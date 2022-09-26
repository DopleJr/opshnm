<?php

namespace PHPMaker2022\opsmezzanineupload;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;
use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Filter for 'Last Month' (example)
function GetLastMonthFilter($FldExpression, $dbid = 0)
{
    $today = getdate();
    $lastmonth = mktime(0, 0, 0, $today['mon'] - 1, 1, $today['year']);
    $val = date("Y|m", $lastmonth);
    $wrk = $FldExpression . " BETWEEN " .
        QuotedValue(DateValue("month", $val, 1, $dbid), DATATYPE_DATE, $dbid) .
        " AND " .
        QuotedValue(DateValue("month", $val, 2, $dbid), DATATYPE_DATE, $dbid);
    return $wrk;
}

// Filter for 'Starts With A' (example)
function GetStartsWithAFilter($FldExpression, $dbid = 0)
{
    return $FldExpression . Like("'A%'", $dbid);
}

// Global user functions

// Database Connecting event
function Database_Connecting(&$info)
{
    // Example:
    //var_dump($info);
    //if ($info["id"] == "DB" && IsLocal()) { // Testing on local PC
    //    $info["host"] = "locahost";
    //    $info["user"] = "root";
    //    $info["pass"] = "";
    //}
}

// Database Connected event
function Database_Connected(&$conn)
{
    // Example:
    //if ($conn->info["id"] == "DB") {
    //    $conn->executeQuery("Your SQL");
    //}
}

function MenuItem_Adding($item)
{
    //var_dump($item);
    // Return false if menu item not allowed
    return true;
}

function Menu_Rendering($menu)
{
    // Change menu items here
}

function Menu_Rendered($menu)
{
    // Clean up here
}

// Page Loading event
function Page_Loading()
{
    //Log("Page Loading");
}

// Page Rendering event
function Page_Rendering()
{
    //Log("Page Rendering");
}

// Page Unloaded event
function Page_Unloaded()
{
    //Log("Page Unloaded");
}

// AuditTrail Inserting event
function AuditTrail_Inserting(&$rsnew)
{
    //var_dump($rsnew);
    return true;
}

// Personal Data Downloading event
function PersonalData_Downloading(&$row)
{
    //Log("PersonalData Downloading");
}

// Personal Data Deleted event
function PersonalData_Deleted($row)
{
    //Log("PersonalData Deleted");
}

// Route Action event
function Route_Action($app)
{
    // Example:
    // $app->get('/myaction', function ($request, $response, $args) {
    //    return $response->withJson(["name" => "myaction"]); // Note: Always return Psr\Http\Message\ResponseInterface object
    // });
    // $app->get('/myaction2', function ($request, $response, $args) {
    //    return $response->withJson(["name" => "myaction2"]); // Note: Always return Psr\Http\Message\ResponseInterface object
    // });
}

// API Action event
function Api_Action($app)
{
    // Example:
    // $app->get('/myaction', function ($request, $response, $args) {
    //    return $response->withJson(["name" => "myaction"]); // Note: Always return Psr\Http\Message\ResponseInterface object
    // });
    // $app->get('/myaction2', function ($request, $response, $args) {
    //    return $response->withJson(["name" => "myaction2"]); // Note: Always return Psr\Http\Message\ResponseInterface object
    // });
}

// Container Build event
function Container_Build($builder)
{
    // Example:
    // $builder->addDefinitions([
    //    "myservice" => function (ContainerInterface $c) {
    //        // your code to provide the service, e.g.
    //        return new MyService();
    //    },
    //    "myservice2" => function (ContainerInterface $c) {
    //        // your code to provide the service, e.g.
    //        return new MyService2();
    //    }
    // ]);
}

function generateId() {
	$textid = "NCG";
	$separat= "-";
	$separat2 = "/";
    $currentDate = date('dmY');
    //$_store = substr($_SESSION['destination_code'], -2);
    //$_truck = $_SESSION["truck_seq"];
    $gabung = $textid . $separat . $currentDate . $separat ;
    return $gabung;
}

