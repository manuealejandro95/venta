<?php   

    require_once "../../controller/controller.php";
    require_once "../../model/acciones.php";

    class MvcSesion{
        public $enviardata;
        public function SesionView(){
            $datosenvia = $this->enviardata;
                if (isset($datosenvia["contrasena"]) && isset($datosenvia["usuario"])){
                    $respuesta = MvcController::validasesioncontroller($datosenvia);
                    $array = $respuesta;
                    if(isset($array[0]['usuario'])){
                        session_start();
                        $_SESSION['username'] = $array[0]['usuario'];
                        $url = "/venta/admin";
                        echo $url;
                    }else{
                        echo "0";
                    }                    
                }else{
                    echo "3";
                }
        }
    }

    $data = new MvcSesion();
    $data -> enviardata = array("usuario"=>$_POST["usuario"],
                                "contrasena"=>$_POST["contrasena"]);
    $data -> SesionView();