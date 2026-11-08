
@props([
    'product',
    'floating' => false,
    'showlabel' => false
])

@php
    $isSaved = auth()->check()
        && \App\Models\Wishlist::query()
            ->where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->exists();
@endphp

<button
    type="button"

    class="eh-wl-heart
        {{ $floating ? 'eh-wl-floating' : '' }}
        {{ $isSaved ? 'is-active' : '' }}"

    data-eh-wishlist-btn
    data-product-id="{{ $product->id }}"
    data-product-name="{{ $product->name }}"
    data-toggle-url="{{ route('wishlist.toggle', $product) }}"
    data-login-url="{{ route('wishlist.index') }}"
    data-auth="{{ auth()->check() ? '1' : '0' }}"

    aria-label="{{ $isSaved ? 'Remove from Wishlist' : 'Add to Wishlist' }}"
    aria-pressed="{{ $isSaved ? 'true' : 'false' }}"

    title="{{ $isSaved ? 'Remove from Wishlist' : 'Add to Wishlist' }}"
>
    <svg
        viewBox="0 0 24 24"
        width="20"
        height="20"
        fill="none"
        stroke="currentColor"
        stroke-width="1.9"
        stroke-linecap="round"
        stroke-linejoin="round"
        aria-hidden="true"
    >
        <path
            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78z"
        />
    </svg>

    @if($showlabel)
        <span class="eh-wl-word">
            {{ $isSaved ? 'Saved to Wishlist' : 'Save to Wishlist' }}
        </span>
    @endif
</button>

@once
<style>
    .eh-wl-heart {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;

        min-height: 43px;
        padding: 10px 15px;

        border: 1px solid #dce6f3;
        border-radius: 10px;

        background: #f7faff;
        color: #687a95;

        font-family: inherit;
        font-size: 12px;
        font-weight: 750;

        cursor: pointer;
        transition: all .2s ease;
    }

    .eh-wl-heart:hover {
        color: #d84360;
        border-color: #f4b8c6;
        background: #fff0f3;
        transform: translateY(-1px);
    }

    .eh-wl-heart svg {
        display: block;
        flex-shrink: 0;
        fill: none;
    }

    .eh-wl-heart.is-active {
        color: #d84360;
        border-color: #f4bdca;
        background: #fff0f3;
    }

    .eh-wl-heart.is-active svg {
        fill: currentColor;
    }

    .eh-wl-heart:disabled {
        opacity: .55;
        cursor: wait;
    }

    .eh-wl-heart:focus-visible {
        outline: 2px solid #2477ee;
        outline-offset: 3px;
    }

    /* Small floating heart on product photos */

    .eh-wl-floating {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 10;

        width: 39px;
        height: 39px;
        min-height: 39px;

        border-radius: 50%;
        padding: 0;

        background: rgba(255,255,255,.96);
        box-shadow: 0 5px 18px rgba(16,27,49,.12);
    }

    /* Notification */

    .eh-wl-notification {
        position: fixed;
        right: 22px;
        bottom: 24px;
        z-index: 99999;

        padding: 13px 20px;
        border-radius: 11px;

        background: #101b31;
        color: white;

        font-size: 12px;
        font-family: inherit;

        box-shadow: 0 12px 32px rgba(16,27,49,.25);
    }

    .eh-wl-notification[hidden] {
        display: none;
    }
</style>

<script>
    document.addEventListener('click', async function (event) {

        const button = event.target.closest(
            '[data-eh-wishlist-btn]'
        );

        if (!button) {
            return;
        }

        event.preventDefault();

        // Guest users sign in first.
        if (button.dataset.auth !== '1') {
            window.location.href = button.dataset.loginUrl;
            return;
        }

        if (button.disabled) {
            return;
        }

        button.disabled = true;

        try {
            const response = await fetch(
                button.dataset.toggleUrl,
                {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': @json(csrf_token())
                    }
                }
            );

            if (response.status === 401) {
                window.location.href =
                    button.dataset.loginUrl;
                return;
            }

            if (!response.ok) {
                throw new Error('Wishlist update failed');
            }

            const data = await response.json();

            // Update all hearts for this product.
            document.querySelectorAll(
                '[data-eh-wishlist-btn]'
            ).forEach(item => {

                if (
                    item.dataset.productId !==
                    button.dataset.productId
                ) {
                    return;
                }

                item.classList.toggle(
                    'is-active',
                    data.saved
                );

                item.setAttribute(
                    'aria-pressed',
                    String(data.saved)
                );

                const title = data.saved
                    ? 'Remove from Wishlist'
                    : 'Add to Wishlist';

                item.setAttribute('aria-label', title);
                item.title = title;

                const label = item.querySelector(
                    '.eh-wl-word'
                );

                if (label) {
                    label.textContent = data.saved
                        ? 'Saved to Wishlist'
                        : 'Save to Wishlist';
                }
            });

            // Update a wishlist counter if present.
            const counter = document.getElementById(
                'wishlist-label'
            );

            if (counter && Array.isArray(data.ids)) {
                counter.textContent =
                    data.ids.length + ' saved';
            }

            showWishlistNotification(
                data.saved
                    ? '♡ Product added to Wishlist'
                    : 'Product removed from Wishlist'
            );

        } catch (error) {

            showWishlistNotification(
                'Could not update Wishlist.'
            );

        } finally {
            button.disabled = false;
        }
    });

    function showWishlistNotification(message) {
        let notification = document.getElementById(
            'eh-wl-notification'
        );

        if (!notification) {
            notification = document.createElement('div');

            notification.id = 'eh-wl-notification';
            notification.className = 'eh-wl-notification';
            notification.setAttribute('role', 'status');

            document.body.appendChild(notification);
        }

        notification.textContent = message;
        notification.hidden = false;

        clearTimeout(window.ehWishlistTimer);

        window.ehWishlistTimer = setTimeout(() => {
            notification.hidden = true;
        }, 2500);
    }
</script>
@endonce
