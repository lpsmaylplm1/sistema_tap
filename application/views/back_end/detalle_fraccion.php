

<table id="fracciones" class=" display responsive nowrap" width="95%">
	<thead>
	<th style="font-size:12px" >Artículo</th>
	<th style="font-size:12px">Fracción</th>
	<th style="font-size:12px">Descripción</th>
	<th style="font-size:14px">Operaciones</th>


</thead>
<tbody>
	<?php foreach ($data_fracciones as $data_frac): ?>
		<tr>
			<td style="font-size:12px "><i class="tiny material-icons" style="vertical-align: -2px;">local_library</i> Art.-<?php
				$art = substr($data_frac->fraccion, 0, 6);
				if ($art == "LGTAIP") {
					echo "70";
				} else {
					echo $data_frac->articulo;
				}
				?></td>
			<td style="font-size:12px "><?php echo $data_frac->fraccion ?></td>
			<td style="font-size:12px "><?php echo wordwrap($data_frac->descrip_frac, 50, "<br>", TRUE);	 ?></td>
			<td style="font-size:12px ">
				<a href="#!" class=" waves-effect waves-light btn-small btn-floating   btn tooltipped add_fund" id ="<?php echo $data_frac->id_fraccion ?>" data-position="top" data-tooltip="Agregar / Editar fundamentación "><i class="material-icons">add_circle</i></a> &nbsp;
				<?php if ($data_frac->fundamentacion_ltg == "") { ?>
					<a  disabled href="#!" class=" waves-effect waves-light btn-small btn-floating orange darken-4  btn tooltipped view_fund" id ="<?php echo $data_frac->id_fraccion ?>" data-position="top" data-tooltip="Ver fundamentación "><i class="material-icons">pageview</i></a>
				<?php } else { ?>
					<a   href="#!" class=" waves-effect waves-light btn-small btn-floating orange darken-4  btn tooltipped view_fund" id ="<?php echo $data_frac->id_fraccion ?>" data-position="top" data-tooltip="Ver fundamentación "><i class="material-icons">pageview</i></a>
				<?php } ?>
			</td>
		</tr>

	<?php endforeach ?>
</tbody>
</table>

<script type="text/javascript">
	$(document).ready(function () {
		base_url = "<?php echo base_url(); ?>";
		$('select').formSelect();
		$('.tooltipped').tooltip();
		$("#load_data_fund").empty();
	});
	$("body").on('click', ".add_fund", function () {
		$("#load_data_fund").empty();
		base_url = "<?php echo base_url(); ?>";
		var id_frac = $(this).attr("id");
		$("#data_fundamenta").modal('open');
		$.ajax({
			async: true,
			type: "POST",
			url: base_url + "tablas_ap/add_fundamenta",
			data: 'id_frac=' + id_frac,
			dataType: "html",
			beforeSend: function () {
				$("#load_data_fund").empty();
			},
			success: function (load)
			{

				$("#load_data_fund").empty();
				$("#load_data_fund").append(load);

			}
		});
	});
	$("body").on('click', ".view_fund", function () {
		$("#load_data_fund").empty();
		base_url = "<?php echo base_url(); ?>";
		var id_frac = $(this).attr("id");
		$("#data_fundamenta").modal('open');
		$.ajax({
			async: true,
			type: "POST",
			url: base_url + "tablas_ap/view_fundamenta",
			data: 'id_frac=' + id_frac,
			dataType: "html",
			beforeSend: function () {
				$("#load_data_fund").empty();
			},
			success: function (load)
			{

				$("#load_data_fund").empty();
				$("#load_data_fund").append(load);

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
</script>