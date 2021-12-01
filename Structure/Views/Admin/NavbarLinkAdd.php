<?php
adminHeaderAction(["blog","Blog"], ["sd","ad"], "Blog" ,"blog-add");
adminForms([
    ["text", "text", "title", "please-enter-a-text", "enter-a-text"],
    ["link", "dropdowntext", "link", "please-enter-link", "enter-link" ,"ddtDatas" => $links, "ddtValKey" => "SefLink", "ddtDisplayKey" => "Name", "buttonText" => "select-link", "buttonActionName" => "selectLink"],
    ["sequance", "number", "sequence", "please-enter-a-sequence", "enter-a-sequence"],
    ["langID", "language", "language", "please-choose-a-language", "selectDatas" => $languages, "selectValKey" => "ID", "selectDisplayKey" => "Name"],
], "addNavbarLink");
?>