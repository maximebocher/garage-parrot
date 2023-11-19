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
<?php require_once("./FormContactManager.php");?>

<?php 
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $FormContactManager= New FormContactManager();
                if (isset($_POST["name"])){
                $Contact = New Contact(array('name'=> $_POST["name"],'surname'=> $_POST["surname"],'email'=> $_POST["email"],'phone'=> $_POST["phone"],'message'=> $_POST["message"],'date_creation'=> $_POST["date_creation"]));
                $FormContactManager->create($Contact);
                }
            }
?>
<?php
    $manager = new FormContactManager();
    $contacts = $manager->getAll();

    ?>
    <div>
    <?php foreach ($contacts as $contact): ?>
    <div class="card" style= "margin-bottom:20px; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
  <h5 class="card-header" style= "background-color:  #df5b5b; color: #fff; "><?php echo $contact->getName()?> <?php echo $contact->getsurname()?></h5>
  <div class="card-body" style="background-color: #EBEBEB;">
    <h5 class="card-title"> tel : <?php echo $contact->getPhone()?> Email: <?php echo $contact->getEmail()?></h5>
    <p class="card-text"><?php echo $contact->getMessage()?></p>
  </div>
</div>
<?php endforeach ?>
</div>


<?php include_once("Footer.php"); ?>
<?php require("./LoginManager.php");?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" ></script>
</body>

</html>