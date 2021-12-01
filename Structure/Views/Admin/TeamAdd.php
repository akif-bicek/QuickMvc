<?php
adminHeaderAction(["0","s"],[",",","],"team","team--add");
adminForms([
    ["name", "text", "name", "please-enter-a-name", "enter-a-name"],
    ["path", "image", "link", "please-enter-link", "enter-link"],
    ["langID", "select", "language", "please-choose-a-language", "selectDatas" => $languages, "selectValKey" => "ID", "selectDisplayKey" => "Name"],
    ["content", "editor", "icon", "please-enter-icon", "enter-icon"]
], "addTeam");
?>