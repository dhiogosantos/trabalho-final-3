<?php
    include_once "../../conexao.php";
    include_once "../../UsuarioEntidade.php";

    session_start();
    $usuario = $_SESSION["usuario"];
    $tipoPerfil = $usuario->getTipoPerfil();
    
    if($_SESSION["login"] == "1"){
        if($tipoPerfil == "professor"){
            $botaoNovoCurso = '<button type="button" class="btn btn-outline-success" id="addCursoBtn" href="../pages/cadastroCurso.php" >Novo curso</button>';
        
            echo "$botaoNovoCurso";
        }

        exit();
    }
    else {
        header("Location: login.php");
    }
?>