<?php
class SettingsModel extends System {
    public static function settings(){
        return getDatas("select * from settings where langID = ? limit 1", lang);
    }
    public static function settingsVal($col){
        $sett = getDatas("select ID,{$col} from settings where langID = ? limit 1", lang);
        return ($sett != false) ? $sett[$col] : "Karmızı";
    }
    public static function currentSettingsId(){
        $sett = getDatas("select ID,LangID from settings where LangID = ? limit 1", lang);
        return $sett["ID"];
    }
    public static function editSettingVal($col, $value){
        return editData("settings", $col, self::currentSettingsId(), $value);
    }
    public static function systemContents($search = ""){
        if ($search != ""){
            $search = "%". $search ."%";
            $query = "select * from systemcontents where LangID = ? and LangKey like  ? or Text like ? order by ID desc";
            return getDatas($query, lang, $search, $search);
        }else{
            $query = "select * from systemcontents where LangID = ? order by ID desc";
            return getDatas($query, lang);
        }
    }
    public static function editSystemContents($ids){
        $countIds = count($ids);
        $ok = 0;
        if ($countIds > 0){
            foreach ($ids as $id => $value){
                if (editData("systemcontents", "text", $id, $value)){
                    $ok++;
                }
            }
            if ($countIds == $ok){
                return true;
            }
        }else{
            return false;
        }

    }
}
?>