// TEM O ADICIONAR DO DONO 

<?php
try {
	$con = new PDO('pgsql:host=localhost;port=5432;dbname=20221214010024',
	'postgres', 'pabd');
	
	if ($con) {
		$nome = $_POST['nome'];
		$valor  = $_POST['valor'];
        $id  = $_POST['id'];
        $quantidade  = $_POST['quantidade'];
		
		
		$comando3 = "INSERT INTO itens VALUES ('$id', '$valor','$quantidade', '$nome')";
		
		$con->exec($comando3);
	}
} catch (PDOException $e) {
	echo 'DEU ERRADO!!!' . $e;
}
?>
