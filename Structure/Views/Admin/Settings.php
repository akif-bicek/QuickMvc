<?php adminHeaderAction(["blog","Blog"], ["sd","ad"], "Blog" ,"blog-add"); ?>
<div class="container-fluid">
    <div class="default-tab card">
        <ul class="nav nav-tabs mb-3 card-body bg-dark" role="tablist">
            <li class="nav-item"><a class="nav-link btn btn-primary active show" data-toggle="tab" href="#home"><?php sc("settings"); ?></a>
            </li>
            <li class="nav-item"><a class="nav-link btn btn-primary" data-toggle="tab" href="#profile"><?php sc("contact"); ?></a>
            </li>
            <li class="nav-item"><a class="nav-link btn btn-primary" data-toggle="tab" href="#contact"><?php sc("products-page"); ?></a>
            </li>
            <li class="nav-item"><a class="nav-link btn btn-primary" data-toggle="tab" href="#message"><?php sc("reference-page"); ?></a>
            </li>
            <li class="nav-item"><a class="nav-link btn btn-primary" data-toggle="tab" href="#se"><?php sc("about-page"); ?></a>
            </li>
            <li class="nav-item"><a class="nav-link btn btn-primary" data-toggle="tab" href="#sl"><?php sc("main-page"); ?></a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active show" id="home" role="tabpanel">
                <?php
                $themes = [
                    ["Theme" => "dark"],
                    ["Theme" => "light"]
                ];
                $skins = [
                    ["Skin" => "avocado"],
                    ["Skin" => "blue"],
                    ["Skin" => "blueiris"],
                    ["Skin" => "blueturquoise"],
                    ["Skin" => "brown"],
                    ["Skin" => "burntsienna"],
                    ["Skin" => "chillipepper"],
                    ["Skin" => "chocolate"],
                    ["Skin" => "eggplant"],
                    ["Skin" => "electricblue"],
                    ["Skin" => "grassgreen"],
                    ["Skin" => "gray"],
                    ["Skin" => "green"],
                    ["Skin" => "orange"],
                    ["Skin" => "palebrown"],
                    ["Skin" => "pink"],
                    ["Skin" => "radiantorchid"],
                    ["Skin" => "red"],
                    ["Skin" => "skyblue"],
                    ["Skin" => "yellow"]
                ];
                adminForms([
                    ["ID", "hidden", "ID"],
                    ["MainSliderOrder", "checkbox", "main-slider-order"],
                    ["MultilingualSystem", "checkbox", "multilingunal-system"],
                    ["AnalyticsCode", "textbox", "Google Analytics Code"],
                    ["SiteName", "text", "site-name"],
                    ["Logo", "image", "Logo"],
                    ["LoaderImage", "image", "loader-image"],
                    ["Icon", "image", "icon"],
                    ["LoaderLeft", "text", "loader-left-text"],
                    ["LoaderRight", "text", "loader-right-text"],
                    ["Copyright", "text", "copyright-text"],
                    ["Skin", "select", "site-skin", "selectDatas" => $skins, "selectValKey" => "Skin", "selectDisplayKey" => "Skin"],
                    ["Theme", "select", "site-theme", "selectDatas" => $themes, "selectValKey" => "Theme", "selectDisplayKey" => "Theme"],
                    ["Whatsapp", "text", "Whatsapp"]
                ], "editSettings", $settings);
                ?>
            </div>
            <div class="tab-pane fade" id="profile">
                <?php
                adminForms([
                    ["ID", "hidden", "ID"],
                    ["Address", "textarea", "address"],
                    ["Phone", "text", "phone"],
                    ["Email", "email", "email"],
                    ["Map", "textarea", "map-code"],
                    ["ContactTitle", "text", "contact-title"],
                    ["ContactKeywords", "tags", "contact-keywords"],
                    ["ContactDesc", "textarea", "contact-desciription"],
                    ["ContactContent", "editor", "contact-content"]
                ], "editContact", $settings);
                ?>
            </div>
            <div class="tab-pane fade" id="contact">
                <?php
                adminForms([
                    ["ID", "hidden", "ID"],
                    ["ProductsTitle", "text", "products-title"],
                    ["ProductsKeyword", "tags", "products-keywords"],
                    ["ProductsDesc", "textarea", "products-desciription"],
                ], "editProductsPage", $settings);
                ?>
            </div>
            <div class="tab-pane fade" id="message">
                <?php
                adminForms([
                    ["ID", "hidden", "ID"],
                    ["ReferencesTitle", "text", "references-title"],
                    ["ReferencesKeywords", "tags", "references-keywords"],
                    ["ReferencesDesc", "textarea", "references-desc"]
                ], "editReferencesPage", $settings);
                ?>
            </div>
            <div class="tab-pane fade" id="se">
                <?php
                adminForms([
                    ["ID", "hidden", "ID"],
                    ["AboutTitle", "text", "references-title"],
                    ["AboutKeywords", "tags", "references-keywords"],
                    ["AboutDesc", "textarea", "references-desc"],
                ], "editAboutPage", $settings);
                ?>
            </div>
            <div class="tab-pane fade" id="sl">
                <?php
                adminForms([
                    ["ID", "hidden", "ID"],
                    ["MainPageTitle", "text", "references-title"],
                    ["MainPageKeywords", "tags", "references-keywords"],
                    ["MainPageDescription", "textarea", "references-desc"],
                ], "editMainPage", $settings);
                ?>
            </div>
        </div>
    </div>
</div>