<?php
$viewData = array();
function getViewDatas(){
    global $viewData;
    return blankKeysAssign($viewData);
}
function renderAction(){
    extract(getViewDatas());
    require_once "Structure/Views/". view . ".php";
}
function partials($partial, $datas){
    extract(blankKeysAssign($datas));
    require  "Structure/Views/". $partial . ".php";;
}
function assets($asset){
    echo "Materials/Front/Assets/" . $asset;
}
function uploads($uploaded){
    echo "Materials/Front/Uploads/" . $uploaded;
}
function uploadsr($uploaded){
    return "Materials/Front/Uploads/" . $uploaded;
}
function scriptRunner($script, $layout = true){
    $script = '<script>'. trim($script) .'</script>';
    if($layout){
        global $scripts;
        $scripts .= $script;
    }else{
        echo $script;
    }
}
function styleRunner($style, $layout = true){
    $style = '<style>'. trim($style) .'</style>';
    if($layout){
        global $styles;
        $styles .= $style;
    }else{
        echo $style;
    }
}
function scriptImploder($path, $layout = true){
    if ((strpos($path, "http://") !== false ) or strpos($path, "https://") !== false){
        $script = '<script src="'. $path .'" type="text/javascript"></script>';
    }else{
        $script = '<script src="Materials/Front/Assets/'. $path .'" type="text/javascript"></script>';
    }
    if($layout){
        global $scriptFiles;
        $scriptFiles .= trim($script);
    }else{
        echo trim($script);
    }
}
function styleImploader($path, $layout = true){
    if ((strpos($path, "http://") !== false ) or strpos($path, "https://") !== false){
        $style = '<link href="'. $path .'" rel="stylesheet" />';
    }else{
        $style = '<link href="Materials/Front/Assets/'. $path .'" rel="stylesheet" />';
    }
    if($layout){
        global $styleFiles;
        $styleFiles .= trim($style);
    }else{
        echo trim($style);
    }
}
function systemScripts($layout = false){
    $script = '<script src="Materials/Back/System/System.js" type="text/javascript"></script>';
    if($layout){
        global $scriptFiles;
        $scriptFiles .= trim($script);
    }else{
        echo trim($script);
    }
}
function scripts(){
    global $scripts, $scriptFiles;
    echo $scriptFiles;
    echo $scripts;
}
function styles(){
    global $styles, $styleFiles;
    echo $styleFiles;
    echo $styles;
}
?>