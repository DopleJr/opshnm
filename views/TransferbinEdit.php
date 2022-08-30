<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$TransferbinEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { transferbin: currentTable } });
var currentForm, currentPageID;
var ftransferbinedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftransferbinedit = new ew.Form("ftransferbinedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = ftransferbinedit;

    // Add fields
    var fields = currentTable.fields;
    ftransferbinedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["FromBin", [fields.FromBin.visible && fields.FromBin.required ? ew.Validators.required(fields.FromBin.caption) : null], fields.FromBin.isInvalid],
        ["ToBin", [fields.ToBin.visible && fields.ToBin.required ? ew.Validators.required(fields.ToBin.caption) : null], fields.ToBin.isInvalid],
        ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null], fields.date_created.isInvalid]
    ]);

    // Form_CustomValidate
    ftransferbinedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftransferbinedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("ftransferbinedit");
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
<form name="ftransferbinedit" id="ftransferbinedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="transferbin">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_transferbin_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_transferbin_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="transferbin" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->FromBin->Visible) { // From Bin ?>
    <div id="r_FromBin"<?= $Page->FromBin->rowAttributes() ?>>
        <label id="elh_transferbin_FromBin" for="x_FromBin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->FromBin->caption() ?><?= $Page->FromBin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->FromBin->cellAttributes() ?>>
<span id="el_transferbin_FromBin">
<input type="<?= $Page->FromBin->getInputTextType() ?>" name="x_FromBin" id="x_FromBin" data-table="transferbin" data-field="x_FromBin" value="<?= $Page->FromBin->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->FromBin->getPlaceHolder()) ?>"<?= $Page->FromBin->editAttributes() ?> aria-describedby="x_FromBin_help">
<?= $Page->FromBin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->FromBin->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ToBin->Visible) { // To Bin ?>
    <div id="r_ToBin"<?= $Page->ToBin->rowAttributes() ?>>
        <label id="elh_transferbin_ToBin" for="x_ToBin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ToBin->caption() ?><?= $Page->ToBin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ToBin->cellAttributes() ?>>
<span id="el_transferbin_ToBin">
<input type="<?= $Page->ToBin->getInputTextType() ?>" name="x_ToBin" id="x_ToBin" data-table="transferbin" data-field="x_ToBin" value="<?= $Page->ToBin->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->ToBin->getPlaceHolder()) ?>"<?= $Page->ToBin->editAttributes() ?> aria-describedby="x_ToBin_help">
<?= $Page->ToBin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ToBin->getErrorMessage() ?></div>
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
    ew.addEventHandlers("transferbin");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
