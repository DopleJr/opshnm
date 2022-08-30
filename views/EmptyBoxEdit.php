<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$EmptyBoxEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { empty_box: currentTable } });
var currentForm, currentPageID;
var fempty_boxedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fempty_boxedit = new ew.Form("fempty_boxedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fempty_boxedit;

    // Add fields
    var fields = currentTable.fields;
    fempty_boxedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["photo_before", [fields.photo_before.visible && fields.photo_before.required ? ew.Validators.fileRequired(fields.photo_before.caption) : null], fields.photo_before.isInvalid],
        ["photo_after", [fields.photo_after.visible && fields.photo_after.required ? ew.Validators.fileRequired(fields.photo_after.caption) : null], fields.photo_after.isInvalid],
        ["divisi", [fields.divisi.visible && fields.divisi.required ? ew.Validators.required(fields.divisi.caption) : null], fields.divisi.isInvalid],
        ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null], fields.date_updated.isInvalid]
    ]);

    // Form_CustomValidate
    fempty_boxedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fempty_boxedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fempty_boxedit.lists.divisi = <?= $Page->divisi->toClientList($Page) ?>;
    loadjs.done("fempty_boxedit");
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
<form name="fempty_boxedit" id="fempty_boxedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="empty_box">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_empty_box_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_empty_box_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="empty_box" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->photo_before->Visible) { // photo_before ?>
    <div id="r_photo_before"<?= $Page->photo_before->rowAttributes() ?>>
        <label id="elh_empty_box_photo_before" class="<?= $Page->LeftColumnClass ?>"><?= $Page->photo_before->caption() ?><?= $Page->photo_before->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->photo_before->cellAttributes() ?>>
<span id="el_empty_box_photo_before">
<div id="fd_x_photo_before" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->photo_before->title() ?>" data-table="empty_box" data-field="x_photo_before" name="x_photo_before" id="x_photo_before" lang="<?= CurrentLanguageID() ?>"<?= $Page->photo_before->editAttributes() ?> aria-describedby="x_photo_before_help"<?= ($Page->photo_before->ReadOnly || $Page->photo_before->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->photo_before->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->photo_before->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_photo_before" id= "fn_x_photo_before" value="<?= $Page->photo_before->Upload->FileName ?>">
<input type="hidden" name="fa_x_photo_before" id= "fa_x_photo_before" value="<?= (Post("fa_x_photo_before") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_photo_before" id= "fs_x_photo_before" value="65535">
<input type="hidden" name="fx_x_photo_before" id= "fx_x_photo_before" value="<?= $Page->photo_before->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_photo_before" id= "fm_x_photo_before" value="<?= $Page->photo_before->UploadMaxFileSize ?>">
<table id="ft_x_photo_before" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->photo_after->Visible) { // photo_after ?>
    <div id="r_photo_after"<?= $Page->photo_after->rowAttributes() ?>>
        <label id="elh_empty_box_photo_after" class="<?= $Page->LeftColumnClass ?>"><?= $Page->photo_after->caption() ?><?= $Page->photo_after->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->photo_after->cellAttributes() ?>>
<span id="el_empty_box_photo_after">
<div id="fd_x_photo_after" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->photo_after->title() ?>" data-table="empty_box" data-field="x_photo_after" name="x_photo_after" id="x_photo_after" lang="<?= CurrentLanguageID() ?>"<?= $Page->photo_after->editAttributes() ?> aria-describedby="x_photo_after_help"<?= ($Page->photo_after->ReadOnly || $Page->photo_after->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->photo_after->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->photo_after->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_photo_after" id= "fn_x_photo_after" value="<?= $Page->photo_after->Upload->FileName ?>">
<input type="hidden" name="fa_x_photo_after" id= "fa_x_photo_after" value="<?= (Post("fa_x_photo_after") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_photo_after" id= "fs_x_photo_after" value="65535">
<input type="hidden" name="fx_x_photo_after" id= "fx_x_photo_after" value="<?= $Page->photo_after->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_photo_after" id= "fm_x_photo_after" value="<?= $Page->photo_after->UploadMaxFileSize ?>">
<table id="ft_x_photo_after" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->divisi->Visible) { // divisi ?>
    <div id="r_divisi"<?= $Page->divisi->rowAttributes() ?>>
        <label id="elh_empty_box_divisi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->divisi->caption() ?><?= $Page->divisi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->divisi->cellAttributes() ?>>
<span id="el_empty_box_divisi">
<template id="tp_x_divisi">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="empty_box" data-field="x_divisi" name="x_divisi" id="x_divisi"<?= $Page->divisi->editAttributes() ?>>
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
    data-table="empty_box"
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
    ew.addEventHandlers("empty_box");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
