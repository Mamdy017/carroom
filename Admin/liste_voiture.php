<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['user']) == 0) {
     header('location:index.php');
} else {

     if (isset($_GET['del']) and !empty($_GET['del'])) {
          $getid = $_GET['del'];
          $recupusers = $bdd->prepare("SELECT * FROM vehicule where id_vehi=?");
          $recupusers->execute(array($getid));
          if ($recupusers->rowCount() > 0) {
               $bannir_user = $bdd->prepare("DELETE FROM vehicule where id_vehi=?");
               $bannir_user->execute(array($getid));

               $msg = "bon travail";
          } else {
               $error = "l'indentifaiant n'a pas été recupéré";
          }
     }


?>
     <!doctype html>
     <html lang="en">


     <!-- Mirrored from codervent.com/rocker/demo/vertical/table-basic-table.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Feb 2022 21:58:04 GMT -->

     <head>
          <?php include 'includes/css.php' ?>
          <style>
               .errorWrap {
                    padding: 10px;
                    margin: 0 0 20px 0;
                    background: #fff;
                    border-left: 4px solid #dd3d36;
                    -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                    box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
               }

               .succWrap {
                    padding: 10px;
                    margin: 0 0 20px 0;
                    background: #fff;
                    border-left: 4px solid #5cb85c;
                    -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                    box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
               }
          </style>
     </head>

     <body>
          <!--wrapper-->
          <div class="wrapper">
               <!--sidebar wrapper -->
               <?php include 'includes/latbar.php' ?>
               <!--end sidebar wrapper -->
               <!--start header -->
               <?php include 'includes/header.php' ?>
               <!--end header -->
               <!--start page wrapper -->
               <div class="page-wrapper">
                    <div class="page-content">
                         <!--breadcrumb-->

                         <!--end breadcrumb-->
                         <?php if ($error) { ?><div class="errorWrap">
                                   <strong>ERREUR</strong>:<?php echo htmlentities($error); ?>
                              </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>

                         <h6 class="mb-0 text-uppercase " style=" text-align:center ;">La liste des voitures </h6>
                         <hr />
                         <div class="card">
                              <div class="car-body">
                                   <div class="table-responsive">
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                             <thead class="table-blank">
                                                  <tr>
                                                       <th>Numero</th>
                                                       <th>Nom</th>
                                                       <th>Marque</th>
                                                       <th>Prix/jour ou Valeur</th>
                                                       <th>Statut</th>
                                                       <th>Modele année</th>
                                                       <th>Carburant</th>
                                                       <th>Date</th>
                                                       <th>Action</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php $sql = "SELECT * from  vehicule  ";
                                                  $query = $bdd->prepare($sql);
                                                  $query->execute();
                                                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                  $cnt = 1;
                                                  if ($query->rowCount() > 0) {
                                                       foreach ($results as $result) {                    ?>
                                                            <tr>
                                                                 <td><?php echo htmlentities($cnt); ?></td>
                                                                 <td><?php echo htmlentities($result->nom); ?></td>
                                                                 <td><?php echo htmlentities($result->marque); ?></td>
                                                                 <td><?php echo htmlentities($result->prixparjour); ?></td>
                                                                 <td><?php echo htmlentities($result->statut); ?></td>
                                                                 <td><?php echo htmlentities($result->annee_modele); ?></td>
                                                                 <td><?php echo htmlentities($result->carburant); ?></td>
                                                                 <td><?php echo htmlentities($result->date_ajout); ?></td>
                                                                 <td>
                                                                      <a href="modifier_vehicule.php?id=<?php echo $result->id_vehi; ?>">
                                                                           <i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                                                      <a href="liste_voiture.php?del=<?php echo $result->id_vehi; ?>" onclick="return confirm('voulez vous vraiment supprimeer?');"><i class="fa fa-close"></i></a>
                                                                 </td>
                                                            </tr>
                                                  <?php $cnt = $cnt + 1;
                                                       }
                                                  } ?>

                                             </tbody>
                                             <!-- <tfoot class="table-dark">
                                                  <tr>
                                                       <th>Identifiant</th>
                                                       <th>Nom</th>
                                                       <th>prenom</th>
                                                       <th>Sexe</th>
                                                       <th>Email</th>
                                                       <th>Telephone</th>
                                                       <th>Pays</th>
                                                       <th>Ville</th>
                                                       <th>Date</th>
                                                  </tr>
                                             </tfoot> -->
                                        </table>
                                   </div>
                              </div>
                         </div>
                         <!--end row-->
                    </div>
               </div>
               <!--end page wrapper -->
               <!--start overlay-->
               <div class="overlay toggle-icon"></div>
               <!--end overlay-->
               <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
               <!--End Back To Top Button-->
               <footer class="page-footer">
                    <p class="mb-0">Copyright © 2022. carroom@gmail.com.</p>
               </footer>
          </div>
          <!--end wrapper-->
          <!--start switcher-->
          <!--end switcher-->
          <!-- Bootstrap JS -->
          <script src="assets/js/bootstrap.bundle.min.js"></script>
          <!--plugins-->
          <script src="assets/js/jquery.min.js"></script>
          <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
          <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
          <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
          <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
          <script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
          <!--app JS-->
          <script>
               $(document).ready(function() {
                    $('#example').DataTable();
               });
          </script>
          <!--app JS-->
          <script src="assets/js/app.js"></script>
     </body>


     <!-- Mirrored from codervent.com/rocker/demo/vertical/table-basic-table.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Feb 2022 21:58:04 GMT -->

     </html>
<?php } ?>