
<div class="row container">

	<div class="card  ">
		<?php foreach ($data_SO as $SO): ?>
			<div class="card-image ">
				<img src="<?php echo base_url('assets/images/background_card.jpg') ?>">
				<div class="card-title" style="text-shadow: 1px 1px 1px black; font-size:17px"><b><?php echo mb_strtoupper($SO->nombre_so) ?></b><br /> <?php echo '(' . $SO->descrip_categoria . ')' ?></strong></div>
			</div>
			<div class="card-content section">
				<div class="row">
					<div class="col s12 m6 l6 ">
						<div class="center  ">
							<span ><i class="  material-icons">person_pin</i> <br /><b><?php echo $SO->nombre_user . ' ' . $SO->ap_p . ' ' . $SO->ap_m ?></b> </span><br />
							<div class="divider"></div>
							<span style="font-size:12px">Responsable de Unidad de Transparencia</span>
						</div>
					</div>
					<div class="col s12 m6 l6">
						<div class="center  ">
							<span ><i class="  material-icons">email</i> <br /><b><?php echo $SO->correo ?></b></span> <br />
							<div class="divider"></div>
							<span style="font-size:12px">Contacto</span>
						</div>
					</div>
				</div>
			<?php endforeach ?>
			<div class="row section">
				<div class="row">

					<div class="col s12 m6 center " >
						<div class="card-panel orange darken-4  hoverable"  style="border-radius: 20px;">
							<span class="white-text" ><b>OBLIGACIONES COMUNES</b>	</span>
						</div>
						<div class="row">
							<div class="col s12 m6 center ">
								<div class="card-panel  light-green darken-1 hoverable" style="border-radius: 10px;">

									<span class="white-text" style="font-size: 50px;text-shadow: 2px 2px 2px black;"><b><?php echo $num_aplica ?></b> </span><br />
									<span class="white-text"  style="font-size: 13px">Obligaciones comunes aplicables</span> <br />
									<i class="medium material-icons white-text">offline_pin</i> 
								</div>
							</div>
							<div class="col s12 m6">
								<div class="card-panel orange darken-1 hoverable center"  style="border-radius: 10px;">


									<span class="white-text"style="font-size: 50px;text-shadow: 2px 2px 2px black;"><b><?php echo $num_noaplica ?></b> </span><br />
									<span class="white-text"  style="font-size: 13px"> Obligaciones comunes  NO aplicables 	</span> <br />
									<i class="medium material-icons white-text">do_not_disturb_off</i>
								</div>
							</div>
						</div>
					</div>
					<div class="col s12 m6  center">
						<div class="card-panel orange darken-4 hoverable" style="border-radius: 20px;" >
							<span class="white-text"><b>OBLIGACIONES ESPECÍFICAS</b>	</span>
						</div>
						<div class="row">
							<div class="col s12 m6 ">
								<div class="card-panel light-green darken-1 hoverable center"  style="border-radius: 10px;">

									<span class="white-text" style="font-size: 50px;text-shadow: 2px 2px 2px black;"><b><?php echo $num_aplica_esp ?></b> </span><br />
									<span class="white-text"  style="font-size: 13px">Obligaciones especificas aplicables</span> <br />
									<i class="medium material-icons white-text">offline_pin</i>
								</div>
							</div>
							<div class="col s12 m6">
								<div class="card-panel orange darken-1 hoverable center"  style="border-radius: 10px;">

									<span class="white-text"style="font-size: 50px;text-shadow: 2px 2px 2px black;"><b><?php echo $num_noaplica_esp ?></b> </span><br />
									<span class="white-text"  style="font-size: 13px"> Obligaciones  especificas  NO aplicables 	</span> <br />
									<i class="medium material-icons white-text" >do_not_disturb_off</i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php foreach ($data_SO as $SO): ?>
					<div class="card-panel col s12 orange lighten-5 hoverable"><br />
						<div class="section center orange lighten-4">
							<span><b>TABLA DE APLICABILIDAD <?php echo $this->session->userdata('ejercicio') ?></b> </span> <br />
							<b>CATEGORÍA: </b><?php echo $SO->descrip_categoria ?> <br />
							
						</div>

						<table border="1" class="highlight str" style="font-size: 12px">
							<thead class="centered">
								<tr>
									<th rowspan="2">No.</th>
									<th width="30%" rowspan="2">Sujeto Obligado</th>
									<th width="30%" colspan="2" style="text-align: center">Obligaciones comunes <br />- Artículo 74 de la Ley Estatal</th>

									<th width="30%" colspan="2" style="text-align: center">Obligaciones Especificas <br />- Artículo 
										<?php
										if ($SO->id_art_cat === "75") {
											echo $SO->id_art_cat . ' de la Ley Estatal e inciso <b>f</b> del artículo 71 de la Ley General';
										} elseif ($SO->id_art_cat === "76") {
											echo $SO->id_art_cat . ' de la Ley Estatal e incisos <b>b</b>, <b>c</b>, y  <b>d</b>  del artículo 71 de la Ley General';
										} else {
											echo $SO->id_art_cat . ' de la Ley Estatal';
										}
										?></th>



								</tr>
								<tr>

									<th width ="20%" class="center" >Aplica</th>
									<th width ="20%" class="center" >No Aplica</th>
									<th width ="20%" class="center" >Aplica</th>
									<th width ="20%" class="center" >No Aplica</th>
								</tr>
							</thead>
							<tbody>

								<tr>
									<td  class="center">1</td>
									<td ><?php echo $SO->nombre_so ?></td>
									<td  class="center">
										<?php
										foreach ($data_aplica as $aplica) {
											if ($aplica !== end($data_aplica)) {
												$separador = ",";
											} else {
												$separador = ".";
											}
											echo $aplica->fraccion . $separador . " ";
										}
										?>
									</td>
									<td>
										<?php
										foreach ($data_noaplica as $noaplica) {
											if ($noaplica !== end($data_noaplica)) {
												$separador = ",";
											} else {
												$separador = ".";
											}
											echo $noaplica->fraccion . $separador . " ";
										}
										?>
									</td>
									<td>
										<?php
										foreach ($data_aplica_esp as $aplica_esp) {
											if ($aplica_esp !== end($data_aplica_esp)) {
												$separador = ",";
											} else {
												$separador = ".";
											}
											echo $aplica_esp->fraccion . $separador . " ";
										}
										?>
									</td>
									<td>
										<?php
										foreach ($data_noaplica_esp as $noaplica_esp) {
											if ($noaplica_esp !== end($data_noaplica_esp)) {
												$separador = ",";
											} else {
												$separador = ".";
											}
											echo $noaplica_esp->fraccion . $separador . " ";
										}
										?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				<?php endforeach ?>
			</div>
			<?php if ($view_na_oc !== 0) { ?>
				<div class="row ">
					<div class="card-panel col s12 orange lighten-5 hoverable"><br />
						<div class="section center orange lighten-4">
							<b>OBLIGACIONES COMUNES  <br /></b> Fracciones determinadas por el sujeto obligado como NO APLICABLES, con su justificación:
						</div>

						<div class="divider"></div>
						<div>
							<table border="1" class="highlight str" style="font-size: 12px">
								<thead class="centered">

									<tr>
										<th >No</th>
										<th width="45%">Fracción</th>
										<th width="45%">Justificación NO APLICABILIDAD</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									foreach ($data_noaplica as $na):
										?>

										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo '<b>Fracción ' . $na->fraccion . '</b>.-' . $na->descrip_frac ?></td>
											<td><?php echo $na->justificacion_so_oc ?></td>

										</tr>

										<?php
										$i++;
									endforeach;
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			<?php } else { ?>
				<div style="font-size: 12px; color:green">
					<i class="tiny material-icons" style="vertical-align: -2px">info</i> No se registraron obligaciones comunes como NO APLICABLES.
				</div>

			<?php } ?>
			<?php if ($view_na_esp !== 0) { ?>
				<div class="row ">
					<div class="card-panel col s12 orange lighten-5 hoverable"><br />
						<div class="section center orange lighten-4">
							<b>OBLIGACIONES ESPECÍFICAS <br /></b> Fracciones determinadas por el sujeto obligado como NO APLICABLES, con su justificación:
						</div>

						<div class="divider"></div>
						<div>
							<table border="1" class="highlight str" style="font-size: 12px">
								<thead class="centered">

									<tr>
										<th >No</th>
										<th width="45%">Fracción</th>
										<th width="45%">Justificación NO APLICABILIDAD</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									foreach ($data_noaplica_esp as $na_esp):
										?>

										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo '<b>Fracción ' . $na_esp->fraccion . '</b>.-' . $na_esp->descrip_frac ?></td>
											<td><?php echo $na_esp->just_so_oesp ?></td>

										</tr>

										<?php
										$i++;
									endforeach;
									?>
								</tbody>
							</table>
						</div>

					</div>
				</div>
			<?php } else { ?>
				<div style="font-size: 12px; color:green">
					<i class="tiny material-icons" style="vertical-align: -2px">info</i> No se registraron obligaciones especificas como NO APLICABLES.
				</div>

			<?php } ?>
			<div class="row center section section">
				<div class="col s3"> 
					<?php
					if ($val_send_table == 1) {
						$activate = 'disabled';
					} else {
						$activate = '';
					}
					?>
					<a href="<?php echo base_url('tablas_ap/edit_table') ?>"  id="edit_table" class="btn waves-effect waves-light" <?php echo $activate ?>><i class="material-icons" style="vertical-align: -3px">edit</i> EDITAR TABLA</a>
				</div>
				<div class="col s3">
					<a href="<?php echo base_url('Pdfcreator_controller') ?>" class="btn  red darken-4 waves-effect waves-light"><i class="material-icons" style="vertical-align: -3px">picture_as_pdf</i> descargar PDF  <i class="material-icons" style="vertical-align: -3px">file_download</i></a>
				</div>
				<div class="col s3">
					<a href="<?php echo base_url('tablas_ap/edit_table') ?>" class="btn green darken-4 waves-effect waves-light"><i class="material-icons" style="vertical-align: -3px">insert_drive_file</i> GENERAR EXCEL (.xlsx)</a>
				</div>
				<div class="col s3">
					<button  class="btn orange darken-4 waves-effect waves-light" id="send_mail" <?php echo $activate ?>><i class="material-icons" style="vertical-align: -3px">send</i> ENVIAR TABLA </button>
				</div>
			</div>
			<div  class="row  " id="pre_sendmail" style="display:none" >
				<div class="progress">
					<div class="indeterminate"></div>
				</div>
			</div>
			<div id="send_done">

			</div>
		</div>


	</div>
