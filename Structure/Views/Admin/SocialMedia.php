<?php
adminHeader(["asd",""], ["sdsa", "d"], "References", "socialMediaAdd", "social-media-add");
adminLister("c-t", falseToArray($socialMedia), [
    "name--Name",
    "link--Link--link",
    "icon--Icon--html",
    "bg--BackgroundColor--color",
    "action--btn--(ID | delete | deleteSoicalMedia | danger)--(ID | edit | socialMediaEdit | primary)",
]);
?>