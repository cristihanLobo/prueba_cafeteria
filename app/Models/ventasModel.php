<?php

namespace App\Models;

use CodeIgniter\Model;

class ventasModel extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function listado(){
        return $this->db->query('
            SELECT c.nombre as categoria, v.estado, v.fecha_actualizacion, v.fecha_creacion, v.id, v.nombre, v.precio, v.stock
            FROM tbl_ventas as v
            INNER JOIN tbl_categotia as c
            WHERE v.categoria=c.id and v.estado = "1";
        ')->getResultArray();
    }

    public function stockListado(){
        return $this->db->table('tbl_ventas')->where("estado", "1")->countAllResults();
    }

    public function insertar($vector){
        $this->db->table('tbl_ventas')->insert($vector);
        return $this->db->affectedRows();
    }
}