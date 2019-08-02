<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyModel extends CI_Model {

    var $client_service = "user-management";
    var $auth_key       = "code_igniter_api_key";

    public function check_auth_client(){
        $client_service = $this->input->get_request_header('Client-Service', TRUE);
        $auth_key  = $this->input->get_request_header('Auth-Key', TRUE);
        if($client_service == $this->client_service && $auth_key == $this->auth_key){
            return true;
        } else {
            return json_output(401,array('status' => 401,'message' => 'Unauthorized.'));
        }
    }

    public function login($username,$password)
    {
        $q  = $this->db->select('password,id')->from('users')->where('email',$username)->get()->row();
        if($q == ""){
            return array('status' => 401,'message' => 'Email invalid.');
        } else {
            $hashed_password = $q->password;
            $id              = $q->id;
            if (password_verify($password, $hashed_password)) {
               $last_login = date('Y-m-d H:i:s');
               $token = password_hash("rasmuslerdorf",PASSWORD_DEFAULT);
               $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
               $this->db->trans_start();
               $this->db->where('id',$id)->update('users',array('last_login' => $last_login));
               $this->db->insert('users_authentication',array('users_id' => $id,'token' => $token,'expired_at' => $expired_at));
               if ($this->db->trans_status() === FALSE){
                  $this->db->trans_rollback();
                  return array('status' => 500,'message' => 'Internal server error.');
               } else {
                  $this->db->trans_commit();
                  return array('status' => 200,'message' => 'Successfully login.','id' => $id, 'token' => $token);
               }
            } else {
                echo "Wrong password";
                exit();
               return array('status' => 204,'message' => 'Wrong password.');
            }
        }
    }

    public function register($name,$username,$password)
    {
        $q  = $this->db->select('password,id')->from('users')->where('email',$username)->get()->row();
        if($q != ""){
            return array('status' => 401,'message' => 'Email exists!');
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $this->db->trans_start();
            $this->db->insert('users',array('email' => $username,'password' => $hashed_password,'name' => $name));
            if ($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
                return array('status' => 500,'message' => 'Internal server error.');
            } else {
                $this->db->trans_commit();
                return array('status' => 200,'message' => 'Successfully registered.');
            }
        }
    }

    public function logout()
    {
        $users_id  = $this->input->get_request_header('User-ID', TRUE);
        $token     = $this->input->get_request_header('Authorization', TRUE);
        $this->db->where('users_id',$users_id)->where('token',$token)->delete('users_authentication');
        return array('status' => 200,'message' => 'Successfully logout.');
    }

    public function auth()
    {
        $users_id  = $this->input->get_request_header('User-ID', TRUE);
        $token     = $this->input->get_request_header('Authorization', TRUE);
        $q  = $this->db->select('expired_at')->from('users_authentication')->where('users_id',$users_id)->where('token',$token)->get()->row();
        if($q == ""){
            return json_output(401,array('status' => 401,'message' => 'Unauthorized.'));
        } else {
            if($q->expired_at < date('Y-m-d H:i:s')){
                return json_output(401,array('status' => 401,'message' => 'Your session has been expired.'));
            } else {
                $updated_at = date('Y-m-d H:i:s');
                $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
                $this->db->where('users_id',$users_id)->where('token',$token)->update('users_authentication',array('expired_at' => $expired_at,'updated_at' => $updated_at));
                return array('status' => 200,'message' => 'Authorized.');
            }
        }
    }



    public function getAllUsers()
    {
        $result = $this->db->select('id,email,name')->from('users')->where('id !=','1')->order_by('id','asc')->get()->result();
        return array('status' => 200,'data' => $result);
    }
    public function user_detail_data($id)
    {
        $result =  $this->db->select('id,name,email')->from('users')->where('id',$id)->order_by('id','desc')->get()->row();
        return array('status' => 200,'data' => $result);
    }
    public function user_create_data($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->db->insert('users',$data);
        return array('status' => 201,'message' => 'Data has been created.');
    }
    public function user_update_data($id,$data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->db->where('id',$id)->update('users',$data);
        return array('status' => 200,'message' => 'Data has been updated.');
    }
    public function user_delete_data($id)
    {
        $this->db->where('id',$id)->delete('users');
        return array('status' => 200,'message' => 'Data has been deleted.');
    }
}
