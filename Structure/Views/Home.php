<section id="slideshow">
    <div class="swiper-container main-slider loading">
        <div class="swiper-wrapper">
            <?php foreach (falseToArray($sliders) as $slider): ?>
            <div class="swiper-slide">
                <figure class="slide-bgimg css-async" data-src="<?php uploads($slider["ImagePath"]); ?>"
                        style="background-image:url(<?php assets("images/art.gif"); ?>)">
                    <img alt="<?php altuider(); ?>" src="<?php echo assets("images/art.gif"); ?>" data-src="<?php uploads($slider["ImagePath"]); ?>"
                         class="entity-img async" />
                </figure>
                <div class="content">
                    <p class="title"><?php echo $slider["Title"] ?></p>
                    <span class="caption"><?php echo decodeSecurity($slider["Caption"]) ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev swiper-button-white"></div>
        <div class="swiper-button-next swiper-button-white"></div>
    </div>

    <!-- Thumbnail navigation -->
    <div class="swiper-container nav-slider loading">
        <div class="swiper-wrapper" role="navigation">
            <?php foreach (falseToArray($sliders) as $slider): ?>
                <div class="swiper-slide">
                    <figure class="slide-bgimg css-async" data-src="<?php uploads($slider["ImagePath"]); ?>"
                            style="background-image:url(<?php echo assets("images/art.gif"); ?>)">
                        <img alt="<?php altuider(); ?>" data-src="<?php uploads($slider["ImagePath"]); ?>" src="<?php echo assets("images/art.gif");?>"
                             class="entity-img async"/>
                    </figure>
                    <div class="content">
                        <p class="title"><?php echo $slider["Title"] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section id="primary" class="content-full-width"> <!-- **Primary Starts Here** -->

    <div class="dt-sc-hr-invisible-small"></div>

    <div class="fullwidth-section"> <!-- **Full-width-section Starts Here** -->
        <div class="container">
            <div class="main-title animate" data-animation="pullDown" data-delay="100">
                <h2 class="aligncenter">Son Eklenen Ürünler </h2>
                <!--<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do </p>-->
            </div>
        </div>
        <div class="dt-sc-sorting-container">
            <a data-filter="*" href="#" title="09"
               class="active-sort type1 dt-sc-button animate" data-animation="fadeIn"
               data-delay="100">Tümü</a>
            <?php foreach (falseToArray($lastAdded["categories"]) as $category): ?>
            <a data-filter=".<?php echo $category["Name"]; ?>" href="#"
               class="type1 dt-sc-button animate" data-animation="fadeIn"
               data-delay="200"><?php echo $category["Name"]; ?></a>
            <?php endforeach; ?>
        </div>
        <div class="portfolio-fullwidth">
            <div class="portfolio-grid">
                <div class="dt-sc-portfolio-container isotope">
                    <!-- **dt-sc-portfolio-container Starts Here** -->
                    <?php foreach (falseToArray($lastAdded["products"]) as $product): ?>
                    <div class="portfolio <?php echo getCategoryName($product["CategoryID"], $lastAdded["categories"]); ?> still-life dt-sc-one-fourth">
                        <figure>
                            <img class="async" src="<?php echo assets("images/art.gif"); ?>" data-src="<?php uploads($product["Path"]); ?>" alt="<?php echo $product["Name"]; ?>" title="<?php echo $product["Name"]; ?>">
                            <figcaption>
                                <div class="portfolio-detail">
                                    <div class="views">
                                        <a class="fa fa-camera-retro" data-gal="prettyPhoto[gallery]"
                                           href="<?php uploads($product["Path"]); ?>"></a>
                                    </div>
                                    <div class="portfolio-title">
                                        <h5><a href="<?php echo $product["Url"]; ?>"><?php echo $product["Name"]; ?></a></h5>
                                        <p><?php echo $product["Description"]; ?></p>
                                    </div>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                    <?php endforeach; ?>
                </div><!-- **dt-sc-portfolio-container Ends Here** -->
            </div>
        </div>
    </div><!-- **Full-width-section Ends Here** -->
    <div class="clear"></div>
    <div class="container">
        <div class="main-title animate" data-animation="pullDown" data-delay="100">
            <h2 class="aligncenter"> Ürünler </h2>
            <!--<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do </p>-->
        </div>
    </div>
    <div class="fullwidth-section"><!-- **Full-width-section Starts Here** -->
        <?php foreach (falseToArray($categories) as $category): ?>
            <div class="blog-section">
                <article class="blog-entry">
                    <div class="entry-thumb">
                        <ul class="blog-slider">
                           <?php foreach ($category["Images"] as $image): ?>
                               <li><img class="async" src="<?php echo assets("images/art.gif"); ?>" data-src="<?php uploads($image["Path"]); ?>" alt="<?php echo $category["Name"]; ?>" title="<?php echo $category["Description"]; ?>">
                               </li>
                           <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="entry-details">
                        <div class="entry-title">
                            <h3><a href="<?php echo $category["Url"]; ?>"></a></h3>
                        </div>
                        <div class="entry-body">
                            <p><b><?php echo $category["Name"]; ?></b>, <?php echo decodeSecurity($category["Content"]); ?>
                            </p>
                        </div>
                        <a class="type1 dt-sc-button small" href="<?php echo $category["Url"]; ?>">Ürünleri Gör<i
                                    class="fa fa-angle-right"></i></a>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    </div><!-- **Full-width-section Ends Here** -->
    <div class="clear"></div>
    <div class="dt-sc-hr-invisible-small"></div>
    <div class="clear"></div>

    <div class="fullwidth-section"><!-- **Full-width-section Starts Here** -->
        <div class="container">

            <div class="main-title animate" data-animation="pullDown" data-delay="100">
                <h2 class="aligncenter"> Hakkımızda </h2>
                <!--<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do </p>-->
            </div>

            <div class="about-section">

                <div class="dt-sc-one-half column first">
                    <img class="async" src="<?php echo assets("images/art.gif"); ?>" data-src="<?php uploads($aboutImage); ?>" title="<?php echo $aboutDesc; ?>" alt="<?php echo $aboutTitle; ?>">
                </div>

                <div class="dt-sc-one-half column">
                    <?php echo decodeSecurity($aboutContent); ?>
                </div>
            </div>
        </div>
    </div><!-- **Full-width-section Ends Here** -->
    <div class="dt-sc-hr-invisible-small"></div>
</section>