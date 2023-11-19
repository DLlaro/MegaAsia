<?php
$page = 'Inventario';

include_once 'nav.php';
require '../conexion.php';
?>

<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!--   Card de Usuario -->
                <div class="card card-primary">

                    <div class="card-header" style="background-color:#dc3036">
                        <h1 class="card-title" style="font-size: 23px;">Inventario</h1>
                    </div>

                    <div class="card-body">
                        <table id="myTable" class="table text-center table-responsive" style="width:100%; font-size: 12px;">
                            <thead>
                                <tr>
                                    <th style="width:10%;">idProducto</th>
                                    <th style="width:20%;">Producto</th>
                                    <th style="width:15%;">Precio</th>
                                    <th style="width:20%;">Estado</th>
                                    <th style="width:15%;">Stock</th>
                                    <th style="width:15%;">Salidas</th>
                                    <th style="width:15%;">Entradas</th>
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
                                $query = "SELECT p.idProducto,CONCAT_WS(' ',p.producto, 'marca',m.marca) as descripcion,p.precio,p.estado,p.stock, 
                                (select sum(cantidad) from det_not_salida dns where dns.idProducto = p.idProducto ) as salida, 
                                (select sum(cantidadIngresada) from det_req_entrada dre where dre.idProducto = p.idProducto ) as entrada
                                FROM productos p 
                                INNER JOIN marca m on m.idMarca=p.idMarca group by p.idProducto;";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $row['idProducto'] ?>
                                            </td>
                                            <td>
                                                <?= $row['descripcion'] ?>
                                            </td>
                                            <td>
                                                <?= $row['precio'] ?>
                                            </td>
                                            <td>
                                            <?php
                                                if ($row['estado'] == 1) {

                                                    echo '<span class="badge badge-success">DISPONIBLE</span>';
                                                }
                                                if ($row['estado'] == 2) {
                                                    echo '<span class="badge badge-secondary">AGOTADO</span>';
                                                }
                                                if ($row['estado'] == 0) {
                                                    echo '<span class="badge badge-danger">ELIMINADO</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?= $row['stock'] ?>
                                            </td>
                                           
                                            <td>
                                                <?= $row['salida'] ?>
                                            </td>
                                            <td>
                                                <?= $row['entrada'] ?>
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
