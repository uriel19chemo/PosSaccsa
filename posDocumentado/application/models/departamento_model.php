<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Clase departamento_model Para realizar ABC de el catalogo  
class departamento_model extends CI_Model {
//Constructor de la clase
	function __construct()

     {

          parent::__construct();

     }
/*
  * Funcion Listar departamento Para consultar todos los departamentos registrados en la base de datos
 */
	public function ListarDepartamento(){

		$sql="SELECT * from departamento order by id asc";

		$query=$this->db->query($sql);

		return $query->result();

	}
/*
  * Funcion Buscar departamento Para buscar los departamentos registrados en la base de datos
 */
	public function BuscaDepartamento($id){

		$sql="SELECT * from departamento where id='".$id."' limit 1";

		$query=$this->db->query($sql);

		return $query->result();

	}
        
/*
  * Funcion Sucursales Para consultar las sucursales registradas en la base de datos
 */
	public function Sucursales(){

		$sql="select * from sucursal";

		$query=$this->db->query($sql);

		return $query->result();

	}        
        
/*
  * Funcion Save departamento Para almacenar el departamento en la base de datos
 */
	public function SaveDepartamento($ArrayDepartamento){

		$this->db->trans_start();

     	$this->db->insert('departamento', $ArrayDepartamento);

     	$this->db->trans_complete();

	}
/*
  * Funcion Update departamento Para actualizar la inf del departamento registrado en la base de datos
 */
	public function UpdateDepartamento($UpdateDepartamento,$id){

		$this->db->trans_start();

		$this->db->where('id', $id);

		$this->db->update('departamento', $UpdateDepartamento); 

		$this->db->trans_complete();

	}
	
	public function EliminarDepartamento($id){

		$this->db->where('id',$id);

		return $this->db->delete('departamento');

	}

}