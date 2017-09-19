
<div class="content-wrapper">    
  <section class="content">
    <br><br><br>
    <div class="col-md-4 col-md-offset-4">
      <div class="panel panel-default">
        <div class="panel-body">
          <span class='text-left'><strong>Masuk untuk memulai sesi </strong></span> <span id='load' style='margin-top:2px;' class='pull-right'></span><hr>

          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" id="username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" id="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <!-- /.col -->
            <input type="hidden" id="url" value="<?= BASE_URL.'auth/submit_login'; ?>">
            <div class="col-xs-12">                            
              <button type="submit" id='loginbtn'  class="btn btn-primary btn-block btn-flat pull-right" onclick="login()">Login</button> 
            </div>
            <!-- /.col -->
          </div>
        </div>
        <!-- /.login-box-body -->
      </div>
    </div>
  </div>
</section>
<!-- /.content -->

<!-- /.content-wrapper -->

</div>




