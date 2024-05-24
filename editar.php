<?php
   include_once "conexao.php";
   include_once "funcoes.php";
   
   if(isset($_GET['id'])&& $_GET['id']>0){
   $id= $_GET['id'];

   $conexaoComBanco = abrirBanco();
   $pegarDados = $conexaoComBanco->prepare("SELECT * FROM cadastro WHERE id = ?");
   $pegarDados->bind_param("i", $id);
   $pegarDados->execute();
   $result = $pegarDados->get_result();

   if($result->num_rows ==1){
    $registro = $result->fetch_assoc();
   }
   fecharBanco($conexaoComBanco);

   }
   if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $atualizacao = $_POST['atualizacao'];
    $criado = $_POST['criado'];

   $conexaoComBanco = abrirBanco();

   $sql = "UPDATE cadastro SET descricao = '$descricao', valor = '$valor', atualizacao = '$atualizacao', 
   criado = '$criado',  
   WHERE id = $ID";

   if($conexaoComBanco->query($sql) === TRUE){
      echo ":) Contato salvo com sucessso no banco de dados :)";
   } else {
      echo ":( Erro ao salvar no banco de dados: " . $conexaoComBanco->error;
   }

   fecharBanco($conexaoComBanco);
 }
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vale</title>
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
        <h2>Atualizar Vale</h2>

        <form action="" method="POST">

           <label for="descricao">Descrição</label>
           <input type="text" name="descricao" value="<?= $registro['Descricao']?>" required>

           <label for="valor">Valor</label>
           <input type="number" name="valor" value="<?= $registro['valor']?>" required>

           <label for="atualizacao">Atualização</label>
           <input type="date" name="atualizacao" value="<?= $registro['autalizacao']?>" required>

           <label for="criado">Criado</label>
           <input type="date" name="criado" value="<?= $registro['criado']?>" required>


           <input type="hidden" name="id" value="<?= $registro['id']?>">

           <button type="submit">Atualizar</button>

        </form>
    </section>
</body>
</html>