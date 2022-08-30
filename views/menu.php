<?php

namespace PHPMaker2022\opsmezzanineupload;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(108, "mi_Dashboard2", $MenuLanguage->MenuPhrase("108", "MenuText"), $MenuRelativePath . "dashboard2", -1, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}Dashboard'), false, false, "", "", false, true);
$sideMenu->addMenuItem(62, "mci_KPI", $MenuLanguage->MenuPhrase("62", "MenuText"), "", -1, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(63, "mi_monitor_kpi", $MenuLanguage->MenuPhrase("63", "MenuText"), $MenuRelativePath . "monitorkpilist", 62, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}monitor_kpi'), false, false, "", "", false, true);
$sideMenu->addMenuItem(44, "mi_disposition_location", $MenuLanguage->MenuPhrase("44", "MenuText"), $MenuRelativePath . "dispositionlocationlist", 62, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}disposition_location'), false, false, "", "", false, true);
$sideMenu->addMenuItem(65, "mi_empty_box", $MenuLanguage->MenuPhrase("65", "MenuText"), $MenuRelativePath . "emptyboxlist", 62, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}empty_box'), false, false, "", "", false, true);
$sideMenu->addMenuItem(367, "mci_Online", $MenuLanguage->MenuPhrase("367", "MenuText"), "", -1, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(318, "mi_picking_pending", $MenuLanguage->MenuPhrase("318", "MenuText"), $MenuRelativePath . "pickingpendinglist", 367, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}picking_pending'), false, false, "", "", false, true);
$sideMenu->addMenuItem(369, "mi_box_result", $MenuLanguage->MenuPhrase("369", "MenuText"), $MenuRelativePath . "boxresultlist", 367, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}box_result'), false, false, "", "", false, true);
$sideMenu->addMenuItem(317, "mi_job_control_copy1", $MenuLanguage->MenuPhrase("317", "MenuText"), $MenuRelativePath . "jobcontrolcopy1list", 367, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}job_control_copy1'), false, false, "", "", false, true);
$sideMenu->addMenuItem(316, "mi_picking", $MenuLanguage->MenuPhrase("316", "MenuText"), $MenuRelativePath . "pickinglist", 367, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}picking'), false, false, "", "", false, true);
$sideMenu->addMenuItem(43, "mci_Mezzanine", $MenuLanguage->MenuPhrase("43", "MenuText"), "", -1, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(64, "mi_monitor_audit_picking", $MenuLanguage->MenuPhrase("64", "MenuText"), $MenuRelativePath . "monitorauditpickinglist", 43, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}monitor_audit_picking'), false, false, "", "", false, true);
$sideMenu->addMenuItem(27, "mi_box_picking", $MenuLanguage->MenuPhrase("27", "MenuText"), $MenuRelativePath . "boxpickinglist", 43, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}box_picking'), false, false, "", "", false, true);
$sideMenu->addMenuItem(28, "mi_audit_picking", $MenuLanguage->MenuPhrase("28", "MenuText"), $MenuRelativePath . "auditpickinglist", 43, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}audit_picking'), false, false, "", "", false, true);
$sideMenu->addMenuItem(25, "mi_print_label", $MenuLanguage->MenuPhrase("25", "MenuText"), $MenuRelativePath . "printlabellist", 43, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}print_label'), false, false, "", "", false, true);
$sideMenu->addMenuItem(26, "mi_store", $MenuLanguage->MenuPhrase("26", "MenuText"), $MenuRelativePath . "storelist", 43, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}store'), false, false, "", "", false, true);
$sideMenu->addMenuItem(22, "mci_Outbound", $MenuLanguage->MenuPhrase("22", "MenuText"), "", -1, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(221, "mci_Monitor_Staging", $MenuLanguage->MenuPhrase("221", "MenuText"), "", 22, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(188, "mi_monitor_staging_on_staging", $MenuLanguage->MenuPhrase("188", "MenuText"), $MenuRelativePath . "monitorstagingonstaginglist", 221, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}monitor_staging_on_staging'), false, false, "", "", false, true);
$sideMenu->addMenuItem(189, "mi_monitor_staging_delivered", $MenuLanguage->MenuPhrase("189", "MenuText"), $MenuRelativePath . "monitorstagingdeliveredlist", 221, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}monitor_staging_delivered'), false, false, "", "", false, true);
$sideMenu->addMenuItem(1, "mi_auditstaging", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "auditstaginglist", 22, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}audit staging'), false, false, "", "", false, true);
$sideMenu->addMenuItem(14, "mi_staging", $MenuLanguage->MenuPhrase("14", "MenuText"), $MenuRelativePath . "staginglist", 22, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}staging'), false, false, "", "", false, true);
$sideMenu->addMenuItem(11, "mi_report_outbound", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "reportoutboundlist", 22, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}report_outbound'), false, false, "", "", false, true);
$sideMenu->addMenuItem(368, "mi_report_totes", $MenuLanguage->MenuPhrase("368", "MenuText"), $MenuRelativePath . "reporttoteslist", 22, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}report_totes'), false, false, "", "", false, true);
$sideMenu->addMenuItem(23, "mci_Inventory", $MenuLanguage->MenuPhrase("23", "MenuText"), "", -1, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(153, "mci_Monitor_Cycle_Count", $MenuLanguage->MenuPhrase("153", "MenuText"), "", 23, "", IsLoggedIn(), false, true, "", "", false, true);
$sideMenu->addMenuItem(10, "mi_monitor_cycle_count", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "monitorcyclecountlist", 153, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}monitor_cycle_count'), false, false, "", "", false, true);
$sideMenu->addMenuItem(110, "mi_monitor_cycle_count_offline", $MenuLanguage->MenuPhrase("110", "MenuText"), $MenuRelativePath . "monitorcyclecountofflinelist", 153, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}monitor_cycle_count_offline'), false, false, "", "", false, true);
$sideMenu->addMenuItem(107, "mci_Cycle_Count", $MenuLanguage->MenuPhrase("107", "MenuText"), "", 23, "", IsLoggedIn(), false, true, "", "", false, true);
$sideMenu->addMenuItem(3, "mi_cycle_count", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "cyclecountlist", 107, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}cycle_count'), false, false, "", "", false, true);
$sideMenu->addMenuItem(109, "mi_cycle_count_offline", $MenuLanguage->MenuPhrase("109", "MenuText"), $MenuRelativePath . "cyclecountofflinelist", 107, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}cycle_count_offline'), false, false, "", "", false, true);
$sideMenu->addMenuItem(187, "mci_Extra_Stock", $MenuLanguage->MenuPhrase("187", "MenuText"), "", 23, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(154, "mi_extra_stock", $MenuLanguage->MenuPhrase("154", "MenuText"), $MenuRelativePath . "extrastocklist", 187, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}extra_stock'), false, false, "", "", false, true);
$sideMenu->addMenuItem(156, "mi_blank_count_sheet", $MenuLanguage->MenuPhrase("156", "MenuText"), $MenuRelativePath . "blankcountsheetlist", 187, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}blank_count_sheet'), false, false, "", "", false, true);
$sideMenu->addMenuItem(267, "mci_Transfer_Bin", $MenuLanguage->MenuPhrase("267", "MenuText"), "", 23, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(24, "mi_bintobin", $MenuLanguage->MenuPhrase("24", "MenuText"), $MenuRelativePath . "bintobinlist", 267, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}bin to bin'), false, false, "", "", false, true);
$sideMenu->addMenuItem(268, "mi_bin_to_bin_piece", $MenuLanguage->MenuPhrase("268", "MenuText"), $MenuRelativePath . "bintobinpiecelist", 267, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}bin_to_bin_piece'), false, false, "", "", false, true);
$sideMenu->addMenuItem(20, "mi_transferbin", $MenuLanguage->MenuPhrase("20", "MenuText"), $MenuRelativePath . "transferbinlist", 267, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}transfer bin'), false, false, "", "", false, true);
$sideMenu->addMenuItem(228, "mi_transfer_bin_piece", $MenuLanguage->MenuPhrase("228", "MenuText"), $MenuRelativePath . "transferbinpiecelist", 267, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}transfer_bin_piece'), false, false, "", "", false, true);
$sideMenu->addMenuItem(315, "mci_Shortpick", $MenuLanguage->MenuPhrase("315", "MenuText"), "", 23, "", true, false, true, "", "", false, true);
$sideMenu->addMenuItem(270, "mi_shortpick_by_area", $MenuLanguage->MenuPhrase("270", "MenuText"), $MenuRelativePath . "shortpickbyarealist", 315, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}shortpick_by_area'), false, false, "", "", false, true);
$sideMenu->addMenuItem(271, "mi_findingshortpick", $MenuLanguage->MenuPhrase("271", "MenuText"), $MenuRelativePath . "findingshortpicklist", 315, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}findingshortpick'), false, false, "", "", false, true);
$sideMenu->addMenuItem(227, "mi_finding_shortpick2", $MenuLanguage->MenuPhrase("227", "MenuText"), $MenuRelativePath . "findingshortpick2list", 315, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}finding_shortpick'), false, false, "", "", false, true);
$sideMenu->addMenuItem(224, "mi_locations", $MenuLanguage->MenuPhrase("224", "MenuText"), $MenuRelativePath . "locationslist", 23, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}locations'), false, false, "", "", false, true);
$sideMenu->addMenuItem(85, "mi_master_article", $MenuLanguage->MenuPhrase("85", "MenuText"), $MenuRelativePath . "masterarticlelist", 23, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}master_article'), false, false, "", "", false, true);
$sideMenu->addMenuItem(226, "mi_master_article2", $MenuLanguage->MenuPhrase("226", "MenuText"), $MenuRelativePath . "masterarticle2list", 23, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}master_article2'), false, false, "", "", false, true);
$sideMenu->addMenuItem(225, "mi_mb51", $MenuLanguage->MenuPhrase("225", "MenuText"), $MenuRelativePath . "mb51list", 23, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}mb51'), false, false, "", "", false, true);
$sideMenu->addMenuItem(21, "mi_user", $MenuLanguage->MenuPhrase("21", "MenuText"), $MenuRelativePath . "userlist", -1, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}user'), false, false, "", "", false, true);
$sideMenu->addMenuItem(2, "mi_audittrail", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "audittraillist", -1, "", AllowListMenu('{82E0F641-A651-4BB1-8010-BEBF3749166D}audittrail'), false, false, "", "", false, true);
echo $sideMenu->toScript();
