<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$StoreEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { store: currentTable } });
var currentForm, currentPageID;
var fstoreedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fstoreedit = new ew.Form("fstoreedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fstoreedit;

    // Add fields
    var fields = currentTable.fields;
    fstoreedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["store_code", [fields.store_code.visible && fields.store_code.required ? ew.Validators.required(fields.store_code.caption) : null], fields.store_code.isInvalid],
        ["store_name", [fields.store_name.visible && fields.store_name.required ? ew.Validators.required(fields.store_name.caption) : null], fields.store_name.isInvalid],
        ["totes", [fields.totes.visible && fields.totes.required ? ew.Validators.required(fields.totes.caption) : null], fields.totes.isInvalid]
    ]);

    // Form_CustomValidate
    fstoreedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fstoreedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fstoreedit.lists.totes = <?= $Page->totes->toClientList($Page) ?>;
    loadjs.done("fstoreedit");
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
<form name="fstoreedit" id="fstoreedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="store">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_store_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_store_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="store" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_code->Visible) { // store_code ?>
    <div id="r_store_code"<?= $Page->store_code->rowAttributes() ?>>
        <label id="elh_store_store_code" for="x_store_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->store_code->caption() ?><?= $Page->store_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_code->cellAttributes() ?>>
<span id="el_store_store_code">
<input type="<?= $Page->store_code->getInputTextType() ?>" name="x_store_code" id="x_store_code" data-table="store" data-field="x_store_code" value="<?= $Page->store_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->store_code->getPlaceHolder()) ?>"<?= $Page->store_code->editAttributes() ?> aria-describedby="x_store_code_help">
<?= $Page->store_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->store_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
    <div id="r_store_name"<?= $Page->store_name->rowAttributes() ?>>
        <label id="elh_store_store_name" for="x_store_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->store_name->caption() ?><?= $Page->store_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_name->cellAttributes() ?>>
<span id="el_store_store_name">
<input type="<?= $Page->store_name->getInputTextType() ?>" name="x_store_name" id="x_store_name" data-table="store" data-field="x_store_name" value="<?= $Page->store_name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->store_name->getPlaceHolder()) ?>"<?= $Page->store_name->editAttributes() ?> aria-describedby="x_store_name_help">
<?= $Page->store_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->store_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->totes->Visible) { // totes ?>
    <div id="r_totes"<?= $Page->totes->rowAttributes() ?>>
        <label id="elh_store_totes" for="x_totes" class="<?= $Page->LeftColumnClass ?>"><?= $Page->totes->caption() ?><?= $Page->totes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->totes->cellAttributes() ?>>
<span id="el_store_totes">
    <select
        id="x_totes"
        name="x_totes"
        class="form-select ew-select<?= $Page->totes->isInvalidClass() ?>"
        data-select2-id="fstoreedit_x_totes"
        data-table="store"
        data-field="x_totes"
        data-value-separator="<?= $Page->totes->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->totes->getPlaceHolder()) ?>"
        <?= $Page->totes->editAttributes() ?>>
        <?= $Page->totes->selectOptionListHtml("x_totes") ?>
    </select>
    <?= $Page->totes->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->totes->getErrorMessage() ?></div>
<script>
loadjs.ready("fstoreedit", function() {
    var options = { name: "x_totes", selectId: "fstoreedit_x_totes" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fstoreedit.lists.totes.lookupOptions.length) {
        options.data = { id: "x_totes", form: "fstoreedit" };
    } else {
        options.ajax = { id: "x_totes", form: "fstoreedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.store.fields.totes.selectOptions);
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
    ew.addEventHandlers("store");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
