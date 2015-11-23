$(document).ready(function(){

		$("#Descripcion").focus();

		// Al hacer click en el botón para guardar

	$("form#formulario").submit(function()

	{

			

				var Departamento 		= new Object();

				Departamento.Id          = $('input#id').val();

				Departamento.Descripcion      = $('input#descripcion').val();
                                
                                Departamento.Sucursal   = $('select#sucursal').val();

				Departamento.Estatus     = $('select#estatus').val();

				
				$("#mensaje").append("<div class='modal1'><div class='center1'> <center> <img src='"+ baseurl +"/img/gif-load.gif'> Guardando Informacion...</center></div></div>");

				var DatosJson = JSON.stringify(Departamento);

				$.post(baseurl + 'departamento/SaveDepartamento',

					{ 

						DepartamentoPost: DatosJson

					},

					function(data, textStatus) {

						$("#"+data.campo+"").focus();

						$("#mensaje").html(data.error_msg);

					}, 

					"json"		

				);

				return false;			

	});
        
//Cargamos Sucursales al combo
var sucursal = $("#sucursal");

    sucursal.append("<option value='0'>Cargando Sucursal...</option>");

    $.getJSON(baseurl + "departamento/sucursales",function(objetosretorna){

	sucursal.empty();
	sucursal.append("<option value='0'>---Elige Sucursal---</option>");

	$.each(objetosretorna, function(i,ObjetoReturn){

	var seleccion = "";
	if(id_sucursal==ObjetoReturn.id){

	    seleccion = "selected='selected'";

	}
	var nuevaFila = "<option value='"+ObjetoReturn.id+"' "+seleccion+">" + ObjetoReturn.descripcion+"</option>";
	sucursal.append(nuevaFila);

	});

    });                


});