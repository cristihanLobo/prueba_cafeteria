<?php

namespace App\Models;

use CodeIgniter\Model;

class categoriaModel extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function listado(){
        return $this->db->query('SELECT * FROM tbl_categotia')->getResultArray();
    }

    public function insertar($categoria){
        $object = [
            "nombre" => $categoria,
            "fecha_actualizacion" => date("Y-m-d H:i:s"),
            "fecha_creacion" => date("Y-m-d H:i:s")
        ];
        $this->db->table('tbl_categotia')->insert($object);
        return $this->db->affectedRows();
    }

    public function verificar($categoria){
        return $this->db->table('tbl_categotia')->where('nombre', $categoria)->get()->getResultArray();
    }

    public function verificarId($id){
        return $this->db->table('tbl_categotia')->where('id', $id)->get()->getResultArray();
    }
}