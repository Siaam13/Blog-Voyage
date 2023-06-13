// // Fonction pour effectuer la recherche en temps réel
// function searchCategories() {
//     const searchInput = document.getElementById('search-input');
//     const searchResults = document.getElementById('search-results');
  
//     // Écouteur d'événement pour capturer la saisie de l'utilisateur
//     searchInput.addEventListener('input', function() {
//       const query = searchInput.value.trim();
  
//       if (query === '') {
//         // Effacer les résultats de la recherche si la barre de recherche est vide
//         searchResults.innerHTML = '';
//         return;
//       }
  
//       // Effectuer une requête AJAX avec fetch pour rechercher les catégories pertinentes
//       fetch('/category/search?query=' + encodeURIComponent(query))
//         .then(response => response.json())
//         .then(data => {
//           // Afficher les résultats de la recherche
//           searchResults.innerHTML = '';
  
//           data.forEach(category => {
//             const listItem = document.createElement('li');
//             listItem.textContent = category.name;
  
//             // Ajouter un écouteur d'événement pour gérer le clic sur une catégorie
//             listItem.addEventListener('click', function() {
//               // Rediriger vers la page d'affichage des articles correspondants à la catégorie
//               window.location.href = '/category/' + category.idCategory;
//             });
  
//             searchResults.appendChild(listItem);
//           });
//         })
//         .catch(error => {
//           console.error('Une erreur s\'est produite lors de la recherche de catégories:', error);
//         });
//     });
//   }
  
//   // Appeler la fonction pour initialiser la recherche des catégories
//   searchCategories();
  
