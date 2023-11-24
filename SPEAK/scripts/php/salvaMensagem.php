<?php
    include_once "../../conexao.php";

    session_start();
    
    $resposta = "";

    if($_SESSION["login"] == "1"){
        $idChat = $_POST["idChat"];
        $conteudo = $_POST["conteudo"];

        $conn = new Conexao();

        $sql = 'INSERT INTO mensagem (conteudo, Chat_id) VALUES (?, ?)';
        $stmt = $conn->conexao->prepare( $sql );

        $stmt->bindParam(1, $conteudo);
        $stmt->bindParam(2, $idChat);

        $resultado = $stmt->execute();

        echo $conteudo;
    }
    else{
        header("Location: login.php");
    }

    echo $resposta;

    exit();
?> 