<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_alumno extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function checking() {
    	$id=$this->session->idusuario;
        $this->db->select('
            idtestlog,end_date,status
            ');
        $this->db->from('testlog');
        $this->db->where('idusuario',$this->session->idusuario);
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function checking_examen() {
    	$id=$this->session->idusuario;
        $this->db->select('
            idexamlog,dtfinal,estatus
            ');
        $this->db->from('examlog');
        $this->db->where('idusuario',$this->session->idusuario);
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function insert_time_testlog($time,$newtime) {

        $testlog = array(
                'idusuario' => $this->session->idusuario,
                'start_date' => $time,
                'end_date' => $newtime,
                'status' => 0,
            );
    	$this->db->insert('testlog', $testlog);

        $n = $this->db->affected_rows();
        $this->db->trans_complete();
        if ($n > 0) {
            $res = TRUE;
        } else {
            $res = FALSE;
        }
        return $res;
    }

    public function insert_time_examlog($time,$newtime) {

        $testlog = array(
                'idusuario' => $this->session->idusuario,
                'dtinicio' => $time,
                'dtfinal' => $newtime,
                'estatus' => 0,
            );
    	$this->db->insert('examlog', $testlog);

        $n = $this->db->affected_rows();
        $this->db->trans_complete();
        if ($n > 0) {
            $res = TRUE;
        } else {
            $res = FALSE;
        }
        return $res;
    }

    public function examen_terminado(){
        $time=new DateTime('NOW');
        $time=$time->format('Y-m-d H:i:s');
        $cambio=array(
            'dtfinal'=>$time,
            'estatus'=>1
        );
        $this->db->where('idusuario',$this->session->idusuario);
        $this->db->update('examlog',$cambio);
    }

    public function log_terminado(){
        $time=new DateTime('NOW');
        $time=$time->format('Y-m-d H:i:s');
        $cambio=array(
            'end_date'=>$time,
            'status'=>1
        );
        $this->db->where('idusuario',$this->session->idusuario);
        $this->db->update('testlog',$cambio);
    }

    public function preguntas($id){
        /*
        select a.idusuario,a.idexamen,c.txtpregunta,d.contenido
        from usuarios a 
        join examenes b on a.idexamen=b.idexamen
        join preguntas c on c.idexamen=b.idexamen
        join reading d on d.idreading=c.idreading 
        where a.idusuario=92;
        */
        $this->db->select('
            a.idusuario,a.idexamen,c.txtpregunta,d.contenido
            ');
        $this->db->from('usuarios a');
        $this->db->join('examenes b','a.idexamen=b.idexamen');
        $this->db->join('preguntas c','c.idexamen=b.idexamen');
        $this->db->join('reading d','d.idreading=c.idreading ');
        $this->db->where('a.idusuario',$id);
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function insert_answers($respuestas){
        /*
        $testlog = array(
                'idusuario' => $this->session->idusuario,
                'start_date' => $time,
                'end_date' => $newtime,
                'status' => 0,
            );
        $this->db->insert('testlog', $testlog);

        $n = $this->db->affected_rows();
        $this->db->trans_complete();
        if ($n > 0) {
            $res = TRUE;
        } else {
            $res = FALSE;
        }
        return $res;
        */
        $n="";
        foreach ($respuestas as $key => $value) {
        }

    }

}