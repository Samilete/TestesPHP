<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>

    <?php
        if(!isset($_SESSION['username'])){
            if(isset($_POST['submit'])){
                $username='samilly';
                $senha='123';

                $usernameform =$_POST ['username'];
                $senhaform =$_POST ['senha'];

                if($username ==  $usernameform && $senha == $senhaform){
                        //logado com suceso
                        header ('location: index.php');
                }else{
                    //obviamente teve erro
                    echo 'dados invalidos';
                }

        }
           include('login.php');
        }else{
            include('home.php');
        }
    ?>
    
</body>
</html>