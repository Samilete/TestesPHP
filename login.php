<?php
// TROCAR E ESCREVER DE NOVO PARA N COISAR DO GPT
include('config.php');

if (isset($_POST['username']) && isset($_POST['senha'])) {
    //quantidade de caracteres
    if(strlen($_POST['username']) == 0){
        echo "preencha seu username";
    }else if (strlen($_POST['senha']) == 0){
        echo "preencha sua senha";
    }else{
        // Usando o método quote() do PDO para escapar a string
        $username = $con->quote($_POST['username']);
        $senha = $con->quote($_POST['senha']);

        // Alterar a consulta para usar PDO
        $sql_code = "SELECT * FROM usuario WHERE username = $username AND senha = $senha";
        $sql_query = $con->query($sql_code);

        if ($sql_query) {
            // Verificar o número de resultados
            $quantidade = $sql_query->rowCount();

            if($quantidade == 1){
                // Pega os dados do usuário
                $username = $sql_query->fetch(PDO::FETCH_ASSOC);

                if(!isset($_SESSION)){
                    session_start();
                }

                $_SESSION['username'] = $username['username'];
                header("Location: home.php");
                exit;
            } else {
                echo "Falha ao logar. Seu email ou senha estão incorretos.";
            }
        } else {
            echo "Falha na execução da consulta.";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tela de login</title>
</head>
<body>
    <a href="parte1.php">voltar</a>
    <div>
        <h1>login</h1>
        <form action="" method="POST">
            <input type="text" name="username" placeholder="username">
            <br><br>
            <input type="password" name="senha" placeholder="senha">
            <br><br>
            <input type="submit" name="submit" value="enviar">
        </form>
    </div>
</body>
</html>