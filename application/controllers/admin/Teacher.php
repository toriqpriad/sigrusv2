<?php

include 'Admin.php';

class teacher extends admin
{
  public function __construct()
  {
    parent::__construct();
    parent::checkauth();
    $this->data['active_page'] = "teacher";
  }

  public function json()
  {
    $dest_table_as = 'teacher as t';
    $select_values = array('t.*','tpq.name as tpq_name','tpq.alias as tpq_alias');
    $join1 = array("join_with" => 'tpq', "join_on" => 't.id_tpq = tpq.id', "join_type" => '');
    $params = new stdClass();
    $params->dest_table_as = $dest_table_as;
    $params->select_values = $select_values;
    $params->join_tables = array($join1);
    $get = $this->data_model->get($params);    
    echo json_encode(array("data" => $get['results']));
  }


  public function index()
  {
    $this->data['title_page'] = "Pengajar";
    parent::display('admin/teacher/index', 'admin/teacher/function', true);
  }

  public function add()
  {
    $this->data['title_page'] = "Tambah Pengajar";
    $this->data['tpq_options'] = parent::get_tpq_option();
    parent::display('admin/teacher/add', 'admin/teacher/function', false);
  }

  public function post()
  {
    $name = $this->input->post("name");
    $gender = $this->input->post("gender");
    $address = $this->input->post("address");
    $teacher_category = $this->input->post("teacher_category");
    $tpq = $this->input->post("tpq");
    $contact = $this->input->post("contact");
    $place = $this->input->post("place");
    $date = $this->input->post("date");
    $email = $this->input->post("email");
    $link = strtolower(preg_replace("/[^a-zA-Z0-9]/", "", $name));
    $params_check = new stdClass();
    $params_data = array(
      "name" => $name,
      "gender" => $gender,
      "id_tpq" => $tpq,
      "contact" => $contact,
      "email" => $email,
      "place_birth" => $place,
      "date_birth" => $date,
      "link" => $link,
      "teacher_category" => $teacher_category,
      "address" => $address,
      "update_at" => date('d-m-Y h:m')
    );
    $dest_table = 'teacher';
    $add = $this->data_model->add($params_data, $dest_table);
    $teacher_id = $add["data"];
    $teacher_dir = BACKEND_IMAGE_UPLOAD_FOLDER;

    if (isset($_FILES["foto"])) {
      if ($_FILES["foto"] != "") {
        $upload= image_upload(array($_FILES["foto"]), $teacher_dir . "/profile/");
        $image_name = $upload->data[0];
      } else {
        $image_name = "";
      }
    } else {
      $image_name = "";
    }

    $params_update = new stdClass();
    $params_update->new_data = array("photo" => $image_name);
    $params_update->table_update = 'teacher';
    $where = array("where_column" => 'id', "where_value" => $teacher_id);
    $params_update->where_tables = array($where);
    $update_foto_cover = $this->data_model->update($params_update);

    if ($add) {
      $data = array("link" => base_url() . 'admin/teacher/' . $teacher_id);
      $result = get_success($data);
    } else {
      $params = new stdClass();
      $params->response =  NO_DATA_STATUS;
      $params->message = FAIL_STATUS;
      $params->data = array("error" => $error_data, "link" => base_url() . 'admin/teacher/' . $teacher_id);
      $result = response_custom($params);
    }
    echo json_encode($result);
  }

  public function detail()
  {
    $parameter = $this->uri->segment(3);
    $params = new stdClass();
    $params->dest_table_as = 'teacher as t';
    $params->select_values = array('t.*');
    $params->where_tables = array(array("where_column" => 't.id', "where_value" => $parameter));
    $get = $this->data_model->get($params);
    if ($get['results'][0] != "") {
      $this->data['tpq_options'] = parent::get_tpq_option();
      $foto = $get['results'][0]->photo;
      $get["results"][0]->foto_old = $get['results'][0]->photo;
      $dir = BACKEND_IMAGE_UPLOAD_FOLDER;
      $image_dir_foto =  $dir.'profile/'. $foto;
      $check_thumb = check_if_empty($foto, $image_dir_foto);
      if ($check_thumb == NO_IMG_NAME) {
        $get["results"][0]->foto = BASE_URL.BACKEND_IMAGE_UPLOAD_FOLDER.'dummy_logo.png';
      } else {
        $get["results"][0]->foto = BASE_URL . $dir.'profile/'.$check_thumb;
      }

      $this->data['records'] = $get['results'][0];
      $this->data['title_page'] = "Pengajar ".$get["results"][0]->name;
      parent::display('admin/teacher/detail', 'admin/teacher/function');
    } else {
      redirect('/admin/404');
    }
  }

