<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOT Email</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite(['resources/css/app1.css', 'resources/js/app.js'])
</head>
<body>
    <main class="container">
        <div class="container__title">
            <h1>Buscando os E-mails, por favor aguarde.</h1>
        </div>
        <div class="loader">
            <div class="dot" style="--i:0;"></div>
            <div class="dot" style="--i:1;"></div>
            <div class="dot" style="--i:2;"></div>
            <div class="dot" style="--i:3;"></div>
            <div class="dot" style="--i:4;"></div>
            <div class="dot" style="--i:5;"></div>
            <div class="dot" style="--i:6;"></div>
            <div class="dot" style="--i:7;"></div>
            <div class="dot" style="--i:8;"></div>
            <div class="dot" style="--i:9;"></div>
            <div class="dot" style="--i:10;"></div>
            <div class="dot" style="--i:11;"></div>
        </div>
    </main>
    <script>
    $(document).ready(function () {
        console.log("Página carregada, iniciando o bot...");

        // Faz uma requisição AJAX para chamar a API que inicia o bot
        $.ajax({
            url: "http://127.0.0.1:8000/api/start",  // Ajuste se necessário
            type: "POST",
            success: function(response) {
                console.log(response.message);  // Exibe a resposta do servidor no console
            },
            error: function(xhr, status, error) {
                console.error("Erro ao iniciar o bot:", error); 
            }
        });
    });
    </script>
</body>
</html>
