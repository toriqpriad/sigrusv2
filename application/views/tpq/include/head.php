
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php
    if(isset($title_page)){
      echo $title_page;
    }
    ?>

  </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= BACKEND_STATIC_FILES ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= BACKEND_STATIC_FILES ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= BACKEND_STATIC_FILES ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= BACKEND_STATIC_FILES ?>dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= BACKEND_STATIC_FILES ?>dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?= BACKEND_STATIC_FILES ?>bower_components/icheck/square/blue.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="<?= BACKEND_STATIC_FILES ?>bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?= BACKEND_STATIC_FILES ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="<?= BACKEND_STATIC_FILES ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?= BACKEND_STATIC_FILES ?>bower_components/fastclick/lib/fastclick.js"></script>
  <script src="<?= BACKEND_STATIC_FILES ?>bower_components/icheck/icheck.min.js"></script>
  <script src="<?= BACKEND_STATIC_FILES ?>bower_components/jquery-md5/jquerymd5.js"></script>
  <script src="<?= BACKEND_STATIC_FILES ?>bower_components/bootstrap/js/bootstrap-notify.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= BACKEND_STATIC_FILES ?>dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= BACKEND_STATIC_FILES ?>dist/js/demo.js"></script>
  <script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
  </script>
</head>
<body class="hold-transition skin-green-light layout-top-nav">
<style type="text/css">
  .crop-text {
  overflow: hidden;
  text-overflow: ellipsis;
  display: -webkit-box;
  line-height: 16px;     /* fallback */
  height: 80px;   
  text-align: justify;
}
</style>