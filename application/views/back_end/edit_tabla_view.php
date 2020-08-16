
<!--Interfaz de carga de fracciones  para realizar CAMBIOS -->
<div class="container" style="width:80%">
	<?php foreach ($data_SO as $SO): ?>
		<div class="row ">
			<div class="card hoverable ">
				<div class="card-image ">
					<img src="<?php echo base_url('assets/images/background_card.jpg') ?>">
					<div class="card-title" style="text-shadow: 1px 1px 1px black; font-size:17px"><b><?php echo mb_strtoupper($SO->nombre_so) ?></b><br /> <?php echo '(' . $SO->descrip_categoria . ')' ?></strong></div>
				</div>
				<div class="card-content section">
					<div class="row">
						<div class="col s12 m6 l6 ">
							<div class="center  ">
								<span ><i class="  material-icons">person_pin</i> <br /><b><?php echo mb_strtoupper($SO->nombre_user) . ' ' . mb_strtoupper($SO->ap_p) . ' ' . mb_strtoupper($SO->ap_m) ?></b> </span><br />
								<div class="divider"></div>
								<span style="font-size:12px">Responsable de Unidad de Transparencia</span>
							</div>
						</div>
						<div class="col s12 m6 l6">
							<div class="center  ">
								<span ><i class="  material-icons">email</i> <br /><?php echo $SO->correo ?></span> <br />
								<div class="divider"></div>
								<span style="font-size:12px">Contacto</span>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="row" style="margin-bottom: 0px">
			<div class="col s12 ">
				<div class="card hoverable">
					<div class="card-image">
						<img src="<?php echo base_url('assets/images/background_card.jpg') ?>">
						<div class="card-title" style="text-shadow: 1px 1px 1px black; font-size:calc(1em + 1vw);"><i class="material-icons " style="vertical-align: -3px;">edit</i> <strong>Editar tabla de aplicabilidad</strong></div>
					</div>
					<div class="card-content section">
						<form action="" name = "data_so" id = "datos_edit_so">
							<div class="row ">
								<input type="hidden" value="<?php echo trim($SO->id_so) ?>" name="id_so" id="id_so"/> 
								<input type="hidden" value="<?php echo trim($SO->id_categoria_so) ?>" name="id_cat_so" id="id_cat_so"/> 
							<?php endforeach; ?> 
							<a name="inicio"></a>
						</div>
						<div class="row">
							<div class="col s12">
								Proporcione los siguientes datos para continuar:
							</div>

						</div>
						<div class="row">

							<div class="input-field col s12 m4 l4 ">
								<i class="material-icons prefix">date_range</i>
								<select name="ejercicio" id="ejercicio">
									<option value="" disabled >Seleccione ejercicio</option>
									<option value="2021" selected>Ejercicio 2021</option>
								</select>
								<label>Tabla de aplicabilidad correpondiente a:</label>
							</div>

							<div class="input-field col s12 m8 l8 ">
								<i class="material-icons prefix">date_range</i>
								<select name="articulo" id="articulo">
									<option value="" disabled selected>Seleccione Artículo</option>
									<option value="1"  >Art 74.- Obligaciones comunes en materia de transparencia</option>
									<?php foreach ($select_art as $data_art): ?>
										<option value="<?php echo $data_art->id_articulo ?>"><p class="truncate"><?php echo 'Art ' . $data_art->articulo . '.-' . $data_art->descrip_art ?></p></option>
									<?php endforeach ?>
								</select>
								<label>Determine el tipo de obligaciones que desea EDITAR</label>
							</div>
					</form>
				</div>
				<div class="row center">
					<div class="input-field col s12 m12 l12 ">
						<button  id="load_edit_frac" class="btn waves-effect waves-light "  ><i class="material-icons"style="vertical-align: -4px">file_upload</i> Cargar fracciones y Editar tabla</button>
					</div>
				</div>

				<div class="row margin"  style="display: none" id="pre_edit">
					<div class="progress">
						<div class="indeterminate"></div>
					</div>
				</div>
				<div class="row">
					<div class="col s12 m12 l12 ">
						<div  id="det_edit_frac">

						</div>
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
<div id="info_table" class="modal ">  
	<div class="modal-content section ">
		<div class="row ">
			<div class="col s12 m12">

				<div class="card horizontal">
					<div class="card-image">
						<div class="hide-on-small-only">
							<img src="<?php echo base_url('assets/images/manual_icon.jpg') ?>">
						</div>

					</div>
					<div class="card-stacked">
						<div class="card-content">
							<div class="row">
								<div class="col s12">
									<p><i class="material-icons"style="vertical-align: -5px;">beenhere</i> INSTRUCCIONES.</p>
									<input type="hidden" name="id_user" id="id_user" value="<?php // echo $id_user                  ?>" />
								</div>
							</div>
							<div class="divider"></div>
							<div class="row">
								En la creación de la tabla de aplicabilidad, solo es necesario indicar aquellas fracciones que no aplican al sujeto obligado, así como su justificación a las mismas.
							</div>
							<div class="progress" id="pre_edit" style="display: none">
								<div class="indeterminate"></div>
							</div>
							<div class="col s12">

								<div id="confirm_save_name">

								</div>
							</div>
						</div>
						<div class="card-action" style="text-align: center">
							<button   class="waves-effect waves-light btn  modal-close" ><i class="material-icons left">launch</i> Aceptar  y continuar  </button> 
						</div>

					</div>

				</div>

			</div>

		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		base_url = "<?php echo base_url(); ?>";
		$('#det_edit_frac').empty();


	});

	$("body").on('change', "#articulo", function () {
		$('#load_edit_frac').attr('disabled', false);
	});
	function getURL()
	{
		var base_url = "<?php echo base_url("tablas_ap/view_table"); ?>";
		var id_articulo = $("#articulo").val();
		var ejercicio = $("#ejercicio").val();
		var id_so = $("#id_so").val();
		var dir = ` ${base_url}?id_art=${id_articulo}&ejer=${ejercicio}&id_so=${id_so}`;

		window.location.href = dir;
	}
	$("body").on('click', "#load_edit_frac", function (event) {
		event.preventDefault();
		base_url = "<?php echo base_url(); ?>";
		$('#det_edit_frac').empty();
		$('#load_edit_frac').attr('disabled', true);
		URL = base_url + "tablas_ap/select_edit_table";
		$.ajax({
			async: true,
			type: "POST",
			url: URL,
			cache: false,
			data: $('#datos_edit_so').serialize(),
			dataType: "html",
			beforeSend: function () {
				$('#pre_edit').show();
				$('#det_edit_frac').empty();
			},
			success: function (data) {
				$('#pre_edit').hide();
				$('#det_edit_frac').html(data);

			}
		});

	});


</script>