function generateLabel() {
$labelid1 = "A";
$labelid2 = "B";
$labelid3 = "C";
$labelid4 = "D";
$labelid5 = "E";
$labelid6 = "F";
$labelid7 = "G";
$labelid8 = "H";
$labelid9 = "I";
$labelid10 = "J";
$labelid11 = "K";
$labelid12 = "L";
$labelid13 = "M";
$labelid14 = "N";
$labelid15 = "O";
$labelid16 = "P";
$labelid17 = "Q";
$labelid18 = "R";
$labelid19 = "S";
$labelid20 = "T";
$labelid21 = "U";
$labelid22 = "V";
$labelid23 = "W";
$labelid24 = "X";
$labelid25 = "Y";
$labelid26 = "Z";
	$_sequence ="000000";
	$_boxid = 	ExecuteScalar("SELECT count(*) FROM print_label ");
    	IF (strlen($_boxid)== 1){ // Label A 1 digit
    		$mix = substr($_sequence,1) . $_boxid++ . $labelid1;
    		return $mix;
    	}
    	IF (strlen($_boxid)== 2){ 
    		$mix = substr($_sequence,2) . $_boxid++ . $labelid1;
    		return $mix;
    	}
    	IF (strlen($_boxid)== 3){ 
    		$mix = substr($_sequence,3) . $_boxid++ . $labelid1;
    		return $mix;
    	}
    	IF (strlen($_boxid)== 4){ 
    		$mix = substr($_sequence,4) . $_boxid++ . $labelid1;
    		return $mix;
    	}
    	IF (strlen($_boxid)== 5){ 
    		$mix = substr($_sequence,5) . $_boxid++ . $labelid1;
    		return $mix;
    	}
    	IF (strlen($_boxid)== 6){ 
    		$mix = substr($_sequence,6) . $_boxid++ . $labelid1;
    		return $mix;
    	}
}

function GetLastestLocation()
{
	$_usercycle = CurrentUserName();
return ExecuteScalar("SELECT location FROM cycle_count WHERE `user` = ('$_usercycle') ORDER BY `id` desc LIMIT 1");
}

function GetLastestSU()
{
	$_usercycle = CurrentUserName();
return ExecuteScalar("SELECT su FROM cycle_count WHERE `user` = ('$_usercycle') ORDER BY `id` desc LIMIT 1");
}

function GetTotalRecord()
{
	$currentLoc = GetLastestLocation();
	$_usercycle = CurrentUserName();
return ExecuteScalar("SELECT COUNT(`article`) FROM cycle_count WHERE `location` = ('$currentLoc') AND `user` = ('$_usercycle') AND `article` is not null ORDER BY `id` desc LIMIT 1");
}

function GetLastestLocationXtra()
{
	$_usercycle = CurrentUserName();
return ExecuteScalar("SELECT location FROM blank_count_sheet WHERE `user` = ('$_usercycle') ORDER BY `id` desc LIMIT 1");
}

function GetLastestCtn()
{
	$_usercycle = CurrentUserName();
return ExecuteScalar("SELECT ctn FROM blank_count_sheet WHERE `user` = ('$_usercycle') ORDER BY `id` desc LIMIT 1");
}

function GetArea()
{
	$_location = $rsnew["location"];
	return ExecuteScalar("SELECT area FROM locations WHERE `location` = '$_location' ORDER BY `id` ");
}

function GetAisle()
{
	return ExecuteScalar("SELECT aisle2 FROM `picking` WHERE `status` = 'Pending' ORDER BY `id` ");
}

