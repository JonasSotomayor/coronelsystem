<?php
  ob_start();
  session_start();
  if (isset($_SESSION["codigoUsuario"]))
  {
     header("Location: vistas/home.php");
  }else{
    if (isset($_SESSION["codigoEmpleado"])) {
      header("Location: vistas/homeEmpleado.php");
    }else{
      echo '
      <!DOCTYPE html>
      <html lang="es">
      <head>
          <title>COVISYS - CLUB CORONEL</title>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <!--===============================================================================================-->
          <link rel="icon" type="image/png" href="public/images/favico.png" />
          <!--===============================================================================================-->
          <link rel="stylesheet" type="text/css" href="public/login/vendor/bootstrap/css/bootstrap.min.css">
          <!--===============================================================================================-->
          <link rel="stylesheet" type="text/css" href="public/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
          <!--===============================================================================================-->
          <link rel="stylesheet" type="text/css" href="public/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
          <!--===============================================================================================-->
          <link rel="stylesheet" type="text/css" href="public/login/vendor/animate/animate.css">
          <!--===============================================================================================-->
          <link rel="stylesheet" type="text/css" href="public/login/vendor/css-hamburgers/hamburgers.min.css">
          <!--===============================================================================================-->
          <link rel="stylesheet" type="text/css" href="public/login/vendor/animsition/css/animsition.min.css">
          <!--===============================================================================================-->
          <link rel="stylesheet" type="text/css" href="public/login/vendor/select2/select2.min.css">
          <!--===============================================================================================-->
          <link rel="stylesheet" type="text/css" href="public/login/vendor/daterangepicker/daterangepicker.css">
          <!--===============================================================================================-->
          <link rel="stylesheet" type="text/css" href="public/login/css/util.css">
          <link rel="stylesheet" type="text/css" href="public/login/css/main.css">

          <link rel="stylesheet" href="public/sweetalert/dist/sweetalert.css">

          <!--===============================================================================================-->
      </head>

      <body style="background-image: url(public/login/images/fondo2.jpg);
      -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
          ">

          <div class="limiter">
              <div class="container-login100">
                  <div class="wrap-login100">
                      <div class="login100-form-title" style="background-image: url(public/login/images/edi2.png) ">
                          <!-- <span class="login100-form-title-1">
      							Inicia Sección
      					</span> -->
                      </div>

                      <form class="login100-form validate-form" name="formulario" id="formulario" method="POST">
                          <div class="wrap-input100 validate-input m-b-26" data-validate="El usuario es requerido" style="margin-left: -50px;">
                              <span class="label-input100"><i class="fa fa-user"></i></span>
                              <input class="input100" type="text" name="username" id="username" placeholder="Nombre de usuario" required>
                              <span class="focus-input100"></span>
                          </div>

                          <div class="wrap-input100 validate-input m-b-18" data-validate="La contraseña es requerida" style="margin-left: -50px;">
                              <span class="label-input100"><i class="fa fa-key"></i></span>
                              <input class="input100" type="password" name="pass" id="pass" placeholder="Contraseña" required>
                              <span class="focus-input100"></span>
                          </div>
                          <div class="wrap-input100 validate-input m-b-18" data-validate="La contraseña es requerida" style="margin-left: -50px;">
                             
                              <select class="form-control" id="cargoUsuario" name="cargoUsuario">
                                    <option value="" selected>CARGO</option>
                                    <option value="PRESIDENTE">PRESIDENTE</option>
                                    <option value="SECRETARIO">SECRETARIO</option>
                                    <option value="TESORERO">TESORERO</option>
                                </select>
                          </div>  

                          <div class="container-login100-form-btn">
                              <center style="margin-top: 20px;">
                                  <button class="login100-form-btn" type="submit" style="margin-left: -80px;" id="btnsub">
                                          Acceder
      						                 </button>
                              </center>
                          </div>
                          <p class="md-30"></p>
                          <div class="flex-sb-m w-full p-b-30">
                              <div class="contact100-form-checkbox">

                              </div>

                              <div style="margin-top: 45px;">
                                  <a onclick="olvide()" href="#" class="txt1">
                    								Perdi mi contraseña?
                    							</a>
                              </div>
                          </div>

                      </form>
                  </div>
              </div>
          </div>

          <!--===============================================================================================-->
          <script src="public/login/vendor/jquery/jquery-3.2.1.min.js"></script>
          <!--===============================================================================================-->
          <script src="public/login/vendor/animsition/js/animsition.min.js"></script>
          <!--===============================================================================================-->
          <script src="public/login/vendor/bootstrap/js/popper.js"></script>
          <script src="public/login/vendor/bootstrap/js/bootstrap.min.js"></script>
          <!--===============================================================================================-->
          <script src="public/login/vendor/select2/select2.min.js"></script>
          <!--===============================================================================================-->
          <script src="public/login/vendor/daterangepicker/moment.min.js"></script>
          <script src="public/login/vendor/daterangepicker/daterangepicker.js"></script>
          <!--===============================================================================================-->
          <script src="public/login/vendor/countdowntime/countdowntime.js"></script>
          <!--===============================================================================================-->
          <script type="text/javascript" src="vistas/scripts/login.js"></script>
          <!-- SWEET ALERT -->
          <script src="public/sweetalert/dist/sweetalert.js"></script>
          <script src="public/sweetalert/dist/sweetalert.min.js"></script>


      </body>

      </html>
';
    }
  }
?>
