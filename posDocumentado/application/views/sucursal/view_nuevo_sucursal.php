<input type="hidden" value="<?php echo @$sucursal[0]->id; ?>" id="id" name="id"> 

<script type="text/javascript">

  var baseurl = "<?php echo base_url(); ?>";

 

  function regresar(){

    window.location="<?php echo base_url()?>sucursal";

  }

</script>

<?php

//Nombre

  $Descripcion      = array(

  'name'        => 'descripcion',

  'id'          => 'descripcion',

  'size'        => 50,

  'value'       => set_value('descripcion',@$sucursal[0]->descripcion),

  'type'        => 'text',

  'class'       => 'form-control',

  'style'       => 'text-transform:uppercase',

  'onkeypress'  => 'return validarn(event);',

  );

//Calle_numero

  $CalleNumero       = array(

  'name'        => 'calleNumero',

  'id'          => 'calleNumero',

  'size'        => 50,

  'value'       => set_value('calleNumero',@$sucursal[0]->calleNumero),

  'type'        => 'alpha_numeric',

  'class'       => 'form-control',

  'style'       => 'text-transform:uppercase',
  
  'onkeypress'  => 'return validarn(event);',

  );
  //Colonia

  $Colonia       = array(

  'name'        => 'colonia',

  'id'          => 'colonia',

  'size'        => 50,

  'value'       => set_value('colonia',@$sucursal[0]->colonia),

  'type'        => 'text',

  'class'       => 'form-control',

  'style'       => 'text-transform:uppercase',

  'onkeypress'  => 'return validarn(event);',

  );
  //Estado

  $Estado       = array(

  'name'        => 'estado',

  'id'          => 'estado',

  'size'        => 50,

  'value'       => set_value('estado',@$sucursal[0]->estado),

  'type'        => 'text',

  'class'       => 'form-control',

  'style'       => 'text-transform:uppercase',

  'onkeypress'  => 'return validarn(event);',

  );
  //Ciudad

  $Ciudad       = array(

  'name'        => 'ciudad',

  'id'          => 'ciudad',

  'size'        => 50,

  'value'       => set_value('ciudad',@$sucursal[0]->ciudad),

  'type'        => 'text',

  'class'       => 'form-control',

  'style'       => 'text-transform:uppercase',

  'onkeypress'  => 'return validarn(event);',

  );
  //Municipio

  $Municipio       = array(

  'name'        => 'municipio',

  'id'          => 'municipio',

  'size'        => 50,

  'value'       => set_value('municipio',@$sucursal[0]->municipio),

  'type'        => 'text',

  'class'       => 'form-control',

  'style'       => 'text-transform:uppercase',

  'onkeypress'  => 'return validarn(event);',

  );
  //Codigo postal
  $Cp           = array(

  'name'        => 'cp',

  'id'          => 'cp',

  'size'        => 50,

  'value'       => set_value('cp',@$sucursal[0]->cp),

  'type'        => 'text',

  'class'       => 'form-control',

  'onkeypress'  => 'return validarNumeros(event);',

  );

  //Telefono
  
  $Telefono       = array(

  'name'        => 'telefono',

  'id'          => 'telefono',

  'size'        => 50,

  'value'       => set_value('telefono',@$sucursal[0]->telefono),

  'type'        => 'numeric',

  'class'       => 'form-control',

  'onkeypress'  => 'return validarNumeros(event);',

  );

  $Estatus        = array(

  '0'             => '---Elegir Opción---',

  '1'             => 'Activo',

  '2'             => 'Inactivo',

  );

?>

<script src="<?php echo base_url();?>js/JsonSucursal.js"></script>

<h1 class="page-header"><span class="glyphicon glyphicon-th-list"></span> <?php echo $titulo; ?></h1>

<div id="mensaje"></div>

<form class="form-horizontal" name="formulario" id="formulario" role="form">

  <div class="form-group">

    <label for="Descripcion" class="col-lg-3 control-label">Nombre:</label>

    <div class="col-lg-3">

      <?php echo form_input($Descripcion); ?>

    </div>

  </div>
  
    
<div class="form-group">  

  <label for="CalleNumero" class="col-lg-3 control-label">Calle y Numero:</label>

    <div class="col-lg-3">

      <?php echo form_input($CalleNumero); ?>

    </div>
  
</div>
    
  
    <div class="form-group">

    <label for="Colonia" class="col-lg-3 control-label">Colonia:</label>

    <div class="col-lg-3">

      <select name="colonia" id="colonia" class="form-control">
        <option value='0'>Elige Colonia...</option>
      </select>

    </div>

  </div>
    
    
    <div class="form-group">  

  <label for="Estado" class="col-lg-3 control-label">Estado:</label>

    <div class="col-lg-3">

      <?php echo form_input($Estado); ?>

    </div>
  
  </div>
    
    
  <div class="form-group">  

  <label for="Ciudad" class="col-lg-3 control-label">Ciudad:</label>

    <div class="col-lg-3">

      <?php echo form_input($Ciudad); ?>

    </div>
  
  </div>
    
   
<div class="form-group">
  
<label for="Municipio" class="col-lg-3 control-label">Municipio:</label>

    <div class="col-lg-3">

      <?php echo form_input($Municipio); ?>

    </div>
    
</div>   
    
    
<div class="form-group">

  <label for="cp" class="col-lg-3 control-label">Codigo Postal:</label>

    <div class="col-lg-3">

      <?php echo form_input($Cp); ?>

    </div>
  
</div>
    
    
<div class="form-group">
    
  <label for="Telefono" class="col-lg-3 control-label">Telefono:</label>

    <div class="col-lg-3">

      <?php echo form_input($Telefono); ?>

    </div>
  
  </div>

    <div class="form-group"><!--Div de Estatus-->

    <label for="unidadmedida" class="col-lg-3 control-label">Estatus:</label>

    <div class="col-lg-3">

      <?php echo  form_dropdown('estatus', $Estatus, set_value('estatus',@$sucursal[0]->estatus),'class="form-control" id="estatus"'); ?>

    </div>

  </div><!--/Div estatus-->

  <div class="form-group">

    <div class="col-lg-offset-3 col-lg-10">

      <button type="button" onclick="regresar()" class="btn btn-default">Regresar</button>

      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Guardar Sucursal</button>

      <?php if($titulo=="Nueva Sucursal"){ ?>

      <button type="reset" class="btn btn-default">Nuevo</button>

      <?php } ?>

    </div>

  </div>

  <hr/>

</form>		

<script type="text/javascript">

  
</script>

