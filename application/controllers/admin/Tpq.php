<?php

include 'Admin.php';

class tpq extends admin
{
    public function __construct()
    {
        parent::__construct();
        parent::checkauth();
        $this->data['active_page'] = "tpq";
    }

    public function get_login_data($tpq_id){
        $parameter = $tpq_id;
        $params = new stdClass();
        $params->dest_table_as = 'user as u';
        $params->select_values = array('u.username','u.status as user_status');
        $where1 = array("where_column" => 'u.id_level', "where_value" => $parameter);
        $where2 = array("where_column" => 'u.level', "where_value" => 'T');
        $params->where_tables = array($where1,$where2);
        $get = $this->data_model->get($params);

        if($get['results'] != ''){
            $res = $get['results'][0];
        } else {
            $res = '';
        }
        return $res;
    }

    public function json()
    {
        $dest_table_as = 'tpq as t';
        $select_values = array('t.*','p.name as pc_name');
        $join1 = array("join_with" => 'pc as p', "join_on" => 't.id_pc = p.id', "join_type" => '');
        $params = new stdClass();
        $params->dest_table_as = $dest_table_as;
        $params->select_values = $select_values;
        $params->join_tables = array($join1);
        $get = $this->data_model->get($params);
        echo json_encode(array("data" => $get['results']));
    }


    public function index()
    {
        $this->data['title_page'] = "TPQ";
        parent::display('admin/tpq/index', 'admin/tpq/function', true);
    }


    public function get_tpq_position_option()
    {
        $dest_table_as = 'tpq_position as t';
        $select_values = array('t.name as position_name','t.id as position_id',);
        $params = new stdClass();
        $params->dest_table_as = $dest_table_as;
        $params->select_values = $select_values;
        $get = $this->data_model->get($params);
        return $get['results'];
    }

    public function add()
    {
        $this->data['title_page'] = "Tambah TPQ";
        $this->data['pc_options'] = parent::get_pc_option();
        parent::display('admin/tpq/add', 'admin/tpq/function', false);
    }

    public function post()
    {
        $name = $this->input->post("name");
        $address = $this->input->post("address");
        $contact = $this->input->post("contact");
        $alias = $this->input->post("alias");
        $email = $this->input->post("email");
        $pc = $this->input->post("pc");
        $link = strtolower(preg_replace("/[^a-zA-Z0-9]/", "", $name));
        $params_check = new stdClass();
        $params_data = array(
            "name" => $name,
            "id_pc" => $pc,
            "contact" => $contact,
            "email" => $email,
            "alias" => $alias,
            "link" => $link,
            "address" => $address,
            "update_at" => date('d-m-Y h:m')
            );
        $dest_table = 'tpq';
        $add = $this->data_model->add($params_data, $dest_table);
        $tpq_id = $add["data"];
        if (isset($_FILES["logo"])) {
            if ($_FILES["logo"] != "") {
                $upload_logo = image_upload(array($_FILES["logo"]), BACKEND_IMAGE_UPLOAD_FOLDER . "/logo/");
                $image_logo_name = $upload_logo->data[0];
            } else {
                $image_logo_name = "";
            }
        } else {
            $image_logo_name = "";
        }
        if (isset($_FILES["cover"])) {
            if ($_FILES["cover"] != "") {
                $upload_cover = image_upload(array($_FILES["cover"]), BACKEND_IMAGE_UPLOAD_FOLDER . "/cover/");
                $image_cover_name = $upload_cover->data[0];
            } else {
                $image_cover_name = "";
            }
        } else {
            $image_cover_name = "";
        }
        $params_update = new stdClass();
        $params_update->new_data = array("logo" => $image_logo_name, "cover" => $image_cover_name);
        $params_update->table_update = 'tpq';
        $where = array("where_column" => 'id', "where_value" => $tpq_id);
        $params_update->where_tables = array($where);
        $update_logo_cover = $this->data_model->update($params_update);

        $tpq_position = $this->get_tpq_position_option();
        foreach ($tpq_position as $each) {
            $add_position_tpq = array(
                "id_tpq" => $tpq_id,
                "id_tpq_position" => $each->position_id,
                "name" => "",
                "update_at" => date('d-m-Y h:m')
                );
            $dest_table = 'tpq_position_person';
            $add = $this->data_model->add($add_position_tpq, $dest_table);
            $add_position_tpq = "";
        }

        if($link){
            $add_login_tpq = array(
                "username" => $link.$tpq_id,
                "password" => md5($link.$tpq_id),
                "level" => "T",
                "id_level" => $tpq_id,
                "status" => 'N',
                "update_at" => date('d-m-Y h:m')
                );
            $login_table = 'user';
            $add = $this->data_model->add($add_login_tpq, $login_table);
        }


        if ($add) {
            $data = array("link" => base_url() . 'admin/tpq/' . $tpq_id);
            $result = get_success($data);
        } else {
            $params = new stdClass();
            $params->response =  NO_DATA_STATUS;
            $params->message = FAIL_STATUS;
            $params->data = array("error" => $error_data, "link" => base_url() . 'admin/tpq/' . $tpq_id);
            $result = response_custom($params);
        }
        echo json_encode($result);
    }

