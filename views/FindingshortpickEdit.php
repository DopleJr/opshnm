<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$FindingshortpickEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { findingshortpick: currentTable } });
var currentForm, currentPageID;
var ffindingshortpickedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ffindingshortpickedit = new ew.Form("ffindingshortpickedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = ffindingshortpickedit;

    // Add fields
    var fields = currentTable.fields;
    ffindingshortpickedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["location", [fields.location.visible && fields.location.required ? ew.Validators.required(fields.location.caption) : null], fields.location.isInvalid],
        ["ctn", [fields.ctn.visible && fields.ctn.required ? ew.Validators.required(fields.ctn.caption) : null], fields.ctn.isInvalid],
        ["article", [fields.article.visible && fields.article.required ? ew.Validators.required(fields.article.caption) : null], fields.article.isInvalid],
        ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
        ["actual", [fields.actual.visible && fields.actual.required ? ew.Validators.required(fields.actual.caption) : null, ew.Validators.integer], fields.actual.isInvalid],
        ["target_quantity", [fields.target_quantity.visible && fields.target_quantity.required ? ew.Validators.required(fields.target_quantity.caption) : null], fields.target_quantity.isInvalid],
        ["pick_quantity", [fields.pick_quantity.visible && fields.pick_quantity.required ? ew.Validators.required(fields.pick_quantity.caption) : null, ew.Validators.integer], fields.pick_quantity.isInvalid],
        ["shortpick", [fields.shortpick.visible && fields.shortpick.required ? ew.Validators.required(fields.shortpick.caption) : null], fields.shortpick.isInvalid],
        ["user", [fields.user.visible && fields.user.required ? ew.Validators.required(fields.user.caption) : null], fields.user.isInvalid],
        ["area", [fields.area.visible && fields.area.required ? ew.Validators.required(fields.area.caption) : null], fields.area.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["date_upload", [fields.date_upload.visible && fields.date_upload.required ? ew.Validators.required(fields.date_upload.caption) : null, ew.Validators.datetime(fields.date_upload.clientFormatPattern)], fields.date_upload.isInvalid],
        ["date_picking", [fields.date_picking.visible && fields.date_picking.required ? ew.Validators.required(fields.date_picking.caption) : null], fields.date_picking.isInvalid],
        ["total_shortpick", [fields.total_shortpick.visible && fields.total_shortpick.required ? ew.Validators.required(fields.total_shortpick.caption) : null], fields.total_shortpick.isInvalid],
        ["short_article", [fields.short_article.visible && fields.short_article.required ? ew.Validators.required(fields.short_article.caption) : null], fields.short_article.isInvalid],
        ["total", [fields.total.visible && fields.total.required ? ew.Validators.required(fields.total.caption) : null], fields.total.isInvalid],
        ["excess", [fields.excess.visible && fields.excess.required ? ew.Validators.required(fields.excess.caption) : null, ew.Validators.integer], fields.excess.isInvalid]
    ]);

    // Form_CustomValidate
    ffindingshortpickedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ffindingshortpickedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("ffindingshortpickedit");
});
</script>
<script>
loadjs.ready("head", function () {
    // Client script
    // Write your table-specific client script here, no need to add script tags.
    $(document).ready(function() {
    $(".input-group").hide();
    $(".text-muted").hide();
    $("#el_bin_to_bin_piece_destination_location").hide(); // atribut text
    $("#el_bin_to_bin_piece_su").hide();// atribut text
    $(".ew-breadcrumbs").hide();// atribut text
    $("#x_actual").val("");
    $("#x_pick_quantity").val("");
    $("#x_excess").val("");
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
<form name="ffindingshortpickedit" id="ffindingshortpickedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="findingshortpick">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div d-none"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_findingshortpick_id" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_findingshortpick_id"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<template id="tpx_findingshortpick_id"><span id="el_findingshortpick_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="findingshortpick" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
    <div id="r_location"<?= $Page->location->rowAttributes() ?>>
        <label id="elh_findingshortpick_location" for="x_location" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_findingshortpick_location"><?= $Page->location->caption() ?><?= $Page->location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->location->cellAttributes() ?>>
<template id="tpx_findingshortpick_location"><span id="el_findingshortpick_location">
<span<?= $Page->location->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->location->getDisplayValue($Page->location->EditValue))) ?>"></span>
<input type="hidden" data-table="findingshortpick" data-field="x_location" data-hidden="1" name="x_location" id="x_location" value="<?= HtmlEncode($Page->location->CurrentValue) ?>">
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
    <div id="r_ctn"<?= $Page->ctn->rowAttributes() ?>>
        <label id="elh_findingshortpick_ctn" for="x_ctn" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_findingshortpick_ctn"><?= $Page->ctn->caption() ?><?= $Page->ctn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ctn->cellAttributes() ?>>
<template id="tpx_findingshortpick_ctn"><span id="el_findingshortpick_ctn">
<span<?= $Page->ctn->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->ctn->getDisplayValue($Page->ctn->EditValue))) ?>"></span>
<input type="hidden" data-table="findingshortpick" data-field="x_ctn" data-hidden="1" name="x_ctn" id="x_ctn" value="<?= HtmlEncode($Page->ctn->CurrentValue) ?>">
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <div id="r_article"<?= $Page->article->rowAttributes() ?>>
        <label id="elh_findingshortpick_article" for="x_article" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_findingshortpick_article"><?= $Page->article->caption() ?><?= $Page->article->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->article->cellAttributes() ?>>
