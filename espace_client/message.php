<?php
session_start();
error_reporting(0);
include('../includes/config.php');
$bdd = pdo_connect_mysql();
if (strlen($_SESSION['login']) == 0) {
    header('location:../index.php');
} else {
    if (isset($_POST['valider'])) {

        $emailid = $_SESSION['login'];
        $mesg = $_POST['msg'];
        $status = 0;
        if (empty($mesg)) {
            $error = "Champ message est vide";
        } else {
            $insert = $bdd->prepare('INSERT INTO question ( `emailid`, `message`,`statut`)
         VALUES (?,?,?)');
            $insert->execute(array($emailid, $mesg, $status));
            if ($insert) {
                $msg = "Question posée avec succès !!!!";
            } else {
                $error = "Une erreur s'est produite. essayez encore";
            }
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
                        <?php include '../includes/naves.php'; ?>
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

                                    .bac {
                                        background: #E3EEFF;
                                    }
                                </style>
                                <img src="../image/<?php echo htmlentities($result->photo); ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm i">
                            </div>
                        </div>
                        <div class="col-auto my-auto">
                            <div class="h-100">
                                <h5 class="mb-1">
                                    <?php echo htmlentities($result->nom); ?>
                                </h5>
                                <p class="mb-0 font-weight-bold text-sm">
                                    <?php echo htmlentities($result->prenom); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-2">|</div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="section">
                                <div class="user_info_box">
                                    <?php if ($error) { ?>
                                        <div class="errorWrap">
                                            <strong>ERRUR</strong>:
                                            <?php echo htmlentities($error); ?>
                                        </div><?php }

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
                                                    <div class="form-group">
                                                        <label for="">Formuler une question</label>
                                                        <textarea class="form-control" name="msg" placeholder="Message *" rows="5"></textarea>
                                                    </div>
                                                </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class=" w-100 pm" name='valider'>Poser la question
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