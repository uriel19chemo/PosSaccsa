<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Clase ecomerce_model para generar vista principal
class ecomerce_model extends CI_Model {
//Constructor de la clase
	function __construct()

     {
          parent::__construct();
     }
/*
  * Funcion Para contar los productos 
*/
     public function CountProductos(){
     	 return $this->db->count_all_results('productos');
     }
/*
  * Funcion Para listar los pedidos de productos de los clientes mediante su id
*/     
	 public function MisPedidos($cliente){
		 $sql="select * from documentos where CLIENTE='".$cliente."' and TIPO='Pedido' ORDER BY fecha DESC";
		$query=$this->db->query($sql);
		return $query->result();
	 }
/*
  * Funcion Para listar los productos 
*/
     public function ListProductos($limit, $offset){
		 	$this->db->limit($limit, $offset);
	      	$query = $this->db->get('productos');
	      	return $query->result();
     }
/*
  * Funcion Para cargar el listado de productos nuevos
*/ 
     public function ProductosNew(){

		$sql="select * from productos ORDER BY fecha DESC limit 9";
		$query=$this->db->query($sql);
		return $query->result();
	}
/*
  * Funcion Para cargar todas las imagenes desde la base de datos de cada producto
*/
	public function TraeImagenes(){
		$sql="select * from img_productos  GROUP BY ID_PRODUCTO ORDER BY RAND() ";
		$query=$this->db->query($sql);
		return $query->result();
	}
/*
  * Funcion Para definir un limite en la volcada de categorias al Menu de productos
*/
	public function TraeCategoriaLimit(){
		$sql="select * from categorias ORDER BY RAND() limit 7";
		$query=$this->db->query($sql);
		return $query->result();
	}
/*
  * Funcion Para listar todos los productos al menu productos por categorias

*/	
	public function Productos(){
		$sql="select * from productos ORDER BY RAND()";
		$query=$this->db->query($sql);
		return $query->result();
	}
/*
  * Funcion Para listar los productos al carousel de productos recomendados
*/
	public function CarruselProductos(){
		$sql="select * from productos ORDER BY RAND() limit 9";
		$query=$this->db->query($sql);
		return $query->result();
	}
/*
  * Funcion Para la busqueda de productos 
*/
	public function BuscaProducto($id){
		//$sql="select * from productos where id='".$id."'";
		$sql = "select p.precio_compra, p.id,p.codigo,p.descripcion,p.precio_venta,p.cantidad,c.descripcion as familia, sc.descripcion as subfamilia  from productos as p inner join categorias as c on p.id_categoria=c.id inner join subcategoria as sc on p.id_subcategoria=sc.id where p.id='".$id."'";
		$query=$this->db->query($sql);
		return $query->result();
	}
/*
  * Funcion Para listar los detalles de los productos seleccionados
*/	
	public function TraeImagenDetalle($id){
		$sql="select * from img_productos where ID_PRODUCTO='".$id."' ORDER BY RAND() limit 1 ";
		$query=$this->db->query($sql);
		return $query->result();
	}
        

}