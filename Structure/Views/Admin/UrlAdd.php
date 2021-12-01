<?php
adminHeaderAction(["blog", "Blog"], ["sd", "ad"], "urls", "url-add");
$actions = array(
    ["Action" => "index"],
    ["Action" => "about"],
    ["Action" => "products"],
    ["Action" => "searchProducts"],
    ["Action" => "searchProductCategories"],
    ["Action" => "references"],
    ["Action" => "blog"],
    ["Action" => "searchBlog"],
    ["Action" => "searchBlogCategories"],
    ["Action" => "contact"],
    ["Action" => "page"]
);
adminForms([
    ["name", "text", "name", "please-enter-a-name", "enter-a-name"],
    ["action", "select", "action", "please-choose-a-action", "selectDatas" => $actions, "selectValKey" => "Action", "selectDisplayKey" => "Action"],
    ["parameters", "tags", "parameters"],
    ["langID", "language", "language", "please-choose-a-language", "selectDatas" => $languages, "selectValKey" => "ID", "selectDisplayKey" => "Name"]
],"addUrl");
?>