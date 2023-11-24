<?php
    include_once __DIR__ . "/../../conexao.php";
    include_once __DIR__ . "/../../UsuarioEntidade.php";

    $conn = new Conexao();
    
    session_start();

    $idUsuario = $_SESSION["usuario"]->getId();
    $idCurso = $_POST["idCurso"];

    $sql = "SELECT curso.usuarioResponsavel FROM curso WHERE idCurso = $idCurso";
    $stmt = $conn->conexao->prepare( $sql );

    $resultado = $stmt->execute();

    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
        $idUsuarioResponsavel = $rs->usuarioResponsavel;

        $sqlInsert = "INSERT INTO usuario_cursando (Curso_idCurso, Curso_usuarioResponsavel, Usuario_idUsuario)
            VALUES ($idCurso, $idUsuarioResponsavel, $idUsuario);";

        $stmtInsert = $conn->conexao->prepare($sqlInsert);

        try {
            $resultadoInsert = $stmtInsert->execute();
            header('Content-Type: application/json');
            echo json_encode(["status" => "Inscrição feita com sucesso!"]);
            exit();
        } catch (PDOException $e) {
            header('Content-Type: application/json');
            echo json_encode(["status" => "Você já está inscrito neste curso."]);
            exit();
        }
    }
?>