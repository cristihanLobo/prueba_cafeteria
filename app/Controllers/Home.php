<?php

namespace App\Controllers;
use App\Models\categoriaModel; 
use App\Models\productosModel; 
use App\Models\ventasModel; 

class Home extends BaseController
{
    public function index()
    {
        return view('inicio');
    }

    public function Inicio()
    {
        return view('admin/inicio');
    }

    public function agregarCategorias(){
        $datos = $this->request->getPost();
        if($datos["categoria"] != ""){
            $categoria = new categoriaModel($datos["categoria"]);
            $verificarCate =  $categoria->verificar($datos["categoria"]);
            if(count($verificarCate) > 0){
                print_r(json_encode(array("status"=>"stop", "message" => "")));
            }else{
                $result = $categoria->insertar($datos["categoria"]);
                if($result > 0){
                    print_r(json_encode(array("status"=>"success", "message" => "", "data" =>  $categoria->listado())));
                }else{
                    print_r(json_encode(array("status"=>"error", "message" => "")));
                }
            }
        }else{
            print_r(json_encode(array("status"=>"error", "message" => "")));
        }
    }

    public function agregarProducto(){
        $datos = $this->request->getPost();
        if($datos["nombre"] != "" && $datos["referencia"] != "" && $datos["precio"] != "" && $datos["peso"] != "" && $datos["categoria"] != "" && $datos["cantidad"] != ""){
            $vector = [
                "nombre" => $datos["nombre"],
                "referencia" => $datos["referencia"],
                "precio" => $datos["precio"],
                "peso" => $datos["peso"],
                "categoria" => $datos["categoria"],
                "stock" => $datos["cantidad"],
                "estado" => 1,
                "fecha_actualizacion" => date("Y-m-d H:i:s"),
                "fecha_creacion" => date("Y-m-d H:i:s")
            ];
            $productos = new productosModel();
            $verificarProd =  $productos->verificar($datos["nombre"]);
            if(count($verificarProd) > 0){
                print_r(json_encode(array("status"=>"stop", "message" => "")));
            }else{
                $result = $productos->insertar($vector);
                if($result > 0){
                    print_r(json_encode(array("status"=>"success", "message" => "", "data" =>  $productos->listado())));
                }else{
                    print_r(json_encode(array("status"=>"error", "message" => "")));
                }
            }
        }else{
            print_r(json_encode(array("status"=>"error", "message" => "")));
        }
    }

    public function listarProductos(){
        $productos = new productosModel();
        print_r(json_encode(array("data" => $productos->listado())));
    }

    public function listarVentas(){
        $ventas = new ventasModel();
        print_r(json_encode(array("data" => $ventas->listado())));
    }

    public function countListadoProducto(){
        $productos = new productosModel();
        print_r(json_encode(array("data" => $productos->stocklistado())));
    }

    public function countListadoVentas(){
        $ventas = new ventasModel();
        print_r(json_encode(array("data" => $ventas->stocklistado())));
    }

    public function listarCategoria(){
        $categoria = new categoriaModel();
        print_r(json_encode(array("data" => $categoria->listado())));
    }

    public function borrarProducto(){
        $datos = $this->request->getPost();
        $productos = new productosModel();
        $verificarProd =  $productos->verificarId($datos["id"]);
        if(count($verificarProd) > 0){
            $result = $productos->borrar($datos["id"]);
            if($result > 0){
                print_r(json_encode(array("status"=>"success", "message" => "", "data" =>  $productos->listado())));
            }else{
                print_r(json_encode(array("status"=>"error", "message" => "")));
            }
        }else{
            print_r(json_encode(array("status"=>"stop", "message" => "")));
        }
    }

    public function editarProducto(){
        $datos = $this->request->getPost();
        $productos = new productosModel();
        $verificarProd =  $productos->verificarId($datos["id"]);
        $vector = [
            "nombre" => $datos["nombre"],
            "referencia" => $datos["referencia"],
            "precio" => $datos["precio"],
            "peso" => $datos["peso"],
            "categoria" => $datos["categoria"],
            "stock" => $datos["cantidad"],
            "estado" => 1,
            "fecha_actualizacion" => date("Y-m-d H:i:s"),
            "fecha_creacion" => date("Y-m-d H:i:s")
        ];
        if(count($verificarProd) > 0){
            $result = $productos->editar($datos["id"],$vector);
            if($result > 0){
                print_r(json_encode(array("status"=>"success", "message" => "", "data" => $productos->listado())));
            }else{
                print_r(json_encode(array("status"=>"error", "message" => "")));
            }
        }else{
            print_r(json_encode(array("status"=>"stop", "message" => "")));
        }
    }

    public function obtenerProducto(){
        $datos = $this->request->getPost();
        $productos = new productosModel();
        print_r(json_encode(array("status"=>"success", "message" => "", "data" =>  $productos->verificarId($datos["id"]))));
    }

    public function obtenerCategoriaProductos(){
        $datos = $this->request->getPost();
        $productos = new productosModel();
        print_r(json_encode(array("status"=>"success", "message" => "", "data" =>  $productos->verificarCategoria($datos["id"]))));
    }

    public function comprarProducto(){
        $datos = $this->request->getPost();
        $vector = [
            "idProducto" => $datos["id"],
            "nombre" => $datos["nombre"],
            "precio" => $datos["precio"],
            "stock" => $datos["stock"],
            "categoria" => $datos["categoria"],
            "estado" => 1,
            "fecha_actualizacion" => date("Y-m-d H:i:s"),
            "fecha_creacion" => date("Y-m-d H:i:s")
        ];
        $venta = new ventasModel();
        $result = $venta->insertar($vector);
        if($result > 0){
            $productos = new productosModel();
            $verificarProd =  $productos->verificarId($datos["id"]);
            $restante = $verificarProd[0]["stock"] - $datos["stock"];
            if($restante == 0){
                $vector = [
                    "stock" => 0,
                    "estado" => 0,
                    "fecha_actualizacion" => date("Y-m-d H:i:s"),
                ];
            }else{
                $vector = [
                    "stock" => $restante,
                    "fecha_actualizacion" => date("Y-m-d H:i:s"),
                ];
            }
            $result = $productos->editar($datos["id"],$vector);
            if($result > 0){
                print_r(json_encode(array("status"=>"success", "message" => "", "data" => $productos->listado())));
            }else{
                print_r(json_encode(array("status"=>"error", "message" => "")));
            }
        }else{
            print_r(json_encode(array("status"=>"error", "message" => "")));
        }
    }
}
