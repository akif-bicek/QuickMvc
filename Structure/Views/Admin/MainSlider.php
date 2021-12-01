<?php
adminHeader(["akif","sad"], ["sd","ad"], "Blog" ,"mainsliderAdd", "mainslider-add");
adminLister("b-cf", falseToArray($mainslider), [
    "t--Title",
    "te--Caption",
    "i--ImagePath",
    "fb--ID--delete--deleteMainSlider--danger",
    "fb--ID--edit--mainSliderEdit--primary",
    "ft--Sequence--". scr("sequence").": "
]);
?>