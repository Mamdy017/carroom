<?php
session_start();
error_reporting(0);
include('../includes/config.php');
$bdd = pdo_connect_mysql();
if (strlen($_SESSION['login']) == 0) {
    header('location:../index.php');
} else {
    if (
        isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['sexe']) && isset($_POST['age'])
        && isset($_POST['pays']) && isset($_POST['tel']) && isset($_POST['ville']) && isset($_POST['adresse'])
    ) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $sexe = $_POST['sexe'];
        $age = $_POST['age'];
        $pays = $_POST['pays'];
        $tel = $_POST['tel'];
        $ville = $_POST['ville'];
        $adresse = $_POST['adresse'];
        $id = intval($_GET['id']);
        $sql = "update client set nom=:nom,prenom=:prenom,adresse=:adresse,sexe=:sexe,age=:age,ville_provenence=:ville,pays=:pays,telephone=:tel  where id_client=:id";
        $query = $bdd->prepare($sql);
        $query->execute(array(
            'nom' => $nom,
            'prenom' => $prenom,
            'sexe' => $sexe,
            'age' => $age,
            'ville' => $ville,
            'pays' => $pays,
            'tel' => $tel,
            'adresse' => $adresse,
            'id' => $id,
        ));

        if ($query) {
            $msg = "Excent travail !!!!";
        } else {
            $error = "Une erreur s'est produite. essayez encore";
        }
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <meta http-equiv="content-type" content="text/html;charset=utf-8" />

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



        <title>Carrom| profile</title>

        <?php include "../includes/css2.php";  ?>
        <?php include "../includes/css.php"; ?>
        <link href="../Admin/assets/css/app.css" rel="stylesheet">
        <link href="../Admin/assets/css/icons.css" rel="stylesheet">
        <link rel="shortcut icon" href="../assets/images/icon/favicon.png">

        <link rel="icon" type="image/png" sizes="32x32" href="../favicon.ico">


    </head>

    <body style="background-color:#F6F6F6;" class="g-sidenav-show  bg-gray-10">

        <?php include "../includes/latbard.php"; ?>



        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
                <div style="background-color:#FFFFFF;" class="container-fluid py-1 px-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                            <!-- <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li> -->
                            <li class="breadcrumb-item text-sm text-dark " aria-current="page">Profile</li>
                        </ol>
                        <h6 class="font-weight-bolder mb-0">Mon profile</h6>
                    </nav>
                    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                            <div class="input-group">
                                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" placeholder="Recherche...">
                            </div>
                        </div>
                        <?php include '../includes/naves.php'; ?>
                        <style>
                            .bn {
                                background: #56A9FF;
                            }

                            .pm {
                                background: #56A9FF;
                                border-radius: 10px;
                                color: white;
                            }
                        </style>

                    </div>
                </div>
            </nav>
            <div class="container-fluid">
                <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../image/<?php echo htmlentities($result->photo); ?>'); ">
                    <span class="mask bg-gradient opacity-6"></span>
                </div>
                <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                    <div class="row gx-4">
                        <div class="col-auto">
                            <div class="avatar avatar-xl position-relative">
                                <style>
                                    .i {
                                        height: 100px;
                                        width: 130px;

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
                                <img src="../image/<?php echo htmlentities($result->photo); ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm i">
                            </div>
                        </div>
                        <div class="col-auto my-auto">
                            <div class="h-100 B">
                                <h5 class="mb-1">
                                    <?php echo htmlentities($result->nom); ?>
                                </h5>
                                <p class="mb-0 font-weight-bold text-sm">
                                    <?php echo htmlentities($result->prenom); ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                            <div class="nav-wrapper position-relative end-0">
                                <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                                    <li class="nav-item bac">
                                        <a class="nav-link mb-0 px-0 py-1 A" href="infos.php?id=<?php echo $result->id_client; ?>" role="tab" aria-selected="false">
                                            <i class="fas fa-user-edit ii"></i>
                                            <span class="ms-1">Infos</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-0 px-0 py-1 A" href="mot_passe.php?id=<?php echo $result->id_client; ?>" role="tab" aria-selected="false">
                                            <style>
                                                .pe {
                                                    font-size: 10px;
                                                    position: relative;
                                                    top: 25%;
                                                    left: 4%;
                                                }

                                                .bac {
                                                    background: #E3EEFF;
                                                }

                                                .ii {
                                                    position: relative;
                                                    top: 25%;
                                                    left: 8%;
                                                }

                                                .A {
                                                    margin-top: -40px;
                                                }

                                                .B {

                                                    margin-top: -80px;
                                                    margin-left: 100px;
                                                }
                                            </style>
                                            <i class="fas fa-unlock-alt ii"></i>
                                            <i class="fas fa-pen pe"></i>
                                            <span class="ms-1">Mot de passe</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-1">|</div>
                    <div class="col-xl-8 col-lg-6">
                        <div class="section">
                            <div class="user_info_box">
                                <?php
                                if ($msg) {
                                ?>
                                    <div class="succWrap">
                                        <strong>SUCCESS</strong>:
                                        <?php echo htmlentities($msg); ?>
                                    </div>
                                    <?php
                                }

                                $email = $_SESSION['login'];
                                $sql = "SELECT * FROM client WHERE emailid=:emailid ";
                                $query = $bdd->prepare($sql);
                                $query->bindParam(':emailid', $email);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) { ?>
                                        <form action="#" method="POST" class="user_form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Prenom</label>
                                                        <input type="text" name="prenom" value="<?php echo htmlentities($result->prenom); ?> " class="form-control form-control-custom" placeholder="Prenom" autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nom</label>
                                                        <input type="text" name="nom" value="<?php echo htmlentities($result->nom); ?> " class="form-control form-control-custom" placeholder="Nom" autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Addrese </label>
                                                        <input type="text" name="adresse" value="<?php echo htmlentities($result->adresse); ?> " class=" form-control
                                                                                                        form-control-custom" placeholder="Adesse Email" autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Numero de Telephone
                                                        </label>
                                                        <input type="text" name="tel" value="<?php echo htmlentities($result->telephone); ?> " class="form-control form-control-custom" placeholder="Votre Numero de Telephone" autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Age</label>
                                                        <input type="text" name="age" value="<?php echo htmlentities($result->age); ?> " class="form-control form-control-custom" autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Sexe</label>
                                                        <input type="text" name="sexe" value="<?php echo htmlentities($result->sexe); ?> " class="form-control form-control-custom" placeholder="Votre Sexe" autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Ville</label>
                                                        <input type="text" name="ville" value="<?php echo htmlentities($result->ville_provenence); ?> " class="form-control form-control-custom" placeholder="Votre Ville de Provenence" autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Pays</label>
                                                        <input type="text" name="pays" value="<?php echo htmlentities($result->pays); ?> " class="form-control form-control-custom" placeholder="Votre Pays" autocomplete="off" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class=" w-100 pm" name='valider'>Mettre à jour
                                                </button>
                                            </div>
                                        </form>
                                <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

        </main>
        <script src="../assets2/js/core/popper.min.js"></script>
        <script src="../assets2/js/core/bootstrap.min.js"></script>
        <script src="../assets2/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="../assets2/js/plugins/smooth-scrollbar.min.js"></script>
        <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script>
        <script async defer src="../../../buttons.github.io/buttons.js"></script>
        <script src="../assets2/js/soft-ui-dashboard.minc924.js?v=1.0.6"></script>
    </body>

    </html>
<?php } ?>