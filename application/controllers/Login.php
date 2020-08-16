<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

Class Login Extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url', 'file', 'text'));
		$this->load->model('Usuarios_model');
//        $this->load->model('Img_model');
	}

	public function login() {
		$this->form_validation->set_error_delimiters('<div  style="color:#d9534f; font-size: 13px"> <i class="tiny material-icons" style="vertical-align:-2px">cancel</i>  ', '</div>');
		$this->form_validation->set_rules('usuario', '<b>Usuario </b>', 'required');
		$this->form_validation->set_rules('contrasenia', '<b>Contraseña </b>', 'required');

		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
			echo '<script>$("#login").attr("disabled", false);</script>';
		} else {
			sleep(1);

			$usuario = $this->security->xss_clean(strip_tags($this->input->post('usuario')));
			$decryp_password = $this->security->xss_clean(strip_tags($this->input->post('contrasenia')));

			$this->load->library('opencypher');
			$password = $this->opencypher->cifrararchivos('encrypt', $decryp_password);
			$valida = $this->Usuarios_model->validar_login($usuario, $password);
			if ($valida == TRUE) {
				echo '<div class="light-green lighten-5 green-text" style="text-align:center;font-size: 14px" ><i class="material-icons">beenhere</i><br>Los datos son correctos.<br>Redireccionando...  </div>';
				if ($this->session->userdata('nivel_user') == 2) {
					echo '<script  type="text/javascript">    setTimeout(function (){var url = base_url + "tablas_ap";   $(location).attr("href", url);    }, 2000);</script>';
				} else {
					echo '<script  type="text/javascript">    setTimeout(function (){var url = base_url + "behome";   $(location).attr("href", url);    }, 2000);</script>';
				}
			} else {
				echo $this->session->flashdata('mensaje');
				echo '<script>$("#login").attr("disabled", false);</script>';
				exit();
			}
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		$this->session->set_userdata('Sistema de Gestión de Clientes', 'https://alqccontabilidad.com/');
		redirect(base_url('home/login'));
	}

	public function forbidden() {
		$dinamic_content['contenido'] = 'forbidden';
		$this->load->view('plantilla/plantilla_front_end', $dinamic_content);
	}

}
