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
    <link rel="stylesheet" href="../styles/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/header.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/chat.css">
    
    <script src="../scripts/JQuery-3.7.0/jquery-3.7.0.js"></script>
    <title>Chat</title>    
</head>
<header>
    <div class="conteiner-header">
        <img src="../assets/logo.svg" title="SPEAK" alt="logo SPEAK">
        <nav>
            <a class="item-navegacao" href="../index.php"><img src="../assets/home.svg" alt="home" title="Home"></a>
            <a class="item-navegacao" href="../pages/cursos.php"><img src="../assets/cursos.svg" alt="cursos" title="Cursos"></a>
            <a class="item-navegacao" href="../pages/cursando.php"><img src="../assets/cursando.svg" alt="cursando" title="Cursando"></a>
            <a class="item-navegacao" href="../scripts/php/logOut.php"><img src="../assets/profile.svg" alt="cadastro" title="Cadastro"></a>
        </nav>
    </div>
</header>

<body>
    <div class="chat">

    </div>
    
</body>

<footer class="text-center py-2 fixed-bottom" id="footer" >
    SPEAK - Solidarity Platform for Education and Access to Knowledge @Copyright 2023. Todos os direitos reservados.
</footer>
</html>

<!-- script carrega mensagens -->
<script>
    //recuperando idChat
    var idChat = localStorage.getItem("idChat");

    // Envie o valor para o servidor usando AJAX
    $.ajax({
        type: 'POST',
        url: '../scripts/php/carregarMensagens.php',
        data: { idChat: idChat },
        success: function(response) {
            $(".chat").html(response);
            console.log('Sucesso ao carregar mensagens.');
        },
        error: function(error) {
            console.error('Erro ao salvar mensagem:', error);
        }
    });
</script>

<!-- script carrega envio mensagem para dono curso -->
<script>
    //recuperando idChat
    idChat = localStorage.getItem("idChat");

    // Envie o valor para o servidor usando AJAX
    $.ajax({
        type: 'POST',
        url: '../scripts/php/carregarCampoEnvioMensagem.php',
        data: { idChat: idChat },
        success: async function(response) {
            await $("body").append(response); //adiciona as mensagens na div

            //funcao listener do botao de envio de mensagem
            function print(event){
                let mensagem = $("textarea").val();
                $("textarea").val("");

                if(mensagem.length > 0){
                    $.ajax({
                        type: 'POST',
                        url: '../scripts/php/salvaMensagem.php',
                        data: { idChat: idChat, conteudo: mensagem },
                        success: async function(response) {
                            console.log("Mensagem enviada.")
                        },
                        error: function(error) {
                            console.error('Erro na solicitação AJAX:', error);
                        }
                    });

                    $(".chat").append('<div class="mensagem">' + mensagem + '</div>')
                }
            }

            //adicionando listener
            $(".enviar-mensagem-button").on("click", print)
        },
        error: function(error) {
            console.error('Erro na solicitação AJAX:', error);
        }
    });
</script>