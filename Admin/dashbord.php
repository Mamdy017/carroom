<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['user']) == 0) {
     header('location:index.php');
} else {
?>

     <!DOCTYPE html>
     <html lang="en">

     <head>
          <?php include 'includes/css.php'; ?>
     </head>

     <body>
          <!--wrapper-->
          <div class="wrapper">
               <!--sidebar wrapper -->

               <?php include 'includes/latbar.php' ?>
               <!--end navigation-->


               <!--end sidebar wrapper -->
               <!--start header -->
               <?php include 'includes/header.php' ?>

               <!--end header -->
               <!--start page wrapper -->
               <?php
               $sql = "SELECT id_vehi from vehicule ";
               $query = $bdd->prepare($sql);
               $query->execute();
               $results = $query->fetchAll(PDO::FETCH_OBJ);
               $vehicule = $query->rowCount();
               ?>
               <div class="page-wrapper">
                    <div class="page-content">
                         <?php include 'question.php'; ?>
                         <?php include 'contact.php'; ?>
                         <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3">
                              <div class="col">
                                   <div class="card radius-10 border-start border-0 border-3 border-info">
                                        <div class="card-body">
                                             <div class="d-flex align-items-center">
                                                  <div>
                                                       <p class="mb-0 text-secondary">Total des voitures</p>
                                                       <h1 class="my-3 text-danger"><?php echo htmlentities($vehicule); ?></h1>
                                                       <!-- <p class="mb-0 font-13">+2.5% from last week</p> -->
                                                  </div>
                                                  <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                                                       <i class='bx bxs-car'></i>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <?php
                              $sql = "SELECT id_vehi from vehicule where statut= 'Vendre' ";
                              $query = $bdd->prepare($sql);
                              $query->execute();
                              $results = $query->fetchAll(PDO::FETCH_OBJ);
                              $vendre = $query->rowCount();
                              ?>
                              <div class="col">
                                   <div class="card radius-10 border-start border-0 border-3 border-danger">
                                        <div class="card-body">
                                             <div class="d-flex align-items-center">
                                                  <div>
                                                       <p class="mb-0 text-secondary">Total voiture à vendre</p>
                                                       <h1 class="my-3 text-danger"><?php echo htmlentities($vendre); ?></h1>
                                                       <!-- <p class="mb-0 font-13">+5.4% from last week</p> -->
                                                  </div>
                                                  <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto">
                                                       <i class='bx bxs-wallet'></i>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <?php
                              $sql = "SELECT id_vehi from vehicule where statut= 'Louer' ";
                              $query = $bdd->prepare($sql);
                              $query->execute();
                              $results = $query->fetchAll(PDO::FETCH_OBJ);
                              $louer = $query->rowCount();
                              ?>
                              <div class="col">
                                   <div class="card radius-10 border-start border-0 border-3 border-success">
                                        <div class="card-body">
                                             <div class="d-flex align-items-center">
                                                  <div>
                                                       <p class="mb-0 text-secondary">Total de voiture à louer</p>
                                                       <h1 class="my-3 text-danger"><?php echo htmlentities($louer); ?></h1>
                                                       <!-- <p class="mb-0 font-13">-4.5% from last week</p> -->
                                                  </div>
                                                  <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                                       <i class='bx bxs-car'></i>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <?php
                              $sql = "SELECT id_client from client ";
                              $query = $bdd->prepare($sql);
                              $query->execute();
                              $results = $query->fetchAll(PDO::FETCH_OBJ);
                              $client = $query->rowCount();
                              ?>
                              <div class="col">
                                   <div class="card radius-10 border-start border-0 border-3 border-warning">
                                        <div class="card-body">
                                             <div class="d-flex align-items-center">
                                                  <div>
                                                       <p class="mb-0 text-secondary"><a href="client.php">Client inscrit</a></p>
                                                       <h1 class="my-3 text-danger"><a href="client.php" class="my-3 text-danger"><?php echo htmlentities($client); ?></a></h1>
                                                       <!-- <p class="mb-0 font-13">+8.4% from last week</p> -->
                                                  </div>
                                                  <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
                                                       <a href="client.php" class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class='fa fa-users'></i></a>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>

                              <?php
                              $sql = "SELECT id_client from client ";
                              $query = $bdd->prepare($sql);
                              $query->execute();
                              $results = $query->fetchAll(PDO::FETCH_OBJ);
                              $client = $query->rowCount();
                              ?>
                              <div class="col">
                                   <div class="card radius-10 border-start border-0 border-3 border-warning">
                                        <div class="card-body">
                                             <div class="d-flex align-items-center">
                                                  <div>
                                                       <p class="mb-0 text-secondary"><a href="client.php">Client inscrit</a></p>
                                                       <h1 class="my-3 text-danger"><a href="client.php" class="my-3 text-danger"><?php echo htmlentities($client); ?></a></h1>
                                                       <!-- <p class="mb-0 font-13">+8.4% from last week</p> -->
                                                  </div>
                                                  <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto">
                                                       <a href="client.php" class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class='fa fa-users'></i></a>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <!--end row-->

                         <div class="row">
                              <div class="col-12 col-lg-12">
                                   <div class="card radius-10">
                                        <div class="card-body">
                                             <div class="d-flex align-items-center">
                                                  <div>
                                                       <h6 class="mb-0">Location</h6>
                                                  </div>
                                                  <div class="dropdown ms-auto">
                                                       <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                                                       </a>
                                                       <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="javascript:;">Action</a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="javascript:;">Another
                                                                      action</a>
                                                            </li>
                                                            <li>
                                                                 <hr class="dropdown-divider">
                                                            </li>
                                                            <li><a class="dropdown-item" href="javascript:;">Something else
                                                                      here</a>
                                                            </li>
                                                       </ul>
                                                  </div>
                                             </div>
                                             <div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
                                                  <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" style="color: #14abef"></i>Location</span>
                                                  <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1" style="color: #ffc107"></i>Vente</span>
                                             </div>
                                             <div class="chart-container-1">
                                                  <canvas id="char1"></canvas>
                                             </div>
                                        </div>
                                        <div class="row row-cols-1 row-cols-md-3 row-cols-xl-3 g-0 row-group text-center border-top">
                                             <div class="col">
                                                  <?php
                                                  $sql = "SELECT * from reservation where type=1";
                                                  $query = $bdd->prepare($sql);
                                                  $query->execute();
                                                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                  $location = $query->rowCount();
                                                  ?>
                                                  <div class="p-3">
                                                       <h5 class="mb-0"><?php echo htmlentities($location); ?> </h5>
                                                       <small class="mb-0">Total Location <span>
                                                                 <!-- <i class="bx bx-up-arrow-alt align-middle"></i>2.43%</span> -->
                                                       </small>
                                                  </div>
                                             </div>
                                             <div class="col">
                                                  <?php
                                                  $sql = "SELECT * from reservation where type=2";
                                                  $query = $bdd->prepare($sql);
                                                  $query->execute();
                                                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                  $vente = $query->rowCount();
                                                  ?>
                                                  <div class="p-3">
                                                       <h5 class="mb-0"><?php echo htmlentities($vente) ?></h5>
                                                       <small class="mb-0">Total vente
                                                            <!-- <span><i class="bx bx-up-arrow-alt align-middle"></i>12.65%</span> -->
                                                       </small>
                                                  </div>
                                             </div>
                                             <div class="col">
                                                  <?php
                                                  $sql = "SELECT * from reservation";
                                                  $query = $bdd->prepare($sql);
                                                  $query->execute();
                                                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                  $total = $query->rowCount();
                                                  ?>
                                                  <div class="p-3">
                                                       <h5 class="mb-0"><?php echo htmlentities($total) ?></h5>
                                                       <small class="mb-0">Total reservation
                                                            <!-- <span><i class="bx bx-up-arrow-alt align-middle"></i>5.62%</span> -->
                                                       </small>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          </div>
          </div>
          <!--end page wrapper -->
          <!--start overlay-->
          <div class="overlay toggle-icon"></div>
          <!--end overlay-->
          <!--Start Back To Top Button-->
          <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
          <!--End Back To Top Button-->
          <footer class="page-footer">
               <p class="mb-0">Copyright © 2022. carroom@gmail.com. </p>
          </footer>
          </div>
          <!--end wrapper-->
          <!-- Bootstrap JS -->
          <script src="assets/js/bootstrap.bundle.min.js"></script>
          <!--plugins-->
          <script src="assets/js/jquery.min.js"></script>
          <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
          <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
          <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
          <script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
          <script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
          <script src="assets/plugins/chartjs/js/Chart.min.js"></script>
          <script src="assets/plugins/chartjs/js/Chart.extension.js"></script>
          <script src="assets/js/index.js"></script>
          <!--app JS-->
          <script src="assets/js/app.js"></script>
          <script src="./index.php"></script>
          <script src="./orders.js"></script>
     </body>


     </html>
<?php } ?>


