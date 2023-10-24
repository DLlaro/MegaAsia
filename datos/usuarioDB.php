<?php

require '../conexion.php';

if(isset($_POST['save_usuario']))
{
    $usuariocorreo = mysqli_real_escape_string($con, $_POST['usuariocorreo']);
    $contraseña = mysqli_real_escape_string($con, $_POST['contraseña']);
    $nombres = mysqli_real_escape_string($con, $_POST['nombres']);
    $idAdministrador = mysqli_real_escape_string($con, $_POST['idAdministrador']);

    if($nombres == NULL || $idAdministrador == NULL || $usuariocorreo == NULL || $contraseña == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'Todos los campos son obligatorios'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO usuario (usuariocorreo,contraseña,nombres,idAdministrador) VALUES ('$usuariocorreo','$contraseña','$nombres','$idAdministrador')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Usuario Creado Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Error al crear el usuario'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['update_usuario']))
{
    $idUsuario = mysqli_real_escape_string($con, $_POST['idUsuario']);

    $usuariocorreo = mysqli_real_escape_string($con, $_POST['usuariocorreo']);
    $nombres = mysqli_real_escape_string($con, $_POST['nombres']);
    $contraseña = mysqli_real_escape_string($con, $_POST['contraseña']);
    $idAdministrador = mysqli_real_escape_string($con, $_POST['idAdministrador']);

    if($usuariocorreo == NULL || $nombres == NULL || $contraseña == NULL || $idAdministrador == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'Todos los campos son obligatorios'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE usuario SET usuariocorreo='$usuariocorreo', contraseña='$contraseña',nombres='$nombres',idAdministrador='$idAdministrador'
                WHERE idUsuario='$idUsuario'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Usuario actualizado Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Error al actualizar el usuario'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_GET['idUsuario']))
{
    $idUsuario = mysqli_real_escape_string($con, $_GET['idUsuario']);

    $query = "SELECT * FROM usuario WHERE idUsuario='$idUsuario'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $usuario = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Usuario encontrado Satisfactoriamente',
            'data' => $usuario
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404, 
            'message' => 'Usuario no encontrado'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_usuario']))
{
    $idUsuario = mysqli_real_escape_string($con, $_POST['idUsuario']);

    $query = "UPDATE usuario SET usuarioEstado='0' 
    WHERE idUsuario='$idUsuario'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Usuario eliminado Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Usuario no encontrado'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['restore_usuario']))
{
    $idUsuario = mysqli_real_escape_string($con, $_POST['idUsuario']);

    $query = "UPDATE usuario SET usuarioEstado='1' 
    WHERE idUsuario='$idUsuario'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Usuario restaurado Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Usuario no encontrado'
        ];
        echo json_encode($res);
        return;
    }
}
?>