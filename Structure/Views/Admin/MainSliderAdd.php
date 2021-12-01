<?php
adminHeaderAction(["blog","Blog"], ["sd","ad"], "Blog" ,"blog-add");
adminForms([
    ["title", "text", "title", "please-enter-a-title", "enter-a-title"],
    ["path", "image", "image", "please-select-a-image"],
    ["sequence", "number", "sequence", "please-enter-a-sequence", "enter-a-sequence"],
    ["langID", "language", "language", "please-choose-a-language", "selectDatas" => $languages, "selectValKey" => "ID", "selectDisplayKey" => "Name"],
    ["caption", "editor", "caption", "please-enter-a-caption", "enter-a-caption"]
], "addMainSlider");
?>