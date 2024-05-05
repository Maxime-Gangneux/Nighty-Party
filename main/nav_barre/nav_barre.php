<?php

echo
'

<style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
header{
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    padding: 30px 100px;
    display: flex;
    justify-content: space-between; 
    align-item: center;
    z-index: 3;
}
header .logo{
    color: white;
    font-weight: 700;
    text-decoration: none;
    font-size: 2em;
    text-transform: uppercase;
    letter-spacing: 2px;
}

header ul{
    display: flex;
    justify-content: center;
    align-items: center;
}
header ul li{
    list-style: none;
    margin-left: 50px;

}
header ul li a{
    text-decoration: none;
    padding: 6px 15px;
    color: white;
    border-radius: 20px;
}
header ul li a:hover{
    background: white;
    color: #2b1055;
}

header ul li a.active{
    background: white;
    color: #2b1055;
}

.input_soiree {
    background: white url("search_icon.png") no-repeat 1rem center;
    height: 0;
    width: 0;
    text-align: center;
    transition: all 1.5s ease-in-out; 
    z-index: 100;
    outline: none;
    margin-left: 20px;
    border: none;
}
.input_soiree::placeholder {
    color: black;
}

.input_soiree.active-search {
    height: 30px;
    width: 50vw;
    border: solid 2px black;

}

header ul li:nth-child(4) img{
    width: 3vw;
    height: 3vw;
}
header .menu{
    position: absolute;
    display: none;
    top: 5.5vh;
    right: 5vw;
    width: 35px;
}
header .mobile_menu{
    right: 0;
}

@media screen and (max-width: 900px){
    header{
        padding: 0;
    }
    header .logo{
        position: absolute;
        top: 50px;
        left: 50px;
        z-index: 2;
    }

    header .menu{
        display: block;
    }
    header ul{
        top: 0;
        right: -100%;
        position:absolute;
        display: flex;
        justiy-content: center;
        align-items: center;
        flex-direction: column ; 
        background-color: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px); 
        width: 100vw;
        height: 100vh;
        transition: all 0.5s ease;
    }
    header ul li{
        margin: 25px 0;
        font-size: 1.7em;
    }
    
}

</style>
<header>
    <a href="../home/index.php" class="logo" onclick="reset()" >Logo</a>
<<<<<<< Updated upstream

=======
    <form method="GET">
        <input type="input" name="main_search" id="input_soiree" class="input_soiree" placeholder="Rechercher une soirée" oninput = "verif_input_main()">
    </form>
>>>>>>> Stashed changes
    <ul>
        <form method="GET">
            <input type="input" name="main_search" id="input_soiree" class="input_soiree" placeholder="Rechercher une soirée" oninput = "verif_input_main()">
        </form>
        <li><a href = "../search/index.php" class="search" onclick="ajouter_active(this, event)">Search</a></li>
        <li><a href = "../my_party/index.php" onclick="ajouter_active(this, event)">My party</a></li>
        <li><a href = "../create_party/index.php" onclick="ajouter_active(this, event)">Create party</a></li>
        <li><a href = "../login/index.php" class = "" onclick="ajouter_active(this, event)">Login</a></li>
    </ul>
    <img src="../../Image/menu.png" class="menu" alt="">
</header>
<script>
const menu = document.querySelector(".menu")
const nav = document.querySelector("header ul")

menu.addEventListener("click",()=>{
nav.classList.toggle("mobile_menu")
})

function reset() {
    // Supprimer la classe "active" de tous les liens
    const links = document.querySelectorAll("header ul li a");
    links.forEach(link => {
        link.classList.remove("active");
    });

    // Supprimer également la classe "active" du logo lui-même
    const logo = document.querySelector(".logo");
    logo.classList.remove("active");

    const inputSoiree = document.getElementById("input_soiree");
    inputSoiree.classList.remove("active-search");

    // Effacer le lien actif du stockage local
    localStorage.removeItem("activeLink");
    localStorage.removeItem("inputSoireeActive"); 
}

document.addEventListener("DOMContentLoaded", function() {

    const inputSoireeActive = localStorage.getItem("inputSoireeActive");


    if (inputSoireeActive === "true") {
        document.getElementById("input_soiree").classList.add("active-search");
    }
});

function ajouter_active(link, event) {
    event.preventDefault();
    
    // Supprimer la classe "active" de tous les liens
    const links = document.querySelectorAll("header ul li a");
    links.forEach(link => {
        link.classList.remove("active");
    });

    // Ajouter la classe "active" au lien sur lequel on a cliqué
    link.classList.add("active");

    const inputSoiree = document.getElementById("input_soiree");
    if (link.classList.contains("search")) {
        inputSoiree.classList.add("active-search");
        localStorage.setItem("inputSoireeActive", "true"); 
    } else {
        inputSoiree.classList.remove("active-search");
        localStorage.removeItem("inputSoireeActive"); 
    }

    localStorage.setItem("activeLink", link.getAttribute("href"));

    setTimeout(() => {
        window.location.href = link.getAttribute("href");
    }, 100);
}

// Récupérer le lien actif du stockage local et le rétablir
document.addEventListener("DOMContentLoaded", function() {
    const activeLink = localStorage.getItem("activeLink");
    if (activeLink) {
        const link = document.querySelector(`header ul li a[href="${activeLink}"]`);
        if (link) {
            link.classList.add("active");
        }
    }
});
</script>
'
?>