</div>
<!-- Modal Structure -->
<div id="warning_send_mail" class="modal">
    <div class="modal-content">
		<div class="card horizontal">
			<div class="card-image">
				<div class="hide-on-small-only">
					<img src="<?php echo base_url('assets/images/warn.jpg') ?>">
				</div>

			</div>
			<div class="card-stacked">
				<div class="card-content">
					<div style="font-size: 18px; text-align: center"><b>ATENCIÓN</b></div>
					<br /><div style="font-size: 14px">Al realizar el envío de esta tabla de aplicabilidad, correspondiente al ejercicio <?php echo $this->session->userdata('ejercicio') ?>, ya no será posible realizar cambios en la misma.</div>
					<br /><div style="font-size: 14px "> <b>¿Confirma que desea realizar el envío de esta tabla de aplicabilidad?</b></div>
					<input type="hidden" name="id_user" id="id_user" value="" />
				</div>
			</div>
		</div>
    </div>
    <div class="modal-footer ">
		<div  style="text-align: center" class="">
			<button  id="confirm_sendmail" class="waves-effect waves-light btn  " ><i class="material-icons left">check_circle</i> ENTIENDO Y DESEO CONTINUAR  </button> 
			<button type="reset" class="waves-effect waves-light btn  red darken-4 modal-close" ><i class="material-icons left">cancel</i> CANCELAR Y VOLVER A EDITAR </button> 
			<br />
		</div>
    </div>
</div>
<script type="text/javascript">
	$("#send_mail").on("click", function () {

		$("#warning_send_mail").modal('open');
	});

	$("#confirm_sendmail").on("click", function () {
		base_url = "<?php echo base_url(); ?>";
		var id_so_user = <?php echo $this->session->userdata('id_so_user'); ?>;
		var ejercicio = <?php echo $this->session->userdata('ejercicio'); ?>;
		$.ajax({
			async: true,
			type: "POST",
			url: base_url + "send_mail",
			cache: false,
			data: {'id_so_user': id_so_user, 'ejercicio': ejercicio},
			dataType: "html",
			beforeSend: function () {
				$("#pre_sendmail").show();
				$("#send_done").empty();
				$("#warning_send_mail").modal('close');
			},
			success: function (load)
			{
				$("#pre_sendmail").hide();
				$("#send_done").append(load);
			}
		});

	});

</script>