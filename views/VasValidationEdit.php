<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$VasValidationEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { vas_validation: currentTable } });
var currentForm, currentPageID;
var fvas_validationedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fvas_validationedit = new ew.Form("fvas_validationedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fvas_validationedit;

    // Add fields
    var fields = currentTable.fields;
    fvas_validationedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["order", [fields.order.visible && fields.order.required ? ew.Validators.required(fields.order.caption) : null], fields.order.isInvalid],
        ["po", [fields.po.visible && fields.po.required ? ew.Validators.required(fields.po.caption) : null], fields.po.isInvalid],
        ["sap_art", [fields.sap_art.visible && fields.sap_art.required ? ew.Validators.required(fields.sap_art.caption) : null], fields.sap_art.isInvalid],
        ["sub_index", [fields.sub_index.visible && fields.sub_index.required ? ew.Validators.required(fields.sub_index.caption) : null], fields.sub_index.isInvalid],
        ["concept", [fields.concept.visible && fields.concept.required ? ew.Validators.required(fields.concept.caption) : null], fields.concept.isInvalid],
        ["ctn", [fields.ctn.visible && fields.ctn.required ? ew.Validators.required(fields.ctn.caption) : null, ew.Validators.integer], fields.ctn.isInvalid],
        ["season2", [fields.season2.visible && fields.season2.required ? ew.Validators.required(fields.season2.caption) : null], fields.season2.isInvalid],
        ["qty_oss", [fields.qty_oss.visible && fields.qty_oss.required ? ew.Validators.required(fields.qty_oss.caption) : null, ew.Validators.integer], fields.qty_oss.isInvalid],
        ["shipment", [fields.shipment.visible && fields.shipment.required ? ew.Validators.required(fields.shipment.caption) : null], fields.shipment.isInvalid],
        ["aju", [fields.aju.visible && fields.aju.required ? ew.Validators.required(fields.aju.caption) : null], fields.aju.isInvalid],
        ["actual_price", [fields.actual_price.visible && fields.actual_price.required ? ew.Validators.required(fields.actual_price.caption) : null], fields.actual_price.isInvalid],
        ["price_foto", [fields.price_foto.visible && fields.price_foto.required ? ew.Validators.fileRequired(fields.price_foto.caption) : null], fields.price_foto.isInvalid],
        ["snow", [fields.snow.visible && fields.snow.required ? ew.Validators.required(fields.snow.caption) : null], fields.snow.isInvalid],
        ["remarks", [fields.remarks.visible && fields.remarks.required ? ew.Validators.required(fields.remarks.caption) : null], fields.remarks.isInvalid],
        ["date_upload", [fields.date_upload.visible && fields.date_upload.required ? ew.Validators.required(fields.date_upload.caption) : null, ew.Validators.datetime(fields.date_upload.clientFormatPattern)], fields.date_upload.isInvalid],
        ["user", [fields.user.visible && fields.user.required ? ew.Validators.required(fields.user.caption) : null], fields.user.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["date_update", [fields.date_update.visible && fields.date_update.required ? ew.Validators.required(fields.date_update.caption) : null], fields.date_update.isInvalid],
        ["time_update", [fields.time_update.visible && fields.time_update.required ? ew.Validators.required(fields.time_update.caption) : null], fields.time_update.isInvalid]
    ]);

    // Form_CustomValidate
    fvas_validationedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fvas_validationedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fvas_validationedit");
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
<form name="fvas_validationedit" id="fvas_validationedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="vas_validation">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_vas_validation_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_vas_validation_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="vas_validation" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->order->Visible) { // order ?>
    <div id="r_order"<?= $Page->order->rowAttributes() ?>>
        <label id="elh_vas_validation_order" for="x_order" class="<?= $Page->LeftColumnClass ?>"><?= $Page->order->caption() ?><?= $Page->order->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->order->cellAttributes() ?>>