<template id="tpx_findingshortpick_article"><span id="el_findingshortpick_article">
<span<?= $Page->article->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->article->getDisplayValue($Page->article->EditValue))) ?>"></span>
<input type="hidden" data-table="findingshortpick" data-field="x_article" data-hidden="1" name="x_article" id="x_article" value="<?= HtmlEncode($Page->article->CurrentValue) ?>">
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_findingshortpick_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_findingshortpick_description"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<template id="tpx_findingshortpick_description"><span id="el_findingshortpick_description">
<span<?= $Page->description->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->description->getDisplayValue($Page->description->EditValue))) ?>"></span>
<input type="hidden" data-table="findingshortpick" data-field="x_description" data-hidden="1" name="x_description" id="x_description" value="<?= HtmlEncode($Page->description->CurrentValue) ?>">
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->actual->Visible) { // actual ?>
    <div id="r_actual"<?= $Page->actual->rowAttributes() ?>>
        <label id="elh_findingshortpick_actual" for="x_actual" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_findingshortpick_actual"><?= $Page->actual->caption() ?><?= $Page->actual->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->actual->cellAttributes() ?>>
<template id="tpx_findingshortpick_actual"><span id="el_findingshortpick_actual">
<input type="<?= $Page->actual->getInputTextType() ?>" name="x_actual" id="x_actual" data-table="findingshortpick" data-field="x_actual" value="<?= $Page->actual->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->actual->getPlaceHolder()) ?>"<?= $Page->actual->editAttributes() ?> aria-describedby="x_actual_help">
<?= $Page->actual->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->actual->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->target_quantity->Visible) { // target_quantity ?>
    <div id="r_target_quantity"<?= $Page->target_quantity->rowAttributes() ?>>
        <label id="elh_findingshortpick_target_quantity" for="x_target_quantity" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_findingshortpick_target_quantity"><?= $Page->target_quantity->caption() ?><?= $Page->target_quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->target_quantity->cellAttributes() ?>>
<template id="tpx_findingshortpick_target_quantity"><span id="el_findingshortpick_target_quantity">
<span<?= $Page->target_quantity->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->target_quantity->getDisplayValue($Page->target_quantity->EditValue))) ?>"></span>
<input type="hidden" data-table="findingshortpick" data-field="x_target_quantity" data-hidden="1" name="x_target_quantity" id="x_target_quantity" value="<?= HtmlEncode($Page->target_quantity->CurrentValue) ?>">
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pick_quantity->Visible) { // pick_quantity ?>
    <div id="r_pick_quantity"<?= $Page->pick_quantity->rowAttributes() ?>>
        <label id="elh_findingshortpick_pick_quantity" for="x_pick_quantity" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_findingshortpick_pick_quantity"><?= $Page->pick_quantity->caption() ?><?= $Page->pick_quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pick_quantity->cellAttributes() ?>>
<template id="tpx_findingshortpick_pick_quantity"><span id="el_findingshortpick_pick_quantity">
<input type="<?= $Page->pick_quantity->getInputTextType() ?>" name="x_pick_quantity" id="x_pick_quantity" data-table="findingshortpick" data-field="x_pick_quantity" value="<?= $Page->pick_quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->pick_quantity->getPlaceHolder()) ?>"<?= $Page->pick_quantity->editAttributes() ?> aria-describedby="x_pick_quantity_help">
<?= $Page->pick_quantity->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pick_quantity->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->shortpick->Visible) { // shortpick ?>
    <div id="r_shortpick"<?= $Page->shortpick->rowAttributes() ?>>
        <label id="elh_findingshortpick_shortpick" for="x_shortpick" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_findingshortpick_shortpick"><?= $Page->shortpick->caption() ?><?= $Page->shortpick->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->shortpick->cellAttributes() ?>>
<template id="tpx_findingshortpick_shortpick"><span id="el_findingshortpick_shortpick">
<span<?= $Page->shortpick->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->shortpick->getDisplayValue($Page->shortpick->EditValue))) ?>"></span>
<input type="hidden" data-table="findingshortpick" data-field="x_shortpick" data-hidden="1" name="x_shortpick" id="x_shortpick" value="<?= HtmlEncode($Page->shortpick->CurrentValue) ?>">
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
    <div id="r_user"<?= $Page->user->rowAttributes() ?>>
        <label id="elh_findingshortpick_user" for="x_user" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_findingshortpick_user"><?= $Page->user->caption() ?><?= $Page->user->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->user->cellAttributes() ?>>
