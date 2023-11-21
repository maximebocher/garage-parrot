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



<div class="card">
    <div class="card-body">
        <h5 class="card-title">Ajouter un service</h5>
        <form action="IndexAdmin.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Nom du service :</label>
                <input type="text" class="form-control" id="name" name="name" require_onced>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description du service :</label>
                <textarea class="form-control" id="description" name="description" require_onced></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter le service</button>
            <?php 
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $ServicesManager= New ServicesManager();
                if (isset($_POST["name"])){
                $services = New Services(array('name'=> $_POST["name"],'description'=> $_POST["description"]));
                $ServicesManager->AddServices($services);
                }
                if(isset($_POST["service_id"])){
                    $ServicesManager->deleteService(intval($_POST["service_id"]));
                }
            }
                ?>
        </form>
    </div>
</div>
<?php
    $ServicesManager = new ServicesManager();
    $services = $ServicesManager->getAllServices();
?>
<!--afficher les services-->
<h2>les Services affiché sur la page d'acceuil</h2>
<main class="container">
    <section class ="d-flex flex-wrap justify-content-center">
        <?php foreach($services as $service):?>
        <div class="card m-5" style="width: 18rem; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="card-body">
                <h5 class="card-title"style="background-color: #df5b5b;color: white; padding: 8px; border-radius: 4px;"><?php echo $service->getName()?></h5>
                <p class="card-text"><?php echo $service->getDescription()?></p>
                <form action="IndexAdmin.php" method="post">
                    <input type="hidden" name="service_id" value="<?php echo $service->getId();?>">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
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


<?php
    if (isset($_POST["garagestatus"])){
        echo ($_POST["garagestatus"]);
        $garagestatus_manager = new Garage_StatusManager();
        $garagestatus_manager->update($_POST["garagestatus"]);
        }
?>
<?php 
    $statusmanager = new Garage_statusManager();
    $status = $statusmanager->getgarage_status()
?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card text-center p-4">
                <h2>Changer l'etat du garage</h2>
                <form method="post" action="IndexAdmin.php">
                <?php 
                if ($status== 0){
                    echo "<button type=\"submit\" class=\"btn btn-primary btn-lg\">ouvert</button>";
                    echo "<input type=\"hidden\" name=\"garagestatus\" value=\"0\">";
                }else{
                    echo "<button type=\"submit\" class=\"btn btn-danger btn-lg\">fermer</button>";
                    echo "<input type=\"hidden\" name=\"garagestatus\" value=\"1\">";
                    }
                ?>
                </form>
            </div>
        </div>
    </div>
</div>        
<a href="./gestionemploye.php" class="btn btn-primary">vers creation employé</a>
<?php include_once("Footer.php"); ?>
<?php 
    require_once("./CarManager.php");
    $manager = new CarManager();
    $cars = $manager->getAll();
    require_once("./LoginManager.php");
    require_once("./OpinionManager.php");
    $manager = new OpinionManager();
    

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" ></script>
</body>

</html>