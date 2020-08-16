<?php if ($this->session->userdata('nivel_user') == 2) { ?>
	<div class="container  section">
		<a href="#" class="sidenav-trigger" data-target="menu-side"><i class="material-icons">menu</i></a>
		<ul class="sidenav" id="menu-side">
			<li>
				<div class="user-view">
					<div class="background">
						<img src="<?php echo base_url('assets/images/background_profile.jpg') ?>" alt="" />
					</div>
					<div class="center">
						<a href="#!" ><img src="<?php echo base_url('assets/images/logo_circle.png') ?>" alt="" class="circle"/></a>	
					</div>

					<a href="#!"><span class="name white-text"><b><?php echo $this->session->userdata('nombre_user').' '.$this->session->userdata('ap_p').' '.$this->session->userdata('ap_m')?></b></span></a>
					<a href="#!"><span class="email white-text"><?php echo $this->session->userdata('correo')?></span></a>
				</div>
			</li>

			<li class="no-padding">
				<ul class="collapsible collapsible-accordion">
					<li>
						<a class="collapsible-header"><i class="material-icons">people</i> Usuarios<i class="material-icons right">keyboard_arrow_down</i></a>
						<div class="collapsible-body">
							<ul>
								<li><a href="<?php echo base_url('usuarios/adduser') ?>"><i class="material-icons">person_add</i>Registrar usuarios</a></li>
								<li><a href="<?php echo base_url('usuarios') ?>"><i class="material-icons">edit</i>Operaciones con usuarios</a></li>
							</ul>
						</div>
					</li>
				</ul>
			</li>
			<li>
				<div class="divider"></div>
			</li>
			<li class="no-padding">
				<ul class="collapsible collapsible-accordion">
					<li>
						<a class="collapsible-header"><i class="material-icons">settings_applications</i> Admin. configuración<i class="material-icons right">keyboard_arrow_down</i></a>
						<div class="collapsible-body">
							<ul>
								<li><a href="<?php echo base_url('tablas_ap') ?>"><i class="material-icons">perm_data_setting</i>Configurar aplicabilidad</a></li>

							</ul>
						</div>
					</li>
				</ul>
			</li>
			<li>
				<div class="divider"></div>
			</li>
			<li class="no-padding">
				<ul class="collapsible collapsible-accordion">
					<li>
						<a class="collapsible-header"><i class="material-icons">picture_as_pdf</i> Generar Reportes<i class="material-icons right">keyboard_arrow_down</i></a>
						<div class="collapsible-body">
							<ul>
								<li><a href="<?php echo base_url('pdfcreator_controller/prev_report_full') ?>"><i class="material-icons">assignment_turned_in</i>Total de Tablas de Aplicabilidad</a></li>

							</ul>
							<ul>
								<li><a href="<?php echo base_url('tablas_ap') ?>"><i class="material-icons">check_circle</i>Sujetos Obligados Cumplidos</a></li>

							</ul>
						</div>
					</li>
				</ul>
			</li>
		</ul>
	</ul>
	</div>
<?php } else { ?>
	<div class="container  section">
		<a href="#" class="sidenav-trigger" data-target="menu-side"><i class="material-icons">menu</i></a>
		<ul class="sidenav" id="menu-side">
			<li>
				<div class="user-view">
					<div class="background">
						<img src="<?php echo base_url('assets/images/background_profile.jpg') ?>" alt="" />
					</div>
					<div class="center">
						<a href="#!" ><img src="<?php echo base_url('assets/images/logo_circle.png') ?>" alt="" class="circle"/></a>	
					</div>

				<a href="#!"><span class="name white-text"><b><?php echo $this->session->userdata('nombre_user').' '.$this->session->userdata('ap_p').' '.$this->session->userdata('ap_m')?>i</b></span></a>
					<a href="#!"><span class="email white-text"><?php echo $this->session->userdata('correo')?></span></a>
				</div>
			</li>

			<li>
				<div class="divider"></div>
			</li>

			<li class="no-padding">
				<ul class="collapsible collapsible-accordion">
					<li>
						<a class="collapsible-header"><i class="material-icons">assignment_turned_in</i> Tablas de Aplicabilidad<i class="material-icons right">keyboard_arrow_down</i></a>
						<div class="collapsible-body">
							<ul>
								<li><a href="<?php echo base_url('behome') ?>"><i class="material-icons">playlist_add_check </i>Crear tabla de aplicabilidad</a></li>

							</ul>
							<ul>
								<li><a href="<?php echo base_url('tablas_ap/download_ac') ?>"><i class="material-icons">playlist_add_check </i>Mis tablas enviadas</a></li>

							</ul>
						</div>
					</li>
				</ul>
			</li>
		</ul>
	</ul>
	</div>
<?php } ?>
