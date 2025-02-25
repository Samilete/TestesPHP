<?php
//CONEXÃO COM O BANCO DE DADOS

try {
   $con = new PDO('pgsql:host=localhost; port=5432;dbname=20221214010023','postgres', 'cams05');
   $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $con->exec("set client_encoding to utf8");

}catch (PDOException $e) {
	echo 'DEU ERRADO!!!' . $e;
}

?>
