document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById('modal');
    const mHeader = document.getElementById('mHeader');
    const mBody = document.getElementById('mBody');
    const fecharBtn = document.getElementById('fecharBtn');
    const modalShadow = document.getElementById('modalShadow');

    if (fecharBtn) {
        fecharBtn.addEventListener('click', fecharModal);
    }
    if (modalShadow) {
        modalShadow.addEventListener('click', fecharModal);
    }

    function ativarModal(titulo, desc, tipo) {
        console.log("Tipo recebido:", tipo);
        switch (tipo) {
            case 'error':
                modal.style.animation = "modalIn .5s";
                modalShadow.style.animation = "msIn .5s";
                mHeader.style.backgroundColor = "#e90000";
                fecharBtn.style.backgroundColor = "#ffcece";
                mHeader.innerHTML = `<i class="fa fa-exclamation-triangle"></i> <p>${titulo}</p>`;
                mBody.innerHTML = `<p>${desc}</p>`;

                mHeader.style.fontSize = "32px";

                fecharBtn.addEventListener("mouseover", function() {
                    fecharBtn.style.backgroundColor = "#e90000";
                    fecharBtn.style.color = "#fff";
                });
                fecharBtn.addEventListener("mouseout", function() {
                    fecharBtn.style.backgroundColor = "#ffcece";
                    fecharBtn.style.color = "#000";
                });

                break;
            case 'normal':
                modal.style.animation = "modalIn .5s";
                modalShadow.style.animation = "msIn .5s";
                mHeader.style.backgroundColor = "#23af00";
                fecharBtn.style.backgroundColor = "#d8ffce";
                mHeader.innerHTML = `<i class="fa fa-info-circle"></i> <p>${titulo}</p>`;
                mBody.innerHTML = `<p>${desc}</p>`;

                mHeader.style.fontSize = "32px";

                fecharBtn.addEventListener("mouseover", function() {
                    fecharBtn.style.backgroundColor = "#23af00";
                    fecharBtn.style.color = "#fff";
                });
                fecharBtn.addEventListener("mouseout", function() {
                    fecharBtn.style.backgroundColor = "#d8ffce";
                    fecharBtn.style.color = "#000";
                });
                break;
            default:
                console.warn("Tipo de modal inválido:", tipo);
                return;
        }

        modal.style.display = "flex";
        modalShadow.style.display = "block";
    }

    function fecharModal() {
        modal.style.animation = "modalOut .5s";
        modalShadow.style.animation = "msOut .5s";

        setTimeout(() => {
            modal.style.display = "none";
            modalShadow.style.display = "none";
        }, 499);
    }

    // Torna ativarModal disponível globalmente para ser chamado no HTML
    window.ativarModal = ativarModal;
});
