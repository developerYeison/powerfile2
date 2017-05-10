@extends('admin.template.main')

@section('titulo')
	{{ trans('principal.titvvisor') }}
@endsection

@section('tituloPagina')
	<h3 class="titulop">{{ trans('principal.titvvisor') }} <span id="titi"></span></h3>
@endsection

@section('contenido')

@inject('permisos','App\helpers\Util')



<?php
@session_start();

	$ruta= $permisos->verurl();
	
	$configdb = $permisos->verurl();

	$_SESSION['elidusuario'] = $idusuario;

	//buscamos los indices de ese documento para montarlo en la tablita de botones
	
	$indicesexp = $permisos->listadoindices($id_documento,0);
	
	$numimgdocument = $permisos->contarimagenesxdoc($id_documento);   
	
	$indicesexp = explode("_;_",$indicesexp);
		
	$nombresindi = json_decode($indicesexp[0]);
		
	$valoresindi = json_decode($indicesexp[1]);
	
	//se buscan los datos de expediente, carpeta y tipo documental
	
	$datosmostrar =  $permisos->datoscadena($id_documento);  
	
	//se busca el iddel expediente
	
	$iddelexp = $permisos->datoexpedienteid($id_documento);   
	
	//se busca la tabla del documento sgd_documentos
		
	$tablaid = $permisos->datotablaid($id_documento,$iddelexp);
	
	//se busca el folder del documento
	
	$idffolder = $permisos->datoffolderid($id_documento,$iddelexp);  
	
	$idtpdoc = $permisos->datotipodocid($id_documento);
	
	$permiorden = $permisos->conocepermisos('order_img');
	
	$workspace = $_SESSION['espaciotrabajo'];
	
	$permidescarga = $permisos->conocepermisos('down-img');
	
	if ($buscar == '_;_')
		{
			$abuscar = '';
		}
	else
		{
			$abuscar = $buscar;
		}
	//se arma la lineas de indices
	$scriptventana = '<span style="font-size:1em"><strong>'.trans("principal.titimigesti").'</strong></span><br>';
		
	for ($i = 0; $i < count($nombresindi); $i++)
		{
				
			$scriptventana .= '<span class="indicesub"><strong>'.$nombresindi[$i].': </strong></span>'.$valoresindi[$i].'<br>';
		}
		
	/// se cre el listado de todos los documentos q conforman el expediente con sus indices
	
	$ldocumentos = $permisos->listadodocumentos($iddelexp);	  

	$ldocumentos = explode("_;_",$ldocumentos); 
	
	$iddocs = json_decode($ldocumentos[0]);    
	
	$idtpdocv = json_decode($ldocumentos[1]);  
		
	$scriptventanadoc = '<span style="font-size:1em"><strong>'.trans("principal.msgdocume").'</strong></span><br>';
	
	 
		
	for ($i = 0; $i < count($iddocs); $i++)
		{
			
			if ($id_documento != $iddocs[$i])
				{
					$indicesexp = $permisos->listadoindices($iddocs[$i],$iddocs[$i]);
					
<<<<<<< visor_listado.blade.php
					if ($indicesexp != '')
						{
							$indicesexp = explode("_;_",$indicesexp);
							
							$nombresindi = json_decode($indicesexp[0]);
							
							$valoresindi = json_decode($indicesexp[1]);
							
							$script = '';
							
							for ($f = 0; $f < count($nombresindi); $f++)
								{
									$script .= '<span class="indicesub"><strong>'.$nombresindi[$f].': </strong></span>'.$valoresindi[$f].', ';
									
								}
							
							$numimg = $permisos->contarimagenesxdoc($iddocs[$i]);
							
							//se busca el nombre del folder
							
							$nfolder = $permisos->dameidfolder_tabla($iddocs[$i]);
							
							//se verifica que tenga permiso para ver datos de la dependencia y tabla de los documentos filtrados
=======
					if ($indicesexp != '')
						{
					
							$indicesexp = explode("_;_",$indicesexp);
							
							$nombresindi = json_decode($indicesexp[0]);
							
							$valoresindi = json_decode($indicesexp[1]);
							
							$script = '';
							
							for ($f = 0; $f < count($nombresindi); $f++)
								{
									$script .= '<span class="indicesub"><strong>'.$nombresindi[$f].': </strong></span>'.$valoresindi[$f].', ';
										
								}		
							
							$numimg = $permisos->contarimagenesxdoc($iddocs[$i]);
							
							//se busca el nombre del folder
>>>>>>> 1.39
							
<<<<<<< visor_listado.blade.php
							$permiso_documentos = $permisos->permisofolder_tabladepuser($iddocs[$i]);
=======
							$nfolder = $permisos->dameidfolder_tabla($iddocs[$i]);
>>>>>>> 1.39
							
<<<<<<< visor_listado.blade.php
							if ($permiso_documentos == true)
								{
									
									//se busca el nombre el tipo docmumental.
									$ntpdoc = $permisos->traerdocumental($idtpdocv[$i]);
									
									$scriptventanadoc .= '<br>';
									$scriptventanadoc .= '<a href="javascript:;"  id="docexpediente_'.$iddocs[$i].'" class="actible" onclick="visor_dopc('.$iddocs[$i].')">'.$nfolder.'&nbsp;-&nbsp;'.$ntpdoc.'&nbsp;&nbsp;('.$numimg.'&nbsp;&nbsp;'.trans('principal.titimage').')</a><br>';
									//- LOS INDICES Y SUS VALORES
									$scriptventanadoc .= '<span>'.$script.'</span><br>';
									$scriptventanadoc .= '<span><a href="javascript:;"  id="eldocumento_'.$iddocs[$i].'" class="actible" onclick="visor_dopc('.$iddocs[$i].')">'.trans("principal.titirdoc").'</span>';
									$scriptventanadoc .= '<hr style="margin-top:1px !important;margin-bottom:1px !important;">';
									
								}
						}
					
				}
=======
							//se verifica que tenga permiso para ver datos de la dependencia y tabla de los documentos filtrados
								
							$permiso_documentos = $permisos->permisofolder_tabladepuser($iddocs[$i]);
												
							if ($permiso_documentos == true)
								{
									
									//se busca el nombre el tipo docmumental.
									$ntpdoc = $permisos->traerdocumental($idtpdocv[$i]); 
									
									$scriptventanadoc .= '<br>';
									$scriptventanadoc .= '<a href="javascript:;"  id="docexpediente_'.$iddocs[$i].'" class="actible" onclick="visor_dopc('.$iddocs[$i].')">'.$nfolder.'&nbsp;-&nbsp;'.$ntpdoc.'&nbsp;&nbsp;('.$numimg.'&nbsp;&nbsp;'.trans('principal.titimage').')</a><br>';
										//- LOS INDICES Y SUS VALORES
									$scriptventanadoc .= '<span>'.$script.'</span><br>';
									$scriptventanadoc .= '<span><a href="javascript:;"  id="eldocumento_'.$iddocs[$i].'" class="actible" onclick="visor_dopc('.$iddocs[$i].')">'.trans("principal.titirdoc").'</span>';
									$scriptventanadoc .= '<hr style="margin-top:1px !important;margin-bottom:1px !important;">';
										
								}
					}			
			}
>>>>>>> 1.39
		}
		
		//llenamos los usuarios a los cuales se les puede enviar la notificacion del documento
			
		$scriptu = '';
		
		$scriptu = $permisos->usuarios_notificar($idusuario,$ruta);

		//se le coloca la fecha en que fue visto para que se quite de notificaciones
		
		$docle = $permisos->docleido($id_documento,$idusuario);
		
		//se buscan los usuarios para montarlos en el listado en compartir
		
		//dd($registrousuarios);
		//dd(count($registrousuarios));
		$totalusuarios = count($registrousuarios); 
		$vidusuarios = array();
		$vnomusuarios = array();
		for ($iu = 0; $iu< $totalusuarios; $iu++)
			{
				
				$vidusuarios[] = $registrousuarios[$iu]->id;
				
				$vnomusuarios[] = $registrousuarios[$iu]->name.' '.$registrousuarios[$iu]->lastname;
			}	
		
