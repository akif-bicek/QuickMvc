<?php
class NavbarFooterLinksModel{
    public static function navbarLinks(){
        return getDatas("select * from navbarfooterlinks where LangID = ? and Types = 0 order by Sequance", lang);
    }
    public static function footerLinks(){
        return getDatas("select * from navbarfooterlinks where LangID = ? and Types = 1 order by Sequance", lang);
    }
    public static function add($type, $text, $link, $sequance, $langID){
        return addData("navbarfooterlinks", "Text,Link,Sequance,Types,LangID", $text, $link, $sequance, $type, $langID);
    }
}
?>