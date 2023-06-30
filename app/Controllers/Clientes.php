<?php 
namespace App\Controllers;

use App\Models\ClientesModel;

use Exception;

class Clientes extends BaseController{

    protected $ClientesModel;

    public function __construct(){
        $this->ClientesModel= new ClientesModel(); //llamar al modelo 
    }
    public function index()
    {
        $vista = "clientes/index";
        $this->estructura($vista); //llamar a los archivos
    }


    public function Listar(){
        $datos=$this->ClientesModel->listarClientes(); //traemos datos y lo almacenamos en la variable datos
        $data=array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["ID_Cliente"];
            $sub_array[] = $row["Nombre_Cliente"];
            $sub_array[] = $row["Apellido_Cliente"];
            $sub_array[] = $row["Dni_Cliente"];
            $sub_array[] = $row["Telefono_Cliente"];
            $sub_array[] = $row["Correo_Cliente"];
            $sub_array[] = $row["Direccion_Cliente"];
            $sub_array[] = $row["Estado_Cliente"] == 1 ? '<span class="badge badge-success">Activo</span>' : '<span class="badge badge-danger">Inactivo</span>';
            $sub_array[] = '<div class="btn-group" role="group" aria-label="Button group">
            <a class="btn btn-primary btn-sm" onClick="EditarCliente(' . $row["ID_Cliente"] . ')" title="Actualizar"><i class="fas fa-pencil-alt"></i></a>
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

    public function RegistrarEditar(){
        $respuesta=array();
        $validacion=$this->validate([
            
            'txtNombre'=>[
                'rules'=>'required|min_length[3]|max_length[50]',
                'errors'=>[
                    'required'=>'Ingresar Nombre de Cliente',
                    'min_length'=>'El nombre de Cliente debe ser mayor a dos caracteres',
                    'max_length'=>'El nombre de Cliente no debe superar 50 caracteres',
                ]
            ],

            'txtApellido'=>[
                'rules'=>'required|min_length[3]|max_length[70]',
                'errors'=>[
                    'required'=>'Ingresar Nombre de Cliente',
                    'min_length'=>'El Apellido del Cliente debe ser mayor a dos caracteres',
                    'max_length'=>'El Apellido del Cliente no debe superar 70 caracteres',
                ]
            ],

            'txtIdentificacion'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Ingresar el número de identificación'
                ]
            ],

            'txtTelefono'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Ingresar el número del Cliente',
                    
                ]
            ],

            
            'txtEmail'=>[
                'rules'=>'required|valid_email',
                'errors'=>[
                    'required'=>'Ingresar el correo electrónico',
                    'valid_email'=>'Ingresar un email válido'
                ]
            ],

            'txtDireccion'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Ingresar el número del Cliente',
                    
                ]
            ],

        ]); //para que se valide los campos requeridos

        $id=$this->request->getPostGet('idCliente'); //traer el dato del formulario
        $contraseña=$this->request->getPostGet('txtPassword');
        if(empty($id))
        {
            $validacion=$this->validate([
                'txtEmail'=>[
                    'rules'=>'is_unique[Cliente.Correo_Cliente]',
                    'errors'=>[
                        'is_unique'=>'El correo electrónico ingresado, ya existe'
                    ]
                ],

                'txtPassword'=>[
                    'rules'=>'required|min_length[8]',
                    'errors'=>[
                        'required'=>'Contraseña obligatoria',
                        'min_length'=>'La contraseña debe ser mayor o igual a 8 caracteres'

                    ]
                ],
            ]);

        }else{
            $datosCliente=$this->ClientesModel->getClientexEmail($this->request->getPostGet('txtEmail'));
            
            if($datosCliente){
                if($datosCliente[0]['ID_Cliente']!= $id){
                    $validacion=$this->validate([
                        'txtEmail'=>[
                            'rules'=>'is_unique[Cliente.Correo_Cliente]',
                            'errors'=>[
                                'is_unique'=>'El correo electrónico ingresado, ya existe'
                            ]
                        ],
        
                        
                    ]);
                }
            }

            if(!empty($contraseña))
            {
                
                $validacion=$this->validate([
                   
                    'txtPassword'=>[
                        'rules'=>'required | min_length[8]',
                        'errors'=>[
                            'required'=>'Contraseña obligatoria',
                            'min_length'=>'La contraseña debe ser mayor o igual a 8 caracteres'
    
                        ]
                    ],
                ]);
    
            }
        }

        if(!$validacion)
        {
            $respuesta['error'] =$this->validator->listErrors();
        } else{
            $contraHash=password_hash($contraseña,PASSWORD_DEFAULT); //encriptamos LA CONTRASEÑA
            $data=['ID_Cliente'=>$this->request->getPostGet('idCliente'),
                    'Nombre_Cliente'=>$this->request->getPostGet('txtNombre'),
                    'Apellido_Cliente'=>$this->request->getPostGet('txtApellido'),
                    'Dni_Cliente'=>$this->request->getPostGet('txtIdentificacion'),
                    'Telefono_Cliente'=>$this->request->getPostGet('txtTelefono'),
                    'Correo_Cliente'=>$this->request->getPostGet('txtEmail'),
                    'Contraseña_Cliente'=>$contraHash,
                    'Direccion_Cliente'=>$this->request->getPostGet('txtDireccion'),
                    'Estado_Cliente' => $this->request->getPostGet('listEstado')];
            if(empty($id))
            {
                try{
                    $this->ClientesModel->insert($data);
                    $respuesta['error']='';
                    $respuesta['ok'] = 'Datos registrados correctamente';
                }
                catch(Exception $e){
                    $respuesta['error']='Error en el servidor';
                }
            }
            else{
                if(empty($contraseña)){
                    $data2= ['ID_Cliente'=>$this->request->getPostGet('idCliente'),
                    'Nombre_Cliente'=>$this->request->getPostGet('txtNombre'),
                    'Apellido_Cliente'=>$this->request->getPostGet('txtApellido'),
                    'Dni_Cliente'=>$this->request->getPostGet('txtIdentificacion'),
                    'Telefono_Cliente'=>$this->request->getPostGet('txtTelefono'),
                    'Correo_Cliente'=>$this->request->getPostGet('txtEmail'),
                    'Direccion_Cliente'=>$this->request->getPostGet('txtDireccion'),
                    'Estado_Cliente' => $this->request->getPostGet('listEstado')];
                    try{
                        $this->ClientesModel->update($id,$data2);
                        $respuesta['error']='';
                        $respuesta['ok'] = 'Datos actualizados correctamente';
                    } 
                    catch(Exception $e){
                        $respuesta['error']='Error en el servidor';
                    }
                }

                else{
                    try{
                        $this->ClientesModel->update($id,$data);
                        $respuesta['error']='';
                        $respuesta['ok'] = 'Datos actualizados correctamente';
                    }
                    catch(Exception $e){
                        $respuesta['error']='Error en el servidor';
                    }
                }
            }
        }

        echo json_encode($respuesta);
    }

    public function buscar()
    {
        $data = array();
        $id = $this->request->getPostGet('id');
        $data['data'] = $this->ClientesModel->getClientes($id);
        echo json_encode($data);
    }

    public function eliminar()
    {
        $id = $this->request->getPostGet('id');
        $respuesta = array();
        try {
            $this->ClientesModel->where('ID_Cliente', $id)->delete();
            $respuesta['error'] = "";
            $respuesta['ok'] = "El cliente se Elimino Correctamente";
        } catch (Exception $e) {
            $respuesta['error'] = "Problemas al realizar Operación!";
        }
        echo json_encode($respuesta);
    }
}