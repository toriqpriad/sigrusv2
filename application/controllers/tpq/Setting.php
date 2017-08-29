<?php

include 'Tpq.php';

class setting extends tpq {

  function __construct() {
    parent::__construct();
    parent::checkauth();
    $this->data['active_page'] = "setting";
  }

  //Data on Page
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

          $this->data['records'] = $get['results'][0];
          $this->data['position'] = $get_pgrs['results'];
          $this->data['title_page'] = $get["results"][0]->name;
          parent::display('tpq/setting/detail', 'tpq/setting/function');
      } else {
          redirect('/tpq/404');
      }
  }
}
