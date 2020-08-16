 

<div class="container section">
	<?php foreach ($data_SO as $SO): ?>
		<div class="row">
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
						<br />
						<div class="card-content col s12 m12 l12 center">
							<div><i class="medium material-icons">assignment_turned_in</i> <br /><b>MIS TABLAS ENVIADAS</b></div>
						</div>
						<div class="col s12 m12 l12">

							<ul class="collapsible">
								<li>
									<div class="collapsible-header">
										<i class="material-icons">assignment_turned_in</i>
										Tabla de aplicabilidad ____
										<span class="new badge">4</span></div>
									<div class="collapsible-body">
										<table>
											<thead>
												<th>Ejercicio</th>
												<th>Oblicaciones Comunes A</th>
												<th>Fecha de Envío</th>
												<th>Ssujeto Obligado</th>
											</thead>
										</table>
									</div>
								</li>
								
							</ul>
						</div>
					</div>

				</div>
			</div>
		</div>	
	<?php endforeach; ?>
</div>


<!-- /page content -->
<script type="text/javascript">

</script>