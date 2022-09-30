<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$StockCountSearch = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { stock_count: currentTable } });
var currentForm, currentPageID;
var fstock_countsearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fstock_countsearch = new ew.Form("fstock_countsearch", "search");
    <?php if ($Page->IsModal) { ?>
    currentAdvancedSearchForm = fstock_countsearch;
    <?php } else { ?>
    currentForm = fstock_countsearch;
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var fields = currentTable.fields;
    fstock_countsearch.addFields([
        ["location", [], fields.location.isInvalid],
        ["date_created", [ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
        ["y_date_created", [ew.Validators.between], false],
        ["time_created", [ew.Validators.time(fields.time_created.clientFormatPattern)], fields.time_created.isInvalid],
        ["get_total", [], fields.get_total.isInvalid]
    ]);

    // Validate form
    fstock_countsearch.validate = function () {
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
    fstock_countsearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fstock_countsearch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fstock_countsearch");
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
<form name="fstock_countsearch" id="fstock_countsearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="stock_count">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->location->Visible) { // location ?>
    <div id="r_location"<?= $Page->location->rowAttributes() ?>>
        <label for="x_location" class="<?= $Page->LeftColumnClass ?>"><span id="elh_stock_count_location"><?= $Page->location->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_location" id="z_location" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->location->cellAttributes() ?>>
            <span id="el_stock_count_location" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->location->getInputTextType() ?>" name="x_location" id="x_location" data-table="stock_count" data-field="x_location" value="<?= $Page->location->EditValue ?>" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->location->getPlaceHolder()) ?>"<?= $Page->location->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->location->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <div id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <label for="x_date_created" class="<?= $Page->LeftColumnClass ?>"><span id="elh_stock_count_date_created"><?= $Page->date_created->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_date_created" id="z_date_created" value="BETWEEN">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->date_created->cellAttributes() ?>>
            <span id="el_stock_count_date_created" class="ew-search-field">
<input type="<?= $Page->date_created->getInputTextType() ?>" name="x_date_created" id="x_date_created" data-table="stock_count" data-field="x_date_created" value="<?= $Page->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_created->getPlaceHolder()) ?>"<?= $Page->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->date_created->getErrorMessage(false) ?></div>
<?php if (!$Page->date_created->ReadOnly && !$Page->date_created->Disabled && !isset($Page->date_created->EditAttrs["readonly"]) && !isset($Page->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstock_countsearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fstock_countsearch", "x_date_created", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
                <span class="ew-search-and"><label><?= $Language->phrase("AND") ?></label></span>
                <span id="el2_stock_count_date_created" class="ew-search-field2">
<input type="<?= $Page->date_created->getInputTextType() ?>" name="y_date_created" id="y_date_created" data-table="stock_count" data-field="x_date_created" value="<?= $Page->date_created->EditValue2 ?>" placeholder="<?= HtmlEncode($Page->date_created->getPlaceHolder()) ?>"<?= $Page->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->date_created->getErrorMessage(false) ?></div>
<?php if (!$Page->date_created->ReadOnly && !$Page->date_created->Disabled && !isset($Page->date_created->EditAttrs["readonly"]) && !isset($Page->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstock_countsearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fstock_countsearch", "y_date_created", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->time_created->Visible) { // time_created ?>
    <div id="r_time_created"<?= $Page->time_created->rowAttributes() ?>>
        <label for="x_time_created" class="<?= $Page->LeftColumnClass ?>"><span id="elh_stock_count_time_created"><?= $Page->time_created->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_time_created" id="z_time_created" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->time_created->cellAttributes() ?>>
            <span id="el_stock_count_time_created" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->time_created->getInputTextType() ?>" name="x_time_created" id="x_time_created" data-table="stock_count" data-field="x_time_created" value="<?= $Page->time_created->EditValue ?>" placeholder="<?= HtmlEncode($Page->time_created->getPlaceHolder()) ?>"<?= $Page->time_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->time_created->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->get_total->Visible) { // get_total ?>
    <div id="r_get_total"<?= $Page->get_total->rowAttributes() ?>>
        <label for="x_get_total" class="<?= $Page->LeftColumnClass ?>"><span id="elh_stock_count_get_total"><?= $Page->get_total->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_get_total" id="z_get_total" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->get_total->cellAttributes() ?>>
            <span id="el_stock_count_get_total" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->get_total->getInputTextType() ?>" name="x_get_total" id="x_get_total" data-table="stock_count" data-field="x_get_total" value="<?= $Page->get_total->EditValue ?>" placeholder="<?= HtmlEncode($Page->get_total->getPlaceHolder()) ?>"<?= $Page->get_total->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->get_total->getErrorMessage(false) ?></div>
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
    ew.addEventHandlers("stock_count");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
