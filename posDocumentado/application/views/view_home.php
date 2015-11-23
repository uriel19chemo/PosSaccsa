<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/panel-style.css">
<link rel="stylesheet" href="<?php echo base_url()?>css/iconos/font-awesome/css/font-awesome.css">
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/dist/jquery.jqplot.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/dist/jquery.jqplot.min.css" />

<script type="text/javascript" src="<?php echo base_url();?>js/dist/plugins/jqplot.pieRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/dist/plugins/jqplot.donutRenderer.min.js"></script>
<h1 class="page-header"><i class="icon-dashboard"></i> Bienvenido al Sistema de Administración</h1>

<br/>
<!--Cajas de accion-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
            <!--<li class="bg_ls"> <a href="<?php echo base_url()?>index.php/ventas"><i class="icon-shopping-cart"></i> Ventas</a></li>-->
            <li class="bg_lb"> <a href="<?php echo base_url()?>clientes"> <i class="icon-group"></i> Clientes</a> </li>
            <li class="bg_lg"> <a href="<?php echo base_url()?>productos"> <i class="icon-barcode"></i> Productos</a> </li>
            <li class="bg_ly"> <a href="<?php echo base_url()?>proveedores"> <i class="icon-suitcase"></i> Proveedores</a> </li>
            <li class="bg_lo"> <a href="<?php echo base_url()?>categorias"> <i class="icon-tags"></i> Categorias</a> </li>
            <li class="bg_ls"> <a href="<?php echo base_url()?>ventas"><i class="icon-shopping-cart"></i> Ventas</a></li>
           
      </ul>
    </div>
  </div>  
<!--/Fin Cajas de Accion-->

<!--Reportes PDF-->
<?php	
/*
    echo '<button type="submit" >';	
	echo anchor('pdf/exportarUsuarios', 'Reporte PDF usuarios', ' target="_blank" class=""'); 
    echo '</button>';
?>
<br>
<?php	
    echo '<button type="submit" >';	
	echo anchor('excel/exportarUsuariosE', 'Reporte Excel Usuarios', ' target="_blank" class=""'); 
    echo '</button>';
 
 */
?>
<!--/FIN Reportes PDF-->

<center><br/>
<img src="<?php echo base_url()?>img/logophpU.jpg" />
<br/>
<a>TSU: Uriel López Vargas</a>
<br/><br/><br/><!--Saltos de linea-->

<!--Division de stock minimo de productos-->

