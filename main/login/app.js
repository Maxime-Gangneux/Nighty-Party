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

const sign_in = document.getElementById('sign_in');
const login = document.getElementById('login');

function switchForms() {
    sign_in.style.left = (sign_in.style.left === '0') ? '50%' : '0';
    login.style.left = (login.style.left === '50%') ? '0' : '50%';
    sign_in.style.zIndex = (sign_in.style.zIndex === '0') ? '1' : '0';
    login.style.zIndex = (login.style.zIndex === '1') ? '0' : '50%';
}
