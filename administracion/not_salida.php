<?php
$page = 'Nota_Salida';

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
                        <h1 class="card-title" style="font-size: 23px;">NOTA DE SALIDA</h1>
                    </div>

                    <div class="card-body">

                    <div class="row">

                     <div class="table-responsive col-md-6">
                                    <table id="Table" class="table text-center" style="width:100%; font-size: 12px; ">
                                        <tbody>
                                            <?php
                                            $query = "SELECT count(idNot_Salida) as total FROM `nota_salida`";
                                            $query_run = mysqli_query($con, $query);

                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $row) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <b>TOTAL DE NOTAS DE SALIDA</b>
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

                                <div class="table-responsive col-md-6">
                                    <table id="Table" class="table text-center" style="width:100%; font-size: 12px; ">
                                        <tbody>
                                            <?php
                                            $query = "SELECT count(idNot_Salida) as total FROM `nota_salida` where 
                                            estado=1";
                                            $query_run = mysqli_query($con, $query);

                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $row) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <b>NOTAS DE SALIDA PENDIENTES</b>
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

                                <div class="table-responsive col-md-6">
                                    <table id="Table" class="table text-center" style="width:100%; font-size: 12px; ">
                                        <tbody>
                                            <?php
                                            $query = "SELECT count(idNot_Salida) as total FROM `nota_salida` where
                                            estado=0";
                                            $query_run = mysqli_query($con, $query);

                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $row) {
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <b>NOTAS DE SALIDA APROBADAS</b>
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

                        <button id="btnNuevaNot" type="button" class="btn float-end <?php if ($page == 'NuevaNotaSalida') {
                                echo 'active'; 
                            } ?>" style="background-color: #dc3036; color:white"><i class="fa-solid fa-plus"></i> Crear Nota de Salida
                        </button>

                        <br>

                        <table id="myTable" class="table text-center"
                            style="width:100%; font-size: 12px;">
                            <thead style="background: #E8E8E8">
                                <tr>
                                    <th style="width:20%;">Fecha de Registro</th>                                 
                                    <th style="width:30%;">Usuario Encargado</th>
                                    <th style="width:20%;">Estado</th>
                                    <th style="width:20%;">TOTAL</th>
                                    <th style="width:20%;">Acciones</th>
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
                                $query = "SELECT ns.idNot_Salida, us.nombres as usuario,fecha,estado,total from nota_salida as ns
                                INNER JOIN usuario as us on ns.idUsuario = us.idUsuario order by fecha DESC;";
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
                                                    echo '<span class="badge badge-success">REALIZADO</span>';
                                                }
                                                if ($row['estado'] == 0) {
                                                    echo '<span class="badge badge-secondary">ELIMINADO</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?= $row['total'] ?>
                                            </td>
                                            <td>
                                                <!--Boton para ver en PDF -->    
                                                <?php
                                                    if ($row['estado'] == 1) {
                                                    ?>    
                                                <a href="reporte_not_salida.php?ns_id=<?= $row['idNot_Salida']; ?>"target="_blank">
                                                        <button type="button" class="btn btn-info btn-sm"><i class="fa-solid fa-eye"></i></button>
                                                    </a>
                                            
                                                
                                                <!--Boton para deshabilitar Nota Salida-->
                                                    <button type="button" value="<?= $row['idNot_Salida']; ?>"
                                                        class="delete_notSalidaBtn btn btn-danger btn-sm"><i
                                                            class="fa-solid fa-trash"></i>
                                                    </button>
                                                    <?php }
                                                    ?>

                                                    <?php
                                                    if ($row['estado'] == 0) {
                                                    ?>
                                                    <!--Boton para restaurar Nota Salida--> 
                                                        <button type="button" value="<?= $row['idNot_Salida']; ?>"
                                                        class="restore_notSalidaBtn btn btn-secondary btn-sm"><i
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
           /*   NUEVO REQUERIMIENTO */
        $(document).on('click', '#btnNuevaNot', function() {
        var nuevoq = $(this).val();
        $.ajax({
            type: "GET",
            url: "../datos/not_salidaDB.php?nuevoq=" + nuevoq,
            success: function(response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 200) {
                    window.location.href = "not_salidanuevo.php";

                } else {
                    alert(res.message);
                }
            }
        });
    });

    $(document).on('submit', '#save_notSalida', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("save_notSalida", true);

        $.ajax({
            type: "POST",
            url: "../datos/not_salidaDB.php",
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
                    $('#notSalidaAddModal').modal('hide');
                    $('#save_notSalida')[0].reset();
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


    $(document).on('click', '.delete_notSalidaBtn', function (e) {
        e.preventDefault();

        if (confirm('¿Estas seguro que deseas cambiar la condición de producto a "VENDIDO"?')) {
            var idNot_Salida = $(this).val();
            $.ajax({
                type: "POST",
                url: "../datos/not_salidaDB.php",
                data: {
                    'delete_notSalida': true,
                    'idNot_Salida': idNot_Salida
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

    $(document).on('click', '.restore_notSalidaBtn', function (e) {
        e.preventDefault();
        if (confirm('¿Estas seguro que deseas eliminar el Usuario de Requerimiento?')) {
            var idNot_Salida = $(this).val();
            $.ajax({
                type: "POST",
                url: "../datos/not_salidaDB.php",
                data: {
                    'restore_notSalida': true,
                    'idNot_Salida': idNot_Salida
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
