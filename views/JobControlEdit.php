<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$JobControlEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { job_control: currentTable } });
var currentForm, currentPageID;
var fjob_controledit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fjob_controledit = new ew.Form("fjob_controledit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fjob_controledit;

    // Add fields
    var fields = currentTable.fields;
    fjob_controledit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["job_category", [fields.job_category.visible && fields.job_category.required ? ew.Validators.required(fields.job_category.caption) : null], fields.job_category.isInvalid],
        ["aisle", [fields.aisle.visible && fields.aisle.required ? ew.Validators.required(fields.aisle.caption) : null], fields.aisle.isInvalid],
        ["user", [fields.user.visible && fields.user.required ? ew.Validators.required(fields.user.caption) : null], fields.user.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null, ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
        ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null, ew.Validators.datetime(fields.date_updated.clientFormatPattern)], fields.date_updated.isInvalid],
        ["test", [fields.test.visible && fields.test.required ? ew.Validators.required(fields.test.caption) : null], fields.test.isInvalid]
    ]);

    // Form_CustomValidate
    fjob_controledit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fjob_controledit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fjob_controledit.lists.job_category = <?= $Page->job_category->toClientList($Page) ?>;
    fjob_controledit.lists.aisle = <?= $Page->aisle->toClientList($Page) ?>;
    fjob_controledit.lists.user = <?= $Page->user->toClientList($Page) ?>;
    fjob_controledit.lists.status = <?= $Page->status->toClientList($Page) ?>;
    loadjs.done("fjob_controledit");
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
<form name="fjob_controledit" id="fjob_controledit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="job_control">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_job_control_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_job_control_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="job_control" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->job_category->Visible) { // job_category ?>
    <div id="r_job_category"<?= $Page->job_category->rowAttributes() ?>>
        <label id="elh_job_control_job_category" for="x_job_category" class="<?= $Page->LeftColumnClass ?>"><?= $Page->job_category->caption() ?><?= $Page->job_category->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->job_category->cellAttributes() ?>>
<span id="el_job_control_job_category">
    <select
        id="x_job_category"
        name="x_job_category"
        class="form-select ew-select<?= $Page->job_category->isInvalidClass() ?>"
        data-select2-id="fjob_controledit_x_job_category"
        data-table="job_control"
        data-field="x_job_category"
        data-value-separator="<?= $Page->job_category->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->job_category->getPlaceHolder()) ?>"
        <?= $Page->job_category->editAttributes() ?>>
        <?= $Page->job_category->selectOptionListHtml("x_job_category") ?>
    </select>
    <?= $Page->job_category->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->job_category->getErrorMessage() ?></div>
