<div class="row">
	<?php foreach ($data_fraccion as $data_espec): ?>
		<div >
			<p class="truncate"  style="font-size:12px"> <i class="tiny material-icons" style="vertical-align: -2px;">beenhere</i><b> ARTÍCULO <?php echo strtoupper($data_espec->articulo) ?> </b>.- <?php echo strtoupper($data_espec->descrip_art) ?>
				<br /> <i class="tiny material-icons" style="vertical-align: -2px;">beenhere</i><b> FRACCION <?php echo $data_espec->fraccion ?> </b>.- <?php echo $data_espec->descrip_frac ?></p>
			<div class="progress"  style="display: none" id="pre-saving-fund">
				<div class="indeterminate"></div>
			</div>
			<div id="load_info">

			</div>
		</div>
		<div class="card horizontal hoverable">
			<div class="card-image">
				<div class="hide-on-small-only">
					<img src="<?php echo base_url('assets/images/ltg_icon.png') ?>">
				</div>
			</div>
			<div class="card-stacked">
				<div class="card-content">

					<div class="row " >
						<form action="" name="save_fund" id="save_fund_so">
							<div class="col s9">
								<div class="row">

									<input type="text" name="ejercicio_j" id="ejercicio_j"value="<?php echo'Ejercicio '. $ejercicio ?>" />
									<input type="text" name="id_cat" id="ejercicio_j"value="<?php echo'id categoria '. $id_cat_so ?>" />
									<input type="text" name="id_so" id="ejercicio_j"value="<?php echo'id sujeto obligado '. $id_so ?>" />
									<input type="text" name="id_fraccion" id="id_fraccion"value="<?php echo 'id fraccion '.$id_frac ?>" />
									<div class="input-field col s12">
										<?php // foreach ($data_just as $justificacion): ?>
										<textarea id="fundamenta_frac" name ="fundamenta_frac" class="materialize-textarea" > <?php // echo $justificacion->justificacion_so_just      ?></textarea>

										<label for="fundamenta_frac" class="active">Ingrese fundamentación</label>
										<span class="helper-text" data-error="wrong" data-success="right">Ingresa el texto correspondiente, de manera clara y precisa, que fundamenta la <b>NO APLICABILIDAD</b> de esta fracción.</span>
										<?php // endforeach ?>
									</div>
								</div>
							</div>
						</form>
						<div class="input-field  col s3 " >
							<a class=" btn waves-effect waves-light save_fund" id=" <?php echo $data_espec->id_fraccion ?>"><i class="material-icons">save</i></a>
							<button class=" btn  waves-effect  waves-light red close" id="<?php echo $data_espec->id_fraccion ?>"><i class="material-icons">close</i></button>
						</div>
					</div>


				</div>
			</div>
		</div>
	<?php endforeach ?>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		base_url = "<?php echo base_url(); ?>";

	});

	base_url = "<?php echo base_url(); ?>";
	$("body").on('click', ".save_fund", function () {
		URL = base_url + "tablas_ap/save_fundamenta_so";
//		$("#load_data_just").empty();
		$.ajax({
			async: true,
			type: "POST",
			url: URL,
			data: $("#save_fund_so").serialize(),
			dataType: "html",
			    cache: false, 
			beforeSend: function () {
				$('#pre-saving-fund').show();
				$('#load_info').empty();
			},
			success: function (data) {
				$('#pre-saving-fund').hide();
				$('#load_info').html(data);
				setTimeout(function () {
					$("#data_new_table").modal("close");
					$("#refresh").click();
				}, 1000);
			}
		});
	});
	$("body").on('click', ".close", function () {
//		var id_check = $(this).attr("id");
//		$("#" + id_check).prop("checked", true);
		$("#data_new_table").modal("close");
		
	});

</script>
