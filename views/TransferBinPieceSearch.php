<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$TransferBinPieceSearch = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { transfer_bin_piece: currentTable } });
var currentForm, currentPageID;
var ftransfer_bin_piecesearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    ftransfer_bin_piecesearch = new ew.Form("ftransfer_bin_piecesearch", "search");
    <?php if ($Page->IsModal) { ?>
    currentAdvancedSearchForm = ftransfer_bin_piecesearch;
    <?php } else { ?>
    currentForm = ftransfer_bin_piecesearch;
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var fields = currentTable.fields;
    ftransfer_bin_piecesearch.addFields([
        ["description", [], fields.description.isInvalid],
        ["qty", [ew.Validators.integer], fields.qty.isInvalid],
        ["actual", [ew.Validators.integer], fields.actual.isInvalid],
        ["status", [], fields.status.isInvalid],
        ["date_upload", [ew.Validators.datetime(fields.date_upload.clientFormatPattern)], fields.date_upload.isInvalid],
        ["y_date_upload", [ew.Validators.between], false],
        ["date_confirmation", [ew.Validators.datetime(fields.date_confirmation.clientFormatPattern)], fields.date_confirmation.isInvalid],
        ["y_date_confirmation", [ew.Validators.between], false],
        ["time_confirmation", [ew.Validators.time(fields.time_confirmation.clientFormatPattern)], fields.time_confirmation.isInvalid]
    ]);

    // Validate form
    ftransfer_bin_piecesearch.validate = function () {
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
    ftransfer_bin_piecesearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftransfer_bin_piecesearch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("ftransfer_bin_piecesearch");
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
<form name="ftransfer_bin_piecesearch" id="ftransfer_bin_piecesearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="transfer_bin_piece">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label for="x_description" class="<?= $Page->LeftColumnClass ?>"><span id="elh_transfer_bin_piece_description"><?= $Page->description->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_description" id="z_description" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->description->cellAttributes() ?>>
            <span id="el_transfer_bin_piece_description" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->description->getInputTextType() ?>" name="x_description" id="x_description" data-table="transfer_bin_piece" data-field="x_description" value="<?= $Page->description->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->qty->Visible) { // qty ?>
    <div id="r_qty"<?= $Page->qty->rowAttributes() ?>>
        <label for="x_qty" class="<?= $Page->LeftColumnClass ?>"><span id="elh_transfer_bin_piece_qty"><?= $Page->qty->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_qty" id="z_qty" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->qty->cellAttributes() ?>>
            <span id="el_transfer_bin_piece_qty" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->qty->getInputTextType() ?>" name="x_qty" id="x_qty" data-table="transfer_bin_piece" data-field="x_qty" value="<?= $Page->qty->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->qty->getPlaceHolder()) ?>"<?= $Page->qty->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->qty->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->actual->Visible) { // actual ?>
    <div id="r_actual"<?= $Page->actual->rowAttributes() ?>>
        <label for="x_actual" class="<?= $Page->LeftColumnClass ?>"><span id="elh_transfer_bin_piece_actual"><?= $Page->actual->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_actual" id="z_actual" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->actual->cellAttributes() ?>>
            <span id="el_transfer_bin_piece_actual" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->actual->getInputTextType() ?>" name="x_actual" id="x_actual" data-table="transfer_bin_piece" data-field="x_actual" value="<?= $Page->actual->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->actual->getPlaceHolder()) ?>"<?= $Page->actual->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->actual->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label for="x_status" class="<?= $Page->LeftColumnClass ?>"><span id="elh_transfer_bin_piece_status"><?= $Page->status->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_status" id="z_status" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->status->cellAttributes() ?>>
            <span id="el_transfer_bin_piece_status" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="transfer_bin_piece" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"<?= $Page->status->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
    <div id="r_date_upload"<?= $Page->date_upload->rowAttributes() ?>>
        <label for="x_date_upload" class="<?= $Page->LeftColumnClass ?>"><span id="elh_transfer_bin_piece_date_upload"><?= $Page->date_upload->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_date_upload" id="z_date_upload" value="BETWEEN">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->date_upload->cellAttributes() ?>>
            <span id="el_transfer_bin_piece_date_upload" class="ew-search-field">
