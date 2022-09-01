<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$PickingPendingSearch = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { picking_pending: currentTable } });
var currentForm, currentPageID;
var fpicking_pendingsearch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fpicking_pendingsearch = new ew.Form("fpicking_pendingsearch", "search");
    <?php if ($Page->IsModal) { ?>
    currentAdvancedSearchForm = fpicking_pendingsearch;
    <?php } else { ?>
    currentForm = fpicking_pendingsearch;
    <?php } ?>
    currentPageID = ew.PAGE_ID = "search";

    // Add fields
    var fields = currentTable.fields;
    fpicking_pendingsearch.addFields([
        ["id", [ew.Validators.integer], fields.id.isInvalid],
        ["po_no", [], fields.po_no.isInvalid],
        ["to_no", [], fields.to_no.isInvalid],
        ["to_order_item", [], fields.to_order_item.isInvalid],
        ["to_priority", [], fields.to_priority.isInvalid],
        ["to_priority_code", [], fields.to_priority_code.isInvalid],
        ["source_storage_type", [], fields.source_storage_type.isInvalid],
        ["source_storage_bin", [], fields.source_storage_bin.isInvalid],
        ["carton_number", [], fields.carton_number.isInvalid],
        ["creation_date", [ew.Validators.datetime(fields.creation_date.clientFormatPattern)], fields.creation_date.isInvalid],
        ["gr_number", [], fields.gr_number.isInvalid],
        ["gr_date", [ew.Validators.datetime(fields.gr_date.clientFormatPattern)], fields.gr_date.isInvalid],
        ["delivery", [], fields.delivery.isInvalid],
        ["store_id", [], fields.store_id.isInvalid],
        ["store_name", [], fields.store_name.isInvalid],
        ["article", [], fields.article.isInvalid],
        ["size_code", [], fields.size_code.isInvalid],
        ["size_desc", [], fields.size_desc.isInvalid],
        ["color_code", [], fields.color_code.isInvalid],
        ["color_desc", [], fields.color_desc.isInvalid],
        ["concept", [], fields.concept.isInvalid],
        ["target_qty", [ew.Validators.integer], fields.target_qty.isInvalid],
        ["picked_qty", [ew.Validators.integer], fields.picked_qty.isInvalid],
        ["variance_qty", [ew.Validators.integer], fields.variance_qty.isInvalid],
        ["confirmation_date", [ew.Validators.datetime(fields.confirmation_date.clientFormatPattern)], fields.confirmation_date.isInvalid],
        ["confirmation_time", [ew.Validators.time(fields.confirmation_time.clientFormatPattern)], fields.confirmation_time.isInvalid],
        ["box_code", [], fields.box_code.isInvalid],
        ["box_type", [], fields.box_type.isInvalid],
        ["picker", [], fields.picker.isInvalid],
        ["status", [], fields.status.isInvalid],
        ["remarks", [], fields.remarks.isInvalid],
        ["aisle", [], fields.aisle.isInvalid],
        ["area", [], fields.area.isInvalid],
        ["aisle2", [], fields.aisle2.isInvalid],
        ["store_id2", [], fields.store_id2.isInvalid],
        ["scan_article", [], fields.scan_article.isInvalid],
        ["close_totes", [], fields.close_totes.isInvalid],
        ["job_id", [], fields.job_id.isInvalid]
    ]);

    // Validate form
    fpicking_pendingsearch.validate = function () {
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
    fpicking_pendingsearch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpicking_pendingsearch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fpicking_pendingsearch.lists.box_type = <?= $Page->box_type->toClientList($Page) ?>;
    loadjs.done("fpicking_pendingsearch");
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
<form name="fpicking_pendingsearch" id="fpicking_pendingsearch" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="picking_pending">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label for="x_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_id"><?= $Page->id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->id->cellAttributes() ?>>
            <span id="el_picking_pending_id" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->id->getInputTextType() ?>" name="x_id" id="x_id" data-table="picking_pending" data-field="x_id" value="<?= $Page->id->EditValue ?>" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>"<?= $Page->id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->po_no->Visible) { // po_no ?>
    <div id="r_po_no"<?= $Page->po_no->rowAttributes() ?>>
        <label for="x_po_no" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_po_no"><?= $Page->po_no->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_po_no" id="z_po_no" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->po_no->cellAttributes() ?>>
            <span id="el_picking_pending_po_no" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->po_no->getInputTextType() ?>" name="x_po_no" id="x_po_no" data-table="picking_pending" data-field="x_po_no" value="<?= $Page->po_no->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->po_no->getPlaceHolder()) ?>"<?= $Page->po_no->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->po_no->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->to_no->Visible) { // to_no ?>
    <div id="r_to_no"<?= $Page->to_no->rowAttributes() ?>>
        <label for="x_to_no" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_to_no"><?= $Page->to_no->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_to_no" id="z_to_no" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->to_no->cellAttributes() ?>>
            <span id="el_picking_pending_to_no" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->to_no->getInputTextType() ?>" name="x_to_no" id="x_to_no" data-table="picking_pending" data-field="x_to_no" value="<?= $Page->to_no->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->to_no->getPlaceHolder()) ?>"<?= $Page->to_no->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->to_no->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->to_order_item->Visible) { // to_order_item ?>
    <div id="r_to_order_item"<?= $Page->to_order_item->rowAttributes() ?>>
        <label for="x_to_order_item" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_to_order_item"><?= $Page->to_order_item->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_to_order_item" id="z_to_order_item" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->to_order_item->cellAttributes() ?>>
            <span id="el_picking_pending_to_order_item" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->to_order_item->getInputTextType() ?>" name="x_to_order_item" id="x_to_order_item" data-table="picking_pending" data-field="x_to_order_item" value="<?= $Page->to_order_item->EditValue ?>" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->to_order_item->getPlaceHolder()) ?>"<?= $Page->to_order_item->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->to_order_item->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->to_priority->Visible) { // to_priority ?>
    <div id="r_to_priority"<?= $Page->to_priority->rowAttributes() ?>>
        <label for="x_to_priority" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_to_priority"><?= $Page->to_priority->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_to_priority" id="z_to_priority" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->to_priority->cellAttributes() ?>>
            <span id="el_picking_pending_to_priority" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->to_priority->getInputTextType() ?>" name="x_to_priority" id="x_to_priority" data-table="picking_pending" data-field="x_to_priority" value="<?= $Page->to_priority->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->to_priority->getPlaceHolder()) ?>"<?= $Page->to_priority->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->to_priority->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->to_priority_code->Visible) { // to_priority_code ?>
    <div id="r_to_priority_code"<?= $Page->to_priority_code->rowAttributes() ?>>
        <label for="x_to_priority_code" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_to_priority_code"><?= $Page->to_priority_code->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_to_priority_code" id="z_to_priority_code" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->to_priority_code->cellAttributes() ?>>
            <span id="el_picking_pending_to_priority_code" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->to_priority_code->getInputTextType() ?>" name="x_to_priority_code" id="x_to_priority_code" data-table="picking_pending" data-field="x_to_priority_code" value="<?= $Page->to_priority_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->to_priority_code->getPlaceHolder()) ?>"<?= $Page->to_priority_code->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->to_priority_code->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->source_storage_type->Visible) { // source_storage_type ?>
    <div id="r_source_storage_type"<?= $Page->source_storage_type->rowAttributes() ?>>
        <label for="x_source_storage_type" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_source_storage_type"><?= $Page->source_storage_type->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_source_storage_type" id="z_source_storage_type" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->source_storage_type->cellAttributes() ?>>
            <span id="el_picking_pending_source_storage_type" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->source_storage_type->getInputTextType() ?>" name="x_source_storage_type" id="x_source_storage_type" data-table="picking_pending" data-field="x_source_storage_type" value="<?= $Page->source_storage_type->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->source_storage_type->getPlaceHolder()) ?>"<?= $Page->source_storage_type->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->source_storage_type->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->source_storage_bin->Visible) { // source_storage_bin ?>
    <div id="r_source_storage_bin"<?= $Page->source_storage_bin->rowAttributes() ?>>
        <label for="x_source_storage_bin" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_source_storage_bin"><?= $Page->source_storage_bin->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_source_storage_bin" id="z_source_storage_bin" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->source_storage_bin->cellAttributes() ?>>
            <span id="el_picking_pending_source_storage_bin" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->source_storage_bin->getInputTextType() ?>" name="x_source_storage_bin" id="x_source_storage_bin" data-table="picking_pending" data-field="x_source_storage_bin" value="<?= $Page->source_storage_bin->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->source_storage_bin->getPlaceHolder()) ?>"<?= $Page->source_storage_bin->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->source_storage_bin->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->carton_number->Visible) { // carton_number ?>
    <div id="r_carton_number"<?= $Page->carton_number->rowAttributes() ?>>
        <label for="x_carton_number" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_carton_number"><?= $Page->carton_number->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_carton_number" id="z_carton_number" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->carton_number->cellAttributes() ?>>
            <span id="el_picking_pending_carton_number" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->carton_number->getInputTextType() ?>" name="x_carton_number" id="x_carton_number" data-table="picking_pending" data-field="x_carton_number" value="<?= $Page->carton_number->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->carton_number->getPlaceHolder()) ?>"<?= $Page->carton_number->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->carton_number->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->creation_date->Visible) { // creation_date ?>
    <div id="r_creation_date"<?= $Page->creation_date->rowAttributes() ?>>
        <label for="x_creation_date" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_creation_date"><?= $Page->creation_date->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_creation_date" id="z_creation_date" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->creation_date->cellAttributes() ?>>
            <span id="el_picking_pending_creation_date" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->creation_date->getInputTextType() ?>" name="x_creation_date" id="x_creation_date" data-table="picking_pending" data-field="x_creation_date" value="<?= $Page->creation_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->creation_date->getPlaceHolder()) ?>"<?= $Page->creation_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->creation_date->getErrorMessage(false) ?></div>
