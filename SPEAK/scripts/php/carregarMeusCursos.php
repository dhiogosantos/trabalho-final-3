<?php
    include_once "../../conexao.php";
    include_once "../../UsuarioEntidade.php";

    session_start();
    $idUsuario = $_SESSION["usuario"]->getId();
    $cursos = [];
    
    if($_SESSION["login"] == "1"){
        $conn = new Conexao();

        $sql = "SELECT curso.idCurso, curso.titulo, usuario.nome as usuarioResponsavel, curso.usuarioResponsavel as idResponsavel, curso.descricao, chat.idChat as idChat
            FROM curso
            JOIN usuario ON curso.usuarioResponsavel = usuario.idUsuario
            JOIN chat ON curso.idCurso = chat.Curso_idCurso
            JOIN usuario_cursando ON Usuario_idUsuario = $idUsuario AND usuario_cursando.Curso_idCurso = curso.idCurso
            ORDER BY curso.idCurso ASC;";
        $stmt = $conn->conexao->prepare($sql);

        $resultado = $stmt->execute();

        while ($curso = $stmt->fetch(PDO::FETCH_OBJ)) {
            $cursoArray = [
                "idChat" => $curso->idChat,
                "titulo" => $curso->titulo,
                "idResponsavel" => $curso->idResponsavel,
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