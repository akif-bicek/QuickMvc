<?php
adminHeaderAction(["blog","Blog"], ["sd","ad"], "products" ,"multi-upload");
adminForms([
    ["files[]", "folder", "folder", "please-select-a-folder"],
    ["langID", "language", "language", "please-choose-a-language", "selectDatas" => $languages, "selectValKey" => "ID", "selectDisplayKey" => "Name"],
], "multiCategoryAdd");
?>