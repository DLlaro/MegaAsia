<?php
require '../conexion.php';
$idConvocatoria = $_GET['id'];
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
          <button type="button"
                style="background: #FB6445; color: #fff;border-radius: 45px;" onclick="document.getElementById('id01').style.display='block'" class="btn btn-xs">Iniciar Sesión</button>
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
        <button type="submit" class="button-login" >Inisiar Sesión</button>
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

        <?php
        $query = "SELECT *, date_format(fechaConvocatoria, \"%d de %M del %Y\") as fechaConvocatoria, date_format(fechaFinConvocatoria, \"%d-%m-%Y\") as fechaFinConvocatoria FROM convocatoria 
    INNER JOIN categoria ON categoria.idCategoria =convocatoria.idCategoria
    INNER JOIN empresa ON empresa.idEmpresa = convocatoria.idEmpresa	
    INNER JOIN cargo ON cargo.idCargo= convocatoria.idCargo
    where idConvocatoria = '$idConvocatoria'";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $convocatoria) {
                if (strlen($convocatoria['idConvocatoria']) == 1) {
                    $codigo = "000" . $convocatoria['idConvocatoria'];
                }
                if (strlen($convocatoria['idConvocatoria']) == 2) {
                    $codigo = "00" . $convocatoria['idConvocatoria'];
                }
                if (strlen($convocatoria['idConvocatoria']) == 3) {
                    $codigo = "0" . $convocatoria['idConvocatoria'];
                }

        ?>



                <h2>
                    CONVOCATORIA N° <?= strtoupper($codigo) ?>:
                    <?= strtoupper($convocatoria['empresaNombre']) ?> REQUIERE
                    <?= strtoupper($convocatoria['cargoNombre']) ?> - 
                    <?= $convocatoria['plazas'] ?> PLAZAS

                </h2>

                <p style="text-align: justify;background:#4CAF50;color:#fff;padding: 16px;font-size: 15px; margin: 0 0 16px 0;  text-align: left; box-shadow: 0 4px 10px 0 rgba(0,0,0,0.2), 0 4px 20px 0 rgba(0,0,0,0.19);"><b>CONVOCATORIA VIGENTE. La oferta esta vigente hasta el
                        <?= $convocatoria['fechaFinConvocatoria'] ?>
                </p>


                <div class="p-5 border" style="border-radius: 10px;">
                    <h4 style="background-color: #ffe4e4;border-radius: 0.5rem; border-left: 0.5rem solid #ff6060;padding: 0.5rem; color: #404040;font-size: 1.2rem;"> Detalle de la convocatoria</h4>

                    <p style="text-align: justify;"><b>Fecha de publicación:</b>
                        <?= $convocatoria['fechaConvocatoria'] ?>
                    </p>
                    <p style="text-align: justify;"><b>Fecha de cierre:</b>
                        <?= $convocatoria['fechaFinConvocatoria'] ?>
                    </p>


                    <p style="text-align: justify;"><b>Institución:</b>
                        <?= $convocatoria['empresaNombre'] ?>
                    </p>

                    <p style="text-align: justify;"><b>Tipo de Contrato:</b>
                        <?= $convocatoria['tipoContrato'] ?>
                    </p>


                    <p style="text-align: justify;"><b>Lugar de labores:</b>
                        <?= $convocatoria['lugar'] ?>
                    </p>

                    <p style="text-align: justify;"><b>Remuneración:</b>
                        <?= $convocatoria['remuneracion'] ?>
                    </p>

                    <p style="text-align: justify;"><b>Plazas:</b>
                        <?= $convocatoria['plazas'] ?>
                    </p>

                    
                    <p style="text-align: justify;"><b>Jornada:</b>
                        <?= $convocatoria['jornada'] ?>
                    </p>

                    <p style="text-align: justify;"><b>Modalidad:</b>
                        <?= $convocatoria['modalidad'] ?>
                    </p>

                </div>
                <br>


                <p style="text-align: justify;background:#ffefcc;color:#000;padding: 15px;font-size: 15px; margin: 10 0 16px 0;  text-align: left; box-shadow: 0 4px 10px 0 rgba(0,0,0,0.2), 0 4px 20px 0 rgba(0,0,0,0.19);">
                    <b>Nota:</b> Los interesados deben considerar previamente a la postulación, si cumplen con los requisitos
                    establecidos para cada vacante y revisar que documentación (anexos, formatos, etc) debe adjuntar para su
                    correcta inscripción. Las bases son consignados para cada puesto a continuación.
                </p>

                <div class="p-5 border" style="border-radius: 10px;">
                    <h4 style="background-color: #ffe4e4;border-radius: 0.5rem; border-left: 0.5rem solid #ff6060;padding: 0.5rem; color: #404040;font-size: 1.2rem;"> Requisitos</h4>
                  
                    <p style="text-align: justify;">
                    <?= str_replace("\n", "<br>", $convocatoria['requisitos']); ?>
                    </p>

                  
                    <p style="text-align: justify;background:#ffefcc;color:#000;padding: 8px;font-size: 15px; margin: 0 0 16px 0;  text-align: left; box-shadow: 0 4px 10px 0 rgba(0,0,0,0.2), 0 4px 20px 0 rgba(0,0,0,0.19);"> <i class="fa-solid fa-circle-info"></i> Es importante descargar las bases para revisar los requisitos completos.
                    </p>

                    <br>


                    <h4 style="background-color: #ffe4e4;border-radius: 0.5rem; border-left: 0.5rem solid #ff6060;padding: 0.5rem; color: #404040;font-size: 1.2rem;"> Condiciones del contrato</h4>

                     <p style="text-align: justify;">
                    <?= str_replace("\n", "<br>", $convocatoria['beneficios']); ?>
                    </p>

                    <p style="text-align: justify;background:#ffefcc;color:#000;padding: 8px;font-size: 15px; margin: 0 0 16px 0;  text-align: left; box-shadow: 0 4px 10px 0 rgba(0,0,0,0.2), 0 4px 20px 0 rgba(0,0,0,0.19);"> <i class="fa-solid fa-circle-info"></i> Es importante descargar las bases para conocer a más detalle las condiciones del contrato.
                    </p>
               

                    <br>
                    <h4 style="background-color: #ffe4e4;border-radius: 0.5rem; border-left: 0.5rem solid #ff6060;padding: 0.5rem; color: #404040;font-size: 1.2rem;"> ¿Cómo postular?</h4>
                    <p style="text-align: justify;"><b>Plazo para postular:</b>
                        <?= $convocatoria['fechaFinConvocatoria'] ?>
                    </p>
                    <p style="text-align: justify;"><b>COMO POSTULAR:</b> Registro de postulación en el Portal Empresarial de
                        T-Soluciona. <a target="_blank" href="postulacion.php"><B>POSTULA
                                AQUI</B></a>
                    </p>
                 
                    <p style="text-align: justify;background:#ffefcc;color:#000;padding: 8px;font-size: 15px; margin: 0 0 16px 0;  text-align: left; box-shadow: 0 4px 10px 0 rgba(0,0,0,0.2), 0 4px 20px 0 rgba(0,0,0,0.19);"> <i class="fa-solid fa-circle-info"></i> En las bases se especifica a mayor detalle el procedimiento de postulación.
                    </p>
                    <br>
                    <h4 style="background-color: #ffe4e4;border-radius: 0.5rem; border-left: 0.5rem solid #ff6060;padding: 0.5rem; color: #404040;font-size: 1.2rem;"> Recomendación para postular</h4>
                    <p style="text-align: justify;">
                    <ul>
                        <li>
                            Para postular al Estado es muy importante revisar a detalle cada punto descrito en las bases de la
                            convocatoria. En este documento se especifica los requisitos completos, cronograma, anexos a
                            presentar, que formularios llenar, como y en que orden debe presentar su documentación, etc.
                        </li>
                        <li>
                            Si cumple con los requisitos, solo puede postular a través de los medios y en las fechas que indica
                            las Bases/cronograma. Cualquier otro medio utilizado puede ser motivo de descalificación.
                        </li>
                        <li>
                            Seguir la página de la institución para estar informado sobre cualquier comunicado de
                            reprogramación, suspensión, cancelación, fe de erratas, etc que pudieran surgir durante el proceso
                            de selección.
                        </li>
                    </ul>
                    </p>

                    <br>
                    <h4 style="background-color: #ffe4e4;border-radius: 0.5rem; border-left: 0.5rem solid #ff6060;padding: 0.5rem; color: #404040;font-size: 1.2rem;"> Descargar bases del concurso</h4>
                    <p style="text-align: justify;">
                    <ul>
                        <li>
                            <a target="_blank" href="bases.php"><B>Ver aquí Bases(convocatoria completa y cronograma)</B></a>
                        </li>
                    </ul>
                    </p>

                    <br>
                    <h4 style="background-color: #ffe4e4;border-radius: 0.5rem; border-left: 0.5rem solid #ff6060;padding: 0.5rem; color: #404040;font-size: 1.2rem;"> Resultados de la convocatoria</h4>
                    <p style="text-align: justify;">
                        Revisar el cronograma del proceso de selección, allí se especifica cuando y por que medios se publicará los resultados de cada etapa evaluativa.
                    </p>
                </div>

                <?php
            }
        }
                ?>
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