<!-- Ensure Font Awesome, Material Symbols, and Google Fonts are loaded for footer icons -->
<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    rel="stylesheet">
<link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Montserrat:wght@300;400;500;600&display=swap"
    rel="stylesheet" />
<script>
    // Fallback: Ensure icons load even if CDN links fail
    (function () {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', ensureIconsLoaded);
        } else {
            ensureIconsLoaded();
        }

        function ensureIconsLoaded() {
            // Check if Font Awesome icons are rendering
            setTimeout(function () {
                var faIcons = document.querySelectorAll('.fab.fa-cc-visa, .fab.fa-cc-mastercard');
                if (faIcons.length > 0) {
                    faIcons.forEach(function (icon) {
                        var computedStyle = window.getComputedStyle(icon, ':before');
                        if (!computedStyle.content || computedStyle.content === 'none' || computedStyle.content === '""') {
                            // Icon not loading, try to reload Font Awesome
                            var head = document.head || document.getElementsByTagName('head')[0];
                            var faLink = document.createElement('link');
                            faLink.rel = 'stylesheet';
                            faLink.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css';
                            faLink.crossOrigin = 'anonymous';
                            head.appendChild(faLink);
                        }
                    });
                }

                // Check if Material Symbols are rendering
                var msIcons = document.querySelectorAll('.material-symbols-outlined');
                if (msIcons.length > 0) {
                    msIcons.forEach(function (icon) {
                        var computedStyle = window.getComputedStyle(icon);
                        if (computedStyle.fontFamily.indexOf('Material Symbols') === -1) {
                            // Font not loaded, try to reload
                            var head = document.head || document.getElementsByTagName('head')[0];
                            var msLink = document.createElement('link');
                            msLink.rel = 'stylesheet';
                            msLink.href = 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200';
                            head.appendChild(msLink);
                        }
                    });
                }
            }, 500);
        }
    })();
