<?php

	session_start();
	
	if (!isset($_SESSION['logged_in']))
{
	header('Location: index.php');
	exit();
}
	
	require_once 'navbar.html';
?>

  <body>
    
	<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
		  
			<h1 class="title">Dodano pomyślnie!</h1>
			<br />
			<img src="img/ok.png" alt="OK" width="50" class="rounded mx-auto d-block">
            
	
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