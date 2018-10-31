<?php
if(isset($_GET["id"]))
{
    $id =$_GET["id"];
    $stmt3= Datos::getJugadoresID($id);
}
?>

<div class="col-md-12">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?=$stmt3["ruta_img"]?>" alt="User profile picture">

              <h3 class="profile-username text-center">Nombre del Jugador: <?=$stmt3["nombre"]?></h3>
               <h3 class="profile-username text-center">Tipo de jugador: <?=$stmt3["tipoJugador"]?></h3>
              <h3 class="profile-username text-center">Equipo: <?=$stmt3["idEquipo"]?></h3>
            </div>
            <!-- /.box-body -->
          </div>
        </div>