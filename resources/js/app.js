$(document).ready(function () {
    // Código para manipulação do drag and drop
    const $fileInput = $('.file-input');
    const $droparea = $('.container--drop');
    const $delete = $('.container--delete');

    // Adiciona classe ao interagir com o input de arquivo
    $fileInput.on('dragenter focus click', function () {
        $droparea.addClass('is-active');
    });
    $fileInput.on('dragleave blur drop', function () {
        $droparea.removeClass('is-active');
    });
    $fileInput.on('change', function () {
        let filesCount = $(this)[0].files.length;
        let $textContainer = $('.container__txt');
        if (filesCount === 1) {
            let fileName = $(this).val().split('\\').pop();
            $textContainer.html(`<b>${fileName}</b>`);
            $delete.show();
        } else {
            $textContainer.html('<b>Arraste e solte o arquivo</b><p>ou</p>');
            $delete.hide();
        }
    });
    $delete.on('click', function () {
        $fileInput.val(null);
        $('.container__txt').html('<b>Arraste e solte o arquivo</b><p>ou</p>');
        $(this).hide();
    });
    $droparea.on('dragover', function (e) {
        e.preventDefault();
        $droparea.addClass('is-active');
    });
    $droparea.on('drop', function (e) {
        e.preventDefault();
        $droparea.removeClass('is-active');
        let files = e.originalEvent.dataTransfer.files;
        if (files.length > 0) {
            $fileInput.prop('files', files);
            $fileInput.trigger('change');
        }
    });

    // Lógica para envio do arquivo e exibição do modal
    $("#start-button").on("click", function (event) {
        event.preventDefault();

        let file = $("#file-input")[0].files[0];

        // Se não houver arquivo, exibe modal de erro
        if (!file) {
            ativarModal("Erro!", "Selecione um arquivo antes de prosseguir.", "error");
            return;
        }

        // Se houver arquivo, realiza o upload
        let formData = new FormData();
        formData.append('file', file);

        fetch('/upload-file', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Exibe modal de sucesso
            ativarModal("Sucesso!", "Arquivo recebido com sucesso", "normal");

            // Aguarda o usuário clicar no botão de fechar para redirecionar
            $("#fecharBtn").one("click", function() {
                window.location.href = '/loading';
            });
        })
        .catch(error => {
            console.error("Erro no upload:", error);
            ativarModal("Erro!", "Ocorreu um erro ao enviar o arquivo.", "error");
        });
    });
});
