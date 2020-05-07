<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_administrador extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listadoExamenes($idexamen) {
        $this->db->select('idexamen,nomexamen');
        $this->db->from('examenes');
        if ($idexamen != "" || $idexamen != 0) {
            $this->db->where('idexamen', $idexamen);
        }
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }
    
    public function listadoRoles($idrol) {
        $this->db->select('idrol,nomrol');
        $this->db->from('roles');
        if ($idrol != "" || $idrol != 0) {
            $this->db->where('idrol', $idrol);
        }
        $this->db->order_by("idrol", 'desc');
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function listadoCalificadores() {
        $this->db->select('idusuario,nomusuario,apeusuario,lastusuario');
        $this->db->from('usuarios');
        $this->db->where('idrol', 2);
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function listadoAlumnosPorExamen($idexamen) {
        /*
        select
            a.idusuario,
            a.folusuario,
            a.nomusuario,
            a.segnomusuario,
            a.apeusuario,
            a.lastusuario,
            b.nomexamen,
            (select count(idrespuesta) from respuestas where idusuario=a.idusuario) numrespuestas
        from usuarios a
        join examenes b on a.idexamen=b.idexamen
        where a.idrol=4 and
        a.idexamen=3;
        */
        $this->db->select('
            a.idusuario,
            a.folusuario,
            a.nomusuario,
            a.segnomusuario,
            a.apeusuario,
            a.lastusuario,
            b.nomexamen,
            (select count(idrespuesta) from respuestas where idusuario=a.idusuario) numrespuestas
            ');
        $this->db->from('usuarios a');
        $this->db->join('examenes b', 'a.idexamen=b.idexamen');
        $this->db->where('a.idrol', 4);
        if($idexamen != "" || $idexamen !=0){
            $this->db->where('b.idexamen', $idexamen);
        }
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function asignarRevisiones($calificador, $examen, $alumnos) {
        $this->db->trans_start();
        if(isset($alumnos)){
            foreach ($alumnos as $key) {
            $fechaObj = new DateTime('NOW');
            $fechaMod = $fechaObj->format('Y-m-d H:i:s');
            $alumno = $alumnos[$key];
            $foliorevision = $this->session->idusuario . $examen . $alumno . $calificador;
            $asignar = array(
                'idexamen' => $examen,
                'idusuarioasigna' => $this->session->idusuario,
                'folrevision' => $foliorevision,
                'dtrevision' => $fechaMod,
                'idusuarioalum' => $alumno,
                'idusuariocalificador' => $calificador,
                'estatus' => 1,
            );
            //echo 'holamundo';
            $this->db->insert('revisiones', $asignar);
            }
        }
        
        $n = $this->db->affected_rows();
        $this->db->trans_complete();
        if ($n > 0) {
            $res = TRUE;
        } else {
            $res = FALSE;
        }
        return $res;
    }

    public function listadoRevisiones() {
        $this->db->select('
            a.idrevision,
            (d.nomexamen) examen,
            (c.folusuario) folio_alumno,
            a.dtrevision,
            concat(c.nomusuario," ",c.apeusuario," ",c.lastusuario) alumno,
            concat(b.nomusuario," ",b.apeusuario," ",b.lastusuario) calificador,
            a.estatus,
            a.dtrevision
            ');
        $this->db->from('revisiones a');
        $this->db->join('usuarios b', 'a.idusuariocalificador=b.idusuario');
        $this->db->join('usuarios c', 'a.idusuarioalum=c.idusuario');
        $this->db->join('examenes d', 'a.idexamen=d.idexamen');
        $this->db->order_by("d.idexamen");
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function listadoRevisionesConFiltro($alumno,$calificador,$examen) {
        $this->db->select('
            a.idrevision,
            (d.nomexamen) examen,
            (c.folusuario) folio_alumno,
            a.dtrevision,
            concat(c.nomusuario," ",c.apeusuario," ",c.lastusuario) alumno,
            concat(b.nomusuario," ",b.apeusuario," ",b.lastusuario) calificador,
            a.estatus,
            a.dtrevision
            ');
        $this->db->from('revisiones a');
        $this->db->join('usuarios b', 'a.idusuariocalificador=b.idusuario');
        $this->db->join('usuarios c', 'a.idusuarioalum=c.idusuario');
        $this->db->join('examenes d', 'a.idexamen=d.idexamen');

        if($alumno != 0){
            $this->db->where("a.idusuarioalum",$alumno);
        }

        if( $calificador !=0){
            $this->db->where("a.idusuariocalificador",$calificador);
        }

        if($examen !=0){
            $this->db->where("d.idexamen",$examen);
        }

        $this->db->order_by("d.idexamen");
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function listadoCalificaciones($alumno, $programa, $dimension, $pregunta, $calificador, $nivel, $examen) {
        /*
          select
          a.valcalificacion,
          a.dtcalificacion,
          b.idrevision,
          b.estatus,
          b.folrevision,
          b.enviado,
          b.dtenviado,
          c.idpregunta,
          c.txtpregunta,
          d.titulo nomdimension,
          e.idusuario,
          e.folusuario,
          e.nomusuario nomalumno,
          e.segnomusuario,
          e.apeusuario,
          e.lastusuario,
          f.idusuario idcalificador,
          f.nomusuario nomcalificador,
          h.nomprograma
          from calificaciones a
          join revisiones b  on b.idrevision=a.idrevision
          join preguntas c  on c.idpregunta=a.idpregunta
          join dimensiones d  on d.iddimension=a.iddimension
          join usuarios e  on e.idusuario=b.idusuarioalum
          join usuarios f  on f.idusuario=b.idusuariocalificador
          join usuarios g  on g.idusuario=b.idusuarioasigna
          join programas h  on e.idprograma=h.idprograma
          where b.estatus=1 and
          b.enviado=1;
         */
        $this->db->select('
          a.valcalificacion,
          a.dtcalificacion,
          b.idrevision,
          b.estatus,
          b.folrevision,
          b.enviado,
          b.dtenviado,
          c.idpregunta,
          c.txtpregunta,
          d.titulo nomdimension,
          e.idusuario,
          e.folusuario,
          e.nomusuario nomalumno,
          e.segnomusuario,
          e.apeusuario,
          e.lastusuario,
          f.idusuario idcalificador,
          f.nomusuario nomcalificador,
          h.nomprograma
            ');
        $this->db->from('calificaciones a');
        $this->db->join('revisiones b', 'b.idrevision=a.idrevision');
        $this->db->join('preguntas c', 'c.idpregunta=a.idpregunta');
        $this->db->join('dimensiones d', 'd.iddimension=a.iddimension');
        $this->db->join('usuarios e', 'e.idusuario=b.idusuarioalum');
        $this->db->join('usuarios f', 'f.idusuario=b.idusuariocalificador');
        $this->db->join('usuarios g', 'g.idusuario=b.idusuarioasigna');
        $this->db->join('programas h', 'e.idprograma=h.idprograma');
        $this->db->join('examenes i', 'i.idexamen=b.idexamen');
        $this->db->where('b.estatus', 1);
        $this->db->where('b.enviado', 1);
        if ($alumno != 0) {
            $this->db->where('e.idusuario', $alumno);
        }
        if ($programa != 0) {
            $this->db->where('h.idprograma', $programa);
        }
        if ($dimension != 0) {
            $this->db->where('d.iddimension', $dimension);
        }
        if ($pregunta != 0) {
            $this->db->where('c.idpregunta', $pregunta);
        }
        if ($calificador != 0) {
            $this->db->where('f.idusuario', $calificador);
        }
        if ($nivel != 99) {
            $this->db->where('a.valcalificacion', $nivel);
        }
        if ($examen != 0) {
            $this->db->where('i.idexamen', $examen);
        }
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function eliminarRevision($idrevision) {
        $cambio = array(
            'estatus' => 0,
        );
        $this->db->trans_start();
        $this->db->where('idrevision', $idrevision);
        $this->db->update('revisiones', $cambio);
        $n = $this->db->affected_rows();
        $this->db->trans_complete();
        if ($n > 0) {
            $res = TRUE;
        } else {
            $res = FALSE;
        }
        return $res;
    }
    
    public function activarRevision($idrevision) {
        $cambio = array(
            'estatus' => 1,
        );
        $this->db->trans_start();
        $this->db->where('idrevision', $idrevision);
        $this->db->update('revisiones', $cambio);
        $n = $this->db->affected_rows();
        $this->db->trans_complete();
        if ($n > 0) {
            $res = TRUE;
        } else {
            $res = FALSE;
        }
        return $res;
    }

    public function listadoNiveles() {
        $this->db->select('idnivel,valnivel,nomnivel');
        $this->db->from('niveles');
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function listadoProgramas($idprograma) {
        $this->db->select('idprograma,nomprograma');
        $this->db->from('programas');
        if ($idprograma != "" || $idprograma != 0) {
            $this->db->where('idprograma', $idprograma);
        }
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function listadoDimensiones() {
        $this->db->select('iddimension,titulo');
        $this->db->from('dimensiones');
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function listadoPreguntas() {
        $this->db->select('idpregunta,txtpregunta');
        $this->db->from('preguntas');
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function listadoUsuarios($exa,$pro){
        /*
        select 
        a.nomusuario,
        a.segnomusuario,
        a.apeusuario,
        a.lastusuario,
        b.nomprograma
        from usuarios a
        join programas b on a.idprograma=b.idprograma 
        where a.idprograma=1;
        */
        $this->db->select('
            a.idusuario,
            a.nomusuario,
            a.segnomusuario,
            a.apeusuario,
            a.lastusuario,
            a.usuario,
            a.folusuario,
            a.decrypt,
            b.nomprograma,
            c.nomexamen
            ');
        $this->db->from('usuarios a');
        $this->db->join('programas b', 'a.idprograma=b.idprograma');
        $this->db->join('examenes c', 'a.idexamen=c.idexamen');
        $this->db->where('a.idrol', 4);
        //$this->db->where('a.idusuario >=',305);
        //$this->db->where('a.idusuario <=',375);
        if ($exa != "" && $exa != 0 && $exa !="0") {
            $this->db->where('a.idexamen', $exa);
        }
        if ($pro != "" && $pro != 0 && $pro != "0") {
            $this->db->where('a.idprograma', $pro);
        }
        //$this->db->where('a.idprograma !=', 5); //línea para evitar a los genéricos
        $this->db->where('a.estatus', null);
        $this->db->order_by("a.idusuario","asc");
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function impusuario($id){
        /*
        select 
        a.nomusuario,
        a.segnomusuario,
        a.apeusuario,
        a.lastusuario,
        b.nomprograma
        from usuarios a
        join programas b on a.idprograma=b.idprograma 
        where a.idprograma=1;
        */
        $this->db->select('
            a.idusuario,
            a.nomusuario,
            a.segnomusuario,
            a.apeusuario,
            a.lastusuario,
            a.usuario,
            a.decrypt,
            a.folusuario,
            b.nomprograma,
            c.nomexamen
            ');
        $this->db->from('usuarios a');
        $this->db->join('programas b', 'a.idprograma=b.idprograma');
        $this->db->join('examenes c', 'a.idexamen=c.idexamen');
        $this->db->where('a.idrol', 4);
        $this->db->where('a.idusuario', $id);
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function perfilusuario($id){
        if($this->session->nomrol != "administrador" && $this->session->idusuario != $id ){
            return false;
        }
        /*
        select 
        a.idusuario,
        a.idprograma,
        a.idrol,
        a.idexamen,
        a.usuario,
        a.nomusuario,
        a.segnomusuario,
        a.apeusuario,
        a.lastusuario,
        a.decrypt,
        a.email,
        a.curp,
        a.folusuario,
        b.nomprograma,
        c.nomexamen
        from usuarios a
        join programas b on a.idprograma=b.idprograma
        join examenes c on a.idexamen=c.idexamen 
        where a.idusuario=76;
        */
        $this->db->select('
            a.idusuario,
            a.idprograma,
            a.idrol,
            a.idexamen,
            a.usuario,
            a.nomusuario,
            a.segnomusuario,
            a.apeusuario,
            a.lastusuario,
            a.decrypt,
            a.email,
            a.curp,
            a.folusuario,
            b.nomprograma,
            c.nomexamen
            ');
        $this->db->from('usuarios a');
        $this->db->join('programas b', 'a.idprograma=b.idprograma');
        $this->db->join('examenes c', 'a.idexamen=c.idexamen');
        $this->db->where('a.idusuario', $id);
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }
    
    public function editarcrearusuario($idusuario,$first_name,$second_name,$last_name,$mother_name,$email,$curp,$user_name,$idrol,$idprograma,$idexamen,$password,$folio){
        if($idusuario != 0){
            if($idrol != 4){
                $cambio = array(
                    'idrol' => $idrol,
                    'usuario' => $user_name,
                    'nomusuario' => $first_name,
                    'segnomusuario' => $second_name,
                    'apeusuario' => $last_name,
                    'lastusuario' => $mother_name,
                    'email' => $email,
                    'curp' => $curp,
                    'folusuario' => $folio,
                );
            }else{
                $cambio = array(
                    'idprograma' => $idprograma,
                    'idrol' => $idrol,
                    'idexamen' => $idexamen,
                    'usuario' => $user_name,
                    'nomusuario' => $first_name,
                    'segnomusuario' => $second_name,
                    'apeusuario' => $last_name,
                    'lastusuario' => $mother_name,
                    'email' => $email,
                    'curp' => $curp,
                    'folusuario' => $folio,
                ); 
            }
            
            $this->db->trans_start();
            $this->db->where('idusuario', $idusuario);
            $this->db->update('usuarios', $cambio);
            $n = $this->db->affected_rows();
            $this->db->trans_complete();  
        }else{

            $time=new DateTime('NOW');
            $time=$time->format('Y-m-d H:i:s');
            $decrypt=$password;
            $password=hash('sha512', $password);
            $asignar = array(
                'idprograma' => $idprograma,
                'idrol' => $idrol,
                'idexamen' => $idexamen,
                'usuario' => $user_name,
                'nomusuario' => $first_name,
                'segnomusuario' => $second_name,
                'apeusuario' => $last_name,
                'lastusuario' => $mother_name,
                'decrypt' => $decrypt,
                'password' => $password,
                'email' => $email,
                'dtusuario' => $time,
                'estatus' => 1,
                'curp' => $curp,
                'folusuario' => $folio,
            );
            //echo 'holamundo';
            $this->db->insert('usuarios', $asignar);
        }

    }

}
