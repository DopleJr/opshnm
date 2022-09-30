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
        ["store_name", [fields.store_name.visible && fields.store_name.required ? ew.Validators.required(fields.store_name.caption) : null], fields.store_name.isInvalid],
        ["user", [fields.user.visible && fields.user.required ? ew.Validators.required(fields.user.caption) : null], fields.user.isInvalid],
        ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
        ["time_created", [fields.time_created.visible && fields.time_created.required ? ew.Validators.required(fields.time_created.caption) : null, ew.Validators.time(fields.time_created.clientFormatPattern)], fields.time_created.isInvalid]
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
<div class="ew-add-div d-none"><!-- page* -->
<?php if ($Page->box_id->Visible) { // box_id ?>
    <div id="r_box_id"<?= $Page->box_id->rowAttributes() ?>>
        <label id="elh_print_label_box_id" for="x_box_id" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_print_label_box_id"><?= $Page->box_id->caption() ?><?= $Page->box_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->box_id->cellAttributes() ?>>
<template id="tpx_print_label_box_id"><span id="el_print_label_box_id">
<input type="<?= $Page->box_id->getInputTextType() ?>" name="x_box_id" id="x_box_id" data-table="print_label" data-field="x_box_id" value="<?= $Page->box_id->EditValue ?>" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->box_id->getPlaceHolder()) ?>"<?= $Page->box_id->editAttributes() ?> aria-describedby="x_box_id_help">
<?= $Page->box_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->box_id->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->priority->Visible) { // priority ?>
    <div id="r_priority"<?= $Page->priority->rowAttributes() ?>>
        <label id="elh_print_label_priority" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_print_label_priority"><?= $Page->priority->caption() ?><?= $Page->priority->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->priority->cellAttributes() ?>>
<template id="tpx_print_label_priority"><span id="el_print_label_priority">
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
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_code->Visible) { // store_code ?>
    <div id="r_store_code"<?= $Page->store_code->rowAttributes() ?>>
        <label id="elh_print_label_store_code" for="x_store_code" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_print_label_store_code"><?= $Page->store_code->caption() ?><?= $Page->store_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_code->cellAttributes() ?>>
<template id="tpx_print_label_store_code"><span id="el_print_label_store_code">
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
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
    <div id="r_store_name"<?= $Page->store_name->rowAttributes() ?>>
        <label id="elh_print_label_store_name" for="x_store_name" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_print_label_store_name"><?= $Page->store_name->caption() ?><?= $Page->store_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_name->cellAttributes() ?>>
<template id="tpx_print_label_store_name"><span id="el_print_label_store_name">
<input type="<?= $Page->store_name->getInputTextType() ?>" name="x_store_name" id="x_store_name" data-table="print_label" data-field="x_store_name" value="<?= $Page->store_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->store_name->getPlaceHolder()) ?>"<?= $Page->store_name->editAttributes() ?> aria-describedby="x_store_name_help">
<?= $Page->store_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->store_name->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
    <div id="r_user"<?= $Page->user->rowAttributes() ?>>
        <label id="elh_print_label_user" for="x_user" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_print_label_user"><?= $Page->user->caption() ?><?= $Page->user->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->user->cellAttributes() ?>>
<template id="tpx_print_label_user"><span id="el_print_label_user">
<input type="<?= $Page->user->getInputTextType() ?>" name="x_user" id="x_user" data-table="print_label" data-field="x_user" value="<?= $Page->user->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->user->getPlaceHolder()) ?>"<?= $Page->user->editAttributes() ?> aria-describedby="x_user_help">
<?= $Page->user->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->user->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <div id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <label id="elh_print_label_date_created" for="x_date_created" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_print_label_date_created"><?= $Page->date_created->caption() ?><?= $Page->date_created->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_created->cellAttributes() ?>>
<template id="tpx_print_label_date_created"><span id="el_print_label_date_created">
<input type="<?= $Page->date_created->getInputTextType() ?>" name="x_date_created" id="x_date_created" data-table="print_label" data-field="x_date_created" value="<?= $Page->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_created->getPlaceHolder()) ?>"<?= $Page->date_created->editAttributes() ?> aria-describedby="x_date_created_help">
<?= $Page->date_created->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_created->getErrorMessage() ?></div>
<?php if (!$Page->date_created->ReadOnly && !$Page->date_created->Disabled && !isset($Page->date_created->EditAttrs["readonly"]) && !isset($Page->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fprint_labeladd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fprint_labeladd", "x_date_created", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->time_created->Visible) { // time_created ?>
    <div id="r_time_created"<?= $Page->time_created->rowAttributes() ?>>
        <label id="elh_print_label_time_created" for="x_time_created" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_print_label_time_created"><?= $Page->time_created->caption() ?><?= $Page->time_created->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->time_created->cellAttributes() ?>>
<template id="tpx_print_label_time_created"><span id="el_print_label_time_created">
<input type="<?= $Page->time_created->getInputTextType() ?>" name="x_time_created" id="x_time_created" data-table="print_label" data-field="x_time_created" value="<?= $Page->time_created->EditValue ?>" placeholder="<?= HtmlEncode($Page->time_created->getPlaceHolder()) ?>"<?= $Page->time_created->editAttributes() ?> aria-describedby="x_time_created_help">
<?= $Page->time_created->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->time_created->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_print_labeladd" class="ew-custom-template"></div>
<template id="tpm_print_labeladd">
<div id="ct_PrintLabelAdd">    <div id="r_box_id" class="mb-3 row">
        <label for="x_box_id" class="col-sm-2 col-form-label"><?= $Page->box_id->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_print_label_box_id"></slot></div>
    </div>
    <div id="r_priority" class="mb-3 row">
        <label for="x_priority" class="col-sm-2 col-form-label"><?= $Page->priority->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_print_label_priority"></slot></div>
    </div>
    <div id="r_store_code" class="mb-3 row">
        <label for="x_store_code" class="col-sm-2 col-form-label"><?= $Page->store_code->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_print_label_store_code"></slot></div>
    </div>
    <div id="r_store_name" class="mb-3 row">
        <label for="x_store_name" class="col-sm-2 col-form-label"><?= $Page->store_name->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_print_label_store_name"></slot></div>
    </div>
    <div id="r_user" class="mb-3 row" hidden>
        <label for="x_user" class="col-sm-2 col-form-label"><?= $Page->user->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_print_label_user"></slot></div>
    </div>
    <div id="r_date_created" class="mb-3 row" hidden>
        <label for="x_date_created" class="col-sm-2 col-form-label"><?= $Page->date_created->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_print_label_date_created"></slot></div>
    </div>
    <div id="r_time_created" class="mb-3 row" hidden>
        <label for="x_time_created" class="col-sm-2 col-form-label"><?= $Page->time_created->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_print_label_time_created"></slot></div>
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
    ew.applyTemplate("tpd_print_labeladd", "tpm_print_labeladd", "print_labeladd", "<?= $Page->CustomExport ?>", ew.templateData.rows[0]);
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
    ew.addEventHandlers("print_label");
});
</script>
<script>
loadjs.ready("load", function () {
    // Startup script
    // Write your table-specific startup script here, no need to add script tags.
    $(".ew-toast").hide();
    $('a.ew-export-link.ew-print').attr('target','_blank');
});
</script>
