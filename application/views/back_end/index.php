

<div class="container section">

	<div class="row">
		<div class="col s12 ">
			<div class="card hoverable ">
				<div class="card-image">
					<img src="<?php echo base_url('assets/images/tabla.jpg') ?>"class="responsive-img">
					<span class="card-title"><strong>LTAIPEC, Art. 74, segundo párrafo</strong></span>
				</div>
				<div class="card-content">
					<p>Los sujetos obligados deberán informar a la Comisión y constatar que se publiquen en la Plataforma
						Nacional cuáles son los rubros que son aplicables a sus páginas electrónicas, con el objeto de que el
						organismo garante verifique y apruebe, de forma fundada y motivada, la relación de fracciones aplicables a
						cada sujeto obligado.</p>
				</div>
				<div class="card-action">
					<div class="row">
						<div class="col s12 center-align">
							<?php if ($verify_table == "1") { ?>
								<a href="javascript:loadURL()" class="waves-effect waves-light btn-large  orange darken-4 " id="ver_tablas"><i class="material-icons" style="vertical-align: -6px">pageview</i> Ver tabla de aplicabilidad creada</a>

							<?php } else {  ?>
								<a href="#!" class="waves-effect waves-light btn-large  green darken-4 " id="iniciar_tabla"><i class="material-icons"  style="vertical-align: -6px">add_to_photos</i> Iniciar / continuar Registro de tabla de aplicabilidad</a>

							<?php }
							?>

						</div>

					</div>


				</div>
			</div>
		</div>

    </div>	
</div>
<div id="data_name" class="modal    ">  
	<div class="modal-content section ">
		<div class="row margin"  style="display: none" id="pre_data_user">
			<div class="progress">
				<div class="indeterminate"></div>
			</div>
		</div>
		<div id="load_data_name">

		</div>
	</div>
</div>

<!-- /page content -->
<script type="text/javascript">
	$(document).ready(function () {
		base_url = "<?php echo base_url(); ?>";
		var elems = document.querySelectorAll('.modal');
		var instances = M.Modal.init(elems, {
			dismissible: false
		});

	});

	$("body").on('click', "#iniciar_tabla", function () {
		base_url = "<?php echo base_url(); ?>";
		var id_user = <?php echo $this->session->userdata('id_so_user'); ?>;
		$.ajax({
			type: "POST",
			url: base_url + "tablas_ap/create_table",
			data: 'id_user=' + id_user,
			dataType: "html",
			beforeSend: function () {
				$("#pre_data_user").show();
				$("#data_name").modal('open');
			},
			success: function (load)
			{
				$("#pre_data_user").hide();
				$("#load_data_name").append(load);
			}
		});
	});
	function loadURL()
	{
		var base_url = "<?php echo base_url("tablas_ap/view_table"); ?>";
		var id_articulo = <?php echo $this->session->userdata('id_cat_user') ?>;
		var ejercicio = <?php echo $this->session->userdata('ejercicio') ?>;
		var id_so = <?php echo $this->session->userdata('id_so_user') ?>;
		var dir = ` ${base_url}?id_art=${id_articulo}&ejer=${ejercicio}&id_so=${id_so}`;

		window.location.href = dir;
	}

//$("body").on('click', "#ver_tablas", function () {
//		base_url = "<?php echo base_url(); ?>";
//		var id_so = ;
//		var ejer = ;
//		$.ajax({
//			type: "POST",
//			url: base_url + "tablas_ap/view_table",
//			data: {'id_so': id_so, 'ejer': ejer},
//			dataType: "html",
//			beforeSend: function () {
//				$("#pre_data_user").show();
//				$("#data_name").modal('open');
//			},
//			success: function (load)
//			{
//				$("#pre_data_user").hide();
//				$("#load_data_name").append(load);
//			}
//		});

</script>