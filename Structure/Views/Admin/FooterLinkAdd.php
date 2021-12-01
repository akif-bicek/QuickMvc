<?php
adminHeaderAction(["blog","Blog"], ["sd","ad"], "Blog" ,"blog-add");
adminForms([
    ["text", "text", "title", "please-enter-a-text", "enter-a-text"],
    ["link", "text", "link", "please-enter-a-link", "enter-a-link"],
    ["sequance", "number", "sequance", "please-enter-a-sequance", "enter-a-sequance"],
    ["langID", "language", "language", "please-choose-a-language", "selectDatas" => $languages, "selectValKey" => "ID", "selectDisplayKey" => "Name"],
], "addFooterLink");
?>