<script src="<?= BACKEND_STATIC_FILES ?>/bower_components/select2/dist/js/select2.full.min.js"></script>
<link rel="stylesheet" href="<?= BACKEND_STATIC_FILES ?>/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?= BACKEND_STATIC_FILES ?>/bower_components/select2/dist/css/select2-bootstrap.css">
<div class="content-wrapper">
  <section class="content">
    <!-- Default box -->
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">
          <b>
            <?php
            if(isset($title_page)){
              echo $title_page;
            }
            ?>
          </b>
        </h3>
      </div>
      <div class="box-body">
        <!-- text input -->
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" placeholder="..." id="name">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Alias</label>
              <input type="text" class="form-control" placeholder="..." id="alias">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Pengurus Cabang</label>
              <select class="form-control select2" style="width: 100%;" id="pc">
                <?php
                if(isset($pc_options)){
                  foreach($pc_options as $opt){
                    echo "<option value=".$opt->pc_id.">".$opt->pc_name."</option>";
                  }
                }
                ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">

            <div class="form-group">
              <label>Kontak</label>
              <input type="text" class="form-control" placeholder="..." id="contact">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">

            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control" placeholder="..." id="email">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Alamat</label>
              <textarea class="form-control" rows="3" placeholder="..." id="address"></textarea>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Logo</label>
              <input type="file" accept="image/*" class="" name="logo" onchange="load_logo(event)" id="logo">
              <br>
              <input type="hidden" id="max_num_gallery" value=''>
              <img id="output_logo" style="width:200px;height:150px" class="img img-thumbnail" src="<?= base_url().BACKEND_IMAGE_UPLOAD_FOLDER . 'dummy_logo.png' ?>"/>
              <br><br>

              <script>
              var load_logo = function (event) {
                var output_logo = document.getElementById('output_logo');
                output_logo.src = URL.createObjectURL(event.target.files[0]);
              };
              </script>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Cover</label>
              <input type="file" accept="image/*" class="" name="cover" onchange="load(event)" id="cover">
              <br>
              <input type="hidden" id="max_num_gallery" value=''>
              <img id="output_cover" style="width:1024px;height:200px;background-repeat: repeat-x;" class="img img-thumbnail" src="<?= base_url().BACKEND_IMAGE_UPLOAD_FOLDER . 'dummy_cover.png' ?>"/>
              <br><br>
              <script>
              var load = function (event) {
                var output = document.getElementById('output_cover');
                output.src = URL.createObjectURL(event.target.files[0]);
              };
              </script>
            </div>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="pull-right btn btn-flat btn-success" onclick="post()"><i class="fa fa-save"></i>&nbsp; Simpan</button>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->

    <!-- /.content-wrapper -->

  </div>
  <script>
  $('.select2').select2()
  </script>
