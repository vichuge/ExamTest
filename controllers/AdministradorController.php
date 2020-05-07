<?php

defined('BASEPATH') OR exit('No direct script access allowed');

include_once ('ConstIndex.php');

class AdministradorController extends CI_Controller {

    var $INDEX;

    public function __construct() {
        parent:: __construct();
        $this->load->helper('url');
        $this->load->model('Model_administrador');
        $constIndex = new ConstIndex();
        $this->INDEX = $constIndex->impIndex();
    }

    public function index() {
        $result['raiz'] = $this->INDEX;
    }

    public function crearExamen() {
        $result['raiz'] = $this->INDEX;
        $this->load->view('login', $result);
    }

    public function verCalificaciones() {
        //$result['nomrol']=$this->session->nomrol;
        //$result['idusuario']=$this->session->idusuario;
        
        $alumno = $this->input->get_post("idusuarioalumno");
        if (!isset($alumno)) {
            $alumno = 0;
        }

        $programa = $this->input->get_post("idprograma");
        if (!isset($programa)) {
            $programa = 0;
        }

        $dimension = $this->input->get_post("iddimension");
        if (!isset($dimension)) {
            $dimension = 0;
        }

        $pregunta = $this->input->get_post("idpregunta");
        if (!isset($pregunta)) {
            $pregunta = 0;
        }

        $calificador = $this->input->get_post("idusuariocalificador");
        if (!isset($calificador)) {
            $calificador = 0;
        }

        $nivel = $this->input->get_post("idnivel");
        if (!isset($nivel)) {
            $nivel = 99;
        }

        $examen = $this->input->get_post("idexamen");
        if (!isset($examen)) {
            $examen = 0;
        }

        $result['idalumno'] = $alumno;
        $result['idprograma'] = $programa;
        $result['iddimension'] = $dimension;
        $result['idpregunta'] = $pregunta;
        $result['idusuariocalificador'] = $calificador;
        $result['valnivel'] = $nivel;
        $result['examen'] = $examen;

        $result['raiz'] = $this->INDEX;
        $idexamen = $examen;
        $result['examenes']= $this->Model_administrador->listadoExamenes(0);
        $result['alumnos'] = $this->Model_administrador->listadoAlumnosPorExamen($idexamen);
        $result['programas'] = $this->Model_administrador->listadoProgramas(0);
        $result['dimensiones'] = $this->Model_administrador->listadoDimensiones();
        $result['preguntas'] = $this->Model_administrador->listadoPreguntas();
        $result['calificadores'] = $this->Model_administrador->listadoCalificadores();
        $result['niveles'] = $this->Model_administrador->listadoNiveles();
        $result['revisionesc'] = $this->Model_administrador->listadoCalificaciones($alumno, $programa, $dimension, $pregunta, $calificador, $nivel, $examen);
        $this->load->view('revisiones', $result);
    }

