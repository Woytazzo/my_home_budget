<?php

session_start();

if (isset($_POST['email']))
{
	$all_OK=true;
		
		//poprawny name
		$name = $_POST['name'];
		
		if (strlen($name)<3 || (strlen($name)>20))
		{
			$all_OK=false;
			$_SESSION['e_name'] = "Imię musi posiadać 3-20 znaków!";
		}
		if($all_OK==true)
		{
			
		}
		
	
}


//6LcLCOEUAAAAAOddyjhNxH9jk3ADBduuAfLLhh_G 
//6LcLCOEUAAAAAHsrXwSGIkchBe8DomeiYjR0VqKC secret

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

    <title>Mój domowy budżet - rejestracja</title>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<style>
	.error{
		color:red;
		margin-top: 10px;
		margin-bottom: 10px;
	}
	</style>
	
  </head>
  <body>
    
	<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
			<h1 class="title">mój domowy budżet</h1>
            <h5 class="card-title text-center">Rejestracja</h5>
            <form method="post" class="form-signin">
			
              <div class="form-label-group">
                <input type="text" id="inputName" class="form-control" placeholder="imię" required autofocus>
                <label for="inputName">imię</label>
				</div>
				<?php
				
					if (isset($_SESSION['e_name']))
					{
						echo '<div class="error">'.$_SESSION['e_name'].'</div>';
						unset($_SESSION['e_name']);
					}
				
				?>
				<br/>
				
				<div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="adres email" required>
                <label for="inputEmail">adres email</label>
              </div>
			  
			  <br/>

              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" placeholder="hasło" required>
                <label for="inputPassword">hasło</label>
              </div>
			  
			  <br/>

              <div class="form-label-group">
                <input type="password" id="confirmPassword" class="form-control" placeholder="potwierdź hasło" required>
                <label for="confirmPassword">potwierdź hasło</label>
              </div>
			  
			  <label>
				<input type="checkbox" name="regulations" /> Akceptuję regulamin
			  </label>
			  
				<br/><br/>
				
				<div class="g-recaptcha" data-sitekey="6LcLCOEUAAAAAOddyjhNxH9jk3ADBduuAfLLhh_G "></div>
				
				<br/>
              
              <button class="btn btn-lg btn-primary btn-block text-uppercase reg-log" type="submit">Zarejestruj się</button>
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