<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$PickingPendingEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { picking_pending: currentTable } });
var currentForm, currentPageID;
var fpicking_pendingedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpicking_pendingedit = new ew.Form("fpicking_pendingedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fpicking_pendingedit;

    // Add fields
    var fields = currentTable.fields;
    fpicking_pendingedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
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
        ["target_qty", [fields.target_qty.visible && fields.target_qty.required ? ew.Validators.required(fields.target_qty.caption) : null], fields.target_qty.isInvalid],
        ["picked_qty", [fields.picked_qty.visible && fields.picked_qty.required ? ew.Validators.required(fields.picked_qty.caption) : null, ew.Validators.integer], fields.picked_qty.isInvalid],
        ["variance_qty", [fields.variance_qty.visible && fields.variance_qty.required ? ew.Validators.required(fields.variance_qty.caption) : null, ew.Validators.integer], fields.variance_qty.isInvalid],
        ["confirmation_date", [fields.confirmation_date.visible && fields.confirmation_date.required ? ew.Validators.required(fields.confirmation_date.caption) : null, ew.Validators.datetime(fields.confirmation_date.clientFormatPattern)], fields.confirmation_date.isInvalid],
        ["confirmation_time", [fields.confirmation_time.visible && fields.confirmation_time.required ? ew.Validators.required(fields.confirmation_time.caption) : null, ew.Validators.time(fields.confirmation_time.clientFormatPattern)], fields.confirmation_time.isInvalid],
        ["box_code", [fields.box_code.visible && fields.box_code.required ? ew.Validators.required(fields.box_code.caption) : null], fields.box_code.isInvalid],
        ["box_type", [fields.box_type.visible && fields.box_type.required ? ew.Validators.required(fields.box_type.caption) : null], fields.box_type.isInvalid],
        ["picker", [fields.picker.visible && fields.picker.required ? ew.Validators.required(fields.picker.caption) : null], fields.picker.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["remarks", [fields.remarks.visible && fields.remarks.required ? ew.Validators.required(fields.remarks.caption) : null], fields.remarks.isInvalid],
        ["aisle", [fields.aisle.visible && fields.aisle.required ? ew.Validators.required(fields.aisle.caption) : null], fields.aisle.isInvalid],
        ["area", [fields.area.visible && fields.area.required ? ew.Validators.required(fields.area.caption) : null], fields.area.isInvalid],
        ["aisle2", [fields.aisle2.visible && fields.aisle2.required ? ew.Validators.required(fields.aisle2.caption) : null], fields.aisle2.isInvalid],
        ["store_id2", [fields.store_id2.visible && fields.store_id2.required ? ew.Validators.required(fields.store_id2.caption) : null], fields.store_id2.isInvalid],
        ["scan_article", [fields.scan_article.visible && fields.scan_article.required ? ew.Validators.required(fields.scan_article.caption) : null], fields.scan_article.isInvalid],
        ["close_totes", [fields.close_totes.visible && fields.close_totes.required ? ew.Validators.required(fields.close_totes.caption) : null], fields.close_totes.isInvalid],
        ["job_id", [fields.job_id.visible && fields.job_id.required ? ew.Validators.required(fields.job_id.caption) : null], fields.job_id.isInvalid]
    ]);

    // Form_CustomValidate
    fpicking_pendingedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpicking_pendingedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fpicking_pendingedit.lists.box_type = <?= $Page->box_type->toClientList($Page) ?>;
    loadjs.done("fpicking_pendingedit");
});
</script>
<script>
loadjs.ready("head", function () {
    // Client script
    // Write your table-specific client script here, no need to add script tags.
    $(document).ready(function() {
    $(".input-group").hide();
    $(".text-muted").hide();
    $(".ew-breadcrumbs").hide();// atribut text
    });
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if (!$Page->IsModal) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<form name="fpicking_pendingedit" id="fpicking_pendingedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="picking_pending">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div d-none"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_picking_pending_id" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_id"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<template id="tpx_picking_pending_id"><span id="el_picking_pending_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="picking_pending" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->po_no->Visible) { // po_no ?>
    <div id="r_po_no"<?= $Page->po_no->rowAttributes() ?>>
        <label id="elh_picking_pending_po_no" for="x_po_no" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_po_no"><?= $Page->po_no->caption() ?><?= $Page->po_no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->po_no->cellAttributes() ?>>
<template id="tpx_picking_pending_po_no"><span id="el_picking_pending_po_no">
<input type="<?= $Page->po_no->getInputTextType() ?>" name="x_po_no" id="x_po_no" data-table="picking_pending" data-field="x_po_no" value="<?= $Page->po_no->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->po_no->getPlaceHolder()) ?>"<?= $Page->po_no->editAttributes() ?> aria-describedby="x_po_no_help">
<?= $Page->po_no->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->po_no->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->to_no->Visible) { // to_no ?>
    <div id="r_to_no"<?= $Page->to_no->rowAttributes() ?>>
        <label id="elh_picking_pending_to_no" for="x_to_no" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_to_no"><?= $Page->to_no->caption() ?><?= $Page->to_no->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->to_no->cellAttributes() ?>>
<template id="tpx_picking_pending_to_no"><span id="el_picking_pending_to_no">
<input type="<?= $Page->to_no->getInputTextType() ?>" name="x_to_no" id="x_to_no" data-table="picking_pending" data-field="x_to_no" value="<?= $Page->to_no->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->to_no->getPlaceHolder()) ?>"<?= $Page->to_no->editAttributes() ?> aria-describedby="x_to_no_help">
<?= $Page->to_no->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->to_no->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->to_order_item->Visible) { // to_order_item ?>
    <div id="r_to_order_item"<?= $Page->to_order_item->rowAttributes() ?>>
        <label id="elh_picking_pending_to_order_item" for="x_to_order_item" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_to_order_item"><?= $Page->to_order_item->caption() ?><?= $Page->to_order_item->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->to_order_item->cellAttributes() ?>>
<template id="tpx_picking_pending_to_order_item"><span id="el_picking_pending_to_order_item">
<input type="<?= $Page->to_order_item->getInputTextType() ?>" name="x_to_order_item" id="x_to_order_item" data-table="picking_pending" data-field="x_to_order_item" value="<?= $Page->to_order_item->EditValue ?>" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->to_order_item->getPlaceHolder()) ?>"<?= $Page->to_order_item->editAttributes() ?> aria-describedby="x_to_order_item_help">
<?= $Page->to_order_item->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->to_order_item->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->to_priority->Visible) { // to_priority ?>
    <div id="r_to_priority"<?= $Page->to_priority->rowAttributes() ?>>
        <label id="elh_picking_pending_to_priority" for="x_to_priority" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_to_priority"><?= $Page->to_priority->caption() ?><?= $Page->to_priority->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->to_priority->cellAttributes() ?>>
<template id="tpx_picking_pending_to_priority"><span id="el_picking_pending_to_priority">
<input type="<?= $Page->to_priority->getInputTextType() ?>" name="x_to_priority" id="x_to_priority" data-table="picking_pending" data-field="x_to_priority" value="<?= $Page->to_priority->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->to_priority->getPlaceHolder()) ?>"<?= $Page->to_priority->editAttributes() ?> aria-describedby="x_to_priority_help">
<?= $Page->to_priority->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->to_priority->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->to_priority_code->Visible) { // to_priority_code ?>
    <div id="r_to_priority_code"<?= $Page->to_priority_code->rowAttributes() ?>>
        <label id="elh_picking_pending_to_priority_code" for="x_to_priority_code" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_to_priority_code"><?= $Page->to_priority_code->caption() ?><?= $Page->to_priority_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->to_priority_code->cellAttributes() ?>>
<template id="tpx_picking_pending_to_priority_code"><span id="el_picking_pending_to_priority_code">
<input type="<?= $Page->to_priority_code->getInputTextType() ?>" name="x_to_priority_code" id="x_to_priority_code" data-table="picking_pending" data-field="x_to_priority_code" value="<?= $Page->to_priority_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->to_priority_code->getPlaceHolder()) ?>"<?= $Page->to_priority_code->editAttributes() ?> aria-describedby="x_to_priority_code_help">
<?= $Page->to_priority_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->to_priority_code->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->source_storage_type->Visible) { // source_storage_type ?>
    <div id="r_source_storage_type"<?= $Page->source_storage_type->rowAttributes() ?>>
        <label id="elh_picking_pending_source_storage_type" for="x_source_storage_type" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_source_storage_type"><?= $Page->source_storage_type->caption() ?><?= $Page->source_storage_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->source_storage_type->cellAttributes() ?>>
<template id="tpx_picking_pending_source_storage_type"><span id="el_picking_pending_source_storage_type">
<input type="<?= $Page->source_storage_type->getInputTextType() ?>" name="x_source_storage_type" id="x_source_storage_type" data-table="picking_pending" data-field="x_source_storage_type" value="<?= $Page->source_storage_type->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->source_storage_type->getPlaceHolder()) ?>"<?= $Page->source_storage_type->editAttributes() ?> aria-describedby="x_source_storage_type_help">
<?= $Page->source_storage_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->source_storage_type->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->source_storage_bin->Visible) { // source_storage_bin ?>
    <div id="r_source_storage_bin"<?= $Page->source_storage_bin->rowAttributes() ?>>
        <label id="elh_picking_pending_source_storage_bin" for="x_source_storage_bin" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_source_storage_bin"><?= $Page->source_storage_bin->caption() ?><?= $Page->source_storage_bin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->source_storage_bin->cellAttributes() ?>>
<template id="tpx_picking_pending_source_storage_bin"><span id="el_picking_pending_source_storage_bin">
<span<?= $Page->source_storage_bin->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->source_storage_bin->getDisplayValue($Page->source_storage_bin->EditValue))) ?>"></span>
<input type="hidden" data-table="picking_pending" data-field="x_source_storage_bin" data-hidden="1" name="x_source_storage_bin" id="x_source_storage_bin" value="<?= HtmlEncode($Page->source_storage_bin->CurrentValue) ?>">
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->carton_number->Visible) { // carton_number ?>
    <div id="r_carton_number"<?= $Page->carton_number->rowAttributes() ?>>
        <label id="elh_picking_pending_carton_number" for="x_carton_number" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_carton_number"><?= $Page->carton_number->caption() ?><?= $Page->carton_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->carton_number->cellAttributes() ?>>
<template id="tpx_picking_pending_carton_number"><span id="el_picking_pending_carton_number">
<span<?= $Page->carton_number->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->carton_number->getDisplayValue($Page->carton_number->EditValue))) ?>"></span>
<input type="hidden" data-table="picking_pending" data-field="x_carton_number" data-hidden="1" name="x_carton_number" id="x_carton_number" value="<?= HtmlEncode($Page->carton_number->CurrentValue) ?>">
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->creation_date->Visible) { // creation_date ?>
    <div id="r_creation_date"<?= $Page->creation_date->rowAttributes() ?>>
        <label id="elh_picking_pending_creation_date" for="x_creation_date" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_creation_date"><?= $Page->creation_date->caption() ?><?= $Page->creation_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->creation_date->cellAttributes() ?>>
<template id="tpx_picking_pending_creation_date"><span id="el_picking_pending_creation_date">
<input type="<?= $Page->creation_date->getInputTextType() ?>" name="x_creation_date" id="x_creation_date" data-table="picking_pending" data-field="x_creation_date" value="<?= $Page->creation_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->creation_date->getPlaceHolder()) ?>"<?= $Page->creation_date->editAttributes() ?> aria-describedby="x_creation_date_help">
<?= $Page->creation_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->creation_date->getErrorMessage() ?></div>
<?php if (!$Page->creation_date->ReadOnly && !$Page->creation_date->Disabled && !isset($Page->creation_date->EditAttrs["readonly"]) && !isset($Page->creation_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpicking_pendingedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpicking_pendingedit", "x_creation_date", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gr_number->Visible) { // gr_number ?>
    <div id="r_gr_number"<?= $Page->gr_number->rowAttributes() ?>>
        <label id="elh_picking_pending_gr_number" for="x_gr_number" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_gr_number"><?= $Page->gr_number->caption() ?><?= $Page->gr_number->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->gr_number->cellAttributes() ?>>
<template id="tpx_picking_pending_gr_number"><span id="el_picking_pending_gr_number">
<input type="<?= $Page->gr_number->getInputTextType() ?>" name="x_gr_number" id="x_gr_number" data-table="picking_pending" data-field="x_gr_number" value="<?= $Page->gr_number->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->gr_number->getPlaceHolder()) ?>"<?= $Page->gr_number->editAttributes() ?> aria-describedby="x_gr_number_help">
<?= $Page->gr_number->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gr_number->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gr_date->Visible) { // gr_date ?>
    <div id="r_gr_date"<?= $Page->gr_date->rowAttributes() ?>>
        <label id="elh_picking_pending_gr_date" for="x_gr_date" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_gr_date"><?= $Page->gr_date->caption() ?><?= $Page->gr_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->gr_date->cellAttributes() ?>>
<template id="tpx_picking_pending_gr_date"><span id="el_picking_pending_gr_date">
<input type="<?= $Page->gr_date->getInputTextType() ?>" name="x_gr_date" id="x_gr_date" data-table="picking_pending" data-field="x_gr_date" value="<?= $Page->gr_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->gr_date->getPlaceHolder()) ?>"<?= $Page->gr_date->editAttributes() ?> aria-describedby="x_gr_date_help">
<?= $Page->gr_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gr_date->getErrorMessage() ?></div>
<?php if (!$Page->gr_date->ReadOnly && !$Page->gr_date->Disabled && !isset($Page->gr_date->EditAttrs["readonly"]) && !isset($Page->gr_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpicking_pendingedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpicking_pendingedit", "x_gr_date", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->delivery->Visible) { // delivery ?>
    <div id="r_delivery"<?= $Page->delivery->rowAttributes() ?>>
        <label id="elh_picking_pending_delivery" for="x_delivery" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_delivery"><?= $Page->delivery->caption() ?><?= $Page->delivery->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->delivery->cellAttributes() ?>>
<template id="tpx_picking_pending_delivery"><span id="el_picking_pending_delivery">
<input type="<?= $Page->delivery->getInputTextType() ?>" name="x_delivery" id="x_delivery" data-table="picking_pending" data-field="x_delivery" value="<?= $Page->delivery->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->delivery->getPlaceHolder()) ?>"<?= $Page->delivery->editAttributes() ?> aria-describedby="x_delivery_help">
<?= $Page->delivery->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->delivery->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_id->Visible) { // store_id ?>
    <div id="r_store_id"<?= $Page->store_id->rowAttributes() ?>>
        <label id="elh_picking_pending_store_id" for="x_store_id" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_store_id"><?= $Page->store_id->caption() ?><?= $Page->store_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_id->cellAttributes() ?>>
<template id="tpx_picking_pending_store_id"><span id="el_picking_pending_store_id">
<span<?= $Page->store_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->store_id->getDisplayValue($Page->store_id->EditValue))) ?>"></span>
<input type="hidden" data-table="picking_pending" data-field="x_store_id" data-hidden="1" name="x_store_id" id="x_store_id" value="<?= HtmlEncode($Page->store_id->CurrentValue) ?>">
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
    <div id="r_store_name"<?= $Page->store_name->rowAttributes() ?>>
        <label id="elh_picking_pending_store_name" for="x_store_name" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_store_name"><?= $Page->store_name->caption() ?><?= $Page->store_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_name->cellAttributes() ?>>
<template id="tpx_picking_pending_store_name"><span id="el_picking_pending_store_name">
<span<?= $Page->store_name->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->store_name->getDisplayValue($Page->store_name->EditValue))) ?>"></span>
<input type="hidden" data-table="picking_pending" data-field="x_store_name" data-hidden="1" name="x_store_name" id="x_store_name" value="<?= HtmlEncode($Page->store_name->CurrentValue) ?>">
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <div id="r_article"<?= $Page->article->rowAttributes() ?>>
        <label id="elh_picking_pending_article" for="x_article" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_article"><?= $Page->article->caption() ?><?= $Page->article->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->article->cellAttributes() ?>>
<template id="tpx_picking_pending_article"><span id="el_picking_pending_article">
<span<?= $Page->article->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->article->getDisplayValue($Page->article->EditValue))) ?>"></span>
<input type="hidden" data-table="picking_pending" data-field="x_article" data-hidden="1" name="x_article" id="x_article" value="<?= HtmlEncode($Page->article->CurrentValue) ?>">
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->size_code->Visible) { // size_code ?>
    <div id="r_size_code"<?= $Page->size_code->rowAttributes() ?>>
        <label id="elh_picking_pending_size_code" for="x_size_code" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_size_code"><?= $Page->size_code->caption() ?><?= $Page->size_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->size_code->cellAttributes() ?>>
<template id="tpx_picking_pending_size_code"><span id="el_picking_pending_size_code">
<input type="<?= $Page->size_code->getInputTextType() ?>" name="x_size_code" id="x_size_code" data-table="picking_pending" data-field="x_size_code" value="<?= $Page->size_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->size_code->getPlaceHolder()) ?>"<?= $Page->size_code->editAttributes() ?> aria-describedby="x_size_code_help">
<?= $Page->size_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->size_code->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
    <div id="r_size_desc"<?= $Page->size_desc->rowAttributes() ?>>
        <label id="elh_picking_pending_size_desc" for="x_size_desc" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_size_desc"><?= $Page->size_desc->caption() ?><?= $Page->size_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->size_desc->cellAttributes() ?>>
<template id="tpx_picking_pending_size_desc"><span id="el_picking_pending_size_desc">
<span<?= $Page->size_desc->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->size_desc->getDisplayValue($Page->size_desc->EditValue))) ?>"></span>
<input type="hidden" data-table="picking_pending" data-field="x_size_desc" data-hidden="1" name="x_size_desc" id="x_size_desc" value="<?= HtmlEncode($Page->size_desc->CurrentValue) ?>">
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
    <div id="r_color_code"<?= $Page->color_code->rowAttributes() ?>>
        <label id="elh_picking_pending_color_code" for="x_color_code" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_color_code"><?= $Page->color_code->caption() ?><?= $Page->color_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->color_code->cellAttributes() ?>>
