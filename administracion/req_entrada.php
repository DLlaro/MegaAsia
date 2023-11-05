<?php
$page = 'Requerimiento_Entrada';

include_once 'nav.php';
require '../conexion.php';
?>

<section class="content-header">
</section>
<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!--   Card de Admin -->
                <div class="card card-primary">

                    <div class="card-header">
                        <h1 class="card-title" style="font-size: 23px;">Requerimiento de Entrada</h1>
                    </div>

                    <div class="card-body">

                    <div class="row">

                     <div class="table-responsive">
                                    <table id="Table" class="table text-center" style="width:100%; font-size: 12px; ">
                                        <tbody>
                                            <?php
                                            $query = "SELECT count(idReq_Entrada) as total FROM `req_entrada`";
                                            $query_run = mysqli_query($con, $query);

                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $row) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <b>TOTAL DE REQUERIMIENTOS DE ENTRADA</b>
                                                        </td>
                                                        <td>
                                                            <b>
                                                                <?= $row['total'] ?>
                                                            </b>
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

                        <a href="req_entradanuevo.php"><button id="btnNuevoReq" type="button" class="btn float-end <?php if ($page == 'NuevoRequerimiento') {
                                echo 'active'; 
                            } ?>" style="background-color: #dc3036; color:white"><i class="fas fa-graduation-cap"></i> Crear Requerimiento Nuevo
                        </button></a>

                        <!--<button type="button" class="btn float-end <?php if ($page == 'NuevoRequerimiento') {
                                echo 'active';
                            } ?>" style="background-color: #049ca4; color:white"> <a href="req_entradanuevo.php" style="text-decoration: none; color: white"> <i class="fas fa-graduation-cap"></i> Crear Requerimiento</a>
                        </button>-->

                        <br>

                        <table id="myTable" class="table text-center"
                            style="width:100%; font-size: 12px;">
                            <thead style="background: #E8E8E8">
                                <tr>
                                    <th style="width:25%;">Fecha de Registro</th>                                 
                                    <th style="width:30%;">Usuario Encargado</th>
                                    <th style="width:20%;">Estado</th>
                                    <th style="width:50%;"></th>
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
                                $query = "SELECT re.idReq_Entrada, us.nombres as usuario,fecha,estado from req_entrada as re
                                INNER JOIN usuario as us on re.idUsuario = us.idUsuario order by fecha DESC;";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                        ?>
                                        <tr>
                                           
                                            <td>
                                                <?= $row['fecha'] ?>
                                            </td>
                                            <td>
                                                <?= $row['usuario'] ?>
                                            </td>
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
                                                ?>
                                            </td>
                                            <td>

                                            <!--Boton para ver en PDF -->    
                                            <?php
                                                if ($row['estado'] == 1) {
                                                ?>    
                                            <a href="reporte_req_entrada.php?rq_id=<?= $row['idReq_Entrada']; ?>"target="_blank">
                                                    <button type="button" class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></button>
                                                </a>
                                           
                                              
                                            <!--Boton para deshabilitar Requerimiento-->
                                                <button type="button" value="<?= $row['idReq_Entrada']; ?>"
                                                    class="delete_reqEntradaBtn btn btn-danger btn-sm"><i
                                                        class="fa-solid fa-trash"></i>
                                                </button>
                                                <?php }
                                                ?>

                                                <?php
                                                if ($row['estado'] == 0) {
                                                ?>
                                                <!--Boton para restaurar Requerimiento--> 
                                                    <button type="button" value="<?= $row['idReq_Entrada']; ?>"
                                                    class="restore_reqEntradaBtn btn btn-secondary btn-sm"><i
                                                        class="fa-solid fa-undo"></i></button>
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

                       
                    </div>
                </div>
                <!--   Card de Admin -->
            </div>
        </div>
    </div>
</section>

<?php include_once 'footer.php'; ?>

<script>

    $(document).on('submit', '#save_reqEntrada', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("save_reqEntrada", true);

        $.ajax({
            type: "POST",
            url: "../datos/req_entradaDB.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 422) {
                    $('#errorMessage').removeClass('d-none');
                    $('#errorMessage').text(res.message);

                } else if (res.status == 200) {

                    $('#errorMessage').addClass('d-none');
                    $('#reqEntradaAddModal').modal('hide');
                    $('#save_reqEntrada')[0].reset();
                    location.reload();

                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);

                    $('#myTable').load(location.href + " #myTable");

                } else if (res.status == 500) {
                    alert(res.message);
                }
            }
        });

    });


    $(document).on('click', '.delete_reqEntradaBtn', function (e) {
        e.preventDefault();

        if (confirm('¿Estas seguro que deseas cambiar la condición de producto a "VENDIDO"?')) {
            var idReq_Entrada = $(this).val();
            $.ajax({
                type: "POST",
                url: "../datos/req_entradaDB.php",
                data: {
                    'delete_reqEntrada': true,
                    'idReq_Entrada': idReq_Entrada
                },
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 500) {

                        alert(res.message);
                    } else {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");
                    }
                }
            });
        }
    });

    $(document).on('click', '.restore_reqEntradaBtn', function (e) {
        e.preventDefault();
        if (confirm('¿Estas seguro que deseas eliminar el Usuario de Requerimiento?')) {
            var idReq_Entrada = $(this).val();
            $.ajax({
                type: "POST",
                url: "../datos/req_entradaDB.php",
                data: {
                    'restore_reqEntrada': true,
                    'idReq_Entrada': idReq_Entrada
                },
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 500) {

                        alert(res.message);
                    } else {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");
                    }
                }
            });
        }
    });



    $('#myTable').DataTable({
        dom: 'Bfrtip',
        "bSort": true,
        "order": [],
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
        ]
    });
  
</script>