<input type="<?= $Page->date_upload->getInputTextType() ?>" name="x_date_upload" id="x_date_upload" data-table="transfer_bin_piece" data-field="x_date_upload" value="<?= $Page->date_upload->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_upload->getPlaceHolder()) ?>"<?= $Page->date_upload->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->date_upload->getErrorMessage(false) ?></div>
<?php if (!$Page->date_upload->ReadOnly && !$Page->date_upload->Disabled && !isset($Page->date_upload->EditAttrs["readonly"]) && !isset($Page->date_upload->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftransfer_bin_piecesearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftransfer_bin_piecesearch", "x_date_upload", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
                <span class="ew-search-and"><label><?= $Language->phrase("AND") ?></label></span>
                <span id="el2_transfer_bin_piece_date_upload" class="ew-search-field2">
<input type="<?= $Page->date_upload->getInputTextType() ?>" name="y_date_upload" id="y_date_upload" data-table="transfer_bin_piece" data-field="x_date_upload" value="<?= $Page->date_upload->EditValue2 ?>" placeholder="<?= HtmlEncode($Page->date_upload->getPlaceHolder()) ?>"<?= $Page->date_upload->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->date_upload->getErrorMessage(false) ?></div>
<?php if (!$Page->date_upload->ReadOnly && !$Page->date_upload->Disabled && !isset($Page->date_upload->EditAttrs["readonly"]) && !isset($Page->date_upload->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftransfer_bin_piecesearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftransfer_bin_piecesearch", "y_date_upload", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->date_confirmation->Visible) { // date_confirmation ?>
    <div id="r_date_confirmation"<?= $Page->date_confirmation->rowAttributes() ?>>
        <label for="x_date_confirmation" class="<?= $Page->LeftColumnClass ?>"><span id="elh_transfer_bin_piece_date_confirmation"><?= $Page->date_confirmation->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_date_confirmation" id="z_date_confirmation" value="BETWEEN">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->date_confirmation->cellAttributes() ?>>
            <span id="el_transfer_bin_piece_date_confirmation" class="ew-search-field">
<input type="<?= $Page->date_confirmation->getInputTextType() ?>" name="x_date_confirmation" id="x_date_confirmation" data-table="transfer_bin_piece" data-field="x_date_confirmation" value="<?= $Page->date_confirmation->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_confirmation->getPlaceHolder()) ?>"<?= $Page->date_confirmation->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->date_confirmation->getErrorMessage(false) ?></div>
<?php if (!$Page->date_confirmation->ReadOnly && !$Page->date_confirmation->Disabled && !isset($Page->date_confirmation->EditAttrs["readonly"]) && !isset($Page->date_confirmation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftransfer_bin_piecesearch", "datetimepicker"], function () {
    let format = "<?= DateFormat(2) ?>",
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
    ew.createDateTimePicker("ftransfer_bin_piecesearch", "x_date_confirmation", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
                <span class="ew-search-and"><label><?= $Language->phrase("AND") ?></label></span>
                <span id="el2_transfer_bin_piece_date_confirmation" class="ew-search-field2">
<input type="<?= $Page->date_confirmation->getInputTextType() ?>" name="y_date_confirmation" id="y_date_confirmation" data-table="transfer_bin_piece" data-field="x_date_confirmation" value="<?= $Page->date_confirmation->EditValue2 ?>" placeholder="<?= HtmlEncode($Page->date_confirmation->getPlaceHolder()) ?>"<?= $Page->date_confirmation->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->date_confirmation->getErrorMessage(false) ?></div>
<?php if (!$Page->date_confirmation->ReadOnly && !$Page->date_confirmation->Disabled && !isset($Page->date_confirmation->EditAttrs["readonly"]) && !isset($Page->date_confirmation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftransfer_bin_piecesearch", "datetimepicker"], function () {
    let format = "<?= DateFormat(2) ?>",
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
    ew.createDateTimePicker("ftransfer_bin_piecesearch", "y_date_confirmation", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->time_confirmation->Visible) { // time_confirmation ?>
    <div id="r_time_confirmation"<?= $Page->time_confirmation->rowAttributes() ?>>
        <label for="x_time_confirmation" class="<?= $Page->LeftColumnClass ?>"><span id="elh_transfer_bin_piece_time_confirmation"><?= $Page->time_confirmation->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_time_confirmation" id="z_time_confirmation" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->time_confirmation->cellAttributes() ?>>
            <span id="el_transfer_bin_piece_time_confirmation" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->time_confirmation->getInputTextType() ?>" name="x_time_confirmation" id="x_time_confirmation" data-table="transfer_bin_piece" data-field="x_time_confirmation" value="<?= $Page->time_confirmation->EditValue ?>" placeholder="<?= HtmlEncode($Page->time_confirmation->getPlaceHolder()) ?>"<?= $Page->time_confirmation->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->time_confirmation->getErrorMessage(false) ?></div>
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
    ew.addEventHandlers("transfer_bin_piece");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
