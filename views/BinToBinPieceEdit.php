<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$BinToBinPieceEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { bin_to_bin_piece: currentTable } });
var currentForm, currentPageID;
var fbin_to_bin_pieceedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fbin_to_bin_pieceedit = new ew.Form("fbin_to_bin_pieceedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fbin_to_bin_pieceedit;

    // Add fields
    var fields = currentTable.fields;
    fbin_to_bin_pieceedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["date_upload", [fields.date_upload.visible && fields.date_upload.required ? ew.Validators.required(fields.date_upload.caption) : null, ew.Validators.datetime(fields.date_upload.clientFormatPattern)], fields.date_upload.isInvalid],
        ["source_location", [fields.source_location.visible && fields.source_location.required ? ew.Validators.required(fields.source_location.caption) : null], fields.source_location.isInvalid],
        ["scan_location", [fields.scan_location.visible && fields.scan_location.required ? ew.Validators.required(fields.scan_location.caption) : null], fields.scan_location.isInvalid],
        ["article", [fields.article.visible && fields.article.required ? ew.Validators.required(fields.article.caption) : null], fields.article.isInvalid],
        ["description", [fields.description.visible && fields.description.required ? ew.Validators.required(fields.description.caption) : null], fields.description.isInvalid],
        ["scan_article", [fields.scan_article.visible && fields.scan_article.required ? ew.Validators.required(fields.scan_article.caption) : null], fields.scan_article.isInvalid],
        ["destination_location", [fields.destination_location.visible && fields.destination_location.required ? ew.Validators.required(fields.destination_location.caption) : null], fields.destination_location.isInvalid],
        ["su", [fields.su.visible && fields.su.required ? ew.Validators.required(fields.su.caption) : null, ew.Validators.integer], fields.su.isInvalid],
        ["qty", [fields.qty.visible && fields.qty.required ? ew.Validators.required(fields.qty.caption) : null, ew.Validators.integer], fields.qty.isInvalid],
        ["actual", [fields.actual.visible && fields.actual.required ? ew.Validators.required(fields.actual.caption) : null, ew.Validators.integer], fields.actual.isInvalid],
        ["user", [fields.user.visible && fields.user.required ? ew.Validators.required(fields.user.caption) : null], fields.user.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["date_confirmation", [fields.date_confirmation.visible && fields.date_confirmation.required ? ew.Validators.required(fields.date_confirmation.caption) : null], fields.date_confirmation.isInvalid],
        ["time_confirmation", [fields.time_confirmation.visible && fields.time_confirmation.required ? ew.Validators.required(fields.time_confirmation.caption) : null], fields.time_confirmation.isInvalid]
    ]);

    // Form_CustomValidate
    fbin_to_bin_pieceedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fbin_to_bin_pieceedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fbin_to_bin_pieceedit");
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
<form name="fbin_to_bin_pieceedit" id="fbin_to_bin_pieceedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bin_to_bin_piece">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div d-none"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_bin_to_bin_piece_id" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_bin_to_bin_piece_id"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<template id="tpx_bin_to_bin_piece_id"><span id="el_bin_to_bin_piece_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="bin_to_bin_piece" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
    <div id="r_date_upload"<?= $Page->date_upload->rowAttributes() ?>>
        <label id="elh_bin_to_bin_piece_date_upload" for="x_date_upload" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_bin_to_bin_piece_date_upload"><?= $Page->date_upload->caption() ?><?= $Page->date_upload->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_upload->cellAttributes() ?>>
