<?php
    require_once "../../controller/controller.php";
    require_once "../../model/acciones.php";

    class MvcRegistroProduct{
        public $enviardata;
        public function RegistrarProductView(){
            $datosenvia = $this->enviardata;
                if (isset($datosenvia["codigo"]) && isset($datosenvia["nombre"])){
                    $respuesta = Mvccontroller::RegistrarProductController($datosenvia);
                    echo $respuesta;
                }else{
                    echo "3";
                }
        }
    }

    $data = new MvcRegistroProduct();
    $data -> enviardata = array("codigo"=>$_POST["codigo"],
                                "nombre"=>ucwords(strtolower($_POST["nombre"])),
                                "referencia"=>ucwords(strtolower($_POST["referencia"])),
                                "precio"=>$_POST["precio"],
                                "peso"=>$_POST["peso"],
                                "categoria"=>$_POST["categoria"],
                                "cantidad"=>$_POST["cantidad"]);
    $data -> RegistrarProductView();