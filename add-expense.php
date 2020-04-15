<?php
session_start();
require_once "navbar.html";

require_once "connect.php";

//setting today's date
$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;

//connecting with the database
$connection = @new mysqli ($host, $db_user, $db_password, $db_name);
	if(!$connection){
		die("connection failed: ".mysqli_connect_errno());
	}
			$user_id=$_SESSION['id'];
			$connection->query("SET NAMES 'utf8'");
	
	if(isset($_POST['submit'])){
		
		//checking errors
$all_OK=true;

		$amount_of_money=$_POST['money'];
		$amount_of_money = str_replace(',','.', $amount_of_money);
		
		if($amount_of_money<0.01)
		{
			$all_OK=false;
			$_SESSION['e_money'] = "wpisz kwotę!";
		}
		
		$date_of_transaction=$_POST['date'];
		$expense_type=$_POST['expense_type'];
		$payment_method=$_POST['way-of-payment'];
		$comment=$_POST['comment'];

		if($all_OK==true)
		{
			$sql= "INSERT INTO expenses (user_id, expense_category_assigned_to_user_id, payment_method_assigned_to_user_id, amount, date_of_expense, expense_comment) VALUES ('$user_id', '$expense_type', '$payment_method', '$amount_of_money', '$date_of_transaction', '$comment') ";
			
			$result = $connection->query($sql);
			if (!$result) throw new Exception($connection->error);
			
			header('Location: added-transaction.php');
		}
	}
//=$_SESSION[''];


?>

<article>	
<div class="container">	

	<div class="main-title">
	
		DODAJ WYDATEK
		<?php
		
			if (isset($_SESSION['e_money']))
			{
				echo '<div class="error">'.$_SESSION['e_money'].'</div>';
				unset($_SESSION['e_money']);
			}
		
		?>
	
	</div>
<form method="post">	
	<div class="income-container col-md-12">
	
	<div class="box3 col-md-3 amountDate">
			<fieldset class="field_set">
								
									<legend><b>KWOTA</b></legend>
									
								<input type="number" min="0.00"  step="0.01" name="money" class="inputAmountDate" />
									
								
			</fieldset>
								
			<fieldset class="field_set">
								
									<legend><b>DATA</b></legend>
							
									<input type="date" name="date" class="inputAmountDate" value=<?php
						echo $today;
						?> />
								
			</fieldset>
			
			<fieldset class="field_set">
			
			<legend><b>SPOSÓB ZAPŁATY</b></legend>
								
									<select id="way-of-payment" name="way-of-payment">
									
									<?php
											
											if($connection->connect_errno!=0)
												echo "Error: ".$connection->connect_errno;

											else{
												$sql=("SELECT name FROM payment_methods_assigned_to_users WHERE user_id='$user_id'");
												$result = $connection->query($sql);
												if (!$result) throw new Exception($connection->error);
								
												if($result = mysqli_query($connection, $sql)){	
													$a=1;
													//$names_of_categories = array();
							
													while ($row = mysqli_fetch_assoc($result)){
														foreach ($row as $value) { 
															echo '<option value="'.$a.'">'.$value.'</option>' ;
															$a++;
														}
													}
												}
											}				
										?>
									</select>
			</fieldset>						
									
			</div>
			
			
			<div class="box2 col-md-5 category">
				<fieldset class="field_set">
								
									<legend class="name-of-area"><b>KATEGORIA</b></legend>
								
									<div class="column col-xs-6">
										<?php
											
											if($connection->connect_errno!=0)
												echo "Error: ".$connection->connect_errno;

											else{
												$sql=("SELECT name, id FROM expenses_category_assigned_to_users WHERE user_id='$user_id'");
												$result = $connection->query($sql);
												if (!$result) throw new Exception($connection->error);
								
												if($result = mysqli_query($connection, $sql)){	
													$a=1;
													$names_of_categories = array();
							
													while ($row = mysqli_fetch_assoc($result)){
														foreach ($row as $value) {
															if($a % 2 != 0){
																echo '<div><label> <input type="radio" value="'.$row['id'].'" name="expense_type"';
																if($a==1){echo 'checked > '.$value.' </label></div> ';}
																else {echo'> '.$value.' </label></div> ';}
																
															}
															$a++;
															if($a % 20 == 0) {echo ' </div> <div class="column col-xs-6">';
														}
														}
													}
												}
											}				
										?>
									</div>
									
					
									
								
				</fieldset>
			
			</div>
	
		<div class="box col-md-3 comment">
			
				<fieldset class="field_set ">
								
						<legend><b>KOMENTARZ</b></legend>
									
							<label><br/>
								<textarea placeholder="Dodaj komentarz..." class=" textinput" name="comment" ></textarea>
							</label><br/>
								
				</fieldset>
			
		</div>
	
	</div>
	
	<div class="row col-12">
			<div class="submitBox">
				<input type="submit"  name="submit" value="Dodaj">
				<a href="add-expense.php"><input type="button" id="anuluj" value="Resetuj" >
			</div>
	</div>
</form>	
</div>
</article>
<?php
require_once "footer.html";
?>