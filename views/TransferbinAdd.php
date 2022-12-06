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
        ["from_bin", [fields.from_bin.visible && fields.from_bin.required ? ew.Validators.required(fields.from_bin.caption) : null], fields.from_bin.isInvalid],
        ["ctn", [fields.ctn.visible && fields.ctn.required ? ew.Validators.required(fields.ctn.caption) : null], fields.ctn.isInvalid],
        ["to_bin", [fields.to_bin.visible && fields.to_bin.required ? ew.Validators.required(fields.to_bin.caption) : null], fields.to_bin.isInvalid],
        ["user", [fields.user.visible && fields.user.required ? ew.Validators.required(fields.user.caption) : null], fields.user.isInvalid],
        ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null], fields.date_created.isInvalid],
        ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null], fields.date_updated.isInvalid],
        ["time_updated", [fields.time_updated.visible && fields.time_updated.required ? ew.Validators.required(fields.time_updated.caption) : null], fields.time_updated.isInvalid]
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
<?php if ($Page->from_bin->Visible) { // from_bin ?>
    <div id="r_from_bin"<?= $Page->from_bin->rowAttributes() ?>>
        <label id="elh_transferbin_from_bin" for="x_from_bin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->from_bin->caption() ?><?= $Page->from_bin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->from_bin->cellAttributes() ?>>
<span id="el_transferbin_from_bin">
<input type="<?= $Page->from_bin->getInputTextType() ?>" name="x_from_bin" id="x_from_bin" data-table="transferbin" data-field="x_from_bin" value="<?= $Page->from_bin->EditValue ?>" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->from_bin->getPlaceHolder()) ?>"<?= $Page->from_bin->editAttributes() ?> aria-describedby="x_from_bin_help">
<?= $Page->from_bin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->from_bin->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
    <div id="r_ctn"<?= $Page->ctn->rowAttributes() ?>>
        <label id="elh_transferbin_ctn" for="x_ctn" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ctn->caption() ?><?= $Page->ctn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ctn->cellAttributes() ?>>
<span id="el_transferbin_ctn">
<input type="<?= $Page->ctn->getInputTextType() ?>" name="x_ctn" id="x_ctn" data-table="transferbin" data-field="x_ctn" value="<?= $Page->ctn->EditValue ?>" size="30" maxlength="4" placeholder="<?= HtmlEncode($Page->ctn->getPlaceHolder()) ?>"<?= $Page->ctn->editAttributes() ?> aria-describedby="x_ctn_help">
<?= $Page->ctn->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ctn->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->to_bin->Visible) { // to_bin ?>
    <div id="r_to_bin"<?= $Page->to_bin->rowAttributes() ?>>
        <label id="elh_transferbin_to_bin" for="x_to_bin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->to_bin->caption() ?><?= $Page->to_bin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->to_bin->cellAttributes() ?>>
<span id="el_transferbin_to_bin">
<input type="<?= $Page->to_bin->getInputTextType() ?>" name="x_to_bin" id="x_to_bin" data-table="transferbin" data-field="x_to_bin" value="<?= $Page->to_bin->EditValue ?>" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->to_bin->getPlaceHolder()) ?>"<?= $Page->to_bin->editAttributes() ?> aria-describedby="x_to_bin_help">
<?= $Page->to_bin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->to_bin->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
    <div id="r_user"<?= $Page->user->rowAttributes() ?>>
        <label id="elh_transferbin_user" for="x_user" class="<?= $Page->LeftColumnClass ?>"><?= $Page->user->caption() ?><?= $Page->user->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->user->cellAttributes() ?>>
<span id="el_transferbin_user">
<input type="<?= $Page->user->getInputTextType() ?>" name="x_user" id="x_user" data-table="transferbin" data-field="x_user" value="<?= $Page->user->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->user->getPlaceHolder()) ?>"<?= $Page->user->editAttributes() ?> aria-describedby="x_user_help">
<?= $Page->user->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->user->getErrorMessage() ?></div>
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