<template id="tpx_bin_to_bin_piece_date_upload"><span id="el_bin_to_bin_piece_date_upload">
<input type="<?= $Page->date_upload->getInputTextType() ?>" name="x_date_upload" id="x_date_upload" data-table="bin_to_bin_piece" data-field="x_date_upload" value="<?= $Page->date_upload->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_upload->getPlaceHolder()) ?>"<?= $Page->date_upload->editAttributes() ?> aria-describedby="x_date_upload_help">
<?= $Page->date_upload->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_upload->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->source_location->Visible) { // source_location ?>
    <div id="r_source_location"<?= $Page->source_location->rowAttributes() ?>>
        <label id="elh_bin_to_bin_piece_source_location" for="x_source_location" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_bin_to_bin_piece_source_location"><?= $Page->source_location->caption() ?><?= $Page->source_location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->source_location->cellAttributes() ?>>
<template id="tpx_bin_to_bin_piece_source_location"><span id="el_bin_to_bin_piece_source_location">
<input type="<?= $Page->source_location->getInputTextType() ?>" name="x_source_location" id="x_source_location" data-table="bin_to_bin_piece" data-field="x_source_location" value="<?= $Page->source_location->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->source_location->getPlaceHolder()) ?>"<?= $Page->source_location->editAttributes() ?> aria-describedby="x_source_location_help">
<?= $Page->source_location->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->source_location->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->scan_location->Visible) { // scan_location ?>
    <div id="r_scan_location"<?= $Page->scan_location->rowAttributes() ?>>
        <label id="elh_bin_to_bin_piece_scan_location" for="x_scan_location" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_bin_to_bin_piece_scan_location"><?= $Page->scan_location->caption() ?><?= $Page->scan_location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->scan_location->cellAttributes() ?>>
<template id="tpx_bin_to_bin_piece_scan_location"><span id="el_bin_to_bin_piece_scan_location">
<input type="<?= $Page->scan_location->getInputTextType() ?>" name="x_scan_location" id="x_scan_location" data-table="bin_to_bin_piece" data-field="x_scan_location" value="<?= $Page->scan_location->EditValue ?>" size="30" maxlength="8" placeholder="<?= HtmlEncode($Page->scan_location->getPlaceHolder()) ?>"<?= $Page->scan_location->editAttributes() ?> aria-describedby="x_scan_location_help">
<?= $Page->scan_location->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->scan_location->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <div id="r_article"<?= $Page->article->rowAttributes() ?>>
        <label id="elh_bin_to_bin_piece_article" for="x_article" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_bin_to_bin_piece_article"><?= $Page->article->caption() ?><?= $Page->article->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->article->cellAttributes() ?>>
<template id="tpx_bin_to_bin_piece_article"><span id="el_bin_to_bin_piece_article">
<input type="<?= $Page->article->getInputTextType() ?>" name="x_article" id="x_article" data-table="bin_to_bin_piece" data-field="x_article" value="<?= $Page->article->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->article->getPlaceHolder()) ?>"<?= $Page->article->editAttributes() ?> aria-describedby="x_article_help">
<?= $Page->article->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->article->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->description->Visible) { // description ?>
    <div id="r_description"<?= $Page->description->rowAttributes() ?>>
        <label id="elh_bin_to_bin_piece_description" for="x_description" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_bin_to_bin_piece_description"><?= $Page->description->caption() ?><?= $Page->description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->description->cellAttributes() ?>>
<template id="tpx_bin_to_bin_piece_description"><span id="el_bin_to_bin_piece_description">
<input type="<?= $Page->description->getInputTextType() ?>" name="x_description" id="x_description" data-table="bin_to_bin_piece" data-field="x_description" value="<?= $Page->description->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->description->getPlaceHolder()) ?>"<?= $Page->description->editAttributes() ?> aria-describedby="x_description_help">
<?= $Page->description->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->description->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->scan_article->Visible) { // scan_article ?>
    <div id="r_scan_article"<?= $Page->scan_article->rowAttributes() ?>>
        <label id="elh_bin_to_bin_piece_scan_article" for="x_scan_article" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_bin_to_bin_piece_scan_article"><?= $Page->scan_article->caption() ?><?= $Page->scan_article->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->scan_article->cellAttributes() ?>>
<template id="tpx_bin_to_bin_piece_scan_article"><span id="el_bin_to_bin_piece_scan_article">
<input type="<?= $Page->scan_article->getInputTextType() ?>" name="x_scan_article" id="x_scan_article" data-table="bin_to_bin_piece" data-field="x_scan_article" value="<?= $Page->scan_article->EditValue ?>" size="30" maxlength="31" placeholder="<?= HtmlEncode($Page->scan_article->getPlaceHolder()) ?>"<?= $Page->scan_article->editAttributes() ?> aria-describedby="x_scan_article_help">
<?= $Page->scan_article->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->scan_article->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->destination_location->Visible) { // destination_location ?>
    <div id="r_destination_location"<?= $Page->destination_location->rowAttributes() ?>>
        <label id="elh_bin_to_bin_piece_destination_location" for="x_destination_location" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_bin_to_bin_piece_destination_location"><?= $Page->destination_location->caption() ?><?= $Page->destination_location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->destination_location->cellAttributes() ?>>
<template id="tpx_bin_to_bin_piece_destination_location"><span id="el_bin_to_bin_piece_destination_location">
<input type="<?= $Page->destination_location->getInputTextType() ?>" name="x_destination_location" id="x_destination_location" data-table="bin_to_bin_piece" data-field="x_destination_location" value="<?= $Page->destination_location->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->destination_location->getPlaceHolder()) ?>"<?= $Page->destination_location->editAttributes() ?> aria-describedby="x_destination_location_help">
<?= $Page->destination_location->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->destination_location->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->su->Visible) { // su ?>
    <div id="r_su"<?= $Page->su->rowAttributes() ?>>
        <label id="elh_bin_to_bin_piece_su" for="x_su" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_bin_to_bin_piece_su"><?= $Page->su->caption() ?><?= $Page->su->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->su->cellAttributes() ?>>
<template id="tpx_bin_to_bin_piece_su"><span id="el_bin_to_bin_piece_su">
<input type="<?= $Page->su->getInputTextType() ?>" name="x_su" id="x_su" data-table="bin_to_bin_piece" data-field="x_su" value="<?= $Page->su->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->su->getPlaceHolder()) ?>"<?= $Page->su->editAttributes() ?> aria-describedby="x_su_help">
<?= $Page->su->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->su->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->qty->Visible) { // qty ?>
    <div id="r_qty"<?= $Page->qty->rowAttributes() ?>>
        <label id="elh_bin_to_bin_piece_qty" for="x_qty" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_bin_to_bin_piece_qty"><?= $Page->qty->caption() ?><?= $Page->qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->qty->cellAttributes() ?>>
<template id="tpx_bin_to_bin_piece_qty"><span id="el_bin_to_bin_piece_qty">
<input type="<?= $Page->qty->getInputTextType() ?>" name="x_qty" id="x_qty" data-table="bin_to_bin_piece" data-field="x_qty" value="<?= $Page->qty->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->qty->getPlaceHolder()) ?>"<?= $Page->qty->editAttributes() ?> aria-describedby="x_qty_help">
<?= $Page->qty->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->qty->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->actual->Visible) { // actual ?>
    <div id="r_actual"<?= $Page->actual->rowAttributes() ?>>
        <label id="elh_bin_to_bin_piece_actual" for="x_actual" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_bin_to_bin_piece_actual"><?= $Page->actual->caption() ?><?= $Page->actual->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->actual->cellAttributes() ?>>
<template id="tpx_bin_to_bin_piece_actual"><span id="el_bin_to_bin_piece_actual">
<input type="<?= $Page->actual->getInputTextType() ?>" name="x_actual" id="x_actual" data-table="bin_to_bin_piece" data-field="x_actual" value="<?= $Page->actual->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->actual->getPlaceHolder()) ?>"<?= $Page->actual->editAttributes() ?> aria-describedby="x_actual_help">
<?= $Page->actual->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->actual->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->user->Visible) { // user ?>
    <div id="r_user"<?= $Page->user->rowAttributes() ?>>
        <label id="elh_bin_to_bin_piece_user" for="x_user" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_bin_to_bin_piece_user"><?= $Page->user->caption() ?><?= $Page->user->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->user->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$Page->userIDAllow("edit")) { // Non system admin ?>
<span<?= $Page->user->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->user->getDisplayValue($Page->user->EditValue))) ?>"></span>
<input type="hidden" data-table="bin_to_bin_piece" data-field="x_user" data-hidden="1" name="x_user" id="x_user" value="<?= HtmlEncode($Page->user->CurrentValue) ?>">
<?php } else { ?>
<template id="tpx_bin_to_bin_piece_user"><span id="el_bin_to_bin_piece_user">
<input type="<?= $Page->user->getInputTextType() ?>" name="x_user" id="x_user" data-table="bin_to_bin_piece" data-field="x_user" value="<?= $Page->user->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->user->getPlaceHolder()) ?>"<?= $Page->user->editAttributes() ?> aria-describedby="x_user_help">
<?= $Page->user->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->user->getErrorMessage() ?></div>
</span></template>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_bin_to_bin_piece_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_bin_to_bin_piece_status"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<template id="tpx_bin_to_bin_piece_status"><span id="el_bin_to_bin_piece_status">
<input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="bin_to_bin_piece" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_bin_to_bin_pieceedit" class="ew-custom-template"></div>
<template id="tpm_bin_to_bin_pieceedit">
<div id="ct_BinToBinPieceEdit"><script type="text/javascript">
</script>
<script type="text/javascript">

function skip3() {
  $("#x_destination_location").val("Empty");
  $("#x_su").val("0");
  $("#x_status").val("Incomplete");
}
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
    .select2-results__options{
    	list-style-position: outside !important;
    }
</style>
<div class="main-form" >
    <div class="card">
        <div class="card-body">    
            <div class="formbuilder-item" hidden>
                <h2 class="Location" id="control-225011"><slot class="ew-slot" name="tpc_bin_to_bin_piece_id"></slot>&nbsp;<slot class="ew-slot" name="tpx_bin_to_bin_piece_id"></slot></h2>
            </div>
            <div id="r_date_upload" class="formbuilder-item" hidden >
                 <label for="x_date_upload" class="col-sm-2 col-form-label"><?= $Page->date_upload->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_bin_to_bin_piece_date_upload"></slot></div>
            </div>
            <div id="r_source_location" class="formbuilder-item">
                 <label for="x_source_location" class="col-sm-2 col-form-label"><?= $Page->source_location->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_bin_to_bin_piece_source_location"></slot></div>
            </div>
            <div id="r_scan_location" class="formbuilder-item">
                 <label for="x_scan_location" class="col-sm-2 col-form-label"><?= $Page->scan_location->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_bin_to_bin_piece_scan_location"></slot></div>
            </div>
            <div id="r_article" class="formbuilder-item">
                 <label for="x_article" class="col-sm-2 col-form-label"><?= $Page->article->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_bin_to_bin_piece_article"></slot></div>
            </div>
            <div id="r_description" class="formbuilder-item">
                 <label for="x_description" class="col-sm-2 col-form-label"><?= $Page->description->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_bin_to_bin_piece_description"></slot></div>
            </div>
            <div id="r_qty" class="formbuilder-item">
                 <label for="x_qty" class="col-sm-2 col-form-label"><?= $Page->qty->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_bin_to_bin_piece_qty"></slot></div>
            </div>
            <div id="r_scan_article" class="scan-input">
                 <label for="x_scan_article" class="col-sm-2 col-form-label"><?= $Page->scan_article->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_bin_to_bin_piece_scan_article"></slot></div>
            </div>
            <div id="r_actual" class="formbuilder-item">
                 <label for="x_actual" class="col-sm-2 col-form-label"><?= $Page->actual->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_bin_to_bin_piece_actual"></slot></div>
            </div>
            <div id="r_destination_location" class="formbuilder-item">
                 <label for="x_destination_location" class="col-sm-2 col-form-label"><?= $Page->destination_location->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_bin_to_bin_piece_destination_location"></slot></div>
            </div>
            <div id="r_su" class="formbuilder-item">
                 <label for="x_su" class="col-sm-2 col-form-label"><?= $Page->su->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_bin_to_bin_piece_su"></slot></div>
            </div>
            <div id="r_status" class="formbuilder-item" hidden>
                 <label for="x_status" class="col-sm-2 col-form-label"><?= $Page->status->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_bin_to_bin_piece_status"></slot></div>
            </div>
            <div id="r_user" class="formbuilder-item" hidden>
                 <label for="x_user" class="col-sm-2 col-form-label"><?= $Page->user->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_bin_to_bin_piece_user"></slot></div>
            </div>
            <div id="r_date_confirmation" class="formbuilder-item" hidden>
                 <label for="x_date_confirmation" class="col-sm-2 col-form-label"><?= $Page->date_confirmation->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_bin_to_bin_piece_date_confirmation"></slot></div>
            </div>
            <div id="r_time_confirmation" class="formbuilder-item" hidden>
                 <label for="x_time_confirmation" class="col-sm-2 col-form-label"><?= $Page->time_confirmation->caption() ?></label>
                  <div class="col-sm-10"><slot class="ew-slot" name="tpx_bin_to_bin_piece_time_confirmation"></slot></div>
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
    ew.applyTemplate("tpd_bin_to_bin_pieceedit", "tpm_bin_to_bin_pieceedit", "bin_to_bin_pieceedit", "<?= $Page->CustomExport ?>", ew.templateData.rows[0]);
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
    ew.addEventHandlers("bin_to_bin_piece");
});
</script>
<script>
loadjs.ready("load", function () {
    // Startup script
    // Write your table-specific startup script here, no need to add script tags.
    $(document).ready(function () {
      $(document).on("focus", "input[type=text]", function () {
        this.select();
      });
      $("#x_scan_location").focus();
      $("#btn-action").after(
        '<button class="btn btn-danger ew-btn" name="btn-action" id="btn-action" type="submit" onclick="skip3()">Skip</button>'
      );
      $(document).on("input", "#x_scan_location", function () {
                if ($("#x_scan_location").val() == $("#x_source_location").val())
                {
                $("#el_bin_to_bin_piece_destination_location").show(); // atribut text
                $("#el_bin_to_bin_piece_su").show();// atribut text
                $("#x_scan_location").css({ color: 'green'}); // warna text
                $("#x_scan_location").attr('readonly', true); // atribut text
                $("#x_scan_location").blur();
                $("#x_scan_article").focus(); // pindah focus
                }
                else
                {
                alert('Wrong Location !!');
                $("#x_scan_location").val("");
                $("#x_scan_location").focus();
                }
            });
       $("#x_scan_article").on("keydown", function (e) {
       	if (e.which == 13 || e.keycode == 13) {
        //alert('clikced');
        const element = document.getElementById("x_scan_article");
        $("#x_scan_article").focus();
        if (element.readOnly) {
          //console.log("✅ element is read-only");
          event.preventDefault();
          $("#x_scan_article").blur();
          $("#x_destination_location").focus();
        }
        else {
        $("#x_scan_article").focus();
        event.preventDefault();
        return false;
        }
      }
      });

     // $("#x_scan_article").keypress(function (event) {
     //   if ((event.keyCode || event.which) == 13) {
     //     event.preventDefault();
     //     return false;
     //   }
     // });
      $("#x_destination_location").keypress(function (event) {
        if ((event.keyCode || event.which) == 13) {
          event.preventDefault();
          $("#x_destination_location").attr('readonly', true); // atribut text
          $("#x_su").focus();
          return false;
        }
      });
      $("#x_su").keypress(function (event) {
        if ((event.keyCode || event.which) == 13) {
          event.preventDefault();
          $("#x_su").attr('readonly', true); // atribut text
          $("#btn-action").focus();
          return false;
        }
      });
      $(document).on("input", "#x_scan_article", function () {
        var picked = $("#x_actual").val();
        var actual = 1;
        var target = $("#x_qty").val();
        var result = parseInt(picked) + parseInt(actual);
        if ($("#x_scan_article").val().length == 30) {
          scan1 = $("#x_scan_article").val().substring(4, 14);
          scan2 = $("#x_scan_article").val().substring(18, 21);
          scan3 = $("#x_scan_article").val().substring(12, 17);
          $("#x_scan_article").val(scan1 + scan2 + scan3);
          if ($("#x_scan_article").val() == $("#x_article").val()) {
            $("#x_scan_article").css({ color: "green" }); // warna text
            $("#x_scan_article").focus();
            $("#x_actual").val(result);
            //Check Qty Target & Actual
            if (target == result) {
              $("#x_scan_article").attr("readonly", true);
              $("#x_status").val("Complete");
              //$("#x_destination_location").focus();
              //alert('Qty Match!!');
            }
            else if (target !== result) {
              $("#x_status").val("Incomplete");
              //alert('Shortpick');
            }
            //end
          } else {
            alert("Wrong Article !!");
            $("#x_scan_article").val("");
            $("#x_scan_article").focus();
          }
          //alert("type 1");
        }
        if (
          $("#x_scan_article").val().length == 29 &&
          $("#x_scan_article").val().substring(2, 3) == 1
        ) {
          scan4 = $("#x_scan_article").val().substring(2, 3);
          scan5 = $("#x_scan_article").val().substring(3, 12);
          scan6 = $("#x_scan_article").val().substring(17, 19);
          scan7 = $("#x_scan_article").val().substring(1, 2);
          scan8 = $("#x_scan_article").val().substring(12, 15);
          $("#x_scan_article").val(scan4 + scan5 + scan6 + scan7 + scan8);
          if ($("#x_scan_article").val() == $("#x_article").val()) {
            $("#x_scan_article").css({ color: "green" }); // warna text
            $("#x_scan_article").focus();
            $("#x_actual").val(result);
            //Check Qty Target & Actual
            if (target == result) {
              $("#x_scan_article").attr("readonly", true);
              $("#x_status").val("Complete");
              //$("#x_destination_location").focus();
              //alert('Qty Match!!');
            }
            else if (target !== result) {
              $("#x_status").val("Incomplete");
              //alert('Shortpick');
            }
            //end
          } else {
            alert("Wrong Article !!");
            $("#x_scan_article").val("");
            $("#x_scan_article").focus();
          }
          //alert("type 2");
        } else if (
          $("#x_scan_article").val().length == 29 &&
          $("#x_scan_article").val().substring(2, 3) !== 1
        ) {
          scan9 = $("#x_scan_article").val().substring(3, 12);
          scan10 = $("#x_scan_article").val().substring(17, 19);
          scan11 = $("#x_scan_article").val().substring(1, 2);
          scan12 = $("#x_scan_article").val().substring(12, 15);
          $("#x_scan_article").val(scan9 + scan10 + scan11 + scan12);
          if ($("#x_scan_article").val() == $("#x_article").val()) {
            $("#x_scan_article").css({ color: "green" }); // warna text
            $("#x_scan_article").focus();
            $("#x_actual").val(result);
            //Check Qty Target & Actual
            if (target == result) {
              $("#x_scan_article").attr("readonly", true);
              $("#x_status").val("Complete");
              //$("#x_destination_location").focus();
              //alert('Qty Match!!');
            }
            else if (target !== result) {
              $("#x_status").val("Incomplete");
              //alert('Shortpick');
            }
            //end
          } else {
            alert("Wrong Article !!");
            $("#x_scan_article").val("");
            $("#x_scan_article").focus();
          }
          //alert("type 3");
        } else if ($("#x_scan_article").val().length <= 29) {
          if ($("#x_scan_article").val() == $("#x_article").val()) {
            $("#x_scan_article").css({ color: "green" }); // warna text
            $("#x_scan_article").focus();
            $("#x_actual").val(result);
            //Check Qty Target & Actual
            if (target == result) {
              $("#x_scan_article").attr("readonly", true);
              $("#x_status").val("Complete");
              //$("#x_destination_location").focus();
              //alert('Complete');
            }
            else if (target !== result) {
              $("#x_status").val("Incomplete");
              //alert('Incomplete');
            }
            //end
          } else {
            alert("Wrong Article !!");
            $("#x_scan_article").val("");
            $("#x_scan_article").focus();
          }
          //alert("type 4");
        }
      });
    });
});
</script>
