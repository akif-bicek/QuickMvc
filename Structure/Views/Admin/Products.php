<?php
adminHeader(["akif","sad"], ["sd","ad"], "Blog" ,"productsAdd", "product-add");
adminLister("b-cf-sp", falseToArray($products), [
    "t--Name",
    "st--CategoryName",
    "std--PostDate",
    "i--Path",
    "te--Content",
    "fb--ID--delete--blogDelete--danger",
    "fb--ID--edit--blogEdit--primary",
    "fb--ID--comments--messages/0--secondary",
    "ft--Views--". scr("views").": "
]);
?>