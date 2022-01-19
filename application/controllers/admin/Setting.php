<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $validateToken = validateToken();

        Monolog::saveLog("validateToken", "I", json_encode($validateToken));

        if ($validateToken["status_code"] == 200) {

            $this->user_id = @$validateToken["user_data"]->user_id;
            $this->mobile_number = @$validateToken["user_data"]->mobile_number;
            $this->first_name = @$validateToken["user_data"]->first_name;
            $this->email = @$validateToken["user_data"]->email;
        } else {
            $data = $validateToken;
            echo $this->load->view('comman/unauthorize_view', $data, TRUE);
            die();
        }
        $this->load->model('admin/Home_m', 'obj_home', true);
        $this->load->model('admin/Setting_m', 'obj_setting', true);
    }



    public function themeSetting()
    {
        extract($this->input->post(null, true));
        $data = [];
        $condition = "";
        if (@$user_id) {
            $condition = ['users.user_id' => $user_id];
        } else {
            $condition = ['users.user_id' => $this->user_id];
        }


        $data['userList'] = $this->obj_home->getUsers($condition);
        $theme_setting['theme_setting'] = $this->obj_setting->getThemeData();

        if ($data['userList']) {
            $this->load->view('layout/admin/header', $data);
            $this->load->view('themeSetting/themeconfig', $theme_setting);
            $this->load->view('admin/themeSetting', $data);
            $this->load->view('layout/admin/footer', $data);
        } else {
            $this->load->view('comman/unauthorize_view', $data);
        }
    }
}
