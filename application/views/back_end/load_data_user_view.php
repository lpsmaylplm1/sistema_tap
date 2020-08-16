

<div class="card-content ">
	<div class="row">
		<div class="col s12 m6 l6 ">
			<h6><i class="material-icons" style="vertical-align: -3px;">edit</i> <b>Editar información de usuario</b></h6>
		</div>
		<div class="col s12 m6 l6 right-align">
			<button  id="btn_submit_edit" class="waves-effect waves-light btn  " ><i class="material-icons left">file_download</i> Actualizar  </button> 
			<button type="reset" class="waves-effect waves-light btn  red darken-4 modal-close" ><i class="material-icons left">cancel</i> Cancelar </button> 
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			<div id="validation_errors"> 	</div>
			<div class="progress" id="pre-saving"  style="display: none">
				<div class="indeterminate"></div>
			</div>
			<div id="confirm_save_user">
				
			</div>
		</div>
	</div>
	<div class="divider"></div>
	<div class="section">
		<form class="col s12" name="load_data_user" id="load_data_user" >
			<?php foreach ($prev_data_user as $data_saved): ?>
				<div class="row">
					<div class="input-field col s12 m6 l6 ">
						<i class="material-icons prefix">supervisor_account</i>
						<select  name="tipo_usuario" id="tipo_usuario">
							<option value=""   disabled="">Seleccione</option>
							<?php
							foreach ($select_nivel as $nivel_user):
								if ($data_saved->nivel_user == $nivel_user->id_nivel_usr) {
									?>
									<option value="<?php echo $nivel_user->id_nivel_usr ?>" selected> <?php echo $nivel_user->descrip_nivel ?></option> 
								<?php } else { ?>
									<option value="<?php echo $nivel_user->id_nivel_usr ?>" > <?php echo $nivel_user->descrip_nivel ?></option> 
									<?php
								}

							endforeach;
							?>
						</select>
						<label >Tipo  de usuario </label>

					</div>
					<div class="input-field col s12 m6 l6 ">
						<i class="material-icons prefix">add_to_photos</i>
						<select  name="cat_so" id="cat_so" >
							<option value=""   disabled >Seleccione</option>
							<?php
							foreach ($select_cat as $cat):
								if ($data_saved->id_cat_user == $cat->id_categoria) {
									?>
									<option value="<?php echo $cat->id_categoria ?>" selected> <?php echo $cat->descrip_categoria ?></option>
								<?php } else { ?>
									<option value="<?php echo $cat->id_categoria ?>"> <?php echo $cat->descrip_categoria ?></option>
								<?php } endforeach ?>
						</select>
						<label for="cat_so">Categoría</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12 m9 l9 " style="font-size: x-small;">
						<i class="material-icons prefix">apartment</i>
						<select  name="nombre_so" id="nombre_so"   >
							<option value=""   disabled >Seleccione</option>
							<?php
							foreach ($select_so as $so):
								if ($data_saved->id_so_user == $so->id_so) {
									?>
									<option value="<?php echo $so->id_so ?>" selected> <?php echo $so->nombre_so ?></option>
								<?php } else { ?>
									<option value="<?php echo $so->id_so ?>"> <?php echo $so->nombre_so ?></option>
								<?php } endforeach ?>
						</select>
						<label for="nombre_so"> Sujeto Obligado</label>
					</div>
	<!--					<input type="hidden" name="id_ayu" id="id_ayu" value="" />-->
					<div class="input-field col s12 m3 l3">

						<i class="material-icons prefix">location_on </i>
						<select   id="ubicacion" name="ubicacion" >
							<option value=""   disabled >Seleccione</option>
							<?php
							foreach ($data_municipios as $ayuntamientos):
								if ($municipio == $ayuntamientos->id_ayuntamiento) {
									?>
									<option value="<?php echo $ayuntamientos->id_ayuntamiento ?>" selected> <?php echo $ayuntamientos->nombre ?></option>
								<?php } else { ?>
									<option value="<?php echo $ayuntamientos->id_ayuntamiento ?>"> <?php echo $ayuntamientos->nombre ?></option>
								<?php } endforeach ?>
						</select>
						<label for="ubicacion" >Ubic. Geográfica</label>
					</div>


				</div>
				<div class="row">
					<div class="input-field col s12 m6 l4 ">
						<i class="material-icons prefix">account_box</i>
						<input type="text"  id="usuario" name="usuario" value="<?php echo$data_saved->usuario ?>" >
						<label for="usuario" class="active">Usuario</label>
					</div>
					<input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $data_saved->id_user ?>" />
					<div class="input-field col s12 m6 l4 ">
						<i class="material-icons prefix">vpn_key</i>
						<input type="text" id="password1" name="password1" value="<?php echo $pass ?>"  >
						<label for="password1" class="active">Contraseña registrada</label>
					</div>
					<div class="input-field col s12 m6 l4 ">
						<i class="material-icons prefix">vpn_key</i>
						<input type="text"  id="password2" name="password2"   value="<?php echo $pass ?>">
						<label for="password1" class="active">Confirmar Contraseña</label>
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
			<?php endforeach; ?>
		</form>
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

	<script type="text/javascript">
		$(document).ready(function () {
			$('select').formSelect();
		});
		base_url = "<?php echo base_url(); ?>";
		$("body").on('change', "#cat_so", function () {
			URL = base_url + "usuarios/select_so_cat";
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
			base_url = "<?php echo base_url(); ?>";
			$("#btn_submit_edit").prop('disabled', true);
			URL = base_url + "usuarios/get_data_edit_user";
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

	</script>