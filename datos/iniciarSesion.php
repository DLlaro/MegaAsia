<?php
session_start();
require '../conexion.php';

$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
/* $encriptado = sha1($contraseña); */

$sql = "SELECT * from usuario where usuariocorreo = '$usuario'  and usuarioEstado = 1";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_assoc($result);

    $contraseña1 = $row['contraseña'];

    $_SESSION['usuariocorreo'] = $row['usuariocorreo'];
    $_SESSION['idUsuario'] = $row['idUsuario'];
    $_SESSION['nombres'] = $row['nombres'];
    $_SESSION['idAdministrador'] = $row['idAdministrador'];

    if ($contraseña == $contraseña1) {
        if ($row['idAdministrador'] == '1' || $row['idAdministrador'] == '2') {
        header("Location: ../administracion/panelControl.php");
        exit();
        }else{
        header("Location: ../administracion/panelControl.php");
        exit();
        }
    } else {
        header("Location: ../index.php");
        exit();
    }
} else {
    header("Location: ../index.php");
    exit();
}