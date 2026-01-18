<?php include 'header.php' ?>

<!-- Tailwind CSS and Custom Styles for Contact Page -->
<link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Montserrat:wght@100..900&display=swap"
    rel="stylesheet" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    rel="stylesheet">
<script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
<script>
    // Ensure Material Symbols font loads
    (function () {
        var link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200';
        document.head.appendChild(link);

        // Wait for font to load
        document.fonts.ready.then(function () {
            // Force reflow to ensure icons render
            var icons = document.querySelectorAll('.material-symbols-outlined');
            icons.forEach(function (icon) {
                icon.style.display = 'inline-block';
            });
        });
    })();
</script>
<script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    primary: "#800020", // Deep Maroon
                    secondary: "#D4AF37", // Gold
                    "background-light": "#FDFCF8", // Soft Cream
                    "background-dark": "#121212",
                },
                fontFamily: {
                    display: ["'Playfair Display'", "serif"],
                    body: ["'Montserrat'", "sans-serif"],
                },
                borderRadius: {
                    DEFAULT: "0px", // Sharp, premium boutique look
                    'lg': "4px",
                },
            },
        },
    };
</script>
<style>
    body {
        font-family: 'Montserrat', sans-serif;
    }

    .font-serif {
        font-family: 'Playfair Display', serif;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .dark .glass-card {
        background: rgba(30, 30, 30, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Override existing styles for contact page */
    #page-content {
        background: #FDFCF8;
    }

    .dark #page-content {
        background: #121212;
    }

    /* Fix Material Symbols Icons */
    .material-symbols-outlined {
        font-family: 'Material Symbols Outlined' !important;
        font-weight: normal !important;
        font-style: normal !important;
        font-size: 24px !important;
        line-height: 1 !important;
        letter-spacing: normal !important;
        text-transform: none !important;
        display: inline-block !important;
        white-space: nowrap !important;
        word-wrap: normal !important;
        direction: ltr !important;
        -webkit-font-feature-settings: 'liga' !important;
        -webkit-font-smoothing: antialiased !important;
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24 !important;
        speak: none !important;
        font-variant: normal !important;
        text-rendering: auto !important;
    }

    /* Force icon display */
    span.material-symbols-outlined {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    /* Fix input fields - ensure transparent background and visible text */
    #contact-form input[type="text"],
    #contact-form input[type="email"],
    #contact-form input[type="tel"],
    #contact-form textarea {
        background-color: transparent !important;
        background: transparent !important;
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        appearance: none !important;
        color: #1f2937 !important;
        /* Dark gray text for visibility */
        caret-color: #800020 !important;
        /* Maroon cursor color */
    }

    #contact-form input[type="text"]:focus,
    #contact-form input[type="email"]:focus,
    #contact-form input[type="tel"]:focus,
    #contact-form textarea:focus {
        background-color: transparent !important;
        background: transparent !important;
        outline: none !important;
        box-shadow: none !important;
        border-bottom-color: #800020 !important;
        /* Primary color on focus */
        border-bottom-width: 2px !important;
        /* Thicker border on focus */
        color: #1f2937 !important;
        /* Ensure text stays dark */
        caret-color: #800020 !important;
        /* Visible cursor */
    }

    /* Ensure placeholder text is visible */
    #contact-form input::placeholder,
    #contact-form textarea::placeholder {
        color: rgba(107, 114, 128, 0.6) !important;
        opacity: 0.7 !important;
    }

    /* Ensure border is always visible - override Tailwind */
    #contact-form input[type="text"],
    #contact-form input[type="email"],
    #contact-form input[type="tel"],
    #contact-form textarea {
        border: none !important;
        border-bottom: 1px solid #d1d5db !important;
        /* Light gray border */
        border-radius: 0 !important;
    }

    #contact-form input[type="text"]:focus,
    #contact-form input[type="email"]:focus,
    #contact-form input[type="tel"]:focus,
    #contact-form textarea:focus {
        border: none !important;
        border-bottom: 2px solid #800020 !important;
        /* Primary color on focus - thicker */
        border-radius: 0 !important;
        outline: none !important;
        box-shadow: none !important;
    }

    /* Ensure text and cursor are visible */
    #contact-form input[type="text"],
    #contact-form input[type="email"],
    #contact-form input[type="tel"],
    #contact-form textarea {
        -webkit-text-fill-color: #1f2937 !important;
        /* Override autofill */
    }

    #contact-form input[type="text"]:focus,
    #contact-form input[type="email"]:focus,
    #contact-form input[type="tel"]:focus,
    #contact-form textarea:focus {
        -webkit-text-fill-color: #1f2937 !important;
        /* Override autofill */
    }

    /* Remove background overlay from breadcrumb CONTACT US */
    .flex.items-center.justify-center span.text-primary {
        background: none !important;
        background-color: transparent !important;
        padding: 0 !important;
        color: #800020 !important;
    }

    /* Make button text and icon yellow/gold on hover - HIGH PRIORITY */
    #send-message-btn:hover,
    #send-message-btn:hover .button-text,
    #send-message-btn:hover span.material-symbols-outlined {
        color: #D4AF37 !important;
        /* Gold/Secondary color */
    }

    /* Make Get Directions link yellow/gold on hover */
    #get-directions-link:hover,
    #get-directions-link:hover .link-text {
        color: #D4AF37 !important;
        /* Gold/Secondary color */
        border-bottom-color: #D4AF37 !important;
    }
