<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Excel extends CI_Controller {
 
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('mysql_to_excel_helper');//Cargamos el helper
	}
 
	public function index()
	{
		$this->load->model('model_pdf_excel');//Cargamos el modelo pdf excel
		to_excel($this->model_pdf_excel->getUsuariosE(), "excel_usuarios");//Llamamos a funcion getUsuariosE para listar usuarios
	}
 
}
/* End of file home.php */
/* Location: ./application/controllers/home.php */