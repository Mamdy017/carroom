<div class="sidebar-wrapper" data-simplebar="true">
     <div class="sidebar-header">
          <div>
               <img src="img/logo.png" class="logo-icon" alt="logo icon">
          </div>
          <div>
               <h2 class="des logo-text">Car<span class="dange" style="color:black;">room</span></h2>
          </div>
          <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
          </div>
     </div>

     <!--navigation-->
     <div class="sideba">
          <ul class="metismenu" id="menu">
               <li>
                    <a href="dashbord.php">
                         <span class="fa fa-align-justify">

                         </span>
                         <div class="menu-title">
                              <h2>Le board</h2>
                         </div>
                    </a>
               </li>
               <li>
                    <a href="client.php">
                         <span class="fa fa-user">

                         </span>
                         <div class="menu-title">
                              <h3>Client</h3>
                         </div>
                    </a>
               </li>
               <li>
                    <a class="has-arrow" href="javascript:;">
                         <span class="fa fa-automobile"></span>
                         <div class="menu-title">
                              <h3>vehicules</h3>
                         </div>
                    </a>
                    <ul>
                         <li> <a href="liste_voiture.php"><i class="fa fa-clipboard"></i>Les voitures</a>
                         </li>
                         <li> <a href="ajouter_vehicule.php"><i class="fa fa-plus-circle"></i>Nouvelle voiture</a>
                         </li>
                    </ul>
               </li>
               <li>
                    <a class="has-arrow" href="javascript:;">
                         <span class="fa fa-hourglass-half"></span>
                         <div class="menu-title">
                              <h3>Locations</h3>
                         </div>
                    </a>
                    <ul>
                         <li> <a href="reservation.php"><i class="fa fa-edit"></i>Non confirmer</a>
                         </li>
                         <li> <a href="confimer.php"><i class="fa fa-check"></i>Confirmer</a>
                         </li>
                         <li> <a href="annuler.php"><i class="fa fa-close"></i>Annuler</a>
                         </li>
                         <li> <a href="retour.php"><i class="fa fa-close"></i>retour</a>
                         </li>
                    </ul>
               </li>
               <li>
                    <a class="has-arrow" href="javascript:;">
                         <span class="fa fa-credit-card"></span>
                         <div class="menu-title">
                              <h3>Ventes</h3>
                         </div>
                    </a>
                    <ul>
                         <li> <a href="vente.php"><i class="fa fa-edit"></i>Non confirmer</a>
                         </li>
                         <li> <a href="vente_confirmer.php"><i class="fa fa-check"></i>Confirmer</a>
                         </li>
                         <li> <a href="vente_annuler.php"><i class="fa fa-close"></i>Annuler</a>
                         </li>
                    </ul>
               </li>
               <li>
               <?php 
                         $sql ="SELECT id from question where statut=0 ";
                         $query = $bdd -> prepare($sql);
                         $query->execute();
                         $results=$query->fetchAll(PDO::FETCH_OBJ);
                         $res=$query->rowCount(); 

                         $sql ="SELECT id_contact from contact where statut=0";
                         $query = $bdd -> prepare($sql);
                         $query->execute();
                         $results=$query->fetchAll(PDO::FETCH_OBJ);
                         $reser=$query->rowCount();

                         $total=$res+$reser;
                         ?>                         
                    <a class="has-arrow" href="javascript:;">
                         <span class="fa fa-envelope-o"></span>
                         <div class="menu-title">
                              <h3>Message</h3>
                              <spann class="alert-count"><?php echo htmlentities($total);?></spann>
                         </div>
                    </a>
                    <ul>
                  

                         <li> 
                              <a href="contact1.php">
                                   <i class="bx bx-right-arrow-alt"></i>Contact 
                                   <spann class="alert-count"><?php echo htmlentities($reser);?></spann>
                              </a>
                         </li>

                         <li> 
                              <a href="question1.php">
                                   <i class="bx bx-right-arrow-alt"></i>Question</i>
                                   <spann class="alert-count"><?php echo htmlentities($res);?></spann>
                              </a>
                         </li>
                    </ul>
               </li>
               <?php
               $email=$_SESSION['user'];
               $sql ="SELECT * FROM admin WHERE email=:email ";
               $query= $bdd -> prepare($sql);
               $query-> bindParam(':email', $email, PDO::PARAM_STR);
               $query-> execute();
               $results=$query->fetchAll(PDO::FETCH_OBJ);
               if($query->rowCount() > 0)
               {
               foreach($results as $result)
                    { ?>
               <li>
                    <a href="profile.php?id=<?php echo htmlentities($result->id);}}?>">
                         <span class="fa fa-cog"> </span>
                         <div class="menu-title">
                              <h3>Paramètres</h3>
                         </div>
                    </a>
               </li>

               <li>
                   
                    <a href="logout.php">
                         <span class="fa fa-power-off"> </span>
                         <div class="menu-title">
                              <h3>Déconnexion</h3>
                         </div>
                    </a>
               </li>




          </ul>
     </div>

     <!--end navigation-->
</div>