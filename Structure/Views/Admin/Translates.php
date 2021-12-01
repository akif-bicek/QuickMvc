<?php
$action = "";
if (action != HomeAction){
    $action = action;
}
$link = "admin/". langshort . $action;
adminHeaderAction(["blog","Blog"], ["sd","ad"], "Blog" ,"blog-add"); ?>
<div class='card'>
    <div class='card-body row'>
        <div class='col-lg-10'>
            <input type='text' placeholder='<?php sc('search'); ?>' class='form-control valid' id='search'>
        </div>
        <div class='col-lg-2 text-right'>
            <button onclick="search('<?php echo $link; ?>')" class='btn btn-primary h-100'><?php sc('search'); ?></button>
        </div>
    </div>
</div>
<?php
if (count(falseToArray($translates)) > 0){
    $inputs = array();
    $datas = array();
    foreach (falseToArray($translates) as $translate){
        $datas[$translate["ID"]] = $translate["Text"];
        $inputs[] = [$translate["ID"]. "--" . $translate["ID"], "textnoscr", $translate["LangKey"]];
    }
    adminForms($inputs, "editTranslates", $datas);
}
?>