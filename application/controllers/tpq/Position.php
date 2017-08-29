<?php

include 'Tpq.php';

class position extends tpq
{
    public function __construct()
    {
        parent::__construct();
        parent::checkauth();
        $this->data['active_page'] = "position";
    }

    public function json()
    {
        $dest_table_as = 'tpq_position_person';
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
        parent::display('tpq/position/index', 'tpq/position/function', true);
    }


    public function add()
    {
        $this->data['title_page'] = "Tambah Pengurus TPQ";
        parent::display('tpq/position/add', 'tpq/position/function', false);
    }

    public function detail()
    {

        $params = new stdClass();
        $params->dest_table_as = 'tpq_position_person as tpp';
        $params->select_values = array('tpp.*','tp.name as name_position','tp.id as id_position');
        $join1 = array("join_with" => 'tpq_position as tp ', "join_on" => 'tpp.id_tpq_position = tp.id', "join_type" => '');
        $params->where_tables = array(array("where_column" => 'tpp.id_tpq', "where_value" => $this->data['tpq_id']));
        $params->join_tables = array($join1);
        $get = $this->data_model->get($params);
        if ($get['results'] != "") {
            $this->data['records'] = $get['results'];
            $this->data['title_page'] = 'Pengurus TPQ';
            parent::display('tpq/position/detail', 'tpq/position/function');
        } else {
            redirect('/tpq/404');
        }
    }

    public function update()
    {
        $id = $this->data['tpq_id'];
        $params = new stdClass();
        $params->dest_table_as = 'tpq_position_person as g';
        $params->select_values = array('g.id');
        $params->where_tables = array(array("where_column" => 'g.id_tpq', "where_value" => $id));
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

        $position_data = json_decode($this->input->post("position_data"));

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


        $params = new stdClass();
        $params->response = OK_STATUS;
        $params->message = OK_MESSAGE;
        $params->data = array('link' => base_url() . 'tpq/position');
        $result = response_custom($params);
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
