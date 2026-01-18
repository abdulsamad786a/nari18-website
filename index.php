<?php include('header.php'); ?>

<!-- Body Container -->
<div id="page-content" class="mb-0">
    <!--Hero Section-->
    <section class="hero-section">
        <div class="hero-background">
            <picture>
                <source media="(max-width:767px)" srcset="assets/images/slideshow/naribanner_1.png">
                <img class="hero-image" src="assets/images/slideshow/naribanner_1.png"
                    alt="Stunning model in premium ethnic wear" />
            </picture>
            <div class="hero-overlay"></div>
        </div>

        <div class="hero-content">
            <div class="container">
                <div class="hero-text-wrapper">
                    <div class="hero-byline">
                        <span class="byline-text">BY RICHA SINGH</span>
                        <div class="byline-divider"></div>
                    </div>

                    <h1 class="hero-heading">
                        Because every woman deserves to feel <span class="hero-special">special</span> everyday
                    </h1>

                    <p class="hero-description">
                        Curated unstitched luxury that breathes heritage. Discover the art of premium Indian ethnic wear
                        designed for the modern connoisseur.
                    </p>

                    <div class="hero-buttons">
                        <a class="btn-shop-now" href="all-category.php">SHOP NOW</a>
                        <a class="btn-explore" href="all-category.php">EXPLORE LOOKBOOK</a>
                    </div>
                </div>
            </div>
        </div>

        <a href="#page-content" class="hero-scroll-indicator"
            onclick="event.preventDefault(); document.querySelector('#page-content').scrollIntoView({behavior: 'smooth'});">
            <span class="scroll-text">DISCOVER MORE</span>
            <div class="scroll-line">
                <div class="scroll-animation"></div>
            </div>
        </a>
    </section>
    <!--End Hero Section-->

    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500&display=swap"
        rel="stylesheet">
    <style>
        /* Hero Section Styles */
        .hero-section {
            position: relative;
            width: 100%;
            height: 100vh;
            min-height: 600px;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .hero-background {
            position: absolute;
            inset: 0;
            z-index: 0;
        }

        .hero-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.3) 50%, transparent 100%);
            background: rgba(0, 0, 0, 0.2);
        }

        .hero-overlay::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.3) 50%, transparent 100%);
        }

        .hero-content {
            position: relative;
            z-index: 10;
            width: 100%;
            padding: 140px 0 80px;
        }

        .hero-text-wrapper {
            max-width: 800px;
        }

        .hero-byline {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 32px;
            opacity: 0.9;
        }

        .byline-text {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5em;
            text-transform: uppercase;
            color: #ffffff;
            font-family: 'Inter', sans-serif;
        }

        .byline-divider {
            width: 48px;
            height: 1px;
            background: #D4AF37;
        }

        .hero-heading {
            font-size: 48px;
            line-height: 1.1;
            font-weight: 500;
            color: #ffffff;
            margin-bottom: 40px;
            font-family: 'Cormorant Garamond', serif;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .hero-heading .hero-special {
            color: #D4AF37;
            font-family: 'Cormorant Garamond', serif !important;
            font-weight: 500;
            font-style: normal;
        }

        .hero-description {
            font-size: 18px;
            line-height: 1.6;
            color: #f5f5f5;
            font-weight: 300;
            margin-bottom: 48px;
            max-width: 600px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            font-family: 'Inter', sans-serif;
        }

        .hero-buttons {
            display: flex;
            flex-direction: column;
            gap: 24px;
            align-items: flex-start;
        }

        .btn-shop-now,
        .btn-explore {
            display: inline-block;
            padding: 20px 48px;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.3em;
            font-weight: 700;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        .btn-shop-now {
            background: #ffffff;
            color: #000000;
        }

        .btn-shop-now:hover {
            background: #D4AF37;
            color: #ffffff;
        }

        .btn-explore {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }

        .btn-explore:hover {
            background: #ffffff;
            color: #000000;
        }

        .hero-scroll-indicator {
            position: absolute;
            bottom: 48px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 10;
            text-decoration: none;
            cursor: pointer;
            transition: opacity 0.3s ease;
        }

        .hero-scroll-indicator:hover {
            opacity: 0.8;
        }

        .scroll-text {
            font-size: 9px;
            letter-spacing: 0.4em;
            font-weight: 700;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 16px;
            font-family: 'Inter', sans-serif;
        }

        .scroll-line {
            width: 1px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .scroll-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 33.33%;
            background: #D4AF37;
            animation: scroll-down 2s infinite ease-in-out;
        }

        @keyframes scroll-down {
            0% {
                transform: translateY(0);
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                transform: translateY(240px);
                opacity: 0;
            }
        }

        /* Responsive Styles */
        @media (min-width: 768px) {
            .hero-buttons {
                flex-direction: row;
                gap: 32px;
            }

            .hero-heading {
                font-size: 64px;
            }

            .hero-description {
                font-size: 20px;
            }
        }

        @media (min-width: 1024px) {
            .hero-heading {
                font-size: 80px;
            }

            .hero-description {
                font-size: 22px;
            }
        }

        @media (max-width: 767px) {
            .hero-section {
                height: 80vh;
                min-height: 500px;
            }

            .hero-content {
                padding: 100px 16px 60px;
            }

            .hero-heading {
                font-size: 36px;
                margin-bottom: 24px;
            }

            .hero-description {
                font-size: 16px;
                margin-bottom: 32px;
            }

            .btn-shop-now,
            .btn-explore {
                padding: 16px 32px;
                font-size: 10px;
            }
        }
    </style>

    <!--Collection banner-->
    <!-- <section class="section collection-banners pb-0">
                    <div class="container">                      
                        <div class="collection-banner-grid">
                            <div class="row sp-row">
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 collection-banner-item">
                                    <div class="collection-item sp-col">
                                        <a href="all-category.php" class="zoom-scal">
                                            <div class="img">
                                                <img class="blur-up lazyload" data-src="assets/images/collection/demo1-ct-img1.jpg" src="assets/images/collection/demo1-ct-img1.jpg" alt="Women Wear" title="Women Wear" width="645" height="723" />
                                            </div>
                                            <div class="details middle-right">
                                                <div class="inner">
                                                    <p class="mb-2">Trending Now</p>
                                                    <h3 class="title">Women Wear</h3>
                                                    <span class="btn btn-outline-secondary btn-md">Shop Now</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 collection-banner-item">
                                    <div class="collection-item sp-col">
                                        <a href="all-category.php" class="zoom-scal">
                                            <div class="img">
                                                <img class="blur-up lazyload" data-src="assets/images/collection/demo1-ct-img2.jpg" src="assets/images/collection/demo1-ct-img2.jpg" alt="Saree Collections" title="Saree Collections" width="645" height="344" />
                                            </div>
                                            <div class="details middle-left">
                                                <div class="inner">
                                                    <h3 class="title mb-2">Saree Collections</h3>
                                                    <p class="mb-3">Tailor-made with passion</p>
                                                    <span class="btn btn-outline-secondary btn-md">Shop Now</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="collection-item sp-col">
                                        <a href="all-category.php" class="zoom-scal">
                                            <div class="img">
                                                <img class="blur-up lazyload" data-src="assets/images/collection/demo1-ct-img3.jpg" src="assets/images/collection/demo1-ct-img3.jpg" alt="Best Quality" title="Best Quality" width="645" height="349" />
                                            </div>
                                            <div class="details middle-right">
                                                <div class="inner">
                                                    <p class="mb-2">Buy Your best quality</p>
                                                    <h3 class="title">Best Quality</h3>
                                                    <span class="btn btn-outline-secondary btn-md">Shop Now</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> -->
    <!--End Collection banner-->

    <style>
        /* Section Header Styles */
        .section-header-elegant {
            text-align: center;
            margin-bottom: 48px;
        }

        .section-header-elegant h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 500;
            margin-bottom: 16px;
            letter-spacing: -0.02em;
            color: #1a1a1a;
        }

        .section-header-elegant .divider {
            width: 64px;
            height: 1px;
            background: #800020;
            margin: 0 auto 24px;
        }

        .section-header-elegant .description {
            margin-top: 24px;
            color: #666;
            font-size: 1rem;
            font-weight: 300;
            font-style: italic;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }

        @media (min-width: 1024px) {
            .section-header-elegant h2 {
                font-size: 3rem;
            }
        }

        @media (max-width: 768px) {
            .section-header-elegant h2 {
                font-size: 2rem;
            }

            .section-header-elegant {
                margin-bottom: 32px;
            }
        }

        /* Elegant Button Style */
        .btn-elegant {
            display: inline-block;
            padding: 16px 48px;
            border: 1px solid #800020;
            color: #800020;
            background: transparent;
            text-decoration: none;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            font-size: 12px;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        .btn-elegant:hover {
            background: #800020 !important;
            color: #C5A059 !important;
            border-color: #800020 !important;
        }

        html body .btn-elegant:hover,
        body .btn-elegant:hover,
        a.btn-elegant:hover {
            color: #C5A059 !important;
        }

        @media (max-width: 768px) {
            .btn-elegant {
                padding: 14px 36px;
                font-size: 11px;
            }
        }
    </style>

    <section class="section product-slider tab-slider-product">
        <div class="container">
            <div class="tabs-listing">
                <div class="section-header-elegant">
                    <h2>New Arrivals</h2>
                    <div class="divider"></div>
                    <p class="description">Discover our latest collection of handcrafted ethnic masterpieces, curated
                        for the modern woman.</p>
                </div>

                <!-- Start Product Slider -->
                <div class="product-slider-5items gp15 arwOut5 hov-arrow">
                    <!-- Fetch Product Data -->
                    <?php
                    $ret = mysqli_query($con, "select * from products ORDER BY id DESC limit 10");
                    while ($row = mysqli_fetch_array($ret)) {
                        ?>
                            <div class="product-item zoomscal-hov">
                                <div class="product-box-modern">
                                    <!-- Product Image -->
                                    <div class="product-image-modern">
                                        <a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>"
                                            class="product-img-modern">
                                            <img class="blur-up lazyload"
                                                data-src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>"
                                                src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>"
                                                alt="Product" title="<?php echo htmlentities($row['productName']); ?>" />
                                        </a>
                                        <a href="category.php?pid=<?php echo htmlentities($row['id']) ?>&&action=wishlist"
                                            class="btn-wishlist-modern" title="Add to Wishlist">
                                            <i class="icon anm anm-heart-l"></i>
                                        </a>
                                        <button type="button" class="btn-quickview-modern" title="Quick View"
                                            onclick="openQuickView(<?php echo $row['id']; ?>)">
                                            <span class="material-symbols-outlined">visibility</span>
                                        </button>
                                    </div>
                                    <!-- Product Details -->
                                    <div class="product-details-modern">
                                        <div class="product-name-modern">
                                            <a
                                                href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['productName']); ?></a>
                                        </div>
                                        <div class="product-price-modern">
                                            <div class="price-info">
                                                <span class="price-current">₹
                                                    <?php echo htmlentities($row['productPrice']); ?></span>
                                                <?php if ($row['productPriceBeforeDiscount'] > $row['productPrice']) { ?>
                                                        <span class="price-old">₹
                                                            <?php echo htmlentities($row['productPriceBeforeDiscount']); ?></span>
                                                <?php } ?>
                                            </div>
                                            <?php if ($row['productAvailability'] == 'In Stock') { ?>
                                                    <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                        class="btn-cart-modern" title="Add to Cart">
                                                        <i class="icon anm anm-cart-l"></i>
                                                    </a>
                                            <?php } else { ?>
                                                    <a href="" style="cursor: not-allowed;" onclick="event.preventDefault();"
                                                        class="btn-cart-modern disabled" title="Out of Stock">
                                                        <i class="icon anm anm-cart-l"></i>
                                                    </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php } ?>
                </div>
                <!-- End Product Slider -->

            </div>
        </div>
    </section>


    <!--Popular Categories-->
    <!-- <section class="section collection-slider pb-0">
                    <div class="container">
                        <div class="section-header">
                            <p class="mb-2 mt-0">Shop by category</p>
                            <h2>Popular Collections</h2>
                        </div>

                        <div class="collection-slider-5items gp15 arwOut5 hov-arrow">
                            <?php $sql = mysqli_query($con, "select id,categoryName  from category");
                            while ($row = mysqli_fetch_array($sql)) { ?>
                            <div class="category-item zoomscal-hov">
                                <a href="category.php?cid=<?php echo $row['id']; ?>" class="category-link clr-none">
                                    <div class="zoom-scal zoom-scal-nopb rounded-3">
                                        <p class="item_heading"><?php echo $row['categoryName']; ?></p>
                                        <img class="blur-up lazyload" data-src="assets/images/category.png" src="assets/images/category.png" alt="Men's Jakets" title="<?php echo $row['categoryName']; ?>" width="365" height="150" />
                                    </div>
                                    <div class="details mt-3 text-center">
                                        <h4 class="category-title mb-0"><?php echo $row['categoryName']; ?></h4>
                                    </div>
                                </a>
                            </div>

                            <?php } ?> 
                            
                        </div>
                    </div>
                </section> -->
    <!--End Popular Categories-->
    <div class="fabric-marquee">
        <div class="fabric-track">
            <span>SILK</span>
            <span>ORGANZA</span>
            <span>TISSUE</span>
            <span>MUSLINS</span>
            <span>COTTON SUITS</span>
            <span>LINEN SUITS</span>
            <span>GEORGETTE COLLECTION</span>
            <span>CHANDERI COLLECTION</span>
            <span>MUSLIN SUITS</span>
            <span>PARTY WEAR SUITS</span>
            <span>HANDPRINTED SUITS</span>
            <span>COORDS</span>


        </div>
    </div>
    <!--Products With Tabs-->
    <section class="section product-slider tab-slider-product popular-collection">
        <div class="container">

            <div class="tabs-listing">
                <div class="section-header-elegant">
                    <h2>Best Sellers</h2>
                    <div class="divider"></div>
                    <p class="description">Explore our most beloved pieces, handpicked by our discerning clientele for
                        their timeless elegance and exceptional quality.</p>
                </div>

                <div class="tab-content" id="productTabsContent">
                    <div class="tab-pane show active" id="bestsellers" role="tabpanel"
                        aria-labelledby="bestsellers-tab">
                        <!--Product Grid-->
                        <div class="grid-products grid-view-items">
                            <div
                                class="row col-row product-options row-cols-xl-5 row-cols-lg-5 row-cols-md-3 row-cols-sm-3 row-cols-2">

                                <?php
                                $ret = mysqli_query($con, "select * from products ORDER BY id DESC limit 10");
                                while ($row = mysqli_fetch_array($ret)) {
                                    ?>
                                        <div class="item col-item">
                                            <div class="product-box-modern">
                                                <!-- Start Product Image -->
                                                <div class="product-image-modern">
                                                    <a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>"
                                                        class="product-img-modern">
                                                        <img class="blur-up lazyload"
                                                            data-src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>"
                                                            data-echo="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>"
                                                            src="admin/productimages/<?php echo htmlentities($row['id']); ?>/<?php echo htmlentities($row['productImage1']); ?>"
                                                            alt="Product"
                                                            title="<?php echo htmlentities($row['productName']); ?>" />
                                                    </a>
                                                    <a href="category.php?pid=<?php echo htmlentities($row['id']) ?>&&action=wishlist"
                                                        class="btn-wishlist-modern" title="Add to Wishlist">
                                                        <i class="icon anm anm-heart-l"></i>
                                                    </a>
                                                    <button type="button" class="btn-quickview-modern" title="Quick View"
                                                        onclick="openQuickView(<?php echo $row['id']; ?>)">
                                                        <span class="material-symbols-outlined">visibility</span>
                                                    </button>
                                                </div>
                                                <!-- Start Product Details -->
                                                <div class="product-details-modern">
                                                    <!-- Product Name -->
                                                    <div class="product-name-modern">
                                                        <a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['productName']); ?></a>
                                                    </div>
                                                    <!-- End Product Name -->
                                                    <!-- Product Price -->
                                                    <div class="product-price-modern">
                                                        <div class="price-info">
                                                            <span class="price-current">₹
                                                                <?php echo htmlentities($row['productPrice']); ?></span>
                                                            <?php if ($row['productPriceBeforeDiscount'] > $row['productPrice']) { ?>
                                                                    <span class="price-old">₹
                                                                        <?php echo htmlentities($row['productPriceBeforeDiscount']); ?></span>
                                                            <?php } ?>
                                                        </div>
                                                        <?php if ($row['productAvailability'] == 'In Stock') { ?>
                                                                <a href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                                    class="btn-cart-modern" title="Add to Cart">
                                                                    <i class="icon anm anm-cart-l"></i>
                                                                </a>
                                                        <?php } else { ?>
                                                                <a href="" style="cursor: not-allowed;"
                                                                    onclick="event.preventDefault();" class="btn-cart-modern disabled"
                                                                    title="Out of Stock">
                                                                    <i class="icon anm anm-cart-l"></i>
                                                                </a>
                                                        <?php } ?>
                                                    </div>
                                                    <!-- End Product Price -->
                                                </div>
                                                <!-- End product details -->
                                            </div>
                                        </div>
                                <?php } ?>

                            </div>

                            <div class="view-collection text-center mt-4 mt-md-5">
                                <a href="all-category.php" class="btn-elegant">View Collection</a>
                            </div>
                        </div>
                        <!--End Product Grid-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Products With Tabs-->


    <!--Products With Tabs-->
    <!--Products With Tabs-->
    <section class="section product-slider tab-slider-product popular-collection">
        <div class="container">
            <div class="tabs-listing">
                <div class="section-header-elegant">
                    <h2>Shop by Categories</h2>
                    <div class="divider"></div>
                    <p class="description">Browse through our carefully curated collections, each designed to celebrate
                        the rich heritage of Indian craftsmanship.</p>
                </div>

                <div>
                    <div class="tab-pane show active" id="popular" role="tabpanel" aria-labelledby="popular-tab">
                        <!--Product Grid-->
                        <div class="grid-products grid-view-items">
                            <div
                                class="row col-row product-options row-cols-xl-5 row-cols-lg-5 row-cols-md-3 row-cols-sm-3 row-cols-2">

                                <?php
                                $rets = mysqli_query($con, "select * from products ORDER BY id DESC limit 10");
                                while ($rows = mysqli_fetch_array($rets)) {
                                    ?>
                                            <div class="item col-item">
                                                <div class="product-box-modern">
                                                    <div class="product-image-modern">
                                                        <a href="product-details.php?pid=<?php echo htmlentities($rows['id']); ?>"
                                                            class="product-img-modern">
                                                            <img class="blur-up lazyload"
                                                                data-src="admin/productimages/<?php echo htmlentities($rows['id']); ?>/<?php echo htmlentities($rows['productImage1']); ?>"
                                                                src="admin/productimages/<?php echo htmlentities($rows['id']); ?>/<?php echo htmlentities($rows['productImage1']); ?>"
                                                                alt="Product"
                                                                title="<?php echo htmlentities($rows['productName']); ?>" />
                                                        </a>
                                                        <a href="category.php?pid=<?php echo htmlentities($rows['id']) ?>&&action=wishlist"
                                                            class="btn-wishlist-modern" title="Add to Wishlist">
                                                            <i class="icon anm anm-heart-l"></i>
                                                        </a>
                                                        <button type="button" class="btn-quickview-modern" title="Quick View"
                                                            onclick="openQuickView(<?php echo $rows['id']; ?>)">
                                                            <span class="material-symbols-outlined">visibility</span>
                                                        </button>
                                                    </div>
                                                    <div class="product-details-modern">
                                                        <div class="product-name-modern">
                                                            <a
                                                                href="product-details.php?pid=<?php echo htmlentities($rows['id']); ?>"><?php echo htmlentities($rows['productName']); ?></a>
                                                        </div>
                                                        <div class="product-price-modern">
                                                            <div class="price-info">
                                                                <span class="price-current">₹
                                                                    <?php echo htmlentities($rows['productPrice']); ?></span>
                                                                <?php if ($rows['productPriceBeforeDiscount'] > $rows['productPrice']) { ?>
                                                                            <span class="price-old">₹
                                                                                <?php echo htmlentities($rows['productPriceBeforeDiscount']); ?></span>
                                                                <?php } ?>
                                                            </div>
                                                            <?php if ($rows['productAvailability'] == 'In Stock') { ?>
                                                                        <a href="index.php?page=product&action=add&id=<?php echo $rows['id']; ?>"
                                                                            class="btn-cart-modern" title="Add to Cart">
                                                                            <i class="icon anm anm-cart-l"></i>
                                                                        </a>
                                                            <?php } else { ?>
                                                                        <a href="" style="cursor: not-allowed;"
                                                                            onclick="event.preventDefault();" class="btn-cart-modern disabled"
                                                                            title="Out of Stock">
                                                                            <i class="icon anm anm-cart-l"></i>
                                                                        </a>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                <?php } ?>

                            </div>

                            <div class="view-collection text-center mt-4 mt-md-5">
                                <a href="all-category.php" class="btn-elegant">View Collection</a>
                            </div>
                        </div>
                        <!--End Product Grid-->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->


    <section class="section video-slider">
        <div class="container">
            <div class="section-header-elegant">
                <h2>Shop Latest Collection</h2>
                <div class="divider"></div>
                <p class="description">Explore our newest curated pieces, showcasing the finest in contemporary ethnic
                    fashion and timeless elegance.</p>
            </div>
            <div class="grid-videos grid-view-items">
                <div class="row col-row row-cols-xl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2">

                    <!-- Video Item 1 - BLACK CRAPE SUIT SET -->
                    <div class="item col-item">
                        <div class="video-box">
                            <div class="video-wrapper" data-video="assets/1.mp4" data-title="BLACK CRAPE SUIT SET"
                                data-price="Rs. 4,350.00"
                                data-description="Experience the ethereal charm of traditional work on premium crape fabric. A perfect companion for the modern woman who values elegance and sophistication."
                                data-thumbnail="assets/1.mp4" data-product-id="1" data-fabric-top="Premium Black Crape"
                                data-fabric-bottom="Matching Crape Base"
                                data-fabric-dupatta="Crape with Net Fabric accents"
                                data-work="Intricate handcrafted work on shirt daaman"
                                data-work-extra="Hand-finished net fabric detailing on dupatta">
                                <video autoplay loop muted playsinline class="video-player">
                                    <source src="assets/1.mp4" type="video/mp4" />
                                </video>
                            </div>
                        </div>
                    </div>

                    <!-- Video Item 2 - VIBRANT MAGENTA SILK SUIT SET -->
                    <div class="item col-item">
                        <div class="video-box">
                            <div class="video-wrapper" data-video="assets/2.mp4"
                                data-title="VIBRANT MAGENTA SILK SUIT SET" data-price="Rs. 5,200.00"
                                data-description="Discover the vibrant elegance of premium silk with exquisite craftsmanship. A statement piece that celebrates color and tradition."
                                data-thumbnail="assets/2.mp4" data-product-id="2"
                                data-fabric-top="Premium Vibrant Magenta Silk" data-fabric-bottom="Matching Silk Base"
                                data-fabric-dupatta="Silk with Embroidered accents"
                                data-work="Intricate embroidery work on shirt daaman"
                                data-work-extra="Hand-finished detailing on dupatta">
                                <video autoplay loop muted playsinline class="video-player">
                                    <source src="assets/2.mp4" type="video/mp4" />
                                </video>
                            </div>
                        </div>
                    </div>

                    <!-- Video Item 3 - Dusty Rose handcrafted embroidery Imported Silk Suit -->
                    <div class="item col-item">
                        <div class="video-box">
                            <div class="video-wrapper" data-video="assets/3.mp4"
                                data-title="Dusty Rose Handcrafted Embroidery Imported Silk Suit"
                                data-price="Rs. 6,500.00"
                                data-description="Witness the artistry of handcrafted embroidery on imported silk. A timeless piece that showcases traditional craftsmanship at its finest."
                                data-thumbnail="assets/3.mp4" data-product-id="3"
                                data-fabric-top="Imported Dusty Rose Silk" data-fabric-bottom="Matching Silk Base"
                                data-fabric-dupatta="Silk with Handcrafted Embroidery"
                                data-work="Intricate handcrafted embroidery work"
                                data-work-extra="Premium imported silk with traditional motifs">
                                <video autoplay loop muted playsinline class="video-player">
                                    <source src="assets/3.mp4" type="video/mp4" />
                                </video>
                            </div>
                        </div>
                    </div>

                    <!-- Video Item 4 - PREMIUM CHIFFON SUIT SET -->
                    <div class="item col-item">
                        <div class="video-box">
                            <div class="video-wrapper" data-video="assets/4.mp4" data-title="PREMIUM CHIFFON SUIT SET"
                                data-price="Rs. 4,800.00"
                                data-description="Embrace the flow and grace of premium chiffon. A delicate and elegant ensemble perfect for special occasions."
                                data-thumbnail="assets/4.mp4" data-product-id="4" data-fabric-top="Premium Chiffon"
                                data-fabric-bottom="Matching Chiffon Base"
                                data-fabric-dupatta="Chiffon with Embellished accents"
                                data-work="Delicate embellished work on shirt daaman"
                                data-work-extra="Hand-finished chiffon detailing on dupatta">
                                <video autoplay loop muted playsinline class="video-player">
                                    <source src="assets/4.mp4" type="video/mp4" />
                                </video>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Modal for Video Popup -->
    <div id="videoModal" class="video-modal">
        <div class="video-modal-content">
            <button class="video-modal-close-mobile">
                <span class="material-symbols-outlined">close</span>
            </button>

            <div class="video-modal-body">
                <!-- Left: Video -->
                <div class="modal-video-left">
                    <video id="modalVideo" autoplay loop muted playsinline class="modal-video-player">
                        <source src="" type="video/mp4" />
                        Your browser does not support the video tag.
                    </video>
                    <div class="video-overlay">
                        <div class="video-overlay-top">
                            <div class="live-look-badge">
                                <div class="live-dot"></div>
                                <span>LIVE LOOK</span>
                            </div>
                        </div>
                        <div class="video-overlay-bottom">
                            <div class="video-controls">
                                <button class="video-control-btn" id="playPauseBtn">
                                    <span class="material-symbols-outlined">play_circle</span>
                                </button>
                                <button class="video-control-btn" id="volumeBtn">
                                    <span class="material-symbols-outlined">volume_up</span>
                                </button>
                            </div>
                            <div class="video-brand">
                                <p class="brand-name">Nari18</p>
                                <p class="brand-subtitle">by Richa Singh</p>
                            </div>
                        </div>
                    </div>
                    <div class="video-progress">
                        <div class="video-progress-bar"></div>
                    </div>
                </div>

                <!-- Right: Product Info -->
                <div class="modal-video-right">
                    <button class="video-modal-close-desktop">
                        <span class="material-symbols-outlined">close</span>
                    </button>

                    <div class="modal-content-scroll">
                        <div class="product-header">
                            <div class="product-thumbnail">
                                <img id="modalThumbnail" src="" alt="Product Thumbnail" />
                            </div>
                            <div class="product-title-section">
                                <h2 id="modalTitle" class="modal-title"></h2>
                                <p id="modalPrice" class="modal-price"></p>
                            </div>
                        </div>

                        <div class="product-details-section">
                            <p id="modalDescription" class="modal-description"></p>

                            <div class="detail-section">
                                <h3 class="detail-heading">Fabric Details</h3>
                                <ul class="detail-list">
                                    <li>
                                        <span class="detail-bullet">◆</span>
                                        <span><strong>Top:</strong> <span id="fabricTop"></span></span>
                                    </li>
                                    <li>
                                        <span class="detail-bullet">◆</span>
                                        <span><strong>Bottom:</strong> <span id="fabricBottom"></span></span>
                                    </li>
                                    <li>
                                        <span class="detail-bullet">◆</span>
                                        <span><strong>Dupatta:</strong> <span id="fabricDupatta"></span></span>
                                    </li>
                                </ul>
                            </div>

                            <div class="detail-section">
                                <h3 class="detail-heading">Exquisite Work</h3>
                                <ul class="detail-list">
                                    <li>
                                        <span class="detail-bullet">◆</span>
                                        <span id="workDetail"></span>
                                    </li>
                                    <li>
                                        <span class="detail-bullet">◆</span>
                                        <span id="workDetailExtra"></span>
                                    </li>
                                </ul>
                            </div>

                            <div class="detail-section">
                                <h3 class="detail-heading">Inclusions</h3>
                                <p class="inclusions-text">Unstitched Suit Set: Includes Shirt, Bottom & Dupatta fabric.
                                    Design allows for personalized neckline styling.</p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-actions">
                        <a href="#" class="btn-add-to-cart">
                            <span class="btn-text">Add to Cart</span>
                            <i class="icon anm anm-cart-l"></i>
                        </a>
                        <a href="#" class="btn-wishlist">
                            <span class="material-symbols-outlined">favorite</span>
                        </a>
                    </div>
                    <p class="shipping-info">Complimentary shipping on all orders above ₹20,000</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Material Symbols Font Settings */
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
            font-family: 'Material Symbols Outlined';
            font-weight: normal;
            font-style: normal;
            display: inline-block;
            line-height: 1;
            text-transform: none;
            letter-spacing: normal;
            word-wrap: normal;
            white-space: nowrap;
            direction: ltr;
        }

        /* ===== Video Grid ===== */
        .video-slider {
            padding: 80px 0 40px;
        }

        .video-slider .section-header-elegant {
            margin-bottom: 48px;
        }

        .video-wrapper {
            position: relative;
            width: 100%;
            padding-bottom: 140.78%;
            overflow: hidden;
            border-radius: 12px;
            background: #000;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .video-wrapper:hover {
            transform: scale(1.03);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }

        .video-player {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            pointer-events: none;
        }

        /* ===== Modal Styles ===== */
        .video-modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.85);
            justify-content: center;
            align-items: center;
            padding: 20px;
            font-family: 'Inter', sans-serif;
        }

        .video-modal.show {
            display: flex;
        }

        .video-modal-content {
            background: #FDFBF7;
            border-radius: 12px;
            max-width: 1200px;
            width: 100%;
            height: 90vh;
            max-height: 800px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            position: relative;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            animation: zoomIn 0.3s ease;
        }

        .video-modal-body {
            display: flex;
            flex-direction: row;
            flex: 1;
            overflow: hidden;
        }

        /* Left Video Section */
        .modal-video-left {
            position: relative;
            width: 60%;
            background: #000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-video-player {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .video-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 24px;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3) 0%, transparent 30%, transparent 70%, rgba(0, 0, 0, 0.6) 100%);
            pointer-events: none;
        }

        .video-overlay-top {
            display: flex;
            align-items: flex-start;
        }

        .live-look-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #fff;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.2em;
            text-transform: uppercase;
        }

        .live-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #ff0000;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .video-overlay-bottom {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .video-controls {
            display: flex;
            gap: 16px;
        }

        .video-control-btn {
            background: transparent;
            border: none;
            color: #fff;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s;
            pointer-events: auto;
        }

        .video-control-btn:hover {
            transform: scale(1.1);
        }

        .video-control-btn .material-symbols-outlined {
            font-size: 32px;
        }

        .video-brand {
            text-align: right;
        }

        .brand-name {
            color: #D4AF37;
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            font-style: italic;
            margin: 0;
        }

        .brand-subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            margin: 0;
        }

        .video-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: rgba(255, 255, 255, 0.2);
        }

        .video-progress-bar {
            height: 100%;
            background: #D4AF37;
            width: 33.33%;
        }

        /* Right Product Info Section */
        .modal-video-right {
            width: 40%;
            display: flex;
            flex-direction: column;
            background: #FDFBF7;
            border-left: 1px solid rgba(0, 0, 0, 0.1);
        }

        .video-modal-close-desktop {
            display: none;
            position: absolute;
            top: 24px;
            right: 24px;
            background: transparent;
            border: none;
            color: #666;
            cursor: pointer;
            padding: 4px;
            z-index: 10;
            transition: color 0.2s;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .video-modal-close-desktop:hover {
            color: #800020;
        }

        .video-modal-close-desktop .material-symbols-outlined {
            font-size: 20px;
        }

        .video-modal-close-mobile {
            position: absolute;
            top: 16px;
            right: 16px;
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(8px);
            border: none;
            color: #fff;
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content-scroll {
            flex: 1;
            overflow-y: auto;
            padding: 24px 40px;
            -webkit-overflow-scrolling: touch;
        }

        .modal-content-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .modal-content-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .modal-content-scroll::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 3px;
        }

        .product-header {
            display: flex;
            gap: 24px;
            margin-bottom: 32px;
            align-items: flex-start;
        }

        .product-thumbnail {
            width: 96px;
            height: 128px;
            flex-shrink: 0;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .product-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .product-thumbnail:empty::before {
            content: '';
            display: block;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
        }

        .product-title-section {
            flex: 1;
            padding-top: 8px;
            padding-right: 40px;
        }

        .modal-title {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 500;
            color: #1a1a1a;
            margin: 0 0 8px 0;
            line-height: 1.3;
        }

        .modal-price {
            color: #800020;
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }

        .product-details-section {
            margin-bottom: 32px;
        }

        .modal-description {
            font-size: 14px;
            line-height: 1.75;
            color: #666;
            font-style: italic;
            margin-bottom: 32px;
        }

        .detail-section {
            margin-bottom: 24px;
        }

        .detail-heading {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            font-weight: 600;
            color: #999;
            margin: 0 0 12px 0;
            padding-bottom: 8px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .detail-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .detail-list li {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            margin-bottom: 8px;
            color: #333;
            font-size: 14px;
            line-height: 1.6;
        }

        .detail-bullet {
            color: #D4AF37;
            font-size: 12px;
            margin-top: 4px;
            flex-shrink: 0;
        }

        .inclusions-text {
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            font-style: italic;
            margin: 0;
        }

        .modal-actions {
            padding: 24px 40px;
            background: #fff;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .btn-add-to-cart {
            flex: 1;
            background: #800020;
            color: #fff;
            border: none;
            padding: 0 24px;
            height: 56px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.3s, color 0.3s;
            text-decoration: none;
        }

        .btn-add-to-cart i {
            color: #fff;
            transition: color 0.3s ease;
            font-size: 16px;
        }

        /* Fix hover color - Maximum specificity to override red */
        html body .btn-add-to-cart:hover,
        html body a.btn-add-to-cart:hover,
        .modal-actions .btn-add-to-cart:hover,
        .btn-add-to-cart:hover {
            background: #800020 !important;
            color: #C5A059 !important;
        }

        html body .btn-add-to-cart:hover .btn-text,
        html body a.btn-add-to-cart:hover .btn-text,
        .modal-actions .btn-add-to-cart:hover .btn-text,
        .btn-add-to-cart:hover .btn-text {
            color: #C5A059 !important;
        }

        html body .btn-add-to-cart:hover i,
        html body a.btn-add-to-cart:hover i,
        .modal-actions .btn-add-to-cart:hover i,
        .btn-add-to-cart:hover i {
            color: #C5A059 !important;
            transform: translateX(4px);
        }

        .btn-wishlist {
            width: 56px;
            height: 56px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            background: transparent;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.3s, border-color 0.3s;
        }

        .btn-wishlist:hover {
            background: rgba(0, 0, 0, 0.05);
            border-color: rgba(0, 0, 0, 0.3);
        }

        .btn-wishlist .material-symbols-outlined {
            color: #666;
            font-size: 24px;
        }

        .shipping-info {
            text-align: center;
            font-size: 10px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin: 16px 0 0 0;
            padding: 0 40px;
        }

        /* Animation */
        @keyframes zoomIn {
            from {
                transform: scale(0.95);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Responsive */
        @media (min-width: 768px) {
            .video-modal-close-mobile {
                display: none !important;
            }

            .video-modal-close-desktop {
                display: flex !important;
            }
        }

        @media (max-width: 767px) {
            .video-modal-close-desktop {
                display: none !important;
            }

            .video-modal-close-mobile {
                display: flex !important;
            }
        }

        @media (max-width: 767px) {
            .video-modal-content {
                height: 100vh;
                max-height: 100vh;
                border-radius: 0;
            }

            .video-modal-body {
                flex-direction: column;
            }

            .modal-video-left {
                width: 100%;
                height: 50%;
            }

            .modal-video-right {
                width: 100%;
                height: 50%;
            }

            .modal-content-scroll {
                padding: 16px 24px;
            }

            .product-header {
                gap: 16px;
                margin-bottom: 24px;
            }

            .product-thumbnail {
                width: 80px;
                height: 106px;
            }

            .modal-title {
                font-size: 20px;
            }

            .modal-actions {
                padding: 16px 24px;
            }

            .shipping-info {
                padding: 0 24px;
            }
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const videoWrappers = document.querySelectorAll(".video-wrapper");
            const modal = document.getElementById("videoModal");
            const modalVideo = document.getElementById("modalVideo");
            const modalTitle = document.getElementById("modalTitle");
            const modalPrice = document.getElementById("modalPrice");
            const modalDescription = document.getElementById("modalDescription");
            const modalThumbnail = document.getElementById("modalThumbnail");
            const fabricTop = document.getElementById("fabricTop");
            const fabricBottom = document.getElementById("fabricBottom");
            const fabricDupatta = document.getElementById("fabricDupatta");
            const workDetail = document.getElementById("workDetail");
            const workDetailExtra = document.getElementById("workDetailExtra");
            const closeBtnDesktop = document.querySelector(".video-modal-close-desktop");
            const closeBtnMobile = document.querySelector(".video-modal-close-mobile");
            const playPauseBtn = document.getElementById("playPauseBtn");
            const volumeBtn = document.getElementById("volumeBtn");
            const addToCartBtn = document.querySelector(".modal-actions .btn-add-to-cart");
            const wishlistBtn = document.querySelector(".modal-actions .btn-wishlist");
            let isPlaying = true;
            let isMuted = true;
            let currentProductId = null;

            // Function to create thumbnail from video
            function createThumbnailFromVideo(videoSrc, callback) {
                const video = document.createElement('video');
                video.src = videoSrc;
                video.crossOrigin = 'anonymous';
                video.currentTime = 1; // Get frame at 1 second

                video.addEventListener('loadeddata', function () {
                    const canvas = document.createElement('canvas');
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                    callback(canvas.toDataURL('image/jpeg'));
                });

                video.addEventListener('error', function () {
                    // Fallback: use video as poster
                    callback(videoSrc);
                });
            }

            // Open modal with product data
            videoWrappers.forEach((wrapper) => {
                wrapper.addEventListener("click", function () {
                    const videoSrc = this.getAttribute("data-video");
                    const title = this.getAttribute("data-title");
                    const price = this.getAttribute("data-price");
                    const desc = this.getAttribute("data-description");
                    const thumbnail = this.getAttribute("data-thumbnail");
                    const productId = this.getAttribute("data-product-id");
                    const top = this.getAttribute("data-fabric-top");
                    const bottom = this.getAttribute("data-fabric-bottom");
                    const dupatta = this.getAttribute("data-fabric-dupatta");
                    const work = this.getAttribute("data-work");
                    const workExtra = this.getAttribute("data-work-extra");

                    currentProductId = productId;
                    modalVideo.src = videoSrc;
                    modalTitle.textContent = title || "Product Title";
                    modalPrice.textContent = price || "Rs. 0.00";
                    modalDescription.textContent = desc || "Product description goes here.";

                    // Create thumbnail from video
                    if (thumbnail && thumbnail.endsWith('.mp4')) {
                        createThumbnailFromVideo(videoSrc, function (thumbnailData) {
                            modalThumbnail.src = thumbnailData;
                            modalThumbnail.style.display = "block";
                        });
                    } else if (thumbnail) {
                        modalThumbnail.src = thumbnail;
                        modalThumbnail.style.display = "block";
                    } else {
                        // Use video as poster
                        modalThumbnail.src = videoSrc;
                        modalThumbnail.style.display = "block";
                    }

                    fabricTop.textContent = top || "";
                    fabricBottom.textContent = bottom || "";
                    fabricDupatta.textContent = dupatta || "";
                    workDetail.textContent = work || "";
                    workDetailExtra.textContent = workExtra || "";

                    modal.classList.add("show");
                    modalVideo.play();
                    isPlaying = true;
                    isMuted = true;
                    modalVideo.muted = true;
                    updatePlayPauseIcon();
                    updateVolumeIcon();
                });
            });

            // Close modal
            function closeModal() {
                modal.classList.remove("show");
                modalVideo.pause();
                modalVideo.src = "";
            }

            if (closeBtnDesktop) {
                closeBtnDesktop.addEventListener("click", closeModal);
            }

            if (closeBtnMobile) {
                closeBtnMobile.addEventListener("click", closeModal);
            }

            // Close on background click
            modal.addEventListener("click", function (e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // Play/Pause functionality
            if (playPauseBtn) {
                playPauseBtn.addEventListener("click", function (e) {
                    e.stopPropagation();
                    if (isPlaying) {
                        modalVideo.pause();
                        isPlaying = false;
                    } else {
                        modalVideo.play();
                        isPlaying = true;
                    }
                    updatePlayPauseIcon();
                });
            }

            // Volume toggle functionality
            if (volumeBtn) {
                volumeBtn.addEventListener("click", function (e) {
                    e.stopPropagation();
                    isMuted = !isMuted;
                    modalVideo.muted = isMuted;
                    updateVolumeIcon();
                });
            }

            // Update play/pause icon
            function updatePlayPauseIcon() {
                if (playPauseBtn) {
                    const icon = playPauseBtn.querySelector(".material-symbols-outlined");
                    if (icon) {
                        icon.textContent = isPlaying ? "pause_circle" : "play_circle";
                    }
                }
            }

            // Update volume icon
            function updateVolumeIcon() {
                if (volumeBtn) {
                    const icon = volumeBtn.querySelector(".material-symbols-outlined");
                    if (icon) {
                        icon.textContent = isMuted ? "volume_off" : "volume_up";
                    }
                }
            }

            // Update video progress (simplified - shows 1/3 progress)
            modalVideo.addEventListener("timeupdate", function () {
                const progress = (modalVideo.currentTime / modalVideo.duration) * 100;
                const progressBar = document.querySelector(".video-progress-bar");
                if (progressBar) {
                    progressBar.style.width = progress + "%";
                }
            });

            // Handle video play/pause events
            modalVideo.addEventListener("play", function () {
                isPlaying = true;
                updatePlayPauseIcon();
            });

            modalVideo.addEventListener("pause", function () {
                isPlaying = false;
                updatePlayPauseIcon();
            });

            // Force Yellow Hover on Add to Cart Button in Modal
            if (addToCartBtn) {
                const btnText = addToCartBtn.querySelector('.btn-text');
                const btnIcon = addToCartBtn.querySelector('i');

                addToCartBtn.addEventListener('mouseenter', function () {
                    if (btnText) btnText.style.setProperty('color', '#C5A059', 'important');
                    if (btnIcon) btnIcon.style.setProperty('color', '#C5A059', 'important');
                    this.style.setProperty('color', '#C5A059', 'important');
                });

                addToCartBtn.addEventListener('mouseleave', function () {
                    if (btnText) btnText.style.setProperty('color', '#ffffff', 'important');
                    if (btnIcon) btnIcon.style.setProperty('color', '#ffffff', 'important');
                    this.style.setProperty('color', '#ffffff', 'important');
                });
            }

            // Add to Cart functionality
            if (addToCartBtn) {
                addToCartBtn.addEventListener("click", function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    if (!currentProductId) {
                        alert("Product information not available. Please contact us for this item.");
                        return;
                    }

                    // Create add to cart URL
                    const addToCartUrl = `index.php?page=product&action=add&id=${currentProductId}`;

                    // Fetch to add to cart
                    fetch(addToCartUrl)
                        .then(function (response) {
                            return response.text();
                        })
                        .then(function (data) {
                            // Show success message
                            alert("Product added to cart successfully!");

                            // Update cart count if function exists
                            if (window.updateCartCount) {
                                window.updateCartCount();
                            }

                            // Optionally close modal or keep it open
                            // closeModal();
                        })
                        .catch(function (error) {
                            console.error("Error adding to cart:", error);
                            alert("There was an error adding the product to cart. Please try again.");
                        });
                });
            }

            // Wishlist functionality
            if (wishlistBtn) {
                wishlistBtn.addEventListener("click", function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    if (!currentProductId) {
                        alert("Product information not available. Please contact us for this item.");
                        return;
                    }

                    // Check if user is logged in (you may need to adjust this based on your session handling)
                    // For now, redirect to wishlist page
                    const wishlistUrl = `category.php?pid=${currentProductId}&&action=wishlist`;

                    // Try to add to wishlist
                    fetch(wishlistUrl)
                        .then(function (response) {
                            if (response.redirected) {
                                // If redirected to login, open in new window
                                window.location.href = response.url;
                            } else {
                                return response.text();
                            }
                        })
                        .then(function (data) {
                            if (data) {
                                alert("Product added to wishlist successfully!");
                            }
                        })
                        .catch(function (error) {
                            // If fetch fails, redirect to wishlist page
                            window.location.href = wishlistUrl;
                        });
                });
            }
        });
    </script>



    <!--End Products With Tabs-->
    <section class="store-location-section">
        <div class="container">
            <div class="store-location-header">
                <h2>Store Locations</h2>
                <div class="store-location-divider"></div>
                <p class="store-location-description">
                    Step in, explore, and experience our collection at a store near you. Immerse yourself in the
                    heritage of premium ethnic wear.
                </p>
            </div>

            <div class="store-location-card">
                <div class="store-location-image">
                    <img src="assets/images/store.jpg" alt="Elegant ethnic wear display in boutique" />
                    <div class="store-location-overlay"></div>
                    <div class="store-location-badge">
                        <p class="badge-label">Flagship Store</p>
                        <p class="badge-city">Gurugram</p>
                    </div>
                </div>

                <div class="store-location-content">
                    <span class="store-country">India</span>
                    <h3>Nari18</h3>
                    <p class="store-subtitle">by Richa Singh</p>

                    <div class="store-details">
                        <div class="store-detail-item">
                            <span class="material-icons-outlined">location_on</span>
                            <div class="store-detail-text">
                                <p>Shop no 119-120, First Floor, SS Omnia,</p>
                                <p>Sector 86, Gurugram, Haryana 122004</p>
                            </div>
                        </div>

                        <div class="store-detail-item">
                            <span class="material-icons-outlined">phone</span>
                            <a href="tel:+918826446755" class="store-detail-text">+91 8826446755</a>
                        </div>

                        <div class="store-detail-item">
                            <span class="material-icons-outlined">mail_outline</span>
                            <div class="store-detail-text">
                                <a href="mailto:info@nari18.com">info@nari18.com</a>
                                <a href="mailto:richa@nari18.com">richa@nari18.com</a>
                            </div>
                        </div>
                    </div>

                    <div class="store-actions">
                        <a href="https://maps.app.goo.gl/gZq1RZfPYDikAFe88" target="_blank" class="btn-get-directions">
                            Get Directions
                            <span class="material-icons-outlined">east</span>
                        </a>
                        <a href="about.php" class="btn-view-info">View More Info</a>
                    </div>

                    <div class="store-hours">
                        <div class="store-hours-content">
                            <span>Open Daily</span>
                            <span>11:00 AM — 9:00 PM</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="store-tags">
                <div class="store-tag">PREMIUM CRAFT</div>
                <div class="store-tag">EST. 2018</div>
                <div class="store-tag">AUTHENTIC FABRICS</div>
                <div class="store-tag">LUXURY ETHNIC</div>
            </div>
        </div>
    </section>
    <!--End Store Location Section-->

    <!-- Features Section -->
    <?php include 'footer-features.php'; ?>

    <style>
        /* Store Location Section Styles */
        .store-location-section {
            padding: 80px 0;
            background: #F9F8F6;
            min-height: 60vh;
            display: flex;
            align-items: center;
        }

        .store-location-header {
            text-align: center;
            margin-bottom: 64px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .store-location-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 300;
            margin-bottom: 16px;
            color: #1e293b;
        }

        .store-location-divider {
            width: 64px;
            height: 2px;
            background: #C5A059;
            margin: 0 auto 24px;
        }

        .store-location-description {
            color: #64748b;
            font-weight: 300;
            line-height: 1.6;
            font-size: 1rem;
        }

        .store-location-card {
            max-width: 1200px;
            margin: 0 auto;
            background: #ffffff;
            box-shadow: 0 20px 50px -12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .store-location-image {
            width: 100%;
            position: relative;
            min-height: 400px;
        }

        .store-location-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            inset: 0;
        }

        .store-location-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.05);
        }

        .store-location-badge {
            position: absolute;
            bottom: 32px;
            left: 32px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            padding: 16px 24px;
            border-left: 4px solid #C5A059;
        }

        .badge-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: #64748b;
            margin-bottom: 4px;
        }

        .badge-city {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            color: #6B1D1D;
        }

        .store-location-content {
            width: 100%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .store-country {
            color: #C5A059;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            margin-bottom: 16px;
        }

        .store-location-content h3 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            margin-bottom: 8px;
            color: #1e293b;
        }

        .store-subtitle {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 1.125rem;
            color: #64748b;
            margin-bottom: 32px;
        }

        .store-details {
            display: flex;
            flex-direction: column;
            gap: 24px;
            margin-bottom: 40px;
        }

        .store-detail-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }

        .store-detail-item .material-icons-outlined {
            color: #C5A059;
            font-size: 24px;
            margin-top: 2px;
        }

        .store-detail-text {
            color: #475569;
            line-height: 1.6;
            flex: 1;
        }

        .store-detail-text a {
            color: #475569;
            text-decoration: none;
            transition: color 0.3s ease;
            display: block;
        }

        .store-detail-text a:hover {
            color: #C5A059;
        }

        .store-actions {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 48px;
        }

        .btn-get-directions,
        .btn-view-info {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 16px 32px;
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-get-directions {
            background: #6B1D1D;
            color: #ffffff !important;
        }

        .btn-get-directions:hover {
            background: #5a1818;
            box-shadow: 0 4px 12px rgba(107, 29, 29, 0.3);
            color: #C5A059 !important;
        }

        .btn-get-directions .material-icons-outlined {
            font-size: 18px;
            margin-left: 8px;
            color: #ffffff !important;
        }

        .btn-get-directions:hover .material-icons-outlined {
            color: #C5A059 !important;
        }

        .btn-view-info {
            border: 1px solid #e2e8f0;
            color: #1e293b;
        }

        .btn-view-info:hover {
            background: #f8fafc;
            color: #C5A059 !important;
        }

        .store-hours {
            padding-top: 32px;
            border-top: 1px solid #f1f5f9;
        }

        .store-hours-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: #94a3b8;
        }

        .store-tags {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 32px;
            margin-top: 80px;
            opacity: 0.5;
            filter: grayscale(100%);
            transition: all 0.5s ease;
        }

        .store-tags:hover {
            opacity: 1;
            filter: grayscale(0);
        }

        .store-tag {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            text-align: center;
            letter-spacing: -0.02em;
        }

        /* Responsive Design */
        @media (min-width: 768px) {
            .store-location-card {
                flex-direction: row;
            }

            .store-location-image {
                width: 50%;
                min-height: 600px;
            }

            .store-location-content {
                width: 50%;
                padding: 60px;
            }

            .store-actions {
                flex-direction: row;
            }

            .store-tags {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .store-location-header h2 {
                font-size: 3rem;
            }

            .store-location-content h3 {
                font-size: 3rem;
            }
        }

        @media (max-width: 767px) {
            .store-location-section {
                padding: 60px 0;
            }

            .store-location-header {
                margin-bottom: 48px;
            }

            .store-location-header h2 {
                font-size: 2rem;
            }

            .store-location-content {
                padding: 32px 24px;
            }

            .store-location-content h3 {
                font-size: 2rem;
            }

            .store-location-badge {
                bottom: 16px;
                left: 16px;
                padding: 12px 16px;
            }
        }

        .material-icons-outlined {
            font-family: 'Material Icons Outlined', 'Material Icons' !important;
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
            speak: none;
            font-variant: normal;
            text-rendering: optimizeLegibility;
        }

        .store-detail-item .material-icons-outlined {
            font-family: 'Material Icons Outlined', 'Material Icons' !important;
        }

        .btn-get-directions .material-icons-outlined {
            font-family: 'Material Icons Outlined', 'Material Icons' !important;
        }
    </style>

    <!--Parallax Banner-->
    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <header class="testimonials-header">
                <p class="testimonials-label">Testimonials</p>
                <h1 class="testimonials-title">What Our Clients Say</h1>
                <div class="testimonials-divider"></div>
            </header>

            <div class="testimonials-carousel-perspective">
                <!-- Left Card (Hidden on mobile) -->
                <div class="testimonial-card-left" id="leftCard">
                    <p class="testimonial-quote-text">
                        "Nari18 made me feel so confident. The fabric is comfortable and the designs are endless. Truly
                        a memorable experience with Richa Singh."
                    </p>
                    <div class="testimonial-stars">
                        <span class="material-icons-outlined">star</span>
                        <span class="material-icons-outlined">star</span>
                        <span class="material-icons-outlined">star</span>
                        <span class="material-icons-outlined">star</span>
                        <span class="material-icons-outlined">star</span>
                    </div>
                    <div class="testimonial-author-info">
                        <span class="testimonial-author-name">Priya Sharma</span>
                        <span class="testimonial-author-role">Loyal Customer</span>
                    </div>
                </div>

                <!-- Center Card (Active) -->
                <div class="testimonial-card-center" id="centerCard">
                    <div class="testimonial-quote-icon">
                        <span class="material-icons-outlined">format_quote</span>
                    </div>
                    <p class="testimonial-quote-main">
                        "Beautiful designs and even more beautiful boutique. I absolutely love the unique style and
                        quality of the pieces at Nari18. Very elegant, yet modern and the attention to detail is
                        impressive!"
                    </p>
                    <div class="testimonial-stars-main">
                        <span class="material-icons-outlined">star</span>
                        <span class="material-icons-outlined">star</span>
                        <span class="material-icons-outlined">star</span>
                        <span class="material-icons-outlined">star</span>
                        <span class="material-icons-outlined">star</span>
                    </div>
                    <div class="testimonial-author-main">
                        <span class="testimonial-author-name-main">Sandali Tiwari</span>
                        <span class="testimonial-author-role-main">Fashion Enthusiast</span>
                    </div>
                </div>

                <!-- Right Card (Hidden on mobile) -->
                <div class="testimonial-card-right" id="rightCard">
                    <p class="testimonial-quote-text">
                        "The studio offers trendy and high-end fashion options. Excellent customer service with Richa
                        Singh. Highly recommend for fashion lovers!"
                    </p>
                    <div class="testimonial-stars">
                        <span class="material-icons-outlined">star</span>
                        <span class="material-icons-outlined">star</span>
                        <span class="material-icons-outlined">star</span>
                        <span class="material-icons-outlined">star</span>
                        <span class="material-icons-outlined">star</span>
                    </div>
                    <div class="testimonial-author-info">
                        <span class="testimonial-author-name">Ananya Roy</span>
                        <span class="testimonial-author-role">Style Lover</span>
                    </div>
                </div>
            </div>

            <div class="testimonials-dots" id="testimonialsDots">
                <!-- Dots will be generated by JavaScript -->
            </div>
        </div>
    </section>

    <!--End Parallax Banner-->


    <!--Service Section-->
    <!-- <section class="section service-section">
        <div class="container">
            <div class="service-info row col-row row-cols-lg-4 row-cols-md-4 row-cols-sm-2 row-cols-2 text-center">
                <div class="service-wrap col-item">
                    <div class="service-icon mb-3">
                        <i class="icon anm anm-phone-call-l"></i>
                    </div>
                    <div class="service-content">
                        <h3 class="title mb-2">Call us any time</h3>
                        <span class="text-muted">Contact us 24/7 hours a day</span>
                    </div>
                </div>
                <div class="service-wrap col-item">
                    <div class="service-icon mb-3">
                        <i class="icon anm anm-truck-l"></i>
                    </div>
                    <div class="service-content">
                        <h3 class="title mb-2">Pickup At Any Store</h3>
                        <span class="text-muted">Free shipping on orders over $65</span>
                    </div>
                </div>
                <div class="service-wrap col-item">
                    <div class="service-icon mb-3">
                        <i class="icon anm anm-credit-card-l"></i>
                    </div>
                    <div class="service-content">
                        <h3 class="title mb-2">Secured Payment</h3>
                        <span class="text-muted">We accept all major credit cards</span>
                    </div>
                </div>
                <div class="service-wrap col-item">
                    <div class="service-icon mb-3">
                        <i class="icon anm anm-redo-l"></i>
                    </div>
                    <div class="service-content">
                        <h3 class="title mb-2">Free Returns</h3>
                        <span class="text-muted">30-days free return policy</span>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!--End Service Section-->

</div>


<!-- End Body Container -->

<!-- <div class="card purchase-card">
            <div class="card-header purchase-header text-center py-3">
                <h5 class="card-title mb-0">Latest Purchase</h5>
            </div>
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-geo-alt-fill location-icon me-2" viewBox="0 0 16 16">
                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                    </svg>
                    <span class="text-muted">Someone in New Delhi, India</span>
                </div>
                
                <p class="mb-2">purchased a</p>
                
                <h4 class="product-name mb-3">Sukoon Red Tiered Anarkali Set-Set Of 3</h4>
                
                <div class="d-flex align-items-center time-indicator text-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock me-2" viewBox="0 0 16 16">
                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                    </svg>
                    <span>22 minutes ago</span>
                </div>
            </div>
</div> -->
<style>
    /* Testimonials Section Styles */
    .testimonials-section {
        background: #F5F3EF;
        padding: 80px 0;
        min-height: 60vh;
        display: flex;
        align-items: center;
    }

    .testimonials-header {
        text-align: center;
        margin-bottom: 96px;
    }

    .testimonials-label {
        color: #8B6E4E;
        font-family: 'Inter', sans-serif;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        font-size: 14px;
        margin-bottom: 16px;
        font-weight: 500;
    }

    .testimonials-title {
        font-family: 'Playfair Display', serif;
        font-style: italic;
        font-size: 2.5rem;
        color: #1a1a1a;
        margin-bottom: 32px;
    }

    .testimonials-divider {
        width: 80px;
        height: 1px;
        background: #8B6E4E;
        margin: 0 auto;
        opacity: 0.5;
    }

    .testimonials-carousel-perspective {
        position: relative;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 500px;
        perspective: 1200px;
    }

    /* Left Card */
    .testimonial-card-left {
        position: absolute;
        width: 90%;
        max-width: 448px;
        background: rgba(255, 255, 255, 0.8);
        padding: 40px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.7s ease;
        pointer-events: none;
        transform: translateX(-60%) translateZ(-200px) rotateY(25deg);
        opacity: 0.4;
        filter: blur(2px);
    }

    /* Center Card */
    .testimonial-card-center {
        position: relative;
        width: 95%;
        max-width: 672px;
        background: #ffffff;
        padding: 48px 64px;
        border-radius: 16px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        transition: all 0.7s ease;
        transform: translateX(0) translateZ(50px) rotateY(0deg);
        z-index: 20;
    }

    .testimonial-quote-icon {
        position: absolute;
        top: -24px;
        left: 48px;
    }

    .testimonial-quote-icon .material-icons-outlined {
        font-size: 64px;
        color: rgba(139, 110, 78, 0.2);
    }

    .testimonial-quote-main {
        font-family: 'Playfair Display', serif;
        font-style: italic;
        font-size: 1.5rem;
        color: #1e293b;
        line-height: 1.6;
        margin-bottom: 40px;
        position: relative;
        z-index: 10;
    }

    /* Text Animation Styles - No font/styling changes */
    @keyframes testimonialFadeOut {
        from {
            opacity: 1;
            transform: translateY(0);
        }

        to {
            opacity: 0;
            transform: translateY(-15px);
        }
    }

    @keyframes testimonialFadeIn {
        from {
            opacity: 0;
            transform: translateY(15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .testimonial-text-fade-out {
        animation: testimonialFadeOut 0.4s ease-out forwards;
    }

    .testimonial-text-fade-in {
        animation: testimonialFadeIn 0.5s ease-out forwards;
    }

    /* Stars Animation */
    .testimonial-stars,
    .testimonial-stars-main {
        animation: testimonialFadeIn 0.5s ease-out 0.1s both;
    }

    .testimonial-stars-fade-out,
    .testimonial-stars-main-fade-out {
        animation: testimonialFadeOut 0.4s ease-out forwards;
    }

    .testimonial-stars-fade-in,
    .testimonial-stars-main-fade-in {
        animation: testimonialFadeIn 0.5s ease-out 0.1s both;
    }

    .testimonial-stars-main {
        display: flex;
        gap: 4px;
        margin-bottom: 32px;
        color: #fbbf24;
    }

    .testimonial-stars-main .material-icons-outlined {
        font-size: 20px;
    }

    .testimonial-author-main {
        display: flex;
        flex-direction: column;
        padding-top: 32px;
        border-top: 1px solid #f1f5f9;
    }

    .testimonial-author-name-main {
        font-family: 'Inter', sans-serif;
        font-size: 16px;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 4px;
    }

    .testimonial-author-role-main {
        font-family: 'Inter', sans-serif;
        font-size: 12px;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: #8B6E4E;
    }

    /* Right Card */
    .testimonial-card-right {
        position: absolute;
        width: 90%;
        max-width: 448px;
        background: rgba(255, 255, 255, 0.8);
        padding: 40px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.7s ease;
        pointer-events: none;
        transform: translateX(60%) translateZ(-200px) rotateY(-25deg);
        opacity: 0.4;
        filter: blur(2px);
    }

    /* Side Cards Content */
    .testimonial-quote-text {
        font-family: 'Playfair Display', serif;
        font-style: italic;
        font-size: 1.125rem;
        color: #374151;
        line-height: 1.6;
        margin-bottom: 24px;
    }

    .testimonial-stars {
        display: flex;
        gap: 4px;
        margin-bottom: 24px;
        color: #fbbf24;
    }

    .testimonial-stars .material-icons-outlined {
        font-size: 14px;
    }

    .testimonial-author-info {
        display: flex;
        flex-direction: column;
    }

    .testimonial-author-name {
        font-family: 'Inter', sans-serif;
        font-size: 14px;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        font-weight: 500;
        color: #1e293b;
        margin-bottom: 4px;
    }

    .testimonial-author-role {
        font-family: 'Inter', sans-serif;
        font-size: 12px;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        font-style: italic;
        color: #6b7280;
    }

    /* Navigation */
    .testimonials-dots {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        margin-top: 64px;
    }

    .testimonial-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(139, 110, 78, 0.3);
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 0;
    }

    .testimonial-dot:hover {
        background: rgba(139, 110, 78, 0.6);
        transform: scale(1.2);
    }

    .testimonial-dot.active {
        background: #8B6E4E;
        width: 16px;
        height: 16px;
    }

    /* Responsive */
    @media (max-width: 1024px) {

        .testimonial-card-left,
        .testimonial-card-right {
            display: none;
        }

        .testimonial-card-center {
            width: 100%;
            max-width: 100%;
        }
    }

    @media (max-width: 768px) {
        .testimonials-section {
            padding: 60px 0;
        }

        .testimonials-header {
            margin-bottom: 64px;
        }

        .testimonials-title {
            font-size: 2rem;
        }

        .testimonial-card-center {
            padding: 32px 24px;
        }

        .testimonial-quote-main {
            font-size: 1.25rem;
        }

        .testimonial-quote-icon {
            top: -16px;
            left: 24px;
        }

        .testimonial-quote-icon .material-icons-outlined {
            font-size: 48px;
        }
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const testimonials = [
            {
                quote: "Nari18 made me feel so confident. The fabric is comfortable and the designs are endless. Truly a memorable experience with Richa Singh.",
                author: "Priya Sharma",
                role: "Loyal Customer",
                stars: 5
            },
            {
                quote: "Beautiful designs and even more beautiful boutique. I absolutely love the unique style and quality of the pieces at Nari18. Very elegant, yet modern and the attention to detail is impressive!",
                author: "Sandali Tiwari",
                role: "Fashion Enthusiast",
                stars: 5
            },
            {
                quote: "The studio offers trendy and high-end fashion options. Excellent customer service with Richa Singh. Highly recommend for fashion lovers!",
                author: "Ananya Roy",
                role: "Style Lover",
                stars: 5
            },
            {
                quote: "I would love to share my experience with Nari 18, Richa. It was an awesome process of discussing design with Richa always!",
                author: "Tanuja Malik",
                role: "Regular Customer",
                stars: 5
            },
            {
                quote: "Richa @Nari18 is very detailed oriented and accommodating till the fit and finish was as per my liking. Was a pleasure getting my outfits done from her. Highly recommended!",
                author: "Shilpi Goyal",
                role: "Premium Customer",
                stars: 5
            }
        ];

        let currentIndex = 1;
        const leftCard = document.getElementById('leftCard');
        const centerCard = document.getElementById('centerCard');
        const rightCard = document.getElementById('rightCard');
        const dotsContainer = document.getElementById('testimonialsDots');

        // Create dots
        function createDots() {
            if (dotsContainer) {
                dotsContainer.innerHTML = '';
                testimonials.forEach((_, index) => {
                    const dot = document.createElement('button');
                    dot.className = 'testimonial-dot';
                    if (index === currentIndex) {
                        dot.classList.add('active');
                    }
                    dot.setAttribute('data-index', index);
                    dot.addEventListener('click', function () {
                        currentIndex = parseInt(this.getAttribute('data-index'));
                        updateTestimonials();
                        updateDots();
                    });
                    dotsContainer.appendChild(dot);
                });
            }
        }

        // Update dots active state
        function updateDots() {
            const dots = document.querySelectorAll('.testimonial-dot');
            dots.forEach((dot, index) => {
                if (index === currentIndex) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }

        function animateTextUpdate(element, newText) {
            if (!element) return;

            // Remove any existing animation classes
            element.classList.remove('testimonial-text-fade-in', 'testimonial-text-fade-out');

            // Add fade out
            element.classList.add('testimonial-text-fade-out');

            // After fade out completes, update text and fade in
            setTimeout(() => {
                element.textContent = newText;
                element.classList.remove('testimonial-text-fade-out');

                // Force reflow to restart animation
                void element.offsetWidth;

                // Add fade in
                element.classList.add('testimonial-text-fade-in');

                // Clean up after animation
                setTimeout(() => {
                    element.classList.remove('testimonial-text-fade-in');
                }, 500);
            }, 400);
        }

        function animateStarsUpdate(starsContainer) {
            if (!starsContainer) return;

            // Remove any existing animation classes
            starsContainer.classList.remove('testimonial-stars-fade-in', 'testimonial-stars-fade-out', 'testimonial-stars-main-fade-in', 'testimonial-stars-main-fade-out');

            // Add fade out
            if (starsContainer.classList.contains('testimonial-stars-main')) {
                starsContainer.classList.add('testimonial-stars-main-fade-out');
            } else {
                starsContainer.classList.add('testimonial-stars-fade-out');
            }

            // After fade out completes, fade in
            setTimeout(() => {
                starsContainer.classList.remove('testimonial-stars-fade-out', 'testimonial-stars-main-fade-out');

                // Force reflow to restart animation
                void starsContainer.offsetWidth;

                // Add fade in
                if (starsContainer.classList.contains('testimonial-stars-main')) {
                    starsContainer.classList.add('testimonial-stars-main-fade-in');
                } else {
                    starsContainer.classList.add('testimonial-stars-fade-in');
                }

                // Clean up after animation
                setTimeout(() => {
                    starsContainer.classList.remove('testimonial-stars-fade-in', 'testimonial-stars-main-fade-in');
                }, 600);
            }, 400);
        }

        function updateTestimonials() {
            const prevIndex = (currentIndex - 1 + testimonials.length) % testimonials.length;
            const nextIndex = (currentIndex + 1) % testimonials.length;
            const current = testimonials[currentIndex];
            const prev = testimonials[prevIndex];
            const next = testimonials[nextIndex];

            // Update left card with animation
            if (leftCard) {
                const leftQuote = leftCard.querySelector('.testimonial-quote-text');
                const leftName = leftCard.querySelector('.testimonial-author-name');
                const leftRole = leftCard.querySelector('.testimonial-author-role');
                const leftStars = leftCard.querySelector('.testimonial-stars');

                if (leftQuote) animateTextUpdate(leftQuote, `"${prev.quote}"`);
                if (leftName) animateTextUpdate(leftName, prev.author);
                if (leftRole) animateTextUpdate(leftRole, prev.role);
                if (leftStars) animateStarsUpdate(leftStars);
            }

            // Update center card with animation
            if (centerCard) {
                const centerQuote = centerCard.querySelector('.testimonial-quote-main');
                const centerName = centerCard.querySelector('.testimonial-author-name-main');
                const centerRole = centerCard.querySelector('.testimonial-author-role-main');
                const centerStars = centerCard.querySelector('.testimonial-stars-main');

                if (centerQuote) animateTextUpdate(centerQuote, `"${current.quote}"`);
                if (centerName) animateTextUpdate(centerName, current.author);
                if (centerRole) animateTextUpdate(centerRole, current.role);
                if (centerStars) animateStarsUpdate(centerStars);
            }

            // Update right card with animation
            if (rightCard) {
                const rightQuote = rightCard.querySelector('.testimonial-quote-text');
                const rightName = rightCard.querySelector('.testimonial-author-name');
                const rightRole = rightCard.querySelector('.testimonial-author-role');
                const rightStars = rightCard.querySelector('.testimonial-stars');

                if (rightQuote) animateTextUpdate(rightQuote, `"${next.quote}"`);
                if (rightName) animateTextUpdate(rightName, next.author);
                if (rightRole) animateTextUpdate(rightRole, next.role);
                if (rightStars) animateStarsUpdate(rightStars);
            }

            updateDots();
        }

        function nextTestimonial() {
            currentIndex = (currentIndex + 1) % testimonials.length;
            updateTestimonials();
        }

        // Auto slide every 5 seconds
        setInterval(nextTestimonial, 5000);

        // Initialize
        createDots();
        updateTestimonials();
    });
</script>

<style>
    /* Prevent horizontal scrollbar globally */
    html,
    body {
        overflow-x: hidden !important;
        width: 100% !important;
        max-width: 100% !important;
    }

    .page-wrapper {
        overflow-x: hidden !important;
        width: 100% !important;
        max-width: 100% !important;
    }

    /* Modern Product Design Styles with Card Outline */
    .product-box-modern {
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        padding: 12px;
        margin-bottom: 20px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .product-box-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #800020 0%, #C5A059 100%);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .product-box-modern:hover::before {
        transform: scaleX(1);
    }

    /* Prevent clipping on hover - Add padding to slider container */
    .product-slider-5items {
        padding-top: 12px !important;
        padding-bottom: 12px !important;
        overflow-x: hidden !important;
        overflow-y: visible !important;
        width: 100% !important;
        max-width: 100% !important;
    }

    .product-slider-5items .slick-list {
        padding-top: 0 !important;
        padding-bottom: 0 !important;
        overflow-x: hidden !important;
        overflow-y: visible !important;
        margin: 0 !important;
        width: 100% !important;
    }

    .product-slider-5items .slick-track {
        padding-top: 0 !important;
        margin-top: 0 !important;
        display: flex !important;
        align-items: stretch !important;
    }

    /* Add margin to product items to prevent top clipping */
    .product-item.zoomscal-hov {
        margin-top: 8px;
        margin-bottom: 8px;
        padding-top: 0;
        padding-bottom: 0;
        height: auto;
        width: 100% !important;
        max-width: 100% !important;
    }

    /* Ensure product boxes don't get cut off */
    .product-item.zoomscal-hov .product-box-modern {
        margin-top: 0;
        margin-bottom: 0;
        width: 100% !important;
        max-width: 100% !important;
        box-sizing: border-box !important;
    }

    /* Prevent horizontal overflow on parent containers */
    .section.product-slider,
    .section.product-slider .container,
    .tabs-listing {
        overflow-x: hidden !important;
        width: 100% !important;
        max-width: 100% !important;
    }

    .product-box-modern:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(128, 0, 32, 0.15), 0 4px 8px rgba(0, 0, 0, 0.1);
        border-color: #800020;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .product-image-modern {
        position: relative;
        width: 100%;
        overflow: hidden;
        background: #f8f8f8;
        margin-bottom: 12px;
        border-radius: 8px;
        transition: all 0.4s ease;
    }

    .product-box-modern:hover .product-image-modern {
        box-shadow: 0 4px 12px rgba(128, 0, 32, 0.1);
    }

    .product-img-modern {
        display: block;
        width: 100%;
        height: auto;
        text-decoration: none;
    }

    .product-img-modern img {
        width: 100%;
        height: auto;
        display: block;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1), filter 0.4s ease;
        filter: brightness(1);
    }

    .product-box-modern:hover .product-img-modern img {
        transform: scale(1.08);
        filter: brightness(1.05);
    }

    .product-details-modern {
        text-align: left;
        padding: 0;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .product-name-modern {
        margin-bottom: 10px;
        min-height: 40px;
    }

    .product-name-modern a {
        font-size: 14px;
        font-weight: 500;
        color: #000;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        line-height: 1.4;
        display: block;
        font-family: 'Poppins', sans-serif;
        transition: color 0.3s ease;
    }

    .product-name-modern a:hover {
        color: #800020;
        transition: color 0.3s ease;
    }

    .btn-wishlist-modern {
        position: absolute;
        top: 12px;
        right: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border: 1px solid rgba(128, 0, 32, 0.2);
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(8px);
        color: #800020;
        border-radius: 50%;
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        z-index: 10;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        opacity: 0;
        transform: scale(0.8);
    }

    .product-box-modern:hover .btn-wishlist-modern {
        opacity: 1;
        transform: scale(1);
    }

    .btn-wishlist-modern:hover {
        background: rgba(255, 255, 255, 0.95);
        border-color: #800020;
        color: #800020;
        transform: scale(1.15);
        box-shadow: 0 4px 12px rgba(128, 0, 32, 0.15);
    }

    .btn-wishlist-modern i {
        font-size: 16px;
    }

    .product-price-modern {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 0;
    }

    .price-info {
        display: flex;
        align-items: baseline;
        gap: 8px;
        flex-wrap: wrap;
    }

    .price-current {
        font-size: 16px;
        font-weight: 600;
        color: #ff0000;
        font-family: 'Poppins', sans-serif;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .product-box-modern:hover .price-current {
        color: #ff0000;
        transform: scale(1.05);
    }

    .price-old {
        font-size: 14px;
        color: #999;
        text-decoration: line-through;
        font-weight: 400;
        font-family: 'Poppins', sans-serif;
        transition: opacity 0.3s ease;
    }

    .product-box-modern:hover .price-old {
        opacity: 0.7;
    }

    .btn-cart-modern {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border: 1px solid rgba(128, 0, 32, 0.2);
        background: #fff;
        color: #800020;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        flex-shrink: 0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .btn-cart-modern:hover {
        background: #fff;
        border-color: #800020;
        color: #800020;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(128, 0, 32, 0.15);
    }

    .btn-cart-modern i {
        transition: transform 0.3s ease;
    }

    .btn-cart-modern:hover i {
        transform: scale(1.1);
    }

    .btn-cart-modern.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .btn-cart-modern.disabled:hover {
        background: #fff;
        border-color: #e0e0e0;
        color: #333;
        transform: none;
    }

    .btn-cart-modern i {
        font-size: 16px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .product-box-modern {
            padding: 10px;
        }

        .product-name-modern a {
            font-size: 12px;
        }

        .price-current {
            font-size: 14px;
        }

        .price-old {
            font-size: 12px;
        }

        .btn-cart-modern,
        .btn-wishlist-modern {
            width: 32px;
            height: 32px;
        }

        .btn-cart-modern i,
        .btn-wishlist-modern i {
            font-size: 14px;
        }

        .btn-wishlist-modern {
            top: 8px;
            right: 8px;
        }
    }
</style>

<?php include 'footer.php' ?>