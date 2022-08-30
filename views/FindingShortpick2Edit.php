<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$FindingShortpick2Edit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { finding_shortpick2: currentTable } });
var currentForm, currentPageID;
var ffinding_shortpick2edit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ffinding_shortpick2edit = new ew.Form("ffinding_shortpick2edit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = ffinding_shortpick2edit;

    // Add fields
    var fields = currentTable.fields;
    ffinding_shortpick2edit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["location", [fields.location.visible && fields.location.required ? ew.Validators.required(fields.location.caption) : null], fields.location.isInvalid],
        ["ctn", [fields.ctn.visible && fields.ctn.required ? ew.Validators.required(fields.ctn.caption) : null], fields.ctn.isInvalid],
        ["article", [fields.article.visible && fields.article.required ? ew.Validators.required(fields.article.caption) : null], fields.article.isInvalid],
        ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
        ["avaiable", [fields.avaiable.visible && fields.avaiable.required ? ew.Validators.required(fields.avaiable.caption) : null, ew.Validators.integer], fields.avaiable.isInvalid],
        ["web", [fields.web.visible && fields.web.required ? ew.Validators.required(fields.web.caption) : null, ew.Validators.integer], fields.web.isInvalid],
        ["target_quantity", [fields.target_quantity.visible && fields.target_quantity.required ? ew.Validators.required(fields.target_quantity.caption) : null, ew.Validators.integer], fields.target_quantity.isInvalid],
        ["shortpick", [fields.shortpick.visible && fields.shortpick.required ? ew.Validators.required(fields.shortpick.caption) : null, ew.Validators.integer], fields.shortpick.isInvalid],
        ["actual", [fields.actual.visible && fields.actual.required ? ew.Validators.required(fields.actual.caption) : null, ew.Validators.integer], fields.actual.isInvalid],
        ["pick_quantity", [fields.pick_quantity.visible && fields.pick_quantity.required ? ew.Validators.required(fields.pick_quantity.caption) : null, ew.Validators.integer], fields.pick_quantity.isInvalid],
        ["excess", [fields.excess.visible && fields.excess.required ? ew.Validators.required(fields.excess.caption) : null, ew.Validators.integer], fields.excess.isInvalid],
        ["user", [fields.user.visible && fields.user.required ? ew.Validators.required(fields.user.caption) : null], fields.user.isInvalid],
        ["area", [fields.area.visible && fields.area.required ? ew.Validators.required(fields.area.caption) : null], fields.area.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["date_shortpick", [fields.date_shortpick.visible && fields.date_shortpick.required ? ew.Validators.required(fields.date_shortpick.caption) : null, ew.Validators.datetime(fields.date_shortpick.clientFormatPattern)], fields.date_shortpick.isInvalid],
        ["date_upload", [fields.date_upload.visible && fields.date_upload.required ? ew.Validators.required(fields.date_upload.caption) : null, ew.Validators.datetime(fields.date_upload.clientFormatPattern)], fields.date_upload.isInvalid],
        ["date_picking", [fields.date_picking.visible && fields.date_picking.required ? ew.Validators.required(fields.date_picking.caption) : null, ew.Validators.datetime(fields.date_picking.clientFormatPattern)], fields.date_picking.isInvalid],
        ["time_picking", [fields.time_picking.visible && fields.time_picking.required ? ew.Validators.required(fields.time_picking.caption) : null, ew.Validators.datetime(fields.time_picking.clientFormatPattern)], fields.time_picking.isInvalid]
    ]);

    // Form_CustomValidate
    ffinding_shortpick2edit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ffinding_shortpick2edit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("ffinding_shortpick2edit");
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
<?php if (!$Page->IsModal) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<form name="ffinding_shortpick2edit" id="ffinding_shortpick2edit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="finding_shortpick2">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_finding_shortpick2_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_finding_shortpick2_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="finding_shortpick2" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
    <div id="r_location"<?= $Page->location->rowAttributes() ?>>
        <label id="elh_finding_shortpick2_location" for="x_location" class="<?= $Page->LeftColumnClass ?>"><?= $Page->location->caption() ?><?= $Page->location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->location->cellAttributes() ?>>
<span id="el_finding_shortpick2_location">
<input type="<?= $Page->location->getInputTextType() ?>" name="x_location" id="x_location" data-table="finding_shortpick2" data-field="x_location" value="<?= $Page->location->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->location->getPlaceHolder()) ?>"<?= $Page->location->editAttributes() ?> aria-describedby="x_location_help">
<?= $Page->location->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
    <div id="r_ctn"<?= $Page->ctn->rowAttributes() ?>>
        <label id="elh_finding_shortpick2_ctn" for="x_ctn" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ctn->caption() ?><?= $Page->ctn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ctn->cellAttributes() ?>>
