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
    $tpq = $this->data['tpq_id'];
    $params = new stdClass();
    $params->dest_table_as = 'activity as p';
    $params->select_values = array('p.id');
    $params->where_tables = array(array("where_column" => 'p.id', "where_value" => $id));
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
    $title = $this->input->post("title");
    $desc = $this->input->post("desc");
    $date = $this->input->post("date");
    $tpq_id = $this->data['tpq_id'];

    $img1old = $this->input->post("img_1_old");
    $img2old = $this->input->post("img_2_old");
    $img3old = $this->input->post("img_3_old");
    $img4old = $this->input->post("img_4_old");
    $img5old = $this->input->post("img_5_old");
    $img6old = $this->input->post("img_6_old");
    $to_delete = $this->input->post("to_delete");
    $params_data = new stdClass();
    $params_data->new_data = array(
      "title" => $title,
      "description" => $desc,
      "level" => 'T',
      "id_level" => $tpq,
      "date" => $date,
      "update_at" => date('d-m-Y h:m')
    );

    $where = array("where_column" => 'id', "where_value" => $id);
    $params_data->where_tables = array($where);
    $params_data->table_update = 'activity';
    $update = $this->data_model->update($params_data);

    $img_uploads_array = [];
    if(isset($_FILES["img_1_new"])){
      $img1 = array("file" =>$_FILES["img_1_new"], "old" => $img1old,"sort" => '1');
      array_push($img_uploads_array,$img1);
    }
    if(isset($_FILES["img_2_new"])){
      $img2 = array("file" =>$_FILES["img_2_new"], "old" => $img2old,"sort" => '2');
      array_push($img_uploads_array,$img2);
    }

    if(isset($_FILES["img_3_new"])){
      $img3 = array("file" =>$_FILES["img_3_new"], "old" => $img3old,"sort" => '3');
      array_push($img_uploads_array,$img3);
    }

    if(isset($_FILES["img_4_new"])){
      $img4 = array("file" =>$_FILES["img_4_new"], "old" => $img4old,"sort" => '4');
      array_push($img_uploads_array,$img4);
    }

    if(isset($_FILES["img_5_new"])){
      $img5 = array("file" =>$_FILES["img_5_new"], "old" => $img5old,"sort" => '5');
      array_push($img_uploads_array,$img5);
    }

    if(isset($_FILES["img_6_new"])){
      $img6 = array("file" =>$_FILES["img_6_new"], "old" => $img4old,"sort" => '6');
      array_push($img_uploads_array,$img6);
    }

    $error_upload = [];
    $success_upload = [];
    $dir = BACKEND_IMAGE_UPLOAD_FOLDER.'activity/';
    foreach($img_uploads_array as $ar){
      $upload = image_upload(array($ar["file"]) , $dir);
      if ($upload->response == OK_STATUS) {
        $image_name = $upload->data[0];
        if ($ar["old"] != "") {
          $remove_old = unlink( $dir. $ar["old"]);
        }
        array_push($success_upload,array("new" => $image_name, "old" => $ar["old"], "sort" => $ar['sort']));

      } else {
        if ($upload->data['error']) {
          foreach ($upload->data['error'] as $er) {
            array_push($error_upload, $er);
          }
        }
      }
    }

    foreach($success_upload as $each){
      if($each['old'] != ""){
        $params_update_images = new stdClass();
        $params_update_images->new_data = array("image" => $each['new']);
        $where1 = array("where_column" => 'image', "where_value" => $each['old']);
        $where2 = array("where_column" => 'sort', "where_value" => $each['sort']);
        $params_update_images->where_tables = array($where1,$where2);
        $params_update_images->table_update = 'activity_image';
        $update_images = $this->data_model->update($params_update_images);
      } else {
        $params_data = array(
          "id_activity" => $id,
          "image" => $each['new'],
          "sort" => $each['sort'],
        );
        $dest_table = 'activity_image';
        $add = $this->data_model->add($params_data, $dest_table);
      }
    }

    if(isset($to_delete)){
      $del_data = json_decode($to_delete);
      foreach($del_data as $del){
        $params_delete = new stdClass();
        $where1 = array("where_column" => 'image', "where_value" => $del);
        $params_delete->where_tables = array($where1);
        $params_delete->table = 'activity_image';
        $delete = $this->data_model->delete($params_delete);
        $check_thumb = check_if_empty($del, $dir);
        if($check_thumb != NO_IMG_NAME){
          $remove_old = unlink($dir . $del);
        }
      }
    }


    if ($update['response'] == OK_STATUS ) {
      $params = new stdClass();
      if ($error_upload) {
        $params->response = FAIL_STATUS;
        $params->message = "Peringatan";
        $params->data = array('link' => base_url() . 'admin/product/' . $id,"error" => $error_upload);
      } else {
        $params->response = OK_STATUS;
        $params->message = OK_MESSAGE;
        $params->data = array('link' => base_url() . 'admin/product/' . $id);
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
