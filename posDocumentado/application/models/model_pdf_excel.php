<?php

class Model_pdf_excel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
//Consulta de usuarios para pdf
    public function getUsuarios() {       	   
        
        $this->db->select('*');
        $q = $this->db->get('usuarios');
        return $q->result();
        $q->free_result();
    }
//Consulta de usuarios para excel
    public function getUsuariosE(){
        
        $fields = $this->db->field_data('usuarios');
	$query = $this->db->select('*')->get('usuarios');
	return array("fields" => $fields, "query" => $query);
    }

}

?>
