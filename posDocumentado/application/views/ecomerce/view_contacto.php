<script type="text/javascript" src="<?php echo base_url();?>js/JsValidacion.js"></script>
<script src="<?php echo base_url();?>js/JsonClientes.js"></script>
<script> 
var baseurl = "<?php echo base_url(); ?>";

  var codigopostal  = 0;

  var ids           = document.getElementById("id").value;

  ids               = parseInt(ids.length);

  var col           = document.getElementById("col").value;

  if(ids==0){

    codigopostal = 0;

  }else{

    codigopostal = document.getElementById("cps").value;;

  }
</script>
<input type="hidden" value="" id="id" name="id"> 

<input type="hidden" value="0" id="cps" name="cps"> 

<input type="hidden" value="0" id="col" name="col">
<div id="mensaje2"></div>
<section id="form"><!--Seccion para formulario -->
		<div class="container"><!--Contenedor-->
			<div class="row"><!--Row-->
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--Formulario de Contacto-->
						<h2>Estar en Contacto</h2>
						<form id="formularioC" class="contact-form row" name="formularioC" >
				            <div class="form-group col-md-10">
				                <input type="text" name="name" class="form-control" required="required" placeholder="Nombre">
				            </div>
				            <div class="form-group col-md-10">
				                <input type="email" name="email" class="form-control" required="required" placeholder="Email">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control" required="required" placeholder="Subject">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Escriba su Mensaje Aqui"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Enviar">
				            </div>
				        </form>
					</div><!--/Fin Formulario de Contacto -->
				</div>

				<div class="col-sm-4"><!--Div para Informacion-->
	    			<div class="contact-info">
	    				<h2 class="title text-center">Contact Info</h2>
	    				<address>
	    					<p>E-Shopper Inc.</p>
							<p>935 W. Webster Ave New Streets Chicago, IL 60614, NY</p>
							<p>Newyork USA</p>
							<p>Mobile: +2346 17 38 93</p>
							<p>Fax: 1-714-252-0026</p>
							<p>Email: info@e-shopper.com</p>
	    				</address>
	    				<div class="social-networks"><!--Div para Redes Sociales-->
	    					<h2 class="title text-center">Social Networking</h2>
							<ul>
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-google-plus"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-youtube"></i></a>
								</li>
							</ul>
	    				</div><!--/Fin div Redes sociales-->
	    			</div>
    			</div><!--/Fin div Informacion--> 

			</div><!--/Fin Row-->
		</div><!--/Fin Contenedor-->
	</section><!--/Fin seccion de formulario-->