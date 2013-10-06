<?php
$pageTitle = 'Съобщения';
include 'includes/header.php';

if(isset($_SESSION['isLogged'])){

$connection = mysqli_connect('localhost','maniuni','hello','homework2_telerik');
if(!$connection){
	echo '<p>Възникна проблем при връзката с базата данни, извиняваме се за нeудобството.</p>';
	exit;
}
mysqli_set_charset($connection, 'utf8');

$sql = mysqli_query($connection,"SELECT * FROM messages ORDER BY date");

if(!$sql){
	echo "<p>Възникна проблем, извиняваме се за нeудобството.</p>";
	exit;
}

if($sql->num_rows==0){
	echo "<p>Все още няма добавени съобщения.</p>";
}
else{
	echo "<table border=1><tr><td>Дата</td><td>Автор</td><td>Заглавие</td><td>Съдържание</td></tr>";
	while($row = $sql->fetch_assoc()){
		echo "
			<tr>
				<td>".$row['date']."</td>
				<td>".$row['author']."</td>
				<td>".$row['title']."</td>
				<td>".$row['content']."</td>
			</tr>
		";
	}
	echo "</table>";
}

?>

<a href="new-message.php">Ново съобщение</a><br/>
<a href="destroy.php">Излез</a>
	
<?php
}
else{
header('location:index.php');
exit;
}
include 'includes/footer.php';
?>