<?php
adminHeader(["akif","sad"], ["sd","ad"], "Blog" ,"blogAdd", "blog-add");
adminLister("b-cf-sp", falseToArray($blogs), [
    "t--Title",
    "std--PublishDate",
    "i--Path",
    "te--Content",
    "fb--ID--delete--blogDelete--danger",
    "fb--ID--edit--blogEdit--primary",
    "fb--ID--comments--messages/1--secondary",
    "ft--Views--". scr("views").": "
]);
/*adminLister("c-t", falseToArray($blogs), [
    "image--Path--image",
    "title--Title",
    "publish-date--PublishDate--date",
    "content--Content",
    "views--Views" ,
    "action--btn--(ID | delete | blogDelete | danger)--(ID | edit | blogEdit | primary)",
]);*/
?>