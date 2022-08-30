<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$ReportOutboundEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { report_outbound: currentTable } });
var currentForm, currentPageID;
var freport_outboundedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    freport_outboundedit = new ew.Form("freport_outboundedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = freport_outboundedit;

    // Add fields
    var fields = currentTable.fields;
    freport_outboundedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["Week", [fields.Week.visible && fields.Week.required ? ew.Validators.required(fields.Week.caption) : null], fields.Week.isInvalid],
        ["box_id", [fields.box_id.visible && fields.box_id.required ? ew.Validators.required(fields.box_id.caption) : null], fields.box_id.isInvalid],
        ["date_delivery", [fields.date_delivery.visible && fields.date_delivery.required ? ew.Validators.required(fields.date_delivery.caption) : null, ew.Validators.datetime(fields.date_delivery.clientFormatPattern)], fields.date_delivery.isInvalid],
        ["box_type", [fields.box_type.visible && fields.box_type.required ? ew.Validators.required(fields.box_type.caption) : null], fields.box_type.isInvalid],
        ["check_by", [fields.check_by.visible && fields.check_by.required ? ew.Validators.required(fields.check_by.caption) : null], fields.check_by.isInvalid],
        ["quantity", [fields.quantity.visible && fields.quantity.required ? ew.Validators.required(fields.quantity.caption) : null], fields.quantity.isInvalid],
        ["concept", [fields.concept.visible && fields.concept.required ? ew.Validators.required(fields.concept.caption) : null], fields.concept.isInvalid],
        ["store_code", [fields.store_code.visible && fields.store_code.required ? ew.Validators.required(fields.store_code.caption) : null], fields.store_code.isInvalid],
        ["store_name", [fields.store_name.visible && fields.store_name.required ? ew.Validators.required(fields.store_name.caption) : null], fields.store_name.isInvalid],
        ["remark", [fields.remark.visible && fields.remark.required ? ew.Validators.required(fields.remark.caption) : null], fields.remark.isInvalid],
        ["no_delivery", [fields.no_delivery.visible && fields.no_delivery.required ? ew.Validators.required(fields.no_delivery.caption) : null], fields.no_delivery.isInvalid],
        ["truck_type", [fields.truck_type.visible && fields.truck_type.required ? ew.Validators.required(fields.truck_type.caption) : null], fields.truck_type.isInvalid],
        ["seal_no", [fields.seal_no.visible && fields.seal_no.required ? ew.Validators.required(fields.seal_no.caption) : null], fields.seal_no.isInvalid],
        ["truck_plate", [fields.truck_plate.visible && fields.truck_plate.required ? ew.Validators.required(fields.truck_plate.caption) : null], fields.truck_plate.isInvalid],
        ["transporter", [fields.transporter.visible && fields.transporter.required ? ew.Validators.required(fields.transporter.caption) : null], fields.transporter.isInvalid],
        ["no_hp", [fields.no_hp.visible && fields.no_hp.required ? ew.Validators.required(fields.no_hp.caption) : null], fields.no_hp.isInvalid],
        ["checker", [fields.checker.visible && fields.checker.required ? ew.Validators.required(fields.checker.caption) : null], fields.checker.isInvalid],
        ["admin", [fields.admin.visible && fields.admin.required ? ew.Validators.required(fields.admin.caption) : null], fields.admin.isInvalid],
        ["remarks_box", [fields.remarks_box.visible && fields.remarks_box.required ? ew.Validators.required(fields.remarks_box.caption) : null], fields.remarks_box.isInvalid],
        ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
        ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null], fields.date_updated.isInvalid]
    ]);

    // Form_CustomValidate
    freport_outboundedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    freport_outboundedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("freport_outboundedit");
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
<form name="freport_outboundedit" id="freport_outboundedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="report_outbound">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_report_outbound_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_report_outbound_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="report_outbound" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->Week->Visible) { // Week ?>
    <div id="r_Week"<?= $Page->Week->rowAttributes() ?>>
        <label id="elh_report_outbound_Week" for="x_Week" class="<?= $Page->LeftColumnClass ?>"><?= $Page->Week->caption() ?><?= $Page->Week->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->Week->cellAttributes() ?>>
