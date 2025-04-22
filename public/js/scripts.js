document.addEventListener('DOMContentLoaded', function () {
    validateCreateEventForm();
    deleteLogic();
    imagePreview();
    listUsersParticipants();
});

const validateCreateEventForm = () => {
    const form = document.querySelector('form[action="/events"]');
    if (!form) return;

    form.addEventListener('submit', function(e) {
        const image       = form.querySelector('#image');
        const title       = form.querySelector('#title');
        const date        = form.querySelector('#date');
        const city        = form.querySelector('#city');
        const privateFld  = form.querySelector('#private');
        const description = form.querySelector('#description');
        const itemsChecked = form.querySelectorAll('input[name="items[]"]:checked');

        let errors = [];

        if (!image.value)        errors.push('• Selecione uma imagem.');
        if (!title.value.trim()) errors.push('• Preencha o título do evento.');
        if (!date.value)         errors.push('• Escolha a data do evento.');
        if (!city.value.trim())  errors.push('• Preencha a cidade.');
        if (!privateFld.value)   errors.push('• Informe se o evento é privado.');
        if (!description.value.trim()) errors.push('• Adicione a descrição do evento.');
        if (itemsChecked.length === 0)  errors.push('• Marque ao menos um item de infraestrutura.');

        if (errors.length) {
            e.preventDefault();
            alert('Por favor, corrija os seguintes erros:\n\n' + errors.join('\n'));
        }
    });
}

const deleteLogic = () => {
    const deleteForms = document.querySelectorAll('.form-delete');

    deleteForms.forEach(deleteForm => {
        deleteForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const confirm = document.querySelector('.confirm-delete');
            confirm.style.display = 'flex';

            setTimeout(() => {
                confirm.style.opacity = '1';
            }, 10);

            const btnDelete = document.querySelector('.btn-confirm-delete');
            const btnCancel = document.querySelector('.btn-cancel-delete');

            btnDelete.addEventListener('click', function() {
                confirm.style.display = 'none';
                deleteForm.submit();
            })

            btnCancel.addEventListener('click', function() {
                confirm.style.display = 'none';
            })
        });
    });
}

const imagePreview = () => {
    const image = document.querySelector('.img-preview');
    const inputNewImage = document.querySelector('.from-control-file');

    if (!image || !inputNewImage) return;

    inputNewImage.addEventListener('change', function() {
        image.style.display = 'none';
    })
}

const listUsersParticipants = () => {
    const eventParticipants = document.querySelectorAll('.all-users-btn');
    const participants = document.querySelectorAll('.listUsers');

    eventParticipants.forEach((btn, index) => {
        btn.addEventListener('click', function() {
            const currentDisplay = window.getComputedStyle(participants[index]).display;
            if(currentDisplay == 'none'){
                participants[index].style.display = 'flex';
            } else {
                participants[index].style.display = 'none';
            }
        })
    })
}