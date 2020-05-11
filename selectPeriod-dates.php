<?php  
session_start();
require_once "connect.php";

if(isset($_POST['chosenStart']))
$_SESSION['start_date2']=$_POST['chosenStart'];

if(isset($_POST['chosenEnd']))
$_SESSION['end_date2']=$_POST['chosenEnd'];

?>