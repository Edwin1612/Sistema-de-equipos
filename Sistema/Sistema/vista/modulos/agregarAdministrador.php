<?php
$registro = new MvcControlador();

//se invoca la funcion registrousuariocontroller de la clase mvccontroller;
$resultado= $registro -> AddAdministrador();

?>

<div class="col-md-12">
    <?php
        if($resultado=="success")
        {   echo '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Correcto!</h4>
                Agregado Satisfactoriamente 
            </div>';
        }
        if($resultado=="repetido")
        {
            echo '
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Correo Repetido</h4>
                Intenta con otro correo electronico
            </div>';
        }

    ?>


    <div align="center">
        <h1>Agregar Administrador</h1>
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">Ingrese los datos</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form method="POST">
                <div class="box-body">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="nombre" required>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputEmail1">Correo</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="" name="correo" required>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputEmail1">Contraseña</label>
                    <input type="password" class="form-control" id="exampleInputEmail1" placeholder="" name="contrasena" required>
                    </div>
                    
                    </div>
                    <button type="submit" class="btn btn-primary" >Agregar Administrador</button><br><br>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>