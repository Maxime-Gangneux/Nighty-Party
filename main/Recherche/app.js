function Ouvrir_container_code(){
    var container = document.getElementById("container_code");
    if (container.style.right === "-12vw") {
        container.style.right = "0";
    }else {
        container.style.right = "-12vw";
    }
    console.log("ma bite")
}