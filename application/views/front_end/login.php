<div  class="row container section">
	<div class="col s12 m12 l6 offset-l3 ">
		<div class="col s12 z-depth-4 card-panel hoverable " style="opacity: 87%">
			<form class="login-form" id="form_log" method="POST" >
				<div class="row">
					<div class="input-field col s12 center" style="opacity: 100%">
						<img src="<?php echo base_url('assets/images/user.png') ?>" alt="" class="circle responsive-img valign profile-image-login" >
						<p class="center login-form-text"><h5>Iniciar sesión</h5></p>
					</div>
				</div>
				<div class="container">
					<div class="row margin">

						<div class="input-field col s12">
							<i class="material-icons prefix">account_circle</i>
							<input id="usuario" name ="usuario" type="text">
							<label for="usuario" class="center-align">Usuario</label>
						</div>
					</div>
					<div class="row margin">
						<div class="input-field col s12">
							<i class="material-icons prefix">vpn_key</i>
							<input id="contrasenia" type="password" name="contrasenia">
							<label for="contrasenia">Contraseña</label>
						</div>
					</div>
					<div class="row margin"  style="display: none" id="pre-loading">
						<div class="progress">
							<div class="indeterminate"></div>
						</div>
					</div>
					<div class="row margin"   id="resp">

					</div>
				</div>
			</form>

			<div class="row section center-align">
				<div class="container">
					<button class="btn-large waves-effect waves-light orange darken-4" id="login"><i class="material-icons right">send</i>Iniciar Sesión</button>
				</div>
			</div>

		</div>
	</div>

</div>

<script type="text/javascript">
	$(document).ready(function () {
		base_url = "<?php echo base_url(); ?>";
	});
	$('#login').click(function () {
		URL = base_url + "login/login";
		$.ajax({
			type: "POST",
			url: URL,
			data: $("#form_log").serialize(),
			dataType: "html",
			beforeSend: function () {
				$("#pre-loading").show();
				$("#resp").empty();
				$('#login').attr('disabled', true);
			},
			success: function (data) {
				$("#pre-loading").hide();
				$('#resp').html(data);
			}
		});
	});
</script>
<script src="<?php echo base_url('assets/front_end/js/jquery_code.js') ?>" ></script>
