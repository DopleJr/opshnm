<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$ReportTotesEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { report_totes: currentTable } });
var currentForm, currentPageID;
var freport_totesedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    freport_totesedit = new ew.Form("freport_totesedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = freport_totesedit;

    // Add fields
    var fields = currentTable.fields;
    freport_totesedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["store_id", [fields.store_id.visible && fields.store_id.required ? ew.Validators.required(fields.store_id.caption) : null], fields.store_id.isInvalid],
        ["store_name", [fields.store_name.visible && fields.store_name.required ? ew.Validators.required(fields.store_name.caption) : null], fields.store_name.isInvalid],
        ["out", [fields.out.visible && fields.out.required ? ew.Validators.required(fields.out.caption) : null], fields.out.isInvalid],
        ["in", [fields.in.visible && fields.in.required ? ew.Validators.required(fields.in.caption) : null, ew.Validators.integer], fields.in.isInvalid],
        ["remarks", [fields.remarks.visible && fields.remarks.required ? ew.Validators.required(fields.remarks.caption) : null], fields.remarks.isInvalid],
        ["date_in", [fields.date_in.visible && fields.date_in.required ? ew.Validators.required(fields.date_in.caption) : null, ew.Validators.datetime(fields.date_in.clientFormatPattern)], fields.date_in.isInvalid]
    ]);

    // Form_CustomValidate
    freport_totesedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    freport_totesedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    freport_totesedit.lists.store_id = <?= $Page->store_id->toClientList($Page) ?>;
    freport_totesedit.lists.store_name = <?= $Page->store_name->toClientList($Page) ?>;
    loadjs.done("freport_totesedit");
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
<form name="freport_totesedit" id="freport_totesedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="report_totes">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_report_totes_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_report_totes_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="report_totes" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
    <div id="r_store_id"<?= $Page->store_id->rowAttributes() ?>>
        <label id="elh_report_totes_store_id" for="x_store_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->store_id->caption() ?><?= $Page->store_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_id->cellAttributes() ?>>
<span id="el_report_totes_store_id">
<?php $Page->store_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_store_id"
        name="x_store_id"
        class="form-select ew-select<?= $Page->store_id->isInvalidClass() ?>"
        data-select2-id="freport_totesedit_x_store_id"
        data-table="report_totes"
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
loadjs.ready("freport_totesedit", function() {
    var options = { name: "x_store_id", selectId: "freport_totesedit_x_store_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (freport_totesedit.lists.store_id.lookupOptions.length) {
        options.data = { id: "x_store_id", form: "freport_totesedit" };
    } else {
        options.ajax = { id: "x_store_id", form: "freport_totesedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.report_totes.fields.store_id.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
    <div id="r_store_name"<?= $Page->store_name->rowAttributes() ?>>
        <label id="elh_report_totes_store_name" for="x_store_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->store_name->caption() ?><?= $Page->store_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_name->cellAttributes() ?>>
<span id="el_report_totes_store_name">
    <select
        id="x_store_name"
        name="x_store_name"
        class="form-select ew-select<?= $Page->store_name->isInvalidClass() ?>"
        data-select2-id="freport_totesedit_x_store_name"
        data-table="report_totes"
        data-field="x_store_name"
        data-value-separator="<?= $Page->store_name->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->store_name->getPlaceHolder()) ?>"
        <?= $Page->store_name->editAttributes() ?>>
        <?= $Page->store_name->selectOptionListHtml("x_store_name") ?>
    </select>
    <?= $Page->store_name->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->store_name->getErrorMessage() ?></div>
<?= $Page->store_name->Lookup->getParamTag($Page, "p_x_store_name") ?>
<script>
loadjs.ready("freport_totesedit", function() {
    var options = { name: "x_store_name", selectId: "freport_totesedit_x_store_name" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (freport_totesedit.lists.store_name.lookupOptions.length) {
        options.data = { id: "x_store_name", form: "freport_totesedit" };
    } else {
        options.ajax = { id: "x_store_name", form: "freport_totesedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.report_totes.fields.store_name.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->out->Visible) { // out ?>
    <div id="r_out"<?= $Page->out->rowAttributes() ?>>
        <label id="elh_report_totes_out" for="x_out" class="<?= $Page->LeftColumnClass ?>"><?= $Page->out->caption() ?><?= $Page->out->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->out->cellAttributes() ?>>
<span id="el_report_totes_out">
<span<?= $Page->out->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->out->getDisplayValue($Page->out->EditValue))) ?>"></span>
<input type="hidden" data-table="report_totes" data-field="x_out" data-hidden="1" name="x_out" id="x_out" value="<?= HtmlEncode($Page->out->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->in->Visible) { // in ?>
    <div id="r_in"<?= $Page->in->rowAttributes() ?>>
        <label id="elh_report_totes_in" for="x_in" class="<?= $Page->LeftColumnClass ?>"><?= $Page->in->caption() ?><?= $Page->in->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->in->cellAttributes() ?>>
<span id="el_report_totes_in">
<input type="<?= $Page->in->getInputTextType() ?>" name="x_in" id="x_in" data-table="report_totes" data-field="x_in" value="<?= $Page->in->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->in->getPlaceHolder()) ?>"<?= $Page->in->editAttributes() ?> aria-describedby="x_in_help">
<?= $Page->in->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->in->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->remarks->Visible) { // remarks ?>
    <div id="r_remarks"<?= $Page->remarks->rowAttributes() ?>>
        <label id="elh_report_totes_remarks" for="x_remarks" class="<?= $Page->LeftColumnClass ?>"><?= $Page->remarks->caption() ?><?= $Page->remarks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->remarks->cellAttributes() ?>>
<span id="el_report_totes_remarks">
<input type="<?= $Page->remarks->getInputTextType() ?>" name="x_remarks" id="x_remarks" data-table="report_totes" data-field="x_remarks" value="<?= $Page->remarks->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->remarks->getPlaceHolder()) ?>"<?= $Page->remarks->editAttributes() ?> aria-describedby="x_remarks_help">
<?= $Page->remarks->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->remarks->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_in->Visible) { // date_in ?>
    <div id="r_date_in"<?= $Page->date_in->rowAttributes() ?>>
        <label id="elh_report_totes_date_in" for="x_date_in" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_in->caption() ?><?= $Page->date_in->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_in->cellAttributes() ?>>
<span id="el_report_totes_date_in">
<input type="<?= $Page->date_in->getInputTextType() ?>" name="x_date_in" id="x_date_in" data-table="report_totes" data-field="x_date_in" value="<?= $Page->date_in->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_in->getPlaceHolder()) ?>"<?= $Page->date_in->editAttributes() ?> aria-describedby="x_date_in_help">
<?= $Page->date_in->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_in->getErrorMessage() ?></div>
<?php if (!$Page->date_in->ReadOnly && !$Page->date_in->Disabled && !isset($Page->date_in->EditAttrs["readonly"]) && !isset($Page->date_in->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freport_totesedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("freport_totesedit", "x_date_in", ew.deepAssign({"useCurrent":false}, options));
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
    ew.addEventHandlers("report_totes");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
