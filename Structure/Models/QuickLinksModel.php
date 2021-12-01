<?php
class QuickLinksModel {
    public static function quickLinks(){
        return getDatas("select * from quicklinks order by ID desc");
    }
    public static function quickLink($id){
        return getDatas("select * from quicklinks where ID = ? limit 1", $id);
    }
    public static function editQuickLinks($id, $name, $link, $icon, $bgColor){
        return editData("quicklinks", "Name,Link,Icon,BackgroundColor", $id, $name, $link, $icon, $bgColor);
    }
    public static function addQuickLinks($name, $link, $icon, $bgColor){
        return addData("quicklinks", "Name,Link,Icon,BackgroundColor", $name, $link, $icon, $bgColor);
    }
}
?>