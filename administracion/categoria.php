<?php
$page = 'Categoria';

include_once 'nav.php';
require '../conexion.php';
?>

<section class="content-header">
</section>
<section class="content">

    <!-- Add Usuario -->
    <div class="modal fade" id="categoriaAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Categoria Nueva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="saveCategoria">
                    <div class="modal-body">

                        <div id="errorMessage" class="alert alert-warning d-none"></div>

                        <div class="mb-3">
                            <label for="">Nombre de la Categoria:</label>
                            <input type="text" name="categoria"  class="form-control" />
                            <label for="">Descripcion:</label>
                            <input type="text" name="descripcion" class="form-control" />
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
    <div class="modal fade" id="categoriaEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Categoria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateCategoria">
                    <div class="modal-body">
                        <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                        <input type="hidden" name="idCategoria" id="idCategoria" />

                        <div class="mb-3">
                            <label for="">Nombre de Categoria:</label>
                            <input type="text" name="categoria" id="categoria" class="form-control" />
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
                        <h1 class="card-title" style="font-size: 23px;">Categorias</h1>
                    </div>

                    <div class="card-body">

                        <button type="button" class="btn float-end" style="background-color: #dc3036; color:white" data-bs-toggle="modal"
                            data-bs-target="#categoriaAddModal"><i class="fa-solid fa-plus"></i> Agregar Categoria
                        </button>
                        <br>
                        <table id="myTable" class="table text-center table-responsive" style="width:100%; font-size: 12px;">
                            <thead>
                                <tr>
                                    <th style="width:10%;">idCategoria</th>
                                    <th style="width:20%;">Categoria</th>
                                    <th style="width:20%;">Descripcion</th>
                                    <th style="width:20%;">Estado</th>
                                    <th style="width:20%;"></th>
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
                                $query = "SELECT * FROM categoria";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $row['idCategoria'] ?>
                                            </td>
                                            <td>
                                                <?= $row['categoria'] ?>
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
                                                
                                                <button type="button" value="<?= $row['idCategoria']; ?>"
                                                    class="editCategoriaBtn btn btn-success btn-sm"><i
                                                        class="fa-solid fa-edit"></i></button>
                                                <button type="button" value="<?= $row['idCategoria']; ?>"
                                                    class="deleteCategoriaBtn btn btn-danger btn-sm"><i
                                                        class="fa-solid fa-trash"></i></button>
                                                        <?php }
                                                ?>

                                                <?php
                                                if ($row['estado'] == 0) {
                                                ?>
                                                 <button type="button" value="<?= $row['idCategoria']; ?>"
                                                    class="restoreCategoriaBtn btn btn-secondary btn-sm"><i
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
    $(document).on('submit', '#saveCategoria', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("save_categoria", true);

        $.ajax({
            type: "POST",
            url: "../datos/categoriaDB.php",
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
                    $('#categoriaAddModal').modal('hide');
                    $('#saveCategoria')[0].reset();

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

    $(document).on('click', '.editCategoriaBtn', function () {

        var idCategoria = $(this).val();

        $.ajax({
            type: "GET",
            url: "../datos/categoriaDB.php?idCategoria=" + idCategoria,
            success: function (response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    alert(res.message);
                } else if (res.status == 200) {

                    $('#idCategoria').val(res.data.idCategoria);
                    $('#categoria').val(res.data.categoria);
                    $('#descripcion').val(res.data.descripcion);
                    $('#categoriaEditModal').modal('show');
                }
            }
        });
    });

    $(document).on('submit', '#updateCategoria', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("update_categoria", true);

        $.ajax({
            type: "POST",
            url: "../datos/categoriaDB.php",
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

                    $('#categoriaEditModal').modal('hide');
                    $('#updateCategoria')[0].reset();

                    //$('#myTable').load(location.href + " #myTable");
                    location.reload();

                } else if (res.status == 500) {
                    alert(res.message);
                }
            }
        });

    });

    $(document).on('click', '.deleteCategoriaBtn', function (e) {
        e.preventDefault();

        if (confirm('¿Estas seguro que deseas eliminar la categoria?')) {
            var idCategoria = $(this).val();
            $.ajax({
                type: "POST",
                url: "../datos/categoriaDB.php",
                data: {
                    'delete_categoria': true,
                    'idCategoria': idCategoria
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

    $(document).on('click', '.restoreCategoriaBtn', function (e) {
        e.preventDefault();

        if (confirm('¿Estas seguro que deseas restaurar el registro?')) {
            var idCategoria = $(this).val();
            $.ajax({
                type: "POST",
                url: "../datos/categoriaDB.php",
                data: {
                    'restore_categoria': true,
                    'idCategoria': idCategoria
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