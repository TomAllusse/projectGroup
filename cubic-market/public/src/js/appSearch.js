document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('shopSearch');
    const productDiv = document.querySelector('.product-container-div');
    const page = document.querySelector('title');
    const nameValue = page.getAttribute('name');
    console.log(nameValue);
    searchInput.addEventListener('input', function() {
        const query = this.value;

        // Appel AJAX vers un nouveau fichier PHP
        fetch('./includes/ajax_search.php?q=' + encodeURIComponent(query) + '&&p=' + encodeURIComponent(nameValue))
            .then(response => response.text())
            .then(html => {
                // On remplace le contenu de la div .cloth par les nouveaux résultats
                productDiv.innerHTML = html;
            })
            .catch(error => console.error('Erreur de recherche:', error));
    });
});