function Back() {
    window.history.back();
}

function openCalendar(title, location, date, startTime, endTime) {
    const startDate = `${date.replace(/-/g, '')}T${startTime.replace(/:/g, '')}00`;
    const endDate = `${date.replace(/-/g, '')}T${endTime.replace(/:/g, '')}00`;

    const userAgent = navigator.userAgent || navigator.vendor || window.opera;

    if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
        // iOS
        window.location.href = `calshow://?start=${startDate}&end=${endDate}`;
    } else if (/android/i.test(userAgent)) {
        // Android
        window.location.href = `content://com.android.calendar/time/${Date.parse(startDate)}`;
    } else {
        // Web-based fallback for desktop
        const url = `https://www.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(title)}&dates=${startDate}/${endDate}&location=${encodeURIComponent(location)}`;
        window.open(url, '_blank');
    }
}

function openMap(location, ville) {
    const encodedLocation = encodeURIComponent(location);
    const encodedVille = encodeURIComponent(ville);

    const userAgent = navigator.userAgent || navigator.vendor || window.opera;

    if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
        // Apple Maps
        window.location.href = `http://maps.apple.com/?q=${encodedLocation},${encodedVille}`;
    } else if (/android/i.test(userAgent)) {
        // Google Maps
        window.location.href = `geo:0,0?q=${encodedLocation},${encodedVille}`;
    } else {
        // Web-based fallback for desktop (Google Maps)
        const url = `https://www.google.com/maps/search/?api=1&query=${encodedLocation},${encodedVille}`;
        window.open(url, '_blank');
    }
}


let slideIndex = 1;
showSlides(slideIndex);

function plusSlide(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if (slides.length === 0) {
        return; // Si aucun slide, ne rien faire
    }
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
}
// Auto Slide 


function showPopUp() {

    document.getElementById('pop_up_boisson').style.display = "block";
    console.log('chut');
    localStorage.setItem('popUpState', 'visible');
}

function hidePopUp() {

    document.getElementById('pop_up_boisson').style.display = "none";

    localStorage.setItem('popUpState', 'hidden');
}

window.onload = function() {
    console.log('oui');
    var popUpState = localStorage.getItem('popUpState');
    if (popUpState === 'visible') {
        showPopUp();
    } else {
        hidePopUp();
    }
};


document.addEventListener("DOMContentLoaded", function() {
    var fileInputs = document.querySelectorAll('.add_image_input');

    fileInputs.forEach(function(input) {
        input.addEventListener('change', function() {
            var form = input.closest('form');
            form.submit();
        });
    });

    document.querySelector("form.container_mise_a_jour_complete").addEventListener("submit", function(event) {
        // Récupérer la nouvelle valeur de la description et la mettre à jour dans le champ caché
        document.getElementById("hidden_description").value = document.getElementById("description_soiree").innerText;
        document.getElementById("hidden_nom_soiree").value = document.getElementById("nom_soiree").innerText;
    });
    

    
}); 




function editElement_textarea(idelement) {
    const element = document.getElementById(idelement);
    const button_edit_textarea = document.getElementById("button_edit_textarea");
    const contenu = element.innerText;

    // Création du textarea
    const textarea = document.createElement("textarea");
    textarea.value = contenu;
    textarea.name = idelement;
    textarea.className = idelement;
    textarea.rows = 4; // Ajustez le nombre de lignes selon vos besoins
    textarea.cols = 50; // Ajustez le nombre de colonnes selon vos besoins

    // Remplacer l'élément par le textarea
    element.style.display = 'none'; // Masquer l'élément original
    button_edit_textarea.style.display = 'none';
    element.parentNode.insertBefore(textarea, element);

    // Quand le textarea perd le focus, le remplacer par le texte original
    textarea.addEventListener('blur', function() {
        element.innerText = textarea.value; // Revenir au texte original lors du blur
        element.style.display = 'block'; // Afficher l'élément original
        button_edit_textarea.style.display = 'block';
        element.parentNode.removeChild(textarea); // Supprimer le textarea
    });

    // Focus sur le nouveau textarea
    textarea.focus();
}

function editElement_input(idelement) {
    const element = document.getElementById(idelement);
    const button_edit_input = document.getElementById("button_edit_input");
    const contenu = element.innerText;

    // Création du input
    const input = document.createElement("input");
    input.value = contenu;
    input.name = idelement;
    input.className = idelement;
    // Remplacer l'élément par le input
    element.style.display = 'none'; // Masquer l'élément original
    button_edit_input.style.display = 'none';
    element.parentNode.insertBefore(input, element);

    // Quand le input perd le focus, le remplacer par le texte original
    input.addEventListener('blur', function() {
        element.innerText = input.value; // Revenir au texte original lors du blur
        element.style.display = 'block'; // Afficher l'élément original
        button_edit_input.style.display = 'block';
        element.parentNode.removeChild(input); // Supprimer le input
    });

    // Focus sur le nouveau input
    input.focus();
}





function redirection_js(){
    var inputBoisson = document.getElementById('inputBoisson').value;

    // Utilisation de jQuery pour la requête AJAX
    $.ajax({
        url: '../../BDD/boisson_apporte.php', // Le fichier PHP qui va traiter la requête
        type: 'GET',
        data: { input_boisson: inputBoisson },
        success: function(response) {
            // Optionnel : Vous pouvez ajouter du code ici si vous souhaitez traiter la réponse du serveur
            console.log("Requête envoyée avec succès");
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    });
}