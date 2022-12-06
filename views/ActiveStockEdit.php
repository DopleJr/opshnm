<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$ActiveStockEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { active_stock: currentTable } });
var currentForm, currentPageID;
var factive_stockedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    factive_stockedit = new ew.Form("factive_stockedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = factive_stockedit;

    // Add fields
    var fields = currentTable.fields;
    factive_stockedit.addFields([
        ["aisle", [fields.aisle.visible && fields.aisle.required ? ew.Validators.required(fields.aisle.caption) : null], fields.aisle.isInvalid],
        ["active_bin", [fields.active_bin.visible && fields.active_bin.required ? ew.Validators.required(fields.active_bin.caption) : null, ew.Validators.integer], fields.active_bin.isInvalid],
        ["active_stock", [fields.active_stock.visible && fields.active_stock.required ? ew.Validators.required(fields.active_stock.caption) : null, ew.Validators.integer], fields.active_stock.isInvalid]
    ]);

    // Form_CustomValidate
    factive_stockedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    factive_stockedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("factive_stockedit");
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
<form name="factive_stockedit" id="factive_stockedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="active_stock">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->aisle->Visible) { // aisle ?>
    <div id="r_aisle"<?= $Page->aisle->rowAttributes() ?>>
        <label id="elh_active_stock_aisle" for="x_aisle" class="<?= $Page->LeftColumnClass ?>"><?= $Page->aisle->caption() ?><?= $Page->aisle->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->aisle->cellAttributes() ?>>
<span id="el_active_stock_aisle">
<input type="<?= $Page->aisle->getInputTextType() ?>" name="x_aisle" id="x_aisle" data-table="active_stock" data-field="x_aisle" value="<?= $Page->aisle->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->aisle->getPlaceHolder()) ?>"<?= $Page->aisle->editAttributes() ?> aria-describedby="x_aisle_help">
<?= $Page->aisle->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->aisle->getErrorMessage() ?></div>
<input type="hidden" data-table="active_stock" data-field="x_aisle" data-hidden="1" name="o_aisle" id="o_aisle" value="<?= HtmlEncode($Page->aisle->OldValue ?? $Page->aisle->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->active_bin->Visible) { // active_bin ?>
    <div id="r_active_bin"<?= $Page->active_bin->rowAttributes() ?>>
        <label id="elh_active_stock_active_bin" for="x_active_bin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->active_bin->caption() ?><?= $Page->active_bin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->active_bin->cellAttributes() ?>>
<span id="el_active_stock_active_bin">
<input type="<?= $Page->active_bin->getInputTextType() ?>" name="x_active_bin" id="x_active_bin" data-table="active_stock" data-field="x_active_bin" value="<?= $Page->active_bin->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->active_bin->getPlaceHolder()) ?>"<?= $Page->active_bin->editAttributes() ?> aria-describedby="x_active_bin_help">
<?= $Page->active_bin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->active_bin->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->active_stock->Visible) { // active_stock ?>
    <div id="r_active_stock"<?= $Page->active_stock->rowAttributes() ?>>
        <label id="elh_active_stock_active_stock" for="x_active_stock" class="<?= $Page->LeftColumnClass ?>"><?= $Page->active_stock->caption() ?><?= $Page->active_stock->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->active_stock->cellAttributes() ?>>
<span id="el_active_stock_active_stock">
<input type="<?= $Page->active_stock->getInputTextType() ?>" name="x_active_stock" id="x_active_stock" data-table="active_stock" data-field="x_active_stock" value="<?= $Page->active_stock->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->active_stock->getPlaceHolder()) ?>"<?= $Page->active_stock->editAttributes() ?> aria-describedby="x_active_stock_help">
<?= $Page->active_stock->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->active_stock->getErrorMessage() ?></div>
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
    ew.addEventHandlers("active_stock");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
