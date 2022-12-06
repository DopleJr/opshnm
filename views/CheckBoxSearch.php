<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$CheckBoxSearch = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { check_box: currentTable } });
var currentForm, currentPageID;
var fcheck_boxsearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fcheck_boxsearch = new ew.Form("fcheck_boxsearch", "search");
    <?php if ($Page->IsModal) { ?>
    currentAdvancedSearchForm = fcheck_boxsearch;
    <?php } else { ?>
    currentForm = fcheck_boxsearch;
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var fields = currentTable.fields;
    fcheck_boxsearch.addFields([
        ["box_code", [], fields.box_code.isInvalid],
        ["store_id", [], fields.store_id.isInvalid],
        ["concept", [], fields.concept.isInvalid],
        ["article", [], fields.article.isInvalid],
        ["confirmation_date", [ew.Validators.datetime(fields.confirmation_date.clientFormatPattern)], fields.confirmation_date.isInvalid],
        ["y_confirmation_date", [ew.Validators.between], false],
        ["picker", [], fields.picker.isInvalid]
    ]);

    // Validate form
    fcheck_boxsearch.validate = function () {
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
    fcheck_boxsearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fcheck_boxsearch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fcheck_boxsearch");
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
<form name="fcheck_boxsearch" id="fcheck_boxsearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="check_box">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->box_code->Visible) { // box_code ?>
    <div id="r_box_code"<?= $Page->box_code->rowAttributes() ?>>
        <label for="x_box_code" class="<?= $Page->LeftColumnClass ?>"><span id="elh_check_box_box_code"><?= $Page->box_code->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_box_code" id="z_box_code" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->box_code->cellAttributes() ?>>
            <span id="el_check_box_box_code" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->box_code->getInputTextType() ?>" name="x_box_code" id="x_box_code" data-table="check_box" data-field="x_box_code" value="<?= $Page->box_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->box_code->getPlaceHolder()) ?>"<?= $Page->box_code->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->box_code->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
    <div id="r_store_id"<?= $Page->store_id->rowAttributes() ?>>
        <label for="x_store_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_check_box_store_id"><?= $Page->store_id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_store_id" id="z_store_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->store_id->cellAttributes() ?>>
            <span id="el_check_box_store_id" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->store_id->getInputTextType() ?>" name="x_store_id" id="x_store_id" data-table="check_box" data-field="x_store_id" value="<?= $Page->store_id->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->store_id->getPlaceHolder()) ?>"<?= $Page->store_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->store_id->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
    <div id="r_concept"<?= $Page->concept->rowAttributes() ?>>
        <label for="x_concept" class="<?= $Page->LeftColumnClass ?>"><span id="elh_check_box_concept"><?= $Page->concept->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_concept" id="z_concept" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->concept->cellAttributes() ?>>
            <span id="el_check_box_concept" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->concept->getInputTextType() ?>" name="x_concept" id="x_concept" data-table="check_box" data-field="x_concept" value="<?= $Page->concept->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->concept->getPlaceHolder()) ?>"<?= $Page->concept->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->concept->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <div id="r_article"<?= $Page->article->rowAttributes() ?>>
        <label for="x_article" class="<?= $Page->LeftColumnClass ?>"><span id="elh_check_box_article"><?= $Page->article->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_article" id="z_article" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->article->cellAttributes() ?>>
            <span id="el_check_box_article" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->article->getInputTextType() ?>" name="x_article" id="x_article" data-table="check_box" data-field="x_article" value="<?= $Page->article->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->article->getPlaceHolder()) ?>"<?= $Page->article->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->article->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->confirmation_date->Visible) { // confirmation_date ?>
    <div id="r_confirmation_date"<?= $Page->confirmation_date->rowAttributes() ?>>
        <label for="x_confirmation_date" class="<?= $Page->LeftColumnClass ?>"><span id="elh_check_box_confirmation_date"><?= $Page->confirmation_date->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_confirmation_date" id="z_confirmation_date" value="BETWEEN">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->confirmation_date->cellAttributes() ?>>
            <span id="el_check_box_confirmation_date" class="ew-search-field">
<input type="<?= $Page->confirmation_date->getInputTextType() ?>" name="x_confirmation_date" id="x_confirmation_date" data-table="check_box" data-field="x_confirmation_date" value="<?= $Page->confirmation_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->confirmation_date->getPlaceHolder()) ?>"<?= $Page->confirmation_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->confirmation_date->getErrorMessage(false) ?></div>
<?php if (!$Page->confirmation_date->ReadOnly && !$Page->confirmation_date->Disabled && !isset($Page->confirmation_date->EditAttrs["readonly"]) && !isset($Page->confirmation_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcheck_boxsearch", "datetimepicker"], function () {
    let format = "<?= "yyyyMMdd" ?>",
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
    ew.createDateTimePicker("fcheck_boxsearch", "x_confirmation_date", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
                <span class="ew-search-and"><label><?= $Language->phrase("AND") ?></label></span>
                <span id="el2_check_box_confirmation_date" class="ew-search-field2">
<input type="<?= $Page->confirmation_date->getInputTextType() ?>" name="y_confirmation_date" id="y_confirmation_date" data-table="check_box" data-field="x_confirmation_date" value="<?= $Page->confirmation_date->EditValue2 ?>" placeholder="<?= HtmlEncode($Page->confirmation_date->getPlaceHolder()) ?>"<?= $Page->confirmation_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->confirmation_date->getErrorMessage(false) ?></div>
<?php if (!$Page->confirmation_date->ReadOnly && !$Page->confirmation_date->Disabled && !isset($Page->confirmation_date->EditAttrs["readonly"]) && !isset($Page->confirmation_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcheck_boxsearch", "datetimepicker"], function () {
    let format = "<?= "yyyyMMdd" ?>",
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
    ew.createDateTimePicker("fcheck_boxsearch", "y_confirmation_date", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->picker->Visible) { // picker ?>
    <div id="r_picker"<?= $Page->picker->rowAttributes() ?>>
        <label for="x_picker" class="<?= $Page->LeftColumnClass ?>"><span id="elh_check_box_picker"><?= $Page->picker->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_picker" id="z_picker" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->picker->cellAttributes() ?>>
            <span id="el_check_box_picker" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->picker->getInputTextType() ?>" name="x_picker" id="x_picker" data-table="check_box" data-field="x_picker" value="<?= $Page->picker->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->picker->getPlaceHolder()) ?>"<?= $Page->picker->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->picker->getErrorMessage(false) ?></div>
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
    ew.addEventHandlers("check_box");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
