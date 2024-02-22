// funzione che previene l'invio di due form consecutivi disabilitando il pulsante submit
document.addEventListener("DOMContentLoaded", function() {
    var formSubmitted = false;
  
    document.getElementById("form").addEventListener("submit", function() {
        if (formSubmitted) {
            return false;
        } else {
            formSubmitted = true;
            document.getElementById("submitButton").disabled = true;
        }
    });
});