<?php if (!$Page->creation_date->ReadOnly && !$Page->creation_date->Disabled && !isset($Page->creation_date->EditAttrs["readonly"]) && !isset($Page->creation_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpicking_pendingsearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpicking_pendingsearch", "x_creation_date", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->gr_number->Visible) { // gr_number ?>
    <div id="r_gr_number"<?= $Page->gr_number->rowAttributes() ?>>
        <label for="x_gr_number" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_gr_number"><?= $Page->gr_number->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_gr_number" id="z_gr_number" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->gr_number->cellAttributes() ?>>
            <span id="el_picking_pending_gr_number" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->gr_number->getInputTextType() ?>" name="x_gr_number" id="x_gr_number" data-table="picking_pending" data-field="x_gr_number" value="<?= $Page->gr_number->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->gr_number->getPlaceHolder()) ?>"<?= $Page->gr_number->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->gr_number->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->gr_date->Visible) { // gr_date ?>
    <div id="r_gr_date"<?= $Page->gr_date->rowAttributes() ?>>
        <label for="x_gr_date" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_gr_date"><?= $Page->gr_date->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_gr_date" id="z_gr_date" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->gr_date->cellAttributes() ?>>
            <span id="el_picking_pending_gr_date" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->gr_date->getInputTextType() ?>" name="x_gr_date" id="x_gr_date" data-table="picking_pending" data-field="x_gr_date" value="<?= $Page->gr_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->gr_date->getPlaceHolder()) ?>"<?= $Page->gr_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->gr_date->getErrorMessage(false) ?></div>