<template id="tpx_picking_pending_color_code"><span id="el_picking_pending_color_code">
<input type="<?= $Page->color_code->getInputTextType() ?>" name="x_color_code" id="x_color_code" data-table="picking_pending" data-field="x_color_code" value="<?= $Page->color_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->color_code->getPlaceHolder()) ?>"<?= $Page->color_code->editAttributes() ?> aria-describedby="x_color_code_help">
<?= $Page->color_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->color_code->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->color_desc->Visible) { // color_desc ?>
    <div id="r_color_desc"<?= $Page->color_desc->rowAttributes() ?>>
        <label id="elh_picking_pending_color_desc" for="x_color_desc" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_color_desc"><?= $Page->color_desc->caption() ?><?= $Page->color_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->color_desc->cellAttributes() ?>>
<template id="tpx_picking_pending_color_desc"><span id="el_picking_pending_color_desc">
<span<?= $Page->color_desc->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->color_desc->getDisplayValue($Page->color_desc->EditValue))) ?>"></span>
<input type="hidden" data-table="picking_pending" data-field="x_color_desc" data-hidden="1" name="x_color_desc" id="x_color_desc" value="<?= HtmlEncode($Page->color_desc->CurrentValue) ?>">
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
    <div id="r_concept"<?= $Page->concept->rowAttributes() ?>>
        <label id="elh_picking_pending_concept" for="x_concept" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_concept"><?= $Page->concept->caption() ?><?= $Page->concept->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->concept->cellAttributes() ?>>
