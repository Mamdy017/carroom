<div class="main_navigation hide_cat">
     <div class="container-fluid">
          <div class="row">
               <div class="col-lg-3 col-6">
                    <div class="main-collapse-wrap custom-accordion">
                         <button type="button">Categories de voiture</button>
                         <div id="cataccordion" class="accordion_wrap accordion">


                              <div class="card accordion-item">
                                   <div class="card-header accordion-header">
                                        <button class="btn btn-link accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#catSix"> Carrom
                                        </button>
                                   </div>
                                   <div id="catSix" class="accordion-collapse collapse" data-bs-parent="#cataccordion">
                                        <div class="card-body accordion-body">
                                             <ul class="sub-category">
                                                  <li>
                                                       <a href="../louer.php">location</a>
                                                  </li>
                                                  <li>
                                                       <a href="vente.php">vente</a>
                                                  </li>
                                             </ul>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="col-lg-9 col-6">
                    <div class="nav_inner">
                         <ul class="main-menu">
                              <li class="menu-item">
                                   <a href="../index.php" class="active">Accueil</a>
                              </li>
                              <li class="menu-item menu-item-has-children"><a href="#">Pages</a>
                                   <ul class="sub-menu custom">
                                        <?php if ($_SESSION['login']) { ?>
                                             <li class="menu-item menu-item-has-children"><a href="#">Compte</a>
                                                  <ul class="sub-menu custom">
                                                       <li class="menu-item"><a href="../espace_client/profile.php">Mon compte</a></li>
                                                       <li class="menu-item"><a href="../espace_client/acheter.php">Achéter</a></li>
                                                       <li class="menu-item"><a href="../espace_client/infos.php">Information</a></li>
                                                       <li class="menu-item"><a href="../espace_client/mes_reservation.php">Mes resevervation</a></li>
                                                       <li class="menu-item"><a href="../espace_client/mot_passe.php">Mot de passe</a></li>
                                                  </ul>
                                             </li>
                                        <?php } ?>
                                        <li class="menu-item">
                                             <a href="../louer.php">Location</a>
                                        </li>
                                        <li class="menu-item">
                                             <a href="vente.php">Vente</a>
                                        </li>
                                        <li class="menu-item">
                                             <a href="../panier">Panier de location</a>
                                        </li>
                                        <li class="menu-item">
                                             <a href="vente_panier.php">Panier d'achat</a>
                                        </li>
                                   </ul>
                              </li>
                              <li class="menu-item menu-item-has-children"><a href="#">Blog</a>
                                   <ul class="sub-menu custom">
                                        <li class="menu-item menu-item-has-children"><a href="#">Nos Galeries</a>
                                             <ul class="sub-menu custom">
                                                  <li class="menu-item"><a href="../Noslocations.php">Galeries de location</a></li>
                                                  <li class="menu-item"><a href="NosVentes.php">Galeries de vente</a>
                                                  </li>
                                             </ul>
                                        </li>
                                   </ul>
                              </li>
                              <li class="menu-item">
                                   <a href="../apropos.php">A propos de nous</a>
                              </li>
                              <li class="menu-item">
                                   <a href="../contact.php">Contact</a>
                              </li>
                         </ul>
                         <div class="hamburger">
                              <div class="hamburger_btn">
                                   <span></span>
                                   <span></span>
                                   <span></span>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>