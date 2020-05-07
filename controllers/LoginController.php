<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once ('ConstIndex.php');

class LoginController extends CI_Controller {

	var $INDEX;

	public function __construct() {
            parent:: __construct();
            //$this->load->library('session');
            $this->load->helper('url');
            $this->load->model('Model_login');
            $constIndex=new ConstIndex();
            $this->INDEX=$constIndex->impIndex();
        }

	public function index(){
            $result['raiz'] = $this->INDEX;
            $keys = array('idusuario', 'nomrol');
            $this->session->unset_userdata($keys);
            $this->load->view('login',$result);       
        }
        
        public function home(){
            $result['raiz'] = $this->INDEX;
            if(isset($this->session->idusuario) && isset($this->session->nomrol)){
                $this->load->view('home',$result);
            }
            else{               
                $user=$this->input->post('username');
                $password=hash('sha512', $this->input->post('password'));
                //$password=md5($this->input->post('password')); 
                $enter=$this->Model_login->login($user,$password);
                if($enter!=0){
                    $arraydata = array(
                        'idusuario'=>$enter[0]['idusuario'],
                        'idrol'=>$enter[0]['idrol'],
                        'nomrol'=>$enter[0]['nomrol'],
                        'usuario'=>$enter[0]['usuario'],
                        'nombreCompleto'=>$enter[0]['nomusuario'].' '.$enter[0]['segnomusuario'].' '.$enter[0]['apeusuario'].' '.$enter[0]['lastusuario'],
                        'curp'=>$enter[0]['curp'],
                        'identificador'=>$enter[0]['identificador'],
                        'nomprograma'=>$enter[0]['nomprograma'],
                        'idexamen'=>$enter[0]['idexamen']
                            );
                }
                else{
                    $arraydata = array(
                        'idusuario'=>"",
                        'nomrol'=>"",
                        'usuario'=>"",
                        'nombreCompleto'=>"",
                        'curp'=>"",
                        'identificador'=>"",
                        'nomprograma'=>"",
                        'idexamen'=>""
                        );
                }
                $this->session->set_userdata($arraydata);
                $this->load->view('home',$result); 
            }
                      
        }
        
        public function salir(){
            $result['raiz'] = $this->INDEX;
            $keys = array('idusuario', 'nomrol');
            $this->session->unset_userdata($keys);
            $this->load->view('login',$result);
        }
}