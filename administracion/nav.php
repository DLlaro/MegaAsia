<?php
session_start();
$usuariocorreo = $_SESSION['usuariocorreo'];
$usuario = $_SESSION['idUsuario'];
$nombres = $_SESSION['nombres'];
$idAdministrador = $_SESSION['idAdministrador'];

if (!isset($_SESSION['usuariocorreo'])) {
    header("Location: ../index.php");
}
require '../conexion.php';

$trabaja1 = "SELECT nombres FROM usuario WHERE idUsuario = '$usuario' ";
$resultado1 = $con->query($trabaja1);
$row1 = $resultado1->fetch_assoc();
$nomb = $row1['nombres'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MEGAASIA - ADMINISTRACIÓN</title>
    <link rel="shortcut icon" href="../img/logotittle.png" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <!-- Theme style Dashboard -->
    <link rel="stylesheet" href="../css/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../css/plugins/fontawesome-free/css/all.min.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.bootstrap4.min.css">
    <!-- sdelivr Alert -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="../css/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../css/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body class="hold-transition sidebar-mini sidebar-minicontrol-sidebar-slide-open layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->
    
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <!-- Brand Logo -->
            <a href="panelControl.php" class="brand-link" style="text-decoration: none;">
                <img src="../img/logotittle.png" alt="T-S" class="brand-image">
                <strong>MEGA ASIA</strong>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <table>
                        <tr>
                            <td><img src="../img/cuenta.png" alt=""></td>
                            <td>
                                <div class="info">
                                    <span class="d-block"><b></b> </span>
                                    <span class="d-block  font-weight-bold btn btn-sm"
                                        style="background-color: #dc3036; color:aliceblue">
                                        <?php echo $nomb; ?>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
      
                 
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <br>

                        <li class="nav-item ">
                            <a href="panelControl.php" class="nav-link <?php if ($page == 'home') {
                                echo 'active';
                            } ?>"><i class="fas fa-home "></i>
                                <p>Inicio </p>
                            </a>
                        </li>

                        
                           
                                <li class="nav-item ">
                                <a href="producto.php" class="nav-link <?php if ($page == 'Productos') {
                                    echo 'active';
                                } ?>"><i class="fa-solid fa-box-open"></i>
                                    <p>Gestión de Productos </p>
                                </a>
                                </li>
                           
                           
                                <li class="nav-item ">
                                <a href="marca.php" class="nav-link <?php if ($page == 'Marca') {
                                    echo 'active';
                                } ?>"><i class="fa-solid fa-box-open"></i>
                                    <p>Gestión de Marcas </p>
                                </a>
                                </li>
                            
                           
                                <li class="nav-item ">
                                <a href="categoria.php" class="nav-link <?php if ($page == 'Categoria') {
                                    echo 'active';
                                } ?>"><i class="fa-solid fa-box-open"></i>
                                    <p>Gestión de Categorias </p>
                                </a>
                                </li>
                          
                           
                                <li class="nav-item ">
                                <a href="proveedor.php" class="nav-link <?php if ($page == 'Proveedor') {
                                    echo 'active';
                                } ?>"><i class="fa-solid fa-truck-field"></i>
                                    <p>Gestión de Proveedores </p>
                                </a>
                                </li>

                                <li class="nav-item ">
                                <a href="inventario.php" class="nav-link <?php if ($page == 'Inventario') {
                                    echo 'active';
                                } ?>"><i class="fa-solid fa-boxes-stacked"></i>
                                    <p>Inventario</p>
                                </a>
                                </li>
                            
                       

                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link ">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Requerimientos
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                            <li class="nav-item ">
                            <a href="req_entrada.php" class="nav-link <?php if ($page == 'Requerimiento_Entrada') {
                                echo 'active';
                            } ?>"> <i class="fa-solid fa-truck-ramp-box"></i>
                                <p>Entrada de Productos</p>
                            </a>
                            </li>

                            </ul>
                            <ul class="nav nav-treeview">
                            <li class="nav-item ">
                            <a href="not_salida.php" class="nav-link <?php if ($page == 'Nota_Salida') {
                                echo 'active';
                            } ?>"><i class="fa-solid fa-dolly"></i>
                                <p>Salida de productos</p>
                            </a>
                        </li>

                            </ul>
                        </li>

                        <?php if ($idAdministrador == '1' || $idAdministrador=='2') {
                            ?>

                            <li class="nav-item ">
                                <a href="usuario.php" class="nav-link <?php if ($page == 'Usuario') {
                                    echo 'active';
                                } ?>"><i class="fas fa-user"></i>
                                    <p>Usuarios </p>
                                </a>
                            </li>

                            <li class="nav-item ">
                                <a href="administrador.php" class="nav-link <?php if ($page == 'Administrador') {
                                    echo 'active';
                                } ?>"><i class="fas fa-user"></i>
                                    <p>Administradores </p>
                                </a>
                            </li>

                        <?php } ?>

                        <br> <br> <br>
                        <li class="nav-item ">
                            <a href="../datos/cerrarSesion.php" class="nav-link"><i class="fa-solid fa-arrow-right-from-bracket"></i>
                                <p>Cerrar Sesion </p>
                            </a>
                        </li>

                    </ul>


                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

