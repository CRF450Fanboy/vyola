function scrollToError() {
    var errorElement = document.getElementById("error");
    if (errorElement) {
        errorElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

document.getElementById("registerForm").onsubmit = function() {
    scrollToError();
    return false; // Per evitare l'invio del modulo
};