<table id="fracciones" class=" display responsive nowrap" width="95%">
	<thead>
	<th style="font-size:12px" width="3%" >Art.</th>
	<th style="font-size:12px" width="3%" >Fracción</th>
	<th style="font-size:12px" width="30%" >Descripción</th>
	<th style="font-size:12px" width="20%"><i class="material-icons" style="vertical-align:-3px">check</i> ¿Aplica?</th>
	<th style="font-size:12px"  width="44%">Justificación</th>
</thead>
<tbody>
<form action="" name = "data_art_74" id="data_art_74">

	<?php foreach ($data_fraccion as $data_frac): ?>

		<tr>
			<td style="font-size:12px ">Art. <?php echo $data_frac->articulo ?></td>
			<td style="font-size:12px; text-align:center "><?php echo $data_frac->fraccion ?></td>
			<td style="font-size:12px ">
				<input type="hidden" id="temp_id_articulo" value ="<?php echo $data_frac->articulo ?>" />
				<input type="hidden" id="temp_id_fraccion" value ="<?php echo $data_frac->id_fraccion ?>" />
				<?php echo wordwrap($data_frac->descrip_frac, 45, "<br>", TRUE); ?>
			</td>
			<td style="font-size:12px ">
				<div class="row">
					<div class="col s12 section center">
						<?php
						if ($data_frac->fundamentacion_ltg !== "") {
							?>
							<div class="switch">   
								<label>
									NO
									<input disabled class="aplica"  type="checkbox" name="aplica"  checked=""  id="<?php echo $data_frac->id_fraccion ?>"value="1">
									<span class="lever"></span>
									SI
								</label>
							</div> <?php
						} else {
							if ($data_frac->justificacion_so_oc !== "") {
								?>
								<div class="switch">   
									<label>
										NO
										<input  class="aplica"  type="checkbox"  name="aplica"  id="<?php echo $data_frac->id_fraccion ?>"value="1">
										<span class="lever"></span>
										SI
									</label>
								</div>
							<?php } else {
								?>
								<div class="switch">   
									<label>
										NO
										<input  class="aplica"  type="checkbox" checked="" name="aplica"  id="<?php echo $data_frac->id_fraccion ?>"value="1">
										<span class="lever"></span>
										SI
									</label>
								</div>
							<?php }
							?>

						<?php }
						?>
					</div>

				</div>
			</td>
			<td style="font-size:12px ">
				<div class="row">
					<?php if ($data_frac->fundamentacion_ltg !== "") {
						?>
						<div class="row">
							<div class="col s12 center">
								<br /><a href="#!" class="waves-effect waves-light btn btn-floating btn-small red tooltipped view_fund_og" id = "<?php echo $data_frac->id_fraccion ?>" data-position="top" data-tooltip="¿Por que me aplica? "><i class="material-icons">help</i></a>

							</div>
						</div>

					<?php } else { ?>
						<div  class="row container" id="resp<?php echo $data_frac->articulo . $data_frac->id_fraccion ?>" style="display:none">
							<div class="progress">
								<div class="indeterminate"></div>
							</div>
						</div>
						<div <?php
						if ($data_frac->justificacion_so_oc !== "") {
							echo 'style=""';
						} else {

							echo 'style="display:none"';
						}
						?>  id = "just<?php echo$data_frac->articulo . $data_frac->id_fraccion ?>">

							<div class="" id="response<?php echo$data_frac->articulo . $data_frac->id_fraccion ?>"> </div>
							<div class="input-field col s10">
								<textarea  name ="fundamenta_frac" id="<?php echo $data_frac->articulo . $data_frac->id_fraccion ?>" class="materialize-textarea justifica_so validate active"><?php echo $data_frac->justificacion_so_oc ?></textarea>
								<script>M.textareaAutoResize($('#'+<?php echo $data_frac->articulo . $data_frac->id_fraccion ?>));</script>
								<label class="active">Ingrese Justificación </label>
								<span class="helper-text" data-error="wrong" data-success="Justificación actualizada correctamente">Fundamentación de No Aplicabilidad.</span>

							</div>


						</div>
					
						<div class="input-field col s2 center" >
							<a   class=' btn btn-floating btn-small  waves-effect waves-light save_just' href="#!" data-value="<?php echo $data_frac->id_fraccion ?>" id="save<?php echo $data_frac->articulo . $data_frac->id_fraccion ?>"><i class="material-icons">save</i></a>
						</div>

					<?php } ?>
				</div>
			</td>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>
