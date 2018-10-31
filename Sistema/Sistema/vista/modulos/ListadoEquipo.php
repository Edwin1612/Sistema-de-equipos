<?php
    $stmt =	Datos::getEquipos();
?>

<section class="content">
      <div class="row">
        <div class="col-xs-10 col-md-offset-1">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de Equipos</h3>
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
                  <th>Nombre</th>
                  <th>Tipo de equipo</th>
                  <th align="center" style="width:40px">Editar</th>
                  <th align="center" style="width:40px">Borrar</th>
                </tr>
                </thead>
                <tbody>
                <?php while($datos = $stmt->fetch(PDO::FETCH_ASSOC))
              //Se hace un array asociativo para poder sacar los valores
                  {?>
                <tr>
                  <td><?= $datos['nombre'] ?></td>
                  <td ><?= $datos['tipoEquipo'] ?></td>
                  <td align="center"><a href="index.php?action=editarEquipo&id=<?= $datos['idEquipo'] ?>">
                    <button type="button" class="btn btn-warning">Editar</button>
                  </a></td>
                  <td align="center"><a href="index.php?action=eliminar&id=<?= $datos['idEquipo'] ?>">
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

