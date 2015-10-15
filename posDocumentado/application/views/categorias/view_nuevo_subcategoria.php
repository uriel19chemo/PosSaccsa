<input type="hidden" value="<?php echo @$subcategoria[0]->id; ?>" id="id" name="id"> <!--Generar id -->
<input type="hidden" value="<?php echo @$subcategoria[0]->id_categoria; ?>" id="idcategoria" name="idcategoria"> <!--Generar id de categoria--><!--Script para regresar a la lista de Subcategorias-->
<script type="text/javascript">
  var baseurl = "<?php echo base_url(); ?>";
 
  function regresar(){
    window.location="<?php echo base_url()?>categorias/Subcategoria/<?php echo base64_encode($id);?>/<?php echo base64_encode($desc);?>";
  }
  var id_subcat     = 0;
  var ids           = document.getElementById("id").value;
  ids               = parseInt(ids.length);
  if(ids==0){
    id_subcat     = 0;
  }else{
    id_subcat        = document.getElementById("idcategoria").value;
  }
</script><!--Reglas de formulario-->
<?php
//Nombre
  $SubCategoria = array(
  'name'        => 'descripcion',
  'id'          => 'descripcion',
  'size'        => 50,
  'value'       => set_value('descripcion',@$subcategoria[0]->descripcion),
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
?><!--Script para llamar a script de categorias-->
<script src="<?php echo base_url();?>js/JsonCategorias.js"></script><!--Titulo de la vista-->
<h1 class="page-header"><span class="glyphicon glyphicon-th-list"></span> <?php echo $titulo; ?></h1>
<div id="mensaje"></div>
<form class="form-horizontal" name="formulario2" id="formulario2" role="form"><!--Formulario de nueva subCategoria-->

  <div class="form-group"><!--Div de categoria -->
    <label for="categoria" class="col-lg-3 control-label">Categoria:</label>
    <div class="col-lg-3">
      <select name="categoria" id="categoria" class="form-control"></select>
    </div>
  </div><!--/ Termina Div de categoria -->

  <div class="form-group"><!--Div de Subcategoria -->
    <label for="SubCategoria" class="col-lg-3 control-label">SubCategoria:</label>
    <div class="col-lg-3">
      <?php echo form_input($SubCategoria); ?>
    </div>
  </div><!--/Termina Div de Subcategoria -->
  

    <div class="form-group"><!--Div de estatus -->
    <label for="unidadmedida" class="col-lg-3 control-label">Estatus:</label>
    <div class="col-lg-3">
      <?php echo  form_dropdown('estatus', $Estatus, set_value('estatus',@$subcategoria[0]->estatus),'class="form-control" id="estatus"'); ?>
    </div>
  </div><!--/ Termina Div de estatus -->

 
  <div class="form-group"><!--Div para botones de accion de la vista SubCategoria-->
    <div class="col-lg-offset-3 col-lg-10">
      <button type="button" onclick="regresar()" class="btn btn-default">Regresar</button>
      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-saved"></span> Guardar SubCategoria</button>
      <?php if($titulo=="Nuevo Sub Categoria"){ ?>
      <button type="reset" class="btn btn-default">Nuevo</button>
      <?php } ?>
    </div>
  </div><!--/Termia Div de botones de SubCategoria-->
  <hr/>
</form><!--/Termia formulario subCategoria-->		
<script type="text/javascript">
  
</script>
