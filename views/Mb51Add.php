<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$Mb51Add = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { mb51: currentTable } });
var currentForm, currentPageID;
var fmb51add;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fmb51add = new ew.Form("fmb51add", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fmb51add;

    // Add fields
    var fields = currentTable.fields;
    fmb51add.addFields([
        ["article", [fields.article.visible && fields.article.required ? ew.Validators.required(fields.article.caption) : null], fields.article.isInvalid],
        ["quantity", [fields.quantity.visible && fields.quantity.required ? ew.Validators.required(fields.quantity.caption) : null, ew.Validators.integer], fields.quantity.isInvalid],
        ["reference", [fields.reference.visible && fields.reference.required ? ew.Validators.required(fields.reference.caption) : null], fields.reference.isInvalid],
        ["rcvsite", [fields.rcvsite.visible && fields.rcvsite.required ? ew.Validators.required(fields.rcvsite.caption) : null], fields.rcvsite.isInvalid],
        ["do_type", [fields.do_type.visible && fields.do_type.required ? ew.Validators.required(fields.do_type.caption) : null], fields.do_type.isInvalid],
        ["concept", [fields.concept.visible && fields.concept.required ? ew.Validators.required(fields.concept.caption) : null], fields.concept.isInvalid]
    ]);

    // Form_CustomValidate
    fmb51add.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fmb51add.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fmb51add");
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
<form name="fmb51add" id="fmb51add" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="mb51">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->article->Visible) { // article ?>
    <div id="r_article"<?= $Page->article->rowAttributes() ?>>
        <label id="elh_mb51_article" for="x_article" class="<?= $Page->LeftColumnClass ?>"><?= $Page->article->caption() ?><?= $Page->article->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->article->cellAttributes() ?>>
<span id="el_mb51_article">
<input type="<?= $Page->article->getInputTextType() ?>" name="x_article" id="x_article" data-table="mb51" data-field="x_article" value="<?= $Page->article->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->article->getPlaceHolder()) ?>"<?= $Page->article->editAttributes() ?> aria-describedby="x_article_help">
<?= $Page->article->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->article->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->quantity->Visible) { // quantity ?>
    <div id="r_quantity"<?= $Page->quantity->rowAttributes() ?>>
        <label id="elh_mb51_quantity" for="x_quantity" class="<?= $Page->LeftColumnClass ?>"><?= $Page->quantity->caption() ?><?= $Page->quantity->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->quantity->cellAttributes() ?>>
<span id="el_mb51_quantity">
<input type="<?= $Page->quantity->getInputTextType() ?>" name="x_quantity" id="x_quantity" data-table="mb51" data-field="x_quantity" value="<?= $Page->quantity->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->quantity->getPlaceHolder()) ?>"<?= $Page->quantity->editAttributes() ?> aria-describedby="x_quantity_help">
<?= $Page->quantity->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->quantity->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->reference->Visible) { // reference ?>
    <div id="r_reference"<?= $Page->reference->rowAttributes() ?>>
        <label id="elh_mb51_reference" for="x_reference" class="<?= $Page->LeftColumnClass ?>"><?= $Page->reference->caption() ?><?= $Page->reference->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->reference->cellAttributes() ?>>
<span id="el_mb51_reference">
<input type="<?= $Page->reference->getInputTextType() ?>" name="x_reference" id="x_reference" data-table="mb51" data-field="x_reference" value="<?= $Page->reference->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->reference->getPlaceHolder()) ?>"<?= $Page->reference->editAttributes() ?> aria-describedby="x_reference_help">
<?= $Page->reference->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->reference->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rcvsite->Visible) { // rcvsite ?>
    <div id="r_rcvsite"<?= $Page->rcvsite->rowAttributes() ?>>
        <label id="elh_mb51_rcvsite" for="x_rcvsite" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rcvsite->caption() ?><?= $Page->rcvsite->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->rcvsite->cellAttributes() ?>>
<span id="el_mb51_rcvsite">
<input type="<?= $Page->rcvsite->getInputTextType() ?>" name="x_rcvsite" id="x_rcvsite" data-table="mb51" data-field="x_rcvsite" value="<?= $Page->rcvsite->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->rcvsite->getPlaceHolder()) ?>"<?= $Page->rcvsite->editAttributes() ?> aria-describedby="x_rcvsite_help">
<?= $Page->rcvsite->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rcvsite->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->do_type->Visible) { // do_type ?>
    <div id="r_do_type"<?= $Page->do_type->rowAttributes() ?>>
        <label id="elh_mb51_do_type" for="x_do_type" class="<?= $Page->LeftColumnClass ?>"><?= $Page->do_type->caption() ?><?= $Page->do_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->do_type->cellAttributes() ?>>
<span id="el_mb51_do_type">
<input type="<?= $Page->do_type->getInputTextType() ?>" name="x_do_type" id="x_do_type" data-table="mb51" data-field="x_do_type" value="<?= $Page->do_type->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->do_type->getPlaceHolder()) ?>"<?= $Page->do_type->editAttributes() ?> aria-describedby="x_do_type_help">
<?= $Page->do_type->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->do_type->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
    <div id="r_concept"<?= $Page->concept->rowAttributes() ?>>
        <label id="elh_mb51_concept" for="x_concept" class="<?= $Page->LeftColumnClass ?>"><?= $Page->concept->caption() ?><?= $Page->concept->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->concept->cellAttributes() ?>>
<span id="el_mb51_concept">
<input type="<?= $Page->concept->getInputTextType() ?>" name="x_concept" id="x_concept" data-table="mb51" data-field="x_concept" value="<?= $Page->concept->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->concept->getPlaceHolder()) ?>"<?= $Page->concept->editAttributes() ?> aria-describedby="x_concept_help">
<?= $Page->concept->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->concept->getErrorMessage() ?></div>
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
    ew.addEventHandlers("mb51");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
