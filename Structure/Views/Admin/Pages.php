<?php
adminHeader(["asd",""], ["sdsa", "d"], "Pages", "pageAdd", "add-page");
adminLister("b-c-p", falseToArray($pages), [
    "t--Name",
    "te--Content",
    "fb--ID--delete--pageDelete--danger",
    "fb--ID--edit--pageEdit--primary",
    "ft--Views--". scr("views").": "
]);
?>