<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$PickingAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { picking: currentTable } });
var currentForm, currentPageID;
var fpickingadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpickingadd = new ew.Form("fpickingadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fpickingadd;

    // Add fields
    var fields = currentTable.fields;
    fpickingadd.addFields([
        ["po_no", [fields.po_no.visible && fields.po_no.required ? ew.Validators.required(fields.po_no.caption) : null], fields.po_no.isInvalid],
        ["to_no", [fields.to_no.visible && fields.to_no.required ? ew.Validators.required(fields.to_no.caption) : null], fields.to_no.isInvalid],
        ["to_order_item", [fields.to_order_item.visible && fields.to_order_item.required ? ew.Validators.required(fields.to_order_item.caption) : null], fields.to_order_item.isInvalid],
        ["to_priority", [fields.to_priority.visible && fields.to_priority.required ? ew.Validators.required(fields.to_priority.caption) : null], fields.to_priority.isInvalid],
        ["to_priority_code", [fields.to_priority_code.visible && fields.to_priority_code.required ? ew.Validators.required(fields.to_priority_code.caption) : null], fields.to_priority_code.isInvalid],
        ["source_storage_type", [fields.source_storage_type.visible && fields.source_storage_type.required ? ew.Validators.required(fields.source_storage_type.caption) : null], fields.source_storage_type.isInvalid],
        ["source_storage_bin", [fields.source_storage_bin.visible && fields.source_storage_bin.required ? ew.Validators.required(fields.source_storage_bin.caption) : null], fields.source_storage_bin.isInvalid],
        ["carton_number", [fields.carton_number.visible && fields.carton_number.required ? ew.Validators.required(fields.carton_number.caption) : null], fields.carton_number.isInvalid],
        ["creation_date", [fields.creation_date.visible && fields.creation_date.required ? ew.Validators.required(fields.creation_date.caption) : null, ew.Validators.datetime(fields.creation_date.clientFormatPattern)], fields.creation_date.isInvalid],
        ["gr_number", [fields.gr_number.visible && fields.gr_number.required ? ew.Validators.required(fields.gr_number.caption) : null], fields.gr_number.isInvalid],
        ["gr_date", [fields.gr_date.visible && fields.gr_date.required ? ew.Validators.required(fields.gr_date.caption) : null, ew.Validators.datetime(fields.gr_date.clientFormatPattern)], fields.gr_date.isInvalid],
        ["delivery", [fields.delivery.visible && fields.delivery.required ? ew.Validators.required(fields.delivery.caption) : null], fields.delivery.isInvalid],
        ["store_id", [fields.store_id.visible && fields.store_id.required ? ew.Validators.required(fields.store_id.caption) : null], fields.store_id.isInvalid],
        ["store_name", [fields.store_name.visible && fields.store_name.required ? ew.Validators.required(fields.store_name.caption) : null], fields.store_name.isInvalid],
        ["article", [fields.article.visible && fields.article.required ? ew.Validators.required(fields.article.caption) : null], fields.article.isInvalid],
        ["size_code", [fields.size_code.visible && fields.size_code.required ? ew.Validators.required(fields.size_code.caption) : null], fields.size_code.isInvalid],
        ["size_desc", [fields.size_desc.visible && fields.size_desc.required ? ew.Validators.required(fields.size_desc.caption) : null], fields.size_desc.isInvalid],
        ["color_code", [fields.color_code.visible && fields.color_code.required ? ew.Validators.required(fields.color_code.caption) : null], fields.color_code.isInvalid],
        ["color_desc", [fields.color_desc.visible && fields.color_desc.required ? ew.Validators.required(fields.color_desc.caption) : null], fields.color_desc.isInvalid],
        ["concept", [fields.concept.visible && fields.concept.required ? ew.Validators.required(fields.concept.caption) : null], fields.concept.isInvalid],
        ["target_qty", [fields.target_qty.visible && fields.target_qty.required ? ew.Validators.required(fields.target_qty.caption) : null, ew.Validators.integer], fields.target_qty.isInvalid],
        ["picked_qty", [fields.picked_qty.visible && fields.picked_qty.required ? ew.Validators.required(fields.picked_qty.caption) : null, ew.Validators.integer], fields.picked_qty.isInvalid],
        ["variance_qty", [fields.variance_qty.visible && fields.variance_qty.required ? ew.Validators.required(fields.variance_qty.caption) : null, ew.Validators.integer], fields.variance_qty.isInvalid],
        ["confirmation_date", [fields.confirmation_date.visible && fields.confirmation_date.required ? ew.Validators.required(fields.confirmation_date.caption) : null, ew.Validators.datetime(fields.confirmation_date.clientFormatPattern)], fields.confirmation_date.isInvalid],
        ["confirmation_time", [fields.confirmation_time.visible && fields.confirmation_time.required ? ew.Validators.required(fields.confirmation_time.caption) : null, ew.Validators.time(fields.confirmation_time.clientFormatPattern)], fields.confirmation_time.isInvalid],
        ["box_code", [fields.box_code.visible && fields.box_code.required ? ew.Validators.required(fields.box_code.caption) : null], fields.box_code.isInvalid],
        ["box_type", [fields.box_type.visible && fields.box_type.required ? ew.Validators.required(fields.box_type.caption) : null], fields.box_type.isInvalid],
        ["picker", [fields.picker.visible && fields.picker.required ? ew.Validators.required(fields.picker.caption) : null], fields.picker.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["remarks", [fields.remarks.visible && fields.remarks.required ? ew.Validators.required(fields.remarks.caption) : null], fields.remarks.isInvalid]
    ]);

    // Form_CustomValidate
    fpickingadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpickingadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fpickingadd");
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
<form name="fpickingadd" id="fpickingadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="picking">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->po_no->Visible) { // po_no ?>
    <div id="r_po_no"<?= $Page->po_no->rowAttributes() ?>>
        <label id="elh_picking_po_no" for="x_po_no" class="<?= $Page->LeftColumnClass ?>"><?= $Page->po_no->caption() ?><?= $Page->po_no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->po_no->cellAttributes() ?>>
<span id="el_picking_po_no">
<input type="<?= $Page->po_no->getInputTextType() ?>" name="x_po_no" id="x_po_no" data-table="picking" data-field="x_po_no" value="<?= $Page->po_no->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->po_no->getPlaceHolder()) ?>"<?= $Page->po_no->editAttributes() ?> aria-describedby="x_po_no_help">
<?= $Page->po_no->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->po_no->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->to_no->Visible) { // to_no ?>
    <div id="r_to_no"<?= $Page->to_no->rowAttributes() ?>>
        <label id="elh_picking_to_no" for="x_to_no" class="<?= $Page->LeftColumnClass ?>"><?= $Page->to_no->caption() ?><?= $Page->to_no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->to_no->cellAttributes() ?>>
<span id="el_picking_to_no">
<input type="<?= $Page->to_no->getInputTextType() ?>" name="x_to_no" id="x_to_no" data-table="picking" data-field="x_to_no" value="<?= $Page->to_no->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->to_no->getPlaceHolder()) ?>"<?= $Page->to_no->editAttributes() ?> aria-describedby="x_to_no_help">
<?= $Page->to_no->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->to_no->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->to_order_item->Visible) { // to_order_item ?>
    <div id="r_to_order_item"<?= $Page->to_order_item->rowAttributes() ?>>
        <label id="elh_picking_to_order_item" for="x_to_order_item" class="<?= $Page->LeftColumnClass ?>"><?= $Page->to_order_item->caption() ?><?= $Page->to_order_item->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->to_order_item->cellAttributes() ?>>
<span id="el_picking_to_order_item">
<input type="<?= $Page->to_order_item->getInputTextType() ?>" name="x_to_order_item" id="x_to_order_item" data-table="picking" data-field="x_to_order_item" value="<?= $Page->to_order_item->EditValue ?>" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->to_order_item->getPlaceHolder()) ?>"<?= $Page->to_order_item->editAttributes() ?> aria-describedby="x_to_order_item_help">
<?= $Page->to_order_item->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->to_order_item->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->to_priority->Visible) { // to_priority ?>
    <div id="r_to_priority"<?= $Page->to_priority->rowAttributes() ?>>
        <label id="elh_picking_to_priority" for="x_to_priority" class="<?= $Page->LeftColumnClass ?>"><?= $Page->to_priority->caption() ?><?= $Page->to_priority->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->to_priority->cellAttributes() ?>>
<span id="el_picking_to_priority">
<input type="<?= $Page->to_priority->getInputTextType() ?>" name="x_to_priority" id="x_to_priority" data-table="picking" data-field="x_to_priority" value="<?= $Page->to_priority->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->to_priority->getPlaceHolder()) ?>"<?= $Page->to_priority->editAttributes() ?> aria-describedby="x_to_priority_help">
<?= $Page->to_priority->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->to_priority->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->to_priority_code->Visible) { // to_priority_code ?>
    <div id="r_to_priority_code"<?= $Page->to_priority_code->rowAttributes() ?>>
        <label id="elh_picking_to_priority_code" for="x_to_priority_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->to_priority_code->caption() ?><?= $Page->to_priority_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->to_priority_code->cellAttributes() ?>>
<span id="el_picking_to_priority_code">
<input type="<?= $Page->to_priority_code->getInputTextType() ?>" name="x_to_priority_code" id="x_to_priority_code" data-table="picking" data-field="x_to_priority_code" value="<?= $Page->to_priority_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->to_priority_code->getPlaceHolder()) ?>"<?= $Page->to_priority_code->editAttributes() ?> aria-describedby="x_to_priority_code_help">
<?= $Page->to_priority_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->to_priority_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->source_storage_type->Visible) { // source_storage_type ?>
    <div id="r_source_storage_type"<?= $Page->source_storage_type->rowAttributes() ?>>
        <label id="elh_picking_source_storage_type" for="x_source_storage_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->source_storage_type->caption() ?><?= $Page->source_storage_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->source_storage_type->cellAttributes() ?>>
<span id="el_picking_source_storage_type">
<input type="<?= $Page->source_storage_type->getInputTextType() ?>" name="x_source_storage_type" id="x_source_storage_type" data-table="picking" data-field="x_source_storage_type" value="<?= $Page->source_storage_type->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->source_storage_type->getPlaceHolder()) ?>"<?= $Page->source_storage_type->editAttributes() ?> aria-describedby="x_source_storage_type_help">
<?= $Page->source_storage_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->source_storage_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->source_storage_bin->Visible) { // source_storage_bin ?>
    <div id="r_source_storage_bin"<?= $Page->source_storage_bin->rowAttributes() ?>>
        <label id="elh_picking_source_storage_bin" for="x_source_storage_bin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->source_storage_bin->caption() ?><?= $Page->source_storage_bin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->source_storage_bin->cellAttributes() ?>>
<span id="el_picking_source_storage_bin">
<input type="<?= $Page->source_storage_bin->getInputTextType() ?>" name="x_source_storage_bin" id="x_source_storage_bin" data-table="picking" data-field="x_source_storage_bin" value="<?= $Page->source_storage_bin->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->source_storage_bin->getPlaceHolder()) ?>"<?= $Page->source_storage_bin->editAttributes() ?> aria-describedby="x_source_storage_bin_help">
<?= $Page->source_storage_bin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->source_storage_bin->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->carton_number->Visible) { // carton_number ?>
    <div id="r_carton_number"<?= $Page->carton_number->rowAttributes() ?>>
        <label id="elh_picking_carton_number" for="x_carton_number" class="<?= $Page->LeftColumnClass ?>"><?= $Page->carton_number->caption() ?><?= $Page->carton_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->carton_number->cellAttributes() ?>>
<span id="el_picking_carton_number">
<input type="<?= $Page->carton_number->getInputTextType() ?>" name="x_carton_number" id="x_carton_number" data-table="picking" data-field="x_carton_number" value="<?= $Page->carton_number->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->carton_number->getPlaceHolder()) ?>"<?= $Page->carton_number->editAttributes() ?> aria-describedby="x_carton_number_help">
<?= $Page->carton_number->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->carton_number->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->creation_date->Visible) { // creation_date ?>
    <div id="r_creation_date"<?= $Page->creation_date->rowAttributes() ?>>
        <label id="elh_picking_creation_date" for="x_creation_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->creation_date->caption() ?><?= $Page->creation_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->creation_date->cellAttributes() ?>>
<span id="el_picking_creation_date">
<input type="<?= $Page->creation_date->getInputTextType() ?>" name="x_creation_date" id="x_creation_date" data-table="picking" data-field="x_creation_date" value="<?= $Page->creation_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->creation_date->getPlaceHolder()) ?>"<?= $Page->creation_date->editAttributes() ?> aria-describedby="x_creation_date_help">
<?= $Page->creation_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->creation_date->getErrorMessage() ?></div>
<?php if (!$Page->creation_date->ReadOnly && !$Page->creation_date->Disabled && !isset($Page->creation_date->EditAttrs["readonly"]) && !isset($Page->creation_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpickingadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpickingadd", "x_creation_date", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gr_number->Visible) { // gr_number ?>
    <div id="r_gr_number"<?= $Page->gr_number->rowAttributes() ?>>
        <label id="elh_picking_gr_number" for="x_gr_number" class="<?= $Page->LeftColumnClass ?>"><?= $Page->gr_number->caption() ?><?= $Page->gr_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->gr_number->cellAttributes() ?>>
<span id="el_picking_gr_number">
<input type="<?= $Page->gr_number->getInputTextType() ?>" name="x_gr_number" id="x_gr_number" data-table="picking" data-field="x_gr_number" value="<?= $Page->gr_number->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->gr_number->getPlaceHolder()) ?>"<?= $Page->gr_number->editAttributes() ?> aria-describedby="x_gr_number_help">
<?= $Page->gr_number->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gr_number->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gr_date->Visible) { // gr_date ?>
    <div id="r_gr_date"<?= $Page->gr_date->rowAttributes() ?>>
        <label id="elh_picking_gr_date" for="x_gr_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->gr_date->caption() ?><?= $Page->gr_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->gr_date->cellAttributes() ?>>
<span id="el_picking_gr_date">
<input type="<?= $Page->gr_date->getInputTextType() ?>" name="x_gr_date" id="x_gr_date" data-table="picking" data-field="x_gr_date" value="<?= $Page->gr_date->EditValue ?>" maxlength="255" placeholder="<?= HtmlEncode($Page->gr_date->getPlaceHolder()) ?>"<?= $Page->gr_date->editAttributes() ?> aria-describedby="x_gr_date_help">
<?= $Page->gr_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gr_date->getErrorMessage() ?></div>
<?php if (!$Page->gr_date->ReadOnly && !$Page->gr_date->Disabled && !isset($Page->gr_date->EditAttrs["readonly"]) && !isset($Page->gr_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpickingadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpickingadd", "x_gr_date", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->delivery->Visible) { // delivery ?>
    <div id="r_delivery"<?= $Page->delivery->rowAttributes() ?>>
        <label id="elh_picking_delivery" for="x_delivery" class="<?= $Page->LeftColumnClass ?>"><?= $Page->delivery->caption() ?><?= $Page->delivery->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->delivery->cellAttributes() ?>>
<span id="el_picking_delivery">
<input type="<?= $Page->delivery->getInputTextType() ?>" name="x_delivery" id="x_delivery" data-table="picking" data-field="x_delivery" value="<?= $Page->delivery->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->delivery->getPlaceHolder()) ?>"<?= $Page->delivery->editAttributes() ?> aria-describedby="x_delivery_help">
<?= $Page->delivery->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->delivery->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
    <div id="r_store_id"<?= $Page->store_id->rowAttributes() ?>>
        <label id="elh_picking_store_id" for="x_store_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->store_id->caption() ?><?= $Page->store_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_id->cellAttributes() ?>>
<span id="el_picking_store_id">
<input type="<?= $Page->store_id->getInputTextType() ?>" name="x_store_id" id="x_store_id" data-table="picking" data-field="x_store_id" value="<?= $Page->store_id->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->store_id->getPlaceHolder()) ?>"<?= $Page->store_id->editAttributes() ?> aria-describedby="x_store_id_help">
<?= $Page->store_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->store_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
    <div id="r_store_name"<?= $Page->store_name->rowAttributes() ?>>
        <label id="elh_picking_store_name" for="x_store_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->store_name->caption() ?><?= $Page->store_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_name->cellAttributes() ?>>
<span id="el_picking_store_name">
<input type="<?= $Page->store_name->getInputTextType() ?>" name="x_store_name" id="x_store_name" data-table="picking" data-field="x_store_name" value="<?= $Page->store_name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->store_name->getPlaceHolder()) ?>"<?= $Page->store_name->editAttributes() ?> aria-describedby="x_store_name_help">
<?= $Page->store_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->store_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <div id="r_article"<?= $Page->article->rowAttributes() ?>>
        <label id="elh_picking_article" for="x_article" class="<?= $Page->LeftColumnClass ?>"><?= $Page->article->caption() ?><?= $Page->article->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->article->cellAttributes() ?>>
<span id="el_picking_article">
<input type="<?= $Page->article->getInputTextType() ?>" name="x_article" id="x_article" data-table="picking" data-field="x_article" value="<?= $Page->article->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->article->getPlaceHolder()) ?>"<?= $Page->article->editAttributes() ?> aria-describedby="x_article_help">
<?= $Page->article->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->article->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->size_code->Visible) { // size_code ?>
    <div id="r_size_code"<?= $Page->size_code->rowAttributes() ?>>
        <label id="elh_picking_size_code" for="x_size_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->size_code->caption() ?><?= $Page->size_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->size_code->cellAttributes() ?>>
<span id="el_picking_size_code">
<input type="<?= $Page->size_code->getInputTextType() ?>" name="x_size_code" id="x_size_code" data-table="picking" data-field="x_size_code" value="<?= $Page->size_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->size_code->getPlaceHolder()) ?>"<?= $Page->size_code->editAttributes() ?> aria-describedby="x_size_code_help">
<?= $Page->size_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->size_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
    <div id="r_size_desc"<?= $Page->size_desc->rowAttributes() ?>>
        <label id="elh_picking_size_desc" for="x_size_desc" class="<?= $Page->LeftColumnClass ?>"><?= $Page->size_desc->caption() ?><?= $Page->size_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->size_desc->cellAttributes() ?>>
<span id="el_picking_size_desc">
<input type="<?= $Page->size_desc->getInputTextType() ?>" name="x_size_desc" id="x_size_desc" data-table="picking" data-field="x_size_desc" value="<?= $Page->size_desc->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->size_desc->getPlaceHolder()) ?>"<?= $Page->size_desc->editAttributes() ?> aria-describedby="x_size_desc_help">
<?= $Page->size_desc->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->size_desc->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
    <div id="r_color_code"<?= $Page->color_code->rowAttributes() ?>>
        <label id="elh_picking_color_code" for="x_color_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->color_code->caption() ?><?= $Page->color_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->color_code->cellAttributes() ?>>
<span id="el_picking_color_code">
<input type="<?= $Page->color_code->getInputTextType() ?>" name="x_color_code" id="x_color_code" data-table="picking" data-field="x_color_code" value="<?= $Page->color_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->color_code->getPlaceHolder()) ?>"<?= $Page->color_code->editAttributes() ?> aria-describedby="x_color_code_help">
<?= $Page->color_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->color_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->color_desc->Visible) { // color_desc ?>
    <div id="r_color_desc"<?= $Page->color_desc->rowAttributes() ?>>
        <label id="elh_picking_color_desc" for="x_color_desc" class="<?= $Page->LeftColumnClass ?>"><?= $Page->color_desc->caption() ?><?= $Page->color_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->color_desc->cellAttributes() ?>>
<span id="el_picking_color_desc">
<input type="<?= $Page->color_desc->getInputTextType() ?>" name="x_color_desc" id="x_color_desc" data-table="picking" data-field="x_color_desc" value="<?= $Page->color_desc->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->color_desc->getPlaceHolder()) ?>"<?= $Page->color_desc->editAttributes() ?> aria-describedby="x_color_desc_help">
<?= $Page->color_desc->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->color_desc->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
    <div id="r_concept"<?= $Page->concept->rowAttributes() ?>>
        <label id="elh_picking_concept" for="x_concept" class="<?= $Page->LeftColumnClass ?>"><?= $Page->concept->caption() ?><?= $Page->concept->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->concept->cellAttributes() ?>>
<span id="el_picking_concept">
<input type="<?= $Page->concept->getInputTextType() ?>" name="x_concept" id="x_concept" data-table="picking" data-field="x_concept" value="<?= $Page->concept->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->concept->getPlaceHolder()) ?>"<?= $Page->concept->editAttributes() ?> aria-describedby="x_concept_help">
<?= $Page->concept->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->concept->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->target_qty->Visible) { // target_qty ?>
    <div id="r_target_qty"<?= $Page->target_qty->rowAttributes() ?>>
        <label id="elh_picking_target_qty" for="x_target_qty" class="<?= $Page->LeftColumnClass ?>"><?= $Page->target_qty->caption() ?><?= $Page->target_qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->target_qty->cellAttributes() ?>>
<span id="el_picking_target_qty">
<input type="<?= $Page->target_qty->getInputTextType() ?>" name="x_target_qty" id="x_target_qty" data-table="picking" data-field="x_target_qty" value="<?= $Page->target_qty->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->target_qty->getPlaceHolder()) ?>"<?= $Page->target_qty->editAttributes() ?> aria-describedby="x_target_qty_help">
<?= $Page->target_qty->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->target_qty->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->picked_qty->Visible) { // picked_qty ?>
    <div id="r_picked_qty"<?= $Page->picked_qty->rowAttributes() ?>>
        <label id="elh_picking_picked_qty" for="x_picked_qty" class="<?= $Page->LeftColumnClass ?>"><?= $Page->picked_qty->caption() ?><?= $Page->picked_qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->picked_qty->cellAttributes() ?>>
<span id="el_picking_picked_qty">
<input type="<?= $Page->picked_qty->getInputTextType() ?>" name="x_picked_qty" id="x_picked_qty" data-table="picking" data-field="x_picked_qty" value="<?= $Page->picked_qty->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->picked_qty->getPlaceHolder()) ?>"<?= $Page->picked_qty->editAttributes() ?> aria-describedby="x_picked_qty_help">
<?= $Page->picked_qty->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->picked_qty->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->variance_qty->Visible) { // variance_qty ?>
    <div id="r_variance_qty"<?= $Page->variance_qty->rowAttributes() ?>>
        <label id="elh_picking_variance_qty" for="x_variance_qty" class="<?= $Page->LeftColumnClass ?>"><?= $Page->variance_qty->caption() ?><?= $Page->variance_qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->variance_qty->cellAttributes() ?>>
<span id="el_picking_variance_qty">
<input type="<?= $Page->variance_qty->getInputTextType() ?>" name="x_variance_qty" id="x_variance_qty" data-table="picking" data-field="x_variance_qty" value="<?= $Page->variance_qty->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->variance_qty->getPlaceHolder()) ?>"<?= $Page->variance_qty->editAttributes() ?> aria-describedby="x_variance_qty_help">
<?= $Page->variance_qty->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->variance_qty->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->confirmation_date->Visible) { // confirmation_date ?>
    <div id="r_confirmation_date"<?= $Page->confirmation_date->rowAttributes() ?>>
        <label id="elh_picking_confirmation_date" for="x_confirmation_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->confirmation_date->caption() ?><?= $Page->confirmation_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->confirmation_date->cellAttributes() ?>>
<span id="el_picking_confirmation_date">
<input type="<?= $Page->confirmation_date->getInputTextType() ?>" name="x_confirmation_date" id="x_confirmation_date" data-table="picking" data-field="x_confirmation_date" value="<?= $Page->confirmation_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->confirmation_date->getPlaceHolder()) ?>"<?= $Page->confirmation_date->editAttributes() ?> aria-describedby="x_confirmation_date_help">
<?= $Page->confirmation_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->confirmation_date->getErrorMessage() ?></div>
<?php if (!$Page->confirmation_date->ReadOnly && !$Page->confirmation_date->Disabled && !isset($Page->confirmation_date->EditAttrs["readonly"]) && !isset($Page->confirmation_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpickingadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpickingadd", "x_confirmation_date", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->confirmation_time->Visible) { // confirmation_time ?>
    <div id="r_confirmation_time"<?= $Page->confirmation_time->rowAttributes() ?>>
        <label id="elh_picking_confirmation_time" for="x_confirmation_time" class="<?= $Page->LeftColumnClass ?>"><?= $Page->confirmation_time->caption() ?><?= $Page->confirmation_time->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->confirmation_time->cellAttributes() ?>>
<span id="el_picking_confirmation_time">
<input type="<?= $Page->confirmation_time->getInputTextType() ?>" name="x_confirmation_time" id="x_confirmation_time" data-table="picking" data-field="x_confirmation_time" value="<?= $Page->confirmation_time->EditValue ?>" placeholder="<?= HtmlEncode($Page->confirmation_time->getPlaceHolder()) ?>"<?= $Page->confirmation_time->editAttributes() ?> aria-describedby="x_confirmation_time_help">
<?= $Page->confirmation_time->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->confirmation_time->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->box_code->Visible) { // box_code ?>
    <div id="r_box_code"<?= $Page->box_code->rowAttributes() ?>>
        <label id="elh_picking_box_code" for="x_box_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->box_code->caption() ?><?= $Page->box_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->box_code->cellAttributes() ?>>
<span id="el_picking_box_code">
<input type="<?= $Page->box_code->getInputTextType() ?>" name="x_box_code" id="x_box_code" data-table="picking" data-field="x_box_code" value="<?= $Page->box_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->box_code->getPlaceHolder()) ?>"<?= $Page->box_code->editAttributes() ?> aria-describedby="x_box_code_help">
<?= $Page->box_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->box_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->box_type->Visible) { // box_type ?>
    <div id="r_box_type"<?= $Page->box_type->rowAttributes() ?>>
        <label id="elh_picking_box_type" for="x_box_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->box_type->caption() ?><?= $Page->box_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->box_type->cellAttributes() ?>>
<span id="el_picking_box_type">
<input type="<?= $Page->box_type->getInputTextType() ?>" name="x_box_type" id="x_box_type" data-table="picking" data-field="x_box_type" value="<?= $Page->box_type->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->box_type->getPlaceHolder()) ?>"<?= $Page->box_type->editAttributes() ?> aria-describedby="x_box_type_help">
<?= $Page->box_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->box_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->picker->Visible) { // picker ?>
    <div id="r_picker"<?= $Page->picker->rowAttributes() ?>>
        <label id="elh_picking_picker" for="x_picker" class="<?= $Page->LeftColumnClass ?>"><?= $Page->picker->caption() ?><?= $Page->picker->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->picker->cellAttributes() ?>>
<span id="el_picking_picker">
<input type="<?= $Page->picker->getInputTextType() ?>" name="x_picker" id="x_picker" data-table="picking" data-field="x_picker" value="<?= $Page->picker->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->picker->getPlaceHolder()) ?>"<?= $Page->picker->editAttributes() ?> aria-describedby="x_picker_help">
<?= $Page->picker->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->picker->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_picking_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_picking_status">
<input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="picking" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->remarks->Visible) { // remarks ?>
    <div id="r_remarks"<?= $Page->remarks->rowAttributes() ?>>
        <label id="elh_picking_remarks" for="x_remarks" class="<?= $Page->LeftColumnClass ?>"><?= $Page->remarks->caption() ?><?= $Page->remarks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->remarks->cellAttributes() ?>>
<span id="el_picking_remarks">
<input type="<?= $Page->remarks->getInputTextType() ?>" name="x_remarks" id="x_remarks" data-table="picking" data-field="x_remarks" value="<?= $Page->remarks->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->remarks->getPlaceHolder()) ?>"<?= $Page->remarks->editAttributes() ?> aria-describedby="x_remarks_help">
<?= $Page->remarks->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->remarks->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
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
