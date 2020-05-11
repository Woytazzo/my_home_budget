<?php
session_start();

if((isset($_SESSION['logged_in']))&&($_SESSION['logged_in']==true))
{
	header('Location: menu.php');
	exit();
}
?>

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
			<h1 class="title">mój domowy budżet</h1>
            <h5 class="card-title text-center">Logowanie</h5>
			
            <form class="form-signin" action="login.php" method="post">
			
              <div class="form-label-group">
			  
                <input type="email" id="inputEmail" name="login" class="form-control" placeholder="adres email" required autofocus>
                <label for="inputEmail">Adres email</label>
              </div>
			  <br/>

              <div class="form-label-group">
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="hasło" required>
                <label for="inputPassword">Hasło</label>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Zapamiętaj hasło</label>
              </div>
			  
              <button class="btn btn-lg btn-primary btn-block text-uppercase reg-log" type="submit">Zaloguj się</button>
              <hr class="my-4">
			  
			  <?php
			  if(isset($_SESSION['error'])) echo $_SESSION['error'];
			  
			  ?>
			  
			  <div class="not-registered">
			  <h6> Nie masz konta? <a href="registration.php"> ZAREJESTRUJ SIĘ! </a></h6>
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