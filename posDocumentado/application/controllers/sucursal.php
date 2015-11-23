<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('America/Mexico_City');

class sucursal extends CI_Controller {

	function __construct(){

		parent::__construct();

		$this->load->model('seguridad_model');

		$this->load->model('sucursal_model');

	}

	public function index(){

          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

          $this->seguridad_model->SessionActivo($url);

          /**/

          $this->load->view('constant');

          $this->load->view('view_header');

          $data['sucursal'] = $this->sucursal_model->ListarSucursal();

          $this->load->view('sucursal/view_sucursal', $data);

          $this->load->view('view_footer');

          

	}

     public function nuevo(){

          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

          $this->seguridad_model->SessionActivo($url);

          $this->load->view('constant');

          $this->load->view('view_header');

          $data['titulo'] = "Nueva Sucursal";

          $this->load->view('sucursal/view_nuevo_sucursal', $data);

          $this->load->view('view_footer');

     }

     public function editarSucursal($id){

          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

          $this->seguridad_model->SessionActivo($url);

          $id =  base64_decode($id);

          $this->load->view('constant');

          $this->load->view('view_header');

          $data['sucursal'] = $this->sucursal_model->BuscaSucursal($id);

          $data['titulo'] = "Editar Sucursal";

          $this->load->view('sucursal/view_nuevo_sucursal', $data);

          $this->load->view('view_footer');

     }
//Funcion Busca cp para los codigos postales de direcciones
	public function BuscaCP(){
               //envio de cp
		$cp = $this->input->get('cp');
                //Llamado a funcion busca cp del modelo clientes
		echo json_encode($this->sucursal_model->BuscaCP($cp));

	}
     
     //Funcion savesucursal para guardar una sucursal
           public function SaveSucursal(){
          //Utilizacion del helper url
          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
          //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion
          $this->seguridad_model->SessionActivo($url);
           
          $Sucursal           = json_decode($this->input->post('SucursalPost'));
         //Array de response para verificacion de campos
          $response = array (

                    "estatus"   => false,

                    "campo"     => "",

                 "error_msg" => ""

         );
          //Verificacion del campo Descipcion
           if($Sucursal->Descripcion==""){

               $response["campo"]     = "descripcion";

               $response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Nombre es Obligatorio</div>";

               echo json_encode($response);

          }else if($Sucursal->CalleNumero==""){

               $response["campo"]     = "calleNumero";

               $response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>La Calle y numero son Obligatorios</div>";

               echo json_encode($response);

          }else if($Sucursal->Colonia==""){

               $response["campo"]     = "colonia";

               $response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>La Colonia es Obligatorio</div>";

               echo json_encode($response);

          }else if($Sucursal->Estado==""){

               $response["campo"]     = "estado";

               $response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Estado es Obligatorio</div>";

               echo json_encode($response);

          }else if($Sucursal->Ciudad==""){

               $response["campo"]     = "ciudad";

               $response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>La Ciudad es Obligatoria</div>";

               echo json_encode($response);

          }else if($Sucursal->Municipio==""){

               $response["campo"]     = "municipio";

               $response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Municipio es Obligatorio</div>";

               echo json_encode($response);

          }else if($Sucursal->Cp==""){

               $response["campo"]     = "cp";

               $response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El CodigoPostal es Obligatorio</div>";

               echo json_encode($response);

          }elseif($Sucursal->Telefono==""){

               $response["campo"]     = "telefono";

               $response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El Telefono es Obligatorio</div>";

               echo json_encode($response);

          }else if($Sucursal->Estatus=="0"){//Verificacion del campo Estatus
               
               $response["campo"]     = "estatus";

               $response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El Estatus es obligatorio</div>";

               echo json_encode($response);

          }else{
               //ArrayCategoria con datos recuperados de los campos
                    $arraySucursal    = array(
                        
                        "descripcion" => $Sucursal->Descripcion,

                        "calleNumero" => $Sucursal->CalleNumero,
						 
			"colonia" => $Sucursal->Colonia,
                        
                        "estado" => $Sucursal->Estado,
                        
                        "ciudad" => $Sucursal->Ciudad,
						 
		        "municipio" => $Sucursal->Municipio,
						 
			"cp" => $Sucursal->Cp,
                        
                        "telefono" => $Sucursal->Telefono,                        

                        "estatus"     => $Sucursal->Estatus

                    );
                //If para verificacion del guardado exitoso de la informacion
               if($Sucursal->Id==""){
                    //Llamado a funcion saveCategoria del modelo categorias
                    $this->sucursal_model->SaveSucursal($arraySucursal);

                    $response["error_msg"]   = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>Informacion Guardada Correctamente</div>";

                    echo json_encode($response);

               }
               //If para verificacion de la actualizacion de informacion correctamente
               if($Sucursal->Id != ""){
                    //Llamado a funcion Update categoria del modelo categorias
                    $this->sucursal_model->UpdateSucursal($arraySucursal,$Sucursal->Id);

                    $response["error_msg"]   = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Informacion Actualizada Correctamente</div>";

                    echo json_encode($response);

               }

          }

     }
	 
	 public function DeleteSucursal(){

          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
          //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion
          $this->seguridad_model->SessionActivo($url);
          //Parametros
          $Sucursal          = json_decode($this->input->post('MiSucursal'));

          $id                 = base64_decode($Sucursal->Id);

          /*Array de response*/

           $response = array (

                    "status"   => false,

                 "error_msg" => ""

         );
          //Llamado a la funcion de elimina sucursal
          $this->sucursal_model->EliminarSucursal($id);

          $response["error_msg"]   = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>Sucursal Eliminado Correctamente, La Información de Actualizara en 5 Segundos <meta http-equiv='refresh' content='5'></div>";

          echo json_encode($response);

     }

}