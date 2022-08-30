<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$FindingShortpick2Search = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { finding_shortpick2: currentTable } });
var currentForm, currentPageID;
var ffinding_shortpick2search, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    ffinding_shortpick2search = new ew.Form("ffinding_shortpick2search", "search");
    <?php if ($Page->IsModal) { ?>
    currentAdvancedSearchForm = ffinding_shortpick2search;
    <?php } else { ?>
    currentForm = ffinding_shortpick2search;
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var fields = currentTable.fields;
    ffinding_shortpick2search.addFields([
        ["avaiable", [ew.Validators.integer], fields.avaiable.isInvalid],
        ["web", [ew.Validators.integer], fields.web.isInvalid],
        ["date_shortpick", [ew.Validators.datetime(fields.date_shortpick.clientFormatPattern)], fields.date_shortpick.isInvalid],
        ["date_upload", [ew.Validators.datetime(fields.date_upload.clientFormatPattern)], fields.date_upload.isInvalid],
        ["y_date_upload", [ew.Validators.between], false],
        ["date_picking", [ew.Validators.datetime(fields.date_picking.clientFormatPattern)], fields.date_picking.isInvalid],
        ["y_date_picking", [ew.Validators.between], false]
    ]);

    // Validate form
    ffinding_shortpick2search.validate = function () {
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
    ffinding_shortpick2search.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ffinding_shortpick2search.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("ffinding_shortpick2search");
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
<form name="ffinding_shortpick2search" id="ffinding_shortpick2search" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="finding_shortpick2">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->avaiable->Visible) { // avaiable ?>
    <div id="r_avaiable"<?= $Page->avaiable->rowAttributes() ?>>
        <label for="x_avaiable" class="<?= $Page->LeftColumnClass ?>"><span id="elh_finding_shortpick2_avaiable"><?= $Page->avaiable->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_avaiable" id="z_avaiable" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->avaiable->cellAttributes() ?>>
            <span id="el_finding_shortpick2_avaiable" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->avaiable->getInputTextType() ?>" name="x_avaiable" id="x_avaiable" data-table="finding_shortpick2" data-field="x_avaiable" value="<?= $Page->avaiable->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->avaiable->getPlaceHolder()) ?>"<?= $Page->avaiable->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->avaiable->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->web->Visible) { // web ?>
    <div id="r_web"<?= $Page->web->rowAttributes() ?>>
        <label for="x_web" class="<?= $Page->LeftColumnClass ?>"><span id="elh_finding_shortpick2_web"><?= $Page->web->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_web" id="z_web" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->web->cellAttributes() ?>>
            <span id="el_finding_shortpick2_web" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->web->getInputTextType() ?>" name="x_web" id="x_web" data-table="finding_shortpick2" data-field="x_web" value="<?= $Page->web->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->web->getPlaceHolder()) ?>"<?= $Page->web->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->web->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->date_shortpick->Visible) { // date_shortpick ?>
    <div id="r_date_shortpick"<?= $Page->date_shortpick->rowAttributes() ?>>
        <label for="x_date_shortpick" class="<?= $Page->LeftColumnClass ?>"><span id="elh_finding_shortpick2_date_shortpick"><?= $Page->date_shortpick->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_date_shortpick" id="z_date_shortpick" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->date_shortpick->cellAttributes() ?>>
            <span id="el_finding_shortpick2_date_shortpick" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->date_shortpick->getInputTextType() ?>" name="x_date_shortpick" id="x_date_shortpick" data-table="finding_shortpick2" data-field="x_date_shortpick" value="<?= $Page->date_shortpick->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_shortpick->getPlaceHolder()) ?>"<?= $Page->date_shortpick->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->date_shortpick->getErrorMessage(false) ?></div>
