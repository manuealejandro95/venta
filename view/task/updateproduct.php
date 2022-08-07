<?php
    require_once "../../controller/controller.php";
    require_once "../../model/acciones.php";

    class MvcUpdateProduct{
        public $enviardata;
        public function UpdateProductView(){
            $datosenvia = $this->enviardata;
                if (isset($datosenvia["codigo"]) && isset($datosenvia["nombre"])){
                    $respuesta = Mvccontroller::UpdateProductController($datosenvia);
                    echo $respuesta;
                }else{
                    echo "3";
                }
        }
    }

    $data = new MvcUpdateProduct();
    $data -> enviardata = array("codigo"=>$_POST["codigo"],
                                "nombre"=>ucwords(strtolower($_POST["nombre"])),
                                "referencia"=>ucwords(strtolower($_POST["referencia"])),
                                "precio"=>$_POST["precio"],
                                "peso"=>$_POST["peso"],
                                "categoria"=>$_POST["categoria"],
                                "cantidad"=>$_POST["cantidad"]);
    $data -> UpdateProductView();