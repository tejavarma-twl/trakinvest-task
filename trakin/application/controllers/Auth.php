<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct() {

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Client-Service, Auth-Key, X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$method = $_SERVER['REQUEST_METHOD'];
		if($method == "OPTIONS") {
			die();
		}
		parent::__construct();
	}

	public function login()
	{
		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
				$params = $_REQUEST;
		        $username = $params['username'];
		        $password = $params['password'];
		        $response = $this->MyModel->login($username,$password);
				json_output($response['status'],$response);
			}
		}
	}

	public function getusers()
	{
		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->MyModel->getAllUsers();
				json_output($response['status'],$response);
			}
		}
	}

	public function getusersdetail()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
				$params = $_REQUEST;
		        $id = $params['id'];
		        $response = $this->MyModel->user_detail_data($id);
				json_output($response['status'],$response);
			}
		}
	}

	public function adduser()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
				$params = $_REQUEST;
				$name = $params['name'];
				$email = $params['email'];
				$password = $params['password'];
		        $response = $this->MyModel->register($name,$email,$password);
				json_output($response['status'],$response);
			}
		}
	}

	public function updateuser()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
				$params = $_REQUEST;
		        $id = $params['id'];
		        $response = $this->MyModel->user_update_data($id,$params);
				json_output($response['status'],$response);
			}
		}
	}

	public function deleteuser()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
				$params = $_REQUEST;
		        $id = $params['id'];
		        $response = $this->MyModel->user_delete_data($id);
				json_output($response['status'],$response);
			}
		}
	}

	public function register()
	{
		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
				$params = $_REQUEST;
				$name = $params['name'];
				$username = $params['username'];
		        $password = $params['password'];
		        $response = $this->MyModel->register($name,$username,$password);
				json_output($response['status'],$response);
			}
		}
	}

	public function logout()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->MyModel->logout();
				json_output($response['status'],$response);
			}
		}
	}
	
}
