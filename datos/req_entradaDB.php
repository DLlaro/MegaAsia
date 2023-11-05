<?php

require '../conexion.php';

if(isset($_POST['save_reqEntrada']))
{
    
    $idUsuario= mysqli_real_escape_string($con, $_POST['idUsuario']);
    

    if($idUsuario == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'Todos los campos son obligatorios'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO req_entrada (idUsuario) VALUES ('$idUsuario')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'El usuario se asignó al Requerimiento'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Error al asignar el Usuario'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_GET['idReq_Entrada']))
{
    $idReq_Entrada = mysqli_real_escape_string($con, $_GET['idReq_Entrada']);

    $query = "SELECT * FROM req_entrada WHERE idReq_Entrada='$idReq_Entrada'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $req_entrada = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Se encontró el Requerimiento Satisfactoriamente',
            'data' => $req_entrada
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404, 
            'message' => 'No se encontró el Requerimiento'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_POST['delete_reqEntrada']))
{
    $idReq_Entrada = mysqli_real_escape_string($con, $_POST['idReq_Entrada']);
    
    $query = "UPDATE req_entrada SET estado='0' 
    WHERE idReq_Entrada='$idReq_Entrada'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'El Requerimiento se eliminó Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    
    else
    {
        $res = [
            'status' => 500,
            'message' => 'No se encontró el Requerimiento'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['restore_reqEntrada']))
{
    $idReq_Entrada= mysqli_real_escape_string($con, $_POST['idReq_Entrada']);

    $query = "UPDATE req_entrada SET estado='1' 
    WHERE idReq_Entrada='$idReq_Entrada'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Requerimiento restaurado Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'No se encontro Requerimiento'
        ];
        echo json_encode($res);
        return;
    }
}



?>