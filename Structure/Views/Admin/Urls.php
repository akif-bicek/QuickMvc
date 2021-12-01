<?php adminHeader(["blog", "Blog"], ["sd", "ad"], "urls", "urlAdd", "url-add");
adminLister("c-t-ps", falseToArray($urls), [
    "name--Name",
    "sefLink--SefLink",
    "action--Action" ,
    "parameters--Parameters",
    "action--btn--(ID | delete | deleteUrl | danger)--(ID | edit | urlEdit | primary)",
]);
?>