<span id="el_report_outbound_Week">
<input type="<?= $Page->Week->getInputTextType() ?>" name="x_Week" id="x_Week" data-table="report_outbound" data-field="x_Week" value="<?= $Page->Week->EditValue ?>" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->Week->getPlaceHolder()) ?>"<?= $Page->Week->editAttributes() ?> aria-describedby="x_Week_help">
<?= $Page->Week->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->Week->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
    <div id="r_box_id"<?= $Page->box_id->rowAttributes() ?>>
        <label id="elh_report_outbound_box_id" for="x_box_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->box_id->caption() ?><?= $Page->box_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->box_id->cellAttributes() ?>>
<span id="el_report_outbound_box_id">
<input type="<?= $Page->box_id->getInputTextType() ?>" name="x_box_id" id="x_box_id" data-table="report_outbound" data-field="x_box_id" value="<?= $Page->box_id->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->box_id->getPlaceHolder()) ?>"<?= $Page->box_id->editAttributes() ?> aria-describedby="x_box_id_help">
<?= $Page->box_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->box_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_delivery->Visible) { // date_delivery ?>
    <div id="r_date_delivery"<?= $Page->date_delivery->rowAttributes() ?>>
        <label id="elh_report_outbound_date_delivery" for="x_date_delivery" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_delivery->caption() ?><?= $Page->date_delivery->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_delivery->cellAttributes() ?>>
<span id="el_report_outbound_date_delivery">
<input type="<?= $Page->date_delivery->getInputTextType() ?>" name="x_date_delivery" id="x_date_delivery" data-table="report_outbound" data-field="x_date_delivery" value="<?= $Page->date_delivery->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_delivery->getPlaceHolder()) ?>"<?= $Page->date_delivery->editAttributes() ?> aria-describedby="x_date_delivery_help">
<?= $Page->date_delivery->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_delivery->getErrorMessage() ?></div>
<?php if (!$Page->date_delivery->ReadOnly && !$Page->date_delivery->Disabled && !isset($Page->date_delivery->EditAttrs["readonly"]) && !isset($Page->date_delivery->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freport_outboundedit", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem()
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                    next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                },
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i),
                    useTwentyfourHour: !!format.match(/H/)
                }
            },
            meta: {
                format
            }
        };
    ew.createDateTimePicker("freport_outboundedit", "x_date_delivery", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->box_type->Visible) { // box_type ?>
    <div id="r_box_type"<?= $Page->box_type->rowAttributes() ?>>
        <label id="elh_report_outbound_box_type" for="x_box_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->box_type->caption() ?><?= $Page->box_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->box_type->cellAttributes() ?>>
<span id="el_report_outbound_box_type">
<input type="<?= $Page->box_type->getInputTextType() ?>" name="x_box_type" id="x_box_type" data-table="report_outbound" data-field="x_box_type" value="<?= $Page->box_type->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->box_type->getPlaceHolder()) ?>"<?= $Page->box_type->editAttributes() ?> aria-describedby="x_box_type_help">
<?= $Page->box_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->box_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->check_by->Visible) { // check_by ?>
    <div id="r_check_by"<?= $Page->check_by->rowAttributes() ?>>
        <label id="elh_report_outbound_check_by" for="x_check_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->check_by->caption() ?><?= $Page->check_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->check_by->cellAttributes() ?>>
<span id="el_report_outbound_check_by">
<input type="<?= $Page->check_by->getInputTextType() ?>" name="x_check_by" id="x_check_by" data-table="report_outbound" data-field="x_check_by" value="<?= $Page->check_by->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->check_by->getPlaceHolder()) ?>"<?= $Page->check_by->editAttributes() ?> aria-describedby="x_check_by_help">
<?= $Page->check_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->check_by->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
    <div id="r_quantity"<?= $Page->quantity->rowAttributes() ?>>
        <label id="elh_report_outbound_quantity" for="x_quantity" class="<?= $Page->LeftColumnClass ?>"><?= $Page->quantity->caption() ?><?= $Page->quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->quantity->cellAttributes() ?>>
<span id="el_report_outbound_quantity">
<input type="<?= $Page->quantity->getInputTextType() ?>" name="x_quantity" id="x_quantity" data-table="report_outbound" data-field="x_quantity" value="<?= $Page->quantity->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->quantity->getPlaceHolder()) ?>"<?= $Page->quantity->editAttributes() ?> aria-describedby="x_quantity_help">
<?= $Page->quantity->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->quantity->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
    <div id="r_concept"<?= $Page->concept->rowAttributes() ?>>
        <label id="elh_report_outbound_concept" for="x_concept" class="<?= $Page->LeftColumnClass ?>"><?= $Page->concept->caption() ?><?= $Page->concept->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->concept->cellAttributes() ?>>
<span id="el_report_outbound_concept">
<input type="<?= $Page->concept->getInputTextType() ?>" name="x_concept" id="x_concept" data-table="report_outbound" data-field="x_concept" value="<?= $Page->concept->EditValue ?>" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->concept->getPlaceHolder()) ?>"<?= $Page->concept->editAttributes() ?> aria-describedby="x_concept_help">
<?= $Page->concept->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->concept->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_code->Visible) { // store_code ?>
    <div id="r_store_code"<?= $Page->store_code->rowAttributes() ?>>
        <label id="elh_report_outbound_store_code" for="x_store_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->store_code->caption() ?><?= $Page->store_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_code->cellAttributes() ?>>
<span id="el_report_outbound_store_code">
<input type="<?= $Page->store_code->getInputTextType() ?>" name="x_store_code" id="x_store_code" data-table="report_outbound" data-field="x_store_code" value="<?= $Page->store_code->EditValue ?>" size="30" maxlength="4" placeholder="<?= HtmlEncode($Page->store_code->getPlaceHolder()) ?>"<?= $Page->store_code->editAttributes() ?> aria-describedby="x_store_code_help">
<?= $Page->store_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->store_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
    <div id="r_store_name"<?= $Page->store_name->rowAttributes() ?>>
        <label id="elh_report_outbound_store_name" for="x_store_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->store_name->caption() ?><?= $Page->store_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_name->cellAttributes() ?>>
<span id="el_report_outbound_store_name">
<input type="<?= $Page->store_name->getInputTextType() ?>" name="x_store_name" id="x_store_name" data-table="report_outbound" data-field="x_store_name" value="<?= $Page->store_name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->store_name->getPlaceHolder()) ?>"<?= $Page->store_name->editAttributes() ?> aria-describedby="x_store_name_help">
<?= $Page->store_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->store_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->remark->Visible) { // remark ?>
    <div id="r_remark"<?= $Page->remark->rowAttributes() ?>>
        <label id="elh_report_outbound_remark" for="x_remark" class="<?= $Page->LeftColumnClass ?>"><?= $Page->remark->caption() ?><?= $Page->remark->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->remark->cellAttributes() ?>>
<span id="el_report_outbound_remark">
<input type="<?= $Page->remark->getInputTextType() ?>" name="x_remark" id="x_remark" data-table="report_outbound" data-field="x_remark" value="<?= $Page->remark->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->remark->getPlaceHolder()) ?>"<?= $Page->remark->editAttributes() ?> aria-describedby="x_remark_help">
<?= $Page->remark->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->remark->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_delivery->Visible) { // no_delivery ?>
    <div id="r_no_delivery"<?= $Page->no_delivery->rowAttributes() ?>>
        <label id="elh_report_outbound_no_delivery" for="x_no_delivery" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_delivery->caption() ?><?= $Page->no_delivery->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->no_delivery->cellAttributes() ?>>
<span id="el_report_outbound_no_delivery">
<input type="<?= $Page->no_delivery->getInputTextType() ?>" name="x_no_delivery" id="x_no_delivery" data-table="report_outbound" data-field="x_no_delivery" value="<?= $Page->no_delivery->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->no_delivery->getPlaceHolder()) ?>"<?= $Page->no_delivery->editAttributes() ?> aria-describedby="x_no_delivery_help">
<?= $Page->no_delivery->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_delivery->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->truck_type->Visible) { // truck_type ?>
    <div id="r_truck_type"<?= $Page->truck_type->rowAttributes() ?>>
        <label id="elh_report_outbound_truck_type" for="x_truck_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->truck_type->caption() ?><?= $Page->truck_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->truck_type->cellAttributes() ?>>
<span id="el_report_outbound_truck_type">
<input type="<?= $Page->truck_type->getInputTextType() ?>" name="x_truck_type" id="x_truck_type" data-table="report_outbound" data-field="x_truck_type" value="<?= $Page->truck_type->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->truck_type->getPlaceHolder()) ?>"<?= $Page->truck_type->editAttributes() ?> aria-describedby="x_truck_type_help">
<?= $Page->truck_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->truck_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->seal_no->Visible) { // seal_no ?>
    <div id="r_seal_no"<?= $Page->seal_no->rowAttributes() ?>>
        <label id="elh_report_outbound_seal_no" for="x_seal_no" class="<?= $Page->LeftColumnClass ?>"><?= $Page->seal_no->caption() ?><?= $Page->seal_no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->seal_no->cellAttributes() ?>>
<span id="el_report_outbound_seal_no">
<input type="<?= $Page->seal_no->getInputTextType() ?>" name="x_seal_no" id="x_seal_no" data-table="report_outbound" data-field="x_seal_no" value="<?= $Page->seal_no->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->seal_no->getPlaceHolder()) ?>"<?= $Page->seal_no->editAttributes() ?> aria-describedby="x_seal_no_help">
<?= $Page->seal_no->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->seal_no->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->truck_plate->Visible) { // truck_plate ?>
    <div id="r_truck_plate"<?= $Page->truck_plate->rowAttributes() ?>>
        <label id="elh_report_outbound_truck_plate" for="x_truck_plate" class="<?= $Page->LeftColumnClass ?>"><?= $Page->truck_plate->caption() ?><?= $Page->truck_plate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->truck_plate->cellAttributes() ?>>
<span id="el_report_outbound_truck_plate">
<input type="<?= $Page->truck_plate->getInputTextType() ?>" name="x_truck_plate" id="x_truck_plate" data-table="report_outbound" data-field="x_truck_plate" value="<?= $Page->truck_plate->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->truck_plate->getPlaceHolder()) ?>"<?= $Page->truck_plate->editAttributes() ?> aria-describedby="x_truck_plate_help">
<?= $Page->truck_plate->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->truck_plate->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->transporter->Visible) { // transporter ?>
    <div id="r_transporter"<?= $Page->transporter->rowAttributes() ?>>
        <label id="elh_report_outbound_transporter" for="x_transporter" class="<?= $Page->LeftColumnClass ?>"><?= $Page->transporter->caption() ?><?= $Page->transporter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->transporter->cellAttributes() ?>>
<span id="el_report_outbound_transporter">
<input type="<?= $Page->transporter->getInputTextType() ?>" name="x_transporter" id="x_transporter" data-table="report_outbound" data-field="x_transporter" value="<?= $Page->transporter->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->transporter->getPlaceHolder()) ?>"<?= $Page->transporter->editAttributes() ?> aria-describedby="x_transporter_help">
<?= $Page->transporter->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->transporter->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_hp->Visible) { // no_hp ?>
    <div id="r_no_hp"<?= $Page->no_hp->rowAttributes() ?>>
        <label id="elh_report_outbound_no_hp" for="x_no_hp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_hp->caption() ?><?= $Page->no_hp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->no_hp->cellAttributes() ?>>
<span id="el_report_outbound_no_hp">
<input type="<?= $Page->no_hp->getInputTextType() ?>" name="x_no_hp" id="x_no_hp" data-table="report_outbound" data-field="x_no_hp" value="<?= $Page->no_hp->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->no_hp->getPlaceHolder()) ?>"<?= $Page->no_hp->editAttributes() ?> aria-describedby="x_no_hp_help">
<?= $Page->no_hp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_hp->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->checker->Visible) { // checker ?>
    <div id="r_checker"<?= $Page->checker->rowAttributes() ?>>
        <label id="elh_report_outbound_checker" for="x_checker" class="<?= $Page->LeftColumnClass ?>"><?= $Page->checker->caption() ?><?= $Page->checker->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->checker->cellAttributes() ?>>
<span id="el_report_outbound_checker">
<input type="<?= $Page->checker->getInputTextType() ?>" name="x_checker" id="x_checker" data-table="report_outbound" data-field="x_checker" value="<?= $Page->checker->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->checker->getPlaceHolder()) ?>"<?= $Page->checker->editAttributes() ?> aria-describedby="x_checker_help">
<?= $Page->checker->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->checker->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->admin->Visible) { // admin ?>
    <div id="r_admin"<?= $Page->admin->rowAttributes() ?>>
        <label id="elh_report_outbound_admin" for="x_admin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->admin->caption() ?><?= $Page->admin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->admin->cellAttributes() ?>>
<span id="el_report_outbound_admin">
<input type="<?= $Page->admin->getInputTextType() ?>" name="x_admin" id="x_admin" data-table="report_outbound" data-field="x_admin" value="<?= $Page->admin->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->admin->getPlaceHolder()) ?>"<?= $Page->admin->editAttributes() ?> aria-describedby="x_admin_help">
<?= $Page->admin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->admin->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->remarks_box->Visible) { // remarks_box ?>
    <div id="r_remarks_box"<?= $Page->remarks_box->rowAttributes() ?>>
        <label id="elh_report_outbound_remarks_box" for="x_remarks_box" class="<?= $Page->LeftColumnClass ?>"><?= $Page->remarks_box->caption() ?><?= $Page->remarks_box->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->remarks_box->cellAttributes() ?>>
<span id="el_report_outbound_remarks_box">
<input type="<?= $Page->remarks_box->getInputTextType() ?>" name="x_remarks_box" id="x_remarks_box" data-table="report_outbound" data-field="x_remarks_box" value="<?= $Page->remarks_box->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->remarks_box->getPlaceHolder()) ?>"<?= $Page->remarks_box->editAttributes() ?> aria-describedby="x_remarks_box_help">
<?= $Page->remarks_box->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->remarks_box->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <div id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <label id="elh_report_outbound_date_created" for="x_date_created" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_created->caption() ?><?= $Page->date_created->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_created->cellAttributes() ?>>
<span id="el_report_outbound_date_created">
<input type="<?= $Page->date_created->getInputTextType() ?>" name="x_date_created" id="x_date_created" data-table="report_outbound" data-field="x_date_created" value="<?= $Page->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_created->getPlaceHolder()) ?>"<?= $Page->date_created->editAttributes() ?> aria-describedby="x_date_created_help">
<?= $Page->date_created->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_created->getErrorMessage() ?></div>
<?php if (!$Page->date_created->ReadOnly && !$Page->date_created->Disabled && !isset($Page->date_created->EditAttrs["readonly"]) && !isset($Page->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freport_outboundedit", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem()
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                    next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                },
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i),
                    useTwentyfourHour: !!format.match(/H/)
                }
            },
            meta: {
                format
            }
        };
    ew.createDateTimePicker("freport_outboundedit", "x_date_created", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("report_outbound");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
