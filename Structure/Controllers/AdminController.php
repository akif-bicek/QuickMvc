<?php
class AdminController extends System{
    const layout = "Admin/Admin";
    public function __construct()
    {
        //route("https://sanatetkinligi.com/");
        /*$sidebar = [
            "belirteç",
            "dashboard" => [
                "icon" => "plus",
                "pages" => ""
            ],
            "key" => [
                "icon" => "plus",
                "pages" => ["page" => "link"]
            ],
        ];*/
        $sidebar = [
            "Dashboard",
            "Dashboard" => [
                "pages" => "",
                "icon" => "tachometer"
            ],
            "main-actions",
            "Blog" => [
                "icon" => "pencil",
                "pages" => [
                    "Blog" => "blog",
                    "categories" => "categories/1"
                ]
            ],
            "Pages" => [
                "icon" => "file-text",
                "pages" => "pages"
            ],
            "References" => [
                "icon" => "handshake-o",
                "pages" => "references"
            ],
            "Messages" => [
                "icon" => "envelope",
                "pages" => "messages"
            ],
            "quicklinks" => [
                "icon" => "share-square",
                "pages" => "quickLinks"
            ],
            "socialmedia" => [
                "icon" => "globe",
                "pages" => "socialMedias"
            ],
            "about-settings" => [
                "icon" => "address-card",
                "pages" => [
                    "about-content" => "aboutContent",
                    "team" => "team"
                ]
            ],
            "products",
            "products" => [
                "icon" => "cubes",
                "pages" => [
                    "products" => "products",
                    "categories" => "categories/0"
                ]
            ],
            "multi-upload" => [
                "icon" => "plus-circle",
                "pages" => [
                    "multi-product-upload" => "multiProductUpload",
                    "multi-category-upload" => "multiCategoryUpload",
                ]
            ],
            "settings",
            "mainpage-settings" => [
                "icon" => "map",
                "pages" => [
                    "mainslider" => "mainslider",
                    "main-categories" => "mainCategories",
                    "mainpage-about" => "mainPageAboutContent"
                ]
            ],
            "general-settings" => [
                "icon" => "wrench",
                "pages" => [
                    "navbar-links" => "navbarLinks",
                    "footer-links" => "footerLinks"
                ]
            ],
            /*"preferences"  => [
                "icon" => "sliders",
                "pages" => "preferences"
            ],*/
            "language-settings" => [
                "icon" => "flag",
                "pages" => [
                    "Language" => "languages",
                    "translates" => "translates"
                ]
            ],
            "system-settings" => [
                "icon" => "cogs",
                "pages" => [
                    "settings" => "settings",
                    "urls" => "urls"
                ]
            ],
        ];
        $this->layoutDatas = array(
            "messages" => MessagesModel::unreadMessages(),
            "languages" => LanguagesModel::languages(),
            "title" => SettingsModel::settingsVal("SiteName") . " - AdminPanel",
            "sidebar" => $sidebar
        );
    }

    public function multiProductUpload(){
        $this->view("Admin/MultiUpload", [
            "languages" => LanguagesModel::languages(),
            "categories" => CategoriesModel::categories()
        ]);
    }

    public function multiProductAdd(){
        $categoryID = postParameter("categoryID");
        $langID = postParameter("langID");
        $products = multiFileUpload();
        multiUploadProducts($products, $categoryID, $langID);
        arrayDie($products);
        route("./products");
    }

    function multiCategoryUpload(){
        $this->view("Admin/MultiCategoryUpload", [
            "languages" => LanguagesModel::languages()
        ]);
    }

    function multiCategoryAdd(){
        $langID = postParameter("langID");
        $categories = multiFileUpload();
        multiUploadCategories($categories, $langID);
        route("./categories");
    }

    public function index(){
        $this->view("Admin/Dashboard");
    }
    public function aboutContent(){
        $aboutContent = SettingsModel::settingsVal("AboutContent");
        $this->view("Admin/AboutContent", ["aboutContent" => $aboutContent]);
    }

