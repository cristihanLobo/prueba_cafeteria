<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function iniciar()
    {
        $datos = $this->request->getPost();
        if($datos["usuario"] != "" && $datos["contra"] != ""){
            if($datos["usuario"] == "admin" && $datos["contra"] == "admin123"){
                print_r(json_encode(array("status"=>"success", "message" => "")));
            }else{
                print_r(json_encode(array("status"=>"error", "message" => "")));
            }
        }else{
            print_r(json_encode(array("status"=>"error", "message" => "")));
        }
    }
}
