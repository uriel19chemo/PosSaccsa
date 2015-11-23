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

function EliminarDepartamento(Departamento, id){

    confirmar=confirm("Eliminar a " + Departamento + " Recuerda Una vez Eliminado No podras Recuperarlo"); 

    if (confirmar){

    	document.getElementById('mensaje').innerHTML = "<div class='modal1'><div class='center1'> <center> <img src='"+ baseurl +"/img/gif-load.gif'> Eliminando Departamento...</center></div></div>";

    	var Departamento 		 = new Object();

	    Departamento.Id      	 = id;  

	var DatosJson = JSON.stringify(Departamento);

	    $.post(currentLocation + '/DeleteDepartamento',
	    { 
		MiDepartamento: DatosJson
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

<h1 class="page-header"><span class="glyphicon glyphicon-list-alt"></span> Catalogo de Departamento</h1>

<div id="mensaje"></div>

<p align="right">
    <a href="departamento/nuevo">
 	<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Nuevo Departamento</button>
    </a>  
</p>
<br/>

	<table id="departamento" border="0" cellpadding="0" cellspacing="0" width="100%" class="pretty">
	    <thead>
              
            <!--/ Reportes PDF y EXCEL-->
                <tr>
                    <th>
                        <?php	
                            echo '<button type="button" title="Reporte en PDF" class="btn btn-default btn-xs" > ';
	                    echo anchor('pdf/exportarDepartamentos', '<span class="fa fa-file-pdf-o"></span>', ' target="_blank" class=""'); 
                            echo '</button>';
                        ?>
                                
                        <?php	
                            echo '<button type="button" title="Reporte en Excel" class="btn btn-default btn-xs" >';	
	                    echo anchor('excel/exportarDepartamentosE', '<span class="fa fa-file-excel-o"></span>', ' target="_blank" class=""'); 
                            echo '</button>';
                        ?>
                    </th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            <!--/FIN Reportes PDF Y EXCEL-->
                
		<tr>
	       	    <th></th>
		    <th>Descripcion</th>
                    <th>Sucursal</th>
		    <th>Estatus</th>
		</tr>

	    </thead>
	    <tbody>
		<?php
		    if($departamento){
					
                        foreach($departamento as $departamento){
				
                            $idDepartamento     = base64_encode($departamento->id);						
			    echo '<tr>';
                                echo '<td>';
			            echo '<a href="departamento/editarDepartamento/'.$idDepartamento.'"><button type="button" title="Editar Departamento" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a> &nbsp;';
		?>

				    <button type="button" onclick="EliminarDepartamento('<?php echo $departamento->descripcion; ?>','<?php echo $idDepartamento; ?>');" title="Eliminar Departamento" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
		<?php
				echo '</td>';
				echo '<td>'.$departamento->descripcion.'</td>';
                                echo '<td>'.$departamento->id_sucursal.'</td>';
                                echo '<td>'; 
				    if($departamento->estatus==1){
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

    $('#departamento').dataTable( {

        "scrollX": false

    } );

} );

</script>			