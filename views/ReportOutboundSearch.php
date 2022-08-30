<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$ReportOutboundSearch = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { report_outbound: currentTable } });
var currentForm, currentPageID;
var freport_outboundsearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    freport_outboundsearch = new ew.Form("freport_outboundsearch", "search");
    <?php if ($Page->IsModal) { ?>
    currentAdvancedSearchForm = freport_outboundsearch;
    <?php } else { ?>
    currentForm = freport_outboundsearch;
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var fields = currentTable.fields;
    freport_outboundsearch.addFields([
        ["Week", [], fields.Week.isInvalid],
        ["box_id", [], fields.box_id.isInvalid],
        ["date_delivery", [ew.Validators.datetime(fields.date_delivery.clientFormatPattern)], fields.date_delivery.isInvalid],
        ["y_date_delivery", [ew.Validators.between], false]
    ]);

    // Validate form
    freport_outboundsearch.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm();

        // Validate fields
        if (!this.validateFields())
            return false;

        // Call Form_CustomValidate event
        if (!this.customValidate(fobj)) {
            this.focus();
            return false;
        }
        return true;
    }

    // Form_CustomValidate
    freport_outboundsearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    freport_outboundsearch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("freport_outboundsearch");
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
<form name="freport_outboundsearch" id="freport_outboundsearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="report_outbound">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->Week->Visible) { // Week ?>
    <div id="r_Week"<?= $Page->Week->rowAttributes() ?>>
        <label for="x_Week" class="<?= $Page->LeftColumnClass ?>"><span id="elh_report_outbound_Week"><?= $Page->Week->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_Week" id="z_Week" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->Week->cellAttributes() ?>>
            <span id="el_report_outbound_Week" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->Week->getInputTextType() ?>" name="x_Week" id="x_Week" data-table="report_outbound" data-field="x_Week" value="<?= $Page->Week->EditValue ?>" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->Week->getPlaceHolder()) ?>"<?= $Page->Week->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->Week->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
    <div id="r_box_id"<?= $Page->box_id->rowAttributes() ?>>
        <label for="x_box_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_report_outbound_box_id"><?= $Page->box_id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_box_id" id="z_box_id" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->box_id->cellAttributes() ?>>
            <span id="el_report_outbound_box_id" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->box_id->getInputTextType() ?>" name="x_box_id" id="x_box_id" data-table="report_outbound" data-field="x_box_id" value="<?= $Page->box_id->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->box_id->getPlaceHolder()) ?>"<?= $Page->box_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->box_id->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->date_delivery->Visible) { // date_delivery ?>
    <div id="r_date_delivery"<?= $Page->date_delivery->rowAttributes() ?>>
        <label for="x_date_delivery" class="<?= $Page->LeftColumnClass ?>"><span id="elh_report_outbound_date_delivery"><?= $Page->date_delivery->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_date_delivery" id="z_date_delivery" value="BETWEEN">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->date_delivery->cellAttributes() ?>>
            <span id="el_report_outbound_date_delivery" class="ew-search-field">
<input type="<?= $Page->date_delivery->getInputTextType() ?>" name="x_date_delivery" id="x_date_delivery" data-table="report_outbound" data-field="x_date_delivery" value="<?= $Page->date_delivery->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_delivery->getPlaceHolder()) ?>"<?= $Page->date_delivery->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->date_delivery->getErrorMessage(false) ?></div>
<?php if (!$Page->date_delivery->ReadOnly && !$Page->date_delivery->Disabled && !isset($Page->date_delivery->EditAttrs["readonly"]) && !isset($Page->date_delivery->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freport_outboundsearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("freport_outboundsearch", "x_date_delivery", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
                <span class="ew-search-and"><label><?= $Language->phrase("AND") ?></label></span>
                <span id="el2_report_outbound_date_delivery" class="ew-search-field2">
<input type="<?= $Page->date_delivery->getInputTextType() ?>" name="y_date_delivery" id="y_date_delivery" data-table="report_outbound" data-field="x_date_delivery" value="<?= $Page->date_delivery->EditValue2 ?>" placeholder="<?= HtmlEncode($Page->date_delivery->getPlaceHolder()) ?>"<?= $Page->date_delivery->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->date_delivery->getErrorMessage(false) ?></div>
<?php if (!$Page->date_delivery->ReadOnly && !$Page->date_delivery->Disabled && !isset($Page->date_delivery->EditAttrs["readonly"]) && !isset($Page->date_delivery->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freport_outboundsearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("freport_outboundsearch", "y_date_delivery", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
        <button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("Search") ?></button>
        <button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" data-ew-action="reload"><?= $Language->phrase("Reset") ?></button>
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
    ew.addEventHandlers("report_outbound");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
