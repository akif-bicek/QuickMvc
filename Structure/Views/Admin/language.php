<?php adminHeader(["akif","sad"], ["sd","ad"], "Language"); ?>
<div class="row">
    <div class="col-lg-5">
        <?php
            adminForms([
                ["name", "text", "name", "please-enter-a-name", "enter-name"],
                ["short", "text", "short", "please-enter-language-short", "enter-language-short"],
                ["tag", "text", "tag", "please-enter-language-tag", "enter-language-tag"]
            ],
            "addLanguage");
        ?>
    </div>
    <div class="col-lg-7">
        <?php
            adminLister("c-t", falseToArray($languages), [
                "name--Name",
                "short--Short",
                "tag--Tag",
                "action--btn--(ID | delete | languageDelete | 
                danger)--(ID | edit | languageEdit | primary)--(ID | make-default | defaultLanguage | success | !DefaultLanguage)",
            ]);
        ?>
    </div>
</div>