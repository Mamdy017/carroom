<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['user']) == 0) {
     header('location:index.php');
} else {
?>

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

                         <h6 class="mb-0 text-uppercase " style=" text-align:center ;">La liste des questions </h6>
                         <hr />
                         <div class="card">
                              <div class="car-body">
                                   <style>
                                        th,
                                        td {
                                             font-size: 15px;
                                        }

                                        .btn {
                                             font-size: 12px;
                                        }
                                   </style>
                                   <div class="table-responsive">
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                             <thead class="table-blank">
                                                  <tr>
                                                       <th>#</th>
                                                       <th>Nom</th>
                                                       <th>Prenom</th>
                                                       <th>Message</th>
                                                       <th>Statut</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php $sql = "SELECT question.statut as statut, question.message as message, client.nom as nom, client.prenom as prenom from  question, client where question.emailid=client.emailid ";
                                                  $query = $bdd->prepare($sql);
                                                  $query->execute();
                                                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                  $cnt = 0;
                                                  $i = $i++;

                                                  if ($query->rowCount() > 0) {
                                                       foreach ($results as $result) {                    ?>
                                                            <tr>

                                                                 <th><?php echo ++$i1; ?></th>
                                                                 <td><?php echo htmlentities($result->nom); ?></td>
                                                                 <td><?php echo htmlentities($result->prenom) ?></td>
                                                                 <td><?php echo htmlentities($result->message) ?></td>
                                                                 <td><?php
                                                                      if ($result->statut == 1) { ?>
                                                                           <i class="fa fa-check" style="color:#64C9BF;"></i> Répondu
                                                                      <?php
                                                                      } else if ($result->statut == 0) { ?>
                                                                           <span>
                                                                                <a href="dashbord.php?id=<?php echo htmlentities($question->id); ?>#openModal" style="color: #54A7E3;">
                                                                                     <button class="btn btn-primary"> Repondre:</button> </a>
                                                                           </span>
                                                                      <?php } else if ($result->statut == 3) { ?>
                                                                           <i class="fa fa-check" style="color:#498DFF;"></i><i class="fa fa-check " style="color:#498DFF; padding-left:-50px;"></i> Répondu
                                                                      <?php } ?>
                                                                 </td>
                                                            </tr>
                                                  <?php }
                                                  } ?>
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


<?php } ?>