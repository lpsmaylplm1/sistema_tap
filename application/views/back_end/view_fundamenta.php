<div class="row ">
	<?php foreach ($data_fraccion as $data_espec): ?>
		<div class="card horizontal hoverable">
			<div class="card-image">
				<div class="hide-on-small-only">
					<img src="<?php echo base_url('assets/images/ltg_icon.png') ?> ">
				</div>
			</div>
			<div class="card-stacked">
				<div class="card-content">
					<div class="row " >
						<div class="col s11">
							<div >
								<p style="font-size:12px"> <i class="tiny material-icons" style="vertical-align: -2px;">beenhere</i><b> ARTÍCULO <?php echo strtoupper($data_espec->articulo) ?>.- <?php echo strtoupper($data_espec->descrip_art) ?> </b>
									<br /> <i class="tiny material-icons" style="vertical-align: -2px;">beenhere</i><b> FRACCION <?php echo $data_espec->fraccion ?> </b>.- <?php echo $data_espec->descrip_frac ?></p>
							</div>
						</div>
						<div class="col s1">
							<button class=" btn modal-close waves-effect  waves-light red close" ><i class="material-icons">close</i></button>

						</div>
					</div>
					<div class="divider"></div>
					<div class="row section ">
						<div class="col s12">
							<p style="font-size:12px"><i class="tiny material-icons" style="vertical-align: -2px;">beenhere</i><b>FUNDAMENTACIÓN (LTG)</b>: <?php echo $data_espec->fundamentacion_ltg ?></p>
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
		URL = base_url + "tablas_ap/save_fundamenta";

		$.ajax({
			type: "POST",
			url: URL,
			data: $("#save_fund").serialize(),
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