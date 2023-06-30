<?php

namespace App\Controllers;

use exception;
use FPDF;
use CodeIgniter\Controller;
use App\Models\ComprasModel;
use App\Models\UsuariosModel;
use App\Models\ProductosModel;
use App\Models\ProveedorModel;
use App\Models\ComprasDetalleModel;
use CodeIgniter\CLI\Console;
use DateTime;

class Compras extends BaseController
{

    protected $UsuariosModel;
    protected $ComprasModel;
    protected $ProductosModel;
    protected $ProveedorModel;
    protected $ComprasDetalleModel;


    public function __construct()
    {
        $this->ComprasModel = new ComprasModel(); // se llama al modelo
        $this->UsuariosModel = new UsuariosModel();
        $this->ProductosModel = new ProductosModel();
        $this->ProveedorModel = new ProveedorModel();
        $this->ComprasDetalleModel = new ComprasDetalleModel();
    }


    public function index()
    {
        if ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 1) {
            $vista = "compras/index";
        } else {
            $vista = "errors/html/errores_permiso";
        }
        $this->estructura($vista); // llama a los archivos

    }


    public function registrar()
    {
        $dato['generar_codigo'] = $this->ComprasModel->generar_codigo_compra();
        $vista = "compras/registrar_compra";
        $dato['dato'] = $this->UsuariosModel->listarUsuarios();
        $dato['prod'] = $this->ProductosModel->listarProductos();
        $dato['prov'] = $this->ProveedorModel->listarProveedores();


        $this->estructura($vista, $dato);
    }


    public function RegistrarCompra()
    {
        $respuesta = array();
        $validacion = $this->validate([


            'listUsuario' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccionar el usuaio',

                ]
            ],

            'fecha_compra' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccionar el proveedor',

                ]
            ],
            /*
            'igv' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ingresar el igv',

                ]
            ], */

            'listEstado' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccionar el estado',

                ]
            ],

            'total' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccionar el estado',

                ]
            ],

            'subtotal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Seleccionar el estado',

                ]
            ],

        ]);

        // Para que valide los campos requeridos
        $id = $this->request->getPostGet('id_compra');
        $producto = $this->request->getPostGet('productoid');
        if (!$validacion || empty($producto)) {
            $error = '';
            if (empty($producto)) {
                $error = '<li>Ingrese al menos una compra</li>';
            }
            $respuesta['error'] = $this->validator->listErrors() . $error;
        } else {
            $data = [

                'Codigo_Compra' => $this->ComprasModel->generar_codigo_compra(),
                'ID_Usuario' =>  $this->request->getPostGet('listUsuario'),  //los que dicen post vienen del js
                'Fecha_Compra' => $this->request->getPostGet('fecha_compra'),
                'IGV_Compra' => $this->request->getPostGet('igv'),
                'Estado_Compra' => $this->request->getPostGet('listEstado'),
                'Total_Compra' => $this->request->getPostGet('total'),
                'SubTotal_Compra' => $this->request->getPostGet('subtotal'),


            ];

            if (empty($id)) {
                try {
                    $this->ComprasModel->insert($data);
                    $id_generado = $this->ComprasModel->insertID();
                    for ($i = 0; $i < count($_POST['productoid']); $i++) {
                        $data2 = [
                            'ID_Compra' => $id_generado,
                            'ID_Producto' => $_POST['productoid'][$i],
                            'ID_Proveedor' => $_POST['proveedorid'][$i],
                            'CantidadProducto_DetalleCompra' => $_POST['cantidad'][$i],
                            'Precio_Producto' => $_POST['precio'][$i],
                            'ImporteCompra_DetalleCompra' => $_POST['importe_det'][$i],

                        ];
                        $this->ComprasDetalleModel->insert($data2);
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

        $datos = $this->ComprasModel->listarCompras();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['ID_Compra'];
            $sub_array[] = $row['Codigo_Compra'];
            $sub_array[] = $row['Nombre_Usuario'];
            $sub_array[] = $row['Fecha_Compra'];
            //$sub_array[] = $row['IGV_Compra'];
            $sub_array[] = number_format(intval($row['SubTotal_Compra']) * 0.18, '2', '.', '');
            $sub_array[] = $row['Total_Compra'];
            $sub_array[] = $row['SubTotal_Compra'];
            $sub_array[] = '<div class="btn-group" role="group" aria-label="Button group">
            <a class="btn btn-success text-white" onClick="mostrar_compras(' . $row["ID_Compra"] . ')" title="DetalleCompras"><i class="fas fa-eye"></i></a>
            <a download="' . $row['Codigo_Compra'] . 'Orden-compra.pdf" class="btn btn-danger text-white" onClick="pdf(' . $row["ID_Compra"] . ')" title="Reporte"><i class="fas fa-file-pdf"></i></a>
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
        $datos = $this->ComprasDetalleModel->listar_por_compra($id);

        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['ID_DetalleCompra'];
            $sub_array[] = $row['Nombre_Producto'];
            $sub_array[] = $row['RazonSocial_Proveedor'];
            $sub_array[] = $row['CantidadProducto_DetalleCompra'];
            $sub_array[] = $row['ImporteCompra_DetalleCompra'];

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


    public function pdf($id)
    {

        $datos = $this->ComprasModel->buscar_x_id_datosPDF($id);
        $detalles = $this->ComprasDetalleModel->listar_por_compra($id);

        $datos = $this->ComprasModel->buscar($id);
        $respons = service('response');
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage('P', 'A4');
        $pdf->SetMargins(15, 15);
        $respons->setHeader('Content-Type', 'application/pdf');
        $pdf->SetTitle($datos[0]['Codigo_Compra'] . ' - ORDEN DE COMPRA COMPRA');
        $pdf->Cell(65, 15, $pdf->Image(ROOTPATH . '/public/images/mg.png', $pdf->GetX() + 5, $pdf->GetY(), 40, 35), 0, 1);
        $pdf->Ln(11);
        // Agregar contenido al PDF
        $pdf->SetFont('Arial', 'B', 17);
        $pdf->SetY($pdf->GetY() + 11);
        $pdf->Cell(180, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'ORDEN DE COMPRA'), 0, 1, 'C');
        //$pdf->SetFont('Arial', 'B', 12);

        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(154, 7,  iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'CODIGO:'), 0, 0, 'R');
        $pdf->SetFont('Arial', '', 9);

        $pdf->Cell(22, 6.5, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $datos[0]['Codigo_Compra']), 0, 1, 'R');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(152, 5, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'FECHA:'), 0, 0, 'R');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(24, 5, iconv("UTF-8", "ISO-8859-1//TRANSLIT",  date("d-m-Y", strtotime($datos[0]['Fecha_Compra']))), 0, 1, 'R');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(176, 5, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'MG NETWORKS E.I.R.L.'), 0, 1, 'R');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(176, 5, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'Ca. Ariadna 180 Edf. 7 Ofic 501 Santiago De Surco'), 0, 1, 'R');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(176, 5, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'Lima Lima'), 0, 1, 'R');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(20, 5, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'Usuario: '), 0, 0, 'L');                         //  - salto de linea
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(160, 5, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $datos[0]['Nombre_Usuario']), 0, 1, 'L');


        $pdf->Ln(2);
        $pdf->SetFillColor(225, 220, 220);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'DETALLE DE COMPRAS'), 0, 1, 'C', true);
        $pdf->SetFont('Arial', 'B', 7);
        //180
        $pdf->Cell(10, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", '#'), 0, 0, 'C', true);
        $pdf->Cell(45, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'PRODUCTOS'), 0, 0, 'C', true);
        $pdf->Cell(30, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'PROVEEDOR'), 0, 0, 'C', true);
        $pdf->Cell(30, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'CANTIDAD'), 0, 0, 'C', true);
        $pdf->Cell(30, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'IMPORTE'), 0, 1, 'C', true);


        $contador = 0;
        foreach ($detalles as $row) {
            $nombre_producto_lines = str_split($row['Nombre_Producto'], 14);
            $elementos = count($nombre_producto_lines);
            $elementos = $elementos + ($elementos - 1);
            $pdf->SetFont('Arial', '', 8);
            $x = $pdf->GetX();
            $y = $pdf->GetY();
            $contador++;
            $pdf->SetXY($x, $y);
            $pdf->MultiCell(10, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $contador), 0, 'C');
            $pdf->SetXY($x + 10, $y + 1);
            $pdf->MultiCell(45, 3, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['Nombre_Producto']), 0, 'C');
            $pdf->SetXY($x + 55, $y);
            $pdf->MultiCell(30, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['RazonSocial_Proveedor']), 0, 'C');
            $pdf->SetXY($x + 85, $y);
            $pdf->MultiCell(30, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['CantidadProducto_DetalleCompra']), 0, 'C');
            $pdf->SetXY($x + 115, $y);
            $pdf->MultiCell(35, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $row['ImporteCompra_DetalleCompra']), 0, 'C');

            $y = $pdf->GetY() + $elementos; // Agrega un espacio en blanco de 10 unidades
            $pdf->SetY($y); // Establece la nueva posición Y

            $pdf->Ln(7);
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell(139, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'SUB TOTAL:'), 0, 0, 'R');
            $pdf->SetFont('Arial', '', 9);
            $pdf->Cell(33, 7, 'S/. ' . iconv("UTF-8", "ISO-8859-1//TRANSLIT", $datos[0]['SubTotal_Compra']), 0, 1, 'R');
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell(140, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'IGV(%): '), 0, 0, 'R');
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Cell(33, 7, '%. ' . iconv("UTF-8", "ISO-8859-1//TRANSLIT", $datos[0]['IGV_Compra']), 0, 1, 'R');
            $pdf->Cell(90, 1, '', '', 1);
            $pdf->Line($pdf->GetX() + 120, $pdf->GetY(), $pdf->GetX() + 172, $pdf->GetY());
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Ln(1);
            $pdf->Cell(140, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'TOTAL: '), 0, 0, 'R');
            $pdf->SetFont('Arial', '', 9);
            $pdf->Cell(32, 7, 'S/. ' . iconv("UTF-8", "ISO-8859-1//TRANSLIT", $datos[0]['Total_Compra']), 0, 1, 'R');

            $pdf->Output($datos[0]['Codigo_Compra'] . '-Orden-de-compra.pdf', 'I');
        }

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
