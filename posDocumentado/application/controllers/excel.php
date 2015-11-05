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
 
}
/* End of file home.php */
/* Location: ./application/controllers/excel.php */