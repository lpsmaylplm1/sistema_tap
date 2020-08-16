<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

Class Usuarios Extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url', 'file', 'text'));
		$this->load->model('Usuarios_model');
	}

//Cargar  lista de usuarios activos e inactivos
	public function index() {
		$dinamic_content['contenido'] = 'lista_usuarios';
		$dinamic_content['title'] = 'Gestión de usuarios del Sistema';
		$dinamic_content['select_usr'] = $this->Usuarios_model->obtener_usuarios();
		$this->load->view('template/be_template', $dinamic_content);
	}

	public function select_so_cat() {
		$id_cat = $this->security->xss_clean(strip_tags($this->input->post('id_cat')));
		$data_so_cat = $this->Usuarios_model->select_so_cat($id_cat);
		$lista_so = '<select  name="nombre_so" id="nombre_so" ><option value = "0">Selecciona sujeto obligado</option>';
		foreach ($data_so_cat as $so_cat) {
			$lista_so .= '<option value="' . $so_cat->id_so . '">' . $so_cat->nombre_so . '</option></select>';
		}
		echo $lista_so;
	}

	public function select_ubicacion() {
		$id_cat = $this->security->xss_clean(strip_tags($this->input->post('id_cat')));
		$obtener_id_muni = $this->Usuarios_model->obtener_id_muni($id_cat);
		foreach ($obtener_id_muni as $id_municipio) {
			$id = $id_municipio->id_municipio_so;
		}

		$data_ubicacion = $this->Usuarios_model->select_ubicacion($id);

		foreach ($data_ubicacion as $muni) {
//			$ubicacion='<i class="material-icons prefix">location_on </i><input  type="text"  id="ubicacion" name="ubicacion" disabled   value="'.$muni->nombre.' "><br><label for="ubicacion">USUARIO</label>';
			$id_ubica = $muni->id_ayuntamiento;
			$ubicacion = $muni->nombre;
		}
		$ubica = array(
			'id_ayu' => $id_ubica,
			'value' => $ubicacion
		);
		echo json_encode($ubica);
	}

	public function adduser() {
		$dinamic_content['contenido'] = 'new_data_user_view';
		$dinamic_content['title'] = 'Gestión de usuarios del Sistema';
		$dinamic_content['select_usr'] = $this->Usuarios_model->obtener_usuarios();
		$dinamic_content['select_cat'] = $this->Usuarios_model->select_categoria();
		$this->load->view('template/be_template', $dinamic_content);
	}

	public function seek_usr() {
		$user = $this->security->xss_clean(strip_tags($this->input->post('user')));
		$obtener_user = $this->Usuarios_model->obtener_user($user);
		if ($obtener_user !== 0) {
			echo ' <div  style="color:#b71c1c"> <i class="tiny material-icons">cancel</i> El usuario que intena registrar ya existe, intente con otro nombre de usuario para continuar  </div>';
			echo '<script>$("#usuario").focus();</script>';
			echo '<script>$("#usuario").val("");</script>';
			exit();
		}
	}

	public function save_user() {
		sleep(1);
		$this->form_validation->set_error_delimiters('<div  style="color:#d9534f"> <i class="tiny material-icons">cancel</i>  ', '</div>');
		$this->form_validation->set_rules('tipo_usuario', '<b>Tipo de Usuario</b>', 'required');
		$this->form_validation->set_rules('cat_so', '<b>Categoría</b>', 'required');
		$this->form_validation->set_rules('nombre_so', '<b>Sujeto Obligado</b>', 'required');
		$this->form_validation->set_rules('usuario', '<b>Usuario</b>', 'required');
		$this->form_validation->set_rules('password1', '<b>Contraseña 1</b>', 'required|min_length[8]');
		$this->form_validation->set_rules('password2', '<b>Confirmar Contraseña</b>', 'required|min_length[8]');
		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
			echo '<script>$("#btn_submit_edit").prop("disabled", false);</script>';
		} else {
			sleep(1);
			$tipo_usuario = $this->security->xss_clean(strip_tags($this->input->post('tipo_usuario')));
			$id_cat_so = $this->security->xss_clean(strip_tags($this->input->post('cat_so')));
			$id_nombre_so = $this->security->xss_clean(strip_tags($this->input->post('nombre_so')));
			$id_ayu = $this->security->xss_clean(strip_tags($this->input->post('id_ayu')));
			$usuario = $this->security->xss_clean(strip_tags($this->input->post('usuario')));
			$password1 = $this->security->xss_clean(strip_tags($this->input->post('password1')));
			$password2 = $this->security->xss_clean(strip_tags($this->input->post('password2')));
			$prev_activo = $this->security->xss_clean(strip_tags($this->input->post('is_active')));
			if ($prev_activo == "1") {
				$is_active = "1";
			} else {
				$is_active = "0";
			}

			if ($password1 == $password2) {
				$this->load->library('opencypher');
				$encryp_pass = $this->opencypher->cifrararchivos('encrypt', $password1);
				$valida = $this->Usuarios_model->save_usuario($tipo_usuario, $id_cat_so, $id_nombre_so, $id_ayu, $usuario, $encryp_pass, $is_active);
				if ($valida === TRUE) {
					echo '<div class="green-text center"><i class="medium material-icons">check_box</i> <br>Los datos de usuario se guardaron correctamente en la base de datos.</div>';
					echo ' <script>setTimeout(function () { location.href = base_url + "usuarios/adduser"; },1000)</script>';
					exit();
				} else {
					echo ' <div class="alert alert-success"  style="font-size: 12px"> <i class="fa fa-check-square-o fa "></i> Ocurrió un error al intentar guardar los datos de usuario en la base de datos, por favor intente de nuevo.  </div>';
					exit();
				}
			} else {
				echo ' <div  style="color:#b71c1c"> <i class="tiny material-icons">cancel</i>  Las contraseñas no coinciden, por favor, verifique e intente de nuevo.  </div>';
				echo '<script>$("#btn_submit_edit").prop("disabled", false);</script>';
			}
		}
	}

	public function load_data_user() {
		$id_user = $this->security->xss_clean(strip_tags($this->input->post('id_user')));
		$dinamic_content['select_nivel'] = $this->Usuarios_model->select_nivel_user();
		$dinamic_content['select_so'] = $this->Usuarios_model->obtener_so();
		$dinamic_content['select_cat'] = $this->Usuarios_model->select_categoria();
		$dinamic_content['prev_data_user'] = $this->Usuarios_model->obtener_datos_usuario($id_user);
		$data_usr = $this->Usuarios_model->obtener_datos_usuario($id_user);
		$this->load->library('opencypher');
		foreach ($data_usr as $data) {
			$pass = $data->password;
			$id_ayunt = $data->id_municipio_so;
		}

		$ubicacion = $this->Usuarios_model->obtener_municipio($id_ayunt);
		foreach ($ubicacion as $data_ubica) {
			$id_municipio = $data_ubica->id_ayuntamiento;
		}

		$decryp_pass = $this->opencypher->cifrararchivos('decrypt', $pass);
		$dinamic_content['pass'] = $decryp_pass;
		$dinamic_content['municipio'] = $id_municipio;
		$dinamic_content['data_municipios'] = $this->Usuarios_model->catalogo_municipios();
		$this->load->view('back_end/load_data_user_view', $dinamic_content);
	}

	public function get_data_edit_user() {
		sleep(1);
		$this->form_validation->set_error_delimiters('<div  style="color:#d9534f"> <i class="tiny material-icons">cancel</i>  ', '</div>');
		$this->form_validation->set_rules('tipo_usuario', '<b>Tipo de Usuario</b>', 'required');
		$this->form_validation->set_rules('cat_so', '<b>Categoría</b>', 'required');
		$this->form_validation->set_rules('nombre_so', '<b>Sujeto Obligado</b>', 'required');
		$this->form_validation->set_rules('usuario', '<b>Usuario</b>', 'required');
		$this->form_validation->set_rules('password1', '<b>Contraseña 1</b>', 'required|min_length[8]');
		$this->form_validation->set_rules('password2', '<b>Confirmar Contraseña</b>', 'required|min_length[8]');
		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
			echo '<script>$("#btn_submit_edit").prop("disabled", false);</script>';
		} else {
			sleep(1);
			$this->output->enable_profiler();
			$tipo_usuario = $this->security->xss_clean(strip_tags($this->input->post('tipo_usuario')));
			$id_cat_so = $this->security->xss_clean(strip_tags($this->input->post('cat_so')));
			$id_nombre_so = $this->security->xss_clean(strip_tags($this->input->post('nombre_so')));
			$id_ayu = $this->security->xss_clean(strip_tags($this->input->post('ubicacion')));
			$usuario = $this->security->xss_clean(strip_tags($this->input->post('usuario')));
			$id_user = $this->security->xss_clean(strip_tags($this->input->post('id_usuario')));
			$password1 = $this->security->xss_clean(strip_tags($this->input->post('password1')));
			$password2 = $this->security->xss_clean(strip_tags($this->input->post('password2')));
			$prev_activo = $this->security->xss_clean(strip_tags($this->input->post('is_active')));
			if ($prev_activo == "1") {
				$is_active = "1";
			} else {
				$is_active = "0";
			}

			if ($password1 == $password2) {
				$this->load->library('opencypher');
				$encryp_pass = $this->opencypher->cifrararchivos('encrypt', $password1);
				$valida = $this->Usuarios_model->actualizar_usuario($id_user, $tipo_usuario, $id_cat_so, $id_nombre_so, $id_ayu, $usuario, $encryp_pass, $is_active);

				if ($valida === TRUE) {
					echo '<div class="green-text center"><i class="medium material-icons">check_box</i> <br>Los datos de usuario se actualizaron correctamente en la base de datos.</div>';
					echo ' <script>setTimeout(function () { location.href = base_url + "usuarios"; },1500)</script>';
					exit();
				} else {
					echo ' <div class="alert alert-success"  style="font-size: 12px"> <i class="fa fa-check-square-o fa "></i> Ocurrió un error al intentar guardar los datos de usuario en la base de datos, por favor intente de nuevo.  </div>';
					exit();
				}
			} else {
				echo ' <div  style="color:#b71c1c"> <i class="tiny material-icons" style="vertical-align: -2px;">cancel</i>  Las contraseñas no coinciden, por favor, verifique e intente de nuevo.  </div>';
				echo '<script>$("#btn_submit_edit").prop("disabled", false);</script>';
			}
		}
	}

	public function get_data_user() {
		$id_user = $this->security->xss_clean(strip_tags($this->input->post('id_user')));
		$dinamic_content['prev_data_user'] = $this->Usuarios_model->obtener_datos_usuario($id_user);
		$data_usr = $this->Usuarios_model->obtener_datos_usuario($id_user);
		$this->load->library('opencypher');
		foreach ($data_usr as $data) {
			$pass = $data->password;
		};
		$decryp_pass = $this->opencypher->cifrararchivos('decrypt', $pass);
		$dinamic_content['pass'] = $decryp_pass;
		$this->load->view('back_end/get_data_user_view', $dinamic_content);
	}

	public function del_user() {
		$dinamic_content['id_user'] = $this->security->xss_clean(strip_tags($this->input->post('id_user')));
		$this->load->view('back_end/del_data_user_view', $dinamic_content);
	}

	public function confirm_del_user() {
		sleep(1);
		$id_user = $this->security->xss_clean(strip_tags($this->input->post('id_user')));
		$valida = $this->Usuarios_model->delete_usuario($id_user);
		if ($valida === TRUE) {
			echo '<div class="green-text center"><i class="medium material-icons">check_box</i> <br>El usuario se eliminó correctamente en la base de datos.</div>';
			echo ' <script>setTimeout(function () { location.href = base_url + "usuarios"; },1500)</script>';
		} elseif ($valida === FALSE) {
			echo ' <div class="alert alert-danger  alert-dismissible fade in" role="alert" style="font-size: 18px"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button> <i class="fa fa-check-square-o fa "></i> Ocurrió un error al intentar actualizar la información del usuario en la base de datos.  </div>';
		}
	}

	public function update_name_user() {
		$this->form_validation->set_error_delimiters('<div  style="color:#d9534f; font-size:12px"> <i class="tiny material-icons">cancel</i>  ', '</div>');
		$this->form_validation->set_rules('nombre_user', '<b>Nombres </b>', 'required');
		$this->form_validation->set_rules('ap_p_user', '<b>Apellido Paterno </b>', 'required');
		$this->form_validation->set_rules('ap_m_user', '<b>Apellido Paterno</b>', 'required');
		$this->form_validation->set_rules('correo_user', '<b>Correo</b>', 'required|valid_email');

		if ($this->form_validation->run() == FALSE) {
			sleep(1);
			echo validation_errors();
		} else {
			sleep(1);
			$id_user = $this->security->xss_clean(strip_tags($this->input->post('id_user')));
			$nombre_user = $this->security->xss_clean(strip_tags($this->input->post('nombre_user')));
			$ap_p_user = $this->security->xss_clean(strip_tags($this->input->post('ap_p_user')));
			$ap_m_user = $this->security->xss_clean(strip_tags($this->input->post('ap_m_user')));
			$correo_user = $this->security->xss_clean(strip_tags($this->input->post('correo_user')));
			
			$valida = $this->Usuarios_model->update_name_usuario($id_user, $nombre_user,$ap_p_user,$ap_m_user,$correo_user);
			if ($valida === TRUE) {
				echo '<div class="green-text center"><i class="medium material-icons">check_box</i> <br>Los datos de usuario se guardaron correctamente en la base de datos.</div>';
				echo '<script>setTimeout(function(){$("#load_data_name").empty(); $("#data_name").modal("close");  }, 2000); window.location.href = "'. base_url('tablas_ap/confirm_create_table').'"; </script>';
				

			} else {
				echo ' <div class="alert alert-danger  alert-dismissible fade in" role="alert" style="font-size: 18px"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button> <i class="fa fa-check-square-o fa "></i> Ocurrió un error al intentar actualizar la información del usuario en la base de datos.  </div>';
			}
		}
	}

}
