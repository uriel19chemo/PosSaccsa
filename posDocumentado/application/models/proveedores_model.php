<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');//Clase proveedores_model Para realizar ABC de el catalogo  
class proveedores_model extends CI_Model {//Constructor de la clase
	function __construct()
     {
          parent::__construct();
     }/*  * Funcion Listar proveedores Para consultar todos los proveedores registrados en la base de datos */
	public function ListarProveedores(){
		$sql="SELECT * from proveedores order by nombre_proveedor asc";
		$query=$this->db->query($sql);
		return $query->result();
	}/*  * Funcion Buscar proveedores Para buscar los proveedores registrados en la base de datos */
	public function BuscaProveedores($id){
		$sql="SELECT * from proveedores where id='".$id."' limit 1";
		$query=$this->db->query($sql);
		return $query->result();
	}/*  * Funcion Save proveedores Para almacenar el proveedor en la base de datos */
	public function SaveProveedores($RegistraProveedor){
		$this->db->trans_start();
     	$this->db->insert('proveedores', $RegistraProveedor);
     	$this->db->trans_complete();
	}/*  * Funcion Update proveedores Para actualizar la inf del proveedor registrado en la base de datos */
	public function UpdateProveedores($UpdateProveedor,$id){
		$this->db->trans_start();
		$this->db->where('id', $id);
		$this->db->update('proveedores', $UpdateProveedor); 
		$this->db->trans_complete();
	}
}