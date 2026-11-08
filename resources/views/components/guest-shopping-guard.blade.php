
@guest
<script>
(function () {

    const loginUrl = @json(route('login'));

    const shoppingControls = [
        '[data-add]',
        '[data-add-demo]',
        '[data-wishlist]',
        '[data-wishlist-heart]',
        '[data-wishlist-toggle]',
        '[data-wish]',
        '#cart-open',
        '#wishlist-show',
        '.wish-btn',
        '.wishlist-heart',
        '.eh-wishlist-heart',
        '.eh-wish-btn',
        'button[aria-label*="wishlist" i]',
        'button[aria-label*="favorite" i]'
    ].join(',');

    document.addEventListener('click', function (event) {

        const element = event.target instanceof Element
            ? event.target.closest(shoppingControls)
            : null;

        if (!element) {
            return;
        }

        event.preventDefault();
        event.stopImmediatePropagation();

        window.location.assign(loginUrl);

    }, true);

})();
</script>
@endguest
