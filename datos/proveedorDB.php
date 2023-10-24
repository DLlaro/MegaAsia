<?php

require '../conexion.php';

if(isset($_POST['save_proveedor']))
{
    $proveedor = mysqli_real_escape_string($con, $_POST['proveedor']);
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);

    if($proveedor == NULL || $descripcion == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'Todos los campos son obligatorios'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO proveedor (proveedor,descripcion) VALUES ('$proveedor','$descripcion')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Proveedor Creado Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Error al crear el Proveedor'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['update_proveedor']))
{
    $idProveedor = mysqli_real_escape_string($con, $_POST['idProveedor']);

    $proveedor = mysqli_real_escape_string($con, $_POST['proveedor']);
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
   

    if($proveedor == NULL || $descripcion == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'Todos los campos son obligatorios'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE proveedor SET proveedor='$proveedor', descripcion='$descripcion'
                WHERE idProveedor='$idProveedor'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Proveedor actualizado Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Error al actualizar el proveedor'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_GET['idProveedor']))
{
    $idProveedor = mysqli_real_escape_string($con, $_GET['idProveedor']);

    $query = "SELECT * FROM proveedor WHERE idProveedor='$idProveedor'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $proveedor = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Proveedor encontrado Satisfactoriamente',
            'data' => $proveedor
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404, 
            'message' => 'Proveedor no encontrado'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_proveedor']))
{
    $idProveedor = mysqli_real_escape_string($con, $_POST['idProveedor']);

    $query = "UPDATE proveedor SET estado=0
    WHERE idProveedor='$idProveedor'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Proveedor eliminado Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Proveedor no encontrada'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['restore_proveedor']))
{
    $idProveedor = mysqli_real_escape_string($con, $_POST['idProveedor']);

    $query = "UPDATE proveedor SET estado=1 
    WHERE idProveedor='$idProveedor'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Proveedor restaurado Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Proveedor no encontrada'
        ];
        echo json_encode($res);
        return;
    }
}
?>