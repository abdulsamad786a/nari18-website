<?php include 'header.php' ?>

<!-- Material Icons - Ensure icons load -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
<link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500&display=swap"
    rel="stylesheet">

<!-- Tailwind CSS CDN -->
<script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
<script>
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    primary: "#800020", // Deep Maroon
                    gold: "#D4AF37",
                    "background-light": "#FAF9F6", // Off-white/Cream
                    "background-dark": "#121212",
                },
                fontFamily: {
                    display: ["'Playfair Display'", "serif"],
                    sans: ["'Inter'", "sans-serif"],
                },
                borderRadius: {
                    DEFAULT: "0.5rem",
                },
            },
        },
    };
</script>

<!-- Body Container -->
<div id="page-content"
    class="bg-background-light dark:bg-background-dark text-slate-800 dark:text-slate-200 font-sans transition-colors duration-300">

    <!-- Hero Section with Image and Vision -->
    <section class="relative py-20 lg:py-32 overflow-hidden bg-pattern">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Image Section - LEFT -->
            <div class="relative order-1 lg:order-1">
                <div
                    class="relative z-10 rounded-2xl overflow-hidden shadow-2xl transform hover:scale-[1.01] transition-transform duration-500">
                    <img alt="Richa Singh, Founder of Nari18" class="w-full h-[600px] object-cover"
                        src="assets/images/about/aboutuss.jpg">
                </div>
                <div class="absolute -top-6 -left-6 w-32 h-32 bg-primary/10 rounded-full -z-0"></div>
                <div class="absolute -bottom-6 -right-6 w-48 h-48 bg-gold/10 rounded-full -z-0"></div>
            </div>

            <!-- Content Section - RIGHT -->
            <div class="order-2 lg:order-2 space-y-8">
                <div>
                    <span
                        class="inline-block px-3 py-1 bg-primary/10 text-primary text-xs font-bold uppercase tracking-widest rounded-full mb-6">Our
                        Vision</span>
                    <h1 class="text-5xl lg:text-7xl font-display leading-[1.1] text-slate-900 dark:text-white">
                        Every Woman Deserves to <span class="feel-special-text"
                            style="color: #800020; background: transparent !important;">Feel Special</span>
                    </h1>
                </div>
                <div class="h-1 w-20 bg-primary"></div>
                <p class="text-lg lg:text-xl text-slate-600 dark:text-slate-400 leading-relaxed font-light">
                    Clothes aren't just fabric. They're emotions, confidence, and self-expression. Nari18 was created
                    with one promise—to give every woman outfits that make her feel unapologetically beautiful,
                    graceful, and powerful, every single day.
                </p>
                <div class="pt-4">
                    <p class="font-display text-xl founder-signature"
                        style="color: #800020; background: transparent !important;">— Richa Singh, Founder</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Brand Story Section -->
    <section class="py-24 bg-white dark:bg-slate-950">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-16 items-start">
                <!-- Left Column - Quote Box -->
                <div class="w-full lg:w-1/3 sticky top-32">
                    <div class="p-12 bg-primary shadow-xl rounded-r-2xl">
                        <span
                            class="material-icons-outlined text-white/40 text-5xl opacity-40 italic block mb-4">format_quote</span>
                        <h2 class="text-3xl lg:text-4xl font-display leading-snug text-white mb-6">
                            "Fashion is not just about clothes, it's about confidence, grace, and identity."
                        </h2>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-[1px] bg-white/50"></div>
                            <span class="text-xs uppercase tracking-[0.2em] font-medium text-white/80">Our Brand
                                Story</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Story Text -->
                <div class="w-full lg:w-2/3 space-y-8">
                    <h3 class="text-3xl font-display text-slate-900 dark:text-white">A Journey of Passion</h3>
                    <div class="prose prose-slate dark:prose-invert prose-lg max-w-none">
                        <p class="drop-cap leading-relaxed text-slate-600 dark:text-slate-400">
                            Every journey begins with a spark—and for Richa, it was her love for fabrics and artistry
                            since childhood. She would experiment with clothes, curate her own designs and was always
                            appreciated for her unique style.
                        </p>
                        <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
                            Life took her into a successful television career, but her heart never stopped whispering of
                            something more. Even then, she spent her free time hosting exhibitions, handpicking suits
                            and sarees that carried her touch. The warmth and encouragement from women at these
                            exhibitions became her true inspiration.
                        </p>
                        <p class="text-slate-600 dark:text-slate-400 leading-relaxed italic">
                            In 2021, that inspiration turned into conviction—and Nari18 was born. A brand built with a
                            simple promise: to bring designer wear within reach of everyday women.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Nari18 Section -->
    <section class="py-24 bg-background-light dark:bg-background-dark border-t border-slate-100 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-4xl lg:text-5xl font-sans text-primary mb-4 why-choose-title"
                style="color: #800020; background: transparent !important;">Why Choose Nari18</h2>
            <div class="w-24 h-1 bg-gold mx-auto mb-8"></div>
            <p
                class="max-w-2xl mx-auto text-slate-500 dark:text-slate-400 mb-16 uppercase tracking-widest text-sm font-medium">
                At Nari18, fashion meets comfort and individuality. Here's why women choose us:
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div
                    class="bg-white dark:bg-slate-900 p-10 rounded-xl border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    <div
                        class="w-20 h-20 bg-primary/5 rounded-full flex items-center justify-center mx-auto mb-8 group-hover:bg-primary transition-colors">
                        <span
                            class="material-icons-outlined text-gold group-hover:text-white text-5xl">auto_awesome</span>
                    </div>
                    <h4 class="text-xl font-display font-bold text-slate-900 dark:text-white mb-4">Designed for Everyday
                        Women</h4>
                    <p class="text-slate-500 dark:text-slate-400 leading-relaxed">
                        Stay stylish through work, family and everything in between. Outfits designed for real-life
                        versatility.
                    </p>
                </div>

                <!-- Card 2 -->
                <div
                    class="bg-white dark:bg-slate-900 p-10 rounded-xl border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    <div
                        class="w-20 h-20 bg-primary/5 rounded-full flex items-center justify-center mx-auto mb-8 group-hover:bg-primary transition-colors">
                        <span class="material-icons-outlined text-gold group-hover:text-white text-5xl">diamond</span>
                    </div>
                    <h4 class="text-xl font-display font-bold text-slate-900 dark:text-white mb-4">Luxury Within Reach
                    </h4>
                    <p class="text-slate-500 dark:text-slate-400 leading-relaxed">
                        Designer-inspired outfits at prices that fit your budget. Premium quality doesn't have to be
                        exclusive.
                    </p>
                </div>

                <!-- Card 3 -->
                <div
                    class="bg-white dark:bg-slate-900 p-10 rounded-xl border border-slate-100 dark:border-slate-800 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    <div
                        class="w-20 h-20 bg-primary/5 rounded-full flex items-center justify-center mx-auto mb-8 group-hover:bg-primary transition-colors">
                        <span
                            class="material-icons-outlined text-gold group-hover:text-white text-5xl">person_search</span>
                    </div>
                    <h4 class="text-xl font-display font-bold text-slate-900 dark:text-white mb-4">Personal Stylist</h4>
                    <p class="text-slate-500 dark:text-slate-400 leading-relaxed">
                        Expert guidance on fabrics, styles and trends that bring out your best self for every occasion.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!--End Main Content-->
