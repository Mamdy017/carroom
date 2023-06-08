<?php 
$error="";
$msg="";
require_once'config.php';


if(isset($_POST['emailid'])){
     $headers = "MIME-Version: 1.0\r\n";
     $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
     $token= uniqid();
     $url="http://localhost/sout/admin/includes/token?token=$token";
     $message="Salut, pour modifier votre mot de passe veuillez cliquer : <a href=".$url.">ici</a>";
     if(mail($_POST['emailid'], 'Mot de passe oublié', $message, $headers)){
          $sql="UPDATE admin set token = ? where email = ?";
          $stmt=$bdd->prepare($sql);
          $stmt->execute([$token, $_POST['emailid']]);
          $msg="Verifier votre boite mail";
     }else{
          $error="Oups!!! une erreur est survenu";
     }
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
     <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
     <link href="../assets/css/bootstrap-extended.css" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
     <link href="assets/css/app.css" rel="stylesheet">
     <link href="assets/css/icons.css" rel="stylesheet">
     <!-- Theme Style CSS -->


<style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #606060;
    display: flex;
	justify-content: center;
	align-items: center;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
form{
    height: 420px;
    width: 460px;
    background-color: rgba(255,255,255,0.3);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: black;
    letter-spacing: 1.2px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
    color: white;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
    color: #fff;
}
input{
    display: block;
    height: 45px;
    width: 100%;
    background-color:#ffffff;
    border-radius: 15px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
button{
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
.social{
  margin-top: 30px;
  display: flex;
}
a{
     text-decoration: none;
}
.social div{
  background: red;
  width: 1200px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
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
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="post" action="">
        <h3>Mettez votre Email </h3>
        <?php if($error){?><div class="errorWrap">
                                                  <strong>Erreur</strong>:<?php echo htmlentities($error); ?>
                                             </div><?php } 
                else if($msg){?><div class="succWrap"><strong>Succè<small></small></strong>:<?php echo htmlentities($msg); ?> </div>
                                             <?php }?>
        <label for="username">Email</label>
        <input type="email" placeholder="Email" id="username" name="emailid">

        <button class="btn btn-primary btn-block" name="login"
                    type="submit">Connexion</button>
                    <a href="../index.php">   
                        <div class="social">
                            <div class="go"> Page de connexion </div> 
                        </div>
                    </a>
    </form>
</body>
</html>