<div class="span12">
        
        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Productos Con Stock Mínimo</h5></div>
            <div class="widget-content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Precio de Venta</th>
                            <th>Cantidad</th>
                            <th>Stock Mínimo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        if($productos != null){
                            
                            foreach ($productos as $producto) {
                                
                                echo '<tr>';
                                echo '<td>'.$producto->id.'</td>';
                                echo '<td>'.$producto->descripcion.'</td>';
                                echo '<td>$ '.$producto->precio_venta.'</td>';
                                echo '<td>'.$producto->cantidad.'</td>';
                                echo '<td>'.$producto->stock.'</td>';
                                echo '<td>';
                                    //echo '<a href="'.base_url().'productos/editarProducto/'.$producto->id.'" class="btn btn-success"> <i class="icon-pencil" ></i> </a>  ';
                                    echo '<a href="'.base_url().'ordencompra" class="btn btn-success"> <i class="fa fa-cart-plus"></i></a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                        }
                        else{
                            echo '<tr><td colspan="3">No hay productos con Stock Mínimo.</td></tr>';
                        }    

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!--/Fin division de stock minimo de productos-->

<br><br><!--Saltos de linea-->

<!--Division de pedidos -->
<div class="span12" style="margin-left: 0">
        
        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Pedidos de Productos Pendientes</h5></div>
            <div class="widget-content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha Inicial</th>
                            <th>Fecha Final</th>
                            <th>Cliente</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if($documentos != null){
                            foreach ($documentos as $o) {
                                $id     = base64_encode($o->ID);
                                echo '<tr>';
                                echo '<td>'.$o->ID.'</td>';
                                echo '<td>'.date('d/m/Y' ,strtotime($o->FECHA)).'</td>';
                                echo '<td>'.date('d/m/Y' ,strtotime($o->FECHA)).'</td>';
                                echo '<td>'.$o->CLIENTE.'</td>';
                                echo '<td>';
                                
                                    //echo '<a href="'.base_url().'index.php/os/visualizar/'.$o->ID.'" class="btn"> <i class="icon-eye-open" ></i> </a> '; 
                                    //echo '<a href="'.base_url().'login/" class="btn"> <i class="icon-eye-open" ></i> </a> '; 
                                    echo '<a href="pedidos/editarPedido/'.$id.'"><button type="button" title="Editar Pedido" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a> &nbsp;';
                                    
                                echo '</td>';
                                echo '</tr>';
                            }
                        }
                        else{
                            echo '<tr><td colspan="3">Ningun Servicio de pedido pendiente.</td></tr>';
                        }    

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!--/Fin division de pedidos-->

<br><br><!--Saltos de linea-->

<!--Division de Estadisticas de servicio-->
<?php if($documentos2 != null){ ?>
<div class="row-fluid" style="margin-top: 0">

    <div class="span12">
        
        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Estatísticas de Pedidos</h5></div>
            <div class="widget-content">
                <div class="row-fluid">
                    <div class="span12">
                        <div id="chart-os" style="">
                        </div>
                    </div>
            
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!--Fin de division de estadisticas de servicio-->

<br><br><!--Saltos de linea-->

<!--Estadisticas del Sistemas-->
<div class="row-fluid" style="margin-top: 0">
    <div class="span12">      
        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Estadísticas del Sistema</h5></div>
            <div class="widget-content">
                <div class="row-fluid">           
                    <div class="span12">
                        <ul class="site-stats">
                            <li class="bg_lh"><i class="icon-group"></i> <strong><?php echo $this->db->count_all('clientes');?></strong> <small>Clientes</small></li>
                            <li class="bg_lh"><i class="icon-barcode"></i> <strong><?php echo $this->db->count_all('productos');?></strong> <small>Productos </small></li>
                            <li class="bg_lh"><i class="icon-suitcase"></i> <strong><?php echo $this->db->count_all('proveedores');?></strong> <small>Proveedores</small></li>
                            <li class="bg_lh"><i class="icon-tags"></i> <strong><?php echo $this->db->count_all('categorias');?></strong> <small>Categorias </small></li>
                            <li class="bg_lh"><i class="icon-user"></i> <strong><?php echo $this->db->count_all('usuarios');?></strong> <small>Usuarios</small></li>
                            <li class="bg_lh"><i class="icon-check"></i> <strong><?php echo $this->db->count_all('partidas');?></strong> <small>Movimientos </small></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/Fin estadisticas del sistema-->
<br/><br/><br/>

<!--SCRIPT Para funcion de estadisticas de pedidos-->
<?php if($documentos2 != null) {?>
<script type="text/javascript">
    
    $(document).ready(function(){
      var data = [
        <?php foreach ($documentos2 as $o) {
            /*if($o->ESTATUS==1 || $o->ESTATUS==2){
                echo "['".$o->ESTATUS."', ".$o->total."],";
            }*/
            //Traemos solo los documentos del tipo pedido Entregados y Pendientes
            if($o->ESTATUS==1 || $o->ESTATUS==2){
                echo "['".$o->ESTATUS."', ".$o->total."],";
            } 
            //echo "['".$o->ESTATUS."', ".$o->total."],";
        } ?>
       
      ];
      var plot1 = jQuery.jqplot ('chart-os', [data], 
        { 
          seriesDefaults: {
            // Make this a pie chart.
            renderer: jQuery.jqplot.PieRenderer, 
            rendererOptions: {
              // Put data labels on the pie slices.
              // By default, labels show the percentage of the slice.
              showDataLabels: true
            }
          }, 
          legend: { show:true, location: 'e' }
        }
      );

    });
 
</script>

<?php } ?>



