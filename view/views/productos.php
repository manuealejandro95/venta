<?php
    session_start();
    if (isset($_SESSION['username'])){
        $usuario= $_SESSION['username'];
    }else{
        header("location: /venta/sesion");
    }
    
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="salir">Cerrar Sesion</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="inicio">Usuarios</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="productos">Productos</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="venta">Ventas</a>
      </li>
      <!--<li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled">Disabled</a>
      </li>-->
    </ul>
    <ul class="nav justify-content-end">
        <li class="nav-item">
            <p class="nav-link">Bienvenido <?php echo $usuario;?></p>
        </li>
    </ul>
  </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col text-center">
            <h2>Productos</h2>
        </div>
    </div>
    <div class="row">
      <div class="col">
        <button type="button" id="modal" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable">
          Nuevo Producto
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Registrar Producto Nuevo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form method="POST" id="formuproducto">
                    <input type="text" id="accion" style="display: none;">              
                    <div class="form-row justify-content-center">                        
                        <div class="form-group col-md-6">
                            <label for="codigo">Codigo</label>
                            <input type="text" class="form-control" name="codigo" id="codigo">
                        </div>
                        <div class="form-group col-md-6" id="nombres">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" placeholder="Digitar nombre del Producto" name="nombre"
                                id="nombre">
                        </div>          
                    </div>
                    <div class="form-row">                        
                        <div class="form-group col-md-6" id="apellido">
                            <label for="referencia">Referencia</label>
                            <input type="text" class="form-control" placeholder="Digitar Referencia" name="referencia"
                                id="referencia">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="precio">Precio</label>
                            <input name="precio" type="number" class="form-control" id="precio">
                        </div>
                    </div>
                    <div class="form-row">                        
                        <div class="form-group col-md-4">
                            <label for="peso">Peso</label>
                            <input type="number" name="peso" class="form-control" id="peso" placeholder="Solo entero">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="categoria">Categoría</label>
                            <input type="text" name="categoria" class="form-control" id="categoria">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="cantidad">Cantidad</label>
                            <input name="cantidad" type="number" class="form-control" id="cantidad">
                        </div>
                    </div>
                    <div class="row justify-content-center mb-3">
                        <div class="col-6 col-sm-6 col-xl-6">
                            <button id="enviar" class="btn btn-lg btn-block btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col" id="stock">

      </div>
    </div>
    <div class="row mt-2" id="registros">
    </div>
</div>
<script src="js/productos.js?v=<?php echo(rand()); ?>"></script>