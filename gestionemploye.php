<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">



    <title>Garage V.Parrot</title>
</head>
<?php include_once("Header.php"); ?>
<body style="background-color: #EAEAEA";>
<?php include_once("myslide.php"); ?>
<?php include_once("OpinionManager.php")?>
<?php include_once("Garage_StatusManager.php");?>
<?php require_once("./LoginManager.php");?>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $loginManager = new LoginManager();
    $loginManager->createEmploye($_POST["name"],$_POST["forename"],$_POST["email"],$_POST["password"],"employe");
}
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Création de compte employé</h2>

            <form action="gestionemploye.php" method="post" class="p-4 border rounded shadow">
                <div class="mb-3">
                    <label for="name"class="form-label">Nom :</label>
                    <input type="text" id="name" name="name" require_onced><br>
                </div>

                <div class="mb-3">
                    <label for="forename" class="form-label">Prénom :</label>
                    <input type="text" id="forename" name="forename" require_onced><br>
                </div>

                <div class="mb-3">
                    <label for="email" class="class form-label">Adresse e-mail :</label>
                    <input type="email" id="email" name="email" require_onced><br>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe :</label>
                    <input type="password" id="password" name="password" require_onced><br>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Rôle : employé</label>
                </div>

                <input type="submit" class="btn btn-primary" value="Créer employé">
            </form>
        </div>
    </div>    
</div>

<?php include_once("Footer.php");?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" ></script>
</body>

</html>