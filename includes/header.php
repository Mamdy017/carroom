<div class="preloader">
     <img src="assets/images/icon/fa.png" alt="preloader">
     <h3 style="color:blue;">Veuillez patienter...</h3>
</div>

<header class="header">
     <div class="topbar">
          <div class="container-fluid">
               <div class="inner">
                    <div class="header_action">
                         <ul>
                              </li>
                              <li class="user">
                                   <a href="index.php">
                                        <img src="assets/images/icon/fla.png" class="image-fit" alt="img"><b>
                                             <h4 class="logo-text" style='color: #fff; margin: 0.8rem;'>Car<b style="color:black;"><b style="color:red;">-r</b>oom</b></h4>
                                        </b>
                                   </a>
                              </li>
                              </li>
                         </ul>
                    </div>

                    <div class="search-form">
                         <form method="get">
                              <div class="input-group">
                                   <input type="text" name="recherche" class="form-control" placeholder="Recherchez une voiture..." autocomplete="off" required>
                                   <div class="input-group-append input-group-text">
                                        <button type="submit"><i class="fal fa-search"></i></button>
                                   </div>
                              </div>
                         </form>
                    </div>

                    <div class="header_action">
                         <ul>
                              <li class="cart">
                                   <a href="panier.php">
                                        <span class="cart_value" style="color:#f00;background:#fff; border:solid 0.5px"><?php echo $num_items_in_panier ?></span>
                                        <i class="far fa-shopping-cart"></i>
                                   </a>
                              </li>
                              <?php if (strlen($_SESSION['login']) == 0) { ?>
                                   <li>
                                        <a href="connexion.php"><span>S'identifier</span></a>
                                   </li>
                                   <?php }
                              $email = $_SESSION['login'];
                              $sql = "SELECT * FROM client WHERE emailid=:emailid ";
                              $query = $bdd->prepare($sql);
                              $query->bindParam(':emailid', $email, PDO::PARAM_STR);
                              $query->execute();
                              $results = $query->fetchAll(PDO::FETCH_OBJ);
                              if ($query->rowCount() > 0) {
                                   foreach ($results as $result) { ?>
                                        <li class="user">
                                             <a href="#">
                                                  <img src="image/<?php echo htmlentities($result->photo); ?>" class="image-fit" alt="img">
                                                  <span><?php echo htmlentities($result->nom);
                                                       }
                                                  } ?></span>
                                             </a>
                                             <ul class="sub-menu">
                                                  <?php if ($_SESSION['login']) { ?> 
                                                       <li>
                                                            <a href="espace_client/acheter.php">Achéter</a>
                                                       </li>
                                                       <li>
                                                            <a href="espace_client/profile.php?id=<?php echo $result->id_client; ?>">Paramètre</a>
                                                       <li>
                                                            <a href="espace_client/mes_reservation.php"><i class=""> </i>Reservation</a>
                                                       </li>
                                                       <li>
                                                            <a href="logout.php">Déconnexion</a>
                                                       </li>
                                             </ul>
                                        </li>
                                   <?php }; ?>
                         </ul>
                    </div>
               </div>
          </div>
     </div>
</header>