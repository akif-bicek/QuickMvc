<?php
adminHeader(["",""],["",""], "team" ,"teamAdd", "add-team");
adminLister("c-t", falseToArray($team), [
    "image--ImagePath--image",
    "name--Name",
    "content--Content",
    "action--btn--(ID | delete | deleteTeam | danger)--(ID | edit | teamEdit | primary)",
]);
?>