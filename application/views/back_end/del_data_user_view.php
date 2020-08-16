
<!-- page content -->


<div class="row ">
	<div class="col s12 m12">

		<div class="card horizontal">
			<div class="card-image">
				<div class="hide-on-small-only">
					<img src="<?php echo base_url('assets/images/trash.jpg') ?>">
				</div>

			</div>
			<div class="card-stacked">
				<div class="card-content">
					<div style="text-align: center"><h6 class="header"> <b>¿Confirma la eliminación de este usuario?</b></h6></div>

					<p><i class="material-icons"style="vertical-align: -4px;">cancel</i><b> NOTA:</b> La eliminación se realiza de forma permanente y definitiva. No podrá deshacer esta operación.</p>
					<input type="hidden" name="id_user" id="id_user" value="<?php echo $id_user ?>" />
				</div>
				<div class="card-action" style="text-align: center">
					<button  id="btn_submit_delete" class="waves-effect waves-light btn  " ><i class="material-icons left">delete_forever</i> Confirmar eliminación  </button> 
					<button type="reset" class="waves-effect waves-light btn  red darken-4 modal-close" ><i class="material-icons left">cancel</i> Cancelar </button> 
				</div>

			</div>

		</div>
		<div class="progress" id="pre-saving" style="display: none">
			<div class="indeterminate"></div>
		</div>
		<div class="col s12">

			<div id="confirm_delete_user">

			</div>
		</div>
	</div>

</div>







<!-- /page content -->
<script type="text/javascript">
	$(document).ready(function () {
		base_url = "<?php echo base_url(); ?>";
		$('select').formSelect();
	});

	$("body").on('click', "#btn_submit_delete", function () {
		base_url = "<?php echo base_url(); ?>";
		var id_user = $('#id_user').val();
		$.ajax({
			type: "POST",
			url: base_url + "usuarios/confirm_del_user",
			data: 'id_user=' + id_user,
			dataType: "html",
			beforeSend: function () {
				$("#pre-saving").show();
			},
			success: function (load)
			{
				$("#pre-saving").hide();
				$("#confirm_delete_user").empty();
				$("#confirm_delete_user").append(load);
			}
		});
	});


</script>