<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

Class Behome Extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url', 'file', 'text'));
		$this->load->model('Tablas_ap_model');
	}

	public function index() {

		$ejercicio = $this->security->xss_clean(strip_tags($this->session->userdata('ejercicio')));
		$id_so = $this->security->xss_clean(strip_tags($this->session->userdata('id_so_user')));

		$dinamic_content['contenido'] = 'index';
		$dinamic_content['title'] = 'Tablas de aplicabilidad';
		$verify_table = $this->Tablas_ap_model->val_com_esp_so($ejercicio, (int)$id_so);
		if ($verify_table == 0) {
			$dinamic_content['verify_table'] = 0;
		} else {
			$dinamic_content['verify_table'] = 1;
		}
		$this->load->view('template/be_template', $dinamic_content);
	}

}
