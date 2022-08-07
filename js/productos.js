$('#modal').click(function(e){
    e.preventDefault();
    document.getElementById("formuproducto").reset();
 });
$(document).ready(function() {
    obtenerusuarios();
    obtenermaxstock()
    function obtenerusuarios(){
        $.ajax({
            url: 'view/task/datosproducts.php',            
            method: 'GET',
            cache: false,
            contentType: 'application/json; charset=utf-8',
            dataType: false,
            success: function (response) {
            //console.log(response);                
               let template = '';
               let datos = JSON.parse(response);
               if (response === "0"){
                    template += `
                        <div class="col-12 col-md-12 col-xl-12">
                            <p class="text-uppercase">No hay Productos registrados.</p>
                        </div>
                    `
               }else{
                    template+=`
                    <div class="col-12 col-md-12 col-xl-12">                        
                        <table class="table table-sm table-striped-custom text-center">
                            <thead class="bg-custom text-primary">
                                <tr class="h4 font-weight-bold">
                                    <th scope="col">Id Producto</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Referencia</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Peso</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Fecha</th>
                                    <th ></th>
                                    <th ></th>
                                </tr>
                            </thead>
                            <tbody>`                   
                            datos.forEach(dato => {                                 
                                template += `                                
                                        <tr class="h0">
                                            <td class="align-middle center">${dato.Id}</td>
                                            <td class="align-middle center">${dato.Nombre}</td>
                                            <td class="align-middle center">${dato.Referencia}</td>
                                            <td class="align-middle center">${dato.Precio}</td>
                                            <td class="align-middle center">${dato.Peso}</td>
                                            <td class="align-middle center">${dato.Categoria}</td>
                                            <td class="align-middle center">${dato.Cantidad}</td>
                                            <td class="align-middle center">${dato.Fecha}</td>
                                            <td class="align-middle center"><a class="btn btn-danger text-white" onclick="Delete(${dato.Id});" role="button">Eliminar</a></td>
                                            <td class="align-middle center"><a class="btn btn-info text-white" onclick="findeditar(${dato.Id});" role="button">Editar</a></td>  
                                        </tr>                        
                                `                       
                            });
                            template+=` 
                            </tbody>                                                
                        </table>
                    </div>`
               }
               $('#registros').html(template);
            }
        });
    }

    function obtenermaxstock(){
        $.ajax({
            url: 'view/task/maxstock.php',            
            method: 'GET',
            cache: false,
            contentType: 'application/json; charset=utf-8',
            dataType: false,
            success: function (response) {
            //console.log(response);                
               let template = '';
               let datos = JSON.parse(response);
               if (response === "0"){
                    template += `
                        
                    `
               }else{
                datos.forEach(dato => {                                 
                    template += `                                
                            <p>El Producto que mas Stock tiene es : ${dato.Nombre}</p>                        
                    `                       
                });
               }
               $('#stock').html(template);
            }
        });
    }
});

$('#enviar').click(function(e){
   e.preventDefault();   
   validaciones();
});
function validaciones(){
   switch(true){
       case $("#codigo").val().length === 0:
           Swal.fire({
               title: '<strong>Error</strong>',
               icon: 'error',
               html: '<p class="text-danger font-weight-bold">Codigo de producto vacío.</p>',
               showConfirmButton: false,
               timer: 5500,
               returnFocus: false
           });
           $("#codigo").focus();  
           break;        
       case $("#nombre").val().length === 0:
           Swal.fire({
               title: '<strong>Error</strong>',
               icon: 'error',
               html: '<p class="text-danger font-weight-bold">Nombre producto vacío.</p>',
               showConfirmButton: false,
               timer: 5500,
               returnFocus: false
           });
           $("#nombre").focus();  
           break;
       case $("#referencia").val().length === 0:
           Swal.fire({
                   title: '<strong>Error</strong>',
                   icon: 'error',
                   html: '<p class="text-danger font-weight-bold">Campo referencia vacío.</p>',
                   showConfirmButton: false,
                   timer: 5500,
                   returnFocus: false
           });
           $("#referencia").focus();  
           break;
       case $("#precio").val().length === 0:
           Swal.fire({
               title: '<strong>Error</strong>',
               icon: 'error',
               html: '<p class="text-danger font-weight-bold">Campo precio vacio.</p>',
               showConfirmButton: false,
               timer: 5500,
               returnFocus: false
           });
           $("#precio").focus();  
           break;        
       case $("#peso").val().length === 0:
           Swal.fire({
               title: '<strong>Error</strong>',
               icon: 'error',
               html: '<p class="text-danger font-weight-bold">Debe escribir el peso del producto.</p>',
               showConfirmButton: false,
               timer: 5500,
               returnFocus: false
           });
           $('#peso').focus();
           break;
       case $("#categoria").val().length === 0:
           Swal.fire({
               title: '<strong>Error</strong>',
               icon: 'error',
               html: '<p class="text-danger font-weight-bold">Debe escribir la categoría.</p>',
               showConfirmButton: false,
               timer: 5500,
               returnFocus: false
           });
           $('#categoria').focus();
           break;
      case $("#cantidad").val().length === 0:
            Swal.fire({
                title: '<strong>Error</strong>',
                icon: 'error',
                html: '<p class="text-danger font-weight-bold">Debe escribir la cantidad.</p>',
                showConfirmButton: false,
                timer: 5500,
                returnFocus: false
            });
            $('#cantidad').focus();
            break;
       default:
           let datos = new FormData();
           datos.append("codigo", $('#codigo').val());
           datos.append("nombre", $('#nombre').val());
           datos.append("referencia", $('#referencia').val());
           datos.append("precio", $('#precio').val());
           datos.append("peso", $('#peso').val());
           datos.append("categoria", $('#categoria').val());
           datos.append("cantidad", $('#cantidad').val());
           if ($('#accion').val() == "Editar"){
            update(datos)
           }else{
            enviarformulario(datos);
           }   
   }
}

