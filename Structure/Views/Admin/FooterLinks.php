<?php
adminHeader(["asd",""], ["sdsa", "d"], "References", "footerLinkAdd", "footer-link-add");
adminLister("c-t", falseToArray($footer), [
    "text--Text",
    "link--Link--link",
    "Sequance--Sequance",
    "action--btn--(ID | delete | deleteFooterLink | danger)--(ID | edit | footerLinkEdit | primary)",
]);
?>