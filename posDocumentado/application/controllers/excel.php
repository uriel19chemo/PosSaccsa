<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 //Clase control excel para generar reportes
class Excel extends CI_Controller {
 //constructor de la clase
	public function __construct(){
	    
            parent::__construct();
	    $this->load->helper('mysql_to_excel_helper');//Cargamos el helper mysql_to_excel_helper
	
        }
 //Funcion index 
        public function index(){
	 
        }
 //Funcion exportarUsuariosE para cargar en modelo del reporte
	public function exportarUsuariosE(){
		$this->load->model('model_pdf_excel');//Cargamos el modelo pdf excel
		to_excel($this->model_pdf_excel->getUsuariosE(), "excel_usuarios");//Llamamos a funcion getUsuariosE para listar usuarios
	}
//Funcion exportarCategoriasE para cargar en modelo del reporte
	public function exportarCategoriasE(){
		$this->load->model('model_pdf_excel');//Cargamos el modelo pdf excel
		to_excel($this->model_pdf_excel->getCategoriasE(), "excel_categorias");//Llamamos a funcion getCategoriasE para listar categorias
	}
//Funcion exportarSubCategoriasE para cargar en modelo del reporte
	public function exportarSubCategoriasE(){
		$this->load->model('model_pdf_excel');//Cargamos el modelo pdf excel
		to_excel($this->model_pdf_excel->getSubCategoriasE(), "excel_subcategorias");//Llamamos a funcion getSubCategoriasE para listar Subcategorias
	}        
//Funcion exportarClientesE para cargar en modelo del reporte
	public function exportarClientesE(){
		$this->load->model('model_pdf_excel');//Cargamos el modelo pdf excel
		to_excel($this->model_pdf_excel->getClientesE(), "excel_clientes");//Llamamos a funcion getClientesE para listar clientes
	}
//Funcion exportarDepartamentosE para cargar en modelo del reporte
	public function exportarDepartamentosE(){
		$this->load->model('model_pdf_excel');//Cargamos el modelo pdf excel
		to_excel($this->model_pdf_excel->getDepartamentosE(), "excel_departamentos");//Llamamos a funcion getDepartamentosE para listar departamentos
	}
//Funcion exportarProductosE para cargar en modelo del reporte
	public function exportarProductosE(){
		$this->load->model('model_pdf_excel');//Cargamos el modelo pdf excel
		to_excel($this->model_pdf_excel->getProductosE(), "excel_productos");//Llamamos a funcion getProductosE para listar productos
	}
//Funcion exportarProveedoresE para cargar en modelo del reporte
	public function exportarProveedoresE(){
		$this->load->model('model_pdf_excel');//Cargamos el modelo pdf excel
		to_excel($this->model_pdf_excel->getProveedoresE(), "excel_proveedores");//Llamamos a funcion getProveedoresE para listar proveedores
	}
//Funcion exportarSucursalesE para cargar en modelo del reporte
	public function exportarSucursalesE(){
		$this->load->model('model_pdf_excel');//Cargamos el modelo pdf excel
		to_excel($this->model_pdf_excel->getSucursalesE(), "excel_sucursales");//Llamamos a funcion getSucursalesE para listar sucursales
	}          
 
}
/* End of file home.php */
/* Location: ./application/controllers/excel.php */