/* ***************************************************************
 * LORSQUE LE CONTENU DOM EST CHARGE
 * **************************************************************/
document.addEventListener('DOMContentLoaded', function() {
    $('#articles_list_table ').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/fr-FR.json'
        }
    });  
});