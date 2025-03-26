$(document).ready(function () {
    const $fileInput = $('.file-input');
    const $droparea = $('.container--drop');
    const $delete = $('.container--delete');

    // Adiciona classe ao arrastar ou interagir com o arquivo
    $fileInput.on('dragenter focus click', function () {
        $droparea.addClass('is-active');
    });

    // Remove a classe ao sair
    $fileInput.on('dragleave blur drop', function () {
        $droparea.removeClass('is-active');
    });

    // Atualiza a exibição quando um arquivo é selecionado
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

    // Limpar campo ao clicar no botão de excluir
    $delete.on('click', function () {
        $fileInput.val(null);
        $('.container__txt').html('<b>Arraste e solte o arquivo</b><p>ou</p>');
        $(this).hide();
    });

    // Arrastar e soltar
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

});
