<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
<style>
    /* Features Section Styles */
    .footer-features {
        min-height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 80px 0;
        background: #FDFCF8;
    }

    .footer-features-wrapper {
        max-width: 1200px;
        width: 100%;
        margin: 0 auto;
        padding: 0 24px;
    }

    .footer-features-header {
        text-align: center;
        margin-bottom: 96px;
    }

    .footer-features-header p {
        text-transform: uppercase;
        letter-spacing: 0.3em;
        font-size: 10px;
        color: #71717a;
        font-weight: 500;
        margin-bottom: 8px;
        font-family: 'Inter', sans-serif;
    }

    .footer-features-header h1 {
        font-family: 'Playfair Display', serif;
        font-style: italic;
        font-size: 2.5rem;
        color: #18181b;
        margin: 0;
    }

    .footer-features-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0;
    }

    .feature-divider {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 0 32px;
        position: relative;
    }

    .feature-divider:not(:last-child) {
        border-right: 1px solid rgba(0, 0, 0, 0.08);
    }

    .feature-divider .icon-wrapper {
        margin-bottom: 24px;
        transition: transform 0.5s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .feature-divider:hover .icon-wrapper {
        transform: translateY(-4px);
    }

    .feature-divider .icon-wrapper span {
        font-size: 48px;
        color: #a1a1aa;
        display: inline-block;
        width: 48px;
        height: 48px;
    }

    .feature-divider .content {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .feature-divider h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        color: #18181b;
        letter-spacing: 0.025em;
        margin: 0;
    }

    .feature-divider p {
        color: #71717a;
        font-size: 0.875rem;
        line-height: 1.6;
        max-width: 200px;
        margin: 0 auto;
        font-family: 'Inter', sans-serif;
    }

    .footer-features-bottom {
        margin-top: 128px;
        padding-top: 48px;
        border-top: 1px solid #f4f4f5;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .footer-features-bottom .left {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        color: #a1a1aa;
        font-family: 'Inter', sans-serif;
    }

    .footer-features-bottom .right {
        display: flex;
        gap: 32px;
    }

    .footer-features-bottom .right a {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        color: #a1a1aa;
        text-decoration: none;
        transition: color 0.3s ease;
        font-family: 'Inter', sans-serif;
    }

    .footer-features-bottom .right a:hover {
        color: #1a1a1a;
    }

    /* Responsive Design */
    @media (min-width: 768px) {
        .feature-divider {
            align-items: flex-start;
            text-align: left;
        }

        .feature-divider p {
            margin: 0;
        }

        .footer-features-bottom {
            flex-direction: row;
        }
    }

    @media (max-width: 991px) {
        .footer-features-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .feature-divider:nth-child(2) {
            border-right: none;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding-bottom: 48px;
        }

        .feature-divider:nth-child(4) {
            border-right: none;
        }
    }

    @media (max-width: 767px) {
        .footer-features {
            padding: 60px 0;
        }

        .footer-features-header {
            margin-bottom: 64px;
        }

        .footer-features-header h1 {
            font-size: 2rem;
        }

        .footer-features-grid {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .feature-divider {
            padding: 32px 0;
        }

        .feature-divider:not(:last-child) {
            border-right: none;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .footer-features-bottom {
            margin-top: 64px;
            padding-top: 32px;
        }
    }

    .material-symbols-outlined {
        font-family: 'Material Symbols Outlined' !important;
        font-weight: normal !important;
        font-style: normal !important;
        font-size: 48px !important;
        line-height: 1 !important;
        letter-spacing: normal !important;
        text-transform: none !important;
        display: inline-block !important;
        white-space: nowrap !important;
        word-wrap: normal !important;
        direction: ltr !important;
        font-feature-settings: 'liga' !important;
        -webkit-font-feature-settings: 'liga' !important;
        -webkit-font-smoothing: antialiased !important;
        font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24 !important;
        speak: none;
        font-variant: normal;
        text-rendering: optimizeLegibility;
    }
    
    .feature-divider .icon-wrapper span.material-symbols-outlined {
        font-family: 'Material Symbols Outlined' !important;
    }
</style>

<!-- Features Section -->
<div class="footer-features">
    <div class="footer-features-wrapper">
        <div class="footer-features-header">
            <p>Established in India</p>
            <h1>Nari18 by Richa Singh</h1>
        </div>

        <div class="footer-features-grid">
            <div class="feature-divider">
                <div class="icon-wrapper">
                    <span class="material-symbols-outlined">send</span>
                </div>
                <div class="content">
                    <h3>No Return & Exchange</h3>
                    <p>Strict hygiene & customization policies for luxury garments.</p>
                </div>
            </div>

            <div class="feature-divider">
                <div class="icon-wrapper">
                    <span class="material-symbols-outlined">local_shipping</span>
                </div>
                <div class="content">
                    <h3>Complimentary Shipping</h3>
                    <p>On all domestic orders over ₹10,000 within India.</p>
                </div>
            </div>

            <div class="feature-divider">
                <div class="icon-wrapper">
                    <span class="material-symbols-outlined">lock</span>
                </div>
                <div class="content">
                    <h3>100% Secure Payment</h3>
                    <p>Encrypted processing for international & domestic cards.</p>
                </div>
            </div>

            <div class="feature-divider">
                <div class="icon-wrapper">
                    <span class="material-symbols-outlined">support_agent</span>
                </div>
                <div class="content">
                    <h3>24/7 Concierge Support</h3>
                    <p>Dedicated assistance for sizing and styling consultations.</p>
                </div>
            </div>
        </div>

        <div class="footer-features-bottom">
            <div class="left">A Luxury Collective</div>
            <div class="right">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </div>
</div>
