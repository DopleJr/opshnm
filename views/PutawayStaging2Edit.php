<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$PutawayStaging2Edit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { putaway_staging2: currentTable } });
var currentForm, currentPageID;
var fputaway_staging2edit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fputaway_staging2edit = new ew.Form("fputaway_staging2edit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fputaway_staging2edit;

    // Add fields
    var fields = currentTable.fields;
    fputaway_staging2edit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["store_name", [fields.store_name.visible && fields.store_name.required ? ew.Validators.required(fields.store_name.caption) : null], fields.store_name.isInvalid],
        ["store_code", [fields.store_code.visible && fields.store_code.required ? ew.Validators.required(fields.store_code.caption) : null], fields.store_code.isInvalid],
        ["line", [fields.line.visible && fields.line.required ? ew.Validators.required(fields.line.caption) : null], fields.line.isInvalid],
        ["box_id", [fields.box_id.visible && fields.box_id.required ? ew.Validators.required(fields.box_id.caption) : null], fields.box_id.isInvalid],
        ["concept", [fields.concept.visible && fields.concept.required ? ew.Validators.required(fields.concept.caption) : null], fields.concept.isInvalid],
        ["type", [fields.type.visible && fields.type.required ? ew.Validators.required(fields.type.caption) : null], fields.type.isInvalid],
        ["quantity", [fields.quantity.visible && fields.quantity.required ? ew.Validators.required(fields.quantity.caption) : null, ew.Validators.integer], fields.quantity.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["users", [fields.users.visible && fields.users.required ? ew.Validators.required(fields.users.caption) : null], fields.users.isInvalid],
        ["picking_date", [fields.picking_date.visible && fields.picking_date.required ? ew.Validators.required(fields.picking_date.caption) : null, ew.Validators.datetime(fields.picking_date.clientFormatPattern)], fields.picking_date.isInvalid],
        ["date_staging", [fields.date_staging.visible && fields.date_staging.required ? ew.Validators.required(fields.date_staging.caption) : null, ew.Validators.datetime(fields.date_staging.clientFormatPattern)], fields.date_staging.isInvalid]
    ]);

    // Form_CustomValidate
    fputaway_staging2edit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fputaway_staging2edit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fputaway_staging2edit");
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
<form name="fputaway_staging2edit" id="fputaway_staging2edit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="putaway_staging2">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_putaway_staging2_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_putaway_staging2_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="putaway_staging2" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
    <div id="r_store_name"<?= $Page->store_name->rowAttributes() ?>>
        <label id="elh_putaway_staging2_store_name" for="x_store_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->store_name->caption() ?><?= $Page->store_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_name->cellAttributes() ?>>
