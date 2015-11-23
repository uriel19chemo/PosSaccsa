<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('America/Mexico_City');
//Clase control de las categorias
class categorias extends CI_Controller {
//Constructor de la clase
	function __construct(){

		parent::__construct();

		$this->load->model('seguridad_model');//Llamada al modelo de seguridad

		$this->load->model('categorias_model');//Llamada al modelo de categorias
                
	}
//Funcion index Muestra carga la vista del modulo categorias
	public function index(){
          //Utilizacion del helper url
          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

          $this->seguridad_model->SessionActivo($url);//Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion

          $this->load->view('constant');//llamada a la vista constantes

          $this->load->view('view_header');//Llamada ala vista header
          //Llamado a la funcion listarCategorias del modelo categorias y los almacena en un array
          $data['categorias'] = $this->categorias_model->ListarCategorias();
          //Cargar de la vista categorias mediante arreglo obtenido $data de categorias
          $this->load->view('categorias/view_categorias', $data);
         
          $this->load->view('view_footer');//Lamada a la vista footer
 

	}
//Funcion nuenosubcategoria Para agregar una nueva subcategoria
     public function nuevosubcategoria($id,$descr){
          //Utilizacion del helper url
          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
          //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion
          $this->seguridad_model->SessionActivo($url);
          //Parametros enviados
          $id                   = base64_decode($id);

          $descr                = base64_decode($descr);
           
          $data["titulo"] = "Nueva Sub Categoria";//titulo a la vista de nueva subcategoria

          $data["id"]     = $id;

          $data["desc"]   = $descr;   

          $this->load->view('constant');//llamada a la vista constantes

          $this->load->view('view_header');//Llamada ala vista header
          //Llamada a la vista nuevo subcategoria dentro de categorias
          $this->load->view('categorias/view_nuevo_subcategoria',$data);

          $this->load->view('view_footer');//Lamada a la vista footer

     }
//Funcion editar subcategoria
     public function editarsubcategoria($id,$descr,$idsubcategoria){
          //Utilizacion del helper url
          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
          //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion
          $this->seguridad_model->SessionActivo($url);
          //Parametros enviados
          $id                   = base64_decode($id);

          $descr                = base64_decode($descr);

          $idsubcategoria       = base64_decode($idsubcategoria);
          //titulo de la vista
          $data["titulo"]       = "Editar Sub Categoria";

          $data["id"]           = $id;

          $data["desc"]         = $descr;   
          //Llamada a la funcion buscasubcategoriaone mediante el id del modelo categorias
          $data["subcategoria"] = $this->categorias_model->BuscaSubCategoriaOne($idsubcategoria);

          $this->load->view('constant');//Llamado a la vista constantes

          $this->load->view('view_header');//Llamado a la vista header
          //Llamada ala vista nuevo subcategoria de categorias
          $this->load->view('categorias/view_nuevo_subcategoria',$data);

          $this->load->view('view_footer');//Llamada a la vista footer

     }
//Funcion savesubcategoria para guardar las subcategorias
     public function SaveSubcategoria(){
          //Utilizacion del helper url
          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
          //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion
          $this->seguridad_model->SessionActivo($url);
          
          $SubCategoria           = json_decode($this->input->post('SubCategoriasPost'));
     //aray response para verificacion de campos vacios
          $response = array (

                    "estatus"   => false,

                    "campo"     => "",

                 "error_msg" => ""

         );
     //Verificacion del campo Categoria
           if($SubCategoria->IdCategoria=="0"){

               $response["campo"]     = "categoria";

               $response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>La Categoria es Obligatorio</div>";

               echo json_encode($response);
     //Verificacion del campo Descripcion
           }else if($SubCategoria->Descripcion==""){

               $response["campo"]     = "descripcion";

               $response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>La SubCategoria es Obligatorio</div>";

               echo json_encode($response);
     //Verificacion del campo Estatus
          }else if($SubCategoria->Estatus=="0"){

               $response["campo"]     = "estatus";

               $response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El Estatus es obligatorio</div>";

               echo json_encode($response);

          }else{
               //ArrayCategoria con datos recuperados de los campos
                    $arrayCategoria    = array(

                         "id_categoria"=> $SubCategoria->IdCategoria,

                         "descripcion" => $SubCategoria->Descripcion,

                         "estatus"     => $SubCategoria->Estatus

                         );
               //If para verificacion del guardado exitoso de la informacion
               if($SubCategoria->Id==""){

                    $this->categorias_model->SaveSubCategoria($arrayCategoria);//Llamado a funcio saveSubcaegoria del modelo categorias

                    $response["error_msg"]   = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>Informacion Guardada Correctamente</div>";

                    echo json_encode($response);

               }
               //If para verificacion de la actualizacion de informacion correctamente
               if($SubCategoria->Id != ""){
                    //Llamado a funcion updatesubCategoria del modelo categorias
                    $this->categorias_model->UpdateSubCategoria($arrayCategoria,$SubCategoria->Id);

                    $response["error_msg"]   = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Informacion Actualizada Correctamente</div>";

                    echo json_encode($response);

               }

          }

     }
// Funcion nuevo para una nueva categoria
     public function nuevo(){
          //Utilizacion del helper url
          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
          //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion
          $this->seguridad_model->SessionActivo($url);
          //Titulo de la vista
          $data["titulo"] = "Nuevo Categoria";

          $this->load->view('constant');//Llamada a la vista constantes

          $this->load->view('view_header');//Llamada a la vista header

          $this->load->view('categorias/view_nuevo_categoria',$data);//Llamada ala vista nuevo categoria

          $this->load->view('view_footer');//Llamado a la vista footer

     }
// Funcion Editar para editar una categoria mediante el id
     public function Editar($id){
          //Utilizacion del helper url
          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
          //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion
          $this->seguridad_model->SessionActivo($url);
          //Parametros
          $id                = base64_decode($id);
          //Llamado a la funcion busca categorias del modelo categorias 
          $data["categoria"] = $this->categorias_model->BuscaCategorias($id);
          //Titulo de la vista 
          $data["titulo"]    = "Editar Categoria";

          $this->load->view('constant');//Llamado a la vista constantes

          $this->load->view('view_header');//Llamado a la vista de header

          $this->load->view('categorias/view_nuevo_categoria',$data);//Llamado a la vista nuevo categoria

          $this->load->view('view_footer');//Llamado a la vista footer

     }
//Funcion delete para eliminar una categoria
     public function DeleteCategoria(){
          //Utilizacion del helper url
          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
          //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion
          $this->seguridad_model->SessionActivo($url);
          //Parametros
          $Categoria          = json_decode($this->input->post('MiCategoria'));

          $id                 = base64_decode($Categoria->Id);

          /*Array de verificacion de campos vacios*/

           $response = array (

                    "estatus"   => false,

                 "error_msg" => ""

         );
          //Llamado a la funcion de elimina categoria y subcategoria del modelo categorias
          $this->categorias_model->EliminarCategoria($id);

          $this->categorias_model->EliminarSubcategorias($id);

          $response["error_msg"]   = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>Categoria Eliminado Correctamente, La Información de Actualizara en 5 Segundos <meta http-equiv='refresh' content='5'></div>";

          echo json_encode($response);

     }
//Funcion delete subcategoria para eliminar una subcategoria
     public function DeleteSubcategoria(){
          //Utilizacion del helper url
          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
          //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion
          $this->seguridad_model->SessionActivo($url);
          //Parametros
          $SubCategoria          = json_decode($this->input->post('MiSubCategoria'));

          $id                    = base64_decode($SubCategoria->Id);

           /*Array de response*/

           $response = array (

                    "estatus"   => false,

                 "error_msg" => ""

         );
          //llamado a la funcion de elimina subcategoria del modelo categorias
          $this->categorias_model->EliminaSubcategoria($id);

          $response["error_msg"]   = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>SubCategoria Eliminado Correctamente, La Información de Actualizara en 5 Segundos <meta http-equiv='refresh' content='5'></div>";

          echo json_encode($response);

     }
//Funcion subcategoria para el listado de subcategorias
     public function Subcategoria($id,$descr){
          //Utilizacion del helper url
          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
          //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion
          $this->seguridad_model->SessionActivo($url);
          //Parametros
          $id                   = base64_decode($id);

          $descr                = base64_decode($descr);
          //Llamado a la funcion de busca subcategorias del modelo categorias
          $data["subcategoria"] = $this->categorias_model->BuscaSubCategorias($id);

          $data["descripcionS"] = $descr;

          $data["idcategoria"]  = $id;

          $this->load->view('constant');//Llamado a la vista constantes

          $this->load->view('view_header');//Llamado a la vista header

          $this->load->view('categorias/view_subcategoria',$data);//Llamado a la vista subcategoria

          $this->load->view('view_footer');//Llamado a la vista footer

     }
     
