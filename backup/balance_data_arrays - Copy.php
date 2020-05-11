<?php
require_once "connect.php";

$connection = @new mysqli ($host, $db_user, $db_password, $db_name);
	if(!$connection){
		die("connection failed: ".mysqli_connect_errno());
	}
			$user_id=$_SESSION['id'];
			$connection->query("SET NAMES 'utf8'");
			
			//expenses
			$sql=("SELECT expense_category_assigned_to_user_id, amount FROM expenses WHERE user_id='$user_id';");
				$result = $connection->query($sql);
				
				if (!$result) throw new Exception($connection->error);
					
				if($result = mysqli_query($connection, $sql)){	
					$expenses_table=array();
					$a=1;
					while ($row = mysqli_fetch_assoc($result)){
						foreach ($row as $value) {
							
							if($a % 2 == 0)
								{
									$number=$row['expense_category_assigned_to_user_id'];
									$amount=$row['amount'];

									if(isset($expenses_table[$number]))
									{
										$temp=$expenses_table[$number];									
										$expenses_table[$number] =$temp+$amount;
									}
									else 
									{	
									$expenses_table[$number] =$amount;
									}
								}
							$a++;					
						}
					}
				}
				
				//incomes
				$sql=("SELECT income_category_assigned_to_user_id, amount FROM incomes WHERE user_id='$user_id';");
				$result = $connection->query($sql);
				
				if (!$result) throw new Exception($connection->error);
					
				if($result = mysqli_query($connection, $sql)){	
					$incomes_table=array();
					$a=1;
					while ($row = mysqli_fetch_assoc($result)){
						foreach ($row as $value) {
							
							if($a % 2 == 0)
								{
									$number=$row['income_category_assigned_to_user_id'];
									$amount=$row['amount'];

									if(isset($incomes_table[$number]))
									{
										$temp=$incomes_table[$number];									
										$incomes_table[$number] =$temp+$amount;
									}
									else 
									{	
									$incomes_table[$number] =$amount;
									}
								}
							$a++;					
						}
					}
				}
				
         	  echo"</br>";
			foreach ($incomes_table as $key => $value) {
				echo "['$key', $value],";
				echo"</br>";
				}
				echo"</br>";