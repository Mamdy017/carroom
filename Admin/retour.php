<?php

include('includes/config.php');

if (isset($_GET['del'])) {
     $id = $_GET['del'];
     $sql = "delete from client  WHERE id=:id";
     $query = $bdd->prepare($sql);
     $query = $bdd->prepare($sql);
     $query->execute(array(
          'id' => $id
     ));

     $msg = "page mise à jour avec succès";
}
?>

<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['user']) == 0) {
     header('location:index.php');
} else {
?>
     <!doctype html>
     <html lang="en">


     <!-- Mirrored from codervent.com/rocker/demo/vertical/table-basic-table.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Feb 2022 21:58:04 GMT -->

     <head>
          <?php include 'includes/css.php' ?>
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

                         <h6 class="mb-0 text-uppercase " style=" text-align:center ;">La liste des reservations</h6>
                         <hr />
                         <div class="card">
                              <div class="car-body">
                                   <div class="table-responsive">
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                             <thead class="table-blank">
                                                  <tr>
                                                       <th>N°</th>
                                                       <th>Client</th>
                                                       <th>Voiture</th>
                                                       <th>Total en Fcfa</th>
                                                       <th>N° reservation</th>
                                                       <th>Debut</th>
                                                       <th>Fin</th>
                                                       <th>Date</th>
                                                       <th>statut</th>
                                                  </tr>
                                             </thead>

                                             <?php
                                             $status = 1;
                                             $sql = "SELECT reservation.statut2, DATEDIFF(reservation.fin,reservation.debut) as totaljour, client.prenom as n,vehicule.nom as nom,
                      reservation.total,vehicule.img1,reservation.debut,reservation.fin,reservation.message,reservation.id_vehi as vid,reservation.Statut,
                      reservation.date_ajout,reservation.id,reservation.num  from reservation join vehicule on vehicule.id_vehi IN (reservation.id_vehi) 
                      join client on client.emailid=reservation.email  where reservation.statut=:status and type=1 AND fin<NOW()";
                                             $query = $bdd->prepare($sql);
                                             $query->bindParam(':status', $status, PDO::PARAM_STR);
                                             $query->execute();
                                             $results = $query->fetchAll(PDO::FETCH_OBJ);
                                             $cnt = 1;
                                             if ($query->rowCount() > 0) {
                                                  foreach ($results as $result) {
                                             ?>
                                                       <tbody>
                                                            <tr>
                                                                 <td><?php echo htmlentities($cnt); ?></td>
                                                                 <td><?php echo htmlentities($result->n); ?></td>
                                                                 <td><?php echo htmlentities($result->nom); ?></td>
                                                                 <?php
                                                                 $total = $result->total                         ?>
                                                                 <td><?php echo htmlentities($total); ?></td>
                                                                 <td><?php echo htmlentities($result->num); ?></td>
                                                                 <td><?php echo htmlentities($result->debut); ?></td>
                                                                 <td><?php echo htmlentities($result->fin); ?></td>
                                                                 <td><?php echo htmlentities($result->date_ajout); ?></td>

                                                                 <?php
                                                                 if (isset($_REQUEST['aeid'])) {
                                                                      $aeid = intval($_GET['aeid']);
                                                                      $status = 2;

                                                                      $sql = "UPDATE reservation SET statut2=:status WHERE  id=:aeid";
                                                                      $query = $bdd->prepare($sql);
                                                                      $query->bindParam(':status', $status, PDO::PARAM_STR);
                                                                      $query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
                                                                      $query->execute();
                                                                      echo "<script>alert('Retour confirmer avec succes');</script>";
                                                                      echo "<script type='text/javascript'> document.location = 'retour.php'; </script>";
                                                                 }
                                                                 ?>
                                                                 <td class="align-middle text-center text-sm">

                                                                      <span class=" ">
                                                                           <?php if ($result->statut2 == null) { ?>
                                                                                <p class="en"> Finis </p>
                                                                      </span>
                                                                 <?php } else if ($result->statut2 == 1) { ?>
                                                                      <span class="badge badge-sm btn btn-primary"><a href="retour.php?aeid=<?php echo htmlentities($result->id); ?>">Valider</a></span>
                                                                 <?php } else if ($result->statut2 == 2) { ?>
                                                                      <p class="badge badge-sm ac">Rendu</p>
                                                                 <?php } ?>
                                                                 <style>
                                                                      .ac {
                                                                           font-size: 15px;
                                                                           color: #82D617;
                                                                      }

                                                                      .btn {
                                                                           font-size: 15px;
                                                                      }

                                                                      .en {
                                                                           font-size: 20px;
                                                                           color: red;
                                                                      }
                                                                 </style>
                                                                 </td>
                                                            </tr>
                                                  <?php $cnt = $cnt + 1;
                                                  }
                                             } ?>

                                                       </tbody>
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