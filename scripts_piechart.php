<?php

if(!isset($_SESSION['value_period']))
	$_SESSION['value_period']=1;
	
if($_SESSION['value_period']==4) {
	if(isset($_SESSION['start_date2']))
	$start_date_final = $_SESSION['start_date2'];
	else $start_date_final = '2010-01-01';
	
	if(isset($_SESSION['end_date2']))
	$end_date_final = $_SESSION['end_date2'];
	else $end_date_final = '2020-01-01';
}		

else{
	if(isset($_SESSION['start_date']))
	$start_date_final = $_SESSION['start_date'];
if(isset($_SESSION['start_date']))
	$end_date_final = $_SESSION['end_date'];
}

			$sql=("SELECT name, SUM(amount) FROM (SELECT c.name, i.amount FROM incomes_category_assigned_to_users AS c INNER JOIN incomes AS i ON c.id = i.income_category_assigned_to_user_id WHERE c.user_id='$user_id' AND i.date_of_income >= '$start_date_final' AND i.date_of_income <= '$end_date_final') AS t GROUP BY name;");
				$result = $connection->query($sql);
				if (!$result) throw new Exception($connection->error);
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
	
		<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
	
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
		
          ['Kategoria', 'Kwota'],
		  <?php
				if($result = mysqli_query($connection, $sql)){	
					while ($row = mysqli_fetch_assoc($result))
					{
						echo "[' ".$row["name"]." ', ".$row["SUM(amount)"]."],";
						
					}
						
				}
				?>
]);

        var options = {
		title: 'przychody',
		backgroundColor: 'transparent',
  
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
		
        chart.draw(data, options);
      }
    </script>
	
<?php
			$sql=("SELECT name, SUM(amount) FROM (SELECT c.name, e.amount FROM expenses_category_assigned_to_users AS c INNER JOIN expenses AS e ON c.id = e.expense_category_assigned_to_user_id WHERE c.user_id='$user_id' AND e.date_of_expense >= '$start_date_final' AND e.date_of_expense <= '$end_date_final') AS t GROUP BY name;");
				$result = $connection->query($sql);
				if (!$result) throw new Exception($connection->error);
?>
	
	<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
	
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
		
          ['Kategoria', 'Kwota'],
		  
			<?php
				if($result = mysqli_query($connection, $sql)){	
					while ($row = mysqli_fetch_assoc($result))
					{
						echo "[' ".$row["name"]." ', ".$row["SUM(amount)"]."],";
						
					}
						
				}
				?>
			
]);

        var options = {
		title: 'wydatki',
		backgroundColor: 'transparent',
  
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
		
        chart.draw(data, options);
      }
    </script>