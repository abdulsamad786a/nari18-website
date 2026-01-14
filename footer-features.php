<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    /* Features Section Styles */
    .footer-features {
        padding: 60px 0;
        background: #ECE9E2;
        position: relative;
        z-index: 1;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 15px;
        transition: all 0.3s ease;
    }

    .feature-item:hover {
        transform: translateY(-3px);
    }

    .footer_icons {
        background: transparent;
        width: 70px;
        height: 70px;
        min-width: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px dashed #d0d0d0;
        color: #000000;
        flex-shrink: 0;
        transition: all 0.3s ease;
    }

    .feature-item:hover .footer_icons {
        border-color: #8b7355;
        background: rgba(139, 115, 85, 0.05);
    }

    .footer_icons i {
        font-size: 1.8rem;
        color: #000000;
        transition: all 0.3s ease;
    }

    /* Paper Plane Animation - Fly */
    .feature-item:hover .fa-paper-plane {
        animation: flyPlane 1s ease-in-out;
    }

    @keyframes flyPlane {
        0% {
            transform: translate(0, 0) rotate(0deg);
        }
        25% {
            transform: translate(8px, -8px) rotate(15deg);
        }
        50% {
            transform: translate(12px, -12px) rotate(25deg);
        }
        75% {
            transform: translate(8px, -8px) rotate(15deg);
        }
        100% {
            transform: translate(0, 0) rotate(0deg);
        }
    }

    /* Truck Animation - Drive/Shake */
    .feature-item:hover .fa-truck {
        animation: driveTruck 1s ease-in-out;
    }

    @keyframes driveTruck {
        0%, 100% {
            transform: translateX(0) rotate(0deg);
        }
        25% {
            transform: translateX(5px) rotate(-2deg);
        }
        50% {
            transform: translateX(-5px) rotate(2deg);
        }
        75% {
            transform: translateX(3px) rotate(-1deg);
        }
    }

    /* Lock Animation - Secure/Shake */
    .feature-item:hover .fa-lock {
        animation: secureLock 1s ease-in-out;
    }

    @keyframes secureLock {
        0%, 100% {
            transform: translateY(0) scale(1);
        }
        25% {
            transform: translateY(-5px) scale(1.1);
        }
        50% {
            transform: translateY(0) scale(1);
        }
        75% {
            transform: translateY(-3px) scale(1.05);
        }
    }

    /* Headset Animation - Pulse/Bounce */
    .feature-item:hover .fa-headset {
        animation: pulseHeadset 1s ease-in-out;
    }

    @keyframes pulseHeadset {
        0%, 100% {
            transform: scale(1);
        }
        25% {
            transform: scale(1.15);
        }
        50% {
            transform: scale(1.1);
        }
        75% {
            transform: scale(1.12);
        }
    }

    .feature-content {
        flex: 1;
    }

    .feature-content h5 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #000000;
        margin: 0;
        margin-bottom: 4px;
        line-height: 1.3;
    }

    .feature-content p {
        color: #666666;
        font-size: 0.9rem;
        margin: 0;
        font-weight: 400;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .footer-features {
            padding: 50px 0;
        }

        .footer_icons {
            width: 60px;
            height: 60px;
            min-width: 60px;
        }

        .footer_icons i {
            font-size: 1.5rem;
        }

        .feature-content h5 {
            font-size: 1rem;
        }
    }

    @media (max-width: 768px) {
        .footer-features {
            padding: 40px 0;
        }

        .feature-item {
            flex-direction: column;
            text-align: center;
            gap: 15px;
        }

        .footer_icons {
            width: 65px;
            height: 65px;
            min-width: 65px;
        }

        .footer_icons i {
            font-size: 1.6rem;
        }

        .feature-content h5 {
            font-size: 0.95rem;
        }
    }

    @media (max-width: 576px) {
        .footer_icons {
            width: 60px;
            height: 60px;
            min-width: 60px;
        }

        .footer_icons i {
            font-size: 1.4rem;
        }

        .feature-content h5 {
            font-size: 0.9rem;
        }
    }
</style>
<!-- Features Section -->
<div class="footer-features">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="feature-item">
                    <div class="footer_icons">
                        <i class="fa fa-paper-plane"></i>
                    </div>
                    <div class="feature-content">
                        <h5>No Return & Exchange</h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="feature-item">
                    <div class="footer_icons">
                        <i class="fa fa-truck"></i>
                    </div>
                    <div class="feature-content">
                        <h5>Free Shipping</h5>
                        <p>Free Shipping</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <div class="feature-item">
                    <div class="footer_icons">
                        <i class="fa fa-lock"></i>
                    </div>
                    <div class="feature-content">
                        <h5>100% Secure Payment</h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="feature-item">
                    <div class="footer_icons">
                        <i class="fa fa-headset"></i>
                    </div>
                    <div class="feature-content">
                        <h5>24/7 Customers Support</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
