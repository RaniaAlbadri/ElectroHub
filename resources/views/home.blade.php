<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#101b31">
    <meta name="description"
        content="ElectroHub — modern electronics accessories and smart gadgets. A Laravel portfolio storefront demo.">
    <title>ElectroHub — Tech for Every Day</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --navy: #101b31;
            --navy2: #192746;
            --blue: #2477ee;
            --light-blue: #69b8ff;
            --text: #17233a;
            --muted: #748197;
            --border: #e8edf5;
            --soft: #f5f7fb;
            --shadow: 0 14px 45px rgba(20, 41, 83, .08)
        }

        * {
            box-sizing: border-box
        }

        html {
            scroll-behavior: smooth
        }

        body {
            margin: 0;
            background: #fff;
            color: var(--text);
            font-family: Inter, ui-sans-serif, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif
        }

        button,
        input {
            font: inherit
        }

        button {
            cursor: pointer
        }

        a {
            color: inherit;
            text-decoration: none
        }

        img {
            display: block;
            max-width: 100%
        }

        svg {
            display: block
        }

        .icon {
            width: 21px;
            height: 21px;
            stroke: currentColor;
            stroke-width: 1.9;
            fill: none;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex: none
        }

        .container {
            width: min(1280px, calc(100% - 56px));
            margin-inline: auto
        }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        .topbar {
            background: #0f192b;
            color: #dce7f4;
            font-size: 11px
        }

        .topbar .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 35px;
            gap: 20px
        }

        .topbar span {
            display: inline-flex;
            align-items: center;
            gap: 7px
        }

        .topbar .icon {
            width: 13px;
            height: 13px
        }

        .topbar .top-right {
            opacity: .8
        }

        .main-head {
            background: #fff;
            border-bottom: 1px solid var(--border)
        }

        .main-head .container {
            display: flex;
            align-items: center;
            gap: 38px;
            min-height: 84px
        }

        .logo {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            white-space: nowrap;
            flex: none
        }

        .logo-mark {
            display: grid;
            place-items: center;
            width: 39px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, #2d87ff, #6f5aff);
            color: white;
            box-shadow: 0 6px 16px #2477ee36;
            font-weight: 900;
            font-size: 24px;
            letter-spacing: -3px;
            transform: skew(-5deg)
        }

        .logo-copy {
            display: flex;
            flex-direction: column;
            gap: 1px
        }

        .logo-copy strong {
            font-size: 23px;
            line-height: 1;
            letter-spacing: -1.1px
        }

        .logo-copy strong span {
            color: #2378ee
        }

        .logo-copy small {
            font-size: 10px;
            font-weight: 500;
            color: #7d899a
        }

        .search-form {
            display: flex;
            flex: 1;
            max-width: 560px;
            margin: auto;
            height: 43px;
            border: 1px solid #e1e8f1;
            border-radius: 7px;
            background: #f9fbfd;
            overflow: hidden
        }

        .search-form:focus-within {
            border-color: #70aaff;
            box-shadow: 0 0 0 3px #2477ee13
        }

        .search-form input {
            outline: none;
            border: none;
            background: transparent;
            padding: 0 16px;
            min-width: 0;
            flex: 1;
            font-size: 12px;
            color: #23314a
        }

        .search-form .search-btn {
            background: #2378ee;
            border: 0;
            color: #fff;
            width: 49px;
            display: grid;
            place-items: center
        }

        .search-form .search-btn:hover {
            background: #165fca
        }

        .head-actions {
            display: flex;
            align-items: center;
            gap: 18px
        }

        .head-action {
            border: 0;
            background: transparent;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #253149;
            font-size: 12px;
            font-weight: 600;
            padding: 4px;
            position: relative
        }

        .head-action .action-lines {
            display: flex;
            flex-direction: column;
            text-align: left;
            line-height: 1.27
        }

        .head-action .action-lines small {
            font-size: 10px;
            color: #718099;
            font-weight: 400
        }

        .head-action:hover {
            color: var(--blue)
        }

        .counter {
            position: absolute;
            right: -8px;
            top: -9px;
            background: var(--blue);
            font-size: 10px;
            color: #fff;
            min-width: 17px;
            height: 17px;
            padding: 2px;
            border-radius: 20px;
            display: grid;
            place-items: center
        }

        .mobile-trigger {
            display: none;
            border: 0;
            background: transparent;
            padding: 4px;
            color: #1b2b43
        }

        .nav-bar {
            border-bottom: 1px solid var(--border);
            background: #fff
        }

        .nav-bar .container {
            display: flex;
            align-items: center;
            gap: 31px;
            min-height: 47px;
            font-size: 12px;
            font-weight: 600
        }

        .nav-bar a,
        .nav-drop {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            white-space: nowrap
        }

        .nav-bar a:hover,
        .nav-drop:hover {
            color: var(--blue)
        }

        .nav-bar .category-trigger {
            border-right: 1px solid #e5e9f0;
            padding-right: 20px
        }

        .nav-bar .nav-deal {
            color: #eb4b64;
            margin-left: auto
        }

        .nav-drop {
            border: 0;
            background: transparent;
            color: inherit;
            font-weight: 600;
            font-size: 12px
        }

        .nav-drop .icon {
            width: 14px;
            height: 14px
        }

        .nav-shell {
            position: relative
        }

        .category-menu {
            position: absolute;
            left: 0;
            top: calc(100% + 7px);
            z-index: 15;
            background: white;
            box-shadow: 0 16px 38px #192e4b25;
            border: 1px solid var(--border);
            min-width: 220px;
            border-radius: 12px;
            padding: 8px;
            display: none
        }

        .category-menu.is-open {
            display: block
        }

        .category-menu button {
            display: block;
            width: 100%;
            text-align: left;
            padding: 11px;
            border: 0;
            background: transparent;
            border-radius: 7px;
            color: #26364f;
            font-size: 13px
        }

        .category-menu button:hover {
            background: #edf4ff;
            color: #176ee7
        }

        .hero {
            background: radial-gradient(ellipse at 77% 40%, #304c83 0%, #1b2b4b 38%, #101a2e 75%, #0c1526 100%);
            overflow: hidden;
            color: #fff;
            position: relative
        }

        .hero:before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: linear-gradient(120deg, transparent 42%, rgba(127, 183, 255, .08) 63%, transparent 84%);
            pointer-events: none
        }

        .hero:after {
            content: "";
            position: absolute;
            width: 540px;
            height: 540px;
            right: 4%;
            top: -25%;
            background: radial-gradient(circle, #486ef14d, transparent 66%);
            filter: blur(30px);
            pointer-events: none
        }

        .hero .container {
            min-height: 440px;
            display: grid;
            grid-template-columns: 44% 56%;
            align-items: center;
            position: relative;
            z-index: 1
        }

        .hero-content {
            padding: 64px 0 56px 13px;
            z-index: 3
        }

        .eyebrow {
            font-size: 10px;
            letter-spacing: 5px;
            font-weight: 700;
            color: #a8c6f7
        }

        .hero h1 {
            font-size: clamp(41px, 5.2vw, 68px);
            line-height: 1.04;
            letter-spacing: -2.5px;
            font-weight: 850;
            margin: 17px 0
        }

        .hero h1 .accent {
            color: #79b7ff
        }

        .hero p {
            font-size: 14px;
            line-height: 1.7;
            max-width: 445px;
            color: #d4dcec;
            margin: 12px 0 26px
        }

        .primary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            color: #fff;
            background: linear-gradient(110deg, #2584f6, #4b6dfb);
            border: none;
            border-radius: 10px;
            padding: 13px 22px;
            font-weight: 700;
            font-size: 12px;
            box-shadow: 0 8px 26px #1c70ee38;
            transition: transform .2s, box-shadow .2s
        }

        .primary-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 27px #1c70ee56
        }

        .primary-btn .icon {
            width: 15px;
            height: 15px
        }

        .hero-art {
            position: relative;
            align-self: stretch;
            min-height: 415px
        }

        .hero-art img {
            position: absolute;
            width: 115%;
            max-width: none;
            right: -5%;
            bottom: -19px;
            max-height: 510px;
            object-fit: contain;
            filter: drop-shadow(0 25px 28px #050e2670)
        }

        .hero-bottom {
            display: flex;
            align-items: center;
            gap: 23px;
            margin-top: 38px;
            font-size: 11px;
            color: #d7e0f1
        }

        .hero-bottom span {
            display: inline-flex;
            gap: 7px;
            align-items: center;
            white-space: nowrap
        }

        .hero-bottom .icon {
            width: 16px;
            height: 16px;
            color: #9abfff
        }

        .hero-dots {
            position: absolute;
            bottom: 23px;
            right: 12px;
            display: flex;
            gap: 8px;
            z-index: 4
        }

        .hero-dots button {
            width: 7px;
            height: 7px;
            border-radius: 20px;
            background: #a3b0c27a;
            border: 0;
            padding: 0
        }

        .hero-dots button.active {
            width: 24px;
            background: #62a8ff
        }

        .section {
            padding-block: 37px
        }

        .section-title-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 19px
        }

        .section-title-row h2 {
            font-size: 24px;
            line-height: 1.2;
            letter-spacing: -.8px;
            margin: 0;
            font-weight: 800
        }

        .section-title-row .see-all {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: #226eeb;
            font-weight: 700
        }

        .see-all .icon {
            width: 16px;
            height: 16px
        }

        .section-title-row .see-all:hover {
            text-decoration: underline
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 25px
        }

        .category {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            background: transparent;
            border: 0;
            padding: 0;
            color: #26354a;
            font-weight: 650;
            font-size: 13px;
            text-align: center
        }

        .category-photo {
            width: 150px;
            max-width: 100%;
            aspect-ratio: 1;
            border-radius: 50%;
            background: linear-gradient(135deg, #edf5ff, #f7f9ff);
            overflow: hidden;
            box-shadow: 0 1px 0 #d9e6f8;
            transition: transform .22s, box-shadow .22s
        }

        .category-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover
        }

        .category:hover .category-photo {
            transform: translateY(-5px);
            box-shadow: 0 14px 25px #276bcb1c
        }

        .category:hover {
            color: #256eea
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 17px
        }

        .product-card {
            border: 1px solid var(--border);
            background: white;
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            transition: transform .2s, box-shadow .2s
        }

        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow)
        }

        .product-card-media {
            position: relative;
            background: #f5f8fc;
            aspect-ratio: 1.15;
            overflow: hidden
        }

        .product-card-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .2s
        }

        .product-card:hover .product-card-media img {
            transform: scale(1.045)
        }

        .wish-btn {
            position: absolute;
            right: 10px;
            top: 10px;
            width: 29px;
            height: 29px;
            border: 0;
            border-radius: 50%;
            display: grid;
            place-items: center;
            color: #68788c;
            background: #fffdfde8;
            box-shadow: 0 2px 6px #182a4b0e
        }

        .wish-btn .icon {
            width: 18px;
            height: 18px
        }

        .wish-btn.is-active {
            color: #e63b66;
            background: #ffe8ef
        }

        .wish-btn.is-active .icon {
            fill: #e63b66
        }

        .p-badge {
            position: absolute;
            left: 10px;
            top: 11px;
            background: #2769d9;
            color: #fff;
            padding: 5px 7px;
            font-size: 9px;
            font-weight: 800;
            border-radius: 5px;
            letter-spacing: .2px
        }

        .p-badge.sale {
            background: #25a46b
        }

        .product-card-body {
            padding: 12px 13px 13px
        }

        .p-category {
            color: #7790a9;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .6px
        }

        .p-name {
            font-size: 13px;
            font-weight: 700;
            line-height: 1.3;
            margin: 5px 0 3px;
            min-height: 34px
        }

        .p-subtitle {
            color: #8a94a4;
            font-size: 10.5px;
            line-height: 1.3;
            margin-bottom: 10px
        }

        .p-price {
            font-size: 15px;
            font-weight: 800;
            color: #15243a
        }

        .old-price {
            font-size: 11px;
            font-weight: 500;
            color: #a4acb7;
            text-decoration: line-through;
            margin-left: 5px
        }

        .stars {
            color: #f7aa28;
            letter-spacing: 1px;
            font-size: 13px;
            margin-top: 5px
        }

        .stars small {
            font-size: 10px;
            letter-spacing: 0;
            color: #8d97a7
        }

        .product-add {
            border: 1px solid #d9e6f7;
            background: #f2f7ff;
            color: #176de1;
            font-weight: 750;
            font-size: 11px;
            border-radius: 7px;
            margin-top: 11px;
            padding: 8px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background .2s
        }

        .product-add .icon {
            width: 15px;
            height: 15px
        }

        .product-add:hover {
            background: #1f74ed;
            color: white
        }

        .no-results {
            border: 1px dashed #9ab7dd;
            border-radius: 12px;
            text-align: center;
            padding: 30px;
            color: #6d7d92;
            display: none;
            margin-top: 15px
        }

        .no-results.visible {
            display: block
        }

        .promos {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px
        }

        .promo {
            border-radius: 13px;
            overflow: hidden;
            min-height: 215px;
            position: relative;
            padding: 27px;
            display: flex;
            align-items: center
        }

        .promo.dark {
            background: radial-gradient(circle at 78% 34%, #4a277f 0%, #25113f 38%, #12142b 80%);
            color: #fff
        }

        .promo.light {
            background: linear-gradient(110deg, #eaf1ff, #dfe9fc);
            color: #162540
        }

        .promo .copy {
            position: relative;
            z-index: 2;
            max-width: 54%
        }

        .promo .copy small {
            font-size: 11px;
            letter-spacing: 1.1px;
            text-transform: uppercase;
            font-weight: 800;
            opacity: .75
        }

        .promo h3 {
            font-weight: 850;
            font-size: clamp(24px, 2.8vw, 37px);
            line-height: 1.12;
            margin: 8px 0
        }

        .promo p {
            font-size: 12px;
            line-height: 1.55;
            opacity: .82;
            margin: 0 0 18px
        }

        .promo-link {
            font-size: 12px;
            font-weight: 750;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: white;
            color: #18253c;
            border-radius: 30px;
            padding: 10px 15px
        }

        .promo-link .icon {
            width: 15px;
            height: 15px
        }

        .promo.light .promo-link {
            background: #15233b;
            color: #fff
        }

        .promo img {
            position: absolute;
            right: -25px;
            bottom: -27px;
            width: 54%;
            height: 110%;
            object-fit: contain;
            filter: drop-shadow(0 12px 15px #101a343e);
            border-radius: 50%
        }

        .promo.dark img {
            filter: drop-shadow(0 12px 25px #994aff75)
        }

        .benefits {
            background: #f8faff;
            border-radius: 15px;
            padding: 23px 26px;
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 13px;
            margin-top: 10px
        }

        .benefit {
            display: flex;
            gap: 13px;
            align-items: center
        }

        .benefit-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            color: #257ff8;
            background: #e6f1ff;
            flex: none
        }

        .benefit-icon .icon {
            width: 25px;
            height: 25px
        }

        .benefit strong {
            display: block;
            font-size: 12px
        }

        .benefit small {
            display: block;
            font-size: 10px;
            color: #748199;
            margin-top: 5px;
            line-height: 1.35
        }

        .newsletter {
            margin-top: 34px;
            background: linear-gradient(110deg, #111b30, #152443 65%, #112742);
            color: #fff;
            padding: 32px 44px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            gap: 32px;
            justify-content: space-between
        }

        .newsletter h2 {
            font-size: 26px;
            margin: 0 0 8px;
            letter-spacing: -.8px
        }

        .newsletter h2 span {
            color: #6aaaff
        }

        .newsletter p {
            font-size: 12px;
            color: #c5d3e8;
            max-width: 425px;
            line-height: 1.55;
            margin: 0
        }

        .newsletter form {
            display: flex;
            min-width: 320px;
            max-width: 460px;
            flex: 1;
            height: 46px;
            border-radius: 8px;
            overflow: hidden
        }

        .newsletter input {
            border: 0;
            outline: none;
            padding: 0 17px;
            min-width: 0;
            flex: 1;
            font-size: 12px;
            color: #1a2b46;
            background: white
        }

        .newsletter button {
            border: 0;
            background: #237af0;
            color: #fff;
            padding: 0 22px;
            font-size: 12px;
            font-weight: 750
        }

        .footer {
            margin-top: 40px;
            background: #fff;
            border-top: 1px solid #e9eef5;
            padding-top: 37px
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2.2fr 1fr 1fr 1fr;
            gap: 32px
        }

        .footer .logo-copy strong {
            font-size: 22px
        }

        .footer-desc {
            font-size: 12px;
            color: #7d889a;
            line-height: 1.7;
            max-width: 300px;
            margin-top: 13px
        }

        .footer h3 {
            font-size: 13px;
            margin: 0 0 14px
        }

        .footer ul {
            list-style: none;
            margin: 0;
            padding: 0
        }

        .footer li {
            margin-bottom: 10px
        }

        .footer li a,
        .footer li button {
            font-size: 11px;
            color: #718097;
            border: 0;
            background: none;
            padding: 0;
            text-align: left
        }

        .footer li a:hover,
        .footer li button:hover {
            color: #2378ee
        }

        .socials {
            display: flex;
            gap: 10px;
            margin-top: 14px
        }

        .socials span {
            width: 30px;
            height: 30px;
            display: grid;
            place-items: center;
            border-radius: 8px;
            background: #edf4ff;
            color: #2474e5;
            font-size: 13px;
            font-weight: 800
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 20px 0;
            margin-top: 25px;
            border-top: 1px solid var(--border);
            font-size: 11px;
            color: #8290a3
        }

        .toast {
            position: fixed;
            bottom: 26px;
            left: 50%;
            transform: translate(-50%, 100px);
            background: #13243e;
            color: white;
            border: 1px solid #41648d;
            border-radius: 11px;
            padding: 12px 20px;
            font-size: 13px;
            box-shadow: 0 18px 40px #0b203545;
            z-index: 100;
            opacity: 0;
            transition: transform .24s, opacity .24s;
            max-width: min(480px, 90vw);
            text-align: center;
            pointer-events: none
        }

        .toast.visible {
            transform: translate(-50%, 0);
            opacity: 1
        }

        .drawer-backdrop {
            position: fixed;
            inset: 0;
            background: #0e203c79;
            z-index: 50;
            display: none
        }

        .drawer-backdrop.open {
            display: block
        }

        .cart-drawer {
            position: fixed;
            z-index: 51;
            top: 0;
            right: 0;
            width: min(420px, 100%);
            height: 100dvh;
            background: #fff;
            box-shadow: -20px 0 70px #13213a25;
            transform: translateX(105%);
            transition: transform .24s;
            display: flex;
            flex-direction: column
        }

        .cart-drawer.open {
            transform: translateX(0)
        }

        .cart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border);
            padding: 20px 22px
        }

        .cart-header strong {
            font-size: 20px
        }

        .icon-button {
            border: 0;
            background: #f0f4fa;
            display: grid;
            place-items: center;
            width: 35px;
            height: 35px;
            border-radius: 9px
        }

        .cart-items {
            overflow: auto;
            padding: 15px 22px;
            flex: 1
        }

        .cart-item {
            display: flex;
            gap: 12px;
            padding: 15px 0;
            border-bottom: 1px solid var(--border)
        }

        .cart-item img {
            width: 80px;
            height: 75px;
            border-radius: 9px;
            object-fit: cover;
            background: #e9f2fa
        }

        .cart-item strong {
            font-size: 13px;
            display: block
        }

        .cart-item small {
            color: var(--muted);
            font-size: 12px;
            display: block;
            margin-top: 5px
        }

        .cart-item button {
            font-size: 11px;
            background: none;
            border: 0;
            color: #d84460;
            padding: 7px 0
        }

        .cart-footer {
            border-top: 1px solid var(--border);
            padding: 18px 22px
        }

        .cart-footer-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 15px;
            margin-bottom: 14px
        }

        .cart-footer button {
            width: 100%;
            border: 0;
            border-radius: 9px;
            background: #237af0;
            color: white;
            font-weight: 700;
            padding: 13px
        }

        .cart-footer button:disabled {
            background: #aeb8c7;
            cursor: not-allowed
        }

        @media(max-width:1050px) {
            .main-head .container {
                gap: 20px
            }

            .head-actions .action-lines {
                display: none
            }

            .nav-bar .container {
                gap: 19px
            }

            .category-photo {
                width: 125px
            }

            .products-grid {
                gap: 12px
            }

            .product-card-body {
                padding: 10px
            }

            .hero h1 {
                font-size: 52px
            }

            .promo .copy {
                max-width: 58%
            }
        }

        @media(max-width:800px) {
            .container {
                width: min(100% - 34px, 1280px)
            }

            .main-head .container {
                min-height: 70px;
                gap: 12px
            }

            .mobile-trigger {
                display: block
            }

            .logo-copy strong {
                font-size: 20px
            }

            .logo-copy small {
                font-size: 9px
            }

            .search-form {
                max-width: 270px
            }

            .head-actions {
                gap: 10px
            }

            .nav-bar {
                display: none
            }

            .nav-bar.open {
                display: block
            }

            .nav-bar .container {
                display: flex;
                align-items: flex-start;
                flex-direction: column;
                gap: 0;
                padding-block: 9px
            }

            .nav-bar a,
            .nav-drop {
                padding: 10px 0
            }

            .nav-bar .category-trigger {
                border: 0
            }

            .nav-bar .nav-deal {
                margin-left: 0
            }

            .category-menu {
                position: static;
                box-shadow: none;
                margin-bottom: 10px
            }

            .hero .container {
                grid-template-columns: 1fr 1fr;
                min-height: 385px
            }

            .hero-content {
                padding: 40px 0
            }

            .hero h1 {
                font-size: 44px
            }

            .hero-art {
                min-height: 370px
            }

            .hero-art img {
                width: 135%;
                right: -27%;
                bottom: 0
            }

            .hero-bottom {
                gap: 12px;
                flex-wrap: wrap;
                font-size: 10px
            }

            .category-grid {
                gap: 15px
            }

            .products-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr))
            }

            .benefits {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                row-gap: 24px
            }

            .footer-grid {
                grid-template-columns: 2fr 1fr 1fr
            }

            .footer-grid>div:last-child {
                display: none
            }
        }

        @media(max-width:600px) {
            .topbar .container {
                justify-content: center;
                text-align: center
            }

            .topbar .top-right {
                display: none
            }

            .main-head .container {
                gap: 11px;
                flex-wrap: wrap;
                padding-block: 11px
            }

            .logo-mark {
                width: 31px;
                height: 34px;
                font-size: 20px
            }

            .logo-copy strong {
                font-size: 19px
            }

            .logo-copy small {
                font-size: 8px
            }

            .search-form {
                order: 5;
                flex-basis: 100%;
                max-width: none;
                height: 40px
            }

            .head-actions {
                margin-left: auto
            }

            .head-action {
                gap: 0
            }

            .head-action .icon {
                width: 20px;
                height: 20px
            }

            .hero .container {
                grid-template-columns: 1fr;
                min-height: auto
            }

            .hero-content {
                padding: 41px 0 5px;
                text-align: left
            }

            .hero h1 {
                font-size: 44px;
                letter-spacing: -1.5px;
                max-width: 420px
            }

            .hero p {
                font-size: 12px;
                max-width: 330px;
                margin-bottom: 19px
            }

            .hero-art {
                min-height: 245px
            }

            .hero-art img {
                width: 96%;
                right: 0;
                bottom: -38px;
                max-height: 300px
            }

            .hero-bottom {
                margin-top: 22px;
                gap: 13px
            }

            .hero-bottom span:last-child {
                display: none
            }

            .hero-dots {
                bottom: 11px;
                right: 10px
            }

            .section {
                padding-block: 27px
            }

            .section-title-row h2 {
                font-size: 21px
            }

            .category-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 18px 9px
            }

            .category-photo {
                width: 105px
            }

            .category {
                font-size: 11px
            }

            .products-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 10px
            }

            .product-card-media {
                aspect-ratio: 1
            }

            .p-name {
                font-size: 12px
            }

            .p-price {
                font-size: 13px
            }

            .p-subtitle {
                font-size: 10px
            }

            .product-card-body {
                padding: 10px
            }

            .promos {
                grid-template-columns: 1fr;
                gap: 13px
            }

            .promo {
                min-height: 188px
            }

            .promo h3 {
                font-size: 28px
            }

            .promo .copy {
                max-width: 60%
            }

            .benefits {
                padding: 20px;
                gap: 18px 10px
            }

            .benefit {
                gap: 8px
            }

            .benefit-icon {
                width: 38px;
                height: 38px
            }

            .benefit-icon .icon {
                width: 20px;
                height: 20px
            }

            .benefit strong {
                font-size: 10px
            }

            .benefit small {
                font-size: 9px
            }

            .newsletter {
                padding: 25px;
                flex-direction: column;
                align-items: stretch;
                gap: 22px
            }

            .newsletter h2 {
                font-size: 23px
            }

            .newsletter form {
                min-width: 0;
                max-width: none;
                flex: none;
                width: 100%;
                height: 44px
            }

            .newsletter button {
                padding: 0 14px
            }

            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 24px
            }

            .footer-grid>div:first-child {
                grid-column: 1/-1
            }

            .footer-grid>div:last-child {
                display: block
            }

            .footer-bottom {
                flex-direction: column;
                gap: 5px
            }

            .primary-btn {
                padding: 12px 17px
            }
        }

        @media(prefers-reduced-motion:reduce) {

            *,
            *:before,
            *:after {
                scroll-behavior: auto !important;
                animation-duration: .01ms !important;
                transition-duration: .01ms !important
            }
        }

        .product-card .stars {
            display: none;
        }


        /* ========================================
   ElectroHub Home Account Dropdown
======================================== */

        .eh-home-account {
            display: flex;
            align-items: center;
            position: relative;
            z-index: 100;
        }

        /* Guest Buttons */

        .eh-home-guest-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .eh-home-signin {
            color: #17233a;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
        }

        .eh-home-signin:hover {
            color: #2477ee;
        }

        .eh-home-register {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 18px;
            background: #2477ee;
            color: #ffffff !important;
            border-radius: 9px;
            font-size: 12px;
            font-weight: 750;
            text-decoration: none;
            white-space: nowrap;
            transition: background .2s ease;
        }

        .eh-home-register:hover {
            background: #175fcb;
        }

        /* Logged In User */

        .eh-home-user-menu {
            position: relative;
        }

        .eh-home-user-trigger {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 7px 12px;
            border: 1px solid #e3eaf4;
            background: #f6f9fd;
            border-radius: 10px;
            cursor: pointer;
            list-style: none;
            transition: .2s;
        }

        .eh-home-user-trigger::-webkit-details-marker {
            display: none;
        }

        .eh-home-user-trigger::marker {
            content: "";
        }

        .eh-home-user-trigger:hover {
            background: #edf4ff;
            border-color: #cddff7;
        }

        .eh-home-user-trigger:focus-visible {
            outline: 2px solid #2477ee;
            outline-offset: 3px;
        }

        .eh-home-user-icon {
            width: 34px;
            height: 34px;
            display: grid;
            place-items: center;
            background: #e2edff;
            color: #2477ee;
            border-radius: 50%;
        }

        .eh-home-user-name {
            color: #17233a;
            font-size: 12px;
            font-weight: 750;
            max-width: 130px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .eh-home-user-chevron {
            color: #718099;
            transition: transform .2s;
        }

        .eh-home-user-menu[open] .eh-home-user-chevron {
            transform: rotate(180deg);
        }

        /* Dropdown */

        .eh-home-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            width: 240px;
            max-width: calc(100vw - 24px);
            background: #ffffff;
            border: 1px solid #e4ebf5;
            border-radius: 13px;
            box-shadow: 0 15px 40px rgba(16, 27, 49, .16);
            padding: 8px;
            z-index: 9999;
        }

        .eh-home-dropdown-header {
            display: flex;
            flex-direction: column;
            gap: 5px;
            padding: 12px;
        }

        .eh-home-dropdown-header strong {
            color: #17233a;
            font-size: 13px;
            font-weight: 750;
            overflow-wrap: anywhere;
        }

        .eh-home-dropdown-header small {
            color: #718099;
            font-size: 11px;
            overflow-wrap: anywhere;
        }

        .eh-home-dropdown-divider {
            height: 1px;
            background: #edf1f6;
            margin: 6px 0;
        }

        .eh-home-dropdown-link,
        .eh-home-logout {
            display: flex;
            align-items: center;
            gap: 11px;
            width: 100%;
            padding: 12px;
            border: 0;
            border-radius: 8px;
            background: transparent;
            color: #263954;
            font-size: 12px;
            font-weight: 700;
            text-align: left;
            text-decoration: none;
            cursor: pointer;
            font-family: inherit;
        }

        .eh-home-dropdown-link:hover {
            background: #edf4ff;
            color: #2477ee;
        }

        .eh-home-dropdown form {
            margin: 0;
        }

        .eh-home-logout {
            color: #d84460;
        }

        .eh-home-logout:hover {
            background: #fff0f3;
            color: #bb304d;
        }

        /* Responsive */

        @media (max-width: 600px) {
            .eh-home-guest-actions {
                gap: 8px;
            }

            .eh-home-register {
                padding: 9px 12px;
                font-size: 11px;
            }

            .eh-home-signin {
                font-size: 11px;
            }

            .eh-home-user-name {
                max-width: 75px;
            }

            .eh-home-user-trigger {
                gap: 6px;
                padding: 5px 8px;
            }

            .eh-home-dropdown {
                width: 220px;
            }
        }