</script>
<style>
    /* Premium Footer Design with Black to Red Gradient */
    .footer {
        background: linear-gradient(135deg, #000000 0%, #1a0000 20%, #330000 40%, #660020 60%, #800020 80%, #800020 100%);
        color: rgba(255, 255, 255, 0.9);
        font-family: 'Montserrat', sans-serif;
        position: relative;
        overflow: hidden;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .footer::after {
        content: '';
        position: absolute;
        inset: 0;
        opacity: 0.1;
        mix-blend-mode: overlay;
        background-image: url('https://www.transparenttextures.com/patterns/natural-paper.png');
        pointer-events: none;
        z-index: 1;
    }

    /* Custom Stitching Section - Merged with Footer */
    .stitching-section {
        position: relative;
        padding: 96px 24px;
        overflow: hidden;
        background: transparent;
        z-index: 2;
    }

    .stitching-container {
        position: relative;
        max-width: 56rem;
        margin: 0 auto;
        text-align: center;
        z-index: 10;
    }

    .stitching-icon {
        margin-bottom: 2rem;
        display: flex;
        justify-content: center;
    }

    .stitching-icon span {
        color: rgba(255, 255, 255, 0.4);
        font-size: 48px !important;
        font-weight: 300;
        font-family: 'Material Symbols Outlined' !important;
        font-weight: normal !important;
        font-style: normal !important;
        display: inline-block !important;
        line-height: 1 !important;
        text-transform: none !important;
        letter-spacing: normal !important;
        word-wrap: normal !important;
        white-space: nowrap !important;
        direction: ltr !important;
        -webkit-font-feature-settings: 'liga' !important;
        -webkit-font-smoothing: antialiased !important;
    }

    .stitching-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.25rem;
        font-weight: 500;
        color: #ffffff;
        margin-bottom: 1.5rem;
        line-height: 1.25;
    }

    .stitching-title .italic {
        font-style: italic;
    }

    .stitching-content {
        max-width: 42rem;
        margin: 0 auto;
    }

    .stitching-label {
        font-family: 'Montserrat', sans-serif;
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.8);
        text-transform: uppercase;
        letter-spacing: 0.15em;
        font-weight: 500;
        margin-bottom: 1rem;
        display: block;
    }

    .stitching-description {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.125rem;
        color: rgba(255, 255, 255, 0.7);
        font-weight: 300;
        line-height: 1.625;
        margin-bottom: 0;
    }

    .stitching-button-wrapper {
        margin-top: 3rem;
    }

    .ghost-button {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 2.5rem;
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 9999px;
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        font-size: 0.75rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .ghost-button:hover {
        background-color: white;
        color: #800020;
    }

    .ghost-button svg {
        width: 1rem;
        height: 1rem;
        fill: currentColor;
        transition: transform 0.3s ease;
    }

    .ghost-button:hover svg {
        transform: scale(1.1);
    }

    .stitching-note {
        margin-top: 2rem;
        color: rgba(255, 255, 255, 0.4);
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.2em;
    }

    .stitching-corner {
        position: absolute;
        width: 8rem;
        height: 8rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        pointer-events: none;
        z-index: 5;
    }

    .stitching-corner-bottom-left {
        bottom: 0;
        left: 0;
        border-left: 1px solid rgba(255, 255, 255, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        border-top: none;
        border-right: none;
        margin-left: 2rem;
        margin-bottom: 2rem;
    }

    .stitching-corner-top-right {
        top: 0;
        right: 0;
        border-right: 1px solid rgba(255, 255, 255, 0.1);
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        border-bottom: none;
        border-left: none;
        margin-right: 2rem;
        margin-top: 2rem;
    }

    .footer-content {
        max-width: 1280px;
        margin: 0 auto;
        padding: 80px 24px 40px;
        position: relative;
        z-index: 10;
        background: transparent;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 48px;
        margin-bottom: 80px;
    }

    .footer-brand h2 {
        font-family: 'Montserrat', sans-serif !important;
        font-size: 1.875rem;
        font-weight: 600 !important;
        color: #ffffff;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
        font-variant-numeric: lining-nums !important;
    }

    .footer-brand-subtitle {
        display: block;
        font-family: 'Montserrat', sans-serif;
        font-size: 0.875rem;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        margin-top: 0.25rem;
        color: rgba(255, 255, 255, 0.6);
    }

    .footer-brand p {
        font-size: 0.875rem;
        line-height: 1.75;
        color: rgba(255, 255, 255, 0.7);
        max-width: 320px;
        font-weight: 300;
        margin-top: 1.5rem;
    }

    .footer-social {
        display: flex;
        gap: 1rem;
        margin-top: 0.5rem;
        padding-top: 0.5rem;
    }

    .footer-social a {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .footer-social a:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #C5A059 !important;
    }

    .footer-social svg {
        width: 20px;
        height: 20px;
        fill: currentColor;
    }

    .footer-column h3 {
        color: #ffffff;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        font-size: 0.875rem;
        margin-bottom: 2rem;
        position: relative;
        display: inline-block;
    }

    .footer-column h3::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 32px;
        height: 1px;
        background: rgba(255, 255, 255, 0.6);
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 1rem;
    }

    .footer-links a {
        color: rgba(255, 255, 255, 0.8) !important;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 300;
        transition: all 0.3s ease;
    }

    .footer-column .footer-links a:hover,
    .footer-links a:hover,
    html body .footer .footer-column .footer-links a:hover,
    html body .footer .footer-links a:hover,
    html body .footer .footer-links li a:hover,
    .footer .footer-column .footer-links li a:hover,
    .footer .footer-links li:hover a {
        color: #C5A059 !important;
        text-decoration: none !important;
    }

    .footer-contact-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1.25rem;
        gap: 0.75rem;
    }

    .footer-contact-item .material-symbols-outlined {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1.5rem !important;
        margin-top: 2px;
        transition: transform 0.3s ease;
        font-family: 'Material Symbols Outlined' !important;
        font-weight: normal !important;
        font-style: normal !important;
        display: inline-block !important;
        line-height: 1 !important;
        text-transform: none !important;
        letter-spacing: normal !important;
        word-wrap: normal !important;
        white-space: nowrap !important;
        direction: ltr !important;
        -webkit-font-feature-settings: 'liga' !important;
        -webkit-font-smoothing: antialiased !important;
    }

    .footer-contact-item:hover .material-symbols-outlined {
        transform: scale(1.1);
        color: #C5A059 !important;
    }

    .footer-contact-item span,
    .footer-contact-item a {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.875rem;
        font-weight: 300;
        line-height: 1.75;
        text-decoration: none;
    }

    .footer-contact-item a:hover {
        color: #C5A059 !important;
    }

    .footer-contact-email {
        display: flex;
        flex-direction: column;
    }

    .footer-bottom {
        margin-top: 80px;
        padding-top: 32px;
        border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        align-items: center;
        position: relative;
        z-index: 10;
        background: transparent !important;
    }

    .footer-bottom * {
        color: rgba(255, 255, 255, 0.9) !important;
    }

    .footer-bottom a {
        color: rgba(255, 255, 255, 0.9) !important;
        text-decoration: none !important;
    }

    .footer-bottom a:hover {
        color: #C5A059 !important;
    }

    .footer-copyright {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.9) !important;
        font-weight: 300;
        letter-spacing: 0.05em;
        font-family: 'Montserrat', sans-serif;
        text-align: center;
    }

    .footer-copyright a,
    .footer-copyright span,
    .footer-copyright .brand-name {
        color: rgba(255, 255, 255, 0.9) !important;
        font-weight: 500 !important;
        text-decoration: none;
        font-size: 0.85rem !important;
        font-family: 'Montserrat', sans-serif !important;
        font-style: normal !important;
        font-variant-numeric: lining-nums !important;
        letter-spacing: 0.02em;
    }

    .footer-copyright a:hover {
        color: #C5A059 !important;
    }

    .footer-payment {
        display: flex;
        align-items: center;
        gap: 1rem;
        opacity: 0.9;
        transition: all 0.5s ease;
    }

    .footer-payment:hover {
        opacity: 1;
    }

    .footer-payment i {
        font-size: 2rem;
        color: rgba(255, 255, 255, 0.9) !important;
        background: rgba(255, 255, 255, 0.1);
        padding: 8px 12px;
        border-radius: 4px;
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        width: 50px;
        height: 32px;
        font-family: "Font Awesome 6 Brands", "Font Awesome 6 Free" !important;
        font-weight: 400 !important;
        font-style: normal !important;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .footer-payment i:hover {
        background: rgba(255, 255, 255, 0.2);
        color: #C5A059 !important;
        transform: scale(1.05);
    }

    .footer-payment i.fa-cc-mastercard {
        font-size: 2.2rem;
    }

    .whatsapp-float {
        position: fixed;
        bottom: 32px;
        right: 32px;
        background: #25D366;
        color: white;
        width: 56px;
        height: 56px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        text-decoration: none;
        z-index: 50;
        transition: transform 0.3s ease;
    }

    .whatsapp-float:hover {
        transform: scale(1.1);
        color: white !important;
        background: #25D366 !important;
    }

    .whatsapp-float svg {
        width: 32px;
        height: 32px;
        fill: white !important;
    }

    .whatsapp-float:hover svg {
        fill: white !important;
    }

    /* Scroll to Top Arrow */
    #site-scroll {
        position: fixed;
        bottom: 100px;
        right: 32px;
        width: 56px;
        height: 56px;
        background: rgba(128, 0, 32, 0.9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        cursor: pointer;
        z-index: 49;
        transition: all 0.3s ease;
        border: 2px solid rgba(255, 255, 255, 0.2);
    }

    #site-scroll:hover {
        background: rgba(128, 0, 32, 1);
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
    }

    #site-scroll i {
        color: #ffffff;
        font-size: 24px;
        line-height: 1;
    }

    @media (min-width: 768px) {
        .footer-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 48px;
        }

        .footer-bottom {
            flex-direction: row;
            justify-content: space-between;
            gap: 0;
        }

        .stitching-title {
            font-size: 3rem;
        }

        .stitching-label {
            font-size: 1rem;
        }

        .stitching-description {
            font-size: 1.25rem;
        }

        .stitching-description br {
            display: block;
        }
    }

    @media (min-width: 1024px) {
        .footer-grid {
            grid-template-columns: repeat(4, 1fr);
            gap: 32px;
        }

        .stitching-title {
            font-size: 3.75rem;
        }
    }

    @media (max-width: 767px) {
        .footer-content {
            padding: 60px 16px 32px;
        }

        .footer-grid {
            gap: 40px;
            margin-bottom: 60px;
        }

        .footer-bottom {
            margin-top: 60px;
            text-align: center;
        }

        .stitching-section {
            padding: 64px 16px;
        }

        .stitching-title {
            font-size: 1.875rem;
        }

        .ghost-button {
            padding: 0.75rem 1.5rem;
        }

        .stitching-corner-bottom-left {
            margin-left: 1rem;
            margin-bottom: 1rem;
        }

        .stitching-corner-top-right {
            margin-right: 1rem;
            margin-top: 1rem;
        }

        .stitching-description br {
            display: none;
        }

        .whatsapp-float {
            bottom: 20px;
            right: 20px;
            width: 56px;
            height: 56px;
        }

        #site-scroll {
            bottom: 105px !important;
            right: 20px;
            width: 56px;
            height: 56px;
        }
    }

    /* FINAL OVERRIDE - Maximum specificity for footer links hover */
    html body .footer .footer-column .footer-links li a:hover,
    html body .footer .footer-column .footer-links a:hover,
    html body .footer .footer-links li a:hover,
    html body .footer .footer-links a:hover,
    html body .footer .footer-column ul.footer-links li a:hover,
    html body .footer .footer-column ul.footer-links a:hover {
        color: #C5A059 !important;
        text-decoration: none !important;
    }

    /* FINAL OVERRIDE - Ensure footer contact icons are correct size on home page */
    html body .footer .footer-contact-item .material-symbols-outlined,
    html body .footer .footer-column .footer-contact-item .material-symbols-outlined,
    .footer .footer-contact-item .material-symbols-outlined,
    .footer .footer-column .footer-contact-item .material-symbols-outlined {
        font-size: 1.5rem !important;
    }

    /* FINAL OVERRIDE - Ensure architecture icon (stitching icon) is same size on all pages as homepage */
    html body .footer .stitching-icon span.material-symbols-outlined,
    html body .footer .stitching-section .stitching-icon span.material-symbols-outlined,
    .footer .stitching-icon span.material-symbols-outlined,
    .footer .stitching-section .stitching-icon span.material-symbols-outlined {
        font-size: 48px !important;
    }

    /* Minicart Continue Shopping Button Hover */
    .minicart-continue-btn:hover .btn-text {
        color: #D4AF37 !important;
    }
