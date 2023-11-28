<?php
$page = 'Nueva NotaSalida';
include_once 'nav.php';
require '../conexion.php';

/*
$idReq_Entrada = $_GET['idReq'];
$query = "SELECT * FROM req_entrada WHERE idReq_Entrada =$idReq_Entrada";
$query_run = mysqli_query($con, $query);
$aa = mysqli_fetch_assoc($query_run);
*/
?>

<section class="content-header">
</section>
<section class="content">

    <!-- Add Usuario -->
    <div class="modal fade" id="salidaproductoAddModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir Productos a la Nota de Salida</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="savesalida">
                    <div class="modal-body row">

                     
                           <h6>Seleccione ID de producto: </h6>
                        <div class="container-fluid">
                         <div class="row">
                            <div class="col-md-12">
                                <table id="myTable2" style="font-size: 12px; width:100%"  class="table text-center" >
                                    <thead style="background: #C9C9C9">
                                        <tr>
                                            <th style="width:30%;">idProducto</th>
                                            <th style="width:20%;">Producto</th>
                                            <th style="width:20%;">Precio (S/.)</th>
                                            <th style="width:20%;">Stock Actual</th>
                                        </tr>
                                    </thead>

                                    <tbody id="tablahover">
                                        <?php
                                        $query = "SELECT p.idProducto,
                                        (SELECT CONCAT_WS(' ',pro.producto, 'marca',m.marca) 
                                        FROM productos as pro 
                                        INNER join marca as m on m.idMarca=pro.idMarca 
                                        WHERE pro.idProducto = p.idProducto) as Producto, p.precio, p.stock 
                                        FROM productos as p where estado=1;";
                                        $query_run = mysqli_query($con, $query);

                                        if (mysqli_num_rows($query_run) > 0) {
                                            foreach ($query_run as $row) {
                                                ?>
                                                <tr id="prueba" onclick="muestra2(this)" style="cursor: pointer;">
                                                    <td>
                                                        <?=$row['idProducto']?>
                                                    </td>
                                                    <td>
                                                        <?=$row['Producto']?>
                                                    </td>
                                                    <td>
                                                        <?=$row['precio']?>
                                                    </td>
                                                    <td>
                                                        <?=$row['stock']?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <br>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="width:10rem;">
                                <label for="">ID de Producto:</label>
                                <input type="text" name="idProducto" id="idProducto" class="form-control" readonly />
                            </div>
                            <div class="col-md-6" style="width:10rem;">
                                <label for="">Stock:</label>
                                <input type="text" name="stock" id="stock" class="form-control" readonly/>
                            </div>
                            <div class="col-md-6" style="width:10rem;">
                                <label for="">Cantidad:</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control"/>
                            </div>
                        </div>
                        <div id="errorMessage" class="alert alert-warning d-none"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button id="enviar" type="submit" class="btn" style="background-color: #dc3036; color:white">Guardar</button>
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
                    <div class="card-header">
                        <h1 class="card-title" style="font-size: 25px;">Nuevo Nota de Salida</h1>
                    </div>
                    <div class="card-body">

                    <form id="saveProdEntrada">
                        <blockquote style="font-size: 20px; background-color:#E8E8E8">Ingresar Usuario Encargado</blockquote>
                  
                            <!--<input type="hidden" name="idReq_Entrada" id="idReq_Entrada" value="<?php //echo $idReq_Entrada;?>" class="form-control" />-->
                            <div class="mb-3" style="width:25rem;">
                            <?php 
                            $query = "SELECT * FROM usuario where usuarioEstado in(1) and idAdministrador=3;";
                            $query_run = mysqli_query($con, $query); ?>
                            <select name="idUsuario" id="idUsuario"  class="form-control">
                                <?php
                                while ($ver = mysqli_fetch_row($query_run)): ?>
                                    <option value="<?php echo $ver[0] ?>"><?php echo $ver[3]; ?></option>
                                <?php endwhile; ?>
                            </select>
                            </div>
                
                        <blockquote style="font-size: 20px;background-color:#E8E8E8">Ingresar Productos a Nota de Salida: </blockquote>
                    <br>
                        <button type="button" class="btn float-end" style="background-color: #dc3036; color:white" data-bs-toggle="modal"
                        data-bs-target="#salidaproductoAddModal"><i class="fas fa-graduation-cap"></i> Agregar Productos
                        </button>
                    <br>

                <table id="myTable" class="table text-center" style="width:100%; font-size: 12px;">

                            <thead style="background: #E8E8E8">
                                <tr>
                                    <th style="width:10%;">idProducto</th>                           
                                    <th style="width:20%;">Producto</th>
                                    <th style="width:20%;">Marca</th>
                                    <th style="width:20%;">Proveedor</th>
                                    <th style="width:10%;">Cantidad Ingresada</th>
                                    <th style="width:10%;">Precio Unitario</th>
                                    <th style="width:10%;">Precio Total</th>
                                    <th style="width:20%">Acciones</th>
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
                                $query = "SELECT p.idProducto, p.producto, m.marca, prov.proveedor, pA.cantidadSalida, p.precio, (p.precio*pA.cantidadSalida) as Subtotal from salidaproducto as pA
                                inner join productos as p on p.idProducto = pA.idProducto
                                inner join marca as m on m.idMarca = p.idMarca
                                inner join proveedor as prov on prov.idProveedor = p.idProveedor
                                order by p.precio asc";
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $row) {
                                        ?>
                                        <tr>
                                            <td>
                                            <?= $row['idProducto'] ?> 
                                            <input type="hidden" name=idProductoAdd id="idProductoAdd" value="<?= $row['idProducto']; ?>">
                                            </td>
                                            <td>
                                                <?= $row['producto'] ?>
                                            </td>
                                            <td>
                                                <?= $row['marca'] ?>
                                            </td>
                                            <td>
                                                <?= $row['proveedor'] ?>
                                            </td>
                                        
                                            <td>
                                                <?= $row['cantidadSalida'] ?>
                                            </td>
                                            <td>
                                                <?= $row['precio'] ?>
                                            </td>
                                            <td>
                                                <?= $row['Subtotal'] ?>
                                            </td>
                                            <td>
                                            <button type="button" value="<?= $row['idProducto']; ?>" class="deletesalidaprodBtn btn btn-danger btn-sm"><i class="fa-solid fa-xmark"></i></button>
                                            </td>
                                            
                                           
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                </table>     
                   <br>
                   <div id="errorMessage" class="alert alert-warning d-none"></div>

                    <button type="button" id="addnotsalidaBtn" class="btn float-end btn-success"><i class="fas fa-graduation-cap"></i> Asignar Productos a Nota de Salida
                </button>
                <!--   Card de Admin -->
                </form>
            </div>
        </div>
    </div>
</section>

<?php include_once 'footer.php'; ?>

<script>
    function muestra2(t2){
        //var mue=document.getElementById('txtidentificador2');
        var idProducto = document.getElementById('idProducto');
        var stock= document.getElementById('stock');
/*
        var texto2 = Number(t2.innerHTML);
        var texto3 = Number(t3.innerHTML);

        console.log(texto2);
        console.log(texto3); */
        idProducto.value= $(t2).children('td')[0].innerText;;
        stock.value=$(t2).children('td')[3].innerText;
    }
    document.getElementById("cantidad").oninput = function() {
        var cantidad= document.getElementById('cantidad').value;
        var stock= document.getElementById('stock').value;

        console.log(cantidad, stock);
        var btn = document.getElementById('enviar');
        if(cantidad > stock){
            
            btn.style.display = "none"; 
        }
        else{
            btn.style.display = "inline"; 
        }
    }
    $(document).on('submit', '#savesalida', function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("save_salidaproducto", true);

        $.ajax({
            type: "POST",
            url: "../datos/salidaproductoDB.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 422) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error(res.message);

                } else if (res.status == 200) {

                    $('#salidaproductoAddModal').modal('hide');
                    $('#savesalida')[0].reset();
                    $('#myTable').load(location.href + " #myTable");

                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);

                } else if (res.status == 500) {
                    alert(res.message);
                }
            }
        });

    });


    $(document).on('click', '#addnotsalidaBtn', function(e) {
        e.preventDefault();
        if (confirm('¿Estas seguro de enviar productos a nota de salida?')) {
        var idNuevoProducto = $(this).val();
        //var idReq_Entrada = document.getElementById("idReq_Entrada").value;
        var idUsuario = document.getElementById('idUsuario').value;

        $.ajax({
            type: "POST",
            url: "../datos/salidaproductoDB.php",
            data:{
                'save_saprod': true,
                'idNuevoProducto': idNuevoProducto,
                //'idReq_Entrada' : idReq_Entrada
                'idUsuario': idUsuario,
            },
            success: function (response) {

                var res = jQuery.parseJSON(response);
                if (res.status == 422) {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.error(res.message);

                } else if (res.status == 200) {

                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);

                    setTimeout(function() {
                        window.location = 'not_salida.php';
                    });
                    /*   alertify.set('notifier', 'position', 'top-right');
                      alertify.success(res.message); */
                    $('#myTable').load(location.href + " #myTable");

                } else if (res.status == 500) {
                    alert(res.message);
                }
            }
        });
    }

    });

  
    $(document).on('click', '.deletesalidaprodBtn', function (e) {
        e.preventDefault();


        if (confirm('¿Estas seguro de eliminar el producto')) {
            var idNuevoProducto = $(this).val();
            $.ajax({
                type: "POST",
                url: "../datos/salidaproductoDB.php",
                data: {
                    'delete_salidaprod': true,
                    'idNuevoProducto': idNuevoProducto
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

    $('#myTable2').DataTable({
        
        dom: 'Bfrtip',
        buttons: [
            'colvis'
        ],
        pageLength : 5,
    });

</script>