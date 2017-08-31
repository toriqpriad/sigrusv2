<?php

include 'Tpq.php';

class activity extends tpq
{
  public function __construct()
  {
    parent::__construct();
    parent::checkauth();
    $this->data['active_page'] = "activity";
  }

  public function json()
  {
    $dest_table_as = 'activity as a';
    $select_values = array('a.*');
    $where1 = array("where_column" => 'a.id_level', "where_value" => $this->data['tpq_id']);
    $where2= array("where_column" => 'a.level', "where_value" => 'T');
    $params = new stdClass();
    $params->dest_table_as = $dest_table_as;
    $params->select_values = $select_values;
    $params->where_tables = array($where1,$where2);
    $get = $this->data_model->get($params);
    echo json_encode(array("data" => $get['results']));
  }


  public function index()
  {
    $this->data['title_page'] = "Kegiatan";
    parent::display('tpq/activity/index', 'tpq/activity/function', true);
  }

  public function add()
  {
    $this->data['title_page'] = "Tambah Kegiatan";
    parent::display('tpq/activity/add', 'tpq/activity/function', false);
  }


  public function post()
  {
    $title = $this->input->post("title");
    $desc = $this->input->post("desc");
    $date = $this->input->post("date");
    $tpq = $this->data['tpq_id'];
    $params_data = array(
      "title" => $title,
      "description" => $desc,
      "level" => 'T',
      "id_level" => $tpq,
      "date" => $date,
      "update_at" => date('d-m-Y h:m')
    );
    $dest_table = 'activity';
    $add = $this->data_model->add($params_data, $dest_table);
    $activity_id = $add["data"];
    $activity_dir = BACKEND_IMAGE_UPLOAD_FOLDER.'activity/';

    $error = array();
    $images_support = [];
    if (isset($_FILES["image_1"])) {
      if ($_FILES["image_1"] != "undefined") {
        array_push($images_support, $_FILES["image_1"]);
      }
    }

    if (isset($_FILES["image_2"])) {
      if ($_FILES["image_2"] != "undefined") {
        array_push($images_support, $_FILES['image_2']);
      }
    }

    if (isset($_FILES["image_3"])) {
      if ($_FILES["image_3"] != "undefined") {
        array_push($images_support, $_FILES['image_3']);
      }
    }

    if (isset($_FILES["image_4"])) {
      if ($_FILES["image_4"] != "undefined") {
        array_push($images_support, $_FILES['image_4']);
      }
    }

    if (isset($_FILES["image_5"])) {
      if ($_FILES["image_5"] != "undefined") {
        array_push($images_support, $_FILES['image_5']);
      }
    }

    if (isset($_FILES["image_6"])) {
      if ($_FILES["image_6"] != "undefined") {
        array_push($images_support, $_FILES['image_6']);
      }
    }

    $upload= image_upload($images_support, $activity_dir);
    $name_success = [];
    $error_data = [];
    $int = 1;
    if($upload->response == OK_STATUS){
      foreach($upload->data as $name){
        $name_success[] = array($activity_id,$name, $int,date('d-m-Y h:m'));
        $int++;
      }
    } else {
      foreach($upload->data['success'] as $name){
        $name_success[] = array($activity_id,$name, $int,date('d-m-Y h:m'));
        $int++;
      }
      foreach($upload_images_support->data['error'] as $err){
        $error_data[] = $err;
      }
    }
    foreach($name_success as $name) {
      $params_image = array(
        "id_activity" => $name[0],
        "image" => $name[1],
        "sort" => $name[2],
        "update_at" => date('d-m-Y h:m')
      );
      $dest_table = 'activity_image';
      $add_images = $this->data_model->add($params_image, $dest_table);
    }

    if(empty($error_data)){
      $data = array("link" => base_url() . 'tpq/activity/' . $activity_id);
      $result = get_success($data);
    } else {
      $params = new stdClass();
      $params->response =  NO_DATA_STATUS;
      $params->message = "Proses upload tidak lengkap";
      $params->data = array("error" => $error_data, "link" => base_url() . 'tpq/activity/' . $activity_id);
      $result = response_custom($params);
    }
    echo json_encode($result);
  }

