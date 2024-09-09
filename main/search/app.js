function RedirectPageSoiree(element) {
    const idSoiree = element.getAttribute('data-id');
    const url = `../soiree/index.php?id_soiree=${idSoiree}`;
    window.location.href = url;
}

document.addEventListener('DOMContentLoaded', () => {
    const likes = document.querySelectorAll('.like');

    likes.forEach((like) => {
        let isFavorite = like.classList.contains('liked');
        const userId = like.getAttribute('data-user-id'); // Récupérer l'ID utilisateur

        like.addEventListener('click', () => {
            // Si l'utilisateur n'est pas connecté, afficher un message ou ne rien faire
            if (!userId) {
                alert("Vous devez être connecté pour liker une soirée.");
                return;
            }

            isFavorite = !isFavorite;

            const idSoiree = like.getAttribute('data-id-soiree');
            const action = isFavorite ? 'add_favorite' : 'remove_favorite';

            // Changement visuel immédiat
            if (isFavorite) {
                like.classList.add('anim-like');
                like.classList.add('liked');
                like.style.backgroundPosition = 'right';
            } else {
                like.classList.remove('liked');
                like.style.backgroundPosition = 'left';
            }

            // Envoi de la requête AJAX
            fetch('../../BDD/ajouter_supprimer_favori.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id_soiree=${encodeURIComponent(idSoiree)}&action=${encodeURIComponent(action)}`
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                // Actions supplémentaires si nécessaire
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
        });

        like.addEventListener('animationend', () => {
            like.classList.remove('anim-like');
        });
    });
});