</style>
<!--Footer with Stitching Section-->
<footer class="footer">
    <!-- Custom Stitching Section -->
    <section class="stitching-section">
        <div class="stitching-container">
            <div class="stitching-icon">
                <span class="material-symbols-outlined">architecture</span>
            </div>
            <h2 class="stitching-title">
                You Deserve a Perfect Fit
            </h2>
            <div class="stitching-content">
                <p class="stitching-label">
                    Tailoring and customisations available
                </p>
                <p class="stitching-description">
                    Our in-house tailoring team will ensure every piece <br /> fits exactly the way you imagined it.
                </p>
            </div>
            <div class="stitching-button-wrapper">
                <a class="ghost-button" href="https://wa.me/918826446755" target="_blank">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z">
                        </path>
                    </svg>
                    Explore Custom Stitching
                </a>
            </div>
            <div class="stitching-note">
                <p>Consult with our designer on WhatsApp after ordering</p>
            </div>
        </div>
        <div class="stitching-corner stitching-corner-bottom-left"></div>
        <div class="stitching-corner stitching-corner-top-right"></div>
    </section>

    <div class="footer-content">
        <div class="footer-grid">
            <!-- Brand Column -->
            <div class="footer-brand">
                <h2>
                    Nari18 <span class="footer-brand-subtitle">by Richa Singh</span>
                </h2>
                <p>
                    Celebrating the essence of modern Indian womanhood with curated ethnic wear that blends timeless
                    tradition with contemporary elegance.
                </p>
                <div class="footer-social">
                    <a href="https://www.facebook.com/share/17CuUJyWF9/" target="_blank" title="Facebook">
                        <svg fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z">
                            </path>
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/richa_nari18?igsh=cGt3dDU2MGVheHZs&utm_source=qr" target="_blank"
                        title="Instagram">
                        <svg fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Informations Column -->
            <div class="footer-column">
                <h3>Informations</h3>
                <ul class="footer-links">
                    <li><a href="my-account.php">My Account</a></li>
                    <li><a href="login.php">Login / Register</a></li>
                    <li><a href="my-wishlist.php">Wishlist</a></li>
                    <li><a href="my-cart.php">My Cart</a></li>
                </ul>
            </div>

            <!-- Customer Services Column -->
            <div class="footer-column">
                <h3>Customer Services</h3>
                <ul class="footer-links">
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="terms-and-condition.php">Terms & Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Contact Us Column -->
            <div class="footer-column">
                <h3>Contact Us</h3>
                <ul class="footer-links">
                    <li class="footer-contact-item">
                        <span class="material-symbols-outlined">location_on</span>
                        <span>Shop no 119-120, First Floor, SS Omnia, Sector 86, Gurugram, Haryana 122004</span>
                    </li>
                    <li class="footer-contact-item">
                        <span class="material-symbols-outlined">call</span>
                        <a href="tel:8826446755">+91-8826446755</a>
                    </li>
                    <li class="footer-contact-item">
                        <span class="material-symbols-outlined">mail</span>
                        <div class="footer-contact-email">
                            <a href="mailto:info@nari18.com">info@nari18.com</a>
                            <a href="mailto:richa@nari18.com">richa@nari18.com</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="footer-copyright">
                Copyright © 2025 <span class="brand-name">Nari18 by Richa Singh</span>. All Rights Reserved.
            </div>
            <div class="footer-payment">
                <i class="fab fa-cc-visa" title="Visa"></i>
                <i class="fab fa-cc-mastercard" title="Mastercard"></i>
            </div>
        </div>
    </div>