    public function editAboutContent(){
        $aboutContent = postParameter("content");
        if (SettingsModel::editSettingVal("AboutContent", $aboutContent)){
            //toastr
        }
        route("./aboutContent");
    }
    public function mainPageAboutContent(){
        $aboutContent = SettingsModel::settingsVal("MainPageAboutContent");
        $path = SettingsModel::settingsVal("MainPageAboutImage");
        $this->view("Admin/MainPageAboutContent", [
            "values" => [
                "content" => $aboutContent,
                "path" => $path,
            ]]);
    }

    public function editMainPageAboutContent(){
        $aboutContent = postParameter("content");
        $path = upload(postFile("path"), "image", language, 502, 533);
        SettingsModel::editSettingVal("MainPageAboutContent", $aboutContent);
        SettingsModel::editSettingVal("MainPageAboutImage", $path);
        //toastr
        route("./mainPageAboutContent");
    }

    public function navbarLinks(){
        $this->view("Admin/NavbarLinks", ["navbar" => NavbarFooterLinksModel::navbarLinks()]);
    }

    public function navbarLinkAdd(){
        $this->view("Admin/NavbarLinkAdd", ["languages" => LanguagesModel::languages(), "links" => UrlsModel::linkUrls()]);
    }

    public function addNavbarLink(){
        $text = postParameter("text");
        $link = postParameter("link");
        $sequance = postParameter("sequance");
        $langID = postParameter("langID");
        if (NavbarFooterLinksModel::add(0, $text, $link, $sequance, $langID)){
            //TOASTR
        }
        route("./navbarLinks");
    }

    public function footerLinks(){
        $this->view("Admin/FooterLinks", ["footer" => NavbarFooterLinksModel::footerLinks()]);
    }

    public function footerLinkAdd(){
        $this->view("Admin/FooterLinkAdd", ["languages" => LanguagesModel::languages()]);
    }

    public function addFooterLink(){
        $text = postParameter("text");
        $link = postParameter("link");
        $sequance = postParameter("sequance");
        $langID = postParameter("langID");
        if (NavbarFooterLinksModel::add(1, $text, $link, $sequance, $langID)){
            //TOASTR
        }
        route("./footerLinks");
    }

    public function translates($params){
        $search = security($params[0] ?? "");
        $this->view("Admin/Translates", ["translates" => SettingsModel::systemContents($search)]);
    }

    public function editTranslates(){
        $posts = getPosts(true);
        if (SettingsModel::editSystemContents($posts)){
            //toastr
        }
        route("./translates");
    }

    public function settings(){
        $this->view("Admin/Settings", ["settings" => SettingsModel::settings()]);
    }

    public function editSettings(){
        $id = postParameter("ID");
        $MainsliderOrder = postParameter("MainSliderOrder");
        $MultilingualSystem = postParameter("MultilingualSystem");
        $AnalyticsCode = postParameter("AnalyticsCode");
        $SiteName = postParameter("SiteName");
        $Logo = upload(postFile("Logo"), "image", language, 200, 55);
        $Icon = upload(postFile("Icon"), "image", language, 30, 30);
        $LoaderImage = upload(postFile("LoaderImage"), "image", language, 110, 196);
        $LoaderLeft = postParameter("LoaderLeft");
        $LoaderRight = postParameter("MainSliderOrder");
        $Copyright = postParameter("Copyright");
        $Skin = postParameter("Skin");
        $Theme = postParameter("Theme");
        $Whatsapp = postParameter("Whatsapp");
        if (editData("settings",
            "MainSliderOrder,MultilingualSystem,AnalyticsCode,SiteName,Logo,Icon,LoaderImage,LoaderLeft,MainSliderOrder,Copyright,Skin,Theme,Whatsapp",
            $id, $MainsliderOrder, $MultilingualSystem, $AnalyticsCode, $SiteName,
            $Logo, $Icon, $LoaderImage, $LoaderLeft, $LoaderRight, $Copyright, $Skin, $Theme, $Whatsapp
        )){
            //toastr
        }
    }

