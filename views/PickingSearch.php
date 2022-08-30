<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$PickingSearch = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { picking: currentTable } });
var currentForm, currentPageID;
var fpickingsearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fpickingsearch = new ew.Form("fpickingsearch", "search");
    <?php if ($Page->IsModal) { ?>
    currentAdvancedSearchForm = fpickingsearch;
    <?php } else { ?>
    currentForm = fpickingsearch;
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var fields = currentTable.fields;
    fpickingsearch.addFields([
        ["creation_date", [ew.Validators.datetime(fields.creation_date.clientFormatPattern)], fields.creation_date.isInvalid],
        ["y_creation_date", [ew.Validators.between], false],
        ["confirmation_date", [ew.Validators.datetime(fields.confirmation_date.clientFormatPattern)], fields.confirmation_date.isInvalid],
        ["y_confirmation_date", [ew.Validators.between], false]
    ]);

    // Validate form
    fpickingsearch.validate = function () {
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
    fpickingsearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpickingsearch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fpickingsearch");
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
<form name="fpickingsearch" id="fpickingsearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="picking">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->creation_date->Visible) { // creation_date ?>
    <div id="r_creation_date"<?= $Page->creation_date->rowAttributes() ?>>
        <label for="x_creation_date" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_creation_date"><?= $Page->creation_date->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_creation_date" id="z_creation_date" value="BETWEEN">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->creation_date->cellAttributes() ?>>
            <span id="el_picking_creation_date" class="ew-search-field">
<input type="<?= $Page->creation_date->getInputTextType() ?>" name="x_creation_date" id="x_creation_date" data-table="picking" data-field="x_creation_date" value="<?= $Page->creation_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->creation_date->getPlaceHolder()) ?>"<?= $Page->creation_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->creation_date->getErrorMessage(false) ?></div>
<?php if (!$Page->creation_date->ReadOnly && !$Page->creation_date->Disabled && !isset($Page->creation_date->EditAttrs["readonly"]) && !isset($Page->creation_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpickingsearch", "datetimepicker"], function () {
    let format = "<?= "ddMMyyyy" ?>",
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
    ew.createDateTimePicker("fpickingsearch", "x_creation_date", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
                <span class="ew-search-and"><label><?= $Language->phrase("AND") ?></label></span>
                <span id="el2_picking_creation_date" class="ew-search-field2">
<input type="<?= $Page->creation_date->getInputTextType() ?>" name="y_creation_date" id="y_creation_date" data-table="picking" data-field="x_creation_date" value="<?= $Page->creation_date->EditValue2 ?>" placeholder="<?= HtmlEncode($Page->creation_date->getPlaceHolder()) ?>"<?= $Page->creation_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->creation_date->getErrorMessage(false) ?></div>
<?php if (!$Page->creation_date->ReadOnly && !$Page->creation_date->Disabled && !isset($Page->creation_date->EditAttrs["readonly"]) && !isset($Page->creation_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpickingsearch", "datetimepicker"], function () {
    let format = "<?= "ddMMyyyy" ?>",
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
    ew.createDateTimePicker("fpickingsearch", "y_creation_date", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->confirmation_date->Visible) { // confirmation_date ?>
    <div id="r_confirmation_date"<?= $Page->confirmation_date->rowAttributes() ?>>
        <label for="x_confirmation_date" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_confirmation_date"><?= $Page->confirmation_date->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_confirmation_date" id="z_confirmation_date" value="BETWEEN">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->confirmation_date->cellAttributes() ?>>
            <span id="el_picking_confirmation_date" class="ew-search-field">
<input type="<?= $Page->confirmation_date->getInputTextType() ?>" name="x_confirmation_date" id="x_confirmation_date" data-table="picking" data-field="x_confirmation_date" value="<?= $Page->confirmation_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->confirmation_date->getPlaceHolder()) ?>"<?= $Page->confirmation_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->confirmation_date->getErrorMessage(false) ?></div>
<?php if (!$Page->confirmation_date->ReadOnly && !$Page->confirmation_date->Disabled && !isset($Page->confirmation_date->EditAttrs["readonly"]) && !isset($Page->confirmation_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpickingsearch", "datetimepicker"], function () {
    let format = "<?= "ddMMyyyy" ?>",
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
    ew.createDateTimePicker("fpickingsearch", "x_confirmation_date", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
                <span class="ew-search-and"><label><?= $Language->phrase("AND") ?></label></span>
                <span id="el2_picking_confirmation_date" class="ew-search-field2">
<input type="<?= $Page->confirmation_date->getInputTextType() ?>" name="y_confirmation_date" id="y_confirmation_date" data-table="picking" data-field="x_confirmation_date" value="<?= $Page->confirmation_date->EditValue2 ?>" placeholder="<?= HtmlEncode($Page->confirmation_date->getPlaceHolder()) ?>"<?= $Page->confirmation_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->confirmation_date->getErrorMessage(false) ?></div>
<?php if (!$Page->confirmation_date->ReadOnly && !$Page->confirmation_date->Disabled && !isset($Page->confirmation_date->EditAttrs["readonly"]) && !isset($Page->confirmation_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpickingsearch", "datetimepicker"], function () {
    let format = "<?= "ddMMyyyy" ?>",
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
    ew.createDateTimePicker("fpickingsearch", "y_confirmation_date", ew.deepAssign({"useCurrent":false}, options));
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
    ew.addEventHandlers("picking");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
