<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOT Email</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <main class="container">
        <div class="container__title">
            <h1>BEM VINDO</h1>
        </div>
        <div class="container__mensage">
            <p>Insira abaixo o Excel contendo os nomes para a pesquisa</p>
        </div>

        <!-- Área de arrastar e soltar -->
        <div class="container--drop">
            <img src="{{ asset('midia/Ícone.png') }}" height="90">
            <div class="container__txt">
                <b>Arraste e solte o arquivo</b>
                <p>ou</p>
            </div>
            <div class="container--button">
                <label for="file-input" style="cursor: pointer;">Procurar no Dispositivo</label>
            </div>
            <input type="file" id="file-input" class="file-input" accept=".xlsx, .xls, .csv">
            <span class="container--delete">❌</span>
        </div>

        <!-- Botão de envio -->
        <div class="container--send">
            <button id="start-button">Iniciar</button>
        </div>        
    </main>

    <script>
        // Função para enviar o arquivo
        document.getElementById("start-button").addEventListener("click", function(event) {
            event.preventDefault();

            let fileInput = document.getElementById('file-input');
            let file = fileInput.files[0];

            if (!file) {
                alert("Selecione um arquivo primeiro!");
                return;
            }

            let formData = new FormData();
            formData.append('file', file);

            fetch('/upload-file', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message); // Exibe a resposta
            })
            .catch(error => {
                console.error("Erro no upload:", error);
            });
        });
    </script>
</body>
</html>
