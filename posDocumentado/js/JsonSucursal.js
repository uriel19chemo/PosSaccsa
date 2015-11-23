$(document).ready(function(){

		$("#Descripcion").focus();

		// Al hacer click en el botón para guardar

	$("form#formulario").submit(function()

	{

				var Sucursal 		= new Object();

				Sucursal.Id          = $('input#id').val();
                                
                                Sucursal.Descripcion      = $('input#descripcion').val();

				Sucursal.CalleNumero      = $('input#calleNumero').val();

				Sucursal.Colonia     = $('select#colonia').val();
                                
                                Sucursal.Estado     	   = $('input#estado').val();
                                
                                Sucursal.Ciudad    	   = $('input#ciudad').val();
				
				Sucursal.Municipio     = $('input#municipio').val();
				
				Sucursal.Cp     = $('input#cp').val();
				
				Sucursal.Telefono     = $('input#telefono').val();
				
				Sucursal.Estatus     = $('select#estatus').val();

				
				$("#mensaje").append("<div class='modal1'><div class='center1'> <center> <img src='"+ baseurl +"/img/gif-load.gif'> Guardando Informacion...</center></div></div>");

				var DatosJson = JSON.stringify(Sucursal);

				$.post(baseurl + 'sucursal/SaveSucursal',

					{ 

						SucursalPost: DatosJson

					},

					function(data, textStatus) {

						$("#"+data.campo+"").focus();

						$("#mensaje").html(data.error_msg);

					}, 

					"json"		

				);

				return false;

	});


$("#cp").blur(function(){

			var cp  = $("#cp").val();

			$.getJSON(baseurl + "sucursal/BuscaCP",{cp:cp},function(objetosretorna){

				$.each(objetosretorna, function(i,codigoPostal){

					$("#colonia").empty();
					$("#colonia").append("<option value='0'>Elige Colonia...</option>");
					$("#pais").val("Mexico");
					$("#estado").val(codigoPostal.Estado);
					$("#municipio").val(codigoPostal.Municipio);
					$("#ciudad").val(codigoPostal.ciudad);

					var colonias = (codigoPostal.Colonia).split(";");
					var cuantos  = colonias.length;

					for (i=0;i<cuantos;i++) { 

						$("#colonia").append("<option value='"+colonias[i]+"'>" + colonias[i] +"</option>");

					}

				});
                                
			});
                        
	});



});