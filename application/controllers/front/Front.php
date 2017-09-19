<?php

class front extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('data_model');
    $this->load->library(array('pagination','user_agent'));
    $this->load->helper(array('url', 'jwt_helper', 'image_process_helper','pagination_helper'));
    $this->data = [];
    $this->get_access_user();

  }

  public function get_access_user(){
    $ip = $this->input->ip_address();
    $params_check = new stdClass();
    $params_check->dest_table_as = 'access_log';
    $params_check->select_values = array('*');
    $sort = array("order_column" => 'date', "order_type" => 'desc');
    $params_check->order_by = array($sort);
    $where_data = array("where_column" => 'ip_address', "where_value" => $ip);
    $params_check->where_tables = array($where_data);
    $check = $this->data_model->get($params_check);
    if (!empty($check['results'][0])) {
      $date = date('d-m-Y');
      if($date != $check['results'][0]->date){
        $params_data = array(
          "ip_address" => $this->input->ip_address(),
          "platform" => $this->agent->platform,
          "browser" => $this->agent->browser,
          "date" => date('d-m-Y')
        );
        $dest_table = 'access_log';
        $add = $this->data_model->add($params_data, $dest_table);
      }
    } else {
      $params_data = array(
        "ip_address" => $this->input->ip_address(),
        "platform" => $this->agent->platform,
        "browser" => $this->agent->browser,
        "date" => date('d-m-Y')
      );
      $dest_table = 'access_log';
      $add = $this->data_model->add($params_data, $dest_table);
    }

    $count = $this->data_model->get_count('access_log')['results'];
    return $count;
  }



  public function display( $location, $function_location = null, $table = null ) {
    $this->data ['menu'] = $this->menu();
    $this->data ['site'] = $this->website_information();
    $this->load->view( 'front/include/head', $this->data );
    $this->load->view ( 'authentication/include/function' );
    if ( $table == true ) {
      $this->load->view( 'front/include/table' );
    }
    // $this->load->view( 'front/include/function' );
    $this->load->view( 'front/include/modal' );
    $this->load->view( 'front/include/top_menu' );
    if ( $function_location == true ) {
      $this->load->view( $function_location );
    }
    $this->load->view( $location );

    $this->load->view( 'front/include/footer_menu' );
  }


  public function login() {
    $this->data['active_page'] = "login";
    $this->data ['title_page'] = "Masuk";
    $this->display ('front/login');
  }

  public function home() {
    $this->data['active_page'] = "home";
    $this->data['title_page'] = "Beranda";    
    $this->display ('front/dashboard/dashboard');
  }

  
  public function notfound() {
    $this->data['title_page'] = "Tidak ditemukan";
    $this->load->view('front/404', $this->data);
  }



  public function get_slider(){
    $dest_table_as = 'slider';
    $select_values = array('*');
    $params = new stdClass();
    $params->dest_table_as = $dest_table_as;
    $params->select_values = $select_values;
    $get = $this->data_model->get($params);
    if ($get['response'] == OK_STATUS) {
      if($get['results'] != ""){
        foreach($get['results'] as $each){
          $img_dir = BACKEND_IMAGE_UPLOAD_FOLDER.'slider/'.$each->id.'/';
          $noimg_dir = base_url().BACKEND_IMAGE_UPLOAD_FOLDER.'noimg.png';
          if($each->image != ""){
            $check = check_if_empty($each->image, $img_dir.$each->image);
            if($check == NO_IMG_NAME){
              $img = $noimg_dir;
            } else {
              $img = base_url().$img_dir.$check;
            }
          }
          else {
            $img = $noimg_dir;
          }
          $each->image = $img;
        }
        $results = $get['results'];
      } else {
        $results = [];
      }
    } else {
      $results = [];
    }
    return $results;
  }



  private function website_information() {
    $dest_table_as = 'setting';
    $select_values = array('*');
    $params = new stdClass();
    $params->dest_table_as = $dest_table_as;
    $params->select_values = $select_values;
    $get = $this->data_model->get($params);
    if ($get['response'] == OK_STATUS) {
      $website = $get['results'][0];
    } else {
      $website = [];
    }
    return $website;
  }

  public function menu() {
    $home = array (
      "type" => "menu",
      "label" => "Beranda",
      "link" => site_url () . 'home',
      "page_name" => "home",
      "icon" => "ti-panel"
    );

    $login = array (
      "type" => "menu",
      "label" => "Masuk",
      "link" => site_url () . 'login',        
      "page_name" => "login",
      "icon" => "fa fa-signin"
    );

    $merchant = array (
      "type" => "menu",
      "label" => "Merchant",
      "link" => site_url () . 'merchant',
      "page_name" => "merchant",
      "icon" => "fa fa-users 1x"
    );

    $galeri = array (
      "type" => "menu",
      "label" => "Galeri",
      "link" => site_url () . 'gallery',
      "page_name" => "gallery",
      "icon" => "fa fa-cube 1x"
    );

    $tentang_kami = array (
      "type" => "menu",
      "label" => "Tentang Kami",
      "link" => site_url () . 'about_us',
      "page_name" => "info",
      "icon" => "fa fa-cube 1x"
    );


    $array = [$home,$login];

    return $array;
  }

  public function footer(){
    $dest_table_as = 'setting as s';
    $select_values = array('s.*');
    $params = new stdClass();
    $params->dest_table_as = $dest_table_as;
    $params->select_values = $select_values;
    $get = $this->data_model->get($params);
    $dir_logo = BACKEND_IMAGE_UPLOAD_FOLDER.'logo/'.$get['results'][0]->site_logo;
    $check = check_if_empty($get['results'][0]->site_logo, $dir_logo);
    if($check == NO_IMG_NAME){
      $img = base_url().BACKEND_IMAGE_UPLOAD_FOLDER.'noimg.png';
    } else {
      $img = base_url().$dir_logo;
    }
    $get['results'][0]->logo = $img;

    $sc = new stdClass();
    $sc->dest_table_as = 'socmed as sc';
    $sc->select_values = array('*');
    $get_sc = $this->data_model->get($sc);
    if($get_sc['results'] != ""){
      foreach($get_sc['results'] as $each){
        $scm = new stdClass();
        $scm->dest_table_as = 'site_socmed as sc';
        $scm->select_values = array('*');
        $where1 = array("where_column" => 'sc.socmed_id', "where_value" => $each->id);
        $scm->where_tables = array($where1);
        $get_sc = $this->data_model->get($scm);
        if(empty($get_sc["results"][0])){
          $scm_id = "";
          $scm_url = "";
        } else {
          $scm_id = $get_sc["results"][0]->id;
          $scm_url = $get_sc["results"][0]->url;
        }
        $site_scm[] = array(
          "sc_id" => $each->id,
          "sc_icon" => $each->icon,
          "sc_name"=> $each->name,
          "scm_url" => $scm_url
        );
      }
      $array = array("info" => $get['results'][0],"social_media" => $site_scm, "visitor" => $this->get_access_user());
    } else {
      $array = [];
    }


    return $array;
  }
}
