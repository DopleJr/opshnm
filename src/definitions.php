<?php

namespace PHPMaker2022\opsmezzanineupload;

use Slim\Views\PhpRenderer;
use Slim\Csrf\Guard;
use Psr\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Doctrine\DBAL\Logging\LoggerChain;
use Doctrine\DBAL\Logging\DebugStack;

return [
    "cache" => function (ContainerInterface $c) {
        return new \Slim\HttpCache\CacheProvider();
    },
    "view" => function (ContainerInterface $c) {
        return new PhpRenderer("views/");
    },
    "flash" => function (ContainerInterface $c) {
        return new \Slim\Flash\Messages();
    },
    "audit" => function (ContainerInterface $c) {
        $logger = new Logger("audit"); // For audit trail
        $logger->pushHandler(new AuditTrailHandler("audit.log"));
        return $logger;
    },
    "log" => function (ContainerInterface $c) {
        global $RELATIVE_PATH;
        $logger = new Logger("log");
        $logger->pushHandler(new RotatingFileHandler($RELATIVE_PATH . "log.log"));
        return $logger;
    },
    "sqllogger" => function (ContainerInterface $c) {
        $loggers = [];
        if (Config("DEBUG")) {
            $loggers[] = $c->get("debugstack");
        }
        $loggers[] = $c->get("debugsqllogger");
        return (count($loggers) > 0) ? new LoggerChain($loggers) : null;
    },
    "csrf" => function (ContainerInterface $c) {
        global $ResponseFactory;
        return new Guard($ResponseFactory, Config("CSRF_PREFIX"));
    },
    "debugstack" => \DI\create(DebugStack::class),
    "debugsqllogger" => \DI\create(DebugSqlLogger::class),
    "security" => \DI\create(AdvancedSecurity::class),
    "profile" => \DI\create(UserProfile::class),
    "language" => \DI\create(Language::class),
    "timer" => \DI\create(Timer::class),
    "session" => \DI\create(HttpSession::class),

    // Tables
    "auditstaging" => \DI\create(Auditstaging::class),
    "audittrail" => \DI\create(Audittrail::class),
    "cycle_count" => \DI\create(CycleCount::class),
    "monitor_cycle_count" => \DI\create(MonitorCycleCount::class),
    "report_outbound" => \DI\create(ReportOutbound::class),
    "staging" => \DI\create(Staging::class),
    "transferbin" => \DI\create(Transferbin::class),
    "user" => \DI\create(User::class),
    "bintobin" => \DI\create(Bintobin::class),
    "print_label" => \DI\create(PrintLabel::class),
    "store" => \DI\create(Store::class),
    "box_picking" => \DI\create(BoxPicking::class),
    "audit_picking" => \DI\create(AuditPicking::class),
    "disposition_location" => \DI\create(DispositionLocation::class),
    "monitor_kpi" => \DI\create(MonitorKpi::class),
    "monitor_audit_picking" => \DI\create(MonitorAuditPicking::class),
    "empty_box" => \DI\create(EmptyBox::class),
    "master_article" => \DI\create(MasterArticle::class),
    "Dashboard2" => \DI\create(Dashboard2::class),
    "cycle_count_offline" => \DI\create(CycleCountOffline::class),
    "monitor_cycle_count_offline" => \DI\create(MonitorCycleCountOffline::class),
    "extra_stock" => \DI\create(ExtraStock::class),
    "blank_count_sheet" => \DI\create(BlankCountSheet::class),
    "monitor_staging_on_staging" => \DI\create(MonitorStagingOnStaging::class),
    "monitor_staging_delivered" => \DI\create(MonitorStagingDelivered::class),
    "OnStaging" => \DI\create(OnStaging::class),
    "Outbound" => \DI\create(Outbound::class),
    "locations" => \DI\create(Locations::class),
    "mb51" => \DI\create(Mb51::class),
    "master_article2" => \DI\create(MasterArticle2::class),
    "finding_shortpick2" => \DI\create(FindingShortpick2::class),
    "transfer_bin_piece" => \DI\create(TransferBinPiece::class),
    "bin_to_bin_piece" => \DI\create(BinToBinPiece::class),
    "job_control" => \DI\create(JobControl::class),
    "shortpick_by_area" => \DI\create(ShortpickByArea::class),
    "findingshortpick" => \DI\create(Findingshortpick::class),
    "picking" => \DI\create(Picking::class),
    "job_control_copy1" => \DI\create(JobControlCopy1::class),
    "picking_pending" => \DI\create(PickingPending::class),
    "report_totes" => \DI\create(ReportTotes::class),
    "box_result" => \DI\create(BoxResult::class),
    "oss_manual" => \DI\create(OssManual::class),
    "productivity_online" => \DI\create(ProductivityOnline::class),
    "check_box" => \DI\create(CheckBox::class),
    "audit_picking_online" => \DI\create(AuditPickingOnline::class),
    "userlevelpermissions" => \DI\create(Userlevelpermissions::class),
    "userlevels" => \DI\create(Userlevels::class),
    "stock_count" => \DI\create(StockCount::class),
    "summary_stock_count" => \DI\create(SummaryStockCount::class),

    // User table
    "usertable" => \DI\get("user"),
];
