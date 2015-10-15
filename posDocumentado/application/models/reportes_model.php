<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');//Clase reportes_model Para realizar reportes de de compras o ventas  
class reportes_model extends CI_Model {//Constructor de la clase
	function __construct()
     {
          parent::__construct();
     }/*  * Funcion Buscar clientes Para consultar los clientes registrados en la base de datos */
     public function buscarcliente($filtro){
		$sql="SELECT concat(CODIGO_CLIENTE,' - ', NOMBRE, ' ', APELLIDOS) AS label, CODIGO_CLIENTE, NOMBRE, APELLIDOS FROM clientes   WHERE (CODIGO_CLIENTE LIKE  '%".$filtro."%' or NOMBRE LIKE '%".$filtro."%')";
		$query=$this->db->query($sql);
		return $query->result();
	}/*  * Funcion UpdateExistenciasProducto Para actualizar las existencias de los producto registrados en la base de datos */
	public function UpdateExistenciasProducto($codigo,$cantidad){
		$sql="update productos set cantidad= cantidad - '".$cantidad."' where codigo='".$codigo."'";
		$query=$this->db->query($sql);
		return True;
	}/*  * Funcion reportesGenera Para consultar y generar reportes mediante un rango de fecha de las ventas o compras registradas en la base de datos */
	public function reportesGenera($FInicial, $FFinal, $Documento){
		$sql="SELECT * FROM documentos   WHERE FECHA between '".$FInicial."' AND '".$FFinal."' AND TIPO='".$Documento."'";
		//echo $sql;
		$query=$this->db->query($sql);
		return $query->result();
	}

}