<header>
     <div class="topbar d-flex align-items-center">
          <nav class="navbar navbar-expand">
               <div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
               <div class="search-bar flex-grow-1">
                    <div class="position-relative search-bar-box">
                         <input type="text" class="form-control search-control" placeholder="Recherche">
                         <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
                         <span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
                    </div>
               </div>
               <div class="top-menu ms-auto">
                    <ul class="navbar-nav align-items-center">
                         <li class="nav-item mobile-search-icon">
                              <a class="nav-link" href="#"> <i class='bx bx-search'></i>
                              </a>
                         </li>
                         <?php
                         $status = 0;
                         $sql = "SELECT id from reservation WHERE statut= 0";
                         $query = $bdd->prepare($sql);
                         $query->execute();
                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                         $reser = $query->rowCount();
                         ?>
                         <li class="nav-item dropdown dropdown-large">
                              <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                   <span class="alert-count"><?php echo htmlentities($reser); ?></span>
                                   <i class='bx bx-bell'></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-end">
                                   <a href="javascript:;">
                                        <div class="msg-header">
                                             <p class="msg-header-title">Notifications</p>
                                             <p class="msg-header-clear ms-auto">Demande de reservation</p>
                                        </div>
                                   </a>

                                   <div class="header-notifications-list">
                                        Les demandes de locations
                                        <br>
                                        <?php
                                        $status = 0;
                                        $sql = "SELECT client.prenom as n,vehicule.nom,vehicule.nom,vehicule.img1,reservation.debut,reservation.fin,reservation.message,reservation.id_vehi as vid,reservation.Statut,reservation.date_ajout,reservation.id,reservation.num  from reservation join vehicule on vehicule.id_vehi=reservation.id_vehi join client on client.emailid=reservation.email  where reservation.statut=:status and reservation.type=1";
                                        $query = $bdd->prepare($sql);
                                        $query->bindParam(':status', $status, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                             foreach ($results as $result) {
                                        ?>
                                                  <a href="reservation.php" style="border: 1px solid #fff;">
                                                       <h4 class="des  logo-text" style=" font-size: 18px;">N°:<?php echo htmlentities($result->num); ?>,<span><?php echo htmlentities($result->n); ?>,<?php echo htmlentities($result->nom); ?></span></h4>
                                                  </a>
                                        <?php $cnt = $cnt + 1;
                                             }
                                        } ?>
                                        <hr>
                                        Les demandes de d'achats
                                        <br>

                                        <?php
                                        $status = 0;
                                        $sql = "SELECT client.prenom as n,vehicule.nom,vehicule.nom,vehicule.img1,reservation.debut,reservation.fin,reservation.message,reservation.id_vehi as vid,reservation.Statut,reservation.date_ajout,reservation.id,reservation.num  from reservation join vehicule on vehicule.id_vehi=reservation.id_vehi join client on client.emailid=reservation.email  where reservation.statut=:status and reservation.type=2";
                                        $query = $bdd->prepare($sql);
                                        $query->bindParam(':status', $status, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                             foreach ($results as $result) {
                                        ?>
                                                  <a href="vente.php" style="border: 1px solid #fff;">
                                                       <h4 class="des  logo-text" style=" font-size: 18px;">N°:<?php echo htmlentities($result->num); ?>,<span><?php echo htmlentities($result->n); ?>,<?php echo htmlentities($result->nom); ?></span></h4>
                                                  </a>
                                        <?php $cnt = $cnt + 1;
                                             }
                                        } ?>
                                   </div>

                                   <a href="reservation.php">
                                        <div class="text-center msg-footer">Voir tout</div>
                                   </a>
                              </div>

                         </li>

                         <li class="nav-item dropdown dropdown-large">
                              <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                   <span class="alert-count"><?php echo htmlentities($total); ?></span>
                                   <i class='bx bx-comment'></i>
                              </a>
                              <div class="dropdown-menu dropdown-menu-end">
                                   <a href="javascript:;">
                                        <div class="msg-header">
                                             <p class="msg-header-title">Messages</p>
                                             <p class="msg-header-clear ms-auto">Question et cantact</p>
                                        </div>
                                   </a>
                                   <div class="header-message-list">
                                        <span style="margin-left:150px;">
                                             Les questions:
                                        </span>
                                        <?php
                                        $status = 0;
                                        $sql = "SELECT client.photo  as photo, question.id as id, client.prenom as n, client.nom as nom, question.emailid as email, question.message as message
                                    from client join question on client.emailid=question.emailid   where question.statut=:status";
                                        $query = $bdd->prepare($sql);
                                        $query->bindParam(':status', $status, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                             foreach ($results as $question) {
                                        ?>
                                                  <b class="dropdown-item">
                                                       <div class="d-flex align-items-center">
                                                            <!-- <div class="">
                                                       <img src="image/?php echo htmlentities($result->photo);?>" class="msg-avatar"
                                                            alt="user avatar">
                                                  </div> -->
                                                            <div class="flex-grow-1">
                                                                 <h6 class="msg-name"><?php echo htmlentities($question->nom); ?>
                                                                      <span class="msg-time float-end"><a href="dashbord.php?id=<?php echo htmlentities($question->id); ?>#openModal" style="color: #54A7E3;">Repondre: </a></span>
                                                                 </h6>
                                                                 <p class="msg-info"><?php echo htmlentities($question->message); ?></p>
                                                            </div>
                                                       </div>
                                                  </b>
                                        <?php }
                                        } ?>
                                        <hr>

                                        <span style="margin-left:150px;">
                                             Les conatcts:
                                        </span>

                                        <?php
                                        $status1 = 0;
                                        $sql = "SELECT * from contact where statut=:status1";
                                        $query = $bdd->prepare($sql);
                                        $query->bindParam(':status1', $status1, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;

                                        if ($query->rowCount() > 0) {
                                             foreach ($results as $contact) {
                                        ?>
                                                  <b class="dropdown-item">
                                                       <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1">
                                                                 <h6 class="msg-name"><?php echo htmlentities($contact->nom); ?>
                                                                      <span class="msg-time float-end"><a href="dashbord.php?id=<?php echo htmlentities($contact->id_contact); ?> #openModal1" style="color: #54A7E3;">Repondre: </a></span>
                                                                 </h6>
                                                                 <p class="msg-info"><?php echo htmlentities($contact->message); ?></p>
                                                            </div>
                                                       </div>
                                                  </b>
                                        <?php }
                                        } ?>


                                   </div>
                              </div>
                         </li>
                    </ul>
               </div>
               <?php
               $email = $_SESSION['user'];
               $sql = "SELECT * FROM admin WHERE email=:email ";
               $query = $bdd->prepare($sql);
               $query->bindParam(':email', $email, PDO::PARAM_STR);
               $query->execute();
               $results = $query->fetchAll(PDO::FETCH_OBJ);
               if ($query->rowCount() > 0) {
                    foreach ($results as $result) { ?>
                         <div class="user-box dropdown">
                              <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                   <img src="img/admin/<?php echo htmlentities($result->photo); ?>" class="user-img" alt="user avatar">
                                   <div class="user-info ps-3">
                                        <p class="user-name mb-0"><?php echo htmlentities($result->nom); ?></p>
                                        <p class="designattion mb-0"><?php echo htmlentities($result->prenom); ?></p>
                                   </div>
                              </a>
                              <ul class="dropdown-menu dropdown-menu-end">
                                   <li><a class="dropdown-item" href="profile.php?id=<?php echo htmlentities($result->id); ?>"><i class="bx bx-user"></i><span>Profile</span></a>
                                   </li>
                                   <li><a class="dropdown-item" href="profile.php?id=<?php echo htmlentities($result->id);
                                                                                }
                                                                           } ?>"><i class="bx bx-cog"></i><span>Paramètres</span></a>
                                   </li>
                                   <li>
                                        <div class="dropdown-divider mb-0"></div>
                                   </li>
                                   <li><a class="dropdown-item" href="logout.php"><i class='bx bx-log-out-circle'></i><span>Deconexion</span></a>
                                   </li>
                              </ul>
                         </div>
          </nav>
     </div>
</header>