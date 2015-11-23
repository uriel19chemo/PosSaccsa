<input type="hidden" value="<?php echo @$departamento[0]->id; ?>" id="id" name="id"> 

<input type="hidden" name="suc" id="suc" value="<?php echo @$departamento[0]->id_sucursal; ?>">

<script type="text/javascript">

  var baseurl = "<?php echo base_url(); ?>";

 var id_sucursal  = 0;
 
 var ids           = document.getElementById("id").value;

  ids               = parseInt(ids.length);
  
  if(ids==0){

    id_sucursal = 0;

  }else{

    id_sucursal     = document.getElementById("suc").value;

  }

  function regresar(){

    window.location="<?php echo base_url()?>departamento";

  }

</script>

<?php

//Descripcion

  $Descripcion       = array(

  'name'        => 'descripcion',

  'id'          => 'descripcion',

  'size'        => 50,

  'value'       => set_value('descripcion',@$departamento[0]->descripcion),

  'type'        => 'text',

  'class'       => 'form-control',

  'style'       => 'text-transform:uppercase',

  'onkeypress'  => 'return validarn(event);',

  );



  $Estatus        = array(

  '0'             => '---Elegir Opción---',

  '1'             => 'Activo',

  '2'             => 'Inactivo',

  );

?>

<script src="<?php echo base_url();?>js/JsonDepartamento.js"></script>

<h1 class="page-header"><span class="glyphicon glyphicon-th-list"></span> <?php echo $titulo; ?></h1>

<div id="mensaje"></div>

<form class="form-horizontal" name="formulario" id="formulario" role="form">

  <div class="form-group">

    <label for="Descripcion" class="col-lg-3 control-label">Descripcion:</label>

    <div class="col-lg-3">

      <?php echo form_input($Descripcion); ?>

    </div>

  </div>
    
    
 <div class="form-group">

    <label for="sucursal" class="col-lg-3 control-label">Sucursal:</label>

    <div class="col-lg-3">

      <select name="sucursal" id="sucursal" class="form-control"></select>

    </div>

</div>


    <div class="form-group"><!--Div de Estatus-->

    <label for="unidadmedida" class="col-lg-3 control-label">Estatus:</label>

    <div class="col-lg-3">

      <?php echo  form_dropdown('estatus', $Estatus, set_value('estatus',@$departamento[0]->estatus),'class="form-control" id="estatus"'); ?>

    </div>

  </div><!--/Div estatus-->



  <div class="form-group">

    <div class="col-lg-offset-3 col-lg-10">

      <button type="button" onclick="regresar()" class="btn btn-default">Regresar</button>

      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Guardar Departamento</button>

      <?php if($titulo=="Nuevo Departamento"){ ?>

      <button type="reset" class="btn btn-default">Nuevo</button>

      <?php } ?>

    </div>

  </div>

  <hr/>

</form>		

<script type="text/javascript">

  
</script>

