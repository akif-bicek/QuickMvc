<?php
adminHeaderAction(["blog","Blog"], ["sd","ad"], "Pages" ,"page-add");
adminForms([
    ["id--ID", "hidden"],
    ["name--Name", "text", "page-name", "please-enter-a-name", "enter-a-name"],
    ["title--Title", "text", "title", "please-enter-a-title", "enter-a-title"],
    ["desc--Description", "textarea", "description", "please-enter-a-description", "enter-a-description"],
    ["keywords--Keywords", "tags", "Keywords", "please-enter-keywords", "enter-keywords"],
    ["langID--LangID", "select", "language", "please-choose-a-language", "selectDatas" => $languages, "selectValKey" => "ID", "selectDisplayKey" => "Name"],
    ["content--Content", "editor", "content", "please-enter-content"]
], "editPage", $page);
?>