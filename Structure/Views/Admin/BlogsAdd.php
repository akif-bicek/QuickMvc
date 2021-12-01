<?php
adminHeaderAction(["blog","Blog"], ["sd","ad"], "Blog" ,"blog-add");
adminForms([
    ["title", "text", "title", "please-enter-a-title", "enter-a-title"],
    ["description", "textarea", "description", "please-enter-a-description", "enter-a-description"],
    ["keywords", "tags", "Keywords", "please-enter-keywords", "enter-keywords"],
    ["author", "text", "author", "please-enter-author", "enter-author"],
    ["path", "image", "image", "please-select-a-image"],
    ["langID", "select", "language", "please-choose-a-language", "selectDatas" => $languages, "selectValKey" => "ID", "selectDisplayKey" => "Name"],
    ["tags", "tags", "enter-tags", "please-enter-tags"],
    ["content", "editorf", "content", "please-enter-content"]
], "addBlog");
?>