<?php
class LanguagesModel {
    public static function languages(){
        return getDatas("select * from languages order by ID desc");
    }
    public function defaultLang(){
        return getDatas("select * from languages where DefaultLanguage = 1 limit 1");
    }
    public static function defaultLangID(){
        $lang = getDatas("select ID,DefaultLanguage from languages where DefaultLanguage = 1 limit 1");
        return $lang["ID"];
    }
    public static function activeLangID($Short){
        $lang = getDatas("select ID,Short from languages where Short = '?' limit 1", $Short);
        return $lang["ID"];
    }
    public static function language($id){
        return getDatas("select * from languages where ID = ? limit 1", $id);
    }
    public static function deleteLanguage($id){
        return deleteData("languages", $id);
    }
    public static function defaultLanguage($id){
        if (runSql("update languages set DefaultLanguage = ?", 0)){
            return editData("languages", "DefaultLanguage", $id , 1);
        }
    }
    public static function editLanguage($id, $name, $short, $tag){
        return editData("languages", "Name,Short,Tag", $id, $name, $short, $tag);
    }
    public static function addLanguage($name, $short, $tag){
        return addData("languages", "Name,Short,Tag,DefaultLanguage", $name, $short, $tag, 0);
    }
    public static function languagesNames(){
        return getDatas("select ID,Name from languages order by ID desc");
    }
}
?>