
<script type="text/javascript">
	$(document).ready(function () {
		base_url = "http://localhost:8080/sistema_tap/";
		$('select').formSelect();
		$('.tooltipped').tooltip();
		$("#load_data_fund").empty();
	});
	$("body").on('click', ".add_fund", function () {
		$("#load_data_fund").empty();
		base_url = "http://localhost:8080/sistema_tap/";
		var id_frac = $(this).attr("id");
		$("#data_fundamenta").modal('open');
		$.ajax({
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
		base_url = "http://localhost:8080/sistema_tap/";
		var id_frac = $(this).attr("id");
		$("#data_fundamenta").modal('open');
		$.ajax({
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
//	$('#fracciones').DataTable({
//		language: {
//			processing: "Procesando...",
//			search: "<b>BUSCAR:</b>",
//			lengthMenu: "Mostrar _MENU_ registros",
//			info: "Mostrando _START_  de _END_  de un total de _TOTAL_ registros",
//			infoEmpty: "Mostrando  0 coincidencias",
//			infoFiltered: "(de un total de _MAX_ registros)",
//			infoPostFix: "",
//			loadingRecords: "Cargando...",
//			zeroRecords: "No existen registros que mostrar",
//			emptyTable: "No existen registros en la tabla",
//			paginate: {
//				first: "Primer",
//				previous: "Anterior",
//				next: "Siguiente",
//				last: "Último"
//			},
//			aria: {
//				sortAscending: ": Ordenar la columna en forma Ascendente",
//				sortDescending: ": Ordenar la columna en forma Descendente"
//			}
//
//		}
//
//	});
</script>
<script type="text/javascript">
		$(document).ready(function () {
			base_url = "http://localhost:8080/sistema_tap/";
			$('select').formSelect();
			$('#detail_frac').empty();
		});

		base_url = "http://localhost:8080/sistema_tap/";
		$("body").on('change', "#articulo", function () {
			$('#detail_frac').empty();
			URL = base_url + "tablas_ap/select_fraccion";
			var id_art = $('#articulo').val();
			$.ajax({
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
		});
		base_url = "http://localhost:8080/sistema_tap/";
		$("#refresh").on('click', function () {
			$('#detail_frac').empty();
			URL = base_url + "tablas_ap/select_fraccion";
			var id_art = $('#articulo').val();
			$.ajax({
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
		});
	</script>