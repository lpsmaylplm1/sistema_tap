<div class="row container">
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
						<form action="" name="save_fund" id="save_fund">
							<div class="col s10">
								<div class="row">
									<input type="hidden" name="id_fraccion" id="id_fraccion"value="<?php echo $data_espec->id_fraccion ?>" />
									<div class="input-field col s12">
										<textarea id="fundamenta_frac" name ="fundamenta_frac" class="materialize-textarea" ><?php echo $data_espec->fundamentacion_ltg ?></textarea>
										<label for="fundamenta_frac" class="active">Fundamentación  LTG</label>
										<span class="helper-text" data-error="wrong" data-success="right">Ingresa el texto correspondiente a los LTG, que fundamenta la aplicabilidad de esta fracción.</span>
									</div>
								</div>
							</div>
						</form>
						<div class="input-field  col s2 " >
							<button class=" btn waves-effect waves-light save_fund" id=" <?php echo $data_espec->id_fraccion ?>"><i class="material-icons">save</i></button>
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
	$("body").on('click', ".save_fund", function () {
		URL = base_url + "tablas_ap/save_fundamenta";
		$.ajax({
			async: true,
			type: "POST",
			url: URL,
			data: $("#save_fund").serialize(),
			cache: false,
			dataType: "html",
			beforeSend: function () {
				$('#pre-saving-fund').show();
				$('#load_info').empty();
			},
			success: function (data) {
				$('#pre-saving-fund').hide();
				$('#load_info').html(data);
			}
		});
	});


</script>