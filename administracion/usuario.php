<?php
$page = 'Usuario';

include_once 'nav.php';
require '../conexion.php';
?>

<section class="content-header">
</section>
<section class="content">

    <!-- Add Usuario -->
    <div class="modal fade" id="usuarioAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Usuario Nuevo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="saveUsuario">
                    <div class="modal-body">

                        <div id="errorMessage" class="alert alert-warning d-none"></div>

                        <div class="mb-3">
                            <label for="">Correo:</label>
                            <input type="text" name="usuariocorreo" id="usuariocorreo" class="form-control" />
                            <label for="">Contraseña:</label>
                            <input type="text" name="contraseña" id="contraseña" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="">Nombres:</label>
                            <input type="text" name="nombres" id="nombres" class="form-control" />
                            <label for="">Tipo Administrador:</label>
                            <?php
                            $query = "SELECT * FROM administrador where estado in(1)";
                            $query_run = mysqli_query($con, $query); ?>
                            <select name="idAdministrador" id="idAdministrador" class="form-control">
                                <?php
                                while ($ver = mysqli_fetch_row($query_run)): ?>
                                    <option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn" style="background-color: #079ea1; color:white">Guardar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit usuario Modal -->
    <div class="modal fade" id="usuarioEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateUsuario">
                    <div class="modal-body">
                        <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                        <input type="hidden" name="idUsuario" id="idUsuario" />

                        <div class="mb-3">
                            <label for="">Correo:</label>
                            <input type="text" name="usuariocorreo" id="usuariocorreo" class="form-control" />
                            <label for="">Contraseña:</label>
                            <input type="text" name="contraseña" id="contraseña" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="">Nombres:</label>
                            <input type="text" name="nombres" id="nombres" class="form-control" />
                            <label for="">Tipo Administrador:</label>
                            <?php
                            $query = "SELECT * FROM administrador where estado in(1)";
                            $query_run = mysqli_query($con, $query); ?>
                            <select name="idAdministrador" id="idAdministrador" class="form-control">
                                <?php
                                while ($ver = mysqli_fetch_row($query_run)): ?>
                                    <option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn" style="background-color: #079ea1; color:white">Actualizar </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!--   Card de Usuario -->
                <div class="card card-primary">

                    <div class="card-header" style="background-color: #dc3036">
                        <h1 class="card-title" style="font-size: 23px;">Usuarios</h1>
                    </div>

                    <div class="card-body">

                        <button type="button" class="btn float-end" style="background-color: #dc3036; color:white" data-bs-toggle="modal"
                            data-bs-target="#usuarioAddModal"><i class="fas fa-graduation-cap"></i> Agregar Usuario
                        </button>
                        <br>
                        <table id="myTable" class="table text-center table-responsive" style="width:100%; font-size: 12px;">
                            <thead>
                                <tr>
                                    <th style="width:20%;">NOMBRES</th>
                                    <th style="width:10%;">Tipo de Administrador</th>
                                    <th style="width:20%;">CORREOS</th>
                                    <th style="width:20%;">CONTRASEÑA</th>
                                    <th style="width:20%;">ESTADO</th>
                                    <th style="width:20%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM usuario 
                                            inner join administrador as admin on admin.idAdministrador = usuario.idAdministrador";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $usuario) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $usuario['nombres'] ?>
                                            </td>
                                            <td>
                                                <?= $usuario['admin'] ?>
                                            </td>
                                            <td>
                                                <?= $usuario['usuariocorreo'] ?>
                                            </td>
                                            <td>
                                                <?= $usuario['contraseña'] ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($usuario['usuarioEstado'] == 1) {

                                                    echo '<span class="badge badge-success">ACTIVO</span>';
                                                }
                                                if ($usuario['usuarioEstado'] == 2) {
                                                    echo '<span class="badge badge-info">NO ACTIVO</span>';
                                                }
                                                if ($usuario['usuarioEstado'] == 0) {
                                                    echo '<span class="badge badge-danger">ELIMINADO</span>';
                                                }
                                                ?>
                                            </td>


                                            <td>
                                            <?php
                                                if ($usuario['usuarioEstado'] == 1) {
                                                ?>
                                               
                                                <button type="button" value="<?= $usuario['idUsuario']; ?>"
                                                    class="editUsuarioBtn btn btn-success btn-sm"><i
                                                        class="fa-solid fa-edit"></i></button>
                                                <button type="button" value="<?= $usuario['idUsuario']; ?>"
                                                    class="deleteUsuarioBtn btn btn-danger btn-sm"><i
                                                        class="fa-solid fa-trash"></i></button>
                                                        <?php }
                                                ?>

                                                 <?php
                                                if ($usuario['usuarioEstado'] == 0) {
                                                ?>
                                                 <button type="button" value="<?= $usuario['idUsuario']; ?>"
                                                    class="restoreUsuarioBtn btn btn-secondary btn-sm"><i
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
                <!--   Card de usuario -->
            </div>
        </div>
    </div>
</section>

<?php include_once 'footer.php'; ?>

<script>
    $(document).on('submit', '#saveUsuario', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("save_usuario", true);

        $.ajax({
            type: "POST",
            url: "../datos/usuarioDB.php",
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
                    $('#usuarioAddModal').modal('hide');
                    $('#saveUsuario')[0].reset();

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

    $(document).on('click', '.editUsuarioBtn', function () {

        var idUsuario = $(this).val();

        $.ajax({
            type: "GET",
            url: "../datos/usuarioDB.php?idUsuario=" + idUsuario,
            success: function (response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    alert(res.message);
                } else if (res.status == 200) {

                    $('#idUsuario').val(res.data.idUsuario);
                    $('#usuariocorreo').val(res.data.usuariocorreo);
                    $('#contraseña').val(res.data.contraseña);
                    $('#nombres').val(res.data.nombres);
                    $('#idAdministrador').val(res.data.idAdministrador);
                    $('#usuarioEditModal').modal('show');
                }
            }
        });
    });

    $(document).on('submit', '#updateUsuario', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("update_usuario", true);

        $.ajax({
            type: "POST",
            url: "../datos/usuarioDB.php",
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

                    $('#usuarioEditModal').modal('hide');
                    $('#updateUsuario')[0].reset();

                    //$('#myTable').load(location.href + " #myTable");
                    location.reload();

                } else if (res.status == 500) {
                    alert(res.message);
                }
            }
        });

    });

    $(document).on('click', '.deleteUsuarioBtn', function (e) {
        e.preventDefault();

        if (confirm('¿Estas seguro que deseas eliminar el usuario?')) {
            var idUsuario = $(this).val();
            $.ajax({
                type: "POST",
                url: "../datos/usuarioDB.php",
                data: {
                    'delete_usuario': true,
                    'idUsuario': idUsuario
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

    $(document).on('click', '.restoreUsuarioBtn', function (e) {
        e.preventDefault();

        if (confirm('¿Estas seguro que deseas restaurar el registro?')) {
            var idUsuario = $(this).val();
            $.ajax({
                type: "POST",
                url: "../datos/usuarioDB.php",
                data: {
                    'restore_usuario': true,
                    'idUsuario': idUsuario
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