<script>
     var ctx = document.getElementById("char1").getContext('2d');

     var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
     gradientStroke1.addColorStop(0, '#6078ea');
     gradientStroke1.addColorStop(1, '#17c5ea');

     var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
     gradientStroke2.addColorStop(0, '#ff8359');
     gradientStroke2.addColorStop(1, '#ffdf40');

     var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
               labels: ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aoùt",
                    "Septembre", "Octobre", "Nomvenbre", "Decembre"
               ],
               datasets: [{
                    label: 'lOCATION',
                    data: [<?php
                              $sql = "SELECT * from reservation where mois=1 AND type=1";
                              $query = $bdd->prepare($sql);
                              $query->execute();
                              $results = $query->fetchAll(PDO::FETCH_OBJ);
                              $chart1 = $query->rowCount();
                              echo htmlentities($chart1);
                              ?>,
                         <?php
                         $sql = "SELECT * from reservation where mois=2 AND type=1";
                         $query = $bdd->prepare($sql);
                         $query->execute();
                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                         $chart2 = $query->rowCount();
                         echo htmlentities($chart2);
                         ?>,
                         <?php
                         $sql = "SELECT * from reservation where mois=3 AND type=1";
                         $query = $bdd->prepare($sql);
                         $query->execute();
                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                         $chart3 = $query->rowCount();
                         echo htmlentities($chart3);
                         ?>,
                         <?php
                         $sql = "SELECT * from reservation where mois=4 AND type=1";
                         $query = $bdd->prepare($sql);
                         $query->execute();
                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                         $chart4 = $query->rowCount();
                         echo htmlentities($chart4);
                         ?>,
                         <?php
                         $sql = "SELECT * from reservation where mois=5 AND type=1";
                         $query = $bdd->prepare($sql);
                         $query->execute();
                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                         $chart5 = $query->rowCount();
                         echo htmlentities($chart5);
                         ?>,
                         <?php
                         $sql = "SELECT * from reservation where mois=6 AND type=1";
                         $query = $bdd->prepare($sql);
                         $query->execute();
                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                         $chart6 = $query->rowCount();
                         echo htmlentities($chart6);
                         ?>,
                         <?php
                         $sql = "SELECT * from reservation where mois=7 AND type=1";
                         $query = $bdd->prepare($sql);
                         $query->execute();
                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                         $chart7 = $query->rowCount();
                         echo htmlentities($chart7);
                         ?>,
                         <?php
                         $sql = "SELECT * from reservation where mois=8 AND type=1";
                         $query = $bdd->prepare($sql);
                         $query->execute();
                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                         $chart8 = $query->rowCount();
                         echo htmlentities($chart8);
                         ?>,
                         <?php
                         $sql = "SELECT * from reservation where mois=9 AND type=1 ";
                         $query = $bdd->prepare($sql);
                         $query->execute();
                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                         $chart9 = $query->rowCount();
                         echo htmlentities($chart9);
                         ?>,
                         <?php
                         $sql = "SELECT * from reservation where mois=10 AND type=1 ";
                         $query = $bdd->prepare($sql);
                         $query->execute();
                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                         $chart10 = $query->rowCount();
                         echo htmlentities($chart10);
                         ?>,
                         <?php
                         $sql = "SELECT * from reservation where mois=11 AND type=1";
                         $query = $bdd->prepare($sql);
                         $query->execute();
                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                         $chart11 = $query->rowCount();
                         echo htmlentities($chart11);
                         ?>,
                         <?php
                         $sql = "SELECT * from reservation where mois=12 AND type=1";
                         $query = $bdd->prepare($sql);
                         $query->execute();
                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                         $chart12 = $query->rowCount();
                         echo htmlentities($chart12);
                         ?>
                    ],

                    borderColor: gradientStroke1,
                    backgroundColor: gradientStroke1,
                    hoverBackgroundColor: gradientStroke1,
                    pointRadius: 0,
                    fill: false,
                    borderWidth: 0

               }, {
                    label: 'VENTE',
                    data: [<?php
                              $sql = "SELECT * from reservation where mois=1 AND type=2";
                              $query = $bdd->prepare($sql);
                              $query->execute();
                              $results = $query->fetchAll(PDO::FETCH_OBJ);
                              $chart13 = $query->rowCount();
                              echo htmlentities($chart13);
                              ?>,
                         <?php
                         $sql = "SELECT * from reservation where mois=2 AND type=2";
                         $query = $bdd->prepare($sql);
                         $query->execute();
                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                         $chart14 = $query->rowCount();
                         echo htmlentities($chart14);
                         ?>,
                         <?php
                         $sql = "SELECT * from reservation where mois=3 AND type=2";
                         $query = $bdd->prepare($sql);
                         $query->execute();
                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                         $chart15 = $query->rowCount();
                         echo htmlentities($chart15);
                         ?>,
                         <?php
                         $sql = "SELECT * from reservation where mois=4 AND type=2";
                         $query = $bdd->prepare($sql);
                         $query->execute();
                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                         $chart16 = $query->rowCount();
                         echo htmlentities($chart16);
                         ?>,
                         <?php
                         $sql = "SELECT * from reservation where mois=5 AND type=2";
                         $query = $bdd->prepare($sql);
                         $query->execute();
                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                         $chart17 = $query->rowCount();
                         echo htmlentities($chart17);
                         ?>,
                         <?php
                         $sql = "SELECT * from reservation where mois=6 AND type=2";
                         $query = $bdd->prepare($sql);
                         $query->execute();
                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                         $chart18 = $query->rowCount();
                         echo htmlentities($chart18);
                         ?>,
                         <?php
                         $sql = "SELECT * from reservation where mois=7 AND type=2";
                         $query = $bdd->prepare($sql);
                         $query->execute();
                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                         $chart19 = $query->rowCount();
                         echo htmlentities($chart19);
                         ?>,
                         <?php
                         $sql = "SELECT * from reservation where mois=8 AND type=2";
                         $query = $bdd->prepare($sql);
                         $query->execute();
                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                         $chart20 = $query->rowCount();
                         echo htmlentities($chart20);
                         ?>,
                         <?php
                         $sql = "SELECT * from reservation where mois=9 AND type=2 ";
                         $query = $bdd->prepare($sql);
                         $query->execute();
                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                         $chart21 = $query->rowCount();
                         echo htmlentities($chart21);
                         ?>,
                         <?php
                         $sql = "SELECT * from reservation where mois=10 AND type=2 ";
                         $query = $bdd->prepare($sql);
                         $query->execute();
                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                         $chart22 = $query->rowCount();
                         echo htmlentities($chart22);
                         ?>,
                         <?php
                         $sql = "SELECT * from reservation where mois=11 AND type=2";
                         $query = $bdd->prepare($sql);
                         $query->execute();
                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                         $chart23 = $query->rowCount();
                         echo htmlentities($chart23);
                         ?>,
                         <?php
                         $sql = "SELECT * from reservation where mois=12 AND type=2";
                         $query = $bdd->prepare($sql);
                         $query->execute();
                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                         $chart24 = $query->rowCount();
                         echo htmlentities($chart24);
                         ?>
                    ],
                    borderColor: gradientStroke2,
                    backgroundColor: gradientStroke2,
                    hoverBackgroundColor: gradientStroke2,
                    pointRadius: 0,
                    fill: false,
                    borderWidth: 0
               }]
          },


          options: {
               maintainAspectRatio: false,
               legend: {
                    position: 'bottom',
                    display: false,
                    labels: {
                         boxWidth: 6
                    }
               },
               tooltips: {
                    displayColors: false,
               },
               scales: {
                    xAxes: [{
                         barPercentage: .9
                    }]
               }
          }
     });
</script>