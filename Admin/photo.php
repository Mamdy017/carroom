<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['user']) == 0) {
     header('location:index.php');
} else {

     if (isset($_POST['valider'])) {
          $photo = $_FILES["photo"]["name"];
          $id = intval($_GET['imgid']);
          move_uploaded_file($_FILES["photo"]["tmp_name"], "img/admin/" . $_FILES["photo"]["name"]);
          $sql = "update admin set photo=:photo where id=:id";
          $query = $bdd->prepare($sql);
          $query->execute(array(
               'photo' => $photo,
               'id' => $id,
          ));
          header('location:profile.php');

          $msg = "Image mise à jour avec succes";
     }
?>

     <!DOCTYPE html>
     <html lang="en">

     <head>
          <?php include 'includes/css.php'; ?>

     </head>

     <body>
          <div class="wrapper">

               <?php include 'includes/latbar.php' ?>
               <?php include 'includes/header.php'; ?>


               <div class="page-wrapper">
                    <div class="page-content">
                         <section class="user_account">
                              <div class="container-fluid">
                                   <div class="col-xl-9 col-lg-6">
                                        <div class="section">
                                             <div class="user_info_box">
                                                  <style>
                                                       .user_info_box .user_box .image {
                                                            width: 450px;
                                                            height: 350px;
                                                            margin-right: 70px;
                                                            position: relative;
                                                            border-radius: 50%;
                                                            margin-bottom: 15px;
                                                       }

                                                       .user_info_box .user_box .image img {
                                                            border-radius: 50%;
                                                       }

                                                       .mais {
                                                            width: 40%;
                                                            justify-content: center;
                                                            margin: 15px auto;
                                                       }

                                                       /*Buttons*/
                                                       .thm-btn {
                                                            font-size: 18px;
                                                            color: #ffffff;
                                                            display: inline-flex;
                                                            align-items: center;
                                                            border: 2px solid transparent;
                                                            padding: 8px 35px;
                                                            transition: 0.5s all;
                                                            font-weight: 500;
                                                            background-color: #00a8ff;
                                                            text-align: center;
                                                            justify-content: center;
                                                            white-space: nowrap;
                                                       }

                                                       .thm-btn.btn-border {
                                                            background-color: #ffffff;
                                                       }

                                                       .thm-btn:hover,
                                                       .thm-btn:focus {
                                                            color: #ffffff;
                                                            background-color: #000000;
                                                            border-color: transparent;
                                                       }

                                                       .thm-btn i {
                                                            font-size: 14px;
                                                            line-height: normal;
                                                            margin-left: 10px;
                                                       }

                                                       .thm-btn.btn-rounded {
                                                            border-radius: 50px;
                                                       }

                                                       .thm-btn.btn-rectangle {
                                                            border-radius: 8px;
                                                       }


                                                       .image-fit {
                                                            width: 70%;
                                                            height: 90%;
                                                            object-fit: cover;
                                                            object-position: center;
                                                       }
                                                  </style>
                                                  <div class="user_box mais">
                                                       <div class="image">
                                                            <img src="img/admin/<?php echo htmlentities($result->photo); ?>" class="image-fit" alt="img" width="200" height="300" style="border:solid 1px #000">
                                                       </div>

                                                  </div>


                                                  <form action="" method="POST" enctype="multipart/form-data">



                                                       <div>
                                                            <div class="form-group"><input type="file" name="photo" placeholder="*" required>
                                                                 </button>
                                                            </div>

                                                       </div>



                                                       <div class="col-12">
                                                            <button type="submit" class="thm-btn btn-rectangle thm-bg-color-one w-100" name='valider'>Mettre à jour</button>

                                                       </div>
                                                  </form>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                    </div>
               </div>
               </section>
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

     </html>
<?php } ?>