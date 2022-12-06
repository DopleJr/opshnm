<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$AuditPickingAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { audit_picking: currentTable } });
var currentForm, currentPageID;
var faudit_pickingadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    faudit_pickingadd = new ew.Form("faudit_pickingadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = faudit_pickingadd;

    // Add fields
    var fields = currentTable.fields;
    faudit_pickingadd.addFields([
        ["box_id", [fields.box_id.visible && fields.box_id.required ? ew.Validators.required(fields.box_id.caption) : null], fields.box_id.isInvalid]
    ]);

    // Form_CustomValidate
    faudit_pickingadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    faudit_pickingadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("faudit_pickingadd");
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
<form name="faudit_pickingadd" id="faudit_pickingadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="audit_picking">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div d-none"><!-- page* -->
<?php if ($Page->box_id->Visible) { // box_id ?>
    <div id="r_box_id"<?= $Page->box_id->rowAttributes() ?>>
        <label id="elh_audit_picking_box_id" for="x_box_id" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_audit_picking_box_id"><?= $Page->box_id->caption() ?><?= $Page->box_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->box_id->cellAttributes() ?>>
<template id="tpx_audit_picking_box_id"><span id="el_audit_picking_box_id">
<input type="<?= $Page->box_id->getInputTextType() ?>" name="x_box_id" id="x_box_id" data-table="audit_picking" data-field="x_box_id" value="<?= $Page->box_id->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->box_id->getPlaceHolder()) ?>"<?= $Page->box_id->editAttributes() ?> aria-describedby="x_box_id_help">
<?= $Page->box_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->box_id->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_audit_pickingadd" class="ew-custom-template"></div>
<template id="tpm_audit_pickingadd">
<div id="ct_AuditPickingAdd"><style>
	input {
        display: flex;
        width: 100%;
        box-sizing: border-box;
    }
     button {
        display: inline-block !important;
        width: 100%;
        box-sizing: border-box;
        margin-bottom: 10px;
    }
</style>
    <div id="r_box_id" class="mb-3 row">
        <label for="x_box_id" class="col-sm-2 col-form-label"><?= $Page->box_id->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_audit_picking_box_id"></slot></div>
    </div>
</div>
</template>
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
</form>
<script class="ew-apply-template">
loadjs.ready(ew.applyTemplateId, function() {
    ew.templateData = { rows: <?= JsonEncode($Page->Rows) ?> };
    ew.applyTemplate("tpd_audit_pickingadd", "tpm_audit_pickingadd", "audit_pickingadd", "<?= $Page->CustomExport ?>", ew.templateData.rows[0]);
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
    ew.addEventHandlers("audit_picking");
});
</script>
<script>
loadjs.ready("load", function () {
    // Startup script
    // Write your table-specific startup script here, no need to add script tags.
    $(document).ready(function() {
        		});
    $(document).ready(function () {
        $("#x_box_id").on("change", function () {
        this.form.submit();
        });
      });
});
</script>
