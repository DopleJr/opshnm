<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$OssManualEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { oss_manual: currentTable } });
var currentForm, currentPageID;
var foss_manualedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    foss_manualedit = new ew.Form("foss_manualedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = foss_manualedit;

    // Add fields
    var fields = currentTable.fields;
    foss_manualedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["date", [fields.date.visible && fields.date.required ? ew.Validators.required(fields.date.caption) : null, ew.Validators.datetime(fields.date.clientFormatPattern)], fields.date.isInvalid],
        ["shipment", [fields.shipment.visible && fields.shipment.required ? ew.Validators.required(fields.shipment.caption) : null], fields.shipment.isInvalid],
        ["pallet_no", [fields.pallet_no.visible && fields.pallet_no.required ? ew.Validators.required(fields.pallet_no.caption) : null, ew.Validators.integer], fields.pallet_no.isInvalid],
        ["sscc", [fields.sscc.visible && fields.sscc.required ? ew.Validators.required(fields.sscc.caption) : null], fields.sscc.isInvalid],
        ["idw", [fields.idw.visible && fields.idw.required ? ew.Validators.required(fields.idw.caption) : null], fields.idw.isInvalid],
        ["order_no", [fields.order_no.visible && fields.order_no.required ? ew.Validators.required(fields.order_no.caption) : null, ew.Validators.integer], fields.order_no.isInvalid],
        ["item_in_ctn", [fields.item_in_ctn.visible && fields.item_in_ctn.required ? ew.Validators.required(fields.item_in_ctn.caption) : null], fields.item_in_ctn.isInvalid],
        ["no_of_ctn", [fields.no_of_ctn.visible && fields.no_of_ctn.required ? ew.Validators.required(fields.no_of_ctn.caption) : null], fields.no_of_ctn.isInvalid],
        ["ctn_no", [fields.ctn_no.visible && fields.ctn_no.required ? ew.Validators.required(fields.ctn_no.caption) : null, ew.Validators.integer], fields.ctn_no.isInvalid],
        ["checker", [fields.checker.visible && fields.checker.required ? ew.Validators.required(fields.checker.caption) : null], fields.checker.isInvalid],
        ["shift", [fields.shift.visible && fields.shift.required ? ew.Validators.required(fields.shift.caption) : null], fields.shift.isInvalid]
    ]);

    // Form_CustomValidate
    foss_manualedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    foss_manualedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    foss_manualedit.lists.shift = <?= $Page->shift->toClientList($Page) ?>;
    loadjs.done("foss_manualedit");
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
<form name="foss_manualedit" id="foss_manualedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="oss_manual">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_oss_manual_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_oss_manual_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="oss_manual" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
    <div id="r_date"<?= $Page->date->rowAttributes() ?>>
        <label id="elh_oss_manual_date" for="x_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date->caption() ?><?= $Page->date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date->cellAttributes() ?>>
