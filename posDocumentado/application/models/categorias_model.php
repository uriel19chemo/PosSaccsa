<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Clase Categorias_model Para realizar ABC de el catalogo
class categorias_model extends CI_Model {
//Constructor de la clase
	function __construct()

     {

          parent::__construct();

     }
 /*
  * Funcion Listar Categorias Para consultar todas las categorias registradas en la base de datos
 */
     public function ListarCategorias(){

		$sql="SELECT  * from categorias ORDER BY  descripcion ASC ";
		$query=$this->db->query($sql);
		return $query->result();
	}
/*
  * Funcion Listar SubCategorias Para consultar todas las Subcategorias registradas en la base de datos
 */
	public function ListarSubCategorias(){

		$sql="SELECT  * from subcategoria ORDER BY  descripcion ASC ";

		$query=$this->db->query($sql);

		return $query->result();

	}
/*
  * Funcion Eliminar Categorias Para eliminar las categorias registradas en la base de datos
 */
	public function EliminarCategoria($id){

		$this->db->where('id',$id);

		return $this->db->delete('categorias');

	}
/*
  * Funcion Eliminar SubCategorias Para eliminar las Subcategorias registradas en la base de datos
 */
	public function EliminarSubcategorias($id){

		$this->db->where('id_categoria',$id);

		return $this->db->delete('subcategoria');

	}
/*
  * Funcion Eliminar SubCategoria Para eliminar la Subcategoria registrada en la base de datos
 */
	public function EliminaSubcategoria($id){

		$this->db->where('id',$id);

		return $this->db->delete('subcategoria');

	}
/*
  * Funcion Buscar Categorias Para consultar las categorias registradas en la base de datos
 */
	public function BuscaCategorias($id){

		$sql="SELECT  * from categorias where id='".$id."' limit 1";

		$query=$this->db->query($sql);

		return $query->result();

	}
/*
  * Funcion Buscar SubCategorias Para consultar las Subcategorias registradas en la base de datos
 */
	public function BuscaSubCategorias($id){

		$sql="SELECT  * from subcategoria where id_categoria='".$id."'";

		$query=$this->db->query($sql);

		return $query->result();

	}
/*
  * Funcion Buscar Categoria Para consultar la categoria registrada en la base de datos
 */
	public function BuscaSubCategoriaOne($id){

		$sql="SELECT  * from subcategoria where id='".$id."' limit 1";

		$query=$this->db->query($sql);

		return $query->result();

	}
        
/*
  * Funcion Departamentos Para consultar las departamentos registradas en la base de datos
 */
	public function Departamentos(){

		$sql="select * from departamento";

		$query=$this->db->query($sql);

		return $query->result();

	}
        
/*
  * Funcion Save Categoria Para almacenar la categoria  en la base de datos
 */
	public function SaveCategoria($array){

		$this->db->trans_start();

     	$this->db->insert('categorias', $array);

     	$this->db->trans_complete();

	}
/*
  * Funcion Update Categoria Para actualizar la categoria registrada en la base de datos
 */
	public function UpdateCategoria($array,$id){

		$this->db->trans_start();

		$this->db->where('id', $id);

		$this->db->update('categorias', $array); 

		$this->db->trans_complete();

	}
/*
  * Funcion Save SubCategoria Para almacenar la Subcategoria en la base de datos
 */
	public function SaveSubCategoria($array){

		$this->db->trans_start();

     	$this->db->insert('subcategoria', $array);

     	$this->db->trans_complete();

	}
/*
  * Funcion Update SubCategoria Para actualizar la Subcategoria registrada en la base de datos
 */
	public function UpdateSubCategoria($array,$id){

		$this->db->trans_start();

		$this->db->where('id', $id);

		$this->db->update('subcategoria', $array); 

		$this->db->trans_complete();

	}

	 

}