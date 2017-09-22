<script src="<?= BACKEND_STATIC_FILES ?>/bower_components/input-mask/jquery.inputmask.js"></script>
<script src="<?= BACKEND_STATIC_FILES ?>/bower_components/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?= BACKEND_STATIC_FILES ?>/bower_components/input-mask/jquery.inputmask.extensions.js"></script>
<div class="content-wrapper">
  <section class="content">
    <!-- Default box -->
    <br>
    <div class="box box-success">
      
      <div class="box-body">

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Judul</label>
              <input type="text" class="form-control" placeholder="..." id="title">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Pelaksanaan</label>
              <input type="text" class="form-control" id="date" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
              <script>
              $('#date').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
              </script>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Deskripsi</label>
              <textarea class='form-control' id='desc'></textarea>
            </div>
          </div>
        </div>

        <div class="row">
            <?php
            $a = 1;
            while($a<=6){
              ?>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Gambar <?=$a?></label>
                  <div class="row">
                    <div class="col-md-4">
                      <input type="file" accept="image/*" class="" name="image_1" onchange="load_image_<?=$a?>(event)" id="image_<?=$a?>">
                    </div>
                    <div class="col-md-8">
                      <button class="btn btn-sm pull-left" onclick="delete_img_<?=$a?>()" ><i  class="fa fa-trash" title="hapus"></i></button>
                    </div>
                  </div>
                  <br>
                  <input type="hidden" id="max_num_gallery" value=''>
                  <img id="output_image_<?=$a?>" style="width:1024px;height:200px" class="img img-thumbnail" src="<?= BACKEND_IMAGE_FOLDER . 'dummy_cover.png' ?>"/>
                  <br><br>

                  <script>
                  var load_image_<?=$a?> = function (event) {
                    var output_image_<?=$a?> = document.getElementById('output_image_<?=$a?>');
                    output_image_<?=$a?>.src = URL.createObjectURL(event.target.files[0]);
                  };
                  var delete_img_<?=$a?> = function () {
                    $("#output_image_<?=$a?>").attr('src','<?=BACKEND_IMAGE_FOLDER . 'dummy_cover.png'?>');
                    $('#image_<?=$a?>').val('');
                  };
                  </script>
                </div>
              </div>
              <?php
              $a++; }
              ?>
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
