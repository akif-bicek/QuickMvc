<?php
class UrlsModel {
    public static function deleteUrl($id){
        return deleteData("urls", $id);
    }
    public static function editUrl($id, $title, $langID){
        $seflink = sefUrlTR($title);
        return editData("urls", "Name,SefLink,LangID", $id, $title, $seflink, $langID);
    }
    public static function addUrl($data){
        $seflink = sefUrlTR($data["title"]);
        return addDataReturnAI(
            "urls",
            "Name,SefLink,Action,Parameters,LangID",
            $data["title"], $seflink, $data["action"], $data["parameters"], $data["langID"]
        );
    }
    public static function addParameters($id, $params){
        return editData("urls", "parameters", $id, $params);
    }
    public static function linkUrls(){
        return getDatas("select * from urls where LangID = ?  order by ID desc", lang);
    }
    public static function urls($search, $offset, $limit){
        if ($search != ""){
            $search = "%". $search ."%";
            return getDatas("select * from urls where LangID = ? and Name like ?  order by ID desc limit {$offset}, {$limit}", lang, $search);
        }else{
            return getDatas("select * from urls where LangID = ?  order by ID desc limit {$offset}, {$limit}", lang);
        }
    }
    public static function url($id){
        return getDatas("select * from urls where ID = ? limit 1", $id);
    }
    public static function urlDelete($id){
        $url = self::url($id);
        if ($url["parameters"]  == ""){
            self::deleteUrl($id);
        }else{
            return false;
        }
    }
    public static function urlEdit($id, $name, $seflink, $action, $parameters, $langID){
        return editData(
            "urls",
            "Name,SefLink,Action,Parameters,LangID",
            $id,
            $name, $seflink, $action, $parameters, $langID
        );
    }
    public static function urlAdd($name, $seflink, $action, $parameters, $langID){
        if ($parameters == ""){
            $parameters = null;
        }
        return addData(
            "urls",
            "Name,SefLink,Action,Parameters,LangID",
            $name, $seflink, $action, $parameters, $langID
        );
    }
    public static function urlDeletes($itemID){
        return deleteDatas("urls", "itemID", );
    }
    public static function getUrlByAction($action){
        $action = getDatas("select * from urls where LangID = ? and Action = ? order by ID desc limit 1", lang, $action);
        return $action["SefLink"];
    }
    public static function getUrlByName($name){
        $url = getDatas("select * from urls where LangID = ? and Name = ? order by ID desc limit 1", lang, $name);
        return $url["SefLink"];
    }
}
?>