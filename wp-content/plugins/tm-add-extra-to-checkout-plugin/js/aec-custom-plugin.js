document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.getElementById('tmCheckbox');
    const textField = document.getElementById('tmTesto');

    // Imposta lo stato iniziale
    textField.disabled = !checkbox.checked;

    // Aggiungi l'evento change al checkbox
    checkbox.addEventListener('change', function () {
        textField.disabled = !this.checked;
    });
});