
<div class="row section">

	<?php foreach ($data_SO as $SO): ?>
		<div class="card-panel col s12 orange lighten-5 hoverable"><br />
			<div class="section center orange lighten-4">
				<b>CATEGORÍA: </b><?php echo $SO->descrip_categoria ?>
			</div>

			<table   id="report_table_full"  class="display responsive nowrap"  style="font-size: 12px" >  
				<thead class="centered">
					<tr>
						<th rowspan="2">No.</th>
						<th width="30%" rowspan="2">Sujeto Obligado</th>
						<th width="30%" colspan="2" style="text-align: center">Obligaciones comunes <br />- artículo 74 de la Ley Estatal.</th>

						<th width="30%" colspan="2" style="text-align: center">Obligaciones Específicas <br />- artículo 
							<?php
							if ($SO->id_art_cat === "75") {
								echo $SO->id_art_cat . ' de la Ley Estatal e inciso F del artículo 71 de la Ley General.';
							} elseif ($SO->id_art_cat === "76") {
								echo $SO->id_art_cat . ' de la Ley Estatal e incisos B, C, y  D  del artículo 71 de la Ley General.';
							} else {
								echo $SO->id_art_cat . '.';
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
					<?php
					foreach ($data_group as $group) {
						$id_so_key = $group->id_so_oc;
						?>
						<tr>
							<td  class="center">
								<?php
								echo key($data_group) + 1;
								next($data_group);
								?>
							</td>
							<td>
								<?php echo $group->nombre_so ?>
							</td>
							<td>
								<?php
								foreach ($data_aplica_oc as $aplica) {
									if ($id_so_key == $aplica->id_so_oc) {
										$separador = ",";
										if ($aplica->fraccion == "Párrafo Segundo") {
											$separador = ".";
										}
										echo $aplica->fraccion . $separador . ' ';
									}
								}
								?>
							</td>
							<td><?php
								foreach ($data_noaplica_oc as $noaplica) {
									if ($id_so_key == $noaplica->id_so_oc) {
										$separador = ",";
										if ($noaplica->fraccion == "Párrafo Segundo") {
											$separador = ".";
										}

										echo $noaplica->fraccion . $separador . ' ';
									}
								}
								?></td>
							<td>
								<?php
								foreach ($data_aplica_esp as $aplica_esp) {
									if ($id_so_key == $aplica_esp->$data_id_so) {
										$separador = ",";
										if ($aplica_esp->fraccion == "Párrafo Segundo") {
											$separador = ".";
										}
//										$inciso = explode(", ", $aplica_esp->fraccion);
//										if ($inciso[0] == 'Fr. III') { 
//											$fraccion = 'Fracción III';
//											echo  substr($inciso[1],-1,1).' ';
//										}
										echo $aplica_esp->fraccion . $separador . ' ';
									}
								}
								?>
							</td>
							<td>
								<?php
								foreach ($data_noaplica_esp as $noaplica_esp) {
									if ($id_so_key == $noaplica_esp->$data_id_so) {
										$separador = ",";
										if ($noaplica_esp->fraccion == "Párrafo Segundo") {
											$separador = ".";
										}
										echo $noaplica_esp->fraccion . $separador . ' ';
									}
								}
								?>
							</td>
						</tr>
					<?php }
					?>
					<tr>


					</tr>
				</tbody>
			</table>
		</div>
	<?php endforeach ?>
</div>

<script type="text/javascript">

</script>
