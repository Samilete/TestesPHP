<?php
    //ajeitar a parte de table pq eu copiei do arquivo
    //CONTEÉM O READ E O ADICIONAR DA TELA DONO 
 
    $con = new PDO('pgsql:host=localhost; port=5432;dbname=20221214010024','postgres', 'pabd');
?>   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina DONO</title>
</head>
<body>
    <form action="insertcrud.php" method="POST">
        <h1>ADICIONAR NOVO ITEM AO CATÁLOGO</h1>
        <hr>
        <input type="text" name="id" placeholder="Código de identificação"/>

        <input type="text" name="valor" placeholder="Valor do produto" />

        <input type="text" name="quantidade" placeholder="Quantos produtos estão disponíveis?" />

        <input type="text" name="nome" placeholder="Nome do Produto" />       

        <input type="submit" value="salvar">
        <input type="reset" value="novo">
    </form>
    
    <table border="1" width="100%">
        <tr>
            <th>ID</th>
            <th>VALOR</th>
            <th>QUANTIDADE</th>
            <th>NOME</th>
        </tr>
        <?php
    // Bloco que realiza o papel do Read - recupera os dados e apresenta na tela (TEM QUE ALTERAR PQ EU PEGUEI DO ARQUIVO)
        try {
            $stmt = $con->prepare("SELECT * FROM itens");
                if ($stmt->execute()) {
                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                        echo "<tr>";
                        echo "<td>".$rs->id_item."</td><td>".$rs->valor_item."</td><td>".$rs->quantidade."</td><td>".$rs->nome_item."</td>";
                                "</td><td><center><a href=\"\">[Alterar]</a>"
                                ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                                ."<a href=\"\">[Excluir]</a></center></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Erro: Não foi possível recuperar os dados do banco de dados";
                }
        } catch (PDOException $erro) {
            echo "Erro: ".$erro->getMessage();
        }
        ?>
    </table>
</body>
</html> 
