<?php
session_start();
require_once "connect.php";
//require_once "balance_data_arrays.php";
$connection = @new mysqli ($host, $db_user, $db_password, $db_name);
	if(!$connection){
		die("connection failed: ".mysqli_connect_errno());
	}
if (!isset($_SESSION['logged_in']))
{
	header('Location: index.php');
	exit();
}
	
$user_id=$_SESSION['id'];
$connection->query("SET NAMES 'utf8'");

$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;
if(!isset($_SESSION['value_period']) || $_SESSION['value_period']==1){
	$_SESSION['start_date']=date("Y-m-01");
	$_SESSION['end_date']=strtotime($_SESSION['start_date']. ' +1 month');
	$_SESSION['end_date'] = date("Y-m-d",$_SESSION['end_date']);
	$_SESSION['value_period']=1;
	$start_date_final = $_SESSION['start_date'];
		$end_date_final = $_SESSION['end_date'];
}

if (($_SESSION['value_period']==4) && (!isset($_SESSION['start_date2'])) && (!isset($_SESSION['end_date2']))){
	$_SESSION['start_date2']=$today;
	$_SESSION['end_date2']=$today;
}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <title>Mój Domowy Budżet</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  

  
	<link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="css/fixed.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>   
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  

  
	
  <?php
  require_once "scripts_piechart.php";
  ?>
  
  <script>

$(function() {
    if (localStorage.getItem('chooseBalancePeriod')) {
        $("#chooseBalancePeriod option").eq(localStorage.getItem('chooseBalancePeriod')).prop('selected', true);
    }

    $("#chooseBalancePeriod").on('change', function() {
        localStorage.setItem('chooseBalancePeriod', $('option:selected', this).index());
    });
});
	

</script>

<script>
function choosingPeriod() {
	var chosenPeriod = document.getElementById("chooseBalancePeriod").value;
	
	$.ajax({
					url:"selectPeriod.php",
					method:"post",
					data:{chosenPeriod:chosenPeriod},
	});

	location.reload();
};
</script>

<script>
function choosingStart(){
	var chosenStart = document.getElementById("StartDate").value;
	
	$.ajax({
					url:"selectPeriod-dates.php",
					method:"post",
					data:{chosenStart:chosenStart},
	});
	//document.write(chosenStart);
	location.reload();
};
</script>

<script>
function choosingEnd(){
	var chosenEnd = document.getElementById("EndDate").value;
	
	$.ajax({
					url:"selectPeriod-dates.php",
					method:"post",
					data:{chosenEnd:chosenEnd},
	});

	location.reload();
};
</script>

<script>  
 $(document).ready(function(){  
      $('.view_expenses').click(function(){  
				var expense_name = $(this).attr("id");
			 $('#dataModal2').find('#Category2').html($('<b> Chosen category: ' + expense_name  + '</b>' + '<button type="button" class="close" data-dismiss="modal">&times;</button> '));
			 
				$.ajax({
					url:"select2.php",
					method:"post",
					data:{expense_name:expense_name},
					success:function(data){
						$('#expenses_detail').html(data);
						$('#dataModal2').modal("show");  
					}
				});
		});
});  

 </script> 			
 
 <script>  
 $(document).ready(function(){  
      $('.view_incomes').click(function(){  
				var income_name = $(this).attr("id");
			 $('#dataModal').find('#Category').html($('<b> Chosen category: ' + income_name  + '</b>' + '<button type="button" class="close" data-dismiss="modal">&times;</button> '));
			 
				$.ajax({
					url:"select.php",
					method:"post",
					data:{income_name:income_name},
					success:function(data){
						$('#incomes_detail').html(data);
						$('#dataModal').modal("show");  
					}
				});
		});
});  

 </script> 	

<script>  
 $(document).ready(function(){  
      $('.view_allIncomes').click(function(){  
				//var expense_name = $(this).attr("id");
			 $('#dataModal3').find('#allIncomes').html($('<b> Wszystkie przychody </b>' + '<button type="button" class="close" data-dismiss="modal">&times;</button> '));
				
				
				$.ajax({
					url:"select3.php",
					//method:"post",
					//data:{expense_name:expense_name},
					success:function(data){
						$('#allincomes_detail').html(data);
						$('#dataModal3').modal("show");  
					}
				});
		});
});  
 </script> 			 

<script>  
 $(document).ready(function(){  
      $('.view_allExpenses').click(function(){  
				//var expense_name = $(this).attr("id");
			 $('#dataModal4').find('#allExpenses').html($('<b> Wszystkie wydatki </b>' + '<button type="button" class="close" data-dismiss="modal">&times;</button> '));
				
				
				$.ajax({
					url:"select4.php",
					//method:"post",
					//data:{expense_name:expense_name},
					success:function(data){
						$('#allexpenses_detail').html(data);
						$('#dataModal4').modal("show");  
					}
				});
		});
});  
 </script> 			
	
 <script>
 
 function sendPeriod()
 {
	 var chosenPeriod = $('#chooseBalancePeriod option:selected').attr("value").val();
	 
	 $post('selectPeriod.php', {chosenPeriod:chosenPeriod},function(data)
		 {
			 $('#result').html(data);
		 });
 }
 
 </script>

  
</head>
<body>

	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		<a class="navbar-brand" href="menu.php">MDB</a>
		
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
			<span class="navbar-toggler-icon"></span>
		</button>
		
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="add-income.php">Dodaj przychód</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="add-expense.php">Dodaj wydatek</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="check-balance.php">Przeglądaj bilans</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="settings.php">Ustawienia</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="logout.php">Wyloguj</a>
				</li>
				
			</ul>
			</div>
	</nav>
