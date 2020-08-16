<?php //

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Home Extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'file', 'text'));
//        $this->load->model('Noticias_model');
    }

    public function index() {
        $dinamic_content['contenido'] = 'index';
//        $dinamic_content['noticias'] = $this->Noticias_model->obtener_lista_noticias();
         $this->load->view('template/fe_template', $dinamic_content);
    }
public function login() {
        $dinamic_content['contenido'] = 'login';
//        $dinamic_content['noticias'] = $this->Noticias_model->obtener_lista_noticias();
         $this->load->view('template/fe_template', $dinamic_content);
    }
 public function forbidden() {
        $dinamic_content['contenido'] = '403_forbidden_view';
//        $dinamic_content['noticias'] = $this->Noticias_model->obtener_lista_noticias();
         $this->load->view('template/fe_template', $dinamic_content);
    }
}
