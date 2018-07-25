<?php
require_once("php/session.php");
require_once("php/class.user.php");

$login = new USER();

if($login->is_loggedin()!="") {
    $login->redirect('index.php');
}

$cookieFB = "fb_login_integ";
if(isset($_COOKIE[$cookieFB])) {
    //Separate data
    $cookieFB = $_COOKIE[$cookieFB];
    $cookieFB = explode('|', $cookieFB);
    $FB_id = $cookieFB[0]; //FB ID
    $FB_idP = $cookieFB[0]; //FB ID Password
    $FB_name = $cookieFB[1]; //Name
    $FB_email = $cookieFB[2]; //Email
    
    $stmt = $login->runQuery("SELECT user_logger FROM users WHERE user_logger=:FB_id");
    $stmt->execute(array(':FB_id'=>$FB_id));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
        
    if($row['user_logger'] == $FB_id) {
        //Register with Facebook
        if($login->doLoginFace($FB_name,$FB_id,$FB_id)) {
            $login->redirect('index.php');
        }
        
    } else {
        if($login->registerFB($FB_name,$FB_email,$FB_id,$FB_idP)) {  
            //Register with Facebook
            $stmt = $login->runQuery("SELECT user_id, user_name, user_email, user_logger, user_pass FROM users WHERE user_logger=:FB_id");
            $stmt->execute(array(':FB_id'=>$FB_id));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
            $login->redirect('index.php');
        }
    }
}


if(isset($_POST['btn-login'])) {
    $uname = strip_tags($_POST['txt_uname_email']);
    $umail = strip_tags($_POST['txt_uname_email']);
    $upass = strip_tags($_POST['txt_password']);
        
    if($login->doLogin($uname,$umail,$upass)) {
        $login->redirect('index.php');
    } else {
        $error = "Wrong Details !";
    }   
}

?>
<html>
    <!-- Head -->
    <head>
        <?php include 'head-scripts.html'; ?>
        <title>Login | AllFunz</title>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="container login">
            <div class="signin-form">
                <h1>Sign Up</h1>
                <div class="btFacebook" onclick="connectToFacebook();">Login with Facebook</div>
                <div class="g-signin2" data-onsuccess="onSignIn"></div>
                <!-- <form class="form-signin" method="post" id="login-form">        
                    <div class="form-group">
                        <input type="text" class="form-control" name="txt_uname_email" placeholder="Username or E mail ID" required />
                        <span id="check-e"></span>
                    </div>
                    
                    <div class="form-group">
                        <input type="password" class="form-control" name="txt_password" placeholder="Your Password" />
                    </div>
                                   
                    <div class="form-group">
                        <button type="submit" name="btn-login" class="btn btn-default">
                                <i class="glyphicon glyphicon-log-in"></i> &nbsp; SIGN IN
                        </button>
                    </div>  
                    <label>Don't have account yet ! <a href="sign-up.php">Sign Up</a></label>
                 </form> -->
            </div>
            
        </div>
        <script>
            function onSignIn(googleUser) {
              var profile = googleUser.getBasicProfile();
              console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
              console.log('Name: ' + profile.getName());
              console.log('Image URL: ' + profile.getImageUrl());
              console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
            }
        </script>
    </body>
</html>