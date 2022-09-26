<?php

namespace PHPMaker2022\opsmezzanineupload;

// Page object
$PrintLabelView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { print_label: currentTable } });
var currentForm, currentPageID;
var fprint_labelview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fprint_labelview = new ew.Form("fprint_labelview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fprint_labelview;
    loadjs.done("fprint_labelview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fprint_labelview" id="fprint_labelview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="print_label">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table d-none">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_print_label_id"><template id="tpc_print_label_id"><?= $Page->id->caption() ?></template></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<template id="tpx_print_label_id"><span id="el_print_label_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->box_id->Visible) { // box_id ?>
    <tr id="r_box_id"<?= $Page->box_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_print_label_box_id"><template id="tpc_print_label_box_id"><?= $Page->box_id->caption() ?></template></span></td>
        <td data-name="box_id"<?= $Page->box_id->cellAttributes() ?>>
<template id="tpx_print_label_box_id"><span id="el_print_label_box_id">
<span<?= $Page->box_id->viewAttributes() ?>>
<?= $Page->box_id->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->priority->Visible) { // priority ?>
    <tr id="r_priority"<?= $Page->priority->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_print_label_priority"><template id="tpc_print_label_priority"><?= $Page->priority->caption() ?></template></span></td>
        <td data-name="priority"<?= $Page->priority->cellAttributes() ?>>
<template id="tpx_print_label_priority"><span id="el_print_label_priority">
<span<?= $Page->priority->viewAttributes() ?>>
<?= $Page->priority->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->store_code->Visible) { // store_code ?>
    <tr id="r_store_code"<?= $Page->store_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_print_label_store_code"><template id="tpc_print_label_store_code"><?= $Page->store_code->caption() ?></template></span></td>
        <td data-name="store_code"<?= $Page->store_code->cellAttributes() ?>>
<template id="tpx_print_label_store_code"><span id="el_print_label_store_code">
<span<?= $Page->store_code->viewAttributes() ?>>
<?= $Page->store_code->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->store_name->Visible) { // store_name ?>
    <tr id="r_store_name"<?= $Page->store_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_print_label_store_name"><template id="tpc_print_label_store_name"><?= $Page->store_name->caption() ?></template></span></td>
        <td data-name="store_name"<?= $Page->store_name->cellAttributes() ?>>
<template id="tpx_print_label_store_name"><span id="el_print_label_store_name">
<span<?= $Page->store_name->viewAttributes() ?>>
<?= $Page->store_name->getViewValue() ?></span>
</span></template>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_barcode->Visible) { // barcode ?>
    <tr id="r__barcode"<?= $Page->_barcode->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_print_label__barcode"><template id="tpc_print_label__barcode"><?= $Page->_barcode->caption() ?></template></span></td>
        <td data-name="_barcode"<?= $Page->_barcode->cellAttributes() ?>>
<template id="tpx_print_label__barcode" class="print_labelview">
<?= Barcode()->show($Page->box_id->CurrentValue, 'CODE128', 60) ?>
</template>
<template id="tpx_print_label__barcode"><span id="el_print_label__barcode">
<span<?= $Page->_barcode->viewAttributes() ?>><slot name="tpx_print_label__barcode"></slot></span>
</span></template>
</td>
    </tr>
<?php } ?>
</table>
<div id="tpd_print_labelview" class="ew-custom-template"></div>
<template id="tpm_print_labelview">
<div id="ct_PrintLabelView"><script>
$(document).ready(function() {
  window.onload = function(){
  	window.print();
  	window.onafterprint =
  	function() {
  	window.close = back();
  	 };
  }

  function back() {
    window.history.back();
  }
});
</script>
<!doctype html public "-//w3c//dtd xhtml 1.0 transitional//en" "http://www.w3.org/tr/xhtml1/dtd/xhtml1-transitional.dtd">
<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="ProgId" content="Excel.Sheet">
<meta name="Generator" content="Aspose.Cell 22.7.0">
<link rel="File-List" href="_files_files/filelist.xml">
<link rel="Edit-Time-Data" href="_files_files/editdata.mso">
<link rel="OLE-Object-Data" href="_files_files/oledata.mso">
<!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>DHLus3</o:Author>
  <o:LastPrinted>2022-07-13T09:08:27Z</o:LastPrinted>
  <o:Created>2021-04-14T00:45:19Z</o:Created>
  <o:LastSaved>2022-07-13T09:11:26Z</o:LastSaved>
</o:DocumentProperties>
</xml><![endif]-->
<style>
<!--table
 {mso-displayed-decimal-separator:"\.";
 mso-displayed-thousand-separator:"\,";}
@page
 {
 mso-header-data:"";
 mso-footer-data:"";
 margin:0.75in 0.7in 0.75in 0.7in;
 mso-header-margin:0.3in;
 mso-footer-margin:0.3in;
 mso-page-orientation:Portrait;
 }
tr
 {mso-height-source:auto;
 mso-ruby-visibility:none;}
col
 {mso-width-source:auto;
 mso-ruby-visibility:none;}
br
 {mso-data-placement:same-cell;}
ruby
 {ruby-align:left;}
.style0
 {
 mso-number-format:General;
 text-align:general;
 vertical-align:bottom;
 white-space:nowrap;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:11pt;
 font-weight:400;
 font-style:normal;
 font-family:"Calibri","sans-serif";
 mso-protection:locked visible;
 mso-style-name:Normal;
 mso-style-id:0;}
td
 {mso-style-parent:style0;
 mso-number-format:General;
 text-align:general;
 vertical-align:bottom;
 white-space:nowrap;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:11pt;
 font-weight:400;
 font-style:normal;
 font-family:"Calibri","sans-serif";
 mso-protection:locked visible;
 mso-ignore:padding;}
.x15
 {
 mso-number-format:General;
 text-align:general;
 vertical-align:bottom;
 white-space:nowrap;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:11pt;
 font-weight:400;
 font-style:normal;
 font-family:"Calibri","sans-serif";
 mso-protection:locked visible;
 }
.x23
 {
 mso-number-format:General;
 text-align:center;
 vertical-align:middle;
 white-space:normal;word-wrap:break-word;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:16pt;
 font-weight:400;
 font-style:normal;
 font-family:"Arial Black","sans-serif";
 border-top:1px solid windowtext;
 border-right:none;
 border-bottom:none;
 border-left:1px solid windowtext;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x24
 {
 mso-number-format:General;
 text-align:center;
 vertical-align:middle;
 white-space:normal;word-wrap:break-word;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:16pt;
 font-weight:400;
 font-style:normal;
 font-family:"Arial Black","sans-serif";
 border-top:1px solid windowtext;
 border-right:none;
 border-bottom:none;
 border-left:none;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x25
 {
 mso-number-format:General;
 text-align:center;
 vertical-align:middle;
 white-space:normal;word-wrap:break-word;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:16pt;
 font-weight:400;
 font-style:normal;
 font-family:"Arial Black","sans-serif";
 border-top:1px solid windowtext;
 border-right:1px solid windowtext;
 border-bottom:none;
 border-left:none;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x26
 {
 mso-number-format:General;
 text-align:center;
 vertical-align:middle;
 white-space:normal;word-wrap:break-word;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:16pt;
 font-weight:400;
 font-style:normal;
 font-family:"Arial Black","sans-serif";
 border-top:none;
 border-right:none;
 border-bottom:none;
 border-left:1px solid windowtext;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x27
 {
 mso-number-format:General;
 text-align:center;
 vertical-align:middle;
 white-space:normal;word-wrap:break-word;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:16pt;
 font-weight:400;
 font-style:normal;
 font-family:"Arial Black","sans-serif";
 mso-protection:locked visible;
 }
.x28
 {
 mso-number-format:General;
 text-align:center;
 vertical-align:middle;
 white-space:normal;word-wrap:break-word;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:16pt;
 font-weight:400;
 font-style:normal;
 font-family:"Arial Black","sans-serif";
 border-top:none;
 border-right:1px solid windowtext;
 border-bottom:none;
 border-left:none;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x29
 {
 mso-number-format:General;
 text-align:center;
 vertical-align:middle;
 white-space:normal;word-wrap:break-word;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:16pt;
 font-weight:400;
 font-style:normal;
 font-family:"Arial Black","sans-serif";
 border-top:none;
 border-right:none;
 border-bottom:1px solid windowtext;
 border-left:1px solid windowtext;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x30
 {
 mso-number-format:General;
 text-align:center;
 vertical-align:middle;
 white-space:normal;word-wrap:break-word;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:16pt;
 font-weight:400;
 font-style:normal;
 font-family:"Arial Black","sans-serif";
 border-top:none;
 border-right:none;
 border-bottom:1px solid windowtext;
 border-left:none;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x31
 {
 mso-number-format:General;
 text-align:center;
 vertical-align:middle;
 white-space:normal;word-wrap:break-word;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:16pt;
 font-weight:400;
 font-style:normal;
 font-family:"Arial Black","sans-serif";
 border-top:none;
 border-right:1px solid windowtext;
 border-bottom:1px solid windowtext;
 border-left:none;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x32
 {
 mso-number-format:General;
 text-align:center;
 vertical-align:middle;
 white-space:nowrap;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:32pt;
 font-weight:400;
 font-style:normal;
 font-family:"Arial Black","sans-serif";
 border-top:1px solid windowtext;
 border-right:none;
 border-bottom:none;
 border-left:1px solid windowtext;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x33
 {
 mso-number-format:General;
 text-align:center;
 vertical-align:middle;
 white-space:nowrap;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:32pt;
 font-weight:400;
 font-style:normal;
 font-family:"Arial Black","sans-serif";
 border-top:1px solid windowtext;
 border-right:1px solid windowtext;
 border-bottom:none;
 border-left:none;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x34
 {
 mso-number-format:General;
 text-align:center;
 vertical-align:middle;
 white-space:nowrap;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:32pt;
 font-weight:400;
 font-style:normal;
 font-family:"Arial Black","sans-serif";
 border-top:none;
 border-right:none;
 border-bottom:none;
 border-left:1px solid windowtext;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x35
 {
 mso-number-format:General;
 text-align:center;
 vertical-align:middle;
 white-space:nowrap;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:32pt;
 font-weight:400;
 font-style:normal;
 font-family:"Arial Black","sans-serif";
 border-top:none;
 border-right:1px solid windowtext;
 border-bottom:none;
 border-left:none;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x36
 {
 mso-number-format:General;
 text-align:center;
 vertical-align:middle;
 white-space:nowrap;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:32pt;
 font-weight:400;
 font-style:normal;
 font-family:"Arial Black","sans-serif";
 border-top:none;
 border-right:none;
 border-bottom:1px solid windowtext;
 border-left:1px solid windowtext;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x37
 {
 mso-number-format:General;
 text-align:center;
 vertical-align:middle;
 white-space:nowrap;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:32pt;
 font-weight:400;
 font-style:normal;
 font-family:"Arial Black","sans-serif";
 border-top:none;
 border-right:1px solid windowtext;
 border-bottom:1px solid windowtext;
 border-left:none;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x38
 {
 mso-number-format:General;
 text-align:left;
 vertical-align:middle;
 white-space:nowrap;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:11pt;
 font-weight:400;
 font-style:normal;
 font-family:"Calibri","sans-serif";
 border-top:1px solid windowtext;
 border-right:none;
 border-bottom:none;
 border-left:1px solid windowtext;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x39
 {
 mso-number-format:General;
 text-align:left;
 vertical-align:middle;
 white-space:nowrap;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:11pt;
 font-weight:400;
 font-style:normal;
 font-family:"Calibri","sans-serif";
 border-top:none;
 border-right:none;
 border-bottom:none;
 border-left:1px solid windowtext;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x40
 {
 mso-number-format:"MM\/dd\/yyyy";
 text-align:center;
 vertical-align:middle;
 white-space:nowrap;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:11pt;
 font-weight:400;
 font-style:normal;
 font-family:"Calibri","sans-serif";
 border-top:1px solid windowtext;
 border-right:1px solid windowtext;
 border-bottom:none;
 border-left:none;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x41
 {
 mso-number-format:"MM\/dd\/yyyy";
 text-align:center;
 vertical-align:middle;
 white-space:nowrap;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:11pt;
 font-weight:400;
 font-style:normal;
 font-family:"Calibri","sans-serif";
 border-top:none;
 border-right:1px solid windowtext;
 border-bottom:none;
 border-left:none;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x42
 {
 mso-number-format:General;
 text-align:left;
 vertical-align:middle;
 white-space:nowrap;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:10pt;
 font-weight:400;
 font-style:normal;
 font-family:"Calibri","sans-serif";
 border-top:none;
 border-right:none;
 border-bottom:none;
 border-left:1px solid windowtext;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x43
 {
 mso-number-format:General;
 text-align:left;
 vertical-align:middle;
 white-space:nowrap;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:10pt;
 font-weight:400;
 font-style:normal;
 font-family:"Calibri","sans-serif";
 border-top:none;
 border-right:1px solid windowtext;
 border-bottom:none;
 border-left:none;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x44
 {
 mso-number-format:General;
 text-align:left;
 vertical-align:middle;
 white-space:nowrap;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:10pt;
 font-weight:400;
 font-style:normal;
 font-family:"Calibri","sans-serif";
 border-top:none;
 border-right:none;
 border-bottom:1px solid windowtext;
 border-left:1px solid windowtext;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x45
 {
 mso-number-format:General;
 text-align:left;
 vertical-align:middle;
 white-space:nowrap;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:10pt;
 font-weight:400;
 font-style:normal;
 font-family:"Calibri","sans-serif";
 border-top:none;
 border-right:1px solid windowtext;
 border-bottom:1px solid windowtext;
 border-left:none;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x46
 {
 mso-number-format:General;
 text-align:left;
 vertical-align:middle;
 white-space:nowrap;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:11pt;
 font-weight:400;
 font-style:normal;
 font-family:"Calibri","sans-serif";
 border-top:none;
 border-right:none;
 border-bottom:1px solid windowtext;
 border-left:1px solid windowtext;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x47
 {
 mso-number-format:General;
 text-align:center;
 vertical-align:middle;
 white-space:nowrap;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:11pt;
 font-weight:400;
 font-style:normal;
 font-family:"Calibri","sans-serif";
 border-top:none;
 border-right:1px solid windowtext;
 border-bottom:none;
 border-left:none;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x48
 {
 mso-number-format:General;
 text-align:center;
 vertical-align:middle;
 white-space:nowrap;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:11pt;
 font-weight:400;
 font-style:normal;
 font-family:"Calibri","sans-serif";
 border-top:none;
 border-right:1px solid windowtext;
 border-bottom:1px solid windowtext;
 border-left:none;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x49
 {
 mso-number-format:General;
 text-align:center;
 vertical-align:middle;
 white-space:nowrap;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:18pt;
 font-weight:700;
 font-style:normal;
 font-family:"Calibri","sans-serif";
 border-top:1px solid windowtext;
 border-right:1px solid windowtext;
 border-bottom:1px solid windowtext;
 border-left:1px solid windowtext;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x50
 {
 mso-number-format:General;
 text-align:center;
 vertical-align:top;
 white-space:nowrap;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:14pt;
 font-weight:400;
 font-style:normal;
 font-family:"IDAutomationHC39M","monospace";
 border-top:1px solid windowtext;
 border-right:1px solid windowtext;
 border-bottom:1px solid windowtext;
 border-left:1px solid windowtext;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x51
 {
 mso-number-format:General;
 text-align:left;
 vertical-align:middle;
 white-space:normal;word-wrap:break-word;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:11pt;
 font-weight:400;
 font-style:normal;
 font-family:"Calibri","sans-serif";
 border-top:1px solid windowtext;
 border-right:none;
 border-bottom:none;
 border-left:1px solid windowtext;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x52
 {
 mso-number-format:General;
 text-align:left;
 vertical-align:middle;
 white-space:normal;word-wrap:break-word;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:11pt;
 font-weight:400;
 font-style:normal;
 font-family:"Calibri","sans-serif";
 border-top:1px solid windowtext;
 border-right:1px solid windowtext;
 border-bottom:none;
 border-left:none;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x53
 {
 mso-number-format:General;
 text-align:left;
 vertical-align:middle;
 white-space:normal;word-wrap:break-word;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:11pt;
 font-weight:400;
 font-style:normal;
 font-family:"Calibri","sans-serif";
 border-top:none;
 border-right:none;
 border-bottom:none;
 border-left:1px solid windowtext;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
.x54
 {
 mso-number-format:General;
 text-align:left;
 vertical-align:middle;
 white-space:normal;word-wrap:break-word;
 background:auto;
 mso-pattern:auto;
 color:#000000;
 font-size:11pt;
 font-weight:400;
 font-style:normal;
 font-family:"Calibri","sans-serif";
 border-top:none;
 border-right:1px solid windowtext;
 border-bottom:none;
 border-left:none;
 mso-diagonal-down:none;
 mso-diagonal-up:none;
 mso-protection:locked visible;
 }
-->
</style>
<!--[if gte mso 9]><xml>
 <x:ExcelWorkbook>
  <x:ExcelWorksheets>
   <x:ExcelWorksheet>
    <x:Name>Sheet3</x:Name>
<x:WorksheetOptions>
 <x:StandardWidth>2048</x:StandardWidth>
 <x:Print>
  <x:ValidPrinterInfo/>
  <x:PaperSizeIndex>1</x:PaperSizeIndex>
  <x:HorizontalResolution>600</x:HorizontalResolution>
  <x:VerticalResolution>600</x:VerticalResolution>
 </x:Print>
 <x:ShowPageBreakZoom/>
 <x:Zoom>60</x:Zoom>
 <x:Selected/>
</x:WorksheetOptions>
   </x:ExcelWorksheet>
  </x:ExcelWorksheets>
  <x:WindowHeight>11040</x:WindowHeight>
  <x:WindowWidth>20730</x:WindowWidth>
  <x:WindowTopX>-120</x:WindowTopX>
  <x:WindowTopY>-120</x:WindowTopY>
  <x:RefModeR1C1/>
  <x:TabRatio>600</x:TabRatio>
  <x:ActiveSheet>0</x:ActiveSheet>
 </x:ExcelWorkbook>
 <x:ExcelName>
  <x:Name>Print_Area</x:Name>
  <x:SheetIndex>1</x:SheetIndex>
  <x:Formula>=Sheet3!$A$1:$F$7</x:Formula>
 </x:ExcelName>
</xml><![endif]-->
<meta name="generator" content="PHPMaker 2022.12.0">
</head>
<body link='blue' vlink='purple' >
<table border='0' cellpadding='0' cellspacing='0' width='384' style='border-collapse: 
 collapse;table-layout:fixed;width:288pt'>
 <col width='64' span='6' style='width:48pt'>
 <tr height='20' style='mso-height-source:userset;height:15pt'>
<td colspan='2' rowspan='2' height='39' class='x51' width='128' style='border-right:1px solid windowtext;height:29.25pt;'><a name="Print_Area" ><span style='font-size:11pt;color:#000000;font-weight:400;text-decoration:none;text-line-through:none;font-family:"Calibri";'><slot class="ew-slot" name="tpx_print_label_priority"></slot></span></a></td>
<td colspan='2' class='x49' width='128' style='border-right:1px solid windowtext;border-bottom:1px solid windowtext;'><slot class="ew-slot" name="tpx_print_label_box_id"></slot></td>
<td rowspan='2' height='39' class='x38' width='64' style='height:29.25pt;width:48pt;'>Date</td>
<td rowspan='2' height='39' class='x40' width='64' style='height:29.25pt;width:48pt;'></td>
 </tr>
 <tr height='20' style='mso-height-source:userset;height:15pt'>
<td colspan='2' rowspan='3' height='52' class='x50' style='border-right:1px solid windowtext;border-bottom:1px solid windowtext;height:39.4pt;'><slot class="ew-slot" name="tpx_print_label__barcode"></slot></td>
 </tr>
 <tr height='17' style='mso-height-source:userset;height:12.95pt'>
<td colspan='2' rowspan='2' height='34' class='x42' style='border-right:1px solid windowtext;border-bottom:1px solid windowtext;height:25.9pt;'>Konsep :</td>
<td rowspan='2' height='34' class='x39' style='border-bottom:1px solid windowtext;height:25.9pt;'>Qty</td>
<td rowspan='2' height='34' class='x47' style='border-bottom:1px solid windowtext;height:25.9pt;'></td>
 </tr>
 <tr height='17' style='mso-height-source:userset;height:12.95pt'>
 </tr>
 <tr height='24' style='mso-height-source:userset;height:18pt'>
<td colspan='4' rowspan='3' height='55' class='x23' style='border-right:1px solid windowtext;border-bottom:1px solid windowtext;height:41.25pt;'><slot class="ew-slot" name="tpx_print_label_store_name"></slot></td>
<td colspan='2' rowspan='3' height='55' class='x32' style='border-right:1px solid windowtext;border-bottom:1px solid windowtext;height:41.25pt;'>{{:store_code.substring(0,5) }}</td>
 </tr>
 <tr height='8' style='mso-height-source:userset;height:6pt'>
 </tr>
 <tr height='24' style='mso-height-source:userset;height:18pt'>
 </tr>
<![if supportMisalignedColumns]>
 <tr height='0' style='display:none'>
  <td width='384' colspan='6' style='width:288pt;mso-ignore:colspan;'></td>
 </tr>
 <![endif]>
</table>
</body>
</html>
</div>
</template>
</form>
<script class="ew-apply-template">
loadjs.ready(ew.applyTemplateId, function() {
    ew.templateData = { rows: <?= JsonEncode($Page->Rows) ?> };
    ew.applyTemplate("tpd_print_labelview", "tpm_print_labelview", "print_labelview", "<?= $Page->CustomExport ?>", ew.templateData.rows[0]);
    loadjs.done("customtemplate");
});
</script>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Startup script
    // Write your table-specific startup script here, no need to add script tags.
    $('a.ew-export-link.ew-print').attr('target','_blank');
});
</script>
<?php } ?>
