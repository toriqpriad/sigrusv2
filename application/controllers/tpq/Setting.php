<?php

include 'Tpq.php';

class setting extends tpq {

  function __construct() {
    parent::__construct();
    parent::checkauth();
    $this->data['active_page'] = "setting";
  }

  //Data on Page
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

  public function get_login_data(){
    $parameter = $this->data['tpq_id'];
    $params = new stdClass();
    $params->dest_table_as = 'user as u';
    $params->select_values = array('u.username');
    $where1 = array("where_column" => 'u.id_level', "where_value" => $parameter);
    $where2 = array("where_column" => 'u.level', "where_value" => 'T');
    $params->where_tables = array($where1,$where2);
    $get = $this->data_model->get($params);
    return $get['results'][0];
  }

  public function detail()
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

          $login_data = $this->get_login_data();
          $get['results'][0]->username = $login_data->username;
          $this->data['records'] = $get['results'][0];
          $this->data['pc_options'] = $this->get_pc_option();
          $this->data['title_page'] = $get["results"][0]->name;
          parent::display('tpq/setting/detail', 'tpq/setting/function');
      } else {
          redirect('/tpq/404');
      }
  }

  public function update()
    {
        $id = $this->data['tpq_id'];
        $name = $this->input->post("name");
        $username = $this->input->post("username");
        $address = $this->input->post("addr");
        $contact = $this->input->post("contact");
        $alias = $this->input->post("alias");
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

        if($username != NULL){
          $login_update = new stdClass();
          $login_update->new_data = array("username" => $username);
          $where_1 = array("where_column" => 'level', "where_value" => 'T');
          $where_2 = array("where_column" => 'id_level', "where_value" => $id);
          $login_update->where_tables = array($where_1,$where_2);
          $login_update->table_update = 'user';
          $update_login = $this->data_model->update($login_update);
        }

        $data_profile = array('id' => $id, 'name' => $name, 'alias' => $alias, 'logo_url' => $image_logo_name);
        $set_session = $this->session->set_userdata('tpq_data', $data_profile);

        if ($update['response'] == OK_STATUS) {
            $params = new stdClass();
            if ($error) {
                $params->response = FAIL_STATUS;
                $params->message = "Peringatan";
                $params->data = array('link' => base_url() . 'tpq/setting');
                $params->data = $error;
            } else {
                $params->response = OK_STATUS;
                $params->message = OK_MESSAGE;
                $params->data = array('link' => base_url() . 'tpq/setting');
            }
            $result = response_custom($params);
        } else {
            $result = response_fail();
        }
        echo json_encode($result);
    }


    public function change_password() {
      $old_pass = $this->input->post("old_pass");
      $new_pass = $this->input->post("new_pass");
      $dest_table_as = 'user as u';
      $select_values = array('u.password');
      $params = new stdClass();
      $params->dest_table_as = $dest_table_as;
      $params->select_values = $select_values;
      $where1 = array("where_column" => 'u.level', "where_value" => "T");
      $where2 = array("where_column" => 'u.id_level', "where_value" =>$this->data['tpq_id']);
      $params->where_tables = array($where1,$where2);
      $get = $this->data_model->get($params);
      if ($get['response'] == OK_STATUS) {
        if ($old_pass != $get['results'][0]->password) {
          $response_data = array("response" => FAIL_STATUS, "message" => "Password lama tidak sesuai");
        } else {
          $params_data = new stdClass();
          $params_data->new_data = array("password" => $new_pass);
          $where1 = array("where_column" => 'u.level', "where_value" => "T");
          $where2 = array("where_column" => 'u.id_level', "where_value" =>$this->data['tpq_id']);
          $params_data->where_tables = array($where1,$where2);
          $params_data->table_update = 'user as u';
          $update = $this->data_model->update($params_data);
          if ($update["response"] == OK_STATUS) {
            $response_data = array("response" => OK_STATUS, "message" => "Password sudah diganti");
          }
        }
      }
      echo json_encode($response_data);
    }
}
