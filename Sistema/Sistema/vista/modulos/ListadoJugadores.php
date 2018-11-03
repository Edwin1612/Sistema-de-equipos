<?php
    $stmt =	Datos::getSelecionesJug();
?>

<section class="content">
      <div class="row">
        <div class="col-xs-10 col-md-offset-1">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de alumnos</h3>
            </div>
           
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Rango de filas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <td ><b>Nombre del Jugador</b></th>
                <td ><b>Deporte</b></th>
                <td ><b>Equipo</b></th>
                <td align="center" style="width:40px"><b>Editar</b></th>
                <td align="center" style="width:40px"><b>Borrar</b></th>
                </tr>
                </thead>
                <tbody>
                <?php while($datos = $stmt->fetch(PDO::FETCH_ASSOC))
              //Se hace un array asociativo para poder sacar los valores
                  {?>
                  <tr>
                    <td align="center"><a href="index.php?action=perfil&id=<?= $datos['idJugador'] ?>"><?= $datos['nombreJugador'] ?></a></td>
                    <?php
                        $stmt2 =	Datos::getEquipoID($datos["idEquipo"]);
                    ?>
                    <td align="center"><?= $datos['tipo'] ?></td>
                    <td align="center"><?= $datos["equipo"] ?></td>
                    <td style="width:40px"><a href="index.php?action=editarJugador&id=<?= $datos["idJugador"] ?>">
                    <button type="button" class="btn btn-warning">Editar</button>
                    </a></td>
                    <td>
                      <a href="index.php?action=eliminarJugador&id=<?= $datos['idJugador'] ?>">
                      <button type="button" class="btn btn-danger">Borrar</button>
                      </a>
                    </td>
                </tr>
                <?php }?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>