<?php if (!$Page->date_shortpick->ReadOnly && !$Page->date_shortpick->Disabled && !isset($Page->date_shortpick->EditAttrs["readonly"]) && !isset($Page->date_shortpick->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffinding_shortpick2search", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ffinding_shortpick2search", "x_date_shortpick", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
    <div id="r_date_upload"<?= $Page->date_upload->rowAttributes() ?>>
        <label for="x_date_upload" class="<?= $Page->LeftColumnClass ?>"><span id="elh_finding_shortpick2_date_upload"><?= $Page->date_upload->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_date_upload" id="z_date_upload" value="BETWEEN">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->date_upload->cellAttributes() ?>>
            <span id="el_finding_shortpick2_date_upload" class="ew-search-field">
<input type="<?= $Page->date_upload->getInputTextType() ?>" name="x_date_upload" id="x_date_upload" data-table="finding_shortpick2" data-field="x_date_upload" value="<?= $Page->date_upload->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_upload->getPlaceHolder()) ?>"<?= $Page->date_upload->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->date_upload->getErrorMessage(false) ?></div>
<?php if (!$Page->date_upload->ReadOnly && !$Page->date_upload->Disabled && !isset($Page->date_upload->EditAttrs["readonly"]) && !isset($Page->date_upload->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffinding_shortpick2search", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ffinding_shortpick2search", "x_date_upload", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
                <span class="ew-search-and"><label><?= $Language->phrase("AND") ?></label></span>
                <span id="el2_finding_shortpick2_date_upload" class="ew-search-field2">
<input type="<?= $Page->date_upload->getInputTextType() ?>" name="y_date_upload" id="y_date_upload" data-table="finding_shortpick2" data-field="x_date_upload" value="<?= $Page->date_upload->EditValue2 ?>" placeholder="<?= HtmlEncode($Page->date_upload->getPlaceHolder()) ?>"<?= $Page->date_upload->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->date_upload->getErrorMessage(false) ?></div>
<?php if (!$Page->date_upload->ReadOnly && !$Page->date_upload->Disabled && !isset($Page->date_upload->EditAttrs["readonly"]) && !isset($Page->date_upload->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffinding_shortpick2search", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ffinding_shortpick2search", "y_date_upload", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->date_picking->Visible) { // date_picking ?>
    <div id="r_date_picking"<?= $Page->date_picking->rowAttributes() ?>>
        <label for="x_date_picking" class="<?= $Page->LeftColumnClass ?>"><span id="elh_finding_shortpick2_date_picking"><?= $Page->date_picking->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_date_picking" id="z_date_picking" value="BETWEEN">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->date_picking->cellAttributes() ?>>
            <span id="el_finding_shortpick2_date_picking" class="ew-search-field">
<input type="<?= $Page->date_picking->getInputTextType() ?>" name="x_date_picking" id="x_date_picking" data-table="finding_shortpick2" data-field="x_date_picking" value="<?= $Page->date_picking->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_picking->getPlaceHolder()) ?>"<?= $Page->date_picking->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->date_picking->getErrorMessage(false) ?></div>
<?php if (!$Page->date_picking->ReadOnly && !$Page->date_picking->Disabled && !isset($Page->date_picking->EditAttrs["readonly"]) && !isset($Page->date_picking->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffinding_shortpick2search", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ffinding_shortpick2search", "x_date_picking", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
                <span class="ew-search-and"><label><?= $Language->phrase("AND") ?></label></span>
                <span id="el2_finding_shortpick2_date_picking" class="ew-search-field2">
<input type="<?= $Page->date_picking->getInputTextType() ?>" name="y_date_picking" id="y_date_picking" data-table="finding_shortpick2" data-field="x_date_picking" value="<?= $Page->date_picking->EditValue2 ?>" placeholder="<?= HtmlEncode($Page->date_picking->getPlaceHolder()) ?>"<?= $Page->date_picking->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->date_picking->getErrorMessage(false) ?></div>
<?php if (!$Page->date_picking->ReadOnly && !$Page->date_picking->Disabled && !isset($Page->date_picking->EditAttrs["readonly"]) && !isset($Page->date_picking->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffinding_shortpick2search", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ffinding_shortpick2search", "y_date_picking", ew.deepAssign({"useCurrent":false}, options));
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
    ew.addEventHandlers("finding_shortpick2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
