<?php
adminHeader(["asd",""], ["sdsa", "d"], "References", "navbarLinkAdd", "navbar-link-add");
adminLister("c-t", falseToArray($navbar), [
    "text--Text",
    "link--Link--link",
    "sequance--Sequance",
    "action--btn--(ID | delete | deleteNavbarLink | danger)--(ID | edit | navbarLinkEdit | primary)",
]);
?>