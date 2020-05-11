<?php  
session_start();
$user_id=$_SESSION['id'];

 if(isset($_POST["income_name"]))  
 {  

if($_SESSION['value_period']==4) {
		$start_date_final = $_SESSION['start_date2'];
		$end_date_final = $_SESSION['end_date2'];
		}		
		else{
			$start_date_final = $_SESSION['start_date'];
		$end_date_final = $_SESSION['end_date'];
		}
      $output = '';  
      $connect = mysqli_connect("localhost", "root", "", "mdb");  
	  $query = "SELECT i.amount, date_of_income, income_comment FROM incomes_category_assigned_to_users AS c INNER JOIN incomes AS i ON c.id = i.income_category_assigned_to_user_id WHERE c.user_id='$user_id' AND c.name='".$_POST["income_name"]."' AND i.date_of_income >= '$start_date_final' AND i.date_of_income <= '$end_date_final' ORDER BY date_of_income";
	 
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">
		   <tr>  
                     <th width="30%"><label>Date</label></th>  
					 <th width="30%"><label>Amount</label></th>  
                     
                     <th width="40%"><label>Comment</label></th>  
                </tr>
		   ';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td width="30%">'.$row["date_of_income"].'</td>  
					 <td width="30%">'.$row["amount"].'</td>  
                     
                     <td width="40%">'.$row["income_comment"].'</td>  
                </tr>  
                ';  
      }  
      $output .= "</table></div>";  
      echo $output;  
 } 
 ?>