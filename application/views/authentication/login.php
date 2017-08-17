<div class="login-box">
  <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>
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
        <div class="col-xs-4 pull-right">
          <input type="hidden" id="url" value="<?= BASE_URL.'auth/submit_login'; ?>">
          <button type="submit" class="btn btn-primary btn-block btn-flat" onclick="login()">Login</button>
        </div>
        <!-- /.col -->
      </div>
  </div>
  <!-- /.login-box-body -->
</div>
