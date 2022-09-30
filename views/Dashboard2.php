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
    left: 0px !important;
    top: 0px;
}
body{margin-top:0px;}
.container-filter {
  margin-top: 0;
  margin-right: 0;
  margin-left: 0;
  margin-bottom: 30px;
  padding: 0;
  text-align: center;
}
.container-filter li {
  list-style: none;
  display: inline-block;
}
.container-filter a {
  display: block;
  font-size: 14px;
  margin: 10px 20px;
  text-transform: uppercase;
  cursor: pointer;
  font-weight: 400;
  line-height: 30px;
  -webkit-transition: all 0.6s;
  border-bottom: 1px solid transparent;
  color: #807c7c !important;
}
.container-filter a:hover {
  color: #222222 !important;
}
.container-filter a.active {
  color: #222222 !important;
  border-bottom: 1px solid #222222;
}
.item-box {
  position: relative;
  overflow: hidden;
  display: block;
}
.item-box a {
  display: inline-block;
}
.item-box .item-mask {
  background: none repeat scroll 0 0 rgba(255, 255, 255, 0.9);
  position: absolute;
  transition: all 0s ease-in-out 0s;
  -moz-transition: all 0s ease-in-out 0s;
  -webkit-transition: all 0s ease-in-out 0s;
  -o-transition: all 0s ease-in-out 0s;
  top: 0px;
  left: 0px;
  bottom: 0px;
  right: 0px;
  opacity: 1;
  visibility: hidden;
  overflow: hidden;
  text-align: center;
}
.item-box .item-mask .item-caption {
  position: absolute;
  width: 100%;
  bottom: 10px;
  opacity: 0;
}
.item-box:hover .item-mask {
  opacity: 1;
  visibility: visible;
  cursor: pointer !important;
}
.item-box:hover .item-caption {
  opacity: 1;
}
.item-box:hover .item-container {
  width: 100%;
}
.services-box {
  padding: 45px 25px 45px 25px;
}
.col-lg-4 {
    flex: auto;
    width: 31.33333333%;
    max-width: 110px;
    min-height: 205px;
    background-color: #F7FFB0;
    border-radius: 0.75rem;
}
.detail-info {
    display: block;
    vertical-align: center;
    text-align: center;
    font-weight: auto !important;
    margin-top: 10px;
    box-sizing: border-box;
}
.p-4 {
    padding: 1rem!important;
    margin: 1.5px 1.5px 1.5px 1.5px;
}
.content-header {
    display: none !important;
}
</style>
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js" integrity="sha512-Zq2BOxyhvnRFXu0+WE6ojpZLOU2jdnqbrM1hmVdGzyeCa1DgM3X5Q4A/Is9xA1IkbUeDd7755dNNI/PzSf2Pew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
<script language="JavaScript" type="text/javascript" >
$(document).ready( function imagearranger() {
  var $container = $(".portfolioContainer");
  var $filter = $("#filter");
  $container.isotope({
    filter: "*",
    layoutMode: "masonry",
    animationOptions: { duration: 750, easing: "linear" },
  });
  $filter.find("a").click(function () {
    var selector = $(this).attr("data-filter");
    $filter.find("a").removeClass("active");
    $(this).addClass("active");
    $container.isotope({
      filter: selector,
      animationOptions: {
        animationDuration: 750,
        easing: "linear",
        queue: false,
      },
    });
    return false;
  });
});
</script>
<section class="section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">
                    <ul class="col container-filter portfolioFilte list-unstyled mb-0" id="filter">
                        <li><a class="categories active" data-filter="*">All</a></li>
                        <li><a class="categories" data-filter=".inbound">Inbound</a></li>
                        <li><a class="categories" data-filter=".mezzanine">Mezzanine</a></li>
                        <li><a class="categories" data-filter=".inventory">Inventory</a></li>
                        <li><a class="categories" data-filter=".outbound">Outbound</a></li>
                        <li><a class="categories" data-filter=".online">Online</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="port portfolio-masonry mt-4">
            <div class="portfolioContainer row photo">
            	<div class="col-lg-4 p-4 *">
                    <div class="item-box" href="./stockcountadd">
                        <a class="mfp-image" href="./stockcountadd" title="Project H&M">
                            <img class="item-container img-fluid" src="./images/menu/warehouse.png" alt="work-img">
                            <div class="item-mask">
                                <div class="item-caption">
                                    <p class="text-dark mb-0">Stock Count</p>
                                </div>
                            </div>
                            <span class="detail-info">
                            Stock Count Online
                            </span>
                        </a>
                    </div>
                </div>
            	<div class="col-lg-4 p-4 *">
                    <div class="item-box" href="./printlabeladd">
                        <a class="mfp-image" href="./printlabeladd" title="Project Name">
                            <img class="item-container img-fluid" src="./images/menu/paper.png" alt="work-img">
                            <div class="item-mask">
                                <div class="item-caption">
                                    <p class="text-dark mb-0">Print Label</p>
                                </div>
                            </div>
                            <span class="detail-info">
                            Print Label Picking
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 p-4 inbound">
                    <div class="item-box" href="./ossmanualadd" >
                        <a class="mfp-image" href="./ossmanualadd" title="Project Name">
                            <img class="item-container img-fluid" src="./images/menu/clipboard.png  " alt="work-img">
                            <div class="item-mask">
                                <div class="item-caption">
                                    <p class="text-dark mb-0">OSS Manual</p>
                                </div>
                            </div>
                            <span class="detail-info">
                            Input OSS Manual
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 p-4 online">
                    <div class="item-box" href="./pickingpendinglist" >
                        <a class="mfp-image" href="./pickingpendinglist" title="Project Name">
                            <img class="item-container img-fluid" src="./images/menu/box2.png" alt="work-img">
                            <div class="item-mask">
                                <div class="item-caption">
                                    <p class="text-dark mb-0">Picking Online</p>
                                </div>
                            </div>
                            <span class="detail-info">
                            Picking Online
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 p-4 online">
                    <div class="item-box" href="./checkboxlist" >
                        <a class="mfp-image" href="./checkboxlist" title="Project Name">
                            <img class="item-container img-fluid" src="./images/menu/box2.png" alt="work-img">
                            <div class="item-mask">
                                <div class="item-caption">
                                    <p class="text-dark mb-0">Check Box Online</p>
                                </div>
                            </div>
                            <span class="detail-info">
                            Check Box Online
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 p-4 online">
                    <div class="item-box" href="./boxresultlist" >
                        <a class="mfp-image" href="./boxresultlist" title="Project Name">
                            <img class="item-container img-fluid" src="./images/menu/box.png" alt="work-img">
                            <div class="item-mask">
                                <div class="item-caption">
                                    <p class="text-dark mb-0">Box Result</p>
                                </div>
                            </div>
                            <span class="detail-info">
                            Box Result Online
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 p-4 online">
                    <div class="item-box" href="./jobcontrolcopy1list">
                        <a class="mfp-image" href="./jobcontrolcopy1list" title="Project Name">
                            <img class="item-container img-fluid" src="./images/menu/clipboard.png" alt="work-img">
                            <div class="item-mask">
                                <div class="item-caption">
                                    <p class="text-dark mb-0">Job Control</p>
                                </div>
                            </div>
                            <span class="detail-info">
                            Job Control Picking Online
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 p-4 mezzanine">
                    <div class="item-box" href="./auditpickingadd">
                        <a class="mfp-image" href="./auditpickingadd" title="Project Name">
                            <img class="item-container img-fluid" src="./images/menu/box.png" alt="work-img">
                            <div class="item-mask">
                                <div class="item-caption">
                                    <p class="text-dark mb-0">Audit Picking</p>
                                </div>
                            </div>
                            <span class="detail-info">
                            Audit Picking Mezzanine
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 p-4 outbound">
                    <div class="item-box" href="./auditstaginglist">
                        <a class="mfp-image" href="./auditstaginglist" title="Project Name">
                            <img class="item-container img-fluid" src="./images/menu/warehouse.png" alt="work-img">
                            <div class="item-mask">
                                <div class="item-caption">
                                    <p class="text-dark mb-0">Audit Staging</p>
                                </div>
                            </div>
                            <span class="detail-info">
                            Audit Staging Outbound
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 p-4 inventory">
                    <div class="item-box" href="./cyclecountadd">
                        <a class="mfp-image" href="./cyclecountadd" title="Project Name">
                            <img class="item-container img-fluid" src="./images/menu/box.png" alt="work-img">
                            <div class="item-mask">
                                <div class="item-caption">
                                    <p class="text-dark mb-0">Cycle Count</p>
                                </div>
                            </div>
                            <span class="detail-info">
                            Cycle Count Online
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 p-4 inventory">
                    <div class="item-box" href="./cyclecountofflineadd">
                        <a class="mfp-image" href="./cyclecountofflineadd" title="Project Name">
                            <img class="item-container img-fluid" src="./images/menu/box.png" alt="work-img">
                            <div class="item-mask">
                                <div class="item-caption">
                                    <p class="text-dark mb-0">Cycle Count</p>
                                </div>
                            </div>
                            <span class="detail-info">
                            Cycle Count Offline
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 p-4 inventory">
                    <div class="item-box" href="./blankcountsheetadd">
                        <a class="mfp-image" href="./blankcountsheetadd" title="Project Name">
                            <img class="item-container img-fluid" src="./images/menu/paper.png" alt="work-img">
                            <div class="item-mask">
                                <div class="item-caption">
                                    <p class="text-dark mb-0">Blank Count Sheet</p>
                                </div>
                            </div>
                            <span class="detail-info">
                            Blank Count Sheet Inventory
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 p-4 ">
                    <div class="item-box" href="./userlist">
                        <a class="mfp-image" href="./userlist" title="Project Name">
                            <img class="item-container img-fluid" src="./images/menu/delivery-boy.png" alt="work-img">
                            <div class="item-mask">
                                <div class="item-caption">
                                    <p class="text-dark mb-0">User</p>
                                </div>
                            </div>
                            <span class="detail-info">
                            USER LIST
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
<body>
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
    // Startup script
    // Write your table-specific startup script here, no need to add script tags.
    $(".ew-breadcrumbs").hide();
});
</script>
