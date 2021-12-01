<?php
adminHeaderAction(["blog","Blog"], ["sd","ad"], "products" ,"multi-upload");
adminForms([
    ["files[]", "folder", "folder", "please-select-a-folder"],
    ["categoryID", "select", "category","please-choose-a-category", "selectDatas" => falseToArray($categories), "selectValKey" => "ID", "selectDisplayKey" => "Name"],
    ["langID", "language", "language", "please-choose-a-language", "selectDatas" => $languages, "selectValKey" => "ID", "selectDisplayKey" => "Name"],
], "multiProductAdd");
?>