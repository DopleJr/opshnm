<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$JobControlCopy1Add = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { job_control_copy1: currentTable } });
var currentForm, currentPageID;
var fjob_control_copy1add;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fjob_control_copy1add = new ew.Form("fjob_control_copy1add", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fjob_control_copy1add;

    // Add fields
    var fields = currentTable.fields;
    fjob_control_copy1add.addFields([
        ["creation_date", [fields.creation_date.visible && fields.creation_date.required ? ew.Validators.required(fields.creation_date.caption) : null], fields.creation_date.isInvalid],
        ["store_id", [fields.store_id.visible && fields.store_id.required ? ew.Validators.required(fields.store_id.caption) : null], fields.store_id.isInvalid],
        ["area", [fields.area.visible && fields.area.required ? ew.Validators.required(fields.area.caption) : null], fields.area.isInvalid],
        ["aisle", [fields.aisle.visible && fields.aisle.required ? ew.Validators.required(fields.aisle.caption) : null], fields.aisle.isInvalid],
        ["user", [fields.user.visible && fields.user.required ? ew.Validators.required(fields.user.caption) : null], fields.user.isInvalid],
        ["target_qty", [fields.target_qty.visible && fields.target_qty.required ? ew.Validators.required(fields.target_qty.caption) : null], fields.target_qty.isInvalid],
        ["picked_qty", [fields.picked_qty.visible && fields.picked_qty.required ? ew.Validators.required(fields.picked_qty.caption) : null], fields.picked_qty.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
        ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null], fields.date_updated.isInvalid]
    ]);

    // Form_CustomValidate
    fjob_control_copy1add.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fjob_control_copy1add.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fjob_control_copy1add.lists.creation_date = <?= $Page->creation_date->toClientList($Page) ?>;
    fjob_control_copy1add.lists.store_id = <?= $Page->store_id->toClientList($Page) ?>;
    fjob_control_copy1add.lists.area = <?= $Page->area->toClientList($Page) ?>;
    fjob_control_copy1add.lists.aisle = <?= $Page->aisle->toClientList($Page) ?>;
    fjob_control_copy1add.lists.user = <?= $Page->user->toClientList($Page) ?>;
    fjob_control_copy1add.lists.status = <?= $Page->status->toClientList($Page) ?>;
    loadjs.done("fjob_control_copy1add");
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
<form name="fjob_control_copy1add" id="fjob_control_copy1add" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="job_control_copy1">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div d-none"><!-- page* -->
<?php if ($Page->creation_date->Visible) { // creation_date ?>
    <div id="r_creation_date"<?= $Page->creation_date->rowAttributes() ?>>
        <label id="elh_job_control_copy1_creation_date" for="x_creation_date" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_job_control_copy1_creation_date"><?= $Page->creation_date->caption() ?><?= $Page->creation_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->creation_date->cellAttributes() ?>>
<template id="tpx_job_control_copy1_creation_date"><span id="el_job_control_copy1_creation_date">
<?php $Page->creation_date->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_creation_date"
        name="x_creation_date"
        class="form-select ew-select<?= $Page->creation_date->isInvalidClass() ?>"
        data-select2-id="fjob_control_copy1add_x_creation_date"
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
loadjs.ready("fjob_control_copy1add", function() {
    var options = { name: "x_creation_date", selectId: "fjob_control_copy1add_x_creation_date" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjob_control_copy1add.lists.creation_date.lookupOptions.length) {
        options.data = { id: "x_creation_date", form: "fjob_control_copy1add" };
    } else {
        options.ajax = { id: "x_creation_date", form: "fjob_control_copy1add", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.job_control_copy1.fields.creation_date.selectOptions);
    ew.createSelect(options);
});
</script>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
    <div id="r_store_id"<?= $Page->store_id->rowAttributes() ?>>
        <label id="elh_job_control_copy1_store_id" for="x_store_id" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_job_control_copy1_store_id"><?= $Page->store_id->caption() ?><?= $Page->store_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_id->cellAttributes() ?>>
<template id="tpx_job_control_copy1_store_id"><span id="el_job_control_copy1_store_id">
<?php $Page->store_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_store_id[]"
        name="x_store_id[]"
        class="form-select ew-select<?= $Page->store_id->isInvalidClass() ?>"
        data-select2-id="fjob_control_copy1add_x_store_id[]"
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
loadjs.ready("fjob_control_copy1add", function() {
    var options = { name: "x_store_id[]", selectId: "fjob_control_copy1add_x_store_id[]" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.multiple = true;
    options.closeOnSelect = false;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjob_control_copy1add.lists.store_id.lookupOptions.length) {
        options.data = { id: "x_store_id[]", form: "fjob_control_copy1add" };
    } else {
        options.ajax = { id: "x_store_id[]", form: "fjob_control_copy1add", limit: 100 };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.job_control_copy1.fields.store_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->area->Visible) { // area ?>
    <div id="r_area"<?= $Page->area->rowAttributes() ?>>
        <label id="elh_job_control_copy1_area" for="x_area" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_job_control_copy1_area"><?= $Page->area->caption() ?><?= $Page->area->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->area->cellAttributes() ?>>
<template id="tpx_job_control_copy1_area"><span id="el_job_control_copy1_area">
<?php $Page->area->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_area"
        name="x_area"
        class="form-select ew-select<?= $Page->area->isInvalidClass() ?>"
        data-select2-id="fjob_control_copy1add_x_area"
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
loadjs.ready("fjob_control_copy1add", function() {
    var options = { name: "x_area", selectId: "fjob_control_copy1add_x_area" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjob_control_copy1add.lists.area.lookupOptions.length) {
        options.data = { id: "x_area", form: "fjob_control_copy1add" };
    } else {
        options.ajax = { id: "x_area", form: "fjob_control_copy1add", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.job_control_copy1.fields.area.selectOptions);
    ew.createSelect(options);
});
</script>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->aisle->Visible) { // aisle ?>
    <div id="r_aisle"<?= $Page->aisle->rowAttributes() ?>>
        <label id="elh_job_control_copy1_aisle" for="x_aisle" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_job_control_copy1_aisle"><?= $Page->aisle->caption() ?><?= $Page->aisle->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->aisle->cellAttributes() ?>>
<template id="tpx_job_control_copy1_aisle"><span id="el_job_control_copy1_aisle">
    <select
        id="x_aisle[]"
        name="x_aisle[]"
        class="form-select ew-select<?= $Page->aisle->isInvalidClass() ?>"
        data-select2-id="fjob_control_copy1add_x_aisle[]"
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
loadjs.ready("fjob_control_copy1add", function() {
    var options = { name: "x_aisle[]", selectId: "fjob_control_copy1add_x_aisle[]" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.multiple = true;
    options.closeOnSelect = false;
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjob_control_copy1add.lists.aisle.lookupOptions.length) {
        options.data = { id: "x_aisle[]", form: "fjob_control_copy1add" };
    } else {
        options.ajax = { id: "x_aisle[]", form: "fjob_control_copy1add", limit: 100 };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.job_control_copy1.fields.aisle.selectOptions);
    ew.createSelect(options);
});
</script>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
    <div id="r_user"<?= $Page->user->rowAttributes() ?>>
        <label id="elh_job_control_copy1_user" for="x_user" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_job_control_copy1_user"><?= $Page->user->caption() ?><?= $Page->user->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->user->cellAttributes() ?>>
<template id="tpx_job_control_copy1_user"><span id="el_job_control_copy1_user">
    <select
        id="x_user"
        name="x_user"
        class="form-select ew-select<?= $Page->user->isInvalidClass() ?>"
        data-select2-id="fjob_control_copy1add_x_user"
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
loadjs.ready("fjob_control_copy1add", function() {
    var options = { name: "x_user", selectId: "fjob_control_copy1add_x_user" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjob_control_copy1add.lists.user.lookupOptions.length) {
        options.data = { id: "x_user", form: "fjob_control_copy1add" };
    } else {
        options.ajax = { id: "x_user", form: "fjob_control_copy1add", limit: 20 };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.job_control_copy1.fields.user.selectOptions);
    ew.createSelect(options);
});
</script>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->target_qty->Visible) { // target_qty ?>
    <div id="r_target_qty"<?= $Page->target_qty->rowAttributes() ?>>
        <label id="elh_job_control_copy1_target_qty" for="x_target_qty" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_job_control_copy1_target_qty"><?= $Page->target_qty->caption() ?><?= $Page->target_qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->target_qty->cellAttributes() ?>>
<template id="tpx_job_control_copy1_target_qty"><span id="el_job_control_copy1_target_qty">
<input type="<?= $Page->target_qty->getInputTextType() ?>" name="x_target_qty" id="x_target_qty" data-table="job_control_copy1" data-field="x_target_qty" value="<?= $Page->target_qty->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->target_qty->getPlaceHolder()) ?>"<?= $Page->target_qty->editAttributes() ?> aria-describedby="x_target_qty_help">
<?= $Page->target_qty->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->target_qty->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->picked_qty->Visible) { // picked_qty ?>
    <div id="r_picked_qty"<?= $Page->picked_qty->rowAttributes() ?>>
        <label id="elh_job_control_copy1_picked_qty" for="x_picked_qty" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_job_control_copy1_picked_qty"><?= $Page->picked_qty->caption() ?><?= $Page->picked_qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->picked_qty->cellAttributes() ?>>
<template id="tpx_job_control_copy1_picked_qty"><span id="el_job_control_copy1_picked_qty">
<input type="<?= $Page->picked_qty->getInputTextType() ?>" name="x_picked_qty" id="x_picked_qty" data-table="job_control_copy1" data-field="x_picked_qty" value="<?= $Page->picked_qty->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->picked_qty->getPlaceHolder()) ?>"<?= $Page->picked_qty->editAttributes() ?> aria-describedby="x_picked_qty_help">
<?= $Page->picked_qty->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->picked_qty->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_job_control_copy1_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_job_control_copy1_status"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<template id="tpx_job_control_copy1_status"><span id="el_job_control_copy1_status">
    <select
        id="x_status"
        name="x_status"
        class="form-select ew-select<?= $Page->status->isInvalidClass() ?>"
        data-select2-id="fjob_control_copy1add_x_status"
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
loadjs.ready("fjob_control_copy1add", function() {
    var options = { name: "x_status", selectId: "fjob_control_copy1add_x_status" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjob_control_copy1add.lists.status.lookupOptions.length) {
        options.data = { id: "x_status", form: "fjob_control_copy1add" };
    } else {
        options.ajax = { id: "x_status", form: "fjob_control_copy1add", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.job_control_copy1.fields.status.selectOptions);
    ew.createSelect(options);
});
</script>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <div id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <label id="elh_job_control_copy1_date_created" for="x_date_created" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_job_control_copy1_date_created"><?= $Page->date_created->caption() ?><?= $Page->date_created->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_created->cellAttributes() ?>>
<template id="tpx_job_control_copy1_date_created"><span id="el_job_control_copy1_date_created">
<input type="<?= $Page->date_created->getInputTextType() ?>" name="x_date_created" id="x_date_created" data-table="job_control_copy1" data-field="x_date_created" value="<?= $Page->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_created->getPlaceHolder()) ?>"<?= $Page->date_created->editAttributes() ?> aria-describedby="x_date_created_help">
<?= $Page->date_created->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_created->getErrorMessage() ?></div>
<?php if (!$Page->date_created->ReadOnly && !$Page->date_created->Disabled && !isset($Page->date_created->EditAttrs["readonly"]) && !isset($Page->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjob_control_copy1add", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjob_control_copy1add", "x_date_created", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span></template>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_job_control_copy1add" class="ew-custom-template"></div>
<template id="tpm_job_control_copy1add">
<div id="ct_JobControlCopy1Add"><script>
$("#checkbox").on("click", function () {
    if($("#checkbox").is(':checked') ){
        $("select[name='x_aisle[]']").find("option").prop("selected","selected").trigger("change");
    }else{
        $("select[name='x_aisle[]']").find("option").prop("selected", false).trigger("change");
     }
});
$(document).ready(function(){
    $("select[id='x_user[]']").select2({ maximumSelectionSize: 1 });
    });
</script>
<style>
</style>
	<div id="r_creation_date" class="mb-3 row">
        <label for="x_creation_date" class="col-sm-2 col-form-label"><?= $Page->creation_date->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_job_control_copy1_creation_date"></slot></div>
    </div>
    <div id="r_store_id" class="mb-3 row">
        <label for="x_store_id" class="col-sm-2 col-form-label"><?= $Page->store_id->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_job_control_copy1_store_id"></slot></div>
    </div>
    <div id="r_area" class="mb-3 row">
        <label for="x_area" class="col-sm-2 col-form-label"><?= $Page->area->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_job_control_copy1_area"></slot></div>
    </div>
    <div id="r_aisle" class="mb-3 row">
        <label for="x_aisle" class="col-sm-2 col-form-label"><?= $Page->aisle->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_job_control_copy1_aisle"></slot></div>
    </div>
    <div id="check" class="mb-3 row">
        <label for="check" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10"><input type="checkbox" id="checkbox" > Select All</div>
    </div>
    <div id="r_user" class="mb-3 row">
        <label for="x_user" class="col-sm-2 col-form-label"><?= $Page->user->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_job_control_copy1_user"></slot></div>
    </div>
    <div id="r_qty" class="mb-3 row">
        <label for="x_qty" class="col-sm-2 col-form-label"><slot class="ew-slot" name="tpcaption_qty"></slot></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_qty"></slot></div>
    </div>
    <div id="r_status" class="mb-3 row" hidden>
        <label for="x_status" class="col-sm-2 col-form-label"><?= $Page->status->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_job_control_copy1_status"></slot></div>
    </div>
    <div id="r_date_created" class="mb-3 row" hidden>
        <label for="x_date_created" class="col-sm-2 col-form-label"><?= $Page->date_created->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_job_control_copy1_date_created"></slot></div>
    </div>
</div>
</template>
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
</form>
<script class="ew-apply-template">
loadjs.ready(ew.applyTemplateId, function() {
    ew.templateData = { rows: <?= JsonEncode($Page->Rows) ?> };
    ew.applyTemplate("tpd_job_control_copy1add", "tpm_job_control_copy1add", "job_control_copy1add", "<?= $Page->CustomExport ?>", ew.templateData.rows[0]);
    loadjs.done("customtemplate");
});
</script>
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
    // Startup script
    // Write your table-specific startup script here, no need to add script tags.

    /////////////////////////////////////////////////////////////////////////////////////
    $(document).ready(function () {
      $(document).on("focus", "input[type=text]", function () {
        this.select();
      });
      $("#x_store_id").focus();
      $("#x_store_id").change(function () {});
      $("#x_area").change(function () {
        $("#x_aisle").focus();
      });
    });
});
</script>
