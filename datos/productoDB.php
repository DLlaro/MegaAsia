<?php

require '../conexion.php';

if(isset($_POST['save_producto']))
{
    $producto = mysqli_real_escape_string($con, $_POST['producto']);
    $idMarca = mysqli_real_escape_string($con, $_POST['idMarca']);
    $idCategoria = mysqli_real_escape_string($con, $_POST['idCategoria']);
    $idProveedor = mysqli_real_escape_string($con, $_POST['idProveedor']);
    $precio = mysqli_real_escape_string($con, $_POST['precio']);
    $stock = mysqli_real_escape_string($con, $_POST['stock']);

    if($producto == NULL || $idMarca == NULL || $idCategoria == NULL || $idProveedor == NULL || $precio == NULL || $stock == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'Todos los campos son obligatorios'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO productos (producto,idMarca,idCategoria,idProveedor,precio,stock) VALUES ('$producto','$idMarca','$idCategoria','$idProveedor','$precio','$stock')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Producto Creado Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Error al crear el producto'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['update_producto']))
{
    $idProducto = mysqli_real_escape_string($con, $_POST['idProducto']);

    $producto = mysqli_real_escape_string($con, $_POST['producto']);
    $idMarca = mysqli_real_escape_string($con, $_POST['idMarca']);
    $idCategoria = mysqli_real_escape_string($con, $_POST['idCategoria']);
    $idProveedor = mysqli_real_escape_string($con, $_POST['idProveedor']);
    $precio = mysqli_real_escape_string($con, $_POST['precio']);
    $stock = mysqli_real_escape_string($con, $_POST['stock']);

    if($producto == NULL || $idMarca == NULL || $idCategoria == NULL || $idProveedor == NULL || $precio == NULL || $stock == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'Todos los campos son obligatorios'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE productos SET producto='$producto', idMarca='$idMarca', idCategoria='$idCategoria', idProveedor='$idProveedor', precio='$precio', stock='$stock'
                WHERE idProducto='$idProducto'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Producto actualizado Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Error al actualizar el producto'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_GET['idProducto']))
{
    $idProducto = mysqli_real_escape_string($con, $_GET['idProducto']);

    $query = "SELECT * FROM productos WHERE idProducto='$idProducto'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $producto = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Producto encontrado Satisfactoriamente',
            'data' => $producto
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404, 
            'message' => 'Producto no encontrado'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_producto']))
{
    $idProducto = mysqli_real_escape_string($con, $_POST['idProducto']);

    $query = "UPDATE productos SET estado =0 
    WHERE idProducto='$idProducto'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Producto eliminado Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Producto no encontrado'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['restore_producto']))
{
    $idProducto = mysqli_real_escape_string($con, $_POST['idProducto']);

    $query = "UPDATE productos SET estado=1 
    WHERE idProducto='$idProducto'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Producto restaurado Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Producto no encontrado'
        ];
        echo json_encode($res);
        return;
    }
}
?>