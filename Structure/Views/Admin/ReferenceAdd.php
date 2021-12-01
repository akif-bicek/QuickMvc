<?php
adminHeaderAction(["blog","Blog"], ["sd","ad"], "References" ,"reference-add");
adminForms([
    ["name", "text", "name", "please-enter-a-name", "enter-a-name"],
    ["title", "text", "title", "please-enter-a-title", "enter-a-title"],
    ["path", "image", "image", "please-select-a-image"],
    ["category", "text", "category", "please-enter-category", "enter-category"],
    ["langID", "select", "language", "please-choose-a-language", "selectDatas" => $languages, "selectValKey" => "ID", "selectDisplayKey" => "Name"],
], "addReference");
?>
