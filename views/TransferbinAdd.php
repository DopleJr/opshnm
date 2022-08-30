<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$TransferbinAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { transferbin: currentTable } });
var currentForm, currentPageID;
var ftransferbinadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftransferbinadd = new ew.Form("ftransferbinadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = ftransferbinadd;

    // Add fields
    var fields = currentTable.fields;
    ftransferbinadd.addFields([
        ["FromBin", [fields.FromBin.visible && fields.FromBin.required ? ew.Validators.required(fields.FromBin.caption) : null], fields.FromBin.isInvalid],
        ["ToBin", [fields.ToBin.visible && fields.ToBin.required ? ew.Validators.required(fields.ToBin.caption) : null], fields.ToBin.isInvalid],
        ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null], fields.date_created.isInvalid]
    ]);

    // Form_CustomValidate
    ftransferbinadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftransferbinadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("ftransferbinadd");
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
<form name="ftransferbinadd" id="ftransferbinadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="transferbin">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
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
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
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
