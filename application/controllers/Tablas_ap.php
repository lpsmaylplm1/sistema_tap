<?php
//Testload
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

Class Tablas_ap Extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url', 'file', 'text'));
		$this->load->model('Tablas_ap_model');
		$this->load->model('Usuarios_model');
	}

	public function index() {
		$dinamic_content['contenido'] = 'conf_tabla_view';
		$dinamic_content['select_articulos'] = $this->Tablas_ap_model->select_articulos();
		$dinamic_content['title'] = 'Configuración de tablas de aplicabilidad';
		$this->load->view('template/be_template', $dinamic_content);
	}

	public function select_fraccion() {
//		sleep(1);
		$id_art = $this->security->xss_clean(strip_tags($this->input->post('id_art')));
		$id_oa = $this->security->xss_clean(strip_tags($this->input->post('id_oa')));
		if ($id_oa === '') {
			$dinamic_content['data_fracciones'] = $this->Tablas_ap_model->obtener_fracciones($id_art);
			$this->load->view('back_end/detalle_fraccion', $dinamic_content);
		} else {

			switch ($id_oa) {
				case 116: //CODEHCAM
					$dinamic_content['data_incisos'] = TRUE;
					$dinamic_content['data_fracciones'] = $this->Tablas_ap_model->obtener_fracciones_codehcam($id_art);
					$this->load->view('back_end/detalle_fraccion', $dinamic_content);
					break;
				case 117:  //Cotaipec
					$dinamic_content['data_incisos'] = TRUE;
					$dinamic_content['data_fracciones'] = $this->Tablas_ap_model->obtener_fracciones_cotaipec($id_art);
					$this->load->view('back_end/detalle_fraccion', $dinamic_content);
					break;
				case 118:  //Fiscalía Especializada en Combate a la Corrupción del Estado de Campeche
					echo '<div class="card-panel green lighten-3 center "><i class="medium material-icons">announcement</i><br><b>No existen <u>OBLIGACIONES ESPECIFICAS</u> para este sujeto obligado.</b> <br /> <span style="font-size:12px">No es posible continuar con el proceso de configuración de aplicabilidad.<br><span><div>';
					break;
				case 119: //IEEC
					$dinamic_content['data_incisos'] = TRUE;
					$dinamic_content['data_fracciones'] = $this->Tablas_ap_model->obtener_fracciones_ieec($id_art);
					$this->load->view('back_end/detalle_fraccion', $dinamic_content);
					break;
				case 120: //Tribunal de Justicia Administrativa del Estado de Campeche
					echo '<div class="card-panel green lighten-3 center "><i class="medium material-icons">announcement</i><br><b>No existen <u>OBLIGACIONES ESPECIFICAS</u> para este sujeto obligado.</b> <br /> <span style="font-size:12px">No es posible continuar con el proceso de configuración de aplicabilidad.<br><span><div>';
					break;
				case 121: //Tribunal Electoral del Estado de Campeche
					echo '<div class="card-panel green lighten-3 center "><i class="medium material-icons">announcement</i><br><b>No existen <u>OBLIGACIONES ESPECIFICAS</u> para este sujeto obligado.</b> <br /> <span style="font-size:12px">No es posible continuar con el proceso de configuración de aplicabilidad.<br><span><div>';
					break;
			}
		}
	}

	public function add_fundamenta() {
		$id_frac = $this->security->xss_clean(strip_tags($this->input->post('id_frac')));
		$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->obtener_fraccion_especifica($id_frac);
		$this->load->view('back_end/add_fundamenta', $dinamic_content);
	}

	public function save_fundamenta() {

		$this->form_validation->set_error_delimiters('<div  style="color:#d9534f"> <i class="tiny material-icons">cancel</i>  ', '</div>');
		$this->form_validation->set_rules('fundamenta_frac', '<b>Fundamentacion LTG</b>', 'required');

		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
		} else {
			sleep(1);
			$id_fraccion = $this->security->xss_clean(strip_tags($this->input->post('id_fraccion')));
			$fundamenta_frac = $this->security->xss_clean(strip_tags($this->input->post('fundamenta_frac')));
			$valida = $this->Tablas_ap_model->save_fundamentacion($id_fraccion, $fundamenta_frac);
			if ($valida) {
				echo "<script>  M.toast({html: 'La fundamentación  de esta fracción se guardó correctamente en la base de datos', displayLength: 2000})</script>";
//				echo '<i class="material-icons">check</i>';
//				echo ' <script>setTimeout(function () { $("#data_fundamenta").modal("close");$("#load_data_fund").empty();  $("#refresh").click();},1000)  </script>';
				echo ' <script>setTimeout(function () { $("#data_fundamenta").modal("close");$("#load_data_fund").empty();  $("#refresh").click();},1000)  </script>';
//				echo json_encode($id_articulo);
				exit();
			} else {
				echo ' <div class="alert alert-success"  style="font-size: 12px"> <i class="fa fa-check-square-o fa "></i> Ocurrió un error al intentar guardar los datos de usuario en la base de datos, por favor intente de nuevo.  </div>';
				exit();
			}
		}
	}

	public function view_fundamenta() {
		$id_frac = $this->security->xss_clean(strip_tags($this->input->post('id_frac')));
		$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->obtener_fraccion_especifica($id_frac);
		$this->load->view('back_end/view_fundamenta', $dinamic_content);
	}

	public function create_table() {
		sleep(1);
		$this->load->model('Usuarios_model');
		$id_so_user = $this->security->xss_clean(strip_tags($this->session->userdata('id_so_user')));
		$consulta_user = $this->Usuarios_model->buscar_user($id_so_user);
		foreach ($consulta_user as $consulta) {
			$existe = $consulta->nombre_user;
//			$existe ="";
		}
		if ($existe == "") {
			$this->load->view('back_end/add_name_user_view');
		} else {

			echo '<script>$("#load_data_name").empty(); $("#data_name").modal("close"); window.location.href = "' . base_url('tablas_ap/confirm_create_table') . '"; </script>';
		}
	}

	public function confirm_create_table() {
		$this->load->model('Usuarios_model');
		$dinamic_content['contenido'] = 'create_tabla_view';
		$id_so_user = $this->session->userdata('id_so_user');
		$id_cat_user = $this->session->userdata('id_cat_user');
		$dinamic_content['title'] = 'Configuración de tablas de aplicabilidad';
		$dinamic_content['data_SO'] = $this->Tablas_ap_model->obtener_so($id_so_user, $id_cat_user);
		$dinamic_content['select_art'] = $this->Tablas_ap_model->obtener_art($id_cat_user);
		$this->load->view('template/be_template', $dinamic_content);
	}

	public function select_fraccion_aplic_so() {

		$this->form_validation->set_error_delimiters('<div  style="color:#d9534f"> <i class="tiny material-icons" style="vertical-align:-2px">cancel</i>  ', '</div>');
		$this->form_validation->set_rules('ejercicio', '<b>Ejercicio </b>', 'required');
		$this->form_validation->set_rules('articulo', '<b>Artículo </b>', 'required');

		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
			echo "<script>$('#load_frac').attr('disabled', false);</script>";
		} else {
//		sleep(1);
			$id_art = $this->security->xss_clean(strip_tags($this->input->post('articulo')));
			$ejercicio = $this->security->xss_clean(strip_tags($this->input->post('ejercicio')));
			$id_cat_so = $this->security->xss_clean(strip_tags($this->input->post('id_cat_so')));
			$id_so = $this->security->xss_clean(strip_tags($this->input->post('id_so')));
			switch ($id_art) {
				case 1:
					$check_table = $this->Tablas_ap_model->seek_tabla_so($ejercicio, $id_so);
					if ($check_table !== 0) {
						$url = base_url('tablas_ap/view_table');
						echo '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">assignment_late</i><br><b>Ya se han registrado <u>OBLIGACIONES COMUNES</u> para esta tabla de aplicabilidad, correspondiente al ejercicio ' . $ejercicio . '. </b><br>No es posible continuar con el proceso de creación.<br><span style="font-size:12px"> Si desea realizar cambios en su tabla de aplicabilidad, utilice el módulo <a style="color:#d50000 " href="' . base_url('tablas_ap/edit_table') . '"><b>"Editar Tablas de Aplicabilidad"</b></a><span><div>';
						echo '<br><br><a class="orange darken-4  btn waves-effect waves-light" href="javascript:getURL()"><i class="material-icons" style="vertical-align:-5px">pageview</i> Ver tabla creada</a>';
						break;
					} else {
						$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->obtener_fracciones($id_art);
						$aplicabilidad = 1;
						for ($i = 1; $i <= 49; $i++) {
							$this->Tablas_ap_model->save_tabla_base($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad);
						}
						$verify_table = $this->Tablas_ap_model->val_tcreate_so($ejercicio, $id_so);
						if ($verify_table == 0) {
							$this->Tablas_ap_model->save_control_oc($ejercicio, $id_so, $id_cat_so);
						} else {
							$this->Tablas_ap_model->upd_control_oc($ejercicio, $id_so, $id_cat_so);
						}
						$preview = $this->Tablas_ap_model->val_vpreview_so($ejercicio, (int) $id_so);
						if ($preview === 1) {
							$enabled_preview = 1;
						} else {
							$enabled_preview = 0;
						}
						$dinamic_content['enabled_preview'] = $enabled_preview;
						$this->load->view('back_end/art_74_view', $dinamic_content);
						echo "<script>  M.toast({html: 'La tabla con obligaciones comunes se ha creado correctamente', displayLength: 2000,classes: 'rounded',inDuration:0}); </script>";
						break;
					}
				case 2:
					$check_table = $this->Tablas_ap_model->seek_tabla_oesp_pejec($ejercicio, $id_so);
					if ($check_table !== 0) {
						$url = base_url('tablas_ap/view_table');
						echo '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">assignment_late</i><br><b>Ya se han registrado <u>OBLIGACIONES ESPECÍFICAS</u> para esta tabla de aplicabilidad, correspondiente al ejercicio ' . $ejercicio . '. </b><br>No es posible continuar con el proceso de creación.<br><span style="font-size:12px"> Si desea realizar cambios en su tabla de aplicabilidad, utilice el módulo <a style="color:#d50000 " href="' . base_url('tablas_ap/edit_table') . '"><b>"Editar Tablas de Aplicabilidad"</b></a><span><div>';
						echo '<br><br><a class="orange darken-4  btn waves-effect waves-light" href="javascript:getURL()"><i class="material-icons" style="vertical-align:-5px">pageview</i> Ver tabla creada</a>';
						break;
					} else {
						$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->obtener_fracciones($id_art);
						$aplicabilidad = 1;
						for ($i = 50; $i <= 56; $i++) {
							$this->Tablas_ap_model->save_tbase_oesp($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad);
						}
						$verify_table = $this->Tablas_ap_model->val_tcreate_so($ejercicio, $id_so);
						if ($verify_table == 0) {
							$this->Tablas_ap_model->save_control_esp($ejercicio, $id_so, $id_cat_so);
						} else {
							$this->Tablas_ap_model->upd_control_esp($ejercicio, $id_so, $id_cat_so);
						}
						$preview = $this->Tablas_ap_model->val_vpreview_so($ejercicio, (int) $id_so);
						if ($preview === 1) {
							$enabled_preview = 1;
						} else {
							$enabled_preview = 0;
						}
						$dinamic_content['enabled_preview'] = $enabled_preview;
						$this->load->view('back_end/art_especificas_view', $dinamic_content);
						echo "<script>  M.toast({html: 'La tabla con obligaciones específicas se ha creado correctamente', displayLength: 2000,classes: 'rounded',inDuration:0}); </script>";
						break;
					}
				case 3:
					$check_table = $this->Tablas_ap_model->seek_tabla_oesp_muni($ejercicio, $id_so);
					if ($check_table !== 0) {
						$url = base_url('tablas_ap/view_table');
						echo '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">assignment_late</i><br><b>Ya se han registrado <u>OBLIGACIONES ESPECÍFICAS </u> para esta tabla de aplicabilidad, correspondiente al ejercicio ' . $ejercicio . '. </b><br>No es posible continuar con el proceso de creación.<br><span style="font-size:12px"> Si desea realizar cambios en su tabla de aplicabilidad, utilice el módulo <a style="color:#d50000 " href="' . base_url('tablas_ap/edit_table') . '"><b>"Editar Tablas de Aplicabilidad"</b></a><span><div>';
						echo '<br><br><a class="orange darken-4  btn waves-effect waves-light" href="javascript:getURL()"><i class="material-icons" style="vertical-align:-5px">pageview</i> Ver tabla creada</a>';
						break;
					} else {
						$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->obtener_fracciones($id_art);
//						$dinamic_content['data_na_frac'] = $this->Tablas_ap_model->obtener_na_so($ejercicio, $id_so);
						$aplicabilidad = 1;
						for ($i = 57; $i <= 71; $i++) {
							$this->Tablas_ap_model->save_tbase_oesp_muni($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad);
						}
						$verify_table = $this->Tablas_ap_model->val_tcreate_so($ejercicio, $id_so);
						if ($verify_table == 0) {
							$this->Tablas_ap_model->save_control_esp($ejercicio, $id_so, $id_cat_so);
						} else {
							$this->Tablas_ap_model->upd_control_esp($ejercicio, $id_so, $id_cat_so);
						}
						$preview = $this->Tablas_ap_model->val_vpreview_so($ejercicio, (int) $id_so);
						if ($preview === 1) {
							$enabled_preview = 1;
						} else {
							$enabled_preview = 0;
						}
						$dinamic_content['enabled_preview'] = $enabled_preview;
						$this->load->view('back_end/art_especificas_view', $dinamic_content);
						echo "<script>  M.toast({html: 'La tabla con obligaciones específicas se ha creado correctamente', displayLength: 2000,classes: 'rounded',inDuration:0}); </script>";
						break;
					}
				case 4:
					$check_table = $this->Tablas_ap_model->seek_tabla_oesp_pleg($ejercicio, $id_so);
					if ($check_table !== 0) {
						$url = base_url('tablas_ap/view_table');
						echo '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">assignment_late</i><br><b>Ya se han registrado <u>OBLIGACIONES ESPECÍFICAS </u> para esta tabla de aplicabilidad, correspondiente al ejercicio ' . $ejercicio . '. </b><br>No es posible continuar con el proceso de creación.<br><span style="font-size:12px"> Si desea realizar cambios en su tabla de aplicabilidad, utilice el módulo <a style="color:#d50000 " href="' . base_url('tablas_ap/edit_table') . '"><b>"Editar Tablas de Aplicabilidad"</b></a><span><div>';
						echo '<br><br><a class="orange darken-4  btn waves-effect waves-light" href="javascript:getURL()"><i class="material-icons" style="vertical-align:-5px">pageview</i> Ver tabla creada</a>';
						break;
					} else {
						$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->obtener_fracciones($id_art);
//						$dinamic_content['data_na_frac'] = $this->Tablas_ap_model->obtener_na_so($ejercicio, $id_so);
						$aplicabilidad = 1;
						for ($i = 72; $i <= 86; $i++) {
							$this->Tablas_ap_model->save_tbase_oesp_pleg($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad);
						}
						$verify_table = $this->Tablas_ap_model->val_tcreate_so($ejercicio, $id_so);
						if ($verify_table == 0) {
							$this->Tablas_ap_model->save_control_esp($ejercicio, $id_so, $id_cat_so);
						} else {
							$this->Tablas_ap_model->upd_control_esp($ejercicio, $id_so, $id_cat_so);
						}
						$preview = $this->Tablas_ap_model->val_vpreview_so($ejercicio, (int) $id_so);
						if ($preview === 1) {
							$enabled_preview = 1;
						} else {
							$enabled_preview = 0;
						}
						$dinamic_content['enabled_preview'] = $enabled_preview;
						$this->load->view('back_end/art_especificas_view', $dinamic_content);
						echo "<script>  M.toast({html: 'La tabla con obligaciones específicas se ha creado correctamente', displayLength: 2000,classes: 'rounded',inDuration:0}); </script>";
						break;
					}
				case 5:
					$check_table = $this->Tablas_ap_model->seek_tabla_oesp_pjud($ejercicio, $id_so);
					if ($check_table !== 0) {
						$url = base_url('tablas_ap/view_table');
						echo '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">assignment_late</i><br><b>Ya se han registrado <u>OBLIGACIONES ESPECÍFICAS </u> para esta tabla de aplicabilidad, correspondiente al ejercicio ' . $ejercicio . '. </b><br>No es posible continuar con el proceso de creación.<br><span style="font-size:12px"> Si desea realizar cambios en su tabla de aplicabilidad, utilice el módulo <a style="color:#d50000 " href="' . base_url('tablas_ap/edit_table') . '"><b>"Editar Tablas de Aplicabilidad"</b></a><span><div>';
						echo '<br><br><a class="orange darken-4  btn waves-effect waves-light" href="javascript:getURL()"><i class="material-icons" style="vertical-align:-5px">pageview</i> Ver tabla creada</a>';
						break;
					} else {
						$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->obtener_fracciones($id_art);
//						$dinamic_content['data_na_frac'] = $this->Tablas_ap_model->obtener_na_so($ejercicio, $id_so);
						$aplicabilidad = 1;
						for ($i = 87; $i <= 91; $i++) {
							$this->Tablas_ap_model->save_tbase_oesp_pjud($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad);
						}
						$verify_table = $this->Tablas_ap_model->val_tcreate_so($ejercicio, $id_so);
						if ($verify_table == 0) {
							$this->Tablas_ap_model->save_control_esp($ejercicio, $id_so, $id_cat_so);
						} else {
							$this->Tablas_ap_model->upd_control_esp($ejercicio, $id_so, $id_cat_so);
						}
						$preview = $this->Tablas_ap_model->val_vpreview_so($ejercicio, (int) $id_so);
						if ($preview === 1) {
							$enabled_preview = 1;
						} else {
							$enabled_preview = 0;
						}
						$dinamic_content['enabled_preview'] = $enabled_preview;
						$this->load->view('back_end/art_especificas_view', $dinamic_content);
						echo "<script>  M.toast({html: 'La tabla con obligaciones específicas se ha creado correctamente', displayLength: 2000,classes: 'rounded',inDuration:0}); </script>";
						break;
					}
				case 6:
					$check_table = $this->Tablas_ap_model->seek_tabla_oesp_oa($ejercicio, $id_so);
					if ($check_table !== 0) {
						$url = base_url('tablas_ap/view_table');
						echo '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">assignment_late</i><br><b>Ya se han registrado <u>OBLIGACIONES ESPECÍFICAS </u> para esta tabla de aplicabilidad, correspondiente al ejercicio ' . $ejercicio . '. </b><br>No es posible continuar con el proceso de creación.<br><span style="font-size:12px"> Si desea realizar cambios en su tabla de aplicabilidad, utilice el módulo <a style="color:#d50000 " href="' . base_url('tablas_ap/edit_table') . '"><b>"Editar Tablas de Aplicabilidad"</b></a><span><div>';
						echo '<br><br><a class="orange darken-4  btn waves-effect waves-light" href="javascript:getURL()"><i class="material-icons" style="vertical-align:-5px">pageview</i> Ver tabla creada</a>';
						break;
					} else {
						switch ($id_so) {
							case 116: //Comisión de Derechos Humanos del Estado de Campeche
								$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->obtener_fracciones_codehcam($id_art);
								$aplicabilidad = 1;
								for ($i = 106; $i <= 118; $i++) {
									$this->Tablas_ap_model->save_tbase_oesp_og($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad);
								}
								$verify_table = $this->Tablas_ap_model->val_tcreate_so($ejercicio, $id_so);
								if ($verify_table == 0) {
									$this->Tablas_ap_model->save_control_esp($ejercicio, $id_so, $id_cat_so);
								} else {
									$this->Tablas_ap_model->upd_control_esp($ejercicio, $id_so, $id_cat_so);
								}
								$preview = $this->Tablas_ap_model->val_vpreview_so($ejercicio, (int) $id_so);
								if ($preview === 1) {
									$enabled_preview = 1;
								} else {
									$enabled_preview = 0;
								}
								$dinamic_content['enabled_preview'] = $enabled_preview;
								$this->load->view('back_end/art_especificas_view', $dinamic_content);
								echo "<script>  M.toast({html: 'La tabla con obligaciones específicas se ha creado correctamente', displayLength: 2000,classes: 'rounded',inDuration:0}); </script>";
								break;
							case 117: //Comisión de Transparencia y Acceso a la Información Pública del Estado de Campeche
								$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->obtener_fracciones_cotaipec($id_art);
								$aplicabilidad = 1;
								for ($i = 119; $i <= 125; $i++) {
									$this->Tablas_ap_model->save_tbase_oesp_og($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad);
								}
								$verify_table = $this->Tablas_ap_model->val_tcreate_so($ejercicio, $id_so);
								if ($verify_table == 0) {
									$this->Tablas_ap_model->save_control_esp($ejercicio, $id_so, $id_cat_so);
								} else {
									$this->Tablas_ap_model->upd_control_esp($ejercicio, $id_so, $id_cat_so);
								}
								$preview = $this->Tablas_ap_model->val_vpreview_so($ejercicio, (int) $id_so);
								if ($preview === 1) {
									$enabled_preview = 1;
								} else {
									$enabled_preview = 0;
								}
								$dinamic_content['enabled_preview'] = $enabled_preview;
								$this->load->view('back_end/art_especificas_view', $dinamic_content);
								echo "<script>  M.toast({html: 'La tabla con obligaciones específicas se ha creado correctamente', displayLength: 2000,classes: 'rounded',inDuration:0}); </script>";
								break;
							case 118: //Fiscalía Especializada en Combate a la Corrupción del Estado de Campeche
								echo '<div class="card-panel green lighten-3 center "><i class="medium material-icons">announcement</i><br><b>No existen <u>OBLIGACIONES ESPECIFICAS</u> para este sujeto obligado.</b> <br /> <span style="font-size:12px">No es posible continuar con el proceso de configuración de aplicabilidad.<br><span><div>';
								break;
							case 119: //Instituto Electoral del Estado de Campeche
								$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->obtener_fracciones_ieec($id_art);
								$aplicabilidad = 1;
								for ($i = 92; $i <= 105; $i++) {
									$this->Tablas_ap_model->save_tbase_oesp_og($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad);
								}
								$verify_table = $this->Tablas_ap_model->val_tcreate_so($ejercicio, $id_so);
								if ($verify_table == 0) {
									$this->Tablas_ap_model->save_control_esp($ejercicio, $id_so, $id_cat_so);
								} else {
									$this->Tablas_ap_model->upd_control_esp($ejercicio, $id_so, $id_cat_so);
								}
								$preview = $this->Tablas_ap_model->val_vpreview_so($ejercicio, (int) $id_so);
								if ($preview === 1) {
									$enabled_preview = 1;
								} else {
									$enabled_preview = 0;
								}
								$dinamic_content['enabled_preview'] = $enabled_preview;
								$this->load->view('back_end/art_especificas_view', $dinamic_content);
								echo "<script>  M.toast({html: 'La tabla con obligaciones específicas se ha creado correctamente', displayLength: 2000,classes: 'rounded',inDuration:0}); </script>";
								break;
							case 120: //Tribunal de Justicia Administrativa del Estado de Campeche
								echo '<div class="card-panel green lighten-3 center "><i class="medium material-icons">announcement</i><br><b>No existen <u>OBLIGACIONES ESPECIFICAS</u> para este sujeto obligado.</b> <br /> <span style="font-size:12px">No es posible continuar con el proceso de configuración de aplicabilidad.<br><span><div>';
								break;
							case 121: //Tribunal Electoral del Estado de Campeche
								echo '<div class="card-panel green lighten-3 center "><i class="medium material-icons">announcement</i><br><b>No existen <u>OBLIGACIONES ESPECIFICAS</u> para este sujeto obligado.</b> <br /> <span style="font-size:12px">No es posible continuar con el proceso de configuración de aplicabilidad.<br><span><div>';
								break;
						}
					}
					break;
				case 7:
					$check_table = $this->Tablas_ap_model->seek_tabla_oesp_iesa($ejercicio, $id_so);
					if ($check_table !== 0) {
						$url = base_url('tablas_ap/view_table');
						echo '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">assignment_late</i><br><b>Ya se han registrado <u>OBLIGACIONES ESPECÍFICAS </u> para esta tabla de aplicabilidad, correspondiente al ejercicio ' . $ejercicio . '. </b><br>No es posible continuar con el proceso de creación.<br><span style="font-size:12px"> Si desea realizar cambios en su tabla de aplicabilidad, utilice el módulo <a style="color:#d50000 " href="' . base_url('tablas_ap/edit_table') . '"><b>"Editar Tablas de Aplicabilidad"</b></a><span><div>';
						echo '<br><br><a class="orange darken-4  btn waves-effect waves-light" href="javascript:getURL()"><i class="material-icons" style="vertical-align:-5px">pageview</i> Ver tabla creada</a>';
						break;
					} else {
						$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->obtener_fracciones($id_art);
						$aplicabilidad = 1;
						for ($i = 128; $i <= 136; $i++) {
							$this->Tablas_ap_model->save_tbase_oesp_iesa($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad);
						}
						$verify_table = $this->Tablas_ap_model->val_tcreate_so($ejercicio, $id_so);
						if ($verify_table == 0) {
							$this->Tablas_ap_model->save_control_esp($ejercicio, $id_so, $id_cat_so);
						} else {
							$this->Tablas_ap_model->upd_control_esp($ejercicio, $id_so, $id_cat_so);
						}
						$preview = $this->Tablas_ap_model->val_vpreview_so($ejercicio, (int) $id_so);
						if ($preview === 1) {
							$enabled_preview = 1;
						} else {
							$enabled_preview = 0;
						}
						$dinamic_content['enabled_preview'] = $enabled_preview;
						$this->load->view('back_end/art_especificas_view', $dinamic_content);
						echo "<script>  M.toast({html: 'La tabla con obligaciones específicas se ha creado correctamente', displayLength: 2000,classes: 'rounded',inDuration:0}); </script>";
						break;
					}
				case 8:
					$check_table = $this->Tablas_ap_model->seek_tabla_oesp_pp($ejercicio, $id_so);
					if ($check_table !== 0) {
						$url = base_url('tablas_ap/view_table');
						echo '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">assignment_late</i><br><b>Ya se han registrado <u>OBLIGACIONES ESPECÍFICAS </u> para esta tabla de aplicabilidad, correspondiente al ejercicio ' . $ejercicio . '. </b><br>No es posible continuar con el proceso de creación.<br><span style="font-size:12px"> Si desea realizar cambios en su tabla de aplicabilidad, utilice el módulo <a style="color:#d50000 " href="' . base_url('tablas_ap/edit_table') . '"><b>"Editar Tablas de Aplicabilidad"</b></a><span><div>';
						echo '<br><br><a class="orange darken-4  btn waves-effect waves-light" href="javascript:getURL()"><i class="material-icons" style="vertical-align:-5px">pageview</i> Ver tabla creada</a>';
						break;
					} else {
						$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->obtener_fracciones($id_art);
						$aplicabilidad = 1;
						for ($i = 137; $i <= 166; $i++) {
							$this->Tablas_ap_model->save_tbase_oesp_pp($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad);
						}
						$verify_table = $this->Tablas_ap_model->val_tcreate_so($ejercicio, $id_so);
						if ($verify_table == 0) {
							$this->Tablas_ap_model->save_control_esp($ejercicio, $id_so, $id_cat_so);
						} else {
							$this->Tablas_ap_model->upd_control_esp($ejercicio, $id_so, $id_cat_so);
						}
						$preview = $this->Tablas_ap_model->val_vpreview_so($ejercicio, (int) $id_so);
						if ($preview === 1) {
							$enabled_preview = 1;
						} else {
							$enabled_preview = 0;
						}
						$dinamic_content['enabled_preview'] = $enabled_preview;
						$this->load->view('back_end/art_especificas_view', $dinamic_content);
						echo "<script>  M.toast({html: 'La tabla con obligaciones específicas se ha creado correctamente', displayLength: 2000,classes: 'rounded',inDuration:0}); </script>";
						break;
					}
				case 9:
					$check_table = $this->Tablas_ap_model->seek_tabla_oesp_ffp($ejercicio, $id_so);
					if ($check_table !== 0) {
						$url = base_url('tablas_ap/view_table');
						echo '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">assignment_late</i><br><b>Ya se han registrado <u>OBLIGACIONES ESPECÍFICAS </u> para esta tabla de aplicabilidad, correspondiente al ejercicio ' . $ejercicio . '. </b><br>No es posible continuar con el proceso de creación.<br><span style="font-size:12px"> Si desea realizar cambios en su tabla de aplicabilidad, utilice el módulo <a style="color:#d50000 " href="' . base_url('tablas_ap/edit_table') . '"><b>"Editar Tablas de Aplicabilidad"</b></a><span><div>';
						echo '<br><br><a class="orange darken-4  btn waves-effect waves-light" href="javascript:getURL()"><i class="material-icons" style="vertical-align:-5px">pageview</i> Ver tabla creada</a>';
						break;
					} else {
						$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->obtener_fracciones($id_art);
						$aplicabilidad = 1;
						for ($i = 167; $i <= 174; $i++) {
							$this->Tablas_ap_model->save_tbase_oesp_ffp($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad);
						}
						$verify_table = $this->Tablas_ap_model->val_tcreate_so($ejercicio, $id_so);
						if ($verify_table == 0) {
							$this->Tablas_ap_model->save_control_esp($ejercicio, $id_so, $id_cat_so);
						} else {
							$this->Tablas_ap_model->upd_control_esp($ejercicio, $id_so, $id_cat_so);
						}
						$preview = $this->Tablas_ap_model->val_vpreview_so($ejercicio, (int) $id_so);
						if ($preview === 1) {
							$enabled_preview = 1;
						} else {
							$enabled_preview = 0;
						}
						$dinamic_content['enabled_preview'] = $enabled_preview;
						$this->load->view('back_end/art_especificas_view', $dinamic_content);
						echo "<script>  M.toast({html: 'La tabla con obligaciones específicas se ha creado correctamente', displayLength: 2000,classes: 'rounded',inDuration:0}); </script>";
						break;
					}
				case 10:
					$check_table = $this->Tablas_ap_model->seek_tabla_oesp_aayjml($ejercicio, $id_so);
					if ($check_table !== 0) {
						$url = base_url('tablas_ap/view_table');
						echo '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">assignment_late</i><br><b>Ya se han registrado <u>OBLIGACIONES ESPECÍFICAS </u> para esta tabla de aplicabilidad, correspondiente al ejercicio ' . $ejercicio . '. </b><br>No es posible continuar con el proceso de creación.<br><span style="font-size:12px"> Si desea realizar cambios en su tabla de aplicabilidad, utilice el módulo <a style="color:#d50000 " href="' . base_url('tablas_ap/edit_table') . '"><b>"Editar Tablas de Aplicabilidad"</b></a><span><div>';
						echo '<br><br><a class="orange darken-4  btn waves-effect waves-light" href="javascript:getURL()"><i class="material-icons" style="vertical-align:-5px">pageview</i> Ver tabla creada</a>';
						break;
					} else {
						$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->obtener_fracciones($id_art);
						$aplicabilidad = 1;
						for ($i = 175; $i <= 182; $i++) {
							$this->Tablas_ap_model->save_tbase_oesp_aayjml($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad);
						}
						$verify_table = $this->Tablas_ap_model->val_tcreate_so($ejercicio, $id_so);
						if ($verify_table == 0) {
							$this->Tablas_ap_model->save_control_esp($ejercicio, $id_so, $id_cat_so);
						} else {
							$this->Tablas_ap_model->upd_control_esp($ejercicio, $id_so, $id_cat_so);
						}
						$preview = $this->Tablas_ap_model->val_vpreview_so($ejercicio, (int) $id_so);
						if ($preview === 1) {
							$enabled_preview = 1;
						} else {
							$enabled_preview = 0;
						}
						$dinamic_content['enabled_preview'] = $enabled_preview;
						$this->load->view('back_end/art_especificas_view', $dinamic_content);
						echo "<script>  M.toast({html: 'La tabla con obligaciones específicas se ha creado correctamente', displayLength: 2000,classes: 'rounded',inDuration:0}); </script>";
						break;
					}
				case 11:
					$check_table = $this->Tablas_ap_model->seek_tabla_oesp_sind($ejercicio, $id_so);
					if ($check_table !== 0) {
						$url = base_url('tablas_ap/view_table');
						echo '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">assignment_late</i><br><b>Ya se han registrado <u>OBLIGACIONES ESPECÍFICAS </u> para esta tabla de aplicabilidad, correspondiente al ejercicio ' . $ejercicio . '. </b><br>No es posible continuar con el proceso de creación.<br><span style="font-size:12px"> Si desea realizar cambios en su tabla de aplicabilidad, utilice el módulo <a style="color:#d50000 " href="' . base_url('tablas_ap/edit_table') . '"><b>"Editar Tablas de Aplicabilidad"</b></a><span><div>';
						echo '<br><br><a class="orange darken-4  btn waves-effect waves-light" href="javascript:getURL()"><i class="material-icons" style="vertical-align:-5px">pageview</i> Ver tabla creada</a>';
						break;
					} else {
						$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->obtener_fracciones($id_art);
						$aplicabilidad = 1;
						for ($i = 183; $i <= 186; $i++) {
							$this->Tablas_ap_model->save_tbase_oesp_sind($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad);
						}
						$verify_table = $this->Tablas_ap_model->val_tcreate_so($ejercicio, $id_so);
						if ($verify_table == 0) {
							$this->Tablas_ap_model->save_control_esp($ejercicio, $id_so, $id_cat_so);
						} else {
							$this->Tablas_ap_model->upd_control_esp($ejercicio, $id_so, $id_cat_so);
						}
						$preview = $this->Tablas_ap_model->val_vpreview_so($ejercicio, (int) $id_so);
						if ($preview === 1) {
							$enabled_preview = 1;
						} else {
							$enabled_preview = 0;
						}
						$dinamic_content['enabled_preview'] = $enabled_preview;
						$this->load->view('back_end/art_especificas_view', $dinamic_content);
						echo "<script>  M.toast({html: 'La tabla con obligaciones específicas se ha creado correctamente', displayLength: 2000,classes: 'rounded',inDuration:0}); </script>";
						break;
					}
				case 12:
					echo 'No disponible (12)';
					break;
			}
		}
	}

	public function add_fundamenta_so() {
		$id_frac = $this->security->xss_clean(strip_tags($this->input->post('id_frac')));
		$ejercicio = $this->security->xss_clean(strip_tags($this->input->post('ejercicio')));
		$id_cat_so = $this->security->xss_clean(strip_tags($this->input->post('id_cat_so')));
		$id_so = $this->security->xss_clean(strip_tags($this->input->post('id_so')));
		$dinamic_content['ejercicio'] = $ejercicio;
		$dinamic_content['id_cat_so'] = $id_cat_so;
		$dinamic_content['id_so'] = $id_so;
		$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->obtener_fraccion_especifica($id_frac);
		$dinamic_content['data_just'] = $this->Tablas_ap_model->obtener_just_fraccion_esp($id_frac);
		$this->load->view('back_end/add_fundamenta_so', $dinamic_content);
	}

	public function save_fundamenta_so() {

		$this->form_validation->set_error_delimiters('<div  style="color:#d9534f"> <i class="tiny material-icons">cancel</i>  ', '</div>');
		$this->form_validation->set_rules('fundamenta_frac', '<b>Justificación </b>', 'required');

		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
			echo "<script>$('.save_just').attr('disabled', false);</script>";
		} else {
			sleep(1);
			$id_fraccion = $this->security->xss_clean(strip_tags($this->input->post('id_frac')));
			$ejercicio = $this->security->xss_clean(strip_tags($this->input->post('ejercicio')));
			$id_cat_so = $this->security->xss_clean(strip_tags($this->input->post('id_cat_so')));
			$id_so = $this->security->xss_clean(strip_tags($this->input->post('id_so')));
			$fundamenta_frac = $this->security->xss_clean(strip_tags($this->input->post('fundamenta_frac')));
			$id_fundamenta_frac = $this->security->xss_clean(strip_tags($this->input->post('id_fundamenta_frac')));
			$aplicabilidad = 0;


			$valida = $this->Tablas_ap_model->save_fundamentacion_so($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad);
			if ($valida) {
				echo "<script>  M.toast({html: 'La justificación  de esta fracción se guardó correctamente en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', true);$('#" . $id_fraccion . "').prop('disabled', true);</script>";
				exit();
			} else {
				echo "<script>  M.toast({html: 'Ocurrio un error al guardar en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', false);$('#" . $id_fraccion . "').prop('disabled', false);</script>";
				exit();
			}
		}
	}

	public function view_table() {
		sleep(1);
		$ejercicio = $this->security->xss_clean(strip_tags($this->input->get('ejer')));
		$id_so_user = $this->security->xss_clean(strip_tags($this->input->get('id_so')));
		$id_articulo = $this->security->xss_clean(strip_tags($this->session->userdata('id_cat_user')));
		$dinamic_content['data_art'] = $this->Tablas_ap_model->obtener_data_art($id_articulo);
		$dinamic_content['data_aplica'] = $this->Tablas_ap_model->data_toc_apl($ejercicio, $id_so_user);
		$dinamic_content['data_noaplica'] = $this->Tablas_ap_model->data_toc_noapl($ejercicio, $id_so_user);
		$dinamic_content['num_aplica'] = $this->Tablas_ap_model->a_num_comunes($ejercicio, $id_so_user);
		$dinamic_content['num_noaplica'] = $this->Tablas_ap_model->na_num_comunes($ejercicio, $id_so_user);
		$view = $this->Tablas_ap_model->na_num_comunes($ejercicio, $id_so_user);
		if ($view === 0) {
			$view_na_oc = 0;
		} else {
			$view_na_oc = 1;
		}
		$dinamic_content['view_na_oc'] = $view_na_oc;
		switch ($id_articulo) {
			case 1:
				$dinamic_content['data_aplica_esp'] = $this->Tablas_ap_model->data_tesp_apl($ejercicio, $id_so_user);
				$dinamic_content['data_noaplica_esp'] = $this->Tablas_ap_model->data_tesp_noapl($ejercicio, $id_so_user);
				$dinamic_content['num_aplica_esp'] = $this->Tablas_ap_model->a_num_esp($ejercicio, $id_so_user);
				$dinamic_content['num_noaplica_esp'] = $this->Tablas_ap_model->na_num_esp($ejercicio, $id_so_user);
				$view_esp = $this->Tablas_ap_model->na_num_esp($ejercicio, $id_so_user);
				if ($view_esp === 0) {
					$view_na_esp = 0;
				} else {
					$view_na_esp = 1;
				}
				$dinamic_content['view_na_esp'] = $view_na_esp;
				break;

			case 2:
				$dinamic_content['data_aplica_esp'] = $this->Tablas_ap_model->data_tesp_muni($ejercicio, $id_so_user);
				$dinamic_content['data_noaplica_esp'] = $this->Tablas_ap_model->data_tesp_namuni($ejercicio, $id_so_user);
				$dinamic_content['num_aplica_esp'] = $this->Tablas_ap_model->a_num_esp_muni($ejercicio, $id_so_user);
				$dinamic_content['num_noaplica_esp'] = $this->Tablas_ap_model->na_num_esp_muni($ejercicio, $id_so_user);
				$view_esp = $this->Tablas_ap_model->na_num_esp_muni($ejercicio, $id_so_user);
				if ($view_esp === 0) {
					$view_na_esp = 0;
				} else {
					$view_na_esp = 1;
				}
				$dinamic_content['view_na_esp'] = $view_na_esp;
				break;
			case 3:
				$dinamic_content['data_aplica_esp'] = $this->Tablas_ap_model->data_tesp_pleg($ejercicio, $id_so_user);
				$dinamic_content['data_noaplica_esp'] = $this->Tablas_ap_model->data_tesp_napleg($ejercicio, $id_so_user);
				$dinamic_content['num_aplica_esp'] = $this->Tablas_ap_model->a_num_esp_pleg($ejercicio, $id_so_user);
				$dinamic_content['num_noaplica_esp'] = $this->Tablas_ap_model->na_num_esp_pleg($ejercicio, $id_so_user);
				$view_esp = $this->Tablas_ap_model->na_num_esp_pleg($ejercicio, $id_so_user);
				if ($view_esp === 0) {
					$view_na_esp = 0;
				} else {
					$view_na_esp = 1;
				}
				$dinamic_content['view_na_esp'] = $view_na_esp;
				break;
			case 4:
				$dinamic_content['data_aplica_esp'] = $this->Tablas_ap_model->data_tesp_pjud($ejercicio, $id_so_user);
				$dinamic_content['data_noaplica_esp'] = $this->Tablas_ap_model->data_tesp_napjud($ejercicio, $id_so_user);
				$dinamic_content['num_aplica_esp'] = $this->Tablas_ap_model->a_num_esp_pjud($ejercicio, $id_so_user);
				$dinamic_content['num_noaplica_esp'] = $this->Tablas_ap_model->na_num_esp_pjud($ejercicio, $id_so_user);
				$view_esp = $this->Tablas_ap_model->na_num_esp_pjud($ejercicio, $id_so_user);
				if ($view_esp === 0) {
					$view_na_esp = 0;
				} else {
					$view_na_esp = 1;
				}
				$dinamic_content['view_na_esp'] = $view_na_esp;
				break;
			case 5:
				$dinamic_content['data_aplica_esp'] = $this->Tablas_ap_model->data_tesp_oa($ejercicio, $id_so_user);
				$dinamic_content['data_noaplica_esp'] = $this->Tablas_ap_model->data_tesp_naoa($ejercicio, $id_so_user);
				$dinamic_content['num_aplica_esp'] = $this->Tablas_ap_model->a_num_esp_oa($ejercicio, $id_so_user);
				$dinamic_content['num_noaplica_esp'] = $this->Tablas_ap_model->na_num_esp_oa($ejercicio, $id_so_user);
				$view_esp = $this->Tablas_ap_model->na_num_esp_oa($ejercicio, $id_so_user);
				if ($view_esp === 0) {
					$view_na_esp = 0;
				} else {
					$view_na_esp = 1;
				}
				$dinamic_content['view_na_esp'] = $view_na_esp;
				break;
			case 6:
				$dinamic_content['data_aplica_esp'] = $this->Tablas_ap_model->data_tesp_iesa($ejercicio, $id_so_user);
				$dinamic_content['data_noaplica_esp'] = $this->Tablas_ap_model->data_tesp_naiesa($ejercicio, $id_so_user);
				$dinamic_content['num_aplica_esp'] = $this->Tablas_ap_model->a_num_esp_iesa($ejercicio, $id_so_user);
				$dinamic_content['num_noaplica_esp'] = $this->Tablas_ap_model->na_num_esp_iesa($ejercicio, $id_so_user);
				$view_esp = $this->Tablas_ap_model->na_num_esp_iesa($ejercicio, $id_so_user);
				if ($view_esp === 0) {
					$view_na_esp = 0;
				} else {
					$view_na_esp = 1;
				}
				$dinamic_content['view_na_esp'] = $view_na_esp;
				break;
			case 7:
				$dinamic_content['data_aplica_esp'] = $this->Tablas_ap_model->data_tesp_pp($ejercicio, $id_so_user);
				$dinamic_content['data_noaplica_esp'] = $this->Tablas_ap_model->data_tesp_napp($ejercicio, $id_so_user);
				$dinamic_content['num_aplica_esp'] = $this->Tablas_ap_model->a_num_esp_pp($ejercicio, $id_so_user);
				$dinamic_content['num_noaplica_esp'] = $this->Tablas_ap_model->na_num_esp_pp($ejercicio, $id_so_user);
				$view_esp = $this->Tablas_ap_model->na_num_esp_pp($ejercicio, $id_so_user);
				if ($view_esp === 0) {
					$view_na_esp = 0;
				} else {
					$view_na_esp = 1;
				}
				$dinamic_content['view_na_esp'] = $view_na_esp;
				break;
			case 8:
				$dinamic_content['data_aplica_esp'] = $this->Tablas_ap_model->data_tesp_ffp($ejercicio, $id_so_user);
				$dinamic_content['data_noaplica_esp'] = $this->Tablas_ap_model->data_tesp_naffp($ejercicio, $id_so_user);
				$dinamic_content['num_aplica_esp'] = $this->Tablas_ap_model->a_num_esp_ffp($ejercicio, $id_so_user);
				$dinamic_content['num_noaplica_esp'] = $this->Tablas_ap_model->na_num_esp_ffp($ejercicio, $id_so_user);
				$view_esp = $this->Tablas_ap_model->na_num_esp_ffp($ejercicio, $id_so_user);
				if ($view_esp === 0) {
					$view_na_esp = 0;
				} else {
					$view_na_esp = 1;
				}
				$dinamic_content['view_na_esp'] = $view_na_esp;
				break;
			case 9:
				$dinamic_content['data_aplica_esp'] = $this->Tablas_ap_model->data_tesp_aayjml($ejercicio, $id_so_user);
				$dinamic_content['data_noaplica_esp'] = $this->Tablas_ap_model->data_tesp_naaayjml($ejercicio, $id_so_user);
				$dinamic_content['num_aplica_esp'] = $this->Tablas_ap_model->a_num_esp_aayjml($ejercicio, $id_so_user);
				$dinamic_content['num_noaplica_esp'] = $this->Tablas_ap_model->na_num_esp_aayjml($ejercicio, $id_so_user);
				$view_esp = $this->Tablas_ap_model->na_num_esp_aayjml($ejercicio, $id_so_user);
				if ($view_esp === 0) {
					$view_na_esp = 0;
				} else {
					$view_na_esp = 1;
				}
				$dinamic_content['view_na_esp'] = $view_na_esp;
				break;
			case 10:
				$dinamic_content['data_aplica_esp'] = $this->Tablas_ap_model->data_tesp_sind($ejercicio, $id_so_user);
				$dinamic_content['data_noaplica_esp'] = $this->Tablas_ap_model->data_tesp_nasind($ejercicio, $id_so_user);
				$dinamic_content['num_aplica_esp'] = $this->Tablas_ap_model->a_num_esp_sind($ejercicio, $id_so_user);
				$dinamic_content['num_noaplica_esp'] = $this->Tablas_ap_model->na_num_esp_sind($ejercicio, $id_so_user);
				$view_esp = $this->Tablas_ap_model->na_num_esp_sind($ejercicio, $id_so_user);
				if ($view_esp === 0) {
					$view_na_esp = 0;
				} else {
					$view_na_esp = 1;
				}
				$dinamic_content['view_na_esp'] = $view_na_esp;
				break;
		}

		$dinamic_content['data_SO'] = $this->Tablas_ap_model->obtener_so($id_so_user);
		$check_send = $this->Tablas_ap_model->val_issend_table($ejercicio, $id_so_user);
		if ($check_send === 1) {
			$val_send_table = 1;
		} else {
			$val_send_table = 0;
		}
		$dinamic_content['val_send_table'] = $val_send_table;
		$dinamic_content['contenido'] = 'view_table_view';
		$this->load->view('template/be_template', $dinamic_content);
	}

	public function edit_table() {
		$id_so_user = $this->session->userdata('id_so_user');
		$id_cat_user = $this->session->userdata('id_cat_user');
		$dinamic_content['contenido'] = 'edit_tabla_view';
		$dinamic_content['title'] = 'Editar tablas de aplicabilidad';
		$dinamic_content['data_SO'] = $this->Tablas_ap_model->obtener_so($id_so_user, $id_cat_user);
		$dinamic_content['select_art'] = $this->Tablas_ap_model->obtener_art($id_cat_user);
		$this->load->view('template/be_template', $dinamic_content);
	}

	public function select_edit_table() {

		$this->form_validation->set_error_delimiters('<div  style="color:#d9534f"> <i class="tiny material-icons" style="vertical-align:-2px">cancel</i>  ', '</div>');
		$this->form_validation->set_rules('ejercicio', '<b>Ejercicio </b>', 'required');
		$this->form_validation->set_rules('articulo', '<b>Artículo </b>', 'required');

		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();

			echo "<script>$('#load_edit_frac').attr('disabled', false);</script>";
		} else {
			$id_art = $this->security->xss_clean(strip_tags($this->input->post('articulo')));
			$ejercicio = $this->security->xss_clean(strip_tags($this->input->post('ejercicio')));
			$id_cat_so = $this->security->xss_clean(strip_tags($this->input->post('id_cat_so')));
			$id_so = $this->security->xss_clean(strip_tags($this->input->post('id_so')));
			switch ($id_art) {
				case 1:
					$check_table = $this->Tablas_ap_model->seek_tabla_so($ejercicio, $id_so);
					if ($check_table !== 0) {
						$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->edit_frac_toc($ejercicio, $id_so, $id_art);

						$this->load->view('back_end/edit_art_74_view', $dinamic_content);
//					
						break;
					} else {
						echo '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">assignment_late</i><br><b>No se encontró ninguna tabla de aplicabilidad con obligaciones comunes, correspondiente al ejercicio ' . $ejercicio . '. </b><br>No es posible continuar con el proceso de edición.<br><span style="font-size:12px"> Si desea crear  su tabla de aplicabilidad, utilice el módulo "Crear Tablas de Aplicabilidad<span>"<div>';
						echo '<br><br><a class="orange darken-4  btn waves-effect waves-light" href="' . base_url('behome') . '"><i class="material-icons" style="vertical-align:-5px">pageview</i> Crear tabla de aplicabilidad</a>';
						exit();
						break;
					}

				case 2:
					$check_table = $this->Tablas_ap_model->seek_tabla_pejec($ejercicio, $id_so);
					if ($check_table !== 0) {
						$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->edit_frac_esp($ejercicio, $id_so, $id_art);

						$this->load->view('back_end/edit_especificas_view', $dinamic_content);
//					
						break;
					} else {
						echo '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">assignment_late</i><br><b>No se encontró ninguna tabla de aplicabilidad con OBLIGACIONES ESPECIFICAS registradas, correspondiente al ejercicio ' . $ejercicio . '. </b><br>No es posible continuar con el proceso de edición.<br><span style="font-size:12px"> Si desea crear  su tabla de aplicabilidad, utilice el módulo "Crear Tablas de Aplicabilidad<span>"<div>';
						echo '<br><br><a class="orange darken-4  btn waves-effect waves-light" href="' . base_url('behome') . '"><i class="material-icons" style="vertical-align:-5px">pageview</i> Crear tabla de aplicabilidad</a>';
						exit();
						break;
					}

				case 3:
					$check_table = $this->Tablas_ap_model->seek_tabla_muni($ejercicio, $id_so);
					if ($check_table !== 0) {
						$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->edit_frac_muni($ejercicio, $id_so, $id_art);
						$this->load->view('back_end/edit_especificas_view', $dinamic_content);
//					
						break;
					} else {
						echo '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">assignment_late</i><br><b>No se encontró ninguna tabla de aplicabilidad con OBLIGACIONES ESPECIFICAS registradas, correspondiente al ejercicio ' . $ejercicio . '. </b><br>No es posible continuar con el proceso de edición.<br><span style="font-size:12px"> Si desea crear  su tabla de aplicabilidad, utilice el módulo "Crear Tablas de Aplicabilidad<span>"<div>';
						echo '<br><br><a class="orange darken-4  btn waves-effect waves-light" href="' . base_url('behome') . '"><i class="material-icons" style="vertical-align:-5px">pageview</i> Crear tabla de aplicabilidad</a>';
						exit();
						break;
					}
				case 4:
					$check_table = $this->Tablas_ap_model->seek_tabla_pleg($ejercicio, $id_so);
					if ($check_table !== 0) {
						$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->edit_frac_pleg($ejercicio, $id_so, $id_art);
						$this->load->view('back_end/edit_especificas_view', $dinamic_content);
//					
						break;
					} else {
						echo '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">assignment_late</i><br><b>No se encontró ninguna tabla de aplicabilidad con OBLIGACIONES ESPECIFICAS registradas, correspondiente al ejercicio ' . $ejercicio . '. </b><br>No es posible continuar con el proceso de edición.<br><span style="font-size:12px"> Si desea crear  su tabla de aplicabilidad, utilice el módulo "Crear Tablas de Aplicabilidad<span>"<div>';
						echo '<br><br><a class="orange darken-4  btn waves-effect waves-light" href="' . base_url('behome') . '"><i class="material-icons" style="vertical-align:-5px">pageview</i> Crear tabla de aplicabilidad</a>';
						exit();
						break;
					}
				case 5:
					$check_table = $this->Tablas_ap_model->seek_tabla_pjud($ejercicio, $id_so);
					if ($check_table !== 0) {
						$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->edit_frac_pjud($ejercicio, $id_so, $id_art);
						$this->load->view('back_end/edit_especificas_view', $dinamic_content);
//					
						break;
					} else {
						echo '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">assignment_late</i><br><b>No se encontró ninguna tabla de aplicabilidad con OBLIGACIONES ESPECIFICAS registradas, correspondiente al ejercicio ' . $ejercicio . '. </b><br>No es posible continuar con el proceso de edición.<br><span style="font-size:12px"> Si desea crear  su tabla de aplicabilidad, utilice el módulo "Crear Tablas de Aplicabilidad<span>"<div>';
						echo '<br><br><a class="orange darken-4  btn waves-effect waves-light" href="' . base_url('behome') . '"><i class="material-icons" style="vertical-align:-5px">pageview</i> Crear tabla de aplicabilidad</a>';
						exit();
						break;
					}
				case 6:
					$check_table = $this->Tablas_ap_model->seek_tabla_oa($ejercicio, $id_so);
					if ($check_table !== 0) {
						$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->edit_frac_oa($ejercicio, $id_so, $id_art);
						$this->load->view('back_end/edit_especificas_view', $dinamic_content);
//					
						break;
					} else {
						echo '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">assignment_late</i><br><b>No se encontró ninguna tabla de aplicabilidad con OBLIGACIONES ESPECIFICAS registradas, correspondiente al ejercicio ' . $ejercicio . '. </b><br>No es posible continuar con el proceso de edición.<br><span style="font-size:12px"> Si desea crear  su tabla de aplicabilidad, utilice el módulo "Crear Tablas de Aplicabilidad<span>"<div>';
						echo '<br><br><a class="orange darken-4  btn waves-effect waves-light" href="' . base_url('behome') . '"><i class="material-icons" style="vertical-align:-5px">pageview</i> Crear tabla de aplicabilidad</a>';
						exit();
						break;
					}

				case 7:
					$check_table = $this->Tablas_ap_model->seek_tabla_oesp_iesa($ejercicio, $id_so);
					if ($check_table !== 0) {
						$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->edit_frac_iesa($ejercicio, $id_so, $id_art);
						$this->load->view('back_end/edit_especificas_view', $dinamic_content);
//					
						break;
					} else {
						echo '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">assignment_late</i><br><b>No se encontró ninguna tabla de aplicabilidad con OBLIGACIONES ESPECIFICAS registradas, correspondiente al ejercicio ' . $ejercicio . '. </b><br>No es posible continuar con el proceso de edición.<br><span style="font-size:12px"> Si desea crear  su tabla de aplicabilidad, utilice el módulo "Crear Tablas de Aplicabilidad<span>"<div>';
						echo '<br><br><a class="orange darken-4  btn waves-effect waves-light" href="' . base_url('behome') . '"><i class="material-icons" style="vertical-align:-5px">pageview</i> Crear tabla de aplicabilidad</a>';
						exit();
						break;
					}
				case 8:
					$check_table = $this->Tablas_ap_model->seek_tabla_oesp_pp($ejercicio, $id_so);
					if ($check_table !== 0) {
						$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->edit_frac_pp($ejercicio, $id_so, $id_art);
						$this->load->view('back_end/edit_especificas_view', $dinamic_content);
//					
						break;
					} else {
						echo '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">assignment_late</i><br><b>No se encontró ninguna tabla de aplicabilidad con OBLIGACIONES ESPECIFICAS registradas, correspondiente al ejercicio ' . $ejercicio . '. </b><br>No es posible continuar con el proceso de edición.<br><span style="font-size:12px"> Si desea crear  su tabla de aplicabilidad, utilice el módulo "Crear Tablas de Aplicabilidad<span>"<div>';
						echo '<br><br><a class="orange darken-4  btn waves-effect waves-light" href="' . base_url('behome') . '"><i class="material-icons" style="vertical-align:-5px">pageview</i> Crear tabla de aplicabilidad</a>';
						exit();
						break;
					}
				case 9:
					$check_table = $this->Tablas_ap_model->seek_tabla_oesp_ffp($ejercicio, $id_so);
					if ($check_table !== 0) {
						$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->edit_frac_ffp($ejercicio, $id_so, $id_art);
						$this->load->view('back_end/edit_especificas_view', $dinamic_content);
//					
						break;
					} else {
						echo '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">assignment_late</i><br><b>No se encontró ninguna tabla de aplicabilidad con OBLIGACIONES ESPECIFICAS registradas, correspondiente al ejercicio ' . $ejercicio . '. </b><br>No es posible continuar con el proceso de edición.<br><span style="font-size:12px"> Si desea crear  su tabla de aplicabilidad, utilice el módulo "Crear Tablas de Aplicabilidad<span>"<div>';
						echo '<br><br><a class="orange darken-4  btn waves-effect waves-light" href="' . base_url('behome') . '"><i class="material-icons" style="vertical-align:-5px">pageview</i> Crear tabla de aplicabilidad</a>';
						exit();
						break;
					}
				case 10:
					$check_table = $this->Tablas_ap_model->seek_tabla_oesp_aayjml($ejercicio, $id_so);
					if ($check_table !== 0) {
						$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->edit_frac_aayjml($ejercicio, $id_so, $id_art);
						$this->load->view('back_end/edit_especificas_view', $dinamic_content);
//					
						break;
					} else {
						echo '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">assignment_late</i><br><b>No se encontró ninguna tabla de aplicabilidad con OBLIGACIONES ESPECIFICAS registradas, correspondiente al ejercicio ' . $ejercicio . '. </b><br>No es posible continuar con el proceso de edición.<br><span style="font-size:12px"> Si desea crear  su tabla de aplicabilidad, utilice el módulo "Crear Tablas de Aplicabilidad<span>"<div>';
						echo '<br><br><a class="orange darken-4  btn waves-effect waves-light" href="' . base_url('behome') . '"><i class="material-icons" style="vertical-align:-5px">pageview</i> Crear tabla de aplicabilidad</a>';
						exit();
						break;
					}
				case 11:
					$check_table = $this->Tablas_ap_model->seek_tabla_oesp_sind($ejercicio, $id_so);
					if ($check_table !== 0) {
						$dinamic_content['data_fraccion'] = $this->Tablas_ap_model->edit_frac_sind($ejercicio, $id_so, $id_art);
						$this->load->view('back_end/edit_especificas_view', $dinamic_content);
//					
						break;
					} else {
						echo '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">assignment_late</i><br><b>No se encontró ninguna tabla de aplicabilidad con OBLIGACIONES ESPECIFICAS registradas, correspondiente al ejercicio ' . $ejercicio . '. </b><br>No es posible continuar con el proceso de edición.<br><span style="font-size:12px"> Si desea crear  su tabla de aplicabilidad, utilice el módulo "Crear Tablas de Aplicabilidad<span>"<div>';
						echo '<br><br><a class="orange darken-4  btn waves-effect waves-light" href="' . base_url('behome') . '"><i class="material-icons" style="vertical-align:-5px">pageview</i> Crear tabla de aplicabilidad</a>';
						exit();
						break;
					}
				case 12:
					echo 'No disponible';
					break;
					$dinamic_content['data_fracciones'] = $this->Tablas_ap_model->obtener_fracciones($id_art);
					$this->load->view('back_end/detalle_fraccion', $dinamic_content);
			}
		}
	}

	public function edit_fundamenta_so() {
		$this->form_validation->set_error_delimiters('<div  style="color:#d9534f"> <i class="tiny material-icons">cancel</i>  ', '</div>');
		$this->form_validation->set_rules('fundamenta_frac', '<b>Justificación </b>', 'required');

		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
			echo "<script>$('.save_just').attr('disabled', false);</script>";
		} else {
			sleep(1);
			$id_fraccion = $this->security->xss_clean(strip_tags($this->input->post('id_frac')));
			$ejercicio = $this->security->xss_clean(strip_tags($this->input->post('ejercicio')));
			$id_cat_so = $this->security->xss_clean(strip_tags($this->input->post('id_cat_so')));
			$id_so = $this->security->xss_clean(strip_tags($this->input->post('id_so')));

			$id_fundamenta_frac = $this->security->xss_clean(strip_tags($this->input->post('id_fundamenta_frac')));
			$aplicabilidad = $this->security->xss_clean(strip_tags($this->input->post('aplica')));
			if ($aplicabilidad == 1) {
				$aplicabilidad = 1;
				$fundamenta_frac = "";
			} else {
				$aplicabilidad = 0;
				$fundamenta_frac = $this->security->xss_clean(strip_tags($this->input->post('fundamenta_frac')));
			}
			$valida = $this->Tablas_ap_model->save_fundamentacion_so($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad);
			if ($valida) {
				echo "<script>  M.toast({html: 'La justificación  de esta fracción se actualizó correctamente en la base de datos', displayLength: 2000}); </script>";
				exit();
			} else {
				echo "<script>  M.toast({html: 'Ocurrio un error al guardar en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', false);$('#" . $id_fraccion . "').prop('disabled', false);</script>";
				exit();
			}
		}
	}

	public function edit_esp_fun_so() {

		$this->form_validation->set_error_delimiters('<div  style="color:#d9534f"> <i class="tiny material-icons">cancel</i>  ', '</div>');
		$this->form_validation->set_rules('fundamenta_frac', '<b>Justificación </b>', 'required');

		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
			echo "<script>$('.save_just').attr('disabled', false);</script>";
		} else {
			sleep(1);
			$id_fraccion = $this->security->xss_clean(strip_tags($this->input->post('id_frac')));
			$ejercicio = $this->security->xss_clean(strip_tags($this->input->post('ejercicio')));
			$id_cat_so = $this->security->xss_clean(strip_tags($this->input->post('id_cat_so')));
			$id_so = $this->security->xss_clean(strip_tags($this->input->post('id_so')));
			$id_art = $this->security->xss_clean(strip_tags($this->input->post('id_articulo')));

			$id_fundamenta_frac = $this->security->xss_clean(strip_tags($this->input->post('id_fundamenta_frac')));
			$aplicabilidad = $this->security->xss_clean(strip_tags($this->input->post('aplica')));
			if ($aplicabilidad == 1) {
				$aplicabilidad = 1;
				$fundamenta_frac = "";
			} else {
				$aplicabilidad = 0;
				$fundamenta_frac = $this->security->xss_clean(strip_tags($this->input->post('fundamenta_frac')));
			}
			switch ($id_art) {
				case 2:
					$valida = $this->Tablas_ap_model->edit_fund_esp($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad);
					if ($valida) {
						echo "<script>  M.toast({html: 'La justificación  de esta fracción se actualizó correctamente en la base de datos', displayLength: 2000}); </script>";
						exit;
					} else {
						echo "<script>  M.toast({html: 'Ocurrio un error al guardar en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', false);$('#" . $id_fraccion . "').prop('disabled', false);</script>";
						exit;
					}
					break;
				case 3:
					$valida = $this->Tablas_ap_model->edit_fund_muni($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad);
					if ($valida) {
						echo "<script>  M.toast({html: 'La justificación  de esta fracción se actualizó correctamente en la base de datos', displayLength: 2000}); </script>";
						exit;
					} else {
						echo "<script>  M.toast({html: 'Ocurrio un error al guardar en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', false);$('#" . $id_fraccion . "').prop('disabled', false);</script>";
						exit;
					}
					break;
				case 4:
					$valida = $this->Tablas_ap_model->edit_fund_pleg($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad);
					if ($valida) {
						echo "<script>  M.toast({html: 'La justificación  de esta fracción se actualizó correctamente en la base de datos', displayLength: 2000}); </script>";
						exit;
					} else {
						echo "<script>  M.toast({html: 'Ocurrio un error al guardar en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', false);$('#" . $id_fraccion . "').prop('disabled', false);</script>";
						exit;
					}
					break;
				case 5:
					$valida = $this->Tablas_ap_model->edit_fund_pjud($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad);
					if ($valida) {
						echo "<script>  M.toast({html: 'La justificación  de esta fracción se actualizó correctamente en la base de datos', displayLength: 2000}); </script>";
						exit;
					} else {
						echo "<script>  M.toast({html: 'Ocurrio un error al guardar en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', false);$('#" . $id_fraccion . "').prop('disabled', false);</script>";
						exit;
					}
					break;
				case 6:
					$valida = $this->Tablas_ap_model->edit_fund_oa($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad);
					if ($valida) {
						echo "<script>  M.toast({html: 'La justificación  de esta fracción se actualizó correctamente en la base de datos', displayLength: 2000}); </script>";
						exit;
					} else {
						echo "<script>  M.toast({html: 'Ocurrio un error al guardar en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', false);$('#" . $id_fraccion . "').prop('disabled', false);</script>";
						exit;
					}
					break;
				case 7:
					$valida = $this->Tablas_ap_model->edit_fund_iesa($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad);
					if ($valida) {
						echo "<script>  M.toast({html: 'La justificación  de esta fracción se actualizó correctamente en la base de datos', displayLength: 2000}); </script>";
						exit;
					} else {
						echo "<script>  M.toast({html: 'Ocurrio un error al guardar en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', false);$('#" . $id_fraccion . "').prop('disabled', false);</script>";
						exit;
					}
					break;
				case 8:
					$valida = $this->Tablas_ap_model->edit_fund_pp($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad);
					if ($valida) {
						echo "<script>  M.toast({html: 'La justificación  de esta fracción se actualizó correctamente en la base de datos', displayLength: 2000}); </script>";
						exit;
					} else {
						echo "<script>  M.toast({html: 'Ocurrio un error al guardar en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', false);$('#" . $id_fraccion . "').prop('disabled', false);</script>";
						exit;
					}
					break;
				case 9:
					$valida = $this->Tablas_ap_model->edit_fund_ffp($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad);
					if ($valida) {
						echo "<script>  M.toast({html: 'La justificación  de esta fracción se actualizó correctamente en la base de datos', displayLength: 2000}); </script>";
						exit;
					} else {
						echo "<script>  M.toast({html: 'Ocurrio un error al guardar en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', false);$('#" . $id_fraccion . "').prop('disabled', false);</script>";
						exit;
					}
					break;
				case 10:
					$valida = $this->Tablas_ap_model->edit_fund_aayjml($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad);
					if ($valida) {
						echo "<script>  M.toast({html: 'La justificación  de esta fracción se actualizó correctamente en la base de datos', displayLength: 2000}); </script>";
						exit;
					} else {
						echo "<script>  M.toast({html: 'Ocurrio un error al guardar en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', false);$('#" . $id_fraccion . "').prop('disabled', false);</script>";
						exit;
					}
					break;
				case 11:
					$valida = $this->Tablas_ap_model->edit_fund_sind($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad);
					if ($valida) {
						echo "<script>  M.toast({html: 'La justificación  de esta fracción se actualizó correctamente en la base de datos', displayLength: 2000}); </script>";
						exit;
					} else {
						echo "<script>  M.toast({html: 'Ocurrio un error al guardar en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', false);$('#" . $id_fraccion . "').prop('disabled', false);</script>";
						exit;
					}
					break;
			}
		}
	}

	public function save_funs_so_esp() {

		$this->form_validation->set_error_delimiters('<div  style="color:#d9534f"> <i class="tiny material-icons">cancel</i>  ', '</div>');
		$this->form_validation->set_rules('fundamenta_frac', '<b>Justificación </b>', 'required');

		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
			echo "<script>$('.save_just_esp').attr('disabled', false);</script>";
		} else {
			sleep(1);
			$id_fraccion = $this->security->xss_clean(strip_tags($this->input->post('id_frac')));
			$ejercicio = $this->security->xss_clean(strip_tags($this->input->post('ejercicio')));
			$id_art = $this->security->xss_clean(strip_tags($this->input->post('id_articulo')));
			$id_cat_so = $this->security->xss_clean(strip_tags($this->input->post('id_cat_so')));
			$id_so = $this->security->xss_clean(strip_tags($this->input->post('id_so')));
			$fundamenta_frac = $this->security->xss_clean(strip_tags($this->input->post('fundamenta_frac')));
			$id_fundamenta_frac = $this->security->xss_clean(strip_tags($this->input->post('id_fundamenta_frac')));
			$aplicabilidad = 0;
			switch ($id_art) {
				case 2:
					$valida = $this->Tablas_ap_model->save_fund_so_esp($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad);
					if ($valida) {
						echo "<script>  M.toast({html: 'La justificación  de esta fracción se guardó correctamente en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', true);$('#" . $id_fraccion . "').prop('disabled', true);</script>";
						exit();
					} else {
						echo "<script>  M.toast({html: 'Ocurrio un error al guardar en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', false);$('#" . $id_fraccion . "').prop('disabled', false);</script>";
						exit();
					}
					break;

				case 3:
					$valida = $this->Tablas_ap_model->save_fund_so_muni($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad);
					if ($valida) {
						echo "<script>  M.toast({html: 'La justificación  de esta fracción se guardó correctamente en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', true);$('#" . $id_fraccion . "').prop('disabled', true);</script>";
						exit();
					} else {
						echo "<script>  M.toast({html: 'Ocurrio un error al guardar en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', false);$('#" . $id_fraccion . "').prop('disabled', false);</script>";
						exit();
					}
					break;
				case 4:
					$valida = $this->Tablas_ap_model->save_fund_so_pleg($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad);
					if ($valida) {
						echo "<script>  M.toast({html: 'La justificación  de esta fracción se guardó correctamente en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', true);$('#" . $id_fraccion . "').prop('disabled', true);</script>";
						exit();
					} else {
						echo "<script>  M.toast({html: 'Ocurrio un error al guardar en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', false);$('#" . $id_fraccion . "').prop('disabled', false);</script>";
						exit();
					}
					break;
				case 5:
					$valida = $this->Tablas_ap_model->save_fund_so_pjud($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad);
					if ($valida) {
						echo "<script>  M.toast({html: 'La justificación  de esta fracción se guardó correctamente en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', true);$('#" . $id_fraccion . "').prop('disabled', true);</script>";
						exit();
					} else {
						echo "<script>  M.toast({html: 'Ocurrio un error al guardar en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', false);$('#" . $id_fraccion . "').prop('disabled', false);</script>";
						exit();
					}
					break;
				case 6:
					$valida = $this->Tablas_ap_model->save_fund_so_oa($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad);
					if ($valida) {
						echo "<script>  M.toast({html: 'La justificación  de esta fracción se guardó correctamente en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', true);$('#" . $id_fraccion . "').prop('disabled', true);</script>";
						exit();
					} else {
						echo "<script>  M.toast({html: 'Ocurrio un error al guardar en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', false);$('#" . $id_fraccion . "').prop('disabled', false);</script>";
						exit();
					}
					break;
				case 7:
					$valida = $this->Tablas_ap_model->save_fund_so_iesa($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad);
					if ($valida) {
						echo "<script>  M.toast({html: 'La justificación  de esta fracción se guardó correctamente en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', true);$('#" . $id_fraccion . "').prop('disabled', true);</script>";
						exit();
					} else {
						echo "<script>  M.toast({html: 'Ocurrio un error al guardar en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', false);$('#" . $id_fraccion . "').prop('disabled', false);</script>";
						exit();
					}
					break;
				case 8:
					$valida = $this->Tablas_ap_model->save_fund_so_pp($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad);
					if ($valida) {
						echo "<script>  M.toast({html: 'La justificación  de esta fracción se guardó correctamente en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', true);$('#" . $id_fraccion . "').prop('disabled', true);</script>";
						exit();
					} else {
						echo "<script>  M.toast({html: 'Ocurrio un error al guardar en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', false);$('#" . $id_fraccion . "').prop('disabled', false);</script>";
						exit();
					}
					break;
				case 9:
					$valida = $this->Tablas_ap_model->save_fund_so_ffp($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad);
					if ($valida) {
						echo "<script>  M.toast({html: 'La justificación  de esta fracción se guardó correctamente en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', true);$('#" . $id_fraccion . "').prop('disabled', true);</script>";
						exit();
					} else {
						echo "<script>  M.toast({html: 'Ocurrio un error al guardar en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', false);$('#" . $id_fraccion . "').prop('disabled', false);</script>";
						exit();
					}
					break;
				case 10:
					$valida = $this->Tablas_ap_model->save_fund_so_aayjml($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad);
					if ($valida) {
						echo "<script>  M.toast({html: 'La justificación  de esta fracción se guardó correctamente en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', true);$('#" . $id_fraccion . "').prop('disabled', true);</script>";
						exit();
					} else {
						echo "<script>  M.toast({html: 'Ocurrio un error al guardar en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', false);$('#" . $id_fraccion . "').prop('disabled', false);</script>";
						exit();
					}
					break;
				case 11:
					$valida = $this->Tablas_ap_model->save_fund_so_sind($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad);
					if ($valida) {
						echo "<script>  M.toast({html: 'La justificación  de esta fracción se guardó correctamente en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', true);$('#" . $id_fraccion . "').prop('disabled', true);</script>";
						exit();
					} else {
						echo "<script>  M.toast({html: 'Ocurrio un error al guardar en la base de datos', displayLength: 2000}); $('#" . $id_fundamenta_frac . "').prop('disabled', false);$('#" . $id_fraccion . "').prop('disabled', false);</script>";
						exit();
					}
					break;
			}
		}
	}

	public function download_ac() {
		$id_so_user = $this->session->userdata('id_so_user');
		$id_cat_user = $this->session->userdata('id_cat_user');
		$dinamic_content['contenido'] = 'lista_acuse';
		$dinamic_content['select_articulos'] = $this->Tablas_ap_model->select_articulos();
		$dinamic_content['title'] = 'Configuración de tablas de aplicabilidad';
		$dinamic_content['data_SO'] = $this->Tablas_ap_model->obtener_so($id_so_user, $id_cat_user);
		$this->load->view('template/be_template', $dinamic_content);
	}

}
