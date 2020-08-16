<?php

class Reportes_model Extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	public function groupt_oc_full($ejercicio, $data_cat) { //Generador de filas por grupo
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oc.id_so_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('aplica_oc', 1);
		$this->db->group_by('id_so_oc');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function full_tables_oc($ejercicio) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oc.id_so_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('aplica_oc', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function full_tables_oc_noapl($ejercicio) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('aplica_oc', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}
	
	//------------------------------------------------PODER EJECUTIVO --------------------------------------------------
	public function groupt_ocpejec($ejercicio, $data_cat) { //Generador de filas por grupo
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oc.id_so_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 1);
		$this->db->group_by('id_so_oc');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_ocpejec_apl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oc.id_so_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_ocpejec_noapl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_esppejec_apl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oesp_pejec');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_pejec.id_oe_pe');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oesp_pejec.id_so_tap_pejec');
		$this->db->where('ejercicio_pejec', $ejercicio);
		$this->db->where('id_categoría_so_pejec', $data_cat);
		$this->db->where('t_oesp_pejec.aplica_oesp', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_esppejec_noapl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oesp_pejec');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_pejec.id_oe_pe');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oesp_pejec.id_so_tap_pejec');
		$this->db->where('ejercicio_pejec', $ejercicio);
		$this->db->where('id_categoría_so_pejec', $data_cat);
		$this->db->where('t_oesp_pejec.aplica_oesp', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	//
	//------------------------------------------------MUNICIPIOS --------------------------------------------------
	//
	public function groupt_ocmuni($ejercicio, $data_cat) { //Generador de filas por grupo
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oc.id_so_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 1);
		$this->db->group_by('id_so_oc');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_ocmuni_apl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oc.id_so_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_ocmuni_noapl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_espmuni_apl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oesp_muni');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_muni.id_oe_muni');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oesp_muni.id_so_tap_muni');
		$this->db->where('ejercicio_muni', $ejercicio);
		$this->db->where('id_categoría_so_muni', $data_cat);
		$this->db->where('aplica_muni', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_espmuni_noapl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oesp_muni');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_muni.id_oe_muni');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oesp_muni.id_so_tap_muni');
		$this->db->where('ejercicio_muni', $ejercicio);
		$this->db->where('id_categoría_so_muni', $data_cat);
		$this->db->where('aplica_muni', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

//
	//------------------------------------------------PODER LEGISLATIVO --------------------------------------------------
	//
	public function groupt_ocpleg($ejercicio, $data_cat) { //Generador de filas por grupo
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oc.id_so_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 1);
		$this->db->group_by('id_so_oc');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_ocpleg_apl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oc.id_so_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_ocpleg_noapl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_esppleg_apl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oesp_pleg');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_pleg.id_oe_pleg');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oesp_pleg.id_so_tap_pleg');
		$this->db->where('ejercicio_pleg', $ejercicio);
		$this->db->where('id_categoría_so_pleg', $data_cat);
		$this->db->where('aplica_pleg', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_esppleg_noapl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oesp_pleg');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_pleg.id_oe_pleg');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oesp_pleg.id_so_tap_pleg');
		$this->db->where('ejercicio_pleg', $ejercicio);
		$this->db->where('id_categoría_so_pleg', $data_cat);
		$this->db->where('aplica_pleg', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

//
	//------------------------------------------------PODER JUDICIAL --------------------------------------------------
	//
	public function groupt_ocpjud($ejercicio, $data_cat) { //Generador de filas por grupo
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oc.id_so_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 1);
		$this->db->group_by('id_so_oc');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_ocpjud_apl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oc.id_so_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_ocpjud_noapl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_esppjud_apl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oesp_pjud');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_pjud.id_oe_pjud');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oesp_pjud.id_so_tap_pjud');
		$this->db->where('ejercicio_pjud', $ejercicio);
		$this->db->where('id_categoría_so_pjud', $data_cat);
		$this->db->where('aplica_pjud', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_espjud_noapl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oesp_pjud');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_pjud.id_oe_pjud');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oesp_pjud.id_so_tap_pjud');
		$this->db->where('ejercicio_pjud', $ejercicio);
		$this->db->where('id_categoría_so_pjud', $data_cat);
		$this->db->where('aplica_pjud', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	//
	//------------------------------------------------ORGANISMOS AUTÓNOMOS --------------------------------------------------
	//
	public function groupt_ocoa($ejercicio, $data_cat) { //Generador de filas por grupo
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oc.id_so_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 1);
		$this->db->group_by('id_so_oc');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_ocoa_apl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oc.id_so_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_ocoa_noapl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_espoa_apl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oesp_oa');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_oa.id_oe_oa');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oesp_oa.id_so_tap_oa');
		$this->db->where('ejercicio_oa', $ejercicio);
		$this->db->where('id_categoria_so_oa', $data_cat);
		$this->db->where('aplica_oa', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_espoa_noapl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oesp_oa');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_oa.id_oe_oa');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oesp_oa.id_so_tap_oa');
		$this->db->where('ejercicio_oa', $ejercicio);
		$this->db->where('id_categoria_so_oa', $data_cat);
		$this->db->where('aplica_oa', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	//
	//------------------------------------------------ORGANISMOS AUTÓNOMOS --------------------------------------------------
	//
	public function groupt_ocesda($ejercicio, $data_cat) { //Generador de filas por grupo
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oc.id_so_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 1);
		$this->db->group_by('id_so_oc');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_ocesda_apl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oc.id_so_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_ocesda_noapl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_espesda_apl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oesp_esda');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_esda.id_oe_esda');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oesp_esda.id_so_tap_esda');
		$this->db->where('ejercicio_esda', $ejercicio);
		$this->db->where('id_categoria_so_esda', $data_cat);
		$this->db->where('aplica_esda', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_espesda_noapl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oesp_esda');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_esda.id_oe_esda');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oesp_esda.id_so_tap_esda');
		$this->db->where('ejercicio_esda', $ejercicio);
		$this->db->where('id_categoria_so_esda', $data_cat);
		$this->db->where('aplica_esda', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	//
	//------------------------------------------------PARTIDOS POLÍTICOS --------------------------------------------------
	//
	public function groupt_ocpp($ejercicio, $data_cat) { //Generador de filas por grupo
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oc.id_so_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 1);
		$this->db->group_by('id_so_oc');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_ocpp_apl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oc.id_so_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_ocpp_noapl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_esppp_apl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oesp_pp');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_pp.id_oe_pp');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oesp_pp.id_so_tap_pp');
		$this->db->where('ejercicio_pp', $ejercicio);
		$this->db->where('id_categoria_so_pp', $data_cat);
		$this->db->where('aplica_pp', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_esppp_noapl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oesp_pp');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_pp.id_oe_pp');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oesp_pp.id_so_tap_pp');
		$this->db->where('ejercicio_pp', $ejercicio);
		$this->db->where('id_categoria_so_pp', $data_cat);
		$this->db->where('aplica_pp', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

//
	//------------------------------------------------FIDEICOMISOS  Y FONDOS PÚBLICOS--------------------------------------------------
	//
	public function groupt_ocffp($ejercicio, $data_cat) { //Generador de filas por grupo
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oc.id_so_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 1);
		$this->db->group_by('id_so_oc');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_ocffp_apl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oc.id_so_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_ocffp_noapl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_espffp_apl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oesp_ffp');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_ffp.id_oe_ffp');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oesp_ffp.id_so_tap_ffp');
		$this->db->where('ejercicio_ffp', $ejercicio);
		$this->db->where('id_categoria_so_ffp', $data_cat);
		$this->db->where('aplica_ffp', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_espffp_noapl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oesp_ffp');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_ffp.id_oe_ffp');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oesp_ffp.id_so_tap_ffp');
		$this->db->where('ejercicio_ffp', $ejercicio);
		$this->db->where('id_categoria_so_ffp', $data_cat);
		$this->db->where('aplica_ffp', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}
//
	//------------------------------------------------AUTORIDADES ADMINISTRATIVAS Y JURISDICCIONALES EN MATERIA LABORAL--------------------------------------------------
	//
	public function groupt_ocaayjml($ejercicio, $data_cat) { //Generador de filas por grupo
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oc.id_so_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 1);
		$this->db->group_by('id_so_oc');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_ocaayjml_apl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oc.id_so_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_ocaayjml_noapl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_espaayjml_apl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oesp_aayjml');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_aayjml.id_oe_aayjml');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oesp_aayjml.id_so_tap_aayjml');
		$this->db->where('ejercicio_aayjml', $ejercicio);
		$this->db->where('id_categoria_so_aayjml', $data_cat);
		$this->db->where('aplica_aayjml', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_espaayjml_noapl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oesp_aayjml');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_aayjml.id_oe_aayjml');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oesp_aayjml.id_so_tap_aayjml');
		$this->db->where('ejercicio_aayjml', $ejercicio);
		$this->db->where('id_categoria_so_aayjml', $data_cat);
		$this->db->where('aplica_aayjml', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}
	//
	//------------------------------------------------SINDICATOS-------------------------------------------------
	//
	public function groupt_ocsind($ejercicio, $data_cat) { //Generador de filas por grupo
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oc.id_so_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 1);
		$this->db->group_by('id_so_oc');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_ocsind_apl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oc.id_so_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_ocsind_noapl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oc');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oc.id_fc_oc');
		$this->db->where('ejercicio_oc', $ejercicio);
		$this->db->where('id_categoria_so_oc', $data_cat);
		$this->db->where('aplica_oc', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_espsind_apl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oesp_sind');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_sind.id_oe_sind');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oesp_sind.id_so_tap_sind');
		$this->db->where('ejercicio_sind', $ejercicio);
		$this->db->where('id_categoria_so_sind', $data_cat);
		$this->db->where('aplica_sind', 1);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function ftables_espsind_noapl($ejercicio, $data_cat) {
		$this->db->select('*');
		$this->db->from('t_oesp_sind');
		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_sind.id_oe_sind');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = t_oesp_sind.id_so_tap_sind');
		$this->db->where('ejercicio_sind', $ejercicio);
		$this->db->where('id_categoria_so_sind', $data_cat);
		$this->db->where('aplica_sind', 0);
		$consulta = $this->db->get();
		return $consulta->result();
	}
	
public function load_cat_report( $data_cat) {
		$this->db->select('*');
		$this->db->from('categorias');
//		$this->db->join('fracciones', 'fracciones.id_fraccion = t_oesp_sind.id_oe_sind');
		$this->db->where('id_categoria', $data_cat);
		$consulta = $this->db->get();
		return $consulta->result();
	}
}