<?php if (!$Page->gr_date->ReadOnly && !$Page->gr_date->Disabled && !isset($Page->gr_date->EditAttrs["readonly"]) && !isset($Page->gr_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpicking_pendingsearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpicking_pendingsearch", "x_gr_date", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->delivery->Visible) { // delivery ?>
    <div id="r_delivery"<?= $Page->delivery->rowAttributes() ?>>
        <label for="x_delivery" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_delivery"><?= $Page->delivery->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_delivery" id="z_delivery" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->delivery->cellAttributes() ?>>
            <span id="el_picking_pending_delivery" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->delivery->getInputTextType() ?>" name="x_delivery" id="x_delivery" data-table="picking_pending" data-field="x_delivery" value="<?= $Page->delivery->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->delivery->getPlaceHolder()) ?>"<?= $Page->delivery->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->delivery->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
    <div id="r_store_id"<?= $Page->store_id->rowAttributes() ?>>
        <label for="x_store_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_store_id"><?= $Page->store_id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_store_id" id="z_store_id" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->store_id->cellAttributes() ?>>
            <span id="el_picking_pending_store_id" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->store_id->getInputTextType() ?>" name="x_store_id" id="x_store_id" data-table="picking_pending" data-field="x_store_id" value="<?= $Page->store_id->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->store_id->getPlaceHolder()) ?>"<?= $Page->store_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->store_id->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
    <div id="r_store_name"<?= $Page->store_name->rowAttributes() ?>>
        <label for="x_store_name" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_store_name"><?= $Page->store_name->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_store_name" id="z_store_name" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->store_name->cellAttributes() ?>>
            <span id="el_picking_pending_store_name" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->store_name->getInputTextType() ?>" name="x_store_name" id="x_store_name" data-table="picking_pending" data-field="x_store_name" value="<?= $Page->store_name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->store_name->getPlaceHolder()) ?>"<?= $Page->store_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->store_name->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <div id="r_article"<?= $Page->article->rowAttributes() ?>>
        <label for="x_article" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_article"><?= $Page->article->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_article" id="z_article" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->article->cellAttributes() ?>>
            <span id="el_picking_pending_article" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->article->getInputTextType() ?>" name="x_article" id="x_article" data-table="picking_pending" data-field="x_article" value="<?= $Page->article->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->article->getPlaceHolder()) ?>"<?= $Page->article->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->article->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->size_code->Visible) { // size_code ?>
    <div id="r_size_code"<?= $Page->size_code->rowAttributes() ?>>
        <label for="x_size_code" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_size_code"><?= $Page->size_code->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_size_code" id="z_size_code" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->size_code->cellAttributes() ?>>
            <span id="el_picking_pending_size_code" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->size_code->getInputTextType() ?>" name="x_size_code" id="x_size_code" data-table="picking_pending" data-field="x_size_code" value="<?= $Page->size_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->size_code->getPlaceHolder()) ?>"<?= $Page->size_code->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->size_code->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
    <div id="r_size_desc"<?= $Page->size_desc->rowAttributes() ?>>
        <label for="x_size_desc" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_size_desc"><?= $Page->size_desc->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_size_desc" id="z_size_desc" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->size_desc->cellAttributes() ?>>
            <span id="el_picking_pending_size_desc" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->size_desc->getInputTextType() ?>" name="x_size_desc" id="x_size_desc" data-table="picking_pending" data-field="x_size_desc" value="<?= $Page->size_desc->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->size_desc->getPlaceHolder()) ?>"<?= $Page->size_desc->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->size_desc->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
    <div id="r_color_code"<?= $Page->color_code->rowAttributes() ?>>
        <label for="x_color_code" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_color_code"><?= $Page->color_code->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_color_code" id="z_color_code" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->color_code->cellAttributes() ?>>
            <span id="el_picking_pending_color_code" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->color_code->getInputTextType() ?>" name="x_color_code" id="x_color_code" data-table="picking_pending" data-field="x_color_code" value="<?= $Page->color_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->color_code->getPlaceHolder()) ?>"<?= $Page->color_code->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->color_code->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->color_desc->Visible) { // color_desc ?>
    <div id="r_color_desc"<?= $Page->color_desc->rowAttributes() ?>>
        <label for="x_color_desc" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_color_desc"><?= $Page->color_desc->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_color_desc" id="z_color_desc" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->color_desc->cellAttributes() ?>>
            <span id="el_picking_pending_color_desc" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->color_desc->getInputTextType() ?>" name="x_color_desc" id="x_color_desc" data-table="picking_pending" data-field="x_color_desc" value="<?= $Page->color_desc->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->color_desc->getPlaceHolder()) ?>"<?= $Page->color_desc->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->color_desc->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
    <div id="r_concept"<?= $Page->concept->rowAttributes() ?>>
        <label for="x_concept" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_concept"><?= $Page->concept->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_concept" id="z_concept" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->concept->cellAttributes() ?>>
            <span id="el_picking_pending_concept" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->concept->getInputTextType() ?>" name="x_concept" id="x_concept" data-table="picking_pending" data-field="x_concept" value="<?= $Page->concept->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->concept->getPlaceHolder()) ?>"<?= $Page->concept->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->concept->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->target_qty->Visible) { // target_qty ?>
    <div id="r_target_qty"<?= $Page->target_qty->rowAttributes() ?>>
        <label for="x_target_qty" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_target_qty"><?= $Page->target_qty->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_target_qty" id="z_target_qty" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->target_qty->cellAttributes() ?>>
            <span id="el_picking_pending_target_qty" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->target_qty->getInputTextType() ?>" name="x_target_qty" id="x_target_qty" data-table="picking_pending" data-field="x_target_qty" value="<?= $Page->target_qty->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->target_qty->getPlaceHolder()) ?>"<?= $Page->target_qty->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->target_qty->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->picked_qty->Visible) { // picked_qty ?>
    <div id="r_picked_qty"<?= $Page->picked_qty->rowAttributes() ?>>
        <label for="x_picked_qty" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_picked_qty"><?= $Page->picked_qty->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_picked_qty" id="z_picked_qty" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->picked_qty->cellAttributes() ?>>
            <span id="el_picking_pending_picked_qty" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->picked_qty->getInputTextType() ?>" name="x_picked_qty" id="x_picked_qty" data-table="picking_pending" data-field="x_picked_qty" value="<?= $Page->picked_qty->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->picked_qty->getPlaceHolder()) ?>"<?= $Page->picked_qty->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->picked_qty->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->variance_qty->Visible) { // variance_qty ?>
    <div id="r_variance_qty"<?= $Page->variance_qty->rowAttributes() ?>>
        <label for="x_variance_qty" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_variance_qty"><?= $Page->variance_qty->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_variance_qty" id="z_variance_qty" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->variance_qty->cellAttributes() ?>>
            <span id="el_picking_pending_variance_qty" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->variance_qty->getInputTextType() ?>" name="x_variance_qty" id="x_variance_qty" data-table="picking_pending" data-field="x_variance_qty" value="<?= $Page->variance_qty->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->variance_qty->getPlaceHolder()) ?>"<?= $Page->variance_qty->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->variance_qty->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->confirmation_date->Visible) { // confirmation_date ?>
    <div id="r_confirmation_date"<?= $Page->confirmation_date->rowAttributes() ?>>
        <label for="x_confirmation_date" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_confirmation_date"><?= $Page->confirmation_date->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_confirmation_date" id="z_confirmation_date" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->confirmation_date->cellAttributes() ?>>
            <span id="el_picking_pending_confirmation_date" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->confirmation_date->getInputTextType() ?>" name="x_confirmation_date" id="x_confirmation_date" data-table="picking_pending" data-field="x_confirmation_date" value="<?= $Page->confirmation_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->confirmation_date->getPlaceHolder()) ?>"<?= $Page->confirmation_date->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->confirmation_date->getErrorMessage(false) ?></div>
