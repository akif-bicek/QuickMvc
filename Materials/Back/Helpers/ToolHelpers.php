<?php
function blankKeysAssign($datas){
    if (!empty($datas)){
        $newDatas = array();
        foreach($datas as $key => $data){
            if (is_numeric($key)){
                $newDatas[$data] = $data;
            }else{
                $newDatas[$key] = $data;
            }
        }
        return $newDatas;
    }else{
        return array("nodata");
    }
}
function falseToArray($value){
    if ($value == false){
        return array();
    }else{
        return $value;
    }
}
function groupArray($array, $key){
    $arr = array();
    foreach ($array as $value){
        $add = true;
        foreach ($arr as $val){
            if ($value[$key] == $val){
                $add = false;
            }
        }
        if ($add){
            $arr[] = $value[$key];
        }
    }
    return $arr;
}
function thirdParty($framework){
    return "Materials/Back/ThirdParty/". $framework;
}
function upload($file, $type, ...$options){
    $return = false;
    if ($file != null){
        switch ($type) {
            case "image":
                $lang = (!empty($options[0])) ? $options[0] : "en-US";
                $x = (!empty($options[1])) ? $options[1] : 0;
                $y = (!empty($options[2])) ? $options[2] : 0;
                $convert = (!empty($options[3])) ? $options[3] : false;
                $randomNamed = (!empty($options[4])) ? $options[4] : false;
                $background = (!empty($options[5])) ? $options[5] : "#FFFFFF";
                $quality = (!empty($options[6])) ? $options[6] : 100;
                $return = uploadImage($file, $lang, $x, $y, $convert, $randomNamed, $background, $quality);
                break;
            case "video":
                echo "this is coming soon";
                break;
            case "mp3":
                echo "this is coming soon type";
                break;
        }
    }
    return $return;
}
function randomNamed(){
    return substr(md5(uniqid(time())), 0, 25);
}
function uploadImage($file, $lang, $x, $y, $convert, $randomNamed, $background, $quality){
    require_once thirdParty("Verot/src/class.upload.php");

    $fileName = security($file["name"]);
    $baseName = security(pathinfo($file["name"], PATHINFO_FILENAME));
    $exention = strtolower(substr($fileName, -4));
    if ($exention == "jpeg"){
        $exention = ".".$exention;
    }
    //if ($randomNamed){
    if (true){
        $randomName = randomNamed();
        $baseName = $randomName;
    }
    $upload = new upload($file, $lang);
    if ($upload->uploaded){
        $upload->mime_magic_check			=	true;
        $upload->allowed					=	array("image/*");
        $upload->file_new_name_body		=	$baseName;
        $upload->file_overwrite			=	true;
        if ($convert != false){
            $upload->image_convert			=  ltrim(strtolower($convert), ".");
        }
        $upload->image_quality			=	$quality;
        $upload->image_background_color	=	$background;
        if (($x != 0) or ($y != 0)){
            $upload->image_resize				=	true;
        }
        if ($x != 0){
            $upload->image_x					=	$x;
        }
        if ($y != 0){
            $upload->image_y					=	$y;
        }
        $upload->process(root(ImagesRoot));

        if($upload->processed){
            $upload->clean();
            return $baseName . $exention;
        }else{
            /*echo $fileName . $exention;
            die($upload->error);*/
            return false;
        }
    }
}
function characterLimiter($str, $n = 500, $end_char = '&#8230;')
{
    if (mb_strlen($str) < $n)
    {
        return $str;
    }
    $str = preg_replace('/ {2,}/', ' ', str_replace(array("\r", "\n", "\t", "\v", "\f"), ' ', $str));
    if (mb_strlen($str) <= $n)
    {
        return $str;
    }
    $out = '';
    foreach (explode(' ', trim($str)) as $val)
    {
        $out .= $val.' ';

        if (mb_strlen($out) >= $n)
        {
            $out = trim($out);
            return (mb_strlen($out) === mb_strlen($str)) ? $out : $out.$end_char;
        }
    }
}
function blank($value = null, $default = ""){
    if($value == null){
        return $default;
    }else{
        return (empty($value)) ? $default : $value;
    }
}
function isNotEmpty($value, $default){
    return (empty($value)) ? blank() : $default;
}
function arrayRepeat($array, $times){
    $return = array();
    foreach ($array as $value){
        for ($i = 0; $i < $times; $i++){
            $return[] = $value;
        }
    }
    return $return;
}
function deleteUpload($file){
    $file = "Materials/Front/Uploads/" . $file;
    if (file_exists($file)){
        unlink($file);
    }
}
function arrayDie($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
    die();
}
function arrayPrint($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
?>