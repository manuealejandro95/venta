<?php
class MvcController {
    public function inicio(){
        include "view/template.php";
    }

    /*este metodo es de navegacion nos permite evitar otros enlaces en la url*/
    public function Enlacescontroller(){
        if(isset($_GET['action'])){
            $enlace = $_GET['action'];
        }else{
            $enlace = "index.php";
        }
        $respuesta = MvcModel::Enlacesmodel($enlace);
        include $respuesta;
    }

    /* este metodo Pasamos los registros al modelo*/
    public function RegistrarController($datoscontroller){
        $respuesta = datos::registromodel($datoscontroller);
        return $respuesta;
    }

    public function validausercontroller($idclientmodel){
        $respuesta = datos::validausermodel($idclientmodel, "personas");
        return $respuesta;
    }

    public function validasesioncontroller($datosenvia){
        $respuesta = datos::validasesionmodel($datosenvia);
        return $respuesta;
    }

    public function Datoscontroller(){
        $respuesta = datos::DatosModel();
        return $respuesta;
    }

    public function DatosProductscontroller(){
        $respuesta = datos::DatosProductsModel();
        return $respuesta;
    }

    public function RegistrarProductController($datoscontroller){
        $respuesta = datos::registroProductmodel($datoscontroller);
        return $respuesta;
    }

    public function UpdateProductController($datoscontroller){
        $respuesta = datos::UpdateProductmodel($datoscontroller);
        return $respuesta;
    }

    public function DeleteProductController($idproductController){
        $respuesta = datos::DeleteProductModel($idproductController, "productos");
        return $respuesta;
    }

    public function validaProductcontroller($idproductController){
        $respuesta = datos::validaProductmodel($idproductController, "productos");
        return $respuesta;
    }

    public function ProductMaxStockController(){
        $respuesta = datos::ProductMaxStockModel();
        return $respuesta;
    }
}