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
    <a href="../home/index.php" class="logo">Logo</a>
    <ul>
        <li><a href = "../search/index.php" >Search</a></li>
        <li><a href = "../my_party/index.php">My party</a></li>
        <li><a href = "../create_party/index.php">Create party</a></li>
        <li><a href = "../login/index.php" class = "login">Login</a></li>
    </ul>
    <img src="../../Image/menu.png" class="menu" alt="">
</header>
<script>
        const menu = document.querySelector(".menu")
        const nav = document.querySelector("header ul")
 
        menu.addEventListener("click",()=>{
        nav.classList.toggle("mobile_menu")
        })
</script>
'
?>