
<?php
$stmt =	Datos::getEquipos();
$stmt2 =	Datos::getJugadores();
$registro = new MvcControlador();

//se invoca la funcion registrousuariocontroller de la clase mvccontroller;
$resultado= $registro -> AddJugadorSelecion();
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

    ?>


    <div align="center">
        <h1>Agregar Jugador a equipo</h1>
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">Ingrese los datos</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form method="POST" enctype="multipart/form-data">
                  <div class="col-md-10 col-md-offset-1">
                    <label for="texto">Jugador</label>
                     <select class="form-control" name="jugador">
                       <?php while($datos = $stmt2->fetch(PDO::FETCH_ASSOC))
                    //Se hace un array asociativo para poder sacar los valores
                        {?>
                      <option value="<?=$datos["idJugador"]?>"><?=$datos["nombre"]?></option>
                       <?php }?>
                    </select>
                  </div>
                  <div class="col-md-10 col-md-offset-1">
                    <label for="texto">Equipo</label>
                       <select class="form-control" name="equipo">
                         <?php while($datos = $stmt->fetch(PDO::FETCH_ASSOC))
                      //Se hace un array asociativo para poder sacar los valores
                          {?>
                        <option value="<?=$datos["idEquipo"]?>"><?=$datos["nombre"]?></option>
                         <?php }?>
                      </select>
                    <br>
                   </div>
                    <button type="submit" class="btn btn-primary" >Agregar Jugador</button><br><br>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>