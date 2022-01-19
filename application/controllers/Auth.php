<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/vendor/autoload.php';

use Firebase\JWT\JWT;

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_m', 'obj_auth', true);
    }

    public  function unauthorize_view($message = "")
    {
        $this->load->view('comman/unauthorize_view', $message);
    }

    public function signin()
    {
        $this->load->view('signin');
    }

    public function checkLogin()
    {
        extract($this->input->post(null, true));

        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() == FALSE) {

            $arr["message"] = "Validation Error";
            $arr["fields"] = $this->form_validation->error_array();
            $arr["title"] = "Failed, Sign In";
            return $this->output
                ->set_status_header(422)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    "message" => $arr["message"],
                    "data" => $arr,
                ]));
        }

        $query = $this->db->where(["email" => $email, "password" => $password])
            ->get("users");
        if ($query->num_rows() > 0) {
            $query = $query->row();

            $date = new DateTime();
            $tokenData = [
                "role_id" => $query->role_id,
                "user_id" => $query->user_id,
                "mobile_number" => $query->mobile_number,
                "first_name" => $query->first_name,
                "email" => $email,
                "iat" => $date->getTimestamp(),
                "exp" => $date->getTimestamp() + 60 * 60 * 5,
                // "exp" => $date->getTimestamp() + 10,
            ];


            $key = "example_key_construct";
            $token = JWT::encode($tokenData, $key);

            $this->db->where(["user_id" => $query->user_id])->update("users", [
                "session_id" => $token,
            ]);

            $tokenData = [
                "session_id" => $token,
            ];
            setToken($token);
            saveLogin($query->user_id, $token, "N", "Login");

            $arr["title"] = "Success, Sign In";
            $arr["href"] = "admin/profile";
            return $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    "token" =>  $token,
                    "message" =>  $arr['title'],
                    "data" => $arr
                ]));
        }

        $arr["title"] = "AccountNot Found";
        return $this->output
            ->set_status_header(400)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                "message" =>  $arr['title'],
                "data" => $this->form_validation->error_array()
            ]));
    }
}