<span id="el_vas_validation_order">
<input type="<?= $Page->order->getInputTextType() ?>" name="x_order" id="x_order" data-table="vas_validation" data-field="x_order" value="<?= $Page->order->EditValue ?>" size="30" maxlength="6" placeholder="<?= HtmlEncode($Page->order->getPlaceHolder()) ?>"<?= $Page->order->editAttributes() ?> aria-describedby="x_order_help">
<?= $Page->order->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->order->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->po->Visible) { // po ?>
    <div id="r_po"<?= $Page->po->rowAttributes() ?>>
        <label id="elh_vas_validation_po" for="x_po" class="<?= $Page->LeftColumnClass ?>"><?= $Page->po->caption() ?><?= $Page->po->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->po->cellAttributes() ?>>
<span id="el_vas_validation_po">
<input type="<?= $Page->po->getInputTextType() ?>" name="x_po" id="x_po" data-table="vas_validation" data-field="x_po" value="<?= $Page->po->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->po->getPlaceHolder()) ?>"<?= $Page->po->editAttributes() ?> aria-describedby="x_po_help">
<?= $Page->po->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->po->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sap_art->Visible) { // sap_art ?>
    <div id="r_sap_art"<?= $Page->sap_art->rowAttributes() ?>>
        <label id="elh_vas_validation_sap_art" for="x_sap_art" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sap_art->caption() ?><?= $Page->sap_art->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sap_art->cellAttributes() ?>>
<span id="el_vas_validation_sap_art">
<input type="<?= $Page->sap_art->getInputTextType() ?>" name="x_sap_art" id="x_sap_art" data-table="vas_validation" data-field="x_sap_art" value="<?= $Page->sap_art->EditValue ?>" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->sap_art->getPlaceHolder()) ?>"<?= $Page->sap_art->editAttributes() ?> aria-describedby="x_sap_art_help">
<?= $Page->sap_art->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sap_art->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sub_index->Visible) { // sub_index ?>
    <div id="r_sub_index"<?= $Page->sub_index->rowAttributes() ?>>
        <label id="elh_vas_validation_sub_index" for="x_sub_index" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sub_index->caption() ?><?= $Page->sub_index->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sub_index->cellAttributes() ?>>
<span id="el_vas_validation_sub_index">
<input type="<?= $Page->sub_index->getInputTextType() ?>" name="x_sub_index" id="x_sub_index" data-table="vas_validation" data-field="x_sub_index" value="<?= $Page->sub_index->EditValue ?>" size="30" maxlength="4" placeholder="<?= HtmlEncode($Page->sub_index->getPlaceHolder()) ?>"<?= $Page->sub_index->editAttributes() ?> aria-describedby="x_sub_index_help">
<?= $Page->sub_index->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sub_index->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->concept->Visible) { // concept ?>
    <div id="r_concept"<?= $Page->concept->rowAttributes() ?>>
        <label id="elh_vas_validation_concept" for="x_concept" class="<?= $Page->LeftColumnClass ?>"><?= $Page->concept->caption() ?><?= $Page->concept->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->concept->cellAttributes() ?>>
<span id="el_vas_validation_concept">
<input type="<?= $Page->concept->getInputTextType() ?>" name="x_concept" id="x_concept" data-table="vas_validation" data-field="x_concept" value="<?= $Page->concept->EditValue ?>" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->concept->getPlaceHolder()) ?>"<?= $Page->concept->editAttributes() ?> aria-describedby="x_concept_help">
<?= $Page->concept->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->concept->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
    <div id="r_ctn"<?= $Page->ctn->rowAttributes() ?>>
        <label id="elh_vas_validation_ctn" for="x_ctn" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ctn->caption() ?><?= $Page->ctn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ctn->cellAttributes() ?>>
