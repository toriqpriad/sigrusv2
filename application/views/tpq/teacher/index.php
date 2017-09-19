
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h4>

        <?php
        if(isset($title_page)){
          echo $title_page;
        }
      ?>

    </h4>

    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box box-success">
        <div class="box-body">
          <a href="<?= base_url().'tpq/teacher/add'?>" class="btn btn-primary btn-flat btn-fill  pull-left btn-sm" style><i class="fa fa-plus"></i>&nbsp; Tambah</a>
          <a href="<?= base_url().'tpq/teacher/search_page'?>" class="btn btn-default btn-flat btn-fill btn-sm pull-left"><i class="fa fa-search"></i>&nbsp; Pencarian Lebih Lanjut</a>
          <small>
            <table class="table table-bordered table-striped table-hover dataTable table1" >
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Gender</th>
                  <th>Email</th>
                  <th>Kontak</th>
                  <th>Status</th>                  
                  <th>Aktif</th>
                  <th>Update Terakhir</th>
                  <th>Aksi</th>
                </tr>
              </thead>
      </tbody>
    </table>
  </small>
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->

</div>


<div class="modal fade"  aria-labelledby="myModalLabel" id="deleteModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Konfirmasi</h4>
      </div>
      <div class="modal-body">
        <p>Menghapus data ini berarti menonaktifkan beberapa data terkait. Yakin menghapus ?</p>
        <input type="hidden" id="del_id" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" id='yes'>Ya</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
      </div>
    </div>

  </div>
</div>



<script>
table_render();
</script>
