<!-- Remove the container if you want to extend the Footer to full width. -->
<div class="container my-5">

  <Footer class="text-white text-center text-lg-start" style="background-color: #23242a;">
    <!-- Grid container -->
    <div class="container p-4">
      <!--Grid row-->
      <div class="row mt-4">
        <!--Grid column-->
        <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
          <h5 class="text-uppercase mb-4">A propos :</h5>

          <p>
          Vincent Parrot, fort de ses 15 années d'expérience dans la réparation automobile, à ouvert son popre garage à Toulouse en 2021.
          </p>

          <p>
          Depuis 2 ans, il propose une large gamme de services: réparation de la carrosserie et de la mécanique des voitures ainsi que leur entretien régulier pour garantir leur performance et 
          leur sécurité.
          </p>

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
        
          
          <ul class="fa-ul" style="margin-left: 1.65em;">
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
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase mb-4">Horaires d'ouverture</h5>

          <table class="table text-center text-white">
            <tbody class="font-weight-normal">
              <tr>
                <td>Lundi - Samedi:</td>
                <td>8h45 - 12h00 : 14h00 - 18h00 </td>
              </tr>
              <tr>
                <td>Dimanche:</td>
                <td>8h45 - 12h00</td>
              </tr>
              <tr>
                <td colspan="2">
                <h1>Le garage est :</h1>
              <?php 
                $statusmanager = new Garage_statusManager();
                $status = $statusmanager->getgarage_status(); 
                if ($status== 0){
                echo "<h2>ouvert</h2>"; 
                }else{
                echo "<h2>fermé</h2>"; 
                }
                ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </div>
    <!-- Grid container -->
    

  </Footer>
  
<!-- End of .container -->