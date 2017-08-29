<div class="content-wrapper">

  <section class="content">
    <!-- Default box -->
    <div class="box box-primary">
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
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" placeholder="..." id="name">
          </div>

          <div class="form-group">
            <label>Kontak</label>
            <input type="text" class="form-control" placeholder="..." id="contact">
          </div>

          <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control" rows="3" placeholder="..." id="address"></textarea>
          </div>

          <!-- input states -->

          <!-- /.box-body -->
        </div>
        <div class="box-footer">
          <a href="<?=base_url().'admin/pc/'?>" class="pull-left btn btn-flat btn-default"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
          <button type="submit" class="pull-right btn btn-flat btn-success" onclick="post()"><i class="fa fa-save"></i>&nbsp; Simpan</button>
        </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->

      <!-- /.content-wrapper -->

    </div>
