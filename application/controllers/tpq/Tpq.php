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
    // $this->load->view('tpq/include/sidebar_menu');
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
    $this->data['active_page'] = "dashboard";
    $this->data['title_page'] = "Dashboard";
    $this->data['records'] = $this->profile();
    $where = array('where_column'=> 'id_tpq','where_value'=> $this->data['tpq_id']);    
    $where_cb = array('where_column'=> 'student_category','where_value'=> 'C');
    $where_pr = array('where_column'=> 'student_category','where_value'=> 'P');
    $where_rm = array('where_column'=> 'student_category','where_value'=> 'R');
    $tc = $this->count_component('teacher',array($where));
    $cb = $this->count_component('student',array($where,$where_cb));        
    $pr = $this->count_component('student',array($where,$where_pr));        
    $rm = $this->count_component('student',array($where,$where_rm));    
    $this->data['component'] = array("tc"=>$tc,"cb"=> $cb, "pr"=>$pr, "rm" => $rm);        
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
      "label" => "Pengurus",
      "link" => site_url() . 'tpq/position/',
      "page_name" => "position",
      "icon" => "fa fa-cubes 1x"
    );

    $activity = array(
      "label" => "Kegiatan",
      "link" => site_url() . 'tpq/activity/',
      "page_name" => "activity",
      "icon" => "fa fa-tags 1x"
    );

    $setting = array(
      "label" => "Pengaturan",
      "link" => site_url() . 'tpq/setting/',
      "page_name" => "setting",
      "icon" => "fa fa-cog 1x"
    );

    $array = [$dashboard,$teacher,$student,$activity,$tpq_position,$setting];
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

  public function profile()
  {
    $parameter = $this->data['tpq_id'];
    $params = new stdClass();
    $params->dest_table_as = 'tpq as p';
    $params->select_values = array('p.*');
    $params->where_tables = array(array("where_column" => 'p.id', "where_value" => $parameter));
    $get = $this->data_model->get($params);
    if ($get['results'][0] != "") {
      $logo = $get['results'][0]->logo;
      $cover = $get['results'][0]->cover;
      $get["results"][0]->logo_old = $get['results'][0]->logo;
      $dir = BACKEND_IMAGE_UPLOAD_FOLDER;
      $image_dir_logo =  $dir.'logo/'. $logo;
      $check_thumb = check_if_empty($logo, $image_dir_logo);
      if ($check_thumb == NO_IMG_NAME) {
        $get["results"][0]->logo = BASE_URL.BACKEND_IMAGE_UPLOAD_FOLDER.'dummy_logo.png';
      } else {
        $get["results"][0]->logo = BASE_URL . $dir.'logo/'.$check_thumb;
      }
      $get["results"][0]->cover_old = $get['results'][0]->cover;
      $image_dir_cover = $dir.'cover/' . $cover;
      $check_thumb = check_if_empty($cover, $image_dir_cover);
      if ($check_thumb == NO_IMG_NAME) {
        $get["results"][0]->cover = BASE_URL.BACKEND_IMAGE_UPLOAD_FOLDER.'dummy_cover.png';
      } else {
        $get["results"][0]->cover = BASE_URL. $dir.'cover/' . $check_thumb;
      }

      return $get['results'][0];
    }
  }

  public function count_component($table,$where){
    $ret = $this->data_model->get_count($table,$where);        
    return $ret['results'];
  }

}
