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

function EliminarPedido(Pedido, id){

    confirmar=confirm("Eliminar a " + Pedido + " Recuerda Una vez Eliminado No podras Recuperarlo"); 

    if (confirmar){

    	document.getElementById('mensaje').innerHTML = "<div class='modal1'><div class='center1'> <center> <img src='"+ baseurl +"/img/gif-load.gif'> Eliminando Pedido...</center></div></div>";

    	 var Pedido 		 = new Object();

	    Pedido.Id      	 = id;  

	var DatosJson = JSON.stringify(Pedido);

	    $.post(currentLocation + '/DeletePedido',
            { 

		MiPedido: DatosJson

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

<h1 class="page-header"><span class="glyphicon glyphicon-list-alt"></span> Catalogo de Pedidos</h1>

<div id="mensaje"></div>

<p align="right">

    <a href="pedidos/nuevo">
        <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Nuevo Pedido</button>
    </a>  

</p>
<br/>

	<table id="pedido" border="0" cellpadding="0" cellspacing="0" width="100%" class="pretty">
	    <thead>
                
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
                </tr>
            <!--/FIN Reportes PDF Y EXCEL-->
                
	        <tr>
		    <th></th>
		    <th>Tipo</th>
		    <th>Fecha</th>
                    <th>Cliente</th>
		    <th>Total</th>
                    <th>Estatus</th>
	        </tr>
                
	    </thead>
	    <tbody>
		<?php
		    if($pedido){

			foreach($pedido as $pedido){

			    $idPedido     = base64_encode($pedido->ID);			

			    echo '<tr>';

				echo '<td>';
				echo '<a href="pedidos/editarPedido/'.$idPedido.'"><button type="button" title="Editar Pedido" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a> &nbsp;';

		?>

			        <button type="button" onclick="EliminarPedido('<?php echo $pedido->TIPO; ?>','<?php echo $idPedido; ?>');" title="Eliminar Pedido" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button>

		<?php

			        echo '</td>';
                                echo '<td>'.$pedido->TIPO.'</td>';
                                echo '<td>'.$pedido->FECHA.'</td>';
                                echo '<td>'.$pedido->CLIENTE.'</td>';
                                echo '<td>'.$pedido->TOTAL.'</td>';
                                echo '<td>'; 
				    if($pedido->ESTATUS==1){

					echo "Entregado";

				}else{

					echo "Pendiente";

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

    $('#pedido').dataTable( {

        "scrollX": false

    } );

} );

</script>			