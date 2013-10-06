<?php
$pageTitle = 'Ново съобщение';
include 'includes/header.php';

if(isset($_SESSION['isLogged'])){
	if($_POST){
		$connection = mysqli_connect('localhost','maniuni','hello','homework2_telerik');
		if(!$connection){
			echo '<p>Възникна проблем при връзката с базата данни, извиняваме се за нeудобството.</p>';
			exit;
		}
		mysqli_set_charset($connection, 'utf8');
		
		$title = trim($_POST['title']);
		$title = mysqli_real_escape_string($connection,$title);
		
		if(mb_strlen($title)>50 || mb_strlen($title)<1){
			echo "<p>Дължината на заглавието трябва да бъде минимум 1 символ и максимум 50.</p>";
			exit;
		}
			
		$content = trim($_POST['content']);
		$content = mysqli_real_escape_string($connection,$content);
		
		if(mb_strlen($content)>250 || mb_strlen($content)<1){
			echo "<p>Дължината на съобщението трябва да бъде минимум 1 символ и максимум 250.</p>";
			exit;
		}
		
		$date = date("Y-m-d");
		
		$insert = mysqli_query($connection,"INSERT INTO messages(author,date,title,content) VALUES ('".$_SESSION['user']."','".$date."','".$title."','".$content."')");
		
		if(!$insert){
			printf(mysqli_error($connection));
			echo "<p>Възникна проблем, извиняваме се за нeудобството.</p>";
			exit;
		}
		else{
			header('location:messages.php');
			exit;
		}
	}

?>


<form method="POST" action="">
	<label for="title">Заглавие:</label><br/>
	<input type="text" id="title" name="title"/><br/>
	<label for="content">Съобщение:</label><br/>
	<textarea id="content" name="content" rows="4" cols="50"></textarea><br/>
	<input type="submit" name="submit" value="Добави"/>
</form>


<?php
}
else{
header('location:index.php');
exit;
}
include 'includes/footer.php';
?>