<?php
    //ajeitar a parte de table pq eu copiei do arquivo
    //CONTEÉM O READ E O ADICIONAR DA TELA DONO 
 
    $con = new PDO('pgsql:host=localhost; port=5432;dbname=20221214010023','postgres', 'cams05');


/**
 * Projeto de aplicação CRUD utilizando PDO - Agenda de Contatos (PostgreSQL)
 *
 * Alexandre Bezerra Barbosa
 */

// Verificar se foi enviado dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_produto = !empty($_POST["id_produto"]) ? $_POST["id_produto"] : "";
    $nome_produto = !empty($_POST["nome_produto"]) ? $_POST["nome_produto"] : "";
    $valor_produto = !empty($_POST["valor_produto"]) ? $_POST["valor_produto"] : "";
    $tempo_produção = !empty($_POST["tempo_producao"]) ? $_POST["tempo_producao"] : NULL;
} else if (!isset($id)) {
    $id_produto = !empty($_GET["id_produto"]) ? $_GET["id_produto"] : "";
    $nome_produto = NULL;
    $valor_produto = NULL;
    $tempo_producao = NULL;
}

// Conectar ao banco de dados PostgreSQL
try {
    $conexao = new PDO("pgsql:host=localhost;dbname=20221214010023", "postgres", "cams05");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $erro) {
    echo "Erro na conexão: " . $erro->getMessage();
}

// Bloco para salvar (Create/Update)
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && !empty($nome)) {
    try {
        if (!empty($id_produto)) {
            $stmt = $conexao->prepare("UPDATE catalogo SET nome_produto = ?, valor_produto = ?, tempo_producao = ? WHERE id_produto = ?");
            $stmt->bindParam(4, $id_produto, PDO::PARAM_INT);
        } else {
            $stmt = $conexao->prepare("INSERT INTO catalogo (id_produto, nome_produto, valor_produto, tempo_producao) VALUES (?, ?, ?,?)");
        }
        $stmt->bindParam(1, $id_produto);
        $stmt->bindParam(2, $nome_produto);
        $stmt->bindParam(3, $valor_produto);
        $stmt->bindParam(4, $tempo_producao);

        if ($stmt->execute()) {
            echo "Dados cadastrados com sucesso!";
            $id_produto = $nome_produto = $valor_produto = $tempo_producao = null;
        } else {
            echo "Erro ao tentar efetivar cadastro";
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}

// Bloco para buscar informações para edição (Read)
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && !empty($id_produto)) {
    try {
        $stmt = $conexao->prepare("SELECT * FROM catalogo WHERE id_produto = ?");
        $stmt->bindParam(1, $id_produto, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            if ($rs) {
                $id_produto = $rs->id_produto;
                $nome_produto = $rs->nome_produto;
                $valor_produto = $rs->valor_produto;
                $tempo_producao = $rs->tempo_producao;
            }
        } else {
            throw new PDOException("Erro ao recuperar os dados");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}

    if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && !empty($id_produto)) {
        try {
            $stmt = $conexao->prepare("DELETE FROM catalogo WHERE id_produto = ?");
            $stmt->bindParam(1, $id_produto, PDO::PARAM_INT);
            if ($stmt->execute()) {
                echo "Registro excluído com sucesso!";
                $id = null;
            } else {
                throw new PDOException("Erro ao tentar excluir o contato");
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }
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
        <input type="text" name="id_produto" placeholder="Código de identificação"/>

        <input type="text" name="nome_produto" placeholder="Nome do Produto" />   
        
        <input type="text" name="valor_produto" placeholder="Valor do produto" />

        <input type="text" name="tempo_producao" placeholder="Tempo de produção" />
      

        <input type="submit" value="salvar">
        <input type="reset" value="novo">
    </form>
    
    <table border="1" width="100%">
        <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>VALOR</th>
            <th>TEMPO DE PRODUCAO</th>
        </tr>
        <?php
    // Bloco que realiza o papel do Read - recupera os dados e apresenta na tela (TEM QUE ALTERAR PQ EU PEGUEI DO ARQUIVO)
        try {
            $stmt = $con->prepare("SELECT * FROM catalogo ORDER BY id_produto ASC");
            if ($stmt->execute()) {
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    echo "<tr>";
                    echo "<td>{$rs->id_produto}</td><td>{$rs->nome_produto}</td><td>{$rs->valor_produto}</td><td>{$rs->tempo_producao}</td>";
                    echo "<td><center>
                        <a href=\"?act=upd&id_produto={$rs->id_produto}\">[Alterar]</a> 
                        &nbsp;&nbsp;&nbsp;
                        <a href=\"?act=del&id_produto={$rs->id_produto}\" onclick=\"return confirm('Deseja realmente excluir?');\">[Excluir]</a>
                        </center></td>";
                    echo "</tr>";
                }
            } else {
                echo "Erro ao recuperar os contatos.";
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
        ?>
    </table>
</body>
</html>
