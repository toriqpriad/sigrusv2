<?php
class admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('data_model');
    $this->load->library(array('curl','session','datatables'));
    $this->load->helper(array('form','url','jwt_helper','rest_response_helper','key_helper','image_process_helper','file'));
    $this->data = [ ];
    $this->checkauth();
  }

  public function logout() {
    $delete_session = $this->session->sess_destroy();
    $data = array('link' => base_url().'login');
    echo json_encode(get_success($data));
  }

  public function display($location, $function_location = null, $table = null)
  {
    $this->data ['menu'] = $this->menu();
    $this->data ['site'] = $this->site();
    $this->load->view('admin/include/head', $this->data);
    if ($table == true) {
      $this->load->view('admin/include/table');
    }
    $this->load->view('admin/include/function');
    $this->load->view('admin/include/modal');
    $this->load->view('admin/include/top_menu');
    $this->load->view('admin/include/sidebar_menu');
    if ($function_location == true) {
      $this->load->view($function_location);
    }
    $this->load->view($location);

    $this->load->view('admin/include/footer_menu');
  }


  public function checkauth()
  {
    if ($this->session->userdata('admin_token') == "") {
      redirect('login');
      exit();
    } else {
      $decode = JWT::decode($this->session->userdata('admin_token'), SERVER_SECRET_KEY, JWT_ALGHORITMA);
      if ($decode->response != OK_STATUS) {
        redirect('login');
        exit();
      } else {
        if ($decode->data->role != "A") {
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
    $this->display('admin/dashboard/dashboard', 'admin/dashboard/function');
  }

  public function site()
  {
    $params = new stdClass();
    $params->dest_table_as = 'setting as s';
    $params->select_values = array(
      's.*'
      );
    $get = $this->data_model->get($params);
    return $get ['results'] [0];
  }


  public function notfound()
  {
    $this->data ['active_page'] = "notfound";
    $this->data ['title_page'] = "Tidak ditemukan";
    $this->display('admin/404', 'admin/dashboard/function');
  }

  public function menu()
  {
    $dashboard = array(
      "label" => "Dashboard",
      "link" => site_url() . 'admin/',
      "page_name" => "dashboard",
      "icon" => "fa fa-tachometer 1x"
      );
    $pc = array(
      "label" => "PC",
      "link" => site_url() . 'admin/pc/',
      "page_name" => "pc",
      "icon" => "fa fa-university 1x"
      );

    $tpq = array(
      "label" => "TPQ",
      "link" => site_url() . 'admin/tpq/',
      "page_name" => "tpq",
      "icon" => "fa fa-home 1x"
      );

    $teacher = array(
      "label" => "Pengajar",
      "link" => site_url() . 'admin/teacher/',
      "page_name" => "teacher",
      "icon" => "fa fa-user-o 1x"
      );

    $student = array(
      "label" => "Siswa",
      "link" => site_url() . 'admin/student/',
      "page_name" => "student",
      "icon" => "fa fa-users 1x"
      );

    $tpq_position = array(
      "label" => "Pengurus TPQ",
      "link" => site_url() . 'admin/tpq_position/',
      "page_name" => "tpq_position",
      "icon" => "fa fa-cubes 1x"
      );

    $this_position = array(
      "label" => "Pengurus PPG",
      "link" => site_url() . 'admin/position/',
      "page_name" => "position",
      "icon" => "fa fa-handshake-o 1x"
      );

    $socmed = array (
      "label" => "Sosial Media",
      "link" => site_url () . 'admin/socmed/',
      "page_name" => "socmed",
      "icon" => "fa fa-share-alt 1x"
      );


    $setting = array(
      "label" => "Pengaturan",
      "link" => site_url() . 'admin/setting/',
      "page_name" => "setting",
      "icon" => "fa fa-cog 1x"
      );

    $array = [$dashboard,$pc,$tpq,$teacher,$student,$tpq_position ,$this_position,$socmed,$setting];
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
