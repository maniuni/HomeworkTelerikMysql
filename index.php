<?php
$pageTitle = 'Вход';
include 'includes/header.php';

if(isset($_SESSION['isLogged'])){
	header('location:messages.php');
	exit;
}

else{
	if ($_POST){	
		$username = trim($_POST['username']);
		$pass = trim($_POST['pass']);
		
		$connection = mysqli_connect('localhost','maniuni','hello','homework2_telerik');

		if(!$connection){
			echo '<p>Възникна проблем, извиняваме се за нeудобството. Моля, прегледайте файлът "ReadMe.txt" в папката с домашното.</p>';
			exit;
		}

		mysqli_set_charset($connection, 'utf8');
		
		$check_user = mysqli_query($connection,"SELECT username,password FROM users WHERE username='".$username."'AND password='".$pass."'");

		if($check_user->num_rows>0){
			$_SESSION['isLogged']=true;
			$_SESSION['user'] = $username;
			header('location:index.php');
			exit;
		}
		else{
			echo "<p>Грешни данни.</p>";
		}
	}

?>

<p>Вход за регистрирани потребители</p>
<form method="POST" action="">
	<label for="username">Име:</label>
	<input type="text" id="username" name="username"/><br/>
	<label for="pass">Парола:</label>
	<input type="password" id="pass" name="pass"/><br/>
	<input type="submit" value="Вход"/><br/>	
</form>
<a href="registration.php">Регистрация на нов потребител</a>

<?php
}
include 'includes/footer.php';
?>