<span id="el_vas_validation_ctn">
<input type="<?= $Page->ctn->getInputTextType() ?>" name="x_ctn" id="x_ctn" data-table="vas_validation" data-field="x_ctn" value="<?= $Page->ctn->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->ctn->getPlaceHolder()) ?>"<?= $Page->ctn->editAttributes() ?> aria-describedby="x_ctn_help">
<?= $Page->ctn->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ctn->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->season2->Visible) { // season2 ?>
    <div id="r_season2"<?= $Page->season2->rowAttributes() ?>>
        <label id="elh_vas_validation_season2" for="x_season2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->season2->caption() ?><?= $Page->season2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->season2->cellAttributes() ?>>
<span id="el_vas_validation_season2">
<input type="<?= $Page->season2->getInputTextType() ?>" name="x_season2" id="x_season2" data-table="vas_validation" data-field="x_season2" value="<?= $Page->season2->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->season2->getPlaceHolder()) ?>"<?= $Page->season2->editAttributes() ?> aria-describedby="x_season2_help">
<?= $Page->season2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->season2->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->qty_oss->Visible) { // qty_oss ?>
    <div id="r_qty_oss"<?= $Page->qty_oss->rowAttributes() ?>>
        <label id="elh_vas_validation_qty_oss" for="x_qty_oss" class="<?= $Page->LeftColumnClass ?>"><?= $Page->qty_oss->caption() ?><?= $Page->qty_oss->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->qty_oss->cellAttributes() ?>>
<span id="el_vas_validation_qty_oss">
<input type="<?= $Page->qty_oss->getInputTextType() ?>" name="x_qty_oss" id="x_qty_oss" data-table="vas_validation" data-field="x_qty_oss" value="<?= $Page->qty_oss->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->qty_oss->getPlaceHolder()) ?>"<?= $Page->qty_oss->editAttributes() ?> aria-describedby="x_qty_oss_help">
<?= $Page->qty_oss->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->qty_oss->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->shipment->Visible) { // shipment ?>
    <div id="r_shipment"<?= $Page->shipment->rowAttributes() ?>>
        <label id="elh_vas_validation_shipment" for="x_shipment" class="<?= $Page->LeftColumnClass ?>"><?= $Page->shipment->caption() ?><?= $Page->shipment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->shipment->cellAttributes() ?>>
<span id="el_vas_validation_shipment">
<input type="<?= $Page->shipment->getInputTextType() ?>" name="x_shipment" id="x_shipment" data-table="vas_validation" data-field="x_shipment" value="<?= $Page->shipment->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->shipment->getPlaceHolder()) ?>"<?= $Page->shipment->editAttributes() ?> aria-describedby="x_shipment_help">
<?= $Page->shipment->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->shipment->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->aju->Visible) { // aju ?>
    <div id="r_aju"<?= $Page->aju->rowAttributes() ?>>
        <label id="elh_vas_validation_aju" for="x_aju" class="<?= $Page->LeftColumnClass ?>"><?= $Page->aju->caption() ?><?= $Page->aju->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->aju->cellAttributes() ?>>
<span id="el_vas_validation_aju">
<input type="<?= $Page->aju->getInputTextType() ?>" name="x_aju" id="x_aju" data-table="vas_validation" data-field="x_aju" value="<?= $Page->aju->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->aju->getPlaceHolder()) ?>"<?= $Page->aju->editAttributes() ?> aria-describedby="x_aju_help">
<?= $Page->aju->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->aju->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->actual_price->Visible) { // actual_price ?>
    <div id="r_actual_price"<?= $Page->actual_price->rowAttributes() ?>>
        <label id="elh_vas_validation_actual_price" for="x_actual_price" class="<?= $Page->LeftColumnClass ?>"><?= $Page->actual_price->caption() ?><?= $Page->actual_price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->actual_price->cellAttributes() ?>>
<span id="el_vas_validation_actual_price">
<input type="<?= $Page->actual_price->getInputTextType() ?>" name="x_actual_price" id="x_actual_price" data-table="vas_validation" data-field="x_actual_price" value="<?= $Page->actual_price->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->actual_price->getPlaceHolder()) ?>"<?= $Page->actual_price->editAttributes() ?> aria-describedby="x_actual_price_help">
<?= $Page->actual_price->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->actual_price->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->price_foto->Visible) { // price_foto ?>
    <div id="r_price_foto"<?= $Page->price_foto->rowAttributes() ?>>
        <label id="elh_vas_validation_price_foto" class="<?= $Page->LeftColumnClass ?>"><?= $Page->price_foto->caption() ?><?= $Page->price_foto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->price_foto->cellAttributes() ?>>
<span id="el_vas_validation_price_foto">
<div id="fd_x_price_foto" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->price_foto->title() ?>" data-table="vas_validation" data-field="x_price_foto" name="x_price_foto" id="x_price_foto" lang="<?= CurrentLanguageID() ?>"<?= $Page->price_foto->editAttributes() ?> aria-describedby="x_price_foto_help"<?= ($Page->price_foto->ReadOnly || $Page->price_foto->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->price_foto->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->price_foto->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_price_foto" id= "fn_x_price_foto" value="<?= $Page->price_foto->Upload->FileName ?>">
<input type="hidden" name="fa_x_price_foto" id= "fa_x_price_foto" value="<?= (Post("fa_x_price_foto") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_price_foto" id= "fs_x_price_foto" value="255">
<input type="hidden" name="fx_x_price_foto" id= "fx_x_price_foto" value="<?= $Page->price_foto->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_price_foto" id= "fm_x_price_foto" value="<?= $Page->price_foto->UploadMaxFileSize ?>">
<table id="ft_x_price_foto" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->snow->Visible) { // snow ?>
    <div id="r_snow"<?= $Page->snow->rowAttributes() ?>>
        <label id="elh_vas_validation_snow" for="x_snow" class="<?= $Page->LeftColumnClass ?>"><?= $Page->snow->caption() ?><?= $Page->snow->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->snow->cellAttributes() ?>>
<span id="el_vas_validation_snow">
<input type="<?= $Page->snow->getInputTextType() ?>" name="x_snow" id="x_snow" data-table="vas_validation" data-field="x_snow" value="<?= $Page->snow->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->snow->getPlaceHolder()) ?>"<?= $Page->snow->editAttributes() ?> aria-describedby="x_snow_help">
<?= $Page->snow->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->snow->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->remarks->Visible) { // remarks ?>
    <div id="r_remarks"<?= $Page->remarks->rowAttributes() ?>>
        <label id="elh_vas_validation_remarks" for="x_remarks" class="<?= $Page->LeftColumnClass ?>"><?= $Page->remarks->caption() ?><?= $Page->remarks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->remarks->cellAttributes() ?>>
<span id="el_vas_validation_remarks">
<input type="<?= $Page->remarks->getInputTextType() ?>" name="x_remarks" id="x_remarks" data-table="vas_validation" data-field="x_remarks" value="<?= $Page->remarks->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->remarks->getPlaceHolder()) ?>"<?= $Page->remarks->editAttributes() ?> aria-describedby="x_remarks_help">
<?= $Page->remarks->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->remarks->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->date_upload->Visible) { // date_upload ?>
    <div id="r_date_upload"<?= $Page->date_upload->rowAttributes() ?>>
        <label id="elh_vas_validation_date_upload" for="x_date_upload" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date_upload->caption() ?><?= $Page->date_upload->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date_upload->cellAttributes() ?>>
<span id="el_vas_validation_date_upload">
<input type="<?= $Page->date_upload->getInputTextType() ?>" name="x_date_upload" id="x_date_upload" data-table="vas_validation" data-field="x_date_upload" value="<?= $Page->date_upload->EditValue ?>" placeholder="<?= HtmlEncode($Page->date_upload->getPlaceHolder()) ?>"<?= $Page->date_upload->editAttributes() ?> aria-describedby="x_date_upload_help">
<?= $Page->date_upload->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date_upload->getErrorMessage() ?></div>
<?php if (!$Page->date_upload->ReadOnly && !$Page->date_upload->Disabled && !isset($Page->date_upload->EditAttrs["readonly"]) && !isset($Page->date_upload->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fvas_validationedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fvas_validationedit", "x_date_upload", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_vas_validation_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_vas_validation_status">
<input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="vas_validation" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
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
    ew.addEventHandlers("vas_validation");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
