<div class="content-wrapper">

  <section class="content">
    <!-- Default box -->
    <div class="panel panel-default">
        <h3 class="panel-heading panel-title">
          <b>
            <?php
            if(isset($title_page)){
              echo $title_page;
            }
            ?>
          </b>
        </h3>
      <div class="box-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Pengurus TPQ</th>
              <th>Nama Personil</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (isset($records)) {
              $x = 0;
              foreach ($records as $each) {
                echo "<tr>";
                echo '<td>' . $each->name_position . '</td>';
                echo "<td><input type='hidden' value='" . $each->id_position . "'><input type='text' class='position_data form-control' id='" . $each->id_position . "' value='" . $each->name . "'></td>";
                echo "</tr>";
                $x++;
              }
            }
            ?>
          </tbody>
        </table>
        </div>
        <div class="box-footer">
          <a type="submit" class="pull-left btn btn-flat btn-warning" href="<?=base_url().'tpq/position/'?>"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
          <button type="submit" class="pull-right btn btn-flat btn-success" onclick="update()"><i class="fa fa-save"></i>&nbsp; Simpan</button>
        </div>
        </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->

      <!-- /.content-wrapper -->

    </div>
