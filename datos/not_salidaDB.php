<?php

require '../conexion.php';

if(isset($_POST['save_notSalida']))
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

    $query = "INSERT INTO nota_salida (idUsuario) VALUES ('$idUsuario')";
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

if(isset($_GET['idNot_Salida']))
{
    $idNot_Salida = mysqli_real_escape_string($con, $_GET['idNot_Salida']);

    $query = "SELECT * FROM nota_salida WHERE idNot_Salida='$idNot_Salida'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $nota_salida = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Se encontró la Nota de Salida correctamente',
            'data' => $nota_salida
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


if(isset($_POST['delete_notSalida']))
{
    $idNot_Salida = mysqli_real_escape_string($con, $_POST['idNot_Salida']);
    
    $query = "UPDATE nota_salida SET estado='0' 
    WHERE idNot_Salida='$idNot_Salida'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'La Nota de Salida se eliminó Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    
    else
    {
        $res = [
            'status' => 500,
            'message' => 'No se encontró la Nota'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['restore_notSalida']))
{
    $idNot_Salida= mysqli_real_escape_string($con, $_POST['idNot_Salida']);

    $query = "UPDATE nota_salida SET estado='1' 
    WHERE idNot_Salida='$idNot_Salida'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Nota de Salida restaurada Satisfactoriamente'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'No se encontro Nota de Salida'
        ];
        echo json_encode($res);
        return;
    }
}



?>