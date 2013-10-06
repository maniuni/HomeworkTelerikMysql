<?php
$pageTitle = 'Регистрация';
include 'includes/header.php';

if(isset($_SESSION['registerNew'])){
	header('location:index.php');
	exit;
}

else{
	if($_POST){
		$username = trim($_POST['username']);
		$pass = trim($_POST['pass']);
		if(mb_strlen($username)<5 || mb_strlen($pass)<5){
			echo "<p>Минималната дължина на името и паролата е 5 символа</p>";
		}
		else{
			$connection = mysqli_connect('localhost','maniuni','hello','homework2_telerik');
			if(!$connection){
				echo '<p>Възникна проблем при връзката с базата данни, извиняваме се за нeудобството. Моля, прегледайте файлът "ReadMe.txt" в папката с домашното.</p>';
				exit;
			}
			mysqli_set_charset($connection, 'utf8');
			
			$duplicate = mysqli_query($connection,"SELECT username FROM users WHERE username='".$username."'");
			if($duplicate->num_rows > 0){
				echo "<p>Вече има потребител с такова име.</p>";
				echo '<a href="registration.php">Назад</a>';
				exit;
			}
			
			$registerNew = mysqli_query($connection, "INSERT INTO users (username,password) VALUES ('".$username."','".$pass."')");
			if(!$registerNew){
				echo "<p>Възникна проблем, извиняваме се за нeудобството.</p>";
			}
			else{
				$_SESSION['registerNew'] = true;
				header('location:registration.php');
				exit;
			}
		}
	}

?>

<form method="POST" action="">
	<label for="username">Име:</label>
	<input type="text" id="username" name="username"/><br/>
	<label for="pass">Парола:</label>
	<input type="password" id="pass" name="pass"/><br/>
	<input type="submit" value="Регистрирай ме"/><br/>	
</form>

<?php
}
include 'includes/footer.php';
?>