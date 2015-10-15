<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Mexico_City');
//Clase control Para Cargar las Opciones del menu de la vista del cliente
class ecomerce extends CI_Controller {

/*
 *Contructor de la clase Ecomerce 
*/
	function __construct(){
		parent::__construct(); 
		$this->load->model('categorias_model');//Llamado a modelo categorias
		$this->load->model('ecomerce_model');//Llamado a modelo eccomerce
		$this->load->model('ecomerce_login');//Llamado a modelo eccomerce login
		$this->load->model('ordencompra_model');//Llamado a modelo ordencompra
		$this->load->library('pagination');//Llamado a libreria pagination
                
	}
/*
 * Funcion Index en cargada de cargar toda la plantilla del index asi como sus funciones complementarias
*/	
	public function index(){ 
          $this->load->view('constant');//Llamada a la vista Constantes

          //Llamado a funciones del modelo_categorias
          $data['categorias'] = $this->categorias_model->ListarCategorias();
          $data['subcategoria'] = $this->categorias_model->ListarSubCategorias();
          //Llamada a funciones del modelo_ecomerce
          $data['productosnew']= $this->ecomerce_model->ProductosNew();
          $data['imgsproducto']= $this->ecomerce_model->TraeImagenes();
          $data['TraeCatLimit']= $this->ecomerce_model->TraeCategoriaLimit(); 
          $data['ProductoCat'] = $this->ecomerce_model->Productos();
          $data['CarruselProd']= $this->ecomerce_model->CarruselProductos();
          //Llamada a plantillas del modelo_ecomerce
          $this->load->view('ecomerce/view_header',$data);//Llamada al header
          $this->load->view('ecomerce/view_ecomerce',$data);//Llamada a vista ecomerce(Contenido del Llenado y listado de Productos)
          $this->load->view('ecomerce/view_footer');//Llamada a footer
	}
/*
 * Funcion Contacto en cargada de cargar el formulario de contacto
*/
	public function Contacto($offset=''){
		  $this->load->view('constant');//Llamada a la vista Constantes

		  //Llamado a funciones del modelo_categorias
          $data['categorias'] = $this->categorias_model->ListarCategorias();
          $data['subcategoria'] = $this->categorias_model->ListarSubCategorias();
           //Llamada a plantillas del modelo_ecomerce
          $this->load->view('ecomerce/view_header',$data);//Llamada al header
          $this->load->view('ecomerce/view_contacto');//Llamada a vista ecomerce(Contenido del Llenado y listado del formulario de contacto)
          $this->load->view('ecomerce/view_footer');//Llamada a footer
	}
/*
 * Funcion Productos en cargada de cargar el Listado de productos
*/	
	public function Productos($offset=''){
		  $this->load->view('constant');//Llamada a la vista Constantes

		  //Llamado a funciones del modelo_categorias
          $data['categorias'] = $this->categorias_model->ListarCategorias();
          $data['subcategoria'] = $this->categorias_model->ListarSubCategorias();
           //Llamada a plantillas del modelo_ecomerce
          $this->load->view('ecomerce/view_header',$data);//Llamada al header
          $this->load->view('ecomerce/view_list_productos');//Llamada a vista ecomerce(Contenido del Llenado y listado de productos)
          $this->load->view('ecomerce/view_footer');//Llamada a footer
	}
/*
 * Funcion Pagina_Productos en cargada de cargar el Listado de productos mediante paginacion
*/	
	public function Pagina_Productos($offset=''){
		   //
		  $limit                = 9;//Limite de Productos Por Pagina
	      $data['Productos']    = $this->ecomerce_model->ListProductos($limit, $offset);//Llamado a funcion ListProductos de modelo
	      $config['base_url']   = base_url().'ecomerce/Pagina_Productos/';//Funcion Para cambiar pagina
	      $config['total_rows'] = $this->ecomerce_model->CountProductos();//Funcion para contar Productos y Crear Paginas
	      $config['per_page']   = $limit;//Funcion para organizar por categorias los productos y limitar paginas
	      $config['uri_segment']= '3';//Funcion que cuenta paginas y sombrea la seleccionada
	      $this->pagination->initialize($config);//Funcion que inicializa la paginacion
	      $data['pag_links']    = $this->pagination->create_links(); //Creador de links de paginacion 
	      $data['imgsproducto'] = $this->ecomerce_model->TraeImagenes();//Llamado a funcion TreaImagenes del modelo
          $this->load->view('ecomerce/view_productos',$data);//Funcion Para cargar la plantilla del listado de productos
	}
/*
 * Funcion Product_Detail en cargada de cargar el detalle de los productos mediante el id 
*/	
	public function Product_Detail($id){
		  $id = base64_decode($id);//Id para consultar el producto
		  $this->load->view('constant');//Llamado a la vista  constante Para el header

		  //Llamado a funciones del modelo_categorias
          $data['categorias'] = $this->categorias_model->ListarCategorias();
          $data['subcategoria'] = $this->categorias_model->ListarSubCategorias();
          //Llamada a funciones del modelo_ecomerce
          $data['DetalleProd'] = $this->ecomerce_model->BuscaProducto($id);
           $data['imgsproducto']= $this->ecomerce_model->TraeImagenDetalle($id);
           $data['CarruselProd']= $this->ecomerce_model->CarruselProductos();
           $data['imgsproducto2']= $this->ecomerce_model->TraeImagenes();
          //Llamada a plantillas del modelo_ecomerce
          $this->load->view('ecomerce/view_header',$data);//Llamada al header
          $this->load->view('ecomerce/view_detail',$data);//Llamada a vista ecomerce(Contenido del Llenado y listado de  detalles de los productos)
          $this->load->view('ecomerce/view_footer');//Llamada a footer
	}
/*
 * Funcion DeleteCarrito en cargada de Vaciar el Carrito Por Completo  
*/
	public function DeleteCarrito(){
		$this->cart->destroy();
		$add = array("Msg"=>"Se Elimino al Carrito Correctamente");
		echo json_encode($add);
	}
/*
 * Funcion AddToCarrito en cargada de agregar un producto al Carrito   
*/
	public function AddToCarrito(){ 
		$Carrito = json_decode($this->input->post('MiCarrito'));//Variable Donde se almacenan los productos seleccionados
		$Cantidad= $Carrito->Cantidad;
		$idProduc= $Carrito->Id;
		$Precio  = $Carrito->Precio;
		$Descrip = $Carrito->Descripc;
		$Control = $Carrito->Control;
		
		$row     = array();
		//If para Checar si el producto ya existe en el y poder aumentar su cantidad 
		if($cart = $this->cart->contents()){
			foreach($cart as $item){
				if($item['id'] === $idProduc){
					$cant   = ($item['qty']+$Cantidad);
					if($Control==3){
						$cant = $Cantidad;
					} 
					$row    = array('rowid' => $item['rowid'],
					'price' => $item['price'],
					'qty'   =>$cant
					);
					break;
				}
			}
		}//Si la fila es afectada se actualiza
		if($row){
			$this->cart->update($row);
		}else{//De lo contrario se inserta el producto nuevo al carrito
			$insert = array(
			'id' => $idProduc,
			'qty' => $Cantidad,
			'price' => $Precio,
		    'name'=>convert_accented_characters($Descrip) // para quitar los acentos	    
			);
			$this->cart->insert($insert); 
		}
		$add = array();
		if($Cantidad=="-1"){//Si se elimina un producto se manda el mensaje
			$add = array("Msg"=>"Se Elimino al Carrito Correctamente");
		}else{//de lo contrario se agrega correctamente y se manda el msj
			$add = array("Msg"=>"Agregado al Carrito Correctamente");
		}
		
		echo json_encode($add);
		
	}
/*
 * Funcion Carrito en cargada de mostrar la vista Carrito   
*/
	public function Carrito(){
		$this->load->view('constant');//Llamado a la vista  constante Para el header

		//Llamado a funciones del modelo_categorias
        $data['categorias'] = $this->categorias_model->ListarCategorias();
        $data['subcategoria'] = $this->categorias_model->ListarSubCategorias();
        //Llamada a plantillas del modelo_ecomerce
		$this->load->view('ecomerce/view_header',$data);//Llamada al header
        $this->load->view('ecomerce/view_carrito');//Llamada a vista ecomerce(Contenido del Llenado y listado de  detalles de los productos en el carrito)
        $this->load->view('ecomerce/view_footer');//Llamada al Footer
	}
/*
 * Funcion RealizaPedido en cargada de mostrar la vista Para realizar el pedido 
*/	
	public function RealizaPedido(){
		if($this->cart->total_items()>0){
				//Creamos Pedido Con toda la descripcion del empleado y productos
				$impuesto      = 16;
				$iva 		   = ($this->cart->total() * 0.16);
				$total    	   = $this->cart->total() + $iva;
				$arrayDocumento= array(
				"TIPO"				=>"Pedido", 
				"FECHA"				=>date('Y-m-j H:i:s'),
				"CLIENTE"			=>$this->session->userdata('ID'),
				"BASEIMPUESTO"		=>$impuesto,
				"TOTAL_IMPUESTO"	=>$iva,
				"BRUTO"				=>$this->cart->total(),
				"TOTAL"				=>$total,
				"USUARIO"			=>$this->session->userdata('ID')
				);
				$saveOrderDocument = $this->ordencompra_model->saveOrderDocumento($arrayDocumento);
				if($saveOrderDocument!=0){
					foreach ($this->cart->contents() as $items):
						$Id            = $items['rowid'];
						$Clave         = "";
						$Descripcion   = "";
						$Costo         = "";
						$DetalleProd   = $this->ecomerce_model->BuscaProducto($Id);
						foreach ($DetalleProd as $key => $value){
							# code...
							$Descripcion = $value->descripcion;
							$Clave       = $value->codigo;
							$Costo      = $value->precio_compra;
						}
						
						$arrayPartidas = array(
						"ID_LINK"			=> $saveOrderDocument,
						"TIPO"				=> "Pedido",
						"FECHA"				=> date('Y-m-j H:i:s'),
						"CLIENTE"			=> $this->session->userdata('ID'),
						"CLAVE"				=> $Clave,
						"COSTO"				=> $Costo,
						"PRECIO"			=> $items['price'],
						"DESCRIPCION"		=> $Descripcion,
						"SALIDAS"			=> $items['qty']
						);
						$this->ordencompra_model->saveOrderPartidas($arrayPartidas);
					endforeach;
				}
				$this->cart->destroy();//Vaciar el carrito
				$this->load->view('constant');//Llamado a la vista  constante Para el header

		        //Llamado a funciones del modelo_categorias
				$data['categorias'] = $this->categorias_model->ListarCategorias();
				$data['subcategoria'] = $this->categorias_model->ListarSubCategorias();
				//Mensaje de confirmacion exitosa
				$data['Pedidos']       = "<div class='alert alert-success'>El Pedido <strong>".$saveOrderDocument."</strong>, se Creo Correctamente, Revisa Tu Correo</div>";
				$this->load->view('ecomerce/view_header',$data);//Llamada de header
				$this->load->view('ecomerce/view_pedido',$data);//Llamado de vista Para la confirmacion del pedido exitoso
				$this->load->view('ecomerce/view_footer'); //Llamada de footer
				
                //Configuracion para el envio de correo
				$configGmail = array(
					'protocol'  => 'smtp',
					'smtp_host' => 'ssl://smtp.gmail.com',
					'smtp_port' => 465,
					'smtp_user' => 'uri19chemo@gmail.com',
					'smtp_pass' => 'ronaldinho19',
					'mailtype'  => 'html',
					'charset'   => 'utf-8',
					'newline'   => "\r\n"
				);    
				$this->email->initialize($configGmail);
				$this->email->from('uri19chemo@gmail.com','Sistema Ecomerce');
				$this->email->to($this->session->userdata('EMAIL'));
				$this->email->subject('Pedido Nº:'.$saveOrderDocument);
				$this->email->message('Se Creo el Pedido:<strong>'.$saveOrderDocument.'</strong>');
				$this->email->send();
		}else{
				$this->load->view('constant');//Llamado a la vista  constante Para el header

		        //Llamado a funciones del modelo_categorias
				$data['categorias'] = $this->categorias_model->ListarCategorias();
				$data['subcategoria'] = $this->categorias_model->ListarSubCategorias();
				//Mensaje de Alerta
				$data['Pedidos']       = "<div class='alert alert-danger'>No has Comprado Nada para enviar Pedido</div>";
				$this->load->view('ecomerce/view_header',$data);//Llamado al header
				$this->load->view('ecomerce/view_pedido',$data);//Llamada ala vista De confirmacion de pedidos
				$this->load->view('ecomerce/view_footer'); //Llamada de footer
		}
	}
/*
 * Funcion VerPedidos en cargada de mostrar la vista de los pedidos realizados por el cliente 
*/
	public function VerPedidos(){
		if($this->session->userdata('is_logged_in')){//Verificamos que este logueado
			
			$this->load->view('constant');//Llamado a la vista  constante Para el header

		    //Llamado a funciones del modelo_categorias
			$data['categorias'] 	= 	$this->categorias_model->ListarCategorias();
			$data['subcategoria']   = $this->categorias_model->ListarSubCategorias();

			$data['Pedidos']       = $this->ecomerce_model->MisPedidos($this->session->userdata('ID'));//Llamado a funcion mis pedidos del modelo
			$this->load->view('ecomerce/view_header',$data);//Llamado al header
			$this->load->view('ecomerce/view_list_pedidos',$data);//Llamado a la vista listar pedidos
			$this->load->view('ecomerce/view_footer'); //Llamado al footer
		}else{
			redirect(base_url());
		}
	}
/*
 * Funcion Pedido en cargada de mostrar la vista de los pedidos realizados por el cliente 
*/	
	public function Pedido(){
		if($this->session->userdata('is_logged_in')){
			$TipoUsuario = $this->session->userdata('TIPOUSUARIOMS');
			$IdCliente   = $this->session->userdata('ID');
			if($TipoUsuario=="Cliente"){//Verificacion del tipo de usuario para cargar la plantilla 
				$this->load->view('constant');//Llamado a la vista  constante Para el header

		        //Llamado a funciones del modelo_categorias
				$data['categorias'] = $this->categorias_model->ListarCategorias();
				$data['subcategoria'] = $this->categorias_model->ListarSubCategorias();
				$data['MisDatosClient'] = $this->ecomerce_login->DatosCliente($IdCliente);//Carga de los datos del cliente
				$this->load->view('ecomerce/view_header',$data);//Llamada al header
				$this->load->view('ecomerce/view_detailt_pedido',$data);//Llamada a la vista de los detalles del pedido
				$this->load->view('ecomerce/view_footer'); //Llamada al footer
			}else{//Si el usuario no esta lo gueado mostramos la vista necesaria
				$this->load->view('constant');//Llamado a la vista  constante Para el header

		        //Llamado a funciones del modelo_categorias
				$data['categorias'] = $this->categorias_model->ListarCategorias();
				$data['subcategoria'] = $this->categorias_model->ListarSubCategorias();
				$this->load->view('ecomerce/view_header',$data);//Llamada al header
				$this->load->view('ecomerce/view_login_ecomerce');//Llamada a la vista de login en caso de no estar logueado el cliente
				$this->load->view('ecomerce/view_footer'); //Llamado al footer
			}
          }else{//Si no Mostramos la vista principal
                $this->load->view('constant');//Llamado a la vista  constante Para el header

		        //Llamado a funciones del modelo_categorias
				$data['categorias'] = $this->categorias_model->ListarCategorias();
				$data['subcategoria'] = $this->categorias_model->ListarSubCategorias();
				$this->load->view('ecomerce/view_header',$data);//Llamado al header
				$this->load->view('ecomerce/view_login_ecomerce');//Llamado ala vista de logue
				$this->load->view('ecomerce/view_footer'); //Llamado al footer
          }
	}
/*
 * Funcion Logout en cargada de cerrar la sesion del cliente 
*/	
	public function Logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
/*
 * Funcion LoginOut en cargada de mostrar la vista de inicio de sesion del cliente 
*/
	public function LoginOut(){
		if($this->session->userdata('is_logged_in')){
			redirect(base_url());
		}else{
			$this->load->view('constant');
			//Llamado a la vista  constante Para el header

		        //Llamado a funciones del modelo_categorias
			$data['categorias'] = $this->categorias_model->ListarCategorias();
			$data['subcategoria'] = $this->categorias_model->ListarSubCategorias();
			$this->load->view('ecomerce/view_header',$data);//Llamado al header
			$this->load->view('ecomerce/view_login_ecomerce');//Llamado ala vista de login
			$this->load->view('ecomerce/view_footer');//Llamado al footer
		}
		 
	}
/*
 * Funcion Login en cargada de iniciar la sesion del cliente 
*/	
	public function Login(){
		$Login 		= json_decode($this->input->post('LoginPost'));//logueo mediante base de datos
		//$Login      = json_decode('{"Email":"crisant_89@hotmail.com","Password":"1234"}');
		$response = array (
				"login"     => false,
				"campo"     => "",
	            "error_msg" => ""
	    );
		$user = $this->ecomerce_login->LoginBD($Login->Email);
		if(count($user) == 1){
			$crypt     = crypt($Login->Password, $user->PASSWORD); 
			if($user->PASSWORD==$crypt){
				$session = array(
                'ID'           => $user->ID,
				'NOMBRE'       => $user->NOMBRE,
				'APELLIDOS'    => $user->APELLIDOS,
				'EMAIL'        => $Login->Email,
				'TIPOUSUARIO'  => 3,
				'TIPOUSUARIOMS'=> "Cliente",
				'RFC'          => $user->RFC,
				'is_logged_in' => TRUE,                 
				);
				
				$this->session->set_userdata($session);
				//$this->Pedido;
				
				$response["login"] = true;
				$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>Login</div>";
			}else{
				$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>La Contraseña Contraseña es Invalida  </div>";
			}
		}else{
			$response["error_msg"]   = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El Email es Invalida </div>";
		}
		echo json_encode($response);
	}

}