<template id="tpx_picking_pending_concept"><span id="el_picking_pending_concept">
<input type="<?= $Page->concept->getInputTextType() ?>" name="x_concept" id="x_concept" data-table="picking_pending" data-field="x_concept" value="<?= $Page->concept->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->concept->getPlaceHolder()) ?>"<?= $Page->concept->editAttributes() ?> aria-describedby="x_concept_help">
<?= $Page->concept->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->concept->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->target_qty->Visible) { // target_qty ?>
    <div id="r_target_qty"<?= $Page->target_qty->rowAttributes() ?>>
        <label id="elh_picking_pending_target_qty" for="x_target_qty" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_target_qty"><?= $Page->target_qty->caption() ?><?= $Page->target_qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->target_qty->cellAttributes() ?>>
<template id="tpx_picking_pending_target_qty"><span id="el_picking_pending_target_qty">
<span<?= $Page->target_qty->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->target_qty->getDisplayValue($Page->target_qty->EditValue))) ?>"></span>
<input type="hidden" data-table="picking_pending" data-field="x_target_qty" data-hidden="1" name="x_target_qty" id="x_target_qty" value="<?= HtmlEncode($Page->target_qty->CurrentValue) ?>">
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->picked_qty->Visible) { // picked_qty ?>
    <div id="r_picked_qty"<?= $Page->picked_qty->rowAttributes() ?>>
        <label id="elh_picking_pending_picked_qty" for="x_picked_qty" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_picked_qty"><?= $Page->picked_qty->caption() ?><?= $Page->picked_qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->picked_qty->cellAttributes() ?>>
<template id="tpx_picking_pending_picked_qty"><span id="el_picking_pending_picked_qty">
<input type="<?= $Page->picked_qty->getInputTextType() ?>" name="x_picked_qty" id="x_picked_qty" data-table="picking_pending" data-field="x_picked_qty" value="<?= $Page->picked_qty->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->picked_qty->getPlaceHolder()) ?>"<?= $Page->picked_qty->editAttributes() ?> aria-describedby="x_picked_qty_help">
<?= $Page->picked_qty->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->picked_qty->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->variance_qty->Visible) { // variance_qty ?>
    <div id="r_variance_qty"<?= $Page->variance_qty->rowAttributes() ?>>
        <label id="elh_picking_pending_variance_qty" for="x_variance_qty" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_variance_qty"><?= $Page->variance_qty->caption() ?><?= $Page->variance_qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->variance_qty->cellAttributes() ?>>
<template id="tpx_picking_pending_variance_qty"><span id="el_picking_pending_variance_qty">
<input type="<?= $Page->variance_qty->getInputTextType() ?>" name="x_variance_qty" id="x_variance_qty" data-table="picking_pending" data-field="x_variance_qty" value="<?= $Page->variance_qty->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->variance_qty->getPlaceHolder()) ?>"<?= $Page->variance_qty->editAttributes() ?> aria-describedby="x_variance_qty_help">
<?= $Page->variance_qty->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->variance_qty->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->confirmation_date->Visible) { // confirmation_date ?>
    <div id="r_confirmation_date"<?= $Page->confirmation_date->rowAttributes() ?>>
        <label id="elh_picking_pending_confirmation_date" for="x_confirmation_date" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_confirmation_date"><?= $Page->confirmation_date->caption() ?><?= $Page->confirmation_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->confirmation_date->cellAttributes() ?>>
<template id="tpx_picking_pending_confirmation_date"><span id="el_picking_pending_confirmation_date">
<input type="<?= $Page->confirmation_date->getInputTextType() ?>" name="x_confirmation_date" id="x_confirmation_date" data-table="picking_pending" data-field="x_confirmation_date" value="<?= $Page->confirmation_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->confirmation_date->getPlaceHolder()) ?>"<?= $Page->confirmation_date->editAttributes() ?> aria-describedby="x_confirmation_date_help">
<?= $Page->confirmation_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->confirmation_date->getErrorMessage() ?></div>
<?php if (!$Page->confirmation_date->ReadOnly && !$Page->confirmation_date->Disabled && !isset($Page->confirmation_date->EditAttrs["readonly"]) && !isset($Page->confirmation_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpicking_pendingedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpicking_pendingedit", "x_confirmation_date", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->confirmation_time->Visible) { // confirmation_time ?>
    <div id="r_confirmation_time"<?= $Page->confirmation_time->rowAttributes() ?>>
        <label id="elh_picking_pending_confirmation_time" for="x_confirmation_time" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_confirmation_time"><?= $Page->confirmation_time->caption() ?><?= $Page->confirmation_time->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->confirmation_time->cellAttributes() ?>>
<template id="tpx_picking_pending_confirmation_time"><span id="el_picking_pending_confirmation_time">
<input type="<?= $Page->confirmation_time->getInputTextType() ?>" name="x_confirmation_time" id="x_confirmation_time" data-table="picking_pending" data-field="x_confirmation_time" value="<?= $Page->confirmation_time->EditValue ?>" placeholder="<?= HtmlEncode($Page->confirmation_time->getPlaceHolder()) ?>"<?= $Page->confirmation_time->editAttributes() ?> aria-describedby="x_confirmation_time_help">
<?= $Page->confirmation_time->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->confirmation_time->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->box_code->Visible) { // box_code ?>
    <div id="r_box_code"<?= $Page->box_code->rowAttributes() ?>>
        <label id="elh_picking_pending_box_code" for="x_box_code" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_box_code"><?= $Page->box_code->caption() ?><?= $Page->box_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->box_code->cellAttributes() ?>>
<template id="tpx_picking_pending_box_code"><span id="el_picking_pending_box_code">
<input type="<?= $Page->box_code->getInputTextType() ?>" name="x_box_code" id="x_box_code" data-table="picking_pending" data-field="x_box_code" value="<?= $Page->box_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->box_code->getPlaceHolder()) ?>"<?= $Page->box_code->editAttributes() ?> aria-describedby="x_box_code_help">
<?= $Page->box_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->box_code->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->box_type->Visible) { // box_type ?>
    <div id="r_box_type"<?= $Page->box_type->rowAttributes() ?>>
        <label id="elh_picking_pending_box_type" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_box_type"><?= $Page->box_type->caption() ?><?= $Page->box_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->box_type->cellAttributes() ?>>
<template id="tpx_picking_pending_box_type"><span id="el_picking_pending_box_type">
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
    value="<?= HtmlEncode($Page->box_type->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_box_type"
    data-bs-target="dsl_x_box_type"
    data-repeatcolumn="5"
    class="form-control<?= $Page->box_type->isInvalidClass() ?>"
    data-table="picking_pending"
    data-field="x_box_type"
    data-value-separator="<?= $Page->box_type->displayValueSeparatorAttribute() ?>"
    <?= $Page->box_type->editAttributes() ?>></selection-list>
<?= $Page->box_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->box_type->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->picker->Visible) { // picker ?>
    <div id="r_picker"<?= $Page->picker->rowAttributes() ?>>
        <label id="elh_picking_pending_picker" for="x_picker" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_picker"><?= $Page->picker->caption() ?><?= $Page->picker->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->picker->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Page->userIDAllow("edit")) { // Non system admin ?>
<span<?= $Page->picker->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->picker->getDisplayValue($Page->picker->EditValue))) ?>"></span>
<input type="hidden" data-table="picking_pending" data-field="x_picker" data-hidden="1" name="x_picker" id="x_picker" value="<?= HtmlEncode($Page->picker->CurrentValue) ?>">
<?php } else { ?>
<template id="tpx_picking_pending_picker"><span id="el_picking_pending_picker">
<input type="<?= $Page->picker->getInputTextType() ?>" name="x_picker" id="x_picker" data-table="picking_pending" data-field="x_picker" value="<?= $Page->picker->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->picker->getPlaceHolder()) ?>"<?= $Page->picker->editAttributes() ?> aria-describedby="x_picker_help">
<?= $Page->picker->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->picker->getErrorMessage() ?></div>
</span></template>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_picking_pending_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_status"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<template id="tpx_picking_pending_status"><span id="el_picking_pending_status">
<input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="picking_pending" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->remarks->Visible) { // remarks ?>
    <div id="r_remarks"<?= $Page->remarks->rowAttributes() ?>>
        <label id="elh_picking_pending_remarks" for="x_remarks" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_remarks"><?= $Page->remarks->caption() ?><?= $Page->remarks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->remarks->cellAttributes() ?>>
<template id="tpx_picking_pending_remarks"><span id="el_picking_pending_remarks">
<input type="<?= $Page->remarks->getInputTextType() ?>" name="x_remarks" id="x_remarks" data-table="picking_pending" data-field="x_remarks" value="<?= $Page->remarks->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->remarks->getPlaceHolder()) ?>"<?= $Page->remarks->editAttributes() ?> aria-describedby="x_remarks_help">
<?= $Page->remarks->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->remarks->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->aisle->Visible) { // aisle ?>
    <div id="r_aisle"<?= $Page->aisle->rowAttributes() ?>>
        <label id="elh_picking_pending_aisle" for="x_aisle" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_aisle"><?= $Page->aisle->caption() ?><?= $Page->aisle->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->aisle->cellAttributes() ?>>
<template id="tpx_picking_pending_aisle"><span id="el_picking_pending_aisle">
<input type="<?= $Page->aisle->getInputTextType() ?>" name="x_aisle" id="x_aisle" data-table="picking_pending" data-field="x_aisle" value="<?= $Page->aisle->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->aisle->getPlaceHolder()) ?>"<?= $Page->aisle->editAttributes() ?> aria-describedby="x_aisle_help">
<?= $Page->aisle->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->aisle->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->area->Visible) { // area ?>
    <div id="r_area"<?= $Page->area->rowAttributes() ?>>
        <label id="elh_picking_pending_area" for="x_area" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_area"><?= $Page->area->caption() ?><?= $Page->area->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->area->cellAttributes() ?>>
<template id="tpx_picking_pending_area"><span id="el_picking_pending_area">
<input type="<?= $Page->area->getInputTextType() ?>" name="x_area" id="x_area" data-table="picking_pending" data-field="x_area" value="<?= $Page->area->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->area->getPlaceHolder()) ?>"<?= $Page->area->editAttributes() ?> aria-describedby="x_area_help">
<?= $Page->area->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->area->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->aisle2->Visible) { // aisle2 ?>
    <div id="r_aisle2"<?= $Page->aisle2->rowAttributes() ?>>
        <label id="elh_picking_pending_aisle2" for="x_aisle2" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_aisle2"><?= $Page->aisle2->caption() ?><?= $Page->aisle2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->aisle2->cellAttributes() ?>>
<template id="tpx_picking_pending_aisle2"><span id="el_picking_pending_aisle2">
<input type="<?= $Page->aisle2->getInputTextType() ?>" name="x_aisle2" id="x_aisle2" data-table="picking_pending" data-field="x_aisle2" value="<?= $Page->aisle2->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->aisle2->getPlaceHolder()) ?>"<?= $Page->aisle2->editAttributes() ?> aria-describedby="x_aisle2_help">
<?= $Page->aisle2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->aisle2->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_id2->Visible) { // store_id2 ?>
    <div id="r_store_id2"<?= $Page->store_id2->rowAttributes() ?>>
        <label id="elh_picking_pending_store_id2" for="x_store_id2" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_store_id2"><?= $Page->store_id2->caption() ?><?= $Page->store_id2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_id2->cellAttributes() ?>>
<template id="tpx_picking_pending_store_id2"><span id="el_picking_pending_store_id2">
<input type="<?= $Page->store_id2->getInputTextType() ?>" name="x_store_id2" id="x_store_id2" data-table="picking_pending" data-field="x_store_id2" value="<?= $Page->store_id2->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->store_id2->getPlaceHolder()) ?>"<?= $Page->store_id2->editAttributes() ?> aria-describedby="x_store_id2_help">
<?= $Page->store_id2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->store_id2->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->scan_article->Visible) { // scan_article ?>
    <div id="r_scan_article"<?= $Page->scan_article->rowAttributes() ?>>
        <label id="elh_picking_pending_scan_article" for="x_scan_article" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_scan_article"><?= $Page->scan_article->caption() ?><?= $Page->scan_article->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->scan_article->cellAttributes() ?>>
<template id="tpx_picking_pending_scan_article"><span id="el_picking_pending_scan_article">
<input type="<?= $Page->scan_article->getInputTextType() ?>" name="x_scan_article" id="x_scan_article" data-table="picking_pending" data-field="x_scan_article" value="<?= $Page->scan_article->EditValue ?>" placeholder="<?= HtmlEncode($Page->scan_article->getPlaceHolder()) ?>"<?= $Page->scan_article->editAttributes() ?> aria-describedby="x_scan_article_help">
<?= $Page->scan_article->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->scan_article->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->close_totes->Visible) { // close_totes ?>
    <div id="r_close_totes"<?= $Page->close_totes->rowAttributes() ?>>
        <label id="elh_picking_pending_close_totes" for="x_close_totes" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_close_totes"><?= $Page->close_totes->caption() ?><?= $Page->close_totes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->close_totes->cellAttributes() ?>>
<template id="tpx_picking_pending_close_totes"><span id="el_picking_pending_close_totes">
<input type="<?= $Page->close_totes->getInputTextType() ?>" name="x_close_totes" id="x_close_totes" data-table="picking_pending" data-field="x_close_totes" value="<?= $Page->close_totes->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->close_totes->getPlaceHolder()) ?>"<?= $Page->close_totes->editAttributes() ?> aria-describedby="x_close_totes_help">
<?= $Page->close_totes->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->close_totes->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->job_id->Visible) { // job_id ?>
    <div id="r_job_id"<?= $Page->job_id->rowAttributes() ?>>
        <label id="elh_picking_pending_job_id" for="x_job_id" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_picking_pending_job_id"><?= $Page->job_id->caption() ?><?= $Page->job_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->job_id->cellAttributes() ?>>
<template id="tpx_picking_pending_job_id"><span id="el_picking_pending_job_id">
<input type="<?= $Page->job_id->getInputTextType() ?>" name="x_job_id" id="x_job_id" data-table="picking_pending" data-field="x_job_id" value="<?= $Page->job_id->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->job_id->getPlaceHolder()) ?>"<?= $Page->job_id->editAttributes() ?> aria-describedby="x_job_id_help">
<?= $Page->job_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->job_id->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_picking_pendingedit" class="ew-custom-template"></div>
<template id="tpm_picking_pendingedit">
<div id="ct_PickingPendingEdit"><script type="text/javascript">

        function close2() {
			$("#x_close_totes").val("2");
			$("#btn-action").focus();
		};	
</script>
<script type="text/javascript">
        $('body').on('keydown', 'input, select', function(e) { // ganti enter jadi tab di setiap input
            if (e.key === "Enter") {
                var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
                focusable = form.find('a,select,textarea,button').filter(":input:not([readonly])",".scan-article");
                next = focusable.eq(focusable.index(this)+1);
                if (next.length) {
                    next.focus();
                    //alert('Shortpick');
                } else {
                    form.submit(function (){
                    //window.location = 'http://localhost/opsvaliram/auditstagingedit?start=1';
                    return false;
                });
                }
                return false;
            }
        });
        $("#x_scan_article").on("keydown", function (e) {
          	if (e.which == 13 || e.keycode == 13) {
          		//alert('clikced');
          		const element = document.getElementById('x_scan_article');
          		$("#x_scan_article").focus();
          		if (element.readOnly) {
          			console.log('✅ element is read-only');
          			$("#x_box_code").focus();
          		}
        }});
        $("#x_box_code").on("keydown", function (e) {
          	if (e.which == 13 || e.keycode == 13) {
          		$("#x_box_type").focus();
        }});
       $("#x_pick_quantity").change(function () {
            $("#x_pick_quantity").css({ color: 'green'}); // warna text
            $("#btn-action").focus();
        });
        $(document).ready(function() {
         $("#btn-action").on('focus', function() {
            this.form.submit();
             });
         });
</script>
<style>
    .main-frame {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        height: 100vh !important;
        box-sizing: border-box !important;
    }
    .main-form {
        border: solid 2px !important;
        padding: 10px !important;
        width: 350px !important;
        border-radius: 10px !important;
    }
    .formbuilder-item {
        margin-bottom: 10px !important;
    }
    .form-control{
        display: block !important;
        width: 250px !important;
        box-sizing: border-box !important;
    }
    label{
        display: block !important;
        width: auto !important;
    }
    input{
        display: block !important;
        width: auto !important;
        box-sizing: border-box !important;
    }
    .col-sm-10{
        display: block !important;
        width: auto !important;
        box-sizing: border-box !important;
    }
    .btn-primary{
    	display: block !important;
        width: 350px !important;
        box-sizing: border-box !important;
        margin-bottom: 20px !important;
    }
    .btn-default{
    	display: block !important;
        width: 350px !important;
        box-sizing: border-box !important;
        margin-bottom: 20px !important;
    }
    .btn-danger{
    	display: block !important;
        width: 350px !important;
        box-sizing: border-box !important;
        margin-bottom: 20px !important;
    }
    hr.rounded {
    border-top: 8px solid #FFC300 !important;
    border-radius: 5px !important;
    }
    .card-body {
        -ms-flex: 1 1 auto !important;
        flex: 1 1 auto !important;
        margin: 0 !important;
        padding: 1.5rem 1.5rem !important;
        position: relative !important;
    }
    .card {
        position: relative !important;
        display: -ms-flexbox !important;
        display: flex !important;
        -ms-flex-direction: column !important;
        flex-direction: column !important;
        min-width: 0 !important;
        word-wrap: break-word !important;
        background-color: rgb(201, 208, 218) !important;
        background-clip: border-box !important;
        border: 1px solid rgba(0, 0, 0, .125) !important;
        border-radius: .25rem !important;
        margin-bottom: 15px !important;
    }
    .card2 {
        position: relative !important;
        display: -ms-flexbox !important;
        display: flex !important;
        -ms-flex-direction: column !important;
        flex-direction: column !important;
        min-width: 0 !important;
        word-wrap: break-word !important;
        background-color: rgb(0, 247, 41) !important;
        background-clip: border-box !important;
        border: 1px solid rgba(0, 0, 0, .125) !important;
        border-radius: .25rem !important;
        margin-bottom: 15px !important;
    }
    .form-check-input {
        border-radius : 50% !important;
        float : left !important;
        width: 1.125em !important;
        height: 1.125em !important;
        margin-top: 0.1875em !important;
        vertical-align: top !important;
    }
</style>
<div class="main-form" >
    <div class="card2">
        <div class="card-body">    
            <div id="r_source_storage_bin" class="formbuilder-item"  >
                 <label for="x_short_article" class="col-sm-2 col-form-label"><?= $Page->source_storage_bin->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_picking_pending_source_storage_bin"></slot></div>
            </div>
            <div id="r_carton_number" class="formbuilder-item"  >
                 <label for="x_carton_number" class="col-sm-2 col-form-label"><?= $Page->carton_number->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_picking_pending_carton_number"></slot></div>
            </div>
            <div id="r_article" class="formbuilder-item"  >
                 <label for="x_article" class="col-sm-2 col-form-label"><?= $Page->article->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_picking_pending_article"></slot></div>
            </div>
            <div id="r_color_desc" class="formbuilder-item"  >
                 <label for="x_color_desc" class="col-sm-2 col-form-label"><?= $Page->color_desc->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_picking_pending_color_desc"></slot></div>
            </div>
            <div id="r_size_desc" class="formbuilder-item"  >
                 <label for="x_size_desc" class="col-sm-2 col-form-label"><?= $Page->size_desc->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_picking_pending_size_desc"></slot></div>
            </div>
            <div id="r_target_qty" class="formbuilder-item"  >
                 <label for="x_target_qty" class="col-sm-2 col-form-label"><?= $Page->target_qty->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_picking_pending_target_qty"></slot></div>
            </div>
        </div>
    </div>
</div>
<hr class="hr hr-blurry" />
<div class="main-form" >
    <div class="card">
        <div class="card-body">    
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_id"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_po_no"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_po_no"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_to_no"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_to_no"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_to_order_item"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_to_order_item"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_to_priority"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_to_priority"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_to_priority_code"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_to_priority_code"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_source_storage_type"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_source_storage_type"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_creation_date"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_creation_date"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_gr_number"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_gr_number"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_gr_date"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_gr_date"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_delivery"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_delivery"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_store_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_store_id"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_store_name"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_store_name"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_size_code"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_size_code"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_color_code"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_color_code"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_color_desc"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_color_desc"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_concept"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_concept"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_confirmation_date"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_confirmation_date"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_confirmation_time"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_confirmation_time"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_status"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_status"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_remarks"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_remarks"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_aisle"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_aisle"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_close_totes"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_close_totes"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_aisle2"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_aisle2"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_area"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_area"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_store_id2"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_store_id2"></slot></h2>
            </div>
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_picking_pending_job_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_picking_pending_job_id"></slot></h2>
            </div>
            <div id="r_store_name" class="formbuilder-item" >
                 <label for="x_scan_article" class="col-sm-2 col-form-label"><?= $Page->store_name->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_picking_pending_store_id"></slot><slot class="ew-slot" name="tpx_picking_pending_store_name"></slot></div>
            </div>
            <div id="r_picked_qty" class="formbuilder-item" >
                 <label for="x_picked_qty" class="col-sm-2 col-form-label"><?= $Page->picked_qty->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_picking_pending_picked_qty"></slot></div>
            </div>
            <div id="r_scan_article" class="scan-input" >
                 <label for="x_scan_article" class="col-sm-2 col-form-label"><?= $Page->scan_article->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_picking_pending_scan_article"></slot></div>
            </div>
            <div id="r_variance_qty" class="formbuilder-item" hidden>
                 <label for="x_variance_qty" class="col-sm-2 col-form-label"><?= $Page->variance_qty->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_picking_pending_variance_qty"></slot></div>
            </div>
            <div id="r_box_code" class="formbuilder-item">
                 <label for="x_box_code" class="col-sm-2 col-form-label"><?= $Page->box_code->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_picking_pending_box_code"></slot></div>
            </div>
            <div id="r_box_type" class="formbuilder-item">
            	<label for="x_box_type" class="col-sm-2 col-form-label"><?= $Page->box_type->caption() ?></label>
            	<div class="col-sm-10"><slot class="ew-slot" name="tpx_picking_pending_box_type"></slot></div>
            </div>
        </div>
    </div>
</div>
</div>
</template>
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
</form>
<script class="ew-apply-template">
loadjs.ready(ew.applyTemplateId, function() {
    ew.templateData = { rows: <?= JsonEncode($Page->Rows) ?> };
    ew.applyTemplate("tpd_picking_pendingedit", "tpm_picking_pendingedit", "picking_pendingedit", "<?= $Page->CustomExport ?>", ew.templateData.rows[0]);
    loadjs.done("customtemplate");
});
</script>
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
    // Startup script
    // Write your table-specific startup script here, no need to add script tags.
    $(document).ready(function () {
      $("#btn-action").after(
        '<button class="btn btn-danger ew-btn" name="btn-action" id="btn-action" type="button" onclick="close2()">Close Totes</button>'
      );
      $(document).on("focus", "input[type=text]", function () {
        this.select();
      });
      $("#x_scan_article").focus();

      function autofocus() {
        $("#x_scan_article").focus();
      }
      $("#x_close_totes").val("1");
      $("#x_scan_article").keypress(function (event) {
        if ((event.keyCode || event.which) == 13) {
          event.preventDefault();
          return false;
        }
      });
      $(document).on("input", "#x_scan_article", function () {
        var picked = $("#x_picked_qty").val();
        var actual = 1;
        var target = $("#x_target_qty").val();
        var result = parseInt(picked) + parseInt(actual);
        if ($("#x_scan_article").val().length == 30) {
          scan1 = $("#x_scan_article").val().substring(4, 14);
          scan2 = $("#x_scan_article").val().substring(18, 21);
          scan3 = $("#x_scan_article").val().substring(12, 17);
          $("#x_scan_article").val(scan1 + scan2 + scan3);
          if ($("#x_scan_article").val() == $("#x_article").val()) {
            $("#x_scan_article").css({ color: "green" }); // warna text
            //$("#x_scan_article").attr('readonly', true);
            //$("#x_scan_article").blur();
            //$("#x_scan_article").val("");
            $("#x_scan_article").focus();
            $("#x_picked_qty").val(result);
            //Check Qty Target & Actual
            if (target == result) {
              $("#x_scan_article").attr("readonly", true);
              //$("#x_scan_article").blur();
              //$("#x_box_code").focus();
              $("#x_remarks").val("");
              $("#x_close_totes").val("1");

              //alert('Qty Match!!');
            }
            if (target !== result) {
              //$("#x_scan_article").val("");
              //$("#x_scan_article").focus();
              $("#x_remarks").val("M");
              $("#x_close_totes").val("1");

              //alert('Shortpick');
            }
            //end
          } else {
            alert("Wrong Article !!");
            $("#x_scan_article").val("");
            $("#x_scan_article").focus();
          }
          //alert("type 1");
        }
        if (
          $("#x_scan_article").val().length == 29 &&
          $("#x_scan_article").val().substring(2, 3) == 1
        ) {
          scan4 = $("#x_scan_article").val().substring(2, 3);
          scan5 = $("#x_scan_article").val().substring(3, 12);
          scan6 = $("#x_scan_article").val().substring(17, 19);
          scan7 = $("#x_scan_article").val().substring(1, 2);
          scan8 = $("#x_scan_article").val().substring(12, 15);
          $("#x_scan_article").val(scan4 + scan5 + scan6 + scan7 + scan8);
          if ($("#x_scan_article").val() == $("#x_article").val()) {
            $("#x_scan_article").css({ color: "green" }); // warna text
            //$("#x_scan_article").attr('readonly', true);
            //$("#x_scan_article").blur();
            //$("#x_scan_article").val("");
            $("#x_scan_article").focus();
            $("#x_picked_qty").val(result);
            //Check Qty Target & Actual
            if (target == result) {
              $("#x_scan_article").attr("readonly", true);
              //$("#x_scan_article").blur();
              //$("#x_box_code").focus();
              $("#x_remarks").val("");
              $("#x_close_totes").val("1");

              //alert('Qty Match!!');
            }
            if (target !== result) {
              //$("#x_scan_article").val("");
              //$("#x_scan_article").focus();
              $("#x_remarks").val("M");
              $("#x_close_totes").val("1");

              //alert('Shortpick');
            }
            //end
          } else {
            alert("Wrong Article !!");
            $("#x_scan_article").val("");
            $("#x_scan_article").focus();
          }
          //alert("type 2");
        } else if (
          $("#x_scan_article").val().length == 29 &&
          $("#x_scan_article").val().substring(2, 3) !== 1
        ) {
          scan9 = $("#x_scan_article").val().substring(3, 12);
          scan10 = $("#x_scan_article").val().substring(17, 19);
          scan11 = $("#x_scan_article").val().substring(1, 2);
          scan12 = $("#x_scan_article").val().substring(12, 15);
          $("#x_scan_article").val(scan9 + scan10 + scan11 + scan12);
          if ($("#x_scan_article").val() == $("#x_article").val()) {
            $("#x_scan_article").css({ color: "green" }); // warna text
            //$("#x_scan_article").attr('readonly', true);
            //$("#x_scan_article").blur();
            //$("#x_scan_article").val("");
            $("#x_scan_article").focus();
            $("#x_picked_qty").val(result);
            //Check Qty Target & Actual
            if (target == result) {
              $("#x_scan_article").attr("readonly", true);
              //$("#x_scan_article").blur();
              //$("#x_box_code").focus();
              $("#x_remarks").val("");
              $("#x_close_totes").val("1");

              //alert('Qty Match!!');
            }
            if (target !== result) {
              //$("#x_scan_article").val("");
              //$("#x_scan_article").focus();
              $("#x_remarks").val("M");
              $("#x_close_totes").val("1");

              //alert('Shortpick');
            }
            //end
          } else {
            alert("Wrong Article !!");
            $("#x_scan_article").val("");
            $("#x_scan_article").focus();
          }
          //alert("type 3");
        } else if ($("#x_scan_article").val().length <= 29) {
          if ($("#x_scan_article").val() == $("#x_article").val()) {
            $("#x_scan_article").css({ color: "green" }); // warna text
            //$("#x_scan_article").attr('readonly', true);
            //$("#x_scan_article").blur();
            //$("#x_scan_article").val("");
            $("#x_scan_article").focus();
            $("#x_picked_qty").val(result);
            //Check Qty Target & Actual
            if (target == result) {
              $("#x_scan_article").attr("readonly", true);
              //$("#x_scan_article").blur();
              //$("#x_box_code").focus();
              $("#x_remarks").val("");
              $("#x_close_totes").val("1");

              //alert('Qty Match!!');
            }
            if (target !== result) {
              //$("#x_scan_article").val("");
              //$("#x_scan_article").focus();
              $("#x_remarks").val("M");
              $("#x_close_totes").val("1");

              //alert('Shortpick');
            }
            //end
          } else {
            alert("Wrong Article !!");
            $("#x_scan_article").val("");
            $("#x_scan_article").focus();
          }
          //alert("type 4");
        }
      });

      // input PCS Only
      //$("#x_picked_qty").change(function () {
      //  target = $("#x_target_qty").val();
      //  picked = $("#x_picked_qty").val();
      //  variance = $("#x_variance_qty").val();
      //  remarks = $("#x_remarks").val();
      //  scan = $("#x_scan").val();
      //  $("#x_variance_qty").val(picked - target);
      //  if (picked !== target) {
      //    $("#x_remarks").val("M");
      //  }
      //  if (picked == target) {
      //    $("#x_scan_article").attr("readonly", true);
      //    $("#x_box_code").focus();
      //    //$("#x_box_code").focus();
      //    //$("#btn-action").focus();
      //  }
      //});
      $(document).ready(function () {
        $("#btn-action").on("focus", function () {
          this.form.submit();
        });
      });
      $("#x_box_code").change(function () {
        $("#x_box_type").focus();
      });
      $("#x_box_type").change(function () {
        $("#x_box_type").focus();
      });
    });
});
</script>