</div>
<!-- End Body Container -->

<style>
    .drop-cap::first-letter {
        float: left;
        font-size: 4.5rem;
        line-height: 1;
        padding-top: 4px;
        padding-right: 12px;
        padding-left: 3px;
        font-family: 'Playfair Display', serif;
        color: #800020;
    }

    .bg-pattern {
        background-image: radial-gradient(circle at 2px 2px, rgba(128, 0, 32, 0.05) 1px, transparent 0);
        background-size: 40px 40px;
    }

    /* Ensure Material Icons display correctly */
    .material-icons-outlined {
        font-family: 'Material Icons Outlined', 'Material Icons' !important;
        font-weight: normal !important;
        font-style: normal !important;
        font-size: inherit !important;
        line-height: 1 !important;
        letter-spacing: normal !important;
        text-transform: none !important;
        display: inline-block !important;
        white-space: nowrap !important;
        word-wrap: normal !important;
        direction: ltr !important;
        -webkit-font-feature-settings: 'liga' !important;
        -webkit-font-smoothing: antialiased !important;
        speak: none;
        font-variant: normal;
        text-rendering: optimizeLegibility;
    }

    /* Ensure Feel Special text is simple red text with no background */
    .feel-special-text,
    .feel-special-text::before,
    .feel-special-text::after {
        background: transparent !important;
        background-color: transparent !important;
        background-image: none !important;
        padding: 0 !important;
        margin: 0 !important;
        display: inline !important;
        color: #800020 !important;
        -webkit-text-fill-color: #800020 !important;
        box-shadow: none !important;
        border: none !important;
        outline: none !important;
        content: none !important;
    }

    h1 span.text-primary,
    h1 span.italic {
        background: transparent !important;
        background-color: transparent !important;
    }

    /* Ensure Founder signature is simple red text with no background */
    .founder-signature,
    .founder-signature::before,
    .founder-signature::after {
        background: transparent !important;
        background-color: transparent !important;
        background-image: none !important;
        padding: 0 !important;
        margin: 0 !important;
        color: #800020 !important;
        -webkit-text-fill-color: #800020 !important;
        box-shadow: none !important;
        border: none !important;
        outline: none !important;
        content: none !important;
    }

    /* Ensure Why Choose Nari18 title is simple red text with no background */
    .why-choose-title,
    .why-choose-title::before,
    .why-choose-title::after {
        background: transparent !important;
        background-color: transparent !important;
        background-image: none !important;
        padding: 0 !important;
        margin: 0 !important;
        color: #800020 !important;
        -webkit-text-fill-color: #800020 !important;
        box-shadow: none !important;
        border: none !important;
        outline: none !important;
        content: none !important;
    }
</style>

<?php include 'footer.php'; ?>