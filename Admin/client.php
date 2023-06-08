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

                         <h6 class="mb-0 text-uppercase " style=" text-align:center ;">La liste des clients </h6>
                         <hr />
                         <div class="card">
                              <div class="car-body">
                                   <div class="table-responsive">
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                             <thead class="table-blank">
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
                                             </thead>
                                             <tbody>
                                                  <?php $sql = "SELECT * from  client ";
                                                  $query = $bdd->prepare($sql);
                                                  $query->execute();
                                                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                  $cnt = 1;
                                                  if ($query->rowCount() > 0) {
                                                       foreach ($results as $result) {                    ?>
                                                            <tr>
                                                                 <td><?php echo htmlentities($cnt); ?></td>
                                                                 <td><?php echo htmlentities($result->nom); ?></td>
                                                                 <td><?php echo htmlentities($result->prenom); ?></td>
                                                                 <td><?php echo htmlentities($result->sexe); ?></td>
                                                                 <td><?php echo htmlentities($result->emailid); ?></td>
                                                                 <td><?php echo htmlentities($result->telephone); ?></td>
                                                                 <td><?php echo htmlentities($result->pays); ?></td>
                                                                 <td><?php echo htmlentities($result->ville_provenence); ?></td>
                                                                 <td><?php echo htmlentities($result->date_ajout); ?></td>
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
               console.log(DataTable);
          </script>
          <!--app JS-->
          <script src="assets/js/app.js"></script>
     </body>


     <!-- Mirrored from codervent.com/rocker/demo/vertical/table-basic-table.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Feb 2022 21:58:04 GMT -->

     </html>
<?php } ?>