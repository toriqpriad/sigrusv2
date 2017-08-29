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
          <!-- text input -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#info" aria-controls="1" role="tab" data-toggle="tab">Info</a></li>
            <li role="presentation"><a href="#socmed" aria-controls="2" role="tab" data-toggle="tab">Social Media</a></li>
            <li role="presentation"><a href="#akun" aria-controls="2" role="tab" data-toggle="tab">Akun</a></li>
          </ul>
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="info">
              <br>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control border-input" id="name" required value="<?=$records->site_name?>">
                    <input type="hidden" class="form-control border-input" id="edit_id" value="<?=$records->id?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Moto</label>
                    <input type="text" class="form-control border-input" id="moto"  value="<?=$records->site_moto?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control border-input" id="desc"><?=$records->site_description?></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control border-input" id="addr"><?=$records->site_address?></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Kontak</label>
                    <input type="text" class="form-control border-input" id="contact" value="<?=$records->site_contact?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control border-input" id="email" value="<?=$records->site_email?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Logo</label>
                    <input type="file" accept="image/*" class="" name="logo" onchange="load_logo(event)" id="logo">
                    <input type="hidden" id="logo_old" value='<?= $records->logo_old ?>'>
                    <input type="hidden" id="logo_new" value=''>
                    <br>
                    <input type="hidden" id="max_num_gallery" value=''>
                    <img id="output_logo" style="width:200px;height:150px" class="img img-thumbnail" src="<?=$records->logo ?>"/>
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
              </div>
              <div class="row">
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="socmed">
              <br>
              <?php
              if(isset($site_scm)){
                foreach($site_scm as $each){
                  ?>
                  <div class="form-group">
                    <label><?=$each['sc_name']?></label>
                    <input type="text" class="form-control border-input social-media" value="<?=$each['scm_url']?>" id="<?=$each['sc_id']?>">
                  </div>
                  <?php
                }
              }
              ?>
              <hr>

                <div class="form-group">
                  <label>Youtube Channel ID </label>
                  <div class="form-inline">
                  <div class="form-group">
                    <input type="text" class="form-control" id="id_channel" placeholder="Youtube Channel ID" value='<?= $records->site_video_id_channel ?>'>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" id="youtube_api_key" placeholder="Youtube API Key" value='<?= $records->site_video_api_key ?>'>
                  </div>
                  <button onclick="checkyoutubeapi()" class="btn btn-default  btn-flat ">Periksa</button>
                  <span class="pull-right" id="results"></span>
                </div>
              </div>

              <div class="check_div">

              </div>
            </div>



            <div role="tabpanel" class="tab-pane" id="akun">
              <br>
              <div class="row">
                <div class="col-lg-8">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control border-input" id="username" required value="<?=$akun->username?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Password</label>
                    <br>
                    <button class="btn btn-fill btn-primary" onclick="showPassword()">Ganti Password</button>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- input states -->

          <!-- /.box-body -->
        </div>
        <div class="box-footer">
          <input type="hidden" id="edit_id" value="<?=$records->id?>">
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
