<!-- bloqueio caso nao estiver logado -->
<?php
    session_start();

    if($_SESSION["login"] != "1"){
      session_destroy();
      header("Location: login.php");
    }
    else{
      session_abort(); 
    }    
?>

<?php
  if(isset($_POST["submit"])){
    include_once "../conexao.php";
    include_once "../UsuarioEntidade.php";

    $conn = new Conexao();
    
    session_start();
    $usuario = $_SESSION["usuario"];

    $usuarioResponsavel = $usuario->getId();
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];

    //inserir novo curso
    $sql_insert = "INSERT INTO curso (usuarioResponsavel, titulo, descricao) VALUES ('$usuarioResponsavel', '$titulo', '$descricao')";
    
    $result_query = $conn->conexao->prepare($sql_insert);

    if ($result_query) {          
      $result_query->execute();
      
      //obter id do curso criado
      $idCurso = $conn->conexao->lastInsertId();

      if ($result_query->rowCount() > 0) {
        $sql_insert = "INSERT INTO chat (Curso_idCurso, Curso_usuarioResponsavel) VALUES ('$idCurso', '$usuarioResponsavel')";
        $result_query = $conn->conexao->prepare($sql_insert);

        //adiciona o chat pro curso criado
        if ($result_query) $result_query->execute();
        
        header("Location: cursos.php");
      }
      else{
        echo '<script>window.alert("Falha ao cadastrar curso");</script>';
      }
    }
    else {
      echo '<script>window.alert("Falha ao preparar consulta ao banco!");</script>';
    }
  }

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../styles/bootstrap.css">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/cadastro.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link href="styles\bootstrap.min.css">

    <script src="scripts\bootstrap.bundle.min.js"></script>
    <script src="../scripts/bootstrap.js"></script>

  <title>Cadastro Curso</title>
</head>

<body id="body-cadastro">
  <header>
    <div class="conteiner-header">
      <img src="../assets/logo.svg" alt="logo SPEAK">
      <nav>
      <a class="item-navegacao" href="../index.php"><img src="../assets/home.svg" alt="home" title="Home"></a>
            <a class="item-navegacao" href="../pages/cursos.php"><img src="../assets/cursos.svg" alt="cursos" title="Cursos"></a>
            <a class="item-navegacao" href="../pages/cursando.php"><img src="../assets/cursando.svg" alt="cursando" title="Cursando"></a>
            <a class="item-navegacao" href="../scripts/php/logOut.php"><img src="../assets/profile.svg" alt="cadastro" title="Cadastro"></a>
        
      </nav>
    </div>
</header>
  <main>
    <div class="container">      
    <form id="cadastroForm" action="" method="POST">
        <h1 class="text-center py-2">Cadastro Curso</h1>

        <div class="form-floating">
          <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" required>
          <label for="titulo">Titulo:</label>
        </div>
        <br>

        <div class="form-floating">
          <textarea class="form-control" id="descricao" name="descricao" placeholder="Descrição" maxlength="500" required></textarea>
          <label for="descricao">Descricão:</label>
        </div>
        <br>

        <input type="submit" id="submitCadastro" name="submit" value="Cadastrar">
    </form>
    </div>
  </main>
  <footer class="text-center py-2 fixed-bottom" id="footer">
    SPEAK - Solidarity Platform for Education and Access to Knowledge @Copyright 2023. Todos os direitos reservados. <a href="sobre.php" title="Saiba mais"><b>Saiba mais</b></a>
</footer>
</body>

</html>