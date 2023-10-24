<?php
$page = 'Proveedor';

include_once 'nav.php';
require '../conexion.php';
?>

<section class="content-header">
</section>
<section class="content">

    <!-- Add Usuario -->
    <div class="modal fade" id="proveedorAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Proveedor Nuevo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="saveProveedor">
                    <div class="modal-body">

                        <div id="errorMessage" class="alert alert-warning d-none"></div>

                        <div class="mb-3">
                            <label for="">Nombre del Proveedor:</label>
                            <input type="text" name="proveedor"  class="form-control" />
                            <label for="">Descripcion:</label>
                            <input type="text" name="descripcion"  class="form-control" />
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
    <div class="modal fade" id="proveedorEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateProveedor">
                    <div class="modal-body">
                        <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                        <input type="hidden" name="idProveedor" id="idProveedor" />

                        <div class="mb-3">
                            <label for="">Nombre del Proveedor:</label>
                            <input type="text" name="proveedor" id="proveedor" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="">Descripcion:</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control" />
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
                <!--   Card de Proveedor -->
                <div class="card card-primary">

                    <div class="card-header" style="background-color:#dc3036">
                        <h1 class="card-title" style="font-size: 23px;">Proveedores</h1>
                    </div>

                    <div class="card-body">

                        <button type="button" class="btn float-end" style="background-color: #dc3036; color:white" data-bs-toggle="modal"
                            data-bs-target="#proveedorAddModal"><i class="fas fa-graduation-cap"></i> Agregar Proveedor
                        </button>
                        <br>
                        <table id="myTable" class="table text-center table-responsive" style="width:100%; font-size: 12px;">
                            <thead>
                                <tr>
                                    <th style="width:20%;">idProveedor</th>
                                    <th style="width:10%;">Proveedor</th>
                                    <th style="width:20%;">Descripcion</th>
                                    <th style="width:20%;">Estado</th>
                                    <th style="width:20%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM proveedor";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $row['idProveedor'] ?>
                                            </td>
                                            <td>
                                                <?= $row['proveedor'] ?>
                                            </td>
                                            <td>
                                                <?= $row['descripcion'] ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row['estado'] == 1) {

                                                    echo '<span class="badge badge-success">ACTIVO</span>';
                                                }
                                                if ($row['estado'] == 2) {
                                                    echo '<span class="badge badge-info">NO ACTIVO</span>';
                                                }
                                                if ($row['estado'] ==0) {
                                                    echo '<span class="badge badge-danger">ELIMINADO</span>';
                                                }
                                                ?>
                                            </td>


                                            <td>
                                                <button type="button" value="<?= $row['idProveedor']; ?>"
                                                    class="restoreProveedorBtn btn btn-secondary btn-sm"><i
                                                        class="fa-solid fa-undo"></i></button>
                                                <button type="button" value="<?= $row['idProveedor']; ?>"
                                                    class="editProveedorBtn btn btn-success btn-sm"><i
                                                        class="fa-solid fa-edit"></i></button>
                                                <button type="button" value="<?= $row['idProveedor']; ?>"
                                                    class="deleteProveedorBtn btn btn-danger btn-sm"><i
                                                        class="fa-solid fa-trash"></i></button>
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
    $(document).on('submit', '#saveProveedor', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("save_proveedor", true);

        $.ajax({
            type: "POST",
            url: "../datos/proveedorDB.php",
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
                    $('#proveedorAddModal').modal('hide');
                    $('#saveProveedor')[0].reset();

                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);

                    $('#myTable').load(location.href + " #myTable");

                } else if (res.status == 500) {
                    alert(res.message);
                }
            }
        });

    });

    $(document).on('click', '.editProveedorBtn', function () {

        var idProveedor = $(this).val();

        $.ajax({
            type: "GET",
            url: "../datos/proveedorDB.php?idProveedor=" + idProveedor,
            success: function (response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    alert(res.message);
                } else if (res.status == 200) {

                    $('#idProveedor').val(res.data.idProveedor);
                    $('#proveedor').val(res.data.proveedor);
                    $('#descripcion').val(res.data.descripcion);
                    $('#proveedorEditModal').modal('show');
                }
            }
        });
    });

    $(document).on('submit', '#updateProveedor', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("update_proveedor", true);

        $.ajax({
            type: "POST",
            url: "../datos/proveedorDB.php",
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

                    $('#proveedorEditModal').modal('hide');
                    $('#updateProveedor')[0].reset();

                    $('#myTable').load(location.href + " #myTable");

                } else if (res.status == 500) {
                    alert(res.message);
                }
            }
        });

    });

    $(document).on('click', '.deleteProveedorBtn', function (e) {
        e.preventDefault();

        if (confirm('¿Estas seguro que deseas eliminar el Proveedor?')) {
            var idProveedor = $(this).val();
            $.ajax({
                type: "POST",
                url: "../datos/proveedorDB.php",
                data: {
                    'delete_proveedor': true,
                    'idProveedor': idProveedor
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

    $(document).on('click', '.restoreProveedorBtn', function (e) {
        e.preventDefault();

        if (confirm('¿Estas seguro que deseas restaurar el registro?')) {
            var idProveedor = $(this).val();
            $.ajax({
                type: "POST",
                url: "../datos/proveedorDB.php",
                data: {
                    'restore_proveedor': true,
                    'idProveedor': idProveedor
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
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', 'colvis'
        ]
    });
</script>