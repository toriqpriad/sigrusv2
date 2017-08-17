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
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" value="<?=$records->name?>" id="name">
          </div>

          <div class="form-group">
            <label>Kontak</label>
            <input type="text" class="form-control" value="<?=$records->contact?>" id="contact">
          </div>

          <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control" rows="3"  id="address"><?=$records->address?></textarea>
          </div>

          <!-- input states -->

          <!-- /.box-body -->
        </div>
        <div class="box-footer">
          <input type="hidden" id="edit_id" value="<?=$records->id?>">
          <a class="pull-left btn btn-flat btn-warning" href="<?=base_url().'admin/pc/'?>"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
          <button type="submit" class="pull-right btn btn-flat btn-success" onclick="update()"><i class="fa fa-save"></i>&nbsp; Simpan</button>
        </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->

      <!-- /.content-wrapper -->

    </div>