  public function update()
  {
    $id = $this->input->post("id");
    $name = $this->input->post("name");
    $gender = $this->input->post("gender");
    $address = $this->input->post("address");
    $teacher_category = $this->input->post("teacher_category");
    $tpq = $this->input->post("tpq");
    $tpq_last_id = $this->input->post("tpq_last_id");
    $contact = $this->input->post("contact");
    $place = $this->input->post("place");
    $date = $this->input->post("date");
    $email = $this->input->post("email");
    $old_foto = $this->input->post("old_foto");
    $link = strtolower(preg_replace("/[^a-zA-Z0-9]/", "", $name));
    $params_data = new stdClass();
    $params_data->new_data = array(
      "name" => $name,
      "gender" => $gender,
      "id_tpq" => $tpq,
      "contact" => $contact,
      "email" => $email,
      "place_birth" => $place,
      "date_birth" => $date,
      "link" => $link,
      "teacher_category" => $teacher_category,
      "address" => $address,
      "update_at" => date('d-m-Y h:m')
    );
    $where = array("where_column" => 'id', "where_value" => $id);
    $params_data->where_tables = array($where);
    $params_data->table_update = 'teacher';
    $update = $this->data_model->update($params_data);
    $error = [];
    if (isset($_FILES["foto"])) {
      if (!empty($_FILES["foto"]["name"])) {
        $upload_foto = image_upload(array($_FILES["foto"]), BACKEND_IMAGE_UPLOAD_FOLDER . "/profile/");
        if ($upload_foto->response == OK_STATUS) {
          $image_foto_name = $upload_foto->data[0];
          if ($old_foto != "") {
            $remove_old = unlink(BACKEND_IMAGE_UPLOAD_FOLDER . '/profile/' . $old_foto);
          }
        } else {
          if ($upload_foto->data['error']) {
            foreach ($upload_foto->data['error'] as $er) {
              array_push($error, $er);
            }
          }
          $image_foto_name = $old_foto;
        }
      } else {
        $image_foto_name = $old_foto;
      }
    } else {
      $image_foto_name = $old_foto;
    }

    $params_update = new stdClass();
    $params_update->new_data = array("photo" => $image_foto_name);
    $where = array("where_column" => 'id', "where_value" => $id);
    $params_update->where_tables = array($where);
    $params_update->table_update = 'teacher';
    $update_foto_cover = $this->data_model->update($params_update);


    if ($update['response'] == OK_STATUS) {
      $params = new stdClass();
      if ($error) {
        $params->response = FAIL_STATUS;
        $params->message = "Peringatan";
        $params->data = array('link' => base_url() . 'admin/teacher/' . $id);
        $params->data = $error;
      } else {
        $params->response = OK_STATUS;
        $params->message = OK_MESSAGE;
        $params->data = array('link' => base_url() . 'admin/teacher/' . $id);
      }
      $result = response_custom($params);
    } else {
      $result = response_fail();
    }
    echo json_encode($result);
  }


  public function delete()
  {
    $id_delete = $this->input->post("id");
    // print_r($id);exit();
    $params_delete = new stdClass();
    $where1 = array("where_column" => 'teacher_id', "where_value" => $id_delete);
    $params_delete->where_tables = array($where1);
    $params_delete->table = 'teacher_images';
    $delete = $this->data_model->delete($params_delete);

    $delete = new stdClass();
    $where1 = array("where_column" => 'id', "where_value" => $id_delete);
    $delete->where_tables = array($where1);
    $delete->table = 'teacher';
    $delete_teacher = $this->data_model->delete($delete);

    $dir = BACKEND_IMAGE_UPLOAD_FOLDER.'teacher/'.$id_delete.'/';
    $files = glob($dir.'*');

    foreach ($files as $file) {
      $unlink_files = unlink($file);
    }

    $rm_dir = rmdir($dir);

    if ($delete_teacher['response'] == OK_STATUS) {
      $result = response_success();
    } else {
      $result = response_fail();
    }
    echo json_encode($result);
  }
}
