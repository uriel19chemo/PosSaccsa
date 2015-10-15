<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/panel-style.css">
<link rel="stylesheet" href="<?php echo base_url()?>css/iconos/font-awesome/css/font-awesome.css">
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
    echo '<button type="submit" >';	
	echo anchor('pdf/exportarUsuarios', 'Reporte PDF usuarios', ' target="_blank" class=""'); 
    echo '</button>';
?>
<br>
<?php	
    echo '<button type="submit" >';	
	echo anchor('excel', 'Reporte Excel Usuarios', ' target="_blank" class=""'); 
    echo '</button>';
?>
<!--/FIN Reportes PDF-->

<center><br/>
<img src="<?php echo base_url()?>img/logophpU.jpg" />
<br/>
<a>TSU: Uriel López Vargas</a>
<br/><br/><br/>

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






