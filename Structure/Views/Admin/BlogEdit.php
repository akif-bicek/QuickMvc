<?php
adminHeaderAction(["blog","Blog"], ["sd","ad"], "Blog" ,"blog-edit");
$blog["tags"] = tagsCombine($tags);
adminForms([
    ["id--ID", "hidden", "title"],
    ["beforeTitle--Title", "hidden", "title"],
    ["title--Title", "text", "title", "please-enter-a-title", "enter-a-title"],
    ["description--Description", "textarea", "description", "please-enter-a-description", "enter-a-description"],
    ["keywords--Keywords", "tags", "keywords", "please-enter-keywords", "enter-keywords"],
    ["author--Author", "text", "author", "please-enter-author", "enter-author"],
    ["path--Path", "image", "image"],
    ["beforePath--Path", "hidden", "title"],
    ["langID--LangID", "select", "language", "please-choose-a-language", "selectDatas" => $languages, "selectValKey" => "ID", "selectDisplayKey" => "Name"],
    ["tags", "tags", "enter-tags", "please-enter-tags"],
    ["content--Content", "editorf", "content", "please-enter-content"]
], "editBlog", $blog);
?>