    public function detail()
    {
        $parameter = $this->uri->segment(3);
        $params = new stdClass();
        $params->dest_table_as = 'tpq as p';
        $params->select_values = array('p.*');
        $params->where_tables = array(array("where_column" => 'p.id', "where_value" => $parameter));
        $get = $this->data_model->get($params);
        if ($get['results'][0] != "") {
            $this->data['pc_options'] = parent::get_pc_option();
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

            $params_pgrs = new stdClass();
            $params_pgrs->dest_table_as = 'tpq_position_person as tpp';
            $params_pgrs->select_values = array('tpp.id as id_person', 'tpp.name as name_person', 'tp.name as name_position','tp.id as id_position');
            $join1 = array("join_with" => 'tpq_position as tp', "join_on" => 'tpp.id_tpq_position = tp.id', "join_type" => 'RIGHT OUTER');
            $where1 = array("where_column" => 'tpp.id_tpq', "where_value" => $parameter);
            $where2 = array("where_column" => 'tpp.id', "where_value" => null);
            $params_pgrs->join_tables = array($join1);
            $params_pgrs->where_tables = array($where1);
            $params_pgrs->or_where_tables = array($where2);
            $get_pgrs = $this->data_model->get($params_pgrs);
            $login_data = $this->get_login_data($parameter);
            if($login_data != NULL){
                $get['results'][0]->username = $login_data->username;
                $get['results'][0]->user_status = $login_data->user_status;
            }
            $this->data['records'] = $get['results'][0];
            $this->data['position'] = $get_pgrs['results'];
            $this->data['title_page'] = $get["results"][0]->name;
            parent::display('admin/tpq/detail', 'admin/tpq/function');
        } else {
            redirect('/admin/404');
        }
    }

