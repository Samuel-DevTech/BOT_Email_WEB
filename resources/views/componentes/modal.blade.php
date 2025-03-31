<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/modal.css','resources/js/modal.js'])
</head>
<body>
    <div class="modal" id="modal">
        <header class="mHeader" id="mHeader">
            <i class="fa fa-exclamation-triangle"></i>
            <p>Erro!</p>
        </header>
        <div class="mBody" id="mBody">
            <p>Insira o arquivo antes de prosseguir</p>
        </div>
        <footer>
            <button id="fecharBtn">Fechar</button>
        </footer>
    </div>
    <div class="modalShadow" id="modalShadow">
    </div>
    <!-- <button onclick="ativarModal('Erro', 'Insira a planilha antes de prosseguir', 'error')">Ativar Modal</button> -->
</body>
</html>