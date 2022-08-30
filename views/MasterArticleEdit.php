<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$MasterArticleEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { master_article: currentTable } });
var currentForm, currentPageID;
var fmaster_articleedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmaster_articleedit = new ew.Form("fmaster_articleedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fmaster_articleedit;

    // Add fields
    var fields = currentTable.fields;
    fmaster_articleedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["article", [fields.article.visible && fields.article.required ? ew.Validators.required(fields.article.caption) : null], fields.article.isInvalid],
        ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
        ["gtin", [fields.gtin.visible && fields.gtin.required ? ew.Validators.required(fields.gtin.caption) : null], fields.gtin.isInvalid],
        ["color_code", [fields.color_code.visible && fields.color_code.required ? ew.Validators.required(fields.color_code.caption) : null], fields.color_code.isInvalid],
        ["color_desc", [fields.color_desc.visible && fields.color_desc.required ? ew.Validators.required(fields.color_desc.caption) : null], fields.color_desc.isInvalid],
        ["size_code", [fields.size_code.visible && fields.size_code.required ? ew.Validators.required(fields.size_code.caption) : null], fields.size_code.isInvalid],
        ["size_desc", [fields.size_desc.visible && fields.size_desc.required ? ew.Validators.required(fields.size_desc.caption) : null], fields.size_desc.isInvalid],
        ["season", [fields.season.visible && fields.season.required ? ew.Validators.required(fields.season.caption) : null], fields.season.isInvalid],
        ["price", [fields.price.visible && fields.price.required ? ew.Validators.required(fields.price.caption) : null, ew.Validators.float], fields.price.isInvalid]
    ]);

    // Form_CustomValidate
    fmaster_articleedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmaster_articleedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fmaster_articleedit");
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
<form name="fmaster_articleedit" id="fmaster_articleedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="master_article">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_master_article_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_master_article_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="master_article" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <div id="r_article"<?= $Page->article->rowAttributes() ?>>
        <label id="elh_master_article_article" for="x_article" class="<?= $Page->LeftColumnClass ?>"><?= $Page->article->caption() ?><?= $Page->article->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->article->cellAttributes() ?>>
