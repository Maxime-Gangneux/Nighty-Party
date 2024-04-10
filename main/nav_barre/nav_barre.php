<?php

echo
'
<style>
ul{
    display: flex;
    position: fixed;
    height: 10vh;
    margin: 0;
    left: 0;
    top: 0;
    width: 100%;
    list-style-type: none;
    align-items: center;
    justify-content: space-between;
    background-color: rgba(0, 0, 0, 0.9);
    border-bottom: 2px solid white;
}
li {
    display: flex;
    align-items: center;
    max-width: calc(100% / 4);
    flex-grow: 1;
}
li div, li a {
    position: absolute;
    display: inline-block;
    vertical-align: top;
    margin: 0 2vw;
}
li:nth-child(1){
    background-image: url(../../Image/accueil.png);
    background-size: contain;
    background-repeat: no-repeat;
    width: 1.3vw;
    height: 1.3vw;
}
li:nth-child(2){
    background-image: url(../../Image/icon_recherche.png);
    background-size: contain;
    background-repeat: no-repeat;
    width: 2.1vw;
    height: 2.1vw;
}
li:nth-child(3){
    background-image: url(../../Image/icon_soirée.png);
    background-size: contain;
    background-repeat: no-repeat;
    width: 1.4vw;
    height: 1.4vw;
}
li:nth-child(4){
    background-image: url(../../Image/icon_créer.png);
    background-size: contain;
    background-repeat: no-repeat;
    width: 1.4vw;
    height: 1.4vw;
}
.login{
    background-image: url(../../Image/login.png);
    background-size: contain;
    background-repeat: no-repeat;
    position: absolute;
    cursor: pointer;
    right: 5vw;
    width: 3vw;
    height: 3vw;
}
li>a{
    color: rgb(255, 255, 255);
    text-decoration: none;
    font-size: 1.6vw;
}

</style>
<ul id = "nav">
    <li><div></div><a href = "">Accueil</a></li>
    <li><div></div><a href = "">Recherches</a></li>
    <li><div></div><a href = "">Mes soirées</a></li>
    <li><div></div><a href = "zeub.php">Créer une soirée</a></li>
    <a href = "zeub.php" class = "login"></a>

</ul>
'
?>