<br />
<div  class="row  " id="pre_finalizar" style="display:none" >
	<div class="progress">
		<div class="indeterminate"></div>
	</div>
</div>

<div class="row center section">
	<a class="btn waves-effect waves-light "id ="finalizar" href="javascript:getURL()"> <i class="material-icons" style="vertical-align:-4px">pageview</i> Finalizar Edición  y ver vista previa de  tabla </a>
</div>
<div id="load_fund_og" class="modal bottom-sheet   ">  
	<div class="modal-content section ">
		<div id="load_data_fund_og">

		</div>
	</div>
</div>
<div id="data_new_table" class="modal bottom-sheet   ">  
	<div class="modal-content container">

	</div>
</div>
<script type="text/javascript">

	$(document).ready(function () {
		base_url = "<?php echo base_url(); ?>";
		$('select').formSelect();
		$('.tooltipped').tooltip();
		$("#load_data_fund").empty();
		var elems = document.querySelectorAll('.modal');
		var instances = M.Modal.init(elems, {
			dismissible: false
		});

		$("body").on('click', ".aplica", function () {
			var temp_id_fraccion = $(this).attr("id");
			var temp_id_articulo = $('#temp_id_articulo').val();
			var id = temp_id_articulo + temp_id_fraccion;
			if (!this.checked) {
//				$("#response" + temp_id_articulo + temp_id_fraccion).empty();
				$('#just' + id).show();
				$('#' + id).prop("disabled", false);
				$('#save' + id).removeAttr("disabled");

				$('#' + id).focus();
			} else {
				$('#just' + id).hide();
				$('#' + id).prop("disabled", true);
//				$('#save' + id).attr('disabled', true);
//				$('#' + id).val("");
			}
		});
		$("body").on('click', ".save_just", function (event) {
			event.preventDefault();
			if (!this.checked) {
//				$(this).attr("disabled", true);
				base_url = "<?php echo base_url(); ?>";
				var temp_id_articulo = $('#temp_id_articulo').val();
				var id_fraccion = $(this).data('value');
				var id_cat_so = $('#id_cat_so').val();
				var id_so = $('#id_so').val();
				var ejercicio = $('#ejercicio').val();
				var fundamenta_frac = $("#" + temp_id_articulo + id_fraccion).val();
				var id_fundamenta_frac = $("#" + temp_id_articulo + id_fraccion).attr("id");
				if ($('#' + id_fraccion).prop('checked')) {
					var aplica = 1;
				} else {
					var aplica = 0;
				}
				$.ajax({
					async: true,
					type: "POST",
					url: base_url + "tablas_ap/edit_fundamenta_so",
					cache: false,
					data: {'id_frac': id_fraccion, 'ejercicio': ejercicio, 'id_cat_so': id_cat_so, 'id_so': id_so, 'fundamenta_frac': fundamenta_frac, 'id_fundamenta_frac': id_fundamenta_frac, 'aplica': aplica},
					dataType: "html",
					beforeSend: function () {
						$("#resp" + temp_id_articulo + id_fraccion).show();
						$("#response" + temp_id_articulo + id_fraccion).empty();
					},
					success: function (load)
					{
						$("#resp" + temp_id_articulo + id_fraccion).hide();
						$("#response" + temp_id_articulo + id_fraccion).append(load);
					}
				});

			}
		});

		$("body").on('click', ".view_fund_og", function () {
			$("#load_data_fund_og").empty();
			base_url = "<?php echo base_url(); ?>";
			var id_frac = $(this).attr("id");
			$("#load_fund_og").modal('open');
			$.ajax({
				async: true,
				type: "POST",
				url: base_url + "tablas_ap/view_fundamenta",
				cache: false,
				data: 'id_frac=' + id_frac,
				dataType: "html",
				beforeSend: function () {
					$("#load_data_fund_og").empty();
				},
				success: function (load)
				{

					$("#load_data_fund_og").empty();
					$("#load_data_fund_og").append(load);

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
		$('select').formSelect();


	});

</script>
