<?php
function getParameter($key){
    if (!empty($_GET[$key])){
        return security($_GET[$key]);
    }else{
        return null;
    }
}
function postParameter($key, $numberFilter = false){
    if (!empty($_POST[$key])){
        if ($numberFilter){
            return numbersFilter(security($_POST[$key]));
        }else{
            return security($_POST[$key]);
        }
    }else{
        return null;
    }
}
function postFile($key){
    if(!empty($_FILES[$key])){
        $file = $_FILES[$key];
        if (($file["name"] != "") and ($file["type"] != "") and ($file["tmp_name"] != "") and ($file["error"] == 0) and ($file["size"] > 0)){
            return $file;
        }else{
            return null;
        }
    }else{
        return null;
    }
}
function getPosts($keyNumbersFilter = false, $valNumberFilters = false){
    $array = array();
    if (count($_POST) > 0){
        foreach ($_POST as $key => $post){
            $key = ($keyNumbersFilter) ? numbersFilter($key) : $key;
            if ($valNumberFilters){
                $array[$key] = numbersFilter(security($post));
            }else{
                $array[$key] = security($post);
            }
        }
    }
    return $array;
}
?>