
<!-- page content -->
<div class="container">

	<div class="row section">
		<div class="col s12 ">
			<div class="card hoverable">
				<div class="card-image ">
					<img src="<?php echo base_url('assets/images/background_gral.jpg') ?>" >
					<span class="card-title" style="text-shadow: 1px 1px 1px black"><i class="material-icons" style="vertical-align: -5px;">people</i> <strong>Lista de usuarios registrados en el sistema</strong></span>
				</div>
				<div class="card-content section">
					<div class="row">

						<div class="row col s12">
							<table id="lista_usuarios" class="display responsive nowrap" style="width:100%">
								<thead>
									<tr> 

										<th>Usuario</th>
										<th>Operaciones</th>
										<th>Sujeto Obligado</th>
										<th>Tipo Usuario</th>
										<th>Categoría </th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($select_usr as $data_user): ?>
										<tr>

											<td><i class="material-icons" style="vertical-align: -5px;">how_to_reg</i> <?php echo $data_user->usuario ?></td>
											<td><div class="center-align"><a  href="#data_modal" class="waves-effect waves-light btn-small btn-floating  btn tooltipped editar_registro"id ="<?php echo $data_user->id_user ?>" data-position="top" data-tooltip="Editar"><i class="material-icons">edit</i></a>
													<a href="#data_modal" class=" waves-effect waves-light btn-small btn-floating  red btn tooltipped eliminar_registro" id ="<?php echo $data_user->id_user ?>" data-position="top" data-tooltip="Eliminar"><i class="material-icons">delete_sweep</i></a></div></td>
											<td><?php echo wordwrap($data_user->nombre_so, 35, "<br>", TRUE); ?></td>
											<td><i class="tiny material-icons" style="vertical-align: -5px;">radio_button_checked</i> <?php echo $data_user->descrip_nivel ?></td>
											<td><?php echo wordwrap($data_user->descrip_categoria, 35, "<br>", TRUE); ?></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="fixed-action-btn">
	<a href="" class="btn-floating red btn-large"><i class="material-icons large">home</i></a>
		<ul>
			<li>
				<a href="<?php echo base_url('usuarios/adduser')  ?>" class="btn-floating blue tooltipped" data-position="left" data-tooltip="Registrar usuario"><i class="material-icons">person_add</i></a>
			</li>
		</ul>
</div>
<!-- Modal Structure -->
<div id="data_modal" class="modal " style="width: 75% !important ; ">
    <div class="modal-content">
		<div id="load_data"></div>
    </div>

</div>




<!-- /page content -->
<script type="text/javascript">
	$(document).ready(function () {
		base_url = "<?php echo base_url(); ?>";
		$('select').formSelect();
	});
	$('#lista_usuarios').DataTable({
		language: {
			processing: "Procesando...",
			search: "BUSCAR:",
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


	$("body").on('click', ".editar_registro", function () {

		base_url = "<?php echo base_url(); ?>";
		var id_user = $(this).attr("id");
		$("#data_modal").modal('open','inDuration:0','outDuration:0');
		$.ajax({
			type: "POST",
			url: base_url + "usuarios/load_data_user",
			data: 'id_user=' + id_user,
			dataType: "html",
			beforeSend: function () {
				$("#load_data").empty();
			},
			success: function (load)
			{

				$("#load_data").empty();
				$("#load_data").append(load);
			}
		});
	});

	$("body").on('click', ".eliminar_registro", function () {
		base_url = "<?php echo base_url(); ?>";
		var id_user = $(this).attr("id");
		$("#data_modal").modal('open','inDuration:2000','outDuration:0');
		$.ajax({
			type: "POST",
			url: base_url + "usuarios/del_user",
			data: 'id_user=' + id_user,
			dataType: "html",
			beforeSend: function () {
				$("#load_data").empty();
			},
			success: function (load)
			{

				$("#load_data").empty();
				$("#load_data").append(load);
			}
		});
	});

</script>