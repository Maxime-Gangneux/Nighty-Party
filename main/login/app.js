document.addEventListener("DOMContentLoaded", function() {
    // Votre code JavaScript ici
    const spheres = document.querySelectorAll(".spherelumineuse");

    function getRandomPosition() {
        const windowHeight = window.innerHeight;
        const windowWidth = window.innerWidth;
        const sphereSize = 100; // Taille de chaque sphère (en supposant une taille de 100px)
        const maxPosX = windowWidth - sphereSize; // Position maximale en X sans toucher les bords
        const maxPosY = windowHeight - sphereSize; // Position maximale en Y sans toucher les bords
        const randomX = Math.floor(Math.random() * maxPosX);
        const randomY = Math.floor(Math.random() * maxPosY);
        return { x: randomX, y: randomY };
    }

    function moveSpheres() {
        spheres.forEach(sphere => {
            const newPosition = getRandomPosition();
            sphere.style.left = newPosition.x + "px";
            sphere.style.top = newPosition.y + "px"; 
        }); 
    }

    setInterval(moveSpheres, 5000); // Changez la durée pour ajuster la vitesse du mouvement
});

let rota = 0;

function switchForms() {
    const sign_in = document.getElementById('sign_in');
    const login = document.getElementById('login');
    

    sign_in.style.left = (sign_in.style.left === '100%') ? '50%' : '100%';
    login.style.left = (login.style.left === '50%') ? '0' : '50%';

    if (rota === 0) {
        rota = 1;
        sign_in.style.zIndex = '0';
        setTimeout(() => {
            login.style.zIndex = '1'
        }, 999);
    }
    else {
        rota = 0;
        login.style.zIndex = '0'
        setTimeout(() => {
            sign_in.style.zIndex = '1';
        }, 999);
    }
}

