<?php
adminHeaderAction(["akif","sad"], ["sd","ad"], "categories" ,"category-add");
adminForms([
    ["type", "hiddenvalue", $type],
    ["images", "images", "select-category-images", "please-select-category-images"],
    ["name", "text", "category-name", "please-enter-a-name", "enter-a-name"],
    ["desc", "textarea", "description", "please-enter-a-description", "enter-a-description"],
    ["keywords", "tags", "Keywords", "please-enter-keywords", "enter-keywords"],
    ["langID", "language", "language", "please-choose-a-language", "selectDatas" => falseToArray($languages), "selectValKey" => "ID", "selectDisplayKey" => "Name"],
    ["tags", "tags", "tags", "please-enter-tags", "enter-tags"],
    ["content", "editorf", "content", "please-enter-content"]
], "addCategory");
?>