/* ==========================================
   ElectroHub - Shop by Brand
========================================== */

.brands-description {
    margin: 8px 0 0;
    color: #748197;
    font-size: 12px;
}

.brands-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 17px;
}

.brand-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 12px;

    min-height: 185px;
    padding: 23px 15px;

    background: #ffffff;
    border: 1px solid #e5ebf5;
    border-radius: 15px;

    text-decoration: none;
    text-align: center;

    transition:
        transform .2s ease,
        box-shadow .2s ease,
        border-color .2s ease;
}

.brand-card:hover {
    transform: translateY(-4px);
    border-color: #b7d2ff;
    box-shadow: 0 15px 35px rgba(36, 119, 238, .09);
}

.brand-mark {
    width: 65px;
    height: 65px;

    display: grid;
    place-items: center;

    border-radius: 17px;
    background: linear-gradient(135deg, #edf4ff, #e2edff);

    color: #2477ee;

    font-size: 29px;
    font-weight: 850;
    letter-spacing: -1px;
}

.brand-name {
    color: #17233a;
    font-size: 15px;
    font-weight: 800;
}

.brand-explore {
    color: #2477ee;
    font-size: 11px;
    font-weight: 700;
}

@media (max-width: 800px) {
    .brands-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }
}

@media (max-width: 600px) {
    .brands-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 11px;
    }

    .brand-card {
        min-height: 155px;
        padding: 17px 10px;
    }

    .brand-mark {
        width: 53px;
        height: 53px;
        font-size: 24px;
    }

    .brand-name {
        font-size: 13px;
    }
}

