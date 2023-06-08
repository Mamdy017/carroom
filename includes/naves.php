<ul class="navbar-nav  justify-content-end">
    <li class="nav-item d-flex align-items-center">
        <a class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank" href="../index.php">Nouvelle réservation</a>
    </li>
    <?php
    $auj = date('y-m-d');
    $useremail = $_SESSION['login'];
    $sql = "SELECT * from reservation where email='{$useremail}' and statut2 is null and fin < Now() ";
    $query = $bdd->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $client = $query->rowCount();
    ?>
    <li class="nav-item dropdown dropdown-large">
        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="alert-count"><?php echo htmlentities($client); ?></span>
            <i class='bx bx-bell ii'></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <a href="javascript:;">
                <div class="msg-header">
                    <p class="msg-header-title">Notifications</p>
                    <p class="msg-header-clear ms-auto">Demande de reservation finis</p>
                </div>
            </a>

            <div class="header-notifications-list">
                <?php
                $sql = "SELECT * from reservation where email='{$useremail}' and statut2 is null and fin < Now() ";
                $query = $bdd->prepare($sql);
                $query->bindParam(':status', $useremail, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                    foreach ($results as $resul) {
                ?>
                        <a href="finis.php" style="border: 1px solid #fff;">
                            <h4 class="des  logo-text" style=" font-size: 18px;">N°:<?php echo htmlentities($resul->num); ?>,<span><?php echo htmlentities($resul->n); ?>,<?php echo htmlentities($resul->nom); ?></span></h4>
                        </a>
                <?php $cnt = $cnt + 1;
                    }
                } ?>
            </div>

            <a href="finis.php">
                <div class="text-center msg-footer">Voir tout</div>
            </a>
        </div>

    </li>
</ul>
<li class="nav-item d-xl-none ps-3 d-flex align-items-center">
    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
        <div class="sidenav-toggler-inner">
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>