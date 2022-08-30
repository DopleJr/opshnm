<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$ReportTotesAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { report_totes: currentTable } });
var currentForm, currentPageID;
var freport_totesadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    freport_totesadd = new ew.Form("freport_totesadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = freport_totesadd;

    // Add fields
    var fields = currentTable.fields;
    freport_totesadd.addFields([
        ["store_id", [fields.store_id.visible && fields.store_id.required ? ew.Validators.required(fields.store_id.caption) : null], fields.store_id.isInvalid],
        ["store_name", [fields.store_name.visible && fields.store_name.required ? ew.Validators.required(fields.store_name.caption) : null], fields.store_name.isInvalid],
        ["out", [fields.out.visible && fields.out.required ? ew.Validators.required(fields.out.caption) : null, ew.Validators.integer], fields.out.isInvalid],
        ["remarks", [fields.remarks.visible && fields.remarks.required ? ew.Validators.required(fields.remarks.caption) : null], fields.remarks.isInvalid],
        ["date_out", [fields.date_out.visible && fields.date_out.required ? ew.Validators.required(fields.date_out.caption) : null, ew.Validators.datetime(fields.date_out.clientFormatPattern)], fields.date_out.isInvalid]
    ]);

    // Form_CustomValidate
    freport_totesadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    freport_totesadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    freport_totesadd.lists.store_id = <?= $Page->store_id->toClientList($Page) ?>;
    freport_totesadd.lists.store_name = <?= $Page->store_name->toClientList($Page) ?>;
    loadjs.done("freport_totesadd");
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
<form name="freport_totesadd" id="freport_totesadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="report_totes">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
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
        data-select2-id="freport_totesadd_x_store_id"
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
loadjs.ready("freport_totesadd", function() {
    var options = { name: "x_store_id", selectId: "freport_totesadd_x_store_id" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (freport_totesadd.lists.store_id.lookupOptions.length) {
        options.data = { id: "x_store_id", form: "freport_totesadd" };
    } else {
        options.ajax = { id: "x_store_id", form: "freport_totesadd", limit: ew.LOOKUP_PAGE_SIZE };
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
        data-select2-id="freport_totesadd_x_store_name"
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
loadjs.ready("freport_totesadd", function() {
    var options = { name: "x_store_name", selectId: "freport_totesadd_x_store_name" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (freport_totesadd.lists.store_name.lookupOptions.length) {
        options.data = { id: "x_store_name", form: "freport_totesadd" };
    } else {
        options.ajax = { id: "x_store_name", form: "freport_totesadd", limit: ew.LOOKUP_PAGE_SIZE };
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
<input type="<?= $Page->out->getInputTextType() ?>" name="x_out" id="x_out" data-table="report_totes" data-field="x_out" value="<?= $Page->out->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->out->getPlaceHolder()) ?>"<?= $Page->out->editAttributes() ?> aria-describedby="x_out_help">
<?= $Page->out->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->out->getErrorMessage() ?></div>
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
<?php if ($Page->date_out->Visible) { // date_out ?>
    <div id="r_date_out"<?= $Page->date_out->rowAttributes() ?>>
        <label id="elh_report_totes_date_out" for="x_date_out" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_out->caption() ?><?= $Page->date_out->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_out->cellAttributes() ?>>
<span id="el_report_totes_date_out">
<input type="<?= $Page->date_out->getInputTextType() ?>" name="x_date_out" id="x_date_out" data-table="report_totes" data-field="x_date_out" value="<?= $Page->date_out->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_out->getPlaceHolder()) ?>"<?= $Page->date_out->editAttributes() ?> aria-describedby="x_date_out_help">
<?= $Page->date_out->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_out->getErrorMessage() ?></div>
<?php if (!$Page->date_out->ReadOnly && !$Page->date_out->Disabled && !isset($Page->date_out->EditAttrs["readonly"]) && !isset($Page->date_out->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freport_totesadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("freport_totesadd", "x_date_out", ew.deepAssign({"useCurrent":false}, options));
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
    ew.addEventHandlers("report_totes");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