</style>

<!-- Body Container -->
<div id="page-content"
    class="bg-background-light dark:bg-background-dark text-gray-800 dark:text-gray-200 transition-colors duration-300">
    <!--Page Header-->
    <section class="py-16 md:py-24 text-center">
        <h1 class="text-4xl md:text-5xl font-serif tracking-tight mb-4">CONTACT US</h1>
        <div class="flex items-center justify-center space-x-2 text-[10px] tracking-widest uppercase opacity-60">
            <a href="index.php">HOME</a>
            <span>/</span>
            <span class="text-primary font-bold"
                style="background: none !important; padding: 0 !important; color: #800020 !important;">CONTACT US</span>
        </div>
    </section>

    <!--Main Content-->
    <main class="container mx-auto px-6 pb-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
            <div class="lg:col-span-7">
                <div class="text-center mb-12">
                    <h2 class="text-2xl md:text-3xl font-serif italic mb-6">From My Heart to Yours</h2>
                    <p class="text-sm leading-relaxed max-w-xl mx-auto opacity-70">
                        Every outfit at Nari18 is crafted with love, care and the belief that every woman deserves to
                        feel beautiful in her own way. Here, you don't just wear Nari18 — you live it.
                    </p>
                </div>
                <form action="php/ajax_sendmail.php" name="contactus" method="post" id="contact-form" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label
                                class="block text-[10px] uppercase tracking-widest font-bold mb-2 opacity-60">Name</label>
                            <input type="text" id="ContactFormName" name="name"
                                class="w-full bg-transparent border-b border-gray-300 dark:border-gray-700 focus:ring-0 focus:border-primary px-0 py-3 text-sm transition-all text-gray-800"
                                placeholder="Enter your name"
                                style="background-color: transparent !important; background: transparent !important; color: #1f2937 !important; caret-color: #800020 !important; border-top: none !important; border-left: none !important; border-right: none !important;" />
                            <span class="error_msg text-xs text-red-500 mt-1 block" id="name_error"></span>
                        </div>
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest font-bold mb-2 opacity-60">Email
                                Address</label>
                            <input type="email" id="ContactFormEmail" name="email"
                                class="w-full bg-transparent border-b border-gray-300 dark:border-gray-700 focus:ring-0 focus:border-primary px-0 py-3 text-sm transition-all text-gray-800"
                                placeholder="Enter your email"
                                style="background-color: transparent !important; background: transparent !important; color: #1f2937 !important; caret-color: #800020 !important; border-top: none !important; border-left: none !important; border-right: none !important;" />
                            <span class="error_msg text-xs text-red-500 mt-1 block" id="email_error"></span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] uppercase tracking-widest font-bold mb-2 opacity-60">Phone
                            Number</label>
                        <input
                            class="w-full bg-transparent border-b border-gray-300 dark:border-gray-700 focus:ring-0 focus:border-primary px-0 py-3 text-sm transition-all text-gray-800"
                            type="tel" id="ContactFormPhone" name="phone" pattern="[0-9\-]*"
                            placeholder="Enter phone number"
                            style="background-color: transparent !important; background: transparent !important; color: #1f2937 !important; caret-color: #800020 !important; border-top: none !important; border-left: none !important; border-right: none !important;" />
                    </div>
                    <div>
                        <label class="block text-[10px] uppercase tracking-widest font-bold mb-2 opacity-60">Your
                            Message</label>
                        <textarea id="ContactFormMessage" name="message"
                            class="w-full bg-transparent border-b border-gray-300 dark:border-gray-700 focus:ring-0 focus:border-primary px-0 py-3 text-sm transition-all resize-none text-gray-800"
                            placeholder="How can we help you?" rows="4"
                            style="background-color: transparent !important; background: transparent !important; color: #1f2937 !important; caret-color: #800020 !important; border-top: none !important; border-left: none !important; border-right: none !important;"></textarea>
                        <span class="error_msg text-xs text-red-500 mt-1 block" id="message_error"></span>
                    </div>
                    <div class="pt-4">
                        <div class="form-group mailsendbtn mb-0 w-100">
                            <button
                                class="bg-primary hover:bg-black px-10 py-4 text-[10px] tracking-[0.3em] font-bold uppercase transition-all duration-300 border border-primary hover:border-black group flex items-center"
                                type="submit" name="contactus" id="send-message-btn">
                                <span class="button-text" style="color: white;">Send Message</span>
                                <span
                                    class="material-symbols-outlined ml-2 text-sm group-hover:translate-x-1 transition-transform"
                                    style="font-size: 18px; color: white;">arrow_right_alt</span>
                            </button>
                            <div class="loading inline-block ml-4"><img class="img-fluid"
                                    src="assets/images/icons/ajax-loader.gif" alt="loading" width="16" height="16">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="response-msg mt-4 text-sm"></div>
            </div>
            <div class="lg:col-span-5">
                <div
                    class="glass-card p-10 shadow-2xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-800">
                    <h3 class="text-2xl font-serif mb-8 border-b border-gray-100 dark:border-gray-800 pb-4">Visit Us
                    </h3>
                    <p class="text-sm italic opacity-70 mb-10 leading-relaxed">
                        Our studio is not just a space—it's a little corner where dreams meet design. Step in, feel the
                        fabrics, and let's style your story together.
                    </p>
                    <div class="space-y-8">
                        <div class="flex items-start space-x-4">
                            <span class="material-symbols-outlined" style="font-size: 24px;">location_on</span>
                            <div>
                                <h4 class="text-[10px] uppercase tracking-widest font-bold mb-1">Address</h4>
                                <p class="text-sm opacity-70 leading-relaxed">Shop no 119-120, First Floor, SS Omnia,
                                    Sector 86, Gurugram, Haryana 122004</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <span class="material-symbols-outlined" style="font-size: 24px;">call</span>
                            <div>
                                <h4 class="text-[10px] uppercase tracking-widest font-bold mb-1">Phone</h4>
                                <p class="text-sm opacity-70"><a href="tel:+91-8828448755"
                                        class="hover:text-primary transition-colors">+91-8828448755</a></p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <span class="material-symbols-outlined" style="font-size: 24px;">mail</span>
                            <div>
                                <h4 class="text-[10px] uppercase tracking-widest font-bold mb-1">Email</h4>
                                <p class="text-sm opacity-70">
                                    <a href="mailto:info@nari18.com"
                                        class="hover:text-primary transition-colors">info@nari18.com</a><br />
                                    <a href="mailto:richa@nari18.com"
                                        class="hover:text-primary transition-colors">richa@nari18.com</a>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-4">
                            <span class="material-symbols-outlined" style="font-size: 24px;">schedule</span>
                            <div>
                                <h4 class="text-[10px] uppercase tracking-widest font-bold mb-1">Opening Hours</h4>
                                <p class="text-sm opacity-70">Mon - Sat : 9:30 AM - 6:30 PM<br />Sunday: Closed</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-12 pt-8 border-t border-gray-100 dark:border-gray-800">
                        <h4 class="text-[10px] uppercase tracking-widest font-bold mb-4">Stay Connected</h4>
                        <div class="flex space-x-4">
                            <a class="w-10 h-10 flex items-center justify-center border border-gray-200 dark:border-gray-700 transition-all"
                                href="https://www.instagram.com/richa_nari18?igsh=cGt3dDU2MGVheHZs&utm_source=qr"
                                target="_blank" title="Instagram">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.07 1.645.07 4.849 0 3.205-.015 3.584-.07 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.07 4.849-.07zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </a>
                            <a class="w-10 h-10 flex items-center justify-center border border-gray-200 dark:border-gray-700 transition-all"
                                href="https://www.facebook.com/share/17CuUJyWF9/" target="_blank" title="Facebook">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Contact Map -->
    <section
        class="w-full h-[500px] relative bg-gray-200 overflow-hidden grayscale contrast-[1.2] hover:grayscale-0 transition-all duration-700">
        <img alt="Map background" class="w-full h-full object-cover opacity-50 dark:opacity-30"
            src="https://lh3.googleusercontent.com/aida-public/AB6AXuButBvJzU9qPGhybsDckQJIOiAllzlQlLhB_Sz7lLoMn2bzVk7LGWB-inoanzyDmnvqVVlpNTUmv2x5-_bj9L4eYsL934_2aGmAHIVxygVEV2WhtP5Ix0k07D6It7bbT-6DTiVkcTqF3VGLGpe91ayJbqdn85vOs1fnczPlInq2Bej0uhK-BNo2Dkiusz67pWEJqdWkOwhpnXoLE2p3HYI4vl-MfKJzYh8jjPbSux4I9vh_mWC9ul_l5gvYA_CtEkgGA1K8hGnsaTc" />
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
            <div
                class="bg-white dark:bg-gray-900 px-6 py-4 shadow-xl border border-primary/20 pointer-events-auto flex flex-col items-center">
                <span class="material-symbols-outlined text-4xl mb-2" style="font-size: 48px;">location_on</span>
                <p class="font-serif text-sm tracking-widest uppercase">Nari18 Studio</p>
                <a class="text-[10px] font-bold mt-2 uppercase tracking-[0.2em] border-b border-primary pb-0.5 transition-all"
                    href="https://maps.app.goo.gl/gZq1RZfPYDikAFe88" target="_blank" id="get-directions-link"
                    style="color: #800020;">
                    <span class="link-text">Get Directions</span>
                </a>
            </div>
        </div>
        <div class="absolute inset-0 z-[-1] opacity-0">
            <iframe allowfullscreen="" height="100%" loading="lazy"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3509.288282367807!2d76.9749179!3d28.3803831!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d3d57f920f0bb%3A0xe54d6f83060f69a5!2sNari18!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin"
                style="border:0;" width="100%"></iframe>
        </div>
    </section>
