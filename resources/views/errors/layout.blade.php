<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('page_title') | ElectroHub</title>

    <style>
        :root {
            --navy: #101b31;
            --blue: #2477ee;
            --white: #fff;
            --soft: #a4b4cd;
        }

        * { box-sizing: border-box; }

        html { min-height: 100%; }

        body {
            margin: 0;
            min-height: 100vh;
            overflow-x: hidden;
            font-family: Inter, "Segoe UI", Arial, sans-serif;
            color: var(--white);
            background:
                radial-gradient(ellipse at 85% 40%, rgba(36,119,238,.20), transparent 38%),
                radial-gradient(ellipse at 10% 85%, rgba(15,75,167,.17), transparent 35%),
                #101b31;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: .25;
            background-image:
                linear-gradient(rgba(146,179,231,.10) 1px, transparent 1px),
                linear-gradient(90deg, rgba(146,179,231,.10) 1px, transparent 1px);
            background-size: 48px 48px;
            mask-image: linear-gradient(to bottom, black, transparent 90%);
        }

        a { color: inherit; text-decoration: none; }

        .container { width: min(1160px, calc(100% - 48px)); margin: 0 auto; }

        .site-header {
            position: relative;
            z-index: 1;
            padding: 27px 0;
            border-bottom: 1px solid rgba(255,255,255,.09);
        }

        .header-inner { display: flex; align-items: center; justify-content: space-between; gap: 16px; }
        .brand { display: flex; align-items: center; gap: 11px; font-weight: 850; font-size: 19px; letter-spacing: -.6px; }
        .brand-icon { width: 40px; height: 40px; display: grid; place-items: center; border-radius: 12px; background: var(--blue); box-shadow: 0 7px 24px rgba(36,119,238,.26); }
        .brand-icon svg { width: 24px; height: 24px; }
        .brand span span { color: #6aabff; }
        .top-link { color: #c4d2e5; font-size: 13px; font-weight: 700; transition: color .2s; }
        .top-link:hover { color: #fff; }

        .main { position: relative; z-index: 1; }
        .hero { min-height: min(690px, calc(100vh - 190px)); display: grid; grid-template-columns: 1.05fr .95fr; align-items: center; gap: 28px; padding: 52px 0 68px; }
        .eyebrow { color: #79b5ff; font-size: 12px; font-weight: 850; letter-spacing: 2.5px; text-transform: uppercase; }
        .error-number { margin: 10px 0 0; font-size: clamp(102px, 14vw, 185px); letter-spacing: -12px; line-height: .98; font-weight: 900; background: linear-gradient(145deg, #fff 20%, #6baaff 85%); background-clip: text; -webkit-background-clip: text; color: transparent; }
        .headline { margin: 21px 0 15px; max-width: 590px; font-size: clamp(28px, 3.3vw, 43px); line-height: 1.13; letter-spacing: -1.4px; }
        .description { max-width: 500px; color: var(--soft); font-size: 15px; line-height: 1.9; }
        .actions { display: flex; gap: 13px; flex-wrap: wrap; margin-top: 31px; }
        .btn { min-height: 48px; display: inline-flex; align-items: center; justify-content: center; gap: 9px; padding: 13px 20px; border-radius: 11px; font-size: 13px; font-weight: 800; transition: transform .2s, background .2s, border-color .2s; }
        .btn:hover { transform: translateY(-2px); }
        .btn-primary { background: var(--blue); box-shadow: 0 10px 30px rgba(36,119,238,.28); }
        .btn-primary:hover { background: #3889ff; }
        .btn-outline { border: 1px solid rgba(255,255,255,.19); background: rgba(255,255,255,.055); }
        .btn-outline:hover { border-color: rgba(255,255,255,.50); background: rgba(255,255,255,.10); }
        .btn svg { width: 17px; height: 17px; }
        .hint { margin-top: 32px; display: flex; align-items: center; gap: 10px; font-size: 12px; color: #8196b5; }
        .hint-dot { width: 7px; height: 7px; border-radius: 100%; background: #4dabff; box-shadow: 0 0 0 5px rgba(77,171,255,.10); }

        .visual { min-height: 420px; display: grid; place-items: center; position: relative; isolation: isolate; }
        .glow { position: absolute; width: 310px; height: 310px; background: #2477ee; opacity: .22; filter: blur(90px); border-radius: 50%; z-index: -1; }
        .ring { position: absolute; width: min(95%, 420px); aspect-ratio: 1; border: 1px dashed rgba(127,176,255,.20); border-radius: 50%; }
        .ring::after { content: ""; position: absolute; top: 14%; right: 14%; width: 11px; height: 11px; border-radius: 50%; background: #469aff; box-shadow: 0 0 16px #469aff; }
        .ring-small { width: min(75%, 330px); border-style: solid; border-color: rgba(127,176,255,.10); }
        .art-card { position: relative; width: min(300px, 80%); padding: 30px 27px; border: 1px solid rgba(176,204,255,.20); border-radius: 26px; background: linear-gradient(140deg, rgba(49,82,137,.40), rgba(16,27,49,.83)); box-shadow: 0 30px 85px rgba(0,0,0,.23), inset 0 1px 1px rgba(255,255,255,.13); backdrop-filter: blur(18px); transform: rotate(-5deg); animation: float 5.5s ease-in-out infinite; }
        .art-toolbar { display: flex; align-items: center; gap: 6px; padding-bottom: 19px; border-bottom: 1px solid rgba(255,255,255,.10); }
        .art-toolbar i { width: 7px; height: 7px; border-radius: 50%; background: #5e8abf; }
        .art-toolbar i:first-child { background: #3889ff; }
        .art-icon { width: 116px; height: 116px; margin: 30px auto 22px; display: grid; place-items: center; border-radius: 32px; color: #95c5ff; background: linear-gradient(145deg, rgba(36,119,238,.35), rgba(36,119,238,.08)); border: 1px solid rgba(111,173,255,.28); }
        .art-icon svg { width: 67px; height: 67px; }
        .art-title { text-align: center; font-size: 14px; font-weight: 850; letter-spacing: 1.5px; }
        .art-caption { text-align: center; margin: 9px 0 7px; font-size: 11px; line-height: 1.6; color: #95a9c7; }
        .float-label { position: absolute; right: 0; top: 12%; border: 1px solid rgba(124,183,255,.25); background: rgba(28,54,96,.82); border-radius: 12px; padding: 11px 15px; font-size: 11px; color: #b7d8ff; backdrop-filter: blur(12px); box-shadow: 0 10px 30px rgba(0,0,0,.15); }
        .float-label.bottom { top: auto; bottom: 12%; right: auto; left: 0; color: #f0f5ff; }
        .site-footer { position: relative; z-index: 1; border-top: 1px solid rgba(255,255,255,.09); padding: 21px 0; }
        .footer-inner { display: flex; justify-content: space-between; flex-wrap: wrap; gap: 12px; color: #7d8eaa; font-size: 12px; }

        @keyframes float { 0%, 100% { transform: translateY(0) rotate(-5deg); } 50% { transform: translateY(-12px) rotate(-3deg); } }
        @media (max-width: 820px) {
            .hero { grid-template-columns: 1fr; text-align: center; gap: 15px; padding: 55px 0 42px; }
            .copy { display: flex; flex-direction: column; align-items: center; }
            .error-number { letter-spacing: -7px; }
            .headline, .description { max-width: 620px; }
            .actions { justify-content: center; }
            .visual { min-height: 345px; width: min(440px, 100%); margin: 0 auto; }
            .art-card { width: 255px; }
            .ring { width: 330px; }
            .ring-small { width: 270px; }
        }
        @media (max-width: 480px) {
            .container { width: min(100% - 30px, 1160px); }
            .top-link { font-size: 12px; }
            .brand { font-size: 17px; }
            .brand-icon { width: 36px; height: 36px; }
            .headline { font-size: 29px; }
            .description { font-size: 14px; }
            .error-number { font-size: 105px; }
            .actions { width: 100%; flex-direction: column; }
            .btn { width: 100%; }
            .visual { min-height: 320px; }
            .float-label { display: none; }
            .ring { width: 295px; }
            .ring-small { width: 240px; }
            .art-card { width: 245px; }
        }
        @media (prefers-reduced-motion: reduce) {
            .art-card { animation: none; }
            .btn { transition: none; }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="container header-inner">
            <a class="brand" href="{{ url('/') }}" aria-label="ElectroHub home">
                <span class="brand-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m13 2-9 12h7l-1 8 10-12h-7l0-8z" />
                    </svg>
                </span>
                <span>Electro<span>Hub</span></span>
            </a>
            <a href="{{ url('/') }}" class="top-link">← Back to storefront</a>
        </div>
    </header>

    <main class="main">
        <div class="container hero">
            <section class="copy" aria-labelledby="error-heading">
                <span class="eyebrow">@yield('eyebrow')</span>
                <div class="error-number" aria-label="Error @yield('error_code')">@yield('error_code')</div>
                <h1 class="headline" id="error-heading">@yield('headline')</h1>
                <p class="description">@yield('description')</p>
                <div class="actions">
                    <a class="btn btn-primary" href="{{ url('/') }}">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1z"/></svg>
                        Back to Home
                    </a>
                    <a class="btn btn-outline" href="{{ url('/shop') }}">
                        Browse Products
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
                    </a>
                </div>
                <div class="hint"><span class="hint-dot"></span> @yield('hint')</div>
            </section>

            <aside class="visual" aria-hidden="true">
                <div class="glow"></div>
                <div class="ring"></div>
                <div class="ring ring-small"></div>
                <div class="float-label">● ELECTROHUB / SYSTEM</div>
                <div class="art-card">
                    <div class="art-toolbar"><i></i><i></i><i></i></div>
                    <div class="art-icon">@yield('illustration')</div>
                    <div class="art-title">@yield('art_title')</div>
                    <div class="art-caption">@yield('art_caption')</div>
                </div>
                <div class="float-label bottom">@yield('art_status')</div>
            </aside>
        </div>
    </main>

    <footer class="site-footer">
        <div class="container footer-inner">
            <span>© {{ date('Y') }} ElectroHub. All rights reserved.</span>
            <span>Electronics · Accessories · Smart Tech</span>
        </div>
    </footer>
</body>
</html>