    public function editContact(){
        $id = postParameter("ID");
        $Address = postParameter("Address");
        $Phone = postParameter("Phone");
        $Email = postParameter("Email");
        $Map = postParameter("Map");
        $ContactTitle = postParameter("ContactTitle");
        $ContactKeywords = postParameter("ContactKeywords");
        $ContactDesc = postParameter("ContactDesc");
        $ContactContent = postParameter("ContactContent");
        if (editData("settings", "Address,Phone,Email,Map,ContactTitle,ContactKeywords,ContactDesc,ContactContent",
            $id, $Address, $Phone, $Email, $Map, $ContactTitle, $ContactKeywords, $ContactDesc, $ContactContent
        )){
            //TOASTR
        }
    }

    public function editProductsPage(){
        $id = postParameter("ID");
        $ProductsTitle = postParameter("ProductsTitle");
        $ProductsKeyword = postParameter("ProductsKeyword");
        $ProductsDesc = postParameter("ProductsDesc");
        if (editData("settings", "ProductsTitle,ProductsKeyword,ProductsDesc", $id,
            $ProductsTitle, $ProductsKeyword, $ProductsDesc)){
            //TOASTR
        }
    }

    public function editReferencesPage(){
        $id = postParameter("ID");
        $ReferencesTitle = postParameter("ReferencesTitle");
        $ReferencesKeywords = postParameter("ReferencesKeywords");
        $ReferencesDesc = postParameter("ReferencesDesc");
        if (editData("settings", "ReferencesTitle,ReferencesKeywords,ReferencesDesc", $id,
            $ReferencesTitle, $ReferencesKeywords, $ReferencesDesc)){
            //TOASTR
        }
    }

    public function editAboutPage(){
        $id = postParameter("ID");
        $AboutTitle = postParameter("AboutTitle");
        $AboutKeywords = postParameter("AboutKeywords");
        $AboutDesc = postParameter("AboutDesc");
        if (editData("settings", "AboutTitle,AboutKeywords,AboutDesc", $id,
            $AboutTitle, $AboutKeywords, $AboutDesc)){
            //TOASTR
        }
    }

    public function editMainPage(){
        $id = postParameter("ID");
        $mainPageTitle = postParameter("MainPageTitle");
        $mainPageDesc = postParameter("MainPageDescription");
        $mainPageKeywords = postParameter("MainPageKeywords");
        if (editData("settings","MainPageTitle,MainPageDescription,MainPageKeywords", $id, $mainPageTitle, $mainPageDesc, $mainPageKeywords)){
            //TOASTR
        }
    }

    public function mainCategories(){

    }

    // Team Read
    public function team(){
        $this->view("Admin/Team", ["team" => TeamModel::team()]);
    }

    public function teamAdd(){
        $this->view("Admin/TeamAdd", ["languages" => LanguagesModel::languages()]);
    }

    public function teamEdit($params){
        $id = numbersFilter($params[0]);
        $team = TeamModel::teamRow($id);
        $this->view("Admin/TeamEdit", ["team" => $team ,"languages" => LanguagesModel::languages()]);
    }

    function deleteTeam($params){
        $id = numbersFilter($params[0]);
        if (TeamModel::deleteTeam($id)){
            //TOASTR
        }
        route("../team");
    }

    public function addTeam(){
        $name = postParameter("name");
        $content = postParameter("content");
        $path = upload(postFile("path"), "image", language, 200, 200);
        $langID = postParameter("langID");
        if (TeamModel::addTeam($name, $content, $path, $langID)){
            // TOASTR
        }
        route("./team");
    }

    public function editTeam($params){
        $id = numbersFilter($params[0]);
        $name = postParameter("name");
        $content = postParameter("content");
        $path = postParameter("path");
        $langID = postParameter("langID");
        if (TeamModel::editTeam($id, $name, $content, $path, $langID)){
            // TOASTR
        }
        route("./teamEdit/" . $id);
    }

