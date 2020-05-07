<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once ('ConstIndex.php');

class AlumnoController extends CI_Controller {

	var $INDEX;

	public function __construct() {
        parent:: __construct();
        $this->load->model('Model_login');
        $this->load->model('Model_alumno');
        $this->load->helper('url');
        $constIndex=new ConstIndex();
        $this->INDEX=$constIndex->impIndex();
    }

	public function index(){
        $result['raiz'] = $this->INDEX;
	}
        
    public function bienvenida(){
        $result['raiz'] = $this->INDEX;
        $this->check_test();
        $this->examen_test();
        $this->load->view('bienvenido',$result);
    }
        
    public function ejemplo(){
        $result['raiz'] = $this->INDEX;
        $this->load->view('ejemplo',$result);
    }

    public function examtest(){
        $result['raiz'] = $this->INDEX;
        $idalumno=$this->session->idusuario;
        $nomrol=$this->session->nomrol;
        $idexamen=$this->session->idexamen;
        if($nomrol != "alumno"){
            $this->load->view('login');
        }else{
            

            $check=$this->Model_alumno->checking();

            if($check==false){
                //Aqui se debe de agregar el tiempo inicial en el test_log
            $time=new DateTime('NOW');
            $newtime=new DateTime('NOW');

            //$fecha->add(new DateInterval('P10D'));
            $newtime->add(new DateInterval('PT10M'));

            $year=$newtime->format('Y');
            $month=$newtime->format('m');
            $day=$newtime->format('d');
            $hour=$newtime->format('H');
            $minute=$newtime->format('i');
            $second=$newtime->format('s');

            //$fechaMod = $fechaObj->format('Y-m-d H:i:s');
            $time=$time->format('Y-m-d H:i:s');
            $newtime=$newtime->format('Y-m-d H:i:s');

            $this->Model_alumno->insert_time_testlog($time,$newtime);
            }else{
                $newtime=new DateTime($check[0]['end_date']);
                $year=$newtime->format('Y');
                $month=$newtime->format('m');
                $day=$newtime->format('d');
                $hour=$newtime->format('H');
                $minute=$newtime->format('i');
                $second=$newtime->format('s');
            }

            

            
                //$reult['time']=$this->Model_alumno->timer($idalumno);
                //$result['preguntas']= $this->Model_alumno->preguntas($idexamen);

                $result['year']=$year;

                switch ($month) {
                    case 01:$result['month']="Jan";break;
                    case 02:$result['month']="Feb";break;
                    case 03:$result['month']="Mar";break;
                    case 04:$result['month']="Apr";break;
                    case 05:$result['month']="May";break;
                    case 06:$result['month']="Jun";break;
                    case 07:$result['month']="Jul";break;
                    case 08:$result['month']="Aug";break;
                    case 09:$result['month']="Sep";break;
                    case 10:$result['month']="Oct";break;
                    case 11:$result['month']="Nov";break;
                    case 12:$result['month']="Dec";break;
                    default:$result['month']="Error!";break;
                }

                //$result['month']=$month;
                $result['days']=$day;
                $result['hours']=$hour;
                $result['minutes']=$minute;
                $result['seconds']=$second;
                $this->load->view('examtest',$result);
            }
        
    }

    public function inicioexamen(){
        $result['raiz'] = $this->INDEX;
        $this->Model_alumno->log_terminado();
        $this->examen_test();
        $this->load->view('begintest',$result);
    }

    public function examen(){
        $result['raiz'] = $this->INDEX;
        $idalumno=$this->session->idusuario;
        $nomrol=$this->session->nomrol;
        $idexamen=$this->session->idexamen;
        if($nomrol != "alumno"){
            $this->load->view('login');
        }else{

            $check=$this->Model_alumno->checking_examen();

            if($check==false){
            //Aqui se debe de agregar el tiempo inicial en el test_log
            $time=new DateTime('NOW');
            $newtime=new DateTime('NOW');

            //$fecha->add(new DateInterval('P10D'));
            $newtime->add(new DateInterval('PT2H'));

            $year=$newtime->format('Y');
            $month=$newtime->format('m');
            $day=$newtime->format('d');
            $hour=$newtime->format('H');
            $minute=$newtime->format('i');
            $second=$newtime->format('s');

            //$fechaMod = $fechaObj->format('Y-m-d H:i:s');
            $time=$time->format('Y-m-d H:i:s');
            $newtime=$newtime->format('Y-m-d H:i:s');

            $this->Model_alumno->insert_time_examlog($time,$newtime);
            }else{
                $newtime=new DateTime($check[0]['dtfinal']);
                $year=$newtime->format('Y');
                $month=$newtime->format('m');
                $day=$newtime->format('d');
                $hour=$newtime->format('H');
                $minute=$newtime->format('i');
                $second=$newtime->format('s');
            }
            //$reult['time']=$this->Model_alumno->timer($idalumno);
            //$result['preguntas']= $this->Model_alumno->preguntas($idexamen);

            $result['year']=$year;

            switch ($month) {
                case 01:$result['month']="Jan";break;
                case 02:$result['month']="Feb";break;
                case 03:$result['month']="Mar";break;
                case 04:$result['month']="Apr";break;
                case 05:$result['month']="May";break;
                case 06:$result['month']="Jun";break;
                case 07:$result['month']="Jul";break;
                case 08:$result['month']="Aug";break;
                case 09:$result['month']="Sep";break;
                case 10:$result['month']="Oct";break;
                case 11:$result['month']="Nov";break;
                case 12:$result['month']="Dec";break;
                default:$result['month']="Error!";break;
            }

            $result['estatus']=$check[0]['estatus'];
            $result['contenido']=$this->Model_alumno->preguntas($idalumno);  
            //$result['month']=$month;
            $result['days']=$day;
            $result['hours']=$hour;
            $result['minutes']=$minute;
            $result['seconds']=$second;
            $this->load->view('examen',$result);
        }
    }

    public function fin()
    { 
        $txtrespuesta1=$this->input->get_post("txtrespuesta1");
        $txtrespuesta2=$this->input->get_post("txtrespuesta2");
        $txtrespuesta3=$this->input->get_post("txtrespuesta3");
        $txtrespuesta4=$this->input->get_post("txtrespuesta4");

        $respuestas=array($txtrespuesta1,$txtrespuesta2,$txtrespuesta3,$txtrespuesta4);

        $this->Model_alumno->insert_answers($respuestas);

        $result['raiz'] = $this->INDEX;
        $this->Model_alumno->examen_terminado();
        $this->load->view('finalizar',$result);
    }

    public function check_test()
    {
        $result['raiz'] = $this->INDEX;
        $idalumno=$this->session->idusuario;
        $nomrol=$this->session->nomrol;
        $idexamen=$this->session->idexamen;
        if($nomrol != "alumno"){
            $this->load->view('login');
        }else
        {
            $check=$this->Model_alumno->checking();
            if($check[0]['status']==1)
            {
                $result['check']=true;
                $this->load->view('log_test',$result);
            }
        }
    }

    public function examen_test()
    {
        $result['raiz'] = $this->INDEX;
        $idalumno=$this->session->idusuario;
        $nomrol=$this->session->nomrol;
        $idexamen=$this->session->idexamen;
        if($nomrol != "alumno"){
            $this->load->view('login');
        }else{
            $check=$this->Model_alumno->checking_examen();
            if($check[0]['estatus']==1){
                $result['check']=true;
                $this->load->view('examen_test',$result);
            }
        }
    }
}