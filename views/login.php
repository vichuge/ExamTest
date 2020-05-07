<!DOCTYPE html>
<html lang="en">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="msapplication-tap-highlight" content="no">
      <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
      <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
      <title>CEEEY</title>

      <!-- Favicons-->
      <link rel="icon" href="<?php $raiz ?> resources/materialized/images/favicon/favicon-32x32.png" sizes="32x32">
      <!-- Favicons-->
      <link rel="apple-touch-icon-precomposed" href="<?php $raiz ?> resources/materialized/images/favicon/apple-touch-icon-152x152.png">
      <!-- For iPhone -->
      <meta name="msapplication-TileColor" content="#00bcd4">
      <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
      <!-- For Windows Phone -->

      <!-- CORE CSS-->
      <link href="<?php $raiz ?> resources/materialized/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
      <link href="<?php $raiz ?> resources/materialized/css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <!-- Custome CSS-->    
        <link href="<?php $raiz ?> resources/materialized/css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
      <link href="<?php $raiz ?> resources/materialized/css/layouts/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">

      <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
      <link href="<?php $raiz ?> resources/materialized/js/plugins/prism/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
      <link href="<?php $raiz ?> resources/materialized/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

      <style>
        a {
        color: #ffffff;
        /*text-decoration: none;
        -webkit-tap-highlight-color: transparent;*/
      }
      .fixed-action-btn {
        position: fixed;
        left: 23px;
        bottom: 23px;
        padding-top: 15px;
        margin-bottom: 0;
        z-index: 998;
    }
      </style>

    </head>

    <body class="cyan">

      <div id="login-page" class="row">
        <div class="col s12 z-depth-4 card-panel">
            <?php
            if(isset($_SESSION['nomrol']))
            {
                $nomrol=$_SESSION['nomrol'];
            }
            if(isset($_SESSION['idusuario']))
            {
                $idusuario=$_SESSION['idusuario'];
            }
            if(isset($_SESSION['idusuario'])&&isset($_SESSION['nomrol']))
            {
                echo '<p>nombre del rol:'.$nomrol.', idusuario:'.$idusuario.'</p>';
            }
            ?>
            <form class="login-form" method="POST" action="<?php echo $raiz?>login/user">
                <div class="row">
                    <div class="input-field col s12 center">
                        <img src="<?php $raiz ?> resources/materialized/images/login-logo.png" alt="" class="circle responsive-img valign profile-image-login">
                        <p class="center login-form-text">Gestor de examenes</p>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-social-person-outline prefix"></i>
                        <input id="username" type="text" name="username" required class="validate">
                        <label for="username" class="center-align">Username</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-action-lock-outline prefix"></i>
                        <input id="password" type="password" name="password" required class="validate">
                        <label for="password">Password</label>
                    </div>
                </div>
                <!--<div class="row">          
                  <div class="input-field col s12 m12 l12  login-text">
                      <input type="checkbox" id="remember-me" />
                      <label for="remember-me">Remember me</label>
                  </div>
                </div>-->
                <div class="row">
                    <div class="input-field col s12">
                        <button class="btn waves-effect waves-light col s12" type="submit"><a>Login</a></button>
                    </div>
                </div>
                <!--<div class="row">
                  <div class="input-field col s6 m6 l6">
                    <p class="margin medium-small"><a href="<?php $raiz ?> resources/materialized/page-register.html">Register Now!</a></p>
                  </div>
                  <div class="input-field col s6 m6 l6">
                      <p class="margin right-align medium-small"><a href="<?php $raiz ?> resources/materialized/page-forgot-password.html">Forgot password ?</a></p>
                  </div>          
                </div>-->
            </form>
        </div>
      </div>

      <!--<div class="row">
        <div class="col s12">
          <div class="fixed-action-btn">
            <a class="btn-floating btn-large red" href="http://www.edocente.segey.gob.mx">
              <i class="large material-icons">arrow_back</i>
            </a>
          </div>
        </div>
      </div>-->

      <!-- ================================================
        Scripts
        ================================================ -->

        <!-- jQuery Library -->
        <script type="text/javascript" src="<?php $raiz ?> resources/materialized/js/plugins/jquery-1.11.2.min.js"></script>
        <!--materialize js-->
        <script type="text/javascript" src="<?php $raiz ?> resources/materialized/js/materialize.min.js"></script>
        <!--prism-->
        <script type="text/javascript" src="<?php $raiz ?> resources/materialized/js/plugins/prism/prism.js"></script>
        <!--scrollbar-->
        <script type="text/javascript" src="<?php $raiz ?> resources/materialized/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

        <!--plugins.js - Some Specific JS codes for Plugin Settings-->
        <script type="text/javascript" src="<?php $raiz ?> resources/materialized/js/plugins.min.js"></script>
        <!--custom-script.js - Add your own theme custom JS-->
        <script type="text/javascript" src="<?php $raiz ?> resources/materialized/js/custom-script.js"></script>

    </body>
</html>