<?php
$page = 'home';
include_once 'nav.php';
require '../conexion.php';

/* ------------- VARIABLES GENERALES ------------------ */

//Contar total de productos con estado activo
$contarproducto = "SELECT COUNT(idProducto) as totalproductos FROM productos where estado=1";
$querycontarproducto = $con->query($contarproducto);
$totalproductos = $querycontarproducto->fetch_assoc();

//contar total de proveedores
$contarproveedor = "SELECT COUNT(idProveedor) as totalproveedores FROM proveedor where estado=1";
$querycontarproveedor = $con->query($contarproveedor);
$totalproveedores = $querycontarproveedor->fetch_assoc();

//contar total de requerimientos de entrada
$contar_reqentrada = "SELECT COUNT(idReq_Entrada) as totalreqentrada FROM req_entrada where estado=1";
$querycontar_reqentrada = $con->query($contar_reqentrada);
$total_reqentrada = $querycontar_reqentrada->fetch_assoc();

//contar total de requerimientos de salida



?>

<link rel="stylesheet" href="../2_Negocio/css/css.css">

<section class="content-header">
</section>

<section class="content">
  <div class="container-fluid">
    <!-- ------------------MENU DE INFORMACION---------------- -->
    <div class="row">
      <div class="col-lg-3 col-4">
        <!-- small box -->
        <div class="small-box  bg-gradient-info  ">
          <div class="inner">
            <?php

            ?>
            <h3>
            <?= $totalproductos['totalproductos']; ?>
            </h3>
            <p>Total de Productos</p>
          </div>
          <div class="icon">
          <i class="fa-solid fa-box-open"></i>
          </div>
          <a href="producto.php" class="small-box-footer">
          Ver más <i class="fas fa-arrow-circle-right"></i>
          </a>

        </div>
      </div>

      <div class="col-lg-3 col-4">
        <!-- small box -->
        <div class="small-box  bg-gradient-danger  ">
          <div class="inner">
            <?php

            ?>
            <h3>
            <?= $totalproveedores['totalproveedores']; ?>
            </h3>
            <p>Proveedores Asociados</p>
          </div>
          <div class="icon">
          <i class="fa-solid fa-truck-field"></i>
          </div>
          <a href="proveedor.php" class="small-box-footer">
          Ver más <i class="fas fa-arrow-circle-right"></i>
          </a>

        </div>
      </div>

      <div class="col-lg-3 col-4">
        <!-- small box -->
        <div class="small-box  bg-gradient-warning">
          <div class="inner">
            <?php

            ?>
            <h3>
            <?= $total_reqentrada['totalreqentrada']; ?>
            </h3>
            <p>Req. de Entrada</p>
          </div>
          <div class="icon">
          <i class="fa-solid fa-truck-ramp-box"></i>
          </div>
          <a href="req_entrada.php" class="small-box-footer">
          Ver más <i class="fas fa-arrow-circle-right"></i>
          </a>

        </div>
      </div>

      <div class="col-lg-3 col-4">
        <!-- small box -->
        <div class="small-box  bg-gradient-success">
          <div class="inner">
            <?php

            ?>
            <h3>

            </h3>
            <p>Req. de Salida</p>
          </div>
          <div class="icon">
          <i class="fa-solid fa-dolly"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <!-- PIE CHART -->
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Diagrama 1</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <canvas id="pieChart" style="min-height: 180px; height: 180px; max-height: 180px; max-width: 100%;"></canvas>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

      <div class="col-md-4">
        <!-- PIE CHART -->
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Diagrama 2</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <canvas id="pieChart1" style="min-height: 180px; height: 180px; max-height: 180px; max-width: 100%;"></canvas>
          </div>

        </div>

      </div>
      
      <div class="col-md-4">
        <!-- PIE CHART -->
        <div class="card card-danger">
          <div class="card-header">
            <h3 class="card-title">Diagrama 3</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <canvas id="pieChart2" style="min-height: 180px; height: 180px; max-height: 180px; max-width: 100%;"></canvas>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

      <div class="col-md-12">
        <div class="card card-warning">
          <div class="card-header">
            <div class="row">
              <h3 class="card-title  justify-content-center text-center"> <B> Tabla</B></h3>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>

        </div>
      </div>
      
      <!--<div class="col-md-6">
        <div class="card card-success">
          <div class="card-header">
            <div class="row">
              <h3 class="card-title  justify-content-center text-center"> <B>Incidencias por Horario</B></h3>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="barChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>

        </div>
      </div>-->

    </div>


</section>



<?php include_once 'footer.php'; ?>
<script src="../css/plugins/chart.js/Chart.min.js"></script>


<!-- jQuery -->
<script src="../css/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../css/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../css/dist/js/adminlte.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- Bootstrap 4 -->
<script src="../css/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="../css/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../css/plugins/toastr/toastr.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="../css/dist/js/demo.js"></script>

<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

