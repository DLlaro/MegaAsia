<?php

require '../conexion.php';

if(isset($_POST['save_marca']))
{
    $marca = mysqli_real_escape_string($con, $_POST['marca']);
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);

    if($marca == NULL || $descripcion == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'Todos los campos son obligatorios'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO marca (marca,descripcion) VALUES ('$marca','$descripcion')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Marca Creada Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Error al crear la marca'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['update_marca']))
{
    $idMarca = mysqli_real_escape_string($con, $_POST['idMarca']);

    $marca = mysqli_real_escape_string($con, $_POST['marca']);
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
   

    if($marca == NULL || $descripcion == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'Todos los campos son obligatorios'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE marca SET marca='$marca', descripcion='$descripcion'
                WHERE idMarca='$idMarca'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Marca actualizada Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Error al actualizar la marca'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_GET['idMarca']))
{
    $idMarca = mysqli_real_escape_string($con, $_GET['idMarca']);

    $query = "SELECT * FROM marca WHERE idMarca='$idMarca'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $marca = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Marca encontrada Satisfactoriamente',
            'data' => $marca
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404, 
            'message' => 'Marca no encontrada'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_marca']))
{
    $idMarca = mysqli_real_escape_string($con, $_POST['idMarca']);

    $query = "UPDATE marca SET estado=0
    WHERE idMarca='$idMarca'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Marca eliminada Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Marca no encontrada'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['restore_marca']))
{
    $idMarca = mysqli_real_escape_string($con, $_POST['idMarca']);

    $query = "UPDATE marca SET estado=1 
    WHERE idMarca='$idMarca'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Marca restaurada Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Marca no encontrada'
        ];
        echo json_encode($res);
        return;
    }
}
?>