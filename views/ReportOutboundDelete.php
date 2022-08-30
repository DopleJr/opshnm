<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$ReportOutboundDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { report_outbound: currentTable } });
var currentForm, currentPageID;
var freport_outbounddelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    freport_outbounddelete = new ew.Form("freport_outbounddelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = freport_outbounddelete;
    loadjs.done("freport_outbounddelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="freport_outbounddelete" id="freport_outbounddelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="report_outbound">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table table-bordered table-hover table-sm ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->Week->Visible) { // Week ?>
        <th class="<?= $Page->Week->headerCellClass() ?>"><span id="elh_report_outbound_Week" class="report_outbound_Week"><?= $Page->Week->caption() ?></span></th>
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
        <th class="<?= $Page->box_id->headerCellClass() ?>"><span id="elh_report_outbound_box_id" class="report_outbound_box_id"><?= $Page->box_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_delivery->Visible) { // date_delivery ?>
        <th class="<?= $Page->date_delivery->headerCellClass() ?>"><span id="elh_report_outbound_date_delivery" class="report_outbound_date_delivery"><?= $Page->date_delivery->caption() ?></span></th>
<?php } ?>
<?php if ($Page->box_type->Visible) { // box_type ?>
        <th class="<?= $Page->box_type->headerCellClass() ?>"><span id="elh_report_outbound_box_type" class="report_outbound_box_type"><?= $Page->box_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->check_by->Visible) { // check_by ?>
        <th class="<?= $Page->check_by->headerCellClass() ?>"><span id="elh_report_outbound_check_by" class="report_outbound_check_by"><?= $Page->check_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <th class="<?= $Page->quantity->headerCellClass() ?>"><span id="elh_report_outbound_quantity" class="report_outbound_quantity"><?= $Page->quantity->caption() ?></span></th>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
        <th class="<?= $Page->concept->headerCellClass() ?>"><span id="elh_report_outbound_concept" class="report_outbound_concept"><?= $Page->concept->caption() ?></span></th>
<?php } ?>
<?php if ($Page->store_code->Visible) { // store_code ?>
        <th class="<?= $Page->store_code->headerCellClass() ?>"><span id="elh_report_outbound_store_code" class="report_outbound_store_code"><?= $Page->store_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
        <th class="<?= $Page->store_name->headerCellClass() ?>"><span id="elh_report_outbound_store_name" class="report_outbound_store_name"><?= $Page->store_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->remark->Visible) { // remark ?>
        <th class="<?= $Page->remark->headerCellClass() ?>"><span id="elh_report_outbound_remark" class="report_outbound_remark"><?= $Page->remark->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_delivery->Visible) { // no_delivery ?>
        <th class="<?= $Page->no_delivery->headerCellClass() ?>"><span id="elh_report_outbound_no_delivery" class="report_outbound_no_delivery"><?= $Page->no_delivery->caption() ?></span></th>
<?php } ?>
<?php if ($Page->truck_type->Visible) { // truck_type ?>
        <th class="<?= $Page->truck_type->headerCellClass() ?>"><span id="elh_report_outbound_truck_type" class="report_outbound_truck_type"><?= $Page->truck_type->caption() ?></span></th>
<?php } ?>
<?php if ($Page->seal_no->Visible) { // seal_no ?>
        <th class="<?= $Page->seal_no->headerCellClass() ?>"><span id="elh_report_outbound_seal_no" class="report_outbound_seal_no"><?= $Page->seal_no->caption() ?></span></th>
<?php } ?>
<?php if ($Page->truck_plate->Visible) { // truck_plate ?>
        <th class="<?= $Page->truck_plate->headerCellClass() ?>"><span id="elh_report_outbound_truck_plate" class="report_outbound_truck_plate"><?= $Page->truck_plate->caption() ?></span></th>
<?php } ?>
<?php if ($Page->transporter->Visible) { // transporter ?>
        <th class="<?= $Page->transporter->headerCellClass() ?>"><span id="elh_report_outbound_transporter" class="report_outbound_transporter"><?= $Page->transporter->caption() ?></span></th>
<?php } ?>
<?php if ($Page->no_hp->Visible) { // no_hp ?>
        <th class="<?= $Page->no_hp->headerCellClass() ?>"><span id="elh_report_outbound_no_hp" class="report_outbound_no_hp"><?= $Page->no_hp->caption() ?></span></th>
<?php } ?>
<?php if ($Page->checker->Visible) { // checker ?>
        <th class="<?= $Page->checker->headerCellClass() ?>"><span id="elh_report_outbound_checker" class="report_outbound_checker"><?= $Page->checker->caption() ?></span></th>
<?php } ?>
<?php if ($Page->admin->Visible) { // admin ?>
        <th class="<?= $Page->admin->headerCellClass() ?>"><span id="elh_report_outbound_admin" class="report_outbound_admin"><?= $Page->admin->caption() ?></span></th>
<?php } ?>
<?php if ($Page->remarks_box->Visible) { // remarks_box ?>
        <th class="<?= $Page->remarks_box->headerCellClass() ?>"><span id="elh_report_outbound_remarks_box" class="report_outbound_remarks_box"><?= $Page->remarks_box->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <th class="<?= $Page->date_created->headerCellClass() ?>"><span id="elh_report_outbound_date_created" class="report_outbound_date_created"><?= $Page->date_created->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <th class="<?= $Page->date_updated->headerCellClass() ?>"><span id="elh_report_outbound_date_updated" class="report_outbound_date_updated"><?= $Page->date_updated->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->Week->Visible) { // Week ?>
        <td<?= $Page->Week->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_Week" class="el_report_outbound_Week">
<span<?= $Page->Week->viewAttributes() ?>>
<?= $Page->Week->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
        <td<?= $Page->box_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_box_id" class="el_report_outbound_box_id">
<span<?= $Page->box_id->viewAttributes() ?>>
<?= $Page->box_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_delivery->Visible) { // date_delivery ?>
        <td<?= $Page->date_delivery->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_date_delivery" class="el_report_outbound_date_delivery">
<span<?= $Page->date_delivery->viewAttributes() ?>>
<?= $Page->date_delivery->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->box_type->Visible) { // box_type ?>
        <td<?= $Page->box_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_box_type" class="el_report_outbound_box_type">
<span<?= $Page->box_type->viewAttributes() ?>>
<?= $Page->box_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->check_by->Visible) { // check_by ?>
        <td<?= $Page->check_by->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_check_by" class="el_report_outbound_check_by">
<span<?= $Page->check_by->viewAttributes() ?>>
<?= $Page->check_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
        <td<?= $Page->quantity->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_quantity" class="el_report_outbound_quantity">
<span<?= $Page->quantity->viewAttributes() ?>>
<?= $Page->quantity->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
        <td<?= $Page->concept->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_concept" class="el_report_outbound_concept">
<span<?= $Page->concept->viewAttributes() ?>>
<?= $Page->concept->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->store_code->Visible) { // store_code ?>
        <td<?= $Page->store_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_store_code" class="el_report_outbound_store_code">
<span<?= $Page->store_code->viewAttributes() ?>>
<?= $Page->store_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
        <td<?= $Page->store_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_store_name" class="el_report_outbound_store_name">
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->remark->Visible) { // remark ?>
        <td<?= $Page->remark->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_remark" class="el_report_outbound_remark">
<span<?= $Page->remark->viewAttributes() ?>>
<?= $Page->remark->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_delivery->Visible) { // no_delivery ?>
        <td<?= $Page->no_delivery->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_no_delivery" class="el_report_outbound_no_delivery">
<span<?= $Page->no_delivery->viewAttributes() ?>>
<?= $Page->no_delivery->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->truck_type->Visible) { // truck_type ?>
        <td<?= $Page->truck_type->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_truck_type" class="el_report_outbound_truck_type">
<span<?= $Page->truck_type->viewAttributes() ?>>
<?= $Page->truck_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->seal_no->Visible) { // seal_no ?>
        <td<?= $Page->seal_no->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_seal_no" class="el_report_outbound_seal_no">
<span<?= $Page->seal_no->viewAttributes() ?>>
<?= $Page->seal_no->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->truck_plate->Visible) { // truck_plate ?>
        <td<?= $Page->truck_plate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_truck_plate" class="el_report_outbound_truck_plate">
<span<?= $Page->truck_plate->viewAttributes() ?>>
<?= $Page->truck_plate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->transporter->Visible) { // transporter ?>
        <td<?= $Page->transporter->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_transporter" class="el_report_outbound_transporter">
<span<?= $Page->transporter->viewAttributes() ?>>
<?= $Page->transporter->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->no_hp->Visible) { // no_hp ?>
        <td<?= $Page->no_hp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_no_hp" class="el_report_outbound_no_hp">
<span<?= $Page->no_hp->viewAttributes() ?>>
<?= $Page->no_hp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->checker->Visible) { // checker ?>
        <td<?= $Page->checker->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_checker" class="el_report_outbound_checker">
<span<?= $Page->checker->viewAttributes() ?>>
<?= $Page->checker->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->admin->Visible) { // admin ?>
        <td<?= $Page->admin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_admin" class="el_report_outbound_admin">
<span<?= $Page->admin->viewAttributes() ?>>
<?= $Page->admin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->remarks_box->Visible) { // remarks_box ?>
        <td<?= $Page->remarks_box->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_remarks_box" class="el_report_outbound_remarks_box">
<span<?= $Page->remarks_box->viewAttributes() ?>>
<?= $Page->remarks_box->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
        <td<?= $Page->date_created->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_date_created" class="el_report_outbound_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<?= $Page->date_created->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
        <td<?= $Page->date_updated->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_report_outbound_date_updated" class="el_report_outbound_date_updated">
<span<?= $Page->date_updated->viewAttributes() ?>>
<?= $Page->date_updated->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
