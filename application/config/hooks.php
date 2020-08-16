<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');
$hook['post_controller_constructor'] []=array(
    'class' => 'usuarionologueado', //Nombre de la clase en el archivo TODO EN MINÚSCULAS
    'function' => 'check_access',
    'filename' => 'usuarionologueado.php',  //Nombre de archivo TODO EN MINÚSCULAS
    'filepath' => 'hooks',
    'params' => array()
);
$hook['post_controller_constructor'] []= array(
    'class' => 'usuariologueado',//Nombre de la clase en el archivo TODO EN MINÚSCULAS
    'function' => 'check_access',
    'filename' => 'usuariologueado.php',//Nombre de archivo TODO EN MINÚSCULAS
    'filepath' => 'hooks',
    'params' =>array()
);