function enviarformulario(datos){
   $.ajax({
       url:"view/task/registrerproducto.php",
       method: "POST",
       data: datos,
       cache: false,
       contentType: false,
       processData: false,
       success:function(respuesta){
           console.log(respuesta);
           switch(respuesta){
               case "1":
                   Swal.fire({
                       title: '<strong>Registro Exitoso</strong>',
                       icon: 'success',
                       html: '<p class="text-success font-weight-bold">Registro Exitoso.</p>',
                       showConfirmButton: false,
                       timer: 5000,
                       returnFocus: false
                   });
                   document.getElementById("formuproducto").reset();
                   window.setTimeout(function () {
                       window.location.href = "/venta/productos";
                   }, 6000)
                   break;                    
               case "2":
                   Swal.fire({
                       title: '<strong>Información</strong>',
                       icon: 'info',
                       html: '<p class="text-danger font-weight-bold">El producto que desea registrar ya existe. </p>',
                       showConfirmButton: false,
                       timer: 7000,
                       returnFocus: false
                   });
                   document.getElementById("formuproducto").reset();
                   window.setTimeout(function () {
                       window.location.href = "/venta/productos";
                   }, 8000)
                   break;                    
               default:
                   Swal.fire({
                       title: '<strong>Error</strong>',
                       icon: 'error',
                       html: '<p class="text-danger font-weight-bold">No se pudo realizar el registro.</p>',
                       showConfirmButton: false,
                       timer: 7000,
                       returnFocus: false
                   });
                   document.getElementById("formuproducto").reset();
           }                      
       }
   });
}

function findeditar(dato){
    $('#accion').val('Editar');
    $('#exampleModalScrollable').modal('show');
    $('#codigo').val(dato);
    let datos = new FormData();
    datos.append("codproduct", dato);
    $.ajax({
        url:"view/task/validaproduct.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta){
            let datos = JSON.parse(respuesta);
            if (respuesta === '[]'){
            }else{
                datos.forEach(dato => {                               
                    $('#nombre').val(dato.Nombre);
                    $('#referencia').val(dato.Referencia);
                    $('#precio').val(dato.Precio);
                    $('#peso').val(dato.Peso);
                    $('#categoria').val(dato.Categoria);
                    $('#cantidad').val(dato.Cantidad);                     
                });
            }             
        }
    });
}

function update(datos){
    $.ajax({
        url:"view/task/updateproduct.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta){
            console.log(respuesta);
            switch(respuesta){
                case "1":
                    Swal.fire({
                        title: '<strong>Registro Exitoso</strong>',
                        icon: 'success',
                        html: '<p class="text-success font-weight-bold">Actualizacion Exitosa.</p>',
                        showConfirmButton: false,
                        timer: 5000,
                        returnFocus: false
                    });
                    document.getElementById("formuproducto").reset();
                    window.setTimeout(function () {
                        window.location.href = "/venta/productos";
                    }, 6000)
                    break;                    
                default:
                    Swal.fire({
                        title: '<strong>Error</strong>',
                        icon: 'error',
                        html: '<p class="text-danger font-weight-bold">No se pudo actualizar el registro.</p>',
                        showConfirmButton: false,
                        timer: 7000,
                        returnFocus: false
                    });
                    document.getElementById("formuproducto").reset();
            }                      
        }
    });
}

function Delete(dato){
    Swal.fire({
        title: 'Esta seguro?',
        text: "Desea eliminar este producto! "+dato,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
      }).then((result) => {
        if (result.isConfirmed) {
            let datos = new FormData();
            datos.append("codproduct", dato);
            $.ajax({
                url:"view/task/deleteproduct.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success:function(respuesta){
                    console.log(respuesta);
                    switch(respuesta){
                        case "1":
                            Swal.fire({
                                title: '<strong>Registro Exitoso</strong>',
                                icon: 'success',
                                html: '<p class="text-success font-weight-bold">El registro ha sido eliminado.</p>',
                                showConfirmButton: false,
                                timer: 5000,
                                returnFocus: false
                            });
                            window.setTimeout(function () {
                                window.location.href = "/venta/productos";
                            }, 6000)
                            break;                    
                        default:
                            Swal.fire({
                                title: '<strong>Error</strong>',
                                icon: 'error',
                                html: '<p class="text-danger font-weight-bold">No se pudo eliminar el registro.</p>',
                                showConfirmButton: false,
                                timer: 7000,
                                returnFocus: false
                            });
                    }                      
                }
            });
        }
      })
}
