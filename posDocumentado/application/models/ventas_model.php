<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');//Clase ventas_model Para realizar Ventas   
class ventas_model extends CI_Model {//Constructor de la clase
	function __construct()
     {
          parent::__construct();
     }/*  * Funcion Buscar cliente Para buscar inf del cliente registrado en la base de datos */
     public function buscarcliente($filtro){
		$sql="SELECT concat(CODIGO_CLIENTE,' - ', NOMBRE, ' ', APELLIDOS) AS label, CODIGO_CLIENTE, NOMBRE, APELLIDOS FROM clientes   WHERE (CODIGO_CLIENTE LIKE  '%".$filtro."%' or NOMBRE LIKE '%".$filtro."%')";
		$query=$this->db->query($sql);
		return $query->result();
	}/*  * Funcion UpdateExistenciasProducto Para modificar las existencias de los productos registrados en la base de datos */
	public function UpdateExistenciasProducto($codigo,$cantidad){
		$sql="update productos set cantidad= cantidad - '".$cantidad."' where codigo='".$codigo."'";
		$query=$this->db->query($sql);
		return True;
	}/*  * Funcion TraeVenta Para buscar los pedidos o ventas registrados en la base de datos */
	public function TraeVenta($order){
		$sql="SELECT * FROM partidas   WHERE ID_LINK = '".$order."'";
		$query=$this->db->query($sql);
		return $query->result();
	}/*  * Funcion TraeDoc Para buscar los pedidos o ventas registrados en la base de datos */
	public function TraeDoc($order){
		$sql="SELECT * FROM documentos   WHERE ID = '".$order."'";
		$query=$this->db->query($sql);
		return $query->result();
	}

}