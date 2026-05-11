/* **************************************************************************
 * LORSQUE LE DOM EST CHARGE
 * *************************************************************************/
document.addEventListener('DOMContentLoaded', function () {
    /* ---- VARIABLES DOM ---- */
    const selectType = document.querySelector('#type');
    const dateDuJourBloc = document.querySelector('#date_du_jour_bloc');
    const periodeDateBloc = document.querySelector('#periode_date_bloc');
    const contenu = document.querySelector('textarea[id="contenu"]');

    // Sécurité : si un élément manque, on stoppe
    if (!selectType || !dateDuJourBloc || !periodeDateBloc) {
        return;
    }

    // Fonction d'affichage
    function toggleDateBloc(type) {
        if (type === 'journalier') {
            dateDuJourBloc.style.display = 'block';
            periodeDateBloc.style.display = 'none';
        } else {
            dateDuJourBloc.style.display = 'none';
            periodeDateBloc.style.display = 'flex';
        }
    }

    // État initial (au chargement)
    toggleDateBloc(selectType.value);
    contenu.value = evenement.contenu;

    // Changement du select
    selectType.addEventListener('change', function (e) {
        toggleDateBloc(e.target.value);
    });

});





