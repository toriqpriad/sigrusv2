
<script src="<?= BACKEND_STATIC_FILES ?>bower_components/select2/dist/js/select2.full.min.js"></script>
<link rel="stylesheet" href="<?= BACKEND_STATIC_FILES ?>bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?= BACKEND_STATIC_FILES ?>bower_components/select2/dist/css/select2-bootstrap.css">
<script src="<?= BACKEND_STATIC_FILES ?>bower_components/input-mask/jquery.inputmask.js"></script>
<script src="<?= BACKEND_STATIC_FILES ?>bower_components/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?= BACKEND_STATIC_FILES ?>bower_components/input-mask/jquery.inputmask.extensions.js"></script>
<script src="<?= BACKEND_STATIC_FILES ?>bower_components/jquery-table2excel/jquery.table2excel.min.js"></script>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <br>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="box box-success">
      <br>
      <!-- <div class="row">
      <div class="col-md-12">


    </div>
  </div> -->
  <div class="box-body">
    <div class="col-md-12">
      <button class="btn pull-right btn-default btn-md btn-flat" type="button" data-toggle="collapse" data-target="#filter" aria-expanded="false" aria-controls="filter">
        <i class="fa fa-filter">&nbsp;</i>Filter Pencarian
      </button>
    </div>
    <div class="collapse"  id='filter'>
      <br><br><br>
      <div class="well">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" placeholder="..." id="name" >
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Gender</label><br>
              <?php
              $male = array("value" => 'M', "label" => 'Laki-laki');
              $female = array("value" => 'F', "label" => 'Perempuan');
              $gender = array($male,$female);
              ?>
              <select class="form-control" id="gender">
                <?php
                echo "<option value=''> Semua </option>";
                foreach($gender as $opt){
                  echo "<option value=".$opt['value'].">".$opt['label']."</option>";
                }
                ?>

              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Tempat & Tanggal Lahir</label>
              <div class="row">
                <div class="col-xs-4">
                  <input type="text" class="form-control" placeholder="" id="place_birth" >
                </div>
                <div class="col-xs-8">
                  <input type="text" class="form-control" id="date_birth" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" >
                  <script>
                  $('#date_birth').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
                  </script>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Kategori Pengajar</label><br>
              <?php
              $empty = array("value" => '', "label" => 'Semua');
              $mt = array("value" => 'MT', "label" => 'Mubalegh Tugas');
              $ms = array("value" => 'MS', "label" => 'Mubalegh Setempat');
              $pb = array("value" => 'PB', "label" => 'Pribumi');
              $kat = array($empty, $mt,$ms,$pb);
              ?>
              <select class="form-control" id="teacher_category">
                <?php
                foreach($kat as $opt){
                  echo "<option value=".$opt['value'].">".$opt['label']."</option>";
                }
                ?>

              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control" placeholder="..." id="email" >
            </div>
          </div>

          <div class="col-md-6">

            <div class="form-group">
              <label>Kontak</label>
              <input type="text" class="form-control" placeholder="..." id="contact" >
            </div>

          </div>
          <div class="row"></div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Pendidikan Terakhir</label><br>
              <?php
              $empty = array("value" => '', "label" => 'Semua');
              $sd = array("value" => 'SD', "label" => 'SD');
              $smp = array("value" => 'SMP', "label" => 'SMP');
              $sma = array("value" => 'SMA', "label" => 'SMA');
              $diploma = array("value" => 'Diploma', "label" => 'Diploma');
              $sarjana = array("value" => 'Sarjana', "label" => 'Sarjana');
              $pdk = array($empty,$sd,$smp,$sma,$diploma,$sarjana);
              ?>
              <select class="form-control" id="education">
                <?php
                foreach($pdk as $opt){
                  echo "<option value=".$opt['value'].">".$opt['label']."</option>";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Keterangan Pendidikan</label>
              <input type="text" class="form-control" placeholder="..." id="education_detail" >
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Keaktifan</label><br>
              <?php
              $a = array("value" => 'A', "label" => 'Aktif');
              $n = array("value" => 'N', "label" => 'Nonaktif');
              $status = array($a,$n);
              ?>

              <select class="form-control" id="active">
                <?php
                echo "<option value=''> Semua </option>";
                foreach($status as $opt){
                  echo "<option value=".$opt['value'].">".$opt['label']."</option>";
                }
                ?>

              </select>
            </div>
          </div>

          <div class="col-md-6">

            <div class="form-group">
              <label>Status</label><br>
              <?php
              $single = array("value" => 'S', "label" => 'Lajang');
              $married = array("value" => 'M', "label" => 'Menikah');
              $kat = array($single,$married);
              ?>
              <select class="form-control" id="status">
                <?php
                echo "<option value=''> Semua </option>";
                foreach($kat as $opt){
                  echo "<option value=".$opt['value'].">".$opt['label']."</option>";
                }
                ?>

              </select>
            </div>

          </div>

        </div>
        <div class="row">
          <div class='col-md-12' id='btn_opt'>
            <button style="margin-left:10px;" class="pull-right btn btn-md btn-flat btn-primary" onclick="search()"><i class="fa fa-search"></i>&nbsp; Cari</button>
          </div>
        </div>
      </div>
    </div>
    <br><br><br>
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover dataTable table1 " style="font-size: 13px;">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Gender</th>
            <th>Kat. Pengajar</th>
            <th>TPQ - Alias</th>
            <th>TTL & Usia</th>
            <th>Status</th>
            <th>Pend. Terakhir</th>
            <th>Alamat</th>
            <th>Email</th>
            <th>Kontak</th>
            <th>Aktif</th>
            <th>Update Terakhir</th>
          </tr>
        </thead>
        <tbody id='table_body'>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- /.box -->

</section>
<!-- /.content -->

<!-- /.content-wrapper -->

</div>
<!-- <script>$('.table1').DataTable({
dom: 'Bfrtip',
buttons: [
'copy', 'csv', 'excel', 'pdf', 'print'
]
});</script> -->

<div class="modal fade"  aria-labelledby="myModalLabel" id="deleteModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Konfirmasi</h4>
      </div>
      <div class="modal-body">
        <p>Menghapus data ini berarti menonaktifkan beberapa data terkait. Yakin menghapus ?</p>
        <input type="hidden" id="del_id" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="Delete()">Ya</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
      </div>
    </div>

  </div>
</div>
