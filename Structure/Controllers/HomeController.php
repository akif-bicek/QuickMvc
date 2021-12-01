<?php
class HomeController extends System{
    const layout = "Home";

    private $settings;
    public function __construct()
    {
        $this->settings = SettingsModel::settings();
        $this->layoutDatas = array(
            "settings" => $this->settings,
            "navbar" => NavbarFooterLinksModel::navbarLinks(),
            "footer" => NavbarFooterLinksModel::footerLinks()
        );
    }

    public function index(){
        $this->layoutsVariables = array(
            "title" => $this->settings["MainPageTitle"],
            "desc" => $this->settings["MainPageDescription"],
            "keywords"=> $this->settings["MainPageKeywords"],
        );
        viewCounter("settings", "SiteViews");
        $this->view("Home", [
            "sliders" => MainSliderModel::mainSlider($this->settings["MainSliderOrder"]),
            "lastAdded" => ProductsModel::lastAdded(),
            "categories" => CategoriesModel::mainCategories($this->settings["MainPageCategories"]),
            "aboutImage" => $this->settings["MainPageAboutImage"],
            "aboutContent" => decodeSecurity($this->settings["MainPageAboutContent"]),
            "aboutDesc" => $this->settings["AboutDesc"],
            "aboutTitle" => $this->settings["AboutTitle"],
        ]);
    }
    public function about(){
        $this->layoutsVariables = array(
            "title" => $this->settings["AboutTitle"],
            "desc" => $this->settings["AboutDesc"],
            "keywords" => $this->settings["AboutKeywords"],
        );
        $this->view("About", [
            "content" => decodeSecurity($this->settings["AboutContent"]),
            "team" => TeamModel::team()
        ]);
    }
    public function products($params){
        $this->layoutsVariables = array(
            "title" => $this->settings["ProductsTitle"],
            "desc" => $this->settings["ProductsDesc"],
            "keywords" => $this->settings["ProductsKeyword"],
        );
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
        $limit = 8;
        $this->view("Products", [
            "products" => ProductsModel::products($limit, (numbersFilter($ofset) * $limit), $search),
            "categories" => CategoriesModel::categories(),
            /*"prev" => ($ofset != 0) ? ($ofset - 1) : 0 . "/" .$search,
            "next" => $ofset . "/" . $search,*/
            "categoryPage" => false,
            "socials" => SocialsModel::social(4),
            "tags" => TagsModel::tags(0, 20),
            "search" => $search,
            "productsAction" => UrlsModel::getUrlByAction("products")
        ]);
    }
    public function searchProducts($params){
        $search = postParameter("search");
        /*$tag = postParameter("tag");
        if ($tag != null){
            viewCounter("tags", "Views", $tag);
        }*/
        $params[] = $search;
        $this->products($params);
    }
    public function categoryProductsDetail($params){
        $id = numbersFilter($params[0]);
        $category = CategoriesModel::category($id);
        $this->layoutsVariables = array(
            "title" => $category["Name"],
            "desc" => $category["Description"],
            "keywords" => $category["Keywords"],
        );
        if (!empty($params[1])){
            if (is_numeric(numbersFilter($params[1]))){
                $ofset = $params[1] ?? 0;
                $search = "";
            }else{
                $ofset = $params[2] ?? 0;
                $search = $params[1];
            }
        }else{
            $search = "";
            $ofset = $params[1] ?? 0;
        }
        $limit = 8;
        viewCounter("categories", "Views", $id);
        $this->view("Products", [
            "category" => $category,
            "products" => ProductsModel::products($limit, numbersFilter($ofset) * $limit, $search, $category["ID"]),
            "categories" => CategoriesModel::categories(),
            /*"prev" => ($ofset != 0) ? ($ofset - 1) : 0 . "/" .$search,
            "next" => $ofset . "/" . $search,*/
            "categoryPage" => true,
            "categoryID" => $id,
            "socials" => SocialsModel::social(4),
            "tags" => TagsModel::tags(1, 20, $category["ID"]),
            "categoryImages" => CategoriesModel::categoriesImages($category["ID"]),
            "search" => $search,
            "productsAction" => UrlsModel::getUrlByName($category["Name"])
        ]);
    }
    public function searchProductCategories($params){
        $id = postParameter("categoryID");
        $search = postParameter("search");
        $params[] = $id;
        $params[] = $search;
        $this->categoryProductsDetail($params);
    }
    public function productDetail($params){
        $id = numbersFilter($params[0]);
        $product = ProductsModel::product($id);
        $this->layoutsVariables = array(
            "title" => $product["Name"],
            "desc" => $product["Description"],
            "keywords" => $product["Keywords"],
        );
        viewCounter("products", "Views", $id);
        $this->view("ProductDetail", [
            "product" => $product,
            "images" => ProductsModel::productImage($id ,"no", "desc"),
            "comments" => MessagesModel::messages(0, $id),
            "tags" => TagsModel::tags(0, 20, $id),
            "productsAction" => UrlsModel::getUrlByAction("products"),
            "socials" => SocialsModel::social(10),
        ]);
    }
    public function messagePost() {
        $message = postParameter("message");
        $name = postParameter("name");
        $email = postParameter("email");
        $phone = postParameter("phone");
        $type = postParameter("type", true);
        $time = time();
        $itemID = postParameter("itemID" ,true) ?? 0;
        $posted = MessagesModel::addMessage($message, $name, $email, $phone, $time, $type, $itemID);
        if ($posted){
            echo "Mesajınız Tarafımıza İletilmiştir...";
        }else{
            echo "Bir Aksaklık Oluştu Lütfen Daha Sonra Tekrar Deneyiniz...";
        }
    }
    public function references(){
        $this->layoutsVariables = array(
            "title" => $this->settings["ReferencesTitle"],
            "desc" => $this->settings["ReferencesDesc"],
            "keywords" => $this->settings["ReferencesKeywords"],
        );
        $this->view("References", ["references" => ReferencesModel::references()]);
    }
    public function blog($params){
        $this->layoutsVariables = array(
            "title" => $this->settings["BlogTitle"],
            "desc" => $this->settings["BlogDesc"],
            "keywords" => $this->settings["BlogKeywords"],
        );
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
        $limit = 8;
        $this->view("Blog", [
            "blogs" => BlogsModel::blog(numbersFilter($ofset), $limit, $search),
            "categories" => CategoriesModel::categories(1),
            "prev" => ($ofset != 0) ? ($ofset - 1) : 0 . "/" .$search,
            "next" => $ofset . "/" . $search,
            "categoryPage" => false,
            "socials" => SocialsModel::social(4),
            "tags" => TagsModel::tags(2, 20)
        ]);
    }
    public function searchBlog($params){
        $search = postParameter("search");
        $tag = postParameter("tag");
        if ($tag != null){
            viewCounter("tags", "Views", $tag);
        }
        $params[] = $search;
        $this->blog($params);
    }
    public function blogDetail($params){
        $id = numbersFilter($params[0]);
        $blog = BlogsModel::detailBlog($id);
        $this->layoutsVariables = array(
            "title" => $blog["Title"],
            "desc" => $blog["Description"],
            "keywords" => $blog["Keywords"],
        );
        viewCounter("blog", "Views", $id);
        $this->view("BlogDetail", [
            "blog" => $blog,
            "comments" => MessagesModel::messages(1, $id),
            "tags" => TagsModel::tags(2, 20, $id)
        ]);
    }
    public function categoryBlogDetail($params){
        $id = numbersFilter($params[0]);
        $category = CategoriesModel::category($id);
        $this->layoutsVariables = array(
            "title" => $category["Name"],
            "desc" => $category["Description"],
            "keywords" => $category["Keywords"],
        );
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
        $limit = 8;
        viewCounter("categories", "Views", $id);
        $this->view("Blog", [
            "category" => $category,
            "blog" => BlogsModel::blog(numbersFilter($ofset), $limit, $search, $category["ID"]),
            "categories" => CategoriesModel::categories(),
            "prev" => ($ofset != 0) ? ($ofset - 1) : 0 . "/" .$search,
            "next" => $ofset . "/" . $search,
            "categoryPage" => true,
            "socials" => SocialsModel::social(4),
            "tags" => TagsModel::tags(3, 20, $category["ID"]),
            "categoryImages" => CategoriesModel::categoriesImages($category["ID"])
        ]);
    }
    public function searchBlogCategories($params){
        $search = postParameter("search");
        $tag = postParameter("tag");
        if ($tag != null){
            viewCounter("tags", "Views", $tag);
        }
        $params[] = $search;
        $this->categoryBlogDetail($params);
    }
    public function contact(){
        $this->layoutsVariables = array(
            "title" => $this->settings["ContactTitle"],
            "desc" => $this->settings["ContactDesc"],
            "keywords" => $this->settings["ContactKeywords"]
        );
        $this->view("Contact", [
            "map" => $this->settings["Map"],
            "address" => $this->settings["Address"],
            "phone" => $this->settings["Phone"],
            "email" => $this->settings["Email"],
            "socials" => SocialsModel::social(30),
            "contactContent" => $this->settings["ContactContent"]
        ]);
    }
    public function page($params){
        $id = numbersFilter($params[0]);
        $page = PagesModel::page($id);
        viewCounter("page", "Views", $id);
        $this->layoutsVariables = array(
            "title" => $page["title"],
            "desc" => $page["Description"],
            "keywords" => $page["Keywords"]
        );

    }
}
?>