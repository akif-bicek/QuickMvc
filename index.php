<?php
//  test area  //

goto App;
$a = array(1);
$b = array(0);
print_r(array_merge($a, $b));
die();
App:
?>
<?php ob_start(); //error_reporting(0);
const controllers = "Structure/Controllers/";
const back = "Materials/Back/";
const helpers = back."Helpers/";

require_once back."Config.php";
require_once helpers."DatabaseHelpers.php";
require_once helpers."SecurityHelpers.php";
require_once helpers."RequestHelpers.php";
require_once helpers."RouteHelpers.php";
require_once helpers."ViewHelpers.php";
require_once helpers."ToolHelpers.php";

require_once helpers."CustomHelpers.php";

$db = connect(Host, Dbname, Username, Password);
$controller = getControllerWithAction();
$action = $controller["action"];

require_once back."System/System.php";
require_once back."System/Globals.php";

require_once $controller["require"];
foreach (glob("Structure/Models/*Model.php") as $filename)
{
    require_once $filename;
}
$control = new $controller["controller"];
if(method_exists($control, $action)){
    $control->$action($controller["params"]);
}else{
    $savingUrl = savingUrls($controller);
    if (!($savingUrl === false)){
        $action = $savingUrl["action"];
        $params = $savingUrl["params"];
        if (method_exists($control, $savingUrl["action"])){
            $control->$action($params);
        }else{
            if (method_exists($control, "notfound")){
                $control->notfound();
            }else{
                die("404 Not Found");
            }
        }
    }else{
        if (method_exists($control, "notfound")){
            $control->notfound();
        }else{
            die("404 Not Found");
        }
    }
}
ob_end_flush();
?>