<?php
class ProductsModel{
    public static function lastAdded(){
        $products = self::products(10);
        $categoryIDs = groupCategories($products);
        $categories = getDatas("select ID,Name from categories where LangID = ? and ID in ({$categoryIDs})",lang);
        return array("products" => $products, "categories" => $categories);
    }
    public static function productImage($id, $limit = "no", $orderby = "asc"){
        $limits = ($limit != "no") ? " limit ".$limit : "";
        return getDatas("select * from images where Type = 0 and ItemID = ? order by ID " . $orderby . $limits,$id);
    }
    public static function productUrl($id){
        return getDatas("select ID,SefLink from urls where ID = ? limit 1", $id);
    }
    public static function products($limit, $ofset = 0, $search = "", $id = 0){
        $products = self::buildProductDatas($id, $limit, $ofset, $search);
        return self::joinProducts($products);
    }
    public static function commentsCount($id){
        return getDatas("select count(ID) as CommentCount from messages where Type = 1 and ItemID = ?", $id)[0]["CommentCount"];
    }
    private static function buildProductDatas($id, $limit, $ofset = 0, $search = ""){
        if ($search != ""){
            $pattern = "%" . $search ."%";
            if ($id != 0){
                $products = getDatas(
                    "select * from products where LangID = ? and CategoryID = ? and
                             Name like ? or Description like ? or Content like ? order by ID DESC limit {$ofset}, {$limit}",
                    lang, $id, $pattern, $pattern, $pattern
                );
            }else{
                $products = getDatas(
                    "select * from products where LangID = ? and 
                             Name like ? or Description like ? or Content like ? order by ID DESC limit {$ofset}, {$limit}",
                    lang, $pattern, $pattern, $pattern
                );
            }
        }else{
            if ($id != 0){
                $products = getDatas(
                    "select * from products where LangID = ? and CategoryID = ? order by ID DESC limit {$ofset}, {$limit}",
                    lang, $id
                );
            }else{
                $products = getDatas("select * from products where LangID = ? order by ID DESC limit {$ofset}, {$limit}", lang);
            }
        }
        return $products;
    }
    private static function joinProducts($products, $noAutoFetch = false){
        foreach (falseToArray($products) as $key => $product){
            $image = self::productImage($product["ID"], 1, 'desc');
            $url = self::productUrl($product["UrlID"]);
            $category = CategoriesModel::category($product["CategoryID"]);
            $categoryUrl = CategoriesModel::categoryUrl($category["UrlID"]);
            $products[$key]["Path"] = $image["Path"];
            $products[$key]["Url"] = $url["SefLink"] ?? "";
            $products[$key]["CategoryName"] = $category["Name"];
            $products[$key]["CategoryUrl"] = $categoryUrl["SefLink"];
            $products[$key]["CommentsCount"] = self::commentsCount($product["ID"]);
        }
        if ($noAutoFetch){
            return $products[0];
        }else{
            return $products;
        }
    }
    public static function product($id){
        return self::joinProducts(getDatasNoAutoFetch("select * from products where LangID = ? and ID = ? limit 1", lang , $id), true);
    }
    public static function getProduct($id){
        return getDatas("select * from products where ID = ? limit 1", $id);
    }
    public static function deleteProduct($id){
        return deleteData("products", $id);
    }
    public static function deleteImages($id){
        return runSql("delete from images where Type = 0 and ItemID = ?", $id);
    }
    public static function getProductUrl($id){
        $product = getDatas("select ID,UrlID from products ID = ? limit 1", $id);
        return $product["UrlID"];
    }
    public static function editProduct($id, $name, $desc, $keywords, $categoryID, $content, $langID){
        return editData(
            "products",
            "Name,Description,Keywords,CategoryID,Content,LangID",
            $id,
            $name, $desc, $keywords, $categoryID, $content, $langID
        );
    }
    public static function addProduct($name, $desc, $keywords, $categoryID, $content, $langID, $tags, $imagesKey){
        $urlID = saveUrl("add", [
            "title" => $name,
            "action" => "productDetail",
            "langID" => $langID,
            "parameters" => "#"
        ]);
        if ($urlID != false){
            $productID = addDataReturnAI(
                "products",
                "Name,Description,Keywords,CategoryID,Content,Views,PostDate,LangID,UrlID",
                $name, $desc, $keywords, $categoryID, $content, 0, time(), $langID, $urlID
            );
            if ($productID != false){
                saveTags("add", $tags, 0, $productID, $langID);
                uploadImages($imagesKey, 0, $productID);
                return saveUrl("addParams", $productID, $urlID);
            }else{
                return false;
            }
        }else{
            return  false;
        }
    }
}
?>