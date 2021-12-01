<?php
class MainSliderModel {
    public static function mainSlider($sequance = false){
        if ($sequance){
            return getDatas("select * from mainslider where LangID = ? order by Sequence", lang);
        }else{
            return getDatas("select * from mainslider where LangID = ? order by ID desc", lang);
        }
    }
    public static function addMainSlider($title, $caption, $sequence, $path, $langID){
        return addData("mainslider", "Title,Caption,Sequence,ImagePath,LangID", $title, $caption, $sequence, $path, $langID);
    }
    public static function getMainslider($id){
        return getDatas("select * from mainslider where ID = ? limit 1", $id);
    }
    public static function editMainSlider($id, $title, $caption, $sequence, $path, $langID){
        if ($path !== false){
            return editData("mainslider", "ID,Title,Caption,Sequence,ImagePath,LangID", $id, $title, $caption, $sequence, $path, $langID);
        }else{
            return editData("mainslider", "ID,Title,Caption,Sequence,LangID", $id, $title, $caption, $sequence, $langID);
        }
    }
}
?>