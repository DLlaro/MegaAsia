<?php
require '../conexion.php';
/* $idConvocatoria = $_GET['id']; */
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!--   Datos de cabecera -->
  <title>T-Soluciona - Convocatoria</title>
  <link rel="shortcut icon" href="../img/icon.png" />

  <link rel="stylesheet" href="../css/bootstrap.min.css" />
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../css/login.css">
  <style>
    .banner-image {
      background-image: url('../img/xd.png');
      background-size: cover;
      width: 100%;
      height: 80%;
    }
  </style>
</head>

<body>
  <!-- Navbar  -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light    p-md-3">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"> <img src="../img/logo.png" width="40%"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <div class="mx-auto" style=></div>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link " href="https://t-soluciona.com.pe/">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="https://t-soluciona.com.pe/nosotros/">Nosotros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="https://t-soluciona.com.pe/altomayo/">Políticas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="https://t-soluciona.com.pe/servicios/">Servicios</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              Convocatoria
            </a>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="https://job.t-soluciona.com.pe">SEDAPAR</a>
              </li>
              <li>
                <a class="dropdown-item" href="https://job.t-soluciona.com.pe">PRIMNAX</a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="https://t-soluciona.com.pe/contactanos/">Contactanos</a>
          </li>

          <li class="nav-item">
            <button type="button" style="background: #FB6445; color: #fff;border-radius: 45px;"
              onclick="document.getElementById('id01').style.display='block'" class="btn btn-xs">Iniciar Sesión</button>
          </li>

        </ul>
      </div>
    </div>
  </nav>



  <!-- LOGIN -->
  <div id="id01" class="modal">

    <form class="modal-content animate" action="../datos/iniciarSesion.php" method="post">
      <div class="imgcontainer">
        <span onclick="document.getElementById('id01').style.display='none'" class="close"
          title="Close Modal">&times;</span>
        <img src="../img/logo_t.png" alt="Avatar" width="80">
      </div>

      <div class="container-login">
        <label for="usuario"><b>Usuario</b></label>
        <input type="email" placeholder="Ingresar Usuario" name="usuario" id="usuario" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Ingresar Contraseña" name="contraseña" id="contraseña" required>
        <br><br>
        <button type="submit" class="button-login">Inisiar Sesión</button>
        <br><br>
        <label>
          <input type="checkbox" checked="checked" name="remember"> Recuerdame
        </label>
      </div>

      <div class="container-login" style="background-color:#f1f1f1">
        <button type="button" onclick="document.getElementById('id01').style.display='none'"
          class="cancelbtn button-login ">Cancelar</button>
        <!--   <span class="psw"> <a href="#">¿Olvidaste la contraseña?</a></span> -->
      </div>
    </form>
  </div>
  <!-- Main Content Area -->
  <br><br><br><br><br><br>
  <div class="container my-2 d-grid gap-2 ">
    <div class="table-responsive">
      <table id="myTable" class="table text-center" style="width:100%;font-size: 12px;">
        <thead>
          <tr >
            <th>NOMBRE</th>
            <th>DESCARGAR</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Bases</td>
            <td>  <button type="button" class="editCargoBtn btn btn-success btn-sm"><i class="fa-solid fa-file"></i></button></td>
          </tr>
          <tr>
            <td>Cronograma</td>
            <td>  <button type="button" class="editCargoBtn btn btn-success btn-sm"><i class="fa-solid fa-file"></i></button></td>
          </tr>
          <tr>
            <td>Formatos</td>
            <td>  <button type="button" class="editCargoBtn btn btn-success btn-sm"><i class="fa-solid fa-file"></i></button></td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>

  <script src="../js/bootstrap.bundle.min.js"></script>
  <script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>
  <script type="text/javascript">
    var nav = document.querySelector('nav');

    window.addEventListener('scroll', function () {
      if (window.pageYOffset > 100) {
        nav.classList.add('bg-light', 'shadow');
      } else {
        nav.classList.remove('bg-light', 'shadow');
      }
    });
  </script>
</body>

</html>