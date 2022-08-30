<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$CycleCountSearch = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { cycle_count: currentTable } });
var currentForm, currentPageID;
var fcycle_countsearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fcycle_countsearch = new ew.Form("fcycle_countsearch", "search");
    <?php if ($Page->IsModal) { ?>
    currentAdvancedSearchForm = fcycle_countsearch;
    <?php } else { ?>
    currentForm = fcycle_countsearch;
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var fields = currentTable.fields;
    fcycle_countsearch.addFields([
        ["location", [], fields.location.isInvalid],
        ["date_created", [ew.Validators.datetime(fields.date_created.clientFormatPattern)], fields.date_created.isInvalid],
        ["y_date_created", [ew.Validators.between], false],
        ["divisi", [], fields.divisi.isInvalid]
    ]);

    // Validate form
    fcycle_countsearch.validate = function () {
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
    fcycle_countsearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcycle_countsearch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fcycle_countsearch");
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
<form name="fcycle_countsearch" id="fcycle_countsearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="cycle_count">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->location->Visible) { // location ?>
    <div id="r_location"<?= $Page->location->rowAttributes() ?>>
        <label for="x_location" class="<?= $Page->LeftColumnClass ?>"><span id="elh_cycle_count_location"><?= $Page->location->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_location" id="z_location" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->location->cellAttributes() ?>>
            <span id="el_cycle_count_location" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->location->getInputTextType() ?>" name="x_location" id="x_location" data-table="cycle_count" data-field="x_location" value="<?= $Page->location->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->location->getPlaceHolder()) ?>"<?= $Page->location->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->location->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->date_created->Visible) { // date_created ?>
    <div id="r_date_created"<?= $Page->date_created->rowAttributes() ?>>
        <label for="x_date_created" class="<?= $Page->LeftColumnClass ?>"><span id="elh_cycle_count_date_created"><?= $Page->date_created->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_date_created" id="z_date_created" value="BETWEEN">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->date_created->cellAttributes() ?>>
            <span id="el_cycle_count_date_created" class="ew-search-field">
<input type="<?= $Page->date_created->getInputTextType() ?>" name="x_date_created" id="x_date_created" data-table="cycle_count" data-field="x_date_created" value="<?= $Page->date_created->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_created->getPlaceHolder()) ?>"<?= $Page->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->date_created->getErrorMessage(false) ?></div>
<?php if (!$Page->date_created->ReadOnly && !$Page->date_created->Disabled && !isset($Page->date_created->EditAttrs["readonly"]) && !isset($Page->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcycle_countsearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fcycle_countsearch", "x_date_created", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
                <span class="ew-search-and"><label><?= $Language->phrase("AND") ?></label></span>
                <span id="el2_cycle_count_date_created" class="ew-search-field2">
<input type="<?= $Page->date_created->getInputTextType() ?>" name="y_date_created" id="y_date_created" data-table="cycle_count" data-field="x_date_created" value="<?= $Page->date_created->EditValue2 ?>" placeholder="<?= HtmlEncode($Page->date_created->getPlaceHolder()) ?>"<?= $Page->date_created->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->date_created->getErrorMessage(false) ?></div>
<?php if (!$Page->date_created->ReadOnly && !$Page->date_created->Disabled && !isset($Page->date_created->EditAttrs["readonly"]) && !isset($Page->date_created->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcycle_countsearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fcycle_countsearch", "y_date_created", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->divisi->Visible) { // divisi ?>
    <div id="r_divisi"<?= $Page->divisi->rowAttributes() ?>>
        <label for="x_divisi" class="<?= $Page->LeftColumnClass ?>"><span id="elh_cycle_count_divisi"><?= $Page->divisi->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_divisi" id="z_divisi" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->divisi->cellAttributes() ?>>
            <span id="el_cycle_count_divisi" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->divisi->getInputTextType() ?>" name="x_divisi" id="x_divisi" data-table="cycle_count" data-field="x_divisi" value="<?= $Page->divisi->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->divisi->getPlaceHolder()) ?>"<?= $Page->divisi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->divisi->getErrorMessage(false) ?></div>
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
    ew.addEventHandlers("cycle_count");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
