<?php
   include_once "conexao.php";
   include_once "funcoes.php";
   if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'){
    $id = $_GET['ID'];

   $conexaoComBanco = abrirBanco();
   $sql = "DELETE FROM cadastro WHERE ID = $ID";

   if ($conexaoComBanco->query($sql) === TRUE){
    echo "Contato Deletado";
   }else{
    echo "Erro ao Deletar" . $conexaoComBanco->error;
   }
   fecharBanco($conexaoComBanco);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vales</title>
   <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header>
        <h1>Gerecimento de Vales</h1>
        <nav>
            <ul>
                <li> <a href="index.php">Home</a></li>
                <li> <a href="cadastrar.php">Cadastrar Vale</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <h2>Vales Cadastrados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Data do Vale</th>
                    <th>Atualização</th>
                    <th>Criado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                   $conexaoComBanco = abrirBanco();
                   $sql = "SELECT * FROM cadastro";
                   $result = $conexaoComBanco->query($sql);
                   if ($result->num_rows > 0){
                    while($registro = $result->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?= $registro['ID']?></td>
                        <td><?= $registro['descricao']?></td>
                        <td><?= $registro['valor']?></td>
                        <td><?= ( $registro['data_vale'])?></td>
                        <td><?= ( $registro['atualizacao'])?></td>
                        <td><?= ( $registro['criado'])?></td>
                        
                        <td>
                            <a href="editar.php?id=<?=$registro['ID']?>"><button>Editar</button></a>
                            <a href="?acao=deletar&id=<?= $registro['ID']?>" 
                            onclick="return confirm('Tem certeza que deseja excluir?')">
                            <button>Excluir</button></a>
                        </td>

                    </tr>
                    <?php
                    }
                   }else{
                    echo("<tr><td>Nenhum registro para exibir</td></tr>");

                   }
                ?>

            </tbody>
        </table>
    </section>
</body>
</html>