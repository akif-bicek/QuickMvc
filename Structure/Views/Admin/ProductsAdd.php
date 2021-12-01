<?php
adminHeaderAction(["akif","sad"], ["sd","ad"], "products" ,"product-add");
adminForms([
    ["images", "images", "select-product-images", "please-select-product-images"],
    ["name", "text", "product-name", "please-enter-a-name", "enter-a-name"],
    ["categoryID", "select", "category", "please-choose-a-category", "selectDatas" => falseToArray($categories), "selectValKey" => "ID", "selectDisplayKey" => "Name"],
    ["desc", "textarea", "description", "please-enter-a-description", "enter-a-description"],
    ["keywords", "tags", "Keywords", "please-enter-keywords", "enter-keywords"],
    ["langID", "language", "language", "please-choose-a-language", "selectDatas" => falseToArray($languages), "selectValKey" => "ID", "selectDisplayKey" => "Name"],
    ["tags", "tags", "tags", "please-enter-tags", "enter-tags"],
    ["content", "editorf", "content", "please-enter-content"]
], "addProduct");
?>

