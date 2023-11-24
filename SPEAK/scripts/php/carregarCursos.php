<?php
    include_once "../../conexao.php";

    session_start();

    $cursos = [];
    
    if($_SESSION["login"] == "1"){
        $conn = new Conexao();

        $sql = "SELECT curso.idCurso, curso.titulo, usuario.nome as usuarioResponsavel, curso.descricao
                FROM curso
                JOIN usuario ON curso.usuarioResponsavel = usuario.idUsuario
                ORDER BY curso.idCurso ASC;";
        $stmt = $conn->conexao->prepare( $sql );

        $resultado = $stmt->execute();

        while ($curso = $stmt->fetch(PDO::FETCH_OBJ)) {
            $cursoArray = [
                "idCurso" => $curso->idCurso,
                "titulo" => $curso->titulo,
                "usuarioResponsavel" => $curso->usuarioResponsavel,
                "descricao" => $curso->descricao
            ];

            array_push($cursos, $cursoArray);
        }
    }

    header('Content-Type: application/json');
    echo json_encode($cursos);

    exit();
?> 