
<!-- page content -->










<!-- /page content -->
<script type="text/javascript">
	$(document).ready(function () {
		base_url = "<?php echo base_url(); ?>";
	});

	$("body").on('click', "#btn_save", function () {
		base_url = "<?php echo base_url(); ?>";
		$.ajax({
			type: "POST",
			url: base_url + "usuarios/update_name_user",
			data: $('#name_user').serialize(),
			dataType: "html",
			beforeSend: function () {
				$("#pre-saving").show();
			},
			success: function (done)
			{
				$("#pre-saving").hide();
				$("#confirm_save_name").empty();
				$("#confirm_save_name").append(done);
			}
		});
	});


</script>