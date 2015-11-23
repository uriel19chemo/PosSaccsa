<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="POS(Punto de venta)">
    <meta name="author" content="Uriel López Vargas">
    <link rel="icon" type="image/<?php echo EXTENSION_IMAGEN_FAVICON; ?>" href="<?php echo base_url()?>img/<?php echo NOMBRE_IMAGEN_FAVICON; ?>" />
    <title><?php echo TITULO_PAGINA; ?></title><!--Impresion del ditulo mediante variable del controlador-->
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url()?>css/bootstrap.min.css" rel="stylesheet"><!--Uso de la funcion de helper para url base_url()-->
    <!-- Custom styles for this template -->
    <script type="text/javascript" src="<?php echo base_url()?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/JsValidacion.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/treeMenu.js"></script> 
    <link href="<?php echo base_url()?>css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/menu.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/Tablas.css">
    <link rel="stylesheet" href="<?php echo base_url()?>css/iconos/css/font-awesome.min.css"><!--Iconos Grandes-->
    <link rel="stylesheet" href="<?php echo base_url()?>css/iconos/font-awesome/css/font-awesome.css"><!--Iconos Pequeños Menu-->
    <link rel="stylesheet" href="<?php echo base_url()?>css/jquery-ui.css"> 
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Menus</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url()?>login"><?php echo NOMBRE_EMPRESA; ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a><?php echo 'Bienvenido: <strong>'.$this->session->userdata('NOMBRE').' '.$this->session->userdata('APELLIDOS').'</strong>&nbsp;|&nbsp;';
              echo 'Tipo Usuario: <strong>'.$this->session->userdata('TIPOUSUARIOMS').'</strong>&nbsp;|&nbsp;';
             ?></a></li>
            <!--<li><a href="">Mis Datos</a></li>-->
             <li><a href="<?php echo base_url().'login/CerrarSesion'; ?>">Salir</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid"><!--Div Container-->
      <div class="row"><!--Div Row-->
        <div class="col-sm-3 col-md-2 sidebar" style=background:#000000;>

        <?php
    if($this->session->userdata('TIPOUSUARIOMS')=='Administrador'){//Checamos el tipo de usuario para generar su panel de control
        echo '<div id="treeMenu">';
        echo '<br/>';
        echo '<h2>Menú Principal</h2>';
        echo '<hr/><!--Inter lineado para menu-->';
            echo '<ul><!--Lista de Menu-->';
                echo '<li>';
                echo 'Catalogos<span></span>';
                echo '<div>';
                    echo '<ul>';
                        echo '<li><a href="'.base_url().'clientes"> <i class="icon-group"></i>&nbsp;Clientes</a></li>';
                        echo '<li><a href="'.base_url().'sucursal"> <i class="icon-building"></i>&nbsp;Sucursales</a></li>';
                        echo '<li><a href="'.base_url().'departamento"> <i class="icon-columns"></i>&nbsp;Departamentos</a></li>';
                        echo '<li><a href="'.base_url().'categorias"> <i class="icon-tags"></i>&nbsp;Categorias</a></li>';
                        echo '<li><a href="'.base_url().'proveedores"> <i class="icon-suitcase"></i>&nbsp;Proveedores</a></li>';
                        echo '<li><a href="'.base_url().'productos"> <i class="icon-barcode"></i>&nbsp;Productos</a></li>';
                        echo '<li><a href="'.base_url().'usuarios"> <i class="icon-user"></i>&nbsp;Usuarios</a></li>';
                    echo '</ul>';
                echo '</div>';
                echo '</li>';
            
                echo '<li>';
                echo 'Ventas<span></span>';
                echo '<div>';
                    echo '<ul>';
                        echo '<li><a href="'.base_url().'ventas"> <i class="icon-shopping-cart"></i>&nbsp;Nueva Venta</a></li>';
                    echo '</ul>';
                echo '</div>';
                echo '</li>'; 
            
                echo '<li>';
                echo 'Compras<span></span>';
                echo '<div>';
                    echo '<ul>';
                        echo '<li><a href="'.base_url().'ordencompra"> <i class="fa fa-cart-plus"></i>&nbsp;Orden de Compras</a></li>';
                    echo '</ul>';
                echo '</div>';
                echo '</li>';
            
                echo '<li>';
                echo 'Reportes<span></span>';
                echo '<div>';
                    echo '<ul>';
                        echo '<li><a href="'.base_url().'reportes"> <i class="fa fa-file-text-o"></i>&nbsp;Reporte de Movimientos</a></li>';
                    echo '</ul>';
                echo '</div>';
                echo '</li>';
            
                echo '<li>';
                echo 'Respaldo<span></span>';
                echo '<div>';
                    echo '<ul>';
                        echo '<li><a href="'.base_url().'backup/backupBD"> <i class="fa fa-database"></i>&nbsp;Generar Backup</a></li>';
                    echo '</ul>';
                echo '</div>';
                echo '</li>';
            echo '</ul><!--/Fin Lista de Menu-->';
            echo '<br/>';
        echo '</div>';
        }else {
//MENU DE VENDEDOR 
            echo '<div id="treeMenu">';
            echo '<br/>';
            echo '<h2>Menú Principal</h2>';
            echo '<hr/><!--Inter lineado para menu-->';
                echo '<ul><!--Lista de Menu-->';
                    echo '<li>';
                    echo 'Catalogos<span></span>';
                    echo '<div>';
                        echo '<ul>';
                            echo '<li><a href="'.base_url().'productos"> <i class="icon-barcode"></i>&nbsp;Productos</a></li>';
                            echo '<li><a href="'.base_url().'clientes"> <i class="icon-group"></i>&nbsp;Clientes</a></li>';
                            echo '<li><a href="'.base_url().'proveedores"> <i class="icon-suitcase"></i>&nbsp;Proveedores</a></li>';
                            echo '<li><a href="'.base_url().'categorias"> <i class="icon-tags"></i>&nbsp;Categorias</a></li>';
                        echo '</ul>';
                    echo '</div>';
                    echo '</li>';
                    
                    echo '<li>';
                    echo 'Ventas<span></span>';
                    echo '<div>';
                        echo '<ul>';
                            echo '<li><a href="'.base_url().'ventas"> <i class="icon-shopping-cart"></i>&nbsp;Nueva Venta</a></li>';
                        echo '</ul>';
                    echo '</div>';
                    echo '</li>'; 
                    
                    echo '<li>';
                    echo 'Reportes<span></span>';
                    echo '<div>';
                        echo '<ul>';
                            echo '<li><a href="'.base_url().'reportes"> <i class="fa fa-file-text-o"></i>&nbsp;Reporte de Movimientos</a></li>';
                        echo '</ul>';
                    echo '</div>';
                    echo '</li>';
                    
                echo '</ul><!--/Fin Lista de Menu-->';
                echo '<br/>';
            echo '</div>';
        }
?>    
    
        </div>
        <div class="col-md-offset-2 main">
        <br/><br/>
    