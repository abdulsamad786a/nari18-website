<link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Montserrat:wght@300;400;500;600&display=swap"
    rel="stylesheet" />
<link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    rel="stylesheet" />
<style>
    /* Custom Stitching Section with Red Theme */
    .stitching-section {
        position: relative;
        padding: 96px 24px;
        overflow: hidden;
    }

    .stitching-bg {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, #000000 0%, #1a0000 20%, #330000 40%, #660020 60%, #800020 80%, #800020 100%);
    }

    .stitching-bg::after {
        content: '';
        position: absolute;
        inset: 0;
        opacity: 0.1;
        mix-blend-mode: overlay;
        background-image: url('https://www.transparenttextures.com/patterns/natural-paper.png');
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
        font-size: 2.25rem;
        font-weight: 300;
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

    @media (min-width: 768px) {
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
        .stitching-title {
            font-size: 3.75rem;
        }
    }

    @media (max-width: 767px) {
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
    }
</style>

<section class="stitching-section">
    <div class="stitching-bg"></div>
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