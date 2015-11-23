<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('America/Mexico_City');

class departamento extends CI_Controller {

	function __construct(){

		parent::__construct();

		$this->load->model('seguridad_model');

		$this->load->model('departamento_model');

	}

	public function index(){

          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

          $this->seguridad_model->SessionActivo($url);

          /**/

          $this->load->view('constant');

          $this->load->view('view_header');

          $data['departamento'] = $this->departamento_model->ListarDepartamento();

          $this->load->view('departamento/view_departamento', $data);

          $this->load->view('view_footer');

          

	}

     public function nuevo(){

          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

          $this->seguridad_model->SessionActivo($url);

          $this->load->view('constant');

          $this->load->view('view_header');

          $data['titulo'] = "Nuevo Departamento";

          $this->load->view('departamento/view_nuevo_departamento', $data);

          $this->load->view('view_footer');

     }

     public function editarDepartamento($id){

          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

          $this->seguridad_model->SessionActivo($url);

          $id =  base64_decode($id);

          $this->load->view('constant');

          $this->load->view('view_header');

          $data['departamento'] = $this->departamento_model->BuscaDepartamento($id);

          $data['titulo'] = "Editar Departamento";

          $this->load->view('departamento/view_nuevo_departamento', $data);

          $this->load->view('view_footer');

     }
     
     //Funcion Departamentos para listar departamentos
	public function sucursales(){
                //Llamado a funcion depatamentos del modelo categorias
		$sucursales = $this->departamento_model->Sucursales();

		echo json_encode($sucursales);

	}

     //Funcion savedepartamento para guardar una categoria
     public function SaveDepartamento(){
          //Utilizacion del helper url
          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
          //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion
          $this->seguridad_model->SessionActivo($url);
           
          $Departamento           = json_decode($this->input->post('DepartamentoPost'));
         //Array de response para verificacion de campos
          $response = array (

                    "estatus"   => false,

                    "campo"     => "",

                 "error_msg" => ""

         );
          //Verificacion del campo Descipcion
            if($Departamento->Descripcion==""){

               $response["campo"]     = "descripcion";

               $response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>La Categoria es Obligatorio</div>";

               echo json_encode($response);

            }else if($Departamento->Sucursal=="0"){//If para verificacion del campo Sucursal

		    $response["campo"]       = "sucursal";

		    $response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>Elige una Sucursal</div>";

		    echo json_encode($response);

	    }else if($Departamento->Estatus=="0"){//Verificacion del campo Estatus
               
               $response["campo"]     = "estatus";

               $response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El Estatus es obligatorio</div>";

               echo json_encode($response);

            }else{
               //ArrayCategoria con datos recuperados de los campos
                    $arrayDepartamento    = array(

                         "descripcion" => $Departamento->Descripcion,
                        
                        'id_sucursal' =>  $Departamento->Sucursal,

                         "estatus"     => $Departamento->Estatus

                         );
                //If para verificacion del guardado exitoso de la informacion
               if($Departamento->Id==""){
                    //Llamado a funcion saveCategoria del modelo categorias
                    $this->departamento_model->SaveDepartamento($arrayDepartamento);

                    $response["error_msg"]   = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>Informacion Guardada Correctamente</div>";

                    echo json_encode($response);

               }
               //If para verificacion de la actualizacion de informacion correctamente
               if($Departamento->Id != ""){
                    //Llamado a funcion Update categoria del modelo categorias
                    $this->departamento_model->UpdateDepartamento($arrayDepartamento,$Departamento->Id);

                    $response["error_msg"]   = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Informacion Actualizada Correctamente</div>";

                    echo json_encode($response);

               }

          }

     }
	 
	 public function DeleteDepartamento(){

          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
          //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion
          $this->seguridad_model->SessionActivo($url);
          //Parametros
          $Departamento          = json_decode($this->input->post('MiDepartamento'));

          $id                 = base64_decode($Departamento->Id);

          /*Array de response*/

           $response = array (

                    "status"   => false,

                 "error_msg" => ""

         );
          //Llamado a la funcion de elimina departamento
          $this->departamento_model->EliminarDepartamento($id);

          $response["error_msg"]   = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>Departamento Eliminado Correctamente, La Información de Actualizara en 5 Segundos <meta http-equiv='refresh' content='5'></div>";

          echo json_encode($response);

     }

}