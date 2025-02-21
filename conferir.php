<?php
try {
	$con = new PDO('pgsql:host=localhost;port=5432;dbname=20221214010024',
	'postgres', 'pabd');
	
	if ($con) {
		$username = "username";
		$senha  = "senha";
		
		$stmt = $pdo->prepare("SELECT * FROM usuario WHERE username=?");
        $stmt->execute([$username]); 
        $username = $stmt->fetch();
        if ($username) {
            // email found
        } else {
            // or not
        } 
	}
} catch (PDOException $e) {
	echo 'DEU ERRADO!!!' . $e;
}
?>