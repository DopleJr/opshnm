<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$ReportOutboundView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { report_outbound: currentTable } });
var currentForm, currentPageID;
var freport_outboundview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    freport_outboundview = new ew.Form("freport_outboundview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = freport_outboundview;
    loadjs.done("freport_outboundview");
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
<form name="freport_outboundview" id="freport_outboundview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="report_outbound">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_outbound_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_report_outbound_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->Week->Visible) { // Week ?>
    <tr id="r_Week"<?= $Page->Week->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_outbound_Week"><?= $Page->Week->caption() ?></span></td>
        <td data-name="Week"<?= $Page->Week->cellAttributes() ?>>
<span id="el_report_outbound_Week">
<span<?= $Page->Week->viewAttributes() ?>>
<?= $Page->Week->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
    <tr id="r_box_id"<?= $Page->box_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_outbound_box_id"><?= $Page->box_id->caption() ?></span></td>
        <td data-name="box_id"<?= $Page->box_id->cellAttributes() ?>>
<span id="el_report_outbound_box_id">
<span<?= $Page->box_id->viewAttributes() ?>>
<?= $Page->box_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_delivery->Visible) { // date_delivery ?>
    <tr id="r_date_delivery"<?= $Page->date_delivery->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_outbound_date_delivery"><?= $Page->date_delivery->caption() ?></span></td>
        <td data-name="date_delivery"<?= $Page->date_delivery->cellAttributes() ?>>
<span id="el_report_outbound_date_delivery">
<span<?= $Page->date_delivery->viewAttributes() ?>>
<?= $Page->date_delivery->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->box_type->Visible) { // box_type ?>
    <tr id="r_box_type"<?= $Page->box_type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_outbound_box_type"><?= $Page->box_type->caption() ?></span></td>
        <td data-name="box_type"<?= $Page->box_type->cellAttributes() ?>>
<span id="el_report_outbound_box_type">
<span<?= $Page->box_type->viewAttributes() ?>>
<?= $Page->box_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->check_by->Visible) { // check_by ?>
    <tr id="r_check_by"<?= $Page->check_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_outbound_check_by"><?= $Page->check_by->caption() ?></span></td>
        <td data-name="check_by"<?= $Page->check_by->cellAttributes() ?>>
<span id="el_report_outbound_check_by">
<span<?= $Page->check_by->viewAttributes() ?>>
<?= $Page->check_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
    <tr id="r_quantity"<?= $Page->quantity->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_outbound_quantity"><?= $Page->quantity->caption() ?></span></td>
        <td data-name="quantity"<?= $Page->quantity->cellAttributes() ?>>
<span id="el_report_outbound_quantity">
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
    <tr id="r_concept"<?= $Page->concept->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_outbound_concept"><?= $Page->concept->caption() ?></span></td>
        <td data-name="concept"<?= $Page->concept->cellAttributes() ?>>
<span id="el_report_outbound_concept">
<span<?= $Page->concept->viewAttributes() ?>>
<?= $Page->concept->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->store_code->Visible) { // store_code ?>
    <tr id="r_store_code"<?= $Page->store_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_outbound_store_code"><?= $Page->store_code->caption() ?></span></td>
        <td data-name="store_code"<?= $Page->store_code->cellAttributes() ?>>
<span id="el_report_outbound_store_code">
<span<?= $Page->store_code->viewAttributes() ?>>
<?= $Page->store_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
    <tr id="r_store_name"<?= $Page->store_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_outbound_store_name"><?= $Page->store_name->caption() ?></span></td>
        <td data-name="store_name"<?= $Page->store_name->cellAttributes() ?>>
<span id="el_report_outbound_store_name">
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->remark->Visible) { // remark ?>
    <tr id="r_remark"<?= $Page->remark->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_outbound_remark"><?= $Page->remark->caption() ?></span></td>
        <td data-name="remark"<?= $Page->remark->cellAttributes() ?>>
<span id="el_report_outbound_remark">
<span<?= $Page->remark->viewAttributes() ?>>
<?= $Page->remark->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_delivery->Visible) { // no_delivery ?>
    <tr id="r_no_delivery"<?= $Page->no_delivery->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_outbound_no_delivery"><?= $Page->no_delivery->caption() ?></span></td>
        <td data-name="no_delivery"<?= $Page->no_delivery->cellAttributes() ?>>
<span id="el_report_outbound_no_delivery">
<span<?= $Page->no_delivery->viewAttributes() ?>>
<?= $Page->no_delivery->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->truck_type->Visible) { // truck_type ?>
    <tr id="r_truck_type"<?= $Page->truck_type->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_outbound_truck_type"><?= $Page->truck_type->caption() ?></span></td>
        <td data-name="truck_type"<?= $Page->truck_type->cellAttributes() ?>>
<span id="el_report_outbound_truck_type">
<span<?= $Page->truck_type->viewAttributes() ?>>
<?= $Page->truck_type->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->seal_no->Visible) { // seal_no ?>
    <tr id="r_seal_no"<?= $Page->seal_no->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_outbound_seal_no"><?= $Page->seal_no->caption() ?></span></td>
        <td data-name="seal_no"<?= $Page->seal_no->cellAttributes() ?>>
<span id="el_report_outbound_seal_no">
<span<?= $Page->seal_no->viewAttributes() ?>>
<?= $Page->seal_no->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->truck_plate->Visible) { // truck_plate ?>
    <tr id="r_truck_plate"<?= $Page->truck_plate->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_outbound_truck_plate"><?= $Page->truck_plate->caption() ?></span></td>
        <td data-name="truck_plate"<?= $Page->truck_plate->cellAttributes() ?>>
<span id="el_report_outbound_truck_plate">
<span<?= $Page->truck_plate->viewAttributes() ?>>
<?= $Page->truck_plate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->transporter->Visible) { // transporter ?>
    <tr id="r_transporter"<?= $Page->transporter->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_outbound_transporter"><?= $Page->transporter->caption() ?></span></td>
        <td data-name="transporter"<?= $Page->transporter->cellAttributes() ?>>
<span id="el_report_outbound_transporter">
<span<?= $Page->transporter->viewAttributes() ?>>
<?= $Page->transporter->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->no_hp->Visible) { // no_hp ?>
    <tr id="r_no_hp"<?= $Page->no_hp->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_outbound_no_hp"><?= $Page->no_hp->caption() ?></span></td>
        <td data-name="no_hp"<?= $Page->no_hp->cellAttributes() ?>>
<span id="el_report_outbound_no_hp">
<span<?= $Page->no_hp->viewAttributes() ?>>
<?= $Page->no_hp->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->checker->Visible) { // checker ?>
    <tr id="r_checker"<?= $Page->checker->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_outbound_checker"><?= $Page->checker->caption() ?></span></td>
        <td data-name="checker"<?= $Page->checker->cellAttributes() ?>>
<span id="el_report_outbound_checker">
<span<?= $Page->checker->viewAttributes() ?>>
<?= $Page->checker->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->admin->Visible) { // admin ?>
    <tr id="r_admin"<?= $Page->admin->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_outbound_admin"><?= $Page->admin->caption() ?></span></td>
        <td data-name="admin"<?= $Page->admin->cellAttributes() ?>>
<span id="el_report_outbound_admin">
<span<?= $Page->admin->viewAttributes() ?>>
<?= $Page->admin->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->remarks_box->Visible) { // remarks_box ?>
    <tr id="r_remarks_box"<?= $Page->remarks_box->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_outbound_remarks_box"><?= $Page->remarks_box->caption() ?></span></td>
        <td data-name="remarks_box"<?= $Page->remarks_box->cellAttributes() ?>>
<span id="el_report_outbound_remarks_box">
<span<?= $Page->remarks_box->viewAttributes() ?>>
<?= $Page->remarks_box->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <tr id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_report_outbound_date_updated"><?= $Page->date_updated->caption() ?></span></td>
        <td data-name="date_updated"<?= $Page->date_updated->cellAttributes() ?>>
<span id="el_report_outbound_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
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
