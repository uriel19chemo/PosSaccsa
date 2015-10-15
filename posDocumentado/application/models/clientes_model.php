<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');//Clase Clientes_model Para realizar ABC de el catalogo
class clientes_model extends CI_Model {//Constructor de la clase
	function __construct()
     {
          parent::__construct();
     }/*  * Funcion Listar Clientes Para consultar todos los clientes registrados en la base de datos */
	public function ListarClientes(){
		$sql="SELECT  * from clientes ORDER BY  CODIGO_CLIENTE ASC ";
		$query=$this->db->query($sql);
		return $query->result();
	}/*  * Funcion UltimoCliente Para consultar al ultimo cliente en la base de datos */
	public function UltimoCliente()
	{
		$sql = "SELECT CODIGO_CLIENTE FROM clientes ORDER BY CODIGO_CLIENTE DESC limit 1";
		$query=$this->db->query($sql);
		return $query->result();
	}/*  * Funcion BuscaCP Para consultar todos los codigospostales registrados en la base de datos */
	public function BuscaCP($cp){
		$sql="SELECT  * from codigospostales where CodigoPostal='".$cp."' limit 1";
		$query=$this->db->query($sql);
		return $query->result();
	}/*  * Funcion BuscaCliente Para consultar al cliente registrado en la base de datos */
	public function BuscaCliente($id){
		$sql="SELECT  * from clientes where ID='".$id."' limit 1";
		echo $sql;
		$query=$this->db->query($sql);
		return $query->result();
	}/*  * Funcion EliminarCliente Para eliminar un cliente registrado en la base de datos */
	public function EliminarCliente($id)
	{
		# code...
		$this->db->where('ID',$id);
		return $this->db->delete('clientes');
	}/*  * Funcion ExisteEmail Para consultar todos los emails registrados en la base de datos */
	public function ExisteEmail($email){
		$this->db->where("EMAIL",$email);
        $check_exists = $this->db->get("clientes");
        if($check_exists->num_rows() == 0){
            return false;
        }else{
            return true;
        }
	}/*  * Funcion ExisteRFC Para consultar todos los rfc registradas en la base de datos */
	public function ExisteRFC($rfc){
		$this->db->where("RFC",$rfc);
        $check_exists = $this->db->get("clientes");
        if($check_exists->num_rows() == 0){
            return false;
        }else{
            return true;
        }
	}/*  * Funcion SaveClientes Para guardar inf de los clientes registrados en la base de datos */
	public function SaveClientes($arrayClientes){
		$this->db->trans_start();
     	$this->db->insert('clientes', $arrayClientes);
     	$this->db->trans_complete();
	}/*  * Funcion UpdateClientes Para actualizar la inf de los clientes registrados en la base de datos */
	public function UpdateClientes($arrayClientes,$id){
		$this->db->trans_start();
		$this->db->where('ID', $id);
		$this->db->update('clientes', $arrayClientes); 
		$this->db->trans_complete();
	}/*  * Funcion SaveDireccion Para almacenar la direccion de envio en la base de datos */
	public function SaveDireccion($arrayDir){
		$this->db->trans_start();
     	$this->db->insert('direcciones_envio', $arrayDir);
     	$this->db->trans_complete();
	}
}