<?php
class TeamModel{
    public static function team(){
        return getDatas("select * from team where LangID = ? order by ID desc", lang);
    }
    public static function teamRow($id){
        return getDatas("select * from team where ID = ? limit 1", $id);
    }
    public static function addTeam($name, $content, $path, $langID){
        return addData("team", "Name,Content,ImagePath,LangID", $name, $content, $path, $langID);
    }
    public static function editTeam($id, $name, $content, $path, $langID){
        return editData("team", "Name,Content,ImagePath,LangID", $id, $name, $content, $path, $langID);
    }
    public static function deleteTeam($id){
        return deleteData("team", $id);
    }
}
?>