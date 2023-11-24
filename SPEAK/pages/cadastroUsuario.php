<?php
  if(isset($_POST["submit"])){
    require_once "../conexao.php";
    $conn = new Conexao();    

    $nome = $_POST['nomeCadastro'];
    $email = $_POST['emailCadastro'];
    $telefone = $_POST['telefoneCadastro'];
    $cpf = $_POST['cpfCadastro'];
    $endereco = $_POST['enderecoCadastro'];
    $bairro = $_POST['bairroCadastro'];
    $complemento = $_POST['complementoCadastro'];
    $cidade = $_POST['cidadeCadastro'];
    $estado = $_POST['estadoCadastro'];
    $tipoPerfil = $_POST['tipoPerfilCadastro'];
    $numeroRegistroProfessor = $_POST['numeroRegistroProfessor'];
    $areaAtuacao = $_POST['areaAtuacao'];
    $senha = $_POST['senhaCadastro'];

    if($tipoPerfil == "aluno"){
      $numeroRegistroProfessor = "";
      $areaAtuacao = "";
    }

    $sql_insert = "INSERT INTO usuario (nome, email, telefone, cpf, endereco, bairro, complemento, cidade, estado, tipoPerfil, numeroRegistroProfessor, areaAtuacao, senha) VALUES ('$nome', '$email', '$telefone', '$cpf', '$endereco', '$bairro', '$complemento', '$cidade', '$estado', '$tipoPerfil', '$numeroRegistroProfessor', '$areaAtuacao', '$senha')";

    $result_query = $conn->conexao->prepare( $sql_insert );

    if ($result_query) {          
        $result_query->execute();
        if ($result_query->rowCount() > 0) {
          // echo '<script>window.alert("Sucesso ao cadastrar usuário!");</script>';
          header("Location: login.php");
        } else {
          echo '<script>window.alert("Falha ao cadastrar usuário!");</script>';
        }
    } else {
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

  <title>Cadastro</title>
</head>

<body id="body-cadastro">
  <header>
    <div class="conteiner-header">
      <img src="../assets/logo.svg" alt="logo SPEAK">
      <nav>
        <a class="item-navegacao" href="../index.php" title="Início"><img id="svg-home" src="../assets/home.svg" alt="logo SPEAK"></a>
      </nav>
    </div>
</header>
  <main>
    <div class="container">      
        <form id="cadastroForm" action="" method="POST">
          <h1 class="text-center py-2">Cadastro</h1>
          <div class="form-floating">
            <input type="text" class="form-control" id="nomeCadastro" name="nomeCadastro" placeholder="Nome" required>
            <label for="nomeCadastro">Nome</label>
          </div>
          <br>
          <div class="form-floating">
            <input type="email" class="form-control" name="emailCadastro" id="emailCadastro" placeholder="nome@exemplo.com" required>
            <label for="emailCadastro">Email</label>
          </div>
          <br>
          <div class="form-floating">
            <input type="text" class="form-control" name="telefoneCadastro" id="telefoneCadastro" placeholder="(xx)9xxxx-xxxx" required>
            <label for="telefoneCadastro">Telefone</label>
          </div>
          <br>
          <div class="form-floating">
            <input type="text" class="form-control" name="cpfCadastro" id="cpfCadastro" placeholder="CPF" required>
            <label for="cpfCadastro">CPF</label>
          </div>
          <br>
          <div class="form-floating">
            <input type="text" class="form-control" name="enderecoCadastro" id="enderecoCadastro" placeholder="Endereço" required>
            <label for="enderecoCadastro">Endereço</label>
          </div>
          <br>
          <div class="form-floating">
            <input type="text" class="form-control" name="bairroCadastro" id="bairroCadastro" placeholder="Bairro" required>
            <label for="bairroCadastro">Bairro</label>
          </div>
          <br>
          <div class="form-floating">
            <input type="text" class="form-control" name="complementoCadastro" id="complementoCadastro" placeholder="Complemento" required>
            <label for="complementoCadastro">Complemento</label>
          </div>
          <br>
          <div class="form-floating">
            <input type="text" class="form-control" name="cidadeCadastro" id="cidadeCadastro" placeholder="Cidade" required>
            <label for="cidadeCadastro">Cidade</label>
          </div>
          <br>
          <div class="form-floating">
            <select name="estadoCadastro" id="estadoCadastro" class="form-select sm" required>
              <option selected disabled value="">Selecione uma opção</option>
              <option value="AC">Acre</option>
              <option value="AL">Alagoas</option>
              <option value="AP">Amapá</option>
              <option value="AM">Amazonas</option>
              <option value="BA">Bahia</option>
              <option value="CE">Ceará</option>
              <option value="DF">Distrito Federal</option>
              <option value="ES">Espírito Santo</option>
              <option value="GO">Goiás</option>
              <option value="MA">Maranhão</option>
              <option value="MT">Mato Grosso</option>
              <option value="MS">Mato Grosso do Sul</option>
              <option value="MG">Minas Gerais</option>
              <option value="PA">Pará</option>
              <option value="PB">Paraíba</option>
              <option value="PR">Paraná</option>
              <option value="PE">Pernambuco</option>
              <option value="PI">Piauí</option>
              <option value="RJ">Rio de Janeiro</option>
              <option value="RN">Rio Grande do Norte</option>
              <option value="RS">Rio Grande do Sul</option>
              <option value="RO">Rondônia</option>
              <option value="RR">Roraima</option>
              <option value="SC">Santa Catarina</option>
              <option value="SP">São Paulo</option>
              <option value="SE">Sergipe</option>
              <option value="TO">Tocantins</option>
            </select>
            <label for="estadoCadastro">Estado</label>
          </div>
          <br>
          <div class="form-floating">
            <select id="tipoPerfilCadastro" name="tipoPerfilCadastro" class="form-select sm" required>
              <option selected disabled value="">Selecione uma opção</option>
              <option value="aluno">Aluno(a)</option>
              <option value="professor">Professor(a)</option>
            </select>
            <label for="tipoPerfilCadastro">Qual o tipo de perfil ?</label>
          </div>
          <br>
          <div class="form-floating">
            <input type="text" class="form-control" id="numeroRegistroProfessor" name="numeroRegistroProfessor" placeholder="Número de registro" required>
            <label for="numeroRegistroProfessor">Número de registro (somente professor(a))</label>
          </div>
          <br>
          <div class="form-floating">
            <input type="text" class="form-control" id="areaAtuacao" name="areaAtuacao" placeholder="Área de atuação" required>
            <label for="areaAtuacao">Área de atuação (somente professor(a))</label>
          </div>
          <br>
          <div class="form-floating">
            <input type="text" class="form-control" name="senhaCadastro" id="senhaCadastro" placeholder="Senha" required>
            <label for="senhaCadastro">Senha</label>
          </div>
          <br>
          <div class="inferior-form">
            <div><input type="submit" id="submitCadastro" name="submit" value="Cadastrar"/></div>
            
            <div><a href="login.php">Já possui conta ? Faça o login</a></div>
          </div>
        </form>
    </div>
  </main>
  <footer class="text-center py-2 fixed-bottom" id="footer">
    SPEAK - Solidarity Platform for Education and Access to Knowledge @Copyright 2023. Todos os direitos reservados. <a href="sobre.php" title="Saiba mais"><b>Saiba mais</b></a>
</footer>
</body>

</html>