<?php
class SocialsModel{
    public static function social($limit){
        return getDatas("select * from socialmedia order by ID desc limit ".$limit);
    }
    public static function socialMedias(){
        return getDatas("select * from socialmedia order by ID desc");
    }
    public static function socialMedia($id){
        return getDatas("select * from socialmedia where ID = ? limit 1", $id);
    }
    public static function editSocialMedia($id, $name, $link, $icon, $bgColor){
        return editData("socialmedia", "Name,Link,Icon,BackgroundColor", $id, $name, $link, $icon, $bgColor);
    }
    public static function addQSocialMedia($name, $link, $icon, $bgColor){
        return addData("socialmedia", "Name,Link,Icon,BackgroundColor", $name, $link, $icon, $bgColor);
    }
}
?>