
<div class="wrapper" >
  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="../../index2.html" class="navbar-brand"><b>SIGRUS</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <?php
            if (isset($menu)) {
              foreach ($menu as $data) {
                if ($active_page == $data ['page_name']) {
                  ?>
                  <li class="active"><a href="<?= $data['link'] ?>">
                    <span><?= $data['label'] ?></span>
                  </a></li>
                  <?php
                } else {
                  ?>
                  <li><a href="<?= $data['link'] ?>"> <span><?= $data['label'] ?></span>
                  </a></li>
                  <?php

                }
              }
            }
            ?>

          </ul>
        </div>
        <div class="collapse navbar-collapse pull-right" id="navbar-collapse">
          <ul class="nav navbar-nav">            
            <?php 
            if($title_page){              
              echo "<li><a> <b>".$title_page."</b></a></li>";
              echo "<li><a ><b> | </b></a></li>";
            }
            ?>
            <li><a ><b><?= $tpq_data['name'].' - '. $tpq_data['alias'];?></b></a></li>
            <li><a ><b> | </b></a></li>
            <li><a href="" style='margin-top:5px;'><b><i class="fa fa-sign-out"></i></b></a></li>
        <!-- <?= $tpq_data['name'].' - '. $tpq_data['alias'];?>  -->
      </div>
    </div>
  </nav>
</header>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="container">
    <div class="row">
