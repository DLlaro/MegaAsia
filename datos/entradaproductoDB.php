<?php

require '../conexion.php';

if(isset($_POST['save_entradaproducto']))
{
    $idProducto= mysqli_real_escape_string($con, $_POST['idProducto']);
    $cantidadIngresada = mysqli_real_escape_string($con, $_POST['cantidadIngresada']);
    
    if($idProducto == NULL || $cantidadIngresada==NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'Todos los campos son obligatorios'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO nuevoproducto (idProducto, cantidadIngresadaAdd) VALUES ('$idProducto','$cantidadIngresada')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Producto Añadido'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Error al ingresar el producto'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_POST['save_enprod']))
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
    
    $query3 = "INSERT INTO req_entrada (idUsuario) VALUES ('$idUsuario')";
    $query_run3 = mysqli_query($con, $query3);
    $last_id = mysqli_insert_id($con);

    $query2 ="SELECT COUNT(*) as contador FROM nuevoproducto";
    $query_run2= mysqli_query($con, $query2);
    $cont = mysqli_fetch_assoc($query_run2);
    $contador = $cont['contador'];


    //$idReq_Entrada = mysqli_real_escape_string($con, $_POST['idReq_Entrada']);
    $query1 = "SELECT * FROM nuevoproducto ";
    $query_run1 = mysqli_query($con, $query1);
    if (mysqli_num_rows($query_run1) > 0) {
        foreach ($query_run1 as $row) {
            $det_idProducto = $row['idProducto'];
            $det_cantidadIngresadaAdd = $row['cantidadIngresadaAdd']; 
            //$det_cantidadIngresadaAdd = $row['cantidadIngresadaAdd'];

            for ($i = 0; $i < 1; $i++) {
                $query3 = "INSERT INTO det_req_entrada (idProducto,idReq_Entrada, cantidadIngresada) 
                VALUES ('$det_idProducto','$last_id','$det_cantidadIngresadaAdd')";
                $query_run3 = mysqli_query($con, $query3);
            }
        }
    }
 // limpiar la bd temp
    $query5 = "DELETE FROM nuevoproducto";
    $query_run5 = mysqli_query($con, $query5);


    if($query_run1)
    {
        $res = [
            'status' => 200,
            'message' => 'Requerimiento creado'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Error al crear el requerimiento'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_GET['idNuevoProducto']))
{
    $idNuevoProducto = mysqli_real_escape_string($con, $_GET['idNuevoProducto']);

    $query = "SELECT * FROM nuevoproducto WHERE idNuevoProducto='$idNuevoProducto'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $nuevoproducto = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'El Producto se encontró Satisfactoriamente',
            'data' => $nuevoproducto
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404, 
            'message' => 'No se encontró el Producto'
        ];
        echo json_encode($res);
        return;
    }
}



if(isset($_POST['delete_entradaprod']))
{
    $idNuevoProducto = mysqli_real_escape_string($con, $_POST['idNuevoProducto']);
    
    $query = "DELETE from nuevoproducto WHERE idNuevoProducto='$idNuevoProducto'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Producto Eliminado'
        ];
        echo json_encode($res);
        return;
    }
    
    else
    {
        $res = [
            'status' => 500,
            'message' => 'No se encontro el Producto'
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
            'message' => 'El usuario se encontró Satisfactoriamente',
            'data' => $req_entrada
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404, 
            'message' => 'No se encontró el Usuario'
        ];
        echo json_encode($res);
        return;
    }
}