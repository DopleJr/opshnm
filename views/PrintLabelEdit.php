<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$PrintLabelEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { print_label: currentTable } });
var currentForm, currentPageID;
var fprint_labeledit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fprint_labeledit = new ew.Form("fprint_labeledit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fprint_labeledit;

    // Add fields
    var fields = currentTable.fields;
    fprint_labeledit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null, ew.Validators.integer], fields.id.isInvalid],
        ["box_id", [fields.box_id.visible && fields.box_id.required ? ew.Validators.required(fields.box_id.caption) : null], fields.box_id.isInvalid],
        ["priority", [fields.priority.visible && fields.priority.required ? ew.Validators.required(fields.priority.caption) : null], fields.priority.isInvalid],
        ["store_code", [fields.store_code.visible && fields.store_code.required ? ew.Validators.required(fields.store_code.caption) : null], fields.store_code.isInvalid],
        ["user", [fields.user.visible && fields.user.required ? ew.Validators.required(fields.user.caption) : null], fields.user.isInvalid],
        ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null], fields.date_created.isInvalid],
        ["time_created", [fields.time_created.visible && fields.time_created.required ? ew.Validators.required(fields.time_created.caption) : null], fields.time_created.isInvalid]
    ]);

    // Form_CustomValidate
    fprint_labeledit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fprint_labeledit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fprint_labeledit.lists.priority = <?= $Page->priority->toClientList($Page) ?>;
    fprint_labeledit.lists.store_code = <?= $Page->store_code->toClientList($Page) ?>;
    loadjs.done("fprint_labeledit");
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
<form name="fprint_labeledit" id="fprint_labeledit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="print_label">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_print_label_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_print_label_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="print_label" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
    <div id="r_box_id"<?= $Page->box_id->rowAttributes() ?>>
        <label id="elh_print_label_box_id" for="x_box_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->box_id->caption() ?><?= $Page->box_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->box_id->cellAttributes() ?>>
<span id="el_print_label_box_id">
<span<?= $Page->box_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->box_id->getDisplayValue($Page->box_id->EditValue))) ?>"></span>
<input type="hidden" data-table="print_label" data-field="x_box_id" data-hidden="1" name="x_box_id" id="x_box_id" value="<?= HtmlEncode($Page->box_id->CurrentValue) ?>">
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
    <select
        id="x_store_code"
        name="x_store_code"
        class="form-select ew-select<?= $Page->store_code->isInvalidClass() ?>"
        data-select2-id="fprint_labeledit_x_store_code"
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
loadjs.ready("fprint_labeledit", function() {
    var options = { name: "x_store_code", selectId: "fprint_labeledit_x_store_code" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fprint_labeledit.lists.store_code.lookupOptions.length) {
        options.data = { id: "x_store_code", form: "fprint_labeledit" };
    } else {
        options.ajax = { id: "x_store_code", form: "fprint_labeledit", limit: ew.LOOKUP_PAGE_SIZE };
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
<?php if ($Page->user->Visible) { // user ?>
    <div id="r_user"<?= $Page->user->rowAttributes() ?>>
        <label id="elh_print_label_user" for="x_user" class="<?= $Page->LeftColumnClass ?>"><?= $Page->user->caption() ?><?= $Page->user->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->user->cellAttributes() ?>>
<span id="el_print_label_user">
<span<?= $Page->user->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->user->getDisplayValue($Page->user->EditValue))) ?>"></span>
<input type="hidden" data-table="print_label" data-field="x_user" data-hidden="1" name="x_user" id="x_user" value="<?= HtmlEncode($Page->user->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <div id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <label id="elh_print_label_date_created" for="x_date_created" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_created->caption() ?><?= $Page->date_created->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_created->cellAttributes() ?>>
<span id="el_print_label_date_created">
<span<?= $Page->date_created->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->date_created->getDisplayValue($Page->date_created->EditValue))) ?>"></span>
<input type="hidden" data-table="print_label" data-field="x_date_created" data-hidden="1" name="x_date_created" id="x_date_created" value="<?= HtmlEncode($Page->date_created->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->time_created->Visible) { // time_created ?>
    <div id="r_time_created"<?= $Page->time_created->rowAttributes() ?>>
        <label id="elh_print_label_time_created" for="x_time_created" class="<?= $Page->LeftColumnClass ?>"><?= $Page->time_created->caption() ?><?= $Page->time_created->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->time_created->cellAttributes() ?>>
<span id="el_print_label_time_created">
<span<?= $Page->time_created->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->time_created->getDisplayValue($Page->time_created->EditValue))) ?>"></span>
<input type="hidden" data-table="print_label" data-field="x_time_created" data-hidden="1" name="x_time_created" id="x_time_created" value="<?= HtmlEncode($Page->time_created->CurrentValue) ?>">
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
    ew.addEventHandlers("print_label");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
