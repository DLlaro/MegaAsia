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

//contar total notas de salida
$contar_notsalida = "SELECT COUNT(idNot_Salida) as totalnotsalida FROM nota_salida where estado=1";
$querycontar_notsalida = $con->query($contar_notsalida);
$total_notsalida = $querycontar_notsalida->fetch_assoc();

//grafico circular 1
$grafico01 = "SELECT count(*) as activos, (SELECT count(*) FROM req_entrada where estado = '0') as inactivos 
FROM req_entrada where estado = '1';";
$grafico_01 = $con->query($grafico01);
$row_01 = $grafico_01->fetch_assoc();

//grafico donut 2
$query = "SELECT total, idNot_Salida
FROM nota_salida where estado = '1'";
$query_run = mysqli_query($con, $query);
$datos = array();
foreach ($query_run as $row) {
  $datos[]=$row;    
}

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
            <p><b>Total de Productos</b></p>
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
            <p><b>Proveedores Asociados</b></p>
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
            <p><b>Req. de Entrada</b></p>
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
            <?= $total_notsalida['totalnotsalida']; ?>
            </h3>
            <p><b>Req. de Salida</b></p>
          </div>
          <div class="icon">
          <i class="fa-solid fa-dolly"></i>
          </div>
          <a href="req_salida.php" class="small-box-footer">
          Ver más <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <!-- PIE CHART -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Seguimiento de Nota de Entrada</h3>

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
          <canvas id="pieChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

      <div class="col-md-6">
        <!-- PIE CHART -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Monto Total por Nota de Salida</h3>

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
            <canvas id="pieChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
          </div>

        </div>

      </div>

      <div class="col-md-7">
        <div class="card">
          <div class="card-header" style="background-color: #424242; color: white">
            <div class="row">
              <h3 class="card-title">Últimos Productos Agregados</h3>
            </div>
          </div>
          <div class="card-body p-0" style="font-size:15px">
            <div class="table-responsive">
              <table class="table m-0 table-striped table-valign-middle">
              <thead>
                                <tr>
                                    <th style="width:20%;">Producto</th>
                                    <th style="width:15%;">Marca</th>
                                    <th style="width:15%;">Categoria</th>
                                    <th style="width:10%;">Precio</th>
                                </tr>
                            </thead>
                            <tbody id="tablahover">
                                <?php
                                $query = "SELECT idProducto,producto,marca.marca,categoria.categoria, precio FROM `productos`
                                INNER JOIN marca on marca.idMarca=productos.idMarca
                                INNER JOIN categoria on categoria.idCategoria = productos.idCategoria
                                ORDER by idProducto DESC LIMIT 0,10;";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $row['producto'] ?>
                                            </td>
                                            <td>
                                                <?= $row['marca'] ?>
                                            </td>
                                            <td>
                                                <?= $row['categoria'] ?>
                                            </td>
                                           
                                            <td>
                                                <?= $row['precio'] ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
              </table>

            </div>
          </div>
          <div class="card-footer clearfix">
          <a href="producto.php" class="btn btn-sm btn-warning float-left">Ver Todos los Productos</a>
          </div>

        </div>
      </div>
      <div class="col-md-5">
      <div class="card">
          <div class="card-header" style="background-color: #424242; color: white">
            <div class="row">
              <h3 class="card-title">Últimos Usuarios Agregados</h3>
            </div>
          </div>
          <div class="card-body p-0" style="font-size:15px">
            <div class="table-responsive">
              <table class="table m-0 table-striped table-valign-middle">
              <thead>
                                <tr>
                                    <th style="width:20%;">Nombres</th>
                                    <th style="width:25%;">Tipo de Administrador</th>
                                   
                                </tr>
                            </thead>
                            <tbody id="tablahover">
                                <?php
                                $query = "SELECT nombres, administrador.admin as tipoadmin FROM `usuario`
                                INNER JOIN administrador on administrador.idAdministrador=usuario.idAdministrador
                                ORDER by idUsuario DESC LIMIT 0,10;";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $row['nombres'] ?>
                                            </td>
                                            <td>
                                                <?= $row['tipoadmin'] ?>
                                            </td>
                                           
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
              </table>

            </div>
          </div>
          <div class="card-footer clearfix">
          <a href="usuario.php" class="btn btn-sm btn-warning float-left">Ver Todos los Usuarios</a>
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

<script>
  /* GRAFICO DE CIRCULAR 02  */

  var donutData1 = {
    labels: [
      'ACTIVOS',
      'INACTIVOS',

    ],
    datasets: [{
      data: [<?= $row_01['activos']; ?>, <?= $row_01['inactivos']; ?>],
      backgroundColor: ['#FAAE16', '#dc3036'],
    }]
  }
  var pieChartCanvas = $('#pieChart1').get(0).getContext('2d')
  var pieData = donutData1;
  var pieOptions = {
    maintainAspectRatio: false,
    responsive: true,
  }

  new Chart(pieChartCanvas, {
    type: 'pie',
    data: pieData,
    options: pieOptions
  })
  /////////////////////////////////////Grafico donut
  let datitos = []
  datitos =  <?php echo json_encode($datos)?>;
  let data = [];
  let ids = [];
  //arreglo de colores 
  var colorArray = [ '#FF33FF', '#FFFF99', '#00B3E6', 
		  '#E6B333', '#3366E6', '#999966', '#99FF99', '#B34D4D',
		  '#80B300', '#809900', '#E6B3B3', '#6680B3', '#66991A', 
		  '#FF99E6', '#CCFF1A', '#FF1A66', '#E6331A', '#33FFCC',
		  '#66994D', '#B366CC', '#4D8000', '#B33300', '#CC80CC', 
		  '#66664D', '#991AFF', '#E666FF', '#4DB3FF', '#1AB399',
		  '#E666B3', '#33991A', '#CC9999', '#B3B31A', '#00E680', 
		  '#4D8066', '#809980', '#E6FF80', '#1AFF33', '#999933',
		  '#FF3380', '#CCCC00', '#66E64D', '#4D80CC', '#9900B3', 
		  '#E64D66', '#4DB380', '#FF4D4D', '#99E6E6', '#6666FF'];
  for (var i in datitos) {
    data.push(parseInt(datitos[i].total,10));
    ids.push("NS "+datitos[i].idNot_Salida);
  }
  var donutData2 = {
    labels: ids,
    datasets: [{
      data: data
      ,
      backgroundColor: colorArray,
    }]
  }
  var pieChartCanvas2 = $('#pieChart2').get(0).getContext('2d')
  var pieData2 = donutData2;
  var pieOptions2 = {
    maintainAspectRatio: false,
    responsive: true,
  }

  new Chart(pieChartCanvas2, {
    type: 'doughnut',
    data: pieData2,
    options: pieOptions2
  })
</script>
