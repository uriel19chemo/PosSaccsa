$(document).ready(function(){

		$("#Tipo").focus();

		// Al hacer click en el botón para guardar

	$("form#formulario").submit(function()

	{

			

				var Pedido 		= new Object();

				Pedido.Id          = $('input#id').val();

				Pedido.Tipo      = $('input#tipo').val();
                                
                                Pedido.Fecha      = $('input#fecha').val();
                                
                                Pedido.Cliente      = $('input#cliente').val();
                                
                                Pedido.Total      = $('input#total').val();

				Pedido.Estatus     = $('select#estatus').val();

				
				$("#mensaje").append("<div class='modal1'><div class='center1'> <center> <img src='"+ baseurl +"/img/gif-load.gif'> Guardando Informacion...</center></div></div>");

				var DatosJson = JSON.stringify(Pedido);

				$.post(baseurl + 'pedidos/SavePedido',

					{ 

						PedidoPost: DatosJson

					},

					function(data, textStatus) {

						$("#"+data.campo+"").focus();

						$("#mensaje").html(data.error_msg);

					}, 

					"json"		

				);

				return false;

			

			

	});



});