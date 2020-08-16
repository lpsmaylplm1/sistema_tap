<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

Class Pdfcreator_controller Extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Tablas_ap_model');
		$this->load->model('Reportes_model');
		$this->load->library('Pdf');
	}

	public function index() {


		$id_so_user = $this->security->xss_clean(strip_tags($this->session->userdata('id_so_user')));
		$id_articulo = $this->security->xss_clean(strip_tags($this->session->userdata('id_cat_user')));
		$ejercicio = $this->session->userdata('ejercicio');

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

		switch ($id_articulo) {
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
				$dinamic_content['num_aplica_esp'] = $this->Tablas_ap_model->a_num_esp_pleg($ejercicio, $id_so_user);
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
				$dinamic_content['num_aplica_esp'] = $this->Tablas_ap_model->a_num_esp_pjud($ejercicio, $id_so_user);
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
				$dinamic_content['num_aplica_esp'] = $this->Tablas_ap_model->a_num_esp_oa($ejercicio, $id_so_user);
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
				$dinamic_content['num_aplica_esp'] = $this->Tablas_ap_model->a_num_esp_iesa($ejercicio, $id_so_user);
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
				$dinamic_content['num_aplica_esp'] = $this->Tablas_ap_model->a_num_esp_pp($ejercicio, $id_so_user);
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
				$dinamic_content['num_aplica_esp'] = $this->Tablas_ap_model->a_num_esp_ffp($ejercicio, $id_so_user);
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
				$dinamic_content['num_aplica_esp'] = $this->Tablas_ap_model->a_num_esp_aayjml($ejercicio, $id_so_user);
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
				$dinamic_content['num_aplica_esp'] = $this->Tablas_ap_model->a_num_esp_sind($ejercicio, $id_so_user);
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
//		$telefono = $this->telefonos_model->lista_telefono_ente($id_ente);
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('COTAIPEC');
		$pdf->SetTitle('Generador de Tablas de Aplicabilidad');
		$pdf->SetSubject('Cotaipec');


// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(130, 61, 0), array(130, 61, 0));
		$pdf->setFooterData($tc = array(130, 61, 0), $lc = array(130, 61, 0));

// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//relación utilizada para ajustar la conversión de los píxeles
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------
// establecer el modo de fuente por defecto
		$pdf->setFontSubsetting(TRUE);

// Establecer el tipo de letra
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
		$pdf->SetFont('helvetica', '', 10, '', TRUE);

// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
		$pdf->AddPage();

//fijar efecto de sombra en el texto
		$pdf->setTextShadow(array('enabled' => FALSE, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

// Establecemos el contenido para imprimir
		$a = 1;
		$x = 1;
		$y = 1;
		$z = 1;

//preparamos y maquetamos el contenido a crear
		foreach ($data_so as $SO):
			$html = '';
			$html .= "<style type=text/css>";
			$html .= "th{color: #FFFFFF; font-weight: bold; background-color: #e16a0b; padding: 5px 10px;}";
			$html .= "td{background-color: #fff ; color: #000; padding: 1em;}";
			$html .= "</style>";
			$html .= "<center><h2><strong>TABLA DE APLICABILIDAD</strong>" . $this->session->userdata('ejercicio') . " </h2></center>";
			$html .= "<center><h5><strong>CATEGORÍA</strong>: " . $SO->descrip_categoria . " </h5></center>";
			$html .= '<table border="0.6" style="font-size: 9px">';
			$html .= '<thead>';
			$html .= '<tr>';
			$html .= '<th rowspan="2">Sujeto Obligado</th>';
			$html .= '<th colspan="2" style="text-align: center">Obligaciones comunes <br />- Artículo 74 de la Ley Estatal</th>';
			if ($SO->id_art_cat === "75") {
				$data_articulo = $SO->id_art_cat . ' de la Ley Estatal e inciso <b>f</b> del artículo 71 de la Ley General';
			} elseif ($SO->id_art_cat === "76") {
				$data_articulo = $SO->id_art_cat . ' de la Ley Estatal e incisos <b>b</b>, <b>c</b>, y  <b>d</b>  del artículo 71 de la Ley General';
			} else {
				$data_articulo = $SO->id_art_cat . ' de la Ley Estatal';
			}
			$html .= '<th colspan="2" style="text-align: center">Obligaciones Especificas <br />- Artículo ' . $data_articulo . '</th>';
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
				$html .= '<table border="0.6" style="font-size: 9px">';
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
				$html .= '<table border="0.6" style="font-size: 9px">';
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
// Imprimimos el texto con writeHTMLCell()
		$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
		$nombre_archivo = utf8_decode('nombre_archivo' . '.pdf');


		$pdf->Output($nombre_archivo, 'D');
	}

	public function prev_report_full() {
		$dinamic_content['contenido'] = 'table_reportfull_view';
		$dinamic_content['data_cat'] = $this->Tablas_ap_model->select_categorias();
		$this->load->view('template/be_template', $dinamic_content);
	}

	public function report_view_full() {


		$this->form_validation->set_error_delimiters('<div  style="color:#d9534f"> <i class="tiny material-icons" style="vertical-align:-2px">cancel</i>  ', '</div>');
		$this->form_validation->set_rules('data_cat', '<b>Categoría </b>', 'required');

		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
		} else {
			$id_so_user = $this->security->xss_clean(strip_tags($this->session->userdata('id_so_user')));
			$ejercicio = $this->session->userdata('ejercicio');
			$data_cat = $this->security->xss_clean(strip_tags($this->input->post('data_cat')));

			switch ($data_cat) {
				case 1:  // Poder Ejecutivo
					$dinamic_content['data_id_so'] = 'id_so_tap_pejec';
					$dinamic_content['data_group'] = $this->Reportes_model->groupt_ocpejec($ejercicio, $data_cat);
					$dinamic_content['data_aplica_oc'] = $this->Reportes_model->ftables_ocpejec_apl($ejercicio, $data_cat);
					$dinamic_content['data_noaplica_oc'] = $this->Reportes_model->ftables_ocpejec_noapl($ejercicio, $data_cat);
					$dinamic_content['data_aplica_esp'] = $this->Reportes_model->ftables_esppejec_apl($ejercicio, $data_cat);
					$dinamic_content['data_noaplica_esp'] = $this->Reportes_model->ftables_esppejec_noapl($ejercicio, $data_cat);
					break;
				case 2: // Municipios
					$dinamic_content['data_id_so'] = 'id_so_tap_muni';
					$dinamic_content['data_group'] = $this->Reportes_model->groupt_ocmuni($ejercicio, $data_cat);
					$dinamic_content['data_aplica_oc'] = $this->Reportes_model->ftables_ocmuni_apl($ejercicio, $data_cat);
					$dinamic_content['data_noaplica_oc'] = $this->Reportes_model->ftables_ocmuni_noapl($ejercicio, $data_cat);
					$dinamic_content['data_aplica_esp'] = $this->Reportes_model->ftables_espmuni_apl($ejercicio, $data_cat);
					$dinamic_content['data_noaplica_esp'] = $this->Reportes_model->ftables_espmuni_noapl($ejercicio, $data_cat);
					break;
				case 3:
					$dinamic_content['data_id_so'] = 'id_so_tap_pleg';
					$dinamic_content['data_group'] = $this->Reportes_model->groupt_ocpleg($ejercicio, $data_cat);
					$dinamic_content['data_aplica_oc'] = $this->Reportes_model->ftables_ocpleg_apl($ejercicio, $data_cat);
					$dinamic_content['data_noaplica_oc'] = $this->Reportes_model->ftables_ocpleg_noapl($ejercicio, $data_cat);
					$dinamic_content['data_aplica_esp'] = $this->Reportes_model->ftables_esppleg_apl($ejercicio, $data_cat);
					$dinamic_content['data_noaplica_esp'] = $this->Reportes_model->ftables_esppleg_noapl($ejercicio, $data_cat);
					break;
				case 4:
					$dinamic_content['data_id_so'] = 'id_so_tap_pjud';
					$dinamic_content['data_group'] = $this->Reportes_model->groupt_ocpjud($ejercicio, $data_cat);
					$dinamic_content['data_aplica_oc'] = $this->Reportes_model->ftables_ocpjud_apl($ejercicio, $data_cat);
					$dinamic_content['data_noaplica_oc'] = $this->Reportes_model->ftables_ocpjud_noapl($ejercicio, $data_cat);
					$dinamic_content['data_aplica_esp'] = $this->Reportes_model->ftables_esppjud_apl($ejercicio, $data_cat);
					$dinamic_content['data_noaplica_esp'] = $this->Reportes_model->ftables_espjud_noapl($ejercicio, $data_cat);
					break;
				case 5:
					$dinamic_content['data_id_so'] = 'id_so_tap_oa';
					$dinamic_content['data_group'] = $this->Reportes_model->groupt_ocoa($ejercicio, $data_cat);
					$dinamic_content['data_aplica_oc'] = $this->Reportes_model->ftables_ocoa_apl($ejercicio, $data_cat);
					$dinamic_content['data_noaplica_oc'] = $this->Reportes_model->ftables_ocoa_noapl($ejercicio, $data_cat);
					$dinamic_content['data_aplica_esp'] = $this->Reportes_model->ftables_espoa_apl($ejercicio, $data_cat);
					$dinamic_content['data_noaplica_esp'] = $this->Reportes_model->ftables_espoa_noapl($ejercicio, $data_cat);
					break;
				case 6:
					$dinamic_content['data_id_so'] = 'id_so_tap_esda';
					$dinamic_content['data_group'] = $this->Reportes_model->groupt_ocesda($ejercicio, $data_cat);
					$dinamic_content['data_aplica_oc'] = $this->Reportes_model->ftables_ocesda_apl($ejercicio, $data_cat);
					$dinamic_content['data_noaplica_oc'] = $this->Reportes_model->ftables_ocesda_noapl($ejercicio, $data_cat);
					$dinamic_content['data_aplica_esp'] = $this->Reportes_model->ftables_espesda_apl($ejercicio, $data_cat);
					$dinamic_content['data_noaplica_esp'] = $this->Reportes_model->ftables_espesda_noapl($ejercicio, $data_cat);
					break;
				case 7:
					$dinamic_content['data_id_so'] = 'id_so_tap_pp';
					$dinamic_content['data_group'] = $this->Reportes_model->groupt_ocpp($ejercicio, $data_cat);
					$dinamic_content['data_aplica_oc'] = $this->Reportes_model->ftables_ocpp_apl($ejercicio, $data_cat);
					$dinamic_content['data_noaplica_oc'] = $this->Reportes_model->ftables_ocpp_noapl($ejercicio, $data_cat);
					$dinamic_content['data_aplica_esp'] = $this->Reportes_model->ftables_esppp_apl($ejercicio, $data_cat);
					$dinamic_content['data_noaplica_esp'] = $this->Reportes_model->ftables_esppp_noapl($ejercicio, $data_cat);
					break;
				case 8:
					$dinamic_content['data_id_so'] = 'id_so_tap_ffp';
					$dinamic_content['data_group'] = $this->Reportes_model->groupt_ocffp($ejercicio, $data_cat);
					$dinamic_content['data_aplica_oc'] = $this->Reportes_model->ftables_ocffp_apl($ejercicio, $data_cat);
					$dinamic_content['data_noaplica_oc'] = $this->Reportes_model->ftables_ocffp_noapl($ejercicio, $data_cat);
					$dinamic_content['data_aplica_esp'] = $this->Reportes_model->ftables_espffp_apl($ejercicio, $data_cat);
					$dinamic_content['data_noaplica_esp'] = $this->Reportes_model->ftables_espffp_noapl($ejercicio, $data_cat);
					break;
				case 9:
					$dinamic_content['data_id_so'] = 'id_so_tap_aayjml';
					$dinamic_content['data_group'] = $this->Reportes_model->groupt_ocaayjml($ejercicio, $data_cat);
					$dinamic_content['data_aplica_oc'] = $this->Reportes_model->ftables_ocaayjml_apl($ejercicio, $data_cat);
					$dinamic_content['data_noaplica_oc'] = $this->Reportes_model->ftables_ocaayjml_noapl($ejercicio, $data_cat);
					$dinamic_content['data_aplica_esp'] = $this->Reportes_model->ftables_espaayjml_apl($ejercicio, $data_cat);
					$dinamic_content['data_noaplica_esp'] = $this->Reportes_model->ftables_espaayjml_noapl($ejercicio, $data_cat);
					break;
				case 10:
					$dinamic_content['data_id_so'] = 'id_so_tap_sind';
					$dinamic_content['data_group'] = $this->Reportes_model->groupt_ocsind($ejercicio, $data_cat);
					$dinamic_content['data_aplica_oc'] = $this->Reportes_model->ftables_ocsind_apl($ejercicio, $data_cat);
					$dinamic_content['data_noaplica_oc'] = $this->Reportes_model->ftables_ocsind_noapl($ejercicio, $data_cat);
					$dinamic_content['data_aplica_esp'] = $this->Reportes_model->ftables_espsind_apl($ejercicio, $data_cat);
					$dinamic_content['data_noaplica_esp'] = $this->Reportes_model->ftables_espsind_noapl($ejercicio, $data_cat);
					break;
			}
			$dinamic_content['data_SO'] = $this->Reportes_model->load_cat_report($data_cat);
			$this->load->view('back_end/detail_report', $dinamic_content);
		}
	}
	public function create_acuse() {


		$id_so_user = $this->security->xss_clean(strip_tags($this->session->userdata('id_so_user')));
		$id_articulo = $this->security->xss_clean(strip_tags($this->session->userdata('id_cat_user')));
		$ejercicio = $this->session->userdata('ejercicio');

		

		$data_so = $this->Tablas_ap_model->obtener_so($id_so_user);
//		$telefono = $this->telefonos_model->lista_telefono_ente($id_ente);
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('COTAIPEC');
		$pdf->SetTitle('Comprobante de Envío');
		$pdf->SetSubject('Cotaipec');


// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(130, 61, 0), array(130, 61, 0));
		$pdf->setFooterData($tc = array(130, 61, 0), $lc = array(130, 61, 0));

// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//relación utilizada para ajustar la conversión de los píxeles
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------
// establecer el modo de fuente por defecto
		$pdf->setFontSubsetting(TRUE);

// Establecer el tipo de letra
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
		$pdf->SetFont('helvetica', '', 10, '', TRUE);

// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
		$pdf->AddPage();

//fijar efecto de sombra en el texto
		$pdf->setTextShadow(array('enabled' => FALSE, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

// Establecemos el contenido para imprimir
		$a = 1;
		$x = 1;
		$y = 1;
		$z = 1;

//preparamos y maquetamos el contenido a crear
//		foreach ($data_so as $SO):
			$html = '';
			$html .= "<style type=text/css>";
			$html .= "th{color: #FFFFFF; font-weight: bold; background-color: #e16a0b; padding: 5px 10px;}";
			$html .= "td{background-color: #fff ; color: #000; padding: 1em;}";
			$html .= "</style>";
			$html .= "<center><h2><strong>TABLA DE APLICABILIDAD</strong> DATA HERE </h2></center>";
			$html .= "<center><h5><strong>CATEGORÍA</strong>: DATA HERE  </h5></center>";
			$html .= '<table border="0.6" style="font-size: 9px">';
			$html .= '<thead>';
			$html .= '<tr>';
			$html .= '<th rowspan="2">Sujeto Obligado</th>';
			$html .= '<th colspan="2" style="text-align: center">Obligaciones comunes <br />- Artículo 74 de la Ley Estatal</th>';
			
			$html .= '<th colspan="2" style="text-align: center">Obligaciones Especificas <br />- Artículo DATA HERE </th>';
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

			$html .= "<td> </td>";
			$html .= "<td> </td>";
			$html .= "<td> </td>";
			$html .= "<td> </td>";
			$html .= "<td> </td>";
			$html .= "</tr>";
			$html .= "</tbody>";
			$html .= "</table>";
			
//		endforeach;
// Imprimimos el texto con writeHTMLCell()
		$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
		$nombre_archivo = utf8_decode('Comprobante' . '.pdf');


		$pdf->Output($nombre_archivo, 'D');
	}

}
