
<!-- page content -->


<div class="row ">
	<div class="col s12 m12">

		<div class="card horizontal">
			<div class="card-image">
				<div class="hide-on-small-only">
					<img src="<?php echo base_url('assets/images/add_user_.jpg') ?>">
				</div>

			</div>
			<div class="card-stacked">
				<div class="card-content">
					<div class="row">
						<div class="col s12">
							<p><i class="material-icons"style="vertical-align: -5px;">assignment_late</i> Por favor, registre los siguientes datos para continuar.</p>
							<input type="hidden" name="id_user" id="id_user" value="<?php // echo $id_user       ?>" />
						</div>
					</div>
					<div class="divider"></div>
					<div class="row">
						<form action="" name="name_user" id="name_user">
							<div class="col s12" style="font-size: 12px">
								<br />
								<i class="tiny material-icons" style="vertical-align: -2px">person_add</i> Responsable de Unidad de Transparencia
							</div>
							<input id="id_user" name="id_user" type="hidden" value = "<?php echo $this->session->userdata('id_so_user'); ?>">
							<div class="input-field col s4">
								<input id="nombre_user" name="nombre_user" type="text" class="validate">
								<label for="nombre_user">Nombres</label>

							</div>
							<div class="input-field col s4">
								<input id="ap_p_user" name="ap_p_user" type="text" class="validate">
								<label for="ap_p_user">Apellido Paterno</label>

							</div>
							<div class="input-field col s4">
								<input id="ap_m_user" name="ap_m_user" type="text" class="validate">
								<label for="ap_m_user">Apellido Materno</label>

							</div>
							<div class="input-field col s12">
								<input id="correo_user" name="correo_user" type="email" class="validate">
								<label for="correo_user">Correo electrónico</label>

							</div>
						</form>
					</div>
					<div class="progress" id="pre-saving" style="display: none">
						<div class="indeterminate"></div>
					</div>
					<div class="col s12">

						<div id="confirm_save_name">

						</div>
					</div>
				</div>
				<div class="card-action" style="text-align: center">
					<button  id="btn_save" class="waves-effect waves-light btn  " ><i class="material-icons left">save</i> Guardar y continuar  </button> 
				</div>

			</div>

		</div>

	</div>

</div>







<!-- /page content -->
<script type="text/javascript">
	$(document).ready(function () {
		base_url = "<?php echo base_url(); ?>";
	});

	$("body").on('click', "#btn_save", function () {
		base_url = "<?php echo base_url(); ?>";
		$('#nombre_user').focus();
		$.ajax({
			type: "POST",
			url: base_url + "usuarios/update_name_user",
			data: $('#name_user').serialize(),
			dataType: "html",
			beforeSend: function () {
				$("#pre-saving").show();
				$("#confirm_save_name").empty();
			},
			success: function (done)
			{
				$("#pre-saving").hide();
				$("#confirm_save_name").empty();
				$("#confirm_save_name").append(done);
			}
		});
	});


</script>