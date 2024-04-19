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
