
/* ***************************************************************
 * LORSQUE LE DOM EST DISPONIBLE
 * **************************************************************/

document.addEventListener('DOMContentLoaded', function() {

    /* ---- Variables DOM ---- */
    // const element = document.querySelector('select[id="domaines-intervention"]');

    /* ---- Initialisation de l' input domaines-intervation ---- */
    $('#domaines-intervention').select2({
        placeholder: "Sélectionnez une ou plusieurs catégories",
        allowClear: true
    });

});