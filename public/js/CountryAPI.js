async function loadCountries() {
    try {
        const response = await fetch('https://restcountries.com/v3.1/name/{name}');
        const countries = await response.json();
        const countrySelect = document.getElementById('country');

        countries.forEach(country => {
            const option = document.createElement('option');
            option.value = country.cca2.toLowerCase(); // Utilisez le code à 2 lettres du pays
            option.textContent = country.name.common; // Utilisez le nom commun du pays
            countrySelect.appendChild(option);
        });
    } catch (error) {
        console.error('Erreur lors de la récupération des pays :', error);
    }
}

// Chargez la liste des pays au chargement de la page
loadCountries();


