<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$LocationsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { locations: currentTable } });
var currentForm, currentPageID;
var flocationsadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    flocationsadd = new ew.Form("flocationsadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = flocationsadd;

    // Add fields
    var fields = currentTable.fields;
    flocationsadd.addFields([
        ["location", [fields.location.visible && fields.location.required ? ew.Validators.required(fields.location.caption) : null], fields.location.isInvalid],
        ["area", [fields.area.visible && fields.area.required ? ew.Validators.required(fields.area.caption) : null], fields.area.isInvalid],
        ["sequence", [fields.sequence.visible && fields.sequence.required ? ew.Validators.required(fields.sequence.caption) : null], fields.sequence.isInvalid],
        ["divisi", [fields.divisi.visible && fields.divisi.required ? ew.Validators.required(fields.divisi.caption) : null], fields.divisi.isInvalid]
    ]);

    // Form_CustomValidate
    flocationsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    flocationsadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("flocationsadd");
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
<form name="flocationsadd" id="flocationsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="locations">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->location->Visible) { // location ?>
    <div id="r_location"<?= $Page->location->rowAttributes() ?>>
        <label id="elh_locations_location" for="x_location" class="<?= $Page->LeftColumnClass ?>"><?= $Page->location->caption() ?><?= $Page->location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->location->cellAttributes() ?>>
<span id="el_locations_location">
<input type="<?= $Page->location->getInputTextType() ?>" name="x_location" id="x_location" data-table="locations" data-field="x_location" value="<?= $Page->location->EditValue ?>" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->location->getPlaceHolder()) ?>"<?= $Page->location->editAttributes() ?> aria-describedby="x_location_help">
<?= $Page->location->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->area->Visible) { // area ?>
    <div id="r_area"<?= $Page->area->rowAttributes() ?>>
        <label id="elh_locations_area" for="x_area" class="<?= $Page->LeftColumnClass ?>"><?= $Page->area->caption() ?><?= $Page->area->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->area->cellAttributes() ?>>
<span id="el_locations_area">
<input type="<?= $Page->area->getInputTextType() ?>" name="x_area" id="x_area" data-table="locations" data-field="x_area" value="<?= $Page->area->EditValue ?>" size="30" maxlength="25" placeholder="<?= HtmlEncode($Page->area->getPlaceHolder()) ?>"<?= $Page->area->editAttributes() ?> aria-describedby="x_area_help">
<?= $Page->area->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->area->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sequence->Visible) { // sequence ?>
    <div id="r_sequence"<?= $Page->sequence->rowAttributes() ?>>
        <label id="elh_locations_sequence" for="x_sequence" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sequence->caption() ?><?= $Page->sequence->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sequence->cellAttributes() ?>>
<span id="el_locations_sequence">
<input type="<?= $Page->sequence->getInputTextType() ?>" name="x_sequence" id="x_sequence" data-table="locations" data-field="x_sequence" value="<?= $Page->sequence->EditValue ?>" size="30" maxlength="15" placeholder="<?= HtmlEncode($Page->sequence->getPlaceHolder()) ?>"<?= $Page->sequence->editAttributes() ?> aria-describedby="x_sequence_help">
<?= $Page->sequence->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sequence->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->divisi->Visible) { // divisi ?>
    <div id="r_divisi"<?= $Page->divisi->rowAttributes() ?>>
        <label id="elh_locations_divisi" for="x_divisi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->divisi->caption() ?><?= $Page->divisi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->divisi->cellAttributes() ?>>
<span id="el_locations_divisi">
<input type="<?= $Page->divisi->getInputTextType() ?>" name="x_divisi" id="x_divisi" data-table="locations" data-field="x_divisi" value="<?= $Page->divisi->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->divisi->getPlaceHolder()) ?>"<?= $Page->divisi->editAttributes() ?> aria-describedby="x_divisi_help">
<?= $Page->divisi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->divisi->getErrorMessage() ?></div>
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
    ew.addEventHandlers("locations");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
