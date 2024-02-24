
// Controllo nell'nserimento della partita IVA nel form
document.addEventListener('DOMContentLoaded', function() {
    const vat_number = document.getElementById('vat_number');

    vat_number.addEventListener('input', function() {
        let vat_number = this.value.replace(/\D/g, ''); // Rimuovi tutti i caratteri non numerici

        if (vat_number.length > 11) {
            vat_number = vat_number.slice(0, 11); // Limita il numero di caratteri a 11
        }

        if (!vat_number.startsWith('IT')) {
            vat_number = 'IT' + vat_number; // Se l'utente cerca di selezionare il IT ed eliminarlo viene re-inserito
        }

        this.value = vat_number;

    });

    vat_number.addEventListener('keydown', function(event) {
        if (event.key === 'Backspace' && this.selectionStart === 2 && this.value.length === 2) {
            event
        .preventDefault(); // Impedisci la rimozione del prefisso "IT" se il cursore si trova subito dopo il prefisso
        }
    });
});


// Controllo nell'inserimento del numero di telefono

document.addEventListener('DOMContentLoaded', function() {
    const phone_number = document.getElementById('phone_number');

    phone_number.addEventListener('input', function() {
        let phoneNumber = this.value.replace(/[^+\d]/g,''); // Rimuovi tutti i caratteri non numerici

        if (phoneNumber.length > 13) {
            phoneNumber = phoneNumber.slice(0, 13); // Limita il numero di caratteri a 13
        }

        if (!phoneNumber.startsWith('+39')) {
            phoneNumber = '+39' + phoneNumber; // Se l'utente cerca di selezionare il +39 ed eliminarlo viene re-inserito
        }

        this.value = phoneNumber;
        console.log(phoneNumber);
    });

    phone_number.addEventListener('keydown', function(event) {
        if (event.key === 'Backspace' && this.selectionStart === 3 && this.value.length === 3) {
            event.preventDefault(); // Impedisci la rimozione del prefisso "+39" se il cursore si trova subito dopo il prefisso
        }
    });
});


//funzione per rimuovere anteprima immagine
// const deleteImageButton = document.getElementById('delete-img-btn')

// deleteImageButton.addEventListener('click', function(event) {
//     event.preventDefault();
//     previewImgElem.remove();
// }) 

// inserimento della img preview nel form
const previewImgElem = document.getElementById('preview-img');

const image = document.getElementById('image');

if(image) {
    image.addEventListener('change', function() {
        const selectedFile = this.files[0];
        console.log(selectedFile);
        if(selectedFile) {
            const reader = new FileReader();
            reader.addEventListener("load", function() {
                previewImgElem.src = reader.result;
                previewImgElem.style.display = '';
            })
            reader.readAsDataURL(selectedFile);
        }
    })
}


document.getElementById('delete-img-btn').addEventListener('click', function() {
    const imageInput = document.getElementById('image');
    const previewImgElem = document.getElementById('preview-img');
    imageInput.value = '';
    previewImgElem.src = '';
    previewImgElem.style.display = 'none';
});