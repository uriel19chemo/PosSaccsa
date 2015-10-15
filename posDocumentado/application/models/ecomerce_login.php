<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Clase ecomerce_login Para realizar el logueo
class ecomerce_login extends CI_Model {
//Constructor de la clase
	function __construct()

     {
          parent::__construct();
     }
/*
  * Funcion LoginBD Clientes Para consultar todos los clientes registrados en la base de datos
 */	 
	 function LoginBD($username)
     {
          $this->db->where('EMAIL', $username);
          return $this->db->get('clientes')->row();
     }
/*
  * Funcion DatosCliente Para consultar todos los datos de los clientes registrados en la base de datos
 */
	 public function DatosCliente($id){
		 $this->db->where('ID', $id);
          return $this->db->get('clientes')->row();
	 }
	 
}