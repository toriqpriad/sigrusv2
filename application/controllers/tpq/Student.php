<?php

include 'Tpq.php';

class student extends tpq
{
  public function __construct()
  {
    parent::__construct();
    parent::checkauth();
    $this->data['active_page'] = "student";
  }

  public function json()
  {
    $dest_table_as = 'student as t';
    $select_values = array('t.*','tpq.name as tpq_name','tpq.alias as tpq_alias');
    $join1 = array("join_with" => 'tpq', "join_on" => 't.id_tpq = tpq.id', "join_type" => '');
    $where = array("where_column" => 'tpq.id', "where_value" => $this->data['tpq_id']);
    $params = new stdClass();
    $params->dest_table_as = $dest_table_as;
    $params->select_values = $select_values;
    $params->join_tables = array($join1);
    $params->where_tables = array($where);
    $get = $this->data_model->get($params);
    if($get['results'] != ''){
      foreach($get['results'] as $each){
        if($each->student_category == 'C'){
          $each->student_category = 'Caberawit';
        } elseif($each->student_category == 'P'){
          $each->student_category = 'Praremaja';
        } else {
          $each->student_category = 'Remaja';
        }
      }
    }
    echo json_encode(array("data" => $get['results']));
  }


  public function index()
  {
    $this->data['title_page'] = "Siswa";
    parent::display('tpq/student/index', 'tpq/student/function', true);
  }

  public function search_page()
  {
    $this->data['title_page'] = "Pencarian Siswa";
    parent::display('tpq/student/search', 'tpq/student/function', true);
  }

  public function add()
  {
    $this->data['title_page'] = "Tambah Siswa";
    parent::display('tpq/student/add', 'tpq/student/function', false);
  }

  public function post()
  {
    $name = $this->input->post("name");
    $gender = $this->input->post("gender");
    $address = $this->input->post("address");
    $student_category = $this->input->post("student_category");
    $tpq = $this->data['tpq_id'];
    $contact = $this->input->post("contact");
    $place = $this->input->post("place");
    $date = $this->input->post("date");
    $email = $this->input->post("email");
    $status = $this->input->post("status");
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
      "student_category" => $student_category,
      "address" => $address,
      "status" => $status,
      "update_at" => date('d-m-Y h:m')
    );
    $dest_table = 'student';
    $add = $this->data_model->add($params_data, $dest_table);
    $student_id = $add["data"];
    $student_dir = BACKEND_IMAGE_UPLOAD_FOLDER;

    if (isset($_FILES["foto"])) {
      if ($_FILES["foto"] != "") {
        $upload= image_upload(array($_FILES["foto"]), $student_dir . "/profile/");
        $image_name = $upload->data[0];
      } else {
        $image_name = "";
      }
    } else {
      $image_name = "";
    }

    $params_update = new stdClass();
    $params_update->new_data = array("photo" => $image_name);
    $params_update->table_update = 'student';
    $where = array("where_column" => 'id', "where_value" => $student_id);
    $params_update->where_tables = array($where);
    $update_foto_cover = $this->data_model->update($params_update);

