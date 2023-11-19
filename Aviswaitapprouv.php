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
<?php require("./OpinionManager.php");?>

<div class="container">
    <form action="Aviswaitapprouv.php" method="post" class="mx-auto w-80">
        <div class="mb-3">
            <label for="name" class="form-label fw-bold fs-5">Votre nom :</label>
            <input type="text" class="form-control w-50" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label fw-bold fs-5">Votre commentaire :</label>
            <textarea class="form-control" id="comment" name="comment" required></textarea>
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label fw-bold fs-5">Votre note :</label>
            <div class="rating">
                <input type="radio" id="wrench5" name="rating" value="5">
                <label for="wrench5" title="5 clés">5<i class="fas fa-wrench"></i></label>
                <input type="radio" id="wrench4" name="rating" value="4">
                <label for="wrench4" title="4 clés">4<i class="fas fa-wrench"></i></label>
                <input type="radio" id="wrench3" name="rating" value="3">
                <label for="wrench3" title="3 clés">3<i class="fas fa-wrench"></i></label>
                <input type="radio" id="wrench2" name="rating" value="2">
                <label for="wrench2" title="2 clés">2<i class="fas fa-wrench"></i></label>
                <input type="radio" id="wrench1" name="rating" value="1">
                <label for="wrench1" title="1 clé">1<i class="fas fa-wrench"></i></label>
            </div>
        </div>  

            <button type="submit" class="btn btn-outline-dark">Laisser un témoignage</button>
            <?php 
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $OpinionManager= New OpinionMAnager();
                if (isset($_POST["comment"])){
                $Opinion = New Opinion(array('name'=> $_POST["name"],'comment'=> $_POST["comment"],'rating'=>$_POST["rating"]));
                $OpinionManager->create($Opinion);
                }
                
                if (isset($_POST["id"])){
                    $OpinionManager-> update($_POST["id"],$_POST["approved"]);
                    
                }
            }
            ?>
    </form>
    
    <?php
    $manager = new OpinionManager();
    $opinions = $manager->getAll();

    ?>
    <?php foreach ($opinions as $opinion): ?>
    <div class="card" style= "margin-bottom:20px; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h5 class="card-header" style= "background-color:  #df5b5b; color: #fff; "><?php echo $opinion->getName()?></h5>
        <div class="card-body" style="background-color: #EBEBEB;">
        <h5 class="card-title"> note : <?php echo $opinion->getRating()?></h5>
        <p class="card-text"><?php echo $opinion->getComment()?></p>
        <form action="Aviswaitapprouv.php" method="post">
        <input type="hidden" name="id" value="<?php echo $opinion->getId()?>">  
    <?php 
    if ($opinion->getApproved() == 0){
        echo "<button type=\"submit\" class=\"btn btn-primary\">approuvé</button>";
        echo "<input type=\"hidden\" name=\"approved\" value=\"1\">";
    }else{
        echo "<button type=\"submit\" class=\"btn btn-danger\">désapprouvé</button>";
        echo "<input type=\"hidden\" name=\"approved\" value=\"0\">";
    }
    ?>

    </form>

</div>
</div>
<?php endforeach ?>
</div>



<?php include_once("myslide.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>
<?php include_once("footer.php"); ?>

</html>