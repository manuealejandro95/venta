<?php   

    require_once "../../controller/controller.php";
    require_once "../../model/acciones.php";

    class MvcDatosMaxProduct{
        public function DatosMaxProductsView(){
                    $respuesta = MvcController::ProductMaxStockController();
                    echo $respuesta;
        }
    }

    $data = new MvcDatosMaxProduct();
    $data -> DatosMaxProductsView();