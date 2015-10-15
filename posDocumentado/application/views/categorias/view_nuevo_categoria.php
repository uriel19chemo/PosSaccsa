<input type="hidden" value="<?php echo @$categoria[0]->id; ?>" id="id" name="id"> <!--Generar id --><!--Script para regresar a la lista de categorias-->
<script type="text/javascript">
  var baseurl = "<?php echo base_url(); ?>";
 
  function regresar(){
    window.location="<?php echo base_url()?>categorias";
  }
</script><!--Reglas de formulario-->
<?php
//Nombre
  $Nombre       = array(
  'name'        => 'descripcion',
  'id'          => 'descripcion',
  'size'        => 50,
  'value'       => set_value('descripcion',@$categoria[0]->descripcion),
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
?><!--Llamado a script categorias-->
<script src="<?php echo base_url();?>js/JsonCategorias.js"></script><!--Titulo de la vista-->
<h1 class="page-header"><span class="glyphicon glyphicon-th-list"></span> <?php echo $titulo; ?></h1>
<div id="mensaje"></div>
<form class="form-horizontal" name="formulario" id="formulario" role="form"><!--Formulario de nueva Categoria-->
  <div class="form-group"><!--Div de nombre-->
    <label for="Nombre" class="col-lg-3 control-label">Categoria:</label>
    <div class="col-lg-3">
      <?php echo form_input($Nombre); ?>
    </div>
  </div><!--/Div Nombre-->
  

    <div class="form-group"><!--Div de Estatus-->
    <label for="unidadmedida" class="col-lg-3 control-label">Estatus:</label>
    <div class="col-lg-3">
      <?php echo  form_dropdown('estatus', $Estatus, set_value('estatus',@$categoria[0]->estatus),'class="form-control" id="estatus"'); ?>
    </div>
  </div><!--/Div estatus-->

 
  <div class="form-group"><!--Div para botones de accion de la vista Categoria-->
    <div class="col-lg-offset-3 col-lg-10">
      <button type="button" onclick="regresar()" class="btn btn-default">Regresar</button>
      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Guardar Categoria</button>
      <?php if($titulo=="Nuevo Categoria"){ ?>
      <button type="reset" class="btn btn-default">Nuevo</button>
      <?php } ?>
    </div>
  </div><!--/Termia Div de botones de Categoria-->
  <hr/>
</form><!-- /Termina Formulario de nueva Categoria-->
<script type="text/javascript">
  
</script>
