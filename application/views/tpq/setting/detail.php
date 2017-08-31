<script src="<?= BACKEND_STATIC_FILES ?>/bower_components/jquery-md5/jquerymd5.js"></script>
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

        <span class="pull-right">Update Terakhir :
          <?php
          if(isset($records)){
            echo $records->update_at;
          }
          ?> </span>
        </h3>

        <div class="panel-body">
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

          <div class='row'>
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
                <label>Kontak</label>
                <input type="text" class="form-control" value="<?=$records->contact?>" id="contact">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control" rows="3" id="address"><?=$records->address?></textarea>
              </div>
            </div>
          </div>

          <hr>
          <div class='row'>
            <div class='col-md-6'>
              <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" value="<?=$records->email?>" id="username">
              </div>
            </div>
            <div class='col-md-6'>
              <div class="form-group">
                <label>Password</label><br>
                <button class="btn btn-flat btn-danger btn-md">Ganti Password</button>
              </div>
            </div>
          </div>
          <hr>
          <div class='row'>
            <div class='col-md-6'>
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
            </div>
            <div class="col-md-6">
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
          </div>
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
              <div class="col-md-6">
                <div class="form-group">
                  <label>Masukkan Password Lama</label>
                  <input type="password" class="form-control border-input" id="old_pass">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Masukkan Password Baru</label>
                  <input type="password" class="form-control border-input" id="new_pass" >
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
