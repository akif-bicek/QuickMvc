<?php adminHeader(["akif","sad"], ["sd","ad"], "categories" ,"categoriesAdd/{$type}", "category-add");
adminLister("c-t", falseToArray($categories), [
        "image--Path--image",
        "name--Name",
        "desc--Description",
        "keywords--Keywords",
        "content--Content",
        "views--Views" ,
        "action--btn--(ID | delete | categoryDelete | danger)--(ID | edit | categoryEdit | primary)",
    ]
);
?>