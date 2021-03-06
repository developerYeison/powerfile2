@extends('admin.template.main')
 
@section('titulo')
  {{ trans('principal.titbusava') }} 
@endsection

@inject('permisos','App\helpers\Util')    		
		
		
@section('tituloPagina')
    <h3>{{ trans('principal.subtitbusava') }}  {{ $tablas->nombre_tabla }}</h3>  
@endsection

<?php

	$ruta= $permisos->verurl();
	
	$abuscar = @$_REQUEST['abuscar'];
	
	$workspace = $_SESSION['espaciotrabajo'];
	
	//se verifica si tiene bodegas ftp y si estan activas y visibles
	
	$puedever = $permisos->verficabodegas();
	
	if ($puedever == true)
	{
		$sevearch = '1';
	}
	else
	{
		if ($puedever == false)
		{
			$sevearch = '0';
		}
	}
		
?>



@section('contenido')
	<link rel="shortcut icon" href="{{{ asset('img/icopowerfile.png') }}}"> 
	
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/widgets/multi-select/multiselect.css') }}">
		  
    <script type="text/javascript" src="{{ asset('assets/widgets/multi-select/multiselect.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/quicksearch/jquery.quicksearch.js') }}"></script>
	
	<script type="text/javascript" src="{{ asset('js/quicksearch/jquery.quicksearch.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('dist/themes/default/style.css') }} " />
	<script type="text/javascript" src="{{ asset('dist/jstree.js') }} "></script>
	
	
	
	
	
		@if ($message = Session::get('mensaje'))
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				
					{!! $message !!}
				
					{!! Session::forget('mensaje') !!}
				</div>
		@endif
			
			
			
		@if ($message = Session::get('mensajeerror'))
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		
				{!! $message !!}
		
				{!! Session::forget('mensajeerror') !!}
			</div>
		@endif
	
	
	<div class="panel"> 
	    <div class="panel-body"> 
	   
			   
					
				  <div>		    	
				       <div id="divbuscar" class="input-group input-group-lg subtitulop" data-node="" style="width: 20% !important;margin-bottom: 1px !important;position:relative;float:left;display:none;"> 
					           	<input id="buscar" name="buscar" type="text" placeholder="{{ trans('principal.buscarque') }} " class="form-control" value="{{ $abuscar }}"> 
					            <div class="input-group-btn">
					               <button id="buscavisor" type="button" class="btn btn-default" tabindex="-1" >
					                  <i class="glyph-icon icon-search sombraicono icoverd" ></i>
					               </button>
					            </div>
					 		</div>
					 		
				       <div class="form-group" style="width: 30%;position:relative;float:left">
							{!! Form::label('id_tabla',trans('principal.tabln'),['class'=>'col-sm-3 control-label']) !!}
							<div class="col-sm-6" style="margin-left: 1%">
								{{Form::select('id_tabla', $lastablas  ,null,['class'=>'form-control'])}}
							</div>
							
					  </div>
					  <div id="bindi" class="input-group-btn" style="position:relative;float:right !important;display:none;margin-right:3%;z-index:9999 !important;">
			               <button id="buscarxindice" type="button" class="btn btn-default" tabindex="-1" >
			                  <i class="glyph-icon icon-search sombraicono icoverd" ></i>
			               </button>
			            </div>		
					  <div id="divindices" class="form-group" style="display:none;width: 100%;position:relative;">
					  	   {!! Form::label('iddeindices',trans('principal.titvindice'),['class'=>'col-sm-3 control-label']) !!}
					  	   <br>
					  	   <hr>
					  	   <br>
						  <div id="indicecont" style="width: 100% !important;position:relative;float:left;overflow-x:hidden;overflow-y:auto;max-height:150px">
						  
						  </div>
					  </div>	
					  		  
					  <br>
					  <hr>
					  <br>	   
				 </div>
			      
					<?php
						
					echo '<iframe id="cuadroavanzado" src="'.$ruta.'/treepowerfile2/arbol_busqueda.php?tablaid='.$tablaid.'&tiposdocumentales='.$tiposdocumentales.'&ruta='.$ruta.'&sevearch='.$sevearch.'"  height="700" width="100%" style="margin-top:1%" frameborder="0" ></iframe>';
					
					
					?>
			
	    </div>
	</div>
