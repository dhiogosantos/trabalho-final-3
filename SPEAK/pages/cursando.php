<!-- bloqueio caso nao estiver logado -->
<?php
    session_start();

    if($_SESSION["login"] != "1") header("Location: login.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos</title>

    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/curso.css">

    <script src="../scripts/JQuery-3.7.0/jquery-3.7.0.js"></script>
    <script src="../scripts/injetarMeusCursos.js"></script>
    <script src="../scripts/search.js"></script>
</head>
    <header>
        <div class="conteiner-header">
            <img src="../assets/logo.svg" alt="logo SPEAK">
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Pesquisar...">
                <div class="search-icon">&#128269;</div>
            </div>
            <nav>
                <a class="item-navegacao" href="../index.php"><img src="../assets/home.svg" alt="home" title="Home"></a>
                <a class="item-navegacao" href="../pages/cursos.php"><img src="../assets/cursos.svg" alt="cursos" title="Cursos"></a>
                <a class="item-navegacao" href="../pages/cursando.php"><img src="../assets/cursando.svg" alt="cursando" title="Cursando"></a>
                <a class="item-navegacao" href="../scripts/php/logOut.php"><img src="../assets/profile.svg" alt="cadastro" title="Cadastro"></a>
            </nav>
        </div>
    </header>

    <body>
        <main>
            <div class="container-novo-curso">
            </div>

            <div class="container row" id="contPrincipal">
            </div>
        </main>
    </body>

    <footer class="text-center py-2 fixed-bottom" id="footer">
        SPEAK - Solidarity Platform for Education and Access to Knowledge @Copyright 2023. Todos os direitos reservados.
    </footer>
</html>