<?php

class Pdf extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
        $this->load->model('model_pdf_excel', 'pdf');//Cargamos modelo pdf excel
    }
	
//Exportacion PDF DE USUARIOS	
	public function exportarUsuarios(){
	
        $data["usuarios"] = $this->pdf->getUsuarios();//Llamamos a funcion getUsuarios
        $this->load->vars($data);//Almacenamos los registros 
        $this->load->view("pdf_usuarios");//Cargamos la vista del pdf
	}
}