<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$TransferBinPieceEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { transfer_bin_piece: currentTable } });
var currentForm, currentPageID;
var ftransfer_bin_pieceedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftransfer_bin_pieceedit = new ew.Form("ftransfer_bin_pieceedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = ftransfer_bin_pieceedit;

    // Add fields
    var fields = currentTable.fields;
    ftransfer_bin_pieceedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["source_location", [fields.source_location.visible && fields.source_location.required ? ew.Validators.required(fields.source_location.caption) : null], fields.source_location.isInvalid],
        ["article", [fields.article.visible && fields.article.required ? ew.Validators.required(fields.article.caption) : null], fields.article.isInvalid],
        ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
        ["destination_location", [fields.destination_location.visible && fields.destination_location.required ? ew.Validators.required(fields.destination_location.caption) : null], fields.destination_location.isInvalid],
        ["su", [fields.su.visible && fields.su.required ? ew.Validators.required(fields.su.caption) : null], fields.su.isInvalid],
        ["qty", [fields.qty.visible && fields.qty.required ? ew.Validators.required(fields.qty.caption) : null, ew.Validators.integer], fields.qty.isInvalid],
        ["actual", [fields.actual.visible && fields.actual.required ? ew.Validators.required(fields.actual.caption) : null, ew.Validators.integer], fields.actual.isInvalid],
        ["user", [fields.user.visible && fields.user.required ? ew.Validators.required(fields.user.caption) : null], fields.user.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["date_upload", [fields.date_upload.visible && fields.date_upload.required ? ew.Validators.required(fields.date_upload.caption) : null, ew.Validators.datetime(fields.date_upload.clientFormatPattern)], fields.date_upload.isInvalid],
        ["date_confirmation", [fields.date_confirmation.visible && fields.date_confirmation.required ? ew.Validators.required(fields.date_confirmation.caption) : null, ew.Validators.datetime(fields.date_confirmation.clientFormatPattern)], fields.date_confirmation.isInvalid],
        ["time_confirmation", [fields.time_confirmation.visible && fields.time_confirmation.required ? ew.Validators.required(fields.time_confirmation.caption) : null, ew.Validators.time(fields.time_confirmation.clientFormatPattern)], fields.time_confirmation.isInvalid]
    ]);

    // Form_CustomValidate
    ftransfer_bin_pieceedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftransfer_bin_pieceedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("ftransfer_bin_pieceedit");
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
<form name="ftransfer_bin_pieceedit" id="ftransfer_bin_pieceedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="transfer_bin_piece">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_transfer_bin_piece_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_transfer_bin_piece_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="transfer_bin_piece" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->source_location->Visible) { // source_location ?>
    <div id="r_source_location"<?= $Page->source_location->rowAttributes() ?>>
        <label id="elh_transfer_bin_piece_source_location" for="x_source_location" class="<?= $Page->LeftColumnClass ?>"><?= $Page->source_location->caption() ?><?= $Page->source_location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->source_location->cellAttributes() ?>>
<span id="el_transfer_bin_piece_source_location">
<input type="<?= $Page->source_location->getInputTextType() ?>" name="x_source_location" id="x_source_location" data-table="transfer_bin_piece" data-field="x_source_location" value="<?= $Page->source_location->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->source_location->getPlaceHolder()) ?>"<?= $Page->source_location->editAttributes() ?> aria-describedby="x_source_location_help">
<?= $Page->source_location->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->source_location->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <div id="r_article"<?= $Page->article->rowAttributes() ?>>
        <label id="elh_transfer_bin_piece_article" for="x_article" class="<?= $Page->LeftColumnClass ?>"><?= $Page->article->caption() ?><?= $Page->article->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->article->cellAttributes() ?>>
