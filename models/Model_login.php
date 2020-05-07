<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_login extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function login($usu, $pass) {
        $this->db->select('a.idusuario,b.idrol,b.nomrol,a.idexamen,a.usuario,a.nomusuario,a.segnomusuario,a.apeusuario,a.lastusuario,a.curp,a.folusuario identificador,e.nomprograma');
        $this->db->from('usuarios a');
        //$this->db->join('ctiposusuarios b', 'a.iTipoUsuarioId=b.iTipoUsuarioId', 'inner');
        $this->db->join('roles b', 'a.idrol=b.idrol');
        $this->db->join('rolesxpermisos c', 'b.idrol=c.idrol');
        $this->db->join('permisos d', 'c.idpermiso=d.idpermiso');
        $this->db->join('programas e', 'a.idprograma=e.idprograma');
        $this->db->where('a.usuario', $usu);
        $this->db->where('a.password', $pass);
        $this->db->where('a.estatus', 1);

        $query = $this->db->get();
        $res = $query->num_rows();
        if ($res > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return false;
        }
    }

}