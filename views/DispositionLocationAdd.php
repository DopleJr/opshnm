<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$DispositionLocationAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { disposition_location: currentTable } });
var currentForm, currentPageID;
var fdisposition_locationadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fdisposition_locationadd = new ew.Form("fdisposition_locationadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fdisposition_locationadd;

    // Add fields
    var fields = currentTable.fields;
    fdisposition_locationadd.addFields([
        ["photo_before", [fields.photo_before.visible && fields.photo_before.required ? ew.Validators.fileRequired(fields.photo_before.caption) : null], fields.photo_before.isInvalid],
        ["divisi", [fields.divisi.visible && fields.divisi.required ? ew.Validators.required(fields.divisi.caption) : null], fields.divisi.isInvalid]
    ]);

    // Form_CustomValidate
    fdisposition_locationadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdisposition_locationadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fdisposition_locationadd.lists.divisi = <?= $Page->divisi->toClientList($Page) ?>;
    loadjs.done("fdisposition_locationadd");
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
<form name="fdisposition_locationadd" id="fdisposition_locationadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="disposition_location">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->photo_before->Visible) { // photo_before ?>
    <div id="r_photo_before"<?= $Page->photo_before->rowAttributes() ?>>
        <label id="elh_disposition_location_photo_before" class="<?= $Page->LeftColumnClass ?>"><?= $Page->photo_before->caption() ?><?= $Page->photo_before->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->photo_before->cellAttributes() ?>>
<span id="el_disposition_location_photo_before">
<div id="fd_x_photo_before" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->photo_before->title() ?>" data-table="disposition_location" data-field="x_photo_before" name="x_photo_before" id="x_photo_before" lang="<?= CurrentLanguageID() ?>"<?= $Page->photo_before->editAttributes() ?> aria-describedby="x_photo_before_help"<?= ($Page->photo_before->ReadOnly || $Page->photo_before->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->photo_before->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->photo_before->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_photo_before" id= "fn_x_photo_before" value="<?= $Page->photo_before->Upload->FileName ?>">
<input type="hidden" name="fa_x_photo_before" id= "fa_x_photo_before" value="0">
<input type="hidden" name="fs_x_photo_before" id= "fs_x_photo_before" value="65535">
<input type="hidden" name="fx_x_photo_before" id= "fx_x_photo_before" value="<?= $Page->photo_before->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_photo_before" id= "fm_x_photo_before" value="<?= $Page->photo_before->UploadMaxFileSize ?>">
<table id="ft_x_photo_before" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->divisi->Visible) { // divisi ?>
    <div id="r_divisi"<?= $Page->divisi->rowAttributes() ?>>
        <label id="elh_disposition_location_divisi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->divisi->caption() ?><?= $Page->divisi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->divisi->cellAttributes() ?>>
<span id="el_disposition_location_divisi">
<template id="tp_x_divisi">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="disposition_location" data-field="x_divisi" name="x_divisi" id="x_divisi"<?= $Page->divisi->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_divisi" class="ew-item-list"></div>
<selection-list hidden
    id="x_divisi"
    name="x_divisi"
    value="<?= HtmlEncode($Page->divisi->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_divisi"
    data-bs-target="dsl_x_divisi"
    data-repeatcolumn="5"
    class="form-control<?= $Page->divisi->isInvalidClass() ?>"
    data-table="disposition_location"
    data-field="x_divisi"
    data-value-separator="<?= $Page->divisi->displayValueSeparatorAttribute() ?>"
    <?= $Page->divisi->editAttributes() ?>></selection-list>
<?= $Page->divisi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->divisi->getErrorMessage() ?></div>
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
    ew.addEventHandlers("disposition_location");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
