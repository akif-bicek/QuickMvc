<?php adminHeaderAction(["blog","Blog"], ["sd","ad"], "quick-links" ,"quick-link-add"); ?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body text-left">
                <a href="https://fontawesome.com/v4.7/icons/" target="_blank"><?php sc("font-awsome"); ?></a>
            </div>
        </div>
    </div>
<?php
adminForms([
    ["name", "text", "name", "please-enter-a-name", "enter-a-name"],
    ["link", "text", "link", "please-enter-link", "enter-link"],
    ["icon", "text", "icon", "please-enter-icon", "enter-icon"],
    ["bgColor", "color", "bg-color", "please-bg-color", "enter-bg-color"],
], "addSocialMedia");
?>