function GetSkip()
{
	$like = "%";
    $_id = $this->id->CurrentValue;
    $_short = $like. $this->short_article->CurrentValue . $like;
    $_total = $this->total_shortpick->CurrentValue;
    $_status = "Skip";
    $_confirm = CurrentDateTime();

return ExecuteStatement("UPDATE finding_shortpick SET `pick_quantity` = '0',`actual` = '0',`excess` = '0', `status` = '$_status2', `date_picking` = '$_confirm' WHERE id = '$_id' ");
}

function LastStore()
{
	$_picker = CurrentUserName();
	return ExecuteScalar("SELECT `store_code` FROM picking WHERE `store_code` = '$_storecode' AND `picker` = '$_picker' ORDER BY `confirmation_date`, `confirmation_time` DESC ");
}

function GetBoxCode()
{
	$_storecode = $this->store_code->ViewValue;
	$_picker = CurrentUserName();
	return ExecuteScalar("SELECT `box_code` FROM picking WHERE `store_code` = '$_storecode' AND `picker` = '$_picker' ORDER BY `confirmation_date`, `confirmation_time` DESC ");
}

function GetBoxType()
{
	$_storecode = $this->store_code->ViewValue;
	$_picker = CurrentUserName();
	return ExecuteScalar("SELECT `box_type` FROM picking WHERE `store_code` = '$_storecode' AND `picker` = '$_picker' ORDER BY `confirmation_date`, `confirmation_time` DESC ");
}

function GetShipment()
{
	$_checker = CurrentUserName();
	return ExecuteScalar("SELECT `shipment` FROM oss_manual WHERE `checker` = ('$_checker')  ORDER BY `date_updated` desc,`time_updated` desc LIMIT 1 ");
}

function GetPallet()
{
	$_checker = CurrentUserName();
return ExecuteScalar("SELECT `pallet_no` FROM oss_manual WHERE `checker` = ('$_checker')  ORDER BY `date_updated` desc,`time_updated` desc LIMIT 1 ");
}

function GetShift()
{
	$_checker = CurrentUserName();
return ExecuteScalar("SELECT `shift` FROM oss_manual WHERE `checker` = ('$_checker')  ORDER BY `date_updated` desc,`time_updated` desc LIMIT 1 ");
}

function GetOrder()
{
	$_checker = CurrentUserName();
return ExecuteScalar("SELECT `order_no` FROM oss_manual WHERE `checker` = ('$_checker')  ORDER BY `date_updated` desc,`time_updated` desc LIMIT 1 ");
}

function GetIdw()
{
	$_checker = CurrentUserName();
return ExecuteScalar("SELECT `idw` FROM oss_manual WHERE `checker` = ('$_checker')  ORDER BY `date_updated` desc,`time_updated` desc LIMIT 1 ");
}

//audit picking online
function LastBoxCode()
{
	$_checker = CurrentUserName();
	return ExecuteScalar("SELECT `box_code` FROM audit_picking_online WHERE `checker` = '$_checker' ORDER BY `date_update` DESC, `time_update` DESC ");
}

function LastStoreID()
{
	$_checker = CurrentUserName();
	return ExecuteScalar("SELECT `store_id` FROM audit_picking_online WHERE `checker` = '$_checker' ORDER BY `date_update` DESC, `time_update` DESC ");
}

function LastStoreName()
{
	$_checker = CurrentUserName();
	return ExecuteScalar("SELECT `store_name` FROM audit_picking_online WHERE `checker` = '$_checker' ORDER BY `date_update` DESC, `time_update` DESC ");
}

function StoreName()
{
	return ExecuteScalar("SELECT `store_name` FROM `print_label` ORDER BY `id` DESC");
}

function Priority()
{
	return ExecuteScalar("SELECT `priority` FROM `print_label` ORDER BY `id` DESC");
}

function StoreCode()
{
	return ExecuteScalar("SELECT `store_code` FROM `print_label` ORDER BY `id` DESC");
}

function barcode_label()
{
	return ExecuteScalar("SELECT `barcode` FROM `print_label` ORDER BY `id` DESC");
}
