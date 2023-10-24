<?php

require '../conexion.php';

if(isset($_POST['save_categoria']))
{
    $categoria = mysqli_real_escape_string($con, $_POST['categoria']);
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);

    if($categoria == NULL || $descripcion == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'Todos los campos son obligatorios'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO categoria (categoria,descripcion) VALUES ('$categoria','$descripcion')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Categoria Creada Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Error al crear la categoria'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['update_categoria']))
{
    $idCategoria = mysqli_real_escape_string($con, $_POST['idCategoria']);

    $categoria = mysqli_real_escape_string($con, $_POST['categoria']);
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
   

    if($categoria == NULL || $descripcion == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'Todos los campos son obligatorios'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE categoria SET categoria='$categoria', descripcion='$descripcion'
                WHERE idCategoria='$idCategoria'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Categoria actualizada Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Error al actualizar la categoria'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_GET['idCategoria']))
{
    $idCategoria = mysqli_real_escape_string($con, $_GET['idCategoria']);

    $query = "SELECT * FROM categoria WHERE idCategoria='$idCategoria'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $categoria = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Marca encontrada Satisfactoriamente',
            'data' => $categoria
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

if(isset($_POST['delete_categoria']))
{
    $idCategoria = mysqli_real_escape_string($con, $_POST['idCategoria']);

    $query = "UPDATE categoria SET estado=0
    WHERE idCategoria='$idCategoria'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Categoria eliminada Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Categoria no encontrada'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['restore_categoria']))
{
    $idCategoria = mysqli_real_escape_string($con, $_POST['idCategoria']);

    $query = "UPDATE categoria SET estado=1 
    WHERE idCategoria='$idCategoria'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Categoria restaurada Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Categoria no encontrada'
        ];
        echo json_encode($res);
        return;
    }
}
?>