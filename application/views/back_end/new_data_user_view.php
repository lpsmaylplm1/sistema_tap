<div class="container">
	<div class="row">
		<div class="col s12 ">
			<div class="card hoverable">
				<div class="card-image">
					<img src="<?php echo base_url('assets/images/background_card.jpg') ?>">
					<span class="card-title" style="text-shadow: 1px 1px 1px black"><i class="material-icons " style="vertical-align: -3px;">person_add</i> <strong>Registrar nuevo usuario del sistema</strong></span>
				</div>
				<div class="card-content section">
					<div class="row">
						<div class="col s12 ">
							<i class="material-icons">border_color</i> &nbsp; <b>Proporcione los siguientes datos:</b>
						</div>
						<a name="inicio"></a>
					</div>
					<form class="col s12" name="load_data_user" id="load_data_user" >
						<div class="row">
							<div class="input-field col s12 m6 l6 ">
								<i class="material-icons prefix">supervisor_account</i>
								<select  name="tipo_usuario" id="tipo_usuario">
									<option value=""  selected disabled="">Seleccione</option>
									<option value="1" data-icon="<?php echo base_url('assets/images/icon_rut.png') ?>" class="left"> Responsable Unidad de Transparencia</option> 
									<option value="2"  data-icon="<?php echo base_url('assets/images/icon_admin.png') ?>" class="left"> Administrador General</option>
								</select>
								<label >Tipo  de usuario</label>
							</div>
							<div class="input-field col s12 m6 l6 ">
								<i class="material-icons prefix">add_to_photos</i>
								<select  name="cat_so" id="cat_so" >
									<option value=""  selected disabled="" class="truncate">Seleccione</option>
									<?php foreach ($select_cat as $cat): ?>
										<option value="<?php echo $cat->id_categoria ?>"> <?php echo $cat->descrip_categoria ?></option>
									<?php endforeach ?>
								</select>
								<label for="cat_so">Categoría</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m9 l9 " style="font-size: x-small;">
								<i class="material-icons prefix">apartment</i>
								<select  name="nombre_so" id="nombre_so"   >

								</select>
								<label for="nombre_so"> Sujeto Obligado</label>
							</div>
							<input type="hidden" name="id_ayu" id="id_ayu" value="" />
							<div class="input-field col s12 m3 l3">

								<i class="material-icons prefix">location_on </i>
								<input  type="text"  id="ubicacion" name="ubicacion" placeholder="--" readonly="">
								<label for="ubicacion" >Ubicación Geográfica</label>
							</div>


						</div>
						<div class="row">
							<div class="input-field col s12 m6 l4 ">
								<i class="material-icons prefix">account_box</i>
								<input type="text"  id="usuario" name="usuario"  >
								<label for="usuario">Usuario</label>
							</div>
							<div class="input-field col s12 m6 l4 ">
								<i class="material-icons prefix">vpn_key</i>
								<input type="password" id="password1" name="password1"  >
								<label for="password1">Contraseña</label>
							</div>
							<div class="input-field col s12 m6 l4 ">
								<i class="material-icons prefix">vpn_key</i>
								<input type="password"  id="password2" name="password2"  >
								<label for="password2">Confirmar Contraseña</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m12 l12 "  style="text-align: center"> 
								<div class="switch">
									<label>
										Usuario Inactivo
										<input type="checkbox" checked="" name="is_active" id="is_active" value="1">
										<span class="lever"></span>
										Usuario Activo
									</label>
								</div>
							</div>
						</div>
					</form>
					<div class="row margin"  style="display: none" id="pre-saving">
						<div class="progress">
							<div class="indeterminate"></div>
						</div>
					</div>
					<div class="row center  ">
						<div class="col s12 green-text text-darken-1"  id="confirm_save_user">

						</div>
					</div>
					<div class="row  ">
						<div class="col s12"  id="validation_errors">

						</div>
					</div>
					<!--<div class="card-action">-->
					<div class="center-align">
						<button  id="btn_submit_edit" class="waves-effect waves-light btn  " ><i class="material-icons left">save</i> Registrar  usuario</button> 
						<button  id="reset" class="waves-effect waves-light btn  red darken-4" ><i class="material-icons left">cancel</i> Cancelar y limpiar</button> 
					</div>
					<!--</div>-->
				</div>
			</div>
		</div>
	</div>
	<div class="row section">
		<div class="col s12 ">
			<div class="card hoverable">
				<div class="card-image">
					<img src="<?php echo base_url('assets/images/background_gral.jpg') ?>">
					<span class="card-title" style="text-shadow: 1px 1px 1px black"><i class="material-icons" style="vertical-align: -5px;">people</i> <strong>Lista de usuarios registrados en el sistema</strong></span>
				</div>
				<div class="card-content section">
					<div class="row">

						<div class="row col s12">
							<table id="lista_user" class="display responsive nowrap" style="width:100%">
								<thead>
									<tr>
										<th>Usuario</th>
										<th>Sujeto Obligado</th>
										<th>Tipo Usuario</th>
										<th>Categoría </th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($select_usr as $data_user): ?>
										<tr>
											<td><i class="material-icons" style="vertical-align: -5px;">how_to_reg</i> <?php echo $data_user->usuario ?></td>
											<td><?php echo wordwrap($data_user->nombre_so, 35, "<br>", TRUE); ?></td>
											<td><i class="tiny material-icons" style="vertical-align: -5px;">radio_button_checked</i> <?php echo $data_user->descrip_nivel ?></td>
											<td><?php echo wordwrap($data_user->descrip_categoria, 35, "<br>", TRUE); ?></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row margin"  style="display: none" id="pre-saving">
						<div class="progress">
							<div class="indeterminate"></div>
						</div>
					</div>
					<div class="row center  ">
						<div class="col s12 green-text text-darken-1"  id="confirm_save_user">

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
</div>
<div class="fixed-action-btn">
	<a href="" class="btn-floating red btn-large"><i class="material-icons large">home</i></a>
		<ul>
			<li>
				<a href="<?php echo base_url('usuarios')  ?>" class="btn-floating blue tooltipped" data-position="left" data-tooltip="Editar usuarios"><i class="material-icons">edit</i></a>
			</li>
		</ul>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		base_url = "<?php echo base_url(); ?>";
		$('select').formSelect();
	});
	$('#lista_user').DataTable({
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
	base_url = "<?php echo base_url(); ?>";
	$("body").on('change', "#cat_so", function () {
		URL = base_url + "usuarios/select_so_cat";
		//			$('#cat_so').on('change', function () {
		var id_cat = $('#cat_so').val();
		$.ajax({
			type: "POST",
			url: URL,
			data: {'id_cat': id_cat},
			dataType: "html",
			beforeSend: function () {
				$('#ubicacion').val('');
			},
			success: function (data) {
				$('#nombre_so').html(data);
				$('select').formSelect();
			}
		});
	});
	$('#nombre_so').on('change', function () {
		base_url = "<?php echo base_url(); ?>";
		URL = base_url + "usuarios/select_ubicacion";
		var id_cat = $('#nombre_so').val();
		$.ajax({
			type: "POST",
			url: URL,
			data: {'id_cat': id_cat},
			dataType: "html",
			success: function (data) {
				var ubica = JSON.parse(data);
				var newval = ubica.value;
				var id_ayu = ubica.id_ayu;
				$('#id_ayu').val(id_ayu);
				$('#ubicacion').val(newval);
				$('#usuario').focus();
			}
		});
	});

	$('#usuario').on('blur', function () {

		base_url = "<?php echo base_url(); ?>";
		URL = base_url + "usuarios/seek_usr";
		var user = $(this).val();
		$.ajax({
			type: "POST",
			url: URL,
			data: {'user': user},
			dataType: "html",
			success: function (data) {
				$('#validation_errors').html(data);
			}
		});
	});

	$('#btn_submit_edit').click(function () {
		$("#btn_submit_edit").prop('disabled', true);
		URL = base_url + "usuarios/save_user";
		$.ajax({
			type: "POST",
			url: URL,
			data: $("#load_data_user").serialize(),
			dataType: "html",
			beforeSend: function () {
				$("#validation_erros").empty();
				$("#confirm_save_user").empty();
				$("#pre-saving").show();

			},
			success: function (data) {
				$("#pre-saving").hide();
				$('#confirm_save_user').html(data);

			}
		});
	});
	$('#reset').click(function () {
		$("#load_data_user")[0].reset();
	});
</script>