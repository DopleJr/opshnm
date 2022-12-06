<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$InboundExcessEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { inbound_excess: currentTable } });
var currentForm, currentPageID;
var finbound_excessedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    finbound_excessedit = new ew.Form("finbound_excessedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = finbound_excessedit;

    // Add fields
    var fields = currentTable.fields;
    finbound_excessedit.addFields([
        ["sscc", [fields.sscc.visible && fields.sscc.required ? ew.Validators.required(fields.sscc.caption) : null], fields.sscc.isInvalid],
        ["pallet_id", [fields.pallet_id.visible && fields.pallet_id.required ? ew.Validators.required(fields.pallet_id.caption) : null], fields.pallet_id.isInvalid],
        ["users", [fields.users.visible && fields.users.required ? ew.Validators.required(fields.users.caption) : null], fields.users.isInvalid],
        ["date_update", [fields.date_update.visible && fields.date_update.required ? ew.Validators.required(fields.date_update.caption) : null], fields.date_update.isInvalid],
        ["time_update", [fields.time_update.visible && fields.time_update.required ? ew.Validators.required(fields.time_update.caption) : null], fields.time_update.isInvalid]
    ]);

    // Form_CustomValidate
    finbound_excessedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    finbound_excessedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("finbound_excessedit");
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
<form name="finbound_excessedit" id="finbound_excessedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="inbound_excess">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->sscc->Visible) { // sscc ?>
    <div id="r_sscc"<?= $Page->sscc->rowAttributes() ?>>
        <label id="elh_inbound_excess_sscc" for="x_sscc" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sscc->caption() ?><?= $Page->sscc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sscc->cellAttributes() ?>>
<span id="el_inbound_excess_sscc">
<input type="<?= $Page->sscc->getInputTextType() ?>" name="x_sscc" id="x_sscc" data-table="inbound_excess" data-field="x_sscc" value="<?= $Page->sscc->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->sscc->getPlaceHolder()) ?>"<?= $Page->sscc->editAttributes() ?> aria-describedby="x_sscc_help">
<?= $Page->sscc->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sscc->getErrorMessage() ?></div>
<input type="hidden" data-table="inbound_excess" data-field="x_sscc" data-hidden="1" name="o_sscc" id="o_sscc" value="<?= HtmlEncode($Page->sscc->OldValue ?? $Page->sscc->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pallet_id->Visible) { // pallet_id ?>
    <div id="r_pallet_id"<?= $Page->pallet_id->rowAttributes() ?>>
        <label id="elh_inbound_excess_pallet_id" for="x_pallet_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pallet_id->caption() ?><?= $Page->pallet_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pallet_id->cellAttributes() ?>>
<span id="el_inbound_excess_pallet_id">
<input type="<?= $Page->pallet_id->getInputTextType() ?>" name="x_pallet_id" id="x_pallet_id" data-table="inbound_excess" data-field="x_pallet_id" value="<?= $Page->pallet_id->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->pallet_id->getPlaceHolder()) ?>"<?= $Page->pallet_id->editAttributes() ?> aria-describedby="x_pallet_id_help">
<?= $Page->pallet_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pallet_id->getErrorMessage() ?></div>
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
    ew.addEventHandlers("inbound_excess");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
