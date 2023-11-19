<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Détails du véhicule</title>
</head>
<?php include_once("Header.php"); ?>
<?php include_once("Garage_StatusManager.php");?>
<body style="background-color: #EAEAEA";>
    <?php
    require_once("./FormContactManager.php");
    require_once("./Carmanager.php");
    $carmanager=new CarManager();
    $car=$carmanager->get($_GET["carId"]);
    $datapicture=$carmanager->getAllByPicture($car ->GETid());
    ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title"><?php echo $car->getName()." ".$car->getType()?></h1>
                        <p>Marque : <?php echo $car->getName()?></p>
                        <p>Modèle : <?php echo $car->getType()?></p>
                        <p>Année : <?php echo $car->getYear()?></p>
                        <p>Kilométrage :<?php echo $car->getkm()?> Km</p>
                        <p>Prix : <?php echo $car->getPrice()?></p>
                        
                    <div id="carouselExampleIndicators" class="carousel slide">
                        <div class="carousel-inner">
                            <?php
                            foreach($datapicture as $key =>$value){
                                echo $value["image_path"];
                                if($key==0){
                                    echo ' <div class= "carousel-item active">

                                    <img src="./image/car-pictures/'.$car->getId().'/'.$value["image_path"].'" class="d-block w-100" alt="Capture">
                            </div>';
                                }
                                else{
                                    echo ' <div class= "carousel-item">

                                    <img src="./image/car-pictures/'.$car->getId().'/'.$value["image_path"].'" class="d-block w-100" alt="Capture">
                            </div>';
                                }
                            };
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                        
                        <p>Description :<br> <?php echo $car->getDescription()?></p>
                    </div>
                    <p><h2>Formulaire de contact : </h2></p>
                    <div class="row">
                        <div class="col-md-6">
                            <form action="ShowCar1.php?carId=<?php echo $_GET["carId"]?>" method="post">
                                <label for="name" class="form-label" >Nom :</label>
                                <input type="text" class="form-control" id="name" name="name" required><br>

                                <label for="surname" class="form-label">Prénom :</label>
                                <input type="text" class="form-control" id="surname" name="surname" required><br>

                                <label for="email" class="form-label">Adresse e-mail :</label>
                                <input type="email" class="form-control" id="email" name="email" required><br>

                                <label for="phone" class="form-label">Numéro de téléphone :</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required><br>

                                <label for="message" class="form-label">Message :</label>
                                <textarea id="message" class="form-control" name="message" required>Bonjour, Je vous contact par rapport à l'annonce de :  <?php echo $car->getName()." ".$car->getType()?> </textarea><br>

                                <button type="submit" class="btn btn-primary">Envoyer</button>
                            </div>
                        <?php 
                            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                                $Contact = New Contact(array('name'=> $_POST["name"],'surname'=> $_POST["surname"],'email'=> $_POST["email"],'phone'=> $_POST["phone"],'message'=> $_POST["message"]));
                                $FormContactManager= New FormContactManager();
                                $FormContactManager->create($Contact);
                                }
                        ?>
                            </form>
                                <div class="col-md-6">    
                                    <div>
                                        <ul class="fa-ul" style="margin-left: 1.65em; font-size: 25px; margin-top: 70px;">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once("Footer.php"); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTYv6F5v5l5u11xqi9T6mF5bF5C01E81Dn" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" ></script>
</body>
</html>
