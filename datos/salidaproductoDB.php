<?php

require '../conexion.php';

if(isset($_POST['save_salidaproducto']))
{
    $idProducto= mysqli_real_escape_string($con, $_POST['idProducto']);
    $cantidad = mysqli_real_escape_string($con, $_POST['cantidad']);
    
    if($idProducto == NULL || $cantidad==NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'Todos los campos son obligatorios'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO salidaProducto (idProducto, cantidadSalida) VALUES ('$idProducto','$cantidad')";
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


if(isset($_POST['save_saprod']))
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
    
    $query3 = "INSERT INTO nota_salida (idUsuario) VALUES ('$idUsuario')";
    $query_run3 = mysqli_query($con, $query3);
    $last_id = mysqli_insert_id($con);

/*     $query2 ="SELECT COUNT(*) as contador FROM nuevoproducto";
    $query_run2= mysqli_query($con, $query2);
    $cont = mysqli_fetch_assoc($query_run2);
    $contador = $cont['contador']; */


    //$idReq_Entrada = mysqli_real_escape_string($con, $_POST['idReq_Entrada']);


    $query1 = "SELECT nv.idProducto, nv.cantidadSalida, p.precio, (nv.cantidadSalida*p.precio)as Subtotal FROM salidaproducto as nv inner join productos as p where nv.idProducto = p.idProducto";
    $query_run1 = mysqli_query($con, $query1);
    if (mysqli_num_rows($query_run1) > 0) {
        foreach ($query_run1 as $row) {
            $det_idProducto = $row['idProducto'];
            $det_cantidadSalida = $row['cantidadSalida'];
            $det_precioUnit=$row['precio'];
            $det_subtotal=$row['Subtotal'];
            //$det_cantidadIngresadaAdd = $row['cantidadIngresadaAdd'];

            for ($i = 0; $i < 1; $i++) {
                $query3 = "INSERT INTO det_not_salida (idProducto,idNot_Salida, cantidad, precUnitario, precTotal) 
                VALUES ('$det_idProducto','$last_id','$det_cantidadSalida','$det_precioUnit','$det_subtotal')";
                $query_run3 = mysqli_query($con, $query3);
            }

        }
    }
    $query5 = "UPDATE nota_salida ns inner join( SELECT idNot_Salida, SUM(precTotal) 'suma' FROM det_not_salida GROUP BY idNot_Salida ) dt ON ns.idNot_Salida = dt.idNot_Salida 
    SET ns.total = dt.suma where ns.idNot_Salida = $last_id;";//Actualizando el Total de la Nota de Salida
    $query_run5 = mysqli_query($con, $query5);

 // limpiar la bd temp
    $query6 = "DELETE FROM salidaproducto";
    $query_run6 = mysqli_query($con, $query6);


    if($query_run1)
    {
        $res = [
            'status' => 200,
            'message' => 'Nota Salida creada'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Error al crear la nota de salida'
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



if(isset($_POST['delete_salidaprod']))
{
    $idNuevoProducto = mysqli_real_escape_string($con, $_POST['idNuevoProducto']);
    
    $query = "DELETE from salidaproducto WHERE idProducto='$idNuevoProducto'";
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