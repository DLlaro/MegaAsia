<?php
$page = 'Productos';

include_once 'nav.php';
require '../conexion.php';
?>

<section class="content-header">
</section>
<section class="content">

    <!-- Add Usuario -->
    <div class="modal fade" id="productoAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Producto Nuevo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="saveProducto">
                    <div class="modal-body row">

                        <div id="errorMessage" class="alert alert-warning d-none"></div>


                        <div class="mb-3 col-md-6">
                        <label for="">Producto:</label>
                            <input type="text" name="producto" class="form-control" />
                            
                            <label for="">Marca:</label>
                            <?php
                            $query = "SELECT * FROM marca where estado in(1)";
                            $query_run = mysqli_query($con, $query); ?>
                            <select name="idMarca"  class="form-control">
                            <option value=""></option>
                                <?php
                                while ($ver = mysqli_fetch_row($query_run)): ?>
                                    <option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?></option>
                                <?php endwhile; ?>
                            </select>

                            <label for="">Categoria:</label>
                            <?php
                            $query = "SELECT * FROM categoria where estado in(1)";
                            $query_run = mysqli_query($con, $query); ?>
                            <select name="idCategoria" class="form-control">
                            <option value=""></option>
                                <?php
                                while ($ver = mysqli_fetch_row($query_run)): ?>
                                    <option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?></option>
                                <?php endwhile; ?>
                            </select>

                            <label for="">Proveedor:</label>
                            <?php
                            $query = "SELECT * FROM proveedor where estado in(1)";
                            $query_run = mysqli_query($con, $query); ?>
                            <select name="idProveedor" class="form-control">
                                <option value=""></option>
                                <?php
                                while ($ver = mysqli_fetch_row($query_run)): ?>
                                    <option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?></option>
                                <?php endwhile; ?>
                            </select>


                        </div>



                        <div class="mb-3 col-md-6">
                        <label for="">Precio:</label>
                            <input type="text" name="precio" class="form-control" />
                            <label for="">Stock:</label>
                            <input type="number" name="stock" class="form-control" />




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
    <div class="modal fade" id="productoEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateProducto">
                    <div class="modal-body row">
                        <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                        <input type="hidden" name="idProducto" id="idProducto" />
                        <div class="mb-3 col-md-6">
                        <label for="">Producto:</label>
                            <input type="text" name="producto" id="producto" class="form-control" />

                            <label for="">Marca:</label>
                            <?php
                            $query = "SELECT * FROM marca where estado in(1)";
                            $query_run = mysqli_query($con, $query); ?>
                            <select name="idMarca" id="idMarca" class="form-control">
                            <option value=""></option>
                                <?php
                                while ($ver = mysqli_fetch_row($query_run)): ?>
                                    <option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?></option>
                                <?php endwhile; ?>
                            </select>

                            <label for="">Categoria:</label>
                            <?php
                            $query = "SELECT * FROM categoria where estado in(1)";
                            $query_run = mysqli_query($con, $query); ?>
                            <select name="idCategoria" id="idCategoria" class="form-control">
                            <option value=""></option>
                                <?php
                                while ($ver = mysqli_fetch_row($query_run)): ?>
                                    <option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?></option>
                                <?php endwhile; ?>
                            </select>

                            <label for="">Proveedor:</label>
                            <?php
                            $query = "SELECT * FROM proveedor where estado in(1)";
                            $query_run = mysqli_query($con, $query); ?>
                            <select name="idProveedor" id="idProveedor" class="form-control">
                            <option value=""></option>
                                <?php
                                while ($ver = mysqli_fetch_row($query_run)): ?>
                                    <option value="<?php echo $ver[0] ?>"><?php echo $ver[1]; ?></option>
                                <?php endwhile; ?>
                            </select>


                        </div>



                        <div class="mb-3 col-md-6">
                        <label for="">Precio:</label>
                            <input type="text" name="precio" id="precio" class="form-control" />
                            <label for="">Stock:</label>
                            <input type="number" name="stock" id="stock" class="form-control" />




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
                        <h1 class="card-title" style="font-size: 23px;">Productos</h1>
                    </div>

                    <div class="card-body">

                        <button type="button" class="btn float-end" style="background-color: #dc3036; color:white" data-bs-toggle="modal"
                            data-bs-target="#productoAddModal"><i class="fa-solid fa-plus"></i> Agregar Producto
                        </button>
                        <br>
                        <table id="myTable" class="table text-center table-responsive" style="width:100%; font-size: 12px;">
                            <thead>
                                <tr>
                                    <th style="width:10%;">idProducto</th>
                                    <th style="width:20%;">Producto</th>
                                    <th style="width:15%;">idMarca</th>
                                    <th style="width:15%;">idCategoria</th>
                                    <th style="width:15%;">idProveedor</th>
                                    <th style="width:20%;">Precio</th>
                                    <th style="width:20%;">Stock</th>
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
                                $query = "SELECT idProducto,producto,marca.marca,categoria.categoria,proveedor.proveedor,precio,stock,productos.estado FROM `productos`
                                INNER JOIN marca on marca.idMarca=productos.idMarca
                                INNER JOIN categoria on categoria.idCategoria = productos.idCategoria
                                INNER JOIN proveedor on proveedor.idProveedor=productos.idProveedor;";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $row['idProducto'] ?>
                                            </td>
                                            <td>
                                                <?= $row['producto'] ?>
                                            </td>
                                            <td>
                                                <?= $row['marca'] ?>
                                            </td>
                                            <td>
                                                <?= $row['categoria'] ?>
                                            </td>
                                            <td>
                                                <?= $row['proveedor'] ?>
                                            </td>
                                            <td>
                                                <?= $row['precio'] ?>
                                            </td>
                                            <td>
                                                <?= $row['stock'] ?>
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
                                            <?php
                                                if ($row['estado'] == 1) {
                                                ?>
                                                
                                                <button type="button" value="<?= $row['idProducto']; ?>"
                                                    class="editProductoBtn btn btn-success btn-sm"><i
                                                        class="fa-solid fa-edit"></i></button>
                                                <button type="button" value="<?= $row['idProducto']; ?>"
                                                    class="deleteProductoBtn btn btn-danger btn-sm"><i
                                                        class="fa-solid fa-trash"></i></button>
                                                        <?php }
                                                ?>

                                                <?php
                                                if ($row['estado'] == 0) {
                                                ?>
                                                <button type="button" value="<?= $row['idProducto']; ?>"
                                                    class="restoreProductoBtn btn btn-secondary btn-sm"><i
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
    $(document).on('submit', '#saveProducto', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("save_producto", true);

        $.ajax({
            type: "POST",
            url: "../datos/productoDB.php",
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
                    $('#productoAddModal').modal('hide');
                    $('#saveProducto')[0].reset();

                    //$('#myTable').load(location.href + " #myTable");
                    location.reload();
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);

                } else if (res.status == 500) {
                    alert(res.message);
                }
            }
        });

    });

    $(document).on('click', '.editProductoBtn', function () {

        var idProducto = $(this).val();

        $.ajax({
            type: "GET",
            url: "../datos/productoDB.php?idProducto=" + idProducto,
            success: function (response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 404) {

                    alert(res.message);
                } else if (res.status == 200) {

                    $('#idProducto').val(res.data.idProducto);
                    $('#producto').val(res.data.producto);
                    $('#idMarca').val(res.data.idMarca);
                    $('#idCategoria').val(res.data.idCategoria);
                    $('#idProveedor').val(res.data.idProveedor);
                    $('#precio').val(res.data.precio);
                    $('#stock').val(res.data.stock);

                    $('#productoEditModal').modal('show');
                }
            }
        });
    });

    $(document).on('submit', '#updateProducto', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("update_producto", true);

        $.ajax({
            type: "POST",
            url: "../datos/productoDB.php",
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

                    $('#productoEditModal').modal('hide');
                    $('#updateProducto')[0].reset();

                    //$('#myTable').load(location.href + " #myTable");
                    location.reload();
                } else if (res.status == 500) {
                    alert(res.message);
                }
            }
        });

    });

    $(document).on('click', '.deleteProductoBtn', function (e) {
        e.preventDefault();

        if (confirm('¿Estas seguro que deseas eliminar el usuario?')) {
            var idProducto = $(this).val();
            $.ajax({
                type: "POST",
                url: "../datos/productoDB.php",
                data: {
                    'delete_producto': true,
                    'idProducto': idProducto
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

    $(document).on('click', '.restoreProductoBtn', function (e) {
        e.preventDefault();

        if (confirm('¿Estas seguro que deseas restaurar el registro?')) {
            var idProducto = $(this).val();
            $.ajax({
                type: "POST",
                url: "../datos/productoDB.php",
                data: {
                    'restore_producto': true,
                    'idProducto': idProducto
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
