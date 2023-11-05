<?php
require('pdf_fpdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->SetFont('Arial', 'B', 9);
        $this->SetFillColor(254, 254, 254);
        $this->SetDrawColor(0, 0, 0);
        $this->SetTextColor(0, 0, 0);
        $this->Cell(50, 20, '', 1, 0, 'C', true);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(90, 20, 'FICHA DE REQUERIMIENTO', 1, 0, 'C', true);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(50, 20, '', 1, 0, 'C', true);
        $this->Ln(1);
        $this->Cell(325, 10, 'CODIGO: LOGIS-FO-005', 0, 0, 'C');
        $this->Ln(5);
        $this->Cell(311, 10, 'VERSION: 001 ', 0, 0, 'C');
        /*
        $this->Ln(5);
        $this->Cell(327, 10, 'SEPROESPERU.COM.PE ', 0, 0, 'C'); 
        */
        $this->Ln(5);
        $this->Cell(321, 10, 'FECHA: ' . date('d') . ' / ' . date('m') . ' / ' . date('Y'), 0, 1, 'C');
        $this->Ln(5);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Pag.') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

require '../conexion.php';
$rq_id = $_GET['rq_id'];

$query = "SELECT * FROM req_entrada
          inner join usuario on usuario.idUsuario=req_entrada.idUsuario 
          WHERE  req_entrada.idReq_Entrada = '$rq_id'";
$query_run = mysqli_query($con, $query);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Image('../img/megaasiareporte.png', 14, 15, -280);

if (mysqli_num_rows($query_run) > 0) {
    foreach ($query_run as $requerimiento) {

        $pdf->SetFont('Arial', 'B', 9);     //TITULO GENERAL
        $pdf->SetFillColor(0, 0, 0);  //TITULO GENERAL
        $pdf->SetDrawColor(0, 0, 0);        //TITULO GENERAL
        $pdf->SetTextColor(255, 255, 255);        //TITULO GENERAL

        $pdf->Cell(190, 8, 'DATOS GENERALES', 1, 0, 'C', true);
        $pdf->Ln(8);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(254, 254, 254);  //TITULO SECUNDARIO
        $pdf->SetFont('Arial', 'B', 7);      //TITULO SECUNDARIO
        $pdf->Cell(34, 8, 'RUC ', 1, 0, 'C', true);
        $pdf->Cell(78, 8, 'RAZÓN SOCIAL ', 1, 0, 'C', true);
        $pdf->Cell(78, 8, 'REPRESENTANTE', 1, 0, 'C', true);

        $pdf->Ln(8);
        $pdf->SetFillColor(254, 254, 254);  //TEXTO 
        $pdf->SetFont('Arial', '', 7);      //TEXTO
        $pdf->Cell(34, 8, '20608438611', 1, 0, 'C', true);
        $pdf->Cell(78, 8, 'MEGA ASIA S.A.C.', 1, 0, 'C', true);
        $pdf->Cell(78, 8, 'ERNESTO ALONSO ZUÑIGA', 1, 0, 'C', true);
        $pdf->Ln(14);
        $pdf->SetFillColor(254, 254, 254);  //TITULO SECUNDARIO
        $pdf->SetFont('Arial', 'B', 7);      //TITULO SECUNDARIO
        $pdf->Cell(34, 8, 'FECHA DE SOLICITUD ', 1, 0, 'C', true);
        $pdf->Cell(78, 8, 'ENCARGADO', 1, 0, 'C', true);
        $pdf->Cell(78, 8, 'AREA SOLICITANTE ', 1, 0, 'C', true);
        $pdf->Ln(8);
        $pdf->SetFillColor(254, 254, 254);  //TEXTO 
        $pdf->SetFont('Arial', '', 8);      //TEXTO
        $pdf->Cell(34, 8, $requerimiento['fecha'], 1, 0, 'C', true);
        $pdf->Cell(78, 8, $requerimiento['nombres'], 1, 0, 'C', true);
        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(78, 8, 'LOGISTICA', 1, 0, 'C', true);

        $pdf->Ln(14);
    }
}
$pdf->SetFont('Arial', 'B', 9);     //TITULO GENERAL
$pdf->SetFillColor(0, 0, 0);  //TITULO GENERAL
$pdf->SetDrawColor(0, 0, 0);        //TITULO GENERAL
$pdf->SetTextColor(255, 255, 255);        //TITULO GENERAL
$pdf->Cell(190, 8, 'DETALLE DE REQUERIMIENTO', 1, 0, 'C', true);
$pdf->Ln(8);
$pdf->SetFillColor(254, 254, 254);  //TITULO SECUNDARIO
$pdf->SetFont('Arial', 'B', 8);      //TITULO SECUNDARIO
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(20, 8, 'N°', 1, 0, 'C', true);
$pdf->Cell(50, 8, 'ARTICULO', 1, 0, 'C', true);
$pdf->Cell(50, 8, 'MARCA', 1, 0, 'C', true);
$pdf->Cell(40, 8, 'PROVEEDOR', 1, 0, 'C', true);
$pdf->Cell(30, 8, 'CANTIDAD', 1, 0, 'C', true);
$i=1;

$query1 = "SELECT *, COUNT(idDet_Req_Entrada) AS cantidad_reqentrada FROM det_req_entrada   
INNER JOIN productos ON productos.idProducto = det_req_entrada.idProducto
INNER JOIN marca on marca.idMarca = productos.idMarca
INNER JOIN proveedor on proveedor.idProveedor = productos.idProveedor
WHERE det_req_entrada.idReq_Entrada = '$rq_id'
GROUP BY det_req_entrada.idProducto;";


/*$query1 = "SELECT *, COUNT(backup_Talla) AS cantidad_backup FROM backup   
          INNER JOIN uniforme ON backup.uniforme_Codigo = uniforme.uniforme_Codigo     
          WHERE backup.requerimiento_Codigo = '$rq_id' and backup.backup_Estado IN ('BACKUP','ASIGNADO')
          GROUP BY backup.backup_Talla , backup.uniforme_Codigo ";*/
$query_run1 = mysqli_query($con, $query1);

if (mysqli_num_rows($query_run1) > 0) {
    foreach ($query_run1 as $reqen) {
        
        $pdf->Ln(8);
        $pdf->SetFillColor(254, 254, 254);  //TEXTO 
        $pdf->SetFont('Arial', '', 7);      //TEXTO
        $pdf->Cell(20, 8, $i, 1, 0, 'C', true);
        $pdf->Cell(50, 8, $reqen['producto'], 1, 0, 'C', true);
        $pdf->Cell(50, 8, $reqen['marca'], 1, 0, 'C', true);
        $pdf->Cell(40, 8, $reqen['proveedor'], 1, 0, 'C', true);
        $pdf->Cell(30, 8, $reqen['cantidad_reqentrada'], 1, 0, 'C', true);
        $i++;
    }
}


$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 7);

//fecha
// Otra opción: $pdf->Cell(40, 10, date('d/m/Y'), 0, 1, 'L');
/* $pdf->Cell(190, 5, 'FECHA DE CREACIÓN: ' . date('d') . ' / ' . date('m') . ' / ' . date('Y'), 0, 1, 'R'); */
//fin de pagina
$pdf->Output('Reporte_Req_Entrada.pdf', 'I');