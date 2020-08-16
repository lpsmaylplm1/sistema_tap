<?php

class usuarionologueado {
	/* Declaración de Métodos privados
	  ________________METODOS PRIVADOS___________________________ */

	private $ci; //Super objeto CodeIgniter
	private $allowed_controllers; //Controladores Permitidos
	private $allowed_methods; //Métodos Permitidos
	private $disallowed_methods; //Métodos No Permitidos

	Public function __construct() {
		$this->ci = & get_instance(); //Crear la instancia del super objeto codeigniter

		$this->allowed_controllers = array ('home', 'login','forbidden'); //Acceso a Controlador Consultas, Home a usuarios no autenticados
		$this->allowed_methods = array ('login', ''); //Permitir acceso al método Login
		$this->disallowed_methods =  array ('logout'); //No autenticado no tiene acceso a Método LogOut

		$this->ci->load->helper('url'); //Carga del Helper URL
	}

	public function check_access() {
		$class = $this->ci->router->class; //Obtenemos la clase actual
		$method = $this->ci->router->method; //Obtenemos el Método actual
		$session = $this->ci->session->userdata('login'); //Obtenemos el UserData


		if (empty($session) && !in_array($class, $this->allowed_controllers)) { //Si la sesión está vacía y y el controlador esta prohibido para usuarios no autenticados
			if (!in_array($method, $this->allowed_methods)) { //Si el método esta prohibido para usuarios no autenticados
				redirect(base_url('home/forbidden'));
			}
		}

		if (empty($session) && in_array($class, $this->allowed_controllers)) { //Si la sesión esta vacía y el controlador esta permitido para usuarios no autenticados
			if (in_array($method, $this->disallowed_methods)) { //Si el método esta prohibido para usuarios no autenticados
				redirect(base_url('home/forbidden'));
			}
		}
	}

}
