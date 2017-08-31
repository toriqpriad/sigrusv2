<?php
class authentication extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'data_model' );
		$this->load->library ( array (
			'curl',
			'session',
			'email'
			) );
			$this->load->helper ( array (
				'form',
				'url',
				'jwt_helper',
				'rest_response_helper',
				'key_helper',
				'send_mail_helper',
				'client_access_helper',
				'image_process_helper',
				) );
				$this->data = [ ];
			}

			public function display($location) {
				$this->load->view ( 'authentication/include/head', $this->data );
				$this->load->view ( 'authentication/include/function' );
				$this->load->view ( $location );
				$this->load->view ( 'authentication/include/footer_menu' );
			}

			function login() {
				$this->data ['title_page'] = "Halaman Login";
				$this->display ( 'authentication/login' );
			}


			public function submit_login() {
				try {
					$param_fail = new stdClass();
					$param_fail->response = FAIL_STATUS;
					$param_fail->message = "Login failed!";
					$param_fail->data = "";
					$result = response_custom($param_fail);
					// print_r($this->input->post());exit();
					if (! empty ( $this->input->post() )) {
						$params = new stdClass ();
						$params->dest_table_as = 'user';
						$params->select_values = array ('*');
						$where1 = array ("where_column" => 'username',"where_value" => $this->input->post('username'));
						$where2 = array ("where_column" => 'password',"where_value" => $this->input->post('password'));
						$params->where_tables = array ($where1,$where2);
						$get = $this->data_model->get($params);
						// print_r($get);exit();
						if (isset($get['results'][0])) {
							$date = date ( 'Y-m-d' );
							$expr_date = date ( 'Y-m-d', time () + 86400 );
							$include = array (
								'name' => $get ['results'] [0]->username,
								'role' => $get ['results'] [0]->level,
								'id' => $get ['results'] [0]->id_level,
								'created_date' => $date,
								'expire_date' => $expr_date
							);
							$token = JWT::encode ( get_success ( $include ), SERVER_SECRET_KEY );
							if($get ['results'] [0]->level == "A"){
								$this->session->set_userdata ( 'admin_token', $token);
								$data ['level'] = $get ['results'] [0]->level;
								$data ['backend_url'] = ADMIN_WEBAPP_URL;
								$data ['link'] = ADMIN_WEBAPP_URL.'dashboard';
							} else {
								$this->session->set_userdata ( 'tpq_token', $token);
								$create_session = $this->create_session_data($get ['results'] [0]->id_level);
								$data ['backend_url'] = TPQ_WEBAPP_URL;
								$data ['link'] = TPQ_WEBAPP_URL.'dashboard';
								$data ['level'] = $get ['results'] [0]->level;
							}
							// SET WEB SESSION //
							if ($token == TRUE) {
								echo json_encode ( get_success ( $data) );
							} else {
								echo json_encode ( $result );
							}
						} else {
							echo json_encode ( $result );
						}
					}
				} catch ( Exception $e ) {
					echo json_encode ( $result );
				}
			}

			public function create_session_data($id)
			{
				$params = new stdClass();
				$params->dest_table_as = 'tpq';
				$params->select_values = array('*');
				$where = array("where_column" => 'id', "where_value" => $id);
				$params->where_tables = array($where);
				$get = $this->data_model->get($params);
				if($get['results'][0] != '' ){
					$res = $get['results'][0];

					$logo = $res->logo;
					$dir = BACKEND_IMAGE_UPLOAD_FOLDER;
					$image_dir =  $dir.'logo/'. $logo;
					$check_thumb = check_if_empty($logo, $image_dir);
					if ($check_thumb == NO_IMG_NAME) {
						$logo_data = BASE_URL.BACKEND_IMAGE_UPLOAD_FOLDER.'dummy_logo.png';
					} else {
						$logo_data = BASE_URL . $dir.'logo/'.$check_thumb;
					}

					$data_profile = array('id' => $id, 'name' => $res->name, 'alias' => $res->alias, 'logo_url' => $logo_data);
					$set_session = $this->session->set_userdata('tpq_data', $data_profile);
				}
			}


			public function checkwebtoken() {
				try {
					$token = json_decode ( file_get_contents ( 'php://input' ) );
					if ($token == "") {
						$response = response_fail ();
					} else {
						$decode = JWT::decode ( $token, SERVER_SECRET_KEY, JWT_ALGHORITMA );
						if (! $decode) {
							$response = response_fail ();
						} else {
							if ($decode->response != OK_STATUS) {
								$response = response_fail ();
							} else {
								if ($decode->data->role != "A") {
									$response = response_fail ();
								} else {
									$response = response_success ();
								}
							}
						}
					}
				} catch ( Exception $e ) {
					$response = response_fail ();
				}
				echo json_encode ( $response );
			}
		}
