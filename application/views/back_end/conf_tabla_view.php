<div class="container">
	<div class="row">
		<div class="col s12 ">
			<div class="card hoverable">
				<div class="card-image">
					<img src="<?php echo base_url('assets/images/background_card.jpg') ?>">
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
								<?php foreach ($select_articulos as $articulo): ?>
									<option value="<?php echo $articulo->id_articulo ?>" ><?php echo 'Art. ' . $articulo->articulo . '.-' . $articulo->descrip_art ?></option> 
								<?php endforeach ?>
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
								<option value="121"  >Tribunal Electoral del Estado de Campeche</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col s12 m12 l12 ">
							<div  id="detail_frac">

							</div>

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
			base_url = "<?php echo base_url(); ?>";
			$('select').formSelect();
			$('#detail_frac').empty();

		});

		$("body").on('change', "#articulo", function () {
			$('#detail_frac').empty();
			var id_art = $('#articulo').val();
			if (id_art === "6") {
				$("#o_a").show();
				$("body").on('change', "#select_oa", function () {
					$('#detail_frac').empty();
					var id_oa = $("#select_oa").val();
					URL = base_url + "tablas_ap/select_fraccion";
					$.ajax({
						async: true,
						type: "POST",
						url: URL,
						data: {'id_art': id_art,'id_oa': id_oa},
						dataType: "html",
						beforeSend: function () {
							$('#pre-load').show();
							$('#detail_frac').empty();
						},
						success: function (data) {
							$('#pre-load').hide();
							$('#detail_frac').html(data);
						}
					});
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
						$('#detail_frac').empty();
					},
					success: function (data) {
						$('#pre-load').hide();
						$('#detail_frac').html(data);
					}
				});
			}
		});
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

	</script>