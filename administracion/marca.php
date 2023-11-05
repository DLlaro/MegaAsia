<?php
$page = 'Marca';

include_once 'nav.php';
require '../conexion.php';
?>

<section class="content-header">
</section>
<section class="content">

    <!-- Add Usuario -->
    <div class="modal fade" id="marcaAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Marca Nueva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="saveMarca">
                    <div class="modal-body">

                        <div id="errorMessage" class="alert alert-warning d-none"></div>

                        <div class="mb-3">
                            <label for="">Nombre de la Marca:</label>
                            <input type="text" name="marca"  class="form-control" />
                            <label for="">Descripcion:</label>
                            <input type="text" name="descripcion"  class="form-control" />
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
    <div class="modal fade" id="marcaEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateMarca">
                    <div class="modal-body">
                        <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                        <input type="hidden" name="idMarca" id="idMarca" />

                        <div class="mb-3">
                            <label for="">Nombre de Marca:</label>
                            <input type="text" name="marca" id="marca" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label for="">Descripcion:</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control" />
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
                <!--   Card de Usuario -->
                <div class="card card-primary">

                    <div class="card-header" style="background-color:#dc3036">
                        <h1 class="card-title" style="font-size: 23px;">Marcas</h1>
                    </div>

                    <div class="card-body">

                        <button type="button" class="btn float-end" style="background-color: #dc3036; color:white" data-bs-toggle="modal"
                            data-bs-target="#marcaAddModal"><i class="fas fa-graduation-cap"></i> Agregar Marca
                        </button>
                        <br>
                        <table id="myTable" class="table text-center table-responsive" style="width:100%; font-size: 12px;">
                            <thead>
                                <tr>
                                    <th style="width:20%;">idMarca</th>
                                    <th style="width:10%;">Marca</th>
                                    <th style="width:20%;">Descripcion</th>
                                    <th style="width:20%;">Estado</th>
                                    <th style="width:20%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM marca";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $row['idMarca'] ?>
                                            </td>
                                            <td>
                                                <?= $row['marca'] ?>
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
                                            <?php
                                                if ($row['estado'] == 1) {
                                                ?>
                                               
                                                <button type="button" value="<?= $row['idMarca']; ?>"
                                                    class="editMarcaBtn btn btn-success btn-sm"><i
                                                        class="fa-solid fa-edit"></i></button>
                                                <button type="button" value="<?= $row['idMarca']; ?>"
                                                    class="deleteMarcaBtn btn btn-danger btn-sm"><i
                                                        class="fa-solid fa-trash"></i></button>
                                                        <?php }
                                                ?>

                                                <?php
                                                if ($row['estado'] == 0) {
                                                ?>
                                                <button type="button" value="<?= $row['idMarca']; ?>"
                                                    class="restoreMarcaBtn btn btn-secondary btn-sm"><i
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
    $(document).on('submit', '#saveMarca', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("save_marca", true);

        $.ajax({
            type: "POST",
            url: "../datos/marcaDB.php",
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
                    $('#marcaAddModal').modal('hide');
                    $('#saveMarca')[0].reset();

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

    $(document).on('click', '.editMarcaBtn', function () {

        var idMarca = $(this).val();

        $.ajax({
            type: "GET",
            url: "../datos/marcaDB.php?idMarca=" + idMarca,
            success: function (response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    alert(res.message);
                } else if (res.status == 200) {

                    $('#idMarca').val(res.data.idMarca);
                    $('#marca').val(res.data.marca);
                    $('#descripcion').val(res.data.descripcion);
                    $('#marcaEditModal').modal('show');
                }
            }
        });
    });

    $(document).on('submit', '#updateMarca', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("update_marca", true);

        $.ajax({
            type: "POST",
            url: "../datos/marcaDB.php",
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

                    $('#marcaEditModal').modal('hide');
                    $('#updateMarca')[0].reset();

                   //$('#myTable').load(location.href + " #myTable");
                   location.reload();

                } else if (res.status == 500) {
                    alert(res.message);
                }
            }
        });

    });

    $(document).on('click', '.deleteMarcaBtn', function (e) {
        e.preventDefault();

        if (confirm('¿Estas seguro que deseas eliminar la marca?')) {
            var idMarca = $(this).val();
            $.ajax({
                type: "POST",
                url: "../datos/marcaDB.php",
                data: {
                    'delete_marca': true,
                    'idMarca': idMarca
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

    $(document).on('click', '.restoreMarcaBtn', function (e) {
        e.preventDefault();

        if (confirm('¿Estas seguro que deseas restaurar el registro?')) {
            var idMarca = $(this).val();
            $.ajax({
                type: "POST",
                url: "../datos/marcaDB.php",
                data: {
                    'restore_marca': true,
                    'idMarca': idMarca
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