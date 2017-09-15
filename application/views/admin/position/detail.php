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
        <!-- text input -->
        <div class="form-group">
          <label>Nama</label>
          <input type="text" class="form-control" value="<?=$records->name?>" id="name">
        </div>


        <div class="form-group">
          <label>Deskripsi</label>
          <textarea class="form-control" id="desc"><?=$records->description?></textarea>
        </div>
        <div class="form-group">
          <label class="pull-left">Anggota</label>
          <button style="margin-bottom: 10px;" class="btn btn-xs btn-primary pull-right btn-flat" onclick="add_person_table()">Tambah</button>
          <small>
            <table class="table table-bordered" id="person_table" >          
              <thead>
                <tr>                
                  <th>Nama</th>
                  <th>Kontak</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (isset($person)) {
                  $x = 0;
                  foreach ($person as $each) {
                    echo "<tr class='position_data'>";
                    echo '<td><input type="text" class="name_person form-control" value="'.$each->name.'"></td>';
                    echo "<td><input type='hidden' value='" . $each->id . "'><input type='text' class='contact_person form-control'  value='" . $each->contact . "'></td>";
                    echo '<td><button class="btn btn-danger" onclick="delete_row(this)">Hapus</button></td>';
                    echo "</tr>";
                    $x++;
                  }
                }
                ?>
              </tbody>
            </table>
          </small>
        </div>
      
      <!-- input states -->

      <!-- /.box-body -->
    </div>
    <div class="box-footer">
      <input type="hidden" id="edit_id" value="<?=$records->id?>">
      <a type="submit" class="pull-left btn btn-flat btn-warning" href="<?=base_url().'admin/position/'?>"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
      <button type="submit" class="pull-right btn btn-flat btn-success" onclick="update()"><i class="fa fa-save"></i>&nbsp; Simpan</button>
    </div>
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->

<!-- /.content-wrapper -->

</div>