     //Funcion Departamentos para listar departamentos
	public function departamentos(){
                //Llamado a funcion depatamentos del modelo categorias
		$departamentos = $this->categorias_model->Departamentos();

		echo json_encode($departamentos);

	}
     
//Funcion savecategoria para guardar una categoria
     public function SaveCategoria(){
          //Utilizacion del helper url
          $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
          //Llamada a la funcion SessionActivo del modelo seguridad  para verificar la sesion
          $this->seguridad_model->SessionActivo($url);
           
          $Categoria           = json_decode($this->input->post('CategoriasPost'));
         //Array de response para verificacion de campos
        $response = array (

                "estatus"   => false,

                "campo"     => "",

                "error_msg" => ""

        );
          //Verificacion del campo Descipcion
           if($Categoria->Descripcion==""){

               $response["campo"]     = "descripcion";

               $response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>La Categoria es Obligatorio</div>";

               echo json_encode($response);

          }else if($Categoria->Departamento=="0"){//If para verificacion del campo Departamento

		    $response["campo"]       = "departamento";

		    $response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>Elige un Departamento</div>";

		    echo json_encode($response);

		}else if($Categoria->Estatus=="0"){//Verificacion del campo Estatus
               
                    $response["campo"]     = "estatus";

                    $response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El Estatus es obligatorio</div>";

                     echo json_encode($response);

          }else{
               //ArrayCategoria con datos recuperados de los campos
                    $arrayCategoria    = array(

                        "descripcion" => $Categoria->Descripcion,
                        
                        'id_departamento' => $Categoria->Departamento,

                        "estatus"     => $Categoria->Estatus

                         );
                //If para verificacion del guardado exitoso de la informacion
               if($Categoria->Id==""){
                    //Llamado a funcion saveCategoria del modelo categorias
                    $this->categorias_model->SaveCategoria($arrayCategoria);

                    $response["error_msg"]   = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>Informacion Guardada Correctamente</div>";

                    echo json_encode($response);

               }
               //If para verificacion de la actualizacion de informacion correctamente
               if($Categoria->Id != ""){
                    //Llamado a funcion Update categoria del modelo categorias
                    $this->categorias_model->UpdateCategoria($arrayCategoria,$Categoria->Id);

                    $response["error_msg"]   = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Informacion Actualizada Correctamente</div>";

                    echo json_encode($response);

               }

          }

     }
     

}