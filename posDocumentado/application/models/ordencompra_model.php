<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');//Clase ordencompra_model para acceso a compras 
class ordencompra_model extends CI_Model {//Constructor de la clase
	function __construct()
     {
          parent::__construct();
     }/*  * Funcion listarproducto para buscar productos*/
	public function listarproducto($filtro){
		$sql="SELECT concat(p.codigo,' - ', p.descripcion) AS label, p.codigo, p.descripcion, p.precio_compra,p.precio_venta, p.cantidad, pro.nombre_proveedor, pro.id FROM productos AS p INNER JOIN proveedores AS pro ON pro.id = p.id_proveedor WHERE (p.descripcion LIKE  '%".$filtro."%' or p.codigo LIKE '%".$filtro."%')";
		$query=$this->db->query($sql);
		return $query->result();
	}/*  * Funcion saveOrderDocumento para almacenar el dodumento de venta*/
	public function saveOrderDocumento($arrarOrder){
		$this->db->trans_start();
     	$this->db->insert('documentos', $arrarOrder);
     	$ids = $this->db->insert_id();
     	$this->db->trans_complete();
     	return $ids;
	}/*  * Funcion saveOrderPartidas para almacenar las partidas de pedidos*/
	public function saveOrderPartidas($arrarOrder){
		$this->db->trans_start();
     	$this->db->insert('partidas', $arrarOrder);
     	$this->db->trans_complete();
	}/*  * Funcion UpdateExistenciasProducto para actulizar la cantidad del producto*/
	public function UpdateExistenciasProducto($codigo,$cantidad){
		$sql="update productos set cantidad= cantidad + '".$cantidad."' where codigo='".$codigo."'";
		$query=$this->db->query($sql);
		return True;
	}
	
}