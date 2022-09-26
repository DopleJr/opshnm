<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$AuditPickingOnlineEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { audit_picking_online: currentTable } });
var currentForm, currentPageID;
var faudit_picking_onlineedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    faudit_picking_onlineedit = new ew.Form("faudit_picking_onlineedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = faudit_picking_onlineedit;

    // Add fields
    var fields = currentTable.fields;
    faudit_picking_onlineedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["box_code", [fields.box_code.visible && fields.box_code.required ? ew.Validators.required(fields.box_code.caption) : null], fields.box_code.isInvalid],
        ["store_id", [fields.store_id.visible && fields.store_id.required ? ew.Validators.required(fields.store_id.caption) : null], fields.store_id.isInvalid],
        ["store_name", [fields.store_name.visible && fields.store_name.required ? ew.Validators.required(fields.store_name.caption) : null], fields.store_name.isInvalid],
        ["article", [fields.article.visible && fields.article.required ? ew.Validators.required(fields.article.caption) : null], fields.article.isInvalid],
        ["picked_qty", [fields.picked_qty.visible && fields.picked_qty.required ? ew.Validators.required(fields.picked_qty.caption) : null, ew.Validators.integer], fields.picked_qty.isInvalid],
        ["scan_qty", [fields.scan_qty.visible && fields.scan_qty.required ? ew.Validators.required(fields.scan_qty.caption) : null], fields.scan_qty.isInvalid],
        ["checker", [fields.checker.visible && fields.checker.required ? ew.Validators.required(fields.checker.caption) : null], fields.checker.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["date_update", [fields.date_update.visible && fields.date_update.required ? ew.Validators.required(fields.date_update.caption) : null, ew.Validators.datetime(fields.date_update.clientFormatPattern)], fields.date_update.isInvalid],
        ["time_update", [fields.time_update.visible && fields.time_update.required ? ew.Validators.required(fields.time_update.caption) : null, ew.Validators.datetime(fields.time_update.clientFormatPattern)], fields.time_update.isInvalid]
    ]);

    // Form_CustomValidate
    faudit_picking_onlineedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    faudit_picking_onlineedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    faudit_picking_onlineedit.lists.box_code = <?= $Page->box_code->toClientList($Page) ?>;
    faudit_picking_onlineedit.lists.store_id = <?= $Page->store_id->toClientList($Page) ?>;
    loadjs.done("faudit_picking_onlineedit");
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
<form name="faudit_picking_onlineedit" id="faudit_picking_onlineedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="audit_picking_online">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_audit_picking_online_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_audit_picking_online_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="audit_picking_online" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->box_code->Visible) { // box_code ?>
    <div id="r_box_code"<?= $Page->box_code->rowAttributes() ?>>
        <label id="elh_audit_picking_online_box_code" for="x_box_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->box_code->caption() ?><?= $Page->box_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->box_code->cellAttributes() ?>>
<span id="el_audit_picking_online_box_code">
<?php $Page->box_code->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_box_code"
        name="x_box_code"
        class="form-select ew-select<?= $Page->box_code->isInvalidClass() ?>"
        data-select2-id="faudit_picking_onlineedit_x_box_code"
        data-table="audit_picking_online"
        data-field="x_box_code"
        data-value-separator="<?= $Page->box_code->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->box_code->getPlaceHolder()) ?>"
        <?= $Page->box_code->editAttributes() ?>>
        <?= $Page->box_code->selectOptionListHtml("x_box_code") ?>
    </select>
    <?= $Page->box_code->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->box_code->getErrorMessage() ?></div>
