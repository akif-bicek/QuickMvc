<?php
$active = "";
$list = "";
foreach (falseToArray($languages) as $language){
    $action = "";
    if (action != HomeAction){
        $action = action;
    }
    if ($language["DefaultLanguage"]){
        $link = "admin" . "/" . $action;
    }else{
        $link = "admin/". $language["Short"] . "/" . $action;
    }
    if ($language["ID"] == lang){
        $active = $language["Name"];
    }
    $list .= '<li><a class="btn btn-outline-light btn-sm btn-block" href="'. $link .'">'. $language["Name"] .'</a></li>';
}
?>
<a href="javascript:void(0)" class="log-user"  data-toggle="dropdown">
    <span><?php echo $active; ?></span>  <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
</a>
<div class="drop-down dropdown-language animated fadeIn  dropdown-menu">
    <div class="dropdown-content-body">
        <ul>
            <?php echo $list; ?>
        </ul>
    </div>
</div>
