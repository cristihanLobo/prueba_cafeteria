<?php

namespace App\Models;

use CodeIgniter\Model;

class productosModel extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function listado(){
        return $this->db->query('
            SELECT c.nombre as categoria, p.estado, p.fecha_actualizacion, p.fecha_creacion, p.id, p.nombre, p.peso, p.precio, p.referencia, p.stock
            FROM tbl_productos as p
            INNER JOIN tbl_categotia as c
            WHERE p.categoria=c.id and p.estado = "1";'
        )->getResultArray();
    }

    public function stockListado(){
        return $this->db->table('tbl_productos')->where("estado", "1")->countAllResults();
    }

    public function insertar($vector){
        $this->db->table('tbl_productos')->insert($vector);
        return $this->db->affectedRows();
    }

    public function borrar($id){
        $this->db->table('tbl_productos')->where('id',$id)->delete();
        return $this->db->affectedRows();
    }

    public function editar($id,$vector){
        $this->db->table('tbl_productos')->where('id',$id)->update($vector);
        return $this->db->affectedRows();
    }

    public function verificar($productoNombre){
        return $this->db->table('tbl_productos')->where('nombre', $productoNombre)->get()->getResultArray();
    }

    public function verificarId($id){
        return $this->db->table('tbl_productos')->where('id', $id)->get()->getResultArray();
    }

    public function verificarCategoria($id){
        return $this->db->table('tbl_productos')->where('categoria', $id)->where('estado', 1)->get()->getResultArray();
    }
}