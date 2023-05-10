// FONCTIONS
function onSubmitForm(event)
{
    // Stopper la soumission du formulaire
    event.preventDefault();

    // Récupérer les données du formulaire
    const form = event.currentTarget;
    const formData = new FormData(form);

    // Envoi des données au serveur
    const options = {
        method: 'POST',
        body: formData
    };

    const url = form.action;

    fetch(url, options)
    .then(function(response) {
        return response.json();
    })
    .then(function(data) {
        // console.log(data)
           // On efface les précédents messages d'erreurs
    document.querySelectorAll('p.error').forEach(error => error.remove());
    document.querySelector('p.succes')?.remove();

     // Traitement des erreurs
     if (data.errors) {
        for (const fieldName in data.errors) {
            const p = document.createElement('p');
            p.textContent = data.errors[fieldName];
            p.classList.add('error');
            const input = document.getElementById(fieldName);
            input.after(p);
        }
    }
    else if (data.success) {
        const p = document.createElement('p');
        p.textContent = data.success;
        p.classList.add('succes');
        form.before(p);
        form.reset();
        
    }
    })
}
    




// CODE PRINCIPAL
document.getElementById('contact-form').addEventListener('submit', onSubmitForm);