<?php
function getParams(){
    $params = getParameter("params");
    if ($params != null)
        return arrayBlankClear(explode( "/", $params ));
    else
        return null;
}
/*AdminController
adminController
admincotrolleer
admin_controller
admin-controller*/
function controllerType($control){
    $controller = $control . "Controller";
    $controllerFile = controllers . $controller . ".php";
    if (file_exists($controllerFile)){
        return array(true, $controller, $controllerFile);
    }
    $controller = strtolower($control) . "Controller";
    $controllerFile = controllers . $controller . ".php";
    if (file_exists($controllerFile)){
        return array(true, $controller, $controllerFile);
    }
    $controller = strtolower($control) . "controller";
    $controllerFile = controllers . $controller . ".php";
    if (file_exists($controllerFile)){
        return array(true, $controller, $controllerFile);
    }
    $controller = strtolower($control) . "_controller";;
    $controllerFile = controllers . $controller . ".php";
    if (file_exists($controllerFile)){
        return array(true, $controller, $controllerFile);
    }
    $controller = strtolower($control) . "-controller";;
    $controllerFile = controllers . $controller . ".php";
    if (file_exists($controllerFile)){
        return array(true, $controller, $controllerFile);
    }
    $controller = ucfirst($control) . "Controller";
    $controllerFile = controllers . $controller . ".php";
    if (file_exists($controllerFile)){
        return array(true, $controller, $controllerFile);
    }
    return array(false, "", "");;
}
function getControllerWithAction(){
    $params = getParams();
    if ($params != null){
        $controller = controllerType($params[0]);
        if ($controller[0]){
            array_shift($params);
            $actionAndParams = getAction($params);
            $action = $actionAndParams[1];
            $params = $actionAndParams[0];
            define("action", $action);
            array_shift($params);
            return array(
                'controller' => $controller[1],
                'require' => $controller[2],
                'action' => $action,
                'params' => $params
            );
        }else{
            $homeControllerFile = controllers.HomeController."Controller.php";
            $actionAndParams = getAction($params);
            $action = $actionAndParams[1];
            $params = $actionAndParams[0];
            define("action", $action);
            array_shift($params);
            return array(
                'controller' => HomeController."Controller",
                'require' => $homeControllerFile,
                'action' => $action,
                'params' => $params
            );
        }
    }else{
        setCurrentLanguage();
        $homeControllerFile = controllers.HomeController."Controller.php";
        return array(
            'controller' => HomeController."Controller",
            'require' => $homeControllerFile,
            'action' => HomeAction,
            'params' => null
        );
    }
}
function getAction($params){
    $action = $params[0] ?? null;
    if (!empty($action)){
        $lang = setCurrentLanguage($action);
        if ($lang){
            array_shift($params);
            return array($params, $params[0] ?? HomeAction);
        }else{
            return array($params, security($action));
        }
    }else{
        setCurrentLanguage();
        return array($params, HomeAction);
    }
}
function sefUrlTR($text) {
    $find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#');
    $replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp');
    $text = strtolower(str_replace($find, $replace, $text));
    $text = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $text);
    $text = trim(preg_replace('/\s+/', ' ', $text));
    $text = str_replace(' ', '-', $text);
    return $text;
}
function root($addPath = ""){
    $root = $_SERVER["DOCUMENT_ROOT"].dirname($_SERVER['PHP_SELF']);
    $last = substr($root, -1);
    if ($last != "/"){
        $root .= "/";
    }
    return $root.$addPath;
}
function routeControl($datas, $action){
    if ($datas == false){
        header("Location: " . $action );
        exit();
    }else{
        return $datas;
    }
}
function route($action){
    header("Location: " . $action );
    exit();
}
/*function getControllerWithAction(){
    $controllerWithAction = array();
    $getController = getParameter("controller");
    $getAction = getParameter("action");
    echo "c:$getController<br>";
    echo "a:$getAction<br>";
    $controllers = glob(controllers."*Controller.php");
    foreach ($controllers as $controller) {
        if (controllers.$getController."Controller.php" == $controller){
            $controllerWithAction["require"] = controllers.$getController."Controller.php";
            $controllerWithAction["controller"] = $getController."Controller";;
        }
    }
    if (empty($controllerWithAction["controller"])){
        $controllerWithAction["require"] = controllers.HomeController."Controller.php";
        if(!file_exists($controllerWithAction["require"])){
            die("404 Not Found");
        }
        $controllerWithAction["controller"] = HomeController."Controller";
        if ($getAction != null){
            $controllerWithAction["action"] =  $getAction;
        }else{
            if ($getController != null){
                $controllerWithAction["action"] =  $getController;
            }else{
                $controllerWithAction["action"] =  "index";
            }
        }
    }else{
        if ($getAction != null){
            $controllerWithAction["action"] =  $getAction;
        }else{
            $controllerWithAction["action"] =  "index";
        }
    }
    return $controllerWithAction;
}*/
?>
