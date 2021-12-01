<section id="primary" class="content-full-width"> <!-- **Primary Starts Here** -->
    <div class="fullwidth-section"> <!-- **Full-width-section Starts Here** -->
        <div class="container">
            <div class="dt-sc-hr-invisible-small"></div>
            <div class="main-title pullDown" data-animation="pullDown" data-delay="100">
                <h3> Referanslarımız </h3>
                <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>-->
            </div>
        </div>
        <div class="dt-sc-sorting-container">
            <a data-filter="*" href="#" class="active-sort type1 dt-sc-button">Tümü</a>
            <?php foreach (falseToArray(groupArray($references, "Category")) as $category) : ?>
                <a data-filter=".<?php echo sefUrlTR($category); ?>" href="#" class="dt-sc-tooltip-top type1 dt-sc-button"><?php echo $category; ?></a>
            <?php endforeach; ?>
        </div>
        <div class="portfolio-fullwidth"><!-- **portfolio-fullwidth Starts Here** -->
            <div class="portfolio-grid">
                <div class="dt-sc-portfolio-container isotope" style="position: relative; overflow: hidden; height: 1061px;"> <!-- **dt-sc-portfolio-container Starts Here** -->
                    <?php foreach (falseToArray($references) as $reference) : ?>
                    <div class="portfolio nature <?php echo sefUrlTR($reference["Category"]); ?> dt-sc-one-fourth isotope-item" style="position: absolute; left: 0px; top: 0px; transform: translate3d(0px, 0px, 0px);">
                        <figure>
                            <img src="<?php assets("images/art.gif"); ?>" class="async" data-src="<?php uploads($reference["Path"]); ?>" alt="<?php echo $reference["Name"]; ?>" title="<?php echo $reference["Title"]; ?>">
                            <figcaption>
                                <div class="portfolio-detail">
                                    <div class="views">
                                        <a class="fa fa-camera-retro" data-gal="prettyPhoto[gallery]" href="<?php uploads($reference["Path"]); ?>"></a>
                                    </div>
                                    <div class="portfolio-title">
                                        <h5><span href="#"><?php echo $reference["Name"]; ?></span></h5>
                                        <p><?php echo $reference["Title"]; ?></p>
                                    </div>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                    <?php endforeach; ?>
                </div><!-- **dt-sc-portfolio-container Ends Here** -->
            </div>
        </div><!-- **portfolio-fullwidth Ends Here** -->
        <div class="aligncenter">
            <a href="#" class="loadmore dt-sc-button medium type3 with-icon"><i class="fa fa-picture-o"></i> <span> Fazlasını Yükle </span> </a>
        </div>
        <div class="dt-sc-hr-invisible-small"></div>
    </div><!-- **Full-width-section Ends Here** -->
</section>