    public function update()
    {
        $id = $this->input->post("id");
        $name = $this->input->post("name");
        $address = $this->input->post("address");
        $contact = $this->input->post("contact");
        $alias = $this->input->post("alias");
        $username = $this->input->post("username");
        $email = $this->input->post("email");
        $pc = $this->input->post("pc");
        $link = strtolower(preg_replace("/[^a-zA-Z0-9]/", "", $name));
        $old_logo = $this->input->post("old_logo");
        $old_cover = $this->input->post("old_cover");
        $position_data = json_decode($this->input->post("position_data"));

        $params_data = new stdClass();
        $params_data->new_data = array(
            "name" => $name,
            "id_pc" => $pc,
            "contact" => $contact,
            "email" => $email,
            "alias" => $alias,
            "link" => $link,
            "address" => $address,
            "update_at" => date('d-m-Y h:m')
            );
        $where = array("where_column" => 'id', "where_value" => $id);
        $params_data->where_tables = array($where);
        $params_data->table_update = 'tpq';
        $update = $this->data_model->update($params_data);
        $error = [];
        if (isset($_FILES["logo"])) {
            if (!empty($_FILES["logo"]["name"])) {
                $upload_logo = image_upload(array($_FILES["logo"]), BACKEND_IMAGE_UPLOAD_FOLDER . "/logo/");
                if ($upload_logo->response == OK_STATUS) {
                    $image_logo_name = $upload_logo->data[0];
                    if ($old_logo != "") {
                        $remove_old = unlink(BACKEND_IMAGE_UPLOAD_FOLDER . "/logo/" . $old_logo);
                    }
                } else {
                    if ($upload_logo->data['error']) {
                        foreach ($upload_logo->data['error'] as $er) {
                            array_push($error, $er);
                        }
                    }
                    $image_logo_name = $old_logo;
                }
            } else {
                $image_logo_name = $old_logo;
            }
        } else {
            $image_logo_name = $old_logo;
        }
        if (isset($_FILES["cover"])) {
            if (!empty($_FILES["cover"]["name"])) {
                $upload_cover = image_upload(array($_FILES["cover"]), BACKEND_IMAGE_UPLOAD_FOLDER . "/cover/");
                if ($upload_cover->response == OK_STATUS) {
                    $image_cover_name = $upload_cover->data[0];
                    if ($old_cover != "") {
                        $remove_old = unlink(BACKEND_IMAGE_UPLOAD_FOLDER . "/cover/" . $old_cover);
                    }
                } else {
                    if ($upload_cover->data['error']) {
                        foreach ($upload_cover->data['error'] as $er) {
                            array_push($error, $er);
                        }
                    }
                    $image_cover_name = $old_cover;
                }
            } else {
                $image_cover_name = $old_cover;
            }
        } else {
            $image_cover_name = $old_cover;
        }

        $params_update = new stdClass();
        $params_update->new_data = array("logo" => $image_logo_name, "cover" => $image_cover_name);
        $where = array("where_column" => 'id', "where_value" => $id);
        $params_update->where_tables = array($where);
        $params_update->table_update = 'tpq';
        $update_logo_cover = $this->data_model->update($params_update);

        if (isset($position_data)) {
            if (!empty($position_data)) {
                $params_delete = new stdClass();
                $where1 = array("where_column" => 'id_tpq', "where_value" => $id);
                $params_delete->where_tables = array($where1);
                $params_delete->table = 'tpq_position_person';
                $delete = $this->data_model->delete($params_delete);
            }
            foreach ($position_data as $data) {
                $new_data = array(
                    "id_tpq_position" => $data->position_id,
                    "id_tpq" => $id,
                    "name" => $data->position_person,
                    "update_at" => date('d-m-Y h:m')
                    );
                $dest_table_sc = 'tpq_position_person';
                $add_sc = $this->data_model->add($new_data, $dest_table_sc);
            }
        }

        if($username != ""){
            $login_data = new stdClass();
            $login_data->new_data = array("username" => $username);
            $where1 = array("where_column" => 'u.level', "where_value" => "T");
            $where2 = array("where_column" => 'u.id_level', "where_value" =>$id);
            $login_data->where_tables = array($where1,$where2);
            $login_data->table_update = 'user as u';
            $update_login_data = $this->data_model->update($login_data);
        }

        if ($update['response'] == OK_STATUS) {
            $params = new stdClass();
            if ($error) {
                $params->response = FAIL_STATUS;
                $params->message = "Peringatan";
                $params->data = array('link' => base_url() . 'admin/tpq/' . $id);
                $params->data = $error;
            } else {
                $params->response = OK_STATUS;
                $params->message = OK_MESSAGE;
                $params->data = array('link' => base_url() . 'admin/tpq/' . $id);
            }
            $result = response_custom($params);
        } else {
            $result = response_fail();
        }
        echo json_encode($result);
    }