<span id="el_finding_shortpick2_ctn">
<input type="<?= $Page->ctn->getInputTextType() ?>" name="x_ctn" id="x_ctn" data-table="finding_shortpick2" data-field="x_ctn" value="<?= $Page->ctn->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->ctn->getPlaceHolder()) ?>"<?= $Page->ctn->editAttributes() ?> aria-describedby="x_ctn_help">
<?= $Page->ctn->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ctn->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <div id="r_article"<?= $Page->article->rowAttributes() ?>>
        <label id="elh_finding_shortpick2_article" for="x_article" class="<?= $Page->LeftColumnClass ?>"><?= $Page->article->caption() ?><?= $Page->article->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->article->cellAttributes() ?>>
<span id="el_finding_shortpick2_article">
<input type="<?= $Page->article->getInputTextType() ?>" name="x_article" id="x_article" data-table="finding_shortpick2" data-field="x_article" value="<?= $Page->article->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->article->getPlaceHolder()) ?>"<?= $Page->article->editAttributes() ?> aria-describedby="x_article_help">
<?= $Page->article->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->article->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_finding_shortpick2_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_finding_shortpick2_description">
<input type="<?= $Page->description->getInputTextType() ?>" name="x_description" id="x_description" data-table="finding_shortpick2" data-field="x_description" value="<?= $Page->description->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help">
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->avaiable->Visible) { // avaiable ?>
    <div id="r_avaiable"<?= $Page->avaiable->rowAttributes() ?>>
        <label id="elh_finding_shortpick2_avaiable" for="x_avaiable" class="<?= $Page->LeftColumnClass ?>"><?= $Page->avaiable->caption() ?><?= $Page->avaiable->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->avaiable->cellAttributes() ?>>
<span id="el_finding_shortpick2_avaiable">
<input type="<?= $Page->avaiable->getInputTextType() ?>" name="x_avaiable" id="x_avaiable" data-table="finding_shortpick2" data-field="x_avaiable" value="<?= $Page->avaiable->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->avaiable->getPlaceHolder()) ?>"<?= $Page->avaiable->editAttributes() ?> aria-describedby="x_avaiable_help">
<?= $Page->avaiable->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->avaiable->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->web->Visible) { // web ?>
    <div id="r_web"<?= $Page->web->rowAttributes() ?>>
        <label id="elh_finding_shortpick2_web" for="x_web" class="<?= $Page->LeftColumnClass ?>"><?= $Page->web->caption() ?><?= $Page->web->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->web->cellAttributes() ?>>
<span id="el_finding_shortpick2_web">
<input type="<?= $Page->web->getInputTextType() ?>" name="x_web" id="x_web" data-table="finding_shortpick2" data-field="x_web" value="<?= $Page->web->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->web->getPlaceHolder()) ?>"<?= $Page->web->editAttributes() ?> aria-describedby="x_web_help">
<?= $Page->web->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->web->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->target_quantity->Visible) { // target_quantity ?>
    <div id="r_target_quantity"<?= $Page->target_quantity->rowAttributes() ?>>
        <label id="elh_finding_shortpick2_target_quantity" for="x_target_quantity" class="<?= $Page->LeftColumnClass ?>"><?= $Page->target_quantity->caption() ?><?= $Page->target_quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->target_quantity->cellAttributes() ?>>
<span id="el_finding_shortpick2_target_quantity">
<input type="<?= $Page->target_quantity->getInputTextType() ?>" name="x_target_quantity" id="x_target_quantity" data-table="finding_shortpick2" data-field="x_target_quantity" value="<?= $Page->target_quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->target_quantity->getPlaceHolder()) ?>"<?= $Page->target_quantity->editAttributes() ?> aria-describedby="x_target_quantity_help">
<?= $Page->target_quantity->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->target_quantity->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->shortpick->Visible) { // shortpick ?>
    <div id="r_shortpick"<?= $Page->shortpick->rowAttributes() ?>>
        <label id="elh_finding_shortpick2_shortpick" for="x_shortpick" class="<?= $Page->LeftColumnClass ?>"><?= $Page->shortpick->caption() ?><?= $Page->shortpick->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->shortpick->cellAttributes() ?>>
<span id="el_finding_shortpick2_shortpick">
<input type="<?= $Page->shortpick->getInputTextType() ?>" name="x_shortpick" id="x_shortpick" data-table="finding_shortpick2" data-field="x_shortpick" value="<?= $Page->shortpick->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->shortpick->getPlaceHolder()) ?>"<?= $Page->shortpick->editAttributes() ?> aria-describedby="x_shortpick_help">
<?= $Page->shortpick->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->shortpick->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->actual->Visible) { // actual ?>
    <div id="r_actual"<?= $Page->actual->rowAttributes() ?>>
        <label id="elh_finding_shortpick2_actual" for="x_actual" class="<?= $Page->LeftColumnClass ?>"><?= $Page->actual->caption() ?><?= $Page->actual->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->actual->cellAttributes() ?>>
<span id="el_finding_shortpick2_actual">
<input type="<?= $Page->actual->getInputTextType() ?>" name="x_actual" id="x_actual" data-table="finding_shortpick2" data-field="x_actual" value="<?= $Page->actual->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->actual->getPlaceHolder()) ?>"<?= $Page->actual->editAttributes() ?> aria-describedby="x_actual_help">
<?= $Page->actual->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->actual->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pick_quantity->Visible) { // pick_quantity ?>
    <div id="r_pick_quantity"<?= $Page->pick_quantity->rowAttributes() ?>>
        <label id="elh_finding_shortpick2_pick_quantity" for="x_pick_quantity" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pick_quantity->caption() ?><?= $Page->pick_quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pick_quantity->cellAttributes() ?>>
<span id="el_finding_shortpick2_pick_quantity">
<input type="<?= $Page->pick_quantity->getInputTextType() ?>" name="x_pick_quantity" id="x_pick_quantity" data-table="finding_shortpick2" data-field="x_pick_quantity" value="<?= $Page->pick_quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->pick_quantity->getPlaceHolder()) ?>"<?= $Page->pick_quantity->editAttributes() ?> aria-describedby="x_pick_quantity_help">
<?= $Page->pick_quantity->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pick_quantity->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->excess->Visible) { // excess ?>
    <div id="r_excess"<?= $Page->excess->rowAttributes() ?>>
        <label id="elh_finding_shortpick2_excess" for="x_excess" class="<?= $Page->LeftColumnClass ?>"><?= $Page->excess->caption() ?><?= $Page->excess->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->excess->cellAttributes() ?>>
<span id="el_finding_shortpick2_excess">
<input type="<?= $Page->excess->getInputTextType() ?>" name="x_excess" id="x_excess" data-table="finding_shortpick2" data-field="x_excess" value="<?= $Page->excess->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->excess->getPlaceHolder()) ?>"<?= $Page->excess->editAttributes() ?> aria-describedby="x_excess_help">
<?= $Page->excess->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->excess->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
    <div id="r_user"<?= $Page->user->rowAttributes() ?>>
        <label id="elh_finding_shortpick2_user" for="x_user" class="<?= $Page->LeftColumnClass ?>"><?= $Page->user->caption() ?><?= $Page->user->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->user->cellAttributes() ?>>
<span id="el_finding_shortpick2_user">
<input type="<?= $Page->user->getInputTextType() ?>" name="x_user" id="x_user" data-table="finding_shortpick2" data-field="x_user" value="<?= $Page->user->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->user->getPlaceHolder()) ?>"<?= $Page->user->editAttributes() ?> aria-describedby="x_user_help">
<?= $Page->user->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->user->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->area->Visible) { // area ?>
    <div id="r_area"<?= $Page->area->rowAttributes() ?>>
        <label id="elh_finding_shortpick2_area" for="x_area" class="<?= $Page->LeftColumnClass ?>"><?= $Page->area->caption() ?><?= $Page->area->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->area->cellAttributes() ?>>
<span id="el_finding_shortpick2_area">
<input type="<?= $Page->area->getInputTextType() ?>" name="x_area" id="x_area" data-table="finding_shortpick2" data-field="x_area" value="<?= $Page->area->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->area->getPlaceHolder()) ?>"<?= $Page->area->editAttributes() ?> aria-describedby="x_area_help">
<?= $Page->area->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->area->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_finding_shortpick2_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_finding_shortpick2_status">
<input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="finding_shortpick2" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_shortpick->Visible) { // date_shortpick ?>
    <div id="r_date_shortpick"<?= $Page->date_shortpick->rowAttributes() ?>>
        <label id="elh_finding_shortpick2_date_shortpick" for="x_date_shortpick" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_shortpick->caption() ?><?= $Page->date_shortpick->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_shortpick->cellAttributes() ?>>
<span id="el_finding_shortpick2_date_shortpick">
<input type="<?= $Page->date_shortpick->getInputTextType() ?>" name="x_date_shortpick" id="x_date_shortpick" data-table="finding_shortpick2" data-field="x_date_shortpick" value="<?= $Page->date_shortpick->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_shortpick->getPlaceHolder()) ?>"<?= $Page->date_shortpick->editAttributes() ?> aria-describedby="x_date_shortpick_help">
<?= $Page->date_shortpick->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_shortpick->getErrorMessage() ?></div>
<?php if (!$Page->date_shortpick->ReadOnly && !$Page->date_shortpick->Disabled && !isset($Page->date_shortpick->EditAttrs["readonly"]) && !isset($Page->date_shortpick->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffinding_shortpick2edit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ffinding_shortpick2edit", "x_date_shortpick", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
    <div id="r_date_upload"<?= $Page->date_upload->rowAttributes() ?>>
        <label id="elh_finding_shortpick2_date_upload" for="x_date_upload" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_upload->caption() ?><?= $Page->date_upload->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_upload->cellAttributes() ?>>
<span id="el_finding_shortpick2_date_upload">
<input type="<?= $Page->date_upload->getInputTextType() ?>" name="x_date_upload" id="x_date_upload" data-table="finding_shortpick2" data-field="x_date_upload" value="<?= $Page->date_upload->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_upload->getPlaceHolder()) ?>"<?= $Page->date_upload->editAttributes() ?> aria-describedby="x_date_upload_help">
<?= $Page->date_upload->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_upload->getErrorMessage() ?></div>
<?php if (!$Page->date_upload->ReadOnly && !$Page->date_upload->Disabled && !isset($Page->date_upload->EditAttrs["readonly"]) && !isset($Page->date_upload->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffinding_shortpick2edit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ffinding_shortpick2edit", "x_date_upload", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_picking->Visible) { // date_picking ?>
    <div id="r_date_picking"<?= $Page->date_picking->rowAttributes() ?>>
        <label id="elh_finding_shortpick2_date_picking" for="x_date_picking" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_picking->caption() ?><?= $Page->date_picking->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_picking->cellAttributes() ?>>
<span id="el_finding_shortpick2_date_picking">
<input type="<?= $Page->date_picking->getInputTextType() ?>" name="x_date_picking" id="x_date_picking" data-table="finding_shortpick2" data-field="x_date_picking" value="<?= $Page->date_picking->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_picking->getPlaceHolder()) ?>"<?= $Page->date_picking->editAttributes() ?> aria-describedby="x_date_picking_help">
<?= $Page->date_picking->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_picking->getErrorMessage() ?></div>
<?php if (!$Page->date_picking->ReadOnly && !$Page->date_picking->Disabled && !isset($Page->date_picking->EditAttrs["readonly"]) && !isset($Page->date_picking->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffinding_shortpick2edit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ffinding_shortpick2edit", "x_date_picking", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->time_picking->Visible) { // time_picking ?>
    <div id="r_time_picking"<?= $Page->time_picking->rowAttributes() ?>>
        <label id="elh_finding_shortpick2_time_picking" for="x_time_picking" class="<?= $Page->LeftColumnClass ?>"><?= $Page->time_picking->caption() ?><?= $Page->time_picking->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->time_picking->cellAttributes() ?>>
<span id="el_finding_shortpick2_time_picking">
<input type="<?= $Page->time_picking->getInputTextType() ?>" name="x_time_picking" id="x_time_picking" data-table="finding_shortpick2" data-field="x_time_picking" value="<?= $Page->time_picking->EditValue ?>" placeholder="<?= HtmlEncode($Page->time_picking->getPlaceHolder()) ?>"<?= $Page->time_picking->editAttributes() ?> aria-describedby="x_time_picking_help">
<?= $Page->time_picking->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->time_picking->getErrorMessage() ?></div>
<?php if (!$Page->time_picking->ReadOnly && !$Page->time_picking->Disabled && !isset($Page->time_picking->EditAttrs["readonly"]) && !isset($Page->time_picking->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffinding_shortpick2edit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ffinding_shortpick2edit", "x_time_picking", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
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
    ew.addEventHandlers("finding_shortpick2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
