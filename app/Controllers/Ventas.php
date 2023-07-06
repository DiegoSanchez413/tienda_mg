<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\VentasModel;
use App\Models\ClientesModel;
use App\Models\ProductosModel;
use App\Models\VentasDetalleModel;
use Exception;
use FPDF;
use DateTime;

class Ventas extends BaseController
{

    protected $VentasModel;
    protected $ClientesModel;
    protected $ProductosModel;
    protected $VentasDetalleModel;

    public function __construct()
    {
        $this->VentasModel = new VentasModel(); //llamar al modelo 
        $this->ClientesModel = new ClientesModel();
        $this->ProductosModel = new ProductosModel();
        $this->VentasDetalleModel = new VentasDetalleModel();
    }

    public function index()
    {
        if ($_SESSION['rol'] == 3 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 1) {        
            $vista = "ventas/index";
        } else {
            $vista = "errors/html/errores_permiso";
        }

        $this->estructura($vista, ); //llamar a los archivos
    }

    public function index2()
    {
        $vista = "ventas/registrarVenta";
        $dato['generar_codigo'] = $this->VentasModel->generar_codigo_venta();
        $dato['dato'] = $this->ClientesModel->listarClientes();
        $dato['dato2'] = $this->ProductosModel->listarProductos();
        $this->estructura($vista, $dato); //llamar a los archivos
    }

    
    public function RegistrarVenta()
    {
        $respuesta = array();
        $validacion = $this->validate([

            'listCliente' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccionar el Cliente'
                ]
            ],

            'txtFecha' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccion la fecha'
                ]
            ],

            'listEstado' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccione un estado'
                ]
            ],
 

        ]);

        $id = $this->request->getPostGet('id_venta');
        $producto = $this->request->getPostGet('productoid');
        if (!$validacion || empty($producto)) {
            $error = '';
            if (empty($producto)) {
                $error = '<li>Ingrese una venta</li>';

            }
            $respuesta['error'] = $this->validator->listErrors() . $error;

        } else {
            $data = [

                'codigo_venta' =>$this->VentasModel->generar_codigo_venta(),
                'ID_Cliente' => $this->request->getPostGet('listCliente'), //los que dicen post vienen del js
                'Fecha_Venta' => $this->request->getPostGet('txtFecha'),
                'Igv_Venta' => $this->request->getPostGet('igv'),
                'Estado_Venta' => $this->request->getPostGet('listEstado'),
                'Total_Venta' => $this->request->getPostGet('total'),
                'SubTotal_Venta' => $this->request->getPostGet('subtotal'),
            ];

            if (empty($id)) {
                try {
                    $this->VentasModel->insert($data);
                    $id_generado = $this->VentasModel->insertID();
                    for ($i = 0; $i < count($_POST['productoid']); $i++) {
                        $data2 = [
                            'ID_Venta' => $id_generado,
                            'ID_Producto' => $_POST['productoid'][$i],
                            'Cantidad_DetalleVenta' => $_POST['cantidad'][$i],
                            'Precio_DetalleVenta' => $_POST['precio'][$i],
                            'ImporteVenta_DetalleVenta' => $_POST['importe_det'][$i],

                        ];
                        $this->VentasDetalleModel->insert($data2);

                    }
                    $respuesta['error'] = "";
                    $respuesta['ok'] = "Datos registrados correctamente";
                } catch (Exception $e) {
                    // $respuesta['error'] = "Error en el servidor";
                    $respuesta['error'] = $e->getMessage();
                }
            }
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);


    }
    public function listar()
    {
        $datos = $this->VentasModel->listarVentas(); //traemos datos y lo almacenamos en la variable datos
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["codigo_venta"];
            $sub_array[] = $row["Nombre_Cliente"];
            $sub_array[] = $row["Fecha_Venta"];
            $sub_array[] = $row["Total_Venta"];
            $sub_array[] = $row["SubTotal_Venta"];
            $sub_array[] = '<div class="btn-group" role="group" aria-label="Button group">
            
            <a class="btn btn-success text-white" onClick="mostrar_ventas(' . $row["ID_Venta"] . ')" title="Detalleventas"><i class="fas fa-eye"></i></a>
            <a download="' . $row['codigo_venta'] . 'Orden-compra.pdf" class="btn btn-danger text-white" onClick="pdf(' . $row["ID_Venta"] . ')" title="Reporte"><i class="fas fa-file-pdf"></i></a>
            </div>';
            $data[] = $sub_array;
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
    }

    public function listarDetalles()
    {
        $id = $this->request->getPostGet('id');
        $datos = $this->VentasDetalleModel->listar_por_venta($id);
        
        $data = array();

        foreach ($datos as $index=>$valio) {
            $sub_array = array();
            $sub_array[] = $valio->ID_DetalleVenta;
            $sub_array[]= $valio->Nombre_Producto;
            $sub_array []= $valio->Cantidad_DetalleVenta;
            $sub_array []= $valio->Precio_DetalleVenta;
            $data[] = $sub_array;
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);

    }


    public function pdfventa($id)
    {

        $datos = $this->VentasModel->buscar_x_id_datosPDF($id);
        $detalles = $this->VentasDetalleModel->listar_por_venta($id);
        $datos = $this->VentasModel->buscar($id);

        
        $respons = service('response');
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage('P', 'A4');
        $pdf->SetMargins(17,17,17);
        $respons->setHeader('Content-Type', 'application/pdf');
        $pdf->SetTitle($datos[0]['codigo_venta'] . ' - BOLETA VENTA');
        # Logo de la empresa formato png #
	    $pdf->Image(ROOTPATH . '/public/images/mg.png',165,12,35,35,'PNG');

        // Agregar contenido al PDF
        $pdf->SetFont('Arial', 'B', 17);
        $pdf->SetTextColor(27,107,147);
        $pdf->SetY($pdf->GetY() + 11);
        $pdf->Cell(180, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'BOLETA'), 0, 1, 'L');
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(154, 7,  iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'CODIGO:'), 0, 0, 'L');
        $pdf->SetX(32); 
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(22, 6.5, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $datos[0]['codigo_venta']), 0, 1, 'L');
        //$pdf->SetFont('Arial', 'B', 12);
        
        $pdf->SetFont('Arial','B',10);
	    $pdf->SetTextColor(39,39,51);
	    $pdf->Cell(150,9,utf8_decode("RUC: 20605915494"),0,0,'L');
       
	    $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(150, 9, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'MG NETWORKS E.I.R.L.'), 0, 0, 'L');
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(150, 9, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'Av. San Martin de Porres Nro. 1320 Dpto. 504 INT. S'), 0, 0, 'L');
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(150, 9, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'LIMA - LIMA - ATE'), 0, 0, 'L');
        $pdf->Ln(7);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(152, 5, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'FECHA:'), 0, 0, 'L');
        $pdf->SetX(30); 
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(24,5, iconv("UTF-8", "ISO-8859-1//TRANSLIT",  date("d-m-Y", strtotime($datos[0]['Fecha_Venta']))), 0, 1, 'L');
        //$pdf->Ln(1);
        $pdf->Ln(7);   
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(20, 5, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'CLIENTE: '), 0, 0, 'L'); 
        $pdf->SetX(35);                         //  - salto de linea
        $pdf->SetFont('Arial', '', 9);
        //$pdf->Cell(160, 5, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $datos[0]['Nombre_Cliente']), 0, 1, 'L');
        $nombreCompleto = $datos[0]['Nombre_Cliente'] . ' ' . $datos[0]['Apellido_Cliente'];
        $pdf->Cell(160, 5, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $nombreCompleto), 0, 1, 'L');
        
        $pdf->Ln(2);

        # Tabla de productos #
	    $pdf->SetFont('Arial','B',8);
	    $pdf->SetFillColor(50,72,115);
	    $pdf->SetDrawColor(50,72,115);
	    $pdf->SetTextColor(255,255,255);

        $pdf->Cell(10,8,utf8_decode("#"),1,0,'C',true);
	    $pdf->Cell(65,8,utf8_decode("PRODUCTOS"),1,0,'C',true);
	    $pdf->Cell(35,8,utf8_decode("MARCA"),1,0,'C',true);
	    $pdf->Cell(19,8,utf8_decode("CANTIDAD"),1,0,'C',true);
        $pdf->Cell(19,8,utf8_decode("PRECIO"),1,0,'C',true);
	    $pdf->Cell(30,8,utf8_decode("IMPORTE"),1,0,'C',true);

	    $pdf->Ln(9);

	
	    $pdf->SetTextColor(39,39,51);

        $contador = 0;
        $espacioBlanco = 7;
        foreach ($detalles as $row) {
            $nombre_producto_lines = str_split($row->Nombre_Producto, 14);
            $elementos = count($nombre_producto_lines);
            $elementos = $elementos + ($elementos - 1);
            $pdf->SetFont('Arial', '', 8);
            $x = $pdf->GetX();
            $y = $pdf->GetY();
            $contador++;
            $pdf->SetDrawColor(0,0,0);
            $pdf->SetXY($x, $y);
            $pdf->MultiCell(10, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $contador) ,0, 'C');
            $pdf->SetXY($x + 12, $y + 0);
            $pdf->MultiCell(60, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row->Nombre_Producto), 0, 'C');
            
            $pdf->SetXY($x + 55, $y);
            $pdf->MultiCell(75, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row->Marca_Producto), 0, 'C');
            $pdf->SetXY($x + 85, $y);
            $pdf->MultiCell(68, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row->Cantidad_DetalleVenta), 0, 'C');
            $pdf->SetXY($x + 85, $y);
            $pdf->MultiCell(108, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row->Precio_DetalleVenta), 0, 'C');
            //$precio=number_format($row['Precio_DetalleVenta'], 2, '.', ',');
            //$pdf->MultiCell(108, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $precio), 0, 'C');
            //$pdf->SetXY($x + 10, $y+1);
            //$pdf->MultiCell(45, 3, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Precio_DetalleVenta']), 0, 'C');
           // $pdf->MultiCell(108, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row->Precio_Detalle), 0, 'C');

            $pdf->SetXY($x + 115, $y);
            //$importec=number_format($row['ImporteVenta_DetalleVenta'], 2, '.', ',');
            $pdf->MultiCell(100, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT",$row->ImporteVenta_DetalleVenta), 0, 'C');

            $y = $pdf->GetY() + $espacioBlanco; // Agrega un espacio en blanco de 10 unidades
            $pdf->SetY($y); // Establece la nueva posición Y

            $pdf->Ln(7);
        }
            $pdf->Cell(90, 1, '', '', 1);
            $pdf->Line($pdf->GetX() + 120, $pdf->GetY(), $pdf->GetX() + 172, $pdf->GetY());
            
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell(139, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'SUB TOTAL:'), 0, 0, 'R');
            $pdf->SetFont('Arial', '', 9);
            $subtotal=number_format($datos[0]['SubTotal_Venta'], 2, '.', ',');
            $pdf->Cell(33, 7,'S/. '. iconv("UTF-8", "ISO-8859-1//TRANSLIT", $subtotal), 0, 1, 'R');
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell(140, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'IGV(%): '), 0, 0, 'R');
            $pdf->SetFont('Arial', 'B', 9);
            $igv2=number_format(intval($datos[0]['SubTotal_Venta'])*0.18,'2','.',',');
            $pdf->Cell(33, 7,'S/. '. iconv("UTF-8", "ISO-8859-1//TRANSLIT", $igv2), 0, 1, 'R');
            
            $pdf->Cell(90, 1, '', '', 1);
            $pdf->Line($pdf->GetX() + 120, $pdf->GetY(), $pdf->GetX() + 172, $pdf->GetY());
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Ln(1);
            $pdf->Cell(140, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'TOTAL: '), 0, 0, 'R');
            $pdf->SetFont('Arial', '', 9);
            $total=number_format($datos[0]['Total_Venta'], 2, '.', ',');
            $pdf->Cell(32, 7,'S/. '. iconv("UTF-8", "ISO-8859-1//TRANSLIT", $total), 0, 1, 'R');

            $pdf->Output($datos[0]['codigo_venta'] . '-Orden-de-compra.pdf', 'I');

        // Generar el PDF
        $pdfContent = $pdf->Output('S'); // Obtener el contenido del PDF como una cadena

        // Retornar el PDF desde el controlador
        $response = service('response');
        $response->setHeader('Content-Type', 'application/pdf');
        $response->setBody($pdfContent);

        return $response;

        // Creamos una instancia de la clase DateTime con la fecha actual
        $fecha_actual = new DateTime();

        // Formateamos la fecha en el formato deseado
        $fecha_formateada = $fecha_actual->format('j \d\e F \d\e\l Y');
    }
}



