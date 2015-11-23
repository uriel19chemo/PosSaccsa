<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Clase control pdf
class Pdf extends CI_Controller {
//constructor de la clase	
    public function __construct() {
        parent::__construct();
        $this->load->model('model_pdf_excel', 'pdf');//Cargamos modelo pdf excel
    }
//Funcion index 
    public function index(){
	 
    }
//Exportacion PDF DE USUARIOS	
    public function exportarUsuarios(){
	
        $data["usuarios"] = $this->pdf->getUsuarios();//Llamamos a funcion getUsuarios
        $this->load->vars($data);//Almacenamos los registros 
        $this->load->view("usuarios/pdf_usuarios");//Cargamos la vista del pdf

    }
//Exportacion PDF DE Categorias	
    public function exportarCategorias(){
	
        $data["categorias"] = $this->pdf->getCategorias();//Llamamos a funcion getCategorias
        $this->load->vars($data);//Almacenamos los registros 
        $this->load->view("categorias/pdf_categorias");//Cargamos la vista del pdf

    }
//Exportacion PDF DE SubCategorias	
    public function exportarSubCategorias(){
	
        $data["subcategorias"] = $this->pdf->getSubCategorias();//Llamamos a funcion getSubCategorias
        $this->load->vars($data);//Almacenamos los registros 
        $this->load->view("categorias/pdf_subcategorias");//Cargamos la vista del pdf

    }
//Exportacion PDF DE clientes
    public function exportarClientes(){
	
        $data["clientes"] = $this->pdf->getClientes();//Llamamos a funcion getClientes
        $this->load->vars($data);//Almacenamos los registros 
        $this->load->view("clientes/pdf_clientes");//Cargamos la vista del pdf

    }
//Exportacion PDF DE Departamentos	
    public function exportarDepartamentos(){
	
        $data["departamentos"] = $this->pdf->getDepartamentos();//Llamamos a funcion getDepartamentos
        $this->load->vars($data);//Almacenamos los registros 
        $this->load->view("departamento/pdf_departamentos");//Cargamos la vista del pdf

    }
//Exportacion PDF DE Productos	
    public function exportarProductos(){
	
        $data["productos"] = $this->pdf->getProductos();//Llamamos a funcion getProductos
        $this->load->vars($data);//Almacenamos los registros 
        $this->load->view("productos/pdf_productos");//Cargamos la vista del pdf

    }
//Exportacion PDF DE Proveedores	
    public function exportarProveedores(){
	
        $data["proveedores"] = $this->pdf->getProveedores();//Llamamos a funcion getProveedores
        $this->load->vars($data);//Almacenamos los registros 
        $this->load->view("proveedores/pdf_proveedores");//Cargamos la vista del pdf

    }
//Exportacion PDF DE Sucursal	
    public function exportarSucursales(){
	
        $data["sucursales"] = $this->pdf->getSucursales();//Llamamos a funcion getSucursales
        $this->load->vars($data);//Almacenamos los registros 
        $this->load->view("sucursal/pdf_sucursales");//Cargamos la vista del pdf

    }     
        
}