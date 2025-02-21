<?php
try {
	$con = new PDO('pgsql:host=localhost;port=5432;dbname=20221214010024',
	'postgres', 'pabd');
	
	if ($con) {
		$username = $_POST['username'];
		$senha  = $_POST['senha'];
		
		$comando2 = "INSERT INTO usuario VALUES ('$username', '$senha')";
		
		$con->exec($comando2);
	}
} catch (PDOException $e) {
	echo 'DEU ERRADO!!!' . $e;
}
?>