<script>
loadjs.ready("fjob_controledit", function() {
    var options = { name: "x_job_category", selectId: "fjob_controledit_x_job_category" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjob_controledit.lists.job_category.lookupOptions.length) {
        options.data = { id: "x_job_category", form: "fjob_controledit" };
    } else {
        options.ajax = { id: "x_job_category", form: "fjob_controledit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.job_control.fields.job_category.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->aisle->Visible) { // aisle ?>
    <div id="r_aisle"<?= $Page->aisle->rowAttributes() ?>>
        <label id="elh_job_control_aisle" class="<?= $Page->LeftColumnClass ?>"><?= $Page->aisle->caption() ?><?= $Page->aisle->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->aisle->cellAttributes() ?>>
<span id="el_job_control_aisle">
    <select
        id="x_aisle[]"
        name="x_aisle[]"
        class="form-select ew-select<?= $Page->aisle->isInvalidClass() ?>"
        data-select2-id="fjob_controledit_x_aisle[]"
        data-table="job_control"
        data-field="x_aisle"
        data-dropdown
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
loadjs.ready("fjob_controledit", function() {
    var options = { name: "x_aisle[]", selectId: "fjob_controledit_x_aisle[]" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.multiple = true;
    options.closeOnSelect = false;
    options.columns = el.dataset.repeatcolumn || 5;
    options.dropdown = !ew.IS_MOBILE && options.columns > 0; // Use custom dropdown
    el.dataset.dropdown = options.dropdown;
    if (options.dropdown) {
        options.dropdownAutoWidth = true;
        options.dropdownCssClass = "ew-select-dropdown ew-select-multiple job_control-x_aisle-dropdown";
        if (options.columns > 1)
            options.dropdownCssClass += " ew-repeat-column";
    }
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjob_controledit.lists.aisle.lookupOptions.length) {
        options.data = { id: "x_aisle[]", form: "fjob_controledit" };
    } else {
        options.ajax = { id: "x_aisle[]", form: "fjob_controledit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.job_control.fields.aisle.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
    <div id="r_user"<?= $Page->user->rowAttributes() ?>>
        <label id="elh_job_control_user" for="x_user" class="<?= $Page->LeftColumnClass ?>"><?= $Page->user->caption() ?><?= $Page->user->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->user->cellAttributes() ?>>
<span id="el_job_control_user">
    <select
        id="x_user"
        name="x_user"
        class="form-select ew-select<?= $Page->user->isInvalidClass() ?>"
        data-select2-id="fjob_controledit_x_user"
        data-table="job_control"
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
loadjs.ready("fjob_controledit", function() {
    var options = { name: "x_user", selectId: "fjob_controledit_x_user" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjob_controledit.lists.user.lookupOptions.length) {
        options.data = { id: "x_user", form: "fjob_controledit" };
    } else {
        options.ajax = { id: "x_user", form: "fjob_controledit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.job_control.fields.user.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_job_control_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_job_control_status">
    <select
        id="x_status"
        name="x_status"
        class="form-select ew-select<?= $Page->status->isInvalidClass() ?>"
        data-select2-id="fjob_controledit_x_status"
        data-table="job_control"
        data-field="x_status"
        data-value-separator="<?= $Page->status->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"
        <?= $Page->status->editAttributes() ?>>
        <?= $Page->status->selectOptionListHtml("x_status") ?>
    </select>
    <?= $Page->status->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
<script>
loadjs.ready("fjob_controledit", function() {
    var options = { name: "x_status", selectId: "fjob_controledit_x_status" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fjob_controledit.lists.status.lookupOptions.length) {
        options.data = { id: "x_status", form: "fjob_controledit" };
    } else {
        options.ajax = { id: "x_status", form: "fjob_controledit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.job_control.fields.status.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <div id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <label id="elh_job_control_date_created" for="x_date_created" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_created->caption() ?><?= $Page->date_created->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_created->cellAttributes() ?>>
<span id="el_job_control_date_created">
<input type="<?= $Page->date_created->getInputTextType() ?>" name="x_date_created" id="x_date_created" data-table="job_control" data-field="x_date_created" value="<?= $Page->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_created->getPlaceHolder()) ?>"<?= $Page->date_created->editAttributes() ?> aria-describedby="x_date_created_help">
<?= $Page->date_created->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_created->getErrorMessage() ?></div>
<?php if (!$Page->date_created->ReadOnly && !$Page->date_created->Disabled && !isset($Page->date_created->EditAttrs["readonly"]) && !isset($Page->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjob_controledit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjob_controledit", "x_date_created", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_updated->Visible) { // date_updated ?>
    <div id="r_date_updated"<?= $Page->date_updated->rowAttributes() ?>>
        <label id="elh_job_control_date_updated" for="x_date_updated" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_updated->caption() ?><?= $Page->date_updated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_updated->cellAttributes() ?>>
<span id="el_job_control_date_updated">
<input type="<?= $Page->date_updated->getInputTextType() ?>" name="x_date_updated" id="x_date_updated" data-table="job_control" data-field="x_date_updated" value="<?= $Page->date_updated->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_updated->getPlaceHolder()) ?>"<?= $Page->date_updated->editAttributes() ?> aria-describedby="x_date_updated_help">
<?= $Page->date_updated->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_updated->getErrorMessage() ?></div>
<?php if (!$Page->date_updated->ReadOnly && !$Page->date_updated->Disabled && !isset($Page->date_updated->EditAttrs["readonly"]) && !isset($Page->date_updated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjob_controledit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjob_controledit", "x_date_updated", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->test->Visible) { // test ?>
    <div id="r_test"<?= $Page->test->rowAttributes() ?>>
        <label id="elh_job_control_test" for="x_test" class="<?= $Page->LeftColumnClass ?>"><?= $Page->test->caption() ?><?= $Page->test->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->test->cellAttributes() ?>>
<span id="el_job_control_test">
<input type="<?= $Page->test->getInputTextType() ?>" name="x_test" id="x_test" data-table="job_control" data-field="x_test" value="<?= $Page->test->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->test->getPlaceHolder()) ?>"<?= $Page->test->editAttributes() ?> aria-describedby="x_test_help">
<?= $Page->test->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->test->getErrorMessage() ?></div>
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
    ew.addEventHandlers("job_control");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