    public function generarExcelCali() {
        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
 
        $this->excel->getActiveSheet()->setTitle('Lista de calificaciones');
        $this->excel->getActiveSheet()->setCellValue('A1', "Folio Revisión");
        $this->excel->getActiveSheet()->setCellValue('B1', "Folio del Alumno");
        $this->excel->getActiveSheet()->setCellValue('C1', "Nombre del Alumno");
        $this->excel->getActiveSheet()->setCellValue('D1', "Programa");
        $this->excel->getActiveSheet()->setCellValue('E1', "Dimensión");
        $this->excel->getActiveSheet()->setCellValue('F1', "No Pregunta");
        $this->excel->getActiveSheet()->setCellValue('G1', "Pregunta");
        $this->excel->getActiveSheet()->setCellValue('H1', "Id calificador");
        $this->excel->getActiveSheet()->setCellValue('I1', "Nombre del calificador");
        $this->excel->getActiveSheet()->setCellValue('J1', "Calificación");
        $this->excel->getActiveSheet()->setCellValue('K1', "Fecha de envio");
        
        $this->excel->getActiveSheet()->freezePane('A2');
        
        $alumno = $this->input->get_post("idusuarioalumno");
        if (!isset($alumno)) {
            $alumno = 0;
        }
        $programa = $this->input->get_post("idprograma");
        if (!isset($programa)) {
            $programa = 0;
        }
        $dimension = $this->input->get_post("iddimension");
        if (!isset($dimension)) {
            $dimension = 0;
        }
        $pregunta = $this->input->get_post("idpregunta");
        if (!isset($pregunta)) {
            $pregunta = 0;
        }
        $calificador = $this->input->get_post("idusuariocalificador");
        if (!isset($calificador)) {
            $calificador = 0;
        }
        $nivel = $this->input->get_post("idnivel");
        if (!isset($nivel)) {
            $nivel = 99;
        }
        $examen = $this->input->get_post("idexamen");
        if (!isset($examen)) {
            $examen = 0;
        }
        //$idexamen = 1;
        $calificaciones= $this->Model_administrador->listadoCalificaciones($alumno, $programa, $dimension, $pregunta, $calificador, $nivel, $examen);
        
        $i=2;
        if($calificaciones != null){
            foreach ($calificaciones as $key => $value) {
            $this->excel->getActiveSheet()->setCellValue('A' . $i, $calificaciones[$key]['folrevision']);
            $this->excel->getActiveSheet()->setCellValue('B' . $i, $calificaciones[$key]['folusuario']);
            $this->excel->getActiveSheet()->setCellValue('C' . $i, $calificaciones[$key]['nomalumno'].' '.$calificaciones[$key]['segnomusuario'].' '.$calificaciones[$key]['apeusuario'].' '.$calificaciones[$key]['lastusuario']);
            $this->excel->getActiveSheet()->setCellValue('D' . $i, $calificaciones[$key]['nomprograma']);
            $this->excel->getActiveSheet()->setCellValue('E' . $i, $calificaciones[$key]['nomdimension']);
            $this->excel->getActiveSheet()->setCellValue('F' . $i, $calificaciones[$key]['idpregunta']);
            $this->excel->getActiveSheet()->setCellValue('G' . $i, $calificaciones[$key]['txtpregunta']);
            $this->excel->getActiveSheet()->setCellValue('H' . $i, $calificaciones[$key]['idcalificador']);
            $this->excel->getActiveSheet()->setCellValue('I' . $i, $calificaciones[$key]['nomcalificador']);
            $this->excel->getActiveSheet()->setCellValue('J' . $i, $calificaciones[$key]['valcalificacion']);
            $this->excel->getActiveSheet()->setCellValue('K' . $i, $calificaciones[$key]['dtenviado']);
            $i++;
            }
        }
        
        //$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->setActiveSheetIndex(0);
        $fechaObj = new DateTime('NOW');
        $fechaMod = $fechaObj->format('Y-m-d H:i:s');
        $filename = 'lista_calificaciones' . $fechaMod . '.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');      
    }

    public function asignarRev() {
        //listado de examenes
        $result['examenes'] = $this->Model_administrador->listadoExamenes($id = "");
        //listado de calificadores
        $result['calificadores'] = $this->Model_administrador->listadoCalificadores();
        //listado de alumnos de acuerdo al examen solicitado
        $idexamen = 1;
        $result['alumnos'] = $this->Model_administrador->listadoAlumnosPorExamen($idexamen);
        $result['raiz'] = $this->INDEX;
        $this->load->view('asignarcal', $result);
    }

    public function listRev($numerin) { 
        //$idexamen=$_POST['idexamen'];
        //$idusuariocalificador=$_POST['idusuariocalificador'];
        
        $alumno = $this->input->get_post("idusuarioalumno");
        if (!isset($alumno)) {
            $alumno = 0;
        }

        $calificador = $this->input->get_post("idcalificador");
        if (!isset($calificador)) {
            $calificador = 0;
        }
        
        $examen = $this->input->get_post("idexamen");
        if (!isset($examen)) {
            $examen = 0;
        }

        $result['idalumno'] = $alumno;
        $result['idusuariocalificador'] = $calificador;
        $result['idexamen']=$examen;
        
        $result['raiz'] = $this->INDEX;
        $result['numerin'] = $numerin;
        
        $result['alumnos'] = $this->Model_administrador->listadoAlumnosPorExamen("");
        $result['calificadores'] = $this->Model_administrador->listadoCalificadores();
        $result['examenes']=$this->Model_administrador->listadoExamenes("");
        
        $result['revisiones'] = $this->Model_administrador->listadoRevisionesConFiltro($alumno,$calificador,$examen);
        $this->load->view('revisionesasignadas', $result);
    }

    public function generarExcelCali2() {
        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        
        $this->excel->getActiveSheet()->setTitle('Listado de revisiones asignadas');
        $this->excel->getActiveSheet()->setCellValue('A1', "Fecha");
        $this->excel->getActiveSheet()->setCellValue('B1', "Examen");
        $this->excel->getActiveSheet()->setCellValue('C1', "Folio del alumno");
        $this->excel->getActiveSheet()->setCellValue('D1', "Calificador");
        $this->excel->getActiveSheet()->setCellValue('E1', "Activo");
        
        $this->excel->getActiveSheet()->freezePane('A2');
        
        $alumno = $this->input->get_post("idusuarioalumno");
        if (!isset($alumno)) {
            $alumno = 0;
        }

        $calificador = $this->input->get_post("idcalificador");
        if (!isset($calificador)) {
            $calificador = 0;
        }
        
        $examen = $this->input->get_post("idexamen");
        if (!isset($examen)) {
            $examen = 0;
        }

        $revisiones=$this->Model_administrador->listadoRevisionesConFiltro($alumno,$calificador,$examen);
        $i=2;

        if($revisiones != null){
            foreach ($revisiones as $key => $value) {
            $this->excel->getActiveSheet()->setCellValue('A' . $i, $revisiones[$key]['dtrevision']);
            $this->excel->getActiveSheet()->setCellValue('B' . $i, $revisiones[$key]['examen']);
            $this->excel->getActiveSheet()->setCellValue('C' . $i, $revisiones[$key]['folio_alumno']);
            $this->excel->getActiveSheet()->setCellValue('D' . $i, $revisiones[$key]['calificador']);
            if($revisiones[$key]['estatus']==1){
                $this->excel->getActiveSheet()->setCellValue('E' . $i, "Si");
            }else{
                $this->excel->getActiveSheet()->setCellValue('E' . $i, "No");
            }
            
            $i++;
            }
        }
        
        
        //$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->setActiveSheetIndex(0);
        $fechaObj = new DateTime('NOW');
        $fechaMod = $fechaObj->format('Y-m-d H:i:s');
        $filename = 'lista_calificaciones' . $fechaMod . '.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
        
    }

    public function altaRevisores() {
        $result['raiz'] = $this->INDEX;
        $calificador = $this->input->get_post("idusuariocalificador");
        $examen = $this->input->get_post("idexamen");
        $alumnos = "";
        $alumnos = $this->input->get_post("check-list");
        $result['insertar'] = $this->Model_administrador->asignarRevisiones($calificador, $examen, $alumnos);
        $this->load->view('altarevisiones', $result);
    }

    public function eliminarRevision($idrevision) {
        //Revisar que se tenga una sesión de administrador vic 7may18
        $nomrol = $this->session->nomrol;
        $idusuario = $this->session->idusuario;
        if ($nomrol != "administrador") {
            header('Location: ' . $raiz . '');
        }
        //End
        
        $result['raiz'] = $this->INDEX;
        $result['eliminar'] = $this->Model_administrador->eliminarRevision($idrevision);
        $this->load->view('elimrevision', $result);
    }

    public function activarRevision($idrevision) {
        //Revisar que se tenga una sesión de administrador vic 7may18
        $nomrol = $this->session->nomrol;
        $idusuario = $this->session->idusuario;
        if ($nomrol != "administrador") {
            header('Location: ' . $raiz . '');
        }
        //End

        $result['raiz'] = $this->INDEX;
        $result['activar'] = $this->Model_administrador->activarRevision($idrevision);
        $this->load->view('activrevision', $result);
    }

    public function generarExcelEjemplo() {
        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('test worksheet');
        //set cell A1 content with some text
        $this->excel->getActiveSheet()->setCellValue('A1', 'This is just some text value');
        //change the font size
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        //merge cell A1 until D1
        $this->excel->getActiveSheet()->mergeCells('A1:D1');
        //set aligment to center for that merged cell (A1 to D1)
        $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $filename = 'just_some_random_name.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }

    public function generarExcelEjemplo2() {
        //load our new PHPExcel library
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        /* $this->excel->getActiveSheet()->setTitle('test worksheet');
          //set cell A1 content with some text
          $this->excel->getActiveSheet()->setCellValue('A1', 'This is just some text value');
          //change the font size
          $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
          //make the font become bold
          $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
          //merge cell A1 until D1
          $this->excel->getActiveSheet()->mergeCells('A1:D1'); */
        //set aligment to center for that merged cell (A1 to D1)

        $this->excel->getActiveSheet()->setTitle('Especificadores');
        $this->excel->getActiveSheet()->setCellValue('A1', "Nombre Especfificador");
        $this->excel->getActiveSheet()->setCellValue('B1', "Nombre completo");
        $this->excel->getActiveSheet()->setCellValue('C1', "Estado");
        $this->excel->getActiveSheet()->setCellValue('D1', "Fecha último acceso");
        $this->excel->getActiveSheet()->setCellValue('E1', "En proceso");
        $this->excel->getActiveSheet()->setCellValue('F1', "Para 1a revisión");
        $this->excel->getActiveSheet()->setCellValue('G1', "Para 2da revisión");
        $this->excel->getActiveSheet()->setCellValue('H1', "En 1a revisión");
        $this->excel->getActiveSheet()->setCellValue('I1', "En 2da revisión");
        $this->excel->getActiveSheet()->setCellValue('J1', "Para corrección");
        $this->excel->getActiveSheet()->setCellValue('K1', "En corrección");
        $this->excel->getActiveSheet()->setCellValue('L1', "Quemado");
        $this->excel->getActiveSheet()->setCellValue('M1', "Rechazado");
        $this->excel->getActiveSheet()->setCellValue('N1', "Condicionado a 2da revisión");
        $this->excel->getActiveSheet()->setCellValue('O1', "Condicionado a corrección");
        $this->excel->getActiveSheet()->setCellValue('P1', "Válido");
        $this->excel->getActiveSheet()->setCellValue('Q1', "TOTAL");
        $this->excel->getActiveSheet()->freezePane('A2');
        $lista2 = $this->Model_revisor->UsuariosEspecificadoresall();
        $i = 2;
        //print_r($lista2);die();
        foreach ($lista2 as $keylis => $value) {
            //$this->excel->getActiveSheet()->setCellValue('A' . $i, $lista[$keylis]['iUsuarioId']);
            $this->excel->getActiveSheet()->setCellValue('A' . $i, $lista2[$keylis]['cUsuarioNombre']);
            $this->excel->getActiveSheet()->setCellValue('B' . $i, $lista2[$keylis]['cUsuarioPrimerNombre'] . ' ' . $lista2[$keylis]['cUsuarioSegundoNombre'] . ' ' . $lista2[$keylis]['cUsuarioPrimerApellido'] . ' ' . $lista2[$keylis]['cUsuarioSegundoApellido']);
            $this->excel->getActiveSheet()->setCellValue('C' . $i, $lista2[$keylis]['Estado']);
            $this->excel->getActiveSheet()->setCellValue('D' . $i, $lista2[$keylis]['dtFechaUltimoAcceso']);
            $this->excel->getActiveSheet()->setCellValue('E' . $i, $lista2[$keylis]['en_proceso']);
            $this->excel->getActiveSheet()->setCellValue('F' . $i, $lista2[$keylis]['p_1a_revision']);
            $this->excel->getActiveSheet()->setCellValue('G' . $i, $lista2[$keylis]['p_2da_revision']);
            $this->excel->getActiveSheet()->setCellValue('H' . $i, $lista2[$keylis]['en_1a_revision']);
            $this->excel->getActiveSheet()->setCellValue('I' . $i, $lista2[$keylis]['en_2da_revision']);
            $this->excel->getActiveSheet()->setCellValue('J' . $i, $lista2[$keylis]['para_correccion']);
            $this->excel->getActiveSheet()->setCellValue('K' . $i, $lista2[$keylis]['en_correccion']);
            $this->excel->getActiveSheet()->setCellValue('L' . $i, $lista2[$keylis]['quemado']);
            $this->excel->getActiveSheet()->setCellValue('M' . $i, $lista2[$keylis]['rechazado']);
            $this->excel->getActiveSheet()->setCellValue('N' . $i, $lista2[$keylis]['condicionado_2da_revision']);
            $this->excel->getActiveSheet()->setCellValue('O' . $i, $lista2[$keylis]['condicionado_correccion']);
            $this->excel->getActiveSheet()->setCellValue('P' . $i, $lista2[$keylis]['valido']);
            $this->excel->getActiveSheet()->setCellValue('Q' . $i, $lista2[$keylis]['total']);

            $i++;
        }
        //$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->setActiveSheetIndex(0);
        $fechaObj = new DateTime('NOW');
        $fechaMod = $fechaObj->format('Y-m-d H:i:s');
        $filename = 'resumen_especificadores ' . $fechaMod . '.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }

    public function refresh() {
        $idexamen = $this->input->get_post("idexamen");
        $alumnos = $this->Model_administrador->listadoAlumnosPorExamen($idexamen);
        //print_r($idexamen);die();
        echo'
            <table id="data-table-simple" class="responsive-table display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Folio</th>
                        <th>Nombre alumno</th>
                        <th>Número de respuestas</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Folio</th>
                        <th>Nombre alumno</th>
                        <th>Número de respuestas</th>
                    </tr>
                </tfoot>
                <tbody id="tbody">';
        foreach ($alumnos as $key => $value) {
            if($alumnos[$key]['segnomusuario'] != "generico"){
                if($alumnos[$key]['numrespuestas'] < 4){
                    $disabled="disabled";
                }else{
                    $disabled="";
                }
                echo'
                        <tr>
                            <td>
                                <p>
                                    <input type="checkbox" '.$disabled.' id="test' . $alumnos[$key]['idusuario'] . '" value="' . $alumnos[$key]['idusuario'] . '" name="check-list['.$alumnos[$key]['idusuario'].']" />
                                    <label for="test' . $alumnos[$key]['idusuario'] . '"></label>
                                </p>
                            </td>
                            <td>' . $alumnos[$key]['folusuario'] . '</td>
                            <td>' . $alumnos[$key]['nomusuario'] . ' ' . $alumnos[$key]['segnomusuario'] . ' ' . $alumnos[$key]['apeusuario'] . ' ' . $alumnos[$key]['lastusuario'] . '</td>
                            <td>' . $alumnos[$key]['numrespuestas'] . '</td>
                        </tr>';
            }
        }
        echo'   </tbody>
            </table>';
    }

    public function usuarios(){
        
        $result['raiz'] = $this->INDEX;

        $examen = $this->input->get_post("idexamen");
        if (!isset($examen)) {
            $examen = 0;
        }

        $programa = $this->input->get_post("idprograma");
        if (!isset($programa)) {
            $programa = 0;
        }

        $result['idprograma'] = $programa;
        $result['idexamen'] = $examen;
        $result['programas'] = $this->Model_administrador->listadoProgramas(0);
        $result['examenes'] = $this->Model_administrador->listadoExamenes(0);

        $usuarios=$this->Model_administrador->listadoUsuarios($examen,$programa);
        $result['usuarios']=$usuarios;
        $this->load->view('listusuarios', $result);
    }

    public function pdfusuario($id){
        $this->load->library('pdfgenerator');
            $usuario=$this->Model_administrador->impusuario($id);
            /*
            <h1>Fulano de tal</h1>
            <div style="page-break-after:always;"></div>
            <p>Usuario:UPN000</p>
            <p>Password: 123456</p>
            */
            $html="";
            //$html="<div class='row' text-align='center'>";
            $html.="<h1>".$usuario[0]['nomusuario'].' '.$usuario[0]['segnomusuario'].' '.$usuario[0]['apeusuario'].' '.$usuario[0]['lastusuario']."</h1>";
            $html.="<div style='page-break-after:always;'></div>";
            $html.="<p>Usuario:".$usuario[0]['usuario']."</p>";
            $html.="<p>Password:".$usuario[0]['decrypt']."</p>";
            $html.="<div style='page-break-after:always;'></div>";
            //$html="</div>";

            $filename="Rev".$usuario[0]['folusuario'];
            $this->pdfgenerator->generate($html, $filename, true, 'letter', 'portrait'); //antes 'A4' 'landscape'
    }
    
    public function pdfusuarios(){
        $this->load->library('pdfgenerator');
        
        $examen = $this->input->get_post("idexamen");
        if (!isset($examen)) {
            $examen = 0;
        }

        $programa = $this->input->get_post("idprograma");
        if (!isset($programa)) {
            $programa = 0;
        }
        
        $usuarios=$this->Model_administrador->listadousuarios($examen,$programa);
        /*
        <h1>Fulano de tal</h1>
        <div style="page-break-after:always;"></div>
        <p>Usuario:UPN000</p>
        <p>Password: 123456</p>
        */
        $html="";
        //$html="<div class='row' text-align='center'>";
        if($usuarios != null){
            foreach ($usuarios as $key => $value) {
            $html.="<h1 style='text-align:center;vertical-align:middle;'>".$usuarios[$key]['nomusuario'].' '.$usuarios[$key]['segnomusuario'].' '.$usuarios[$key]['apeusuario'].' '.$usuarios[$key]['lastusuario']."</h1>";
            $html.="<div style='page-break-after:always;'></div>";
            $html.="<p style='text-align:center;vertical-align:middle;'>Usuario: ".$usuarios[$key]['usuario']."<br/>";
            $html.="Password: ".$usuarios[$key]['decrypt']."</p>";
            $html.="<div style='page-break-after:always;'></div>";
            }
        }
        
        //$html="</div>";
        
        $filename="Listado de cartas";
        $this->pdfgenerator->generate($html, $filename, true, 'letter', 'portrait'); //antes 'A4' 'landscape'
    }

    public function perfilusuariosesion($id){
        if($this->session->idrol != 1){
            $this->load->view('login', $result);
        }
        
        if($id==0){
            $idusuario=$this->session->idusuario;
        }else{
            $idusuario=$id;
        }
        
        $perfil=$this->Model_administrador->perfilusuario($idusuario);
        $result['programas']=$this->Model_administrador->listadoProgramas(0);
        $result['examenes']=$this->Model_administrador->listadoExamenes(0);
        $result['roles']=$this->Model_administrador->listadoRoles(0);
        $result['perfil']=$perfil;
        $result['id']=$idusuario;
        $result['raiz'] = $this->INDEX;
        $this->load->view('miperfil', $result);
    }
    
    public function crearusuariosesion(){
        $result['programas']=$this->Model_administrador->listadoProgramas(0);
        $result['examenes']=$this->Model_administrador->listadoExamenes(0);
        $result['roles']=$this->Model_administrador->listadoRoles(0);
        $result['id']=0;
        $result['raiz'] = $this->INDEX;
        $this->load->view('miperfil', $result);
    }
    
    public function creareditarusuario(){
        $result['raiz'] = $this->INDEX;
        /*
        $alumno = $this->input->get_post("idusuarioalumno");
        if (!isset($alumno)) {
            $alumno = 0;
        }
        */
        $idusuario=$this->input->get_post("idusuario");
        if(!isset($idusuario)){
            $idusuario=0;
        }
        
        $first_name=$this->input->get_post("first_name");
        if(!isset($first_name)){
            $first_name="";
        }
        
        $second_name=$this->input->get_post("second_name");
        if(!isset($second_name)){
            $second_name="";
        }
        
        $last_name=$this->input->get_post("last_name");
        if(!isset($last_name)){
            $last_name="";
        }
        
        $mother_name=$this->input->get_post("mother_name");
        if(!isset($mother_name)){
            $mother_name="";
        }
        
        $email=$this->input->get_post("email");
        if(!isset($email)){
            $email="";
        }
        
        $curp=$this->input->get_post("curp");
        if(!isset($curp)){
            $curp="";
        }
        
        $user_name=$this->input->get_post("user_name");
        if(!isset($user_name)){
            $user_name="";
        }
        
        $idrol=$this->input->get_post("idrol");
        if(!isset($idrol) || $idrol ==0){
            $idrol=1;
        }
        
        if($idrol == 4){
           $idprograma=$this->input->get_post("idprograma");
            if(!isset($idprograma)){
                $idprograma=0;
            } 
        }else{
            $idprograma=1;
        }
        
        if($idrol == 4){
            $idexamen=$this->input->get_post("idexamen");
            if(!isset($idexamen)){
                $idexamen=0;
            }
        }else{
            $idexamen=4;
        }
         
        $password=$this->input->get_post("password");
        if(!isset($password)){
            $password=0;
        }
        $folio=$this->input->get_post("folio");
        if(!isset($folio)){
            $folio="";
        }

        $this->Model_administrador->editarcrearusuario($idusuario,$first_name,$second_name,$last_name,$mother_name,$email,$curp,$user_name,$idrol,$idprograma,$idexamen,$password,$folio);

        $this->load->view('home', $result);

    }
}