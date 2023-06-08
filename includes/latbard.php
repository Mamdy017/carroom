<aside style="background-color:#ffffff ;" class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <?php
    $email = $_SESSION['login'];
    $sql = "SELECT * FROM client WHERE emailid=:emailid ";
    $query = $bdd->prepare($sql);
    $query->bindParam(':emailid', $email, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        foreach ($results as $result) { ?>
            <div class="">
                <style>
                    .image-fit {

                        height: 70px;
                        width: 70px;
                        border-radius: 50%;
                    }

                    .po {
                        position: absolute;
                        left: 10px;
                        top: 10px;
                    }
                </style>
                <i class=""></i>

                <a class="po" href="profile.php?id=<?php echo $result->id_client; ?>">
                    <img src="../image/<?php echo htmlentities($result->photo); ?>" class="image-fit" width="200" height="300" alt="">
                    <span class="ms-1 font-weight-bold"><?php echo htmlentities($result->nom); ?></span>
                </a>

            </div>
    <?php }
    } ?>

    <hr class="horizontal dark mt-0">
    <br><br><br>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item" style="background:#EFEEFF;">
                <a class="nav-link  " href="#">
                    <i class="fas fa-home-lg"></i>

                    <style>
                        .ii {
                            font-size: 25px;
                        }
                    </style>

                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item" style="background:#E3EEFF;">
                <a class="nav-link  " href="mes_reservation.php">
                    <i class="fa fa-hourglass-half"></i>
                    <span class="nav-link-text ms-1">Location</span>
                </a>
            </li>


            <li class="nav-item" style="background:#EFEEFF;">
                <a class="nav-link  " href="acheter.php">
                    <i class="fas fa-money-check-alt"></i>
                    <span class="nav-link-text ms-1">Achéter</span>
                </a>
            </li>
            <?php
            $email = $_SESSION['login'];
            $sql = "SELECT id from question where statut=1  AND emailid='{$email}'";
            $query = $bdd->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            $res = $query->rowCount();
            ?>
            <li class="nav-item" style="background:#EFEEFF;">
                <a class="nav-link" href="question.php">
                    <i class="fas fa-comments-alt"></i>
                    <span class="nav-link-text ms-1">Message <b style="color:red"><?php echo $res; ?></b></span>
                </a>
            </li>
            <li class="nav-item" style="background:#EFEEFF;">
                <a class="nav-link" href="message.php">
                    <i class="fa fa-question"></i>
                    <span class="nav-link-text ms-1">question</span>
                </a>
            </li>

            <li class="nav-item" style="background:#E3EEFF; position:absolute; width:100%; bottom:0;
            margin-top:40px; height:50px;">
                <a class="nav-link " href="../logout.php">
                    <i class="fa fa-power-off"></i>
                    <span class="nav-link-text ms-1">Déconnexion</span>
                </a>
            </li>
        </ul>
    </div>
</aside>