<script type="text/javascript" src="{{ asset('assets/widgets/colorpicker/colorpicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/widgets/colorpicker/colorpicker-demo.js') }}"></script>	
<script type="text/javascript" src="{{ asset('assets/widgets/spinner/spinner.js') }}"></script>

<script type="text/javascript" src="{{{ asset('assets/widgets/datatable/datatable.js') }}} "></script>
<script type="text/javascript" src="{{{ asset('assets/widgets/datatable/datatable-bootstrap.js') }}}  "></script>
<script type="text/javascript" src="{{{ asset('assets/widgets/datatable/datatable-tabletools.js') }}}  "></script>

	
<script type="text/javascript">	
	$(document).ready(function() {
		$('#bppal').attr('data-visor','');
	
		$('#bppal').attr('data-controller','expedientes'); 

		var tablaid = '{{ $tablaid }}';  

	    $("#id_tabla option").each(function(){   
			if ($(this).attr('value') == tablaid)
				{
					$(this).attr('selected','selected');
				}
	        //alert('opcion '+$(this).text()+' valor '+ $(this).attr('value'))
	     });
		
	});


	$('#id_tabla').change(function () {   //expedientes/_;_/0/visor_arbol

		var espaciotrabajo = '<?php echo $_SESSION['espaciotrabajo'] ?>';
		var buscar = '{{ $buscar }}';
		var id_tabla = $('#id_tabla').val();
		if (buscar == '')
			{
				buscar = '_;_';
			}
		
		window.location.href = '{{ $ruta }}/'+espaciotrabajo+'/expedientes/'+buscar+'/'+id_tabla+'/visor_arbol';	
		
	});


	
	$(function() { "use strict";
		$(".spinner-input").spinner();
	});
	
	//para los tipos documentales
		$( "#btncreatpdoc" ).click(function() {
			$('#modaltipodoc').modal('show');
		});	
		$( "#guardartpdoc" ).click(function() {
			 $('#grabtpdoc').submit(); 
			 $('#modaltipodoc').modal('hide');	
		});	
		$( "#cancelartpdoc" ).click(function() {
			$('#modaltipodoc').modal('hide');
		});	
	//////////////////////////////
	// para los indices
	$( "#btncreaindice" ).click(function() {
			$('#modalindice').modal('show');
		});	
	
	$( "#guardarindice" ).click(function() {
		 $('#grabindic').submit(); 
		 $('#modalindice').modal('hide');	
	});	

	$( "#cancelarindice" ).click(function() {
		$('#modalindice').modal('hide');
	});	


	$('#id_tipo').bind('change', function () { 
		var seleccion = $("#id_tipo option:selected").text();
		seleccion = seleccion.toUpperCase();
		$('#ntipo').val(seleccion);
		switch (seleccion) { 
	    	case 'LISTA': case 'LISTAS': 
	        	// SE GENERAN LOS ITEM DE KEY Y VALOR
	        	$('#bloque_lista').show();
	      	break;
	      	default:
	      		$('#bloque_lista').hide();
		}	
	});

	$('#agregar').bind('click', function () {  
		var ctl = $("#tblista").attr('data-ctl');
		var ctotal = $("#totalitem").val();
		ctl = parseInt(ctl) + 1;
		ctotal = parseInt(ctotal) + 1; 
		$("#totalitem").val(ctotal); 
		//se agregan los valores nuevos a la tabla
		var script = '';
		script += '<tr id="linea_'+ctl+'">';
		script += '<td class="centrartexto">';
		script += '<div class="col-sm-6 ajustainputtd">';
		script += '{!! Form::text("key[]",null,["class"=>"form-control"]) !!}'; 
		script += '</div>';
		script += '</td>';
		script += '<td class="centrartexto">';
		script += '<div class="col-sm-6 ajustainputtd" >';
		script += '{!! Form::text("valor[]",null,["class"=>"form-control"]) !!}';
		script += '</div>';
		script += '</td>';
		script += '<td  class="centrartexto"><a href="javascript:;"  onclick="quitaritem('+ctl+')" class="fileinput-exists glyphicon glyphicon-remove icoremover" id="quitar_{!! 1 !!}}" ></a>';
		script += '</td>';		
		script += '</tr>';
		$("#tblista").append(script);

		
	});	
	
 function quitaritem(item){	 
	$('#linea_'+item).remove();
	var ctotal = $("#totalitem").val();
	ctotal = parseInt(ctotal) - 1; 
	$("#totalitem").val(ctotal); 
	
 }

 function Dios(id_documento){  

	 	var espaciotrabajo = '<?php echo $_SESSION['espaciotrabajo'] ?>';

		var buscar = '{{ $buscar }}';

		if (buscar == '')
			{
			buscar = '_;_';
			}
		buscar = buscar.replace(/%/g, '_..._');
		
		var id_tabla = $('#id_tabla').val();
		
		id_documento = id_documento.split('_');

		window.location.href = '{{ $ruta }}/'+espaciotrabajo+'/expedientes/'+id_documento[1]+'/'+buscar+'/'+id_tabla+'/visor_listado_avanzado';
	
		
	}

 function verbsucar(valor,idnode){    
	if (valor == 1)
		{ 
			$("#divbuscar").attr('data-node',idnode);
			
	 		//$("#divbuscar").fadeIn('slow');	

	 		$("#iddeindices").fadeIn('slow');	 

	 		$("#divindices").fadeIn('slow'); 

	 		$("#bindi").fadeIn('slow');  
		}
	else
		{
			$("#divbuscar").attr('data-node','');
		
			//$("#divbuscar").fadeOut('slow');

			$("#iddeindices").fadeOut('slow');	

			$("#divindices").fadeOut('slow'); 

			$("#bindi").fadeOut('slow');  
				
		}	
	}

 function colocaind(tira){  
	 $("#indicecont").html(tira);	
 }
 

 $('#buscavisor').bind('click', function () {

		var workspace = '{{ $workspace }}';
		
		var ejecutar = $('#buscar').val();

		if (ejecutar == ''){ejecutar='_;_';}

		ejecutar = ejecutar.replace(/%/g, '_..._');   

		var dnode = $('#divbuscar').attr('data-node');
		
		document.getElementById('cuadroavanzado').contentWindow.filtrardoc(dnode,ejecutar);
		
	});

	$('#buscar').keypress(function(e) {
		if(e.which == 13) { 
			var workspace = '{{ $workspace }}';
			
			var ejecutar = $('#buscar').val();
			
			if (ejecutar == ''){ejecutar='_;_';}
			
			ejecutar = ejecutar.replace(/%/g, '_..._');  

			var dnode = $('#divbuscar').attr('data-node');
			
			document.getElementById('cuadroavanzado').contentWindow.filtrardoc(dnode,ejecutar);
		}		
	});

 ///para la busqueda por indices
 
  $('#buscarxindice').bind('click', function () {

		var workspace = '{{ $workspace }}';		

		var dnode = $('#divbuscar').attr('data-node');

		//se recorren los indices para tomar sus valores
		
		var vindicesid = '';

		var vindicesvalor = '';
		
		$(".losindices").each(function(){
       		    var id = $(this).attr('id');
				if ($('#'+id).val() != '')
					{
						vindicesid += $('#'+id).attr('data-idindice')+',';
						vindicesvalor += $('#'+id).val()+',';
						
					}
       		    
       		});	

		document.getElementById('cuadroavanzado').contentWindow.filtrardocxind(dnode,vindicesid,vindicesvalor);

		
	});
 
 function buscarindices(){
	 var workspace = '{{ $workspace }}';		

		var dnode = $('#divbuscar').attr('data-node');

		//se recorren los indices para tomar sus valores
		
		var vindicesid = '';

		var vindicesvalor = '';
		
		$(".losindices").each(function(){
    		    var id = $.trim($(this).attr('id'));
    		    
				if ($('#'+id).val() != '')
					{                                 
						vindicesid += $('#'+id).attr('data-idindice')+',';
						
						vindicesvalor += $('#'+id).val()+',';
						
					}
    		    
    		});	
		
 		document.getElementById('cuadroavanzado').contentWindow.filtrardocxind(dnode,vindicesid,vindicesvalor);
 }

 

 $('div.alert').delay(3000).slideUp(300);	
</script>	
	
@endsection
