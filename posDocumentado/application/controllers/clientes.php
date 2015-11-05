<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');date_default_timezone_set('America/Mexico_City');//Clase control de los clientesclass clientes extends CI_Controller {//Constructor de la clase	function __construct(){		parent::__construct();		$this->load->model('seguridad_model');//Llamada al modelo de seguridad		$this->load->model('clientes_model');//Llamada al modelo de clientes	}//Funcion index Muestra carga la vista del modulo clientes	public function index(){          //Utilizacion del helper url          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];          //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion          $this->seguridad_model->SessionActivo($url);          $this->load->view('constant');//llamada a la vista constantes          $this->load->view('view_header');//Llamada ala vista header          //Llamado a la funcion listarClientes del modelo clientes y los almacena en un array          $data['clientes'] = $this->clientes_model->ListarClientes();          //Cargar de la vista clientes          $this->load->view('clientes/view_clientes', $data);          //Lamada a la vista footer          $this->load->view('view_footer');	}//Funcion Editar Cliente Para modificar inf. de los clientes	public function EditarCliente($idCliente,$codigoCliente){        //Utilizacion del helper url		$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];	//Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion                         $this->seguridad_model->SessionActivo($url);        //Parametros		$idCliente 		= base64_decode($idCliente);		$codigoCliente  = base64_decode($codigoCliente);        //Llamado a funcion busca cliente del modelo clientes		$data["cliente"]= $this->clientes_model->BuscaCliente($idCliente);        //Titulo de a vista		$data["titulo"] = "Editar Cliente";        //llamada a la vista constantes		$this->load->view('constant');        //llamada a la vista header		$this->load->view('view_header');        //llamada a la vista nuevo cliente		$this->load->view('clientes/view_nuevo_cliente',$data);        //llamada a la vista footer		$this->load->view('view_footer');	}//Funcion delete cliente para eliminar clientes	public function deletecliente(){        //Utilizacion del helper url		$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];        //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion                $this->seguridad_model->SessionActivo($url);        //Parametros enviados		$Clientes 		= json_decode($this->input->post('MiCliente'));		$id             = base64_decode($Clientes->Id);		$codigo 		= base64_decode($Clientes->Codigo);		/*Array de response para verificacion de campos*/		 $response = array (		    "estatus"   => false,	            "error_msg" => ""	        );                //Llamado a funcion eliminar cliente del modelo cliente		 $this->clientes_model->EliminarCliente($id);		 $response["error_msg"]   = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>Cliente Eliminado Correctamente Codigo: <strong>".$codigo."</strong>, La Información de Actualizara en 5 Segundos <meta http-equiv='refresh' content='5'></div>";		 echo json_encode($response);	}//Funcion nuevo para agregar un cliente nuevo	public function nuevo(){            //Utilizacion del helper url		$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];            //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion                $this->seguridad_model->SessionActivo($url);            //Titulo de la vista		$data["titulo"] = "Nuevo Cliente";		$this->load->view('constant');//Llamado a vista constantes		$this->load->view('view_header');//Llamado a la vista de header		$this->load->view('clientes/view_nuevo_cliente',$data);//Llamado a vista nuevo cliente		$this->load->view('view_footer');//Llamado a vista footer	}//Funcion dir Envio para agregar una direccion de envio	public function DirEnvio($codigoCliente,$idCliente){            //Utilizacion del helper url		$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];            //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion                $this->seguridad_model->SessionActivo($url);            //Parametros enviados		$idCliente 		= base64_decode($idCliente);		$codigoCliente  = base64_decode($codigoCliente);		$data["idCliente"] = $idCliente;		$data["codigoClie"]= $codigoCliente;		$this->load->view('constant');//Llamado a vista constantes		$this->load->view('view_header');//Llamado a vista header		$this->load->view('clientes/view_dir_clientes',$data);//Llamado a vista view_dir_clientes		$this->load->view('view_footer');//Llamado a vista footer	}//Funcion Busca cp para los codigos postales de direcciones	public function BuscaCP(){               //envio de cp		$cp = $this->input->get('cp');                //Llamado a funcion busca cp del modelo clientes		echo json_encode($this->clientes_model->BuscaCP($cp));	}//Funcion guarda direccion para guardar direcciones de envio	public function GuardaDireccion(){            //Utilizacion del helper url		$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];            //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion                $this->seguridad_model->SessionActivo($url);		$Clientes 		= json_decode($this->input->post('ClientesPost'));            //array respose para verificacion de campos		$response = array (				"estatus"   => false,				"campo"     => "",	            "error_msg" => ""	    );            //Verificacion del campo direccion	    if($Clientes->Direccion==""){			$response["campo"]     = "Direccion";			$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>La Dirección es Obligatorio</div>";			echo json_encode($response);                  		}else if($Clientes->nExterior==""){//verificacion del campo nExterior			$response["campo"]     = "nExterior";			$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El nExterior es obligatorio</div>";			echo json_encode($response);		}else if($Clientes->CP==""){//Verificacion del campo CP			$response["campo"]       = "cp";			$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El Codigo Postal es Obligatorio</div>";			echo json_encode($response);		}else if($Clientes->Estado==""){//Verificacion del campo Estado				$response["campo"]       = "estado";				$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El Estado es Obligatorio</div>";				echo json_encode($response);		}else if($Clientes->Municipio==""){//Verificacion del campo Municipio			$response["campo"]       = "municipio";			$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El Campo Municipio es Obligatorio</div>";			echo json_encode($response);		}else if($Clientes->Ciudad==""){//Verificacion del campo Ciudad			$response["campo"]       = "ciudad";			$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El campo Ciudad es Obligatorio</div>";			echo json_encode($response);		}else if($Clientes->Colonia=="0"){//Verificacion del campo Colonia			$response["campo"]       = "colonia";			$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>La Colonia es Obligatorio</div>";			echo json_encode($response);		}else if($Clientes->Telefono==""){//Verificacion del campo Telefono			$response["campo"]       = "telefono";			$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El Telefono Es Obligatorio</div>";			echo json_encode($response);		}else{                    //ArrayReistrarDirEnvio con datos recuperados de los campos			$RegistrarDirEnvio 	= array(					'ID_CLIENTE'        => $Clientes->idcliente,					'DIRECCION'		    => $Clientes->Direccion,					'N_EXTERIOR'		=> $Clientes->nExterior,					'N_INTERIOR'		=> $Clientes->nInterior,					'CP'				=> $Clientes->CP,					'COLONIA'			=> $Clientes->Colonia,					'CIUDAD'			=> $Clientes->Ciudad,					'MUNICIPIO'			=> $Clientes->Municipio,					'ESTADO'			=> $Clientes->Estado,					'TELEFONO'	    	=> $Clientes->Telefono,					'REFERENCIAS'		=> $Clientes->Referencias,					'FECHA_REGISTRO'	=> date('Y-m-j H:i:s')					);                    //Llamado a funcion $RegistrarDirEnvio del modelo clientes			$this->clientes_model->SaveDireccion($RegistrarDirEnvio);			$response["error_msg"]   = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Informacion Guardada Correctamente</div>";			echo json_encode($response);		}	}//Funcion Guarda Clientes para guardar clientes en la BD	public function GuardaClientes(){	error_reporting(0);            //Utilizacion del helper url		$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];             //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion                //$this->seguridad_model->SessionActivo($url);		$Clientes 		= json_decode($this->input->post('ClientesPost'));                //Array response para verificacion de campos		$response = array (				"estatus"   => false,				"campo"     => "",	            "error_msg" => ""	    );            //Verificacion del campo Nombre	    if($Clientes->Nombre==""){			$response["campo"]     = "Nombre";			$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Nombre es Obligatorio</div>";			echo json_encode($response);		}else if($Clientes->Apellidos==""){//Verificacion del campo Apellidos			$response["campo"]     = "apellidos";			$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El Campo Apellido es obligatorio</div>";			echo json_encode($response);		}else if($Clientes->CP==""){//Verificacion del campo CP			$response["campo"]       = "cp";			$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El Codigo Postal es Obligatorio</div>";			echo json_encode($response);		}else if($Clientes->Pais==""){//Verificacion del campo Pais				$response["campo"]       = "pais";				$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El Campo Pais es obligatorio</div>";				echo json_encode($response);		}else if($Clientes->Estado==""){//Verificacion del campo Estado				$response["campo"]       = "estado";				$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El Estado es Obligatorio</div>";				echo json_encode($response);		}else if($Clientes->Municipio==""){//Verificacion del campo Municipio			$response["campo"]       = "municipio";			$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El Campo Municipio es Obligatorio</div>";			echo json_encode($response);		}else if($Clientes->Ciudad==""){//Verificacion del campo Ciudad			$response["campo"]       = "ciudad";			$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El campo Ciudad es Obligatorio</div>";			echo json_encode($response);		}else if($Clientes->Colonia=="0"){//Verificacion del campo Colonia			$response["campo"]       = "colonia";			$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>La Colonia es Obligatorio</div>";			echo json_encode($response);		}else if($Clientes->Calle==""){//Verificacion del campo Calle			$response["campo"]       = "Calle";			$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El Campo Calle Es Obligatorio</div>";			echo json_encode($response);		}else if($Clientes->Email==""){//Verificacion del campo Email			$response["campo"]       = "email";			$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El Correo Es Obligatorio</div>";			echo json_encode($response);		}else if($Clientes->RFC==""){//Verificacion del campo RFC			$response["campo"]       = "rfc";			$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El Campo RFC Es Obligatorio</div>";			echo json_encode($response);		}else if($Clientes->Telefono==""){//Verificacion del campo Telefono			$response["campo"]       = "telefono";			$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El Telefono Es Obligatorio</div>";			echo json_encode($response);		}else{                            //Verificacion de campos rfc y email existentes				if($Clientes->Id==""){                                        //Llamado a funcion ExisteRFC del modelo clientes					$ExisteRFC         = $this->clientes_model->ExisteRFC($Clientes->RFC);                                        //Llamado a funcion ExisteEmail del modelo clientes					$ExisteEmail       = $this->clientes_model->ExisteEmail($Clientes->Email);                                                                                   //Verificacion del campo RFC					if($ExisteRFC==true){						$response["campo"]     = "rfc";						$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El RFC Ya esta en Uso</div>";						echo json_encode($response);					}else if($ExisteEmail==true){//Verificacion del campo Email						$response["campo"]     = "email";						$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Email Ya esta en Uso</div>";						echo json_encode($response);					}else{						//Llamado de funcion ultimo cliente del modelo cliente						$codigoCliente      = $this->clientes_model->UltimoCliente();                                                //Foreach de codigos del cliente						foreach ($codigoCliente as $value) {							$codigoCliente = $value->CODIGO_CLIENTE;						}                                                //Asignacion del codigo del cliente						$codigoCliente =  (int)$codigoCliente;						$codigoCliente = $codigoCliente + 1;						$codigoCliente = str_pad($codigoCliente, 5, '0',STR_PAD_LEFT);                                                 //Array RegistraCliente con datos recuperados de los campos						$RegistraCliente 	= array(						'CODIGO_CLIENTE'    => $codigoCliente,						'NOMBRE'		    => $Clientes->Nombre,						'APELLIDOS'			=> $Clientes->Apellidos,						'CP'				=> $Clientes->CP,						'CALLE'				=> $Clientes->Calle,						'COLONIA'			=> $Clientes->Colonia,						'LOCALIDAD'			=> $Clientes->Ciudad,						'MUNICIPIO'			=> $Clientes->Municipio,						'ESTADO'			=> $Clientes->Estado,						'PAIS'				=> $Clientes->Pais,						'EMAIL'				=> $Clientes->Email,						'RFC'	    		=> $Clientes->RFC,						'TELEFONO'	    	=> $Clientes->Telefono,						'ID_DIR_ENVIO'      => '0',						'FECHA_REGISTRO'	=> date('Y-m-j H:i:s'),						'PASSWORD'          => crypt($Clientes->Password)						);                                                //Llamado a funcion saveCliente del modelo clientes						$this->clientes_model->SaveClientes($RegistraCliente);						$response["estatus"]     = true;						$response["error_msg"]   = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Cliente Nº: ".$codigoCliente."</strong> Informacion Guardada Correctamente</div>";						echo json_encode($response);					}				}                             //ArrayUpdate clientes con datos recuperados de los campos a actualizar				if($Clientes->Id!=""){						$UpdateClientes 	= array(						'NOMBRE'		    => $Clientes->Nombre,						'APELLIDOS'			=> $Clientes->Apellidos,						'CP'				=> $Clientes->CP,						'CALLE'				=> $Clientes->Calle,						'COLONIA'			=> $Clientes->Colonia,						'LOCALIDAD'			=> $Clientes->Ciudad,						'MUNICIPIO'			=> $Clientes->Municipio,						'ESTADO'			=> $Clientes->Estado,						'PAIS'				=> $Clientes->Pais,						'EMAIL'				=> $Clientes->Email,						'RFC'	    		=> $Clientes->RFC,						'TELEFONO'	    	=> $Clientes->Telefono,						'ID_DIR_ENVIO'      => '0',						'FECHA_EDICION'	    => date('Y-m-j H:i:s')						);						$this->clientes_model->UpdateClientes($UpdateClientes,$Clientes->Id);												$response["error_msg"]   = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Informacion Actualizada Correctamente</div>";						echo json_encode($response);				}		}	}}