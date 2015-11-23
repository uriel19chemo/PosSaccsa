<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Clase departamento_model Para realizar ABC de el catalogo  
class sucursal_model extends CI_Model {
//Constructor de la clase
	function __construct()

     {

          parent::__construct();

     }
/*
  * Funcion Listar sucursal Para consultar todos los departamentos registrados en la base de datos
 */
	public function ListarSucursal(){

		$sql="SELECT * from sucursal order by id asc";

		$query=$this->db->query($sql);

		return $query->result();

	}
/*
  * Funcion Buscar sucursal Para buscar los departamentos registrados en la base de datos
 */
	public function BuscaSucursal($id){

		$sql="SELECT * from sucursal where id='".$id."' limit 1";

		$query=$this->db->query($sql);

		return $query->result();

	}
/*
  * Funcion Save sucursal Para almacenar el sucursal en la base de datos
 */
	public function SaveSucursal($ArraySucursal){

		$this->db->trans_start();

     	$this->db->insert('sucursal', $ArraySucursal);

     	$this->db->trans_complete();

	}
/*
  * Funcion Update departamento Para actualizar la inf del departamento registrado en la base de datos
 */
	public function UpdateSucursal($UpdateSucursal,$id){

		$this->db->trans_start();

		$this->db->where('id', $id);

		$this->db->update('sucursal', $UpdateSucursal); 

		$this->db->trans_complete();

	}
	
	public function EliminarSucursal($id){

		$this->db->where('id',$id);

		return $this->db->delete('sucursal');

	}
        /*
  * Funcion BuscaCP Para consultar todos los codigospostales registrados en la base de datos
 */
	public function BuscaCP($cp){

		$sql="SELECT  * from codigospostales where CodigoPostal='".$cp."' limit 1";

		$query=$this->db->query($sql);

		return $query->result();

	}

}