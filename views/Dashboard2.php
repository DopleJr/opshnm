<?php

namespace PHPMaker2022\opsmezzanineupload;

// Dashboard Page object
$Dashboard2 = $Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { Dashboard2: currentTable } });
var currentForm, currentPageID;
var fDashboard2dashboard;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fDashboard2dashboard = new ew.Form("fDashboard2dashboard", "dashboard");
    currentPageID = ew.PAGE_ID = "dashboard";
    currentForm = fDashboard2dashboard;
    loadjs.done("fDashboard2dashboard");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<!-- Content Container -->
<div id="ew-report" class="ew-report">
<div class="btn-toolbar ew-toolbar"></div>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<!-- Dashboard Container -->
<div id="ew-dashboard" class="container-fluid ew-dashboard">
<style>
element.style {
    display: flex !important;
    box-sizing: border-box;
    height: 500px;
    width: 600px;
    cursor: pointer;
    flex: 0 0 auto !important;
    width: 50%;
}
</style>
<div class="row">
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card border-0 border-radius-2 bg-success">
            <div class="card-body">
                <div class="d-flex flex-md-column flex-xl-row flex-wrap  align-items-center justify-content-between">
                    <div class="icon-rounded-inverse-success icon-rounded-lg">
                        <i class="mdi mdi-arrow-top-right"></i>
                    </div>
                    <div class="text-white">
                        <p class="font-weight-medium mt-md-2 mt-xl-0 text-md-center text-xl-left">Total Sales</p>
                        <div
                            class="d-flex flex-md-column flex-xl-row flex-wrap align-items-baseline align-items-md-center align-items-xl-baseline">
                            <h3 class="mb-0 mb-md-1 mb-lg-0 mr-1">$508</h3>
                            <small class="mb-0">This month</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card border-0 border-radius-2 bg-info">
            <div class="card-body">
                <div class="d-flex flex-md-column flex-xl-row flex-wrap  align-items-center justify-content-between">
                    <div class="icon-rounded-inverse-info icon-rounded-lg">
                        <i class="mdi mdi-basket"></i>
                    </div>
                    <div class="text-white">
                        <p class="font-weight-medium mt-md-2 mt-xl-0 text-md-center text-xl-left">Total Purchases</p>
                        <div
                            class="d-flex flex-md-column flex-xl-row flex-wrap align-items-baseline align-items-md-center align-items-xl-baseline">
                            <h3 class="mb-0 mb-md-1 mb-lg-0 mr-1">$387</h3>
                            <small class="mb-0">This month</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card border-0 border-radius-2 bg-danger">
            <div class="card-body">
                <div class="d-flex flex-md-column flex-xl-row flex-wrap  align-items-center justify-content-between">
                    <div class="icon-rounded-inverse-danger icon-rounded-lg">
                        <i class="mdi mdi-chart-donut-variant"></i>
                    </div>
                    <div class="text-white">
                        <p class="font-weight-medium mt-md-2 mt-xl-0 text-md-center text-xl-left">Total Orders</p>
                        <div
                            class="d-flex flex-md-column flex-xl-row flex-wrap align-items-baseline align-items-md-center align-items-xl-baseline">
                            <h3 class="mb-0 mb-md-1 mb-lg-0 mr-1">$161</h3>
                            <small class="mb-0">This month</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card border-0 border-radius-2 bg-warning">
            <div class="card-body">
                <div class="d-flex flex-md-column flex-xl-row flex-wrap  align-items-center justify-content-between">
                    <div class="icon-rounded-inverse-warning icon-rounded-lg">
                        <i class="mdi mdi-chart-multiline"></i>
                    </div>
                    <div class="text-white">
                        <p class="font-weight-medium mt-md-2 mt-xl-0 text-md-center text-xl-left">Total Growth</p>
                        <div
                            class="d-flex flex-md-column flex-xl-row flex-wrap align-items-baseline align-items-md-center align-items-xl-baseline">
                            <h3 class="mb-0 mb-md-1 mb-lg-0 mr-1">$231</h3>
                            <small class="mb-0">This month</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 mw-50">
        <div class="card">
            <h3 class="card-header">On Staging Report</h3>
            <div class="card-body">
<?php
$OnStaging = Container("OnStaging");
$OnStaging->OnStaging->Width = 0;
$OnStaging->OnStaging->Height = 0;
$OnStaging->OnStaging->setParameter("clickurl", "onstaging"); // Add click URL
$OnStaging->OnStaging->DrillDownUrl = ""; // No drill down for dashboard
$OnStaging->OnStaging->render("ew-chart-top");
?>
</div>
        </div>
    </div>
    <div class="col-lg-6 mw-50">
        <div class="card">
            <h3 class="card-header">Delivery By Category</h3>
            <div class="card-body">
<?php
$Outbound = Container("Outbound");
$Outbound->DeliveryTypeOrder->Width = 0;
$Outbound->DeliveryTypeOrder->Height = 0;
$Outbound->DeliveryTypeOrder->setParameter("clickurl", "outbound"); // Add click URL
$Outbound->DeliveryTypeOrder->DrillDownUrl = ""; // No drill down for dashboard
$Outbound->DeliveryTypeOrder->render("ew-chart-top");
?>
</div>
        </div>
    </div>
</div>
</div>
<!-- /.ew-dashboard -->
</div>
<!-- /.ew-report -->
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
