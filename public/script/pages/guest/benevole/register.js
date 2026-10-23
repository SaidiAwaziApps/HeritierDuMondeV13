
/* **************************************************************************
 * METHODE CHARGEMENT DU FICHIER (IMAGE) 
 * **************************************************************************/
function onSelectFile(e){
    
    const fileReader = new FileReader();

    fileReader.onload = function(e){
        
        const photoCircle = document.querySelector('.photo-circle');

        const image = document.createElement('img');
    
        image.setAttribute('class', 'rounded-circle');

        image.style.width = '100%';
        image.style.height = '100%';

        image.setAttribute('src', e.target.result);

        photoCircle.innerHTML = '';
        photoCircle.appendChild(image);
        
    }

    fileReader.readAsDataURL(e.target.files[0]);
}


/* ***************************************************************
 * LORSQUE LE DOM EST DISPONIBLE
 * **************************************************************/

document.addEventListener('DOMContentLoaded', function() {

    /* ---- Variables DOM ---- */
    const voluntersRegisterForm = document.querySelector('#volunters-register-form');
    const photoInput = document.querySelector('input[id="photo"]');
    const successToast = document.getElementById('successToast');
    const errorToast = document.getElementById('errorToast');

    /* ---- Applique le multiselect avec select2 a domaines-intervation ---- */
    $('#domaines-intervention').select2({
        placeholder: "Sélectionnez une ou plusieurs catégories",
        allowClear: true
    });

    /* ---- Au moment de chargement du fichier ---- */
    photoInput.onchange = (e) => {
        onSelectFile(e);
    }


    // Afficher le toast de succès
    if(successToast || errorToast) { 
        new bootstrap.Toast(successToast ? successToast : errorToast, {
            delay: 10000,
            autohide: true
        }).show();
    }

    /* ---- Au moment de la soumission du formulaire ---- */
    voluntersRegisterForm.onsubmit = (e) => {
        e.preventDefault();

        if(document.querySelector('input[name="sexe"]:checked')) {
           e.currentTarget.submit();
           
           return;
        }

        Swal.fire({
            text: 'Veuillez specifier le sexe !!!',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'red',
            cancelButtonText: 'Cancel',
        });
    }

});