</footer>
<!--End Footer-->

<!-- WhatsApp Floating Icon -->
<a class="whatsapp-float" href="https://wa.me/918826446755" target="_blank" title="WhatsApp">
    <svg viewBox="0 0 24 24">
        <path
            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z">
        </path>
    </svg>
</a>


<!-- Quick View Modal OVERLAY -->
<div id="quickview-overlay" class="qv-overlay">
    <div class="qv-modal">
        <button class="qv-close" onclick="closeQuickView()">
            <span class="material-symbols-outlined">close</span>
        </button>
        <div class="qv-modal-content">
            <div class="qv-grid">
                <!-- Left: Image Section -->
                <div class="qv-image-section">
                    <div class="qv-gallery">
                        <img id="qv-product-image" src="" alt="Product Image">
                        <div class="qv-gallery-nav">
                            <button onclick="changeQvImage(-1)" class="qv-nav-btn prev">
                                <span class="material-symbols-outlined">chevron_left</span>
                            </button>
                            <button onclick="changeQvImage(1)" class="qv-nav-btn next">
                                <span class="material-symbols-outlined">chevron_right</span>
                            </button>
                        </div>
                        <div id="qv-dots" class="qv-dots"></div>
                    </div>
                </div>
                <!-- Right: Content Section -->
                <div class="qv-content-section">
                    <div class="qv-header">
                        <h2 id="qv-product-name" class="qv-title"></h2>
                        <div class="qv-price-container">
                            <span id="qv-product-price" class="qv-price"></span>
                            <span id="qv-product-price-before" class="qv-price-before"></span>
                        </div>
                    </div>


                    <div class="qv-actions">
                        <div class="qv-qty-selector">
                            <button onclick="changeQvQty(-1)">-</button>
                            <input type="text" id="qv-quantity" value="1" readonly>
                            <button onclick="changeQvQty(1)">+</button>
                        </div>
                        <button id="qv-add-btn" class="qv-add-to-cart" onclick="qvAddToCart()">
                            <span>ADD TO CART</span>
                        </button>
                    </div>

                    <div class="qv-meta">
                        <div class="qv-meta-item">
                            <span class="qv-meta-label">ID:</span>
                            <span id="qv-product-sku" class="qv-meta-value"></span>
                        </div>
                        <div class="qv-meta-item">
                            <span class="qv-meta-label">AVAILABILITY:</span>
                            <span id="qv-product-availability" class="qv-meta-value"></span>
                        </div>
                    </div>

                    <div class="qv-footer-links">
                        <a id="qv-view-details" href="#" class="qv-details-link">View details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .qv-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 10000;
        padding: 20px;
    }

    .qv-overlay.show {
        display: flex;
        animation: qvFadeIn 0.3s ease;
    }

    .qv-modal {
        background: #fff;
        width: 100%;
        max-width: 900px;
        position: relative;
        animation: qvZoomIn 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .qv-close {
        position: absolute;
        top: 15px;
        right: 15px;
        background: none;
        border: none;
        cursor: pointer;
        color: #333;
        z-index: 10;
        transition: color 0.3s ease;
    }

    .qv-close:hover {
        color: #800020;
    }

    .qv-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    @media (max-width: 768px) {
        .qv-grid {
            grid-template-columns: 1fr;
        }

        .qv-modal {
            max-height: 90vh;
            overflow-y: auto;
        }
    }

    .qv-image-section {
        background: #F9F7F2;
        display: flex;
        align-items: center;
        justify-content: center;
        aspect-ratio: 4/5;
    }

    .qv-image-section img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .qv-gallery {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .qv-gallery-nav {
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        transform: translateY(-50%);
        display: flex;
        justify-content: space-between;
        padding: 0 10px;
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }

    .qv-gallery:hover .qv-gallery-nav {
        opacity: 1;
    }

    .qv-nav-btn {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.95);
        color: #800020;
        border: 1px solid rgba(128, 0, 32, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        pointer-events: auto;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .qv-nav-btn:hover {
        background: rgba(255, 255, 255, 0.95);
        border-color: #800020;
        color: #800020;
        transform: scale(1.15);
        box-shadow: 0 4px 12px rgba(128, 0, 32, 0.15);
    }

    .qv-dots {
        position: absolute;
        bottom: 15px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 8px;
    }

    .qv-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(0, 0, 0, 0.2);
        cursor: pointer;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .qv-dot.active {
        background: #800020;
        transform: scale(1.2);
    }

    .qv-content-section {
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    @media (max-width: 768px) {
        .qv-content-section {
            padding: 24px;
        }
    }

    .qv-title {
        font-family: 'Playfair Display', serif;
        font-size: 24px;
        font-weight: 600;
        color: #111;
        margin-bottom: 12px;
        line-height: 1.2;
    }

    .qv-price-container {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 24px;
    }

    .qv-price {
        font-size: 20px;
        font-weight: 700;
        color: #800020;
    }

    .qv-price-before {
        font-size: 16px;
        text-decoration: line-through;
        color: #999;
    }


    .qv-actions {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
    }

    .qv-qty-selector {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 4px;
        height: 48px;
    }

    .qv-qty-selector button {
        width: 40px;
        height: 100%;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 18px;
        color: #666;
    }

    .qv-qty-selector input {
        width: 40px;
        text-align: center;
        border: none;
        font-weight: 600;
        outline: none;
        background: transparent;
    }

    .qv-add-to-cart {
        flex: 1;
        background: #800020 !important;
        color: #fff !important;
        border: none;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.1em;
        cursor: pointer;
        transition: all 0.3s ease;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .qv-add-to-cart span {
        transition: all 0.3s ease;
        color: #fff !important;
    }

    .qv-add-to-cart:hover span {
        color: #D4AF37 !important;
    }


    .qv-meta {
        border-top: 1px solid #eee;
        padding-top: 20px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .qv-meta-item {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .qv-meta-label {
        color: #999;
        font-weight: 500;
        width: 100px;
        display: inline-block;
    }

    .qv-meta-value {
        color: #333;
        font-weight: 600;
    }

    .qv-footer-links {
        margin-top: 24px;
    }

    .qv-details-link {
        font-size: 12px;
        color: #666;
        text-decoration: underline;
        text-decoration-thickness: 1px;
        text-underline-offset: 4px;
        transition: color 0.3s ease;
    }

    .qv-details-link:hover {
        color: #800020;
    }

    @keyframes qvFadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes qvZoomIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }
</style>

<script>
    let currentQvProductId = null;
    let qvProductImages = [];
    let currentQvImageIndex = 0;

    function openQuickView(id) {
        // Reset modal data
        document.getElementById('qv-quantity').value = 1;
        currentQvImageIndex = 0;

        // Fetch product info
        fetch('get-product-info.php?id=' + id)
            .then(response => response.json())
            .then(response => {
                if (response.success) {
                    const product = response.data;
                    currentQvProductId = product.id;

                    document.getElementById('qv-product-name').textContent = product.name;
                    document.getElementById('qv-product-price').textContent = 'Rs. ' + parseFloat(product.price).toLocaleString('en-IN') + '.00';
                    if (product.priceBefore > product.price) {
                        document.getElementById('qv-product-price-before').textContent = 'Rs. ' + parseFloat(product.priceBefore).toLocaleString('en-IN') + '.00';
                    } else {
                        document.getElementById('qv-product-price-before').textContent = '';
                    }


                    qvProductImages = product.images || [product.image];
                    updateQvGallery();

                    document.getElementById('qv-product-sku').textContent = 'P-' + product.id;
                    document.getElementById('qv-product-availability').textContent = product.availability;
                    document.getElementById('qv-view-details').href = 'product-details.php?pid=' + product.id;

                    const addBtn = document.getElementById('qv-add-btn');
                    const btnSpan = addBtn.querySelector('span');
                    if (product.availability === 'Out of Stock') {
                        addBtn.disabled = true;
                        btnSpan.textContent = 'OUT OF STOCK';
                        addBtn.style.setProperty('background', '#ccc', 'important');
                        addBtn.style.cursor = 'not-allowed';
                    } else {
                        addBtn.disabled = false;
                        btnSpan.textContent = 'ADD TO CART';
                        addBtn.style.setProperty('background', '#800020', 'important');
                        addBtn.style.cursor = 'pointer';
                    }

                    document.getElementById('quickview-overlay').classList.add('show');
                    document.body.style.overflow = 'hidden';
                }
            })
            .catch(error => console.error('Error fetching product info:', error));
    }

    function updateQvGallery() {
        if (!qvProductImages.length) return;

        const img = document.getElementById('qv-product-image');
        img.src = 'admin/productimages/' + currentQvProductId + '/' + qvProductImages[currentQvImageIndex];

        // Update dots
        const dotsContainer = document.getElementById('qv-dots');
        dotsContainer.innerHTML = '';

        if (qvProductImages.length > 1) {
            qvProductImages.forEach((_, index) => {
                const dot = document.createElement('div');
                dot.className = 'qv-dot' + (index === currentQvImageIndex ? ' active' : '');
                dot.onclick = () => {
                    currentQvImageIndex = index;
                    updateQvGallery();
                };
                dotsContainer.appendChild(dot);
            });
            document.querySelector('.qv-gallery-nav').style.display = 'flex';
        } else {
            document.querySelector('.qv-gallery-nav').style.display = 'none';
        }
    }

    function changeQvImage(direction) {
        currentQvImageIndex += direction;
        if (currentQvImageIndex >= qvProductImages.length) currentQvImageIndex = 0;
        if (currentQvImageIndex < 0) currentQvImageIndex = qvProductImages.length - 1;
        updateQvGallery();
    }

    function closeQuickView() {
        document.getElementById('quickview-overlay').classList.remove('show');
        document.body.style.overflow = '';
    }

    function changeQvQty(delta) {
        const input = document.getElementById('qv-quantity');
        let val = parseInt(input.value) || 1;
        val += delta;
        if (val < 1) val = 1;
        input.value = val;
    }

    function qvAddToCart() {
        if (!currentQvProductId) return;
        const qty = parseInt(document.getElementById('qv-quantity').value) || 1;
        const addBtn = document.getElementById('qv-add-btn');
        const btnSpan = addBtn.querySelector('span');
        const originalText = btnSpan.textContent;

        addBtn.disabled = true;
        btnSpan.textContent = 'ADDING...';

        // Add to cart via existing AJAX logic
        fetch('add-to-cart-ajax.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'id=' + currentQvProductId + '&qty=' + qty
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Update cart count badge
                    const badge = document.getElementById('cart-count-badge');
                    if (badge) badge.textContent = data.count;

                    // Close quick view
                    closeQuickView();

                    // Refresh minicart content and open sidebar
                    const cartDrawerContent = document.getElementById('cart-drawer');
                    if (cartDrawerContent) {
                        fetch('fetch-minicart.php')
                            .then(response => response.text())
                            .then(html => {
                                cartDrawerContent.innerHTML = html;

                                const minicartElement = document.getElementById('minicart-drawer');
                                if (minicartElement) {
                                    const bsOffcanvas = bootstrap.Offcanvas.getInstance(minicartElement) || new bootstrap.Offcanvas(minicartElement);
                                    bsOffcanvas.show();
                                }
                            });
                    }
                } else {
                    alert('Error adding to cart: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error adding to cart:', error);
            })
            .finally(() => {
                addBtn.disabled = false;
                btnSpan.textContent = originalText;
            });
    }

    // Close on overlay click
    document.getElementById('quickview-overlay').addEventListener('click', function (e) {
        if (e.target === this) {
            closeQuickView();
        }
    });

    // Handle Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeQuickView();
        }
    });
</script>

<!--Scoll Top-->
<div id="site-scroll"><i class="icon anm anm-arw-up"></i></div>
<!--End Scoll Top-->

<!--MiniCart Drawer-->
<div id="minicart-drawer" class="minicart-right-drawer offcanvas offcanvas-end" tabindex="-1">

    <div id="cart-drawer" class="block block-cart">
        <?php include('includes/minicart-content.php'); ?>
    </div>
    <!--MiniCart Content-->
</div>


<!-- Including Jquery/Javascript -->
<!-- Plugins JS -->
<script src="assets/js/plugins.js"></script>
<!-- Main JS -->
<script src="assets/js/main.js"></script>

</div>


<!--End Page Wrapper-->
</body>

</html>