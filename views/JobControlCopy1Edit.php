<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$JobControlCopy1Edit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { job_control_copy1: currentTable } });
var currentForm, currentPageID;
var fjob_control_copy1edit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fjob_control_copy1edit = new ew.Form("fjob_control_copy1edit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fjob_control_copy1edit;

    // Add fields
    var fields = currentTable.fields;
    fjob_control_copy1edit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["creation_date", [fields.creation_date.visible && fields.creation_date.required ? ew.Validators.required(fields.creation_date.caption) : null], fields.creation_date.isInvalid],
        ["store_id", [fields.store_id.visible && fields.store_id.required ? ew.Validators.required(fields.store_id.caption) : null], fields.store_id.isInvalid],
        ["area", [fields.area.visible && fields.area.required ? ew.Validators.required(fields.area.caption) : null], fields.area.isInvalid],
        ["aisle", [fields.aisle.visible && fields.aisle.required ? ew.Validators.required(fields.aisle.caption) : null], fields.aisle.isInvalid],
        ["user", [fields.user.visible && fields.user.required ? ew.Validators.required(fields.user.caption) : null], fields.user.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
        ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null], fields.date_updated.isInvalid]
    ]);

    // Form_CustomValidate
    fjob_control_copy1edit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fjob_control_copy1edit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fjob_control_copy1edit.lists.creation_date = <?= $Page->creation_date->toClientList($Page) ?>;
    fjob_control_copy1edit.lists.store_id = <?= $Page->store_id->toClientList($Page) ?>;
    fjob_control_copy1edit.lists.area = <?= $Page->area->toClientList($Page) ?>;
    fjob_control_copy1edit.lists.aisle = <?= $Page->aisle->toClientList($Page) ?>;
    fjob_control_copy1edit.lists.user = <?= $Page->user->toClientList($Page) ?>;
    fjob_control_copy1edit.lists.status = <?= $Page->status->toClientList($Page) ?>;
    loadjs.done("fjob_control_copy1edit");
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
<form name="fjob_control_copy1edit" id="fjob_control_copy1edit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="job_control_copy1">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_job_control_copy1_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_job_control_copy1_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="job_control_copy1" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->creation_date->Visible) { // creation_date ?>
    <div id="r_creation_date"<?= $Page->creation_date->rowAttributes() ?>>
        <label id="elh_job_control_copy1_creation_date" for="x_creation_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->creation_date->caption() ?><?= $Page->creation_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->creation_date->cellAttributes() ?>>
<span id="el_job_control_copy1_creation_date">
<?php $Page->creation_date->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_creation_date"
        name="x_creation_date"
        class="form-select ew-select<?= $Page->creation_date->isInvalidClass() ?>"
        data-select2-id="fjob_control_copy1edit_x_creation_date"
        data-table="job_control_copy1"
        data-field="x_creation_date"
        data-value-separator="<?= $Page->creation_date->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->creation_date->getPlaceHolder()) ?>"
        <?= $Page->creation_date->editAttributes() ?>>
        <?= $Page->creation_date->selectOptionListHtml("x_creation_date") ?>
    </select>
    <?= $Page->creation_date->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->creation_date->getErrorMessage() ?></div>
