<?php
adminHeader(["asd",""], ["sdsa", "d"], "References", "ReferenceAdd", "add-reference");
adminLister("c-t-p", falseToArray($references), [
    "image--Path--image",
    "name--Name",
    "title--Title",
    "category--Category",
    "action--btn--(ID | delete | referenceDelete | danger)--(ID | edit | referenceEdit | primary)",
]);
?>