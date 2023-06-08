<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['user']) == 0) {
     header('location:index.php');
} else {

     if (isset($_POST['update'])) {
          $img3 = $_FILES["img3"]["name"];
          $id = intval($_GET['imgid']);
          move_uploaded_file($_FILES["img3"]["tmp_name"], "img/voitureimages/" . $_FILES["img3"]["name"]);
          $sql = "update vehicule set img3=:img3 where id_vehi=:id";
          $query = $bdd->prepare($sql);
          $query = $bdd->prepare($sql);
          $query->execute(array(
               'img3' => $img3,
               'id' => $id,
          ));

          $msg = "Image mise à jour avec succès";
     }
?>


     <!DOCTYPE html>
     <html lang="en">

     <head>
          <?php include 'includes/css.php'; ?>

     </head>

     <body>
          <div class="wrapper">
               <?php include 'includes/latbar.php'; ?>
               <?php include 'includes/header.php'; ?>
               <div class="page-wrapper">
                    <div class="page-content">
                         <!--breadcrumb-->
                         <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                              <div class="breadcrumb-title pe-3">Vehicule</div>
                              <div class="ps-3">
                                   <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb mb-0 p-0">
                                             <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                             </li>
                                             <li class="breadcrumb-item active" aria-current="page">  
                                                  Modifier    <?php if ($error) { ?><div class="errorWrap">
                                                            <strong>ERROR</strong>:<?php echo htmlentities($error); ?>
                                                       </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                                             </li>
                                        </ol>
                                   </nav>
                              </div>

                         </div>
                         <!--end breadcrumb-->

                         <form action="" method="POST" enctype="multipart/form-data">
                              <div class="card">
                                   <div class="card-body p-4">
                                        <h5 class="card-title"> Modifier l'image 3  </h5>
                                        <hr />
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

                                        <div class="form-body mt-4">
                                             <div class="row">
                                                  <div class="col-lg-10">
                                                       <div class="border border-3 p-4 rounded">
                                                            <?php
                                                            $id = intval($_GET['imgid']);
                                                            $sql = "SELECT img3 from vehicule where id_vehi=:id";
                                                            $query = $bdd->prepare($sql);
                                                            $query->bindParam(':id', $id, PDO::PARAM_STR);
                                                            $query->execute();
                                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                            $cnt = 1;
                                                            if ($query->rowCount() > 0) {
                                                                 foreach ($results as $result) {     ?>

                                                                      <div class="col-sm-7">
                                                                           Image3 actuel<span style="color:red">*</span>
                                                                           <img src="img/voitureimages/<?php echo htmlentities($result->img3); ?>" width="200" height="300" style="border:solid 1px #000">
                                                                      </div>
                                                                      <div class="col-sm-7">
                                                                           pour changer
                                                                      </div>
                                                            <?php }
                                                            } ?>
                                                            <div class="col-sm-7">
                                                                 Telecharger une nouvelle image <span style="color:red">*</span><input type="file" name="img3" required>
                                                            </div>

                                                       </div>
                                                  </div>
                                                  <div class="col-2">
                                                       <div class="d-grid">
                                                            <a href="liste_voiture.php" class="btn btn-primary">Retour</a>
                                                       </div>
                                                  </div>
                                             </div>

                                        </div>
                                        <div class="col-10">
                                             <div class="d-grid">
                                                  <button type="submit" name="update" class="btn btn-primary">Mettre a
                                                       jour</button>
                                             </div>
                                        </div>
                                        <!--end row-->
                                   </div>
                              </div>
                    </div>
                    </form>

               </div>
          </div>
          </div>
          <script src="assets/js/bootstrap.bundle.min.js"></script>
          <!--plugins-->
          <script src="assets/js/jquery.min.js"></script>
          <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
          <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
          <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
          <script src="assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js"></script>
          <script>
               $(document).ready(function() {
                    $('#image-uploadify').imageuploadify();
               })
          </script>
          <!--app JS-->
          <script src="assets/js/app.js"></script>
     </body>

     </html>
<?php } ?>