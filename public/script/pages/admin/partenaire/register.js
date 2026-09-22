/* ***************************************************************
 * LORSQUE LE DOM EST CHARGE
 * **************************************************************/
document.addEventListener('DOMContentLoaded', function() {

    /* ---- Variables DOM ---- */
    const partnerForm = document.querySelector('.partner-form');
    const logoInput   = document.querySelector('input[name="logo"]');
    const logoImgName = document.querySelector('span[id="logo-img-name"]');

    /* ---- Upload Image (logo) ---- */
    logoInput.onchange = function(e) {
       logoImgName.innerHTML = e.target.files[0].name;
    }

    /* ---- Soumission du formulaire ---- */
    partnerForm.onsubmit = function(e) {
        e.preventDefault();

        // Presence du fichier (logo)
        if(logoInput.value) {
            e.currentTarget.submit();
            return;
        }

        // Logo absent
        Swal.fire({
            // title: 'Echec de validation du formulaire',
            text: 'Veuillez inserer un logo !!!',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'red',
            cancelButtonText: 'Cancel',
        });
        
    }
});