       // Fonction pour ouvrir/fermer le conteneur du code de la soirée
       function Ouvrir_container_code() {
        var container = document.getElementById("container_code");
        var txt = document.getElementById("texte_code");
        // Si le conteneur est fermé
        if (container.style.right === "-16vw") {
            // Ouvrir le conteneur et afficher le texte
            container.style.right = "0vw";
            container.style.height = "20vh";
            txt.style.opacity = "1";
        } else {
            // Fermer le conteneur et masquer le texte
            container.style.right = "-16vw";
            container.style.height = "5vh";
            txt.style.transitionDuration = "0.5s";
            txt.style.opacity = "0";
        }
    }

