<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    public $session = null; //captura las sesiones del inicio de sesion


    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->session = \Config\Services::session();

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();

        //funcion para llamar footer,etc


    }

    public function estructura($view = null, $data=null){
        if($data){
            echo view("estructura/header_admin");
            echo view("estructura/nav_admin");
            echo view($view,$data);
            echo view("estructura/footer_admin");

        } else{
            echo view("estructura/header_admin");
            echo view("estructura/nav_admin");
            echo view($view);
            echo view("estructura/footer_admin");
        }
    }

    public function estructuraTienda($view = null, $data = null){
        if($data){
            echo view("estructurat/header_tienda");
            echo view("estructurat/nav_tienda");
            echo view($view,$data);
            echo view("estructurat/footer_tienda");

        }else{
            echo view("estructurat/header_tienda");
            echo view("estructurat/nav_tienda");
            echo view($view);
            echo view("estructurat/footer_tienda");

        }
    }
}
