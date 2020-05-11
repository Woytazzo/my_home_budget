<?php

	session_start();
	
	if (isset($_POST['email']))
	{
		//udana walidacja? załóżmy że tak
		$all_OK=true;
		
		//poprawny imie
		$username = $_POST['username'];
		//sprawdzenie dlugosci username
		if (strlen($username)<3 || (strlen($username)>20))
		{
			$all_OK=false;
			$_SESSION['e_username'] = "imię musi posiadać 3-20 znaków";
		}
		
		//tylko znaki alfanumeryczne bez polskich ogonkow
		
		if (ctype_alpha($username)==false)
		{
			$all_OK=false;
			$_SESSION['e_username']="imię może składać się tylko z liter (bez polskich znaków)";
		}
		
		// check poprawnosc adresu email
		$email = $_POST['email'];
		//sanityzacja kodu (emaila) czyli oczyszczenie go - funkcja filter_var() ze znakow niedozwolonych
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		//walidacja poprawnosci adresu pod katem jego budowy;
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$all_OK=false;
			$_SESSION['e_email']="Wpisany e-mail jest niepoprawny";
		}
		
		//poprawne password
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		
		//sprawdzenie dlugosci hasla
		if (strlen($password1)<8 || (strlen($password1)>20))
		{
			$all_OK=false;
			$_SESSION['e_password'] = "hasło musi posiadać 8-20 znaków";
		}
		
		//checkenie dwukrotnego wpisania tego samego hasła
		if ($password1!=$password2)
		{
			$all_OK=false;
			$_SESSION['e_password'] = "wpisane hasła różnią się od siebie";
		}
		//hashowanie hasła - password default wybiera najlepszy algorytm
		$password_hash = password_hash($password1, PASSWORD_DEFAULT);
		
		//CAPTCHA - tu używamy SECRET KEY
		$secret = "6LcLCOEUAAAAAHsrXwSGIkchBe8DomeiYjR0VqKC";
		//pobierz zawartosc pliku do zmiennej
		$check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
		//dekodowanie informacji zapisanych przez kodowanie json
		$answer = json_decode($check);
		
		if ($answer->success==false)
		{
			$all_OK=false;
			$_SESSION['e_bot'] = "potwierdź, że nie jesteś botem";
		}
		//zapamietaj wprowadzone dane w formularzu - tuz przed connection z baza
		$_SESSION['fr_username'] = $username;
		$_SESSION['fr_email'] = $email;
		$_SESSION['fr_password1'] = $password1;
		$_SESSION['fr_password2'] = $password2;
		if (isset($_POST['regulations'])) $_SESSION['fr_regulations']=true;
		
		//brakuje checkenia czy podany email i login juz nie znajduja sie w bazie
		//musimy połączyć się z bazą danych -> SELECT
		
		require_once "connect.php";
		
		//sposob raportowania błędów - zamiast ostrzezen wrzucamy wyjątki - o to właśnie chodzi w try catch
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		//nawiazanie polaczenia z baza przez blok try catch i obsługa błędów
		try
		{
			$connection = new mysqli ($host, $db_user, $db_password, $db_name);
			if($connection->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				//czy email już istnieje
				$result = $connection->query("SELECT id FROM users WHERE email = '$email'");
				
				if (!$result) throw new Exception($connection->error);
				
				$how_many_mails = $result->num_rows;
				
				if($how_many_mails>0)
				{
					$all_OK=false;
					$_SESSION['e_email'] = "Istnieje już konto przypisane do tego adresu e-mail";
				}

					if($all_OK==true)
					{
						//testy zaliczone, dodajemy konto
						if ($connection->query("INSERT INTO users VALUES (NULL, '$username', '$password_hash', '$email')"))
						{
							
							//dodanie wartości  z default  do tabel ogolnych
							$result->free_result();
							
							$sql=("SELECT id FROM users WHERE email = '$email'");
							
							if($result = mysqli_query($connection, $sql)){
							$row = mysqli_fetch_assoc($result);
							$user_id = (int) $row['id'];
							//mamy interesujące nas id, lecimy z koxem!!
							
							}
							else
							$_SESSION['e_sql']="problem z bazą danych, spróbuj później - przepraszamy";
							
							//dodajemy incomes
							for($x=1; $x<=4; $x++) 
							{
								
								$sql=("SELECT name FROM incomes_category_default WHERE id='$x'");
								if($result = mysqli_query($connection, $sql))
								{	$row = mysqli_fetch_assoc($result);
									$name=$row['name'];
									
									$sql2=("INSERT INTO incomes_category_assigned_to_users (id, user_id, name) 
									VALUES (NULL, '$user_id','$name' )");
									if(!mysqli_query($connection, $sql2))	
									$_SESSION['e_sql']="problem z bazą danych, spróbuj później - przepraszamy";
								
								}	
								else $_SESSION['e_sql']="problem z bazą danych, spróbuj później - przepraszamy";
							}
							$result->free_result();
							
							//dodajemy expenses
							for($x=1; $x<=16; $x++) 
							{
								
								$sql=("SELECT name FROM expenses_category_default WHERE id='$x'");
								if($result = mysqli_query($connection, $sql))
								{	$row = mysqli_fetch_assoc($result);
									$name=$row['name'];
									
									$sql2=("INSERT INTO expenses_category_assigned_to_users (id, user_id, name) 
									VALUES (NULL, '$user_id','$name' )");
									if(!mysqli_query($connection, $sql2))	
									$_SESSION['e_sql']="problem z bazą danych, spróbuj później - przepraszamy";
								
								}	
								else $_SESSION['e_sql']="problem z bazą danych, spróbuj później - przepraszamy";
							}
					
							$result->free_result();
							
								//dodajemy payment
							for($x=1; $x<=3; $x++) 
							{
								
								$sql=("SELECT name FROM payment_methods_default WHERE id='$x'");
								if($result = mysqli_query($connection, $sql))
								{	$row = mysqli_fetch_assoc($result);
									$name=$row['name'];
									
									$sql2=("INSERT INTO payment_methods_assigned_to_users (id, user_id, name) 
									VALUES (NULL, '$user_id','$name' )");
									if(!mysqli_query($connection, $sql2))	
									$_SESSION['e_sql']="problem z bazą danych, spróbuj później - przepraszamy";
								
								}	
								else $_SESSION['e_sql']="problem z bazą danych, spróbuj później - przepraszamy";
							}
					
							$result->free_result();
							
							//TRUNCATE incomes_category_assigned_to_users;
							//TRUNCATE users;
							//TRUNCATE expenses_category_assigned_to_users;
							//TRUNCATE payment_methods_assigned_to_users;
							
						
							$_SESSION['registrationcompleted']=true;
							header('Location: welcome.php');
						}
						else
						{
							throw new Exception($connection->error);
						}
					}

				$connection->close();
			}
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie.</span>';
			echo '<br /> Informacja developerska: '.$e;
		}
	}

?>

<!DOCTYPE HTML >
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Mój domowy budżet - załóż konto</title>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<!-- użyjemy roboczo taku STYLE, zwykle załatwimy to w CSS'ie -->
	<style>
	.error
	{
		color:red;
		margin-top: 10px;
		margin-bottom: 10px;
	}
	
	</style>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	<link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
			<h1 class="title">twój domowy budżet</h1>
            <h5 class="card-title text-center">Rejestracja</h5>
            <form class="form-signin" method="post">
			
			 <div class="form-label-group">
			  
                <input type="text" id="inputName" class="form-control" placeholder="imię" value="<?php
		if (isset($_SESSION['fr_username']))
		{
			echo $_SESSION['fr_username'];
			unset($_SESSION['fr_username']);
		}
		?>" name="username" required autofocus>
                <label for="inputName">imię</label>
				</div>
				
				<?php
		
			if (isset($_SESSION['e_username']))
			{
				echo '<div class="error">'.$_SESSION['e_username'].'</div>';
				unset($_SESSION['e_username']);
			}
		
		?>
				
					
		
				<div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="adres email" value="<?php
		if (isset($_SESSION['fr_email']))
		{
			echo $_SESSION['fr_email'];
			unset($_SESSION['fr_email']);
		}
		?>" name="email" required>
		
                <label for="inputEmail">adres email</label>
				</div>
			  
				
		
		<?php
		
			if (isset($_SESSION['e_email']))
			{
				echo '<div class="error">'.$_SESSION['e_email'].'</div>';
				unset($_SESSION['e_email']);
			}
		
		?>
		
		
		<div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" placeholder="hasło" value="<?php
		if (isset($_SESSION['fr_password1']))
		{
			echo $_SESSION['fr_password1'];
			unset($_SESSION['fr_password1']);
		}
		?>" name="password1" required>
                <label for="inputPassword">hasło</label>
              </div>
			  
		<?php
		
			if (isset($_SESSION['e_password']))
			{
				echo '<div class="error">'.$_SESSION['e_password'].'</div>';
				unset($_SESSION['e_password']);
			}
		
		?>
		
		<div class="form-label-group">
                <input type="password" id="confirmPassword" class="form-control" placeholder="potwierdź hasło" value="<?php
		if (isset($_SESSION['fr_password2']))
		{
			echo $_SESSION['fr_password2'];
			unset($_SESSION['fr_password2']);
		}
		?>" name="password2" required>
                <label for="confirmPassword">potwierdź hasło</label>
              </div>
		
			<div class="g-recaptcha" data-sitekey="6LcLCOEUAAAAAOddyjhNxH9jk3ADBduuAfLLhh_G"></div>
		
		<?php
			if (isset($_SESSION['e_bot']))
			{
				echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
				unset($_SESSION['e_bot']);
			}
		?>
		
		<br />
		
		<button class="btn btn-lg btn-primary btn-block text-uppercase reg-log centerize" type="submit">Zarejestruj się</button>
              <hr class="my-4">
		
		
		<div class="not-registered">
			  <h6> Masz już konto? <a href="index.php"> ZALOGUJ SIĘ! </a></h6>
			  </div>

	</form>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>