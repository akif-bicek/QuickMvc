<?php adminHeaderAction(["blog","Blog"], ["sd","ad"], "quick-links" ,"quick-link-add"); ?>
<?php
adminForms([
    ["content--AboutContent", "editor", "about-content", "please-enter-content"]
],"editAboutContent", ["AboutContent" => $aboutContent]);
?>