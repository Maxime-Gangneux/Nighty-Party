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
    z-index: 999;
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

header ul li:nth-child(4) img{

    width: 3vw;
    height: 3vw;
}


</style>
<header>
    <a href="../Acceuil/index.php" class="logo">Logo</a>
    <ul>
        <li><a href = "../Recherche/index.php" >Search</a></li>
        <li><a href = "">My party</a></li>
        <li><a href = "../creer/index.php">Create party</a></li>
        <li><a href = "../login/index.php" class = "login">Login</a></li>
    </ul>

</header>
'
?>