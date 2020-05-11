<?php  
session_start();
$user_id=$_SESSION['id'];
 //if(isset($_POST["expense_name"]))  
 //{  

if($_SESSION['value_period']==4) {
		$start_date_final = $_SESSION['start_date2'];
		$end_date_final = $_SESSION['end_date2'];
		}		
		else{
			$start_date_final = $_SESSION['start_date'];
		$end_date_final = $_SESSION['end_date'];
		}
      $output = ' ';  
      $connect = mysqli_connect("localhost", "root", "", "mdb");  
	  $query = "SELECT c.name, amount, date_of_expense, expense_comment FROM expenses_category_assigned_to_users AS c INNER JOIN expenses AS e ON c.id = e.expense_category_assigned_to_user_id WHERE c.user_id='$user_id' AND e.date_of_expense >= '$start_date_final' AND e.date_of_expense <= '$end_date_final' ORDER BY date_of_expense;";
	 
      $result = mysqli_query($connect, $query);  
      $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">
		   <tr>  
					<th width="25%"><label>Category</label></th>  
                     <th width="25%"><label>Date</label></th>  
					 <th width="20%"><label>Amount</label></th>  
                     
                     <th width="30%"><label>Comment</label></th>  
                </tr>
		   ';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
					<td width="25%">'.$row["name"].'</td>  
                     <td width="25%">'.$row["date_of_expense"].'</td>  
					 <td width="20%">'.$row["amount"].'</td>  
                     
                     <td width="30%">'.$row["expense_comment"].'</td>  
                </tr>  
                ';  
      }  
      $output .= "</table></div>";  
      echo $output;  
 //} 
 ?>