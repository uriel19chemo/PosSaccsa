<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Clase departamento_model Para realizar ABC de el catalogo  
class pedidos_model extends CI_Model {
//Constructor de la clase
	function __construct()

     {

          parent::__construct();

     }
/*
  * Funcion Listar departamento Para consultar todos los departamentos registrados en la base de datos
 */
	public function ListarPedidos(){

		$sql="SELECT * from documentos order by id asc";

		$query=$this->db->query($sql);

		return $query->result();

	}
/*
  * Funcion Buscar departamento Para buscar los departamentos registrados en la base de datos
 */
	public function BuscaPedido($id){

		$sql="SELECT * from documentos where id='".$id."' limit 1";

		$query=$this->db->query($sql);

		return $query->result();

	}
/*
  * Funcion Save departamento Para almacenar el departamento en la base de datos
 */
	public function SavePedido($ArrayPedido){

		$this->db->trans_start();

     	$this->db->insert('documentos', $ArrayPedido);

     	$this->db->trans_complete();

	}
/*
  * Funcion Update departamento Para actualizar la inf del departamento registrado en la base de datos
 */
	public function UpdatePedido($UpdatePedido,$id){

		$this->db->trans_start();

		$this->db->where('id', $id);

		$this->db->update('documentos', $UpdatePedido); 

		$this->db->trans_complete();

	}
	
	public function EliminarPedido($id){

		$this->db->where('id',$id);

		return $this->db->delete('documentos');

	}

}