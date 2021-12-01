<?php adminHeader(["ss", "ss"],["ss","ss"] ,"messages"); ?>
<?php
global $actual_link;
$link = $actual_link;
if (strpos($actual_link, "?type") !== false){
    $link = explode("?type", $actual_link);
    $link = $link[0];
}
?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body row">
                <div class="col-lg-8">
                    <select class="form-control" id="message-type">
                        <option value=""><?php sc("please-select-message-type"); ?></option>
                        <option value="0"><?php sc("product-comments"); ?></option>
                        <option value="1"><?php sc("category-comments"); ?></option>
                        <option value="2"><?php sc("contact-messages"); ?></option>
                    </select>
                </div>
                <div class="col-lg-2 text-right">
                    <button onclick="filterMessages('<?php echo $link; ?>')" class="btn btn-primary h-100"><?php sc("filter"); ?></button>
                </div>
            </div>
        </div>
    </div>
<?php
adminLister("c-t-p", falseToArray($messages) ,[
    "message--Comment",
    "name--Name",
    "email--Email",
    "phone--Phone",
    "posted-date--PostDate"
]);
?>