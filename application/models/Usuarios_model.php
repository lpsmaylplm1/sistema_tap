<?php

class Usuarios_model Extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function validar_login($usuario, $password) {
		$this->db->where('usuario', $usuario);
		$this->db->where('user_activo', 1);
		$this->db->from('usuarios');
		$consulta = $this->db->get();
		if ($consulta->num_rows() > 0) {
			$this->db->where('usuario', $usuario);
			$this->db->where('password', $password);
			$this->db->from('usuarios');
			$consulta = $this->db->get();
			if ($consulta->num_rows() > 0) {
				$consulta = $consulta->row();
//				$ejercicio =  date("Y");
				$ejercicio =  2021;
				$newdata = array(
					'login' => 1,
					'nivel_user' => $consulta->nivel_user, // Admin - RUT
					'nombre_user' => $consulta->nombre_user, // Admin - RUT
					'ap_p' => $consulta->ap_p, // Admin - RUT
					'ap_m' => $consulta->ap_m, // Admin - RUT
					'correo' => $consulta->correo, // Admin - RUT
					'id_cat_user' => $consulta->id_cat_user, //   ID Categoria S.O   
					'id_so_user' => $consulta->id_so_user, //   ID Sujeto Obligado
					'id_ubicacion_user' => $consulta->id_ubicacion_user, //   ID Ubicacion Geogáfica
					'id_user' => $consulta->id_user, //   ID Ubicacion Geogáfica
					'ejercicio' => $ejercicio,
					'activo' => $consulta->user_activo,
				);
				$this->session->set_userdata($newdata);
				return TRUE;
			} else {
				$this->session->set_flashdata('mensaje', '<div style="color:#d22a2a"><i class="fa fa-times"></i> <i class="fa fa-key"></i> La contraseña es incorrecta</div>');
				return FALSE;
			}
		} else {
			$this->session->set_flashdata('mensaje', '<div style="color:#d22a2a"><i class="fa fa-times"></i> <i class="fa fa-user"></i>  El usuario  es incorrecto </div>');
			return FALSE;
		}
	}

	public function validar_usuario($user) {
		$this->db->select('*');
		$this->db->where('usuario', $user);
		$this->db->from('usuarios');
		$consulta = $this->db->get();
		return $consulta;
	}

	public function buscar_user($id_so_user) {
		$this->db->select('*');
		$this->db->where('id_so_user', $id_so_user);
		$this->db->where('nivel_user', 1);
		$this->db->from('usuarios');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function save_usuario($tipo_usuario, $id_cat_so, $id_nombre_so, $id_ayu, $usuario, $encryp_pass, $is_active) {
		$data = array(
			'nivel_user' => $tipo_usuario,
			'id_cat_user' => $id_cat_so,
			'id_so_user' => $id_nombre_so,
			'id_ubicacion_user' => $id_ayu,
			'usuario' => $usuario,
			'password' => $encryp_pass,
			'user_activo' => $is_active
		);
		$this->db->insert('usuarios', $data);
		return TRUE;
	}

	public function catalogo_municipios() {
		$this->db->select('*');
		$this->db->from('ayuntamientos');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function obtener_municipio($id_ayunt) {
		$this->db->select('*');
		$this->db->from('ayuntamientos');
		$this->db->where('id_ayuntamiento', $id_ayunt);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function obtener_so() {
		$this->db->select('*');
		$this->db->from('sujetos_obligados');
		$this->db->order_by('nombre_so', 'asc');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function select_so_cat($id_cat) {
		$this->db->select('*');
		$this->db->from('sujetos_obligados');
		$this->db->where('id_categoria_so', $id_cat);
		$this->db->order_by('nombre_so', 'asc');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function obtener_id_muni($id_cat) {
		$this->db->select('*');
		$this->db->from('sujetos_obligados');
		$this->db->where('id_so', $id_cat);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function select_ubicacion($id) {
		$this->db->select('*');
		$this->db->from('ayuntamientos');
		$this->db->where('id_ayuntamiento', $id);
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function select_nivel_user() {
		$this->db->select('*');
		$this->db->from('nivel_usr');
		$this->db->order_by('id_nivel_usr', 'asc');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function select_categoria() {
		$this->db->select('*');
		$this->db->from('categorias');
		$this->db->order_by('descrip_categoria', 'asc');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function obtener_usuarios() {
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where('user_activo', 1);
		$this->db->join('nivel_usr', 'nivel_usr.id_nivel_usr = usuarios.nivel_user');
		$this->db->join('categorias', 'categorias.id_categoria = usuarios.id_cat_user');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = usuarios.id_so_user');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function obtener_datos_usuario($id_user) {
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where('id_user', $id_user);
		$this->db->join('nivel_usr', 'nivel_usr.id_nivel_usr = usuarios.nivel_user');
		$this->db->join('categorias', 'categorias.id_categoria = usuarios.id_cat_user');
		$this->db->join('sujetos_obligados', 'sujetos_obligados.id_so = usuarios.id_so_user');
		$consulta = $this->db->get();
		return $consulta->result();
	}

	public function obtener_user($user) {
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where('usuario', $user);
		return $this->db->count_all_results();
	}

	public function actualizar_usuario($id_user, $tipo_usuario, $id_cat_so, $id_nombre_so, $id_ayu, $usuario, $encryp_pass, $is_active) {
		$data = array(
			'nivel_user' => $tipo_usuario,
			'id_cat_user' => $id_cat_so,
			'id_so_user' => $id_nombre_so,
			'id_ubicacion_user' => $id_ayu,
			'usuario' => $usuario,
			'password' => $encryp_pass,
			'user_activo' => $is_active
		);
		$this->db->where('id_user', $id_user);
		$this->db->update('usuarios', $data);
		return TRUE;
	}

	function delete_usuario($id_user) {
		$data = array(
			'id_user' => $id_user
		);

		$this->db->delete('usuarios', $data);
		return TRUE;
	}

	function update_name_usuario($id_user, $nombre_user, $ap_p_user, $ap_m_user, $correo_user) {
		$data = array(
			'nombre_user' => $nombre_user,
			'ap_p' => $ap_p_user,
			'ap_m' => $ap_m_user,
			'correo' => $correo_user
		);
		$this->db->where('id_so_user', $id_user);
		$this->db->where('nivel_user', 1);
		$this->db->update('usuarios', $data);
		return TRUE;
	}

}