<span id="el_master_article_article">
<input type="<?= $Page->article->getInputTextType() ?>" name="x_article" id="x_article" data-table="master_article" data-field="x_article" value="<?= $Page->article->EditValue ?>" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->article->getPlaceHolder()) ?>"<?= $Page->article->editAttributes() ?> aria-describedby="x_article_help">
<?= $Page->article->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->article->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_master_article_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<span id="el_master_article_description">
<input type="<?= $Page->description->getInputTextType() ?>" name="x_description" id="x_description" data-table="master_article" data-field="x_description" value="<?= $Page->description->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help">
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gtin->Visible) { // gtin ?>
    <div id="r_gtin"<?= $Page->gtin->rowAttributes() ?>>
        <label id="elh_master_article_gtin" for="x_gtin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->gtin->caption() ?><?= $Page->gtin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->gtin->cellAttributes() ?>>
<span id="el_master_article_gtin">
<input type="<?= $Page->gtin->getInputTextType() ?>" name="x_gtin" id="x_gtin" data-table="master_article" data-field="x_gtin" value="<?= $Page->gtin->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->gtin->getPlaceHolder()) ?>"<?= $Page->gtin->editAttributes() ?> aria-describedby="x_gtin_help">
<?= $Page->gtin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gtin->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->color_code->Visible) { // color_code ?>
    <div id="r_color_code"<?= $Page->color_code->rowAttributes() ?>>
        <label id="elh_master_article_color_code" for="x_color_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->color_code->caption() ?><?= $Page->color_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->color_code->cellAttributes() ?>>
<span id="el_master_article_color_code">
<input type="<?= $Page->color_code->getInputTextType() ?>" name="x_color_code" id="x_color_code" data-table="master_article" data-field="x_color_code" value="<?= $Page->color_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->color_code->getPlaceHolder()) ?>"<?= $Page->color_code->editAttributes() ?> aria-describedby="x_color_code_help">
<?= $Page->color_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->color_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->color_desc->Visible) { // color_desc ?>
    <div id="r_color_desc"<?= $Page->color_desc->rowAttributes() ?>>
        <label id="elh_master_article_color_desc" for="x_color_desc" class="<?= $Page->LeftColumnClass ?>"><?= $Page->color_desc->caption() ?><?= $Page->color_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->color_desc->cellAttributes() ?>>
<span id="el_master_article_color_desc">
<input type="<?= $Page->color_desc->getInputTextType() ?>" name="x_color_desc" id="x_color_desc" data-table="master_article" data-field="x_color_desc" value="<?= $Page->color_desc->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->color_desc->getPlaceHolder()) ?>"<?= $Page->color_desc->editAttributes() ?> aria-describedby="x_color_desc_help">
<?= $Page->color_desc->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->color_desc->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->size_code->Visible) { // size_code ?>
    <div id="r_size_code"<?= $Page->size_code->rowAttributes() ?>>
        <label id="elh_master_article_size_code" for="x_size_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->size_code->caption() ?><?= $Page->size_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->size_code->cellAttributes() ?>>
<span id="el_master_article_size_code">
<input type="<?= $Page->size_code->getInputTextType() ?>" name="x_size_code" id="x_size_code" data-table="master_article" data-field="x_size_code" value="<?= $Page->size_code->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->size_code->getPlaceHolder()) ?>"<?= $Page->size_code->editAttributes() ?> aria-describedby="x_size_code_help">
<?= $Page->size_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->size_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->size_desc->Visible) { // size_desc ?>
    <div id="r_size_desc"<?= $Page->size_desc->rowAttributes() ?>>
        <label id="elh_master_article_size_desc" for="x_size_desc" class="<?= $Page->LeftColumnClass ?>"><?= $Page->size_desc->caption() ?><?= $Page->size_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->size_desc->cellAttributes() ?>>
<span id="el_master_article_size_desc">
<input type="<?= $Page->size_desc->getInputTextType() ?>" name="x_size_desc" id="x_size_desc" data-table="master_article" data-field="x_size_desc" value="<?= $Page->size_desc->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->size_desc->getPlaceHolder()) ?>"<?= $Page->size_desc->editAttributes() ?> aria-describedby="x_size_desc_help">
<?= $Page->size_desc->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->size_desc->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->season->Visible) { // season ?>
    <div id="r_season"<?= $Page->season->rowAttributes() ?>>
        <label id="elh_master_article_season" for="x_season" class="<?= $Page->LeftColumnClass ?>"><?= $Page->season->caption() ?><?= $Page->season->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->season->cellAttributes() ?>>
<span id="el_master_article_season">
<input type="<?= $Page->season->getInputTextType() ?>" name="x_season" id="x_season" data-table="master_article" data-field="x_season" value="<?= $Page->season->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->season->getPlaceHolder()) ?>"<?= $Page->season->editAttributes() ?> aria-describedby="x_season_help">
<?= $Page->season->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->season->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->price->Visible) { // price ?>
    <div id="r_price"<?= $Page->price->rowAttributes() ?>>
        <label id="elh_master_article_price" for="x_price" class="<?= $Page->LeftColumnClass ?>"><?= $Page->price->caption() ?><?= $Page->price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->price->cellAttributes() ?>>
<span id="el_master_article_price">
<input type="<?= $Page->price->getInputTextType() ?>" name="x_price" id="x_price" data-table="master_article" data-field="x_price" value="<?= $Page->price->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->price->getPlaceHolder()) ?>"<?= $Page->price->editAttributes() ?> aria-describedby="x_price_help">
<?= $Page->price->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->price->getErrorMessage() ?></div>
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
    ew.addEventHandlers("master_article");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
