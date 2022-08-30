<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$FindingShortpickAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { finding_shortpick: currentTable } });
var currentForm, currentPageID;
var ffinding_shortpickadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ffinding_shortpickadd = new ew.Form("ffinding_shortpickadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = ffinding_shortpickadd;

    // Add fields
    var fields = currentTable.fields;
    ffinding_shortpickadd.addFields([
        ["location", [fields.location.visible && fields.location.required ? ew.Validators.required(fields.location.caption) : null], fields.location.isInvalid],
        ["article", [fields.article.visible && fields.article.required ? ew.Validators.required(fields.article.caption) : null], fields.article.isInvalid],
        ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
        ["target_quantity", [fields.target_quantity.visible && fields.target_quantity.required ? ew.Validators.required(fields.target_quantity.caption) : null, ew.Validators.integer], fields.target_quantity.isInvalid],
        ["pick_quantity", [fields.pick_quantity.visible && fields.pick_quantity.required ? ew.Validators.required(fields.pick_quantity.caption) : null, ew.Validators.integer], fields.pick_quantity.isInvalid],
        ["shortpick", [fields.shortpick.visible && fields.shortpick.required ? ew.Validators.required(fields.shortpick.caption) : null, ew.Validators.integer], fields.shortpick.isInvalid],
        ["user", [fields.user.visible && fields.user.required ? ew.Validators.required(fields.user.caption) : null], fields.user.isInvalid],
        ["area", [fields.area.visible && fields.area.required ? ew.Validators.required(fields.area.caption) : null], fields.area.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["date_upload", [fields.date_upload.visible && fields.date_upload.required ? ew.Validators.required(fields.date_upload.caption) : null, ew.Validators.datetime(fields.date_upload.clientFormatPattern)], fields.date_upload.isInvalid],
        ["date_picking", [fields.date_picking.visible && fields.date_picking.required ? ew.Validators.required(fields.date_picking.caption) : null, ew.Validators.datetime(fields.date_picking.clientFormatPattern)], fields.date_picking.isInvalid]
    ]);

    // Form_CustomValidate
    ffinding_shortpickadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ffinding_shortpickadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("ffinding_shortpickadd");
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
<form name="ffinding_shortpickadd" id="ffinding_shortpickadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="finding_shortpick">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->location->Visible) { // location ?>
    <div id="r_location"<?= $Page->location->rowAttributes() ?>>
        <label id="elh_finding_shortpick_location" for="x_location" class="<?= $Page->LeftColumnClass ?>"><?= $Page->location->caption() ?><?= $Page->location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->location->cellAttributes() ?>>
<span id="el_finding_shortpick_location">
<input type="<?= $Page->location->getInputTextType() ?>" name="x_location" id="x_location" data-table="finding_shortpick" data-field="x_location" value="<?= $Page->location->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->location->getPlaceHolder()) ?>"<?= $Page->location->editAttributes() ?> aria-describedby="x_location_help">
<?= $Page->location->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <div id="r_article"<?= $Page->article->rowAttributes() ?>>
        <label id="elh_finding_shortpick_article" for="x_article" class="<?= $Page->LeftColumnClass ?>"><?= $Page->article->caption() ?><?= $Page->article->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->article->cellAttributes() ?>>
<span id="el_finding_shortpick_article">
<input type="<?= $Page->article->getInputTextType() ?>" name="x_article" id="x_article" data-table="finding_shortpick" data-field="x_article" value="<?= $Page->article->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->article->getPlaceHolder()) ?>"<?= $Page->article->editAttributes() ?> aria-describedby="x_article_help">
<?= $Page->article->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->article->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_finding_shortpick_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_finding_shortpick_description">
<input type="<?= $Page->description->getInputTextType() ?>" name="x_description" id="x_description" data-table="finding_shortpick" data-field="x_description" value="<?= $Page->description->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help">
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->target_quantity->Visible) { // target_quantity ?>
    <div id="r_target_quantity"<?= $Page->target_quantity->rowAttributes() ?>>
        <label id="elh_finding_shortpick_target_quantity" for="x_target_quantity" class="<?= $Page->LeftColumnClass ?>"><?= $Page->target_quantity->caption() ?><?= $Page->target_quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->target_quantity->cellAttributes() ?>>
<span id="el_finding_shortpick_target_quantity">
<input type="<?= $Page->target_quantity->getInputTextType() ?>" name="x_target_quantity" id="x_target_quantity" data-table="finding_shortpick" data-field="x_target_quantity" value="<?= $Page->target_quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->target_quantity->getPlaceHolder()) ?>"<?= $Page->target_quantity->editAttributes() ?> aria-describedby="x_target_quantity_help">
<?= $Page->target_quantity->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->target_quantity->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pick_quantity->Visible) { // pick_quantity ?>
    <div id="r_pick_quantity"<?= $Page->pick_quantity->rowAttributes() ?>>
        <label id="elh_finding_shortpick_pick_quantity" for="x_pick_quantity" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pick_quantity->caption() ?><?= $Page->pick_quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pick_quantity->cellAttributes() ?>>
<span id="el_finding_shortpick_pick_quantity">
<input type="<?= $Page->pick_quantity->getInputTextType() ?>" name="x_pick_quantity" id="x_pick_quantity" data-table="finding_shortpick" data-field="x_pick_quantity" value="<?= $Page->pick_quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->pick_quantity->getPlaceHolder()) ?>"<?= $Page->pick_quantity->editAttributes() ?> aria-describedby="x_pick_quantity_help">
<?= $Page->pick_quantity->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pick_quantity->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->shortpick->Visible) { // shortpick ?>
    <div id="r_shortpick"<?= $Page->shortpick->rowAttributes() ?>>
        <label id="elh_finding_shortpick_shortpick" for="x_shortpick" class="<?= $Page->LeftColumnClass ?>"><?= $Page->shortpick->caption() ?><?= $Page->shortpick->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->shortpick->cellAttributes() ?>>
<span id="el_finding_shortpick_shortpick">
<input type="<?= $Page->shortpick->getInputTextType() ?>" name="x_shortpick" id="x_shortpick" data-table="finding_shortpick" data-field="x_shortpick" value="<?= $Page->shortpick->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->shortpick->getPlaceHolder()) ?>"<?= $Page->shortpick->editAttributes() ?> aria-describedby="x_shortpick_help">
<?= $Page->shortpick->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->shortpick->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
    <div id="r_user"<?= $Page->user->rowAttributes() ?>>
        <label id="elh_finding_shortpick_user" for="x_user" class="<?= $Page->LeftColumnClass ?>"><?= $Page->user->caption() ?><?= $Page->user->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->user->cellAttributes() ?>>
<span id="el_finding_shortpick_user">
<input type="<?= $Page->user->getInputTextType() ?>" name="x_user" id="x_user" data-table="finding_shortpick" data-field="x_user" value="<?= $Page->user->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->user->getPlaceHolder()) ?>"<?= $Page->user->editAttributes() ?> aria-describedby="x_user_help">
<?= $Page->user->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->user->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->area->Visible) { // area ?>
    <div id="r_area"<?= $Page->area->rowAttributes() ?>>
        <label id="elh_finding_shortpick_area" for="x_area" class="<?= $Page->LeftColumnClass ?>"><?= $Page->area->caption() ?><?= $Page->area->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->area->cellAttributes() ?>>
<span id="el_finding_shortpick_area">
<input type="<?= $Page->area->getInputTextType() ?>" name="x_area" id="x_area" data-table="finding_shortpick" data-field="x_area" value="<?= $Page->area->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->area->getPlaceHolder()) ?>"<?= $Page->area->editAttributes() ?> aria-describedby="x_area_help">
<?= $Page->area->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->area->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_finding_shortpick_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_finding_shortpick_status">
<input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="finding_shortpick" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
    <div id="r_date_upload"<?= $Page->date_upload->rowAttributes() ?>>
        <label id="elh_finding_shortpick_date_upload" for="x_date_upload" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_upload->caption() ?><?= $Page->date_upload->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_upload->cellAttributes() ?>>
<span id="el_finding_shortpick_date_upload">
<input type="<?= $Page->date_upload->getInputTextType() ?>" name="x_date_upload" id="x_date_upload" data-table="finding_shortpick" data-field="x_date_upload" value="<?= $Page->date_upload->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_upload->getPlaceHolder()) ?>"<?= $Page->date_upload->editAttributes() ?> aria-describedby="x_date_upload_help">
<?= $Page->date_upload->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_upload->getErrorMessage() ?></div>
<?php if (!$Page->date_upload->ReadOnly && !$Page->date_upload->Disabled && !isset($Page->date_upload->EditAttrs["readonly"]) && !isset($Page->date_upload->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffinding_shortpickadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ffinding_shortpickadd", "x_date_upload", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_picking->Visible) { // date_picking ?>
    <div id="r_date_picking"<?= $Page->date_picking->rowAttributes() ?>>
        <label id="elh_finding_shortpick_date_picking" for="x_date_picking" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_picking->caption() ?><?= $Page->date_picking->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_picking->cellAttributes() ?>>
<span id="el_finding_shortpick_date_picking">
<input type="<?= $Page->date_picking->getInputTextType() ?>" name="x_date_picking" id="x_date_picking" data-table="finding_shortpick" data-field="x_date_picking" value="<?= $Page->date_picking->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_picking->getPlaceHolder()) ?>"<?= $Page->date_picking->editAttributes() ?> aria-describedby="x_date_picking_help">
<?= $Page->date_picking->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_picking->getErrorMessage() ?></div>
<?php if (!$Page->date_picking->ReadOnly && !$Page->date_picking->Disabled && !isset($Page->date_picking->EditAttrs["readonly"]) && !isset($Page->date_picking->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ffinding_shortpickadd", "datetimepicker"], function () {
    let format = "<?= DateFormat(1) ?>",
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
    ew.createDateTimePicker("ffinding_shortpickadd", "x_date_picking", ew.deepAssign({"useCurrent":false}, options));
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
    ew.addEventHandlers("finding_shortpick");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