<?= $Page->box_code->Lookup->getParamTag($Page, "p_x_box_code") ?>
<script>
loadjs.ready("faudit_picking_onlineedit", function() {
    var options = { name: "x_box_code", selectId: "faudit_picking_onlineedit_x_box_code" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (faudit_picking_onlineedit.lists.box_code.lookupOptions.length) {
        options.data = { id: "x_box_code", form: "faudit_picking_onlineedit" };
    } else {
        options.ajax = { id: "x_box_code", form: "faudit_picking_onlineedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumInputLength = ew.selectMinimumInputLength;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.audit_picking_online.fields.box_code.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
    <div id="r_store_id"<?= $Page->store_id->rowAttributes() ?>>
        <label id="elh_audit_picking_online_store_id" for="x_store_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->store_id->caption() ?><?= $Page->store_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_id->cellAttributes() ?>>
<span id="el_audit_picking_online_store_id">
<?php $Page->store_id->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
    <select
        id="x_store_id"
        name="x_store_id"
        class="form-select ew-select<?= $Page->store_id->isInvalidClass() ?>"
        data-select2-id="faudit_picking_onlineedit_x_store_id"
        data-table="audit_picking_online"
        data-field="x_store_id"
        data-value-separator="<?= $Page->store_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->store_id->getPlaceHolder()) ?>"
        <?= $Page->store_id->editAttributes() ?>>
        <?= $Page->store_id->selectOptionListHtml("x_store_id") ?>
    </select>
    <?= $Page->store_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->store_id->getErrorMessage() ?></div>
<?= $Page->store_id->Lookup->getParamTag($Page, "p_x_store_id") ?>
<script>
loadjs.ready("faudit_picking_onlineedit", function() {
    var options = { name: "x_store_id", selectId: "faudit_picking_onlineedit_x_store_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (faudit_picking_onlineedit.lists.store_id.lookupOptions.length) {
        options.data = { id: "x_store_id", form: "faudit_picking_onlineedit" };
    } else {
        options.ajax = { id: "x_store_id", form: "faudit_picking_onlineedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.audit_picking_online.fields.store_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
    <div id="r_store_name"<?= $Page->store_name->rowAttributes() ?>>
        <label id="elh_audit_picking_online_store_name" for="x_store_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->store_name->caption() ?><?= $Page->store_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_name->cellAttributes() ?>>
<span id="el_audit_picking_online_store_name">
<input type="<?= $Page->store_name->getInputTextType() ?>" name="x_store_name" id="x_store_name" data-table="audit_picking_online" data-field="x_store_name" value="<?= $Page->store_name->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->store_name->getPlaceHolder()) ?>"<?= $Page->store_name->editAttributes() ?> aria-describedby="x_store_name_help">
<?= $Page->store_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->store_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <div id="r_article"<?= $Page->article->rowAttributes() ?>>
        <label id="elh_audit_picking_online_article" for="x_article" class="<?= $Page->LeftColumnClass ?>"><?= $Page->article->caption() ?><?= $Page->article->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->article->cellAttributes() ?>>
<span id="el_audit_picking_online_article">
<input type="<?= $Page->article->getInputTextType() ?>" name="x_article" id="x_article" data-table="audit_picking_online" data-field="x_article" value="<?= $Page->article->EditValue ?>" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->article->getPlaceHolder()) ?>"<?= $Page->article->editAttributes() ?> aria-describedby="x_article_help">
<?= $Page->article->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->article->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->picked_qty->Visible) { // picked_qty ?>
    <div id="r_picked_qty"<?= $Page->picked_qty->rowAttributes() ?>>
        <label id="elh_audit_picking_online_picked_qty" for="x_picked_qty" class="<?= $Page->LeftColumnClass ?>"><?= $Page->picked_qty->caption() ?><?= $Page->picked_qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->picked_qty->cellAttributes() ?>>
<span id="el_audit_picking_online_picked_qty">
<input type="<?= $Page->picked_qty->getInputTextType() ?>" name="x_picked_qty" id="x_picked_qty" data-table="audit_picking_online" data-field="x_picked_qty" value="<?= $Page->picked_qty->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->picked_qty->getPlaceHolder()) ?>"<?= $Page->picked_qty->editAttributes() ?> aria-describedby="x_picked_qty_help">
<?= $Page->picked_qty->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->picked_qty->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->scan_qty->Visible) { // scan_qty ?>
    <div id="r_scan_qty"<?= $Page->scan_qty->rowAttributes() ?>>
        <label id="elh_audit_picking_online_scan_qty" for="x_scan_qty" class="<?= $Page->LeftColumnClass ?>"><?= $Page->scan_qty->caption() ?><?= $Page->scan_qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->scan_qty->cellAttributes() ?>>
<span id="el_audit_picking_online_scan_qty">
<input type="<?= $Page->scan_qty->getInputTextType() ?>" name="x_scan_qty" id="x_scan_qty" data-table="audit_picking_online" data-field="x_scan_qty" value="<?= $Page->scan_qty->EditValue ?>" placeholder="<?= HtmlEncode($Page->scan_qty->getPlaceHolder()) ?>"<?= $Page->scan_qty->editAttributes() ?> aria-describedby="x_scan_qty_help">
<?= $Page->scan_qty->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->scan_qty->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->checker->Visible) { // checker ?>
    <div id="r_checker"<?= $Page->checker->rowAttributes() ?>>
        <label id="elh_audit_picking_online_checker" for="x_checker" class="<?= $Page->LeftColumnClass ?>"><?= $Page->checker->caption() ?><?= $Page->checker->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->checker->cellAttributes() ?>>
<span id="el_audit_picking_online_checker">
<input type="<?= $Page->checker->getInputTextType() ?>" name="x_checker" id="x_checker" data-table="audit_picking_online" data-field="x_checker" value="<?= $Page->checker->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->checker->getPlaceHolder()) ?>"<?= $Page->checker->editAttributes() ?> aria-describedby="x_checker_help">
<?= $Page->checker->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->checker->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_audit_picking_online_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_audit_picking_online_status">
<input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="audit_picking_online" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_update->Visible) { // date_update ?>
    <div id="r_date_update"<?= $Page->date_update->rowAttributes() ?>>
        <label id="elh_audit_picking_online_date_update" for="x_date_update" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_update->caption() ?><?= $Page->date_update->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_update->cellAttributes() ?>>
<span id="el_audit_picking_online_date_update">
<input type="<?= $Page->date_update->getInputTextType() ?>" name="x_date_update" id="x_date_update" data-table="audit_picking_online" data-field="x_date_update" value="<?= $Page->date_update->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_update->getPlaceHolder()) ?>"<?= $Page->date_update->editAttributes() ?> aria-describedby="x_date_update_help">
<?= $Page->date_update->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_update->getErrorMessage() ?></div>
<?php if (!$Page->date_update->ReadOnly && !$Page->date_update->Disabled && !isset($Page->date_update->EditAttrs["readonly"]) && !isset($Page->date_update->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["faudit_picking_onlineedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("faudit_picking_onlineedit", "x_date_update", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->time_update->Visible) { // time_update ?>
    <div id="r_time_update"<?= $Page->time_update->rowAttributes() ?>>
        <label id="elh_audit_picking_online_time_update" for="x_time_update" class="<?= $Page->LeftColumnClass ?>"><?= $Page->time_update->caption() ?><?= $Page->time_update->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->time_update->cellAttributes() ?>>
<span id="el_audit_picking_online_time_update">
<input type="<?= $Page->time_update->getInputTextType() ?>" name="x_time_update" id="x_time_update" data-table="audit_picking_online" data-field="x_time_update" value="<?= $Page->time_update->EditValue ?>" placeholder="<?= HtmlEncode($Page->time_update->getPlaceHolder()) ?>"<?= $Page->time_update->editAttributes() ?> aria-describedby="x_time_update_help">
<?= $Page->time_update->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->time_update->getErrorMessage() ?></div>
<?php if (!$Page->time_update->ReadOnly && !$Page->time_update->Disabled && !isset($Page->time_update->EditAttrs["readonly"]) && !isset($Page->time_update->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["faudit_picking_onlineedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("faudit_picking_onlineedit", "x_time_update", ew.deepAssign({"useCurrent":false}, options));
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
    ew.addEventHandlers("audit_picking_online");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
