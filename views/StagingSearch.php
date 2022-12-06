<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$StagingSearch = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { staging: currentTable } });
var currentForm, currentPageID;
var fstagingsearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fstagingsearch = new ew.Form("fstagingsearch", "search");
    <?php if ($Page->IsModal) { ?>
    currentAdvancedSearchForm = fstagingsearch;
    <?php } else { ?>
    currentForm = fstagingsearch;
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var fields = currentTable.fields;
    fstagingsearch.addFields([
        ["picking_date", [ew.Validators.datetime(fields.picking_date.clientFormatPattern)], fields.picking_date.isInvalid],
        ["y_picking_date", [ew.Validators.between], false],
        ["line", [], fields.line.isInvalid]
    ]);

    // Validate form
    fstagingsearch.validate = function () {
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
    fstagingsearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fstagingsearch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fstagingsearch");
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
<form name="fstagingsearch" id="fstagingsearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="staging">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->picking_date->Visible) { // picking_date ?>
    <div id="r_picking_date"<?= $Page->picking_date->rowAttributes() ?>>
        <label for="x_picking_date" class="<?= $Page->LeftColumnClass ?>"><span id="elh_staging_picking_date"><?= $Page->picking_date->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_picking_date" id="z_picking_date" value="BETWEEN">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->picking_date->cellAttributes() ?>>
            <span id="el_staging_picking_date" class="ew-search-field">
<input type="<?= $Page->picking_date->getInputTextType() ?>" name="x_picking_date" id="x_picking_date" data-table="staging" data-field="x_picking_date" value="<?= $Page->picking_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->picking_date->getPlaceHolder()) ?>"<?= $Page->picking_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->picking_date->getErrorMessage(false) ?></div>
<?php if (!$Page->picking_date->ReadOnly && !$Page->picking_date->Disabled && !isset($Page->picking_date->EditAttrs["readonly"]) && !isset($Page->picking_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstagingsearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fstagingsearch", "x_picking_date", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
                <span class="ew-search-and"><label><?= $Language->phrase("AND") ?></label></span>
                <span id="el2_staging_picking_date" class="ew-search-field2">
<input type="<?= $Page->picking_date->getInputTextType() ?>" name="y_picking_date" id="y_picking_date" data-table="staging" data-field="x_picking_date" value="<?= $Page->picking_date->EditValue2 ?>" placeholder="<?= HtmlEncode($Page->picking_date->getPlaceHolder()) ?>"<?= $Page->picking_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->picking_date->getErrorMessage(false) ?></div>
<?php if (!$Page->picking_date->ReadOnly && !$Page->picking_date->Disabled && !isset($Page->picking_date->EditAttrs["readonly"]) && !isset($Page->picking_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstagingsearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fstagingsearch", "y_picking_date", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->line->Visible) { // line ?>
    <div id="r_line"<?= $Page->line->rowAttributes() ?>>
        <label for="x_line" class="<?= $Page->LeftColumnClass ?>"><span id="elh_staging_line"><?= $Page->line->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_line" id="z_line" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->line->cellAttributes() ?>>
            <span id="el_staging_line" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->line->getInputTextType() ?>" name="x_line" id="x_line" data-table="staging" data-field="x_line" value="<?= $Page->line->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->line->getPlaceHolder()) ?>"<?= $Page->line->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->line->getErrorMessage(false) ?></div>
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
    ew.addEventHandlers("staging");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
