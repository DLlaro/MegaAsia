<?php

require '../conexion.php';

if(isset($_POST['save_administrador']))
{
    $admin = mysqli_real_escape_string($con, $_POST['admin']);

    if($admin == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'Todos los campos son obligatorios'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO administrador (admin) VALUES ('$admin')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Adm Creado Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Error al crear el adm'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['update_administrador']))
{
    $idAdministrador = mysqli_real_escape_string($con, $_POST['idAdministrador']);

    $admin = mysqli_real_escape_string($con, $_POST['admin']);

    if($admin == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'Todos los campos son obligatorios'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE administrador SET admin='$admin'
                WHERE idAdministrador='$idAdministrador'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Admin actualizado Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Error al actualizar el admin'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_GET['idAdministrador']))
{
    $idAdministrador = mysqli_real_escape_string($con, $_GET['idAdministrador']);

    $query = "SELECT * FROM administrador WHERE idAdministrador='$idAdministrador'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $usuario = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Admin encontrado Satisfactoriamente',
            'data' => $usuario
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404, 
            'message' => 'Admin no encontrado'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_administrador']))
{
    $idAdministrador = mysqli_real_escape_string($con, $_POST['idAdministrador']);

    $query = "UPDATE administrador SET estado='0' 
    WHERE idAdministrador='$idAdministrador'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Admin eliminado Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Admin no encontrado'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['restore_administrador']))
{
    $idAdministrador = mysqli_real_escape_string($con, $_POST['idAdministrador']);

    $query = "UPDATE administrador SET estado='1' 
    WHERE idAdministrador='$idAdministrador'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Admin restaurado Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Admin no encontrado'
        ];
        echo json_encode($res);
        return;
    }
}
?>