<?php

/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/
if (!defined('BASEPATH')) {
  exit('No direct script access allowed');
}

function image_move($new_dir,$old_dir,$image_name){
  if(!empty($image_name)){
    $old = $old_dir.$image_name;    
    $dircheck = mkdir($new_dir);
    $new = $new_dir.$image_name;
    $copy = copy($old,$new);
    $del_old = unlink($old);
  }
}

function image_upload($image_form, $upload_path)
{
  $ci = & get_instance();
  $ci->load->helper('key_helper', 'rest_response_helper');
  $config = array();
  $config['upload_path'] = $upload_path;
  $config['allowed_types'] = 'jpeg|jpg|png';
  $config['max_size'] = '5000';
  $success = array();
  $error = array();
  foreach ($image_form as $image) {
    $_FILES['img']['name_first'] = $image['name'];
    $_FILES['img']['extension'] = pathinfo($_FILES['img']['name_first'], PATHINFO_EXTENSION);
    $_FILES['img']['name'] = generate_key('6') . '.' . $_FILES['img']['extension'];
    $_FILES['img']['type'] = $image['type'];
    $_FILES['img']['tmp_name'] = $image['tmp_name'];
    $_FILES['img']['error'] = $image['error'];
    $_FILES['img']['size'] = $image['size'];
    $load = $ci->load->library('upload', $config);
    $initialize = $ci->upload->initialize($config);
    $upload = $ci->upload->do_upload('img');
    if ($upload) {
      $name = $_FILES['img']['name'];
      $success[] = $name;
    } else {
      $error_message = $ci->upload->display_errors();
      $error[] = $error_message;
    }
  }

  if (count($error) > 0) {
    $params = new stdClass();
    $params->response =  NO_DATA_STATUS;
    $params->message = "Proses upload tidak lengkap";
    $params->data = array("error" => $error, "success" => $success);
    $return_data = response_custom($params);
  } else {
    $params = new stdClass();
    $params->response = OK_STATUS;
    $params->message = OK_MESSAGE;
    $params->data = $success;
    $return_data = response_custom($params);
  }
  return $return_data;
}

function check_if_empty($image, $image_dir)
{
  //    IMAGE_DIR IS NOT URL
  if (isset($image)) {
    if ($image != "") {
      $check_thumb = file_exists($image_dir);
      if (!$check_thumb) {
        $src = 'noimg.PNG';
      } else {
        $src = $image;
      }
    } else {
      $src = 'noimg.PNG';
    }
  } else {
    $src = 'noimg.PNG';
  }

  return $src;
}
