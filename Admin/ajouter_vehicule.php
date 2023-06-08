<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['user']) == 0) {
     header('location:index.php');
} else {
     if (isset($_POST['envoyer'])) {
          $nom = $_POST['nom'];
          $marque = $_POST['marque'];
          $statut = $_POST['statut'];
          $des = $_POST['des'];
          $montant = $_POST['montant'];
          $airconditioner = $_POST['airconditioner'];
          $systeme_freinage = $_POST['systeme_freinage'];
          $cdplayer = $_POST['cdplayer'];
          $carburant = $_POST['carburant'];
          $img1 = $_FILES["img1"]["name"];
          $img2 = $_FILES["img2"]["name"];
          $img3 = $_FILES["img3"]["name"];
          $img4 = $_FILES["img4"]["name"];
          $img5 = $_FILES["img5"]["name"];

          $kilo = $_POST['kilo'];
          $annee = $_POST['annee'];

          $porte = $_POST['porte'];

          $assistance_freinage = $_POST['assistance_freinage'];
          $direction = $_POST['direction'];
          $airbag_chauffeur = $_POST['airbag_chauffeur'];
          $airbag_passager = $_POST['airbag_passager'];
          $vitre_electrique = $_POST['vitre_electrique'];
          $fermeture_centrale = $_POST['fermeture_centrale'];
          $capteur_collision = $_POST['capteur_collision'];
          $quantite = $_POST['quantite'];
          $date = $_POST['date'];
          move_uploaded_file($_FILES["img1"]["tmp_name"], "img/voitureimages/" . $_FILES["img1"]["name"]);
          move_uploaded_file($_FILES["img2"]["tmp_name"], "img/voitureimages/" . $_FILES["img2"]["name"]);
          move_uploaded_file($_FILES["img3"]["tmp_name"], "img/voitureimages/" . $_FILES["img3"]["name"]);
          move_uploaded_file($_FILES["img4"]["tmp_name"], "img/voitureimages/" . $_FILES["img4"]["name"]);
          move_uploaded_file($_FILES["img5"]["tmp_name"], "img/voitureimages/" . $_FILES["img5"]["name"]);

          $insert = $bdd->prepare("INSERT INTO vehicule(
                    nom,marque,statut,etat_vehicule,prixparjour,carburant,kilometrage,date_sortie,annee_modele,img1,img2,img3,img4,
                    img5,air_conditionner,lecteur_cd,porte_electrique,systeme_freinage,assistant_freinage,direction_assistee,airbag_chauffeur,
                    airbag_passager,vitres_electrique,fermeture_central,capteur_collision,quantite)VALUES(
                    ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
          ($insert)->execute(array(
               $nom, $marque, $statut, $des, $montant, $carburant, $kilo,
               $date, $annee, $img1, $img2, $img3, $img4, $img5, $airconditioner, $cdplayer, $porte,
               $systeme_freinage, $assistance_freinage, $direction, $airbag_chauffeur, $airbag_passager,
               $vitre_electrique, $fermeture_centrale, $capteur_collision, $quantite
          ));
          if ($insert) {
               $msg = "Vehicule ajouté avec succès";
          } else {
               $error = "Une erreur s'est produite veuillez reprendre";
          }
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
                                             <li class="breadcrumb-item active" aria-current="page">Ajouter une nouvelle
                                                  voiture dans mon boutique <?php if ($error) { ?><div class="errorWrap">
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
                                        <h5 class="card-title">Ajoutez une voiture </h5>
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
                                                  <div class="col-lg-7">
                                                       <div class="border border-3 p-4 rounded">
                                                            <div class="row g-3">
                                                                 <div class="col-6">
                                                                      <label for="inputProductTitle" class="form-label">Nom<span style="color:red">*</span></label>
                                                                      <input type="text" required name="nom" class="form-control" id="inputProductTitle" placeholder="Entrer le nom du vehicule">
                                                                 </div>
                                                                 <div class="col-6">
                                                                      <label for="inputProductTitle" class="form-label">Marque<span style="color:red">*</span></label>
                                                                      <input type="text" required name="marque" class="form-control" id="inputProductTitle" placeholder="Entrer la marque du vehicule">
                                                                 </div>

                                                                 <div class="col-6">
                                                                      <label for="inputProductTitle" class="form-label">Prix/jour
                                                                           ou le montant<span style="color:red">*</span></label>
                                                                      <input type="text" name="montant" required class="form-control" id="inputProductTitle" placeholder="Prix/jour ou le montant du vehicule en Fcfa">
                                                                 </div>
                                                                 <div class="col-6">
                                                                      <label for="inputProductTitle" class="form-label">Kilométrage</label>
                                                                      <input type="text" name="kilo" class="form-control" id="inputProductTitle" placeholder="Le kilométrage">
                                                                 </div>
                                                                 <div class="col-6">
                                                                      <label for="inputProductTitle" class="form-label">Année
                                                                           modèle</label>
                                                                      <input type="text" name="annee" class="form-control" id="inputProductTitle" placeholder="L'année modèle">
                                                                 </div>

                                                                 <div class="col-6">
                                                                      <label for="inputProductTitle" class="form-label">Date
                                                                           de
                                                                           sortie</label>
                                                                      <input type="date" name="date" class="form-control" id="inputProductTitle" placeholder="Date de sortie">
                                                                 </div>
                                                                 <div class="col-6">
                                                                      <label for="inputCollection" class="form-label">Carburant<span style="color:red">*</span></label>
                                                                      <select class="form-select" required name="carburant" id="inputCollection">
                                                                           <option></option>
                                                                           <option value="Essence">Essence</option>
                                                                           <option value="Gasoil">Gasoil</option>
                                                                      </select>
                                                                 </div>
                                                                 <div class="col-6">
                                                                      <label for="inputCollection" class="form-label">Statut<span style="color:red">*</span></label>
                                                                      <select class="form-select" required name="statut" id="inputCollection">
                                                                           <option></option>
                                                                           <option value="Vendre">A vendre</option>
                                                                           <option value="Louer">A louer
                                                                           </option>
                                                                      </select>
                                                                 </div>
                                                                 <div class="col-12">
                                                                      <label for="inputProductTitle" class="form-label">
                                                                           Quantité</label>
                                                                      <input type="number" name="quantite" min="1" class="form-control" id="inputProductTitle" placeholder="Quantite">
                                                                 </div>
                                                                 <div class="mb-3">
                                                                      <label for="inputProductDescription" class="form-label">Etat
                                                                           et la description de la voiture<span style="color:red">*</span></label>
                                                                      <textarea class="form-control" required name="des" id="inputProductDescription" rows="3"></textarea>
                                                                 </div>
                                                            </div>
                                                       </div>


                                                  </div>

                                                  <div class="col-lg-5">
                                                       <div class="border border-3 p-4 rounded">
                                                            <div class="row g-3">
                                                                 <div class="col-sm-6">
                                                                      <div class="checkbox checkbox-inline">
                                                                           <input type="checkbox" id="airconditioner" name="airconditioner" value="1">
                                                                           <label for="airconditioner">Air conditionner
                                                                           </label>
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-sm-6">
                                                                      <div class="checkbox checkbox-inline">
                                                                           <input type="checkbox" id="cdplayer" name="cdplayer" value="1">
                                                                           <label for="cdplayer"> CD Player </label>
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-sm-6">
                                                                      <div class="checkbox checkbox-inline">
                                                                           <input type="checkbox" id="porte" name="porte" value="1">
                                                                           <label for="porte"> Porte electrique</label>
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-sm-6">
                                                                      <div class="checkbox checkbox-inline">
                                                                           <input type="checkbox" id="airbag_passager" name="airbag_passager" value="1">
                                                                           <label for="airbag_passager"> Airbag passager
                                                                           </label>
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-sm-6">
                                                                      <div class="checkbox checkbox-inline">
                                                                           <input type="checkbox" id="capteur_collision" name="capteur_collision" value="1">
                                                                           <label for="capteur_collision">Capteur
                                                                                collision
                                                                           </label>
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-sm-6">
                                                                      <div class="checkbox checkbox-inline">
                                                                           <input type="checkbox" id="fermeture_centrale" name="fermeture_centrale" value="1">
                                                                           <label for="fermeture_centrale"> Fermeture
                                                                           </label>
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-sm-6">
                                                                      <div class="checkbox checkbox-inline">
                                                                           <input type="checkbox" id="airbag_chauffeur" name="airbag_chauffeur" value="1">
                                                                           <label for="airbag_chauffeur">Airbag
                                                                                chauffeur</label>
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-sm-6">
                                                                      <div class="checkbox checkbox-inline">
                                                                           <input type="checkbox" id="vitre_electrique" name="vitre_electrique" value="1">
                                                                           <label for="vitre_electrique">Vitre
                                                                                electrique
                                                                           </label>
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-sm-6">
                                                                      <div class="checkbox checkbox-inline">
                                                                           <input type="checkbox" id="direction" name="direction" value="1">
                                                                           <label for="direction"> Direction assistée
                                                                           </label>
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-sm-6">
                                                                      <div class="checkbox checkbox-inline">
                                                                           <input type="checkbox" id="assistance_freinage" name="assistance_freinage" value="1">
                                                                           <label for="assistance_freinage">Assistance
                                                                                freinage</label>
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-sm-6">
                                                                      <div class="checkbox checkbox-inline">
                                                                           <input type="checkbox" id="systeme_freinage" name="systeme_freinage" value="1">
                                                                           <label for="systeme_freinage">Systeme
                                                                                freinage
                                                                           </label>
                                                                      </div>
                                                                 </div>

                                                                 <div class="col-12">
                                                                      Image 1 <span style="color:red">*</span><input type="file" name="img1" required>
                                                                 </div>
                                                                 <div class="col-12">
                                                                      Image 2 <span style="color:red">*</span><input type="file" name="img2" required>
                                                                 </div>
                                                                 <div class="col-12">
                                                                      Image 3 <span style="color:red">*</span><input type="file" name="img3" required>
                                                                 </div>
                                                                 <div class="col-12">
                                                                      Image 4 <span style="color:red">*</span><input type="file" name="img4" required>
                                                                 </div>
                                                                 <div class="col-12">
                                                                      Image 5 <span style="color:red">*</span><input type="file" name="img5" required>
                                                                 </div>


                                                            </div>
                                                       </div>
                                                  </div>

                                             </div>
                                             <div class="col-12">
                                                  <div class="d-grid">
                                                       <button type="submit" name="envoyer" class="btn btn-primary">Sauvegarder</button>
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
<?php
} ?>