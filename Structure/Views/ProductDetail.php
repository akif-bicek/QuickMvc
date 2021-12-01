<section id="primary" class="content-full-width"><!-- **Primary Starts Here** -->
    <div class="container">
        <div class="dt-sc-hr-invisible-small"></div>
        <div class="main-title pullDown" data-animation="pullDown" data-delay="100">
            <h3> <?php echo $product["Name"]; ?> </h3>
            <p><?php echo $product["Description"]; ?></p>
        </div>
        <div class="cart-wrapper"><!-- *cart-wrapper starts here** -->
            <div class="dt-sc-three-fifth column first">
                <div class="cart-thumb">
                    <a id="p-big-href" href="<?php uploads($product["Path"]); ?>">
                        <img id="product-big" class="async" src="<?php echo assets("images/art.gif"); ?>" data-src="<?php uploads($product["Path"]); ?>" alt="<?php echo $product["Name"]; ?>" title="<?php echo $product["Description"]; ?>">
                    </a>
                </div>
                <ul class="thumblist">
                    <?php foreach (falseToArray($images) as $image): ?>
                        <li>
                            <a type="button" style="cursor: pointer;" class="product"><img onclick="productThumb('<?php uploads($image["Path"]); ?>')" width="150" height="120" class="async" src="<?php echo assets("images/art.gif"); ?>" data-src="<?php uploads($image["Path"]); ?>" alt="<?php echo $product["Name"]; ?>" title="<?php echo $product["Description"]; ?>"></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <!--<aside class="widget widget_popular_entries">
                    <div class="fadeInRight" data-animation="fadeInRight" data-delay="100">
                        <div class="dt-sc-project-details">
                            <h5>Social share</h5>
                            <ul class="type3 dt-sc-social-icons">
                                <?php /*foreach (falseToArray($socials) as $social): */?>
                                    <li class="<?php /*echo $social["Name"] ;*/?>"><a style="background-color: <?php /*echo decodeSecurity($social["BackgroundColor"]); */?>"  href="<?php /*echo $social["Link"] ;*/?>"> <?php /*echo decodeSecurity($social["Icon"]); */?> </a></li>
                                <?php /*endforeach; */?>
                            </ul>
                        </div>
                    </div>
                </aside>-->
                <div class="commententries"><!-- *commententries starts here** -->
                    <h4> Yorumlar ( <?php echo count(falseToArray($comments)); ?> ) </h4>
                    <ul class="commentlist"><!-- *commentlist starts here** -->
                        <?php foreach (falseToArray($comments) as $comment): ?>
                        <li>
                            <div class="comment">
                                <header class="comment-author">
                                    <img title="" alt="image" src="http://placehold.it/85x85&amp;text=<?php echo $comment["Name"]; ?>">
                                </header>
                                <div class="comment-details">
                                    <div class="author-name">
                                        <span><?php echo $comment["Name"]; ?></span>
                                    </div>
                                    <div class="commentmetadata"><span>/</span> <?php echo $comment["Email"]; ?></div>
                                    <div class="comment-body">
                                        <div class="comment-content">
                                            <p><?php echo $comment["Comment"]; ?></p>
                                            <div class="author-metadata">
                                                <p><span class="fa fa-folder-open"> </span><a href="<?php echo $product["CategoryUrl"]; ?>"> <?php echo $product["CategoryName"]; ?></a></p>
                                                <p><span class="fa fa-calendar"></span><span> <?php echo trDate($comment["PostDate"]); ?> </span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul><!-- *commentlist Ends here** -->
                </div><!-- *commententries Ends here** -->
                <div id="respond">
                    <h3> LÜTFEN ÜRÜN HAKKINDA YORUMUNUZU BELİRTİNİZ </h3>
                    <form id="commentform" action="messagePost" method="post" novalidate="novalidate" name="enqform">
                        <input type="hidden" name="type" value="0">
                        <input type="hidden" name="itemID" value="<?php echo $product["ID"]; ?>">
                        <div class="column dt-sc-one-third first">
                            <p class="input-text">
                                <input class="input-field" type="text" required="" name="name" title="Lütfen Adınızı Giriniz" placeholder="Adınız *">
                            </p>
                        </div>
                        <div class="column dt-sc-one-third">
                            <p class="input-text">
                                <input class="input-field" type="email" required="" autocomplete="off" name="email" title="Lütfen Email Giriniz" placeholder="Emailiniz *">
                            </p>
                        </div>
                        <div class="column dt-sc-one-third">
                            <p class="input-text">
                                <input class="input-field" type="text" required="" name="phone" autocomplete="off" title="Lütfen Telefon Numarası Giriniz" placeholder="Telefonunuz *">
                            </p>
                        </div>
                        <p class="input-text">
                            <textarea class="input-field" required="" rows="3" cols="5" name="message" title="Lütfen Mesajınızı Giriniz" placeholder="Mesaj *"></textarea>
                        </p>

                        <p class="submit"> <input type="submit" value="Yorum Ekle" name="submit" class="button"> </p>
                    </form>
                    <div id="ajax_contactform_msg"></div>
                </div>
            </div>
            <div class="dt-sc-two-fifth column">
                <!-- Author Detail Starts Here -->
                <div class="post-author-details">
                    <div class="author-title">
                        <h5><span><?php echo $product["Name"]; ?></span></h5>
                        <span><a href="<?php echo $product["CategoryUrl"]; ?>"><?php echo $product["CategoryName"]; ?></a></span>
                    </div>
                    <div class="author-desc">
                        <p><?php echo decodeSecurity($product["Content"]); ?></p>
                    </div>
                </div>
                <!-- Author Detail Ends Here -->
                <div class="dt-sc-project-details">
                    <h5>İletişim</h5>
                    <ul class="type3 dt-sc-social-icons">
                        <?php foreach (falseToArray($socials) as $social): ?>
                            <li class="<?php echo $social["Name"] ;?>"><a style="background-color: <?php echo decodeSecurity($social["BackgroundColor"]); ?>"  href="<?php echo $social["Link"] ;?>"> <?php echo decodeSecurity($social["Icon"]); ?> </a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="project-details">
                    <ul class="client-details">
                        <li>
                            <p><span>Ürün :</span><?php echo $product["Name"]; ?></p>
                        </li>
                        <li>
                            <p><span>Kategori :</span><?php echo $product["CategoryName"]; ?></p>
                        </li>
                        <li>
                            <p><span>Açıklama :</span><?php echo $product["Description"]; ?></p>
                        </li>
                        <li>
                            <p><span>Yüklenme Tarihi :</span><?php echo trDate($product["PostDate"]); ?> </p>
                        </li>
                        <li>
                            <p><span>Görüntülenme :</span><i class="fa fa-eye"></i><?php echo $product["Views"]; ?></p>
                        </li>
                        <li>
                            <p>
                                <span>Etiketler :</span>
                            </p><div class="tagcloud type3">
                                <?php foreach (falseToArray($tags) as $tag): ?>
                                    <a href="<?php echo $productsAction . "/" . $tag["Name"]; ?>" ><?php echo $tag["Name"] ;?></a>
                                <?php endforeach; ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!-- *cart-wrapper Ends here** -->
    </div>
</section>