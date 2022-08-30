<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$ReportTotesView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { report_totes: currentTable } });
var currentForm, currentPageID;
var freport_totesview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    freport_totesview = new ew.Form("freport_totesview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = freport_totesview;
    loadjs.done("freport_totesview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="freport_totesview" id="freport_totesview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="report_totes">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_totes_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_report_totes_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
    <tr id="r_store_id"<?= $Page->store_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_totes_store_id"><?= $Page->store_id->caption() ?></span></td>
        <td data-name="store_id"<?= $Page->store_id->cellAttributes() ?>>
<span id="el_report_totes_store_id">
<span<?= $Page->store_id->viewAttributes() ?>>
<?= $Page->store_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
    <tr id="r_store_name"<?= $Page->store_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_totes_store_name"><?= $Page->store_name->caption() ?></span></td>
        <td data-name="store_name"<?= $Page->store_name->cellAttributes() ?>>
<span id="el_report_totes_store_name">
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->out->Visible) { // out ?>
    <tr id="r_out"<?= $Page->out->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_totes_out"><?= $Page->out->caption() ?></span></td>
        <td data-name="out"<?= $Page->out->cellAttributes() ?>>
<span id="el_report_totes_out">
<span<?= $Page->out->viewAttributes() ?>>
<?= $Page->out->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->in->Visible) { // in ?>
    <tr id="r_in"<?= $Page->in->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_totes_in"><?= $Page->in->caption() ?></span></td>
        <td data-name="in"<?= $Page->in->cellAttributes() ?>>
<span id="el_report_totes_in">
<span<?= $Page->in->viewAttributes() ?>>
<?= $Page->in->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->diff->Visible) { // diff ?>
    <tr id="r_diff"<?= $Page->diff->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_totes_diff"><?= $Page->diff->caption() ?></span></td>
        <td data-name="diff"<?= $Page->diff->cellAttributes() ?>>
<span id="el_report_totes_diff">
<span<?= $Page->diff->viewAttributes() ?>>
<?= $Page->diff->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->remarks->Visible) { // remarks ?>
    <tr id="r_remarks"<?= $Page->remarks->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_totes_remarks"><?= $Page->remarks->caption() ?></span></td>
        <td data-name="remarks"<?= $Page->remarks->cellAttributes() ?>>
<span id="el_report_totes_remarks">
<span<?= $Page->remarks->viewAttributes() ?>>
<?= $Page->remarks->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_out->Visible) { // date_out ?>
    <tr id="r_date_out"<?= $Page->date_out->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_totes_date_out"><?= $Page->date_out->caption() ?></span></td>
        <td data-name="date_out"<?= $Page->date_out->cellAttributes() ?>>
<span id="el_report_totes_date_out">
<span<?= $Page->date_out->viewAttributes() ?>>
<?= $Page->date_out->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_in->Visible) { // date_in ?>
    <tr id="r_date_in"<?= $Page->date_in->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_totes_date_in"><?= $Page->date_in->caption() ?></span></td>
        <td data-name="date_in"<?= $Page->date_in->cellAttributes() ?>>
<span id="el_report_totes_date_in">
<span<?= $Page->date_in->viewAttributes() ?>>
<?= $Page->date_in->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
