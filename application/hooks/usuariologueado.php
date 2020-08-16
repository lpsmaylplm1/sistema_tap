<?php

class usuariologueado {
    /* Declaración de Métodos privados
      ___________________________________________ */

    private $ci; //Instanciar super objeto CodeIgniter
    private $allowed_controllers; //Controladores Permitidos nivel 1
    private $allowed_methods; //Métodos Permitidos nivel 1
    private $disallowed_methods; //Métodos No Permitidos nivel 1
  
    Public function __construct() {
        $this->ci = & get_instance();

        $this->disallowed_controllers = array ('login','home');
        $this->allowed_methods =  array ('logout');
        $this->disallowed_methods =  array ('login');
        $this->ci->load->helper('url');
    }

    public function check_access() {
        $class = $this->ci->router->class; //Obtenemos la clase actual
        $method = $this->ci->router->method; //Obtenemos el Método actual
        $session = $this->ci->session->userdata('login'); //Obtenemos el UserData

                if ($session && in_array($class, $this->disallowed_controllers)) { //Si la sesión está creada y y el controlador esta prohibido para usuarios autenticados
                    if (!in_array($method, $this->allowed_methods)) { //Si el método no esta prohibido para usuarios  autenticados
                        redirect(base_url('behome'));
                    }
                }

                if ($session && !in_array($class, $this->disallowed_controllers)) { //Si la sesión esta creada y el controlador esta prohibido para usuarios  autenticados
                    if (in_array($method, $this->disallowed_methods)) { //Si el método esta prohibido para usuarios no autenticados
                        redirect(base_url('behome'));
                    }
                }

        }
    }