    // Blog Read
    public function blog($params){
        if (!empty($params[0])){
            if (is_numeric(numbersFilter($params[0]))){
                $ofset = $params[0] ?? 0;
                $search = "";
            }else{
                $ofset = $params[1] ?? 0;
                $search = urldecode($params[0]);
            }
        }else{
            $search = "";
            $ofset = $params[0] ?? 0;
        }
        $limit = 12;
        $this->view("Admin/Blog", [
            "blogs" => BlogsModel::blog(numbersFilter($ofset) * $limit, $limit, $search),
            "categories" => CategoriesModel::categories(1),
        ]);
    }
    public function blogEdit($params){
        $id = numbersFilter($params[0]);
        $this->view("Admin/BlogEdit", [
            "blog" => routeControl(BlogsModel::blogEdit($id), "./blog"),
            "tags" => TagsModel::tags(2, null, $id),
            "categories" => CategoriesModel::categories(1),
            "languages" => LanguagesModel::languages()
        ]);
    }
    public function blogAdd(){
        $this->view("Admin/BlogsAdd", [
            "languages" => LanguagesModel::languages(),
            "categories" => CategoriesModel::categories(1)
        ]);
    }
    // Blog Delete
    public function blogDelete($params){
        $id = numbersFilter($params[0]);
        $urlID = BlogsModel::getBlogUrl($id);
        if (UrlsModel::deleteUrl($urlID)){
            if (BlogsModel::deleteBlog($id)){
                //TOASTR
            }
        }
        $this->blog([]);
    }
    // Blog Update
    public function editBlog(){
        $id = postParameter("id", true);
        $title = postParameter("title");
        $beforeTitle = postParameter("beforeTitle");
        $desc = postParameter("description");
        $keywords = postParameter("keywords");
        $author = postParameter("author");
        $path = upload(postFile("path"), "image", language, 870, 510);
        $beforePath = postParameter("beforePath");
        $content = postParameter("content");
        $langID = postParameter("langID", true);
        $urlID = BlogsModel::getBlogUrl($id);
        $tags = postParameter("tags");
        $categoryID = postParameter("categoryID");
        if ($beforeTitle != $title){
            $urlsave = saveUrl("edit", $title, $urlID, $langID);
        }else{
            $urlsave = true;
            saveUrl("edit", $title, $urlID, $langID);
        }
        if($urlsave){
            saveTags("edit", $tags, 2, $id, $langID);
            if (BlogsModel::editBlog($id, $title, $desc, $keywords, $author, $path, $content, $categoryID, $langID)){
                if (($path != false) and ($path != $beforePath)){
                    deleteUpload($beforePath);
                }
                //TOASTR
            }
        }
        $this->blogEdit([$id]);
    }
    // Blog Create
    public function addBlog(){
        $title = postParameter("title");
        $desc = postParameter("description");
        $keywords = postParameter("keywords");
        $author = postParameter("author");
        $path = upload(postFile("path"), "image", language, 870, 510);
        $content = postParameter("content");
        $langID = postParameter("langID", true);
        $tags = postParameter("tags");
        $categoryID = postParameter("categoryID");
        if(BlogsModel::addBlog($title, $desc, $keywords, $author, $path, $content, $categoryID, $langID, $tags)){
            //TOASTR
        }
        $this->blog([]);
    }
    // Categories Read
    public function categories($params){
        $type = numbersFilter($params[0] ?? 0);
        $this->view("Admin/Categories", ["type" => $type,"categories" => CategoriesModel::categories($type)]);
    }
    public function categoriesEdit($params){
        $id = numbersFilter($params[0]);
        $this->view("Admin/CategoriesEdit", [
            "category" => CategoriesModel::category($id),
            "languages" => LanguagesModel::languages(),
            "images" => imagegelecek
        ]);
    }
    public function categoriesAdd($params){
        $type = numbersFilter($params[0] ?? 0);
        $this->view("Admin/CategoriesAdd", ["type" => $type,"languages" => LanguagesModel::languages()]);
    }
    // Delete Category
    public function deleteCategory($params){
        // toastr error message is procudct
        $id = numbersFilter($params[0]);
        if (CategoriesModel::deleteCategory($id)){
            if(CategoriesModel::deleteCategoryImages($id)){
                // Toastr success
            }
        }
    }
    // Update Category
    public function editCategory(){
        $id = postParameter("id", true);
        $name = postParameter("name");
        $desc = postParameter("desc");
        $keywords = postParameter("keywords");
        $content = postParameter("content");
        $type = postParameter("type");
        $langID = postParameter("langID");
        $urlID = CategoriesModel::getCategoryUrl($id);
        $tags = postParameter("tags");
        if(saveUrl("edit", $name, $urlID, $langID)){
            if (CategoriesModel::editCategory($id, $name, $desc, $keywords, $content, $type, $langID)){
                saveTags("edit", $tags, $type, $id, $langID);
                //TOASTR
            }
        }
    }
    // Create Category
    public function addCategory(){
        $name = postParameter("name");
        $desc = postParameter("desc");
        $keywords = postParameter("keywords");
        $content = postParameter("content");
        $type = postParameter("type");
        $langID = postParameter("langID");
        $tags = postParameter("tags");
        if(CategoriesModel::addCategory($name, $desc, $keywords, $content, $type, $langID, $tags, "images")){
            //TOASTR
        }
        route("./categories/{$type}");
    }
    // Read Products
    public function products($params){
        if (!empty($params[0])){
            if (is_numeric(numbersFilter($params[0]))){
                $ofset = $params[0] ?? 0;
                $search = "";
            }else{
                $ofset = $params[1] ?? 0;
                $search = $params[0];
            }
        }else{
            $search = "";
            $ofset = $params[0] ?? 0;
        }
        $limit = 12;
        $this->view("Admin/Products", [
            "products" => ProductsModel::products($limit, numbersFilter($ofset) * $limit, $search),
            "categories" => CategoriesModel::categories(),
            /*"prev" => ($ofset != 0) ? ($ofset - 1) : 0 . "/" .$search,
            "next" => $ofset . "/" . $search,*/
        ]);
    }
    public function productsEdit($params){
        $id = numbersFilter($params[0]);
        $this->view("Admin/ProductsEdit", [
            "product" => ProductsModel::getProduct($id),
            "categories" => CategoriesModel::categories(0),
            "languages" => LanguagesModel::languages(),
            "images" => imagesgelecek
        ]);
    }
    public function productsAdd(){
        $this->view("Admin/ProductsAdd", [
            "categories" => CategoriesModel::categories(0),
            "languages" => LanguagesModel::languages(),
        ]);
    }
    // Delete Product
    public function deleteProduct($params){
        $id = numbersFilter($params[0]);
        if(ProductsModel::deleteProduct($id)){
            if (ProductsModel::deleteImages($id)){
                //TOASTR
            }
        }
    }
    // Update Product
    public function editProduct(){
        $id = postParameter("id");
        $name = postParameter("name");
        $desc = postParameter("desc");
        $keywords = postParameter("keywords");
        $categoryID = postParameter("categoryID");
        $content = postParameter("content");
        $langID = postParameter("langID");
        $tags = postParameter("tags");
        $urlID = ProductsModel::getProductUrl($id);
        if (saveUrl("edit", $name, $urlID, $langID)){
            if (ProductsModel::editProduct($id,$name, $desc, $keywords, $categoryID, $content, $langID)){
                saveTags("edit", $tags, 0, $id, $langID);
                // TOASTR
            }
        }
    }
    public function addProduct(){
        $name = postParameter("name");
        $desc = postParameter("desc");
        $keywords = postParameter("keywords");
        $categoryID = postParameter("categoryID");
        $content = postParameter("content");
        $langID = postParameter("langID");
        $tags = postParameter("tags");
        if (ProductsModel::addProduct($name, $desc, $keywords, $categoryID, $content, $langID, $tags, "images")){
            // TOASTR
        }
        route("./products");
    }
    // Read Languages
    public function languages(){
        $this->view("Admin/language", ["languages" => LanguagesModel::languages()]);
    }
    public function languageEdit($params){
        $id = numbersFilter($params[0]);
        $this->view("Admin/LanguageEdit", ["language" => LanguagesModel::language($id)]);
    }
    public function languageAdd(){
        $this->view("Admin/LanguageAdd");
    }
    // Language Delete
    public function languageDelete($params){
        $id = numbersFilter($params[0]);
        if(LanguagesModel::deleteLanguage($id)){
            route("../languages");
            //TOASTR
        }
    }
    // Language Default
    public function defaultLanguage($params){
        $id = numbersFilter($params[0]);
        if (LanguagesModel::defaultLanguage($id)){
            //TOASTR
        }
        route("../languages");
    }
    // Language Edit
    public function editLanguage(){
        $id = postParameter("id", true);
        $name = postParameter("name");
        $short = postParameter("short");
        $tag = postParameter("tag");
        if (LanguagesModel::editLanguage($id, $name, $short, $tag)){
            //TOASTR
        }
        $this->languageEdit([$id]);
    }
    public function addLanguage(){
        $name = postParameter("name");
        $short = postParameter("short");
        $tag = postParameter("tag");
        if (LanguagesModel::addLanguage($name, $short, $tag)){
            //TOASTR
        }
        $this->languages([]);
    }
    // MainsSlider Read
    public function mainslider(){
        $this->view("Admin/MainSlider", [
            "mainslider"=> MainSliderModel::mainSlider(SettingsModel::settingsVal("MainSliderOrder")),
        ]);
    }
    public function mainsliderAdd(){
        $this->view("Admin/MainSliderAdd", [
            "languages" => LanguagesModel::languages()
        ]);
    }
    public function addMainSlider(){
        $title = postParameter("title");
        $caption = postParameter("caption");
        $sequence = postParameter("sequence");
        $path = upload(postFile("path"), "image", language);
        $langID = postParameter("langID");
        if (MainSliderModel::addMainSlider($title, $caption, $sequence, $path, $langID)){
            //toastr
        }
        route("./mainslider");
    }
    public function mainSliderEdit($params){
        $id = numbersFilter($params[0]);
        $this->view("Admin/MainsliderEdit", [
            "languages" => LanguagesModel::languages(),
            "mainslider" => MainSliderModel::getMainslider($id)
        ]);
    }
    public function editMainSlider(){
        $id = postParameter("ID");
        $title = postParameter("title");
        $caption = postParameter("caption");
        $sequence = postParameter("sequence");
        $path = upload(postFile("path"), "image", language);
        $langID = postParameter("langID");
        if (MainSliderModel::editMainSlider($id, $title, $caption, $sequence, $path, $langID)){
            //toastr
        }
        route("./mainslider");
    }
    public function deleteMainSlider($params){
        $id = numbersFilter($params[0]);
        if (deleteData("mainslider", $id)){
            //toastr
        }
        route("./mainslider");
    }
    public function messages($params){
        $offset = $params[0] ?? 0;
        $limit = 25;
        $this->view("Admin/Messages", ["messages" => MessagesModel::messagesList(numbersFilter($offset), $limit)]);
    }
    public function messageDetail($params){
        $id = $params[0] ?? $this->index().die();
        $this->view("Admin/MessageDetail", ["message" => MessagesModel::message($id)]);
    }
    public function messageDelete($params){
        $id = numbersFilter($params[0]);
        if(MessagesModel::messageDelete($id)){
            //TOASTR
        }
        $this->messages([]);
    }
    // Page Read
    public function pages($params){
        $ofset = $params[0] ?? 0;
        $limit = 25;
        $this->view("Admin/Pages",[
            "pages" => PagesModel::pages(numbersFilter($ofset) * $limit, $limit)
        ]);
    }
    public function pageEdit($params){
        $id = numbersFilter($params[0]);
        $this->view("Admin/PageEdit", [
            "page" => PagesModel::page($id),
            "languages" => LanguagesModel::languages()
        ]);
    }
    public function pageAdd(){
        $this->view("Admin/PageAdd", ["languages" => LanguagesModel::languages()]);
    }
    // Page Delete
    public function pageDelete($params){
        $id = numbersFilter($params[0]);
        $urlID = PagesModel::getPageUrl($id);
        if (UrlsModel::deleteUrl($urlID)){
            if (PagesModel::deletePage($id)){
                //TOASTR
            }
        }
        $this->pages([]);
    }
    // Page Update
    public function editPage(){
        $id = postParameter("id", true);
        $name = postParameter("name");
        $content = postParameter("content");
        $title = postParameter("title");
        $desc = postParameter("desc");
        $keywords = postParameter("keywords");
        $langID = postParameter("langID", true);
        $urlID = PagesModel::getPageUrl($id);
        if(saveUrl("edit", $title, $urlID, $langID)){
            if (PagesModel::editPage($id, $name, $content, $title, $desc, $keywords, $langID)){
                //TOASTR
            }
        }
        $this->pageEdit([$id]);
    }
    // Page Create
    public function addPage(){
        $name = postParameter("name");
        $content = postParameter("content");
        $title = postParameter("title");
        $desc = postParameter("desc");
        $keywords = postParameter("keywords");
        $langID = postParameter("langID", true);
        if (PagesModel::addPage($name, $content, $title, $desc, $keywords, $langID)){
            // TOASTR
        }
       route("./pages");
    }
    // References Read
    public function references($params){
        $ofset = $params[0] ?? 0;
        $limit = 10;
        $this->view("Admin/References", ["references" => ReferencesModel::referencesLimts(numbersFilter($ofset) * $limit, $limit)]);
    }
    public function referencesEdit($params){
        $id = numbersFilter($params[0]);
        $this->view("Admin/ReferenceEdit", [
            "reference" => ReferencesModel::reference($id),
            "languages" => LanguagesModel::languages()
        ]);
    }
    public function referenceAdd(){
        $this->view("Admin/ReferenceAdd", ["languages" => LanguagesModel::languages()]);
    }
    // References Delete
    public function referenceDelete($params){
        $id = numbersFilter($params[0]);
        if (ReferencesModel::deleteReferences($id)){
            //TOASTR
        }
    }
    // References Update
    public function editReference(){
        $id = postParameter("id", true);
        $name = postParameter("name");
        $title = postParameter("title");
        $path = upload(postFile("path"), "image", language);
        $category = postParameter("category");
        $langID = postParameter("langID", true);
        if (ReferencesModel::editReference($id, $name, $title, $path, $category, $langID)){
            //TOASTR
        }
        $this->referencesEdit([$id]);
    }
    // References Create
    public function addReference(){
        $name = postParameter("name");
        $title = postParameter("title");
        $path = upload(postFile("path"), "image", language);
        $category = postParameter("category");
        $langID = postParameter("langID", true);
        if (ReferencesModel::addReference($name, $title, $path, $category, $langID)){
            //TOASTR
        }
        $this->references([]);
    }
    // Read QuickLinks
    public function quickLinks(){
        $this->view("Admin/QuickLinks", ["quickLinks" => QuickLinksModel::quickLinks()]);
    }
    public function quickLinkEdit($params){
        $id = numbersFilter($params[0]);
        $this->view("Admin/QuickLinksEdit", ["quicklink" => QuickLinksModel::quickLink($id)]);
    }
    public function quickLinkAdd(){
        $this->view("Admin/QuickLinksAdd", ["links" => UrlsModel::linkUrls()]);
    }
    // Delete QuickLink
    public function deleteQuickLink($params){
        $id = numbersFilter($params[0]);
        if (deleteData("quicklinks", $id)){
            // TOASTR
        }
        $this->quickLinks([]);
    }
    // Update QuickLinks
    public function editQuickLink(){
        $id = postParameter("id", true);
        $name = postParameter("name");
        $link = postParameter("link");
        $icon = postParameter("icon");
        $bgColor = postParameter("bgColor");
        if (QuickLinksModel::editQuickLinks($id, $name, $link, $icon, $bgColor)){
            // TOASTR
        }
        $this->quickLinkEdit([$id]);
    }
    // Create QuickLinks
    public function addQuickLink(){
        $name = postParameter("name");
        $link = postParameter("link");
        $icon = postParameter("icon");
        $bgColor = postParameter("bgColor");
        if (QuickLinksModel::addQuickLinks($name, $link, $icon, $bgColor)){
            // TOASTR
        }
        $this->quickLinks([]);
    }
    // Read SocialMedia
    public function socialMedias(){
        $this->view("Admin/SocialMedia", ["socialMedia" => SocialsModel::socialMedias()]);
    }
    public function socialMediaEdit($params){
        $id = numbersFilter($params[0]);
        $this->view("Admin/SocialMediaEdit", ["socialMedia" => SocialsModel::socialMedia($id)]);
    }
    public function socialMediaAdd(){
        $this->view("Admin/SocialMediaAdd");
    }
    // Delete SocialMedia
    public function deleteSocialMedia($params){
        $id = numbersFilter($params[0]);
        if (deleteData("socialmedia", $id)){
            // TOASTR
        }
        $this->socialMedias([]);
    }
    // Update SocialMedia
    public function editSocialMedia(){
        $id = postParameter("id", true);
        $name = postParameter("name");
        $link = postParameter("link");
        $icon = postParameter("icon");
        $bgColor = postParameter("bgColor");
        if (SocialsModel::editSocialMedia($id, $name, $link, $icon, $bgColor)){
            // TOASTR
        }
        $this->socialMediaEdit([$id]);
    }
    // Create SocialMedia
    public function addSocialMedia(){
        $name = postParameter("name");
        $link = postParameter("link");
        $icon = postParameter("icon");
        $bgColor = postParameter("bgColor");
        if (SocialsModel::addQSocialMedia($name, $link, $icon, $bgColor)){
            // TOASTR
        }
        $this->socialMedias([]);
    }
    // Read Urls
    public function urls($params){
        if (!empty($params[0])){
            if (is_numeric(numbersFilter($params[0]))){
                $ofset = $params[0] ?? 0;
                $search = "";
            }else{
                $ofset = $params[1] ?? 0;
                $search = urldecode($params[0]);
            }
        }else{
            $search = "";
            $ofset = $params[0] ?? 0;
        }
        $limit = 10;
        $this->view("Admin/Urls", ["urls" => UrlsModel::urls($search, numbersFilter($ofset) * $limit, $limit)]);
    }
    public function urlEdit($params){
        $id = numbersFilter($params[0]);
        $this->view("Admin/UrlEdit", ["urlEdit" => UrlsModel::url($id), "languages" => LanguagesModel::languages()]);
    }
    public function urlAdd(){
        $this->view("Admin/UrlAdd", ["languages" => LanguagesModel::languages() ]);
    }
    // Delete Urls
    public function deleteUrl($params){
        $id = numbersFilter($params[0]);
        if (UrlsModel::urlDelete($id)){
            // TOASTR
        }
        $this->urls([]);
    }
    // Update Urls
    public function editUrl(){
        $id = postParameter("id", true);
        $name = postParameter("name");
        $seflink = sefUrlTR($name);
        $action = postParameter("icon");
        $parameters = postParameter("bgColor");
        $langID = postParameter("langID", true);
        if (UrlsModel::urlEdit($id, $name, $seflink, $action, $parameters, $langID)){
            // TOASTR
        }
        $this->urlEdit([$id]);
    }
    // Create Url
    public function addUrl(){
        $name = postParameter("name");
        $seflink = sefUrlTR($name);
        $action = postParameter("action");
        $parameters = postParameter("parameters");
        $langID = postParameter("langID", true);
        if (UrlsModel::urlAdd($name, $seflink, $action, str_replace(",", "&", $parameters), $langID)){
            // TOASTR
        }
        route("./urls");
    }
}
?>