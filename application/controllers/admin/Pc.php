<?php

include 'Admin.php';

class pc extends admin {

  function __construct() {
    parent::__construct();
    parent::checkauth();
    $this->data['active_page'] = "pc";
  }

  public function json(){
    $dest_table_as = 'pc';
    $select_values = array('*');
    $params = new stdClass();
    $params->dest_table_as = $dest_table_as;
    $params->select_values = $select_values;
    $get = $this->data_model->get($params);
    echo json_encode(array("data" => $get['results']));
  }


  public function index() {
    $this->data['title_page'] = "Pengurus Cabang (PC)";
    parent::display('admin/pc/index','admin/pc/function',TRUE);
  }


  public function add() {
    $this->data['title_page'] = "Tambah PC";
    parent::display('admin/pc/add','admin/pc/function',FALSE);
  }

  public function post(){
    $name = $this->input->post("name");
    $address = $this->input->post("address");
    $contact = $this->input->post("contact");
    $params_check = new stdClass();
    $params_data = array(
      "name" => $name,
      "contact" => $contact,
      "address" => $address,
      "update_at" => date('d-m-Y h:m')
    );
    $dest_table = 'pc';
    $add = $this->data_model->add($params_data, $dest_table);
    $pc_id = $add["data"];

    if($add){
      $data = array("link" => base_url() . 'admin/pc/' . $pc_id);
      $result = get_success($data);
    } else {
      $params = new stdClass();
      $params->response =  NO_DATA_STATUS;
      $params->message = FAIL_STATUS;
      $params->data = array("error" => $error_data, "link" => base_url() . 'admin/pc/' . $pc_id);
      $result = response_custom($params);
    }
    echo json_encode($result);
  }

  public function detail(){
    $parameter = $this->uri->segment(3);
    $params = new stdClass();
    $params->dest_table_as = 'pc as p';
    $params->select_values = array('p.*');
    $params->where_tables = array(array("where_column" => 'p.id', "where_value" => $parameter));
    $get = $this->data_model->get($params);
    if($get['results'][0] != ""){
      $this->data['records'] = $get['results'][0];
      $this->data['title_page'] = $get["results"][0]->name;
      parent::display('admin/pc/detail','admin/pc/function');
    } else {
      redirect('/admin/404');
    }
  }

  public function update(){
    $id = $this->input->post("id");
    $params = new stdClass();
    $params->dest_table_as = 'pc as g';
    $params->select_values = array('g.id');
    $params->where_tables = array(array("where_column" => 'g.id', "where_value" => $id));
    $get = $this->data_model->get($params);
    if($get["response"] == FAIL_STATUS){
      echo json_encode(response_fail());
      exit();
    } else {
      if($get["results"] == ""){
        echo json_encode(response_fail());
        exit();
      }
    }
    $name = $this->input->post("name");
    $address = $this->input->post("address");
    $contact = $this->input->post("contact");
    $params_data = new stdClass();
    $params_data->new_data = array(
      "name" => $name,
      "contact" => $contact,
      "address" => $address,
      "update_at" => date('d-m-Y h:m')
    );
    $where = array("where_column" => 'id', "where_value" => $id);
    $params_data->where_tables = array($where);
    $params_data->table_update = 'pc';
    $update = $this->data_model->update($params_data);
    if ($update['response'] == OK_STATUS ) {
      $params = new stdClass();
      $params->response = OK_STATUS;
      $params->message = OK_MESSAGE;
      $params->data = array('link' => base_url() . 'admin/pc/' . $id);
      $result = response_custom($params);
    } else {
      $result = response_fail();
    }
    echo json_encode($result);
  }


  public function delete(){
    $id_delete = $this->input->post("id");
    // print_r($id);exit();
    $params_delete = new stdClass();
    $where1 = array("where_column" => 'pc_id', "where_value" => $id_delete);
    $params_delete->where_tables = array($where1);
    $params_delete->table = 'pc_images';
    $delete = $this->data_model->delete($params_delete);

    $delete = new stdClass();
    $where1 = array("where_column" => 'id', "where_value" => $id_delete);
    $delete->where_tables = array($where1);
    $delete->table = 'pc';
    $delete_pc = $this->data_model->delete($delete);

    $dir = BACKEND_IMAGE_UPLOAD_FOLDER.'pc/'.$id_delete.'/';
    $files = glob($dir.'*');

    foreach($files as $file){
      $unlink_files = unlink($file);
    }

    $rm_dir = rmdir($dir);

    if ($delete_pc['response'] == OK_STATUS) {
      $result = response_success();
    } else {
      $result = response_fail();
    }
    echo json_encode($result);
  }


}