?>
<link rel="shortcut icon" href="{{{ asset('img/icopowerfile.png') }}}">

		<script type="text/javascript" charset="utf8" src="<?php echo $ruta;?>/js/jquery/jquery-1.8.2.min.js"></script>

		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
		  <link rel="stylesheet" href="<?php echo $ruta;?>/assets/bootstrap/css/bootstrap.css">
		  
		  <script src="<?php echo $ruta;?>/js/bootstrap.min.js"></script>
		  		  		 
	
		  <link rel="stylesheet" type="text/css" href="<?php echo $ruta;?>/assets/widgets/tooltip/tooltip.css">		  
		
	
		  <script type="text/javascript" src="<?php echo $ruta;?>/assets/widgets/tooltip/tooltip.js"></script>
		
		
		  <link rel="stylesheet" href="dist/themes/default/style.css" />
		
		  <link rel="stylesheet" type="text/css" href="<?php echo $ruta;?>/assets/icons/fontawesome/fontawesome.css">
		  <link rel="stylesheet" type="text/css" href="<?php echo $ruta;?>/assets/icons/linecons/linecons.css">
		  <link rel="stylesheet" type="text/css" href="<?php echo $ruta;?>/css/estilo_powerfile.css">
		
		  <link rel="stylesheet" type="text/css" href="<?php echo $ruta;?>/css/fileinput/fileinput.css">
		 		  
		  <script src="<?php echo $ruta;?>/js/fileinput/fileinput.js"></script>
		  
		  <script type="text/javascript" src="<?php echo $ruta;?>/js/pdfobject.js"></script>
		  
		  <script src="<?php echo $ruta;?>/js/jscroll-master/jquery.jscroll.js"></script>
		  
		  <script type="text/javascript" src="{{ asset('js/herramientas.js') }}"></script>
		  
		  
		  <script type="text/javascript" src="<?php echo $ruta;?>/assets/widgets/datepicker/datepicker.js"></script>
		  
		 
		

