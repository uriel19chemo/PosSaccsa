<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="E-Comerce Desarrollado con framework Codeigniter">
    <meta name="author" content="Uriel López Vargas">
    <title><?php echo TITULO_ECOMERCE; ?></title>
    <link href="<?php echo base_url()?>lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>lib/css/font-awesome.min.css" rel="stylesheet"> 
    <link href="<?php echo base_url()?>lib/css/animate.css" rel="stylesheet">
	<link href="<?php echo base_url()?>lib/css/main.css" rel="stylesheet">
	<link href="<?php echo base_url()?>lib/css/responsive.css" rel="stylesheet">
	<script src="<?php echo base_url()?>lib/js/jquery.js"></script>
	<script>
/*
 * Funcion para agregar al carrito
*/
	function AddCarrito(a,b,c,d,e,f){ 
		var url          = "<?php echo base_url();?>";
		if(b==999999){
			var valor   = document.getElementById("txtCantidad").value;
			b = valor;
		}
		var totalCarrito = "<?php echo $this->cart->total_items() + 1; ?>";
		
		var Carrito 	 = new Object();
		Carrito.Id  	 = a;
		Carrito.Cantidad = b;
		Carrito.Precio   = c;
		Carrito.Descripc = d;
		Carrito.Control  = f;
		var Json = JSON.stringify(Carrito); 
		$.post(url + 'ecomerce/AddToCarrito',
		{ 
			MiCarrito: Json
		},
		function(data, textStatus) {
			 
			$("#Mensaje").html("<div class='alert alert-success'>Producto: <strong>" + e +"</strong>: "+data.Msg+"</div>");
			$('#lblCarrito').text("(" + totalCarrito + ")");
		}, 
		"json"		
		); 
		if(f=="2"){
			window.setInterval("temporizador()",1000);
		}
		if(f=="3"){
			window.setInterval("temporizador()",1000);
		}

		return false;
	}
	function temporizador() { 
		location.reload(true);

	}