</div>
<!-- End Body Container -->

<!-- Contact Form JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('contact-form');
        const submitBtn = document.getElementById('send-message-btn');
        const responseDiv = document.querySelector('.response-msg');
        const loading = document.querySelector('.loading');

        // Hide loading initially
        if (loading) loading.style.display = 'none';

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // Clear previous errors
            document.querySelectorAll('.error_msg').forEach(el => el.textContent = '');

            // Show loading
            if (loading) loading.style.display = 'inline-block';
            submitBtn.disabled = true;

            // Get form data
            const formData = new FormData(form);

            // Send AJAX request
            fetch('php/ajax_sendmail.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    // Hide loading
                    if (loading) loading.style.display = 'none';
                    submitBtn.disabled = false;

                    if (data.success) {
                        // Success - show success message
                        responseDiv.innerHTML = '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert"><strong>Success!</strong> ' + data.message + '</div>';
                        form.reset();
                    } else {
                        // Error - show errors
                        if (data.errors) {
                            for (const [field, message] of Object.entries(data.errors)) {
                                const errorEl = document.getElementById(field + '_error');
                                if (errorEl) errorEl.textContent = message;
                            }
                        }
                        if (data.message) {
                            responseDiv.innerHTML = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"><strong>Error:</strong> ' + data.message + '</div>';
                        }
                    }
                })
                .catch(error => {
                    // Hide loading
                    if (loading) loading.style.display = 'none';
                    submitBtn.disabled = false;
                    responseDiv.innerHTML = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"><strong>Error:</strong> Something went wrong. Please try again or email us directly at richa@nari18.com</div>';
                    console.error('Error:', error);
                });
        });
    });
</script>

<?php include 'footer.php'; ?>