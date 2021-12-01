<?php adminHeaderAction(["blog","Blog"], ["sd","ad"], "quick-links" ,"quick-link-add"); ?>
<?php
adminForms([
    ["path", "image", "select-image", "please-enter-image"],
    ["content", "editor", "about-content", "please-enter-content"]
],"editMainPageAboutContent", $values);
?>