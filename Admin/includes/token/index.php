<?php 
require_once'../config.php';
$error="Les mots ne sont pas les mêmes";
$msg="";
if (isset($_GET['token']) && $_GET['token'] !='') 
{
 $stmt= $bdd->prepare('SELECT email from admin WHERE token= ?');
 $stmt->execute([$_GET['token']]);
 $emailid=$stmt->fetchColumn();
     if ($emailid) {
      ?>
<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Mon tableau de bord</title>
     <!--Material cdn -->

     <!-- Bootstrap CSS -->
     <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
     <link href="../../assets/css/bootstrap-extended.css" rel="stylesheet">
     <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
     <link href="assets/css/app.css" rel="stylesheet">
     <link href="assets/css/icons.css" rel="stylesheet">
     <!-- Theme Style CSS -->

</head>
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
    height: 470px;
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
        <h3>Modifier le mot de passe </h3>
<?php if($error){?><div class="errorWrap">
                                                  <strong>Erreur</strong>:<?php echo htmlentities($error); ?>
                                             </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div>
                                             <?php }?>
        <label for="username">Nouveau mot de passe</label>
        <input type="password" id="username" name="pass" required>
        <label for="username">Confirmer le mot de passe</label>
        <input type="password" id="password2" name="pass2" required>

        <button class="btn btn-primary btn-block" name="login"
                    type="submit">Modifier</button>
    </form>
</body>
</html>
<?php
           }
}
if (isset($_POST['pass']) && isset($_POST['pass2'])) {
     $pass=$_POST['pass'];
     $pass2=$_POST['pass2'];
     if($pass===$pass2){
          $pass=hash('sha256', $pass);
          $sql="UPDATE admin set password = ?, token=null where email = ?";
          $stmt=$bdd->prepare($sql);
          $stmt->execute([$pass, $emailid]);
          
     header('location:..\..\index.php');
     }else{
          $error="Les mots ne sont pas les mêmes";
     }
     
}



?>