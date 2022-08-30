<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$PriceTagAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { price_tag: currentTable } });
var currentForm, currentPageID;
var fprice_tagadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fprice_tagadd = new ew.Form("fprice_tagadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fprice_tagadd;

    // Add fields
    var fields = currentTable.fields;
    fprice_tagadd.addFields([
        ["location", [fields.location.visible && fields.location.required ? ew.Validators.required(fields.location.caption) : null], fields.location.isInvalid],
        ["ctn", [fields.ctn.visible && fields.ctn.required ? ew.Validators.required(fields.ctn.caption) : null], fields.ctn.isInvalid],
        ["scan", [fields.scan.visible && fields.scan.required ? ew.Validators.required(fields.scan.caption) : null], fields.scan.isInvalid],
        ["gtin", [fields.gtin.visible && fields.gtin.required ? ew.Validators.required(fields.gtin.caption) : null], fields.gtin.isInvalid],
        ["gtin2", [fields.gtin2.visible && fields.gtin2.required ? ew.Validators.required(fields.gtin2.caption) : null], fields.gtin2.isInvalid],
        ["gtin3", [fields.gtin3.visible && fields.gtin3.required ? ew.Validators.required(fields.gtin3.caption) : null], fields.gtin3.isInvalid],
        ["article", [fields.article.visible && fields.article.required ? ew.Validators.required(fields.article.caption) : null], fields.article.isInvalid]
    ]);

    // Form_CustomValidate
    fprice_tagadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fprice_tagadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fprice_tagadd");
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
<form name="fprice_tagadd" id="fprice_tagadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="price_tag">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div d-none"><!-- page* -->
<?php if ($Page->location->Visible) { // location ?>
    <div id="r_location"<?= $Page->location->rowAttributes() ?>>
        <label id="elh_price_tag_location" for="x_location" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_price_tag_location"><?= $Page->location->caption() ?><?= $Page->location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->location->cellAttributes() ?>>
<template id="tpx_price_tag_location"><span id="el_price_tag_location">
<input type="<?= $Page->location->getInputTextType() ?>" name="x_location" id="x_location" data-table="price_tag" data-field="x_location" value="<?= $Page->location->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->location->getPlaceHolder()) ?>"<?= $Page->location->editAttributes() ?> aria-describedby="x_location_help">
<?= $Page->location->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->location->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ctn->Visible) { // ctn ?>
    <div id="r_ctn"<?= $Page->ctn->rowAttributes() ?>>
        <label id="elh_price_tag_ctn" for="x_ctn" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_price_tag_ctn"><?= $Page->ctn->caption() ?><?= $Page->ctn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ctn->cellAttributes() ?>>
<template id="tpx_price_tag_ctn"><span id="el_price_tag_ctn">
<input type="<?= $Page->ctn->getInputTextType() ?>" name="x_ctn" id="x_ctn" data-table="price_tag" data-field="x_ctn" value="<?= $Page->ctn->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->ctn->getPlaceHolder()) ?>"<?= $Page->ctn->editAttributes() ?> aria-describedby="x_ctn_help">
<?= $Page->ctn->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ctn->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->scan->Visible) { // scan ?>
    <div id="r_scan"<?= $Page->scan->rowAttributes() ?>>
        <label id="elh_price_tag_scan" for="x_scan" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_price_tag_scan"><?= $Page->scan->caption() ?><?= $Page->scan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->scan->cellAttributes() ?>>
<template id="tpx_price_tag_scan"><span id="el_price_tag_scan">
<input type="<?= $Page->scan->getInputTextType() ?>" name="x_scan" id="x_scan" data-table="price_tag" data-field="x_scan" value="<?= $Page->scan->EditValue ?>" maxlength="32" placeholder="<?= HtmlEncode($Page->scan->getPlaceHolder()) ?>"<?= $Page->scan->editAttributes() ?> aria-describedby="x_scan_help">
<?= $Page->scan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->scan->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gtin->Visible) { // gtin ?>
    <div id="r_gtin"<?= $Page->gtin->rowAttributes() ?>>
        <label id="elh_price_tag_gtin" for="x_gtin" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_price_tag_gtin"><?= $Page->gtin->caption() ?><?= $Page->gtin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->gtin->cellAttributes() ?>>
<template id="tpx_price_tag_gtin"><span id="el_price_tag_gtin">
<input type="<?= $Page->gtin->getInputTextType() ?>" name="x_gtin" id="x_gtin" data-table="price_tag" data-field="x_gtin" value="<?= $Page->gtin->EditValue ?>" placeholder="<?= HtmlEncode($Page->gtin->getPlaceHolder()) ?>"<?= $Page->gtin->editAttributes() ?> aria-describedby="x_gtin_help">
<?= $Page->gtin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gtin->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gtin2->Visible) { // gtin2 ?>
    <div id="r_gtin2"<?= $Page->gtin2->rowAttributes() ?>>
        <label id="elh_price_tag_gtin2" for="x_gtin2" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_price_tag_gtin2"><?= $Page->gtin2->caption() ?><?= $Page->gtin2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->gtin2->cellAttributes() ?>>
<template id="tpx_price_tag_gtin2"><span id="el_price_tag_gtin2">
<input type="<?= $Page->gtin2->getInputTextType() ?>" name="x_gtin2" id="x_gtin2" data-table="price_tag" data-field="x_gtin2" value="<?= $Page->gtin2->EditValue ?>" placeholder="<?= HtmlEncode($Page->gtin2->getPlaceHolder()) ?>"<?= $Page->gtin2->editAttributes() ?> aria-describedby="x_gtin2_help">
<?= $Page->gtin2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gtin2->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gtin3->Visible) { // gtin3 ?>
    <div id="r_gtin3"<?= $Page->gtin3->rowAttributes() ?>>
        <label id="elh_price_tag_gtin3" for="x_gtin3" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_price_tag_gtin3"><?= $Page->gtin3->caption() ?><?= $Page->gtin3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->gtin3->cellAttributes() ?>>
<template id="tpx_price_tag_gtin3"><span id="el_price_tag_gtin3">
<input type="<?= $Page->gtin3->getInputTextType() ?>" name="x_gtin3" id="x_gtin3" data-table="price_tag" data-field="x_gtin3" value="<?= $Page->gtin3->EditValue ?>" placeholder="<?= HtmlEncode($Page->gtin3->getPlaceHolder()) ?>"<?= $Page->gtin3->editAttributes() ?> aria-describedby="x_gtin3_help">
<?= $Page->gtin3->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gtin3->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->article->Visible) { // article ?>
    <div id="r_article"<?= $Page->article->rowAttributes() ?>>
        <label id="elh_price_tag_article" for="x_article" class="<?= $Page->LeftColumnClass ?>"><template id="tpc_price_tag_article"><?= $Page->article->caption() ?><?= $Page->article->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></template></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->article->cellAttributes() ?>>
<template id="tpx_price_tag_article"><span id="el_price_tag_article">
<input type="<?= $Page->article->getInputTextType() ?>" name="x_article" id="x_article" data-table="price_tag" data-field="x_article" value="<?= $Page->article->EditValue ?>" size="30" maxlength="45" placeholder="<?= HtmlEncode($Page->article->getPlaceHolder()) ?>"<?= $Page->article->editAttributes() ?> aria-describedby="x_article_help">
<?= $Page->article->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->article->getErrorMessage() ?></div>
</span></template>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<div id="tpd_price_tagadd" class="ew-custom-template"></div>
<template id="tpm_price_tagadd">
<div id="ct_PriceTagAdd"><script type="text/javascript">
		$('body').on('keydown', 'input, select', function(e) { // ganti enter jadi tab di setiap input
            if (e.key === "Enter") {
                var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
                focusable = form.find('input,a,select,textarea,button').filter(":input:not([readonly])");
                next = focusable.eq(focusable.index(this)+1);
                if (next.length) {
                    next.focus();
                } else {
                    form.submit(function (){
                    //window.location = 'http://localhost/opsvaliram/pickingappsedit?start=1';
                    return false;
                });
                }
                return false;
            }
        });
        $("#x_location").change(function (i) {
            if(i.keyCode === "Enter" && $("#x_location").val().length >= 8) {
            $("#x_ctn").focus(); // pindah focus
            }
            if(i.keyCode === "Enter" && $("#x_location").val().length <= 8) {
            alert('Lokasi Salah!!!');
            $("#x_location").focus(); // fokus
            }
        });
        $("#x_ctn").change(function () {
            if(i.keyCode === "Enter" && $("#x_ctn").val().length >= 1) {
            $("#x_scan").focus(); // pindah focus
            }
        });
       $(document).ready(function () {
         $("#x_scan").on("change", function () {
           $("#btn-action").focus();
         });
       });
       $(document).ready(function() {
         $("#btn-action").on('focus', function() {
            this.form.submit();
             });
         });
</script>
<style>
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
	<div id="r_get_total" class="mb-3 row">
        <label for="x_get_total" class="col-sm-2 col-form-label">Total Article</label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_price_tag_quantity"></slot></div>
    </div>
    <div id="r_location" class="mb-3 row">
        <label for="x_location" class="col-sm-2 col-form-label"><?= $Page->location->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_price_tag_location"></slot></div>
    </div>
    <div id="r_su" class="mb-3 row" >
        <label for="x_ctn" class="col-sm-2 col-form-label"><?= $Page->ctn->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_price_tag_ctn"></slot></div>
    </div>
    <div id="r_scan" class="mb-3 row">
        <label for="x_scan" class="col-sm-2 col-form-label"><?= $Page->scan->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_price_tag_scan"></slot></div>
    </div>
    <div id="r_scan" class="mb-3 row" >
        <label for="x_gtin" class="col-sm-2 col-form-label"><?= $Page->gtin->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_price_tag_gtin"></slot></div>
    </div>
    <div id="r_scan" class="mb-3 row" >
        <label for="x_gtin2" class="col-sm-2 col-form-label"><?= $Page->gtin2->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_price_tag_gtin2"></slot></div>
    </div>
    <div id="r_scan" class="mb-3 row" >
        <label for="x_gtin3" class="col-sm-2 col-form-label"><?= $Page->gtin3->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_price_tag_gtin3"></slot></div>
    </div>
    <div id="r_article" class="mb-3 row">
        <label for="x_article" class="col-sm-2 col-form-label"><?= $Page->article->caption() ?></label>
        <div class="col-sm-10"><slot class="ew-slot" name="tpx_price_tag_article"></slot></div>
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
    ew.applyTemplate("tpd_price_tagadd", "tpm_price_tagadd", "price_tagadd", "<?= $Page->CustomExport ?>", ew.templateData.rows[0]);
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
    ew.addEventHandlers("price_tag");
});
</script>
<script>
loadjs.ready("load", function () {
    // Startup script
    // Write your table-specific startup script here, no need to add script tags.
    $(document).ready(function() {
        		$("#x_location").attr('disabled', true);
        		$("#x_ctn").attr('disabled', true);
        		$(document).on('focus','input[type=text]',function(){ this.select(); });
        		$("#x_scan").focus();
        		$("#btn-action").after('<button class="btn btn-danger ew-btn" name="btn-action" id="btn-reset" type="button" onclick="clearForm()">Reset</button>');
        	$("#x_scan").change(function () {
                    if ($("#x_location").val() !== "")
                    {
                    	$("#x_location").attr('disabled', false);
                    	$("#x_ctn").attr('disabled', false);
                    	//Price Tag
                    	if ($("#x_scan").val().length == 32)
                    	{
                    		//GTIN 1
                    		scan1 = $("#x_scan").val().substring(2,7);
                    		scan2 = $("#x_scan").val().substring(19,20);
                    		scan3 = $("#x_scan").val().substring(13,15);
                    		scan4 = $("#x_scan").val().substring(20,21);
                    		scan5 = $("#x_scan").val().substring(24,25);
                    		scan6 = $("#x_scan").val().substring(17,19);
                    		$("#x_gtin").val(scan1+scan2+scan3+scan4+scan5+scan6);
                    		//GTIN 2		
                            scan12 = $("#x_scan").val().substring(2,7);
                    		scan13 = $("#x_scan").val().substring(19,20);
                    		scan14 = $("#x_scan").val().substring(13,19);
                    		$("#x_gtin2").val(scan12+scan13+scan14);
                    	}
                    	if ($("#x_scan").val().length == 22)
                    	{
                    		//GTIN 3
                            scan7 = $("#x_scan").val().substring(2,7);
                    		scan8 = $("#x_scan").val().substring(11,12);
                    		scan9 = $("#x_scan").val().substring(7,9);
                    		scan10 = $("#x_scan").val().substring(9,11);
                    		scan11 = $("#x_scan").val().substring(12,14);
                    		$("#x_gtin3").val(scan7+scan8+scan9+scan10+scan11);
                    	}

                    	//QR Code
                    	if ($("#x_scan").val().length == 30)
                    	{
                    		scan1 = $("#x_scan").val().substring(4,14);
                    		scan2 = $("#x_scan").val().substring(18,21);
                    		scan3 = $("#x_scan").val().substring(12,17);
                    		$("#x_article").val(scan1+scan2+scan3);
                            //alert('type 1');
                    	}
                        if ($("#x_scan").val().length == 29 && $("#x_scan").val().substring(2,3) == 1)
                    	{
                    		scan4 = $("#x_scan").val().substring(2,3);
                    		scan5 = $("#x_scan").val().substring(3,12);
                    		scan6 = $("#x_scan").val().substring(17,19);
                            scan7 = $("#x_scan").val().substring(1,2);
                            scan8 = $("#x_scan").val().substring(12,15);
                    		$("#x_article").val(scan4+scan5+scan6+scan7+scan8);
                            //alert('type 2');
                    	}
                        else if ($("#x_scan").val().length == 29 && $("#x_scan").val().substring(2,3) !== 1)
                    	{
                    		scan9 = $("#x_scan").val().substring(3,12);
                    		scan10 = $("#x_scan").val().substring(17,19);
                    		scan11 = $("#x_scan").val().substring(1,2);
                            scan12 = $("#x_scan").val().substring(12,15);
                    		$("#x_article").val(scan9+scan10+scan11+scan12);
                            //alert('type 3');
                    	}
                    }
                    else
                    {
                    $("#x_scan").val("")
                    }
                });
        });
});
</script>
