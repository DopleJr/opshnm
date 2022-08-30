<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$PrintLabelAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { print_label: currentTable } });
var currentForm, currentPageID;
var fprint_labeladd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fprint_labeladd = new ew.Form("fprint_labeladd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fprint_labeladd;

    // Add fields
    var fields = currentTable.fields;
    fprint_labeladd.addFields([
        ["box_id", [fields.box_id.visible && fields.box_id.required ? ew.Validators.required(fields.box_id.caption) : null], fields.box_id.isInvalid],
        ["priority", [fields.priority.visible && fields.priority.required ? ew.Validators.required(fields.priority.caption) : null], fields.priority.isInvalid],
        ["store_code", [fields.store_code.visible && fields.store_code.required ? ew.Validators.required(fields.store_code.caption) : null], fields.store_code.isInvalid],
        ["store_name", [fields.store_name.visible && fields.store_name.required ? ew.Validators.required(fields.store_name.caption) : null], fields.store_name.isInvalid]
    ]);

    // Form_CustomValidate
    fprint_labeladd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fprint_labeladd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fprint_labeladd.lists.priority = <?= $Page->priority->toClientList($Page) ?>;
    fprint_labeladd.lists.store_code = <?= $Page->store_code->toClientList($Page) ?>;
    loadjs.done("fprint_labeladd");
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
<form name="fprint_labeladd" id="fprint_labeladd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="print_label">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->box_id->Visible) { // box_id ?>
    <div id="r_box_id"<?= $Page->box_id->rowAttributes() ?>>
        <label id="elh_print_label_box_id" for="x_box_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->box_id->caption() ?><?= $Page->box_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->box_id->cellAttributes() ?>>
<span id="el_print_label_box_id">
<input type="<?= $Page->box_id->getInputTextType() ?>" name="x_box_id" id="x_box_id" data-table="print_label" data-field="x_box_id" value="<?= $Page->box_id->EditValue ?>" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->box_id->getPlaceHolder()) ?>"<?= $Page->box_id->editAttributes() ?> aria-describedby="x_box_id_help">
<?= $Page->box_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->box_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->priority->Visible) { // priority ?>
    <div id="r_priority"<?= $Page->priority->rowAttributes() ?>>
        <label id="elh_print_label_priority" class="<?= $Page->LeftColumnClass ?>"><?= $Page->priority->caption() ?><?= $Page->priority->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->priority->cellAttributes() ?>>
<span id="el_print_label_priority">
<template id="tp_x_priority">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="print_label" data-field="x_priority" name="x_priority" id="x_priority"<?= $Page->priority->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_priority" class="ew-item-list"></div>
<selection-list hidden
    id="x_priority"
    name="x_priority"
    value="<?= HtmlEncode($Page->priority->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_priority"
    data-bs-target="dsl_x_priority"
    data-repeatcolumn="5"
    class="form-control<?= $Page->priority->isInvalidClass() ?>"
    data-table="print_label"
    data-field="x_priority"
    data-value-separator="<?= $Page->priority->displayValueSeparatorAttribute() ?>"
    <?= $Page->priority->editAttributes() ?>></selection-list>
<?= $Page->priority->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->priority->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_code->Visible) { // store_code ?>
    <div id="r_store_code"<?= $Page->store_code->rowAttributes() ?>>
        <label id="elh_print_label_store_code" for="x_store_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->store_code->caption() ?><?= $Page->store_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_code->cellAttributes() ?>>
<span id="el_print_label_store_code">
<?php $Page->store_code->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
    <select
        id="x_store_code"
        name="x_store_code"
        class="form-select ew-select<?= $Page->store_code->isInvalidClass() ?>"
        data-select2-id="fprint_labeladd_x_store_code"
        data-table="print_label"
        data-field="x_store_code"
        data-value-separator="<?= $Page->store_code->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->store_code->getPlaceHolder()) ?>"
        <?= $Page->store_code->editAttributes() ?>>
        <?= $Page->store_code->selectOptionListHtml("x_store_code") ?>
    </select>
    <?= $Page->store_code->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->store_code->getErrorMessage() ?></div>
<?= $Page->store_code->Lookup->getParamTag($Page, "p_x_store_code") ?>
<script>
loadjs.ready("fprint_labeladd", function() {
    var options = { name: "x_store_code", selectId: "fprint_labeladd_x_store_code" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fprint_labeladd.lists.store_code.lookupOptions.length) {
        options.data = { id: "x_store_code", form: "fprint_labeladd" };
    } else {
        options.ajax = { id: "x_store_code", form: "fprint_labeladd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.print_label.fields.store_code.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
    <div id="r_store_name"<?= $Page->store_name->rowAttributes() ?>>
        <label id="elh_print_label_store_name" for="x_store_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->store_name->caption() ?><?= $Page->store_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_name->cellAttributes() ?>>
<span id="el_print_label_store_name">
<input type="<?= $Page->store_name->getInputTextType() ?>" name="x_store_name" id="x_store_name" data-table="print_label" data-field="x_store_name" value="<?= $Page->store_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->store_name->getPlaceHolder()) ?>"<?= $Page->store_name->editAttributes() ?> aria-describedby="x_store_name_help">
<?= $Page->store_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->store_name->getErrorMessage() ?></div>
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
    ew.addEventHandlers("print_label");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
