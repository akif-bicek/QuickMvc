<?php
adminHeaderAction(["blog","Blog"], ["sd","ad"], "Blog" ,"blog-add");
adminForms([
    ["id--ID", "hidden", "ID"],
    ["title--Title", "text", "title", "please-enter-a-title", "enter-a-title"],
    ["path--ImagePath", "image", "image"],
    ["sequence--Sequence", "number", "sequence", "please-enter-a-sequence", "enter-a-sequence"],
    ["langID--LangID", "language", "language", "please-choose-a-language", "selectDatas" => $languages, "selectValKey" => "ID", "selectDisplayKey" => "Name"],
    ["caption--Caption", "editor", "caption", "please-enter-a-caption", "enter-a-caption"]
], "editMainSlider", $mainslider);
?>