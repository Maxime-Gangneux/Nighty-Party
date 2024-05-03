function Ouvrir_container_code(){
    var container = document.getElementById("container_code");
    var txt = document.getElementById("texte_code")
    if (container.style.right === "-12vw") {
        container.style.right = "0";
        txt.style.display = "flex"

    }else {
        container.style.right = "-12vw";
        txt.style.display = "none"
    }
}