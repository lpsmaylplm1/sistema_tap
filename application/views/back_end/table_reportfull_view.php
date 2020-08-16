<div class="row container">

	<div class="card  ">

		<div class="card-image ">
			<img src="<?php echo base_url('assets/images/background_report_card.jpg') ?>">
			<div class="card-title" style="text-shadow: 1px 1px 1px black; font-size:17px"> <b>Generador de reportes de Tablas de Aplicabiliad</b></div>
		</div>
		<div class="card-content section">
			<div class="row">
				<form action="">

					<div class="input-field col s12 m9 l9 ">
						<select name="rep_cat" id="rep_cat">

							<?php
							foreach ($data_cat as $categoria):
								if ($categoria->id_categoria === "0") {
									?>
									<option value="" selected="" disabled="">Seleccione</option>
								<?php } else { ?>
									<option value="<?php echo $categoria->id_categoria ?>"><?php echo $categoria->descrip_categoria ?></option>
									<?php
								}
							endforeach
							?>
						</select>
						<label>Categoría de sujetos obligados</label>
					</div>
				</form>

				<div class="input-field col s12 m3 l3">
					<button id="rep_generate" class="btn  waves-effect waves-light "> Generar reporte <i class="large material-icons" style="vertical-align: -5px;">keyboard_tab</i></button>
				</div>

			</div>
			<div class="row " style="display: none"  id="pre-report">
				<div >
					<div class="progress">
						<div class="indeterminate"></div>
					</div>
				</div>
			</div>
			<div class="row section" id="data_report">

			</div>

			<div class="row center section">
				<div class="col s3">
					<a href="<?php echo base_url('tablas_ap/edit_table') ?>" class="btn waves-effect waves-light"><i class="material-icons" style="vertical-align: -3px">edit</i> EDITAR TABLA</a>
				</div>
				<div class="col s3">
					<a href="<?php echo base_url('Pdfcreator_controller') ?>" class="btn  red darken-4 waves-effect waves-light"><i class="material-icons" style="vertical-align: -3px">picture_as_pdf</i> GENERAR PDF</a>
				</div>
				<div class="col s3">
					<a href="<?php echo base_url('tablas_ap/edit_table') ?>" class="btn green darken-4 waves-effect waves-light"><i class="material-icons" style="vertical-align: -3px">insert_drive_file</i> GENERAR EXCEL (.xlsx)</a>
				</div>
				<div class="col s3">
					<a href="<?php echo base_url('tablas_ap/edit_table') ?>" class="btn orange darken-4 waves-effect waves-light"><i class="material-icons" style="vertical-align: -3px">send</i> ENVIAR TABLA</a>
				</div>
			</div>
		</div>


	</div>
</div>
<script type="text/javascript">

	$("body").on('click', "#rep_generate", function (event) {
		event.preventDefault();
		base_url = "<?php echo base_url(); ?>";
//		$('#rep_generate').attr('disabled', true);
		$('#data_report').empty();
		var URL = base_url + "pdfcreator_controller/report_view_full";
		var data_cat = $('#rep_cat').val();
		$.ajax({
			async: true,
			type: "POST",
			url: URL,
			cache: false,
			data: {'data_cat': data_cat},
			dataType: "html",
			beforeSend: function () {
				$('#pre-report').show();
				$('#data_report').empty();
			},
			success: function (data) {
				$('#pre-report').hide();
				$('#data_report').html(data);

			}
		});
	});
</script>