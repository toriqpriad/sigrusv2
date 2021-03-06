<script src="<?= BACKEND_STATIC_FILES ?>/bower_components/select2/dist/js/select2.full.min.js"></script>
<link rel="stylesheet" href="<?= BACKEND_STATIC_FILES ?>/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?= BACKEND_STATIC_FILES ?>/bower_components/select2/dist/css/select2-bootstrap.css">
<div class="content-wrapper">
  <section class="content">
    <!-- Default box -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs pull-right">
        <li class=""><a href="#akun" data-toggle="tab" aria-expanded="false">Akun</a></li>
        <li class=""><a href="#pengurus" data-toggle="tab" aria-expanded="false">Pengurus</a></li>
        <li class=""><a href="#image" data-toggle="tab" aria-expanded="false">Logo & Cover</a></li>
        <li class><a href="#profil" data-toggle="tab" aria-expanded="false">Profil</a></li>
        <li class><a href="#Kegiatan" data-toggle="tab" aria-expanded="false">Kegiatan</a></li>
        <li class=""><a href="#siswa" data-toggle="tab" aria-expanded="false">Siswa</a></li>
        <li class=""><a href="#pengajar" data-toggle="tab" aria-expanded="false">Pengajar</a></li>
        <li class="active"><a href="#index" data-toggle="tab" aria-expanded="true">Overview</a></li>
        <li class="pull-left header">
          <?php
          if (isset($title_page)) {
            echo $title_page;
          }
          ?>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane" id="akun">
          <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" value="<?=$records->username?>" id="username">
          </div>
          <div class="form-group">
            <label>Password</label><br>
            <button class="btn btn-flat btn-warning btn-md" onclick="showPassword()">Ganti Password</button>
          </div>
        </div>
        <div class="tab-pane" id="profil">
          <!-- <div class="row"></div> -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" value="<?=$records->name?>" id="name">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Alias</label>
                <input type="text" class="form-control" value="<?=$records->alias?>" id="alias">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Pengurus Cabang (PC)</label>
                <select class="form-control select2" style="width: 100%;" id="pc">
                  <?php
                  if (isset($pc_options)) {
                    foreach ($pc_options as $opt) {
                      if ($records->id_pc == $opt->pc_id) {
                        echo "<option value=".$opt->pc_id." selected>".$opt->pc_name."</option>";
                      } else {
                        echo "<option value=".$opt->pc_id.">".$opt->pc_name."</option>";
                      }
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Kontak</label>
                <input type="text" class="form-control" value="<?=$records->contact?>" id="contact">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" rows="3" id="address"><?=$records->address?></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" value="<?=$records->email?>" id="email">
              </div>
            </div>
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="image">
          <div class="form-group">
            <label>Logo</label>
            <input type="file" accept="image/*" class="" name="logo" onchange="load_logo(event)" id="logo">
            <input type="hidden" id="logo_old" value='<?= $records->logo_old ?>'>
            <input type="hidden" id="logo_new" value=''>
            <br>
            <input type="hidden" id="max_num_gallery" value=''>
            <img id="output_logo" style="width:200px;height:150px;" class="img img-thumbnail" src="<?= $records->logo ?>"/>
            <br><br>

            <script>
            var load_logo = function (event) {
              var output_logo = document.getElementById('output_logo');
              output_logo.src = URL.createObjectURL(event.target.files[0]);
              $('#logo_new').val(event.target.files[0].name);
            };
            </script>
          </div>
          <div class="form-group">
            <label>Cover</label>
            <input type="file" accept="image/*" class="" name="logo" onchange="load_cover(event)" id="cover">
            <input type="hidden" id="cover_old" value='<?= $records->cover_old ?>'>
            <input type="hidden" id="cover_new" value=''>
            <br>
            <input type="hidden" id="max_num_gallery" value=''>
            <img id="output_cover" style="width:1024px;height:200px;background-repeat: repeat-x;" class="img img-thumbnail" src="<?= $records->cover ?>"/>
            <br><br>

            <script>
            var load_cover = function (event) {
              var output_cover = document.getElementById('output_cover');
              output_cover.src = URL.createObjectURL(event.target.files[0]);
              $('#cover_new').val(event.target.files[0].name);
            };
            </script>
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="pengurus">
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
        <div class="tab-pane" id="Kegiatan">
          Kegiatan
        </div>
        <div class="tab-pane active" id="index">
          Overview
        </div>

        <div class="tab-pane " id="siswa">
          <br><br>
          <center><i class="fa fa-3x fa-spin fa-refresh"></i></center>
        </div>

        <div class="tab-pane" id="pengajar">
          <br><br>
          <center><i class="fa fa-3x fa-spin fa-refresh"></i></center>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
      <div class="box-footer">
        <input type="hidden" id="edit_id" value="<?=$records->id?>">
        <a href="javascript:history.back()"  class="btn btn-default btn-flat btn-fill btn-wd pull-left" ><i class="fa fa-arrow-left"></i>&nbsp;Kembali</a>
        <button type="submit" class="pull-right btn btn-flat btn-success" onclick="update()"><i class="fa fa-save"></i>&nbsp; Simpan</button>
      </div>
    </div>

    <!-- /.box -->

  </section>
  <!-- /.content -->

  <!-- /.content-wrapper -->

</div>
<script>
$('.select2').select2();
</script>

<div class="modal fade"  aria-labelledby="myModalLabel" id="PasswordModal" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ganti Password</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Masukkan Password Baru</label>
              <input type="password" class="form-control border-input" id="new_pass" >
              <br>
              <?php if($records->user_status == 'N') {
                echo '<small>NB : User baru saja dibuat, password sama dengan username.</small>';
              }?>

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="ChangePass()">Ya</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
        </div>
      </div>

    </div>
  </div>
</div>
