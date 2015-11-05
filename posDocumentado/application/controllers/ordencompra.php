<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');date_default_timezone_set('America/Mexico_City');//Clase control de las ordenes de compraclass ordencompra extends CI_Controller {//Constructor de la clase 	function __construct(){		parent::__construct();		$this->load->model('seguridad_model');//Llamada al modelo de seguridad		$this->load->model('ordencompra_model');//Llamada al modelo de ordencompra	}//Funcion index Muestra y carga la vista del modulo ordencompra	public function index(){          //Utilizacion del helper url          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];          //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion          $this->seguridad_model->SessionActivo($url);          $this->load->view('constant');//llamada a la vista constantes          $this->load->view('view_header');//Llamada ala vista header          //Cargar de la vista orden_compra          $this->load->view('ordencompra/orden_compra');          //Lamada a la vista footer          $this->load->view('view_footer');          	}//Funcion buscaProductos para buscar los productos	public function buscarproductos(){                //Variable para filtro de productos		$filtro    = $this->input->get("term");                 //Llamado a funcion listar producto del modelo ordencompra		$productos = $this->ordencompra_model->listarproducto($filtro);		echo json_encode($productos);	}//Funcion addcarrito para agregar productos al carrito de compras	public function addcarrito(){                //	    session_start();           //Utilizacion del helper url	    $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];            //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion            $this->seguridad_model->SessionActivo($url);            //Variable CarritoOrdenCompra Para almacenar productos	    $CarritoOrdenCompra   = json_decode($this->input->post('MiCarrito'));               //If para verificacion de sesion en arreglo de carrito orden compra		if(isset($_SESSION['CarritoOrdencompra'.$CarritoOrdenCompra->IdSession])){				$carrito_orderventa=$_SESSION['CarritoOrdencompra'.$CarritoOrdenCompra->IdSession];                                //If para verificacion de codigo y almacenamiento de productos				if(isset($CarritoOrdenCompra->Codigo)){					$txtCodigo = $CarritoOrdenCompra->Codigo;					$precio    = $CarritoOrdenCompra->Pcompra;					$cantidad  = $CarritoOrdenCompra->Cantidad;					$descripcio= $CarritoOrdenCompra->Descripcion;					$Proveedor = $CarritoOrdenCompra->Proveedor;					$Costo     = $CarritoOrdenCompra->Costo;					$donde     = -1;                                        //Recorrido de productos 					for($i=0;$i<=count($carrito_orderventa)-1;$i ++){                                        					if($txtCodigo==$carrito_orderventa[$i]['txtCodigo']){						$donde=$i;					}					}                                    					if($donde != -1){						$cuanto=$carrito_orderventa[$donde]['cantidad'] + $cantidad;						$carrito_orderventa[$donde]=array("txtCodigo"=>$txtCodigo,"precio"=>$precio,"cantidad"=>$cuanto,"descripcion"=>$descripcio,"proveedor"=>$Proveedor,"costo"=>$Costo);					}else{						$carrito_orderventa[]=array("txtCodigo"=>$txtCodigo,"precio"=>$precio,"cantidad"=>$cantidad,"descripcion"=>$descripcio,"proveedor"=>$Proveedor,"costo"=>$Costo);											}				}		}else{//If para verificacion de sesion en arreglo de carrito orden venta				$txtCodigo = $CarritoOrdenCompra->Codigo;				$precio    = $CarritoOrdenCompra->Pcompra;				$cantidad  = $CarritoOrdenCompra->Cantidad;				$descripcio= $CarritoOrdenCompra->Descripcion;				$Proveedor = $CarritoOrdenCompra->Proveedor;				$Costo     = $CarritoOrdenCompra->Costo;				$carrito_orderventa[]=array("txtCodigo"=>$txtCodigo,"precio"=>$precio,"cantidad"=>$cantidad,"descripcion"=>$descripcio,"proveedor"=>$Proveedor,"costo"=>$Costo);			}		$_SESSION['CarritoOrdencompra'.$CarritoOrdenCompra->IdSession]=$carrito_orderventa;		echo json_encode($_SESSION['CarritoOrdencompra'.$CarritoOrdenCompra->IdSession]);	}//Funcion save order  para almacenar los documentos de las compras	public function saveOrder(){               //Inicio de sesion		session_start();                //Utilizacion del helper url		$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];                //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion                $this->seguridad_model->SessionActivo($url);                //Arreglo para msg de error		$arrayResponse = array("NumOrden"=>"0","Msg"=>"Error: Ocurrio Un Error Intente de Nuevo", "TipoMsg"=>"Error");                 		$OrderCompra   = json_decode($this->input->post('MiCarrito'));              		$RecuperaOrder = $_SESSION["CarritoOrdencompra".$OrderCompra->IdSession];                //Variable impuesto para asignar el impuesto designado a la compra		$impuesto      = 16;                //Array documento para almacenar las compras de productos		$arrayDocumento= array(				"TIPO"				=>"Entrada", 				"FECHA"				=>date('Y-m-j H:i:s'),				"BASEIMPUESTO"		=>$impuesto,				"TOTAL_IMPUESTO"	=>$OrderCompra->IVA,				"BRUTO"				=>$OrderCompra->Subtotal,				"TOTAL"				=>$OrderCompra->Total,				"USUARIO"			=>$this->session->userdata('ID')				);                //Llamado a funcion saveorderDocumento del modelo ordencompra_model		$saveOrderDocument = $this->ordencompra_model->saveOrderDocumento($arrayDocumento);               //if de verificacion orderDocumento		if($saveOrderDocument!=0){                        //foreach para volcar las ordenes			foreach ($RecuperaOrder as $key => $value) {                               //ArrayPartidas para almacenar los datos de la partida				$arrayPartidas = array(					"ID_LINK"			=> $saveOrderDocument,					"TIPO"				=> "Entrada",					"FECHA"				=> date('Y-m-j H:i:s'),					"PROVEEDOR"			=> $value["proveedor"],					"CLAVE"				=> $value["txtCodigo"],					"COSTO"				=> $value["costo"],					"PRECIO"			=> $value["precio"],					"DESCRIPCION"		=> $value["descripcion"],					"ENTRADAS"			=> $value["cantidad"]					);				                                //Llamado a funcion saveorderPartidas del modelo ordencompra				$this->ordencompra_model->saveOrderPartidas($arrayPartidas);                                //Llamado a funcion UpdateExistenciasProducto del modelo ordencompra				$this->ordencompra_model->UpdateExistenciasProducto($value["txtCodigo"],$value["cantidad"]);			}                        //Array para msg de error			$arrayResponse = array("NumOrden"=>$saveOrderDocument,"Msg"=>"<strong>Folio: ".$saveOrderDocument."</strong>, La Orden de Compra se Guardado Correctamente", "TipoMsg"=>"Sucefull");		}		echo json_encode($arrayResponse);	}}