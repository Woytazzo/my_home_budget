<?php
session_start();
require_once "navbar.html";

if (!isset($_SESSION['logged_in']))
{
	header('Location: index.php');
	exit();
}

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
		$income_type=$_POST['income_type'];
		$comment=$_POST['comment'];

		if($all_OK==true)
		{
			$sql= "INSERT INTO incomes (user_id, income_category_assigned_to_user_id, amount, date_of_income, income_comment) VALUES ('$user_id', '$income_type', '$amount_of_money', '$date_of_transaction', '$comment') ";
			
			$result = $connection->query($sql);
			if (!$result) throw new Exception($connection->error);
			
			header('Location: added-transaction.php');
		}
	}
//=$_SESSION[''];

?>
<article>	
	<div class="container">	

		<!--<form action="income.php" method="post">-->

			<div class="main-title">
			
				DODAJ PRZYCHÓD
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
			
			
				<div class="box col-md-3 table-transactions amountDate">
					<fieldset class="field_set">
						<legend><b>KWOTA</b> 
						</legend>				
						<input type="number" min="0.00"  step="0.01" name="money" class="inputAmountDate" />
					
					</fieldset>
					
										
					<fieldset class="field_set">
						<legend><b>DATA</b></legend>
						<input type="date" name="date" class="inputAmountDate" value=<?php
						echo $today;
						?> />				
					</fieldset>
				</div>
					
				<div class="box col-md-5 category table-transactions column">
					<fieldset class="field_set">
						<legend class="name-of-area"><b>KATEGORIA</b></legend>
						<?php
							if($connection->connect_errno!=0)
								echo "Error: ".$connection->connect_errno;

							else{
								$sql=("SELECT name, id FROM incomes_category_assigned_to_users WHERE user_id='$user_id'");
								$result = $connection->query($sql);
								if (!$result) throw new Exception($connection->error);
				
								if($result = mysqli_query($connection, $sql)){	
									$a=1;
									//$names_of_categories = array();
			
									while ($row = mysqli_fetch_assoc($result)){
										foreach ($row as $value) { 
											if($a % 2 != 0)
												{
												echo '<div><label> <input type="radio" value="'.$row['id'].'" name="income_type" ';
												if($a==1){echo 'checked > '.$value.' </label></div> ';}
												else {echo'> '.$value.' </label></div> ';}
											}
											$a++;
										}
									}
								}
							}				
						?>
					</fieldset>
				</div>
			
				<div class="box col-md-3 comment table-transactions">
					<fieldset class="field_set ">
						<legend></legend>
						<label><br/>
						<textarea placeholder="Dodaj komentarz..." class=" textinput" name="comment" ></textarea>
						</label><br/>
					</fieldset>
				</div>
			</div>
			
			<div class="row col-12">
				<div class="submitBox">
					<input type="submit" name="submit" value="Dodaj">
					<a href="add-income.php"><input type="button" id="anuluj" value="Resetuj" >
				</div>
			</div>
		</form>
	</div>
</article>

<?php
require_once "footer.html";
?>