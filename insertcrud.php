<?php
// TEM O ADICIONAR DO DONO 
try {
	session_start();
	include_once('conect.php');

	if((!isset($_SESSION['nome']) == true ) and (!isset($_SESSION['senha']) == true))
	{
		unset($_SESSION['nome']);
		unset($_SESSION['senha']);
		header('location: home.php');
	}

	$sql = "SELECT * FROM catalogo ORDER BY id_produto DESC";

	$result = $con->query($sql);

	print_r($result);

		$con = new PDO('pgsql:host=localhost;port=5432;dbname=20221214010023',
		'postgres', 'cams05');
		
		if ($con) {
			$id_produto = $_POST['id_produto'];
			$nome_produto  = $_POST['nome_produto'];
			$valor_produto  = $_POST['valor_produto'];
			$tempo_producao  = $_POST['tempo_producao'];
			
			
			$comando3 = "INSERT INTO catalogo VALUES ('$id_produto', '$nome_produto','$valor_produto', '$tempo_producao')";
			
			$con->exec($comando3);
		}
	} catch (PDOException $e) {
		echo 'DEU ERRADO!!!' . $e;
}
