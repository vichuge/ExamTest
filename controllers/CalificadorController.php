<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once ('ConstIndex.php');

class CalificadorController extends CI_Controller {

	var $INDEX;

	public function __construct() {
            parent:: __construct();
            $this->load->model('Model_login');
            $this->load->model('Model_calificador');
            $this->load->helper('url');
            $constIndex=new ConstIndex();
            $this->INDEX=$constIndex->impIndex();
        }

	public function index(){
            $result['raiz'] = $this->INDEX;
	}
        
        public function listaExamenesAsignados(){
            $result['raiz'] = $this->INDEX;
            $sesion=$this->session->idusuario;
            $result['examenes']=$this->Model_calificador->listaExamenesxCalificador($sesion);         
            $this->load->view('lstexamenes',$result);
        }
        
        public function listaAlumnosxCalificador($value,$num){
            $result['raiz'] = $this->INDEX;
            $sesion=$this->session->idusuario;
            $examen=$value;
            $result['alumnos']=$this->Model_calificador->listaAlumnosxCalificador($sesion,$examen);
            $result['numerin']=$num;
            $this->load->view('lstalumnos',$result);
        }
        
        /*public function descargarPdf($value){
            $result['raiz'] = $this->INDEX;
            header("Content-disposition: attachment; filename=ejemplo.pdf");
            header("Content-type: application/pdf");
            readfile("ejemplo.pdf");
        }*/
        
        public function revExamen($examen,$alumno,$revision,$num){
            $idexamen=$examen;
            $idusuarioalum=$alumno;
            $idrevision=$revision;
            $session=$this->session->idusuario;
            $result['preguntas']=$this->Model_calificador->CalificarExamenxAlumno($idusuarioalum,$idexamen,$idrevision,$session); 
            $result['rubricas']=$this->Model_calificador->CalificarExamenxAlumnoRubricas($idusuarioalum,$idexamen); 
            $result['raiz'] = $this->INDEX;
            $result['idexamen']=$idexamen;
            $result['idusuarioalum']=$idusuarioalum;
            $result['idrevision']=$idrevision;
            $result['numerin']=$num;
            $this->load->view('califexa',$result);
        }

        public function pdfCalifexa($examen,$alumno,$revision,$num){
            $this->load->library('pdfgenerator');
            $idexamen=$examen;
            $idusuarioalum=$alumno;
            $idrevision=$revision;
            $session=$this->session->idusuario;
            $preguntas=$this->Model_calificador->CalificarExamenxAlumnoPdf($idusuarioalum,$idexamen,$idrevision,$session);

            $html="";
            $html.="<p align='center' size='11'>".$preguntas[0]['folusuario']."</p>";
            $cont=1;
            foreach ($preguntas as $key => $value) {
                $html.="<p align='center' size='11'>";
                $html.=$cont.'. '.$preguntas[$key]['txtpregunta'];
                $html.="</p>";
                $html.="<p size='11'>";
                $html.=$preguntas[$key]['respuesta'];
                $html.="</p>";
                $html.="</br>";
                $cont++;
            }
            $filename="Rev".$preguntas[0]['folusuario'];
            $this->pdfgenerator->generate($html, $filename, true, 'letter', 'portrait'); //antes 'A4' 'landscape'
        }
        
        public function enviar($value,$idexa){
            $result['idexamen']=$idexa;
            $result['raiz'] = $this->INDEX;
            $result['cerrar']=$this->Model_calificador->CerrarRevision($value); 
            $this->load->view('enviarrevision',$result);
        }
        
        public function guardarCal(){
            $result['raiz'] = $this->INDEX;
            $session=$this->session->idusuario;
            $numgrupos=$this->input->get_post("numgrupos");
            $idexamen=$this->input->get_post("idexamen");
            $idalumno=$this->input->get_post("idalumno");
            $idrevision=$this->input->get_post("idrevision");
            $result['datoscalificacion']=$this->Model_calificador->DatosCalificacion($idalumno,$idexamen,$idrevision,$session); 
            //idpregunta|iddimension|valcalificacion
            $result['idexamen']=$this->input->get_post("idexamen");
            $result['idalumno']=$this->input->get_post("idalumno");
            $result['idrevision']=$this->input->get_post("idrevision");
            //for($i=1;$i<=$numgrupos;$i++){
            $result['value']=array(
                0=>explode("|",$this->input->get_post("group1")),
                1=>explode("|",$this->input->get_post("group2")),
                2=>explode("|",$this->input->get_post("group3")),
                3=>explode("|",$this->input->get_post("group4")),
                4=>explode("|",$this->input->get_post("group5")),
                5=>explode("|",$this->input->get_post("group6")),
                6=>explode("|",$this->input->get_post("group7")),          
            );         
            //}
            $this->Model_calificador->asignarCalificaciones($result);
            $this->load->view('guardarcal',$result);
        }
}

