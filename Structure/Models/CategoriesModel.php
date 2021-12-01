<?php
class CategoriesModel {
    public static function mainCategories($ids){
        $categories = getDatas("select * from categories where LangID = ? and ID in ({$ids})", lang);
        foreach (falseToArray($categories) as $key => $category){
            $categories[$key]["Images"] = self::categoriesImages($category["ID"]);
            $categories[$key]["Url"] = self::categoryUrl($category["UrlID"])["SefLink"];
        }
        return $categories;
    }
    public static function categoriesImages($id){
        return getDatas("select * from images where Type = 1 and ItemID = ? order by ID desc", $id);
    }
    public static function categoryUrl($id){
        return getDatas("select ID,SefLink from urls where ID = ? limit 1", $id);
    }
    public static function category($id){
        return getDatas("select * from categories where ID = ? limit 1" , $id);
    }
    public static function categories($type = 0){
        $categories = getDatas("select * from categories where LangID = ? and Type = ? order by ID desc" , lang, $type);
        foreach (falseToArray($categories) as $key => $category){
            $categories[$key]["Url"] = self::categoryUrl($category["UrlID"])["SefLink"];
            $categories[$key]["Path"] = self::getCategoryImage($category["ID"]);
            if ($type == 0){
                $categories[$key]["ProductsCount"] = self::productCount($category["ID"]);
            }else{
                $categories[$key]["BlogCount"] = self::blogCount($category["ID"]);
            }
        }
        return $categories;
    }

    public static function getCategoryImage($id){
        $image = getDatas("select * from images where type = 1 and ItemID = ? order by ID limit 1", $id);
        return $image["Path"];
    }

    public static function blogCount($id){
        return getDatas("select count(ID) as BlogCount from blog where LangID = ? and CategoryID = ?", lang, $id)[0]["BlogCount"];
    }

    public static function productCount($id){
        return getDatas("select count(ID) as ProductsCount from products where LangID = ? and CategoryID = ?", lang, $id)[0]["ProductsCount"];
    }
    public static function productCountNotLang($id){
        return getDatas("select count(ID) as ProductsCount from products where CategoryID = ?", $id)[0]["ProductsCount"];
    }
    public static function deleteCategory($id){
        $productCount = self::productCountNotLang($id);
        if($productCount > 0){
            return false;
        }else{
            return deleteData("categories", $id);
        }
    }
    public static function getCategoryUrl($id){
        $category = getDatas("select ID,UrlID from categories where ID = ? limit 1", $id);
        return $category["UrlID"];
    }
    public static function editCategory($id, $name, $desc, $keywords, $content, $type, $langID){
        return editData(
            "categories",
            "Name,Description,Keywords,Content,Type,LangID",
            $id,
            $name, $desc, $keywords, $content, $type, $langID
        );
    }
    public static function addCategory($name, $desc, $keywords, $content, $type, $langID, $tags, $imagesKey){
        $tagType = 1;
        if ($type == 0){
            $action = "categoryProductsDetail";
        }elseif ($type == 1){
            $tagType = 3;
            $action = "categoryBlogDetail";
        }
        $urlID = saveUrl("add", [
            "title" => $name,
            "action" => $action,
            "langID" => $langID,
            "parameters" => "#"
        ]);
        if ($urlID != false){
            $categoryID = addDataReturnAI(
                "categories",
                "Name,Description,Keywords,Content,Type,Views,LangID,UrlID",
                $name, $desc, $keywords, $content, (int)$type, 0, $langID, $urlID
            );
            if ($categoryID != false){
                saveTags("add", $tags, $tagType, $categoryID, $langID);
                uploadImages($imagesKey, 1, $categoryID);
                return saveUrl("addParams", $categoryID, $urlID);
            }else{
                return false;
            }
        }else{
            return  false;
        }
    }
    public static function deleteCategoryImages($id){
        return runSql("delete from images where Type = 1 and ItemID = ?", $id);
    }
}
?>