<?php
   include_once "conexao.php";

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
      $descricao = $_POST['descricao'];
      $valor = $_POST['valor'];
      $data_vale = $_POST['data_vale'];
      //$atualizacao = $_POST['atualizacao'];
      $criado = $_POST['criado'];
     
     $conexaoComBanco = abrirBanco();

     $sql = "insert into cadastro (descricao, valor, data_vale,  criado)
     values ('$descricao', '$valor', '$data_vale',  '$criado')";
     // atualizacao | '$atualizacao'

     if($conexaoComBanco->query($sql) === TRUE){
        echo ":) Contato salvo com sucessso no banco de dados :)";
     } else {
        echo ":( Erro ao salvar no banco de dados " . $conexaoComBanco->error;
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
                <li> <a href="cadastrar.php">Cadastrar</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <h2>Cadastro de Vale</h2>

        <form action="cadastrar.php" method="POST">

           <label for="descricao">Descrição</label>
           <input type="text" name="descricao" required>

           <label for="valor">Valor</label>
           <input type="decimal" name="valor" required>

           <label for="data_vale">Data do Vale</label>
           <input type="date" name="data_vale" required>

           <label for="criado">Criado em</label>
           <input type="date" name="criado" required>

           <button type="submit">Salvar</button>

        </form>
    </section>
</body>
</html>