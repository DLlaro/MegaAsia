<?php
require 'conexion.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MEGAASIA-Administracion</title>
    <link rel="shortcut icon" href="img/pngwing.com (4).png" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="css/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/dist/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>

    <section class="hold-transition login-page">

        <div class="login-box">
            <div class="login-logo">
                <img src="img/logo 1.png" width="150" class="brand-image">
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Bienvenido!</p>

                    <form action="datos/iniciarSesion.php" method="post">
                        <center>
                            <?php if (isset($_GET['error'])) { ?>
                                <p class="error btn btn-danger"><?php echo $_GET['error']; ?></p>
                            <?php } ?>
                        </center>


                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Ingrese su correo" name="usuario" id="usuario">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Ingrese la contraseña" name="contraseña" id="contraseña">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" id="btnLogin" class="btn btn-block" style="background: #dc3036; color: #fff;border-radius: 45px;">Iniciar Sesión</button>
                            </div>
                        </div>
                    </form>

                </div>
                <!-- /.login-card-body -->
            </div>
        </div>


    </section>


    <!-- jQuery -->
    <script src="css/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="css/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="css/dist/js/adminlte.min.js"></script>

    <script src="css/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


</body>

</html>