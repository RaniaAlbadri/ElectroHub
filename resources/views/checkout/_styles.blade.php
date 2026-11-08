
<style>
    :root {
        --navy: #101b31;
        --blue: #2477ee;
        --text: #17233a;
        --muted: #718099;
        --soft: #f5f7fb;
        --border: #e6edf6;
    }

    *,
    *::before,
    *::after {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        background: var(--soft);
        color: var(--text);
        font-family: Inter, system-ui, -apple-system,
            "Segoe UI", sans-serif;
    }

    a {
        color: inherit;
        text-decoration: none;
    }

    button,
    input,
    textarea {
        font: inherit;
    }

    button {
        cursor: pointer;
    }

    .topbar {
        background: #0f192b;
        color: #cbd8e8;
        text-align: center;
        padding: 10px 16px;
        font-size: 11px;
    }

    .head {
        background: #fff;
        border-bottom: 1px solid var(--border);
    }

    .wrap {
        width: min(1170px, calc(100% - 36px));
        margin: 0 auto;
    }

    .nav {
        min-height: 75px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
    }

    .logo {
        font-size: 24px;
        font-weight: 850;
        letter-spacing: -1px;
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .logo-mark {
        width: 36px;
        height: 38px;
        border-radius: 11px;
        background: linear-gradient(
            135deg, #2d87ff, #6f5aff
        );
        display: grid;
        place-items: center;
        color: white;
        font-weight: 900;
        font-size: 23px;
        letter-spacing: -3px;
    }

    .logo span:last-child span {
        color: var(--blue);
    }

    .nav-links {
        display: flex;
        gap: 25px;
        align-items: center;
        font-size: 13px;
        font-weight: 650;
    }

    .nav-links a:hover,
    .crumb a:hover {
        color: var(--blue);
    }

    .crumb {
        font-size: 12px;
        color: var(--muted);
        padding: 23px 0;
    }

    h1 {
        font-size: clamp(28px, 3vw, 39px);
        letter-spacing: -1px;
        margin: 0 0 8px;
    }

    .lead {
        font-size: 13px;
        color: var(--muted);
        line-height: 1.6;
        margin: 0 0 27px;
    }

    .layout {
        display: grid;
        grid-template-columns:
            minmax(0, 1.5fr) minmax(300px, .85fr);
        align-items: start;
        gap: 24px;
        padding-bottom: 80px;
    }

    .panel {
        background: white;
        border: 1px solid var(--border);
        border-radius: 15px;
        padding: 27px;
        box-shadow: 0 6px 30px #1a3d6410;
    }

    .panel h2 {
        font-size: 17px;
        margin: 0 0 21px;
        letter-spacing: -.3px;
    }

    .panel h2 .num {
        background: #e7f1ff;
        color: #1a70e7;
        border-radius: 50%;
        padding: 5px 10px;
        margin-right: 6px;
        font-size: 12px;
    }

    .grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 19px;
    }

    .field {
        display: flex;
        flex-direction: column;
        gap: 7px;
        margin-bottom: 18px;
        min-width: 0;
    }

    .field.full {
        grid-column: 1 / -1;
    }

    .field label {
        font-size: 12px;
        font-weight: 700;
        color: #2a3a55;
    }

    .field input,
    .field textarea {
        width: 100%;
        padding: 13px 14px;
        color: var(--text);
        background: #fff;
        border: 1px solid #dae4f0;
        border-radius: 8px;
        font-size: 13px;
        outline: 0;
    }

    .field input:focus,
    .field textarea:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 3px #2477ee14;
    }

    .field textarea {
        resize: vertical;
        min-height: 94px;
    }

    .error {
        font-size: 11px;
        color: #c2363c;
    }

    .banner-error {
        background: #fff1f1;
        border: 1px solid #fac6c6;
        color: #a22b32;
        padding: 13px;
        border-radius: 9px;
        margin-bottom: 20px;
        font-size: 12px;
    }

    .demo {
        display: flex;
        gap: 11px;
        padding: 14px 15px;
        background: #eff6ff;
        border: 1px solid #d8e9ff;
        color: #315d90;
        border-radius: 10px;
        font-size: 12px;
        line-height: 1.5;
        margin-top: 4px;
    }

    .demo strong {
        color: #173b68;
    }

    .order-product {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px 0;
        border-bottom: 1px solid var(--border);
    }

    .product-art {
        width: 64px;
        height: 64px;
        flex: none;
        background: linear-gradient(
            145deg, #e7f0ff, #f8faff
        );
        border-radius: 10px;
        display: grid;
        place-items: center;
        color: #397cd6;
        font-size: 28px;
    }

    .order-product-text {
        flex: 1;
        min-width: 0;
    }

    .order-product-text strong {
        display: block;
        font-size: 12px;
        line-height: 1.4;
    }

    .order-product-text small {
        display: block;
        font-size: 11px;
        color: var(--muted);
        margin-top: 5px;
    }

    .price {
        white-space: nowrap;
        font-weight: 800;
        font-size: 13px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        margin: 17px 0;
        font-size: 13px;
    }

    .summary-row.muted {
        color: var(--muted);
    }

    .summary-total {
        padding-top: 20px;
        border-top: 1px solid var(--border);
        font-size: 18px;
        font-weight: 800;
    }

    .primary {
        background: var(--blue);
        border: 0;
        border-radius: 9px;
        color: #fff;
        font-size: 13px;
        font-weight: 800;
        display: block;
        text-align: center;
        padding: 15px;
        width: 100%;
        transition: background .2s;
    }

    .primary:hover {
        background: #145dc6;
    }

    .primary:disabled {
        opacity: .65;
        cursor: not-allowed;
    }

    .secondary {
        display: block;
        color: #2870d2;
        text-align: center;
        font-size: 12px;
        font-weight: 650;
        margin-top: 18px;
    }

    .legal {
        color: #8390a4;
        font-size: 11px;
        line-height: 1.5;
        margin: 13px 0 0;
        text-align: center;
    }

    .footer {
        background: #101b31;
        color: #c5d3e5;
        padding: 27px 0;
        font-size: 12px;
    }

    .footer .wrap {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }

    .confirmation {
        text-align: center;
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 40px 36px;
        margin: 15px 0 70px;
    }

    .checkmark {
        background: #e4f8ec;
        color: #15975b;
        border-radius: 50%;
        width: 74px;
        height: 74px;
        display: grid;
        place-items: center;
        margin: 0 auto 20px;
        font-size: 37px;
    }

    .confirm-number {
        display: inline-block;
        background: #f1f6ff;
        color: #226acf;
        border-radius: 9px;
        padding: 12px 18px;
        font-size: 13px;
        font-weight: 800;
        letter-spacing: .4px;
        margin: 15px 0 24px;
        overflow-wrap: anywhere;
    }

    .confirm-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        text-align: left;
        margin-top: 18px;
    }

    .confirm-grid > div {
        background: #fafcff;
        border: 1px solid var(--border);
        padding: 17px;
        border-radius: 10px;
        font-size: 13px;
        line-height: 1.8;
        overflow-wrap: anywhere;
    }

    .confirm-grid strong {
        display: block;
        margin-bottom: 5px;
    }

    .confirmation .primary {
        max-width: 260px;
        margin: 28px auto 0;
    }

    @media (max-width: 820px) {
        .layout {
            grid-template-columns: 1fr;
        }

        .nav-links {
            gap: 14px;
        }

        .panel {
            padding: 22px;
        }
    }

    @media (max-width: 520px) {
        .nav-links {
            gap: 12px;
            font-size: 11px;
        }

        .logo {
            font-size: 19px;
        }

        .logo-mark {
            width: 31px;
            height: 34px;
            font-size: 19px;
        }

        .panel {
            padding: 19px;
        }

        .grid,
        .confirm-grid {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .confirmation {
            padding: 28px 18px;
        }

        .confirm-grid {
            gap: 12px;
        }
    }
</style>
