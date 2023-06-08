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
          $id = intval($_GET['id']);
          $insert = "UPDATE vehicule SET
          nom=:nom,marque=:marque,statut=:statut,etat_vehicule=:des,
          prixparjour=:montant,carburant=:carburant,kilometrage=:kilo,
          date_sortie=:date,annee_modele=:annee,air_conditionner=:airconditioner,
          lecteur_cd=:cdplayer,porte_electrique=:porte,systeme_freinage=:systeme_freinage,
          assistant_freinage=:assistance_freinage,direction_assistee=:direction,
          airbag_chauffeur=:airbag_chauffeur,airbag_passager=:airbag_passager,
          vitres_electrique=:vitre_electrique,fermeture_central=:fermeture_centrale,
          capteur_collision=:capteur_collision,quantite=:quantite where id_vehi=:id";
          $query = $bdd->prepare($insert);
          $query->execute(array(
               'nom' => $nom,
               'marque' => $marque,
               'statut' => $statut,
               'des' => $des,
               'montant' => $montant,
               'carburant' => $carburant,
               'kilo' => $kilo,
               'date' => $date,
               'annee' => $annee,
               'airconditioner' => $airconditioner,
               'cdplayer' => $cdplayer,
               'porte' => $porte,
               'systeme_freinage' => $systeme_freinage,
               'assistance_freinage' => $assistance_freinage,
               'direction' => $direction,
               'airbag_chauffeur' => $airbag_chauffeur,
               'airbag_passager' => $airbag_passager,
               'vitre_electrique' => $vitre_electrique,
               'fermeture_centrale' => $fermeture_centrale,
               'capteur_collision' => $capteur_collision,
               'quantite' => $quantite,
               'id' => $id
          ));


          $msg = "Excellent";
          header('location:liste_voiture.php');
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
                                             <li class="breadcrumb-item active" aria-current="page">Ajouter une voulle
                                                  voiture dans mon boutique
                                                  <?php if ($error) { ?><div class="errorWrap">
                                                            <strong>ERROR</strong>:<?php echo htmlentities($error); ?>
                                                       </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div>
                                                  <?php } ?>
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
                                                  <div class="col-lg-6">
                                                       <div class="border border-3 p-4 rounded">
                                                            <div class="row g-3">
                                                                 <div class="col-6">
                                                                      <?php
                                                                      $id = $_GET['id'];
                                                                      $ret = "select * from vehicule where id_vehi=:id";
                                                                      $query = $bdd->prepare($ret);
                                                                      $query->bindParam(':id', $id, PDO::PARAM_STR);
                                                                      $query->execute();
                                                                      $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                      $cnt = 1;
                                                                      if ($query->rowCount() > 0) {
                                                                           foreach ($results as $result) {
                                                                      ?>
                                                                                <label for="inputProductTitle" class="form-label">Nom<span style="color:red">*</span></label>
                                                                                <input type="text" required name="nom" class="form-control" id="inputProductTitle" value="<?php echo htmlentities($result->nom); ?>">
                                                                 </div>
                                                                 <div class="col-6">
                                                                      <label for="inputProductTitle" class="form-label">Marque<span style="color:red">*</span></label>
                                                                      <input type="text" required name="marque" class="form-control" id="inputProductTitle" value="<?php echo htmlentities($result->marque); ?>">
                                                                 </div>

                                                                 <div class="col-6">
                                                                      <label for="inputProductTitle" class="form-label">Prix/jour
                                                                           ou le montant<span style="color:red">*</span></label>
                                                                      <input type="text" name="montant" required class="form-control" id="inputProductTitle" value="<?php echo htmlentities($result->prixparjour); ?>">
                                                                 </div>
                                                                 <div class="col-6">
                                                                      <label for="inputProductTitle" class="form-label">Kilométrage</label>
                                                                      <input type="text" name="kilo" class="form-control" id="inputProductTitle" value="<?php echo htmlentities($result->kilometrage); ?>">
                                                                 </div>

                                                                 <div class="col-6">
                                                                      <label for="inputProductTitle" class="form-label">Année
                                                                           modèle</label>
                                                                      <input type="text" name="annee" class="form-control" id="inputProductTitle" value="<?php echo htmlentities($result->annee_modele); ?>">
                                                                 </div>
                                                                 <div class="col-6">
                                                                      <label for="inputProductTitle" class="form-label">Date
                                                                           de
                                                                           sortie</label>
                                                                      <input type="text" name="date" class="form-control" id="inputProductTitle" value="<?php echo htmlentities($result->date_sortie); ?>">
                                                                 </div>
                                                                 <div class="col-6">
                                                                      <label for="inputCollection" class="form-label">Carburant<span style="color:red">*</span></label>
                                                                      <select class="form-select" required name="carburant" id="inputCollection">
                                                                           <option value="<?php echo htmlentities($result->carburant); ?>">
                                                                                <?php echo htmlentities($result->carburant); ?>
                                                                           </option>
                                                                           <option value="Essence">Essence</option>
                                                                           <option value="Gasoil">Gasoil</option>
                                                                      </select>

                                                                 </div>
                                                                 <div class="col-6">
                                                                      <label for="inputCollection" class="form-label">Statut<span style="color:red">*</span></label>
                                                                      <select class="form-select" required name="statut" id="inputCollection">
                                                                           <option value="<?php echo htmlentities($result->statut); ?>">
                                                                                <?php echo htmlentities($result->statut); ?>
                                                                           </option>
                                                                           <option value="Vendre">A vendre</option>
                                                                           <option value="Louer">A louer
                                                                           </option>
                                                                      </select>
                                                                 </div>
                                                                 <div class="col-12">
                                                                      <label for="inputProductTitle" class="form-label">
                                                                           Quantité</label>
                                                                      <input type="number" name="quantite" min="1" class="form-control" id="inputProductTitle" placeholder="Quantite" value="<?php echo htmlentities($result->quantite); ?>">
                                                                 </div>
                                                                 <div class="mb-3">
                                                                      <label for="inputProductDescription" class="form-label">Etat
                                                                           et la description de la voiture<span style="color:red">*</span></label>
                                                                      <textarea class="form-control" required name="des" id="inputProductDescription" rows="3"><?php echo htmlentities($result->etat_vehicule); ?></textarea>
                                                                 </div>
                                                                 <div class="col-6">
                                                                      Image 1 <img src="img/voitureimages/<?php echo htmlentities($result->img1); ?>" width="200" height="150" style="border:solid 1px #000">
                                                                      <a href="changeimg1.php?imgid=<?php echo htmlentities($result->id_vehi) ?>" style="background:var(--color-success);">Changer
                                                                           Image 1</a>
                                                                 </div>
                                                            </div>
                                                       </div>


                                                  </div>

                                                  <div class="col-lg-6">
                                                       <div class="border border-3 p-4 rounded">
                                                            <div class="row g-3">
                                                                 <div class="col-sm-6">
                                                                      <?php if ($result->air_conditionner == 1) { ?>
                                                                           <div class="checkbox checkbox-inline">
                                                                                <input type="checkbox" id="airconditioner" name="airconditioner" checked value="1">
                                                                                <label for="airconditioner">Air conditionner
                                                                                </label>

                                                                           </div>
                                                                      <?php } else { ?>
                                                                           <div class="checkbox checkbox-inline">
                                                                                <input type="checkbox" id="airconditioner" name="airconditioner" value="1">
                                                                                <label for="airconditioner">Air conditionner
                                                                                </label>
                                                                           </div>
                                                                      <?php } ?>
                                                                 </div>
                                                                 <div class="col-sm-6">
                                                                      <?php if ($result->lecteur_cd == 1) { ?>
                                                                           <div class="checkbox checkbox-inline">
                                                                                <input type="checkbox" id="cdplayer" name="cdplayer" checked value="1">
                                                                                <label for="cdplayer"> CD Player </label>
                                                                           </div>
                                                                      <?php } else { ?>
                                                                           <div class="checkbox checkbox-inline">
                                                                                <input type="checkbox" id="cdplayer" name="cdplayer" value="1">
                                                                                <label for="cdplayer"> CD Player </label>
                                                                           </div>
                                                                      <?php } ?>
                                                                 </div>
                                                                 <div class="col-sm-6">
                                                                      <?php if ($result->porte_electrique == 1) { ?>
                                                                           <div class="checkbox checkbox-inline">
                                                                                <input type="checkbox" id="porte" name="porte" checked value="1">
                                                                                <label for="porte"> Porte electrique</label>
                                                                           </div>
                                                                      <?php } else { ?>
                                                                           <div class="checkbox checkbox-inline">
                                                                                <input type="checkbox" id="porte" name="porte" value="1">
                                                                                <label for="porte"> Porte electrique</label>
                                                                           </div>
                                                                      <?php } ?>
                                                                 </div>
                                                                 <div class="col-sm-6">
                                                                      <?php if ($result->airbag_passager == 1) { ?>
                                                                           <div class="checkbox checkbox-inline">
                                                                                <input type="checkbox" id="airbag_passager" name="airbag_passager" checked value="1">
                                                                                <label for="airbag_passager"> Airbag passager
                                                                                </label>
                                                                           </div>
                                                                      <?php } else { ?>
                                                                           <div class="checkbox checkbox-inline">
                                                                                <input type="checkbox" id="airbag_passager" name="airbag_passager" value="1">
                                                                                <label for="airbag_passager"> Airbag passager
                                                                                </label>
                                                                           </div>
                                                                      <?php } ?>
                                                                 </div>
                                                                 <div class="col-sm-6">
                                                                      <?php if ($result->capteur_collision == 1) { ?>
                                                                           <div class="checkbox checkbox-inline">
                                                                                <input type="checkbox" id="capteur_collision" name="capteur_collision" checked value="1">
                                                                                <label for="capteur_collision">Capteur
                                                                                     collision
                                                                                </label>
                                                                           </div>
                                                                      <?php } else { ?>
                                                                           <div class="checkbox checkbox-inline">
                                                                                <input type="checkbox" id="capteur_collision" name="capteur_collision" value="1">
                                                                                <label for="capteur_collision">Capteur
                                                                                     collision
                                                                                </label>
                                                                           </div>
                                                                      <?php } ?>
                                                                 </div>
                                                                 <div class="col-sm-6">
                                                                      <?php if ($result->fermeture_central == 1) { ?>
                                                                           <div class="checkbox checkbox-inline">
                                                                                <input type="checkbox" id="fermeture_centrale" name="fermeture_centrale" checked value="1">
                                                                                <label for="fermeture_centrale"> Fermeture
                                                                                </label>
                                                                           </div>
                                                                      <?php } else { ?>
                                                                           <div class="checkbox checkbox-inline">
                                                                                <input type="checkbox" id="fermeture_centrale" name="fermeture_centrale" value="1">
                                                                                <label for="fermeture_centrale"> Fermeture
                                                                                </label>
                                                                           </div>
                                                                      <?php } ?>
                                                                 </div>
                                                                 <div class="col-sm-6">
                                                                      <?php if ($result->airbag_chauffeur == 1) { ?>
                                                                           <div class="checkbox checkbox-inline">
                                                                                <input type="checkbox" id="airbag_chauffeur" name="airbag_chauffeur" checked value="1">
                                                                                <label for="airbag_chauffeur">Airbag
                                                                                     chauffeur</label>
                                                                           </div>
                                                                      <?php } else { ?>
                                                                           <div class="checkbox checkbox-inline">
                                                                                <input type="checkbox" id="airbag_chauffeur" name="airbag_chauffeur" value="1">
                                                                                <label for="airbag_chauffeur">Airbag
                                                                                     chauffeur</label>
                                                                           </div>
                                                                      <?php } ?>
                                                                 </div>
                                                                 <div class="col-sm-6">
                                                                      <?php if ($result->vitres_electrique == 1) { ?>
                                                                           <div class="checkbox checkbox-inline">
                                                                                <input type="checkbox" id="vitre_electrique" name="vitre_electrique" checked value="1">
                                                                                <label for="vitre_electrique">Vitre
                                                                                     electrique
                                                                                </label>
                                                                           </div>
                                                                      <?php } else { ?>
                                                                           <div class="checkbox checkbox-inline">
                                                                                <input type="checkbox" id="vitre_electrique" name="vitre_electrique" value="1">
                                                                                <label for="vitre_electrique">Vitre
                                                                                     electrique
                                                                                </label>
                                                                           </div>
                                                                      <?php } ?>
                                                                 </div>
                                                                 <div class="col-sm-6">
                                                                      <?php if ($result->direction_assistee == 1) { ?>
                                                                           <div class="checkbox checkbox-inline">
                                                                                <input type="checkbox" id="direction" name="direction" checked value="1">
                                                                                <label for="direction"> Direction assistée
                                                                                </label>
                                                                           </div>
                                                                      <?php } else { ?>
                                                                           <div class="checkbox checkbox-inline">
                                                                                <input type="checkbox" id="direction" name="direction" value="1">
                                                                                <label for="direction"> Direction assistée
                                                                                </label>
                                                                           </div>
                                                                      <?php } ?>
                                                                 </div>
                                                                 <div class="col-sm-6">
                                                                      <?php if ($result->assistant_freinage == 1) { ?>
                                                                           <div class="checkbox checkbox-inline">
                                                                                <input type="checkbox" id="assistance_freinage" name="assistance_freinage" checked value="1">
                                                                                <label for="assistance_freinage">Assistance
                                                                                     freinage</label>
                                                                           </div>
                                                                      <?php } else { ?>
                                                                           <div class="checkbox checkbox-inline">
                                                                                <input type="checkbox" id="assistance_freinage" name="assistance_freinage" value="1">
                                                                                <label for="assistance_freinage">Assistance
                                                                                     freinage</label>
                                                                           </div>
                                                                      <?php } ?>
                                                                 </div>
                                                                 <div class="col-sm-6">
                                                                      <?php if ($result->systeme_freinage == 1) { ?>
                                                                           <div class="checkbox checkbox-inline">
                                                                                <input type="checkbox" id="systeme_freinage" name="systeme_freinage" checked value="1">
                                                                                <label for="systeme_freinage">Systeme
                                                                                     freinage
                                                                                </label>
                                                                           </div>
                                                                      <?php } else { ?>
                                                                           <div class="checkbox checkbox-inline">
                                                                                <input type="checkbox" id="systeme_freinage" name="systeme_freinage" value="1">
                                                                                <label for="systeme_freinage">Systeme
                                                                                     freinage
                                                                                </label>
                                                                           </div>
                                                                      <?php } ?>
                                                                 </div>
                                                                 <div class="col-6"></div>


                                                                 <div class="col-6">
                                                                      Image 2 <img src="img/voitureimages/<?php echo htmlentities($result->img2); ?>" width="200" height="150" style="border:solid 1px #000">
                                                                      <a href="changeimg2.php?imgid=<?php echo htmlentities($result->id_vehi) ?>" style="background:var(--color-success);">Changer
                                                                           Image 2</a>
                                                                 </div>
                                                                 <div class="col-6">
                                                                      Image 3 <img src="img/voitureimages/<?php echo htmlentities($result->img3); ?>" width="200" height="150" style="border:solid 1px #000">
                                                                      <a href="changeimg3.php?imgid=<?php echo htmlentities($result->id_vehi) ?>" style="background:var(--color-success);">Changer
                                                                           Image 3</a>
                                                                 </div>
                                                                 <div class="col-6">
                                                                      Image 4 <img src="img/voitureimages/<?php echo htmlentities($result->img4); ?>" width="200" height="150" style="border:solid 1px #000">
                                                                      <a href="changeimg4.php?imgid=<?php echo htmlentities($result->id_vehi) ?>" style="background:var(--color-success);">Changer
                                                                           Image 4</a>
                                                                 </div>
                                                                 <div class="col-6">
                                                                      Image 5 <img src="img/voitureimages/<?php echo htmlentities($result->img5); ?>" width="200" height="150" style="border:solid 1px #000">
                                                                      <a href="changeimg5.php?imgid=<?php echo htmlentities($result->id_vehi) ?>" style="background:var(--color-success);">Changer
                                                                           Image 5</a>
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
                                   <?php }
                                                                      } ?>
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
<?php }  ?>