<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$BlankCountSheetEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { blank_count_sheet: currentTable } });
var currentForm, currentPageID;
var fblank_count_sheetedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fblank_count_sheetedit = new ew.Form("fblank_count_sheetedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fblank_count_sheetedit;

    // Add fields
    var fields = currentTable.fields;
    fblank_count_sheetedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["location", [fields.location.visible && fields.location.required ? ew.Validators.required(fields.location.caption) : null], fields.location.isInvalid],
        ["ctn", [fields.ctn.visible && fields.ctn.required ? ew.Validators.required(fields.ctn.caption) : null], fields.ctn.isInvalid],
        ["article", [fields.article.visible && fields.article.required ? ew.Validators.required(fields.article.caption) : null], fields.article.isInvalid],
        ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
        ["size_desc", [fields.size_desc.visible && fields.size_desc.required ? ew.Validators.required(fields.size_desc.caption) : null], fields.size_desc.isInvalid],
        ["color_code", [fields.color_code.visible && fields.color_code.required ? ew.Validators.required(fields.color_code.caption) : null], fields.color_code.isInvalid],
        ["color_desc", [fields.color_desc.visible && fields.color_desc.required ? ew.Validators.required(fields.color_desc.caption) : null], fields.color_desc.isInvalid],
        ["season", [fields.season.visible && fields.season.required ? ew.Validators.required(fields.season.caption) : null], fields.season.isInvalid],
        ["quantity", [fields.quantity.visible && fields.quantity.required ? ew.Validators.required(fields.quantity.caption) : null, ew.Validators.integer], fields.quantity.isInvalid],
        ["user", [fields.user.visible && fields.user.required ? ew.Validators.required(fields.user.caption) : null], fields.user.isInvalid],
        ["date_created", [fields.date_created.visible && fields.date_created.required ? ew.Validators.required(fields.date_created.caption) : null], fields.date_created.isInvalid],
        ["date_updated", [fields.date_updated.visible && fields.date_updated.required ? ew.Validators.required(fields.date_updated.caption) : null], fields.date_updated.isInvalid]
    ]);

    // Form_CustomValidate
    fblank_count_sheetedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fblank_count_sheetedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fblank_count_sheetedit");
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
<form name="fblank_count_sheetedit" id="fblank_count_sheetedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="blank_count_sheet">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_blank_count_sheet_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_blank_count_sheet_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="blank_count_sheet" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->location->Visible) { // location ?>
    <div id="r_location"<?= $Page->location->rowAttributes() ?>>
        <label id="elh_blank_count_sheet_location" for="x_location" class="<?= $Page->LeftColumnClass ?>"><?= $Page->location->caption() ?><?= $Page->location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->location->cellAttributes() ?>>
<span id="el_blank_count_sheet_location">
<input type="<?= $Page->location->getInputTextType() ?>" name="x_location" id="x_location" data-table="blank_count_sheet" data-field="x_location" value="<?= $Page->location->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->location->getPlaceHolder()) ?>"<?= $Page->location->editAttributes() ?> aria-describedby="x_location_help">
<?= $Page->location->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
    <div id="r_ctn"<?= $Page->ctn->rowAttributes() ?>>
        <label id="elh_blank_count_sheet_ctn" for="x_ctn" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ctn->caption() ?><?= $Page->ctn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ctn->cellAttributes() ?>>
<span id="el_blank_count_sheet_ctn">
<input type="<?= $Page->ctn->getInputTextType() ?>" name="x_ctn" id="x_ctn" data-table="blank_count_sheet" data-field="x_ctn" value="<?= $Page->ctn->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->ctn->getPlaceHolder()) ?>"<?= $Page->ctn->editAttributes() ?> aria-describedby="x_ctn_help">
<?= $Page->ctn->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ctn->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <div id="r_article"<?= $Page->article->rowAttributes() ?>>
        <label id="elh_blank_count_sheet_article" for="x_article" class="<?= $Page->LeftColumnClass ?>"><?= $Page->article->caption() ?><?= $Page->article->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->article->cellAttributes() ?>>
<span id="el_blank_count_sheet_article">
<input type="<?= $Page->article->getInputTextType() ?>" name="x_article" id="x_article" data-table="blank_count_sheet" data-field="x_article" value="<?= $Page->article->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->article->getPlaceHolder()) ?>"<?= $Page->article->editAttributes() ?> aria-describedby="x_article_help">
<?= $Page->article->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->article->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_blank_count_sheet_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_blank_count_sheet_description">
<input type="<?= $Page->description->getInputTextType() ?>" name="x_description" id="x_description" data-table="blank_count_sheet" data-field="x_description" value="<?= $Page->description->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help">
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
    <div id="r_size_desc"<?= $Page->size_desc->rowAttributes() ?>>
        <label id="elh_blank_count_sheet_size_desc" for="x_size_desc" class="<?= $Page->LeftColumnClass ?>"><?= $Page->size_desc->caption() ?><?= $Page->size_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->size_desc->cellAttributes() ?>>
