<?php

include 'Admin.php';

class tpq_position extends admin
{
    public function __construct()
    {
        parent::__construct();
        parent::checkauth();
        $this->data['active_page'] = "tpq_position";
    }

    public function json()
    {
        $dest_table_as = 'tpq_position';
        $select_values = array('*');
        $params = new stdClass();
        $params->dest_table_as = $dest_table_as;
        $params->select_values = $select_values;
        $get = $this->data_model->get($params);
        echo json_encode(array("data" => $get['results']));
    }


    public function index()
    {
        $this->data['title_page'] = "Pengurus TPQ";
        parent::display('admin/tpq_position/index', 'admin/tpq_position/function', true);
    }


    public function add()
    {
        $this->data['title_page'] = "Tambah Pengurus TPQ";
        parent::display('admin/tpq_position/add', 'admin/tpq_position/function', false);
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
        $dest_table = 'tpq_position';
        $add = $this->data_model->add($params_data, $dest_table);
        $tpq_position_id = $add["data"];

        if ($add) {
            $data = array("link" => base_url() . 'admin/tpq_position/' . $tpq_position_id);
            $result = get_success($data);
        } else {
            $params = new stdClass();
            $params->response =  NO_DATA_STATUS;
            $params->message = FAIL_STATUS;
            $params->data = array("error" => $error_data, "link" => base_url() . 'admin/tpq_position/' . $tpq_position_id);
            $result = response_custom($params);
        }
        echo json_encode($result);
    }

    public function detail()
    {
        $parameter = $this->uri->segment(3);
        $params = new stdClass();
        $params->dest_table_as = 'tpq_position as p';
        $params->select_values = array('p.*');
        $params->where_tables = array(array("where_column" => 'p.id', "where_value" => $parameter));
        $get = $this->data_model->get($params);
        if ($get['results'][0] != "") {
            $this->data['records'] = $get['results'][0];
            $this->data['title_page'] = $get["results"][0]->name;
            parent::display('admin/tpq_position/detail', 'admin/tpq_position/function');
        } else {
            redirect('/admin/404');
        }
    }

    public function update()
    {
        $id = $this->input->post("id");
        $params = new stdClass();
        $params->dest_table_as = 'tpq_position as g';
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

        $params_data = new stdClass();
        $params_data->new_data = array(
        "name" => $name,
        "description" => $desc,
        "update_at" => date('d-m-Y h:m')
        );
        $where = array("where_column" => 'id', "where_value" => $id);
        $params_data->where_tables = array($where);
        $params_data->table_update = 'tpq_position';
        $update = $this->data_model->update($params_data);

        if ($update['response'] == OK_STATUS) {
            $params = new stdClass();
            $params->response = OK_STATUS;
            $params->message = OK_MESSAGE;
            $params->data = array('link' => base_url() . 'admin/tpq_position/' . $id);
            $result = response_custom($params);
        } else {
            $result = response_fail();
        }
        echo json_encode($result);
    }


    public function delete()
    {
        $id_delete = $this->input->post("id");

        $c = new stdClass();
        $c->select_values = array('id');
        $c->dest_table_as = 'tpq_position_person';
        $where1 = array("where_column" => 'tpq_position_id', "where_value" => $id_delete);
        $c->where_tables = array($where1);
        $c_get = $this->data_model->get($c);
        // print_r($c_get);exit();
        if($c_get['results'] != ""){
            foreach($c_get['results'] as $each){
                $del = parent::mass_delete('tpq_position_id',$each->id,'tpq_position_person');
            }
        }
        $del = parent::mass_delete('id',$id_delete,'tpq_position');
        // print_r($del_cat['response']);exit();
        if ($del['response'] == OK_STATUS) {
            $result = response_success();
        } else {
            $result = response_fail();
        }
        echo json_encode($result);
    }
}