<span id="el_transfer_bin_piece_article">
<input type="<?= $Page->article->getInputTextType() ?>" name="x_article" id="x_article" data-table="transfer_bin_piece" data-field="x_article" value="<?= $Page->article->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->article->getPlaceHolder()) ?>"<?= $Page->article->editAttributes() ?> aria-describedby="x_article_help">
<?= $Page->article->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->article->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_transfer_bin_piece_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_transfer_bin_piece_description">
<input type="<?= $Page->description->getInputTextType() ?>" name="x_description" id="x_description" data-table="transfer_bin_piece" data-field="x_description" value="<?= $Page->description->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help">
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->destination_location->Visible) { // destination_location ?>
    <div id="r_destination_location"<?= $Page->destination_location->rowAttributes() ?>>
        <label id="elh_transfer_bin_piece_destination_location" for="x_destination_location" class="<?= $Page->LeftColumnClass ?>"><?= $Page->destination_location->caption() ?><?= $Page->destination_location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->destination_location->cellAttributes() ?>>
<span id="el_transfer_bin_piece_destination_location">
<input type="<?= $Page->destination_location->getInputTextType() ?>" name="x_destination_location" id="x_destination_location" data-table="transfer_bin_piece" data-field="x_destination_location" value="<?= $Page->destination_location->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->destination_location->getPlaceHolder()) ?>"<?= $Page->destination_location->editAttributes() ?> aria-describedby="x_destination_location_help">
<?= $Page->destination_location->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->destination_location->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->su->Visible) { // su ?>
    <div id="r_su"<?= $Page->su->rowAttributes() ?>>
        <label id="elh_transfer_bin_piece_su" for="x_su" class="<?= $Page->LeftColumnClass ?>"><?= $Page->su->caption() ?><?= $Page->su->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->su->cellAttributes() ?>>
<span id="el_transfer_bin_piece_su">
<input type="<?= $Page->su->getInputTextType() ?>" name="x_su" id="x_su" data-table="transfer_bin_piece" data-field="x_su" value="<?= $Page->su->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->su->getPlaceHolder()) ?>"<?= $Page->su->editAttributes() ?> aria-describedby="x_su_help">
<?= $Page->su->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->su->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->qty->Visible) { // qty ?>
    <div id="r_qty"<?= $Page->qty->rowAttributes() ?>>
        <label id="elh_transfer_bin_piece_qty" for="x_qty" class="<?= $Page->LeftColumnClass ?>"><?= $Page->qty->caption() ?><?= $Page->qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->qty->cellAttributes() ?>>
<span id="el_transfer_bin_piece_qty">
<input type="<?= $Page->qty->getInputTextType() ?>" name="x_qty" id="x_qty" data-table="transfer_bin_piece" data-field="x_qty" value="<?= $Page->qty->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->qty->getPlaceHolder()) ?>"<?= $Page->qty->editAttributes() ?> aria-describedby="x_qty_help">
<?= $Page->qty->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->qty->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->actual->Visible) { // actual ?>
    <div id="r_actual"<?= $Page->actual->rowAttributes() ?>>
        <label id="elh_transfer_bin_piece_actual" for="x_actual" class="<?= $Page->LeftColumnClass ?>"><?= $Page->actual->caption() ?><?= $Page->actual->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->actual->cellAttributes() ?>>
<span id="el_transfer_bin_piece_actual">
<input type="<?= $Page->actual->getInputTextType() ?>" name="x_actual" id="x_actual" data-table="transfer_bin_piece" data-field="x_actual" value="<?= $Page->actual->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->actual->getPlaceHolder()) ?>"<?= $Page->actual->editAttributes() ?> aria-describedby="x_actual_help">
<?= $Page->actual->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->actual->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
    <div id="r_user"<?= $Page->user->rowAttributes() ?>>
        <label id="elh_transfer_bin_piece_user" for="x_user" class="<?= $Page->LeftColumnClass ?>"><?= $Page->user->caption() ?><?= $Page->user->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->user->cellAttributes() ?>>
<span id="el_transfer_bin_piece_user">
<input type="<?= $Page->user->getInputTextType() ?>" name="x_user" id="x_user" data-table="transfer_bin_piece" data-field="x_user" value="<?= $Page->user->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->user->getPlaceHolder()) ?>"<?= $Page->user->editAttributes() ?> aria-describedby="x_user_help">
<?= $Page->user->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->user->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_transfer_bin_piece_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_transfer_bin_piece_status">
<input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="transfer_bin_piece" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
    <div id="r_date_upload"<?= $Page->date_upload->rowAttributes() ?>>
        <label id="elh_transfer_bin_piece_date_upload" for="x_date_upload" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_upload->caption() ?><?= $Page->date_upload->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_upload->cellAttributes() ?>>
<span id="el_transfer_bin_piece_date_upload">
<input type="<?= $Page->date_upload->getInputTextType() ?>" name="x_date_upload" id="x_date_upload" data-table="transfer_bin_piece" data-field="x_date_upload" value="<?= $Page->date_upload->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_upload->getPlaceHolder()) ?>"<?= $Page->date_upload->editAttributes() ?> aria-describedby="x_date_upload_help">
<?= $Page->date_upload->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_upload->getErrorMessage() ?></div>
<?php if (!$Page->date_upload->ReadOnly && !$Page->date_upload->Disabled && !isset($Page->date_upload->EditAttrs["readonly"]) && !isset($Page->date_upload->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftransfer_bin_pieceedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftransfer_bin_pieceedit", "x_date_upload", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_confirmation->Visible) { // date_confirmation ?>
    <div id="r_date_confirmation"<?= $Page->date_confirmation->rowAttributes() ?>>
        <label id="elh_transfer_bin_piece_date_confirmation" for="x_date_confirmation" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_confirmation->caption() ?><?= $Page->date_confirmation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_confirmation->cellAttributes() ?>>
<span id="el_transfer_bin_piece_date_confirmation">
<input type="<?= $Page->date_confirmation->getInputTextType() ?>" name="x_date_confirmation" id="x_date_confirmation" data-table="transfer_bin_piece" data-field="x_date_confirmation" value="<?= $Page->date_confirmation->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_confirmation->getPlaceHolder()) ?>"<?= $Page->date_confirmation->editAttributes() ?> aria-describedby="x_date_confirmation_help">
<?= $Page->date_confirmation->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_confirmation->getErrorMessage() ?></div>
<?php if (!$Page->date_confirmation->ReadOnly && !$Page->date_confirmation->Disabled && !isset($Page->date_confirmation->EditAttrs["readonly"]) && !isset($Page->date_confirmation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftransfer_bin_pieceedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftransfer_bin_pieceedit", "x_date_confirmation", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->time_confirmation->Visible) { // time_confirmation ?>
    <div id="r_time_confirmation"<?= $Page->time_confirmation->rowAttributes() ?>>
        <label id="elh_transfer_bin_piece_time_confirmation" for="x_time_confirmation" class="<?= $Page->LeftColumnClass ?>"><?= $Page->time_confirmation->caption() ?><?= $Page->time_confirmation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->time_confirmation->cellAttributes() ?>>
<span id="el_transfer_bin_piece_time_confirmation">
<input type="<?= $Page->time_confirmation->getInputTextType() ?>" name="x_time_confirmation" id="x_time_confirmation" data-table="transfer_bin_piece" data-field="x_time_confirmation" value="<?= $Page->time_confirmation->EditValue ?>" placeholder="<?= HtmlEncode($Page->time_confirmation->getPlaceHolder()) ?>"<?= $Page->time_confirmation->editAttributes() ?> aria-describedby="x_time_confirmation_help">
<?= $Page->time_confirmation->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->time_confirmation->getErrorMessage() ?></div>
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
    ew.addEventHandlers("transfer_bin_piece");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
