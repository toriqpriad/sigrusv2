<script src="<?= BACKEND_STATIC_FILES ?>/bower_components/select2/dist/js/select2.full.min.js"></script>
<link rel="stylesheet" href="<?= BACKEND_STATIC_FILES ?>/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?= BACKEND_STATIC_FILES ?>/bower_components/select2/dist/css/select2-bootstrap.css">
<script src="<?= BACKEND_STATIC_FILES ?>/bower_components/input-mask/jquery.inputmask.js"></script>
<script src="<?= BACKEND_STATIC_FILES ?>/bower_components/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?= BACKEND_STATIC_FILES ?>/bower_components/input-mask/jquery.inputmask.extensions.js"></script>
<div class="content-wrapper">
  <section class="content">
    <!-- Default box -->
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">
          <b>
            <?php
            if (isset($title_page)) {
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
              <label>Gender</label><br>
              <select class="form-control" id="gender">
                <option value="L">Laki-laki</option>
                <option value="p">Perempuan</option>
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
                  <input type="text" class="form-control" placeholder="" id="place_birth" placeholder="">
                </div>
                <div class="col-xs-8">
                  <input type="text" class="form-control" id="date_birth" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
                  <script>
                  $('#date_birth').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
                  </script>
                </div>
              </div>
              <!-- <input type="text" class="form-control" placeholder="..." id="place"><input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" id="date"> -->
            </div>

          </div>
          <div class="col-md-6">

            <div class="form-group">
              <label>Status</label><br>
              <select class="form-control" id="status">
                <option value="S">Lajang</option>
                <option value="M">Menikah</option>
              </select>
            </div>

          </div>
        </div>

        <div class="row">
          <div class="col-md-6">

            <div class="form-group">
              <label>TPQ</label>
              <select class="form-control select2" style="width: 100%;" id="tpq">
                <?php
                if (isset($tpq_options)) {
                  foreach ($tpq_options as $opt) {
                    echo "<option value=".$opt->tpq_id.">".$opt->tpq_name." - ".$opt->tpq_alias."</option>";
                  }
                }
                ?>
              </select>
            </div>

          </div>
          <div class="col-md-6">

            <div class="form-group">
              <label>Kategori Siswa</label>
              <select class="form-control" style="width: 100%;" id="student_category">
                <option value="C">Caberawit</option>
                <option value="P">Praremaja</option>
                <option value="R">Remaja</option>
              </select>
            </div>

          </div>
        </div>

        <div class="row">
          <div class="col-md-6">

            <div class="form-group">
              <label>Kontak</label>
              <input type="text" class="form-control" placeholder="..." id="contact">
            </div>

          </div>
          <div class="col-md-6">

            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control" placeholder="..." id="email">
            </div>

          </div>
        </div>

        <div class="row">
          <div class="col-md-6">


              <div class="form-group">
                <label>Foto</label>
                <input type="file" accept="image/*" class="" name="logo" onchange="load_logo(event)" id="logo">
                <br>
                <input type="hidden" id="max_num_gallery" value=''>
                <img id="output_logo" style="width:200px;height:150px" class="img img-thumbnail" src="<?= BACKEND_IMAGE_FOLDER . 'dummy_logo.png' ?>"/>
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
              <label>Alamat</label>
              <textarea class="form-control" rows="3" placeholder="..." id="address"></textarea>
            </div>
          </div>
        </div>

      </div>
      <div class="box-footer">
        <a href="<?=base_url().'admin/student/'?>" class="pull-left btn btn-flat btn-default"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
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
