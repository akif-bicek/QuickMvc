<?php
adminHeader(["asd",""], ["sdsa", "d"], "References", "quickLinkAdd", "quick-link-add");
adminLister("c-t", falseToArray($quickLinks), [
    "name--Name",
    "link--Link--link",
    "icon--Icon--html",
    "bg--BackgroundColor--color",
    "action--btn--(ID | delete | deleteQuickLink | danger)--(ID | edit | quickLinkEdit | primary)",
]);
?>