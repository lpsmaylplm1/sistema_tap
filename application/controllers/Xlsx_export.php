ajah<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Xlsx_export Extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Classes/PHPExcel.php');
        $this->load->model('consulta_model');
    }

    public function index() {
//$this->output->enable_profiler();
        //Recibir datos ocultos y checkbox
        $id_ente = $this->input->post('id_ente');
        $nombre_ente = $this->input->post('nombre_ente');
        $municipio = $this->input->post('municipio');
        $categoria = $this->input->post('categoria');
        $data = $this->input->post('data_fields');

        //recupere todos los campos de la base 
        $query = $this->consulta_model->exportar_campos($id_ente, $nombre_ente, $municipio, $categoria);


        // configuramos las propiedades del documento
        $this->phpexcel->getProperties()->setCreator("Comisión de Transparencia y Acceso a la Información Pública del Estado de Campeche")
                ->setLastModifiedBy("COTAIPEC")
                ->setTitle("Reporte Personalizado")
//                ->setSubject("Directorio de Entes Públicos del Estado de Campeche")
                ->setDescription("Reporte detallado de Tablas de Aplicabilidad")
                ->setKeywords("Tablas Aplicabilidad")
                ->setCategory("DCVSO");
//                            $this->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);

        foreach ($data as $campos => $item) :

            if ($item == 'ente') {
//         agregamos información a las celdas
                $i = 2;
                foreach ($query as $specfic_field) :
                    $this->phpexcel->setActiveSheetIndex(0)
                            ->setCellValue('A1', 'NÚM')
                            ->setCellValue('A' . $i, $specfic_field->id_ente)
                            ->setCellValue('B1', 'ENTE')
                            ->setCellValue('B' . $i, $specfic_field->nombre_ente)
                            ->setCellValue('C1', 'DIRECCIÓN')
                            ->setCellValue('C' . $i, $specfic_field->direccion)
                            ->setCellValue('D1', 'SIGLAS')
                            ->setCellValue('D' . $i, $specfic_field->siglas)
                            ->setCellValue('E1', 'CATEGORÍA')
                            ->setCellValue('E' . $i, $specfic_field->nombre_categoria);
                    $i = $i + 1;
                endforeach;
            }
            if ($item == 'titular_ep') {
//         agregamos información a las celdas
                $i = 2;
                foreach ($query as $specfic_field) :
                    $this->phpexcel->setActiveSheetIndex(0)
                            ->setCellValue('F1', 'TITULAR DEL ENTE')
                            ->setCellValue('F' . $i, $specfic_field->nombre . ' ' . $specfic_field->ap_p . ' ' . $specfic_field->ap_m)
                            ->setCellValue('G1', 'CARGO TITULAR')
                            ->setCellValue('G' . $i, $specfic_field->cargo_te)
                            ->setCellValue('H1', 'CORREO TITULAR ENTE')
                            ->setCellValue('H' . $i, $specfic_field->correo);
                    $i = $i + 1;
                endforeach;
            }

            if ($item == 'titular_ua') {
//         agregamos información a las celdas
                $i = 2;
                foreach ($query as $specfic_field) :
                    $this->phpexcel->setActiveSheetIndex(0)
                            ->setCellValue('I1', 'TITULAR UNIDAD DE ACCESO')
                            ->setCellValue('I' . $i, $specfic_field->nombre_tua . ' ' . $specfic_field->ap_p_tua . ' ' . $specfic_field->ap_m_tua)
                            ->setCellValue('J1', 'CARGO TITULAR U. A.')
                            ->setCellValue('J' . $i, $specfic_field->cargo_tua)
                            ->setCellValue('K1', 'CORREO TITULAR U. A.')
                            ->setCellValue('K' . $i, $specfic_field->email_tua);
                    $i = $i + 1;
                endforeach;
            }
            if ($item == 'contralor') {
//         agregamos información a las celdas
                $i = 2;
                foreach ($query as $specfic_field) :
                    $this->phpexcel->setActiveSheetIndex(0)
                            ->setCellValue('L1', 'CONTRALOR')
                            ->setCellValue('L' . $i, $specfic_field->nombre_cont . ' ' . $specfic_field->ap_p_cont . ' ' . $specfic_field->ap_m_cont)
                            ->setCellValue('M1', 'CARGO CONTRALOR')
                            ->setCellValue('M' . $i, $specfic_field->cargo_cont)
                            ->setCellValue('N1', 'CORREO CONTRALOR')
                            ->setCellValue('N' . $i, $specfic_field->email_cont);
                    $i = $i + 1;
                endforeach;
            }
            if ($item == 'titular_dp') {
//         agregamos información a las celdas
                $i = 2;
                foreach ($query as $specfic_field) :
                    $this->phpexcel->setActiveSheetIndex(0)
                            ->setCellValue('O1', 'TITULAR D. P.')
                            ->setCellValue('O' . $i, $specfic_field->nombre_dp . ' ' . $specfic_field->ap_p_dp . ' ' . $specfic_field->ap_m_dp)
                            ->setCellValue('P1', 'CARGO D. P.')
                            ->setCellValue('P' . $i, $specfic_field->cargo_dp)
                            ->setCellValue('Q1', 'CORREO D. P.')
                            ->setCellValue('Q' . $i, $specfic_field->email_dp);
                    $i = $i + 1;
                endforeach;
            }

        endforeach;

// Renombramos la hoja de trabajo y asignamor formato a las celdas específicas
        $array_column = array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P','Q');

        foreach ($array_column as $col):
            $this->phpexcel->getActiveSheet()
                    ->setTitle('Reporte Personalizado')
                    ->getColumnDimension($col)
                    ->setAutoSize(true);

            $this->phpexcel->getActiveSheet()
                    ->getStyle($col . '1')->getFont()->setBold(true)->setSize(12);
            $this->phpexcel->getActiveSheet()
                    ->getStyle($col . '1')->applyFromArray(
                    array(
                        'fill' => array(
                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                            'color' => array('rgb' => 'c7c1c1')
                        )
                    )
            );



        endforeach;

        /* configuramos el documento para que la hoja
          de trabajo número 0 sera la primera en mostrarse
          al abrir el documento */
        $this->phpexcel->setActiveSheetIndex(0);
        // redireccionamos la salida al navegador del cliente (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="ReporteEntes.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($this->phpexcel, 'Excel2007');
         
        $objWriter->save('php://output');
      
    }


}
