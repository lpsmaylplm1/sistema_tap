<!DOCTYPE html>
<html>
	<head>
		<title>Tablas de aplicabilidad</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link  rel="icon"   href="http://localhost:8080/sistema_tap/assets/images/favicon.ico" type="image/ico" >
		<!--Import Google Icon Font-->

		<link rel="stylesheet" href="http://localhost:8080/sistema_tap/assets/back_end/css/icon.css">
		<!-- Compiled and minified CSS -->
		<link rel="stylesheet" href="http://localhost:8080/sistema_tap/assets/back_end/css/materialize.min.css">
		<link rel="stylesheet" href="http://localhost:8080/sistema_tap/assets/back_end/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="http://localhost:8080/sistema_tap/assets/back_end/css/responsive.dataTables.min.css">
		<script>
			document.addEventListener('DOMContentLoaded', function () {
				M.AutoInit();
			});
		</script> 
		<script    src="http://localhost:8080/sistema_tap/assets/back_end/js/jquery-3.5.0.js"  ></script>
		<script    src="http://localhost:8080/sistema_tap/assets/back_end/js/jquery.dataTables.min.js" ></script> 
		<script    src="http://localhost:8080/sistema_tap/assets/back_end/js/dataTables.responsive.min.js" ></script>
	</head>
	<body>
		<div class="navbar-fixed">

			<!-- Dropdown Structure -->
			<ul id="menu-drop" class="dropdown-content">

				<li class="divider"></li>
				<li><a href=""</li>
			</ul>

			<nav class="orange darken-4">
				<div class="nav-wrapper container">
					<a class="brand-logo">   <img class="responsive-img"  src="http://localhost:8080/sistema_tap/assets/images/logo_small.png">        </a>
					<a href="#" data-target="menu-responsive" class="sidenav-trigger"> <i class="material-icons">menu</i> </a>
					<ul class="right hide-on-med-and-down">
						<!-- Dropdown Trigger -->
						<li><a   href="http://localhost:8080/sistema_tap/login/logout"> <i class="tiny material-icons right"> exit_to_app</i>  Cerrar sesión</a></li>

					</ul>
				</div>
			</nav>

		</div>
		<!--		<ul class="sidenav" id="menu-responsive">
					<li><a href="#"><i class="material-icons ">send</i> Enlace 1</a></li>
					<li><a href="#"><i class="material-icons">send</i> Enlace 2</a></li>
					 Dropdown Trigger 
					<li><a class="dropdown-trigger" href="#!" data-target="menu-drop"><strong>Login</strong><i class="material-icons right">arrow_drop_down</i></a></li>
				</ul>-->	<div class="container  section">
			<a href="#" class="sidenav-trigger" data-target="menu-side"><i class="material-icons">menu</i></a>
			<ul class="sidenav" id="menu-side">
				<li>
					<div class="user-view">
						<div class="background">
							<img src="http://localhost:8080/sistema_tap/assets/images/background_profile.jpg" alt="" />
						</div>
						<div class="center">
							<a href="#!" ><img src="http://localhost:8080/sistema_tap/assets/images/logo_circle.png" alt="" class="circle"/></a>	
						</div>

						<a href="#!"><span class="name white-text"><b>Jenipher Betzaida Pech Pérez</b></span></a>
						<a href="#!"><span class="email white-text">unidaddetransparencia@cotaipec.org.mx</span></a>
					</div>
				</li>

				<li class="no-padding">
					<ul class="collapsible collapsible-accordion">
						<li>
							<a class="collapsible-header"><i class="material-icons">people</i> Usuarios<i class="material-icons right">keyboard_arrow_down</i></a>
							<div class="collapsible-body">
								<ul>
									<li><a href="http://localhost:8080/sistema_tap/usuarios/adduser"><i class="material-icons">person_add</i>Registrar usuarios</a></li>
									<li><a href="http://localhost:8080/sistema_tap/usuarios"><i class="material-icons">edit</i>Operaciones con usuarios</a></li>
								</ul>
							</div>
						</li>
					</ul>
				</li>
				<li>
					<div class="divider"></div>
				</li>
				<li class="no-padding">
					<ul class="collapsible collapsible-accordion">
						<li>
							<a class="collapsible-header"><i class="material-icons">settings_applications</i> Admin. configuración<i class="material-icons right">keyboard_arrow_down</i></a>
							<div class="collapsible-body">
								<ul>
									<li><a href="http://localhost:8080/sistema_tap/tablas_ap"><i class="material-icons">perm_data_setting</i>Configurar aplicabilidad</a></li>

								</ul>
							</div>
						</li>
					</ul>
				</li>
				<li>
					<div class="divider"></div>
				</li>
			</ul>
		</ul>
	</div>
	<div class="container">
		<div class="row">
			<div class="col s12 ">
				<div class="card hoverable">
					<div class="card-image">
						<img src="http://localhost:8080/sistema_tap/assets/images/background_card.jpg">
						<span class="card-title" style="text-shadow: 1px 1px 1px black"><i class="material-icons " style="vertical-align: -3px;">person_add</i> <strong>Configurar aplicabilidad de fracciones</strong></span>
					</div>
					<div class="card-content section">
						<div class="row">
							<div class="col s12 ">
								<i class="material-icons">border_color</i> &nbsp; <b>Proporcione los siguientes datos:</b>
							</div>
							<a name="inicio"></a>
						</div>

						<div class="row">
							<div class="input-field col s11 m11 l11 ">
								<i class="material-icons prefix">format_list_numbered</i>
								<select  name="articulo" id="articulo">
									<option value=""  selected disabled="">Seleccione artículo</option>
									<option value="1" >Art. 74.-Obligaciones Comunes en materia de transparencia</option> 
									<option value="2" >Art. 75.-Poder Ejecutivo del Estado de Campeche</option> 
									<option value="3" >Art. 76.-Municipios</option> 
									<option value="4" >Art. 77.-Poder Legislativo del Estado de Campeche</option> 
									<option value="5" >Art. 78.-Poder Judicial del Estado de Campeche</option> 
									<option value="6" >Art. 79.-Organismos Autónomos</option> 
									<option value="7" >Art. 80.-Instituciones de Educación Superior dotadas de Autonomía</option> 
									<option value="8" >Art. 81.-Partidos Políticos</option> 
									<option value="9" >Art. 82.-Fideicomisos y Fondos Públicos</option> 
									<option value="10" >Art. 83.-Autoridades administrativas y jurisdiccionales en materia laboral</option> 
									<option value="11" >Art. 84.-Sindicatos</option> 
									<option value="12" >Art. 71.-LGTAIP</option> 
								</select>
								<label >Artículo</label>
								<div class="row margin" style="display: none"  id="pre-load">
									<div class="container">
										<div class="progress">
											<div class="indeterminate"></div>
										</div>
									</div>

								</div>
							</div>
							<div class="input-field col s1 m1 l1 ">
								<button id="refresh" class="btn waves-effect waves-light  tooltipped"  data-position="top" data-tooltip="Recargar fracciones "><i class="material-icons">refresh</i></button>
							</div>
							<div class="input-field col s11 m11 l11 " id="o_a" style="display: none">
								<i class="material-icons prefix">library_add</i>
								<select  name="select_so" id="select_oa">
									<option value=""  selected disabled="">Seleccione Sujeto obligado</option>
									<option value="116"  >Comisión de Derechos Humanos del Estado de Campeche</option>
									<option value="117"  >Comisión de Transparencia y Acceso a la Información Pública del Estado de Campeche</option>
									<option value="118"  >Fiscalía Especializada en Combate a la Corrupción del Estado de Campeche</option>
									<option value="119"  >Instituto Electoral del Estado de Campeche</option>
									<option value="120"  >Tribunal de Justicia Administrativa del Estado de Campeche</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col s12 m12 l12 ">
								<div id="detail_frac">

									<div id="fracciones_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="fracciones_length"><label>Mostrar <div class="select-wrapper"><input class="select-dropdown dropdown-trigger" type="text" readonly="true" data-target="select-options-1a9a5c74-c36a-013b-cafe-e531177962cc"><ul id="select-options-1a9a5c74-c36a-013b-cafe-e531177962cc" class="dropdown-content select-dropdown" tabindex="0"><li id="select-options-1a9a5c74-c36a-013b-cafe-e531177962cc0" tabindex="0" class="selected"><span>10</span></li><li id="select-options-1a9a5c74-c36a-013b-cafe-e531177962cc1" tabindex="0"><span>25</span></li><li id="select-options-1a9a5c74-c36a-013b-cafe-e531177962cc2" tabindex="0"><span>50</span></li><li id="select-options-1a9a5c74-c36a-013b-cafe-e531177962cc3" tabindex="0"><span>100</span></li></ul><svg class="caret" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg><select name="fracciones_length" aria-controls="fracciones" class="" tabindex="-1"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></div> registros</label></div><div id="fracciones_filter" class="dataTables_filter"><label><b>BUSCAR:</b><input type="search" class="" placeholder="" aria-controls="fracciones"></label></div><table id="fracciones" class="display responsive nowrap dataTable no-footer dtr-inline" role="grid" aria-describedby="fracciones_info" style="width: 95%;" width="95%">
											<thead>
												<tr role="row"><th style="font-size: 12px; width: 74px;" class="sorting_asc" tabindex="0" aria-controls="fracciones" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Artículo: Ordenar la columna en forma Descendente">Artículo</th><th style="font-size: 12px; width: 112px;" class="sorting" tabindex="0" aria-controls="fracciones" rowspan="1" colspan="1" aria-label="Fracción: Ordenar la columna en forma Ascendente">Fracción</th><th style="font-size: 12px; width: 373px;" class="sorting" tabindex="0" aria-controls="fracciones" rowspan="1" colspan="1" aria-label="Descripción: Ordenar la columna en forma Ascendente">Descripción</th><th style="font-size: 14px; width: 129px;" class="sorting" tabindex="0" aria-controls="fracciones" rowspan="1" colspan="1" aria-label="Operaciones: Ordenar la columna en forma Ascendente">Operaciones</th></tr></thead>
											<tbody>


































































































												<tr role="row" class="odd">
													<td style="font-size:12px " tabindex="0" class="sorting_1"><i class="tiny material-icons" style="vertical-align: -2px;">local_library</i> Art.-74</td>
													<td style="font-size:12px ">I</td>
													<td style="font-size:12px ">El marco normativo aplicable al sujeto obligado,<br>en el que deberá incluirse leyes, códigos,<br>reglamentos, decretos de creación, manuales<br>administrativos, reglas de operación, criterios,<br>políticas, entre otros; </td>
													<td style="font-size:12px ">
														<a href="#!" class=" waves-effect waves-light btn-small btn-floating   btn tooltipped add_fund" id="1" data-position="top" data-tooltip="Agregar / Editar fundamentación "><i class="material-icons">add_circle</i></a> &nbsp;
														<a href="#!" class=" waves-effect waves-light btn-small btn-floating orange darken-4  btn tooltipped view_fund" id="1" data-position="top" data-tooltip="Ver fundamentación "><i class="material-icons">pageview</i></a>
													</td>
												</tr><tr role="row" class="even">
													<td style="font-size:12px " tabindex="0" class="sorting_1"><i class="tiny material-icons" style="vertical-align: -2px;">local_library</i> Art.-74</td>
													<td style="font-size:12px ">II</td>
													<td style="font-size:12px ">Su estructura orgánica completa, en un formato<br>que permita vincular cada parte de la estructura,<br>las atribuciones y responsabilidades que le<br>corresponden a cada servidor público, prestador<br>de servicios profesionales o miembro de los<br>sujetos obligados, de conformidad con las<br>disposiciones aplicables</td>
													<td style="font-size:12px ">
														<a href="#!" class=" waves-effect waves-light btn-small btn-floating   btn tooltipped add_fund" id="2" data-position="top" data-tooltip="Agregar / Editar fundamentación "><i class="material-icons">add_circle</i></a> &nbsp;
														<a href="#!" class=" waves-effect waves-light btn-small btn-floating orange darken-4  btn tooltipped view_fund" id="2" data-position="top" data-tooltip="Ver fundamentación "><i class="material-icons">pageview</i></a>
													</td>
												</tr><tr role="row" class="odd">
													<td style="font-size:12px " tabindex="0" class="sorting_1"><i class="tiny material-icons" style="vertical-align: -2px;">local_library</i> Art.-74</td>
													<td style="font-size:12px ">III</td>
													<td style="font-size:12px ">Las facultades de cada área; </td>
													<td style="font-size:12px ">
														<a href="#!" class=" waves-effect waves-light btn-small btn-floating   btn tooltipped add_fund" id="3" data-position="top" data-tooltip="Agregar / Editar fundamentación "><i class="material-icons">add_circle</i></a> &nbsp;
														<a href="#!" class=" waves-effect waves-light btn-small btn-floating orange darken-4  btn tooltipped view_fund" id="3" data-position="top" data-tooltip="Ver fundamentación "><i class="material-icons">pageview</i></a>
													</td>
												</tr><tr role="row" class="even">
													<td style="font-size:12px " tabindex="0" class="sorting_1"><i class="tiny material-icons" style="vertical-align: -2px;">local_library</i> Art.-74</td>
													<td style="font-size:12px ">IV</td>
													<td style="font-size:12px ">Las metas y objetivos de las áreas, de<br>conformidad con sus programas operativos</td>
													<td style="font-size:12px ">
														<a href="#!" class=" waves-effect waves-light btn-small btn-floating   btn tooltipped add_fund" id="4" data-position="top" data-tooltip="Agregar / Editar fundamentación "><i class="material-icons">add_circle</i></a> &nbsp;
														<a href="#!" class=" waves-effect waves-light btn-small btn-floating orange darken-4  btn tooltipped view_fund" id="4" data-position="top" data-tooltip="Ver fundamentación "><i class="material-icons">pageview</i></a>
													</td>
												</tr><tr role="row" class="odd">
													<td style="font-size:12px " tabindex="0" class="sorting_1"><i class="tiny material-icons" style="vertical-align: -2px;">local_library</i> Art.-74</td>
													<td style="font-size:12px ">V</td>
													<td style="font-size:12px ">Los indicadores relacionados con temas de interés<br>público o trascendencia social que conforme a sus<br>funciones, deban establecer</td>
													<td style="font-size:12px ">
														<a href="#!" class=" waves-effect waves-light btn-small btn-floating   btn tooltipped add_fund" id="5" data-position="top" data-tooltip="Agregar / Editar fundamentación "><i class="material-icons">add_circle</i></a> &nbsp;
														<a href="#!" class=" waves-effect waves-light btn-small btn-floating orange darken-4  btn tooltipped view_fund" id="5" data-position="top" data-tooltip="Ver fundamentación "><i class="material-icons">pageview</i></a>
													</td>
												</tr><tr role="row" class="even">
													<td style="font-size:12px " tabindex="0" class="sorting_1"><i class="tiny material-icons" style="vertical-align: -2px;">local_library</i> Art.-74</td>
													<td style="font-size:12px ">VI</td>
													<td style="font-size:12px ">Los indicadores que permitan rendir cuenta de sus<br>objetivos y resultados</td>
													<td style="font-size:12px ">
														<a href="#!" class=" waves-effect waves-light btn-small btn-floating   btn tooltipped add_fund" id="6" data-position="top" data-tooltip="Agregar / Editar fundamentación "><i class="material-icons">add_circle</i></a> &nbsp;
														<a href="#!" class=" waves-effect waves-light btn-small btn-floating orange darken-4  btn tooltipped view_fund" id="6" data-position="top" data-tooltip="Ver fundamentación "><i class="material-icons">pageview</i></a>
													</td>
												</tr><tr role="row" class="odd">
													<td style="font-size:12px " tabindex="0" class="sorting_1"><i class="tiny material-icons" style="vertical-align: -2px;">local_library</i> Art.-74</td>
													<td style="font-size:12px ">VII</td>
													<td style="font-size:12px ">El directorio de todos los servidores públicos, a<br>partir del nivel de jefe de departamento o su<br>equivalente, o de menor nivel, cuando se brinde<br>atención al público; manejen o apliquen recursos<br>públicos; realicen actos de autoridad o presten<br>servicios profesionales bajo el régimen de<br>confianza u honorarios y personal de base. El<br>directorio deberá incluir, al menos el nombre,<br>cargo o nombramiento asignado, nivel del puesto en<br>la estructura orgánica, fecha de alta en el<br>cargo, número telefónico, domicilio para recibir<br>correspondencia y dirección de correo<br>electrónico oficiales</td>
													<td style="font-size:12px ">
														<a href="#!" class=" waves-effect waves-light btn-small btn-floating   btn tooltipped add_fund" id="7" data-position="top" data-tooltip="Agregar / Editar fundamentación "><i class="material-icons">add_circle</i></a> &nbsp;
														<a href="#!" class=" waves-effect waves-light btn-small btn-floating orange darken-4  btn tooltipped view_fund" id="7" data-position="top" data-tooltip="Ver fundamentación "><i class="material-icons">pageview</i></a>
													</td>
												</tr><tr role="row" class="even">
													<td style="font-size:12px " tabindex="0" class="sorting_1"><i class="tiny material-icons" style="vertical-align: -2px;">local_library</i> Art.-74</td>
													<td style="font-size:12px ">VIII</td>
													<td style="font-size:12px ">La remuneración bruta y neta de todos los<br>servidores públicos de base o de confianza, de<br>todas las percepciones, incluyendo sueldos,<br>prestaciones, gratificaciones, primas, comisiones,<br>dietas, bonos, estímulos, ingresos y sistemas de<br>compensación, señalando la periodicidad de dicha<br>remuneración</td>
													<td style="font-size:12px ">
														<a href="#!" class=" waves-effect waves-light btn-small btn-floating   btn tooltipped add_fund" id="8" data-position="top" data-tooltip="Agregar / Editar fundamentación "><i class="material-icons">add_circle</i></a> &nbsp;
														<a disabled="" href="#!" class=" waves-effect waves-light btn-small btn-floating orange darken-4  btn tooltipped view_fund" id="8" data-position="top" data-tooltip="Ver fundamentación "><i class="material-icons">pageview</i></a>
													</td>
												</tr><tr role="row" class="odd">
													<td style="font-size:12px " tabindex="0" class="sorting_1"><i class="tiny material-icons" style="vertical-align: -2px;">local_library</i> Art.-74</td>
													<td style="font-size:12px ">IX</td>
													<td style="font-size:12px ">Los gastos de representación y viáticos, así<br>como el objeto e informe de la comisión<br>correspondiente</td>
													<td style="font-size:12px ">
														<a href="#!" class=" waves-effect waves-light btn-small btn-floating   btn tooltipped add_fund" id="9" data-position="top" data-tooltip="Agregar / Editar fundamentación "><i class="material-icons">add_circle</i></a> &nbsp;
														<a disabled="" href="#!" class=" waves-effect waves-light btn-small btn-floating orange darken-4  btn tooltipped view_fund" id="9" data-position="top" data-tooltip="Ver fundamentación "><i class="material-icons">pageview</i></a>
													</td>
												</tr><tr role="row" class="even">
													<td style="font-size:12px " tabindex="0" class="sorting_1"><i class="tiny material-icons" style="vertical-align: -2px;">local_library</i> Art.-74</td>
													<td style="font-size:12px ">X</td>
													<td style="font-size:12px ">El número total de las plazas y del personal de<br>base y confianza, especificando el total de las<br>vacantes, por nivel de puesto, para cada unidad<br>administrativa</td>
													<td style="font-size:12px ">
														<a href="#!" class=" waves-effect waves-light btn-small btn-floating   btn tooltipped add_fund" id="10" data-position="top" data-tooltip="Agregar / Editar fundamentación "><i class="material-icons">add_circle</i></a> &nbsp;
														<a disabled="" href="#!" class=" waves-effect waves-light btn-small btn-floating orange darken-4  btn tooltipped view_fund" id="10" data-position="top" data-tooltip="Ver fundamentación "><i class="material-icons">pageview</i></a>
													</td>
												</tr></tbody>
										</table><div class="dataTables_info" id="fracciones_info" role="status" aria-live="polite">Mostrando 1  de 10  de un total de 49 registros</div><div class="dataTables_paginate paging_simple_numbers" id="fracciones_paginate"><a class="paginate_button previous disabled" aria-controls="fracciones" data-dt-idx="0" tabindex="-1" id="fracciones_previous">Anterior</a><span><a class="paginate_button current" aria-controls="fracciones" data-dt-idx="1" tabindex="0">1</a><a class="paginate_button " aria-controls="fracciones" data-dt-idx="2" tabindex="0">2</a><a class="paginate_button " aria-controls="fracciones" data-dt-idx="3" tabindex="0">3</a><a class="paginate_button " aria-controls="fracciones" data-dt-idx="4" tabindex="0">4</a><a class="paginate_button " aria-controls="fracciones" data-dt-idx="5" tabindex="0">5</a></span><a class="paginate_button next" aria-controls="fracciones" data-dt-idx="6" tabindex="0" id="fracciones_next">Siguiente</a></div></div>

									<script type="text/javascript">
			$(document).ready(function () {
				base_url = "http://localhost:8080/sistema_tap/";
				$('select').formSelect();
				$('.tooltipped').tooltip();
				$("#load_data_fund").empty();
			});
			$("body").on('click', ".add_fund", function () {
				$("#load_data_fund").empty();
				base_url = "http://localhost:8080/sistema_tap/";
				var id_frac = $(this).attr("id");
				$("#data_fundamenta").modal('open');
				$.ajax({
					async: true,
					type: "POST",
					url: base_url + "tablas_ap/add_fundamenta",
					data: 'id_frac=' + id_frac,
					dataType: "html",
					beforeSend: function () {
						$("#load_data_fund").empty();
					},
					success: function (load)
					{

						$("#load_data_fund").empty();
						$("#load_data_fund").append(load);

					}
				});
			});
			$("body").on('click', ".view_fund", function () {
				$("#load_data_fund").empty();
				base_url = "http://localhost:8080/sistema_tap/";
				var id_frac = $(this).attr("id");
				$("#data_fundamenta").modal('open');
				$.ajax({
					async: true,
					type: "POST",
					url: base_url + "tablas_ap/view_fundamenta",
					data: 'id_frac=' + id_frac,
					dataType: "html",
					beforeSend: function () {
						$("#load_data_fund").empty();
					},
					success: function (load)
					{

						$("#load_data_fund").empty();
						$("#load_data_fund").append(load);

					}
				});
			});

			$('#fracciones').DataTable({
				language: {
					processing: "Procesando...",
					search: "<b>BUSCAR:</b>",
					lengthMenu: "Mostrar _MENU_ registros",
					info: "Mostrando _START_  de _END_  de un total de _TOTAL_ registros",
					infoEmpty: "Mostrando  0 coincidencias",
					infoFiltered: "(de un total de _MAX_ registros)",
					infoPostFix: "",
					loadingRecords: "Cargando...",
					zeroRecords: "No existen registros que mostrar",
					emptyTable: "No existen registros en la tabla",
					paginate: {
						first: "Primer",
						previous: "Anterior",
						next: "Siguiente",
						last: "Último"
					},
					aria: {
						sortAscending: ": Ordenar la columna en forma Ascendente",
						sortDescending: ": Ordenar la columna en forma Descendente"
					}

				}

			});
									</script></div>

							</div>
						</div>

						<div class="row margin"  style="display: none" id="pre-saving">
							<div class="progress">
								<div class="indeterminate"></div>
							</div>
						</div>

						<div class="row  ">
							<div class="col s12"  id="validation_errors">

							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div id="data_fundamenta" class="modal bottom-sheet  "> <!--MODAL -->
			<div class="modal-content">
				<div id="load_data_fund">

				</div>
			</div>

		</div>

		<script type="text/javascript">
			$(document).ready(function () {
				base_url = "http://localhost:8080/sistema_tap/";
				$('select').formSelect();
				$('#detail_frac').empty();

			});

			//		$("body").on('change', "#articulo", function () {
			//			$('#detail_frac').empty();
			//			var id_art = $('#articulo').val();
			//			if (id_art === "6") {
			//				$("#o_a").show();
			//				$("body").one('change', "#select_oa", function () {
			//					$('#detail_frac').empty();
			//					var id_oa = $("#select_oa").val();
			//					alert(id_oa);
			//				});
			//			} else {
			//				$("#o_a").hide();
			//				var select_o_a = $('#select_oa');
			//				select_o_a.val(select_o_a.children('option:first').val());
			//				URL = base_url + "tablas_ap/select_fraccion";
			//				$.ajax({
			//					async: true,
			//					type: "POST",
			//					url: URL,
			//					data: {'id_art': id_art},
			//					dataType: "html",
			//					beforeSend: function () {
			//						$('#pre-load').show();
			//						$('#detail_frac').empty();
			//					},
			//					success: function (data) {
			//						$('#pre-load').hide();
			//						$('#detail_frac').html(data);
			//					}
			//				});
			//			}
			//		});
			$("#refresh").on("click", function (event) {
				$('#detail_frac').empty();

				var id_art = $('#articulo').val();
				if (id_art === "6") {
					$("#o_a").show();
					$("body").one('change', "#select_oa", function () {
						var id_oa = $("#select_oa").val();
						alert(id_oa);
					});
				} else {
					$("#o_a").hide();
					var select_o_a = $('#select_oa');
					select_o_a.val(select_o_a.children('option:first').val());
					URL = base_url + "tablas_ap/select_fraccion";
					$.ajax({
						async: true,
						type: "POST",
						url: URL,
						data: {'id_art': id_art},
						dataType: "html",
						beforeSend: function () {
							$('#pre-load').show();
							console.log("saliendo");
						},
						success: function (upd) {
							$('#pre-load').hide();
							console.log("llegando");
							$('#detail_frac').html(upd);
						}
					});
				}
			});

		</script><scritp src="http://localhost:8080/sistema_tap/assets/front_end/js/jquery_code.js" ></scritp>	
		<!-- Compiled and minified JavaScript -->
		<script    src="http://localhost:8080/sistema_tap/assets/back_end/js/materialize.min.js" ></script>
</body>
</html>