<span id="el_oss_manual_date">
<input type="<?= $Page->date->getInputTextType() ?>" name="x_date" id="x_date" data-table="oss_manual" data-field="x_date" value="<?= $Page->date->EditValue ?>" placeholder="<?= HtmlEncode($Page->date->getPlaceHolder()) ?>"<?= $Page->date->editAttributes() ?> aria-describedby="x_date_help">
<?= $Page->date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->shipment->Visible) { // shipment ?>
    <div id="r_shipment"<?= $Page->shipment->rowAttributes() ?>>
        <label id="elh_oss_manual_shipment" for="x_shipment" class="<?= $Page->LeftColumnClass ?>"><?= $Page->shipment->caption() ?><?= $Page->shipment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->shipment->cellAttributes() ?>>
<span id="el_oss_manual_shipment">
<input type="<?= $Page->shipment->getInputTextType() ?>" name="x_shipment" id="x_shipment" data-table="oss_manual" data-field="x_shipment" value="<?= $Page->shipment->EditValue ?>" size="10" maxlength="255" placeholder="<?= HtmlEncode($Page->shipment->getPlaceHolder()) ?>"<?= $Page->shipment->editAttributes() ?> aria-describedby="x_shipment_help">
<?= $Page->shipment->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->shipment->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pallet_no->Visible) { // pallet_no ?>
    <div id="r_pallet_no"<?= $Page->pallet_no->rowAttributes() ?>>
        <label id="elh_oss_manual_pallet_no" for="x_pallet_no" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pallet_no->caption() ?><?= $Page->pallet_no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pallet_no->cellAttributes() ?>>
<span id="el_oss_manual_pallet_no">
<input type="<?= $Page->pallet_no->getInputTextType() ?>" name="x_pallet_no" id="x_pallet_no" data-table="oss_manual" data-field="x_pallet_no" value="<?= $Page->pallet_no->EditValue ?>" size="6" maxlength="6" placeholder="<?= HtmlEncode($Page->pallet_no->getPlaceHolder()) ?>"<?= $Page->pallet_no->editAttributes() ?> aria-describedby="x_pallet_no_help">
<?= $Page->pallet_no->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pallet_no->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sscc->Visible) { // sscc ?>
    <div id="r_sscc"<?= $Page->sscc->rowAttributes() ?>>
        <label id="elh_oss_manual_sscc" for="x_sscc" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sscc->caption() ?><?= $Page->sscc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sscc->cellAttributes() ?>>
<span id="el_oss_manual_sscc">
<input type="<?= $Page->sscc->getInputTextType() ?>" name="x_sscc" id="x_sscc" data-table="oss_manual" data-field="x_sscc" value="<?= $Page->sscc->EditValue ?>" size="20" maxlength="255" placeholder="<?= HtmlEncode($Page->sscc->getPlaceHolder()) ?>"<?= $Page->sscc->editAttributes() ?> aria-describedby="x_sscc_help">
<?= $Page->sscc->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sscc->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->idw->Visible) { // idw ?>
    <div id="r_idw"<?= $Page->idw->rowAttributes() ?>>
        <label id="elh_oss_manual_idw" for="x_idw" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idw->caption() ?><?= $Page->idw->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->idw->cellAttributes() ?>>
<span id="el_oss_manual_idw">
<input type="<?= $Page->idw->getInputTextType() ?>" name="x_idw" id="x_idw" data-table="oss_manual" data-field="x_idw" value="<?= $Page->idw->EditValue ?>" size="3" maxlength="255" placeholder="<?= HtmlEncode($Page->idw->getPlaceHolder()) ?>"<?= $Page->idw->editAttributes() ?> aria-describedby="x_idw_help">
<?= $Page->idw->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->idw->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->order_no->Visible) { // order_no ?>
    <div id="r_order_no"<?= $Page->order_no->rowAttributes() ?>>
        <label id="elh_oss_manual_order_no" for="x_order_no" class="<?= $Page->LeftColumnClass ?>"><?= $Page->order_no->caption() ?><?= $Page->order_no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->order_no->cellAttributes() ?>>
<span id="el_oss_manual_order_no">
<input type="<?= $Page->order_no->getInputTextType() ?>" name="x_order_no" id="x_order_no" data-table="oss_manual" data-field="x_order_no" value="<?= $Page->order_no->EditValue ?>" size="6" maxlength="6" placeholder="<?= HtmlEncode($Page->order_no->getPlaceHolder()) ?>"<?= $Page->order_no->editAttributes() ?> aria-describedby="x_order_no_help">
<?= $Page->order_no->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->order_no->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->item_in_ctn->Visible) { // item_in_ctn ?>
    <div id="r_item_in_ctn"<?= $Page->item_in_ctn->rowAttributes() ?>>
        <label id="elh_oss_manual_item_in_ctn" for="x_item_in_ctn" class="<?= $Page->LeftColumnClass ?>"><?= $Page->item_in_ctn->caption() ?><?= $Page->item_in_ctn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->item_in_ctn->cellAttributes() ?>>
<span id="el_oss_manual_item_in_ctn">
<input type="<?= $Page->item_in_ctn->getInputTextType() ?>" name="x_item_in_ctn" id="x_item_in_ctn" data-table="oss_manual" data-field="x_item_in_ctn" value="<?= $Page->item_in_ctn->EditValue ?>" size="6" maxlength="255" placeholder="<?= HtmlEncode($Page->item_in_ctn->getPlaceHolder()) ?>"<?= $Page->item_in_ctn->editAttributes() ?> aria-describedby="x_item_in_ctn_help">
<?= $Page->item_in_ctn->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->item_in_ctn->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->no_of_ctn->Visible) { // no_of_ctn ?>
    <div id="r_no_of_ctn"<?= $Page->no_of_ctn->rowAttributes() ?>>
        <label id="elh_oss_manual_no_of_ctn" for="x_no_of_ctn" class="<?= $Page->LeftColumnClass ?>"><?= $Page->no_of_ctn->caption() ?><?= $Page->no_of_ctn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->no_of_ctn->cellAttributes() ?>>
<span id="el_oss_manual_no_of_ctn">
<input type="<?= $Page->no_of_ctn->getInputTextType() ?>" name="x_no_of_ctn" id="x_no_of_ctn" data-table="oss_manual" data-field="x_no_of_ctn" value="<?= $Page->no_of_ctn->EditValue ?>" size="4" maxlength="255" placeholder="<?= HtmlEncode($Page->no_of_ctn->getPlaceHolder()) ?>"<?= $Page->no_of_ctn->editAttributes() ?> aria-describedby="x_no_of_ctn_help">
<?= $Page->no_of_ctn->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->no_of_ctn->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ctn_no->Visible) { // ctn_no ?>
    <div id="r_ctn_no"<?= $Page->ctn_no->rowAttributes() ?>>
        <label id="elh_oss_manual_ctn_no" for="x_ctn_no" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ctn_no->caption() ?><?= $Page->ctn_no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ctn_no->cellAttributes() ?>>
<span id="el_oss_manual_ctn_no">
<input type="<?= $Page->ctn_no->getInputTextType() ?>" name="x_ctn_no" id="x_ctn_no" data-table="oss_manual" data-field="x_ctn_no" value="<?= $Page->ctn_no->EditValue ?>" size="4" maxlength="4" placeholder="<?= HtmlEncode($Page->ctn_no->getPlaceHolder()) ?>"<?= $Page->ctn_no->editAttributes() ?> aria-describedby="x_ctn_no_help">
<?= $Page->ctn_no->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ctn_no->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->checker->Visible) { // checker ?>
    <div id="r_checker"<?= $Page->checker->rowAttributes() ?>>
        <label id="elh_oss_manual_checker" for="x_checker" class="<?= $Page->LeftColumnClass ?>"><?= $Page->checker->caption() ?><?= $Page->checker->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->checker->cellAttributes() ?>>
<span id="el_oss_manual_checker">
<input type="<?= $Page->checker->getInputTextType() ?>" name="x_checker" id="x_checker" data-table="oss_manual" data-field="x_checker" value="<?= $Page->checker->EditValue ?>" size="20" maxlength="255" placeholder="<?= HtmlEncode($Page->checker->getPlaceHolder()) ?>"<?= $Page->checker->editAttributes() ?> aria-describedby="x_checker_help">
<?= $Page->checker->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->checker->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->shift->Visible) { // shift ?>
    <div id="r_shift"<?= $Page->shift->rowAttributes() ?>>
        <label id="elh_oss_manual_shift" for="x_shift" class="<?= $Page->LeftColumnClass ?>"><?= $Page->shift->caption() ?><?= $Page->shift->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->shift->cellAttributes() ?>>
<span id="el_oss_manual_shift">
    <select
        id="x_shift"
        name="x_shift"
        class="form-select ew-select<?= $Page->shift->isInvalidClass() ?>"
        data-select2-id="foss_manualedit_x_shift"
        data-table="oss_manual"
        data-field="x_shift"
        data-value-separator="<?= $Page->shift->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->shift->getPlaceHolder()) ?>"
        <?= $Page->shift->editAttributes() ?>>
        <?= $Page->shift->selectOptionListHtml("x_shift") ?>
    </select>
    <?= $Page->shift->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->shift->getErrorMessage() ?></div>
<script>
loadjs.ready("foss_manualedit", function() {
    var options = { name: "x_shift", selectId: "foss_manualedit_x_shift" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (foss_manualedit.lists.shift.lookupOptions.length) {
        options.data = { id: "x_shift", form: "foss_manualedit" };
    } else {
        options.ajax = { id: "x_shift", form: "foss_manualedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.oss_manual.fields.shift.selectOptions);
    ew.createSelect(options);
});
</script>
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
    ew.addEventHandlers("oss_manual");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
