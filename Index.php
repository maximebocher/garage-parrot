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
<?php include_once("ServicesManager.php");?>



<?php
    $ServicesManager = new ServicesManager();
    $services = $ServicesManager->getAllServices();
?>
<!--afficher les services-->

<main class="container">
    <section class ="d-flex flex-wrap justify-content-center">
    <h2>Le garage V.Parrot vous propose tout une gamme de services à votre disposition!</h2>
        <?php foreach($services as $service):?>
        <div class="card m-5" style="width: 18rem; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="card-body">
                <h5 class="card-title"style="background-color: #df5b5b;color: white; padding: 8px; border-radius: 4px;"><?php echo $service->getName()?></h5>
                <p class="card-text"><?php echo $service->getDescription()?></p>
            </div>
        </div>
        <?php endforeach ?>
    </section>
</main>



<?php
    $manager = new OpinionManager();
    $opinions = $manager->getAllApproved();

    ?>
    <!-- afficher les commentaires approuver -->
    <h2>Car votre avis compte beaucoup !</h2>
    <?php foreach ($opinions as $opinion): ?>
    <div class="card" style= "margin-bottom:20px; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); "> 
  <h5 class="card-header" style= "background-color:  #df5b5b; color: #fff; "><?php echo $opinion->getName()?></h5>
  <div class="card-body" style="background-color: #EBEBEB;">
    <h5 class="card-title"> note : <?php echo $opinion->getRating()?>/5</h5>
    <p class="card-text"> Commentaire : <?php echo $opinion->getComment()?></p>
    <form action="Aviswaitapprouv.php" method="post">
      <input type="hidden" name="id" value="<?php echo $opinion->getId()?>">  
    </form>

  </div>
</div>
<?php endforeach ?>
</div>

<?php include_once("Footer.php"); ?>
<?php 
    require_once("./CarManager.php");
    $manager = new CarManager();
    $cars = $manager->getAll();
    require_once("./LoginManager.php");
   /* require_once("./OpinionManager.php");*/
    $manager = new OpinionManager();
    

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" ></script>
</body>

</html>