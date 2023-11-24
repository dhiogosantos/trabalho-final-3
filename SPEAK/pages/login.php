<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../styles/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/login.css">
    <link rel="stylesheet" href="../styles/footer.css">

    <script src="../scripts/bootstrap.bundle.min.js"></script>

    <title>Login</title>
</head>
<body id="body-login">
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
            <section>
                <form id="loginForm" action="" method="POST">
                    <h1 class="text-center py-2">Login</h1>
                    <div class="form-floating">
                        <input type="email" name="emailLogin" class="form-control" id="emailLogin" placeholder="nome@exemplo.com" required>
                        <label for="emailLogin">Email</label>
                      </div>
                      <br>
                      <div class="form-floating">
                        <input type="password" class="form-control" name="senhaLogin" id="senhaLogin" placeholder="Senha" required>
                        <label for="senhaLogin">Senha</label>
                      </div>
                      <br>
                    <input type="submit" name="submit" id="loginButton" value="Entrar"/>
                    <br>
                </form>
                <br>
                <a href="./cadastroUsuario.php">Não tem conta ? Cadastre-se</a>
            </section>
        </div>
    </main>
    <footer class="text-center py-2 fixed-bottom" id="footer">
        SPEAK - Solidarity Platform for Education and Access to Knowledge @Copyright 2023. Todos os direitos reservados. <a href="sobre.php" title="Saiba mais"><b>Saiba mais</b></a>
    </footer>
</body>
</html>

<?php
    session_start();
    if(isset($_POST["emailLogin"]) && isset($_POST["senhaLogin"])) {
        include_once "../conexao.php";
        include_once "../UsuarioEntidade.php";
        
        $conn = new Conexao();

        $sql = "SELECT * FROM usuario WHERE email = ? and senha = ?";
        $stmt = $conn->conexao->prepare( $sql );

        $stmt->bindParam(1, $_POST["emailLogin"]);
        $stmt->bindParam(2, $_POST["senhaLogin"]);

        $resultado = $stmt->execute();

        if($stmt->rowCount() == 1) {

            $usuario = new UsuarioEntidade();
            
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $usuario->setCpf($rs->cpf);
                $usuario->setNome($rs->nome);
                $usuario->setTipoPerfil($rs->tipoPerfil);
                $usuario->setId($rs->idUsuario);
            }

            $_SESSION["login"] = "1";
            $_SESSION["usuario"] = $usuario;
            header("Location: cursos.php");
        }
        else {
            echo "Usuário ou senha inválidos";
        }
    }
?>