  public function detail()
  {
    $parameter = $this->uri->segment(3);
    $params = new stdClass();
    $params->dest_table_as = 'activity as t';
    $params->select_values = array('t.*');
    $params->where_tables = array(array("where_column" => 't.id', "where_value" => $parameter));
    $get = $this->data_model->get($params);
    if ($get['results'][0] != "") {
      $params_img = new stdClass();
      $params_img->dest_table_as = 'activity_image as ai';
      $params_img->select_values = array('ai.*');
      $params_img->where_tables = array(array("where_column" => 'ai.id_activity', "where_value" => $parameter));
      $get_imgs = $this->data_model->get($params_img);
      $dummy_cover_dir = BACKEND_IMAGE_UPLOAD_FOLDER.'dummy_cover.png';

      $img1 = array("name"=>"","url" => $dummy_cover_dir , "sort" => '1');
      $img2 = array("name"=>"","url" => $dummy_cover_dir , "sort" => '2');
      $img3 = array("name"=>"","url" => $dummy_cover_dir , "sort" => '3');
      $img4 = array("name"=>"","url" => $dummy_cover_dir , "sort" => '4');
      $img5 = array("name"=>"","url" => $dummy_cover_dir , "sort" => '5');
      $img6 = array("name"=>"","url" => $dummy_cover_dir , "sort" => '6');

      $dir = BACKEND_IMAGE_UPLOAD_FOLDER.'activity/';
      foreach($get_imgs["results"] as $old){
        $img_dir = $dir.$old->image;
        $check_thumb = check_if_empty($old->image, $img_dir);
        if ($old->sort == '1') {
          if($check_thumb == NO_IMG_NAME){
            $img1['name'] = "";
            $img1['url'] = $dummy_cover_dir;
          } else {
            $img1['name'] = $check_thumb;
            $img1['url'] = $dir.$check_thumb;
          }
        }elseif ($old->sort == '2') {
          if($check_thumb == NO_IMG_NAME){
            $img2['name'] = "";
            $img2['url'] = $dummy_cover_dir;
          } else {
            $img2['name'] = $check_thumb;
            $img2['url'] = $dir.$check_thumb;
          }
        }elseif ($old->sort == '3') {
          if($check_thumb == NO_IMG_NAME){
            $img3['name'] = "";
            $img3['url'] = $dummy_cover_dir;
          } else {
            $img3['name'] = $check_thumb;
            $img3['url'] = $dir.$check_thumb;
          }
        }elseif ($old->sort == '4') {
          if($check_thumb == NO_IMG_NAME){
            $img4['name'] = "";
            $img4['url'] = $dummy_cover_dir;
          } else {
            $img4['name'] = $check_thumb;
            $img4['url'] = $dir.$check_thumb;
          }
        }
        elseif ($old->sort == '5') {
          if($check_thumb == NO_IMG_NAME){
            $img5['name'] = "";
            $img5['url'] = $dummy_cover_dir;
          } else {
            $img5['name'] = $check_thumb;
            $img5['url'] = $dir.$check_thumb;
          }
        }
        elseif ($old->sort == '6') {
          if($check_thumb == NO_IMG_NAME){
            $img6['name'] = "";
            $img6['url'] = $dummy_cover_dir;
          } else {
            $img6['name'] = $check_thumb;
            $img6['url'] = $dir.$check_thumb;
          }
        }
      }


      $array_img_old_name = array( "img1" => $img1, "img2" => $img2, "img3" => $img3, "img4" => $img4,"img5" => $img5,"img6" => $img6);
      $this->data['old_img'] = $array_img_old_name;
      $this->data['records'] = $get['results'][0];
      $this->data['title_page'] = "Kegiatan ".$get["results"][0]->title;
      parent::display('tpq/activity/detail', 'tpq/activity/function');
    } else {
      redirect('/tpq/404');
    }
  }

  public function update()
  {
    $id = $this->input->post("id");
    $name = $this->input->post("name");
    $gender = $this->input->post("gender");
    $address = $this->input->post("address");
    $activity_category = $this->input->post("activity_category");
    $tpq = $this->data['tpq_id'];
    $tpq_last_id = $this->input->post("tpq_last_id");
    $contact = $this->input->post("contact");
    $place = $this->input->post("place");
    $date = $this->input->post("date");
    $status = $this->input->post("status");
    $education = $this->input->post("education");
    $education_detail = $this->input->post("education_detail");
    $email = $this->input->post("email");
    $old_foto = $this->input->post("old_foto");
    $active = $this->input->post("active");
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
      "education" => $education,
      "education_detail" => $education_detail,
      "status" => $status,
      "active" => $active,
      "activity_category" => $activity_category,
      "address" => $address,
      "update_at" => date('d-m-Y h:m')
    );
    $where = array("where_column" => 'id', "where_value" => $id);
    $params_data->where_tables = array($where);
    $params_data->table_update = 'activity';
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
    $params_update->table_update = 'activity';
    $update_foto_cover = $this->data_model->update($params_update);


    if ($update['response'] == OK_STATUS) {
      $params = new stdClass();
      if ($error) {
        $params->response = FAIL_STATUS;
        $params->message = "Peringatan";
        $params->data = array('link' => base_url() . 'tpq/activity/' . $id);
        $params->data = $error;
      } else {
        $params->response = OK_STATUS;
        $params->message = OK_MESSAGE;
        $params->data = array('link' => base_url() . 'tpq/activity/' . $id);
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
    $params_delete = new stdClass();
    $where1 = array("where_column" => 'activity_id', "where_value" => $id_delete);
    $params_delete->where_tables = array($where1);
    $params_delete->table = 'activity_images';
    $delete = $this->data_model->delete($params_delete);

    $delete = new stdClass();
    $where1 = array("where_column" => 'id', "where_value" => $id_delete);
    $delete->where_tables = array($where1);
    $delete->table = 'activity';
    $delete_activity = $this->data_model->delete($delete);

    $dir = BACKEND_IMAGE_UPLOAD_FOLDER.'activity/'.$id_delete.'/';
    $files = glob($dir.'*');

    foreach ($files as $file) {
      $unlink_files = unlink($file);
    }

    $rm_dir = rmdir($dir);

    if ($delete_activity['response'] == OK_STATUS) {
      $result = response_success();
    } else {
      $result = response_fail();
    }
    echo json_encode($result);
  }
}