@include('components.guest-shopping-guard');

    </style>

</head>

<body>

    <svg xmlns="http://www.w3.org/2000/svg" style="position:absolute;width:0;height:0;overflow:hidden" aria-hidden="true">
        <symbol id="ic-search" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="7.5" />
            <path d="m17 17 4.5 4.5" />
        </symbol>
        <symbol id="ic-cart" viewBox="0 0 24 24">
            <circle cx="9" cy="21" r="1" />
            <circle cx="19" cy="21" r="1" />
            <path d="M2 3h2l3 13h13l2-10H5" />
        </symbol>
        <symbol id="ic-heart" viewBox="0 0 24 24">
            <path
                d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8L12 21l8.8-8.6a5.5 5.5 0 0 0 0-7.8Z" />
        </symbol>
        <symbol id="ic-user" viewBox="0 0 24 24">
            <circle cx="12" cy="7.5" r="4" />
            <path d="M4 22v-2a8 8 0 0 1 16 0v2" />
        </symbol>
        <symbol id="ic-menu" viewBox="0 0 24 24">
            <path d="M4 6h16M4 12h16M4 18h16" />
        </symbol>
        <symbol id="ic-arrow" viewBox="0 0 24 24">
            <path d="M4 12h16m-7-7 7 7-7 7" />
        </symbol>
        <symbol id="ic-chevron" viewBox="0 0 24 24">
            <path d="m6 9 6 6 6-6" />
        </symbol>
        <symbol id="ic-truck" viewBox="0 0 24 24">
            <path d="M2 5h12v12H2zM14 9h4l4 5v3h-8z" />
            <circle cx="7" cy="19" r="2" />
            <circle cx="18" cy="19" r="2" />
        </symbol>
        <symbol id="ic-shield" viewBox="0 0 24 24">
            <path d="m12 2 9 4v6c0 6-4 9-9 10-5-1-9-4-9-10V6z" />
            <path d="m8 12 3 3 5-6" />
        </symbol>
        <symbol id="ic-headphones" viewBox="0 0 24 24">
            <path d="M3 14v-3a9 9 0 0 1 18 0v3M3 14h4v7H5a2 2 0 0 1-2-2zm18 0h-4v7h2a2 2 0 0 0 2-2z" />
        </symbol>
        <symbol id="ic-spark" viewBox="0 0 24 24">
            <path d="m12 2 2.3 7.7L22 12l-7.7 2.3L12 22l-2.3-7.7L2 12l7.7-2.3z" />
        </symbol>
        <symbol id="ic-close" viewBox="0 0 24 24">
            <path d="m5 5 14 14M19 5 5 19" />
        </symbol>
    </svg>

    <div class="topbar">
        <div class="container"><span><svg class="icon">
                    <use href="#ic-spark" />
                </svg> ElectroHub — Modern tech, everyday essentials <span aria-hidden="true">&nbsp; | &nbsp;</span>
                Portfolio Demo Store</span><span class="top-right">Sample products & prices · No real purchases</span>
        </div>
    </div>

    <header class="main-head" id="top">
        <div class="container">
            <button class="mobile-trigger" type="button" id="mobile-menu-btn" aria-label="Toggle navigation"
                aria-expanded="false"><svg class="icon">
                    <use href="#ic-menu" />
                </svg></button>
            <a class="logo" href="#top" aria-label="ElectroHub home"><span class="logo-mark">E</span><span
                    class="logo-copy"><strong>Electro<span>Hub</span></strong><small>Tech for Every
                        Day.</small></span></a>
            <form class="search-form" role="search" id="search-form"><label class="sr-only" for="site-search">Search
                    products</label><input id="site-search" type="search"
                    placeholder="Search for products, brands or more..." autocomplete="off"><button class="search-btn"
                    type="submit" aria-label="Search"><svg class="icon">
                        <use href="#ic-search" />
                    </svg></button></form>
            <div class="head-actions">

                <!-- ElectroHub Account Menu -->
                <div class="eh-home-account">

                    @guest
                        <!-- Visitor: Not Logged In -->

                        <div class="eh-home-guest-actions">

                            <a href="{{ route('login') }}" class="eh-home-signin">
                                <i class="ri-user-line"></i> Sign In
                            </a>

                        </div>
                    @else
                        <!-- Logged In User -->

                        <details class="eh-home-user-menu" id="eh-home-user-menu">

                            <summary class="eh-home-user-trigger">

                                <span class="eh-home-user-icon">
                                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                        stroke-linejoin="round">

                                        <circle cx="12" cy="8" r="4" />

                                        <path d="M4 21v-2a8 8 0 0 1 16 0v2" />

                                    </svg>
                                </span>

                                <span class="eh-home-user-name">
                                    {{ auth()->user()->name }}
                                </span>

                                <svg class="eh-home-user-chevron" width="15" height="15" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="m6 9 6 6 6-6" />

                                </svg>

                            </summary>

                            <div class="eh-home-dropdown">

                                <div class="eh-home-dropdown-header">

                                    <strong>
                                        {{ auth()->user()->name }}
                                    </strong>

                                    <small>
                                        {{ auth()->user()->email }}
                                    </small>

                                </div>

                                <div class="eh-home-dropdown-divider"></div>

                                <a href="{{ route('profile.edit') }}" class="eh-home-dropdown-link">

                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.8">

                                        <circle cx="12" cy="8" r="4" />

                                        <path d="M4 21v-2a8 8 0 0 1 16 0v2" />

                                    </svg>

                                    My Profile

                                </a>

                                @can('manage-store')
                                    <a href="{{ route('admin.dashboard') }}" class="eh-home-dropdown-link">

                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.8">

                                            <rect x="3" y="3" width="7" height="7" />

                                            <rect x="14" y="3" width="7" height="7" />

                                            <rect x="3" y="14" width="7" height="7" />

                                            <rect x="14" y="14" width="7" height="7" />

                                        </svg>

                                        Admin Dashboard

                                    </a>
                                @endcan

                                <div class="eh-home-dropdown-divider"></div>

                                <form method="POST" action="{{ route('logout') }}">

                                    @csrf

                                    <button type="submit" class="eh-home-logout">

                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round"
                                            stroke-linejoin="round">

                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />

                                            <path d="m16 17 5-5-5-5" />

                                            <path d="M21 12H9" />

                                        </svg>

                                        Logout

                                    </button>

                                </form>

                            </div>

                        </details>
                    @endguest

                </div>

                <button class="head-action" type="button" id="wishlist-show"><svg class="icon">
                        <use href="#ic-heart" />
                    </svg><span class="action-lines">Wishlist <small><span id="wishlist-label">0
                                saved</span></small></span></button>
                <button class="head-action" type="button" id="cart-open" aria-label="Open cart"><svg
                        class="icon">
                        <use href="#ic-cart" />
                    </svg><span class="action-lines">Cart <small>View items</small></span><span class="counter"
                        id="cart-count">0</span></button>
            </div>
        </div>
    </header>

    <nav class="nav-bar" id="site-nav" aria-label="Main navigation">
        <div class="container">
            <div class="nav-shell"><button class="nav-drop category-trigger" id="category-menu-btn" type="button"
                    aria-expanded="false"><svg class="icon">
                        <use href="#ic-menu" />
                    </svg> All Categories <svg class="icon">
                        <use href="#ic-chevron" />
                    </svg></button>
                <div id="category-dropdown" class="category-menu" aria-label="Product categories"></div>
            </div>
            <a href="{{ route('shop.index') }}">Shop</a>

            @auth
                <a href="{{ route('orders.index') }}">
                    My Orders
                </a>
            @endauth

            <a href="#categories">Categories</a><a href="#trending">Trending</a><a href="#offers">Special
                Offers</a><a href="#recommended">New Arrivals</a><a href="#benefits">Why ElectroHub</a><a
                class="nav-deal" href="#offers">Deals</a>
        </div>
    </nav>

    <main>
        <section class="hero" aria-labelledby="hero-title">
            <div class="container">
                <div class="hero-content">
                    <span class="eyebrow" id="hero-eyebrow">NEXT GEN TECH</span>
                    <h1 id="hero-title">A Smarter<br>Tomorrow<br><span class="accent">Starts Here.</span></h1>
                    <p id="hero-desc">Explore smart accessories made for your everyday moments. Discover sound, style,
                        and smarter technology.</p>
                    <a href="#trending" class="primary-btn">Shop the Collection <svg class="icon">
                            <use href="#ic-arrow" />
                        </svg></a>
                    <div class="hero-bottom"><span><svg class="icon">
                                <use href="#ic-spark" />
                            </svg> Modern Gadgets</span><span><svg class="icon">
                                <use href="#ic-shield" />
                            </svg> Thoughtful Design</span><span><svg class="icon">
                                <use href="#ic-headphones" />
                            </svg> Better Every Day</span></div>
                </div>
                <div class="hero-art"><img src="/images/electrohub/hero-tech.svg"
                        alt="Modern tech accessories including headphones, earbuds and a smart watch" width="800"
                        height="560" fetchpriority="high" />
                    <div class="hero-dots" id="hero-dots" aria-label="Choose a banner"><button type="button"
                            class="active" aria-label="Slide 1" aria-pressed="true"></button><button type="button"
                            aria-label="Slide 2" aria-pressed="false"></button><button type="button"
                            aria-label="Slide 3" aria-pressed="false"></button></div>
                </div>
            </div>
        </section>

        <section class="section container" id="categories" aria-labelledby="categories-heading">
            <div class="section-title-row">
                <h2 id="categories-heading">Shop by Category</h2><a href="#trending" class="see-all"
                    data-reset>Explore All <svg class="icon">
                        <use href="#ic-arrow" />
                    </svg></a>
            </div>
            <div class="category-grid" id="category-grid"></div>
        </section>

        @php
            $homeBrands = $products
                ->pluck('brand')
                ->filter(fn ($brand) =>
                    is_string($brand) && trim($brand) !== ''
                )
                ->map(fn ($brand) => trim($brand))
                ->unique(fn ($brand) => strtolower($brand))
                ->sort()
                ->take(4);
        @endphp

        @if($homeBrands->isNotEmpty())

        <section
            class="section container"
            id="brands"
            aria-labelledby="brands-heading"
        >
            <div class="section-title-row">

                <div>
                    <h2 id="brands-heading">
                        Shop by Brand
                    </h2>

                    <p class="brands-description">
                        Explore your favorite technology brands.
                    </p>
                </div>

                <a href="{{ route('shop.index') }}"
                class="see-all">

                    View All Products →

                </a>

            </div>

            <div class="brands-grid">

                @foreach($homeBrands as $brand)

                    <a
                        href="{{ route('shop.index', ['brand' => $brand]) }}"
                        class="brand-card"
                    >

                        <span class="brand-mark">
                            {{ strtoupper(substr($brand, 0, 1)) }}
                        </span>

                        <strong class="brand-name">
                            {{ $brand }}
                        </strong>

                        <span class="brand-explore">
                            Explore Products →
                        </span>

                    </a>

                @endforeach

            </div>

        </section>

        @endif

        <section class="section container" id="trending" aria-labelledby="trending-heading">
            <div class="section-title-row">
                <h2 id="trending-heading">Trending Products</h2><a href="{{ route('shop.index') }}" class="see-all"
                    data-reset>View
                    All <svg class="icon">
                        <use href="#ic-arrow" />
                    </svg></a>
            </div>
            <div class="products-grid" id="trending-grid"></div>
            <div class="no-results" id="no-results">No products found. Try another keyword or category.</div>
        </section>

        <section class="section container" id="offers" aria-label="Featured promotions">
            <div class="promos">
                <article class="promo dark">
                    <div class="copy"><small>THE SOUND EDIT</small>
                        <h3>Level Up<br>Your Sound</h3>
                        <p>Discover headphones and earbuds that fit your day.</p><a href="#trending"
                            class="promo-link" data-category="Audio Devices">Explore Audio <svg class="icon">
                                <use href="#ic-arrow" />
                            </svg></a>
                    </div><img src="/images/electrohub/headphones.svg" width="600" height="500"
                        alt="Headphones" loading="lazy">
                </article>
                <article class="promo light">
                    <div class="copy"><small>MAKE IT YOURS</small>
                        <h3>Your Desk,<br>Upgraded.</h3>
                        <p>Simple accessories for a smarter workspace.</p><a href="#trending" class="promo-link"
                            data-category="Computer Accessories">Shop Workspace <svg class="icon">
                                <use href="#ic-arrow" />
                            </svg></a>
                    </div><img src="/images/electrohub/keyboard.svg" width="600" height="500" alt="Keyboard"
                        loading="lazy">
                </article>
            </div>
        </section>

        <section class="section container" id="recommended" aria-labelledby="recommended-heading">
            <div class="section-title-row">
                <h2 id="recommended-heading">Recommended for You</h2><a href="#trending" class="see-all"
                    data-reset>View All <svg class="icon">
                        <use href="#ic-arrow" />
                    </svg></a>
            </div>
            <div class="products-grid" id="recommended-grid"></div>
        </section>

        <div class="container">
            <section class="benefits" id="benefits" aria-label="ElectroHub features">
                <div class="benefit"><span class="benefit-icon"><svg class="icon">
                            <use href="#ic-truck" />
                        </svg></span><span><strong>Easy Shopping</strong><small>Find the right gear in
                            seconds</small></span></div>
                <div class="benefit"><span class="benefit-icon"><svg class="icon">
                            <use href="#ic-shield" />
                        </svg></span><span><strong>Curated Products</strong><small>Discover useful everyday
                            tech</small></span></div>
                <div class="benefit"><span class="benefit-icon"><svg class="icon">
                            <use href="#ic-spark" />
                        </svg></span><span><strong>Fresh Finds</strong><small>Explore new accessories</small></span>
                </div>
                <div class="benefit"><span class="benefit-icon"><svg class="icon">
                            <use href="#ic-headphones" />
                        </svg></span><span><strong>Portfolio Demo</strong><small>Created with Laravel &
                            Tailwind</small></span></div>
            </section>
        </div>

        <div class="container">
            <section class="newsletter" aria-labelledby="newsletter-heading">
                <div>
                    <h2 id="newsletter-heading">Join <span>ElectroHub+</span></h2>
                    <p>Get inspired by smart tech essentials. This is a front-end demo; no emails are actually sent.</p>
                </div>
                <form id="newsletter-form"><label for="newsletter-email" class="sr-only">Email address</label><input
                        type="email" id="newsletter-email" placeholder="Enter your email address" required><button
                        type="submit">Subscribe</button></form>
            </section>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div><a class="logo" href="#top"><span class="logo-mark">E</span><span
                            class="logo-copy"><strong>Electro<span>Hub</span></strong><small>Tech for Every
                                Day.</small></span></a>
                    <p class="footer-desc">Modern electronics, smarter essentials. A polished e-commerce portfolio
                        project built with Laravel.</p>
                    <div class="socials" aria-label="Design details"><span>EH</span><span>12</span><span>UI</span>
                    </div>
                </div>
                <div>
                    <h3>Shop</h3>
                    <ul>
                        <li><a href="#categories">All Categories</a></li>
                        <li><a href="#trending">Trending Products</a></li>
                        <li><a href="#recommended">Recommended</a></li>
                        <li><a href="#offers">Featured Deals</a></li>
                    </ul>
                </div>
                <div>
                    <h3>Explore</h3>
                    <ul>
                        <li><a href="#categories">Tech Accessories</a></li>
                        <li><a href="#benefits">Our Features</a></li>
                        <li><button type="button" data-demo="Contact page is coming later">Contact</button></li>
                        <li><button type="button" data-demo="Product pages are coming later">Product Details</button>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3>About This Project</h3>
                    <ul>
                        <li><button type="button"
                                data-demo="Built for a GitHub portfolio, not a live store">Portfolio Project</button>
                        </li>
                        <li><button type="button" data-demo="Mock checkout is planned for a later phase">Demo
                                Checkout</button></li>
                        <li><button type="button" data-demo="Admin dashboard is planned for a later phase">Admin
                                Dashboard</button></li>
                        <li><a href="#top">Back to Top ↑</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom"><span>© 2026 ElectroHub. Portfolio demonstration.</span><span>Laravel · MySQL ·
                    Tailwind CSS · Modern Tech UI</span></div>
        </div>
    </footer>

    <div class="drawer-backdrop" id="drawer-backdrop"></div>
    <aside class="cart-drawer" id="cart-drawer" role="dialog" aria-label="Shopping cart" aria-modal="true"
        aria-hidden="true">
        <div class="cart-header"><strong>My Cart</strong><button class="icon-button" type="button" id="cart-close"
                aria-label="Close cart"><svg class="icon">
                    <use href="#ic-close" />
                </svg></button></div>
        <div class="cart-items" id="cart-items"></div>
        <div class="cart-footer">
            <div class="cart-footer-row"><span>Subtotal</span><strong id="cart-subtotal">$0.00</strong></div><button
                type="button" id="checkout-btn">Continue to Checkout (Demo)</button>
        </div>
    </aside>
    <div class="toast" id="toast" role="status" aria-live="polite"></div>

    <script>
        (() => {
            // Demo images from Unsplash when online; the ZIP also includes original local SVG fallbacks.
            const photo = id => `https://images.unsplash.com/${id}?auto=format&fit=crop&w=680&q=82`;
            const fallback = kind => `/images/electrohub/${kind}.svg`;

            const dbCategories = {{ \Illuminate\Support\Js::from($categories) }};

            const categoryImages = {
                'audio-devices': {
                    kind: 'headphones',
                    image: 'photo-1583394838336-acd977736f90'
                },
                'computer-accessories': {
                    kind: 'keyboard',
                    image: 'photo-1587829741301-dc798b83add3'
                },
                'mobile-accessories': {
                    kind: 'powerbank',
                    image: 'photo-1678851836066-dc27614cc56b'
                },
                'smart-gadgets': {
                    kind: 'watch',
                    image: 'photo-1523275335684-37898b6baf30'
                },
                'office-electronics': {
                    kind: 'lamp',
                    image: 'photo-1507473885765-e6ed057f782c'
                }
            };

            const categories = dbCategories.map(c => {
                const visual = categoryImages[c.slug] ?? {
                    kind: 'headphones',
                    image: 'photo-1583394838336-acd977736f90'
                };

                return {
                    name: c.name,
                    kind: visual.kind,
                    photo: c.image ?
                        `/storage/${c.image}` :
                        photo(visual.image)
                };
            });


            const dbProducts = {{ \Illuminate\Support\Js::from($products) }};

            function getProductKind(name) {
                const text = name.toLowerCase();

                if (text.includes('earbud')) return 'earbuds';
                if (text.includes('headphone')) return 'headphones';
                if (text.includes('keyboard')) return 'keyboard';
                if (text.includes('mouse')) return 'mouse';
                if (text.includes('power bank')) return 'powerbank';
                if (text.includes('charger')) return 'charger';
                if (text.includes('watch')) return 'watch';
                if (text.includes('lamp') || text.includes('light')) return 'lamp';

                return 'keyboard';
            }

            const productPhotos = {
                headphones: 'photo-1583394838336-acd977736f90',
                earbuds: 'photo-1572569511254-d8f925fe2cbb',
                keyboard: 'photo-1587829741301-dc798b83add3',
                mouse: 'photo-1527814050087-3793815479db',
                powerbank: 'photo-1678851836066-dc27614cc56b',
                charger: 'photo-1618478594486-c65b899c4931',
                watch: 'photo-1523275335684-37898b6baf30',
                lamp: 'photo-1507473885765-e6ed057f782c'
            };

            const products = dbProducts.map((p, index) => {
                const kind = getProductKind(p.name);

                return {
                    id: p.id,
                    name: p.name,
                    sub: p.description || '',
                    category: p.category?.name || 'Other',
                    price: Number(p.price),
                    old: p.compare_at_price !== null ?
                        Number(p.compare_at_price) :
                        null,
                    rate: null,
                    reviews: null,
                    kind: kind,
                    img: p.image ?
                        `/storage/${p.image}` :
                        photo(productPhotos[kind]),
                    badge: null,
                    section: index < 5 ? 'trending' : 'recommended'
                };
            });

            const icon = name => `<svg class="icon" aria-hidden="true"><use href="#ic-${name}"/></svg>`;
            const safeImage = (src, kind, alt, loading = 'lazy') =>
                `<img src="${fallback(kind)}" data-remote="${src}" width="600" height="500" alt="${alt}" loading="${loading}">`;

            function enhancePhotos() {
                document.querySelectorAll('img[data-remote]:not([data-upgrading])').forEach(img => {
                    img.dataset.upgrading = '1';
                    const test = new Image();
                    test.onload = () => {
                        if (img.isConnected) img.src = test.src;
                    };
                    test.src = img.dataset.remote;
                });
            }
            const money = n => '$' + Number(n).toFixed(2);
            const read = key => {
                try {
                    return JSON.parse(localStorage.getItem(key) || '[]')
                } catch {
                    return []
                }
            };

            const serverCart = @json(session('cart', []));

            let cart = Object.entries(serverCart).map(([id, qty]) => ({
                id: Number(id),
                qty: Number(qty)
            }));


            let wishlist = [];

            const wishlistSignedIn = @json(auth()->check());

            if (!Array.isArray(wishlist)) {
                wishlist = [];
            }

            let filterCat = '',
                filterText = '',
                toastTimer;
            const toast = message => {
                const t = document.getElementById('toast');
                t.textContent = message;
                t.classList.add('visible');
                clearTimeout(toastTimer);
                toastTimer = setTimeout(() => t.classList.remove('visible'), 3000)
            };

            const save = () => {
                try {
                    localStorage.setItem(
                        'electrohub-demo-wishlist',
                        JSON.stringify(wishlist)
                    );
                } catch {}
            };



            async function loadWishlistFromServer() {

                if (!wishlistSignedIn) {
                    wishlist = [];
                    updateCounts();
                    return;
                }


                const oldWishlist = read(
                    'electrohub-demo-wishlist'
                );

                if (Array.isArray(oldWishlist) && oldWishlist.length) {

                    const idsToImport = [
                        ...new Set(
                            oldWishlist
                                .map(Number)
                                .filter(id =>
                                    Number.isInteger(id) && id > 0
                                )
                        )
                    ].slice(0, 100);

                    if (idsToImport.length) {
                        try {
                            const importResponse = await fetch(
                                @json(route('wishlist.import')),
                                {
                                    method: 'POST',
                                    credentials: 'same-origin',
                                    headers: {
                                        'Accept': 'application/json',
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': @json(csrf_token())
                                    },
                                    body: JSON.stringify({
                                        product_ids: idsToImport
                                    })
                                }
                            );

                            if (importResponse.ok) {
                                localStorage.removeItem(
                                    'electrohub-demo-wishlist'
                                );
                            }

                        } catch (error) {
                            console.warn(
                                'Wishlist import was not completed.'
                            );
                        }
                    }
                }

                try {
                    const response = await fetch(
                        @json(route('wishlist.ids')),
                        {
                            credentials: 'same-origin',
                            headers: {
                                'Accept': 'application/json'
                            }
                        }
                    );

                    if (!response.ok) {
                        throw new Error('Wishlist loading failed');
                    }

                    const data = await response.json();

                    wishlist = data.ids.map(Number);

                    updateCounts();
                    renderProducts();

                } catch (error) {
                    toast('Could not load your wishlist.');
                }
            }

            function renderCategories() {

                    document.getElementById('category-grid').innerHTML = categories.slice(0, 5).map(c =>

                    `<button type="button" class="category" data-category="${c.name}"><span class="category-photo">${safeImage(c.photo,c.kind,c.name)}</span><span>${c.name}</span></button>`
                ).join('');
                enhancePhotos();
                document.getElementById('category-dropdown').innerHTML = categories.map(c =>
                    `<button type="button" data-category="${c.name}">${c.name}</button>`).join('')
            }


            function submitCart(action, productId) {
                const form = document.createElement('form');

                form.method = 'POST';
                form.action =
                    `{{ url('/cart') }}/${action}/${encodeURIComponent(productId)}`;

                const token = document.createElement('input');
                token.type = 'hidden';
                token.name = '_token';
                token.value = @json(csrf_token());

                form.appendChild(token);

                if (action === 'add') {
                    const quantity = document.createElement('input');
                    quantity.type = 'hidden';
                    quantity.name = 'quantity';
                    quantity.value = '1';

                    form.appendChild(quantity);
                }

                document.body.appendChild(form);
                form.submit();
            }

            function card(p) {
                const liked = wishlist.includes(p.id);
                return `<article class="product-card"><div class="product-card-media">${safeImage(p.img,p.kind,p.name)}${p.badge?`<span class="p-badge ${p.badge==='SALE'||p.badge.startsWith('-')?'sale':''}">${p.badge}</span>`:''}<button type="button" class="wish-btn ${liked?'is-active':''}" aria-label="${liked?'Remove':'Add'} ${p.name} ${liked?'from':'to'} wishlist" aria-pressed="${liked}" data-wishlist="${p.id}">${icon('heart')}</button></div><div class="product-card-body"><div class="p-category">${p.category}</div><div class="p-name">${p.name}</div><div class="p-subtitle">${p.sub}</div><div class="p-price">${money(p.price)} ${p.old?`<span class="old-price">${money(p.old)}</span>`:''}</div><div class="stars" aria-label="${p.rate} stars out of 5">★★★★★ <small>(${p.reviews})</small></div><button class="product-add" type="button" data-add="${p.id}">${icon('cart')} Add to Cart</button></div></article>`
            }

            function renderProducts() {
                const filtered = products.filter(p => (!filterCat || p.category === filterCat) && (!filterText ||
                    `${p.name} ${p.sub} ${p.category}`.toLowerCase().includes(filterText)));
                const trending = filtered.filter(p => p.section === 'trending'),
                    recommended = filtered.filter(p => p.section === 'recommended');
                document.getElementById('trending-grid').innerHTML = trending.map(card).join('');
                document.getElementById('recommended-grid').innerHTML = recommended.map(card).join('');
                document.getElementById('no-results').classList.toggle('visible', filtered.length === 0);
                document.getElementById('recommended').style.display = recommended.length ? '' : 'none';
                document.getElementById('trending-heading').textContent = filterCat || filterText ? 'Shop Products' :
                    'Trending Products';
                enhancePhotos()
            }

            function updateCounts() {
                document.getElementById('cart-count').textContent = cart.reduce((n, x) => n + x.qty, 0);
                document.getElementById('wishlist-label').textContent = `${wishlist.length} saved`
            }

            function updateCart() {
                updateCounts();
                const el = document.getElementById('cart-items');
                if (!cart.length) {
                    el.innerHTML =
                        '<p style="text-align:center;color:#728097;padding:35px 10px">Your cart is empty. Add a product to get started.</p>'
                } else {
                    el.innerHTML = cart.map(i => {
                        const p = products.find(p => p.id === i.id);
                        if (!p) return '';
                        return `<div class="cart-item">${safeImage(fallback(p.kind),p.kind,p.name)}<div style="flex:1"><strong>${p.name}</strong><small>${money(p.price)} × ${i.qty}</small><button type="button" data-remove="${i.id}">Remove</button></div><strong>${money(p.price*i.qty)}</strong></div>`
                    }).join('')
                };
                document.getElementById('cart-subtotal').textContent = money(cart.reduce((n, i) => n + (products.find(
                    p => p.id === i.id)?.price || 0) * i.qty, 0));
                document.getElementById('checkout-btn').disabled = cart.length === 0
            }

            function openCart() {
                updateCart();
                document.getElementById('cart-drawer').classList.add('open');
                document.getElementById('drawer-backdrop').classList.add('open');
                document.getElementById('cart-drawer').setAttribute('aria-hidden', 'false');
                document.getElementById('cart-close').focus()
            }

            function closeCart() {
                document.getElementById('cart-drawer').classList.remove('open');
                document.getElementById('drawer-backdrop').classList.remove('open');
                document.getElementById('cart-drawer').setAttribute('aria-hidden', 'true');
                document.getElementById('cart-open').focus()
            }

            function applyCategory(category) {
                filterCat = category;
                filterText = '';
                document.getElementById('site-search').value = '';
                renderProducts();
                document.getElementById('category-dropdown').classList.remove('is-open');
                document.getElementById('category-menu-btn').setAttribute('aria-expanded', 'false');
                document.getElementById('trending').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                })
            }

                document.addEventListener('click', async e => {


                const add = e.target.closest('[data-add]');

                if (add) {
                    submitCart('add', add.dataset.add);
                    return;
                }

                if (add) {
                    const id = Number(add.dataset.add),
                        item = cart.find(i => i.id === id);
                    item ? item.qty++ : cart.push({
                        id,
                        qty: 1
                    });
                    save();
                    updateCounts();
                    toast('Added to cart (demo)');
                    return
                }

                const wish = e.target.closest('[data-wishlist]');

                if (wish) {
                    e.preventDefault();

                    // Guests must sign in to save favorites.
                    if (!wishlistSignedIn) {
                        window.location.href =
                            @json(route('wishlist.index'));

                        return;
                    }

                    const id = Number(wish.dataset.wishlist);

                    if (wish.disabled) {
                        return;
                    }

                    wish.disabled = true;

                    try {
                        const response = await fetch(
                            `{{ url('/wishlist/toggle') }}/${id}`,
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
                                @json(route('wishlist.index'));

                            return;
                        }

                        if (!response.ok) {
                            throw new Error('Wishlist update failed');
                        }

                        const result = await response.json();

                        wishlist = result.ids.map(Number);

                        updateCounts();
                        renderProducts();

                        toast(
                            result.saved
                                ? 'Added to your wishlist ♡'
                                : 'Removed from your wishlist'
                        );

                    } catch (error) {
                        wish.disabled = false;

                        toast(
                            'Could not update wishlist. Please try again.'
                        );
                    }

                    return;
                }


                const remove = e.target.closest('[data-remove]');

                if (remove) {
                    submitCart('remove', remove.dataset.remove);
                    return;
                }

                if (remove) {
                    cart = cart.filter(i => i.id !== Number(remove.dataset.remove));
                    save();
                    updateCart();
                    return
                }
                const cat = e.target.closest('[data-category]');
                if (cat) {
                    e.preventDefault();
                    applyCategory(cat.dataset.category);
                    return
                }
                if (e.target.closest('[data-reset]')) {
                    filterCat = '';
                    filterText = '';
                    document.getElementById('site-search').value = '';
                    renderProducts()
                }
                const demo = e.target.closest('[data-demo]');
                if (demo) {
                    toast(demo.dataset.demo);
                    return
                }
            });
            document.getElementById('search-form').addEventListener('submit', e => {
                e.preventDefault();
                filterCat = '';
                filterText = document.getElementById('site-search').value.trim().toLowerCase();
                renderProducts();
                document.getElementById('trending').scrollIntoView({
                    behavior: 'smooth'
                });
                if (!filterText) toast('Showing all products')
            });
            document.getElementById('site-search').addEventListener('input', e => {
                if (!e.target.value.trim()) {
                    filterText = '';
                    filterCat = '';
                    renderProducts()
                }
            });
            document.getElementById('mobile-menu-btn').addEventListener('click', () => {
                const nav = document.getElementById('site-nav'),
                    isOpen = nav.classList.toggle('open');
                document.getElementById('mobile-menu-btn').setAttribute('aria-expanded', String(isOpen))
            });
            document.getElementById('category-menu-btn').addEventListener('click', () => {
                const dd = document.getElementById('category-dropdown'),
                    isOpen = dd.classList.toggle('is-open');
                document.getElementById('category-menu-btn').setAttribute('aria-expanded', String(isOpen))
            });

            document.getElementById('cart-open').addEventListener('click', () => {
                window.location.href = @json(route('cart.index'));
            });

            document.getElementById('cart-close').addEventListener('click', closeCart);
            document.getElementById('drawer-backdrop').addEventListener('click', closeCart);
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape' && document.getElementById('cart-drawer').classList.contains('open'))
                    closeCart()
            });

            document.getElementById('wishlist-show')
                .addEventListener('click', () => {

                    window.location.href =
                        @json(route('wishlist.index'));

                });

            document.getElementById('checkout-btn').addEventListener('click', () => toast(
                'Checkout is planned for the next stage; no payment is taken.'));
            document.getElementById('newsletter-form').addEventListener('submit', e => {
                e.preventDefault();
                toast('Demo only — no subscription or email was sent.');
                e.target.reset()
            });
            const slides = [{
                tag: 'NEXT GEN TECH',
                title: 'A Smarter<br>Tomorrow<br><span class="accent">Starts Here.</span>',
                desc: 'Explore smart accessories made for your everyday moments. Discover sound, style, and smarter technology.'
            }, {
                tag: 'MAKE EVERY DAY BETTER',
                title: 'Powerful Tech.<br><span class="accent">Simple Living.</span>',
                desc: 'Upgrade your workspace, power up your devices, and stay connected to what matters.'
            }, {
                tag: 'THE ELECTROHUB EDIT',
                title: 'Your Gear.<br>Your Style.<br><span class="accent">Your Way.</span>',
                desc: 'From wireless audio to smart gadgets, discover accessories made to fit your routine.'
            }];
            document.querySelectorAll('#hero-dots button').forEach((b, i) => b.addEventListener('click', () => {
                document.getElementById('hero-eyebrow').textContent = slides[i].tag;
                document.getElementById('hero-title').innerHTML = slides[i].title;
                document.getElementById('hero-desc').textContent = slides[i].desc;
                document.querySelectorAll('#hero-dots button').forEach((dot, j) => {
                    dot.classList.toggle('active', j === i);
                    dot.setAttribute('aria-pressed', String(j === i))
                })
            }));
            renderCategories();
            renderProducts();
            updateCounts();
            updateCart();
            loadWishlistFromServer();



            @if (session('success'))
                toast(@json(session('success')));
            @endif

            @if ($errors->has('cart'))
                toast(@json($errors->first('cart')));
            @endif

        })();
    </script>

    <script>
    document.addEventListener('click', function (event) {
        const menu = document.getElementById('eh-home-user-menu');

        if (menu && menu.open && !menu.contains(event.target)) {
            menu.open = false;
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            const menu = document.getElementById('eh-home-user-menu');

            if (menu && menu.open) {
                menu.open = false;
                menu.querySelector('summary').focus();
            }
        }
    });
    </script>

</body>

</html>
