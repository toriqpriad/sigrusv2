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

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Judul</label>
              <input type="text" class="form-control" placeholder="..." id="title" value="<?=$records->title?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Pelaksanaan</label>
              <input type="text" class="form-control" id="date" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" value="<?=$records->date?>">
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
              <textarea class='form-control' id='desc'><?=$records->description?></textarea>
            </div>
          </div>
        </div>

        <div class="row">
          <?php
          foreach($old_img as $img){
            $sort = $img['sort'];
            ?>
            <div class="col-md-6">
              <div class="form-group">
                <label>Gambar <?=$sort?></label>
                <div class="row">
                  <div class="col-md-4">
                    <input type="file" accept="image/*" class="" name="img_<?=$sort?>" onchange="load_img_<?=$sort?>(event)" id="img_<?=$sort?>">
                  </div>
                  <div class="col-md-8">
                    <button class="btn btn-sm pull-left" onclick="delete_img_<?=$sort?>()"><i class="fa fa-trash" title="hapus"></i></button>
                  </div>
                </div>
                <input type="hidden" id="img_<?=$sort?>_old" value='<?= $img['name'] ?>'>
                <input type="hidden" id="img_<?=$sort?>_new" value=''>
                <br>
                <img id="output_img_<?=$sort?>" style="width:1024px;height:200px" class="img img-thumbnail" src="<?= base_url().$img['url']?>"/>
                <br><br>
                <script>
                var load_img_<?=$sort?> = function (event) {
                  var output_img_<?=$sort?> = document.getElementById('output_img_<?=$sort?>');
                  output_img_<?=$sort?>.src = URL.createObjectURL(event.target.files[0]);
                  $('#img_<?=$sort?>_new').val(event.target.files[0].name);
                };
                var delete_img_<?=$sort?> = function () {
                  var old = $('#img_<?=$sort?>_old').val();
                  $(".end").append("<input type='hidden' class='to_delete' value="+old+">");
                  output_img_<?=$sort?>.src = '<?=BACKEND_IMAGE_FOLDER . 'dummy_cover.png'?>';
                  $('#img_<?=$sort?>_new').val('');
                  $('#img_<?=$sort?>').val('');
                };
                </script>
              </div>
            </div>
            <?php
          }
          ?>
        </div>
        </div>
        <div class="box-footer">          
          <input type="hidden" id="edit_id" value='<?=$records->id?>'>
          <a href="javascript:history.back()"  class="btn btn-default btn-flat btn-fill btn-wd pull-left" ><i class="fa fa-arrow-left"></i>&nbsp;Kembali</a>
          <button type="submit" class="pull-right btn btn-flat btn-success" onclick="update()"><i class="fa fa-save"></i>&nbsp; Simpan</button>
        </div>
        <!-- /.box -->
        <div class="end"></div>
      </section>
      <!-- /.content -->

      <!-- /.content-wrapper -->

    </div>
    <script>
    $('.select2').select2()
    </script>
