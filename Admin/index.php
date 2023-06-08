<?php
session_start();
require_once '<includes/config.php';
if (isset($_POST['emailid']) && isset($_POST['password'])) {
    $emailid = htmlspecialchars($_POST['emailid']);
    $password = htmlspecialchars($_POST['password']);

    $recherche = $bdd->prepare('SELECT nom, email, password from admin where email=?');
    $recherche->execute(array($emailid));
    $data = $recherche->fetch();
    $row = $recherche->rowCount();

    if ($row == 1) {
        if (filter_var($emailid, FILTER_VALIDATE_EMAIL)) {
            $password = hash('sha256', $password);
            if ($data['password'] === $password) {
                $_SESSION['user'] = $data['email'];
                header('location:dashbord.php');
            } else header('location:index.php?login_err=password');
        } else header('location:index.php?login_err=email');
    } else header('location: index.php?login_err=already');
}
?>



<!DOCTYPE HTML>
<html lang="en">

<!-- Mirrored from themes.codezion.com/tm/html/wuud/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 30 Jan 2022 01:14:33 GMT -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon tableau de bord</title>
    <!--Material cdn -->

    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->



</head>

<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">

            <form action="" method="POST">
                <label for="ck" aria-hidden="true" class="mon">Connexion</label>
                <?php if (isset($_GET['login_err'])) {
                    $err = htmlspecialchars($_GET['login_err']);
                    switch ($err) {
                        case 'password';
                ?>
                            <div class="errorWrap"><strong>Erreur: </strong>mot de passe incorrect</div>
                        <?php
                            break;

                        case 'email';
                        ?>
                            <div class="errorWrapr"><strong>Erreur </strong>email incorrect</div>
                        <?php
                            break;

                        case 'already';
                        ?>
                            <div class="errorWrap"><strong>Erreur </strong>Compte inexistant</div>
                <?php
                            break;
                    }
                }

                ?>
                <label for="username">Email</label>
                <input type="text" placeholder="Email" id="username" name="emailid">

                <label for="password">Mot de passe</label>
                <input type="password" placeholder="Password" id="password" name="password">

                <button class="btn btn-primary btn-block" name="login" type="submit">Connexion</button>

                <div class="social">
                    <div class="go"> Partie administrateur</div>
                </div>

            </form>
        </div>

    </div>

</body>

</html>
<!-- partial -->

<style media="screen">
    *,
    *:before,
    *:after {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    body {
        background-color: #606060;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .background {
        width: 430px;
        height: 520px;
        position: absolute;
        transform: translate(-50%, -50%);
        left: 50%;
        top: 50%;
    }

    .background .shape {
        height: 200px;
        width: 200px;
        position: absolute;
        border-radius: 50%;
    }

    .shape:first-child {
        background: linear-gradient(#1845ad,
                #23a2f6);
        left: -80px;
        top: -80px;
    }

    .shape:last-child {
        background: linear-gradient(to right,
                #ff512f,
                #f09819);
        right: -30px;
        bottom: -80px;
    }

    form {
        height: 550px;
        width: 460px;
        background-color: rgba(255, 255, 255, 0.3);
        position: absolute;
        transform: translate(-50%, -50%);
        top: 50%;
        left: 50%;
        border-radius: 10px;
        backdrop-filter: blur(10px);
        border: 2px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
        padding: 50px 35px;
    }

    form * {
        font-family: 'Poppins', sans-serif;
        color: black;
        letter-spacing: 1.2px;
        outline: none;
        border: none;
    }

    form h3 {
        font-size: 32px;
        font-weight: 500;
        line-height: 42px;
        text-align: center;
        color: white;
    }

    label {
        display: block;
        margin-top: 30px;
        font-size: 16px;
        font-weight: 500;
        color: #fff;
    }

    input {
        display: block;
        height: 45px;
        width: 100%;
        background-color: #ffffff;
        border-radius: 15px;
        padding: 0 10px;
        margin-top: 8px;
        font-size: 14px;
        font-weight: 300;
    }

    ::placeholder {
        color: #e5e5e5;
    }

    button {
        margin-top: 50px;
        width: 100%;
        background-color: #ffffff;
        color: #080710;
        padding: 15px 0;
        font-size: 18px;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
    }

    .login .mon {
        color: #fff;
        transform: scale(.6);
    }

    #chk:checked~.login {
        transform: translateY(-490px);
    }

    .social {
        margin-top: 30px;
        display: flex;
    }

    .social div {
        background: red;
        width: 1200px;
        border-radius: 3px;
        padding: 5px 10px 10px 5px;
        background-color: rgba(255, 255, 255, 0.27);
        color: #eaf0fb;
        text-align: center;
    }

    .main {
        width: 450px;
        height: 650px;
        overflow: hidden;

    }

    #chk {
        display: none;
    }

    .signup {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .mon {
        color: #fff;
        font-size: 2.3em;
        justify-content: center;
        display: flex;
        margin: 1px;
        font-weight: bold;
        cursor: pointer;
        transition: .5s ease-in-out;
    }

    .login {
        height: 410px;
        background: #606060;
        border-radius: 60% / 10%;
        transform: translateY(-50px);
        transition: .8s ease-in-out;
    }

    .errorWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        color: red;
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