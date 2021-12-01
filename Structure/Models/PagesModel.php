<?php
class PagesModel {
    public static function page($id){
        return getDatas("select * from pages where ID = ? limit 1", $id);
    }
    public static function pages($ofset, $limit){
        return getDatas("select * from pages where LangID = ? order by ID desc limit {$ofset}, {$limit}", lang);
    }
    public static function getPageUrl($id){
        $page = getDatas("select ID,UrlID from pages where ID = ? limit 1", $id);
        return numbersFilter($page["UrlID"]);
    }
    public static function deletePage($id){
        return deleteData("pages", $id);
    }
    public static function editPage($id, $name, $content, $title, $desc, $keywords, $langID){
        return editData(
            "pages",
            "Name,Content,Title,Description,Keywords,LangID",
            $id,
            $name, $content, $title, $desc, $keywords, $langID
        );
    }
    public static function addPage($name, $content, $title, $desc, $keywords, $langID){
        $urlID = saveUrl("add", [
            "title" => $name,
            "action" => "page",
            "langID" => $langID,
            "parameters" => "#"
        ]);
        if ($urlID != false){
            $pageID = addDataReturnAI(
                "pages",
                "Name,Content,Title,Description,Keywords,Views,LangID,UrlID",
                $name, $content, $title, $desc, $keywords, 0, $langID, $urlID
            );
            if ($pageID != false){
                return saveUrl("addParams", $pageID, $urlID);
            }else{
                return false;
            }
        }else{
            return  false;
        }
    }
}
?>