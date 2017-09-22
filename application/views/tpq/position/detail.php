<script src="<?= BACKEND_STATIC_FILES ?>/bower_components/jquery-md5/jquerymd5.js"></script>
<div class="content-wrapper">

  <section class="content">
    <br>
    <div class="panel panel-default">



      <div class="panel-body">
        <table class="table table-bordered" >
          <thead>
            <tr>
              <th>Pengurus TPQ</th>
              <th>Nama Personil</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (isset($position)) {
              $x = 0;
              foreach ($position as $each) {
                echo "<tr>";
                echo '<td>' . $each->name_position . '</td>';
                echo "<td><input type='hidden' value='" . $each->id_position . "'><input type='text' class='position_data form-control' id='" . $each->id_position . "' value='" . $each->name_person . "'></td>";
                echo "</tr>";
                $x++;
              }
            }
            ?>
          </tbody>
        </table>
      </div>
      <div class="box-footer">
        <a type="submit" class="pull-left btn btn-flat btn-warning" href="<?=base_url().'admin/slider/'?>"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
        <button type="submit" class="pull-right btn btn-flat btn-success" onclick="update()"><i class="fa fa-save"></i>&nbsp; Simpan</button>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->

    <!-- /.content-wrapper -->

  </div>
