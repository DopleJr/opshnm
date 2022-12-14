<?php

namespace PHPMaker2022\opsmezzanineupload;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // auditstaging
    $app->map(["GET","POST","OPTIONS"], '/auditstaginglist[/{id}]', AuditstagingController::class . ':list')->add(PermissionMiddleware::class)->setName('auditstaginglist-auditstaging-list'); // list
    $app->group(
        '/auditstaging',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', AuditstagingController::class . ':list')->add(PermissionMiddleware::class)->setName('auditstaging/list-auditstaging-list-2'); // list
        }
    );

    // audittrail
    $app->map(["GET","POST","OPTIONS"], '/audittraillist[/{id}]', AudittrailController::class . ':list')->add(PermissionMiddleware::class)->setName('audittraillist-audittrail-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/audittrailadd[/{id}]', AudittrailController::class . ':add')->add(PermissionMiddleware::class)->setName('audittrailadd-audittrail-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/audittrailview[/{id}]', AudittrailController::class . ':view')->add(PermissionMiddleware::class)->setName('audittrailview-audittrail-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/audittrailedit[/{id}]', AudittrailController::class . ':edit')->add(PermissionMiddleware::class)->setName('audittrailedit-audittrail-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/audittraildelete[/{id}]', AudittrailController::class . ':delete')->add(PermissionMiddleware::class)->setName('audittraildelete-audittrail-delete'); // delete
    $app->group(
        '/audittrail',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', AudittrailController::class . ':list')->add(PermissionMiddleware::class)->setName('audittrail/list-audittrail-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', AudittrailController::class . ':add')->add(PermissionMiddleware::class)->setName('audittrail/add-audittrail-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', AudittrailController::class . ':view')->add(PermissionMiddleware::class)->setName('audittrail/view-audittrail-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', AudittrailController::class . ':edit')->add(PermissionMiddleware::class)->setName('audittrail/edit-audittrail-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', AudittrailController::class . ':delete')->add(PermissionMiddleware::class)->setName('audittrail/delete-audittrail-delete-2'); // delete
        }
    );

    // cycle_count
    $app->map(["GET","POST","OPTIONS"], '/cyclecountlist[/{id}]', CycleCountController::class . ':list')->add(PermissionMiddleware::class)->setName('cyclecountlist-cycle_count-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/cyclecountadd[/{id}]', CycleCountController::class . ':add')->add(PermissionMiddleware::class)->setName('cyclecountadd-cycle_count-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/cyclecountview[/{id}]', CycleCountController::class . ':view')->add(PermissionMiddleware::class)->setName('cyclecountview-cycle_count-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/cyclecountedit[/{id}]', CycleCountController::class . ':edit')->add(PermissionMiddleware::class)->setName('cyclecountedit-cycle_count-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/cyclecountdelete[/{id}]', CycleCountController::class . ':delete')->add(PermissionMiddleware::class)->setName('cyclecountdelete-cycle_count-delete'); // delete
    $app->map(["GET","POST","OPTIONS"], '/cyclecountsearch', CycleCountController::class . ':search')->add(PermissionMiddleware::class)->setName('cyclecountsearch-cycle_count-search'); // search
    $app->group(
        '/cycle_count',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', CycleCountController::class . ':list')->add(PermissionMiddleware::class)->setName('cycle_count/list-cycle_count-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', CycleCountController::class . ':add')->add(PermissionMiddleware::class)->setName('cycle_count/add-cycle_count-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', CycleCountController::class . ':view')->add(PermissionMiddleware::class)->setName('cycle_count/view-cycle_count-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', CycleCountController::class . ':edit')->add(PermissionMiddleware::class)->setName('cycle_count/edit-cycle_count-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', CycleCountController::class . ':delete')->add(PermissionMiddleware::class)->setName('cycle_count/delete-cycle_count-delete-2'); // delete
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', CycleCountController::class . ':search')->add(PermissionMiddleware::class)->setName('cycle_count/search-cycle_count-search-2'); // search
        }
    );

    // monitor_cycle_count
    $app->map(["GET","POST","OPTIONS"], '/monitorcyclecountlist', MonitorCycleCountController::class . ':list')->add(PermissionMiddleware::class)->setName('monitorcyclecountlist-monitor_cycle_count-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/monitorcyclecountsearch', MonitorCycleCountController::class . ':search')->add(PermissionMiddleware::class)->setName('monitorcyclecountsearch-monitor_cycle_count-search'); // search
    $app->group(
        '/monitor_cycle_count',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '', MonitorCycleCountController::class . ':list')->add(PermissionMiddleware::class)->setName('monitor_cycle_count/list-monitor_cycle_count-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', MonitorCycleCountController::class . ':search')->add(PermissionMiddleware::class)->setName('monitor_cycle_count/search-monitor_cycle_count-search-2'); // search
        }
    );

    // report_outbound
    $app->map(["GET","POST","OPTIONS"], '/reportoutboundlist[/{id}]', ReportOutboundController::class . ':list')->add(PermissionMiddleware::class)->setName('reportoutboundlist-report_outbound-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/reportoutboundadd[/{id}]', ReportOutboundController::class . ':add')->add(PermissionMiddleware::class)->setName('reportoutboundadd-report_outbound-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/reportoutboundview[/{id}]', ReportOutboundController::class . ':view')->add(PermissionMiddleware::class)->setName('reportoutboundview-report_outbound-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/reportoutboundedit[/{id}]', ReportOutboundController::class . ':edit')->add(PermissionMiddleware::class)->setName('reportoutboundedit-report_outbound-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/reportoutbounddelete[/{id}]', ReportOutboundController::class . ':delete')->add(PermissionMiddleware::class)->setName('reportoutbounddelete-report_outbound-delete'); // delete
    $app->map(["GET","POST","OPTIONS"], '/reportoutboundsearch', ReportOutboundController::class . ':search')->add(PermissionMiddleware::class)->setName('reportoutboundsearch-report_outbound-search'); // search
    $app->group(
        '/report_outbound',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', ReportOutboundController::class . ':list')->add(PermissionMiddleware::class)->setName('report_outbound/list-report_outbound-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', ReportOutboundController::class . ':add')->add(PermissionMiddleware::class)->setName('report_outbound/add-report_outbound-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', ReportOutboundController::class . ':view')->add(PermissionMiddleware::class)->setName('report_outbound/view-report_outbound-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', ReportOutboundController::class . ':edit')->add(PermissionMiddleware::class)->setName('report_outbound/edit-report_outbound-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', ReportOutboundController::class . ':delete')->add(PermissionMiddleware::class)->setName('report_outbound/delete-report_outbound-delete-2'); // delete
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', ReportOutboundController::class . ':search')->add(PermissionMiddleware::class)->setName('report_outbound/search-report_outbound-search-2'); // search
        }
    );

    // staging
    $app->map(["GET","POST","OPTIONS"], '/staginglist[/{id}]', StagingController::class . ':list')->add(PermissionMiddleware::class)->setName('staginglist-staging-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/stagingadd[/{id}]', StagingController::class . ':add')->add(PermissionMiddleware::class)->setName('stagingadd-staging-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/stagingview[/{id}]', StagingController::class . ':view')->add(PermissionMiddleware::class)->setName('stagingview-staging-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/stagingedit[/{id}]', StagingController::class . ':edit')->add(PermissionMiddleware::class)->setName('stagingedit-staging-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/stagingdelete[/{id}]', StagingController::class . ':delete')->add(PermissionMiddleware::class)->setName('stagingdelete-staging-delete'); // delete
    $app->map(["GET","POST","OPTIONS"], '/stagingsearch', StagingController::class . ':search')->add(PermissionMiddleware::class)->setName('stagingsearch-staging-search'); // search
    $app->group(
        '/staging',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', StagingController::class . ':list')->add(PermissionMiddleware::class)->setName('staging/list-staging-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', StagingController::class . ':add')->add(PermissionMiddleware::class)->setName('staging/add-staging-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', StagingController::class . ':view')->add(PermissionMiddleware::class)->setName('staging/view-staging-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', StagingController::class . ':edit')->add(PermissionMiddleware::class)->setName('staging/edit-staging-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', StagingController::class . ':delete')->add(PermissionMiddleware::class)->setName('staging/delete-staging-delete-2'); // delete
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', StagingController::class . ':search')->add(PermissionMiddleware::class)->setName('staging/search-staging-search-2'); // search
        }
    );

    // transferbin
    $app->map(["GET","POST","OPTIONS"], '/transferbinlist[/{id}]', TransferbinController::class . ':list')->add(PermissionMiddleware::class)->setName('transferbinlist-transferbin-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/transferbinadd[/{id}]', TransferbinController::class . ':add')->add(PermissionMiddleware::class)->setName('transferbinadd-transferbin-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/transferbinview[/{id}]', TransferbinController::class . ':view')->add(PermissionMiddleware::class)->setName('transferbinview-transferbin-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/transferbinedit[/{id}]', TransferbinController::class . ':edit')->add(PermissionMiddleware::class)->setName('transferbinedit-transferbin-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/transferbindelete[/{id}]', TransferbinController::class . ':delete')->add(PermissionMiddleware::class)->setName('transferbindelete-transferbin-delete'); // delete
    $app->group(
        '/transferbin',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', TransferbinController::class . ':list')->add(PermissionMiddleware::class)->setName('transferbin/list-transferbin-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', TransferbinController::class . ':add')->add(PermissionMiddleware::class)->setName('transferbin/add-transferbin-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', TransferbinController::class . ':view')->add(PermissionMiddleware::class)->setName('transferbin/view-transferbin-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', TransferbinController::class . ':edit')->add(PermissionMiddleware::class)->setName('transferbin/edit-transferbin-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', TransferbinController::class . ':delete')->add(PermissionMiddleware::class)->setName('transferbin/delete-transferbin-delete-2'); // delete
        }
    );

    // user
    $app->map(["GET","POST","OPTIONS"], '/userlist[/{id}]', UserController::class . ':list')->add(PermissionMiddleware::class)->setName('userlist-user-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/useradd[/{id}]', UserController::class . ':add')->add(PermissionMiddleware::class)->setName('useradd-user-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/userview[/{id}]', UserController::class . ':view')->add(PermissionMiddleware::class)->setName('userview-user-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/useredit[/{id}]', UserController::class . ':edit')->add(PermissionMiddleware::class)->setName('useredit-user-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/userdelete[/{id}]', UserController::class . ':delete')->add(PermissionMiddleware::class)->setName('userdelete-user-delete'); // delete
    $app->group(
        '/user',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', UserController::class . ':list')->add(PermissionMiddleware::class)->setName('user/list-user-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', UserController::class . ':add')->add(PermissionMiddleware::class)->setName('user/add-user-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', UserController::class . ':view')->add(PermissionMiddleware::class)->setName('user/view-user-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', UserController::class . ':edit')->add(PermissionMiddleware::class)->setName('user/edit-user-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', UserController::class . ':delete')->add(PermissionMiddleware::class)->setName('user/delete-user-delete-2'); // delete
        }
    );

    // print_label
    $app->map(["GET","POST","OPTIONS"], '/printlabellist[/{id}]', PrintLabelController::class . ':list')->add(PermissionMiddleware::class)->setName('printlabellist-print_label-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/printlabeladd[/{id}]', PrintLabelController::class . ':add')->add(PermissionMiddleware::class)->setName('printlabeladd-print_label-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/printlabelview[/{id}]', PrintLabelController::class . ':view')->add(PermissionMiddleware::class)->setName('printlabelview-print_label-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/printlabeledit[/{id}]', PrintLabelController::class . ':edit')->add(PermissionMiddleware::class)->setName('printlabeledit-print_label-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/printlabeldelete[/{id}]', PrintLabelController::class . ':delete')->add(PermissionMiddleware::class)->setName('printlabeldelete-print_label-delete'); // delete
    $app->group(
        '/print_label',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PrintLabelController::class . ':list')->add(PermissionMiddleware::class)->setName('print_label/list-print_label-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', PrintLabelController::class . ':add')->add(PermissionMiddleware::class)->setName('print_label/add-print_label-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', PrintLabelController::class . ':view')->add(PermissionMiddleware::class)->setName('print_label/view-print_label-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', PrintLabelController::class . ':edit')->add(PermissionMiddleware::class)->setName('print_label/edit-print_label-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', PrintLabelController::class . ':delete')->add(PermissionMiddleware::class)->setName('print_label/delete-print_label-delete-2'); // delete
        }
    );

    // store
    $app->map(["GET","POST","OPTIONS"], '/storelist[/{id}]', StoreController::class . ':list')->add(PermissionMiddleware::class)->setName('storelist-store-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/storeadd[/{id}]', StoreController::class . ':add')->add(PermissionMiddleware::class)->setName('storeadd-store-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/storeview[/{id}]', StoreController::class . ':view')->add(PermissionMiddleware::class)->setName('storeview-store-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/storeedit[/{id}]', StoreController::class . ':edit')->add(PermissionMiddleware::class)->setName('storeedit-store-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/storedelete[/{id}]', StoreController::class . ':delete')->add(PermissionMiddleware::class)->setName('storedelete-store-delete'); // delete
    $app->group(
        '/store',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', StoreController::class . ':list')->add(PermissionMiddleware::class)->setName('store/list-store-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', StoreController::class . ':add')->add(PermissionMiddleware::class)->setName('store/add-store-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', StoreController::class . ':view')->add(PermissionMiddleware::class)->setName('store/view-store-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', StoreController::class . ':edit')->add(PermissionMiddleware::class)->setName('store/edit-store-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', StoreController::class . ':delete')->add(PermissionMiddleware::class)->setName('store/delete-store-delete-2'); // delete
        }
    );

    // box_picking
    $app->map(["GET","POST","OPTIONS"], '/boxpickinglist[/{id}]', BoxPickingController::class . ':list')->add(PermissionMiddleware::class)->setName('boxpickinglist-box_picking-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/boxpickingadd[/{id}]', BoxPickingController::class . ':add')->add(PermissionMiddleware::class)->setName('boxpickingadd-box_picking-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/boxpickingview[/{id}]', BoxPickingController::class . ':view')->add(PermissionMiddleware::class)->setName('boxpickingview-box_picking-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/boxpickingedit[/{id}]', BoxPickingController::class . ':edit')->add(PermissionMiddleware::class)->setName('boxpickingedit-box_picking-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/boxpickingdelete[/{id}]', BoxPickingController::class . ':delete')->add(PermissionMiddleware::class)->setName('boxpickingdelete-box_picking-delete'); // delete
    $app->map(["GET","POST","OPTIONS"], '/boxpickingsearch', BoxPickingController::class . ':search')->add(PermissionMiddleware::class)->setName('boxpickingsearch-box_picking-search'); // search
    $app->group(
        '/box_picking',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', BoxPickingController::class . ':list')->add(PermissionMiddleware::class)->setName('box_picking/list-box_picking-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', BoxPickingController::class . ':add')->add(PermissionMiddleware::class)->setName('box_picking/add-box_picking-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', BoxPickingController::class . ':view')->add(PermissionMiddleware::class)->setName('box_picking/view-box_picking-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', BoxPickingController::class . ':edit')->add(PermissionMiddleware::class)->setName('box_picking/edit-box_picking-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', BoxPickingController::class . ':delete')->add(PermissionMiddleware::class)->setName('box_picking/delete-box_picking-delete-2'); // delete
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', BoxPickingController::class . ':search')->add(PermissionMiddleware::class)->setName('box_picking/search-box_picking-search-2'); // search
        }
    );

    // audit_picking
    $app->map(["GET","POST","OPTIONS"], '/auditpickinglist[/{id}]', AuditPickingController::class . ':list')->add(PermissionMiddleware::class)->setName('auditpickinglist-audit_picking-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/auditpickingadd[/{id}]', AuditPickingController::class . ':add')->add(PermissionMiddleware::class)->setName('auditpickingadd-audit_picking-add'); // add
    $app->group(
        '/audit_picking',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', AuditPickingController::class . ':list')->add(PermissionMiddleware::class)->setName('audit_picking/list-audit_picking-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', AuditPickingController::class . ':add')->add(PermissionMiddleware::class)->setName('audit_picking/add-audit_picking-add-2'); // add
        }
    );

    // disposition_location
    $app->map(["GET","POST","OPTIONS"], '/dispositionlocationlist[/{id}]', DispositionLocationController::class . ':list')->add(PermissionMiddleware::class)->setName('dispositionlocationlist-disposition_location-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/dispositionlocationadd[/{id}]', DispositionLocationController::class . ':add')->add(PermissionMiddleware::class)->setName('dispositionlocationadd-disposition_location-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/dispositionlocationedit[/{id}]', DispositionLocationController::class . ':edit')->add(PermissionMiddleware::class)->setName('dispositionlocationedit-disposition_location-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/dispositionlocationdelete[/{id}]', DispositionLocationController::class . ':delete')->add(PermissionMiddleware::class)->setName('dispositionlocationdelete-disposition_location-delete'); // delete
    $app->group(
        '/disposition_location',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', DispositionLocationController::class . ':list')->add(PermissionMiddleware::class)->setName('disposition_location/list-disposition_location-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', DispositionLocationController::class . ':add')->add(PermissionMiddleware::class)->setName('disposition_location/add-disposition_location-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', DispositionLocationController::class . ':edit')->add(PermissionMiddleware::class)->setName('disposition_location/edit-disposition_location-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', DispositionLocationController::class . ':delete')->add(PermissionMiddleware::class)->setName('disposition_location/delete-disposition_location-delete-2'); // delete
        }
    );

    // monitor_kpi
    $app->map(["GET","POST","OPTIONS"], '/monitorkpilist', MonitorKpiController::class . ':list')->add(PermissionMiddleware::class)->setName('monitorkpilist-monitor_kpi-list'); // list
    $app->group(
        '/monitor_kpi',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '', MonitorKpiController::class . ':list')->add(PermissionMiddleware::class)->setName('monitor_kpi/list-monitor_kpi-list-2'); // list
        }
    );

    // monitor_audit_picking
    $app->map(["GET","POST","OPTIONS"], '/monitorauditpickinglist', MonitorAuditPickingController::class . ':list')->add(PermissionMiddleware::class)->setName('monitorauditpickinglist-monitor_audit_picking-list'); // list
    $app->group(
        '/monitor_audit_picking',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '', MonitorAuditPickingController::class . ':list')->add(PermissionMiddleware::class)->setName('monitor_audit_picking/list-monitor_audit_picking-list-2'); // list
        }
    );

    // empty_box
    $app->map(["GET","POST","OPTIONS"], '/emptyboxlist[/{id}]', EmptyBoxController::class . ':list')->add(PermissionMiddleware::class)->setName('emptyboxlist-empty_box-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/emptyboxadd[/{id}]', EmptyBoxController::class . ':add')->add(PermissionMiddleware::class)->setName('emptyboxadd-empty_box-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/emptyboxedit[/{id}]', EmptyBoxController::class . ':edit')->add(PermissionMiddleware::class)->setName('emptyboxedit-empty_box-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/emptyboxdelete[/{id}]', EmptyBoxController::class . ':delete')->add(PermissionMiddleware::class)->setName('emptyboxdelete-empty_box-delete'); // delete
    $app->group(
        '/empty_box',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', EmptyBoxController::class . ':list')->add(PermissionMiddleware::class)->setName('empty_box/list-empty_box-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', EmptyBoxController::class . ':add')->add(PermissionMiddleware::class)->setName('empty_box/add-empty_box-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', EmptyBoxController::class . ':edit')->add(PermissionMiddleware::class)->setName('empty_box/edit-empty_box-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', EmptyBoxController::class . ':delete')->add(PermissionMiddleware::class)->setName('empty_box/delete-empty_box-delete-2'); // delete
        }
    );

    // master_article
    $app->map(["GET","POST","OPTIONS"], '/masterarticlelist[/{id}]', MasterArticleController::class . ':list')->add(PermissionMiddleware::class)->setName('masterarticlelist-master_article-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/masterarticleadd[/{id}]', MasterArticleController::class . ':add')->add(PermissionMiddleware::class)->setName('masterarticleadd-master_article-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/masterarticleview[/{id}]', MasterArticleController::class . ':view')->add(PermissionMiddleware::class)->setName('masterarticleview-master_article-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/masterarticleedit[/{id}]', MasterArticleController::class . ':edit')->add(PermissionMiddleware::class)->setName('masterarticleedit-master_article-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/masterarticledelete[/{id}]', MasterArticleController::class . ':delete')->add(PermissionMiddleware::class)->setName('masterarticledelete-master_article-delete'); // delete
    $app->group(
        '/master_article',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MasterArticleController::class . ':list')->add(PermissionMiddleware::class)->setName('master_article/list-master_article-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MasterArticleController::class . ':add')->add(PermissionMiddleware::class)->setName('master_article/add-master_article-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MasterArticleController::class . ':view')->add(PermissionMiddleware::class)->setName('master_article/view-master_article-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MasterArticleController::class . ':edit')->add(PermissionMiddleware::class)->setName('master_article/edit-master_article-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MasterArticleController::class . ':delete')->add(PermissionMiddleware::class)->setName('master_article/delete-master_article-delete-2'); // delete
        }
    );

    // Dashboard2
    $app->map(["GET", "POST", "OPTIONS"], '/dashboard2', Dashboard2Controller::class)->add(PermissionMiddleware::class)->setName('dashboard2-Dashboard2-dashboard'); // dashboard

    // cycle_count_offline
    $app->map(["GET","POST","OPTIONS"], '/cyclecountofflinelist[/{id}]', CycleCountOfflineController::class . ':list')->add(PermissionMiddleware::class)->setName('cyclecountofflinelist-cycle_count_offline-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/cyclecountofflineadd[/{id}]', CycleCountOfflineController::class . ':add')->add(PermissionMiddleware::class)->setName('cyclecountofflineadd-cycle_count_offline-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/cyclecountofflineedit[/{id}]', CycleCountOfflineController::class . ':edit')->add(PermissionMiddleware::class)->setName('cyclecountofflineedit-cycle_count_offline-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/cyclecountofflinedelete[/{id}]', CycleCountOfflineController::class . ':delete')->add(PermissionMiddleware::class)->setName('cyclecountofflinedelete-cycle_count_offline-delete'); // delete
    $app->group(
        '/cycle_count_offline',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', CycleCountOfflineController::class . ':list')->add(PermissionMiddleware::class)->setName('cycle_count_offline/list-cycle_count_offline-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', CycleCountOfflineController::class . ':add')->add(PermissionMiddleware::class)->setName('cycle_count_offline/add-cycle_count_offline-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', CycleCountOfflineController::class . ':edit')->add(PermissionMiddleware::class)->setName('cycle_count_offline/edit-cycle_count_offline-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', CycleCountOfflineController::class . ':delete')->add(PermissionMiddleware::class)->setName('cycle_count_offline/delete-cycle_count_offline-delete-2'); // delete
        }
    );

    // monitor_cycle_count_offline
    $app->map(["GET","POST","OPTIONS"], '/monitorcyclecountofflinelist', MonitorCycleCountOfflineController::class . ':list')->add(PermissionMiddleware::class)->setName('monitorcyclecountofflinelist-monitor_cycle_count_offline-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/monitorcyclecountofflinesearch', MonitorCycleCountOfflineController::class . ':search')->add(PermissionMiddleware::class)->setName('monitorcyclecountofflinesearch-monitor_cycle_count_offline-search'); // search
    $app->group(
        '/monitor_cycle_count_offline',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '', MonitorCycleCountOfflineController::class . ':list')->add(PermissionMiddleware::class)->setName('monitor_cycle_count_offline/list-monitor_cycle_count_offline-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', MonitorCycleCountOfflineController::class . ':search')->add(PermissionMiddleware::class)->setName('monitor_cycle_count_offline/search-monitor_cycle_count_offline-search-2'); // search
        }
    );

    // extra_stock
    $app->map(["GET","POST","OPTIONS"], '/extrastocklist[/{id}]', ExtraStockController::class . ':list')->add(PermissionMiddleware::class)->setName('extrastocklist-extra_stock-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/extrastockview[/{id}]', ExtraStockController::class . ':view')->add(PermissionMiddleware::class)->setName('extrastockview-extra_stock-view'); // view
    $app->group(
        '/extra_stock',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', ExtraStockController::class . ':list')->add(PermissionMiddleware::class)->setName('extra_stock/list-extra_stock-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', ExtraStockController::class . ':view')->add(PermissionMiddleware::class)->setName('extra_stock/view-extra_stock-view-2'); // view
        }
    );

    // blank_count_sheet
    $app->map(["GET","POST","OPTIONS"], '/blankcountsheetlist[/{id}]', BlankCountSheetController::class . ':list')->add(PermissionMiddleware::class)->setName('blankcountsheetlist-blank_count_sheet-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/blankcountsheetadd[/{id}]', BlankCountSheetController::class . ':add')->add(PermissionMiddleware::class)->setName('blankcountsheetadd-blank_count_sheet-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/blankcountsheetview[/{id}]', BlankCountSheetController::class . ':view')->add(PermissionMiddleware::class)->setName('blankcountsheetview-blank_count_sheet-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/blankcountsheetedit[/{id}]', BlankCountSheetController::class . ':edit')->add(PermissionMiddleware::class)->setName('blankcountsheetedit-blank_count_sheet-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/blankcountsheetdelete[/{id}]', BlankCountSheetController::class . ':delete')->add(PermissionMiddleware::class)->setName('blankcountsheetdelete-blank_count_sheet-delete'); // delete
    $app->group(
        '/blank_count_sheet',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', BlankCountSheetController::class . ':list')->add(PermissionMiddleware::class)->setName('blank_count_sheet/list-blank_count_sheet-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', BlankCountSheetController::class . ':add')->add(PermissionMiddleware::class)->setName('blank_count_sheet/add-blank_count_sheet-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', BlankCountSheetController::class . ':view')->add(PermissionMiddleware::class)->setName('blank_count_sheet/view-blank_count_sheet-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', BlankCountSheetController::class . ':edit')->add(PermissionMiddleware::class)->setName('blank_count_sheet/edit-blank_count_sheet-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', BlankCountSheetController::class . ':delete')->add(PermissionMiddleware::class)->setName('blank_count_sheet/delete-blank_count_sheet-delete-2'); // delete
        }
    );

    // monitor_staging_on_staging
    $app->map(["GET","POST","OPTIONS"], '/monitorstagingonstaginglist[/{id}]', MonitorStagingOnStagingController::class . ':list')->add(PermissionMiddleware::class)->setName('monitorstagingonstaginglist-monitor_staging_on_staging-list'); // list
    $app->group(
        '/monitor_staging_on_staging',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MonitorStagingOnStagingController::class . ':list')->add(PermissionMiddleware::class)->setName('monitor_staging_on_staging/list-monitor_staging_on_staging-list-2'); // list
        }
    );

    // monitor_staging_delivered
    $app->map(["GET","POST","OPTIONS"], '/monitorstagingdeliveredlist[/{id}]', MonitorStagingDeliveredController::class . ':list')->add(PermissionMiddleware::class)->setName('monitorstagingdeliveredlist-monitor_staging_delivered-list'); // list
    $app->group(
        '/monitor_staging_delivered',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MonitorStagingDeliveredController::class . ':list')->add(PermissionMiddleware::class)->setName('monitor_staging_delivered/list-monitor_staging_delivered-list-2'); // list
        }
    );

    // OnStaging
    $app->map(["GET", "POST", "OPTIONS"], '/onstaging', OnStagingController::class)->add(PermissionMiddleware::class)->setName('onstaging-OnStaging-summary'); // summary

    // Outbound
    $app->map(["GET", "POST", "OPTIONS"], '/outbound', OutboundController::class)->add(PermissionMiddleware::class)->setName('outbound-Outbound-summary'); // summary

    // locations
    $app->map(["GET","POST","OPTIONS"], '/locationslist[/{id}]', LocationsController::class . ':list')->add(PermissionMiddleware::class)->setName('locationslist-locations-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/locationsadd[/{id}]', LocationsController::class . ':add')->add(PermissionMiddleware::class)->setName('locationsadd-locations-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/locationsedit[/{id}]', LocationsController::class . ':edit')->add(PermissionMiddleware::class)->setName('locationsedit-locations-edit'); // edit
    $app->group(
        '/locations',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', LocationsController::class . ':list')->add(PermissionMiddleware::class)->setName('locations/list-locations-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', LocationsController::class . ':add')->add(PermissionMiddleware::class)->setName('locations/add-locations-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', LocationsController::class . ':edit')->add(PermissionMiddleware::class)->setName('locations/edit-locations-edit-2'); // edit
        }
    );

    // mb51
    $app->map(["GET","POST","OPTIONS"], '/mb51list[/{id}]', Mb51Controller::class . ':list')->add(PermissionMiddleware::class)->setName('mb51list-mb51-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/mb51add[/{id}]', Mb51Controller::class . ':add')->add(PermissionMiddleware::class)->setName('mb51add-mb51-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/mb51view[/{id}]', Mb51Controller::class . ':view')->add(PermissionMiddleware::class)->setName('mb51view-mb51-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/mb51edit[/{id}]', Mb51Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('mb51edit-mb51-edit'); // edit
    $app->group(
        '/mb51',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', Mb51Controller::class . ':list')->add(PermissionMiddleware::class)->setName('mb51/list-mb51-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', Mb51Controller::class . ':add')->add(PermissionMiddleware::class)->setName('mb51/add-mb51-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', Mb51Controller::class . ':view')->add(PermissionMiddleware::class)->setName('mb51/view-mb51-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', Mb51Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('mb51/edit-mb51-edit-2'); // edit
        }
    );

    // master_article2
    $app->map(["GET","POST","OPTIONS"], '/masterarticle2list[/{id}]', MasterArticle2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('masterarticle2list-master_article2-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/masterarticle2add[/{id}]', MasterArticle2Controller::class . ':add')->add(PermissionMiddleware::class)->setName('masterarticle2add-master_article2-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/masterarticle2view[/{id}]', MasterArticle2Controller::class . ':view')->add(PermissionMiddleware::class)->setName('masterarticle2view-master_article2-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/masterarticle2edit[/{id}]', MasterArticle2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('masterarticle2edit-master_article2-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/masterarticle2delete[/{id}]', MasterArticle2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('masterarticle2delete-master_article2-delete'); // delete
    $app->group(
        '/master_article2',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', MasterArticle2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('master_article2/list-master_article2-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', MasterArticle2Controller::class . ':add')->add(PermissionMiddleware::class)->setName('master_article2/add-master_article2-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', MasterArticle2Controller::class . ':view')->add(PermissionMiddleware::class)->setName('master_article2/view-master_article2-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', MasterArticle2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('master_article2/edit-master_article2-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', MasterArticle2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('master_article2/delete-master_article2-delete-2'); // delete
        }
    );

    // finding_shortpick2
    $app->map(["GET","POST","OPTIONS"], '/findingshortpick2list[/{id}]', FindingShortpick2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('findingshortpick2list-finding_shortpick2-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/findingshortpick2add[/{id}]', FindingShortpick2Controller::class . ':add')->add(PermissionMiddleware::class)->setName('findingshortpick2add-finding_shortpick2-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/findingshortpick2view[/{id}]', FindingShortpick2Controller::class . ':view')->add(PermissionMiddleware::class)->setName('findingshortpick2view-finding_shortpick2-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/findingshortpick2edit[/{id}]', FindingShortpick2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('findingshortpick2edit-finding_shortpick2-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/findingshortpick2delete[/{id}]', FindingShortpick2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('findingshortpick2delete-finding_shortpick2-delete'); // delete
    $app->map(["GET","POST","OPTIONS"], '/findingshortpick2search', FindingShortpick2Controller::class . ':search')->add(PermissionMiddleware::class)->setName('findingshortpick2search-finding_shortpick2-search'); // search
    $app->group(
        '/finding_shortpick2',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', FindingShortpick2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('finding_shortpick2/list-finding_shortpick2-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', FindingShortpick2Controller::class . ':add')->add(PermissionMiddleware::class)->setName('finding_shortpick2/add-finding_shortpick2-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', FindingShortpick2Controller::class . ':view')->add(PermissionMiddleware::class)->setName('finding_shortpick2/view-finding_shortpick2-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', FindingShortpick2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('finding_shortpick2/edit-finding_shortpick2-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', FindingShortpick2Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('finding_shortpick2/delete-finding_shortpick2-delete-2'); // delete
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', FindingShortpick2Controller::class . ':search')->add(PermissionMiddleware::class)->setName('finding_shortpick2/search-finding_shortpick2-search-2'); // search
        }
    );

    // transfer_bin_piece
    $app->map(["GET","POST","OPTIONS"], '/transferbinpiecelist[/{id}]', TransferBinPieceController::class . ':list')->add(PermissionMiddleware::class)->setName('transferbinpiecelist-transfer_bin_piece-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/transferbinpieceadd[/{id}]', TransferBinPieceController::class . ':add')->add(PermissionMiddleware::class)->setName('transferbinpieceadd-transfer_bin_piece-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/transferbinpieceview[/{id}]', TransferBinPieceController::class . ':view')->add(PermissionMiddleware::class)->setName('transferbinpieceview-transfer_bin_piece-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/transferbinpieceedit[/{id}]', TransferBinPieceController::class . ':edit')->add(PermissionMiddleware::class)->setName('transferbinpieceedit-transfer_bin_piece-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/transferbinpiecedelete[/{id}]', TransferBinPieceController::class . ':delete')->add(PermissionMiddleware::class)->setName('transferbinpiecedelete-transfer_bin_piece-delete'); // delete
    $app->map(["GET","POST","OPTIONS"], '/transferbinpiecesearch', TransferBinPieceController::class . ':search')->add(PermissionMiddleware::class)->setName('transferbinpiecesearch-transfer_bin_piece-search'); // search
    $app->group(
        '/transfer_bin_piece',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', TransferBinPieceController::class . ':list')->add(PermissionMiddleware::class)->setName('transfer_bin_piece/list-transfer_bin_piece-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', TransferBinPieceController::class . ':add')->add(PermissionMiddleware::class)->setName('transfer_bin_piece/add-transfer_bin_piece-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', TransferBinPieceController::class . ':view')->add(PermissionMiddleware::class)->setName('transfer_bin_piece/view-transfer_bin_piece-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', TransferBinPieceController::class . ':edit')->add(PermissionMiddleware::class)->setName('transfer_bin_piece/edit-transfer_bin_piece-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', TransferBinPieceController::class . ':delete')->add(PermissionMiddleware::class)->setName('transfer_bin_piece/delete-transfer_bin_piece-delete-2'); // delete
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', TransferBinPieceController::class . ':search')->add(PermissionMiddleware::class)->setName('transfer_bin_piece/search-transfer_bin_piece-search-2'); // search
        }
    );

    // bin_to_bin_piece
    $app->map(["GET","POST","OPTIONS"], '/bintobinpiecelist[/{id}]', BinToBinPieceController::class . ':list')->add(PermissionMiddleware::class)->setName('bintobinpiecelist-bin_to_bin_piece-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/bintobinpieceedit[/{id}]', BinToBinPieceController::class . ':edit')->add(PermissionMiddleware::class)->setName('bintobinpieceedit-bin_to_bin_piece-edit'); // edit
    $app->group(
        '/bin_to_bin_piece',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', BinToBinPieceController::class . ':list')->add(PermissionMiddleware::class)->setName('bin_to_bin_piece/list-bin_to_bin_piece-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', BinToBinPieceController::class . ':edit')->add(PermissionMiddleware::class)->setName('bin_to_bin_piece/edit-bin_to_bin_piece-edit-2'); // edit
        }
    );

    // shortpick_by_area
    $app->map(["GET","POST","OPTIONS"], '/shortpickbyarealist', ShortpickByAreaController::class . ':list')->add(PermissionMiddleware::class)->setName('shortpickbyarealist-shortpick_by_area-list'); // list
    $app->group(
        '/shortpick_by_area',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '', ShortpickByAreaController::class . ':list')->add(PermissionMiddleware::class)->setName('shortpick_by_area/list-shortpick_by_area-list-2'); // list
        }
    );

    // findingshortpick
    $app->map(["GET","POST","OPTIONS"], '/findingshortpicklist[/{id}]', FindingshortpickController::class . ':list')->add(PermissionMiddleware::class)->setName('findingshortpicklist-findingshortpick-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/findingshortpickedit[/{id}]', FindingshortpickController::class . ':edit')->add(PermissionMiddleware::class)->setName('findingshortpickedit-findingshortpick-edit'); // edit
    $app->group(
        '/findingshortpick',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', FindingshortpickController::class . ':list')->add(PermissionMiddleware::class)->setName('findingshortpick/list-findingshortpick-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', FindingshortpickController::class . ':edit')->add(PermissionMiddleware::class)->setName('findingshortpick/edit-findingshortpick-edit-2'); // edit
        }
    );

    // picking
    $app->map(["GET","POST","OPTIONS"], '/pickinglist[/{id}]', PickingController::class . ':list')->add(PermissionMiddleware::class)->setName('pickinglist-picking-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/pickingadd[/{id}]', PickingController::class . ':add')->add(PermissionMiddleware::class)->setName('pickingadd-picking-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/pickingedit[/{id}]', PickingController::class . ':edit')->add(PermissionMiddleware::class)->setName('pickingedit-picking-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/pickingsearch', PickingController::class . ':search')->add(PermissionMiddleware::class)->setName('pickingsearch-picking-search'); // search
    $app->group(
        '/picking',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PickingController::class . ':list')->add(PermissionMiddleware::class)->setName('picking/list-picking-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', PickingController::class . ':add')->add(PermissionMiddleware::class)->setName('picking/add-picking-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', PickingController::class . ':edit')->add(PermissionMiddleware::class)->setName('picking/edit-picking-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', PickingController::class . ':search')->add(PermissionMiddleware::class)->setName('picking/search-picking-search-2'); // search
        }
    );

    // job_control_copy1
    $app->map(["GET","POST","OPTIONS"], '/jobcontrolcopy1list[/{id}]', JobControlCopy1Controller::class . ':list')->add(PermissionMiddleware::class)->setName('jobcontrolcopy1list-job_control_copy1-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/jobcontrolcopy1add[/{id}]', JobControlCopy1Controller::class . ':add')->add(PermissionMiddleware::class)->setName('jobcontrolcopy1add-job_control_copy1-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/jobcontrolcopy1view[/{id}]', JobControlCopy1Controller::class . ':view')->add(PermissionMiddleware::class)->setName('jobcontrolcopy1view-job_control_copy1-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/jobcontrolcopy1delete[/{id}]', JobControlCopy1Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('jobcontrolcopy1delete-job_control_copy1-delete'); // delete
    $app->group(
        '/job_control_copy1',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', JobControlCopy1Controller::class . ':list')->add(PermissionMiddleware::class)->setName('job_control_copy1/list-job_control_copy1-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', JobControlCopy1Controller::class . ':add')->add(PermissionMiddleware::class)->setName('job_control_copy1/add-job_control_copy1-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', JobControlCopy1Controller::class . ':view')->add(PermissionMiddleware::class)->setName('job_control_copy1/view-job_control_copy1-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', JobControlCopy1Controller::class . ':delete')->add(PermissionMiddleware::class)->setName('job_control_copy1/delete-job_control_copy1-delete-2'); // delete
        }
    );

    // picking_pending
    $app->map(["GET","POST","OPTIONS"], '/pickingpendinglist[/{id}]', PickingPendingController::class . ':list')->add(PermissionMiddleware::class)->setName('pickingpendinglist-picking_pending-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/pickingpendingedit[/{id}]', PickingPendingController::class . ':edit')->add(PermissionMiddleware::class)->setName('pickingpendingedit-picking_pending-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/pickingpendingsearch', PickingPendingController::class . ':search')->add(PermissionMiddleware::class)->setName('pickingpendingsearch-picking_pending-search'); // search
    $app->group(
        '/picking_pending',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PickingPendingController::class . ':list')->add(PermissionMiddleware::class)->setName('picking_pending/list-picking_pending-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', PickingPendingController::class . ':edit')->add(PermissionMiddleware::class)->setName('picking_pending/edit-picking_pending-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', PickingPendingController::class . ':search')->add(PermissionMiddleware::class)->setName('picking_pending/search-picking_pending-search-2'); // search
        }
    );

    // report_totes
    $app->map(["GET","POST","OPTIONS"], '/reporttoteslist[/{id}]', ReportTotesController::class . ':list')->add(PermissionMiddleware::class)->setName('reporttoteslist-report_totes-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/reporttotesadd[/{id}]', ReportTotesController::class . ':add')->add(PermissionMiddleware::class)->setName('reporttotesadd-report_totes-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/reporttotesview[/{id}]', ReportTotesController::class . ':view')->add(PermissionMiddleware::class)->setName('reporttotesview-report_totes-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/reporttotesedit[/{id}]', ReportTotesController::class . ':edit')->add(PermissionMiddleware::class)->setName('reporttotesedit-report_totes-edit'); // edit
    $app->group(
        '/report_totes',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', ReportTotesController::class . ':list')->add(PermissionMiddleware::class)->setName('report_totes/list-report_totes-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', ReportTotesController::class . ':add')->add(PermissionMiddleware::class)->setName('report_totes/add-report_totes-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', ReportTotesController::class . ':view')->add(PermissionMiddleware::class)->setName('report_totes/view-report_totes-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', ReportTotesController::class . ':edit')->add(PermissionMiddleware::class)->setName('report_totes/edit-report_totes-edit-2'); // edit
        }
    );

    // box_result
    $app->map(["GET","POST","OPTIONS"], '/boxresultlist', BoxResultController::class . ':list')->add(PermissionMiddleware::class)->setName('boxresultlist-box_result-list'); // list
    $app->group(
        '/box_result',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '', BoxResultController::class . ':list')->add(PermissionMiddleware::class)->setName('box_result/list-box_result-list-2'); // list
        }
    );

    // oss_manual
    $app->map(["GET","POST","OPTIONS"], '/ossmanuallist[/{sscc:.*}]', OssManualController::class . ':list')->add(PermissionMiddleware::class)->setName('ossmanuallist-oss_manual-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/ossmanualadd[/{sscc:.*}]', OssManualController::class . ':add')->add(PermissionMiddleware::class)->setName('ossmanualadd-oss_manual-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/ossmanualview[/{sscc:.*}]', OssManualController::class . ':view')->add(PermissionMiddleware::class)->setName('ossmanualview-oss_manual-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/ossmanualedit[/{sscc:.*}]', OssManualController::class . ':edit')->add(PermissionMiddleware::class)->setName('ossmanualedit-oss_manual-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/ossmanualdelete[/{sscc:.*}]', OssManualController::class . ':delete')->add(PermissionMiddleware::class)->setName('ossmanualdelete-oss_manual-delete'); // delete
    $app->map(["GET","POST","OPTIONS"], '/ossmanualsearch', OssManualController::class . ':search')->add(PermissionMiddleware::class)->setName('ossmanualsearch-oss_manual-search'); // search
    $app->group(
        '/oss_manual',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{sscc:.*}]', OssManualController::class . ':list')->add(PermissionMiddleware::class)->setName('oss_manual/list-oss_manual-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{sscc:.*}]', OssManualController::class . ':add')->add(PermissionMiddleware::class)->setName('oss_manual/add-oss_manual-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{sscc:.*}]', OssManualController::class . ':view')->add(PermissionMiddleware::class)->setName('oss_manual/view-oss_manual-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{sscc:.*}]', OssManualController::class . ':edit')->add(PermissionMiddleware::class)->setName('oss_manual/edit-oss_manual-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{sscc:.*}]', OssManualController::class . ':delete')->add(PermissionMiddleware::class)->setName('oss_manual/delete-oss_manual-delete-2'); // delete
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', OssManualController::class . ':search')->add(PermissionMiddleware::class)->setName('oss_manual/search-oss_manual-search-2'); // search
        }
    );

    // productivity_online
    $app->map(["GET","POST","OPTIONS"], '/productivityonlinelist', ProductivityOnlineController::class . ':list')->add(PermissionMiddleware::class)->setName('productivityonlinelist-productivity_online-list'); // list
    $app->group(
        '/productivity_online',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '', ProductivityOnlineController::class . ':list')->add(PermissionMiddleware::class)->setName('productivity_online/list-productivity_online-list-2'); // list
        }
    );

    // check_box
    $app->map(["GET","POST","OPTIONS"], '/checkboxlist', CheckBoxController::class . ':list')->add(PermissionMiddleware::class)->setName('checkboxlist-check_box-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/checkboxsearch', CheckBoxController::class . ':search')->add(PermissionMiddleware::class)->setName('checkboxsearch-check_box-search'); // search
    $app->group(
        '/check_box',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '', CheckBoxController::class . ':list')->add(PermissionMiddleware::class)->setName('check_box/list-check_box-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', CheckBoxController::class . ':search')->add(PermissionMiddleware::class)->setName('check_box/search-check_box-search-2'); // search
        }
    );

    // audit_picking_online
    $app->map(["GET","POST","OPTIONS"], '/auditpickingonlinelist[/{id}]', AuditPickingOnlineController::class . ':list')->add(PermissionMiddleware::class)->setName('auditpickingonlinelist-audit_picking_online-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/auditpickingonlineadd[/{id}]', AuditPickingOnlineController::class . ':add')->add(PermissionMiddleware::class)->setName('auditpickingonlineadd-audit_picking_online-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/auditpickingonlineview[/{id}]', AuditPickingOnlineController::class . ':view')->add(PermissionMiddleware::class)->setName('auditpickingonlineview-audit_picking_online-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/auditpickingonlineedit[/{id}]', AuditPickingOnlineController::class . ':edit')->add(PermissionMiddleware::class)->setName('auditpickingonlineedit-audit_picking_online-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/auditpickingonlinedelete[/{id}]', AuditPickingOnlineController::class . ':delete')->add(PermissionMiddleware::class)->setName('auditpickingonlinedelete-audit_picking_online-delete'); // delete
    $app->group(
        '/audit_picking_online',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', AuditPickingOnlineController::class . ':list')->add(PermissionMiddleware::class)->setName('audit_picking_online/list-audit_picking_online-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', AuditPickingOnlineController::class . ':add')->add(PermissionMiddleware::class)->setName('audit_picking_online/add-audit_picking_online-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', AuditPickingOnlineController::class . ':view')->add(PermissionMiddleware::class)->setName('audit_picking_online/view-audit_picking_online-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', AuditPickingOnlineController::class . ':edit')->add(PermissionMiddleware::class)->setName('audit_picking_online/edit-audit_picking_online-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', AuditPickingOnlineController::class . ':delete')->add(PermissionMiddleware::class)->setName('audit_picking_online/delete-audit_picking_online-delete-2'); // delete
        }
    );

    // userlevelpermissions
    $app->map(["GET","POST","OPTIONS"], '/userlevelpermissionslist[/{keys:.*}]', UserlevelpermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevelpermissionslist-userlevelpermissions-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/userlevelpermissionsadd[/{keys:.*}]', UserlevelpermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevelpermissionsadd-userlevelpermissions-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/userlevelpermissionsview[/{keys:.*}]', UserlevelpermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevelpermissionsview-userlevelpermissions-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/userlevelpermissionsedit[/{keys:.*}]', UserlevelpermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevelpermissionsedit-userlevelpermissions-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/userlevelpermissionsdelete[/{keys:.*}]', UserlevelpermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevelpermissionsdelete-userlevelpermissions-delete'); // delete
    $app->group(
        '/userlevelpermissions',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{keys:.*}]', UserlevelpermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevelpermissions/list-userlevelpermissions-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{keys:.*}]', UserlevelpermissionsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevelpermissions/add-userlevelpermissions-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{keys:.*}]', UserlevelpermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevelpermissions/view-userlevelpermissions-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{keys:.*}]', UserlevelpermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevelpermissions/edit-userlevelpermissions-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{keys:.*}]', UserlevelpermissionsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevelpermissions/delete-userlevelpermissions-delete-2'); // delete
        }
    );

    // userlevels
    $app->map(["GET","POST","OPTIONS"], '/userlevelslist[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevelslist-userlevels-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/userlevelsadd[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevelsadd-userlevels-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/userlevelsview[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevelsview-userlevels-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/userlevelsedit[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevelsedit-userlevels-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/userlevelsdelete[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevelsdelete-userlevels-delete'); // delete
    $app->group(
        '/userlevels',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevels/list-userlevels-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevels/add-userlevels-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevels/view-userlevels-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevels/edit-userlevels-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevels/delete-userlevels-delete-2'); // delete
        }
    );

    // stock_count
    $app->map(["GET","POST","OPTIONS"], '/stockcountlist[/{id}]', StockCountController::class . ':list')->add(PermissionMiddleware::class)->setName('stockcountlist-stock_count-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/stockcountadd[/{id}]', StockCountController::class . ':add')->add(PermissionMiddleware::class)->setName('stockcountadd-stock_count-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/stockcountview[/{id}]', StockCountController::class . ':view')->add(PermissionMiddleware::class)->setName('stockcountview-stock_count-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/stockcountedit[/{id}]', StockCountController::class . ':edit')->add(PermissionMiddleware::class)->setName('stockcountedit-stock_count-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/stockcountdelete[/{id}]', StockCountController::class . ':delete')->add(PermissionMiddleware::class)->setName('stockcountdelete-stock_count-delete'); // delete
    $app->map(["GET","POST","OPTIONS"], '/stockcountsearch', StockCountController::class . ':search')->add(PermissionMiddleware::class)->setName('stockcountsearch-stock_count-search'); // search
    $app->group(
        '/stock_count',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', StockCountController::class . ':list')->add(PermissionMiddleware::class)->setName('stock_count/list-stock_count-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', StockCountController::class . ':add')->add(PermissionMiddleware::class)->setName('stock_count/add-stock_count-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', StockCountController::class . ':view')->add(PermissionMiddleware::class)->setName('stock_count/view-stock_count-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', StockCountController::class . ':edit')->add(PermissionMiddleware::class)->setName('stock_count/edit-stock_count-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', StockCountController::class . ':delete')->add(PermissionMiddleware::class)->setName('stock_count/delete-stock_count-delete-2'); // delete
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', StockCountController::class . ':search')->add(PermissionMiddleware::class)->setName('stock_count/search-stock_count-search-2'); // search
        }
    );

    // summary_stock_count
    $app->map(["GET","POST","OPTIONS"], '/summarystockcountlist', SummaryStockCountController::class . ':list')->add(PermissionMiddleware::class)->setName('summarystockcountlist-summary_stock_count-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/summarystockcountsearch', SummaryStockCountController::class . ':search')->add(PermissionMiddleware::class)->setName('summarystockcountsearch-summary_stock_count-search'); // search
    $app->group(
        '/summary_stock_count',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '', SummaryStockCountController::class . ':list')->add(PermissionMiddleware::class)->setName('summary_stock_count/list-summary_stock_count-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("SEARCH_ACTION") . '', SummaryStockCountController::class . ':search')->add(PermissionMiddleware::class)->setName('summary_stock_count/search-summary_stock_count-search-2'); // search
        }
    );

    // active_stock
    $app->map(["GET","POST","OPTIONS"], '/activestocklist[/{aisle:.*}]', ActiveStockController::class . ':list')->add(PermissionMiddleware::class)->setName('activestocklist-active_stock-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/activestockview[/{aisle:.*}]', ActiveStockController::class . ':view')->add(PermissionMiddleware::class)->setName('activestockview-active_stock-view'); // view
    $app->group(
        '/active_stock',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{aisle:.*}]', ActiveStockController::class . ':list')->add(PermissionMiddleware::class)->setName('active_stock/list-active_stock-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{aisle:.*}]', ActiveStockController::class . ':view')->add(PermissionMiddleware::class)->setName('active_stock/view-active_stock-view-2'); // view
        }
    );

    // stock_count_monitor
    $app->map(["GET","POST","OPTIONS"], '/stockcountmonitorlist', StockCountMonitorController::class . ':list')->add(PermissionMiddleware::class)->setName('stockcountmonitorlist-stock_count_monitor-list'); // list
    $app->group(
        '/stock_count_monitor',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '', StockCountMonitorController::class . ':list')->add(PermissionMiddleware::class)->setName('stock_count_monitor/list-stock_count_monitor-list-2'); // list
        }
    );

    // putaway_staging
    $app->map(["GET","POST","OPTIONS"], '/putawaystaginglist[/{id}]', PutawayStagingController::class . ':list')->add(PermissionMiddleware::class)->setName('putawaystaginglist-putaway_staging-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/putawaystagingedit[/{id}]', PutawayStagingController::class . ':edit')->add(PermissionMiddleware::class)->setName('putawaystagingedit-putaway_staging-edit'); // edit
    $app->group(
        '/putaway_staging',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PutawayStagingController::class . ':list')->add(PermissionMiddleware::class)->setName('putaway_staging/list-putaway_staging-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', PutawayStagingController::class . ':edit')->add(PermissionMiddleware::class)->setName('putaway_staging/edit-putaway_staging-edit-2'); // edit
        }
    );

    // putaway_staging2
    $app->map(["GET","POST","OPTIONS"], '/putawaystaging2list[/{id}]', PutawayStaging2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('putawaystaging2list-putaway_staging2-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/putawaystaging2edit[/{id}]', PutawayStaging2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('putawaystaging2edit-putaway_staging2-edit'); // edit
    $app->group(
        '/putaway_staging2',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PutawayStaging2Controller::class . ':list')->add(PermissionMiddleware::class)->setName('putaway_staging2/list-putaway_staging2-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', PutawayStaging2Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('putaway_staging2/edit-putaway_staging2-edit-2'); // edit
        }
    );

    // putaway_staging3
    $app->map(["GET","POST","OPTIONS"], '/putawaystaging3list[/{id}]', PutawayStaging3Controller::class . ':list')->add(PermissionMiddleware::class)->setName('putawaystaging3list-putaway_staging3-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/putawaystaging3edit[/{id}]', PutawayStaging3Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('putawaystaging3edit-putaway_staging3-edit'); // edit
    $app->group(
        '/putaway_staging3',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PutawayStaging3Controller::class . ':list')->add(PermissionMiddleware::class)->setName('putaway_staging3/list-putaway_staging3-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', PutawayStaging3Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('putaway_staging3/edit-putaway_staging3-edit-2'); // edit
        }
    );

    // putaway_staging4
    $app->map(["GET","POST","OPTIONS"], '/putawaystaging4list[/{id}]', PutawayStaging4Controller::class . ':list')->add(PermissionMiddleware::class)->setName('putawaystaging4list-putaway_staging4-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/putawaystaging4edit[/{id}]', PutawayStaging4Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('putawaystaging4edit-putaway_staging4-edit'); // edit
    $app->group(
        '/putaway_staging4',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PutawayStaging4Controller::class . ':list')->add(PermissionMiddleware::class)->setName('putaway_staging4/list-putaway_staging4-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', PutawayStaging4Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('putaway_staging4/edit-putaway_staging4-edit-2'); // edit
        }
    );

    // putaway_staging5
    $app->map(["GET","POST","OPTIONS"], '/putawaystaging5list[/{id}]', PutawayStaging5Controller::class . ':list')->add(PermissionMiddleware::class)->setName('putawaystaging5list-putaway_staging5-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/putawaystaging5edit[/{id}]', PutawayStaging5Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('putawaystaging5edit-putaway_staging5-edit'); // edit
    $app->group(
        '/putaway_staging5',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PutawayStaging5Controller::class . ':list')->add(PermissionMiddleware::class)->setName('putaway_staging5/list-putaway_staging5-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', PutawayStaging5Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('putaway_staging5/edit-putaway_staging5-edit-2'); // edit
        }
    );

    // putaway_staging6
    $app->map(["GET","POST","OPTIONS"], '/putawaystaging6list[/{id}]', PutawayStaging6Controller::class . ':list')->add(PermissionMiddleware::class)->setName('putawaystaging6list-putaway_staging6-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/putawaystaging6edit[/{id}]', PutawayStaging6Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('putawaystaging6edit-putaway_staging6-edit'); // edit
    $app->group(
        '/putaway_staging6',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PutawayStaging6Controller::class . ':list')->add(PermissionMiddleware::class)->setName('putaway_staging6/list-putaway_staging6-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', PutawayStaging6Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('putaway_staging6/edit-putaway_staging6-edit-2'); // edit
        }
    );

    // putaway_staging7
    $app->map(["GET","POST","OPTIONS"], '/putawaystaging7list[/{id}]', PutawayStaging7Controller::class . ':list')->add(PermissionMiddleware::class)->setName('putawaystaging7list-putaway_staging7-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/putawaystaging7edit[/{id}]', PutawayStaging7Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('putawaystaging7edit-putaway_staging7-edit'); // edit
    $app->group(
        '/putaway_staging7',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PutawayStaging7Controller::class . ':list')->add(PermissionMiddleware::class)->setName('putaway_staging7/list-putaway_staging7-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', PutawayStaging7Controller::class . ':edit')->add(PermissionMiddleware::class)->setName('putaway_staging7/edit-putaway_staging7-edit-2'); // edit
        }
    );

    // bin_to_bin
    $app->map(["GET","POST","OPTIONS"], '/bintobinlist[/{id}]', BinToBinController::class . ':list')->add(PermissionMiddleware::class)->setName('bintobinlist-bin_to_bin-list'); // list
    $app->group(
        '/bin_to_bin',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', BinToBinController::class . ':list')->add(PermissionMiddleware::class)->setName('bin_to_bin/list-bin_to_bin-list-2'); // list
        }
    );

    // putaway_opening
    $app->map(["GET","POST","OPTIONS"], '/putawayopeninglist[/{id}]', PutawayOpeningController::class . ':list')->add(PermissionMiddleware::class)->setName('putawayopeninglist-putaway_opening-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/putawayopeningedit[/{id}]', PutawayOpeningController::class . ':edit')->add(PermissionMiddleware::class)->setName('putawayopeningedit-putaway_opening-edit'); // edit
    $app->group(
        '/putaway_opening',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', PutawayOpeningController::class . ':list')->add(PermissionMiddleware::class)->setName('putaway_opening/list-putaway_opening-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', PutawayOpeningController::class . ':edit')->add(PermissionMiddleware::class)->setName('putaway_opening/edit-putaway_opening-edit-2'); // edit
        }
    );

    // vas_validation
    $app->map(["GET","POST","OPTIONS"], '/vasvalidationlist[/{id}]', VasValidationController::class . ':list')->add(PermissionMiddleware::class)->setName('vasvalidationlist-vas_validation-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/vasvalidationadd[/{id}]', VasValidationController::class . ':add')->add(PermissionMiddleware::class)->setName('vasvalidationadd-vas_validation-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/vasvalidationview[/{id}]', VasValidationController::class . ':view')->add(PermissionMiddleware::class)->setName('vasvalidationview-vas_validation-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/vasvalidationedit[/{id}]', VasValidationController::class . ':edit')->add(PermissionMiddleware::class)->setName('vasvalidationedit-vas_validation-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/vasvalidationdelete[/{id}]', VasValidationController::class . ':delete')->add(PermissionMiddleware::class)->setName('vasvalidationdelete-vas_validation-delete'); // delete
    $app->group(
        '/vas_validation',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', VasValidationController::class . ':list')->add(PermissionMiddleware::class)->setName('vas_validation/list-vas_validation-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', VasValidationController::class . ':add')->add(PermissionMiddleware::class)->setName('vas_validation/add-vas_validation-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{id}]', VasValidationController::class . ':view')->add(PermissionMiddleware::class)->setName('vas_validation/view-vas_validation-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{id}]', VasValidationController::class . ':edit')->add(PermissionMiddleware::class)->setName('vas_validation/edit-vas_validation-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{id}]', VasValidationController::class . ':delete')->add(PermissionMiddleware::class)->setName('vas_validation/delete-vas_validation-delete-2'); // delete
        }
    );

    // checking_vas
    $app->map(["GET","POST","OPTIONS"], '/checkingvaslist[/{id}]', CheckingVasController::class . ':list')->add(PermissionMiddleware::class)->setName('checkingvaslist-checking_vas-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/checkingvasadd[/{id}]', CheckingVasController::class . ':add')->add(PermissionMiddleware::class)->setName('checkingvasadd-checking_vas-add'); // add
    $app->group(
        '/checking_vas',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{id}]', CheckingVasController::class . ':list')->add(PermissionMiddleware::class)->setName('checking_vas/list-checking_vas-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{id}]', CheckingVasController::class . ':add')->add(PermissionMiddleware::class)->setName('checking_vas/add-checking_vas-add-2'); // add
        }
    );

    // box_picking_online
    $app->map(["GET","POST","OPTIONS"], '/boxpickingonlinelist[/{box_id:.*}]', BoxPickingOnlineController::class . ':list')->add(PermissionMiddleware::class)->setName('boxpickingonlinelist-box_picking_online-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/boxpickingonlineadd[/{box_id:.*}]', BoxPickingOnlineController::class . ':add')->add(PermissionMiddleware::class)->setName('boxpickingonlineadd-box_picking_online-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/boxpickingonlineview[/{box_id:.*}]', BoxPickingOnlineController::class . ':view')->add(PermissionMiddleware::class)->setName('boxpickingonlineview-box_picking_online-view'); // view
    $app->map(["GET","POST","OPTIONS"], '/boxpickingonlineedit[/{box_id:.*}]', BoxPickingOnlineController::class . ':edit')->add(PermissionMiddleware::class)->setName('boxpickingonlineedit-box_picking_online-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/boxpickingonlinedelete[/{box_id:.*}]', BoxPickingOnlineController::class . ':delete')->add(PermissionMiddleware::class)->setName('boxpickingonlinedelete-box_picking_online-delete'); // delete
    $app->group(
        '/box_picking_online',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{box_id:.*}]', BoxPickingOnlineController::class . ':list')->add(PermissionMiddleware::class)->setName('box_picking_online/list-box_picking_online-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{box_id:.*}]', BoxPickingOnlineController::class . ':add')->add(PermissionMiddleware::class)->setName('box_picking_online/add-box_picking_online-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("VIEW_ACTION") . '[/{box_id:.*}]', BoxPickingOnlineController::class . ':view')->add(PermissionMiddleware::class)->setName('box_picking_online/view-box_picking_online-view-2'); // view
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{box_id:.*}]', BoxPickingOnlineController::class . ':edit')->add(PermissionMiddleware::class)->setName('box_picking_online/edit-box_picking_online-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{box_id:.*}]', BoxPickingOnlineController::class . ':delete')->add(PermissionMiddleware::class)->setName('box_picking_online/delete-box_picking_online-delete-2'); // delete
        }
    );

    // inbound_excess
    $app->map(["GET","POST","OPTIONS"], '/inboundexcesslist[/{sscc:.*}]', InboundExcessController::class . ':list')->add(PermissionMiddleware::class)->setName('inboundexcesslist-inbound_excess-list'); // list
    $app->map(["GET","POST","OPTIONS"], '/inboundexcessadd[/{sscc:.*}]', InboundExcessController::class . ':add')->add(PermissionMiddleware::class)->setName('inboundexcessadd-inbound_excess-add'); // add
    $app->map(["GET","POST","OPTIONS"], '/inboundexcessedit[/{sscc:.*}]', InboundExcessController::class . ':edit')->add(PermissionMiddleware::class)->setName('inboundexcessedit-inbound_excess-edit'); // edit
    $app->map(["GET","POST","OPTIONS"], '/inboundexcessdelete[/{sscc:.*}]', InboundExcessController::class . ':delete')->add(PermissionMiddleware::class)->setName('inboundexcessdelete-inbound_excess-delete'); // delete
    $app->group(
        '/inbound_excess',
        function (RouteCollectorProxy $group) {
            $group->map(["GET","POST","OPTIONS"], '/' . Config("LIST_ACTION") . '[/{sscc:.*}]', InboundExcessController::class . ':list')->add(PermissionMiddleware::class)->setName('inbound_excess/list-inbound_excess-list-2'); // list
            $group->map(["GET","POST","OPTIONS"], '/' . Config("ADD_ACTION") . '[/{sscc:.*}]', InboundExcessController::class . ':add')->add(PermissionMiddleware::class)->setName('inbound_excess/add-inbound_excess-add-2'); // add
            $group->map(["GET","POST","OPTIONS"], '/' . Config("EDIT_ACTION") . '[/{sscc:.*}]', InboundExcessController::class . ':edit')->add(PermissionMiddleware::class)->setName('inbound_excess/edit-inbound_excess-edit-2'); // edit
            $group->map(["GET","POST","OPTIONS"], '/' . Config("DELETE_ACTION") . '[/{sscc:.*}]', InboundExcessController::class . ':delete')->add(PermissionMiddleware::class)->setName('inbound_excess/delete-inbound_excess-delete-2'); // delete
        }
    );

    // error
    $app->map(["GET","POST","OPTIONS"], '/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // personal_data
    $app->map(["GET","POST","OPTIONS"], '/personaldata', OthersController::class . ':personaldata')->add(PermissionMiddleware::class)->setName('personaldata');

    // login
    $app->map(["GET","POST","OPTIONS"], '/login', OthersController::class . ':login')->add(PermissionMiddleware::class)->setName('login');

    // change_password
    $app->map(["GET","POST","OPTIONS"], '/changepassword', OthersController::class . ':changepassword')->add(PermissionMiddleware::class)->setName('changepassword');

    // userpriv
    $app->map(["GET","POST","OPTIONS"], '/userpriv', OthersController::class . ':userpriv')->add(PermissionMiddleware::class)->setName('userpriv');

    // logout
    $app->map(["GET","POST","OPTIONS"], '/logout', OthersController::class . ':logout')->add(PermissionMiddleware::class)->setName('logout');

    // barcode
    $app->map(["GET","OPTIONS"], '/barcode', OthersController::class . ':barcode')->add(PermissionMiddleware::class)->setName('barcode');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->get('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        if (Route_Action($app) === false) {
            return;
        }
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            $error = [
                "statusCode" => "404",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")),
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withStatus(302)->withHeader("Location", GetUrl("error")); // Redirect to error page
        }
    );
};
