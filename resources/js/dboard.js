// GET ADDRESS
var eyeSlashAddressIcon = document.getElementById('eye-slash-address');
var addressContentSpan = document.getElementById('address-content');
var isAddressVisible = false;

eyeSlashAddressIcon.addEventListener('click', function() {
    if (!isAddressVisible) {
        fetch('/get-address')
            .then(response => response.json())
            .then(data => {
                addressContentSpan.textContent = data;
                isAddressVisible = true;
                eyeSlashAddressIcon.classList.remove('fa-eye-slash');
                eyeSlashAddressIcon.classList.add('fa-eye');
            })
            .catch(error => console.error('Errore durante il recupero dell\'indirizzo:', error));
    } else {
        addressContentSpan.textContent = '**************';
        isAddressVisible = false;
        eyeSlashAddressIcon.classList.remove('fa-eye');
        eyeSlashAddressIcon.classList.add('fa-eye-slash');
    }
});

// GET EMAIL
var eyeSlashEmailIcon = document.getElementById('eye-slash-email');
var emailContentSpan = document.getElementById('email-content');
var isEmailVisible = false;

eyeSlashEmailIcon.addEventListener('click', function() {
    if (!isEmailVisible) {
        fetch('/get-email')
            .then(response => response.json())
            .then(data => {
                emailContentSpan.textContent = data;
                isEmailVisible = true;
                eyeSlashEmailIcon.classList.remove('fa-eye-slash');
                eyeSlashEmailIcon.classList.add('fa-eye');
            })
            .catch(error => console.error('Errore durante il recupero dell\'email:', error));
    } else {
        emailContentSpan.textContent = '*************';
        isEmailVisible = false;
        eyeSlashEmailIcon.classList.remove('fa-eye');
        eyeSlashEmailIcon.classList.add('fa-eye-slash');
    }
});