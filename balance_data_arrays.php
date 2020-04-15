<?php
require_once "connect.php";

$connection = @new mysqli ($host, $db_user, $db_password, $db_name);
	if(!$connection){
		die("connection failed: ".mysqli_connect_errno());
	}
			$user_id=$_SESSION['id'];
			$connection->query("SET NAMES 'utf8'");
			
			//expenses
			$sql=("SELECT c.name, e.amount FROM expenses_category_assigned_to_users AS c INNER JOIN expenses AS e ON c.id = e.expense_category_assigned_to_user_id WHERE c.user_id='$user_id';");
				$result = $connection->query($sql);
				
				if (!$result) throw new Exception($connection->error);
					
				if($result = mysqli_query($connection, $sql)){	
					$expenses_table=array();
					$a=1;
					while ($row = mysqli_fetch_assoc($result)){
						foreach ($row as $value) {
							
							if($a % 2 == 0)
								{
									$name=$row['name'];
									$amount=(float)$row['amount'];

									if(isset($expenses_table[$name]))
									{
										$temp=(float)$expenses_table[$name];									
										$expenses_table[$name] =$temp+$amount;
									}
									else 
									{	
									$expenses_table[$name] =(float)$amount;
									}
								}
							$a++;					
						}
					}
				}
				
				//incomes
				$sql=("SELECT c.name, i.amount FROM incomes_category_assigned_to_users AS c INNER JOIN incomes AS i ON c.id = i.income_category_assigned_to_user_id WHERE c.user_id='$user_id';");
				$result = $connection->query($sql);
				
				if (!$result) throw new Exception($connection->error);
					
				if($result = mysqli_query($connection, $sql)){	
					$incomes_table=array();
					$a=1;
					while ($row = mysqli_fetch_assoc($result)){
						foreach ($row as $value) {
							
							if($a % 2 == 0)
								{
									$name=$row['name'];
									$amount=(float) $row['amount'];

									if(isset($incomes_table[$name]))
									{
										$temp=(float)$incomes_table[$name];									
										$incomes_table[$name] =$temp+$amount;
									}
									else 
									{	
									$incomes_table[$name] =(float)$amount;
									}
								}
							$a++;					
						}
					}
				}
				
				//print_r ($incomes_table);
				
						foreach ($expenses_table as $key => $value) {
				echo "['".$key."', ".$value."],";
				echo"</br>";
				}
				echo"</br>";
				echo"</br>";
				foreach ($incomes_table as $key => $value) {
				echo "['$key', $value],";
				echo"</br>";
				}
				echo"</br>";
		/*		
		foreach ($incomes_table as $key => $value)	{
		echo $key." ".gettype($key);
		echo"</br>";
		echo $value." ".gettype($value);
		echo"</br>";
		}
	*/
				