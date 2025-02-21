<?php
//try{
    $con = new PDO('pgsql:host=localhost; port=5432;dbname=20221214010024','postgres', 'pabd');
    
   // if (isset($_POST['submit'])){
        //print_r($_POST['nome']);
        //print_r($_POST['senha']);
       // include_once('config.php');

       // $username=$_POST['username'];
       // $senha=$_POST['senha'];

       // $result=  NEW PD0 ($con, "INSERT INTO usuario (userneme,senha) VALUES ('$username'.'$senha')");
   // }
  // if ($con) {
      //  echo "deu certo";
         //   $comando1 = $con->query("SELECT * FROM usuario");
    
      //  while ($var_linha = $comando1->fetch()) {
       //     echo $var_linha[1] . "<br/>";	
   // }
   // }
//} catch (PDOException $e) {
  // echo 'DEU ERRADO!!!' . $e;
///}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <a href="parte1.php">voltar</a>
    <div class="box">
        <form action="insertusuario.php" method="POST">
            <fieldset>
                <legend> Formulario de usuario </legend>
                <br>
                <div class="inputbox">
                    <input type="text" name="username" id="username" class="inputuserneme" required>
                    <label for="username"> Username </label>
                </div>
                <div class="inputbox">
                    <input type="password" name="senha" id="senha" class="inputsenha" required>
                    <label for="senha"> Senha </label>
                </div>
                <input type="submit" name="submit" id="submit">
            </fieldset>
        </form>
    </div>
    
</body>
</html>