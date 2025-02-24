//CONEXÃO COM O BANCO DE DADOS
<?php
try {
   $con = new PDO('pgsql:host=localhost; port=5432;dbname=20221214010024','postgres', 'pabd');
   $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $con->exec("set client_encoding to utf8");

}catch (PDOException $e) {
	echo 'DEU ERRADO!!!' . $e;
}

?>
