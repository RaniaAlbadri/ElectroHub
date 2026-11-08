
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <meta name="theme-color" content="#101b31">

    <title>
        @yield('title', 'Account') | ElectroHub
    </title>


    @vite('resources/css/electrohub-auth.css')

</head>

<body class="eh-auth-body">

    <header class="eh-auth-header">

        <div class="eh-auth-container eh-auth-nav">

            <a href="{{ route('home') }}"
               class="eh-auth-logo">

                <span class="eh-logo-icon">E</span>

                <span>Electro<b>Hub</b></span>
            </a>

            <nav class="eh-auth-nav-links"
                 aria-label="Main navigation">

                <a href="{{ route('home') }}">Home</a>

                <a href="{{ route('shop.index') }}">Shop</a>

                @guest
                    <a href="{{ route('login') }}">Sign In</a>
                @else
                    <a href="{{ route('profile.edit') }}">
                        My Account
                    </a>
                @endguest

            </nav>

        </div>

    </header>

    <main class="eh-auth-main">

        <div class="eh-auth-container">

            <div class="eh-auth-frame">

                <!-- Navy Brand Panel -->
                <aside class="eh-auth-visual">

                    <span class="eh-visual-tag">
                        ELECTROHUB EXPERIENCE
                    </span>

                    <div class="eh-visual-copy">

                        <h2>
                            @yield(
                                'visual_title',
                                'Smarter Tech. Better Every Day.'
                            )
                        </h2>

                        <p>
                            @yield(
                                'visual_text',
                                'Discover modern electronics and useful accessories for your everyday life.'
                            )
                        </p>

                    </div>

                    <div class="eh-tech-art" aria-hidden="true">

                        <div class="eh-tech-circle"></div>

                        <div class="eh-tech-device">
                            <svg viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.5"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">

                                <path d="M3 14v-3a9 9 0 0 1 18 0v3"/>

                                <path d="M3 14h4v7H5a2 2 0 0 1-2-2v-5zm18 0h-4v7h2a2 2 0 0 0 2-2v-5z"/>

                            </svg>
                        </div>

                        <span class="eh-tech-chip one">
                            ✦ Modern Tech
                        </span>

                        <span class="eh-tech-chip two">
                            Everyday Essentials
                        </span>

                    </div>

                </aside>

                <!-- Form Content -->
                <section class="eh-auth-panel">

                    <div class="eh-auth-content">

                        <div class="eh-form-icon">
                            <svg viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">

                                <rect x="4" y="3"
                                      width="16" height="18"
                                      rx="3"/>

                                <path d="m12 7-3 5h4l-1 5 4-6h-4z"/>

                            </svg>
                        </div>

                        @if(
                            session('status') &&
                            session('status') !== 'verification-link-sent'
                        )
                            <div class="eh-status" role="status">
                                {{ session('status') }}
                            </div>
                        @endif

                        @yield('content')

                    </div>

                </section>

            </div>

        </div>

    </main>

    <footer class="eh-auth-footer">
        © {{ date('Y') }} ElectroHub ·
        Laravel Portfolio Demo · No real purchases
    </footer>

    <script>
        document.querySelectorAll(
            '[data-password-toggle]'
        ).forEach(button => {

            button.addEventListener('click', () => {

                const input = document.getElementById(
                    button.dataset.passwordToggle
                );

                if (!input) return;

                const showing = input.type === 'password';

                input.type = showing ? 'text' : 'password';

                button.textContent = showing ? 'Hide' : 'Show';

                button.setAttribute(
                    'aria-pressed',
                    String(showing)
                );
            });

        });
    </script>

</body>
</html>
