<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['user']) == 0) {
     header('location:index.php');
} else {
     if (isset($_POST['nom']) && isset($_POST['prenom'])) {
          $nom = $_POST['nom'];
          $prenom = $_POST['prenom'];
          $passwordn = $_POST['passwordn'];
          $passworda = $_POST['passworda'];
          $password1 = $_POST['password1'];
          $id = intval($_GET['id']);
          $emailid = $_SESSION['user'];

          $recherche = $bdd->prepare('SELECT nom, email, password from admin where email=?');
          $recherche->execute(array($emailid));
          $data = $recherche->fetch();
          $row = $recherche->rowCount();

          if ($row == 1) {
               if (filter_var($emailid, FILTER_VALIDATE_EMAIL)) {
                    $passworda = hash('sha256', $passworda);
                    if ($data['password'] === $passworda) {
                         if (strlen($passwordn) >= 8) {
                              if ($passwordn == $password1) {
                                   $passwordn = hash('sha256', $passwordn);
                                   $sql = "Update admin set nom=:nom, prenom=:prenom,password=:passwordn where id=:id";
                                   $query = $bdd->prepare($sql);
                                   $query->execute(array(
                                        'nom' => $nom,
                                        'prenom' => $prenom,
                                        "passwordn" => $passwordn,
                                        'id' => $id,
                                   ));

                                   if ($query) {
                                        $msg = "Excent travail !!!!";
                                   } else {
                                        $error = "Une erreur s'est produite. essayez encore";
                                   }
                              } else $error = "Les mots de passe ne sont pas les mêmes";
                         } else $error = "Le mot de passe est composé d'au moins 8 caracteres";
                    } else $error = "Ancien mot de passe incorrect";
               } else $error = "email non touver";
          } else $error = "Pas de compte";
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



                                   <div class=" d-flex justify-content-center">
                                        <div class="col-xl-9 col-lg-6 card p-3 py-4">
                                             <div class="section">
                                                  <div class="user_info_box">
                                                       <div class="user_box">
                                                            <div class="merci">
                                                                 <div class="image">
                                                                      <img src="img/admin/<?php echo htmlentities($result->photo); ?>" class="image-fit" alt="img">
                                                                      <a href="photo.php?imgid=<?php echo htmlentities($result->id) ?>" class="edit"><i class="fa fa-pencil"></i></a>
                                                                 </div>
                                                            </div> <br><br><br><br><br><br>
                                                            <div class="text-center mt-3"> <span class="bg-secondary p-1 px-4 rounded text-white">Admin</span>
                                                                 <h2 class="mt-2 mb-0">
                                                                      <?php echo htmlentities($result->prenom); ?>
                                                                      <?php echo htmlentities($result->nom); ?>
                                                                 </h2>
                                                                 <div class="px-4 mt-1">
                                                                 </div>
                                                            </div>

                                                       </div>
                                                       <?php if ($error) { ?>
                                                            <div class="errorWrap">
                                                                 <strong>ERRUR</strong>:
                                                                 <?php echo htmlentities($error); ?>
                                                            </div><?php }

                                                                 if ($msg) {
                                                                      ?>
                                                            <div class="succWrap">
                                                                 <strong>SUCCESS</strong>:
                                                                 <?php echo htmlentities($msg); ?>
                                                            </div>
                                                       <?php
                                                                 } ?>

                                                       <form action="#" method="POST" class="user_form">

                                                            <div>
                                                                 <div class="form-group">
                                                                      <span class="fa fa-user"> </span>
                                                                      <label>Prenom</label>

                                                                      <input type="text" name="prenom" value="<?php echo htmlentities($result->prenom); ?> " class="form-control form-control-custom" placeholder="Prenom" autocomplete="off" required>

                                                                 </div>
                                                            </div>
                                                            <div>
                                                                 <div class="form-group">
                                                                      <label>Nom</label>
                                                                      <input type="text" name="nom" value="<?php echo htmlentities($result->nom); ?> " class="form-control form-control-custom" placeholder="Nom" autocomplete="off" required>
                                                                 </div>
                                                            </div><br>
                                                            <div>
                                                                 <div class="form-group">
                                                                      <label>Ancien mot de passe</label>
                                                                      <input type="password" name="passworda" class="form-control form-control-custom" autocomplete="off" required>
                                                                 </div>
                                                            </div><br>
                                                            <div>
                                                                 <div class="form-group">
                                                                      <label>Nouveau mot de passe</label>
                                                                      <input type="password" name="password1" class="form-control form-control-custom" autocomplete="off" required>
                                                                 </div>
                                                            </div><br>
                                                            <div>
                                                                 <div class="form-group">
                                                                      <label>Confirmer</label>
                                                                      <input type="password" name="passwordn" class="form-control form-control-custom" autocomplete="off" required>
                                                                 </div>
                                                            </div><br>

                                                            <div class="  mais justify-content-center">
                                                                 <button type="submit" name="envoyer" class="btn btn-primary">Mettre à jour</button>
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
          <style>
               .user_info_box {
                    padding: 0 80px 0 50px;
               }

               .merci {
                    width: 30%;
                    height: 30px;
                    justify-content: center;
                    margin: 20px auto;
               }

               .mais {
                    width: 40%;
                    justify-content: center;
                    margin: 15px auto;
               }

               button {
                    height: 40px;
                    width: 300px;
               }

               .image {
                    width: 150px;
                    height: 150px;
                    margin-left: 5px;
                    position: relative;
                    border-radius: 50%;
                    margin-bottom: 15px;
               }

               .image img {
                    border-radius: 50%;
               }

               .image .edit {
                    width: 40px;
                    height: 40px;
                    color: #ffffff;
                    ;
                    border-radius: 50%;
                    background-color: #00a8ff;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    position: absolute;
                    bottom: 3px;
                    right: 5px;
               }

               .image .edit:hover {
                    background-color: #2f2f2f;
               }

               .image-fit {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    object-position: center;

               }

               .card {
                    border: none;
                    position: relative;
                    overflow: hidden;
                    border-radius: 8px;
                    cursor: pointer
               }

               .card:before {
                    content: "";
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 4px;
                    height: 100%;
                    background-color: #E1BEE7;
                    transform: scaleY(1);
                    transition: all 0.5s;
                    transform-origin: bottom
               }

               .card:after {
                    content: "";
                    position: absolute;
                    left: 0;
                    top: 0;
                    width: 9px;
                    height: 100%;
                    background-color: blue;
                    transform: scaleY(0);
                    transition: all 0.5s;
                    transform-origin: bottom
               }

               .card:hover::after {
                    transform: scaleY(1)
               }

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

     </body>

     </html>
<?php } ?>