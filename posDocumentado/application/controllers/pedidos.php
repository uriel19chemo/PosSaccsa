<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('America/Mexico_City');

class pedidos extends CI_Controller {

	function __construct(){

		parent::__construct();

		$this->load->model('seguridad_model');

		$this->load->model('pedidos_model');

	}

	public function index(){

          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

          $this->seguridad_model->SessionActivo($url);

          /**/

          $this->load->view('constant');

          $this->load->view('view_header');

          $data['pedido'] = $this->pedidos_model->ListarPedidos();

          $this->load->view('pedidos/view_pedidos', $data);

          $this->load->view('view_footer');

          
	}

     public function nuevo(){

          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

          $this->seguridad_model->SessionActivo($url);

          $this->load->view('constant');

          $this->load->view('view_header');

          $data['titulo'] = "Nuevo Pedido";

          $this->load->view('pedidos/view_nuevo_pedido', $data);

          $this->load->view('view_footer');

     }
	 
    public function editarPedido($id){

          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

          $this->seguridad_model->SessionActivo($url);

          $id =  base64_decode($id);

          $this->load->view('constant');

          $this->load->view('view_header');

          $data['pedido'] = $this->pedidos_model->BuscaPedido($id);

          $data['titulo'] = "Editar Pedido";

          $this->load->view('pedidos/view_nuevo_pedido', $data);

          $this->load->view('view_footer');

     }

     //Funcion savedepartamento para guardar una categoria
     public function SavePedido(){
          //Utilizacion del helper url
          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
          //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion
          $this->seguridad_model->SessionActivo($url);
           
          $Pedido           = json_decode($this->input->post('PedidoPost'));
         //Array de response para verificacion de campos
          $response = array (

                    "estatus"   => false,

                    "campo"     => "",

                 "error_msg" => ""

         );
          //Verificacion del campo Descipcion
           if($Pedido->Tipo==""){

               $response["campo"]     = "tipo";

               $response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>La Marca es Obligatorio</div>";

               echo json_encode($response);

          }else if($Pedido->Fecha==""){//Verificacion del campo Estatus
               
               $response["campo"]     = "fecha";

               $response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El Estatus es obligatorio</div>";

               echo json_encode($response);

          }else if($Pedido->Cliente==""){//Verificacion del campo Estatus
               
               $response["campo"]     = "cliente";

               $response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El Estatus es obligatorio</div>";

               echo json_encode($response);

          }else if($Pedido->Total==""){//Verificacion del campo Estatus
               
               $response["campo"]     = "total";

               $response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El Estatus es obligatorio</div>";

               echo json_encode($response);

          }else if($Pedido->Estatus=="0"){//Verificacion del campo Estatus
               
               $response["campo"]     = "estatus";

               $response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El Estatus es obligatorio</div>";

               echo json_encode($response);

          }else{
               //ArrayCategoria con datos recuperados de los campos
                    $arrayPedido    = array(
                //COLUMNAS DE BD    Y    CAMPOS RECUPERADOS
                         "TIPO" => $Pedido->Tipo,
                        
                        "FECHA" => $Pedido->Fecha,
                        
                        "CLIENTE" => $Pedido->Cliente,
                            
                        "TOTAL" => $Pedido->Total,

                        "ESTATUS"     => $Pedido->Estatus

                         );
                //If para verificacion del guardado exitoso de la informacion
               if($Pedido->Id==""){
                    //Llamado a funcion saveCategoria del modelo categorias
                    $this->pedidos_model->SavePedido($arrayPedido);

                    $response["error_msg"]   = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>Informacion Guardada Correctamente</div>";

                    echo json_encode($response);

               }
               //If para verificacion de la actualizacion de informacion correctamente
               if($Pedido->Id != ""){
                    //Llamado a funcion Update categoria del modelo categorias
                    $this->pedidos_model->UpdatePedido($arrayPedido,$Pedido->Id);

                    $response["error_msg"]   = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Informacion Actualizada Correctamente</div>";

                    echo json_encode($response);

               }

          }

     }
	 
	 public function DeletePedido(){

          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
          //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion
          $this->seguridad_model->SessionActivo($url);
          //Parametros
          $Pedido         = json_decode($this->input->post('MiPedido'));

          $id                 = base64_decode($Pedido->ID);

          /*Array de response*/

           $response = array (

                    "status"   => false,

                 "error_msg" => ""

         );
          //Llamado a la funcion de elimina departamento
          $this->pedidos_model->EliminarPedido($id);

          $response["error_msg"]   = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>Pedido Eliminado Correctamente, La Información de Actualizara en 5 Segundos <meta http-equiv='refresh' content='5'></div>";

          echo json_encode($response);

     }

}