<span id="el_blank_count_sheet_size_desc">
<input type="<?= $Page->size_desc->getInputTextType() ?>" name="x_size_desc" id="x_size_desc" data-table="blank_count_sheet" data-field="x_size_desc" value="<?= $Page->size_desc->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->size_desc->getPlaceHolder()) ?>"<?= $Page->size_desc->editAttributes() ?> aria-describedby="x_size_desc_help">
<?= $Page->size_desc->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->size_desc->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
    <div id="r_color_code"<?= $Page->color_code->rowAttributes() ?>>
        <label id="elh_blank_count_sheet_color_code" for="x_color_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->color_code->caption() ?><?= $Page->color_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->color_code->cellAttributes() ?>>
<span id="el_blank_count_sheet_color_code">
<input type="<?= $Page->color_code->getInputTextType() ?>" name="x_color_code" id="x_color_code" data-table="blank_count_sheet" data-field="x_color_code" value="<?= $Page->color_code->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->color_code->getPlaceHolder()) ?>"<?= $Page->color_code->editAttributes() ?> aria-describedby="x_color_code_help">
<?= $Page->color_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->color_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->color_desc->Visible) { // color_desc ?>
    <div id="r_color_desc"<?= $Page->color_desc->rowAttributes() ?>>
        <label id="elh_blank_count_sheet_color_desc" for="x_color_desc" class="<?= $Page->LeftColumnClass ?>"><?= $Page->color_desc->caption() ?><?= $Page->color_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->color_desc->cellAttributes() ?>>
<span id="el_blank_count_sheet_color_desc">
<input type="<?= $Page->color_desc->getInputTextType() ?>" name="x_color_desc" id="x_color_desc" data-table="blank_count_sheet" data-field="x_color_desc" value="<?= $Page->color_desc->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->color_desc->getPlaceHolder()) ?>"<?= $Page->color_desc->editAttributes() ?> aria-describedby="x_color_desc_help">
<?= $Page->color_desc->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->color_desc->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->season->Visible) { // season ?>
    <div id="r_season"<?= $Page->season->rowAttributes() ?>>
        <label id="elh_blank_count_sheet_season" for="x_season" class="<?= $Page->LeftColumnClass ?>"><?= $Page->season->caption() ?><?= $Page->season->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->season->cellAttributes() ?>>
<span id="el_blank_count_sheet_season">
<input type="<?= $Page->season->getInputTextType() ?>" name="x_season" id="x_season" data-table="blank_count_sheet" data-field="x_season" value="<?= $Page->season->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->season->getPlaceHolder()) ?>"<?= $Page->season->editAttributes() ?> aria-describedby="x_season_help">
<?= $Page->season->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->season->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
    <div id="r_quantity"<?= $Page->quantity->rowAttributes() ?>>
        <label id="elh_blank_count_sheet_quantity" for="x_quantity" class="<?= $Page->LeftColumnClass ?>"><?= $Page->quantity->caption() ?><?= $Page->quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->quantity->cellAttributes() ?>>
<span id="el_blank_count_sheet_quantity">
<input type="<?= $Page->quantity->getInputTextType() ?>" name="x_quantity" id="x_quantity" data-table="blank_count_sheet" data-field="x_quantity" value="<?= $Page->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->quantity->getPlaceHolder()) ?>"<?= $Page->quantity->editAttributes() ?> aria-describedby="x_quantity_help">
<?= $Page->quantity->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->quantity->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
    <div id="r_user"<?= $Page->user->rowAttributes() ?>>
        <label id="elh_blank_count_sheet_user" for="x_user" class="<?= $Page->LeftColumnClass ?>"><?= $Page->user->caption() ?><?= $Page->user->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->user->cellAttributes() ?>>
<span id="el_blank_count_sheet_user">
<input type="<?= $Page->user->getInputTextType() ?>" name="x_user" id="x_user" data-table="blank_count_sheet" data-field="x_user" value="<?= $Page->user->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->user->getPlaceHolder()) ?>"<?= $Page->user->editAttributes() ?> aria-describedby="x_user_help">
<?= $Page->user->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->user->getErrorMessage() ?></div>
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
    ew.addEventHandlers("blank_count_sheet");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
