<?php
$page = 'Not_SalidaxFecha';
include_once 'nav.php';
require '../conexion.php';


?>

<section class="content-header">

</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="row">
                            <h1 class="card-title  justify-content-center text-center" style="font-size: 23px;"><b>Entradas de Productos por Fecha</b> </h1>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form name="form1">
                        <div class="card-body">

                            <div class="form row">
                                <div class="form-group col-md-3">
                                    <label for="">Fecha Inicio :</label>
                                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control pull-right" required>

                                </div>
                                <div class="form-group col-md-3">
                                    <label for="">Fecha Fin :</label>
                                    <input type="date" name="fecha_fin" id="fecha_fin" class="form-control pull-right" required>

                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>ㅤ</label>
                                        <button type="submit" class="btn btn-warning form-control" style="font-weight: 600;"> <i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
                                    </div>
                                </div>
                            
                              
                              
                            </div>

                        </div>
                    </form>
                </div>


                <div class="card card-primary">
                    <div class="card-header">
                    <div class="row">
                            <h1 class="card-title  justify-content-center text-center" style="font-size: 23px;"><b>REPORTE</b> </h1>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php
                        if (!empty($_GET)) {
                            $inicio = $_GET['fecha_inicio'];
                            $fin = $_GET['fecha_fin'];
                            if (1 == 0) {
                        ?>
                                <h4>No existe </h4>
                            <?php
                            } else {
                            ?>

                                <table id="myTable" class="table text-center table-hover" style="width:100%;font-size: 12px;">
                                    <thead>
                                        <tr>
                                            <th>CODIGO</th>
                                            <th>Usuario Encargado</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                            <th>Total</th>
                                            <th>Reporte Detallado</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT nota_salida.idNot_Salida as codigo, usuario.nombres, nota_salida.fecha, nota_salida.estado, nota_salida.Total from nota_salida 
                                        INNER JOIN usuario on usuario.idUsuario = nota_salida.idUsuario
                                        WHERE nota_salida.fecha is not null and (nota_salida.fecha BETWEEN '$inicio' and '$fin');";
                                        $query_run = mysqli_query($con, $query);

                                        if (mysqli_num_rows($query_run) > 0) {
                                            foreach ($query_run as $row) {
                                        ?>
                                                <tr>
                                                    <td><?= 'SAL' . $row['codigo'] ?></td>
                                                    <td><?= $row['nombres'] ?></td>
                                                    <td><?= $row['fecha'] ?></td>
                                                    <td>
                                                <?php
                                                if ($row['estado'] == 1) {

                                                    echo '<span class="badge badge-success">ACTIVO</span>';
                                                }
                                                if ($row['estado'] == 2) {
                                                    echo '<span class="badge badge-info">NO ACTIVO</span>';
                                                }
                                                if ($row['estado'] == 0) {
                                                    echo '<span class="badge badge-danger">ELIMINADO</span>';
                                                }
                                                ?></td>
                                                <td><?= $row['Total'] ?></td>
                                       
                                                     <td>

                                            <!--Boton para ver en PDF -->    
                                            <?php
                                                if ($row['estado'] == 1) {
                                                ?>    
                                          <a href="reporte_not_salida.php?ns_id=<?= $row['codigo']; ?>"target="_blank">
                                                        <button type="button" class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></button>
                                                    </a>
                                                <?php }
                                                ?>

                                            </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                        <?php

                            }
                        }
                        ?>
                    </div>
                    <!-- /.card-body -->

                </div>

            </div>

        </div>
        <!-- /.row -->
    </div>
</section>

<?php include_once 'footer.php'; ?>

<script>
    $('#myTable').DataTable({
        dom: 'Bfrtip',
        "order": [
            [0, "desc"]
        ],
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
        ]
    });
</script>