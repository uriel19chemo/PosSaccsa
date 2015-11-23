<style type="text/css">
th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
</style>
<script type="text/javascript">
var baseurl = "<?php echo base_url(); ?>";
var currentLocation = window.location;
function EliminarUsuario(Usuario, id){    
    confirmar=confirm("Eliminar a " + Usuario + ", Recuerda Una vez Eliminado No podras Recuperarlo"); 

    if (confirmar){
    	document.getElementById('mensaje').innerHTML = "<div class='modal1'><div class='center1'> <center> <img src='"+ baseurl +"/img/gif-load.gif'> Eliminando Usuario...</center></div></div>";
    	 var Usuario 		 = new Object();
		Usuario.Id      	 = id;
		var DatosJson = JSON.stringify(Usuario);
		$.post(currentLocation + '/Deleteuser',
		{ 
			MiUsuario: DatosJson
		},
		function(data, textStatus) {
			//
			$("#mensaje").html(data.error_msg);
		}, 
		"json"		
		);
    } else{
    } 
  }
  
</script>
<h1 class="page-header"><span class="glyphicon glyphicon-list-alt"></span> Catalogo Usuarios</h1>
<div id="mensaje"></div>
<p align="right">
 	 <a href="usuarios/nuevo">
 	 	<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Nuevo Usuario</button>
 	 </a>  
 	 </p>
 	 <br/>
	<table id="usuarios" border="0" cellpadding="0" cellspacing="0" width="100%" class="pretty" >
		<thead> <!--Cabezera de tabla-->
                    <!--/ Reportes PDF y EXCEL-->
                    <tr>
                        <th>
                            <?php	
                                echo '<button type="button" title="Reporte en PDF" class="btn btn-default btn-xs" > ';
	                        echo anchor('pdf/exportarUsuarios', '<span class="fa fa-file-pdf-o"></span>', ' target="_blank" class=""'); 
                                echo '</button>';
                            ?>
                                
                            <?php	
                                echo '<button type="button" title="Reporte en Excel" class="btn btn-default btn-xs" >';	
	                        echo anchor('excel/exportarUsuariosE', '<span class="fa fa-file-excel-o"></span>', ' target="_blank" class=""'); 
                                echo '</button>';
                            ?>
                        </th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <!--/FIN Reportes PDF Y EXCEL--> 
                    
                    <!--Nombre de columnas-->   
		    <tr>
		        <th></th>
		        <th>Nombre</th>
			<th>Email</th>
			<th>Tipo Usuario</th>
			<th>Fecha Registro</th>
	            </tr>
                    <!--/Fin Nombre de columnas-->
		</thead><!--Termina cabezera de tabla-->
		<tbody>
			<?php
				if($usuarios){
					foreach($usuarios as $usuario){
						$idusuario     = base64_encode($usuario->ID);
						echo '<tr>';
						echo '<td>';
                                                echo '<a href="usuarios/Editar/'.$idusuario.'"><button type="button" title="Editar Usuario" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a> &nbsp;';
						//echo '<a href=""><button type="button" title="Editar Usuario" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-edit"></span></button></a> &nbsp;';
						?>
                                                <button type="button" onclick="EliminarUsuario('<?php echo $usuario->NOMBRE; ?>','<?php echo $idusuario; ?>');" title="Eliminar Usuario" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
						<!--<button type="button"  title="Eliminar Usuario" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button>-->
						<?php
						echo '</td>';
						echo '<td>'.$usuario->NOMBRE.' '.$usuario->APELLIDOS.'</td>';
						echo '<td>'.$usuario->EMAIL.'</td>';
						echo '<td>';
						if($usuario->TIPO==1){
							echo "Administrador";
						}else{
							echo "Vendedor";
						}
						echo '</td>';
						echo '<td>'.$usuario->FECHA_REGISTRO.'</td>';
						echo '</tr>';
					}
				}else{
					echo '<tr><td colspan=5><center>No Existe Informacion</center></td></tr>';
				}
			?>
		</tbody>
	</table>
         
         
<script type="text/javascript">

            $(document).ready(function() {
    $('#usuarios').dataTable( {
        "scrollX": false
    } );
} );

</script>
			