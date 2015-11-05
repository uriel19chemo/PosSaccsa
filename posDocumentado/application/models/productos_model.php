<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');//Clase productos_model Para realizar ABC de el catalogo  class productos_model extends CI_Model {//Constructor de la clase	function __construct()     {          parent::__construct();     }/*  * Funcion Listar Productos Para consultar todos los productos registrados en la base de datos */	public function ListarProductos(){		$sql="SELECT P.id, P.codigo, P.descripcion, P.precio_compra, P.precio_venta, P.cantidad, C.descripcion AS DesCategoria, Pro.nombre_proveedor FROM productos AS P INNER JOIN categorias AS C ON P.id_categoria = C.id INNER JOIN proveedores AS Pro ON P.id_proveedor = Pro.id order by P.descripcion asc";		$query=$this->db->query($sql);		return $query->result();	}/*  * Funcion GuardaImg Para almacenar imagen de producto registrado en la base de datos */		public function GuardaImg($arrays){		$this->db->trans_start();     	$this->db->insert('img_productos', $arrays);     	$this->db->trans_complete();	}/*  * Funcion Buscar Producto Para buscar los productos registrados en la base de datos */	public function BuscarProducto($id){		$sql="SELECT * FROM productos  where id='".$id."'";		$query=$this->db->query($sql);		return $query->result();	}/*  * Funcion Eliminar Producto Para eliminar el producto registrado en la base de datos */	public function EliminarProducto($id)	{		# code...		$this->db->where('id',$id);		return $this->db->delete('productos');	}/*  * Funcion Categoria Para consultar las categorias registradas en la base de datos */	public function Categorias(){		$sql="select * from categorias";		$query=$this->db->query($sql);		return $query->result();	}/*  * Funcion SubCategoria Para consultar las subcategorias registradas en la base de datos */	public function Subcategorias($id){		$sql="select * from subcategoria where id_categoria='".$id."'";		$query=$this->db->query($sql);		return $query->result();	}/*  * Funcion Proveedores Para consultar los proveedores registradas en la base de datos */	public function Proveedores(){		$sql="SELECT  * FROM proveedores where estatus=1";		$query=$this->db->query($sql);		return $query->result();	}/*  * Funcion ExisteCodigo Para consultar los codigos registrados en la base de datos */	public function ExisteCodigo($codigo){		$this->db->where("codigo",$codigo);        $check_exists = $this->db->get("productos");        if($check_exists->num_rows() == 0){            return false;        }else{            return true;        }	}/*  * Funcion Save producto Para almacenar el producto en la base de datos */	public function SaveProductos($arrayProductos){		$this->db->trans_start();     	$this->db->insert('productos', $arrayProductos);     	$this->db->trans_complete();	}/*  * Funcion Update producto Para actualizar la inf del producto registrado en la base de datos */	public function UpdateProductos($arrayProductos, $id){		$this->db->trans_start();		$this->db->where('id', $id);		$this->db->update('productos', $arrayProductos); 		$this->db->trans_complete();	}/*  * Funcion productoMinimo Para listar la informacion del producto registrado en la base de datos con stock minimo */             public function getProductosMinimo(){        $sql = "SELECT * FROM productos WHERE cantidad <= stock LIMIT 10";         return $this->db->query($sql)->result();    } /*  * Funcion PedidosAbiertos Para listar la informacion de los pedidos registrados en la base de datos con estatus pendiente */         function getPedidosAbiertos(){        $this->db->select('documentos.*, clientes.NOMBRE');        $this->db->from('documentos');        $this->db->join('clientes', 'clientes.ID = documentos.CLIENTE');        $this->db->where('documentos.ESTATUS','Pendiente');        $this->db->limit(10);        return $this->db->get()->result();    } /*  * Funcion Estadisticas Para listar la informacion de las estadisticas de los pedidos entregados y pendientes  */         function getEstatisticas(){        $sql = "SELECT ESTATUS, COUNT(ESTATUS) as total FROM documentos GROUP BY ESTATUS ORDER BY ESTATUS";        return $this->db->query($sql)->result();    }        }