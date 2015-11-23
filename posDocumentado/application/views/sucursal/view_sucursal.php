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

function EliminarSucursal(Sucursal, id){

    confirmar=confirm("Eliminar a " + Sucursal + " Recuerda Una vez Eliminado No podras Recuperarlo"); 

    if (confirmar){

    	document.getElementById('mensaje').innerHTML = "<div class='modal1'><div class='center1'> <center> <img src='"+ baseurl +"/img/gif-load.gif'> Eliminando Sucursal...</center></div></div>";

    	var Sucursal 		 = new Object();
	    Sucursal.Id      	 = id;  
        var DatosJson = JSON.stringify(Sucursal);
	$.post(currentLocation + '/DeleteSucursal',
	{ 
	    MiSucursal: DatosJson
	},
	function(data, textStatus) {

	    $("#mensaje").html(data.error_msg);

	}, 
       	
           "json"		
	);
    } else{

    } 
  }

</script>

<h1 class="page-header"><span class="glyphicon glyphicon-list-alt"></span> Catalogo de Sucursal</h1>

<div id="mensaje"></div>

<p align="right">

    <a href="sucursal/nuevo">
        <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Nuevo Sucursal</button>
    </a>  
</p>
<br/>

	<table id="sucursal" border="0" cellpadding="0" cellspacing="0" width="100%" class="pretty">
	    <thead>
	
            <!--/ Reportes PDF y EXCEL-->
                <tr>
                    <th>
                        <?php	
                            echo '<button type="button" title="Reporte en PDF" class="btn btn-default btn-xs" > ';
	                    echo anchor('pdf/exportarSucursales', '<span class="fa fa-file-pdf-o"></span>', ' target="_blank" class=""'); 
                            echo '</button>';
                        ?>
                                
                        <?php	
                            echo '<button type="button" title="Reporte en Excel" class="btn btn-default btn-xs" >';	
	                    echo anchor('excel/exportarSucursalesE', '<span class="fa fa-file-excel-o"></span>', ' target="_blank" class=""'); 
                            echo '</button>';
                        ?>
                    </th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            <!--/FIN Reportes PDF Y EXCEL-->
                
                <tr>
		    <th></th>
                    <th>Nombre</th>
		    <th>CalleNumero</th>
		    <th>Colonia</th>
                    <th>Estado</th>
		    <th>Ciudad</th>
		    <th>Municipio</th>
		    <th>Cp</th>
		    <th>Telefono</th>
		    <th>Estatus</th>
		</tr>
                
	    </thead>
	    <tbody>
		<?php
		    if($sucursal){
					
                        foreach($sucursal as $sucursal){
						
                            $idSucursal     = base64_encode($sucursal->id);
                            echo '<tr>';
			        echo '<td>';
				echo '<a href="sucursal/editarSucursal/'.$idSucursal.'"><button type="button" title="Editar Sucursal" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a> &nbsp;';
		?>

				<button type="button" onclick="EliminarSucursal('<?php echo $sucursal->calleNumero; ?>','<?php echo $idSucursal; ?>');" title="Eliminar Sucursal" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
		<?php
				echo '</td>';
                                echo '<td>'.$sucursal->descripcion.'</td>';
			        echo '<td>'.$sucursal->calleNumero.'</td>';
				echo '<td>'.$sucursal->colonia.'</td>';
                                echo '<td>'.$sucursal->estado.'</td>';
				echo '<td>'.$sucursal->ciudad.'</td>';
				echo '<td>'.$sucursal->municipio.'</td>';
				echo '<td>'.$sucursal->cp.'</td>';
				echo '<td>'.$sucursal->telefono.'</td>';			
                                echo '<td>'; 
				    if($sucursal->estatus==1){
					echo "Activo";
				    }else{
					echo "Inactivo";
				    }
                                echo '</td>';		
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

    $('#sucursal').dataTable( {

        "scrollX": false

    } );

} );

</script>			