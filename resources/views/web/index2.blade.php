<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOT Email</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite(['resources/css/app2.css', 'resources/js/app.js'])
    
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <main class="container">
        <div class="container__central">
            <div class="container--info">
                <div class="container__title">
                    <h1>E-mails encontrados. <br>Planilha gerada com sucesso!</h1>
                </div>
            <a id="download-btn" href="#">
                <div class="container__button">
                    <p>Acesse sua planilha atualizada</p>
                </div>
            </a>
            <script>
                document.getElementById("download-btn").addEventListener("click", function(event) {
                    event.preventDefault();
                    
                    window.location.href = "/download-result";
                    
                    setTimeout(function(){
                        window.location.href = "/delete";
                    }, 1500);
                });
            </script>
            </div>
        <div class="container--buttons">
            <a id="home" href="/">
                <div class="container__return">
                    <p>Voltar ao inicio</p>
                </div>
            </a>
        </div>
        </div>  
    </main>
</body>
</html>