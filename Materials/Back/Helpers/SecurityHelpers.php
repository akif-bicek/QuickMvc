<?php
function security($value){
    return trim(strip_tags(htmlspecialchars($value,ENT_QUOTES)));
}
function decodeSecurity($value){
    return htmlspecialchars_decode($value,ENT_QUOTES);
}
function removeStrings($value){
    return preg_replace("/[^0-9]/","",$value);
}
function numbersFilter($deger){
    return security(removeStrings($deger));
}
function arrayIsNull($array){
    $null = false;
    foreach ($array as $value){
        if ($value == null){
            $null = true;
        }
        if ($value == ""){
            $null = true;
        }
        if (empty($value)){
            if ($value == 0){
                $null = false;
            }else{
                $null = true;
            }
        }
    }
    return $null;
}
function arrayBlankClear($array){
    $re = array();
    $null = false;
    foreach ($array as $value){
        if ($value == null){
            $null = true;
        }
        if ($value == ""){
            $null = true;
        }
        if (empty($value)){
            if ($value == 0){
                $null = false;
            }else{
                $null = true;
            }
        }
        if (!$null){
            $re[] = $value;
        }
    }
    return $re;
}
?>