<span id="el_putaway_staging2_store_name">
<input type="<?= $Page->store_name->getInputTextType() ?>" name="x_store_name" id="x_store_name" data-table="putaway_staging2" data-field="x_store_name" value="<?= $Page->store_name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->store_name->getPlaceHolder()) ?>"<?= $Page->store_name->editAttributes() ?> aria-describedby="x_store_name_help">
<?= $Page->store_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->store_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->store_code->Visible) { // store_code ?>
    <div id="r_store_code"<?= $Page->store_code->rowAttributes() ?>>
        <label id="elh_putaway_staging2_store_code" for="x_store_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->store_code->caption() ?><?= $Page->store_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->store_code->cellAttributes() ?>>
<span id="el_putaway_staging2_store_code">
<input type="<?= $Page->store_code->getInputTextType() ?>" name="x_store_code" id="x_store_code" data-table="putaway_staging2" data-field="x_store_code" value="<?= $Page->store_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->store_code->getPlaceHolder()) ?>"<?= $Page->store_code->editAttributes() ?> aria-describedby="x_store_code_help">
<?= $Page->store_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->store_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->line->Visible) { // line ?>
    <div id="r_line"<?= $Page->line->rowAttributes() ?>>
        <label id="elh_putaway_staging2_line" for="x_line" class="<?= $Page->LeftColumnClass ?>"><?= $Page->line->caption() ?><?= $Page->line->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->line->cellAttributes() ?>>
<span id="el_putaway_staging2_line">
<input type="<?= $Page->line->getInputTextType() ?>" name="x_line" id="x_line" data-table="putaway_staging2" data-field="x_line" value="<?= $Page->line->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->line->getPlaceHolder()) ?>"<?= $Page->line->editAttributes() ?> aria-describedby="x_line_help">
<?= $Page->line->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->line->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
    <div id="r_box_id"<?= $Page->box_id->rowAttributes() ?>>
        <label id="elh_putaway_staging2_box_id" for="x_box_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->box_id->caption() ?><?= $Page->box_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->box_id->cellAttributes() ?>>
<span id="el_putaway_staging2_box_id">
<input type="<?= $Page->box_id->getInputTextType() ?>" name="x_box_id" id="x_box_id" data-table="putaway_staging2" data-field="x_box_id" value="<?= $Page->box_id->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->box_id->getPlaceHolder()) ?>"<?= $Page->box_id->editAttributes() ?> aria-describedby="x_box_id_help">
<?= $Page->box_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->box_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
    <div id="r_concept"<?= $Page->concept->rowAttributes() ?>>
        <label id="elh_putaway_staging2_concept" for="x_concept" class="<?= $Page->LeftColumnClass ?>"><?= $Page->concept->caption() ?><?= $Page->concept->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->concept->cellAttributes() ?>>
<span id="el_putaway_staging2_concept">
<input type="<?= $Page->concept->getInputTextType() ?>" name="x_concept" id="x_concept" data-table="putaway_staging2" data-field="x_concept" value="<?= $Page->concept->EditValue ?>" size="30" maxlength="4" placeholder="<?= HtmlEncode($Page->concept->getPlaceHolder()) ?>"<?= $Page->concept->editAttributes() ?> aria-describedby="x_concept_help">
<?= $Page->concept->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->concept->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->type->Visible) { // type ?>
    <div id="r_type"<?= $Page->type->rowAttributes() ?>>
        <label id="elh_putaway_staging2_type" for="x_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->type->caption() ?><?= $Page->type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->type->cellAttributes() ?>>
<span id="el_putaway_staging2_type">
<input type="<?= $Page->type->getInputTextType() ?>" name="x_type" id="x_type" data-table="putaway_staging2" data-field="x_type" value="<?= $Page->type->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->type->getPlaceHolder()) ?>"<?= $Page->type->editAttributes() ?> aria-describedby="x_type_help">
<?= $Page->type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
    <div id="r_quantity"<?= $Page->quantity->rowAttributes() ?>>
        <label id="elh_putaway_staging2_quantity" for="x_quantity" class="<?= $Page->LeftColumnClass ?>"><?= $Page->quantity->caption() ?><?= $Page->quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->quantity->cellAttributes() ?>>
<span id="el_putaway_staging2_quantity">
<input type="<?= $Page->quantity->getInputTextType() ?>" name="x_quantity" id="x_quantity" data-table="putaway_staging2" data-field="x_quantity" value="<?= $Page->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->quantity->getPlaceHolder()) ?>"<?= $Page->quantity->editAttributes() ?> aria-describedby="x_quantity_help">
<?= $Page->quantity->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->quantity->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_putaway_staging2_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_putaway_staging2_status">
<input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="putaway_staging2" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->users->Visible) { // users ?>
    <div id="r_users"<?= $Page->users->rowAttributes() ?>>
        <label id="elh_putaway_staging2_users" for="x_users" class="<?= $Page->LeftColumnClass ?>"><?= $Page->users->caption() ?><?= $Page->users->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->users->cellAttributes() ?>>
<span id="el_putaway_staging2_users">
<input type="<?= $Page->users->getInputTextType() ?>" name="x_users" id="x_users" data-table="putaway_staging2" data-field="x_users" value="<?= $Page->users->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->users->getPlaceHolder()) ?>"<?= $Page->users->editAttributes() ?> aria-describedby="x_users_help">
<?= $Page->users->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->users->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->picking_date->Visible) { // picking_date ?>
    <div id="r_picking_date"<?= $Page->picking_date->rowAttributes() ?>>
        <label id="elh_putaway_staging2_picking_date" for="x_picking_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->picking_date->caption() ?><?= $Page->picking_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->picking_date->cellAttributes() ?>>
<span id="el_putaway_staging2_picking_date">
<input type="<?= $Page->picking_date->getInputTextType() ?>" name="x_picking_date" id="x_picking_date" data-table="putaway_staging2" data-field="x_picking_date" value="<?= $Page->picking_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->picking_date->getPlaceHolder()) ?>"<?= $Page->picking_date->editAttributes() ?> aria-describedby="x_picking_date_help">
<?= $Page->picking_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->picking_date->getErrorMessage() ?></div>
<?php if (!$Page->picking_date->ReadOnly && !$Page->picking_date->Disabled && !isset($Page->picking_date->EditAttrs["readonly"]) && !isset($Page->picking_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fputaway_staging2edit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fputaway_staging2edit", "x_picking_date", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_staging->Visible) { // date_staging ?>
    <div id="r_date_staging"<?= $Page->date_staging->rowAttributes() ?>>
        <label id="elh_putaway_staging2_date_staging" for="x_date_staging" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_staging->caption() ?><?= $Page->date_staging->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_staging->cellAttributes() ?>>
<span id="el_putaway_staging2_date_staging">
<input type="<?= $Page->date_staging->getInputTextType() ?>" name="x_date_staging" id="x_date_staging" data-table="putaway_staging2" data-field="x_date_staging" value="<?= $Page->date_staging->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_staging->getPlaceHolder()) ?>"<?= $Page->date_staging->editAttributes() ?> aria-describedby="x_date_staging_help">
<?= $Page->date_staging->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_staging->getErrorMessage() ?></div>
<?php if (!$Page->date_staging->ReadOnly && !$Page->date_staging->Disabled && !isset($Page->date_staging->EditAttrs["readonly"]) && !isset($Page->date_staging->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fputaway_staging2edit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fputaway_staging2edit", "x_date_staging", ew.deepAssign({"useCurrent":false}, options));
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
    ew.addEventHandlers("putaway_staging2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
