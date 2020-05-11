<?php

	session_start();

	if (!isset($_SESSION['registrationcompleted'])) 
	{
		header('Location: index.php');
		exit();
	}
	else
	{
		unset($_SESSION['registrationcompleted']);
		unset($_SESSION['error']);
	}

	//usuwamy zmienne zapamietujace wartosci w razie nieudanej walidacji
	if (isset($_SESSION['fr_username'])) unset($_SESSION['fr_username']);
	if (isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
	if (isset($_SESSION['fr_password1'])) unset($_SESSION['fr_password1']);
	if (isset($_SESSION['fr_password2'])) unset($_SESSION['fr_password2']);

	
	//usuwanie błędów rejestracji
	if (isset($_SESSION['e_username'])) unset($_SESSION['e_username']);
	if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
	if (isset($_SESSION['e_password'])) unset($_SESSION['e_password']);

	if (isset($_SESSION['e_bot'])) unset($_SESSION['e_bot']);
?>
<!DOCTYPE HTML >
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>mój domowy budżet</title>
<head>

<body>

<!doctype html>
<html lang="pl">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
	<link rel="stylesheet" type="text/css" href="style.css">

    <title>Mój domowy budżet - logowanie</title>
  </head>
  <body>
    
	<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
			<h1 class="title">Dziękujemy za rejestrację!</h1>
            <h5 class="card-title text-center"><a href="index.php">Zaloguj się na swoje konto!</a>
			<br /></h5>
	
            	<?php
				if(isset($_SESSION['error']))	
				echo $_SESSION['error'];
				?>

			
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



</body>

</html>