<template id="tpx_findingshortpick_user"><span id="el_findingshortpick_user">
<input type="<?= $Page->user->getInputTextType() ?>" name="x_user" id="x_user" data-table="findingshortpick" data-field="x_user" value="<?= $Page->user->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->user->getPlaceHolder()) ?>"<?= $Page->user->editAttributes() ?> aria-describedby="x_user_help">
<?= $Page->user->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->user->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->area->Visible) { // area ?>
    <div id="r_area"<?= $Page->area->rowAttributes() ?>>
        <label id="elh_findingshortpick_area" for="x_area" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_findingshortpick_area"><?= $Page->area->caption() ?><?= $Page->area->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->area->cellAttributes() ?>>
<template id="tpx_findingshortpick_area"><span id="el_findingshortpick_area">
<input type="<?= $Page->area->getInputTextType() ?>" name="x_area" id="x_area" data-table="findingshortpick" data-field="x_area" value="<?= $Page->area->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->area->getPlaceHolder()) ?>"<?= $Page->area->editAttributes() ?> aria-describedby="x_area_help">
<?= $Page->area->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->area->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_findingshortpick_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_findingshortpick_status"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<template id="tpx_findingshortpick_status"><span id="el_findingshortpick_status">
<input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="findingshortpick" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
    <div id="r_date_upload"<?= $Page->date_upload->rowAttributes() ?>>
        <label id="elh_findingshortpick_date_upload" for="x_date_upload" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_findingshortpick_date_upload"><?= $Page->date_upload->caption() ?><?= $Page->date_upload->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_upload->cellAttributes() ?>>
<template id="tpx_findingshortpick_date_upload"><span id="el_findingshortpick_date_upload">
<input type="<?= $Page->date_upload->getInputTextType() ?>" name="x_date_upload" id="x_date_upload" data-table="findingshortpick" data-field="x_date_upload" value="<?= $Page->date_upload->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_upload->getPlaceHolder()) ?>"<?= $Page->date_upload->editAttributes() ?> aria-describedby="x_date_upload_help">
<?= $Page->date_upload->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_upload->getErrorMessage() ?></div>
<?php if (!$Page->date_upload->ReadOnly && !$Page->date_upload->Disabled && !isset($Page->date_upload->EditAttrs["readonly"]) && !isset($Page->date_upload->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffindingshortpickedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ffindingshortpickedit", "x_date_upload", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->total_shortpick->Visible) { // total_shortpick ?>
    <div id="r_total_shortpick"<?= $Page->total_shortpick->rowAttributes() ?>>
        <label id="elh_findingshortpick_total_shortpick" for="x_total_shortpick" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_findingshortpick_total_shortpick"><?= $Page->total_shortpick->caption() ?><?= $Page->total_shortpick->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->total_shortpick->cellAttributes() ?>>
<template id="tpx_findingshortpick_total_shortpick"><span id="el_findingshortpick_total_shortpick">
<input type="<?= $Page->total_shortpick->getInputTextType() ?>" name="x_total_shortpick" id="x_total_shortpick" data-table="findingshortpick" data-field="x_total_shortpick" value="<?= $Page->total_shortpick->EditValue ?>" maxlength="7" placeholder="<?= HtmlEncode($Page->total_shortpick->getPlaceHolder()) ?>"<?= $Page->total_shortpick->editAttributes() ?> aria-describedby="x_total_shortpick_help">
<?= $Page->total_shortpick->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->total_shortpick->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->short_article->Visible) { // short_article ?>
    <div id="r_short_article"<?= $Page->short_article->rowAttributes() ?>>
        <label id="elh_findingshortpick_short_article" for="x_short_article" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_findingshortpick_short_article"><?= $Page->short_article->caption() ?><?= $Page->short_article->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->short_article->cellAttributes() ?>>
<template id="tpx_findingshortpick_short_article"><span id="el_findingshortpick_short_article">
<input type="<?= $Page->short_article->getInputTextType() ?>" name="x_short_article" id="x_short_article" data-table="findingshortpick" data-field="x_short_article" value="<?= $Page->short_article->EditValue ?>" size="30" maxlength="7" placeholder="<?= HtmlEncode($Page->short_article->getPlaceHolder()) ?>"<?= $Page->short_article->editAttributes() ?> aria-describedby="x_short_article_help">
<?= $Page->short_article->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->short_article->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
    <div id="r_total"<?= $Page->total->rowAttributes() ?>>
        <label id="elh_findingshortpick_total" for="x_total" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_findingshortpick_total"><?= $Page->total->caption() ?><?= $Page->total->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->total->cellAttributes() ?>>
<template id="tpx_findingshortpick_total"><span id="el_findingshortpick_total">
<input type="<?= $Page->total->getInputTextType() ?>" name="x_total" id="x_total" data-table="findingshortpick" data-field="x_total" value="<?= $Page->total->EditValue ?>" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->total->getPlaceHolder()) ?>"<?= $Page->total->editAttributes() ?> aria-describedby="x_total_help">
<?= $Page->total->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->total->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->excess->Visible) { // excess ?>
    <div id="r_excess"<?= $Page->excess->rowAttributes() ?>>
        <label id="elh_findingshortpick_excess" for="x_excess" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_findingshortpick_excess"><?= $Page->excess->caption() ?><?= $Page->excess->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->excess->cellAttributes() ?>>
<template id="tpx_findingshortpick_excess"><span id="el_findingshortpick_excess">
<input type="<?= $Page->excess->getInputTextType() ?>" name="x_excess" id="x_excess" data-table="findingshortpick" data-field="x_excess" value="<?= $Page->excess->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->excess->getPlaceHolder()) ?>"<?= $Page->excess->editAttributes() ?> aria-describedby="x_excess_help">
<?= $Page->excess->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->excess->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_findingshortpickedit" class="ew-custom-template"></div>
<template id="tpm_findingshortpickedit">
<div id="ct_FindingshortpickEdit"><script type="text/javascript">
</script>
<script type="text/javascript">

		function skip2() {
			$("#x_actual").val("");
			$("#x_pick_quantity").val("0");
			$("#x_excess").val("0");
			$("#btn-action").focus();
		};		
        $('body').on('keydown', 'input, select', function(e) { // ganti enter jadi tab di setiap input
            if (e.key === "Enter") {
                var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
                focusable = form.find('input,a,select,textarea,button').filter(":input:not([readonly])",".formbuilder-item");
                next = focusable.eq(focusable.index(this)+1);
                if (next.length) {
                    next.focus();
                } else {
                    form.submit(function (){
                    //window.location = 'http://localhost/opsvaliram/auditstagingedit?start=1';
                    return false;
                });
                }
                return false;
            }
        });
       $("#x_pick_quantity").change(function () {
            $("#x_pick_quantity").css({ color: 'green'}); // warna text
            $("#x_pick_quantity").blur();
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
    .select2-results__options{
    	list-style-position: outside !important;
    }
</style>
<div class="main-form" >
    <div class="card2">
        <div class="card-body">    
            <div id="r_short_article" class="formbuilder-item"  >
                 <label for="x_short_article" class="col-sm-2 col-form-label"><?= $Page->short_article->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_findingshortpick_short_article"></slot></div>
            </div>
            <div id="r_total_shortpick" class="formbuilder-item"  >
                 <label for="x_total_shortpick" class="col-sm-2 col-form-label"><?= $Page->total->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_findingshortpick_total"></slot></div>
            </div>
        </div>
    </div>
</div>
<hr class="hr hr-blurry" />
<div class="main-form" >
    <div class="card">
        <div class="card-body">    
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_findingshortpick_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_findingshortpick_id"></slot></h2>
            </div>
            <div id="r_date_upload" class="formbuilder-item" hidden >
                 <label for="x_date_upload" class="col-sm-2 col-form-label"><?= $Page->date_upload->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_findingshortpick_date_upload"></slot></div>
            </div>
            <div id="r_location" class="formbuilder-item">
                 <label for="x_source_location" class="col-sm-2 col-form-label"><?= $Page->location->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_findingshortpick_location"></slot></div>
            </div>
            <div id="r_ctn" class="formbuilder-item">
                 <label for="x_ctn" class="col-sm-2 col-form-label"><?= $Page->ctn->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_findingshortpick_ctn"></slot></div>
            </div>
            <div id="r_article" class="formbuilder-item">
                 <label for="x_scan_location" class="col-sm-2 col-form-label"><?= $Page->article->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_findingshortpick_article"></slot></div>
            </div>
            <div id="r_description" class="formbuilder-item">
                 <label for="x_article" class="col-sm-2 col-form-label"><?= $Page->description->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_findingshortpick_description"></slot></div>
            </div>
            <div id="r_target_quantity" class="formbuilder-item" hidden>
                 <label for="x_scan_article" class="col-sm-2 col-form-label"><?= $Page->target_quantity->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_findingshortpick_target_quantity"></slot></div>
            </div>
            <div id="r_shortpick" class="formbuilder-item">
                 <label for="x_shortpick" class="col-sm-2 col-form-label"><?= $Page->shortpick->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_findingshortpick_shortpick"></slot></div>
            </div>
            <div id="r_actual" class="formbuilder-item" autofocus>
                 <label for="x_actual" class="col-sm-2 col-form-label"><?= $Page->actual->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_findingshortpick_actual"></slot></div>
            </div>
            <div id="r_pick_quantity" class="formbuilder-item">
                 <label for="x_destination_location" class="col-sm-2 col-form-label"><?= $Page->pick_quantity->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_findingshortpick_pick_quantity"></slot></div>
            </div>
            <div id="r_excess" class="formbuilder-item">
                 <label for="x_excess" class="col-sm-2 col-form-label"><?= $Page->excess->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_findingshortpick_excess"></slot></div>
            </div>
            <div id="r_date_picking" class="formbuilder-item" hidden>
                 <label for="x_date_picking" class="col-sm-2 col-form-label"><?= $Page->date_picking->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_findingshortpick_date_picking"></slot></div>
            </div>
            <div id="r_area" class="formbuilder-item" hidden>
                <label for="x_area" class="col-sm-2 col-form-label"><?= $Page->area->caption() ?></label>
                <div class="col-sm-10"><slot class="ew-slot" name="tpx_findingshortpick_area"></slot></div>
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
    ew.applyTemplate("tpd_findingshortpickedit", "tpm_findingshortpickedit", "findingshortpickedit", "<?= $Page->CustomExport ?>", ew.templateData.rows[0]);
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
    ew.addEventHandlers("findingshortpick");
});
</script>
<script>
loadjs.ready("load", function () {
    // Startup script
    // Write your table-specific startup script here, no need to add script tags.
    $(document).ready(function() {
        		$("#btn-action").after('<button class="btn btn-danger ew-btn" name="btn-action" id="btn-action" type="button" onclick="skip2()">Skip</button>');	
        		$(document).on('focus','input[type=text]',function(){ this.select(); });
        		$("#x_actual").focus();
                $("#x_actual").change(function () {
                    actual =$("#x_actual").val();
                    target =$("#x_target_quantity").val();
                    excess =$("#x_excess").val();
                    pick = $("#x_pick_quantity").val();
                    total = $("#x_total").val();
                    excess = (actual - target);
                    $("#x_excess").val(excess);
                    if (actual > target){
                    	$("#x_pick_quantity").val('0');
                        alert("Excess = " + excess);
                        $("#x_pick_quantity").focus();
                    }
                    if (actual < target){
                    	$("#x_pick_quantity").val('0');
                        alert("Excess = " + excess);
                        $("#x_pick_quantity").focus();
                    }
                    if (actual == target) {
                        $("#x_pick_quantity").val('0');
                        alert("Match");
                        $("#btn-action").focus();
                        }
                });
                $("#x_pick_quantity").change(function () {
                    actual =$("#x_actual").val();
                    target =$("#x_target_quantity").val();
                    excess =$("#x_excess").val();
                    pick = $("#x_pick_quantity").val();
                    total = $("#x_total").val();
                    excess =$("#x_excess").val((actual - target)- pick);
                });
        });
});
</script>
