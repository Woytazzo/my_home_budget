<?php
session_start();

if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
{
	header('Location: index.php');
	exit();
}

require_once "connect.php";

$connection = @new mysqli ($host, $db_user, $db_password, $db_name);

if($connection->connect_errno!=0)
{
	echo "Error: ".$connection->connect_errno;
}

else {
$login = $_POST['login'];
$password = $_POST['password'];

$login = htmlentities($login, ENT_QUOTES, "UTF-8");
$password = htmlentities($password, ENT_QUOTES, "UTF-8");

$sql="SELECT * FROM users WHERE email=?;";
$stmt = mysqli_stmt_init($connection);

if (!mysqli_stmt_prepare($stmt, $sql)){
			$_SESSION['error'] = '<span style="color:red">Nieprawidłowy SQL POPRAW!</span>';
		header('Location: index.php');
		}
		else{
			
			mysqli_stmt_bind_param($stmt, "s", $login);
			mysqli_stmt_execute($stmt);
			
			$result = mysqli_stmt_get_result($stmt);
			if ($row = mysqli_fetch_assoc($result)){
				$pwdCheck = password_verify($password, $row['password']);
				if($pwdCheck == false){
					$_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
					header('Location: index.php');
				}
				else if($pwdCheck == true){
					
					$_SESSION['logged_in'] = true;
		
					//$line = $result->fetch_assoc();
					$_SESSION['username'] = $row['username'];
					$_SESSION['id'] = $row['id'];
					$_SESSION['password'] = $row['password'];
					$_SESSION['email'] = $row['email'];
					
					unset($_SESSION['error']);
					$result->free_result();
					header('Location: menu.php');
				}
				else {
					$_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
					header('Location: index.php');
				}
				
			}
			
			else {
				$_SESSION['error'] = '<span style="color:red">Nie ma takiego użytkownika!</span>';
					header('Location: index.php');	
			}
		}

$connection->close();
}