    if ($add) {
      $data = array("link" => base_url() . 'tpq/student/' . $student_id);
      $result = get_success($data);
    } else {
      $params = new stdClass();
      $params->response =  NO_DATA_STATUS;
      $params->message = FAIL_STATUS;
      $params->data = array("error" => $error_data, "link" => base_url() . 'tpq/student/' . $student_id);
      $result = response_custom($params);
    }
    echo json_encode($result);
  }

  public function detail()
  {
    $parameter = $this->uri->segment(3);
    $params = new stdClass();
    $params->dest_table_as = 'student as t';
    $params->select_values = array('t.*');
    $params->where_tables = array(array("where_column" => 't.id', "where_value" => $parameter));
    $get = $this->data_model->get($params);
    if ($get['results'][0] != "") {
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
      $this->data['title_page'] = "Siswa ".$get["results"][0]->name;
      parent::display('tpq/student/detail', 'tpq/student/function');
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
    $student_category = $this->input->post("student_category");
    $tpq = $this->data['tpq_id'];
    $tpq_last_id = $this->input->post("tpq_last_id");
    $contact = $this->input->post("contact");
    $place = $this->input->post("place");
    $father = $this->input->post("father");
    $mother = $this->input->post("mother");
    $education = $this->input->post("education");
    $education_detail = $this->input->post("education_detail");
    $date = $this->input->post("date");
    $active = $this->input->post("active");
    $status = $this->input->post("status");
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
      "father" => $father,
      "mother" => $mother,
      "education" => $education,
      "education_detail" => $education_detail,
      "place_birth" => $place,
      "date_birth" => $date,
      "link" => $link,
      "student_category" => $student_category,
      "address" => $address,
      "active" => $active,
      "status" => $status,
      "update_at" => date('d-m-Y h:m')
    );
    $where = array("where_column" => 'id', "where_value" => $id);
    $params_data->where_tables = array($where);
    $params_data->table_update = 'student';
    $update = $this->data_model->update($params_data);


    $error = [];
    if (isset($_FILES["foto"])) {
      if (!empty($_FILES["foto"]["name"])) {
        // print_r(base_url()."/assets/images/backend/tpq/" . $tpq . "/student/" . $id . "profile/".$_FILES["foto"]["name"]);
        $upload_foto = image_upload(array($_FILES["foto"]), BACKEND_IMAGE_UPLOAD_FOLDER . "/profile/");
        if ($upload_foto->response == OK_STATUS) {
          $image_foto_name = $upload_foto->data[0];
          if ($old_foto != "") {
            $remove_old = unlink(BACKEND_IMAGE_UPLOAD_FOLDER . "/profile/" . $old_foto);
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
    $params_update->table_update = 'student';
    $update_foto_cover = $this->data_model->update($params_update);


    if ($update['response'] == OK_STATUS) {
      $params = new stdClass();
      if ($error) {
        $params->response = FAIL_STATUS;
        $params->message = "Peringatan";
        $params->data = array('link' => base_url() . 'tpq/student/' . $id);
        $params->data = $error;
      } else {
        $params->response = OK_STATUS;
        $params->message = OK_MESSAGE;
        $params->data = array('link' => base_url() . 'tpq/student/' . $id);
      }
      $result = response_custom($params);
    } else {
      $result = response_fail();
    }
    echo json_encode($result);
  }


  public function search_submit()
  {
    $name = $this->input->post("name");
    $gender = $this->input->post("gender");
    $address = $this->input->post("address");
    $student_category = $this->input->post("student_category");
    $contact = $this->input->post("contact");
    $tpq = $this->data['tpq_id'];
    $gender = $this->input->post("gender");
    $address = $this->input->post("address");
    $education = $this->input->post("education");
    $education_detail = $this->input->post("education_detail");
    $place = $this->input->post("place");
    $date = $this->input->post("date");
    $email = $this->input->post("email");
    $father = $this->input->post("father");
    $mother = $this->input->post("mother");
    $active = $this->input->post("active");
    $status = $this->input->post("status");
    $params = new stdClass();
    $params->dest_table_as = 'student as t';
    $params->select_values = array('t.*');
    $where = [];
    $where_like = [];
    if($name != NULL){
      $n = array("where_column" => 't.name', "where_value" => $name);
      array_push($where_like,$n);
    }

    if($gender != NULL ){
      $g = array("where_column" => 't.gender', "where_value" => $gender);
      array_push($where_like,$g);
    }

    if($student_category != NULL ){
      $tc = array("where_column" => 't.student_category', "where_value" => $student_category);
      array_push($where_like,$tc);
    }

    if( $education != NULL ){
      $ed = array("where_column" => 't.education', "where_value" => $education);
      array_push($where_like,$ed);
    }

    if( $education_detail != NULL ){
      $edc = array("where_column" => 't.education_detail', "where_value" => $education_detail);
      array_push($where_like,$edc);
    }

    if( $contact != NULL ){
      $c = array("where_column" => 't.contact', "where_value" => $contact);
      array_push($where_like,$c);
    }

    if($place != NULL ){
      $p = array("where_column" => 't.place_birth', "where_value" => $place);
      array_push($where_like,$p);
    }

    if( $date != NULL ){
      $d = array("where_column" => 't.date_birth', "where_value" => $date);
      array_push($where_like,$d);
    }

    if( $father != NULL ){
      $fa = array("where_column" => 't.father', "where_value" => $father);
      array_push($where_like,$fa);
    }

    if( $mother != NULL ){
      $mo = array("where_column" => 't.mother', "where_value" => $mother);
      array_push($where_like,$mo);
    }

    if($address != NULL ){
      $a = array("where_column" => 't.address', "where_value" => $address);
      array_push($where_like,$a);
    }

    if($active != NULL ){
      $av = array("where_column" => 't.active', "where_value" => $active);
      array_push($where,$av);
    }

    if($status != NULL ){
      $st = array("where_column" => 't.status', "where_value" => $status);
      array_push($where,$st);
    }

    if($tpq != NULL ){
      $tpq = array("where_column" => 't.id_tpq', "where_value" => $tpq);
      array_push($where,$tpq);
    }
    $params->where_tables = $where;
    $params->where_tables_like = $where_like;
    $join1 = array("join_with" => 'tpq as tp', "join_on" => 't.id_tpq = tp.id', "join_type" => '');
    $params->join_tables = array($join1);
    $params->select_values = array('t.*','tp.name as tpq_name','tp.alias as tpq_alias');
    $get = $this->data_model->get($params);
    if($get['results'] != ""){
      foreach($get['results'] as $each){
        if($each->date_birth != ""){
          $age = date_diff( date_create($each->date_birth), date_create() );
          $each->age = $age->y;
        }

        if($each->gender == 'F'){
          $each->gender = 'Perempuan';
        } else {
          $each->gender = 'Laki-Laki';
        }

        if($each->student_category == 'C'){
          $each->student_category = 'Caberawit';
        } elseif($each->student_category == 'P') {
          $each->student_category = 'Praremaja';
        } else {
          $each->student_category = 'Remaja';
        }

        if($each->status == 'M'){
          $each->status = 'Menikah';
        } else {
          $each->status = 'Lajang';
        }

        if($each->active == 'A'){
          $each->active = 'Aktif';
        } else {
          $each->active = 'Nonaktif';
        }
      }
    }
    echo json_encode(get_success($get['results']));
  }

  public function delete()
  {    

    $id = $this->input->post('id');
    $params = new stdClass();
    $params->dest_table_as = 'student as t';
    $params->select_values = array('t.photo');
    $params->where_tables = array(array("where_column" => 't.id', "where_value" => $id));
    $get = $this->data_model->get($params);
    $photo = $get['results'][0]->photo;
    if($photo){
      $file = BACKEND_IMAGE_UPLOAD_FOLDER.'profile/'.$photo;
      $unlink_files = unlink($file);
    }
    $delete = new stdClass();
    $where1 = array("where_column" => 'id', "where_value" => $id);
    $delete->where_tables = array($where1);
    $delete->table = 'student';
    $delete_student = $this->data_model->delete($delete);

    
    if ($delete_student['response'] == OK_STATUS) {
      $result = response_success();
    } else {
      $result = response_fail();
    }
    echo json_encode($result);
  }
}
