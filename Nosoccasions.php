<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        /* Ajoutez du style CSS selon vos besoins */
        #prix-range-container {
            width: 80%;
            margin: 20px 0;
        }
        #prix-range {
            width: 100%;
            margin: 10px 0;
        }
        #prix-values {
            display: flex;
            justify-content: space-between;
        }
    </style>

    <title>Garage V.Parrot</title>
</head>
<?php include_once("header.php"); ?>
<body style="background-color: #EAEAEA";>
<?php include_once("myslide.php"); ?>
<?php include_once("Garage_StatusManager.php");?>

<?php 
    require("./CarManager.php");
    $manager = new CarManager();
    $cars = $manager->getAll();
?>
<div>
<label for="price"> trié par prix</label>
    <select id="price">
    <option value="0">--</option>
    <option value="1">moins de 5000€</option>
    <option value="2">de 5000€ à 10000€</option>
    <option value="de 10 000€ à 15 000€">de 10000€ à 15000€</option>
    <option value="de 15 000€ à 20 000€">de 15000€ à 20000€</option>
    <option value="plus de 20 000€">plus de 20 000€</option>
    </select>
    <div id="prix-range-container">
        <input type="range" id="prix-min" min="0" max="100000" step="1000" value="20000">
        <input type="range" id="prix-max" min="0" max="100000" step="1000" value="80000">
        <div id="prix-values">
            <span id="prix-min-value"></span>
            <span id="prix-max-value"></span>
        </div>
    </div>
<label for="km"> trié par kilometrage</label>
    <select id="km">
    <option value="">--</option>
    <option value="moins de 20 000 km">moins de 20 000 km</option>
    <option value="de 20 000 km à 50 000 km">de 20 000 km à 50 000 km</option>
    <option value="de 50 000 km à 100 000 km">de 50 000 km à 100 000 km</option>
    <option value="de 100 000 km à 150 000 km">de 100 000 km à 150 000 km</option>
    <option value="plus de 150 000 km">plus de 150 000 km</option>
    </select>
<label for="year"> trié par année de mise en circulation</label>
    <select id="year">
    <option value="">--</option>
    <option value="avant_2000">avant 2000</option>
    <option value="de_2000_à_2005">de 2000 à 2005</option>
    <option value="de_2005_à_2010">de 2005 à 2010</option>
    <option value="de_2010_à_2015">de 2010 à 2015</option>
    <option value="de_2015_à_2020">de 2015 à 2020</option>
    <option value="après_2020">après 2020</option> 
    </select>
    <button type="submit" class="btn btn-success" id="filter">Filtrer</button>
</div>

<script>
$(document).ready(function() {
    $("#filter").click(function() {
        var prixMinInput = $("#prix-min").val();
        var prixMaxInput = $("#prix-max").val();
        console.log(prixMinInput);
        var km = $("#km").val();
        var year = $("#year").val();
        $.ajax({
    type: "POST",
    url: "postfiltercar.php",
    data: { prixMinInput: prixMinInput, prixMaxInput: prixMaxInput, km: km, year: year },
    success: function(data) {
        
        console.log(data);
        $('#container').html(data);
    }
});
});
});
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Récupérez les éléments du DOM
    var prixMinInput = document.getElementById("prix-min");
    var prixMaxInput = document.getElementById("prix-max");
    var prixMinValue = document.getElementById("prix-min-value");
    var prixMaxValue = document.getElementById("prix-max-value");

    // Mettez à jour les valeurs initiales
    prixMinValue.textContent = "Min: " + prixMinInput.value;
    prixMaxValue.textContent = "Max: " + prixMaxInput.value;

    // Gérez les changements dans les sliders
    prixMinInput.addEventListener("input", function () {
        prixMinValue.textContent = "Min: " + prixMinInput.value;
        mettreAJourResultats();
    });

    prixMaxInput.addEventListener("input", function () {
        prixMaxValue.textContent = "Max: " + prixMaxInput.value;
        mettreAJourResultats();
    });

    // Fonction pour mettre à jour les résultats (simule une requête AJAX)
    function mettreAJourResultats() {
        var prixMin = prixMinInput.value;
        var prixMax = prixMaxInput.value;

        // Ici, vous devriez effectuer une requête AJAX pour récupérer les résultats filtrés
        // Adapté selon votre scénario
        // ...

        // Exemple : Affichage des résultats dans la console
        console.log("Prix min: " + prixMin + " - Prix max: " + prixMax);
    }
});
</script>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $prixMininput = -1;
    $prixMaxinput = -1;
    $year = 0;
    $Km = 0;
    if (isset($_POST["prixMininput"])){
        $prixMininput = $_POST['prixMininput'];
    }
    if (isset($_POST["prixMaxinput"])){
        $prixMaxinput = $_POST['prixMaxinput'];
    }
    $cars = $manager->getAllfilter($prixMininput,$prixMaxinput);
    echo json_encode($cars);
    // //*if (isset($_POST["year"])){
    //     $year = $_POST['year'];
    // }
    // if (isset($_POST["Km"])){
    //     $Km = $_POST['Km'];
    // }
}


?>




<main class="container">
<section class ="d-flex flex-wrap justify-content-center">
<?php foreach ($cars as $car): ?>
<div class="card m-5" style="width: 18rem;">
    <img class="card-img-top" src="<?php echo "./image/car-pictures/",$car->getId(). "/" . $car->getPicture() ?>">
    <div class="card-body">
    <h5 class="card-title"><?php echo $car->getName() ?>- <?php echo $car->getType() ?></h5>
    <p class="card-text"><?php echo $car->getPrice() ?>€-<?php echo $car->getKm() ?>km-<?php echo $car->getYear() ?></p>
    <a href= "<?php echo "ShowCAR1.php?carId=". $car->getId()?>" class="btn btn-danger">Voir</a>
    </div>
</div>
<?php endforeach ?>
</section>
<?php if (isset($_SESSION["user"])){
    if($_SESSION["user"]["role"] == "admin" || ($_SESSION["user"]["role"] == "employe")){
        echo '<a href="./Addoccasion.php"class="btn btn-success">poster une annonce</a>';
            }
}
?>

</main>
<?php include_once("footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>

</html>