<?php
adminHeaderAction(["blog","Blog"], ["sd","ad"], "Pages" ,"page-add");
adminForms([
    ["name", "text", "page-name", "please-enter-a-name", "enter-a-name"],
    ["title", "text", "title", "please-enter-a-title", "enter-a-title"],
    ["desc", "textarea", "description", "please-enter-a-description", "enter-a-description"],
    ["keywords", "tags", "Keywords", "please-enter-keywords", "enter-keywords"],
    ["langID", "select", "language", "please-choose-a-language", "selectDatas" => $languages, "selectValKey" => "ID", "selectDisplayKey" => "Name"],
    ["content", "editor", "content", "please-enter-content"]
], "addPage");
?>