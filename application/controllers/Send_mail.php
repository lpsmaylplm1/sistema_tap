<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

Class Send_mail Extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Tablas_ap_model');
	}

	public function index() {
		$id_so_user = $this->security->xss_clean(strip_tags($this->input->post('id_so_user')));
		$id_articulo = $this->security->xss_clean(strip_tags($this->session->userdata('id_cat_user')));
		$id_user = $this->security->xss_clean(strip_tags($this->session->userdata('id_user')));
		$fecha =  date("Y/m/d");
		$ejercicio = $this->security->xss_clean(strip_tags($this->input->post('ejercicio')));

		$verify_table = $this->Tablas_ap_model->verify_table($ejercicio, $id_so_user);
		if ($verify_table) {
			$data_aplica = $this->Tablas_ap_model->data_toc_apl($ejercicio, $id_so_user);
			$data_noaplica = $this->Tablas_ap_model->data_toc_noapl($ejercicio, $id_so_user);
			$num_aplica = $this->Tablas_ap_model->a_num_comunes($ejercicio, $id_so_user);
			$num_noaplica = $this->Tablas_ap_model->na_num_comunes($ejercicio, $id_so_user);
			$view = $this->Tablas_ap_model->na_num_comunes($ejercicio, $id_so_user);
			if ($view === 0) {
				$view_na_oc = 0;
			} else {
				$view_na_oc = 1;
			}

			switch ((int) $id_articulo) {
				case 1:
					$data_aplica_esp = $this->Tablas_ap_model->data_tesp_apl($ejercicio, $id_so_user);
					$data_noaplica_esp = $this->Tablas_ap_model->data_tesp_noapl($ejercicio, $id_so_user);
					$num_aplica_esp = $this->Tablas_ap_model->a_num_esp($ejercicio, $id_so_user);
					$num_noaplica_esp = $this->Tablas_ap_model->na_num_esp($ejercicio, $id_so_user);
					$view_esp = $this->Tablas_ap_model->na_num_esp($ejercicio, $id_so_user);
					if ($view_esp === 0) {
						$view_na_esp = 0;
					} else {
						$view_na_esp = 1;
					}
					break;

				case 2:
					$data_aplica_esp = $this->Tablas_ap_model->data_tesp_muni($ejercicio, $id_so_user);
					$data_noaplica_esp = $this->Tablas_ap_model->data_tesp_namuni($ejercicio, $id_so_user);
					$num_aplica_esp = $this->Tablas_ap_model->a_num_esp_muni($ejercicio, $id_so_user);
					$num_noaplica_esp = $this->Tablas_ap_model->na_num_esp_muni($ejercicio, $id_so_user);
					$view_esp = $this->Tablas_ap_model->na_num_esp_muni($ejercicio, $id_so_user);
					if ($view_esp === 0) {
						$view_na_esp = 0;
					} else {
						$view_na_esp = 1;
					}
					break;
				case 3:
					$data_aplica_esp = $this->Tablas_ap_model->data_tesp_pleg($ejercicio, $id_so_user);
					$data_noaplica_esp = $this->Tablas_ap_model->data_tesp_napleg($ejercicio, $id_so_user);
					$num_aplica_esp = $this->Tablas_ap_model->a_num_esp_pleg($ejercicio, $id_so_user);
					$num_noaplica_esp = $this->Tablas_ap_model->na_num_esp_pleg($ejercicio, $id_so_user);
					$view_esp = $this->Tablas_ap_model->na_num_esp_pleg($ejercicio, $id_so_user);
					if ($view_esp === 0) {
						$view_na_esp = 0;
					} else {
						$view_na_esp = 1;
					}
					$dinamic_content['view_na_esp'] = $view_na_esp;
					break;
				case 4:
					$data_aplica_esp = $this->Tablas_ap_model->data_tesp_pjud($ejercicio, $id_so_user);
					$data_noaplica_esp = $this->Tablas_ap_model->data_tesp_napjud($ejercicio, $id_so_user);
					$num_aplica_esp = $this->Tablas_ap_model->a_num_esp_pjud($ejercicio, $id_so_user);
					$num_noaplica_esp = $this->Tablas_ap_model->na_num_esp_pjud($ejercicio, $id_so_user);
					$view_esp = $this->Tablas_ap_model->na_num_esp_pjud($ejercicio, $id_so_user);
					if ($view_esp === 0) {
						$view_na_esp = 0;
					} else {
						$view_na_esp = 1;
					}
					break;
				case 5:
					$data_aplica_esp = $this->Tablas_ap_model->data_tesp_oa($ejercicio, $id_so_user);
					$data_noaplica_esp = $this->Tablas_ap_model->data_tesp_naoa($ejercicio, $id_so_user);
					$num_aplica_esp = $this->Tablas_ap_model->a_num_esp_oa($ejercicio, $id_so_user);
					$num_noaplica_esp = $this->Tablas_ap_model->na_num_esp_oa($ejercicio, $id_so_user);
					$view_esp = $this->Tablas_ap_model->na_num_esp_oa($ejercicio, $id_so_user);
					if ($view_esp === 0) {
						$view_na_esp = 0;
					} else {
						$view_na_esp = 1;
					}
					break;
				case 6:
					$data_aplica_esp = $this->Tablas_ap_model->data_tesp_iesa($ejercicio, $id_so_user);
					$data_noaplica_esp = $this->Tablas_ap_model->data_tesp_naiesa($ejercicio, $id_so_user);
					$num_aplica_esp = $this->Tablas_ap_model->a_num_esp_iesa($ejercicio, $id_so_user);
					$num_noaplica_esp = $this->Tablas_ap_model->na_num_esp_iesa($ejercicio, $id_so_user);
					$view_esp = $this->Tablas_ap_model->na_num_esp_iesa($ejercicio, $id_so_user);
					if ($view_esp === 0) {
						$view_na_esp = 0;
					} else {
						$view_na_esp = 1;
					}
					break;
				case 7:
					$data_aplica_esp = $this->Tablas_ap_model->data_tesp_pp($ejercicio, $id_so_user);
					$data_noaplica_esp = $this->Tablas_ap_model->data_tesp_napp($ejercicio, $id_so_user);
					$num_aplica_esp = $this->Tablas_ap_model->a_num_esp_pp($ejercicio, $id_so_user);
					$num_noaplica_esp = $this->Tablas_ap_model->na_num_esp_pp($ejercicio, $id_so_user);
					$view_esp = $this->Tablas_ap_model->na_num_esp_pp($ejercicio, $id_so_user);
					if ($view_esp === 0) {
						$view_na_esp = 0;
					} else {
						$view_na_esp = 1;
					}
					break;
				case 8:
					$data_aplica_esp = $this->Tablas_ap_model->data_tesp_ffp($ejercicio, $id_so_user);
					$data_noaplica_esp = $this->Tablas_ap_model->data_tesp_naffp($ejercicio, $id_so_user);
					$num_aplica_esp = $this->Tablas_ap_model->a_num_esp_ffp($ejercicio, $id_so_user);
					$num_noaplica_esp = $this->Tablas_ap_model->na_num_esp_ffp($ejercicio, $id_so_user);
					$view_esp = $this->Tablas_ap_model->na_num_esp_ffp($ejercicio, $id_so_user);
					if ($view_esp === 0) {
						$view_na_esp = 0;
					} else {
						$view_na_esp = 1;
					}
					break;
				case 9:
					$data_aplica_esp = $this->Tablas_ap_model->data_tesp_aayjml($ejercicio, $id_so_user);
					$data_noaplica_esp = $this->Tablas_ap_model->data_tesp_naaayjml($ejercicio, $id_so_user);
					$num_aplica_esp = $this->Tablas_ap_model->a_num_esp_aayjml($ejercicio, $id_so_user);
					$num_noaplica_esp = $this->Tablas_ap_model->na_num_esp_aayjml($ejercicio, $id_so_user);
					$view_esp = $this->Tablas_ap_model->na_num_esp_aayjml($ejercicio, $id_so_user);
					if ($view_esp === 0) {
						$view_na_esp = 0;
					} else {
						$view_na_esp = 1;
					}
					break;
				case 10:
					$data_aplica_esp = $this->Tablas_ap_model->data_tesp_sind($ejercicio, $id_so_user);
					$data_noaplica_esp = $this->Tablas_ap_model->data_tesp_nasind($ejercicio, $id_so_user);
					$num_aplica_esp = $this->Tablas_ap_model->a_num_esp_sind($ejercicio, $id_so_user);
					$num_noaplica_esp = $this->Tablas_ap_model->na_num_esp_sind($ejercicio, $id_so_user);
					$view_esp = $this->Tablas_ap_model->na_num_esp_sind($ejercicio, $id_so_user);
					if ($view_esp === 0) {
						$view_na_esp = 0;
					} else {
						$view_na_esp = 1;
					}
					break;
			}


			$data_so = $this->Tablas_ap_model->obtener_so($id_so_user);
			foreach ($data_so as $data_subj) {
				$data_mail = $data_subj->nombre_so;
			}
			$data_user = $this->Tablas_ap_model->load_user($id_so_user);
			foreach ($data_user as $user) {
				$data_user = $user->nombre_user . ' ' . $user->ap_p . ' ' . $user->ap_m;
			}



			foreach ($data_so as $SO):
				$html = '';
				$html .= "<style type=text/css>";
				$html .= "th{color: #FFFFFF; font-weight: bold; background-color: #e16a0b; padding: 5px 10px;}";
				$html .= "td{background-color: #fff ; color: #000; padding: 1em;}";
				$html .= "</style>";
				$html .= "<h2><strong>EJERCICIO</strong>: " . $this->session->userdata('ejercicio') . " </h2>";
				$html .= "<h3><strong>SUJETO OBLIGADO</strong>: " . $SO->nombre_so . " </h3>";
				$html .= "<h3><strong>CATEGORÍA</strong>: " . $SO->descrip_categoria . " </h3>";
				$html .= '<table border="1" style="font-size: 12px" width="100%">';
				$html .= '<thead>';
				$html .= '<tr>';
				$html .= '<th rowspan="2">Sujeto Obligado</th>';
				$html .= '<th colspan="2" style="text-align: center">Obligaciones comunes <br />(artículo 74 de la Ley Estatal)</th>';
				if ($SO->id_art_cat === "75") {
					$data_articulo = $SO->id_art_cat . ' de la Ley Estatal e inciso F del artículo 71 de la Ley General)';
				} elseif ($SO->id_art_cat === "76") {
					$data_articulo = $SO->id_art_cat . ' de la Ley Estatal e incisos B, C, y  D  del artículo 71 de la Ley General)';
				} else {
					$data_articulo = $SO->id_art_cat;
				}
				$html .= '<th colspan="2" style="text-align: center">Obligaciones Especificas <br />(Artículo ' . $data_articulo . '</th>';
				$html .= '</tr>';
				$html .= '<tr>';
				$html .= '<th>Aplica</th>';
				$html .= '<th>No Aplica</th>';
				$html .= '<th>Aplica</th>';
				$html .= '<th>No Aplica</th>';
				$html .= '</tr>';

				$html .= "</thead>";
				$html .= "<tbody>";
				$html .= "<tr>";

				$html .= "<td>" . $SO->nombre_so . "</td>";
				$html .= "<td>";
				foreach ($data_aplica as $aplica) {
					if ($aplica !== end($data_aplica)) {
						$separador = ",";
					} else {
						$separador = ".";
					}
					$html .= $aplica->fraccion . $separador . " ";
				}
				$html .= "</td>";
				$html .= "<td>";
				foreach ($data_noaplica as $noaplica) {
					if ($noaplica !== end($data_noaplica)) {
						$separador = ",";
					} else {
						$separador = ".";
					}
					$html .= $noaplica->fraccion . $separador . " ";
				}
				$html .= "</td>";
				$html .= "<td>";
				foreach ($data_aplica_esp as $aplica_esp) {
					if ($aplica_esp !== end($data_aplica_esp)) {
						$separador = ",";
					} else {
						$separador = ".";
					}
					$html .= $aplica_esp->fraccion . $separador . " ";
				}
				$html .= "</td>";
				$html .= "<td>";
				foreach ($data_noaplica_esp as $noaplica_esp) {
					if ($noaplica_esp !== end($data_noaplica_esp)) {
						$separador = ",";
					} else {
						$separador = ".";
					}
					$html .= $noaplica_esp->fraccion . $separador . " ";
				}
				$html .= "</td>";
				$html .= "</tr>";
				$html .= "</tbody>";
				$html .= "</table>";
				$html .= "<br>";
				$html .= "<br>";

				if ($view_na_oc !== 0) {
					$html .= "<h5><strong>OBLIGACIONES COMUNES </strong><br> ";
					$html .= "Fracciones determinadas por el sujeto obligado como NO APLICABLES, con su justificación:   </h5>";
					$html .= '<table border="1" style="font-size: 12px"  width="100%">';
					$html .= '<thead>';
					$html .= '<tr><th  width="5%">No.</th><th width="45%">Fracción</th><th width="50%">Justificación NO APLICABILIDAD</th></tr>';
					$html .= '</thead>';
					$html .= '<tbody>';
					$i = 1;
					foreach ($data_noaplica as $na):
						$html .= '<tr><td width="5%">' . $i . '</td><td width="45%"><b>Fracción ' . $na->fraccion . '</b>.- ' . $na->descrip_frac . '</td><td width="50%"> ' . $na->justificacion_so_oc . '</td></tr>';
						$i++;
					endforeach;
					$html .= '</tbody>';
					$html .= "</table>";
				} else {
					$html .= '<span style="font-size:8px; color:green">-No se registraron obligaciones comunes como NO APLICABLES.</span><br>';
				}
				if ($view_na_esp !== 0) {
					$html .= "<br>";
					$html .= "<h5><strong>OBLIGACIONES ESPECÍFICAS </strong><br> ";
					$html .= "Fracciones determinadas por el sujeto obligado como NO APLICABLES, con su justificación:   </h5>";
					$html .= '<table border="1" style="font-size: 12px"  width="100%">';
					$html .= '<thead>';
					$html .= '<tr><th width="5%">No.</th><th width="45%">Fracción</th><th width="50%">Justificación NO APLICABILIDAD</th></tr>';
					$html .= '</thead>';
					$html .= '<tbody>';
					$i = 1;
					foreach ($data_noaplica_esp as $na_esp):
						$html .= '<tr><td width="5%">' . $i . '</td><td width="45%"><b>Fracción ' . $na_esp->fraccion . '</b>.- ' . $na_esp->descrip_frac . '</td><td width="50%"> ' . $na_esp->just_so_oesp . '</td></tr>';
						$i++;
					endforeach;
					$html .= '</tbody>';
					$html .= "</table>";
				} else {
					$html .= '<span style="font-size: 8px; color:green">-No se registraron obligaciones específicas como NO APLICABLES.</span>';
				}
			endforeach;
			$this->load->library('email');
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			$this->email->from('rgallardo@cotaipec.org.mx', $data_user);
			$this->email->to('dbs121301@gmail.com');

			$subj = "Tabla de Aplicabilidad " . $ejercicio . ': ' . $data_mail;
			$this->email->subject($subj);
			$this->email->message($html);

			$this->email->send();
			echo $this->session->flashdata('msg_send');
			$this->Tablas_ap_model->save_send_mail($ejercicio, $id_so_user, $id_articulo);
			$this->Tablas_ap_model->save_data_ac($ejercicio, $id_so_user, $id_user,$fecha, $num_aplica,$num_noaplica,$num_aplica_esp,$num_noaplica_esp);
			echo "<script>$('#send_mail').attr('disabled', true);</script>";
			echo "<script>$('#edit_table').attr('disabled', true);</script>";
		} else {
			echo $this->session->flashdata('msg_send_error');
		}
	}

}
