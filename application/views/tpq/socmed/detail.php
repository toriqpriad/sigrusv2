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
        </h3>
      <div class="box-body">
          <!-- text input -->
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" value="<?=$records->name?>" id="name">
          </div>


          <div class="form-group">
            <label>Ikon</label>
            <input type="text" class="form-control" value="<?=$records->icon?>" id="icon">
          </div>

          <!-- input states -->

          <!-- /.box-body -->
        </div>
        <div class="box-footer">
          <input type="hidden" id="edit_id" value="<?=$records->id?>">
          <a type="submit" class="pull-left btn btn-flat btn-warning" href="<?=base_url().'admin/socmed/'?>"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
          <button type="submit" class="pull-right btn btn-flat btn-success" onclick="update()"><i class="fa fa-save"></i>&nbsp; Simpan</button>
        </div>
        </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->

      <!-- /.content-wrapper -->

    </div>
