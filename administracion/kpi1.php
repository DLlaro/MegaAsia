<?php
$page = 'KPI';

include_once 'nav.php';
require '../conexion.php';
?>

<section class="content-header">
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!--   Card de Usuario -->
                <div class="card card-primary">

                    <div class="card-header" style="background-color: #dc3036">
                        <h1 class="card-title" style="font-size: 23px;">KPI-Requerimientos por Trabajador</h1>
                    </div>

                    <div class="card-body">

                        
                        <table id="myTable" class="table text-center table-responsive" style="width:100%; font-size: 12px;">
                            <thead>
                                <tr>
                                    <th style="width:20%;">Nombre de Trabajador</th>
                                    <th style="width:10%;">Entradas Completadas</th>
                                    <th style="width:20%;">Salidas Completadas</th>
                                </tr>
                            </thead>
                            <style>
                                #tablahover td{
                                   
                                   justify-content: center;
                                   align-items: center;
                                    
                                }
                                #tablahover tr:hover{
                                    transition: 0.2s;
                                    background-color: #C9C9C9;
                                }
                            </style>
                            <tbody id="tablahover">
                                <?php
                                $query = "SELECT usuario.idUsuario, usuario.nombres,
                                (SELECT COUNT(*) from req_entrada 
                                 inner join usuario as usen on usen.idUsuario =req_entrada.idUsuario 
                                 WHERE req_entrada.idUsuario = usuario.idUsuario  and req_entrada.estado = 1) as Entradas,
                                 (SELECT COUNT(*) from nota_salida
                                 inner join usuario as usal on usal.idUsuario =nota_salida.idUsuario 
                                 WHERE nota_salida.idUsuario = usuario.idUsuario and nota_salida.estado = 1) as Salidas
                                from usuario
                                inner JOIN req_entrada on req_entrada.idUsuario = usuario.idUsuario WHERE usuario.usuarioEstado = 1
                                GROUP by usuario.nombres;";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $usuario) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $usuario['nombres'] ?>
                                            </td>
                                            <td>
                                                <?= $usuario['Entradas'] ?>
                                            </td>
                                            <td>
                                                <?= $usuario['Salidas'] ?>
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
                <!--   Card de usuario -->
            </div>
        </div>
    </div>
</section>

<?php include_once 'footer.php'; ?>

<script>
    $('#myTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
        ]
    });
</script>
