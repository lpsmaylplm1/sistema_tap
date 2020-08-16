<?php

class Tablas_ap_model Extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function verify_table($ejercicio, $id_so_user) {
		if ($id_so_user === "118" OR $id_so_user === "120" OR $id_so_user === "121") {
			$this->db->select('*');
			$this->db->where('t_oc_control', 1);
			$this->db->where('ejercicio_control', $ejercicio);
			$this->db->where('id_so_control', $id_so_user);
			$this->db->from('control_tap');
			$consulta_oc = $this->db->get();
			if ($consulta_oc->num_rows() === 0) {
				$this->session->set_flashdata('msg_send_error', '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">cancel</i><br><b>No se han registrado <u>OBLIGACIONES COMUNES</u> para esta tabla de aplicabilidad, correspondiente al ejercicio ' . $ejercicio . '. </b><br>No es posible continuar con el proceso de envío.<div>');
				return FALSE;
			} else {
				$this->session->set_flashdata('msg_send', '<div class="card-panel green lighten-3 center "><i class="medium material-icons">check_circle</i><br><b>La tabla de aplicabilidad correspondiente al ejercicio ' . $ejercicio . ' se ha enviado correctamente</b> <br><a href="' . base_url('pdfcreator_controller/create_acuse') . '"><b>Descargar Acuse</b></a><div>');
				return TRUE;
			}
		} else {
			$this->db->select('*');
			$this->db->where('t_oc_control', 1);
			$this->db->where('ejercicio_control', $ejercicio);
			$this->db->where('id_so_control', $id_so_user);
			$this->db->from('control_tap');
			$consulta_oc = $this->db->get();
			if ($consulta_oc->num_rows() === 0) {
				$this->session->set_flashdata('msg_send_error', '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">cancel</i><br><b>No se han registrado <u>OBLIGACIONES COMUNES</u> para esta tabla de aplicabilidad, correspondiente al ejercicio ' . $ejercicio . '.</b><br>No es posible continuar con el proceso de envío.<div>');
				return FALSE;
			} else {
				$this->db->select('*');
				$this->db->where('t_esp_control', 1);
				$this->db->where('ejercicio_control', $ejercicio);
				$this->db->where('id_so_control', $id_so_user);
				$this->db->from('control_tap');
				$consulta_esp = $this->db->get();
				if ($consulta_esp->num_rows() === 0) {
					$this->session->set_flashdata('msg_send_error', '<div class="card-panel orange lighten-3 center"><i class="medium material-icons">cancel</i><br><b>No se han registrado <u>OBLIGACIONES ESPECÍFICAS</u> para esta tabla de aplicabilidad, correspondiente al ejercicio ' . $ejercicio . '.</b><br>No es posible continuar con el proceso de envío.<div>');
					return FALSE;
				} else {
					$this->session->set_flashdata('msg_send', '<div class="card-panel green lighten-3 center "><i class="medium material-icons">check_circle</i><br><b>La tabla de aplicabilidad correspondiente al ejercicio ' . $ejercicio . ' se ha enviado correctamente</b> <br><br><a  class="waves-effect waves-light btn orange darken-4" href="' . base_url('pdfcreator_controller/create_acuse') . '"> <i class="material-icons" style="vertical-align:-3px">file_download</i>Descargar Acuse</a><div>');
					return TRUE;
				}
			}
		}
	}

	public function save_data_ac($ejercicio, $id_so_user, $id_user, $fecha, $num_aplica, $num_noaplica, $num_aplica_esp, $num_noaplica_esp) {
		$data = array(
			'id_so_ac' => $id_so_user,
			'id_user' => $id_user,
			'ejercicio_ac' => $ejercicio,
			'oc_ap_ac' => $num_aplica,
			'oc_na_ac' => $num_noaplica,
			'esp_ap_ac' => $num_aplica_esp,
			'esp_na_ac' => $num_noaplica_esp,
			'fecha' => $fecha
		);
		$this->db->insert('acuse', $data);
		return TRUE;
	}

	public function val_tcreate_so($ejercicio, $id_so) {
		if ($id_so === 118 OR $id_so === 120 OR $id_so === 121) {
			return 1;
		} else {
			$this->db->from('control_tap');
			$this->db->where('ejercicio_control', $ejercicio);
			$this->db->where('id_so_control', $id_so);

			return $this->db->count_all_results();
		}
	}
	public function val_com_esp_so($ejercicio, $id_so) {
		if ($id_so === 118 OR $id_so === 120 OR $id_so === 121) {
			return 1;
		} else {
			$this->db->from('control_tap');
			$this->db->where('ejercicio_control', $ejercicio);
			$this->db->where('id_so_control', $id_so);

			return $this->db->count_all_results();
		}
	}
	public function val_issend_table($ejercicio, $id_so_user) {
		$this->db->from('control_tap');
		$this->db->where('ejercicio_control', $ejercicio);
		$this->db->where('id_so_control', $id_so_user);
		$this->db->where('estado_enviado', 1);
		return $this->db->count_all_results();
	}

	public function val_vpreview_so($ejercicio, $id_so) {
		if ($id_so === 118 OR $id_so === 120 OR $id_so === 121) {
			return 1;
		} else {
			$this->db->from('control_tap');
			$this->db->where('ejercicio_control', $ejercicio);
			$this->db->where('id_so_control', $id_so);
			$this->db->where('t_oc_control', 1);
			$this->db->where('t_esp_control', 1);
			return $this->db->count_all_results();
		}
	}

	public function select_articulos() {
		$this->db->select('*');
		$this->db->from('articulos');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function select_categorias() {
		$this->db->select('*');
		$this->db->from('categorias');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function load_user($id_so_user) {
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where('id_so_user', $id_so_user);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function obtener_fracciones($id_art) {
		$this->db->select('*');
		$this->db->from('fracciones');
		$this->db->join('articulos', 'articulos.id_articulo = fracciones.id_articulo');
		$this->db->where('fracciones.id_articulo', $id_art);
		$this->db->order_by('fracciones.id_fraccion', 'asc');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function obtener_fracciones_ieec($id_art) {
		$this->db->select('*');
		$this->db->from('fracciones');
		$this->db->join('articulos', 'articulos.id_articulo = fracciones.id_articulo');
		$this->db->where('fracciones.id_articulo', $id_art);
		$this->db->where('fracciones.id_fraccion  >=', 92);
		$this->db->where('fracciones.id_fraccion  <=', 105);
		$this->db->order_by('fracciones.id_fraccion', 'asc');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function obtener_data_art($id_articulo) {
		$this->db->select('*');
		$this->db->from('categorias');
		$this->db->where('id_categoria', $id_articulo);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function obtener_fracciones_codehcam($id_art) {
		$this->db->select('*');
		$this->db->from('fracciones');
		$this->db->join('articulos', 'articulos.id_articulo = fracciones.id_articulo');
		$this->db->where('fracciones.id_articulo', $id_art);
		$this->db->where('fracciones.id_fraccion  >=', 106);
		$this->db->where('fracciones.id_fraccion  <=', 118);
		$this->db->order_by('fracciones.id_fraccion', 'asc');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function obtener_fracciones_cotaipec($id_art) {
		$this->db->select('*');
		$this->db->from('fracciones');
		$this->db->join('articulos', 'articulos.id_articulo = fracciones.id_articulo');
		$this->db->where('fracciones.id_articulo', $id_art);
		$this->db->where('fracciones.id_fraccion  >=', 119);
		$this->db->where('fracciones.id_fraccion  <=', 125);
		$this->db->order_by('fracciones.id_fraccion', 'asc');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function obtener_fraccion_especifica($id_frac) {
		$this->db->select('*');
		$this->db->from('fracciones');
		$this->db->join('articulos', 'articulos.id_articulo = fracciones.id_articulo');
		$this->db->where('id_fraccion', $id_frac);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function save_fundamentacion($id_fraccion, $fundamenta_frac) {
		$data = array(
			'fundamentacion_ltg' => $fundamenta_frac,
		);
		$this->db->where('id_fraccion', $id_fraccion);
		$this->db->update('fracciones', $data);
		return TRUE;
	}

	public function obtener_so($id_so_user) {
		$this->db->select('*');
		$this->db->from('sujetos_obligados');
		$this->db->join('categorias', 'categorias.id_categoria = sujetos_obligados.id_categoria_so');
		$this->db->join('usuarios', 'usuarios.id_so_user = sujetos_obligados.id_so');
		$this->db->where('id_so', $id_so_user);
		$this->db->where('usuarios.nivel_user', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function obtener_art($id_cat_user) {
		$this->db->select('*');
		$this->db->from('categorias');
		$this->db->join('articulos', 'articulos.articulo = categorias.id_art_cat');

		$this->db->where('categorias.id_categoria', $id_cat_user);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function save_fundamentacion_so($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad) {
		$data = array(
			'ejercicio_oc' => $ejercicio,
			'id_so_oc' => $id_so,
			'id_categoria_so_oc' => $id_cat_so,
			'id_fc_oc' => $id_fraccion,
			'aplica_oc' => $aplicabilidad,
			'justificacion_so_oc' => $fundamenta_frac
		);
		$this->db->where('id_so_oc', $id_so);
		$this->db->where('id_fc_oc', $id_fraccion);
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->update('t_oc', $data);
		return TRUE;
	}

	public function obtener_just_fraccion_esp($id_frac) {
		$this->db->select('*');
		$this->db->from('justificacion_so');
		$this->db->where('id_fraccion_just', $id_frac);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function obtener_na_so($ejercicio, $id_so) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_so_oc', $id_so);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function save_tabla_base($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad) {
		$data = array(
			'ejercicio_oc' => $ejercicio,
			'id_so_oc' => $id_so,
			'id_categoria_so_oc' => $id_cat_so,
			'id_fc_oc' => $i,
			'aplica_oc' => $aplicabilidad
		);
		$this->db->insert('t_oc', $data);
		return TRUE;
	}

	public function save_send_mail($ejercicio, $id_so_user, $id_articulo) {
		$data = array(
			'id_so_control' => $id_so_user,
			'cat_control' => $id_articulo,
			'ejercicio_control' => $ejercicio,
			'estado_enviado' => 1
		);
		$this->db->where('id_so_control', $id_so_user);
		$this->db->where('ejercicio_control', $ejercicio);
		$this->db->update('control_tap', $data);
		return TRUE;
	}

	public function save_control_oc($ejercicio, $id_so, $id_cat_so) {
		$data = array(
			'id_so_control' => $id_so,
			'cat_control' => $id_cat_so,
			'ejercicio_control' => $ejercicio,
			't_oc_control' => 1
		);
		$this->db->insert('control_tap', $data);
		return TRUE;
	}

	public function upd_control_oc($ejercicio, $id_so, $id_cat_so) {
		$data = array(
			'id_so_control' => $id_so,
			'cat_control' => $id_cat_so,
			'ejercicio_control' => $ejercicio,
			't_oc_control' => 1
		);
		$this->db->where('id_so_control', $id_so);
		$this->db->where('ejercicio_control', $ejercicio);
		$this->db->update('control_tap', $data);
		return TRUE;
	}

	public function save_control_esp($ejercicio, $id_so, $id_cat_so) {
		$data = array(
			'id_so_control' => $id_so,
			'cat_control' => $id_cat_so,
			'ejercicio_control' => $ejercicio,
			't_esp_control' => 1
		);
		$this->db->insert('control_tap', $data);
		return TRUE;
	}

	public function upd_control_esp($ejercicio, $id_so, $id_cat_so) {
		$data = array(
			'id_so_control' => $id_so,
			'cat_control' => $id_cat_so,
			'ejercicio_control' => $ejercicio,
			't_esp_control' => 1
		);
		$this->db->where('id_so_control', $id_so);
		$this->db->where('ejercicio_control', $ejercicio);
		$this->db->update('control_tap', $data);
		return TRUE;
	}

	public function seek_tabla_so($ejercicio, $id_so) {
		$this->db->from('t_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_so_oc', $id_so);

		return $this->db->count_all_results();
	}

	public function seek_tabla_pejec($ejercicio, $id_so) {
		$this->db->from('t_oesp_pejec');
		$this->db->where('ejercicio_pejec', $ejercicio);
		$this->db->where('id_so_tap_pejec', $id_so);

		return $this->db->count_all_results();
	}

	public function seek_tabla_muni($ejercicio, $id_so) {
		$this->db->from('t_oesp_muni');
		$this->db->where('ejercicio_muni', $ejercicio);
		$this->db->where('id_so_tap_muni', $id_so);

		return $this->db->count_all_results();
	}

	public function seek_tabla_pleg($ejercicio, $id_so) {
		$this->db->from('t_oesp_pleg');
		$this->db->where('ejercicio_pleg', $ejercicio);
		$this->db->where('id_so_tap_pleg', $id_so);

		return $this->db->count_all_results();
	}

	public function seek_tabla_pjud($ejercicio, $id_so) {
		$this->db->from('t_oesp_pjud');
		$this->db->where('ejercicio_pjud', $ejercicio);
		$this->db->where('id_so_tap_pjud', $id_so);

		return $this->db->count_all_results();
	}

	public function seek_tabla_oa($ejercicio, $id_so) {
		$this->db->from('t_oesp_oa');
		$this->db->where('ejercicio_oa', $ejercicio);
		$this->db->where('id_so_tap_oa', $id_so);

		return $this->db->count_all_results();
	}

	public function a_num_comunes($ejercicio, $id_so_user) {
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->where('ejercicio_oc', (int) $ejercicio);
		$this->db->where('id_so_oc', (int) $id_so_user);
		$this->db->where('aplica_oc', 1);
		return $this->db->count_all_results();
	}

	public function na_num_comunes($ejercicio, $id_so_user) {
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_so_oc', $id_so_user);
		$this->db->where('aplica_oc', 0);
		return $this->db->count_all_results();
	}

	public function data_toc_apl($ejercicio, $id_so_user) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_so_oc', $id_so_user);
		$this->db->where('aplica_oc', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function data_toc_noapl($ejercicio, $id_so_user) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_so_oc', $id_so_user);
		$this->db->where('aplica_oc', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function edit_frac_toc($ejercicio, $id_so, $id_art) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->join('articulos', 'articulos.id_articulo=' . $id_art);

		$this->db->where('t_oc.id_so_oc', $id_so);
		$this->db->where('t_oc.ejercicio_oc', $ejercicio);
		$this->db->order_by('t_oc.ejercicio_oc', 'asc');

		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function seek_tabla_oesp_pejec($ejercicio, $id_so) {
		$this->db->from('t_oesp_pejec');
		$this->db->where('ejercicio_pejec', $ejercicio);
		$this->db->where('id_so_tap_pejec', $id_so);

		return $this->db->count_all_results();
	}

	public function save_tbase_oesp($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad) {
		$data = array(
			'ejercicio_pejec' => $ejercicio,
			'id_so_tap_pejec' => $id_so,
			'id_categoría_so_pejec' => $id_cat_so,
			'id_oe_pe' => $i,
			'aplica_oesp' => $aplicabilidad
		);
		$this->db->insert('t_oesp_pejec', $data);
		return TRUE;
	}

	public function save_fund_so_esp($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad) {
		$data = array(
			'ejercicio_pejec' => $ejercicio,
			'id_so_tap_pejec' => $id_so,
			'id_categoría_so_pejec' => $id_cat_so,
			'id_oe_pe' => $id_fraccion,
			'aplica_oesp' => $aplicabilidad,
			'just_so_oesp' => $fundamenta_frac
		);
		$this->db->where('id_so_tap_pejec', $id_so);
		$this->db->where('id_oe_pe', $id_fraccion);
		$this->db->where('ejercicio_pejec', $ejercicio);
		$this->db->update('t_oesp_pejec', $data);
		return TRUE;
	}

	public function na_num_esp($ejercicio, $id_so_user) {
		$this->db->from('t_oesp_pejec');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_pejec.id_oe_pe');
		$this->db->where('ejercicio_pejec', $ejercicio);
		$this->db->where('id_so_tap_pejec', $id_so_user);
		$this->db->where('aplica_oesp', 0);
		return $this->db->count_all_results();
	}

	public function a_num_esp($ejercicio, $id_so_user) {
		$this->db->from('t_oesp_pejec');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_pejec.id_oe_pe');
		$this->db->where('ejercicio_pejec', $ejercicio);
		$this->db->where('id_so_tap_pejec', $id_so_user);
		$this->db->where('aplica_oesp', 1);
		return $this->db->count_all_results();
	}

	public function data_tesp_apl($ejercicio, $id_so_user) {
		$this->db->select('*');
		$this->db->from('t_oesp_pejec');
		$this->db->join('fracciones', 'fracciones.id_fraccion =  t_oesp_pejec.id_oe_pe');
		$this->db->where('ejercicio_pejec', $ejercicio);
		$this->db->where('id_so_tap_pejec', $id_so_user);
		$this->db->where('aplica_oesp', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function data_tesp_noapl($ejercicio, $id_so_user) {
		$this->db->select('*');
		$this->db->from('t_oesp_pejec');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_pejec.id_oe_pe');
		$this->db->where('ejercicio_pejec', $ejercicio);
		$this->db->where('id_so_tap_pejec', $id_so_user);
		$this->db->where('aplica_oesp', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function edit_frac_esp($ejercicio, $id_so, $id_art) {
		$this->db->select('*');
		$this->db->from('t_oesp_pejec');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_pejec.id_oe_pe');
		$this->db->join('articulos', 'articulos.id_articulo=' . $id_art);

		$this->db->where('t_oesp_pejec.id_so_tap_pejec', $id_so);
		$this->db->where('t_oesp_pejec.ejercicio_pejec', $ejercicio);
		$this->db->order_by('t_oesp_pejec.ejercicio_pejec', 'asc');

		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function edit_frac_muni($ejercicio, $id_so, $id_art) {
		$this->db->select('*');
		$this->db->from('t_oesp_muni');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_muni.id_oe_muni');
		$this->db->join('articulos', 'articulos.id_articulo=' . $id_art);

		$this->db->where('t_oesp_muni.id_so_tap_muni', $id_so);
		$this->db->where('t_oesp_muni.ejercicio_muni', $ejercicio);
		$this->db->order_by('t_oesp_muni.ejercicio_muni', 'asc');

		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function edit_frac_pleg($ejercicio, $id_so, $id_art) {
		$this->db->select('*');
		$this->db->from('t_oesp_pleg');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_pleg.id_oe_pleg');
		$this->db->join('articulos', 'articulos.id_articulo=' . $id_art);

		$this->db->where('t_oesp_pleg.id_so_tap_pleg', $id_so);
		$this->db->where('t_oesp_pleg.ejercicio_pleg', $ejercicio);
		$this->db->order_by('t_oesp_pleg.ejercicio_pleg', 'asc');

		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function edit_frac_pjud($ejercicio, $id_so, $id_art) {
		$this->db->select('*');
		$this->db->from('t_oesp_pjud');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_pjud.id_oe_pjud');
		$this->db->join('articulos', 'articulos.id_articulo=' . $id_art);

		$this->db->where('t_oesp_pjud.id_so_tap_pjud', $id_so);
		$this->db->where('t_oesp_pjud.ejercicio_pjud', $ejercicio);
		$this->db->order_by('t_oesp_pjud.ejercicio_pjud', 'asc');

		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function edit_frac_oa($ejercicio, $id_so, $id_art) {
		$this->db->select('*');
		$this->db->from('t_oesp_oa');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_oa.id_oe_oa');
		$this->db->join('articulos', 'articulos.id_articulo=' . $id_art);

		$this->db->where('t_oesp_oa.id_so_tap_oa', $id_so);
		$this->db->where('t_oesp_oa.ejercicio_oa', $ejercicio);
		$this->db->order_by('t_oesp_oa.ejercicio_oa', 'asc');

		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function edit_frac_iesa($ejercicio, $id_so, $id_art) {
		$this->db->select('*');
		$this->db->from('t_oesp_esda');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_esda.id_oe_esda');
		$this->db->join('articulos', 'articulos.id_articulo=' . $id_art);

		$this->db->where('t_oesp_esda.id_so_tap_esda', $id_so);
		$this->db->where('t_oesp_esda.ejercicio_esda', $ejercicio);
		$this->db->order_by('t_oesp_esda.ejercicio_esda', 'asc');

		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function edit_frac_pp($ejercicio, $id_so, $id_art) {
		$this->db->select('*');
		$this->db->from('t_oesp_pp');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_pp.id_oe_pp');
		$this->db->join('articulos', 'articulos.id_articulo=' . $id_art);

		$this->db->where('t_oesp_pp.id_so_tap_pp', $id_so);
		$this->db->where('t_oesp_pp.ejercicio_pp', $ejercicio);
		$this->db->order_by('t_oesp_pp.ejercicio_pp', 'asc');

		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function edit_frac_ffp($ejercicio, $id_so, $id_art) {
		$this->db->select('*');
		$this->db->from('t_oesp_ffp');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_ffp.id_oe_ffp');
		$this->db->join('articulos', 'articulos.id_articulo=' . $id_art);

		$this->db->where('t_oesp_ffp.id_so_tap_ffp', $id_so);
		$this->db->where('t_oesp_ffp.ejercicio_ffp', $ejercicio);
		$this->db->order_by('t_oesp_ffp.ejercicio_ffp', 'asc');

		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function edit_frac_sind($ejercicio, $id_so, $id_art) {
		$this->db->select('*');
		$this->db->from('t_oesp_sind');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_sind.id_oe_sind');
		$this->db->join('articulos', 'articulos.id_articulo=' . $id_art);

		$this->db->where('t_oesp_sind.id_so_tap_sind', $id_so);
		$this->db->where('t_oesp_sind.ejercicio_sind', $ejercicio);
		$this->db->order_by('t_oesp_sind.ejercicio_sind', 'asc');

		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function edit_frac_aayjml($ejercicio, $id_so, $id_art) {
		$this->db->select('*');
		$this->db->from('t_oesp_aayjml');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_aayjml.id_oe_aayjml');
		$this->db->join('articulos', 'articulos.id_articulo=' . $id_art);

		$this->db->where('t_oesp_aayjml.id_so_tap_aayjml', $id_so);
		$this->db->where('t_oesp_aayjml.ejercicio_aayjml', $ejercicio);
		$this->db->order_by('t_oesp_aayjml.ejercicio_aayjml', 'asc');

		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function edit_fund_esp($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad) {
		$data = array(
			'ejercicio_pejec' => $ejercicio,
			'id_so_tap_pejec' => $id_so,
			'id_categoría_so_pejec' => $id_cat_so,
			'id_oe_pe' => $id_fraccion,
			'aplica_oesp' => $aplicabilidad,
			'just_so_oesp' => $fundamenta_frac
		);
		$this->db->where('id_so_tap_pejec', $id_so);
		$this->db->where('id_oe_pe', $id_fraccion);
		$this->db->where('ejercicio_pejec', $ejercicio);
		$this->db->update('t_oesp_pejec', $data);
		return TRUE;
	}

	public function edit_fund_muni($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad) {
		$data = array(
			'ejercicio_muni' => $ejercicio,
			'id_so_tap_muni' => $id_so,
			'id_categoría_so_muni' => $id_cat_so,
			'id_oe_muni' => $id_fraccion,
			'aplica_muni' => $aplicabilidad,
			'just_so_oesp' => $fundamenta_frac
		);
		$this->db->where('id_so_tap_muni', $id_so);
		$this->db->where('id_oe_muni', $id_fraccion);
		$this->db->where('ejercicio_muni', $ejercicio);
		$this->db->update('t_oesp_muni', $data);
		return TRUE;
	}

	public function edit_fund_pleg($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad) {
		$data = array(
			'ejercicio_pleg' => $ejercicio,
			'id_so_tap_pleg' => $id_so,
			'id_categoría_so_pleg' => $id_cat_so,
			'id_oe_pleg' => $id_fraccion,
			'aplica_pleg' => $aplicabilidad,
			'just_so_oesp' => $fundamenta_frac
		);
		$this->db->where('id_so_tap_pleg', $id_so);
		$this->db->where('id_oe_pleg', $id_fraccion);
		$this->db->where('ejercicio_pleg', $ejercicio);
		$this->db->update('t_oesp_pleg', $data);
		return TRUE;
	}

	public function edit_fund_pjud($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad) {
		$data = array(
			'ejercicio_pjud' => $ejercicio,
			'id_so_tap_pjud' => $id_so,
			'id_categoría_so_pjud' => $id_cat_so,
			'id_oe_pjud' => $id_fraccion,
			'aplica_pjud' => $aplicabilidad,
			'just_so_oesp' => $fundamenta_frac
		);
		$this->db->where('id_so_tap_pjud', $id_so);
		$this->db->where('id_oe_pjud', $id_fraccion);
		$this->db->where('ejercicio_pjud', $ejercicio);
		$this->db->update('t_oesp_pjud', $data);
		return TRUE;
	}

	public function edit_fund_oa($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad) {
		$data = array(
			'ejercicio_oa' => $ejercicio,
			'id_so_tap_oa' => $id_so,
			'id_categoria_so_oa' => $id_cat_so,
			'id_oe_oa' => $id_fraccion,
			'aplica_oa' => $aplicabilidad,
			'just_so_oesp' => $fundamenta_frac
		);
		$this->db->where('id_so_tap_oa', $id_so);
		$this->db->where('id_oe_oa', $id_fraccion);
		$this->db->where('ejercicio_oa', $ejercicio);
		$this->db->update('t_oesp_oa', $data);
		return TRUE;
	}

	public function edit_fund_iesa($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad) {
		$data = array(
			'ejercicio_esda' => $ejercicio,
			'id_so_tap_esda' => $id_so,
			'id_categoria_so_esda' => $id_cat_so,
			'id_oe_esda' => $id_fraccion,
			'aplica_esda' => $aplicabilidad,
			'just_so_oesp' => $fundamenta_frac
		);
		$this->db->where('id_so_tap_esda', $id_so);
		$this->db->where('id_oe_esda', $id_fraccion);
		$this->db->where('ejercicio_esda', $ejercicio);
		$this->db->update('t_oesp_esda', $data);
		return TRUE;
	}

	public function edit_fund_pp($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad) {
		$data = array(
			'ejercicio_pp' => $ejercicio,
			'id_so_tap_pp' => $id_so,
			'id_categoria_so_pp' => $id_cat_so,
			'id_oe_pp' => $id_fraccion,
			'aplica_pp' => $aplicabilidad,
			'just_so_oesp' => $fundamenta_frac
		);
		$this->db->where('id_so_tap_pp', $id_so);
		$this->db->where('id_oe_pp', $id_fraccion);
		$this->db->where('ejercicio_pp', $ejercicio);
		$this->db->update('t_oesp_pp', $data);
		return TRUE;
	}

	public function edit_fund_ffp($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad) {
		$data = array(
			'ejercicio_ffp' => $ejercicio,
			'id_so_tap_ffp' => $id_so,
			'id_categoria_so_ffp' => $id_cat_so,
			'id_oe_ffp' => $id_fraccion,
			'aplica_ffp' => $aplicabilidad,
			'just_so_oesp' => $fundamenta_frac
		);
		$this->db->where('id_so_tap_ffp', $id_so);
		$this->db->where('id_oe_ffp', $id_fraccion);
		$this->db->where('ejercicio_ffp', $ejercicio);
		$this->db->update('t_oesp_ffp', $data);
		return TRUE;
	}

	public function edit_fund_aayjml($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad) {
		$data = array(
			'ejercicio_aayjml' => $ejercicio,
			'id_so_tap_aayjml' => $id_so,
			'id_categoria_so_aayjml' => $id_cat_so,
			'id_oe_aayjml' => $id_fraccion,
			'aplica_aayjml' => $aplicabilidad,
			'just_so_oesp' => $fundamenta_frac
		);
		$this->db->where('id_so_tap_aayjml', $id_so);
		$this->db->where('id_oe_aayjml', $id_fraccion);
		$this->db->where('ejercicio_aayjml', $ejercicio);
		$this->db->update('t_oesp_aayjml', $data);
		return TRUE;
	}

	public function edit_fund_sind($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad) {
		$data = array(
			'ejercicio_sind' => $ejercicio,
			'id_so_tap_sind' => $id_so,
			'id_categoria_so_sind' => $id_cat_so,
			'id_oe_sind' => $id_fraccion,
			'aplica_sind' => $aplicabilidad,
			'just_so_oesp' => $fundamenta_frac
		);
		$this->db->where('id_so_tap_sind', $id_so);
		$this->db->where('id_oe_sind', $id_fraccion);
		$this->db->where('ejercicio_sind', $ejercicio);
		$this->db->update('t_oesp_sind', $data);
		return TRUE;
	}

	public function seek_tabla_oesp_pleg($ejercicio, $id_so) {
		$this->db->from('t_oesp_pleg');
		$this->db->where('ejercicio_pleg', $ejercicio);
		$this->db->where('id_so_tap_pleg', $id_so);

		return $this->db->count_all_results();
	}

	public function seek_tabla_oesp_pjud($ejercicio, $id_so) {
		$this->db->from('t_oesp_pjud');
		$this->db->where('ejercicio_pjud', $ejercicio);
		$this->db->where('id_so_tap_pjud', $id_so);

		return $this->db->count_all_results();
	}

	public function seek_tabla_oesp_iesa($ejercicio, $id_so) {
		$this->db->from('t_oesp_esda');
		$this->db->where('ejercicio_esda', $ejercicio);
		$this->db->where('id_so_tap_esda', $id_so);

		return $this->db->count_all_results();
	}

	public function seek_tabla_oesp_pp($ejercicio, $id_so) {
		$this->db->from('t_oesp_pp');
		$this->db->where('ejercicio_pp', $ejercicio);
		$this->db->where('id_so_tap_pp', $id_so);

		return $this->db->count_all_results();
	}

	public function seek_tabla_oesp_ffp($ejercicio, $id_so) {
		$this->db->from('t_oesp_ffp');
		$this->db->where('ejercicio_ffp', $ejercicio);
		$this->db->where('id_so_tap_ffp', $id_so);

		return $this->db->count_all_results();
	}

	public function seek_tabla_oesp_aayjml($ejercicio, $id_so) {
		$this->db->from('t_oesp_aayjml');
		$this->db->where('ejercicio_aayjml', $ejercicio);
		$this->db->where('id_so_tap_aayjml', $id_so);

		return $this->db->count_all_results();
	}

	public function seek_tabla_oesp_sind($ejercicio, $id_so) {
		$this->db->from('t_oesp_sind');
		$this->db->where('ejercicio_sind', $ejercicio);
		$this->db->where('id_so_tap_sind', $id_so);

		return $this->db->count_all_results();
	}

	public function seek_tabla_oesp_oa($ejercicio, $id_so) {
		$this->db->from('t_oesp_oa');
		$this->db->where('ejercicio_oa', $ejercicio);
		$this->db->where('id_so_tap_oa', $id_so);

		return $this->db->count_all_results();
	}

	public function seek_tabla_oesp_muni($ejercicio, $id_so) {
		$this->db->from('t_oesp_muni');
		$this->db->where('ejercicio_muni', $ejercicio);
		$this->db->where('id_so_tap_muni', $id_so);

		return $this->db->count_all_results();
	}

	public function save_tbase_oesp_muni($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad) {
		$data = array(
			'ejercicio_muni' => $ejercicio,
			'id_so_tap_muni' => $id_so,
			'id_categoría_so_muni' => $id_cat_so,
			'id_oe_muni' => $i,
			'aplica_muni' => $aplicabilidad
		);
		$this->db->insert('t_oesp_muni', $data);
		return TRUE;
	}

	public function save_tbase_oesp_pleg($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad) {
		$data = array(
			'ejercicio_pleg' => $ejercicio,
			'id_so_tap_pleg' => $id_so,
			'id_categoría_so_pleg' => $id_cat_so,
			'id_oe_pleg' => $i,
			'aplica_pleg' => $aplicabilidad
		);
		$this->db->insert('t_oesp_pleg', $data);
		return TRUE;
	}

	public function save_tbase_oesp_pjud($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad) {
		$data = array(
			'ejercicio_pjud' => $ejercicio,
			'id_so_tap_pjud' => $id_so,
			'id_categoría_so_pjud' => $id_cat_so,
			'id_oe_pjud' => $i,
			'aplica_pjud' => $aplicabilidad
		);
		$this->db->insert('t_oesp_pjud', $data);
		return TRUE;
	}

	public function save_tbase_oesp_iesa($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad) {
		$data = array(
			'ejercicio_esda' => $ejercicio,
			'id_so_tap_esda' => $id_so,
			'id_categoria_so_esda' => $id_cat_so,
			'id_oe_esda' => $i,
			'aplica_esda' => $aplicabilidad
		);
		$this->db->insert('t_oesp_esda', $data);
		return TRUE;
	}

	public function save_tbase_oesp_pp($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad) {
		$data = array(
			'ejercicio_pp' => $ejercicio,
			'id_so_tap_pp' => $id_so,
			'id_categoria_so_pp' => $id_cat_so,
			'id_oe_pp' => $i,
			'aplica_pp' => $aplicabilidad
		);
		$this->db->insert('t_oesp_pp', $data);
		return TRUE;
	}

	public function save_tbase_oesp_ffp($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad) {
		$data = array(
			'ejercicio_ffp' => $ejercicio,
			'id_so_tap_ffp' => $id_so,
			'id_categoria_so_ffp' => $id_cat_so,
			'id_oe_ffp' => $i,
			'aplica_ffp' => $aplicabilidad
		);
		$this->db->insert('t_oesp_ffp', $data);
		return TRUE;
	}

	public function save_tbase_oesp_aayjml($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad) {
		$data = array(
			'ejercicio_aayjml' => $ejercicio,
			'id_so_tap_aayjml' => $id_so,
			'id_categoria_so_aayjml' => $id_cat_so,
			'id_oe_aayjml' => $i,
			'aplica_aayjml' => $aplicabilidad
		);
		$this->db->insert('t_oesp_aayjml', $data);
		return TRUE;
	}

	public function save_tbase_oesp_sind($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad) {
		$data = array(
			'ejercicio_sind' => $ejercicio,
			'id_so_tap_sind' => $id_so,
			'id_categoria_so_sind' => $id_cat_so,
			'id_oe_sind' => $i,
			'aplica_sind' => $aplicabilidad
		);
		$this->db->insert('t_oesp_sind', $data);
		return TRUE;
	}

	public function save_tbase_oesp_og($i, $ejercicio, $id_so, $id_cat_so, $aplicabilidad) {
		$data = array(
			'ejercicio_oa' => $ejercicio,
			'id_so_tap_oa' => $id_so,
			'id_categoria_so_oa' => $id_cat_so,
			'id_oe_oa' => $i,
			'aplica_oa' => $aplicabilidad
		);
		$this->db->insert('t_oesp_oa', $data);
		return TRUE;
	}

	public function save_fund_so_muni($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad) {
		$data = array(
			'ejercicio_muni' => $ejercicio,
			'id_so_tap_muni' => $id_so,
			'id_categoría_so_muni' => $id_cat_so,
			'id_oe_muni' => $id_fraccion,
			'aplica_muni' => $aplicabilidad,
			'just_so_oesp' => $fundamenta_frac
		);
		$this->db->where('id_so_tap_muni', $id_so);
		$this->db->where('id_oe_muni', $id_fraccion);
		$this->db->where('ejercicio_muni', $ejercicio);
		$this->db->update('t_oesp_muni', $data);
		return TRUE;
	}

	public function save_fund_so_pleg($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad) {
		$data = array(
			'ejercicio_pleg' => $ejercicio,
			'id_so_tap_pleg' => $id_so,
			'id_categoría_so_pleg' => $id_cat_so,
			'id_oe_pleg' => $id_fraccion,
			'aplica_pleg' => $aplicabilidad,
			'just_so_oesp' => $fundamenta_frac
		);
		$this->db->where('id_so_tap_pleg', $id_so);
		$this->db->where('id_oe_pleg', $id_fraccion);
		$this->db->where('ejercicio_pleg', $ejercicio);
		$this->db->update('t_oesp_pleg', $data);
		return TRUE;
	}

	public function save_fund_so_pjud($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad) {
		$data = array(
			'ejercicio_pjud' => $ejercicio,
			'id_so_tap_pjud' => $id_so,
			'id_categoría_so_pjud' => $id_cat_so,
			'id_oe_pjud' => $id_fraccion,
			'aplica_pjud' => $aplicabilidad,
			'just_so_oesp' => $fundamenta_frac
		);
		$this->db->where('id_so_tap_pjud', $id_so);
		$this->db->where('id_oe_pjud', $id_fraccion);
		$this->db->where('ejercicio_pjud', $ejercicio);
		$this->db->update('t_oesp_pjud', $data);
		return TRUE;
	}

	public function save_fund_so_oa($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad) {
		$data = array(
			'ejercicio_oa' => $ejercicio,
			'id_so_tap_oa' => $id_so,
			'id_categoria_so_oa' => $id_cat_so,
			'id_oe_oa' => $id_fraccion,
			'aplica_oa' => $aplicabilidad,
			'just_so_oesp' => $fundamenta_frac
		);
		$this->db->where('id_so_tap_oa', $id_so);
		$this->db->where('id_oe_oa', $id_fraccion);
		$this->db->where('ejercicio_oa', $ejercicio);
		$this->db->update('t_oesp_oa', $data);
		return TRUE;
	}

	public function save_fund_so_iesa($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad) {
		$data = array(
			'ejercicio_esda' => $ejercicio,
			'id_so_tap_esda' => $id_so,
			'id_categoria_so_esda' => $id_cat_so,
			'id_oe_esda' => $id_fraccion,
			'aplica_esda' => $aplicabilidad,
			'just_so_oesp' => $fundamenta_frac
		);
		$this->db->where('id_so_tap_esda', $id_so);
		$this->db->where('id_oe_esda', $id_fraccion);
		$this->db->where('ejercicio_esda', $ejercicio);
		$this->db->update('t_oesp_esda', $data);
		return TRUE;
	}

	public function save_fund_so_pp($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad) {
		$data = array(
			'ejercicio_pp' => $ejercicio,
			'id_so_tap_pp' => $id_so,
			'id_categoria_so_pp' => $id_cat_so,
			'id_oe_pp' => $id_fraccion,
			'aplica_pp' => $aplicabilidad,
			'just_so_oesp' => $fundamenta_frac
		);
		$this->db->where('id_so_tap_pp', $id_so);
		$this->db->where('id_oe_pp', $id_fraccion);
		$this->db->where('ejercicio_pp', $ejercicio);
		$this->db->update('t_oesp_pp', $data);
		return TRUE;
	}

	public function save_fund_so_ffp($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad) {
		$data = array(
			'ejercicio_ffp' => $ejercicio,
			'id_so_tap_ffp' => $id_so,
			'id_categoria_so_ffp' => $id_cat_so,
			'id_oe_ffp' => $id_fraccion,
			'aplica_ffp' => $aplicabilidad,
			'just_so_oesp' => $fundamenta_frac
		);
		$this->db->where('id_so_tap_ffp', $id_so);
		$this->db->where('id_oe_ffp', $id_fraccion);
		$this->db->where('ejercicio_ffp', $ejercicio);
		$this->db->update('t_oesp_ffp', $data);
		return TRUE;
	}

	public function save_fund_so_aayjml($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad) {
		$data = array(
			'ejercicio_aayjml' => $ejercicio,
			'id_so_tap_aayjml' => $id_so,
			'id_categoria_so_aayjml' => $id_cat_so,
			'id_oe_aayjml' => $id_fraccion,
			'aplica_aayjml' => $aplicabilidad,
			'just_so_oesp' => $fundamenta_frac
		);
		$this->db->where('id_so_tap_aayjml', $id_so);
		$this->db->where('id_oe_aayjml', $id_fraccion);
		$this->db->where('ejercicio_aayjml', $ejercicio);
		$this->db->update('t_oesp_aayjml', $data);
		return TRUE;
	}

	public function save_fund_so_sind($id_fraccion, $ejercicio, $id_so, $id_cat_so, $fundamenta_frac, $aplicabilidad) {
		$data = array(
			'ejercicio_sind' => $ejercicio,
			'id_so_tap_sind' => $id_so,
			'id_categoria_so_sind' => $id_cat_so,
			'id_oe_sind' => $id_fraccion,
			'aplica_sind' => $aplicabilidad,
			'just_so_oesp' => $fundamenta_frac
		);
		$this->db->where('id_so_tap_sind', $id_so);
		$this->db->where('id_oe_sind', $id_fraccion);
		$this->db->where('ejercicio_sind', $ejercicio);
		$this->db->update('t_oesp_sind', $data);
		return TRUE;
	}

	public function data_tesp_muni($ejercicio, $id_so_user) {
		$this->db->select('*');
		$this->db->from('t_oesp_muni');
		$this->db->join('fracciones', 'fracciones.id_fraccion =  t_oesp_muni.id_oe_muni');
		$this->db->where('ejercicio_muni', $ejercicio);
		$this->db->where('id_so_tap_muni', $id_so_user);
		$this->db->where('aplica_muni', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function data_tesp_pleg($ejercicio, $id_so_user) {
		$this->db->select('*');
		$this->db->from('t_oesp_pleg');
		$this->db->join('fracciones', 'fracciones.id_fraccion =  t_oesp_pleg.id_oe_pleg');
		$this->db->where('ejercicio_pleg', $ejercicio);
		$this->db->where('id_so_tap_pleg', $id_so_user);
		$this->db->where('aplica_pleg', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function data_tesp_pjud($ejercicio, $id_so_user) {
		$this->db->select('*');
		$this->db->from('t_oesp_pjud');
		$this->db->join('fracciones', 'fracciones.id_fraccion =  t_oesp_pjud.id_oe_pjud');
		$this->db->where('ejercicio_pjud', $ejercicio);
		$this->db->where('id_so_tap_pjud', $id_so_user);
		$this->db->where('aplica_pjud', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function data_tesp_oa($ejercicio, $id_so_user) {
		$this->db->select('*');
		$this->db->from('t_oesp_oa');
		$this->db->join('fracciones', 'fracciones.id_fraccion =  t_oesp_oa.id_oe_oa');
		$this->db->where('ejercicio_oa', $ejercicio);
		$this->db->where('id_so_tap_oa', $id_so_user);
		$this->db->where('aplica_oa', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function data_tesp_iesa($ejercicio, $id_so_user) {
		$this->db->select('*');
		$this->db->from('t_oesp_esda');
		$this->db->join('fracciones', 'fracciones.id_fraccion =  t_oesp_esda.id_oe_esda');
		$this->db->where('ejercicio_esda', $ejercicio);
		$this->db->where('id_so_tap_esda', $id_so_user);
		$this->db->where('aplica_esda', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function data_tesp_pp($ejercicio, $id_so_user) {
		$this->db->select('*');
		$this->db->from('t_oesp_pp');
		$this->db->join('fracciones', 'fracciones.id_fraccion =  t_oesp_pp.id_oe_pp');
		$this->db->where('ejercicio_pp', $ejercicio);
		$this->db->where('id_so_tap_pp', $id_so_user);
		$this->db->where('aplica_pp', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function data_tesp_ffp($ejercicio, $id_so_user) {
		$this->db->select('*');
		$this->db->from('t_oesp_ffp');
		$this->db->join('fracciones', 'fracciones.id_fraccion =  t_oesp_ffp.id_oe_ffp');
		$this->db->where('ejercicio_ffp', $ejercicio);
		$this->db->where('id_so_tap_ffp', $id_so_user);
		$this->db->where('aplica_ffp', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function data_tesp_aayjml($ejercicio, $id_so_user) {
		$this->db->select('*');
		$this->db->from('t_oesp_aayjml');
		$this->db->join('fracciones', 'fracciones.id_fraccion =  t_oesp_aayjml.id_oe_aayjml');
		$this->db->where('ejercicio_aayjml', $ejercicio);
		$this->db->where('id_so_tap_aayjml', $id_so_user);
		$this->db->where('aplica_aayjml', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function data_tesp_sind($ejercicio, $id_so_user) {
		$this->db->select('*');
		$this->db->from('t_oesp_sind');
		$this->db->join('fracciones', 'fracciones.id_fraccion =  t_oesp_sind.id_oe_sind');
		$this->db->where('ejercicio_sind', $ejercicio);
		$this->db->where('id_so_tap_sind', $id_so_user);
		$this->db->where('aplica_sind', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function data_tesp_namuni($ejercicio, $id_so_user) {
		$this->db->select('*');
		$this->db->from('t_oesp_muni');
		$this->db->join('fracciones', 'fracciones.id_fraccion =  t_oesp_muni.id_oe_muni');
		$this->db->where('ejercicio_muni', $ejercicio);
		$this->db->where('id_so_tap_muni', $id_so_user);
		$this->db->where('aplica_muni', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function data_tesp_napleg($ejercicio, $id_so_user) {
		$this->db->select('*');
		$this->db->from('t_oesp_pleg');
		$this->db->join('fracciones', 'fracciones.id_fraccion =  t_oesp_pleg.id_oe_pleg');
		$this->db->where('ejercicio_pleg', $ejercicio);
		$this->db->where('id_so_tap_pleg', $id_so_user);
		$this->db->where('aplica_pleg', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function data_tesp_napjud($ejercicio, $id_so_user) {
		$this->db->select('*');
		$this->db->from('t_oesp_pjud');
		$this->db->join('fracciones', 'fracciones.id_fraccion =  t_oesp_pjud.id_oe_pjud');
		$this->db->where('ejercicio_pjud', $ejercicio);
		$this->db->where('id_so_tap_pjud', $id_so_user);
		$this->db->where('aplica_pjud', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function data_tesp_naoa($ejercicio, $id_so_user) {
		$this->db->select('*');
		$this->db->from('t_oesp_oa');
		$this->db->join('fracciones', 'fracciones.id_fraccion =  t_oesp_oa.id_oe_oa');
		$this->db->where('ejercicio_oa', $ejercicio);
		$this->db->where('id_so_tap_oa', $id_so_user);
		$this->db->where('aplica_oa', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function data_tesp_naiesa($ejercicio, $id_so_user) {
		$this->db->select('*');
		$this->db->from('t_oesp_esda');
		$this->db->join('fracciones', 'fracciones.id_fraccion =  t_oesp_esda.id_oe_esda');
		$this->db->where('ejercicio_esda', $ejercicio);
		$this->db->where('id_so_tap_esda', $id_so_user);
		$this->db->where('aplica_esda', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function data_tesp_napp($ejercicio, $id_so_user) {
		$this->db->select('*');
		$this->db->from('t_oesp_pp');
		$this->db->join('fracciones', 'fracciones.id_fraccion =  t_oesp_pp.id_oe_pp');
		$this->db->where('ejercicio_pp', $ejercicio);
		$this->db->where('id_so_tap_pp', $id_so_user);
		$this->db->where('aplica_pp', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function data_tesp_naffp($ejercicio, $id_so_user) {
		$this->db->select('*');
		$this->db->from('t_oesp_ffp');
		$this->db->join('fracciones', 'fracciones.id_fraccion =  t_oesp_ffp.id_oe_ffp');
		$this->db->where('ejercicio_ffp', $ejercicio);
		$this->db->where('id_so_tap_ffp', $id_so_user);
		$this->db->where('aplica_ffp', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function data_tesp_naaayjml($ejercicio, $id_so_user) {
		$this->db->select('*');
		$this->db->from('t_oesp_aayjml');
		$this->db->join('fracciones', 'fracciones.id_fraccion =  t_oesp_aayjml.id_oe_aayjml');
		$this->db->where('ejercicio_aayjml', $ejercicio);
		$this->db->where('id_so_tap_aayjml', $id_so_user);
		$this->db->where('aplica_aayjml', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function data_tesp_nasind($ejercicio, $id_so_user) {
		$this->db->select('*');
		$this->db->from('t_oesp_sind');
		$this->db->join('fracciones', 'fracciones.id_fraccion =  t_oesp_sind.id_oe_sind');
		$this->db->where('ejercicio_sind', $ejercicio);
		$this->db->where('id_so_tap_sind', $id_so_user);
		$this->db->where('aplica_sind', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function a_num_esp_muni($ejercicio, $id_so_user) {
		$this->db->from('t_oesp_muni');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_muni.id_oe_muni');
		$this->db->where('ejercicio_muni', $ejercicio);
		$this->db->where('id_so_tap_muni', $id_so_user);
		$this->db->where('aplica_muni', 1);
		return $this->db->count_all_results();
	}

	public function a_num_esp_pleg($ejercicio, $id_so_user) {
		$this->db->from('t_oesp_pleg');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_pleg.id_oe_pleg');
		$this->db->where('ejercicio_pleg', $ejercicio);
		$this->db->where('id_so_tap_pleg', $id_so_user);
		$this->db->where('aplica_pleg', 1);
		return $this->db->count_all_results();
	}

	public function a_num_esp_pjud($ejercicio, $id_so_user) {
		$this->db->from('t_oesp_pjud');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_pjud.id_oe_pjud');
		$this->db->where('ejercicio_pjud', $ejercicio);
		$this->db->where('id_so_tap_pjud', $id_so_user);
		$this->db->where('aplica_pjud', 1);
		return $this->db->count_all_results();
	}

	public function a_num_esp_oa($ejercicio, $id_so_user) {
		$this->db->from('t_oesp_oa');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_oa.id_oe_oa');
		$this->db->where('ejercicio_oa', $ejercicio);
		$this->db->where('id_so_tap_oa', $id_so_user);
		$this->db->where('aplica_oa', 1);
		return $this->db->count_all_results();
	}

	public function a_num_esp_iesa($ejercicio, $id_so_user) {
		$this->db->from('t_oesp_esda');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_esda.id_oe_esda');
		$this->db->where('ejercicio_esda', $ejercicio);
		$this->db->where('id_so_tap_esda', $id_so_user);
		$this->db->where('aplica_esda', 1);
		return $this->db->count_all_results();
	}

	public function a_num_esp_ffp($ejercicio, $id_so_user) {
		$this->db->from('t_oesp_ffp');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_ffp.id_oe_ffp');
		$this->db->where('ejercicio_ffp', $ejercicio);
		$this->db->where('id_so_tap_ffp', $id_so_user);
		$this->db->where('aplica_ffp', 1);
		return $this->db->count_all_results();
	}

	public function a_num_esp_sind($ejercicio, $id_so_user) {
		$this->db->from('t_oesp_sind');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_sind.id_oe_sind');
		$this->db->where('ejercicio_sind', $ejercicio);
		$this->db->where('id_so_tap_sind', $id_so_user);
		$this->db->where('aplica_sind', 1);
		return $this->db->count_all_results();
	}

	public function a_num_esp_pp($ejercicio, $id_so_user) {
		$this->db->from('t_oesp_pp');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_pp.id_oe_pp');
		$this->db->where('ejercicio_pp', $ejercicio);
		$this->db->where('id_so_tap_pp', $id_so_user);
		$this->db->where('aplica_pp', 1);
		return $this->db->count_all_results();
	}

	public function na_num_esp_muni($ejercicio, $id_so_user) {
		$this->db->from('t_oesp_muni');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_muni.id_oe_muni');
		$this->db->where('ejercicio_muni', $ejercicio);
		$this->db->where('id_so_tap_muni', $id_so_user);
		$this->db->where('aplica_muni', 0);
		return $this->db->count_all_results();
	}

	public function na_num_esp_pleg($ejercicio, $id_so_user) {
		$this->db->from('t_oesp_pleg');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_pleg.id_oe_pleg');
		$this->db->where('ejercicio_pleg', $ejercicio);
		$this->db->where('id_so_tap_pleg', $id_so_user);
		$this->db->where('aplica_pleg', 0);
		return $this->db->count_all_results();
	}

	public function na_num_esp_pjud($ejercicio, $id_so_user) {
		$this->db->from('t_oesp_pjud');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_pjud.id_oe_pjud');
		$this->db->where('ejercicio_pjud', $ejercicio);
		$this->db->where('id_so_tap_pjud', $id_so_user);
		$this->db->where('aplica_pjud', 0);
		return $this->db->count_all_results();
	}

	public function na_num_esp_oa($ejercicio, $id_so_user) {
		$this->db->from('t_oesp_oa');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_oa.id_oe_oa');
		$this->db->where('ejercicio_oa', $ejercicio);
		$this->db->where('id_so_tap_oa', $id_so_user);
		$this->db->where('aplica_oa', 0);
		return $this->db->count_all_results();
	}

	public function na_num_esp_iesa($ejercicio, $id_so_user) {
		$this->db->from('t_oesp_esda');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_esda.id_oe_esda');
		$this->db->where('ejercicio_esda', $ejercicio);
		$this->db->where('id_so_tap_esda', $id_so_user);
		$this->db->where('aplica_esda', 0);
		return $this->db->count_all_results();
	}

	public function na_num_esp_pp($ejercicio, $id_so_user) {
		$this->db->from('t_oesp_pp');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_pp.id_oe_pp');
		$this->db->where('ejercicio_pp', $ejercicio);
		$this->db->where('id_so_tap_pp', $id_so_user);
		$this->db->where('aplica_pp', 0);
		return $this->db->count_all_results();
	}

	public function na_num_esp_ffp($ejercicio, $id_so_user) {
		$this->db->from('t_oesp_ffp');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_ffp.id_oe_ffp');
		$this->db->where('ejercicio_ffp', $ejercicio);
		$this->db->where('id_so_tap_ffp', $id_so_user);
		$this->db->where('aplica_ffp', 0);
		return $this->db->count_all_results();
	}

	public function na_num_esp_aayjml($ejercicio, $id_so_user) {
		$this->db->from('t_oesp_aayjml');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_aayjml.id_oe_aayjml');
		$this->db->where('ejercicio_aayjml', $ejercicio);
		$this->db->where('id_so_tap_aayjml', $id_so_user);
		$this->db->where('aplica_aayjml', 0);
		return $this->db->count_all_results();
	}

	public function na_num_esp_sind($ejercicio, $id_so_user) {
		$this->db->from('t_oesp_sind');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_sind.id_oe_sind');
		$this->db->where('ejercicio_sind', $ejercicio);
		$this->db->where('id_so_tap_sind', $id_so_user);
		$this->db->where('aplica_sind', 0);
		return $this->db->count_all_results();
	}

}
