<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <title>Garage V.Parrot</title>
</head>
<?php include_once("header.php"); ?>
<?php include_once("Garage_StatusManager.php");?>
<body style="background-color: #EAEAEA";>
<?php include_once("myslide.php"); ?>

<?php 
    require_once("./FormContactManager.php");
?>
 <p><h2>Formulaire de contact : </h2></p>
                    <div class="row">
                        <div class="col-md-6">
                            <form action="Contact.php" method="post">
                                <label for="name" class="form-label" >Nom :</label>
                                <input type="text" class="form-control" id="name" name="name" required><br>

                                <label for="surname" class="form-label">Prénom :</label>
                                <input type="text" class="form-control" id="surname" name="surname" required><br>

                                <label for="email" class="form-label">Adresse e-mail :</label>
                                <input type="email" class="form-control" id="email" name="email" required><br>

                                <label for="phone" class="form-label">Numéro de téléphone :</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required><br>

                                <label for="message" class="form-label">Message :</label>
                                <textarea id="message" class="form-control" name="message" required>Bonjour, Je vous contact par rapport à l'annonce de : </textarea><br>

                                <button type="submit" class="btn btn-primary">Envoyer</button>
                                <?php 
                                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                                $Contact = New Contact(array('name'=> $_POST["name"],'surname'=> $_POST["surname"],'email'=> $_POST["email"],'phone'=> $_POST["phone"],'message'=> $_POST["message"]));
                                $FormContactManager= New FormContactManager();
                                $FormContactManager->create($Contact);
                                }
                                ?>
                        </div>
                    
                            </form>
                                <div class="col-md-6">    
                                    <div>
                                        <ul class="fa-ul" style="margin-left: 1.65em; font-size: 30px; margin-top: 80px;">
                                            <li class="mb-3">
                                            <span class="fa-li"><i class="fas fa-home"></i></span><span class="ms-2">Avenue joseph Duranton , 31000 TOULOUSE</span>
                                            </li>
                                            <li class="mb-3">
                                            <span class="fa-li"><i class="fas fa-envelope"></i></span><span class="ms-2">V.Parrot@gmail.com</span>
                                            </li>
                                            <li class="mb-3">
                                            <span class="fa-li"><i class="fas fa-phone"></i></span><span class="ms-2"> Accueil : 04.76.28.25.12</span>
                                            </li>
                                            <li class="mb-3">
                                            <span class="fa-li"><i class="fas fa-phone"></i></span><span class="ms-2">Atelier : 04.76.28.26.98</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div> 
                    </div> 
                    <?php if (isset($_SESSION["user"])){
                    if($_SESSION["user"]["role"] == "admin" || ($_SESSION["user"]["role"] == "employe")){
                    echo '<a href="./traitement-formulaire-contact.php"class="btn btn-success">voir les demandes de contact</a>';
                    }
                    }
                    ?>




<?php include_once("footer.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" ></script>
</body>

</html>