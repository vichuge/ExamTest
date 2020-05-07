<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_calificador extends CI_Model {

    //$this->db->order_by("column1 asc,column2 desc");

    public function __construct() {
        parent::__construct();
        $this->load->model('Model_calificador');
        $this->load->database();
    }

    public function listaExamenesxCalificador($id) {
        /* select
          a.idrevision,
          c.folusuario folio_alumno,
          f.idusuario calificador,
          b.idexamen,
          b.nomexamen,
          b.rubrica,
          d.idprograma,
          (select count(idcalificacion) from calificaciones
          where idrevision=a.idrevision) calif_hechas,
          (select count(iddimensionxpregunta)
          from dimensionesxpreguntas a
          join preguntas b on b.idpregunta=a.idpregunta
          join examenes c on c.idexamen=b.idexamen
          where c.idexamen=a.idexamen) total_calificaciones,
          (select count(idrevision) from revisiones where idusuariocalificador=a.idusuariocalificador and enviado=0 and estatus=1 and idexamen=a.idexamen ) asignaciones,
          (select count(idpregunta) from preguntas where idexamen=b.idexamen) numpreguntas
          from revisiones a
          join examenes b on b.idexamen=a.idexamen
          join usuarios c on c.idusuario=a.idusuarioalum
          join programas d on d.idprograma=c.idprograma
          join preguntas e on e.idexamen=b.idexamen
          join usuarios f on f.idusuario=a.idusuariocalificador
          where a.idusuariocalificador=78 and
          a.estatus=1
          group by a.idrevision
          order by a.idexamen; */
        $this->db->select('
            a.idrevision,
            c.folusuario folio_alumno,
            f.idusuario calificador,
            b.idexamen,
            b.nomexamen,
            b.rubrica,
            d.nomprograma,
            (select count(idcalificacion) from calificaciones
            where idrevision=a.idrevision) calif_hechas,
            (select count(iddimensionxpregunta)
            from dimensionesxpreguntas a
            join preguntas b on b.idpregunta=a.idpregunta
            join examenes c on c.idexamen=b.idexamen 
            where c.idexamen=a.idexamen) total_calificaciones,
	    (select count(idrevision) from revisiones where idusuariocalificador=a.idusuariocalificador and enviado=0 and estatus=1 and idexamen=a.idexamen ) asignaciones,
            (select count(idpregunta) from preguntas where idexamen=b.idexamen) numpreguntas
            ');
        $this->db->from('revisiones a');
        $this->db->join('examenes b', 'b.idexamen=a.idexamen');
        $this->db->join('usuarios c', 'c.idusuario=a.idusuarioalum');
        $this->db->join('programas d', 'd.idprograma=c.idprograma');
        $this->db->join('preguntas e', 'e.idexamen=b.idexamen');
        $this->db->join('usuarios f', 'f.idusuario=a.idusuariocalificador');
        $this->db->where('a.idusuariocalificador', $id);
        $this->db->where('a.estatus', 1);
        $this->db->group_by('a.idrevision');
        $this->db->order_by("a.idexamen");
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function listaAlumnosxCalificador($id, $exa) {
        /* select
          a.idrevision,
          a.estatus,
          a.enviado,
          c.folusuario folio_alumno,
          f.idusuario calificador,
          c.idusuario idalumno,
          b.idexamen,
          d.nomprograma,
          (select count(idcalificacion) from calificaciones
          where idrevision=a.idrevision) calif_hechas,
          (select count(iddimensionxpregunta)
          from dimensionesxpreguntas a
          join preguntas b on b.idpregunta=a.idpregunta
          join examenes c on c.idexamen=b.idexamen
          where c.idexamen=a.idexamen) total_calificaciones,
          (select count(idrevision) from revisiones where idusuariocalificador=a.idusuariocalificador and enviado=0 and estatus=1 and idexamen=a.idexamen ) asignaciones
          from revisiones a
          join examenes b on b.idexamen=a.idexamen
          join usuarios c on c.idusuario=a.idusuarioalum
          join programas d on d.idprograma=c.idprograma
          join preguntas e on e.idexamen=b.idexamen
          join usuarios f on f.idusuario=a.idusuariocalificador
          where a.idusuariocalificador=78 and
          b.idexamen=1 and
          a.estatus=1
          group by a.idrevision;
         */
        $this->db->select('
                    a.idrevision,
                    a.estatus,
                    a.enviado,
                    c.folusuario folio_alumno,
                    f.idusuario calificador,
                    c.idusuario idalumno,
                    b.idexamen,
                    d.nomprograma,
                    (select count(idcalificacion) from calificaciones
                    where idrevision=a.idrevision) calif_hechas,
                    (select count(iddimensionxpregunta)
                    from dimensionesxpreguntas a
                    join preguntas b on b.idpregunta=a.idpregunta
                    join examenes c on c.idexamen=b.idexamen
                    where c.idexamen=a.idexamen) total_calificaciones,
                    (select count(idrevision) from revisiones where idusuariocalificador=a.idusuariocalificador and enviado=0 and estatus=1 and idexamen=a.idexamen ) asignaciones
                    ');
        $this->db->from('revisiones a');
        $this->db->join('examenes b', 'b.idexamen=a.idexamen');
        $this->db->join('usuarios c', 'c.idusuario=a.idusuarioalum');
        $this->db->join('programas d', 'd.idprograma=c.idprograma');
        $this->db->join('preguntas e', 'e.idexamen=b.idexamen');
        $this->db->join('usuarios f', 'f.idusuario=a.idusuariocalificador');
        $this->db->where('a.idusuariocalificador', $id);
        $this->db->where('b.idexamen', $exa);
        $this->db->where('a.estatus', 1);
        $this->db->group_by('a.idrevision');
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function CalificarExamenxAlumno($usu, $exa, $rev, $session) {
        /*
          select
          c.idusuario,
          c.folusuario,
          e.titulo titulo_dimension,
          e.iddimension,
          a.idpregunta,
          a.txtpregunta,
          b.idrespuesta,
          b.respuesta,
          h.idexamen,
          i.idusuariocalificador calif,
          i.idusuarioalum alumno,
          i.idrevision idrev,
          g.valnivel,
          g.nomnivel,
          (select idcalificacion from calificaciones where idpregunta=a.idpregunta and iddimension=e.iddimension and idrevision=i.idrevision ) idcalificacion,
          (select valcalificacion from calificaciones where idpregunta=a.idpregunta and iddimension=e.iddimension and idrevision=i.idrevision ) calificacion,
          (select count(a.idnivel) from niveles a join examenes b on b.idexamen=a.idexamen where a.idexamen=1) tot_niveles
          from preguntas a
          join respuestas b on b.idpregunta=a.idpregunta
          join usuarios c on c.idusuario=b.idusuario
          join dimensionesxpreguntas d on d.idpregunta=a.idpregunta
          join dimensiones e on e.iddimension=d.iddimension
          join rubricas f on f.iddimension=e.iddimension
          join niveles g on g.idnivel=f.idnivel
          join examenes h on h.idexamen=g.idexamen
          join revisiones i on i.idexamen=h.idexamen
          where c.idusuario=3 and
          i.idusuarioalum=3 and
          h.idexamen=1 and
          i.idrevision=1 and
          i.idusuariocalificador=78
          order by a.idpregunta,e.iddimension,g.valnivel;
         */
        $this->db->select('
                    c.idusuario,
                    c.folusuario,
                    e.titulo titulo_dimension,
                    e.iddimension,
                    a.idpregunta,
                    a.txtpregunta,
                    b.idrespuesta,
                    b.respuesta,
                    h.idexamen,
                    i.idusuariocalificador calif,
                    i.idusuarioalum alumno,
                    i.idrevision idrev,
                    g.valnivel,
                    g.nomnivel,
                    (select idcalificacion from calificaciones where idpregunta=a.idpregunta and iddimension=e.iddimension and idrevision=i.idrevision) idcalificacion,
                    (select valcalificacion from calificaciones where idpregunta=a.idpregunta and iddimension=e.iddimension and idrevision=i.idrevision) calificacion,
                    (select count(a.idnivel) from niveles a join examenes b on b.idexamen=a.idexamen where a.idexamen=1) tot_niveles
                    ');
        $this->db->from('preguntas a');
        $this->db->join('respuestas b', 'b.idpregunta=a.idpregunta');
        $this->db->join('usuarios c', 'c.idusuario=b.idusuario');
        $this->db->join('dimensionesxpreguntas d', 'd.idpregunta=a.idpregunta');
        $this->db->join('dimensiones e', 'e.iddimension=d.iddimension');
        $this->db->join('rubricas f', 'f.iddimension=e.iddimension');
        $this->db->join('niveles g', 'g.idnivel=f.idnivel');
        $this->db->join('examenes h', 'h.idexamen=g.idexamen');
        $this->db->join('revisiones i', 'i.idexamen=h.idexamen');
        $this->db->where('c.idusuario', $usu);
        $this->db->where('i.idusuarioalum', $usu);
        $this->db->where('h.idexamen', $exa);
        $this->db->where('i.idrevision', $rev);
        $this->db->where('i.idusuariocalificador', $session);
        $this->db->order_by("a.idpregunta,e.iddimension,g.valnivel");
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function CalificarExamenxAlumnoPdf($usu, $exa, $rev, $session) {
        /*
          select
          c.idusuario,
          c.folusuario,
          e.titulo titulo_dimension,
          e.iddimension,
          a.idpregunta,
          a.txtpregunta,
          b.idrespuesta,
          b.respuesta,
          h.idexamen,
          i.idusuariocalificador calif,
          i.idusuarioalum alumno,
          i.idrevision idrev
          from preguntas a
          join respuestas b on b.idpregunta=a.idpregunta
          join usuarios c on c.idusuario=b.idusuario
          join dimensionesxpreguntas d on d.idpregunta=a.idpregunta
          join dimensiones e on e.iddimension=d.iddimension
          join rubricas f on f.iddimension=e.iddimension
          join niveles g on g.idnivel=f.idnivel
          join examenes h on h.idexamen=g.idexamen
          join revisiones i on i.idexamen=h.idexamen
          where c.idusuario=3 and
          i.idusuarioalum=3 and
          h.idexamen=1 and
          i.idrevision=78 and
          i.idusuariocalificador=78
          group by a.idpregunta
          order by a.idpregunta,e.iddimension,g.valnivel;
         */
        $this->db->select('
                    c.idusuario,
                    c.folusuario,
                    e.titulo titulo_dimension,
                    e.iddimension,
                    a.idpregunta,
                    a.txtpregunta,
                    b.idrespuesta,
                    b.respuesta,
                    h.idexamen,
                    i.idusuariocalificador calif,
                    i.idusuarioalum alumno,
                    i.idrevision idrev
                    ');
        $this->db->from('preguntas a');
        $this->db->join('respuestas b', 'b.idpregunta=a.idpregunta');
        $this->db->join('usuarios c', 'c.idusuario=b.idusuario');
        $this->db->join('dimensionesxpreguntas d', 'd.idpregunta=a.idpregunta');
        $this->db->join('dimensiones e', 'e.iddimension=d.iddimension');
        $this->db->join('rubricas f', 'f.iddimension=e.iddimension');
        $this->db->join('niveles g', 'g.idnivel=f.idnivel');
        $this->db->join('examenes h', 'h.idexamen=g.idexamen');
        $this->db->join('revisiones i', 'i.idexamen=h.idexamen');
        $this->db->where('c.idusuario', $usu);
        $this->db->where('i.idusuarioalum', $usu);
        $this->db->where('h.idexamen', $exa);
        $this->db->where('i.idrevision', $rev);
        $this->db->where('i.idusuariocalificador', $session);
        $this->db->group_by('a.idpregunta');
        $this->db->order_by("a.idpregunta,e.iddimension,g.valnivel");
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function CalificarExamenxAlumnoRubricas($usu, $exa) {
        /*
          select
          e.iddimension,
          a.idpregunta,
          e.titulo,
          e.txtdimension,
          g.valnivel,
          g.nomnivel,
          f.idrubrica,
          f.txtrubrica,
          (select count(a.idnivel) from niveles a join examenes b on b.idexamen=a.idexamen where a.idexamen=h.idexamen) tot_niveles
          from preguntas a
          join respuestas b on b.idpregunta=a.idpregunta
          join usuarios c on c.idusuario=b.idusuario
          join dimensionesxpreguntas d on d.idpregunta=a.idpregunta
          join dimensiones e on e.iddimension=d.iddimension
          join rubricas f on f.iddimension=e.iddimension
          join niveles g on g.idnivel=f.idnivel
          join examenes h on h.idexamen=g.idexamen
          where c.idusuario=79 and
          h.idexamen=2
          order by a.idpregunta,e.iddimension,g.valnivel;
         */
        $this->db->select('
                    e.iddimension,
                    a.idpregunta,
                    e.titulo,
                    e.txtdimension,
                    g.valnivel,
                    g.nomnivel,
                    f.idrubrica,
                    f.txtrubrica,
                    (select count(a.idnivel) from niveles a join examenes b on b.idexamen=a.idexamen where a.idexamen=h.idexamen) tot_niveles
                    ');
        $this->db->from('preguntas a');
        $this->db->join('respuestas b', 'b.idpregunta=a.idpregunta');
        $this->db->join('usuarios c', 'c.idusuario=b.idusuario');
        $this->db->join('dimensionesxpreguntas d', 'd.idpregunta=a.idpregunta');
        $this->db->join('dimensiones e', 'e.iddimension=d.iddimension');
        $this->db->join('rubricas f', 'f.iddimension=e.iddimension');
        $this->db->join('niveles g', 'g.idnivel=f.idnivel');
        $this->db->join('examenes h', 'h.idexamen=g.idexamen');
        $this->db->where('c.idusuario', $usu);
        $this->db->where('h.idexamen', $exa);
        $this->db->order_by("a.idpregunta,e.iddimension,g.valnivel");
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function DatosCalificacion($idalumno, $idexamen, $idrevision, $session) {
        /*
          select
          c.idpregunta,
          e.iddimension,
          g.idrevision,
          c.txtpregunta,
          b.respuesta,
          (select valcalificacion from calificaciones where idpregunta=c.idpregunta and iddimension=e.iddimension and idrevision=g.idrevision) calificacion
          from usuarios a
          join respuestas b on b.idusuario=a.idusuario
          join preguntas c on c.idpregunta=b.idpregunta
          join dimensionesxpreguntas d on d.idpregunta=c.idpregunta
          join dimensiones e on e.iddimension=d.iddimension
          join examenes f on f.idexamen=c.idexamen
          join revisiones g on g.idexamen=f.idexamen
          join calificaciones h on h.idrevision=g.idrevision
          where a.idusuario=3 and
          g.idusuarioalum=3 and
          f.idexamen=1 and
          g.idrevision=26 and
          g.idusuariocalificador=78
          group by e.iddimension
          order by c.idpregunta,e.iddimension;
         */
        $this->db->select('
                    c.idpregunta,
                    e.iddimension,
                    g.idrevision,
                    c.txtpregunta,
                    b.respuesta,
                    (select valcalificacion from calificaciones where idpregunta=c.idpregunta and iddimension=e.iddimension and idrevision=g.idrevision) calificacion
                    ');
        $this->db->from('usuarios a');
        $this->db->join('respuestas b', 'b.idusuario=a.idusuario');
        $this->db->join('preguntas c', 'c.idpregunta=b.idpregunta');
        $this->db->join('dimensionesxpreguntas d', 'd.idpregunta=c.idpregunta');
        $this->db->join('dimensiones e', 'e.iddimension=d.iddimension');
        $this->db->join('examenes f', 'f.idexamen=c.idexamen');
        $this->db->join('revisiones g', 'g.idexamen=f.idexamen');
        $this->db->join('calificaciones h', 'h.idrevision=g.idrevision');
        $this->db->where('a.idusuario', $idalumno);
        $this->db->where('g.idusuarioalum', $idalumno);
        $this->db->where('f.idexamen', $idexamen);
        $this->db->where('g.idrevision', $idrevision);
        $this->db->where('g.idusuariocalificador', $session);
        //$this->db->group_by('e.iddimension');
        $this->db->order_by("c.idpregunta,e.iddimension");
        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

    public function asignarCalificaciones($result) {
        //$this->db->trans_start();
        $valores = $result['value'];
        $existen = $result['datoscalificacion'];
        foreach ($valores as $key => $value) {
            if (isset($valores[$key][0]) && isset($valores[$key][1]) && isset($valores[$key][2])) {
                $existe = 0;
                $fechaObj = new DateTime('NOW');
                $fechaMod = $fechaObj->format('Y-m-d H:i:s');

                if($existen !=0){
                    foreach ($existen as $key2 => $value) {
                    $idpregunta1 = $valores[$key][0];
                    $idpregunta2 = $existen[$key2]['idpregunta'];
                    $iddimension1 = $valores[$key][1];
                    $iddimension2 = $existen[$key2]['iddimension'];
                    $idrevision1 = $result['idrevision'];
                    $idrevision2 = $existen[$key2]['idrevision'];
                        if ($valores[$key][0] == $existen[$key2]['idpregunta'] && $valores[$key][1] == $existen[$key2]['iddimension'] && $result['idrevision'] == $existen[$key2]['idrevision'] && $existen[$key2]['calificacion'] != null) {
                            $existe = 1;
                        }
                    }
                }
                $this->db->trans_start();
                if ($existe == 1) {
                    $asignar = array(
                        'valcalificacion' => $valores[$key][2],
                        'dtcalificacion' => $fechaMod,
                    );
                    //$idcalificacion=
                    $this->db->where('idpregunta', $valores[$key][0]);
                    $this->db->where('iddimension', $valores[$key][1]);
                    $this->db->where('idrevision', $result['idrevision']);
                    $this->db->update('calificaciones', $asignar);
                } else {
                    $asignar = array(
                        'idpregunta' => $valores[$key][0],
                        'idrevision' => $result['idrevision'],
                        'iddimension' => $valores[$key][1],
                        'valcalificacion' => $valores[$key][2],
                        'admincal' => "0",
                        'dtcalificacion' => $fechaMod,
                        'estatus' => "0",
                    );
                    $this->db->insert('calificaciones', $asignar);
                }
                $this->db->trans_complete();
            }
        }
        $n = $this->db->affected_rows();
        //$this->db->trans_complete();
        if ($n > 0) {
            $res = TRUE;
        } else {
            $res = FALSE;
        }
        return $res;
    }

    public function CerrarRevision($id) {
        $fechaObj = new DateTime('NOW');
        $fechaMod = $fechaObj->format('Y-m-d H:i:s');
        $cerrarRev = array(
            'enviado' => '1',
            'dtenviado' => $fechaMod
        );
        $this->db->where('idrevision', $id);
        $this->db->update('revisiones', $cerrarRev);
        $n = $this->db->affected_rows();
        if ($n > 0) {
            $res = TRUE;
        } else {
            $res = FALSE;
        }
        return $res;
    }

}