<?php if (!$Page->confirmation_date->ReadOnly && !$Page->confirmation_date->Disabled && !isset($Page->confirmation_date->EditAttrs["readonly"]) && !isset($Page->confirmation_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpicking_pendingsearch", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpicking_pendingsearch", "x_confirmation_date", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->confirmation_time->Visible) { // confirmation_time ?>
    <div id="r_confirmation_time"<?= $Page->confirmation_time->rowAttributes() ?>>
        <label for="x_confirmation_time" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_confirmation_time"><?= $Page->confirmation_time->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("=") ?>
<input type="hidden" name="z_confirmation_time" id="z_confirmation_time" value="=">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->confirmation_time->cellAttributes() ?>>
            <span id="el_picking_pending_confirmation_time" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->confirmation_time->getInputTextType() ?>" name="x_confirmation_time" id="x_confirmation_time" data-table="picking_pending" data-field="x_confirmation_time" value="<?= $Page->confirmation_time->EditValue ?>" placeholder="<?= HtmlEncode($Page->confirmation_time->getPlaceHolder()) ?>"<?= $Page->confirmation_time->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->confirmation_time->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->box_code->Visible) { // box_code ?>
    <div id="r_box_code"<?= $Page->box_code->rowAttributes() ?>>
        <label for="x_box_code" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_box_code"><?= $Page->box_code->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_box_code" id="z_box_code" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->box_code->cellAttributes() ?>>
            <span id="el_picking_pending_box_code" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->box_code->getInputTextType() ?>" name="x_box_code" id="x_box_code" data-table="picking_pending" data-field="x_box_code" value="<?= $Page->box_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->box_code->getPlaceHolder()) ?>"<?= $Page->box_code->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->box_code->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->box_type->Visible) { // box_type ?>
    <div id="r_box_type"<?= $Page->box_type->rowAttributes() ?>>
        <label class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_box_type"><?= $Page->box_type->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_box_type" id="z_box_type" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->box_type->cellAttributes() ?>>
            <span id="el_picking_pending_box_type" class="ew-search-field ew-search-field-single">
<template id="tp_x_box_type">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="picking_pending" data-field="x_box_type" name="x_box_type" id="x_box_type"<?= $Page->box_type->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_box_type" class="ew-item-list"></div>
<selection-list hidden
    id="x_box_type"
    name="x_box_type"
    value="<?= HtmlEncode($Page->box_type->AdvancedSearch->SearchValue) ?>"
    data-type="select-one"
    data-template="tp_x_box_type"
    data-bs-target="dsl_x_box_type"
    data-repeatcolumn="5"
    class="form-control<?= $Page->box_type->isInvalidClass() ?>"
    data-table="picking_pending"
    data-field="x_box_type"
    data-value-separator="<?= $Page->box_type->displayValueSeparatorAttribute() ?>"
    <?= $Page->box_type->editAttributes() ?>></selection-list>
<div class="invalid-feedback"><?= $Page->box_type->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->picker->Visible) { // picker ?>
    <div id="r_picker"<?= $Page->picker->rowAttributes() ?>>
        <label for="x_picker" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_picker"><?= $Page->picker->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_picker" id="z_picker" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->picker->cellAttributes() ?>>
            <span id="el_picking_pending_picker" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->picker->getInputTextType() ?>" name="x_picker" id="x_picker" data-table="picking_pending" data-field="x_picker" value="<?= $Page->picker->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->picker->getPlaceHolder()) ?>"<?= $Page->picker->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->picker->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label for="x_status" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_status"><?= $Page->status->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_status" id="z_status" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->status->cellAttributes() ?>>
            <span id="el_picking_pending_status" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="picking_pending" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"<?= $Page->status->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->remarks->Visible) { // remarks ?>
    <div id="r_remarks"<?= $Page->remarks->rowAttributes() ?>>
        <label for="x_remarks" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_remarks"><?= $Page->remarks->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_remarks" id="z_remarks" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->remarks->cellAttributes() ?>>
            <span id="el_picking_pending_remarks" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->remarks->getInputTextType() ?>" name="x_remarks" id="x_remarks" data-table="picking_pending" data-field="x_remarks" value="<?= $Page->remarks->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->remarks->getPlaceHolder()) ?>"<?= $Page->remarks->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->remarks->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->aisle->Visible) { // aisle ?>
    <div id="r_aisle"<?= $Page->aisle->rowAttributes() ?>>
        <label for="x_aisle" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_aisle"><?= $Page->aisle->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_aisle" id="z_aisle" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->aisle->cellAttributes() ?>>
            <span id="el_picking_pending_aisle" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->aisle->getInputTextType() ?>" name="x_aisle" id="x_aisle" data-table="picking_pending" data-field="x_aisle" value="<?= $Page->aisle->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->aisle->getPlaceHolder()) ?>"<?= $Page->aisle->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->aisle->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->area->Visible) { // area ?>
    <div id="r_area"<?= $Page->area->rowAttributes() ?>>
        <label for="x_area" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_area"><?= $Page->area->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_area" id="z_area" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->area->cellAttributes() ?>>
            <span id="el_picking_pending_area" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->area->getInputTextType() ?>" name="x_area" id="x_area" data-table="picking_pending" data-field="x_area" value="<?= $Page->area->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->area->getPlaceHolder()) ?>"<?= $Page->area->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->area->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->aisle2->Visible) { // aisle2 ?>
    <div id="r_aisle2"<?= $Page->aisle2->rowAttributes() ?>>
        <label for="x_aisle2" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_aisle2"><?= $Page->aisle2->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_aisle2" id="z_aisle2" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->aisle2->cellAttributes() ?>>
            <span id="el_picking_pending_aisle2" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->aisle2->getInputTextType() ?>" name="x_aisle2" id="x_aisle2" data-table="picking_pending" data-field="x_aisle2" value="<?= $Page->aisle2->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->aisle2->getPlaceHolder()) ?>"<?= $Page->aisle2->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->aisle2->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->store_id2->Visible) { // store_id2 ?>
    <div id="r_store_id2"<?= $Page->store_id2->rowAttributes() ?>>
        <label for="x_store_id2" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_store_id2"><?= $Page->store_id2->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_store_id2" id="z_store_id2" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->store_id2->cellAttributes() ?>>
            <span id="el_picking_pending_store_id2" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->store_id2->getInputTextType() ?>" name="x_store_id2" id="x_store_id2" data-table="picking_pending" data-field="x_store_id2" value="<?= $Page->store_id2->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->store_id2->getPlaceHolder()) ?>"<?= $Page->store_id2->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->store_id2->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->scan_article->Visible) { // scan_article ?>
    <div id="r_scan_article"<?= $Page->scan_article->rowAttributes() ?>>
        <label for="x_scan_article" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_scan_article"><?= $Page->scan_article->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_scan_article" id="z_scan_article" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->scan_article->cellAttributes() ?>>
            <span id="el_picking_pending_scan_article" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->scan_article->getInputTextType() ?>" name="x_scan_article" id="x_scan_article" data-table="picking_pending" data-field="x_scan_article" value="<?= $Page->scan_article->EditValue ?>" placeholder="<?= HtmlEncode($Page->scan_article->getPlaceHolder()) ?>"<?= $Page->scan_article->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->scan_article->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->close_totes->Visible) { // close_totes ?>
    <div id="r_close_totes"<?= $Page->close_totes->rowAttributes() ?>>
        <label for="x_close_totes" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_close_totes"><?= $Page->close_totes->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_close_totes" id="z_close_totes" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->close_totes->cellAttributes() ?>>
            <span id="el_picking_pending_close_totes" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->close_totes->getInputTextType() ?>" name="x_close_totes" id="x_close_totes" data-table="picking_pending" data-field="x_close_totes" value="<?= $Page->close_totes->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->close_totes->getPlaceHolder()) ?>"<?= $Page->close_totes->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->close_totes->getErrorMessage(false) ?></div>
</span>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($Page->job_id->Visible) { // job_id ?>
    <div id="r_job_id"<?= $Page->job_id->rowAttributes() ?>>
        <label for="x_job_id" class="<?= $Page->LeftColumnClass ?>"><span id="elh_picking_pending_job_id"><?= $Page->job_id->caption() ?></span>
        <span class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_job_id" id="z_job_id" value="LIKE">
</span>
        </label>
        <div class="<?= $Page->RightColumnClass ?>">
            <div<?= $Page->job_id->cellAttributes() ?>>
            <span id="el_picking_pending_job_id" class="ew-search-field ew-search-field-single">
<input type="<?= $Page->job_id->getInputTextType() ?>" name="x_job_id" id="x_job_id" data-table="picking_pending" data-field="x_job_id" value="<?= $Page->job_id->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->job_id->getPlaceHolder()) ?>"<?= $Page->job_id->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->job_id->getErrorMessage(false) ?></div>
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
    ew.addEventHandlers("picking_pending");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
