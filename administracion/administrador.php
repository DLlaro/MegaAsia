<?php
$page = 'Administrador';

include_once 'nav.php';
require '../conexion.php';
?>

<section class="content-header">
</section>
<section class="content">

    <!-- Add Usuario -->
    <div class="modal fade" id="administradorAddModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Tipo de Administrador Nuevo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="saveAdministrador">
                    <div class="modal-body">

                        <div id="errorMessage" class="alert alert-warning d-none"></div>

                        <div class="mb-3">
                            <label for="">Administrador:</label>
                            <input type="text" name="admin" id="admin" class="form-control" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn" style="background-color: #dc3036; color:white">Guardar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit usuario Modal -->
    <div class="modal fade" id="administradorEditModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Tipo de Administrador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateAdministrador">
                    <div class="modal-body">
                        <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                        <input type="hidden" name="idAdministrador" id="idAdministrador" />

                        <div class="mb-3">
                            <label for="">Administrador:</label>
                            <input type="text" name="admin" id="admin" class="form-control" />
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn" style="background-color: #dc3036; color:white">Actualizar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!--   Card de Admin -->
                <div class="card card-primary">

                    <div class="card-header" style="background-color:#dc3036">
                        <h1 class="card-title" style="font-size: 23px;">Administradores</h1>
                    </div>

                    <div class="card-body">

                        <button type="button" class="btn float-end" style="background-color: #dc3036; color:white" data-bs-toggle="modal"
                            data-bs-target="#administradorAddModal"><i class="fa-solid fa-plus"></i> Agregar 
                            Administrador
                        </button>
                        <br>
                        <table id="myTable" class="table text-center"
                            style="width:100%; font-size: 12px;">
                            <thead>
                                <tr>
                                    <th style="width:50%;">Tipo de Administrador</th>
                                    <th style="width:40%;">ESTADO</th>
                                    <th style="width:40%;"></th>
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
                                $query = "SELECT * FROM administrador";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $usuario) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $usuario['admin'] ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($usuario['estado'] == 1) {

                                                    echo '<span class="badge badge-success">ACTIVO</span>';
                                                }
                                                if ($usuario['estado'] == 2) {
                                                    echo '<span class="badge badge-info">NO ACTIVO</span>';
                                                }
                                                if ($usuario['estado'] == 0) {
                                                    echo '<span class="badge badge-danger">ELIMINADO</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                            <?php
                                                if ($usuario['estado'] == 1) {
                                                ?>   
                                                
                                                <button type="button" value="<?= $usuario['idAdministrador']; ?>"
                                                    class="editAdministradorBtn btn btn-success btn-sm"><i
                                                        class="fa-solid fa-edit"></i></button>
                                                <button type="button" value="<?= $usuario['idAdministrador']; ?>"
                                                    class="deleteAdministradorBtn btn btn-danger btn-sm"><i
                                                        class="fa-solid fa-trash"></i></button>
                                                        <?php }
                                                ?>

                                                <?php
                                                if ($usuario['estado'] == 0) {
                                                ?>
                                                
                                                <button type="button" value="<?= $usuario['idAdministrador']; ?>"
                                                    class="restoreAdministradorBtn btn btn-secondary btn-sm"><i
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
    $(document).on('submit', '#saveAdministrador', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("save_administrador", true);

        $.ajax({
            type: "POST",
            url: "../datos/administradorDB.php",
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
                    $('#administradorAddModal').modal('hide');
                    $('#saveAdministrador')[0].reset();

                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);

                    //$('#myTable').load(location.href + " #myTable");
                    location.reload();

                } else if (res.status == 500) {
                    alert(res.message);
                }
            }
        });

    });

    $(document).on('click', '.editAdministradorBtn', function () {

        var idAdministrador = $(this).val();

        $.ajax({
            type: "GET",
            url: "../datos/administradorDB.php?idAdministrador=" + idAdministrador,
            success: function (response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    alert(res.message);
                } else if (res.status == 200) {

                    $('#idAdministrador').val(res.data.idAdministrador);
                    $('#admin').val(res.data.admin);
                    $('#administradorEditModal').modal('show');
                }
            }
        });
    });

    $(document).on('submit', '#updateAdministrador', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("update_administrador", true);

        $.ajax({
            type: "POST",
            url: "../datos/administradorDB.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 422) {
                    $('#errorMessageUpdate').removeClass('d-none');
                    $('#errorMessageUpdate').text(res.message);

                } else if (res.status == 200) {

                    $('#errorMessageUpdate').addClass('d-none');

                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);

                    $('#administradorEditModal').modal('hide');
                    $('#updateAdministrador')[0].reset();

                    //$('#myTable').load(location.href + " #myTable");
                    location.reload();

                } else if (res.status == 500) {
                    alert(res.message);
                }
            }
        });

    });

    $(document).on('click', '.deleteAdministradorBtn', function (e) {
        e.preventDefault();

        if (confirm('¿Estas seguro que deseas eliminar el tipo de administrador?')) {
            var idAdministrador = $(this).val();
            $.ajax({
                type: "POST",
                url: "../datos/administradorDB.php",
                data: {
                    'delete_administrador': true,
                    'idAdministrador': idAdministrador
                },
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 500) {

                        alert(res.message);
                    } else {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                       //$('#myTable').load(location.href + " #myTable");
                    location.reload();
                    }
                }
            });
        }
    });

    $(document).on('click', '.restoreAdministradorBtn', function (e) {
        e.preventDefault();

        if (confirm('¿Estas seguro que deseas restaurar el tipo de Administrador?')) {
            var idAdministrador = $(this).val();
            $.ajax({
                type: "POST",
                url: "../datos/administradorDB.php",
                data: {
                    'restore_administrador': true,
                    'idAdministrador': idAdministrador
                },
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if (res.status == 500) {

                        alert(res.message);
                    } else {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(res.message);

                       //$('#myTable').load(location.href + " #myTable");
                    location.reload();
                    }
                }
            });
        }
    });

    $('#myTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
        ]
    });
</script>