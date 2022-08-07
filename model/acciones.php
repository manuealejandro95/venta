<?php
require_once "conexion.php";
class datos extends Conexion {

    public function registromodel($datos){   
            $con = Conexion::getInstance()->Conectar();
            $clave = hash('md5',$datos["contrasena"]);
            $query = "CALL RegistraPersonas ('".$datos["nombre"]."','".$datos["apellido"]."','".$datos["id"]."','".$datos["correo"]."','".$datos["tipoid"]."','".$datos["id"]."','".$clave."')";
            $stmt = mysqli_query($con, $query);
            

            if($stmt){  
                return 1;
            }else{
                printf("Errormessage: %s\n", mysqli_error($con));
            }
    }

    public function validausermodel($idclientmodel, $tabla ){
        $conn2= Conexion::getInstance()->Conectar();
        $query = "SELECT * FROM $tabla WHERE Numeroident = '".$idclientmodel."'";
        $result3 = mysqli_query($conn2, $query);
        
        if($result3){
            $rows= mysqli_num_rows($result3);
            if ($rows > 0){
                return 1;
            }else{
                return 0;
            }
        } 
    }

    public function validasesionmodel($datos){
        $conn= Conexion::getInstance()->Conectar();
        $clave = hash('md5',$datos["contrasena"]);
        $query = "SELECT P.Nombres AS Nombrecompleto, 'cliente' AS Tipo FROM Personas P INNER JOIN Usuarios U ON P.Numeroident = U.Identificador WHERE P.Numeroident  = '".$datos["usuario"]."' AND U.Pass = '".$clave."'";
        $result = mysqli_query($conn, $query);
        
        if($result){
            $rows= mysqli_num_rows($result);            
            if ($rows > 0){
                while($row = mysqli_fetch_array($result)) {
                    $json[] = array(
                        'usuario' => $row['Nombrecompleto'],
                        'tipo' => $row['Tipo']
                    );
                    }
    
                    return $json;
    
                    mysqli_close($conn);
            }else{
                return 0;
            }
        }
    }

    public function DatosModel(){
        $conn= Conexion::getInstance()->Conectar();
        $query = "SELECT Numeroident,Nombres,email,DATE_FORMAT(Fechacreacion,'%d-%m-%Y') AS Fechacreacion FROM personas ORDER BY Fechacreacion";
        $result = mysqli_query($conn, $query);
        
        if($result){
            $rows= mysqli_num_rows($result);
            if ($rows > 0){
                while($row = mysqli_fetch_array($result)) {
                        $json[] = array(
                            'Id' => $row['Numeroident'],
                            'usuario' => $row['Nombres'],
                            'Email' => $row['email'],
                            'Fecha' => $row['Fechacreacion']                            
                        );
                }        
                $jsonstring= json_encode($json);                
                return $jsonstring;   
        
                mysqli_close($conn);
            }else{
                return 0;
            }
        }
    }

    public function registroProductmodel($datos){   
        $con = Conexion::getInstance()->Conectar();
        $query = "INSERT INTO productos(id, Nombre, Referencia, Precio, Peso, Categoria, Cantidad, Fechaingreso) VALUES ('".$datos["codigo"]."','".$datos["nombre"]."','".$datos["referencia"]."','".$datos["precio"]."','".$datos["peso"]."','".$datos["categoria"]."','".$datos["cantidad"]."',NOW(3))";
        $stmt = mysqli_query($con, $query);
        

        if($stmt){  
            return 1;
        }else{
            printf("Errormessage: %s\n", mysqli_error($con));
        }
    }

    public function UpdateProductmodel($datos){   
        $con = Conexion::getInstance()->Conectar();
        $query = "UPDATE productos SET id='".$datos["codigo"]."', Nombre='".$datos["nombre"]."', Referencia='".$datos["referencia"]."', Precio='".$datos["precio"]."', Peso='".$datos["peso"]."', Categoria='".$datos["categoria"]."', Cantidad='".$datos["cantidad"]."'
        WHERE id='".$datos["codigo"]."'";
        $stmt = mysqli_query($con, $query);        

        if($stmt){  
            return 1;
        }else{
            printf("Errormessage: %s\n", mysqli_error($con));
        }
    }

    public function DeleteProductModel($idproductmodel, $tabla ){   
        $con = Conexion::getInstance()->Conectar();
        $query = "DELETE
        FROM $tabla
        WHERE id='".$idproductmodel."'";
        $stmt = mysqli_query($con, $query);        

        if($stmt){  
            return 1;
        }else{
            printf("Errormessage: %s\n", mysqli_error($con));
        }
    }

    public function validaProductmodel($idproductmodel, $tabla ){
        $conn= Conexion::getInstance()->Conectar();
        $query = "SELECT id, Nombre, Referencia, Precio, Peso, Categoria, Cantidad FROM $tabla WHERE id = '".$idproductmodel."'";
        $result3 = mysqli_query($conn, $query);
        
        if($result3){
            $rows= mysqli_num_rows($result3);
            if ($rows > 0){
                while($row = mysqli_fetch_array($result3)) {
                    $json[] = array(
                        'Nombre' => $row['Nombre'],
                        'Referencia' => $row['Referencia'],
                        'Precio' => $row['Precio'],
                        'Peso' => $row['Peso'],
                        'Categoria' => $row['Categoria'],
                        'Cantidad' => $row['Cantidad'],                           
                    );
            }        
            $jsonstring= json_encode($json);                
            return $jsonstring;   
    
            mysqli_close($conn);
            }else{
                return 0;
            }
        } 
    }

    public function DatosProductsModel(){
        $conn= Conexion::getInstance()->Conectar();
        $query = "SELECT id, Nombre, Referencia, Precio, Peso, Categoria, Cantidad, DATE_FORMAT(Fechaingreso,'%d-%m-%Y') AS Fechaingreso FROM productos ORDER BY Cantidad DESC";
        $result = mysqli_query($conn, $query);
        
        if($result){
            $rows= mysqli_num_rows($result);
            if ($rows > 0){
                while($row = mysqli_fetch_array($result)) {
                        $json[] = array(
                            'Id' => $row['id'],
                            'Nombre' => $row['Nombre'],
                            'Referencia' => $row['Referencia'],
                            'Precio' => $row['Precio'],
                            'Peso' => $row['Peso'],
                            'Categoria' => $row['Categoria'],
                            'Cantidad' => $row['Cantidad'],
                            'Fecha' => $row['Fechaingreso']                            
                        );
                }        
                $jsonstring= json_encode($json);                
                return $jsonstring;   
        
                mysqli_close($conn);
            }else{
                return 0;
            }
        }
    }

    public function ProductMaxStockModel(){
        $conn= Conexion::getInstance()->Conectar();
        $query = "SELECT Nombre FROM productos WHERE Cantidad = (SELECT MAX(Cantidad) FROM productos)";
        $result = mysqli_query($conn, $query);
        
        if($result){
            $rows= mysqli_num_rows($result);
            if ($rows > 0){
                while($row = mysqli_fetch_array($result)) {
                        $json[] = array(
                            'Nombre' => $row['Nombre']                           
                        );
                }        
                $jsonstring= json_encode($json);                
                return $jsonstring;   
        
                mysqli_close($conn);
            }else{
                return 0;
            }
        }
    }
}