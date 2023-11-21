
<header>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #df5b5b;">
    <div class="container-fluid">
    <a class="navbar-brand" href="./Index.php">
    <img src="./image/logogarage1.png" width="100" alt="logo garage V.parot">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <span class="navbar-text" style = "font-weight : bold" >
        <h1 class="display-3">GARAGE V.PARROT</h1>
    </span>
    <?php 
        session_start();
    ?>
 
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href=<?php
            if(isset ($_SESSION["user"]["role"])){
                if($_SESSION["user"]["role"] == "admin"){
                    echo "./IndexAdmin.php";
                }else{
                echo "./Index.php";
                }
            }else{
            echo "./Index.php";
            } ?> id="accueil">Accueil</a>
        </li>
    
        <li class="nav-item">
            <a class="nav-link" href="./Nosoccasions.php" id="occasion">Nos occasions</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="./Contact.php" id="contact">Nous contacter</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./Avis.php" id="avis">Votre avis</a>
        </li>
    </ul>
    <?php 
    
    if(isset($_SESSION["user"]))
    {
        echo "<form action=\"Login.php\"><button onclick=\"disconnect()\">Se deconnecter </button></form>";
        echo"<p>bienvenue à vous </p>";
        if($_SESSION["user"]["role"] == "admin"){
        }
        elseif($_SESSION["user"]["role"] == "employe"){
        }
        echo $_SESSION["user"]["role"];
    }else{
        include_once("Login-form.php");
    }
    if (isset($_GET["me"])){
        echo "<p>le mot de passe est incorrect</p>";
    }
    function disconnect(){
        $_SESSION["user"] =null;
        echo"disconnected";
    }
    ?>
    </div>
    </div>
    </div>
    </nav>
</header>
<script>
    // Récupérer le nom de la page actuelle
    let currentPage = window.location.href;
    
    // Vérifier si la page actuelle correspond à une page du menu
    if (currentPage.includes("Index.php")) {
        document.getElementById("accueil").classList.add("active");
    } else if (currentPage.includes("Services.php")) {
        document.getElementById("services").classList.add("active");
    } else if (currentPage.includes("Nosoccasions.php")) {
        document.getElementById("occasion").classList.add("active");
    } else if (currentPage.includes("Contact.php")) {
        document.getElementById("contact").classList.add("active");
    } else if (currentPage.includes("Avis.php")) {
        document.getElementById("avis").classList.add("active");
    }
</script>
