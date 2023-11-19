<?php include_once ("CarManager.php")?>
<?php
$manager = new CarManager();
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