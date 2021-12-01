<?php
class TagsModel {
    public static function tags($type, $limit = null, $id = null){
        $limit = ($limit != null) ? " limit ".$limit : "";
        $id = ($id != null) ? "and ItemID = ". $id : "";
        return getDatas("select * from tags where LangID = ? and Type = ? ". $id ." order by ID desc ". $limit, lang, $type);
    }
    public static function tagsClear($id){
        return runSql("delete from tags where ItemID = ?", $id);
    }
    public static function tagsAdd($tags, $type, $id, $langID){
        $tags = explode(",", $tags);
        $datas = array();
        foreach ($tags as $tag){
            $datas[] = security($tag);
            $datas[] = $type;
            $datas[] = 0;
            $datas[] = $id;
            $datas[] = $langID;
        }
        return multiAdd("tags", "Name,Type,Views,ItemID,LangID" , $datas);
    }
}
?>