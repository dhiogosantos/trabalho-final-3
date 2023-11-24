<?php
    include_once "../../conexao.php";
    include_once "../../UsuarioEntidade.php";

    session_start();

    $mensagensHtml = "";
    
    if($_SESSION["login"] == "1"){
        $idChat = $_POST["idChat"];

        $conn = new Conexao();

        $sql = "SELECT * FROM Mensagem WHERE Chat_id = ? ORDER BY idMensagem ASC;";
        $stmt = $conn->conexao->prepare( $sql );

        $stmt->bindParam(1, $idChat);

        $resultado = $stmt->execute();
        

        while ($mensagem = $stmt->fetch(PDO::FETCH_OBJ)) {
            $mensagensHtml = $mensagensHtml . '<div class="mensagem">' . $mensagem->conteudo . '</div>';
        }
    }
    else{
        header("Location: login.php");
    }

    echo $mensagensHtml;

    exit();
?> 