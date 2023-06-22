<?php

namespace App\Controllers;

class Carrito extends BaseController
{
    public function index()
    {
        $vista = "carrito/carrito";
        $this->estructuraTienda($vista);
    }

    public function authenticate()
    {
        $clientId = $_ENV['PAYPAL_CLIENT_ID'];
        $clientSecret  = $_ENV['PAYPAL_SECRET'];

        $url = "https://api-m.sandbox.paypal.com/v1/oauth2/token";
        $credentials = base64_encode($clientId . ":" . $clientSecret);

        $data = "grant_type=client_credentials";

        $headers = array(
            "Content-Type: application/x-www-form-urlencoded",
            "Authorization: Basic " . $credentials
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);



        if ($response === false) {
            $error = curl_error($ch);
            // echo "cURL Error: " . $error;
            return $error;
        } else {
            return $response;
            // echo "Response: " . $response;
        }

        curl_close($ch);
    }

    public function create_order()
    {
        $url = "https://api-m.sandbox.paypal.com/v2/checkout/orders";
        $accessToken = json_decode($this->authenticate())->access_token;
        $cart = json_decode($this->request->getPostGet('cart'));
        // $cart = json_decode($json);
        $data = array(
            "intent" => "CAPTURE",
            "purchase_units" => array()
        );
        
        foreach ($cart as $item) {
            $purchaseUnit = array(
                "reference_id" => $item->ID_Producto,
                "amount" => array(
                    "currency_code" => "USD",
                    "value" => $item->Precio_Producto * $item->quantity
                ),
                "shipping" => array(
                    "address" => array(
                        "address_line_1" => "2211 N First Street",
                        "address_line_2" => "Building 17",
                        "admin_area_2" => "San Jose",
                        "admin_area_1" => "CA",
                        "postal_code" => "95131",
                        "country_code" => "US"
                    )
                )
            );
        
            $data["purchase_units"][] = $purchaseUnit;
        }


        // $data = array(
        //     "intent" => "CAPTURE",
        //     "purchase_units" => array(
        //         array(
        //             "reference_id" => "1",
        //             "amount" => array(
        //                 "currency_code" => "USD",
        //                 "value" => "10.00"
        //             ),
        //             "shipping" => array(
        //                 "address" => array(
        //                     "address_line_1" => "2211 N First Street",
        //                     "address_line_2" => "Building 17",
        //                     "admin_area_2" => "San Jose",
        //                     "admin_area_1" => "CA",
        //                     "postal_code" => "95131",
        //                     "country_code" => "US"
        //                 )
        //             )
        //                 ),
        //         array(
        //             "reference_id" => "2",
        //             "amount" => array(
        //                 "currency_code" => "USD",
        //                 "value" => "20.00"
        //             ),
        //             "shipping" => array(
        //                 "address" => array(
        //                     "address_line_1" => "2211 N First Street",
        //                     "address_line_2" => "Building 17",
        //                     "admin_area_2" => "San Jose",
        //                     "admin_area_1" => "CA",
        //                     "postal_code" => "95131",
        //                     "country_code" => "US"
        //                 )
        //             )
        //         )
        //     ),
        // );

        $headers = array(
            "Content-Type: application/json",
            "Authorization: Bearer " . $accessToken
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        if ($response === false) {
            $error = curl_error($ch);
            return $error;
        } else {
            return $response;
        }
        curl_close($ch);
    }

    public function capture_order()
    {
        $orderId = $this->request->getPostGet('orderID');
        $accessToken = json_decode($this->authenticate())->access_token;
        $url = "https://api-m.sandbox.paypal.com/v2/checkout/orders/$orderId/capture";
    
        $headers = array(
            "Content-Type: application/json",
            "Authorization: Bearer " . $accessToken
        );
    
        $data = array(
            "payment_source" => array(
                "paypal" => array(
                    "name" => array(
                        "given_name" => "John",
                        "surname" => "Doe"
                    ),
                    "email_address" => "johndoe@email.com",
                    "account_id" => "QYR5Z8XDVJNXQ",
                )
            )
        );
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
        $response = curl_exec($ch);
    
        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            return $error;
        }
    
        curl_close($ch);
        return $response;
    }

    public function show_order_details($orderId)
    {
        $accessToken =  json_decode($this->authenticate())->access_token;

        $url = "https://api-m.sandbox.paypal.com/v2/checkout/orders/$orderId";

        $headers = array(
            "Authorization: Bearer $accessToken"
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            return $error;
        }
    
        curl_close($ch);
        return $response;
    }

    public function store_checkout(){
        $order = $this->request->getPostGet('orderData');
        $clientId = $this->request->getPostGet('clientId');
        $builder = \Config\Database::connect();
        $query = $builder->query("CALL store_sale(?,?)", array([$order], intval($clientId)));
        $results = $query->getResult();
        return json_encode($results);
    }

    public function purchases(){
        $vista = "purchases/list";
        $this->estructuraTienda($vista);
    }

    public function list_purchases(){
        $data=[];
        $clientId = $this->request->getPostGet('id');
        $builder = \Config\Database::connect();
        $query = $builder->query("CALL get_sales(?)",  array($clientId));
        $results = $query->getResult();

        foreach ($results as $index => $value) {
            $sub_array = array();
            $sub_array[]  = $index + 1;
            $sub_array[] = $value->ID_Venta;
            $sub_array[] = $value->cliente;
            $sub_array[] =  'S/.' .  $value->Total_Venta;
            $sub_array[] = '
            <div class="btn-group" role="group" aria-label="Button group">
                <a class="btn btn-primary btn-sm" onClick="checkDetail(' . $value->ID_Venta . ')" title="Visualizar"><i class="fas fa-eye"></i></a>
            </div>';
            $data[] = $sub_array;
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data) ?? 0,
            "iTotalDisplayRecords" => count($data) ?? 0,
            "aaData" => $data
        );
        echo json_encode($results);
    }

    public function purchase_detail($purchaseId){
        $builder = \Config\Database::connect();
        $query = $builder->query("CALL get_sale_detail(?)",  array($purchaseId));
        $results = $query->getResult();
        foreach ($results as $index => $value) {
            $sub_array = array();
            $sub_array[] = $index + 1;
            $sub_array[] = $value->Nombre_Producto;
            $sub_array[] = "<div class='text-center'><img src='" . base_url() . "/img/productos/" . $value->Imagen_Producto . "' class='img-thumbnail mx-auto' width='75' height='75' /></div>";
            $sub_array[] = $value->Cantidad_DetalleVenta;
            $sub_array[] =   'S/.' . $value->Precio_DetalleVenta;
            $sub_array[] =  'S/.' . ($value->Precio_DetalleVenta * $value->Cantidad_DetalleVenta);
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
}
