<script src="<?= BACKEND_STATIC_FILES ?>/bower_components/select2/dist/js/select2.full.min.js"></script>
<link rel="stylesheet" href="<?= BACKEND_STATIC_FILES ?>/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?= BACKEND_STATIC_FILES ?>/bower_components/select2/dist/css/select2-bootstrap.css">
<script src="<?= BACKEND_STATIC_FILES ?>/bower_components/input-mask/jquery.inputmask.js"></script>
<script src="<?= BACKEND_STATIC_FILES ?>/bower_components/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?= BACKEND_STATIC_FILES ?>/bower_components/input-mask/jquery.inputmask.extensions.js"></script>
<div class="content-wrapper">
  <section class="content">

    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs pull-right">
        <li class=""><a href="#image" data-toggle="tab" aria-expanded="false">Foto</a></li>
        <li class><a href="#profil" data-toggle="tab" aria-expanded="false">Profil</a></li>
        <li class><a href="#galeri" data-toggle="tab" aria-expanded="false">Galeri</a></li>
        <li class="active"><a href="#index" data-toggle="tab" aria-expanded="true">Overview</a></li>
        <li class="pull-left header">
          <?php
          if (isset($title_page)) {
            echo $title_page;
          }
          ?>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane" id="Foto">

        </div>
        <div class="tab-pane" id="profil">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" placeholder="..." id="name" value="<?=$records->name?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Gender</label><br>
                <?php
                $male = array("value" => 'M', "label" => 'Laki-laki');
                $female = array("value" => 'F', "label" => 'Perempuan');
                $gender = array($male,$female);
                ?>
                <select class="form-control" id="gender">
                  <?php
                  foreach($gender as $opt){
                    if($records->gender == $opt->value){
                      echo "<option value=".$opt['value']." selected>".$opt['label']."</option>";
                    } else {
                      echo "<option value=".$opt['value'].">".$opt['label']."</option>";
                    }
                  }
                  ?>

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
                    <input type="text" class="form-control" placeholder="" id="place_birth" value="<?=$records->place_birth?>">
                  </div>
                  <div class="col-xs-8">
                    <input type="text" class="form-control" id="date_birth" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" value="<?=$records->date_birth?>">
                    <script>
                    $('#date_birth').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
                    </script>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>TPQ</label>
                <select class="form-control select2" style="width: 100%;" id="tpq">
                  <?php
                  if (isset($tpq_options)) {
                    foreach ($tpq_options as $opt) {
                      if($records->id_tpq == $opt->tpq_id) {
                        echo "<option value=".$opt->tpq_id." selected>".$opt->tpq_name." - ".$opt->tpq_alias."</option>";
                      }
                      else {
                        echo "<option value=".$opt->tpq_id.">".$opt->tpq_name." - ".$opt->tpq_alias."</option>";
                      }
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Kategori Pengajar</label><br>
                <?php
                $mt = array("value" => 'MT', "label" => 'Mubalegh Tugas');
                $ms = array("value" => 'MS', "label" => 'Mubalegh Setempat');
                $pb = array("value" => 'PB', "label" => 'Pribumi');
                $kat = array($mt,$ms,$pb);
                ?>
                <select class="form-control" id="teacher_category">
                  <?php
                  foreach($kat as $opt){
                    if($records->teacher_category == $opt['value']){
                      echo "<option value=".$opt['value']." selected>".$opt['label']."</option>";
                    } else {
                      echo "<option value=".$opt['value'].">".$opt['label']."</option>";
                    }
                  }
                  ?>

                </select>
              </div>
            </div>

            <div class="col-md-6">

              <div class="form-group">
                <label>Kontak</label>
                <input type="text" class="form-control" placeholder="..." id="contact" value="<?=$records->contact?>">
              </div>

            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Pendidikan Terakhir</label><br>
                <?php
                $sd = array("value" => 'SD', "label" => 'SD');
                $smp = array("value" => 'SMP', "label" => 'SMP');
                $sma = array("value" => 'SMA', "label" => 'SMA');
                $diploma = array("value" => 'Diploma', "label" => 'Diploma');
                $sarjana = array("value" => 'Sarjana', "label" => 'Sarjana');
                $pdk = array($sd,$smp,$sma,$diploma,$sarjana);
                ?>
                <select class="form-control" id="education">
                  <?php
                  foreach($pdk as $opt){
                    if($records->education == $opt['value']){
                      echo "<option value=".$opt['value']." selected>".$opt['label']."</option>";
                    } else {
                      echo "<option value=".$opt['value'].">".$opt['label']."</option>";
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Keterangan Pendidikan</label>
                <input type="text" class="form-control" placeholder="..." id="education_detail" value="<?=$records->education_detail?>">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" placeholder="..." id="email" value="<?=$records->email?>">
              </div>
            </div>

            <div class="col-md-6">

              <div class="form-group">
                <label>Keaktifan</label><br>
                <?php
                $a = array("value" => 'A', "label" => 'Aktif');
                $n = array("value" => 'N', "label" => 'Nonaktif');
                $status = array($a,$n);
                ?>

                <select class="form-control" id="active">
                  <?php
                  foreach($status as $opt){
                    if($records->active == $opt['value']){
                      echo "<option value=".$opt['value']." selected>".$opt['label']."</option>";
                    } else {
                      echo "<option value=".$opt['value'].">".$opt['label']."</option>";
                    }
                  }
                  ?>

                </select>
              </div>

            </div>


          </div>

          <div class="row">
            <div class="col-md-6">

              <div class="form-group">
                <label>Status</label><br>
                <?php
                $single = array("value" => 'S', "label" => 'Lajang');
                $married = array("value" => 'M', "label" => 'Menikah');
                $kat = array($single,$married);
                ?>
                <select class="form-control" id="status">
                  <?php
                  foreach($kat as $opt){
                    if($records->status == $opt['value']){
                      echo "<option value=".$opt['value']." selected>".$opt['label']."</option>";
                    } else {
                      echo "<option value=".$opt['value'].">".$opt['label']."</option>";
                    }
                  }
                  ?>

                </select>
              </div>

            </div>
            
            <div class="form-group">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Alamat</label>
                  <textarea class="form-control" rows="3" placeholder="..." id="address"><?=$records->address?></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="image">
            <div class="form-group">
              <label>Foto</label>
              <input type="file" accept="image/*" class="" name="logo" onchange="load_foto(event)" id="foto">
              <input type="hidden" id="foto_old" value='<?= $records->foto_old ?>'>
              <input type="hidden" id="foto_new" value=''>
              <br>
              <input type="hidden" id="max_num_gallery" value=''>
              <img id="output_foto" style="width:200px;height:150px;" class="img img-thumbnail" src="<?= $records->foto ?>"/>
              <br><br>

              <script>
              var load_foto = function (event) {
                var output_foto = document.getElementById('output_foto');
                output_foto.src = URL.createObjectURL(event.target.files[0]);
                $('#foto_new').val(event.target.files[0].name);
              };
              </script>
            </div>
          </div>

          <!-- /.tab-pane -->
          <div class="tab-pane" id="galeri">
            Galeri
          </div>
          <div class="tab-pane active" id="index">
            Overview
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
        <div class="box-footer">
          <input type="hidden" id="edit_id" value="<?=$records->id?>">
          <input type="hidden" id="tpq_last_id" value="<?=$records->id_tpq?>">
          <a href="javascript:history.back()"  class="btn btn-default btn-flat btn-fill btn-wd pull-left" ><i class="fa fa-arrow-left"></i>&nbsp;Kembali</a>
          <button type="submit" class="pull-right btn btn-flat btn-success" onclick="update()"><i class="fa fa-save"></i>&nbsp; Simpan</button>
        </div>

      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->

    <!-- /.content-wrapper -->

  </div>
  <script>
  $('.select2').select2()
  </script>