<style>
	ul.tll {
	  list-style: none;
	  padding: 0;
	}
	li.lni {
	  padding-left: 1.3em;
	  padding-top:0.5em;
	  padding-bottom:0.5em;
	}
	ul.uind {
	  list-style: none;
	  padding: 0;
	}
	li.lni {
	  padding-left: 1em;
	  padding-top:0.5em;
	  padding-bottom:0.5em;
	  
	}
								
	li.lni:hover {
		  background: #B0E6FF;
		}
	li.lni:before {
	  content: "\f04d"; /* FontAwesome Unicode f100 &#xf00c;*/ 
	  font-family: FontAwesome;
	  display: inline-block;
	  font-size:1.5em;
	 /* color:#00B0A1;*/
	  margin-left: 1.3em; /* same as padding-left set on li */
	  width: 1.3em; /* same as padding-left set on li */
	}
	.cder{
		color:#3498DB;
	}
	.cizq{
		color:#2ECC71;
	}
	.actible {
		cursor:pointer;
	}
	.actibleind{
		cursor:pointer;
	}
	.lind{
		color: #ffffff;
		margin-left: 1em !important;
		text-decoration:none; 
	}
	.colsort{
		width: 100% !important;
	}
	.colsortder{
		width: 90% !important;
	}
	.noseve{
		display:none;
	}
	.ampliado{
		max-width: 100% !important;
	}
	
	.popover-content{
		overflow-x: hidden;
		max-height: 500px !important;
	}
	.milazi{
		/*display:none;*/
	}
		
	.carousel-indicators li {
	  display: inline-block;
	  width: 10px;
	  height: 10px;
	  margin: 1px;
	  text-indent: -999px;
	  cursor: pointer;
	  background-color: #1600BF \9 !important;
	  background-color: rgba(22, 0, 191, 1) !important;
	  border: 3px solid #1600BF !important;
	  border-radius: 10px;
	}
	.carousel-indicators .active {
	  width: 12px;
	  height: 12px;
	  margin: 0;
	  background-color: #1600BF !important;
	}
	
	.ui-sortable-handle{
		cursor: pointer;
	}
	
	input[type=checkbox] {
	  display: none;
	}	
	
	.fileinput-upload-button{
	 display:none !important;
	}	
	
	#outerContainer #mainContainer div.toolbar {
	  display: none !important; /* hide PDF viewer toolbar */
	}
	#outerContainer #mainContainer #viewerContainer {
	  top: 0 !important; /* move doc up into empty bar space */
	}
	.bsdatepicker{z-index:99999999 !important;}
	
	 /* Loading Spinner */
        .spinner{margin:0;width:70px;height:18px;margin:-35px 0 0 -9px;position:absolute;top:50%;left:50%;text-align:center}
        .spinner > div{width:18px;height:18px;background-color:#333;border-radius:100%;display:inline-block;-webkit-animation:bouncedelay 1.4s infinite ease-in-out;animation:bouncedelay 1.4s infinite ease-in-out;-webkit-animation-fill-mode:both;animation-fill-mode:both}
        .spinner .bounce1{-webkit-animation-delay:-.32s;animation-delay:-.32s}
        .spinner .bounce2{-webkit-animation-delay:-.16s;animation-delay:-.16s}
        @-webkit-keyframes bouncedelay{0%,80%,100%{-webkit-transform:scale(0.0)}40%{-webkit-transform:scale(1.0)}}@keyframes bouncedelay{0%,80%,100%{transform:scale(0.0);-webkit-transform:scale(0.0)}40%{transform:scale(1.0);-webkit-transform:scale(1.0)}}
</style>


<div id="fondomodal" class="fondomodal">
		<div id="cargando" class="cargando">
			<img src="{{{ asset('assets/images/spinner/loader-dark.gif') }}}" width="100" height="100" alt=""/>
		</div>
</div>	


<div class="modal fade" id="modalgral" role="dialog"> </div>




<div class="panel">
	<div class="panel-body">
	@if ($message = Session::get('mensaje'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			
			{!! $message !!}
			
			{!! Session::forget('mensaje') !!}
		</div>
	@endif
	

		<h3 id="titi" class="title-hero subtitulop">
          
        </h3>
        
        <?php
            	$ctl = 0;
         ?>
        
        <!--div class="example-box-wrapper"> 
            <div class="timeline-box">
            		
            </div>  
        </div-->
       
        <div id="addimg" class="noseve" style="z-index:999999"> 
        	<iframe id="paddimg" src=""  height="700" width="100%" style="margin-top:1%" frameborder="0" ></iframe>
        </div>
        
       <div id="botones" class="noseve btnvisor"> 
        	<table width="50%" border="0" style="position:relative;left:5%">
        		<tr>
        			
        			<td width="50%" >
        				<div class="input-group input-group-lg subtitulop" style="width: 100% !important;margin-bottom: 1px !important;position:relative;float:left;"> 
				           	<input id="buscar" name="buscar" type="text" placeholder="{{ trans('principal.buscarque') }} " class="form-control" value="{{ $abuscar }}"> 
				            <div class="input-group-btn">
				               <button id="buscavisor" type="button" class="btn btn-default" tabindex="-1" >
				                  <i class="glyph-icon icon-search sombraicono icoverd" ></i>
				               </button>
				            </div>
				    	</div>
        			</td>
        			
        			<td width="10%"  class="centrartexto" style="padding-left:10px;">
        				<a data-toggle="dropdown" href="#"  data-placement="bottom" class="popover-button-header tooltip-button hdr-btn sf-with-ul centrartexto" title="{{ trans('principal.btncerrar') }}">
			        	<!--a href="javascript:;" title="{{ trans('principal.btncerrar') }}" class="sf-with-ul centrartexto"-->
							<i class="glyphicon glyphicon-remove-circle sombraicono iconorojo tam23" onclick="cierrzoomimg()">&nbsp;</i> 
						</a>
			        </td>
			        
			        <td id="tddescarga" width="5%" style="display:none" class="centrartexto"> 
			       		<!--a id="itemdescarga" href="javascript:;" title="{{ trans('principal.btndescarg') }}" class="sf-with-ul centrartexto" onclick="quedescarga()"-->
			       		<a id="itemdescarga" data-toggle="dropdown" href="javascript:;"  data-placement="bottom" class="popover-button-header tooltip-button hdr-btn sf-with-ul centrartexto" onclick="quedescarga()" title="{{ trans('principal.btndescarg') }}">
							<i class="glyphicon glyphicon-download-alt sombraicono iconoverde tam23">&nbsp;</i>
						</a>
			         </td>
			         <td width="5%" class="centrartexto"> 
			         	<a id="agregai" data-toggle="dropdown" href="javascript:;"  data-placement="bottom" class="popover-button-header tooltip-button hdr-btn sf-with-ul centrartexto" title="{{ trans('principal.btnagregaimg') }}">
			       		<!--a id="itemcarga" href="javascript:;" title="{{ trans('principal.btnagregaimg') }}" class="sf-with-ul centrartexto"-->
							<i class="glyphicon glyphicon-picture sombraicono iconomorda tam23" onclick="agregarimagenes()">&nbsp;</i>
						</a>
			         </td>
			         <td id="tdadddoc" width="5%" class="centrartexto"> 
			            <a id="itemadddoc" data-toggle="dropdown" href="javascript:;"  data-placement="bottom" class="popover-button-header tooltip-button hdr-btn sf-with-ul centrartexto" onclick="agregadocumento()" title="{{ trans('principal.tradadddoc') }}">
			       		<!--a id="itemadddoc" href="javascript:;" title="{{ trans('principal.tradadddoc') }}" class="sf-with-ul centrartexto" onclick="agregadocumento()"-->
							<i class="glyphicon glyphicon-file sombraicono iconoverde tam23">&nbsp;</i>
						</a>
			         </td>
			         <td width="5%" class="centrartexto">
			        	<div class="popover-content" >
							<a id="itemindi" href="javascript:;" class="sf-with-ul popover-button-default centrartexto" title="{{ trans('principal.btnverind') }}"  data-content="{{ $scriptventana }}" data-trigger="click" data-placement="right">
							<i class="glyphicon glyphicon-option-vertical sombraicono iconooro tam23" ></i>
							</a>
						</div>
					</td>	
					
					
					
					 <td width="5%" class="centrartexto">
			        	<div class="popover-content" >
							<a id="misdocumentos" href="javascript:;" class="sf-with-ul popover-button-default centrartexto" title="{{ trans('principal.tradverdoc') }}"  data-content="{{ $scriptventanadoc }}" data-trigger="click" data-placement="bottom">
							<i class="glyphicon glyphicon-folder-open sombraicono iconoladrillo tam23" ></i>
							</a>
						</div>
					</td>	
					
					
					
			         <td id="tdzoom" width="10%" class="centrartexto" style="padding-left:3%"> 
			       		<label>zoom:</label><input id="rzoom" type="range" min="0" max="500" value="1" oninput="elzoom(this.id)">
			         </td>
			         
			         <td id="tdzoom" width="30%" class="centrartexto" style="padding-left:3%"> 
			         <div id="cajaver_<?php echo $id_documento;?>" class="form-group" style="display:none">
										
										<?php
										$idfocm = 'formdocum_'.$id_documento;
										?>
										
										{!! Form::open(['route'=>'expedientes.comparteloya','method'=>'POST','id'=>$idfocm,'class'=>'form-horizontal bordered-row']) !!}
										
										<input id="otraoperation" type="hidden" name="otraoperation" value="compartelodoc">
																		
										<input id="iddocumento" type="hidden" name="iddocumento" value="<?php echo $id_documento;?>">
										
										<input id="workspace" type="hidden" name="workspace" value="<?php echo $workspace;?>">
										
										<input id="configdb" type="hidden" name="configdb" value="'<?php echo $configdb;?>">
										
										<input id="compartidos_<?php echo $id_documento;?>" type="hidden" name="compartidos" value=""> 
										
										<input id="buscar_<?php echo $id_documento;?>" type="hidden" name="buscar" value="<?php echo $abuscar;?>"> 
										
										<input id="ruta_<?php echo $id_documento;?>" type="hidden" name="ruta" value="<?php echo $ruta;?>">  
										
										<label class="col-sm-3 control-label"></label>
										<div class="col-sm-6" style="width: 100% !important;">
										<select name="id_usuarios" id="id_usuarios_<?php echo $id_documento;?>" multiple data-placeholder="Click to see available users..." class="chosen-select">
								              <?php               
					                            for ($iu = 0; $iu< $totalusuarios; $iu++)
							                            {
							                            	echo '<option value="'.$vidusuarios[$iu].'">'.$vnomusuarios[$iu].'</option>';
							                            }
							                     ?>       
										</select>
										</div>
										
										{!! Form::close() !!}
										</div>
										
										
				         <div id="botonescomparte_<?php echo $id_documento;?>" class="form-group centrartexto" style="display:none; style="width: 100% !important;">
							<button id="compartirlof" type="button" class="btn btn-primary" onclick="compartirlo(<?php echo $id_documento;?>)">Share</button>
						</div>
						
						
						 <a href="javascript:;" id="ver_<?php echo $id_documento;?>" class="btn btn-default btn-md" title="Share" onclick="vercomparte(<?php echo $id_documento;?>)">
	                        <i class="glyphicon glyphicon-share iconoazul sombraicono" ></i>
	                     </a>
										
					 </td>					
										
										
										
										
					
			         
			         
			         
			         <td width="10%" class="centrartexto" style="padding-left:30px">&nbsp;</td>
			         
			         <td id="bizq" width="10%" class="centrartexto"></td> 
			         
			         <td id="num_dimgcen" width="10%" class="centrartexto" style="padding-left:30px;"></td>
			         
			         <td id="bder" width="10%" class="centrartexto" style="padding-left:15px;"></td>
			       
			        
				</tr>	
			</table>	
		</div>
		<hr>	
		
		
			<!-- Modal -->
		  <div class="modal fade" id="modaldocumentos" role="dialog" style="z-index:9999999 !important;">
		    <div class="modal-dialog" style="width: 70%;overflow-y:auto;overflow-x:none;max-heigth:10%;z-index:99999999 !important;">
		    
		    
		      <!-- Modal content-->
		      <div class="modal-content">
			        <div class="modal-header" style="background-color: #009ACC !important;">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 id="titulodocumentep" lass="modal-title"></h4> 
			        </div>
			        <div class="modal-body">
			        
			        <form id="formdocum" method="POST" action="<?php echo $ruta;?>/treepowerfile2/cargalo_documentos.php" accept-charset="UTF-8" class="form-horizontal bpad15L pad15R bordered-row" enctype="multipart/form-data">
			        
			        	<div class="col-md-4" style="width: 90% !important">
				        	<div class="content-box mrg15B" style="position:relative;left:5%">
							        <h3 class="content-box-header clearfix">
							           {{ trans('principal.titinotificaa') }}  					            
							        </h3>
							        <!-- lista de usuarios -->
							        
							        <div id="enviara" class="content-box-wrapper text-center clearfix"><?php echo $scriptu;?> </div>
							</div>
							
						</div>	
			        
			            <input id="otraoperation" type="hidden" name="otraoperation" value="grabardocumentoadd">
			            
			            <input id="origen" type="hidden" name="origen" value="visor_lista">
			            
			            <input id="configdb" type="hidden" name="configdb" value="<?php echo $configdb;?>">
			            <input id="tablaid" type="hidden" name="tablaid" value="<?php echo $tablaid;?>">
			            <input id="id_usuario" type="hidden" name="id_usuario" value="<?php echo $idusuario;?>">
			            
			            <input id="workspace" type="hidden" name="workspace" value="<?php echo $workspace;?>">
			   
			           	<input id="id_tipodoc" type="hidden" name="id_tipodoc" value="<?php echo $idtpdoc;?>">    <!-- contiene el id del tipo documental--> 	         
			        	<input id="id_folder" type="hidden" name="id_folder" value="<?php echo $idffolder;?>">   <!-- contiene el id de la carpeta contenedora-->
			        	<input id="id_tabla" type="hidden" name="id_tabla" value="<?php echo $tablaid;?>">   <!-- contiene el id de la tabla-->
			        	<input id="id_expediente" type="hidden" name="id_expediente" value="<?php echo $iddelexp;?>">  <!-- contiene el id del expediente--> 
			        	
			        	<input id="id_eenviara" type="hidden" name="id_eenviara">  <!-- contiene el id de los usuarios a los que les ser� notificado la creaci�n del documento-->
			        	
			        	<!-- los indices-->
			        	<div id="indicesitems"></div> 
			        	
		                <input id="documentosimg" class="file" type="file" name="documentosimg[]" multiple data-min-file-count="1">
		                <br>
				               
 				   </form>
			        	
		      		</div>
		      <div class="modal-footer">
		          <!--button type="button" class="btn btn-default" data-dismiss="modal">Close</button-->
		      </div>
		      
		      <div class="form-group centrartexto">
					<button id="guardardoc" type="button" class="btn btn-primary" >{{ trans('principal.btngu') }}</button>  
					<button id="cancelardoc" type="button" class="btn btn-danger btn-close" data-dismiss="modal">{{ trans('principal.btnca') }}</button>
			 </div>
		    </div>
		  </div>
		</div>
		
		
		
        <div id="deimagenes" class="noseve"></div>  
        
         <!-- Modal -->
		  <div class="modal fade" id="modaldescarga" role="dialog" style="z-index:9999999 !important;">
		    <div class="modal-dialog" style="width: 70%;overflow-y:auto;overflow-x:none;max-heigth:10%;z-index:9999999 !important;">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
			        <div class="modal-header" style="background-color: #009ACC !important;">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 id="titulodocumentep" class="modal-title">Rango de imagenes a descargar</h4> 
			        </div>
			        <div class="modal-body">
			        
			      
			        	        
			            <input id="otraoperation" type="hidden" name="otraoperation" value="descargarlos">
			            
			            <input id="configdb" type="hidden" name="configdb" value="<?php echo $ruta;?>">
			            
			            <input id="id_usuario" type="hidden" name="id_usuario" value="<?php echo $idusuario;?>">
			   
			   			<input id="id_documento" type="hidden" name="id_documento" value="<?php echo $id_documento;?>">   <!-- contiene el id del documento-->		 
			           	
		               
		                
		                <div>
			                <div class="form-group"  style="width:45%;position:relative;float:left"> 
							  <label>Desde</label>
							   <input type="text" id="desdeimg" class="form-control spinner-input" placeholder="Ingrese el n&uacute;mero de imagen inicio" value="" onKeyUp="return ValNumero(this)">
		                    </div>               
			     			&nbsp;
			     			 <div class="form-group" style="width:45%;position:relative;float:left;margin-left:3%">
							  <label>Hasta</label>
							   <input type="text" id="hastaimg" class="form-control spinner-input" placeholder="Ingrese el n&uacute;mero de imagen final" value="" onKeyUp="return ValNumero(this)"> 
		                    </div>
		                    
 				   		</div>
			        	
		      		</div>
		      		 <br> <br> <br>
		      		<div class="modal-footer">
		         		<div class="form-group centrartexto">
							<button id="descargardoc" type="button" class="btn btn-primary" >{{ trans('principal.btndesc') }}</button>  
							<button id="cancelardoc" type="button" class="btn btn-danger btn-close" data-dismiss="modal">{{ trans('principal.btnca') }}</button>
			 			</div>
		      		</div>
		      
		      
		    </div>
		  </div>
		</div>
        
	</div>
</div>

<script type="text/javascript" src="{{ asset('assets/widgets/interactions-ui/draggable.js') }}"></script> 
<script type="text/javascript" src="{{ asset('assets/widgets/interactions-ui/sortable.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/widgets/interactions-ui/selectable.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/widgets/lazyload/lazyload.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/widgets/spinner/spinner.js') }}"></script>


<script type="text/javascript">
	$(function() { "use strict";
		$(".spinner-input").spinner();
	});
	var docactivo = 0;
	var eltiti = $('#titi').text(); 


	function vercomparte(id){  //alert(id);
		if ($("#cajaver_"+id).is(":visible") == false) 
			{ 
				$("#cajaver_"+id).show();
				$("#botonescomparte_"+id).show();
				$("#tiempover_"+id).show(); 
				
			}
		else
			{
				$("#tiempover_"+id).hide(); 
				$("#cajaver_"+id).hide();
				$("#botonescomparte_"+id).hide();
			}	
	}

	function compartirlo(id){
		

		$("#compartidos_"+id).val($("#id_usuarios_"+id).val());
		
		$("#formdocum_"+id).submit();
		
	}
	
	$(document).ready(function() {

		

		$('#titi').html('{{ $datosmostrar }}&nbsp;&nbsp;({{ $numimgdocument }}&nbsp;&nbsp;{{ trans("principal.titimage") }})');

		$('#bppal').attr('data-visor','visor_lista');
		
		$('#bppal').attr('data-controller','expedientes'); 
		
		$('#fondomodal').show();

		var idusuario = '{{ $idusuario }}'; 

		

		var ruta = 	'{{ $ruta }}';

		var id_documento = 	'{{ $id_documento }}';  

		 $('#fondomodal').hide();	
		    		
		/////proceso de limpieza

		/*var enlacerecep = ruta+'/treepowerfile2/cargalo_documentos.php?otraoperation=limpiarlo'+'&idusuario='+idusuario;   
		$.ajax({
		   type: "GET",
		   async:false, 
		   url: enlacerecep,
		   success: function(msg){  

			   $('#fondomodal').hide();	   				   
		   },
			error: function(x,err,msj){alert(msj) }
		  });*/

		////////
		
		
		verimgtp(id_documento);  //carga las imagenes de ese documento
		
			/*$(function() {
		        $("img.milazi").lazyload({
		            effect: "fadeIn",
		            threshold: 100
		        });
		    });*/

			esmovil= is_mobile();
			
			if (esmovil == true)
				{
					$('#botones').removeClass('btnvisor');

					$('#botones').addClass('btnvisormovil');
				}	
	});

	
	function ejecutarluego(id_documento){ 

		var ruta = '{{ $ruta }}';

		 var buscar = '{{ $buscar }}'; 

		 buscar = buscar.replace(/%/g, '_..._');

		 buscar = buscar.replace('/', '_..._');

		 buscar = $.trim(buscar);

		 var idusuario = '{{ $idusuario }}';

		 var id_documento = 	'{{ $id_documento }}'; 
		    
		 $('#addimg').hide();

		 var espaciotrabajo = '<?php echo $_SESSION['espaciotrabajo'] ?>';
		 
		 window.location.href = '{{ $ruta }}/'+espaciotrabajo+'/expedientes/'+id_documento+'/'+buscar+'/visor_listado';	
		 
		 
	 }

	 function ejecutarluegocierre(){
		 
			    
		 $('#addimg').hide();

		 $('#botones').fadeIn('slow'); 

	   	 $('#deimagenes').fadeIn('slow'); 
		 
		 
		 
	 }
	

	function agregarimagenes(){
		
		   var configdb = '{{ $ruta }}';

		   var ruta = '{{ $ruta }}';

		   var buscar = '{{ $buscar }}'; 

		   buscar = buscar.replace(/%/g, '_..._');

		   buscar = buscar.replace('/', '_..._');

		   buscar = $.trim(buscar);

		   var idusuario = '{{ $idusuario }}';

		   var id_documento = 	'{{ $id_documento }}';  

		   var id_expediente = 	'{{ $iddelexp }}'; 

		   var id_tipodoc = 	'{{ $idtpdoc }}';   

		   var ntipdoc = $('#titi').text();
		   
		    $('#id_documento').val(id_documento);

	   		$('#id_expediente').val(id_expediente);
	   		
	   		$('#paddimg').attr('src',ruta+"/treepowerfile2/arbol_agregaimg.php?id_tipodoc="+id_tipodoc+"&id_documento="+id_documento+"&id_expediente="+id_expediente+"&ruta="+ruta+"&id_usuario="+idusuario+"&buscar="+buscar+"&ntipdoc="+ntipdoc+"&vi=l");

	   		//$('#modalgral').modal('show');    
	   		
	   		$('.timeline-box').fadeOut('slow');

	   		$('.popover').fadeOut('slow');

	   		$('#botones').fadeOut('slow'); 

	   		$('#deimagenes').fadeOut('slow');  

	   		$('#addimg').fadeIn('slow');
	}


	
	function zoomtodo(id){ 
		
		$('#fondomodal').show();

		var idusuario = '{{ $idusuario }}'; 
		
		var ruta = 	'{{ $ruta }}';

		var permiorden = '{{ $permiorden }}';

	    var workspace = '{{ $workspace }}';
		
		//se recorren las imagenes
		var td1 = '';
		var td2 = '';
		var d = 0;
		$(".tiraimg").each(function(){
			var id = $(this).attr('id'); 
			var valord1 = $('#'+id).attr('data-1');
			var valord2 = $('#'+id).attr('data-2');  
			if (d == 0)
				{
					d = $('#'+id).attr('data-d'); 
				}
			td1 += valord1+'_;_';
			td2 += valord2+'_;_';						
		});
		
		var tabla = ''; 
		var script = '';
		var enlacerecep = ruta+'/treepowerfile2/cargalo_documentos.php?otraoperation=descargartodo'+'&d1='+td1+'&d2='+td2+'&iddoc='+d+'&idusuario='+idusuario+'&workspace='+workspace;
		$.ajax({
		   type: "GET",
		   async:false, 
		   url: enlacerecep,
		   success: function(msg){  
			   
			   laimg = ruta+"/img/descargas/"+workspace+"/"+idusuario+"/Powerfiledoc_"+d+"_.pdf" ; 
			   				   
		   },
			error: function(x,err,msj){alert(msj) }
		  });

		if (permiorden == 1)
			{
				script +='<iframe id="print-iframe" name="print-iframe" src="'+laimg+'" height="1000" width="80%"></iframe>';
			}
		else
			{
				script +='<iframe id="print-iframe" name="print-iframe" src="'+laimg+'#toolbar=0" height="1000" width="80%"></iframe>';
			}	
		
		//se oculta el boton de descarga
		
		$("#tddescarga").hide();
		

		if ($("#deimagenes").is(":visible") == true) 
			{ 
				//se montan las imagenes
				$("#imagen_visual").html(script);
			}
		else
			{
				//se cargan las imagenes y se muestra el div de imagenes y se oculta el de los expedientes
				var options = {};
				$("#deimagenes").html(script);						
				$(".timeline-box").fadeOut('slow');
				$("#deimagenes").fadeIn('slow');	
				$("#botones" ).show();				
			}
		$('#fondomodal').hide();
	}
	
   function zoomimg(id,v)
   	{
	   $('#fondomodal').show();
	   
	   var ruta = 	'{{ $ruta }}';

	   var idusuario = '{{ $idusuario }}'; 

	   var id_documento = 	'{{ $id_documento }}';  

	   var workspace = '{{ $workspace }}';  

	   var permidescarga = '{{ $permidescarga }}';  
	   
       if (v == 1)
       	{
			//se toma el src de la imagen y se muestra grande en el centro de la pantalla

			var docum = $('#'+id).attr('src');     

			var d1 = $('#'+id).attr('data-1');

			var d2 = $('#'+id).attr('data-2'); 

			var numim = $('#'+id).attr('data-num');   

			var ordenimg = $('#'+id).attr('data-ordenimg');  

			if (ordenimg > 0)
				{
					ordenimg = ordenimg - 1;
				}
			
			var imgdoc = $('#imagen_visual').attr('data-numimg');  

			var ioid = id.split('_');     

			var d = $('#'+id).attr('data-d'); 

		    var expe = $('#'+id).attr('data-exp');

			var nexpe = $('#exp_'+id).text(); 

			var permiorden = '{{ $permiorden }}';

			var script = '';

			var laimg =  '';
					  
			/////el proceso de descargar

			if (permidescarga == true)
				{
					$("#tddescarga").show();
				}	
			
		if ($("#deimagenes").is(":visible") == true) 
			{ 
					if ($("#ladoizq").is(":visible") == true) 
					{
						//$("#botones").removeClass('btnvisor');
					//	$("#botones").addClass('btnvisorladoizq');  
					//	$("#botones").show();		
					}
				else
					{
						//$("#botones").removeClass('btnvisorladoizq');
					//	$("#botones").addClass('btnvisor');
					}
						
				//se montan las imagenes
				
				//se coloca la imagen actual

				$('#imagen_visual').attr('data-imgact',ordenimg);

				$('#num_imgcen').html(numim);

				$('#tbimagenescen').css('width','80%');
				
				var $scriptimg = '<img id="image_central" src="'+docum+'" data-1="'+d1+'"  data-2="'+d2+'" class="sb-toggle-right imgcentral zoom" onclick="zoomimg(this.id,1)" data-exp="'+expe+'" data-num="'+numim+'" alt="" width="80%" max-width="100%" style="position:relative;left:5%;cursor:pointer;z-index:99;">';
					
				$('#imagen_visual').html($scriptimg);

				/////////////////////////////////////
				

				$(".toolbar").hide(); 
				//se abre el lado derecho con las imagenes en miniatura del documento	
				
				var datoor = $('.slimScrollDiv').html();	

				var configdb = '{{ $ruta }}';
				
				//buscamos las imagenes de ese expedientes y las montamos en el div derecho
				var script = '';
				var enlacerecep = ruta+'/treepowerfile2/cargalo_documentos.php?otraoperation=dameimagenesdoc'+'&id_documento='+id_documento+'&configdb='+configdb+'&permiorden='+permiorden+'&permidescarga='+permidescarga+'&workspace='+workspace; 
				$.ajax({
					   type: "GET",
					   async:false, 
					   url: enlacerecep,
					   success: function(msg){    
						   
						   script += msg; 
						   
					   },
						error: function(x,err,msj){alert(msj) }
					  });
				
				setTimeout(cargalo(script), 7000);
				
			}
		else
			{
				//se cargan las imagenes y se muestra el div de imagenes y se oculta el de los expedientes
				
				if ($("#ladoizq").is(":visible") == true) 
					{
						//$("#botones").removeClass('btnvisor');
					//	$("#botones").addClass('btnvisorladoizq');  
					}
				else
					{
					//	$("#botones").removeClass('btnvisorladoizq');
					//	$("#botones").addClass('btnvisor');
					}
				var options = {};
				$("#deimagenes").html(script);						
				$(".timeline-box").fadeOut('slow');
				$("#deimagenes").fadeIn('slow');	
				//$("#botones").show();				
			}

				$(function() { "use strict";
				$(".colsortder").sortable({
				    connectWith: ".colsortder",
		
				    stop: function( ) {

					    
			           var idimgctl = 0;
		
			           var contadorimg = 0;
		
			           var iddocumimg = 0;
		
			           var vidimagen = new Array();

			         //si el check esta marcado y tiene permiso se efectua el ordenamiento en base de datos de lo contrario no lo realiza 
			          if ($("#vordernoarlos").prop('checked') == true)
			           	{
			           
						       $(".img_listado").each(function(){
									var idimglist = $(this).attr('id'); 

									var idmiganetomada = $('#'+idimglist).attr('data-1');
									if ( jQuery.inArray( idmiganetomada, vidimagen ) == -1)
										{
											idimgctl = idmiganetomada;
											contadorimg = contadorimg + 1;
											if(contadorimg == 1)
												{
													iddocumimg = $('#'+idimglist).attr('data-d');
												}
											$('#'+idimglist).html(contadorimg);
											vidimagen[contadorimg - 1] = $('#'+idimglist).attr('data-1');								
										}
													
								});    
								 // se envia el nuevo orden a la tabla de imagenes
							     var configdb = '{{ $ruta }}';
					
								 var ruta = '{{ $ruta }}';	  

								 var workspace = '{{ $workspace }}'; 
								 	
								 var jsonvidimagen = JSON.stringify(vidimagen);  
								 
								 var enlacerecep = ruta+'/treepowerfile2/cargalo_documentos.php?otraoperation=ordena_imagenes'+'&id_documento='+d+'&configdb='+ruta+'&idsimg='+jsonvidimagen+'&workspace='+workspace; 
				
									$.ajax({
										   type: "GET",
										   async:false, 
										   url: enlacerecep,
										   success: function(msg){   //alert(msg);
											   
										   },
											error: function(x,err,msj){alert(msj) }
										  });
			           	}
							  
			        }//fin del evento stop del sorteable
	        
				});
			});	

		
       	}
      else
      	{
    	  	
      	}     
       $('#fondomodal').hide();	    
   	}
  	
 	function mostrartabla(id){	 
 	 	var idite = id.split('_');
 		$("#vertabla_"+idite[1]).fadeIn('slow');
 	}
 	function nomostrartabla(id){	 
 	 	var idite = id.split('_');
 		$("#vertabla_"+idite[1]).fadeOut('slow');
 	}
 	
	function cierrzoomimg(){
		var espaciotrabajo = '<?php echo $_SESSION['espaciotrabajo'] ?>';
	    window.location.href = '{{ $ruta }}/'+espaciotrabajo+'/expedientes/{{ $buscar }}/visor_lista';
		return false;
	}
 	
   function abrelo(){
			
	}

   

   function mhori(id){
	   var mover = $('#'+id).val()+'%';
	   	   	   
	   $('#imgcentral').css("left",mover) ;
		
   } 
   
   function mver(id){
	   var mover = $('#'+id).val()+'%';
	   	   	   
	   $('#imgcentral').css("top",mover) ;
		
   } 

	
	$('.actible').bind('click', function () {
		
		var id_expediente = $(this).attr('data-exp');

		window.location.href = '{{ $ruta }}/expedientes/'+id_expediente+'/visor_exp';
		
	});

	$('.ver_indices').bind('click', function () {
		
		var id_indice = $(this).attr('data-valor');

		var datoor = $('.slimScrollDiv').html();	

		var configdb = '{{ $ruta }}';

		var ira = 'expedientes.mostrar';

		var ruta = '{{ $ruta }}';

		var workspace = '{{ $workspace }}'; 

		var script = '<div class="row" style="overflow-x:none;overflow-y:auto;max-height:100%;padding-left:3%">';
		
		//buscamos los documentos que tengan ese indice
		var script = '';
		var enlacerecep = ruta+'/treepowerfile2/cargalo_documentos.php?otraoperation=damedocumentosxind'+'&id_indice='+id_indice+'&configdb='+configdb+'&workspace='+workspace; 
		$.ajax({
			   type: "GET",
			   async:false, 
			   url: enlacerecep,
			   success: function(msg){ 
				   
				   script += msg;
				   				   
			   },
				error: function(x,err,msj){alert(msj) }
			  });

	    script += '</div>';

		$('#ladoizq').html(script);  
		
		$(function() { "use strict";
			$(".column-sort").sortable({
			    connectWith: ".column-sort"
			});
		});
		
	});

	
	
	$('.ver_imagenes').bind('click', function () {
		
		var id_expediente = $(this).attr('data-valor'); 

		var datoor = $('.slimScrollDiv').html();	

		var configdb = '{{ $ruta }}';

		var ira = 'expedientes.mostrar';

		var ruta = '{{ $ruta }}';

		var workspace = '{{ $workspace }}'; 
	
		//buscamos las imagenes de ese expedientes y las montamos en el div derecho
		var script = '';
		var enlacerecep = ruta+'/treepowerfile2/cargalo_documentos.php?otraoperation=dameimagenes'+'&id_expediente='+id_expediente+'&configdb='+configdb+'&workspace='+workspace; 
		$.ajax({
			   type: "GET",
			   async:false, 
			   url: enlacerecep,
			   success: function(msg){    
				   
				   script += msg;
				   
			   },
				error: function(x,err,msj){alert(msj) }
			  });
		
		setTimeout(cargalo(script), 7000);
		
	});


	function avanzarimg(direccion){  

		var ruta = '{{ $ruta }}';

		var workspace = '{{ $workspace }}'; 
		
		var configdb = '{{ $ruta }}';
	
		var posi_actual = $('#imagen_visual').attr('data-imgact');  

		var bodegas = $('#imagen_visual').attr('data-bod');

		var imagenes = $('#imagen_visual').attr('data-img');

		var extenciones = $('#imagen_visual').attr('data-ext');

		var iddocumento = $('#imagen_visual').attr('data-d'); 

		var numimgs =  $('#imagen_visual').attr('data-numimg'); 

		var expe =  $('#imagen_visual').attr('data-exp'); 

		var orde = $('#imagen_visual').attr('data-orden');   

		//se busca la imagen a mostrar
		
		var vbodegas = bodegas.split('_,_');

		var vimagenes = imagenes.split('_,_'); 

		var vextenciones = extenciones.split('_,_');

		var vorde = orde.split('_,_'); 

		if (direccion == 1)
			{
				if (posi_actual < (numimgs -1))
					{
						
						posi_actual = parseInt(posi_actual) + 1;
		
						bodegas = vbodegas[posi_actual];
		
						imagenes = vimagenes[posi_actual];
		
						extenciones = vextenciones[posi_actual];

						orde = vorde[posi_actual];
		
						$('#imagen_visual').attr('data-imgact',posi_actual);  
						
					}
				else
					{
						posi_actual = 0;
			
						bodegas = vbodegas[posi_actual];
			
						imagenes = vimagenes[posi_actual];
			
						extenciones = vextenciones[posi_actual];

						orde = vorde[posi_actual];
			
						$('#imagen_visual').attr('data-imgact',posi_actual); 
					}
			}
		else
			{
			if (direccion == 2)
				{   
					if (posi_actual > 0)
						{
							
							posi_actual = parseInt(posi_actual) - 1;
			
							bodegas = vbodegas[posi_actual];
			
							imagenes = vimagenes[posi_actual];
			
							extenciones = vextenciones[posi_actual];

							orde = vorde[posi_actual];
			
							$('#imagen_visual').attr('data-imgact',posi_actual);  
							
						}
					else
						{
							
							posi_actual = (numimgs -1);
				
							bodegas = vbodegas[posi_actual];
				
							imagenes = vimagenes[posi_actual];
				
							extenciones = vextenciones[posi_actual];

							orde = vorde[posi_actual];
				
							$('#imagen_visual').attr('data-imgact',posi_actual); 
						}
				}
			}

		// se colopca el orden de la imagen
		//alert(orde);
		
		$('#num_imgcen').html(orde);
		
		//se manda a trabajar la imagen

		$('#fondomodal').show();
		
		var script = '';
		var enlacerecep = ruta+'/treepowerfile2/cargalo_documentos.php?otraoperation=dameimagenescentsigatras'+'&id_documento='+iddocumento+'&configdb='+configdb;
		enlacerecep += '&bodegas='+bodegas+'&img='+imagenes+'&exte='+extenciones+'&expe='+expe+'&posiimg='+posi_actual+'&dir='+direccion+'&orde='+orde+'&workspace='+workspace;   
		 
		$.ajax({
			   type: "GET",
			   async:false, 
			   url: enlacerecep,
			   success: function(msg){    
				   
				   $("#imagen_visual").html(msg); 
				   
				   $('#fondomodal').hide();
				   
			   },
				error: function(x,err,msj){alert(msj) }
			  });
		
	}

	
	function cargalo(script){   
		$('#ladoder').html(script);  
		if ($("#ladoder").is(":visible") == true) 
			{ 
				
			}	
		else
			{
				$('#ladoder').fadeIn('slow');
				var estiloc = $('.sb-right').attr('style');
				estiloc +=  ';transform:translate(-350px)';
				$('.sb-right').attr('style', estiloc);
				$('#lderecho').show(); 
				$('.slimScrollDiv').show();
			}
		$('.scroll').jscroll();
			
	}
	function verimgtp(id){
		var iddoc = id;
		if (iddoc != docactivo)
			{
				docactivo = iddoc;
				//se carga el lote de imagenes
			
				var configdb = '{{ $ruta }}';
		
				var ira = 'expedientes.mostrar';
		
				var ruta = '{{ $ruta }}';

				var workspace = '{{ $workspace }}'; 
			
				//buscamos las imagenes de ese documento y las montamos en el div deimagenes 
				var script = '';
				var enlacerecep = ruta+'/treepowerfile2/cargalo_documentos.php?otraoperation=dameimagenescentro'+'&id_documento='+iddoc+'&configdb='+configdb+'&anc=0'+'&workspace='+workspace;  
				$.ajax({
					   type: "GET",
					   async:false, 
					   url: enlacerecep,
					   success: function(msg){   
						   
						   script += msg;
						   
						   
					   },
						error: function(x,err,msj){alert(msj) }
					  });

				
				//se verifica que no este visible el div de imagenes
				
				var montaje = script.split('_;_');

				$("#bizq").html(montaje[1]);
				
				$("#num_dimgcen").html(montaje[2]);

				$("#bder").html(montaje[3]);
				
				if ($("#deimagenes").is(":visible") == true) 
					{ 
						//se montan las imagenes
						$("#deimagenes").html(montaje[0]);
						$(".imgcentral").addClass('sb-toggle-right');
					}
				else
					{
						//se cargan las imagenes y se muestra el div de imagenes y se oculta el de los expedientes
						
						$("#deimagenes").html(montaje[0]);			
						$(".imgcentral").addClass('sb-toggle-right');			
						$(".timeline-box").fadeOut('slow');
						$("#deimagenes").fadeIn('slow');		
						$("#botones").fadeIn('slow'); 				
					}

				
			}
		else
			{
				//se oculta el div de imegenwes y se muestra el de expedientes
				$(".timeline-box").fadeIn('slow');
				$("#deimagenes").fadeOut('slow');	
				$("#deimagenes").html('');
				$("#botones").hide();	
				docactivo = 0;
			}
	}

	function verimgtpfull(id){  //muestra el total de imagenes del documento en el centro
		var iddoc = $('#'+id).attr('data-valor');
		var idfolder = $('#'+id).attr('data-folder');
		$('#addimg').hide();
		if (iddoc != docactivo)
			{
				docactivo = iddoc;
				//se carga el lote de imagenes
			
				var configdb = '{{ $ruta }}';
		
				var ira = 'expedientes.mostrar';
		
				var ruta = '{{ $ruta }}';

				var workspace = '{{ $workspace }}'; 
			
				//buscamos las imagenes de ese folder y las montamos en el div deimagenes 
				var script = '';
				var enlacerecep = ruta+'/treepowerfile2/cargalo_documentos.php?otraoperation=dameimagenescentrofolder'+'&id_expediente='+iddoc+'&idfolder='+idfolder+'&configdb='+configdb+'&workspace='+workspace; 
				$.ajax({
					   type: "GET",
					   async:false, 
					   url: enlacerecep,
					   success: function(msg){    
						   
						    
						   script += msg;
						   
					   },
						error: function(x,err,msj){alert(msj) }
					  });
				  
				//se verifica que no este visible el div de imagenes
				if ($("#deimagenes").is(":visible") == true) 
					{ 
						//se montan las imagenes
						$("#deimagenes").html(script);
					}
				else
					{
						//se cargan las imagenes y se muestra el div de imagenes y se oculta el de los expedientes
						
						$("#deimagenes").html(script);						
						$(".timeline-box").fadeOut('slow');
						$("#deimagenes").fadeIn('slow');						
					}
			}
		else
			{
				//se oculta el div de imegenwes y se muestra el de expedientes
				$(".timeline-box").fadeIn('slow');
				$("#deimagenes").fadeOut('slow');	
				$("#deimagenes").html('');
				$("#botones").hide();	
				docactivo = 0;
			}
	}
	 function cierraderlado(){
			var derstyle =  $('#lderecho').attr('style');		
			$('#lderecho').removeClass('sb-active');	
			$('#lderecho').fadeOut('slow');
			$('#lderecho').attr('style','margin-right: -350px;'); 
			//$('.sb-right').length(0);

			//$('#tbimagenescen').css('width','100%');
		//	$('#image_central').css('width','100%');
			
			//$('#num_imgcen').attr('style','position:relative;float:right;font-size:2em;padding-right:50%');
			
			rightActive = false;
	  } 

	
   function verimagenes(id){
	   
	   var id_expediente = $('#'+id).attr('data-valor'); 

		var datoor = $('.slimScrollDiv').html();	

		var configdb = '{{ $ruta }}';

		var ira = 'expedientes.mostrar';

		var ruta = '{{ $ruta }}';

		var workspace = '{{ $workspace }}'; 
	
		//buscamos las imagenes de ese expedientes y las montamos en el div derecho
		var script = '';
		var enlacerecep = ruta+'/treepowerfile2/cargalo_documentos.php?otraoperation=dameimagenes'+'&id_expediente='+id_expediente+'&configdb='+configdb+'&workspace='+workspace; 
		$.ajax({
			   type: "GET",
			   async:false, 
			   url: enlacerecep,
			   success: function(msg){    
				   
				   script += msg;
				   
			   },
				error: function(x,err,msj){alert(msj) }
			  });
		

		$('.slimScrollDiv').attr('style','position: relative; overflow-x:none; overflow-y:auto;width: auto; height: 100%;')
		$('.slimScrollDiv').html(script); //sb-right

		$('.sb-left').fadeOut('fast');

		$('.sb-left').removeClass('sb-active');

		$('.sb-right').fadeIn('fast');

		$('.sb-right').addClass('sb-active');

		 $("img.lazy").lazyload({
	            effect: "fadeIn",
	            threshold: 100
	        });
	
   }

 
   function agregarleimagenes(id_tipodoc,id_expediente){

	   var configdb = '{{ $ruta }}';

	   var ruta = '{{ $ruta }}';

	   var buscar = '{{ $buscar }}'; 

	   var idusuario = '{{ $idusuario }}';

	   var workspace = '{{ $workspace }}';   

	   var ntipdoc = $('#agregaimg_'+id_tipodoc).text();
	   
		//se busca el id del docuemnto al que corresponda ese tipodocumental y expediente
	   var enlacerecep = ruta+'/treepowerfile2/cargalo_documentos.php?otraoperation=dameiddocumento'+'&id_expediente='+id_expediente+'&id_tipodoc='+id_tipodoc+'&configdb='+configdb+'&workspace='+workspace; 
		$.ajax({
		   type: "GET",
		   async:false, 
		   url: enlacerecep,
		   success: function(msg){   

		   		$('#id_tipodoc').val(id_tipodoc);	

		   		$('#id_documento').val(msg);

		   		$('#id_expediente').val(id_expediente);
		   		
		   		$('#paddimg').attr('src',ruta+"/treepowerfile2/arbol_agregaimg.php?id_tipodoc="+id_tipodoc+"&id_documento="+msg+"&id_expediente="+id_expediente+"&ruta="+ruta+"&id_usuario="+idusuario+"&buscar="+buscar+"&ntipdoc="+ntipdoc);

		   		//$('#modalgral').modal('show');    
		   		
		   		$('.timeline-box').fadeOut('slow');

		   		$('.popover').fadeOut('slow');

		   		$('#addimg').fadeIn('slow');
		   		   
			   
		   },
			error: function(x,err,msj){alert(msj) }
		  });
	   }

  function quedescarga(){
	  var primeroimg = 0;
	  
	  var ultimoimg = 0;

	  var ctlimg = 0;
	  	
	  $(".tiraimg").each(function(){
		  	ctlimg = ctlimg + 1
		  	
			var id = $(this).attr('id');

		  	
		  	
			if (ctlimg == 1)
				{
					primeroimg = $('#'+id).attr('data-num');
				} 
			
			ultimoimg = $('#'+id).attr('data-num');		 			
		});	

	  $('#desdeimg').val(primeroimg);

	  $('#hastaimg').val(ultimoimg);
	  
	  $('#modaldescarga').modal('show');   
	
  }
  
  $( "#descargardoc" ).click(function() { 

		$('#modaldescarga').modal('hide');
		
		$('#fondomodal').show();

		var idusuario = '{{ $idusuario }}'; 
		
		var ruta = 	'{{ $ruta }}';

		var permiorden = '{{ $permiorden }}';

	    var workspace = '{{ $workspace }}';

		var desdeimg =  $('#desdeimg').val();

		var hastaimg = $('#hastaimg').val();

		
		//se recorren las imagenes y solio se toman las seleccionadas dentro del rango
		
		var td1 = '';
		var td2 = '';
		var d = 0;
		if (desdeimg == hastaimg)
			{
					$(".tiraimg").each(function(){
						
						var id = $(this).attr('id'); 
		
						var num = $('#'+id).attr('data-num');
		
						if (num == desdeimg)
							{
								var valord1 = $('#'+id).attr('data-1');
								var valord2 = $('#'+id).attr('data-2');  
								if (d == 0)
									{
										d = $('#'+id).attr('data-d'); 
									}
								td1 += valord1+'_;_';
								td2 += valord2+'_;_';

								return false;
							}						
					});
			}			
		else
			{
				if (desdeimg < hastaimg)
					{
						$(".tiraimg").each(function(){
							
							var id = $(this).attr('id'); 
			
							var num = $('#'+id).attr('data-num'); 
			
							if (num >= desdeimg && num <= hastaimg)
								{
						
									var valord1 = $('#'+id).attr('data-1');
									var valord2 = $('#'+id).attr('data-2');  
									if (d == 0)
										{
											d = $('#'+id).attr('data-d'); 
										}
									td1 += valord1+'_;_';
									td2 += valord2+'_;_';
								}						
						});
					}
				else
					{
						if (hastaimg  < desdeimg)
							{
								$(".tiraimg").each(function(){
									
									var id = $(this).attr('id'); 
					
									var num = $('#'+id).attr('data-num');
					
									if (num >= hastaimg && num <= desdeimg)
										{
								
											var valord1 = $('#'+id).attr('data-1');
											var valord2 = $('#'+id).attr('data-2');  
											if (d == 0)
												{
													d = $('#'+id).attr('data-d'); 
												}
											td1 += valord1+'_;_';
											td2 += valord2+'_;_';
										}						
								});
							}
					}	
			}
		
		var tabla = ''; 
		var script = '';

		var laimg = '';
		var enlacerecep = ruta+'/treepowerfile2/cargalo_documentos.php?otraoperation=descargartodo'+'&d1='+td1+'&d2='+td2+'&iddoc='+d+'&idusuario='+idusuario+'&workspace='+workspace; 
		$.ajax({
		   type: "GET",
		   async:false, 
		   url: enlacerecep,
		   success: function(msg){   
			   
			   laimg = ruta+"/img/descargas/"+workspace+"/"+idusuario+"/Powerfiledoc_"+d+"_.pdf" ;   
			   				   
		   },
			error: function(x,err,msj){alert(msj) }
		  });

		if (permiorden == 1)
			{
				script +='<iframe id="print-iframe" name="print-iframe" src="/ViewerJS/./#'+laimg+'" height="1000" width="80%"></iframe>';
			}
		else
			{
				script +='<iframe id="print-iframe" name="print-iframe" src="/ViewerJS/./#'+laimg+'" height="1000" width="80%"></iframe>';
			}			

		if ($("#deimagenes").is(":visible") == true) 
			{ 
				//se montan las imagenes
				$("#deimagenes").html(script);
			}
		else
			{
				//se cargan las imagenes y se muestra el div de imagenes y se oculta el de los expedientes
				var options = {};
				$("#deimagenes").html(script);						
				$(".timeline-box").fadeOut('slow');
				$("#deimagenes").fadeIn('slow');	
				$("#botones" ).show();				
			}
		$('#fondomodal').hide();

		$('#fondomodal').hide();

		setTimeout(ajaa, 5000);

	

	});
  function ajaa(){
	  	//$('#print').hide();
		//$('#print-iframe').children();
	 	// $('#print').addClass('pruebal');

		  
	}

	function agregadocumento(){

		var configdb = '<?php echo $configdb;?>'; 
		var titdoc = '{{ trans('principal.titvvisor') }}'; 
		var idtpdoc = '<?php echo $idtpdoc;?>'; 
		var idnode = '<?php echo $idffolder;?>'; 
		var tablaid = '<?php echo $tablaid;?>'; 
		var expedid = '<?php echo $iddelexp;?>'; 
		var ruta = '<?php echo $ruta;?>'; 
		var workspace = '<?php echo $workspace;?>'; 
		
		
		$('#titulodocumentep').html(titdoc); 

    	//se buscan los indices que tenga registrados la carpeta seleccionada
		var enlacerecep = ruta+'/treepowerfile2/cargalo_documentos.php?otraoperation=dameindicesitems'+'&id_carpeta='+idnode+'&configdb='+configdb+'&idtpdoc='+idtpdoc+'&tablaid='+tablaid+'&expedid='+expedid+'&workspace='+workspace;     
		$.ajax({
			   type: "GET",
			   async:false, 
			   url: enlacerecep,
			   success: function(msg){         
				   $('#indicesitems').html(msg);   
				   
				   $(function() { "use strict";
				        $('.bootstrap-datepicker').bsdatepicker({
				            format: 'dd-mm-yyyy'
				        });
				    });


				   
			   },
				error: function(x,err,msj){ }
			  });	
		  
		$('#modaldocumentos').modal('show');   
		
	}


	$('#buscavisor').bind('click', function () {

		var workspace = '{{ $workspace }}';
		
		var ejecutar = $('#buscar').val();

		if (ejecutar == ''){ejecutar='_;_';}

		ejecutar = ejecutar.replace(/%/g, '_..._');

		ejecutar = ejecutar.replace('/', '_..._');

		ejecutar = $.trim(ejecutar);

		window.location.href = '{{ $ruta }}/'+workspace+'/expedientes/'+ejecutar+'/visor_lista';	
		
	});

	$('#buscar').keypress(function(e) {
		if(e.which == 13) { 
			var workspace = '{{ $workspace }}';
			
			var ejecutar = $('#buscar').val();
			
			if (ejecutar == ''){ejecutar='_;_';}
			
			ejecutar = ejecutar.replace(/%/g, '_..._');

			ejecutar = ejecutar.replace('/', '_..._');

			ejecutar = $.trim(ejecutar);
			
			window.location.href = '{{ $ruta }}/'+workspace+'/expedientes/'+ejecutar+'/visor_lista';	
		}		
	});
	
	$( "#guardardoc" ).click(function() { 

		var ruta = '<?php echo $ruta;?>';  
		var tablaid = '<?php echo $tablaid;?>';  
		var expedid = '<?php echo $iddelexp;?>';  
		var id_usuario = '<?php echo $idusuario;?>';  
		$('#modaldocumentos').modal('hide');	
		$('#formdocum').submit();

		
		var uo = 0;
		 $("#indicesitems input").each(function (index) 
   			 {
   			 	if (uo == 0)
   			 		{
			 			var childEl = $(this).val();
   			 		}
   			}) 	
		 
	});

	    function elzoom(id){
	 	   var zm = $('#'+id).val()+'%';
	 	   
	 	   $('#image_central').css("width",zm) ;
	 		
	    }     

	     
	$('div.alert').delay(3000).slideUp(300);


	function visor_dopc(iddocs){

		var espaciotrabajo = '<?php echo $_SESSION['espaciotrabajo'] ?>';

		var buscar = $('#buscar').val();   

		if (buscar == '')
			{
			buscar = '_;_';
			}
		buscar = buscar.replace(/%/g, '_..._');

		buscar = buscar.replace('/', '_..._');

		buscar = $.trim(buscar);
		
		var id_documento = iddocs;

		window.location.href = '{{ $ruta }}/'+espaciotrabajo+'/expedientes/'+id_documento+'/'+buscar+'/visor_listado';
		
		
	}

	function marcame(idu){  
		var iddeuser = $('#'+idu).attr('data-idusuariosel'); 
		if ($('#im_'+iddeuser).hasClass('escogido'))
			{
				var nid_eenviara = '';
				$('#im_'+iddeuser).removeClass('escogido');
				var id_eenviara = $('#id_eenviara').val(); 	
				var id_eenviara2 = id_eenviara.split('_;_');
				for (i = 0; i < id_eenviara2.length; i++) {   
					if (parseInt(id_eenviara2[i]) != parseInt(iddeuser))
						{
							if (parseInt(id_eenviara2[i])> 0)
								{
									nid_eenviara += id_eenviara2[i]+'_;_';
								}	
						}
				}
				$('#id_eenviara').val(nid_eenviara); 	
				 
			}
		else
			{
				$('#im_'+iddeuser).addClass('escogido');
				var id_eenviara = $('#id_eenviara').val(); 	
				id_eenviara += iddeuser+'_;_';
				$('#id_eenviara').val(id_eenviara); 	
			}
		
		
	}

	function verzip(id){
		var archivodelzip = $('#'+id).attr('data-arzip');  
		var archivopadre = $('#'+id).attr('data-archivopadre'); 
		
		var configdb = '<?php echo $configdb;?>'; 
		var ruta = '<?php echo $ruta;?>'; 
		var espaciotrabajo = '<?php echo $_SESSION['espaciotrabajo'] ?>';
		var destino = '../img/apiimg/'+espaciotrabajo+'/';

		var workspace = '<?php echo $workspace;?>'; 
		///////////// los valores ///////////////////////
		
		var bod = $('#'+id).attr('data-bod');   
		var ordenimg = $('#'+id).attr('data-ordenimg');     
		var d = $('#'+id).attr('data-d');
		var uno = $('#'+id).attr('data-1');
		var dos = $('#'+id).attr('data-2');
		var num = $('#'+id).attr('data-num');  
		var exp = $('#'+id).attr('data-exp'); 
	
	
		
		var enlacerecep = ruta+'/treepowerfile2/cargalo_documentos.php?otraoperation=extraezip'+'&destino='+destino+'&configdb='+configdb+'&archivodelzip='+archivodelzip+'&archivopadre='+archivopadre+'&workspace='+workspace+'&bod='+bod+'&ordenimg='+ordenimg+'&d='+d+'&uno='+uno+'&dos='+dos+'&num='+num+'&exp='+exp;     

		$.ajax({
			   type: "GET",
			   async:false, 
			   url: enlacerecep,
			   success: function(msg){   
				   $('#imagen_visual').html(msg); 
				   $('#num_imgcen').html(num);
				   $('#imagen_visual').attr('data-imgact',num); 
			   },
				error: function(x,err,msj){ }
			  });	
		
	}
	
	
</script>




@endsection


