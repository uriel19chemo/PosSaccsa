<input type="hidden" value="<?php echo @$pedido[0]->ID; ?>" id="id" name="id"> 

<script type="text/javascript">

  var baseurl = "<?php echo base_url(); ?>";

 

  function regresar(){

    window.location="<?php echo base_url()?>login";

  }

</script>

<?php

//

  $Tipo         = array(

  'name'        => 'tipo',

  'id'          => 'tipo',

  'size'        => 50,

  'value'       => set_value('tipo',@$pedido[0]->TIPO),

  'type'        => 'text',

  'class'       => 'form-control',

  'style'       => 'text-transform:uppercase',

  'onkeypress'  => 'return validarn(event);',

  );
  
  $Id         = array(

  'name'        => 'id',

  'id'          => 'id',

  'size'        => 50,

  'value'       => set_value('id',@$pedido[0]->ID),

  'type'        => 'text',

  'class'       => 'form-control',

  'style'       => 'text-transform:uppercase',

  'onkeypress'  => 'return validarNumeros(event);',

  );

  $Fecha         = array(

  'name'        => 'fecha',

  'id'          => 'fecha',

  'size'        => 50,

  'value'       => set_value('fecha',@$pedido[0]->FECHA),

  'type'        => 'text',

  'class'       => 'form-control',

  'style'       => 'text-transform:uppercase',

  'onkeypress'  => 'return validarNumeros(event);',

  );
  
  $Cliente        = array(

  'name'        => 'cliente',

  'id'          => 'cliente',

  'size'        => 50,

  'value'       => set_value('cliente',@$pedido[0]->CLIENTE),

  'type'        => 'text',

  'class'       => 'form-control',

  'style'       => 'text-transform:uppercase',

  'onkeypress'  => 'return validarn(event);',

  );
  
  $Total        = array(

  'name'        => 'total',

  'id'          => 'total',

  'size'        => 50,

  'value'       => set_value('total',@$pedido[0]->TOTAL),

  'type'        => 'text',

  'class'       => 'form-control',

  'style'       => 'text-transform:uppercase',

  'onkeypress'  => 'return validarn(event);',

  );

  $Estatus        = array(

  '0'             => '---Elegir Opción---',

  '1'             => 'Entregado',

  '2'             => 'Pendiente',

  );

?>

<script src="<?php echo base_url();?>js/JsonPedido.js"></script>

<h1 class="page-header"><span class="glyphicon glyphicon-th-list"></span> <?php echo $titulo; ?></h1>

<div id="mensaje"></div>

<form class="form-horizontal" name="formulario" id="formulario" role="form">

  <div class="form-group">

    <label for="Tipo" class="col-lg-3 control-label">Tipo:</label>

    <div class="col-lg-3">

      <?php echo form_input($Tipo); ?>

    </div>

  </div>
    
    
   <div class="form-group">

    <label for="Id" class="col-lg-3 control-label">Numero:</label>

    <div class="col-lg-3">

      <?php echo form_input($Id); ?>

    </div>

  </div> 
    
    
   <div class="form-group">

    <label for="Fecha" class="col-lg-3 control-label">Fecha:</label>

    <div class="col-lg-3">

      <?php echo form_input($Fecha); ?>

    </div>

  </div> 
    
    
  <div class="form-group">

    <label for="Cliente" class="col-lg-3 control-label">Cliente:</label>

    <div class="col-lg-3">

      <?php echo form_input($Cliente); ?>

    </div>

  </div> 
    
      
  <div class="form-group">

    <label for="Total" class="col-lg-3 control-label">Total:</label>

    <div class="col-lg-3">

      <?php echo form_input($Total); ?>

    </div>

  </div>  


    <div class="form-group"><!--Div de Estatus-->

    <label for="unidadmedida" class="col-lg-3 control-label">Estatus:</label>

    <div class="col-lg-3">

      <?php echo  form_dropdown('estatus', $Estatus, set_value('estatus',@$pedido[0]->ESTATUS),'class="form-control" id="estatus"'); ?>

    </div>

  </div><!--/Div estatus-->



  <div class="form-group">

    <div class="col-lg-offset-3 col-lg-10">

      <button type="button" onclick="regresar()" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span>Regresar</button>
      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Guardar Pedido</button>
      
      <!--Se inhabilita boton de nuevo pedido-->
      <?php //if($titulo=="Nuevo Pedido"){ ?>
      <!--<button type="reset" class="btn btn-default">Nuevo</button>-->
      <?php //} ?>

    </div>

  </div>

  <hr/>

</form>		

<script type="text/javascript">

  
</script>

