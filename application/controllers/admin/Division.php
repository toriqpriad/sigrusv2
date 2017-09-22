<?php

include 'Admin.php';

class division extends admin
{
    public function __construct()
    {
        parent::__construct();
        parent::checkauth();
        $this->data['active_page'] = "division";
    }

    public function json()
    {
        $dest_table_as = 'division';
        $select_values = array('*');
        $params = new stdClass();
        $params->dest_table_as = $dest_table_as;
        $params->select_values = $select_values;
        $get = $this->data_model->get($params);
        
        if($get['results'] !=""){
            foreach($get['results'] as $each){
                $get_persons = $this->get_persons($each->id);
                $each->persons_count =  count($get_persons);               
            }
        }

        echo json_encode(array("data" => $get['results']));
    }


    public function index()
    {        
        $this->data['title_page'] = "Pengurus PPG";
        parent::display('admin/division/index', 'admin/division/function', true);
    }


    public function add()
    {
        $this->data['title_page'] = "Tambah Pengurus PPG";
        parent::display('admin/division/add', 'admin/division/function', false);
    }

    public function post()
    {
        $name = $this->input->post("name");
        $desc = $this->input->post("desc");
        $params_check = new stdClass();
        $params_data = array(
            "name" => $name,
            "description" => $desc,
            "update_at" => date('d-m-Y h:m')
        );
        $dest_table = 'division';
        $add = $this->data_model->add($params_data, $dest_table);
        $division_id = $add["data"];

        if ($add) {
            $data = array("link" => base_url() . 'admin/division/' . $division_id);
            $result = get_success($data);
        } else {
            $params = new stdClass();
            $params->response =  NO_DATA_STATUS;
            $params->message = FAIL_STATUS;
            $params->data = array("error" => $error_data, "link" => base_url() . 'admin/division/' . $division_id);
            $result = response_custom($params);
        }
        echo json_encode($result);
    }

    public function get_persons($id_division){
        $id = $id_division;        
        $params = new stdClass();
        $params->dest_table_as = 'division_person as p';
        $params->select_values = array('p.*');
        $params->where_tables = array(array("where_column" => 'p.id_division', "where_value" => $id));
        $get = $this->data_model->get($params);
        return $get['results'];
    }


    public function detail()
    {
        $parameter = $this->uri->segment(3);
        $params = new stdClass();
        $params->dest_table_as = 'division as p';
        $params->select_values = array('p.*');
        $params->where_tables = array(array("where_column" => 'p.id', "where_value" => $parameter));
        $get = $this->data_model->get($params);
        if ($get['results'][0] != "") {
            $this->data['person'] = $this->get_persons($parameter);
            $this->data['records'] = $get['results'][0];
            $this->data['title_page'] = $get["results"][0]->name;            
            parent::display('admin/division/detail', 'admin/division/function');
        } else {
            redirect('/admin/404');
        }
    }

    public function update()
    {
        $id = $this->input->post("id");
        $params = new stdClass();
        $params->dest_table_as = 'division as g';
        $params->select_values = array('g.id');
        $params->where_tables = array(array("where_column" => 'g.id', "where_value" => $id));
        $get = $this->data_model->get($params);
        if ($get["response"] == FAIL_STATUS) {
            echo json_encode(response_fail());
            exit();
        } else {
            if ($get["results"] == "") {
                echo json_encode(response_fail());
                exit();
            }
        }
        $name = $this->input->post("name");
        $desc = $this->input->post("description");
        $person = $this->input->post("person");
        $params_data = new stdClass();
        $params_data->new_data = array(
            "name" => $name,
            "description" => $desc,
            "update_at" => date('d-m-Y h:m')
        );
        $where = array("where_column" => 'id', "where_value" => $id);
        $params_data->where_tables = array($where);
        $params_data->table_update = 'division';
        $update = $this->data_model->update($params_data);

        if($person != ""){
            $del = $this->data_model->delete_now('division_person','id_division',$id);
            $person_data = json_decode($person);
            foreach($person_data as $each){                
                $d = array(
                    "name" => $each->name,
                    "contact" => $each->contact,
                    "update_at" => date('d-m-Y h:m'),
                    "id_division" => $id
                );
                $dt = 'division_person';
                $add = $this->data_model->add($d, $dt);
            }
        }

        if ($update['response'] == OK_STATUS) {
            $params = new stdClass();
            $params->response = OK_STATUS;
            $params->message = OK_MESSAGE;
            $params->data = array('link' => base_url() . 'admin/division/' . $id);
            $result = response_custom($params);
        } else {
            $result = response_fail();
        }
        echo json_encode($result);
    }


    public function delete()
    {
        $id = $this->input->post("id");        
        $person_del = $this->data_model->delete_now('division_person','division_id',$id);
        $del = $this->data_model->delete_now('division','id',$id);    
        if ($del['response'] == OK_STATUS) {
            $result = response_success();
        } else {
            $result = response_fail();
        }
        echo json_encode($result);
    }
}