/*
 * Funcion para vaciar el carrito 
*/
	function VaciarCarrito(){
		if(confirm("Estas Seguro de Vaciar el Carrito?")){
			var url          = "<?php echo base_url();?>";
			var Carrito 	 = new Object();
			Carrito.Id  	 = "1";
			var Json = JSON.stringify(Carrito); 
			$.post(url + 'ecomerce/DeleteCarrito',
			{ 
				MiCarrito: Json
			},
			function(data, textStatus) {
				 
				$("#Mensaje").html("<div class='alert alert-danger'>"+data.Msg+"</div>");
				$('#lblCarrito').text("");
			}, 
			"json"		
			); 
			window.setInterval("temporizador()",1000);
			return false;
			
		}
		
	}
	</script>   
    <link rel="icon" type="image/<?php echo EXTENSION_IMAGEN_FAVICON; ?>" href="<?php echo base_url()?>img/<?php echo NOMBRE_IMAGEN_FAVICON; ?>" />
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container"><!--Contenedor-->
				<div class="row"><!--Row-->
					<div class="col-sm-6">
						<div class="contactinfo"><!--Div de Informacion de contacto-->
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +1 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> dayds19@dayds.com</a></li>
							</ul>
						</div><!--/Fin de div de Informacion de contacto-->
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right"><!--Div de redes sociales-->
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div><!--/Fin Div de redes sociales-->
					</div>
				</div><!--Fin Row-->
			</div><!--/Fin de Container-->
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container"><!--Contenedor-->
				<div class="row"><!--Row-->
					<div class="col-sm-4">
						<div class="logo pull-left"><!--Logo--> 
							<a href=""><img src="<?php echo base_url()?>img/logoU.jpg" width="140px" height="39px" alt="" /></a>
						</div><!--/Fin Logo-->
					</div>

					<div class="col-sm-8">
						<div class="shop-menu pull-right"><!--Div Menu Sesion-->
							<ul class="nav navbar-nav">
								<?php if($this->session->userdata('is_logged_in')){ ?>
								<li><a><strong>Logeado:</strong> <small><?php echo $this->session->userdata('NOMBRE')." ".$this->session->userdata('APELLIDOS');?></small>&nbsp;&nbsp;&nbsp;&nbsp;|</a></li>
								<?php }?>
								<li><a href="<?php echo base_url()?>ecomerce/Carrito"><i class="fa fa-shopping-cart"></i>Mi Carrito <label id="lblCarrito"><?php if($this->cart->total_items()>0){echo "(".$this->cart->total_items().")";}  ?></label></a></li>
								<?php if($this->session->userdata('is_logged_in')){ ?>
								<li><a href="<?php echo base_url()?>ecomerce/VerPedidos"><i class="fa fa-user"></i> Mis Pedidos</a></li>
								<li><a href="<?php echo base_url()?>ecomerce/Logout"><i class="fa fa-user"></i> Cerrar Sesión</a></li>
								<?php }else{ ?>
								<li><a href="<?php echo base_url()?>ecomerce/LoginOut"><i class="fa fa-lock"></i> Login</a></li>
								<?php } ?>
								<!--<li><a href="<?php echo base_url()?>login"><i class="fa fa-lock"></i> Administrar</a></li>-->
							</ul>
						</div><!--/Fin div Menu Sesion-->
					</div>
				</div><!--/Fin Row-->
			</div><!--/Fin Contenedor-->
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container"><!--Contenedor-->
				<div class="row"><!--Row-->
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left"><!--Div Menu Inicio-->
							<ul class="nav navbar-nav collapse navbar-collapse">
						            <li><a href="<?php echo base_url()?>" class="active">Inicio</a></li>
							    <li class="dropdown"><a href="#">Ecomerce<i class="fa fa-angle-down"></i></a>
                                                                <ul role="menu" class="sub-menu">
                                                                    <li><a href="<?php echo base_url()?>ecomerce/Productos">Productos</a></li> 
								    <li><a href="<?php echo base_url()?>ecomerce/Carrito">Mi Carrito</a></li>
                                                                </ul>
							    <li><a href="<?php echo base_url()?>ecomerce/Contacto">Contacto</a></li>
                                                            </li> 
							</ul>
						</div><!--/Fin div menu Inicio-->
					</div>
					<div class="col-sm-3"><!--Div busqueda-->
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div><!--/Fin div Busqueda-->
				</div><!--/Fin Row-->
			</div><!--/Fin Contenedor-->
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	 
	 <section id="slider"><!--slider-->
		<div class="container"><!--Contenedor-->
			<div class="row"><!--Row-->
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel"><!--Div Carousel-->
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner"><!--Div Inner-->
							<div class="item active"><!--Item del carousel Inicial-->
								<div class="col-sm-6"><!--Descripcion de imagen -->
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Free E-Commerce Template</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div><!--/Fin Descripcion de imagen -->
								<div class="col-sm-6"><!--Carga de Imagenes-->
									<img src="<?php echo base_url()?>img/images/home/girl1.jpg" class="girl img-responsive"  alt="" />
									<img src="<?php echo base_url()?>img/images/home/pricing.png" class="pricing"  alt="" />
								</div><!--/Fin Carga de Imagenes-->
							</div><!--/Fin Item Carousel Inicial-->
							
							<div class="item"><!--Item 2 De Carousel-->
								<div class="col-sm-6"><!--Descripcion de imagen -->
									<h1><span>E</span>-SHOPPER</h1>
									<h2>100% Responsive Design</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div><!--/Fin Descripcion de imagen -->
								<div class="col-sm-6"><!--Carga de Imagenes-->
									<img src="<?php echo base_url()?>img/images/home/girl2.jpg" class="girl img-responsive"  alt="" />
									<img src="<?php echo base_url()?>img/images/home/pricing.png" class="pricing"  alt="" />
								</div><!--/Fin Carga de Imagenes-->
							</div><!--/Fin Item 2 De Carousel-->
						
							<div class="item"><!--Item 3 De Carousel-->
								<div class="col-sm-6"><!--Descripcion de imagen -->
									<h1><span>E</span>-SHOPPER</h1>
									<h2>Free Ecommerce Template</h2>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
									<button type="button" class="btn btn-default get">Get it now</button>
								</div><!--/Fin Descripcion de imagen-->
								<div class="col-sm-6"><!--Carga de Imagenes-->
									<img src="<?php echo base_url()?>img/images/home/girl3.jpg" class="girl img-responsive"  alt="" />
									<img src="<?php echo base_url()?>img/images/home/pricing.png" class="pricing"  alt="" />
								</div><!--/Fin Carga de Imagenes-->
							</div><!--/Fin Item 3 De Carousel-->
							
						</div><!--/Fin div inner-->
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div><!--/Fin div carousel-->
					
				</div>
			</div><!--/ Fin Row-->
		</div><!--/Fin Contenedor-->
	</section><!--/Fin slider-->
	 
	<section><!--Section-->
		<div class="container"><!--Contenedor-->
			<div class="row"><!--Row-->
				<div class="col-sm-3">
					<div class="left-sidebar"><!--Div sidebar-->
						<h2>Categorias</h2>
						<div class="panel-group category-products" id="accordian"><!--categoria de productos-->
							<div class="panel panel-default"><!--Div panel-->
							<?php
								if($categorias){
									foreach ($categorias as $key => $value) {
										# code... 
										echo '<div class="panel-heading">';
										echo '<h4 class="panel-title">';
										echo '<a data-toggle="collapse" data-parent="#accordian" href="#'.$value->id.'">';
										echo '<span class="badge pull-right"><i class="fa fa-plus"></i></span>';
										echo $value->descripcion;
										echo '</a>';
										echo '</h4>';
										echo '</div>';
										echo '<div id="'.$value->id.'" class="panel-collapse collapse">';
										echo '<div class="panel-body">'; 
										//
										if($subcategoria){
											foreach ($subcategoria as $key => $value2) {
												# code...
												if($value->id==$value2->id_categoria){
													echo '<ul>';
													echo '<li><a href="'.base_url().'ecomerce/ProductosCat/">'.$value2->descripcion.'</a></li>';
													echo '</ul>';
												}
											}
										}
										echo '</div>';
										echo '</div>';
									}
								} 
							?>
								
							</div><!--/Fin div panel-->
							 		
						</div><!--/categoria de productos-->
					 
					</div><!--/Fin div sidebar-->
				</div>
				
				<div class="col-sm-9 padding-right">
				<div id="Mensaje" ></div>