<?= $Page->creation_date->Lookup->getParamTag($Page, "p_x_creation_date") ?>
<script>
loadjs.ready("fjob_control_copy1edit", function() {
    var options = { name: "x_creation_date", selectId: "fjob_control_copy1edit_x_creation_date" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjob_control_copy1edit.lists.creation_date.lookupOptions.length) {
        options.data = { id: "x_creation_date", form: "fjob_control_copy1edit" };
    } else {
        options.ajax = { id: "x_creation_date", form: "fjob_control_copy1edit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.job_control_copy1.fields.creation_date.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
    <div id="r_store_id"<?= $Page->store_id->rowAttributes() ?>>
        <label id="elh_job_control_copy1_store_id" for="x_store_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->store_id->caption() ?><?= $Page->store_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_id->cellAttributes() ?>>
<span id="el_job_control_copy1_store_id">
<?php $Page->store_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_store_id[]"
        name="x_store_id[]"
        class="form-select ew-select<?= $Page->store_id->isInvalidClass() ?>"
        data-select2-id="fjob_control_copy1edit_x_store_id[]"
        data-table="job_control_copy1"
        data-field="x_store_id"
        multiple
        size="1"
        data-value-separator="<?= $Page->store_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->store_id->getPlaceHolder()) ?>"
        <?= $Page->store_id->editAttributes() ?>>
        <?= $Page->store_id->selectOptionListHtml("x_store_id[]") ?>
    </select>
    <?= $Page->store_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->store_id->getErrorMessage() ?></div>
<?= $Page->store_id->Lookup->getParamTag($Page, "p_x_store_id") ?>
<script>
loadjs.ready("fjob_control_copy1edit", function() {
    var options = { name: "x_store_id[]", selectId: "fjob_control_copy1edit_x_store_id[]" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.multiple = true;
    options.closeOnSelect = false;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjob_control_copy1edit.lists.store_id.lookupOptions.length) {
        options.data = { id: "x_store_id[]", form: "fjob_control_copy1edit" };
    } else {
        options.ajax = { id: "x_store_id[]", form: "fjob_control_copy1edit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.job_control_copy1.fields.store_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->area->Visible) { // area ?>
    <div id="r_area"<?= $Page->area->rowAttributes() ?>>
        <label id="elh_job_control_copy1_area" for="x_area" class="<?= $Page->LeftColumnClass ?>"><?= $Page->area->caption() ?><?= $Page->area->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->area->cellAttributes() ?>>
<span id="el_job_control_copy1_area">
<?php $Page->area->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
    <select
        id="x_area"
        name="x_area"
        class="form-select ew-select<?= $Page->area->isInvalidClass() ?>"
        data-select2-id="fjob_control_copy1edit_x_area"
        data-table="job_control_copy1"
        data-field="x_area"
        data-value-separator="<?= $Page->area->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->area->getPlaceHolder()) ?>"
        <?= $Page->area->editAttributes() ?>>
        <?= $Page->area->selectOptionListHtml("x_area") ?>
    </select>
    <?= $Page->area->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->area->getErrorMessage() ?></div>
<?= $Page->area->Lookup->getParamTag($Page, "p_x_area") ?>
<script>
loadjs.ready("fjob_control_copy1edit", function() {
    var options = { name: "x_area", selectId: "fjob_control_copy1edit_x_area" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjob_control_copy1edit.lists.area.lookupOptions.length) {
        options.data = { id: "x_area", form: "fjob_control_copy1edit" };
    } else {
        options.ajax = { id: "x_area", form: "fjob_control_copy1edit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.job_control_copy1.fields.area.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->aisle->Visible) { // aisle ?>
    <div id="r_aisle"<?= $Page->aisle->rowAttributes() ?>>
        <label id="elh_job_control_copy1_aisle" for="x_aisle" class="<?= $Page->LeftColumnClass ?>"><?= $Page->aisle->caption() ?><?= $Page->aisle->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->aisle->cellAttributes() ?>>
<span id="el_job_control_copy1_aisle">
    <select
        id="x_aisle[]"
        name="x_aisle[]"
        class="form-select ew-select<?= $Page->aisle->isInvalidClass() ?>"
        data-select2-id="fjob_control_copy1edit_x_aisle[]"
        data-table="job_control_copy1"
        data-field="x_aisle"
        multiple
        size="1"
        data-value-separator="<?= $Page->aisle->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->aisle->getPlaceHolder()) ?>"
        <?= $Page->aisle->editAttributes() ?>>
        <?= $Page->aisle->selectOptionListHtml("x_aisle[]") ?>
    </select>
    <?= $Page->aisle->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->aisle->getErrorMessage() ?></div>
<?= $Page->aisle->Lookup->getParamTag($Page, "p_x_aisle") ?>
<script>
loadjs.ready("fjob_control_copy1edit", function() {
    var options = { name: "x_aisle[]", selectId: "fjob_control_copy1edit_x_aisle[]" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.multiple = true;
    options.closeOnSelect = false;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjob_control_copy1edit.lists.aisle.lookupOptions.length) {
        options.data = { id: "x_aisle[]", form: "fjob_control_copy1edit" };
    } else {
        options.ajax = { id: "x_aisle[]", form: "fjob_control_copy1edit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.job_control_copy1.fields.aisle.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
    <div id="r_user"<?= $Page->user->rowAttributes() ?>>
        <label id="elh_job_control_copy1_user" for="x_user" class="<?= $Page->LeftColumnClass ?>"><?= $Page->user->caption() ?><?= $Page->user->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->user->cellAttributes() ?>>
<span id="el_job_control_copy1_user">
    <select
        id="x_user"
        name="x_user"
        class="form-select ew-select<?= $Page->user->isInvalidClass() ?>"
        data-select2-id="fjob_control_copy1edit_x_user"
        data-table="job_control_copy1"
        data-field="x_user"
        data-value-separator="<?= $Page->user->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->user->getPlaceHolder()) ?>"
        <?= $Page->user->editAttributes() ?>>
        <?= $Page->user->selectOptionListHtml("x_user") ?>
    </select>
    <?= $Page->user->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->user->getErrorMessage() ?></div>
<?= $Page->user->Lookup->getParamTag($Page, "p_x_user") ?>
<script>
loadjs.ready("fjob_control_copy1edit", function() {
    var options = { name: "x_user", selectId: "fjob_control_copy1edit_x_user" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjob_control_copy1edit.lists.user.lookupOptions.length) {
        options.data = { id: "x_user", form: "fjob_control_copy1edit" };
    } else {
        options.ajax = { id: "x_user", form: "fjob_control_copy1edit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.job_control_copy1.fields.user.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_job_control_copy1_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_job_control_copy1_status">
    <select
        id="x_status"
        name="x_status"
        class="form-select ew-select<?= $Page->status->isInvalidClass() ?>"
        data-select2-id="fjob_control_copy1edit_x_status"
        data-table="job_control_copy1"
        data-field="x_status"
        data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"
        <?= $Page->status->editAttributes() ?>>
        <?= $Page->status->selectOptionListHtml("x_status") ?>
    </select>
    <?= $Page->status->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
<script>
loadjs.ready("fjob_control_copy1edit", function() {
    var options = { name: "x_status", selectId: "fjob_control_copy1edit_x_status" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjob_control_copy1edit.lists.status.lookupOptions.length) {
        options.data = { id: "x_status", form: "fjob_control_copy1edit" };
    } else {
        options.ajax = { id: "x_status", form: "fjob_control_copy1edit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.job_control_copy1.fields.status.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <div id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <label id="elh_job_control_copy1_date_created" for="x_date_created" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_created->caption() ?><?= $Page->date_created->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_created->cellAttributes() ?>>
<span id="el_job_control_copy1_date_created">
<input type="<?= $Page->date_created->getInputTextType() ?>" name="x_date_created" id="x_date_created" data-table="job_control_copy1" data-field="x_date_created" value="<?= $Page->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_created->getPlaceHolder()) ?>"<?= $Page->date_created->editAttributes() ?> aria-describedby="x_date_created_help">
<?= $Page->date_created->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_created->getErrorMessage() ?></div>
<?php if (!$Page->date_created->ReadOnly && !$Page->date_created->Disabled && !isset($Page->date_created->EditAttrs["readonly"]) && !isset($Page->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjob_control_copy1edit", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem()
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                    next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                },
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i),
                    useTwentyfourHour: !!format.match(/H/)
                }
            },
            meta: {
                format
            }
        };
    ew.createDateTimePicker("fjob_control_copy1edit", "x_date_created", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
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
    ew.addEventHandlers("job_control_copy1");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
