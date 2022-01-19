<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth_m extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function sign_up()
    {
        extract($this->input->post(null, true));

        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('fullName', 'Full Name', 'required');
        $this->form_validation->set_rules('mobileNumber', 'Mobile Number', 'required|min_length[10]|max_length[10]|numeric');

        if ($this->form_validation->run() == FALSE) {

            $arr["title"] = "Failed,\nSomething went Wrong";
            return $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    "message" =>  $arr['title'],
                    "data" => $this->form_validation->error_array()
                ]));
        }
        $this->db->insert("users", [
            "fullName" => $fullName,
            "email" => $email,
            "password" => $password,
            "mobileNumber" => $mobileNumber,
        ]);

        $arr["title"] = "Success,\nAccount created";
        return $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                "message" =>  $arr['title'],
                "data" => []
            ]));
    }
}
