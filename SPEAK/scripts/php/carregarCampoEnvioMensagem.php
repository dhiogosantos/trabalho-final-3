<?php
    include_once "../../conexao.php";
    include_once "../../UsuarioEntidade.php";

    session_start();
    $usuario = $_SESSION["usuario"];
    $tipoPerfil = $usuario->getTipoPerfil();
    
    if($_SESSION["login"] == "1"){
        if($tipoPerfil == "professor"){
            $envioMensagemhtml = '<div class="fixed-bottom container-enviar-mensagem" style="margin-bottom: 50px !important;">
            <div class="conteiner-input-button-mensagem">
                <textarea name="" id="" cols="30" rows="3"></textarea>
                <input class="enviar-mensagem-button" type="button" value="Enviar">
            </div>
            </div>';
        
            echo "$envioMensagemhtml";
        }

        exit();
    }
    else {
        header("Location: login.php");
    }
?>