    public function delete()
    {
        $id = $this->input->post('id');
        $params = new stdClass();
        $params->dest_table_as = 'tpq as t';
        $params->select_values = array('t.logo','t.cover');
        $params->where_tables = array(array("where_column" => 't.id', "where_value" => $id));
        $get = $this->data_model->get($params);
        $logo = $get['results'][0]->logo;
        $cover = $get['results'][0]->cover;              


        $teacher_del = $this->data_model->delete_now('teacher','id_tpq',$id);
        $student_del = $this->data_model->delete_now('student','id_tpq',$id);
        $position_del = $this->data_model->delete_now('tpq_position_person','id_tpq',$id);
        $del = $this->data_model->delete_now('tpq','id',$id);

        if($cover)
        {
          $file = BACKEND_IMAGE_UPLOAD_FOLDER.'cover/'.$cover;
          $unlink_files = unlink($file);      
      }

      if($logo)
      {
          $file = BACKEND_IMAGE_UPLOAD_FOLDER.'logo/'.$logo;
          $unlink_files = unlink($file);      
      }


      if ($del['response'] == OK_STATUS) {
          $result = response_success();
      } else {
          $result = response_fail();
      }
      echo json_encode($result);
  }


  public function delete_now($id)
  {    
    $params = new stdClass();
    $params->dest_table_as = 'tpq as t';
    $params->select_values = array('t.logo','t.cover');
    $params->where_tables = array(array("where_column" => 't.id', "where_value" => $id));
    $get = $this->data_model->get($params);
    $logo = $get['results'][0]->logo;
    $cover = $get['results'][0]->cover;              


    $teacher_del = $this->data_model->delete_now('teacher','id_tpq',$id);
    $student_del = $this->data_model->delete_now('student','id_tpq',$id);
    $position_del = $this->data_model->delete_now('tpq_position_person','id_tpq',$id);
    $del = $this->data_model->delete_now('tpq','id',$id);

    if($cover)
    {
      $file = BACKEND_IMAGE_UPLOAD_FOLDER.'cover/'.$cover;
      $unlink_files = unlink($file);      
  }

  if($logo)
  {
      $file = BACKEND_IMAGE_UPLOAD_FOLDER.'logo/'.$logo;
      $unlink_files = unlink($file);      
  }


  if ($del['response'] == OK_STATUS) {
      $result = response_success();
  } else {
      $result = response_fail();
  }
  echo json_encode($result);
}

public function change_password() {
    $id = $this->input->post("id");
        // $old_pass = $this->input->post("old_pass");
    $new_pass = $this->input->post("new_pass");
    $dest_table_as = 'user as u';
    $select_values = array('u.password');
    $params = new stdClass();
    $params->dest_table_as = $dest_table_as;
    $params->select_values = $select_values;
    $where1 = array("where_column" => 'u.level', "where_value" => "T");
    $where2 = array("where_column" => 'u.id_level', "where_value" =>$id);
    $params->where_tables = array($where1,$where2);
    $get = $this->data_model->get($params);
    if ($get['response'] == OK_STATUS) {
        $params_data = new stdClass();
        $params_data->new_data = array("password" => $new_pass,"status" => 'E', "update_at" => date('d-m-Y h:m') );
        $where1 = array("where_column" => 'u.level', "where_value" => "T");
        $where2 = array("where_column" => 'u.id_level', "where_value" =>$id);
        $params_data->where_tables = array($where1,$where2);
        $params_data->table_update = 'user as u';
        $update = $this->data_model->update($params_data);
        if ($update["response"] == OK_STATUS) {
            $response_data = array("response" => OK_STATUS, "message" => "Password sudah diganti");
        }
    }
    echo json_encode($response_data);
}
}
