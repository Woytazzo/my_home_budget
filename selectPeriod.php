<?php  
session_start();
require_once "connect.php";
//$_SESSION['test2']=$_POST["chosenPeriod"];
$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;

$period = $_POST["chosenPeriod"];

//$period=3;
if($period == 1){
	
	$start=date("Y-m-01");
	$end=strtotime($start. ' +1 month - 1 day');

	$end = date("Y-m-d",$end);
	$_SESSION['value_period']=1;
	$_SESSION['start_date']=$start;
$_SESSION['end_date']=$end;
}

if($period == 2){
	
	$end=date("Y-m-01");
	$start=strtotime($end. ' - 1 month');
	$start = date("Y-m-d",$start);
	$end=strtotime($end. ' - 1 day');
	$end = date("Y-m-d",$end);
	$_SESSION['value_period']=2;
$_SESSION['start_date']=$start;
$_SESSION['end_date']=$end;
}

if($period == 3){
	$start=date('Y-01-01');
	$end=strtotime($start. ' + 1 year - 1 day');
	$end=date('Y-m-d', $end);
	$_SESSION['value_period']=3;
	$_SESSION['start_date']=$start;
$_SESSION['end_date']=$end;
}

if($period == 4){
	$_SESSION['value_period']=4;
}



echo $start;
echo "<br>";
echo $end;
echo "<br>";


						
						







 ?>