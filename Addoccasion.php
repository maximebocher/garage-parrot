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
<?php include_once("Garage_StatusManager.php");?>
<body style="background-color: #EAEAEA";>
<?php include_once("myslide.php"); ?>
<?php require_once("./CarManager.php");?>


<div class="container mt-5">
    <h2 class="mb-4">Création de Fiche pour un Véhicule d'Occasion</h2>

    <form action="Addoccasion.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Marque :</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Modèle :</label>
            <input type="text" class="form-control" id="type" name="type" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Prix :</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>

        <div class="mb-3">
            <label for="km" class="form-label">Kilométrage :</label>
            <input type="number" class="form-control" id="km" name="km" required>
        </div>

        <div class="mb-3">
            <label for="year" class="form-label">Année de Mise en Circulation :</label>
            <input type="number" class="form-control" id="year" name="year" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description :</label>
            <textarea id="description" class="form-control" id="description" name="description" required></textarea><br>
        </div>
        <div class="mb-3">
            <label for="files" class="form-label">Sélectionner des fichiers :</label>
            <input type="file" id="fileToUpload" class="form-control" name="fileToUpload[]" multiple><br><br>
        </div>
        <button type="submit" class="btn btn-primary">Créer la Fiche</button>
        <?php 
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $CarManager= New CarManager();
                if (isset($_POST["name"])){
                $Car = New Car(array('name'=> $_POST["name"],'type'=> $_POST["type"],'price'=> $_POST["price"],'km'=> $_POST["km"],'year'=> $_POST["year"],'description'=> $_POST["description"]));
                $carId=$CarManager->create($Car);
                }
                //insertion de fichier image pour chaque annonce deposer
                $target_dir = "image/car-pictures/";
                mkdir($target_dir.$carId, 0777, true);
                            $target_dir=$target_dir.$carId."/";
                for ($i = 0; $i <= count($_FILES["fileToUpload"]["name"])-1; $i++){
                        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$i]);
                            if($check !== false) {
                                echo "File is an image - " . $check["mime"] . ".";
                                $uploadOk = 1;
                            } else {
                                echo "File is not an image.";
                                $uploadOk = 0;
                            }
                            // Verifier si le fichier est deja existant
                            if (file_exists($target_file)) {
                                echo "Sorry, file already exists.";
                                $uploadOk = 0;
                            }
                            
                            // Verifier la taille de l'image
                            if ($_FILES["fileToUpload"]["size"][$i] > 500000) {
                                echo "Sorry, your file is too large.";
                                $uploadOk = 0;
                            }
                            
                            // Laisser disponible que certain format d'image
                            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                            && $imageFileType != "gif" ) {
                                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                $uploadOk = 0;
                            }
                            
                            // Verifier si l'upload se fait bien par le biais d'une erreur 
                            if ($uploadOk == 0) {
                                echo "Sorry, your file was not uploaded.";
                            // Si tout est ok on upload
                            } else {
                                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {
                                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"][$i])). " has been uploaded.";
                                $CarManager->createPicture($_FILES["fileToUpload"]["name"][$i],$carId);
                                } else {
                                echo "Sorry, there was an error uploading your file.";
                                }
                            }
                        }
                }             

            
?>
    </form>
    
</div>






<?php include_once("Footer.php"); ?>
<?php require("./LoginManager.php");?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" ></script>
</body>

</html>