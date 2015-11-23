<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Clase model_pdf_excel para llenado de reportes 
class Model_pdf_excel extends CI_Model {
//constructor de la clase model_pdf_excel
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
//Consulta de categorias para pdf
    public function getCategorias() {       	   
        
        $this->db->select('*');
        $q = $this->db->get('categorias');
        return $q->result();
        $q->free_result();
    }
//Consulta de categorias para excel
    public function getCategoriasE(){
        
        $fields = $this->db->field_data('categorias');
	$query = $this->db->select('*')->get('categorias');
	return array("fields" => $fields, "query" => $query);
    }
//Consulta de subcategorias para pdf
    public function getSubCategorias() {       	   
        
        $this->db->select('*');
        $q = $this->db->get('subcategoria');
        return $q->result();
        $q->free_result();
    }
//Consulta de subcategorias para excel
    public function getSubCategoriasE(){
        
        $fields = $this->db->field_data('subcategoria');
	$query = $this->db->select('*')->get('subcategoria');
	return array("fields" => $fields, "query" => $query);
    }
//Consulta de clientes para pdf
    public function getClientes() {       	   
        
        $this->db->select('*');
        $q = $this->db->get('clientes');
        return $q->result();
        $q->free_result();
    }
//Consulta de clientes para excel
    public function getClientesE(){
        
        $fields = $this->db->field_data('clientes');
	$query = $this->db->select('*')->get('clientes');
	return array("fields" => $fields, "query" => $query);
    }
//Consulta de Departamento para pdf
    public function getDepartamentos() {       	   
        
        $this->db->select('*');
        $q = $this->db->get('departamento');
        return $q->result();
        $q->free_result();
    }
//Consulta de Departamento para excel
    public function getDepartamentosE(){
        
        $fields = $this->db->field_data('departamento');
	$query = $this->db->select('*')->get('departamento');
	return array("fields" => $fields, "query" => $query);
    }
//Consulta de Productos para pdf
    public function getProductos() {       	   
        
        $this->db->select('*');
        $q = $this->db->get('productos');
        return $q->result();
        $q->free_result();
    }
//Consulta de Productos para excel
    public function getProductosE(){
        
        $fields = $this->db->field_data('productos');
	$query = $this->db->select('*')->get('productos');
	return array("fields" => $fields, "query" => $query);
    }
//Consulta de Proveedores para pdf
    public function getProveedores() {       	   
        
        $this->db->select('*');
        $q = $this->db->get('proveedores');
        return $q->result();
        $q->free_result();
    }
//Consulta de Proveedores para excel
    public function getProveedoresE(){
        
        $fields = $this->db->field_data('proveedores');
	$query = $this->db->select('*')->get('proveedores');
	return array("fields" => $fields, "query" => $query);
    } 
//Consulta de Sucursales para pdf
    public function getSucursales() {       	   
        
        $this->db->select('*');
        $q = $this->db->get('sucursal');
        return $q->result();
        $q->free_result();
    }
//Consulta de Sucursales para excel
    public function getSucursalesE(){
        
        $fields = $this->db->field_data('sucursal');
	$query = $this->db->select('*')->get('sucursal');
	return array("fields" => $fields, "query" => $query);
    }    
  

}

?>
