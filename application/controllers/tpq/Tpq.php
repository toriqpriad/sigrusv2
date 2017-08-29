<?php
class tpq extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('data_model');
    $this->load->library(array('curl','session','datatables'));
    $this->load->helper(array('form','url','jwt_helper','rest_response_helper','key_helper','image_process_helper','file'));
    $this->data = [ ];
    $this->checkauth();
    $this->data['tpq_data'] = $this->session->userdata('tpq_data');
    $this->data['tpq_id'] = $this->session->userdata('tpq_data')['id'];
  }

  public function logout() {
    $delete_session = $this->session->sess_destroy();
    $data = array('link' => base_url().'login');
    echo json_encode(get_success($data));
  }

  public function display($location, $function_location = null, $table = null)
  {
    $this->data ['menu'] = $this->menu();
    $this->load->view('tpq/include/head', $this->data);
    if ($table == true) {
      $this->load->view('tpq/include/table');
    }
    $this->load->view('tpq/include/function');
    $this->load->view('tpq/include/modal');
    $this->load->view('tpq/include/top_menu');
    $this->load->view('tpq/include/sidebar_menu');
    if ($function_location == true) {
      $this->load->view($function_location);
    }
    $this->load->view($location);

    $this->load->view('tpq/include/footer_menu');
  }


  public function checkauth()
  {
    if ($this->session->userdata('tpq_token') == "") {
      redirect('login');
      exit();
    } else {
      $decode = JWT::decode($this->session->userdata('tpq_token'), SERVER_SECRET_KEY, JWT_ALGHORITMA);
      if ($decode->response != OK_STATUS) {
        redirect('login');
        exit();
      } else {
        if ($decode->data->role != "T") {
          redirect('login');
          exit();
        }
      }
    }
  }
  public function dashboard()
  {
    $this->data ['active_page'] = "dashboard";
    $this->data ['title_page'] = "Dashboard";
    $this->display('tpq/dashboard/dashboard', 'tpq/dashboard/function');
  }

  public function notfound()
  {
    $this->data ['active_page'] = "notfound";
    $this->data ['title_page'] = "Tidak ditemukan";
    $this->display('tpq/404', 'tpq/dashboard/function');
  }

  public function menu()
  {
    $dashboard = array(
      "label" => "Dashboard",
      "link" => site_url() . 'tpq/',
      "page_name" => "dashboard",
      "icon" => "fa fa-tachometer 1x"
    );

    $teacher = array(
      "label" => "Pengajar",
      "link" => site_url() . 'tpq/teacher/',
      "page_name" => "teacher",
      "icon" => "fa fa-user-o 1x"
    );

    $student = array(
      "label" => "Siswa",
      "link" => site_url() . 'tpq/student/',
      "page_name" => "student",
      "icon" => "fa fa-users 1x"
    );

    $tpq_position = array(
      "label" => "Pengurus TPQ",
      "link" => site_url() . 'tpq/position/',
      "page_name" => "tpq_position",
      "icon" => "fa fa-cubes 1x"
    );

    $socmed = array (
      "label" => "Sosial Media",
      "link" => site_url () . 'tpq/socmed/',
      "page_name" => "socmed",
      "icon" => "fa fa-share-alt 1x"
    );


    $setting = array(
      "label" => "Pengaturan",
      "link" => site_url() . 'tpq/setting/',
      "page_name" => "setting",
      "icon" => "fa fa-cog 1x"
    );

    $array = [$dashboard,$teacher,$student,$tpq_position ,$socmed,$setting];
    return $array;
  }

  public function get_pc_option()
  {
    $dest_table_as = 'pc';
    $select_values = array('pc.name as pc_name','pc.id as pc_id',);
    $params = new stdClass();
    $params->dest_table_as = $dest_table_as;
    $params->select_values = $select_values;
    $get = $this->data_model->get($params);
    return $get['results'];
  }

  public function get_tpq_option()
  {
    $dest_table_as = 'tpq as t';
    $select_values = array('t.name as tpq_name','t.id as tpq_id','t.alias as tpq_alias');
    $params = new stdClass();
    $params->dest_table_as = $dest_table_as;
    $params->select_values = $select_values;
    $get = $this->data_model->get($params);
    return $get['results'];
  }
}
