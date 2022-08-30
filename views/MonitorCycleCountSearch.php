<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$MonitorCycleCountSearch = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { monitor_cycle_count: currentTable } });
var currentForm, currentPageID;
var fmonitor_cycle_countsearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fmonitor_cycle_countsearch = new ew.Form("fmonitor_cycle_countsearch", "search");
    <?php if ($Page->IsModal) { ?>
    currentAdvancedSearchForm = fmonitor_cycle_countsearch;
    <?php } else { ?>
    currentForm = fmonitor_cycle_countsearch;
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var fields = currentTable.fields;
    fmonitor_cycle_countsearch.addFields([
        ["DateCreated", [ew.Validators.datetime(fields.DateCreated.clientFormatPattern)], fields.DateCreated.isInvalid],
        ["y_DateCreated", [ew.Validators.between], false]
    ]);

    // Validate form
    fmonitor_cycle_countsearch.validate = function () {
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
    fmonitor_cycle_countsearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmonitor_cycle_countsearch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fmonitor_cycle_countsearch");
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
<form name="fmonitor_cycle_countsearch" id="fmonitor_cycle_countsearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="monitor_cycle_count">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->DateCreated->Visible) { // Date Created ?>
    <div id="r_DateCreated"<?= $Page->DateCreated->rowAttributes() ?>>
        <label for="x_DateCreated" class="<?= $Page->LeftColumnClass ?>"><span id="elh_monitor_cycle_count_DateCreated"><?= $Page->DateCreated->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_DateCreated" id="z_DateCreated" value="BETWEEN">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->DateCreated->cellAttributes() ?>>
            <span id="el_monitor_cycle_count_DateCreated" class="ew-search-field">
<input type="<?= $Page->DateCreated->getInputTextType() ?>" name="x_DateCreated" id="x_DateCreated" data-table="monitor_cycle_count" data-field="x_DateCreated" value="<?= $Page->DateCreated->EditValue ?>" placeholder="<?= HtmlEncode($Page->DateCreated->getPlaceHolder()) ?>"<?= $Page->DateCreated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->DateCreated->getErrorMessage(false) ?></div>
<?php if (!$Page->DateCreated->ReadOnly && !$Page->DateCreated->Disabled && !isset($Page->DateCreated->EditAttrs["readonly"]) && !isset($Page->DateCreated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmonitor_cycle_countsearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fmonitor_cycle_countsearch", "x_DateCreated", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
                <span class="ew-search-and"><label><?= $Language->phrase("AND") ?></label></span>
                <span id="el2_monitor_cycle_count_DateCreated" class="ew-search-field2">
<input type="<?= $Page->DateCreated->getInputTextType() ?>" name="y_DateCreated" id="y_DateCreated" data-table="monitor_cycle_count" data-field="x_DateCreated" value="<?= $Page->DateCreated->EditValue2 ?>" placeholder="<?= HtmlEncode($Page->DateCreated->getPlaceHolder()) ?>"<?= $Page->DateCreated->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->DateCreated->getErrorMessage(false) ?></div>
<?php if (!$Page->DateCreated->ReadOnly && !$Page->DateCreated->Disabled && !isset($Page->DateCreated->EditAttrs["readonly"]) && !isset($Page->DateCreated->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmonitor_cycle_countsearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fmonitor_cycle_countsearch", "y_DateCreated", ew.deepAssign({"useCurrent":false}, options));
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
    ew.addEventHandlers("monitor_cycle_count");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
