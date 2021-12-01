<?php
class ReferencesModel {
    public static function references(){
        return getDatas("select * from referencescompanies where LangID = ?", lang);
    }
    public static function referencesLimts($ofset, $limit){
        return getDatas("select * from referencescompanies where LangID = ? limit {$ofset}, {$limit}", lang);
    }
    public static function reference($id){
        return getDatas("select * from referencescompanies where ID = ? limit 1", $id);
    }
    public static function deleteReferences($id){
        return deleteData("referencescompanies", $id);
    }
    public static function editReference($id, $name, $title, $path, $category, $langID){
        if ($path != false){
            return editData(
                "referencescompanies",
                "Name,Title,Path,Category,LangID",
                $id, $name, $title, $path, $category, $langID
            );
        }else{
            return editData(
                "referencescompanies",
                "Name,Title,Category,LangID",
                $id, $name, $title, $category, $langID
            );
        }
    }
    public static function addReference($name, $title, $path, $category, $langID){
        if ($path != false){
            addData(
                "referencescompanies",
                "Name,Title,Path,Category,LangID",
                $name, $title, $path, $category, $langID
            );
        }else{
            return false;
        }
    }
}
?>
