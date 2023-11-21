<?php include_once ("CarManager.php")?>
<?php
$manager = new CarManager();
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $prixMininput = -1;
    $prixMaxinput = -1;
    $kmMin = 0;
    $kmMax = 0;
    $yearMin = 0;
    $yearMax = 0;
    if (isset($_POST["prixMinInput"])){
        $prixMininput = $_POST['prixMinInput'];
    }
    if (isset($_POST["prixMaxInput"])){
        $prixMaxinput = $_POST['prixMaxInput'];
    }
    if (isset($_POST["kmMin"])){
        $kmMin = $_POST['kmMin'];
    }
    if (isset($_POST["kmMax"])){
        $kmMax = $_POST['kmMax'];
    }


    if (isset($_POST["yearMin"])){
        $yearMin = $_POST['yearMin'];
    }
    if (isset($_POST["yearMax"])){
        $yearMax = $_POST['yearMax'];
    }

    $cars = $manager->getAllfilter($prixMininput,$prixMaxinput,$kmMin,$kmMax,$yearMin,$yearMax);
    $html = "";
        foreach ($cars as $car) {
            $html .= '<div class="card m-5" style="width: 18rem;">';
            $html .= '<img class="card-img-top" src="./image/car-pictures/'.$car->getId(). '/' . $car->getPicture() .'">';
            $html .= '<div class="card-body">';
            $html .= '<h5 class="card-title">'.$car->getName().'-'.$car->getType().'</h5>';
            $html .= '<p class="card-text">'. $car->getPrice().'€-'.$car->getKm() .'km-'.$car->getYear().'</p>';
            $html .= '<a href= "ShowCar1.php?carId='. $car->getId().'" class="btn btn-danger">Voir</a>';
            $html .= '</div>';
            $html .= '</div>';
        }

    echo $html;
    // //*if (isset($_POST["year"])){
    //     $year = $_POST['year'];
    // }
    // if (isset($_POST["Km"])){
    //     $Km = $_POST['Km'];
    // }
}


?>