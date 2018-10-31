<?php
    $stmt =	Datos::getAdministradores();
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
          <td align="center"><b>Nombre</b></th>
          <td align="center"><b>Correo</b></th>
          <td align="center"><b>Contraseña</b></th>
          <td align="center" style="width:40px"><b>Editar</b></th>
          <td align="center" style="width:50px"><b>Borrar</b></th>
        </tr>
                </thead>
                <tbody>
                <?php while($datos = $stmt->fetch(PDO::FETCH_ASSOC))
              //Se hace un array asociativo para poder sacar los valores
                  {?>
                  <tr>
                <td align="center"><?= $datos['nombre'] ?></td>
                <td align="center"><?= $datos["correo"] ?></td>
                <td align="center"><?= $datos["contrasena"] ?></td>
                <td style="width:40px"><a href="index.php?action=editarAdministrador&id=<?= $datos["idUsuario"] ?>">
                <button type="button" class="btn btn-warning">Editar</button>
                </a></td>
                <td><a href="index.php?action=eliminarAdministrador&id=<?= $datos['idUsuario'] ?>">
                <button type="button" class="btn btn-danger">Borrar</button>
                </a></td>
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