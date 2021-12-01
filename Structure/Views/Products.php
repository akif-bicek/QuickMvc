<div class="container">
    <div class="dt-sc-hr-invisible-small"></div>
    <div class="main-title pullDown" data-animation="pullDown" data-delay="100">
        <?php if ($categoryPage):
            $searchAction = "searchProductCategories"; ?>
            <h3> <?php echo $category["Name"]; ?> </h3>
            <p><?php echo $category["Description"]; ?></p>
        <?php else:
            $searchAction = "searchProducts"; ?>
            <h3> Ürünlerimiz </h3>
            <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p>-->
        <?php endif; ?>
    </div>
    <section id="primary" class="with-sidebar with-right-sidebar">
        <?php if($search != ""): ?>
            <p>Aranan :</p>
            <h5> <?php echo $search ; ?> </h5>
        <?php endif; ?>
        <article>
            <?php if ($categoryPage): ?>
                <?php if (count($categoryImages) >= 1): ?>
                <div class="dt-sc-one-column column first">
                    <div class="recent-gallery-container">
                        <div class="bx-wrapper" style="max-width: 100%;"><div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 459px;">
                                <ul class="recent-gallery" style="width: 860%; position: relative;">
                                    <?php foreach ($categoryImages as $categoryImage): ?>
                                        <li style="float: left; list-style: none; position: relative; width: 870px;" class="bx-clone">
                                            <img class="async" src="<?php echo assets("images/art.gif"); ?>" data-src="<?php uploads($categoryImage["Path"]); ?>" alt="<?php echo $category["Name"]; ?>">
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                        <div id="bx-pager">
                            <?php foreach ($categoryImages as $k => $categoryImage): ?>
                                <a href="#" data-slide-index="<?php echo $k; ?>" class="<?php echo ($k == 0) ? "active" : ""; ?>">
                                    <img class="async" src="<?php echo assets("images/art.gif"); ?>" data-src="<?php uploads($categoryImage["Path"]); ?>" alt="<?php echo $category["Name"]; ?>">
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="dt-sc-hr-invisible-small"> </div>
                <?php endif; ?>
                <div class="dt-sc-two-third column first fadeInLeft" data-animation="fadeInLeft" data-delay="100">
                    <h2><?php echo $category["Description"]; ?></h2>
                    <?php echo decodeSecurity($category["Content"]); ;?>
                </div>
            <?php endif; ?>

            <div class="blog-items apply-isotope clear isotope" style="position: relative; overflow: hidden; height: 1182px;">
                <?php if (count(falseToArray($products)) > 0): ?>
                    <?php foreach (falseToArray($products) as $product): ?>
                    <div class="dt-sc-one-fourth column isotope-item" style="position: absolute; left: 0px; top: 0px;">
                        <article class="blog-entry">
                            <div class="entry-thumb">
                                <a href="<?php echo $product["Url"] ;?>"><img class="async" src="<?php echo assets("images/art.gif"); ?>" data-src="<?php uploads($product["Path"]); ?>" alt="<?php echo $product["Name"] ;?>" title="<?php echo $product["Name"] ;?>"></a>
                            </div>
                            <div class="entry-details">
                                <div class="entry-title">
                                    <h4> <a href="<?php echo $product["Url"] ;?>"><?php echo $product["Name"] ;?></a> </h4>
                                </div>
                                <div class="entry-metadata">
                                    <p class="tags"><i class="fa fa-tags"> </i><a href="<?php echo $product["CategoryUrl"]; ?>" rel="tag"><?php echo $product["CategoryName"] ;?></a></p>
                                    <p><a href="#"><i class="fa fa-comments"></i><?php echo $product["CommentsCount"]; ?></a></p>
                                </div>
                                <div class="entry-body">
                                    <p><?php echo $product["Description"] ;?></p>
                                </div>
                            </div>
                        </article>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="column isotope-item" style="position: absolute; left: 0px; top: 0px;">
                        <h3>Ürün kaydı bulunamadı</h3>
                    </div>
                <?php endif; ?>
            </div>

            <?php
            $link = "";
            if ($search != ""){
                $link = $productsAction . "/" . $search;
            }
            $currentUrl = currentUrl($link);
            $next = $currentUrl[1];
            $prev = $currentUrl[0];

            ?>
            <div class="dt-sc-post-pagination">
                <a class="dt-sc-button small type3 with-icon prev-post" href="<?php echo $prev; ?>">
                    <span> Önceki Sayfa </span> <i class="fa fa-hand-o-left"> </i> </a>
                <a class="dt-sc-button small type3 with-icon next-post" href="<?php echo $next; ?>"><i class="fa fa-hand-o-right"> </i> <span> Sonraki Sayfa </span> </a>
            </div>
        </article>
        <div class="dt-sc-hr-invisible-small"></div>
    </section>

    <section id="secondary" class="secondary-sidebar secondary-has-right-sidebar">
        <!-- **Secondary Starts Here** -->
        <aside class="widget widget_search">
            <div class="widgettitle sub-title">
                <!--<h3>Have you Lost ?</h3>-->
            </div>
            <form method="post" novalidate="novalidate" id="searchform" action="<?php echo $searchAction; ?>">
                <p class="input-text">
                    <?php if ($categoryPage): ?>
                        <input type="hidden" name="categoryID" value="<?php echo $categoryID;?>">
                    <?php endif; ?>
                    <input class="input-field" type="text" name="search" value="" required="">
                    <label class="input-label">
                        <i class="fa fa-search icon"></i>
                        <span class="input-label-content">Ara</span>
                    </label>
                    <input type="submit" name="submit" class="submit" value="Ara">
                </p>
            </form>
            <div id="ajax_subscribe_msg"></div>
        </aside>
        <aside class="widget widget_categories">
            <div class="widgettitle sub-title">
                <h3> Kategoriler </h3>
            </div>
            <ul>
                <?php foreach (falseToArray($categories) as $category): ?>
                <li class="cat-item"><a title="<?php echo $category["Description"] ;?>" href="<?php echo $category["Url"] ;?>"><?php echo $category["Name"] ;?><span> <?php echo $category["ProductsCount"] ;?></span></a></li>
                <?php endforeach; ?>
            </ul>
        </aside>
        <aside class="widget widget_popular_entries">
            <div class="fadeInRight" data-animation="fadeInRight" data-delay="100">
                <div class="dt-sc-project-details">
                    <?php if ($categoryPage): ?>
                        <!--<h5>Other Details</h5>-->
                        <div class="enquiry-details">
                            <p><i class="fa fa-tags"></i> <?php echo $category["Name"]; ?></p>
                            <p><i class="fa fa-globe"></i> <?php echo $category["Description"]; ?></p>
                            <p><i class="fa fa-eye"></i> <?php echo $category["Views"]; ?></p>
                            <p><i class="fa fa-file-word-o"></i> <?php echo $category["Keywords"]; ?></p>
                        </div>
                    <?php endif; ?>
                    <h5>Sosyal Medya Hesaplarımız</h5>
                    <ul class="type3 dt-sc-social-icons">
                        <?php foreach (falseToArray($socials) as $social): ?>
                            <li class="<?php echo $social["Name"] ;?>"><a style="background-color: <?php echo decodeSecurity($social["BackgroundColor"]); ?>"  href="<?php echo $social["Link"] ;?>"> <?php echo decodeSecurity($social["Icon"]); ?> </a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </aside>
        <aside class="widget widget_tag_cloud">
            <div class="widgettitle sub-title">
                <h3> Etiketler </h3>
            </div>
            <div class="tagcloud type3">
                <?php foreach (falseToArray($tags) as $tag): ?>
                    <a href="<?php echo currentActionHome() . $tag["Name"];?> " ><?php echo $tag["Name"] ;?></a>
                <?php endforeach; ?>
            </div>
        </aside>
    </section><!-- **Secondary Ends Here** -->
</div>
<!--<form id="tag-form-<?php /*echo $tag["ID"] ;*/?>" action="<?php /*echo $searchAction; */?>" method="post">
    <input type="hidden" name="search" value="<?php /*echo $tag["Name"] ;*/?>">
    <a href="#" onclick="document.getElementById('tag-form-<?php /*echo $tag["ID"] ;*/?>').submit();"><?php /*echo $tag["Name"] ;*/?></a>
</form>-->