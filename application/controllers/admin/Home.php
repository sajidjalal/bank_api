<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $validateToken = validateToken();
        Monolog::saveLog("validateToken", "I", json_encode($validateToken));

        if ($validateToken["status_code"] == 200) {

            $this->role_id = @$validateToken["user_data"]->role_id;
            $this->user_id = @$validateToken["user_data"]->user_id;
            $this->mobile_number = @$validateToken["user_data"]->mobile_number;
            $this->first_name = @$validateToken["user_data"]->first_name;
            $this->email = @$validateToken["user_data"]->email;
            $query = $this->db
                ->select("us.session_id")
                ->where("us.isactive = ", 1)
                ->where("us.user_id = ", $this->user_id);
            $resultCheckToken = $query->get("users as us")->row();


            if (is_null($resultCheckToken->session_id) || empty($resultCheckToken->session_id)) {
                $data = $validateToken;
                echo $this->load->view('comman/unauthorize_view', $data, TRUE);
                die();
            }
        } else {
            $data = $validateToken;
            echo $this->load->view('comman/unauthorize_view', $data, TRUE);
            die();
        }
        $this->load->model('admin/Home_m', 'obj_home', true);
        $this->load->model('admin/Setting_m', 'obj_setting', true);
    }



    public function deposit()
    {
        extract($this->input->post(null, true));
        $data = [];
        $condition = "";
        if (@$user_id) {
            $condition = ['us.user_id' => $user_id];
        } else {
            $condition = ['us.user_id' => $this->user_id];
        }

        $data['userInfo'] = $this->obj_home->getUsersInfo($condition);
        $data['lastDepositDetails'] = $this->obj_home->lastDepositDetails($condition);

        $data['userLast5LoginDetails'] = $this->obj_home->userLast5LoginDetails(false, 5, 0);
        $data['userTranactionList'] = $this->obj_home->userTranactionList($condition);

        $theme_setting['theme_setting'] = $this->obj_setting->getThemeData();

        if ($data['userInfo']) {

            if (strcmp($data['userInfo']->session_id, $_COOKIE['token']) == 0) {

                if ($this->role_id == 1) {
                } else if ($this->role_id == 2) {
                } else if ($this->role_id  == 4) {
                    $this->load->view('layout/customer/header', $data);
                    $this->load->view('admin/deposite', $data);
                    $this->load->view('layout/customer/footer');
                    return;
                }
                $this->load->view('comman/unauthorize_view', $data);
            }
        }
        $this->load->view('comman/unauthorize_view', $data);
        return;
    }

    public function withdraw()
    {
        extract($this->input->post(null, true));
        $data = [];
        $condition = "";
        if (@$user_id) {
            $condition = ['us.user_id' => $user_id];
        } else {
            $condition = ['us.user_id' => $this->user_id];
        }

        $data['userInfo'] = $this->obj_home->getUsersInfo($condition);



        $data['userLast5LoginDetails'] = $this->obj_home->userLast5LoginDetails(false, 5, 0);
        $theme_setting['theme_setting'] = $this->obj_setting->getThemeData();

        if ($data['userInfo']) {

            if (strcmp($data['userInfo']->session_id, $_COOKIE['token']) == 0) {

                if ($this->role_id == 1) {
                } else if ($this->role_id == 2) {
                } else if ($this->role_id  == 4) {
                    $this->load->view('layout/customer/header', $data);
                    $this->load->view('admin/withdraw', $data);
                    $this->load->view('layout/customer/footer');
                    return;
                }
                $this->load->view('comman/unauthorize_view', $data);
            }
        }
        $this->load->view('comman/unauthorize_view', $data);
        return;
    }

    public function profile()
    {
        extract($this->input->post(null, true));
        $data = [];
        $condition = "";
        if (@$user_id) {
            $condition = ['us.user_id' => $user_id];
        } else {
            $condition = ['us.user_id' => $this->user_id];
        }

        $data['userInfo'] = $this->obj_home->getUsersInfo($condition);



        $data['userLast5LoginDetails'] = $this->obj_home->userLast5LoginDetails(false, 5, 0);
        $theme_setting['theme_setting'] = $this->obj_setting->getThemeData();

        if ($data['userInfo']) {

            if (strcmp($data['userInfo']->session_id, $_COOKIE['token']) == 0) {

                if ($this->role_id == 1) {
                    $this->load->view('layout/superAdmin/header', $data);
                    $this->load->view('admin/profile', $data);
                    $this->load->view('layout/admin/footer');
                    return;
                } else if ($this->role_id == 2) {

                    $this->load->view('layout/admin/header', $data);
                    $this->load->view('admin/profile', $data);
                    $this->load->view('layout/admin/footer');
                    return;
                } else if ($this->role_id  == 4) {
                    $this->load->view('layout/customer/header', $data);
                    $this->load->view('admin/profile', $data);
                    $this->load->view('layout/customer/footer');
                    return;
                }
                $this->load->view('comman/unauthorize_view', $data);
            }
        }
        $this->load->view('comman/unauthorize_view', $data);
        return;
    }

    public function customerList()
    {
        extract($this->input->get(null, true));

        $condition = "";
        if (@$user_id) {
            $condition = ['us.user_id' => $user_id];
        } else {
            $condition = ['us.user_id' => $this->user_id];
        }


        $data['userInfo'] = $this->obj_home->getUsersInfo($condition);

        $data['customerList'] = $this->obj_home->customerList();

        $theme_setting['theme_setting'] = $this->obj_setting->getThemeData();
        if ($data['customerList']) {
            if ($this->role_id == 1) {
                $this->load->view('layout/superAdmin/header', $data);
                $this->load->view('admin/itemList', $data);
                $this->load->view('layout/admin/footer');
                return;
            } else if ($this->role_id == 2) {
                $this->load->view('layout/admin/header', $data);
                $this->load->view('admin/itemList', $data);
                $this->load->view('layout/admin/footer');
                return;
            } else if ($this->role_id  == 4) {
            }
            $this->load->view('comman/unauthorize_view', $data);
        } else {
            $this->load->view('comman/unauthorize_view', $data);
        }
    }


    public function createLead()
    {
        extract($this->input->get(null, true));

        $condition = "";
        if (@$user_id) {
            $condition = ['us.user_id' => $user_id];
        } else {
            $condition = ['us.user_id' => $this->user_id];
        }


        $data['userInfo'] = $this->obj_home->getUsersInfo($condition);
        $theme_setting['theme_setting'] = $this->obj_setting->getThemeData();
        if ($data['userInfo']) {
            if ($this->role_id == 1) {
                $this->load->view('layout/superAdmin/header', $data);
                $this->load->view('admin/createLead', $data);
                $this->load->view('layout/admin/footer');
                return;
            } else if ($this->role_id == 2) {
                $this->load->view('layout/admin/header', $data);
                $this->load->view('admin/createLead', $data);
                $this->load->view('layout/admin/footer');
                return;
            } else if ($this->role_id  == 4) {
            }
            $this->load->view('comman/unauthorize_view', $data);
        } else {
            $this->load->view('comman/unauthorize_view', $data);
        }
    }

    public function itemlist()
    {
        extract($this->input->get(null, true));

        $condition = "";
        if (@$user_id) {
            $condition = ['us.user_id' => $user_id];
        } else {
            $condition = ['us.user_id' => $this->user_id];
        }


        $data['userInfo'] = $this->obj_home->getUsersInfo($condition);

        $data['itemsList'] = $this->obj_home->itemsList();

        $theme_setting['theme_setting'] = $this->obj_setting->getThemeData();
        if ($data['itemsList']) {

            if ($this->role_id == 1) {
                $this->load->view('layout/superAdmin/header', $data);
                $this->load->view('admin/itemList', $data);
                $this->load->view('layout/admin/footer');
                return;
            } else if ($this->role_id == 2) {
                $this->load->view('layout/admin/header', $data);
                $this->load->view('admin/itemList', $data);
                $this->load->view('layout/admin/footer');
                return;
            } else if ($this->role_id  == 4) {
            }
        } else {
            $this->load->view('comman/unauthorize_view', $data);
        }
    }

    public function customerDetails($custID = "")
    {
        extract($this->input->get(null, true));

        $condition = "";
        if (@$user_id) {
            $condition = ['us.user_id' => $user_id];
        } else {
            $condition = ['us.user_id' => $this->user_id];
        }


        $data['userInfo'] = $this->obj_home->getUsersInfo($condition);

        if (is_numeric($custID)) {
            $data['customerDetails'] = $this->obj_home->customerDetails($custID);
        } else {
            $this->load->view('comman/unauthorize_view', $data);
            return;
        }

        $theme_setting['theme_setting'] = $this->obj_setting->getThemeData();
        if ($data['userInfo']) {

            if ($this->role_id == 1) {
                $this->load->view('layout/superAdmin/header', $data);
                $this->load->view('admin/customerDetails', $data);
                $this->load->view('layout/admin/footer');
                return;
            } else if ($this->role_id == 2) {
                $this->load->view('layout/admin/header', $data);
                $this->load->view('admin/customerDetails', $data);
                $this->load->view('layout/admin/footer');
                return;
            } else if ($this->role_id  == 4) {
            }
        } else {
            $this->load->view('comman/unauthorize_view', $data);
        }
    }

    public function mobileno_check($mobile_number)
    {
        $mobile_number = $this->input->post('mobile_number');

        if (empty($mobile_number)) {
            $this->form_validation->set_message('mobileno_check', 'The {field} is required sss');
            return FALSE;
        }

        if (empty($user_id)) {
            $user_id = $this->user_id;
        }

        $response = $this->obj_home->mobileno_check_expect_this($mobile_number, $user_id);
        if ($response) {
            $this->form_validation->set_message('mobileno_check', 'The {field} is already registered');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function email_check($email)
    {
        $email = $this->input->post('email');

        if (empty($email) || is_null($email)) {
            $this->form_validation->set_message('email_check', 'The {field} is required');
            return FALSE;
        }

        $response = $this->obj_home->email_check_expect_this($email);
        if ($response) {
            $this->form_validation->set_message('email_check', 'The {field} is already registered');
            return FALSE;
        } else {
            return TRUE;
        }
    }


    public function makeLead()
    {

        extract($this->input->post(null, true));

        $this->form_validation->set_rules('first_name', 'First name', 'required');
        $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'required|numeric|regex_match[/^[6-9][0-9]{9}$/]|numeric|callback_mobileno_check');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
        $this->form_validation->set_rules('password', 'password', 'required|min_length[5]');

        if ($this->form_validation->run() == FALSE) {
            $data['message'] = "Validation Error";
            $data['fields'] = $this->form_validation->error_array();

            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(422)
                ->set_output(json_encode(array(
                    'message' =>  $data['message'],
                    'fields' => $data['fields'],
                    'status' => false,
                )));
        }

        $arr_insert = [
            "role_id" => 4,
            "mobile_number" => $mobile_number,
            "first_name" => $first_name,
            "email" => $email,
            "password" => $password,
            "created_by" => $this->user_id,
            "created_by_ip_address" => @$this->input->ip_address(),
        ];

        $data['message'] = "Customer Created successfully";
        $data['data'] = [];
        $this->db->insert("users", $arr_insert);

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'message' =>  $data['message'],
                'data' => $data['data'],
                'status' => true,
            )));
    }



    public function  accounttype_check($value)
    {
        $account_type = $this->input->post('account_type');
        $checkArray = ['savings', 'current'];
        if (in_array($account_type, $checkArray)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('accounttype_check', 'The {field} is invalid');
            return FALSE;
        }
    }

    public function amountDeposite()
    {

        extract($this->input->post(null, true));

        $this->form_validation->set_rules('deposite', 'deposite', 'required|numeric');
        $this->form_validation->set_rules('account_type', 'account type', 'required|callback_accounttype_check');

        if ($this->form_validation->run() == FALSE) {
            $data['message'] = "Validation Error";
            $data['fields'] = $this->form_validation->error_array();

            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(422)
                ->set_output(json_encode(array(
                    'message' =>  $data['message'],
                    'fields' => $data['fields'],
                    'status' => false,
                )));
        }

        if (@$user_id) {
            $user_id = $user_id;
            $condition = [
                'us.user_id' => $user_id,
            ];
        } else {
            $user_id = $this->user_id;
            $condition = [
                'us.user_id' => $this->user_id,
            ];
        }

        $data['lastTranactionDetails'] = $this->obj_home->lastTranactionDetails($condition);

        $balance =  $data['lastTranactionDetails']->balance + $deposite;

        $arr_insert = [
            "user_id" => $user_id,
            "transaction_type" => 1,
            "balance" => $balance,
            "deposite" =>  $deposite,
            "withdraw" =>  $data['lastTranactionDetails']->withdraw,
            "created_by" => $user_id,
            "created_by_ip_address" => @$this->input->ip_address(),
        ];

        $data['message'] = "Transaction Successfully";
        $data['data'] = [];
        $this->db->insert("accounts", $arr_insert);

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'message' =>  $data['message'],
                'data' => $data['data'],
                'status' => true,
            )));
    }

    public function amountWithdraw()
    {

        extract($this->input->post(null, true));

        $this->form_validation->set_rules('withdraw', 'withdraw', 'required|numeric');
        $this->form_validation->set_rules('account_type', 'account type', 'required|callback_accounttype_check');



        if ($this->form_validation->run() == FALSE) {
            $data['message'] = "Validation Error";
            $data['fields'] = $this->form_validation->error_array();

            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(422)
                ->set_output(json_encode(array(
                    'message' =>  $data['message'],
                    'fields' => $data['fields'],
                    'status' => false,
                )));
        }


        if (@$user_id) {
            $user_id = $user_id;
            $condition = [
                'us.user_id' => $user_id,
            ];
        } else {
            $user_id = $this->user_id;
            $condition = [
                'us.user_id' => $this->user_id,
            ];
        }

        $data['lastTranactionDetails'] = $this->obj_home->lastTranactionDetails($condition);


        if ($withdraw > $data['lastTranactionDetails']->balance) {
            $data['message'] = "Validation Error";
            $data['fields'] = ["withdraw" => "insufficient account balance"];
            $data['status'] = false;

            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(422)
                ->set_output(json_encode(array(
                    'message' =>  $data['message'],
                    'fields' => $data['fields'],
                    'status' => false,
                )));
        }

        $balance =  $data['lastTranactionDetails']->balance - $withdraw;

        $arr_insert = [
            "user_id" => $user_id,
            "transaction_type" => 2,
            "balance" => $balance,
            "deposite" =>  0,
            "withdraw" =>  $withdraw,
            "created_by" => $user_id,
            "created_by_ip_address" => @$this->input->ip_address(),
        ];

        $data['message'] = "Transaction Successfully";
        $data['data'] = [];
        $this->db->insert("accounts", $arr_insert);

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'message' =>  $data['message'],
                'data' => $data['data'],
                'status' => true,
            )));
    }


    public function logout()
    {
        extract($this->input->post(null, true));

        $token = $this->db->where(['user_id' => $this->user_id,])->get('users')->row()->session_id;

        if (is_null($token)) {
            $this->load->view('login');
            return;
        }


        saveLogin($this->user_id, $token, "Y", "Logout");

        $users = [
            'session_id' => '',
        ];
        $this->db->where(['user_id' => $this->user_id])->update('users', $users);

        $_COOKIE['token'] = "";
        $data['message'] = "Information successfully updated";
        $this->load->view('login', $data);
    }

    public function productlist()
    {
        extract($this->input->get(null, true));

        $condition = "";
        if (@$user_id) {
            $condition = ['us.user_id' => $user_id];
        } else {
            $condition = ['us.user_id' => $this->user_id];
        }


        $data['userInfo'] = $this->obj_home->getUsersInfo($condition);
        $data['productlist'] = $this->obj_home->productlist();

        $theme_setting['theme_setting'] = $this->obj_setting->getThemeData();
        if ($data['userInfo']) {

            if ($this->role_id == 1) {
                $this->load->view('layout/superAdmin/header', $data);
                $this->load->view('admin/productList', $data);
                $this->load->view('layout/admin/footer');
                return;
            } else if ($this->role_id == 2) {
                $this->load->view('layout/admin/header', $data);
                $this->load->view('admin/productList', $data);
                $this->load->view('layout/admin/footer');
                return;
            } else if ($this->role_id  == 4) {
            }

            $this->load->view('comman/unauthorize_view', $data);
        } else {
            $this->load->view('comman/unauthorize_view', $data);
        }
    }

    public function projectList()
    {
        extract($this->input->get(null, true));

        $condition = "";
        if (@$user_id) {
            $condition = ['us.user_id' => $user_id];
        } else {
            $condition = ['us.user_id' => $this->user_id];
        }

        $data['userInfo'] = $this->obj_home->getUsersInfo($condition);
        $data['projectList'] = $this->obj_home->projectList();

        if ($data['projectList']) {

            if ($this->role_id == 1) {
                $this->load->view('layout/superAdmin/header', $data);
                $this->load->view('admin/projectList', $data);
                $this->load->view('layout/admin/footer');
                return;
            } else if ($this->role_id == 2) {
                $this->load->view('layout/admin/header', $data);
                $this->load->view('admin/projectList', $data);
                $this->load->view('layout/admin/footer');
                return;
            } else if ($this->role_id  == 4) {
            }

            $this->load->view('comman/unauthorize_view', $data);
        } else {
            $this->load->view('comman/unauthorize_view', $data);
        }
    }

    public function projectbyitem($project_id = "")
    {
        extract($this->input->get(null, true));


        $condition = "";
        if (@$user_id) {
            $condition = ['us.user_id' => $user_id];
        } else {
            $condition = ['us.user_id' => $this->user_id];
        }

        $project_id_condition = "";
        if (@$project_id) {
            $project_id_condition = ['ppd.project_id' => $project_id];
        }

        $data['userInfo'] = $this->obj_home->getUsersInfo($condition);
        $data['projectbyitem'] = $this->obj_home->projectbyitem($project_id_condition);

        $theme_setting['theme_setting'] = $this->obj_setting->getThemeData();
        if ($data['userInfo']) {

            if ($this->role_id == 1) {
                $this->load->view('layout/superAdmin/header', $data);
                $this->load->view('admin/projectbyitem', $data);
                $this->load->view('layout/admin/footer');
                return;
            } else if ($this->role_id == 2) {
                $this->load->view('layout/admin/header', $data);
                $this->load->view('admin/projectbyitem', $data);
                $this->load->view('layout/admin/footer');
                return;
            } else if ($this->role_id  == 4) {
            }

            $this->load->view('comman/unauthorize_view', $data);
        } else {
            $this->load->view('comman/unauthorize_view', $data);
        }
    }

    public function projectByProduct($project_id = "")
    {
        extract($this->input->get(null, true));

        $condition = "";
        if (@$user_id) {
            $condition = ['us.user_id' => $user_id];
        } else {
            $condition = ['us.user_id' => $this->user_id];
        }

        $project_id_condition = "";
        if (@$project_id) {
            $project_id_condition = ['ppd.project_id' => $project_id];
        }

        $data['userInfo'] = $this->obj_home->getUsersInfo($condition);


        $project_details_by_Product = $this->obj_home->project_details_by_Product($project_id_condition);
        $where_in  = "( ";
        foreach ($project_details_by_Product as $P_key => $P_detais) {
            $where_in .= $P_detais->product_id . " ,";
        }

        $where_in = (substr($where_in, 0, -1)) . " )";


        $project_details_by_Product_sum = $this->obj_home->project_details_by_Product_sum($where_in);


        $data['projectByProduct'] = $project_details_by_Product;

        foreach ($project_details_by_Product as $P_key => $P_detais) {
            foreach ($project_details_by_Product_sum as $key => $P_Amount_detais) {

                if ($P_Amount_detais->pid == $P_detais->product_id) {
                    $project_details_by_Product[$P_key]->pid = $P_Amount_detais->pid;
                    $project_details_by_Product[$P_key]->first_name = $P_Amount_detais->first_name;
                    $project_details_by_Product[$P_key]->isactive = $P_Amount_detais->isactive;
                    $project_details_by_Product[$P_key]->created_at = $P_Amount_detais->ppd_created_at;
                    $project_details_by_Product[$P_key]->total = $P_Amount_detais->total;
                    $project_details_by_Product[$P_key]->perSqFt = round($P_Amount_detais->total / 100, 2);
                }
            }
        }

        if ($data['userInfo']) {

            if ($this->role_id == 1) {
                $this->load->view('layout/superAdmin/header', $data);
                $this->load->view('admin/projectByProduct', $data);
                $this->load->view('layout/admin/footer');
                return;
            } else if ($this->role_id == 2) {
                $this->load->view('layout/admin/header', $data);
                $this->load->view('admin/projectByProduct', $data);
                $this->load->view('layout/admin/footer');
                return;
            } else if ($this->role_id  == 4) {
            }
            $this->load->view('comman/unauthorize_view', $data);
        } else {
            $this->load->view('comman/unauthorize_view', $data);
        }
    }


    public function productDetails($product_id = "")
    {
        extract($this->input->get(null, true));

        $condition = "";
        if (@$user_id) {
            $condition = ['us.user_id' => $user_id];
        } else {
            $condition = ['us.user_id' => $this->user_id];
        }

        $data['userInfo'] = $this->obj_home->getUsersInfo($condition);


        if ($product_id) {
            $where_in  = "( " . $product_id . " )";
        } else {
            $where_in = false;
        }

        $data['productDetails'] = $this->obj_home->productDetails($where_in, $product_id);

        if ($data['productDetails']) {
            if ($this->role_id == 1) {
                $this->load->view('layout/superAdmin/header', $data);
                $this->load->view('admin/productDetails', $data);
                $this->load->view('layout/admin/footer');
                return;
            } else if ($this->role_id == 2) {
                $this->load->view('layout/admin/header', $data);
                $this->load->view('admin/productDetails', $data);
                $this->load->view('layout/admin/footer');
                return;
            } else if ($this->role_id  == 4) {
            }
            $this->load->view('comman/unauthorize_view', $data);
        } else {
            $this->load->view('comman/unauthorize_view', $data);
        }
    }

    public function productDetailsEdit($product_id = "")
    {
        extract($this->input->get(null, true));

        $condition = "";
        if (@$user_id) {
            $condition = ['us.user_id' => $user_id];
        } else {
            $condition = ['us.user_id' => $this->user_id];
        }

        $data['userInfo'] = $this->obj_home->getUsersInfo($condition);


        if ($product_id) {
            $where_in  = "( " . $product_id . " )";
        } else {
            $where_in = false;
        }

        $data['productDetails'] = $this->obj_home->productDetails($where_in, $product_id);

        if ($data['productDetails']) {

            if ($this->role_id == 1) {
                $this->load->view('layout/superAdmin/header', $data);
                $this->load->view('admin/productDetailsEdit', $data);
                $this->load->view('layout/admin/footer');
                return;
            } else if ($this->role_id == 2) {
                $this->load->view('layout/admin/header', $data);
                $this->load->view('admin/productDetailsEdit', $data);
                $this->load->view('layout/admin/footer');
                return;
            } else if ($this->role_id  == 4) {
            }
            $this->load->view('comman/unauthorize_view', $data);
        } else {
            $this->load->view('comman/unauthorize_view', $data);
        }
    }


    public function productDetailsEditPost()
    {
        extract($this->input->get(null, true));

        $data = json_decode($_POST['data']);

        foreach ($data as $key => $value) {

            if ($value->quantity) {
                $this->db->where(
                    [
                        "ppdid" => $value->ppdid
                    ]
                )->update("project_product_details", [
                    "quantity" => $value->value
                ]);
            }

            if ($value->rate) {
                $this->db->where(
                    [
                        "ppdid" => $value->ppdid
                    ]
                )->update("project_product_details", [
                    "rate" => $value->value
                ]);
            }
        }
        $result['message'] = "Success";
        return $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                "message" => $result['message'],
                "data" =>
                []
            ]));

        $result['message'] = "Failed";
        return $this->output
            ->set_status_header(422)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                "message" => $result['message'],
                "data" =>
                []
            ]));
    }


    // olds one funtion

    // =============================================================================
    // *****************************************************************************
    // =============================================================================
    // *****************************************************************************
    // =============================================================================
    // *****************************************************************************
    // =============================================================================
    // *****************************************************************************
    // =============================================================================
    // *****************************************************************************




    public function viewStage()
    {
        extract($this->input->get(null, true));

        $data['viewStage'] = $this->obj_home->viewStage();
        $theme_setting['theme_setting'] = $this->obj_setting->getThemeData();
        if ($data['viewStage']) {
            if ($this->role_id == 1) {
                $this->load->view('layout/superadmin/header', $data);
                $this->load->view('themeSetting/themeconfig', $theme_setting);
                $this->load->view('admin/viewStage', $data);
                $this->load->view('layout/superadmin/footer', $data);
                return;
            } else if ($this->role_id == 2) {
                $this->load->view('layout/admin/header', $data);
                $this->load->view('themeSetting/themeconfig', $theme_setting);
                $this->load->view('admin/viewStage', $data);
                $this->load->view('layout/admin/footer', $data);
                return;
            } else if ($this->role_id  == 4) {
            }
            $this->load->view('comman/unauthorize_view', $data);
        } else {
            $this->load->view('comman/unauthorize_view', $data);
        }
    }

    public function viewProduct()
    {
        extract($this->input->get(null, true));

        $data['viewProduct'] = $this->obj_home->viewProduct();
        $theme_setting['theme_setting'] = $this->obj_setting->getThemeData();
        if ($data['viewProduct']) {
            if ($this->role_id == 1) {
                $this->load->view('layout/superadmin/header', $data);
                $this->load->view('themeSetting/themeconfig', $theme_setting);
                $this->load->view('admin/viewProduct', $data);
                $this->load->view('layout/superadmin/footer', $data);
                return;
            } else if ($this->role_id == 2) {
                $this->load->view('layout/admin/header', $data);
                $this->load->view('themeSetting/themeconfig', $theme_setting);
                $this->load->view('admin/viewProduct', $data);
                $this->load->view('layout/admin/footer', $data);
                return;
            } else if ($this->role_id  == 4) {
            }
            $this->load->view('comman/unauthorize_view', $data);
        } else {
            $this->load->view('comman/unauthorize_view', $data);
        }
    }

    public function finishedProduct()
    {
        extract($this->input->post(), true);

        // this is bcoz mulitpe may have for single prodcut
        $update_recode = (array_chunk($_POST, 7));
        $insert_key = [];
        foreach ($_POST  as $key => $value) {
            $insert_key[] = (substr($key, 0, -2));
        }

        foreach ($update_recode as $key => $value) {
            $this->db->where([
                'ppdid' => $value[6],
            ])->update('project_product_details', [
                'quantity' => $value[4],
                'rate' => $value[5],
                'modify_by' => 0,
            ]);
        }


        $data['project_details'] = $this->obj_home->project_details();
        $data['project_details_by_Satge'] = $this->obj_home->project_details_by_Satge();
        $data['project_details_by_Item'] = $this->obj_home->project_details_by_Item();
        $data['project_details_by_Product'] = $this->obj_home->project_details_by_Product();
        $this->load->view('admin/testfinishproject', $data);
    }

    public function projectByStage($id = "")
    {
        extract($this->input->get(null, true));

        $data['project_details_by_Satge'] = $this->obj_home->project_details_by_Satge();

        $theme_setting['theme_setting'] = $this->obj_setting->getThemeData();
        if ($data['project_details_by_Satge']) {

            if ($this->role_id == 1) {
                $this->load->view('layout/superadmin/header', $data);
                $this->load->view('themeSetting/themeconfig', $theme_setting);
                $this->load->view('admin/projectByStage', $data);
                $this->load->view('layout/superadmin/footer', $data);
                return;
            } else if ($this->role_id == 2) {
                $this->load->view('layout/admin/header', $data);
                $this->load->view('themeSetting/themeconfig', $theme_setting);
                $this->load->view('admin/projectByStage', $data);
                $this->load->view('layout/admin/footer', $data);
                return;
            } else if ($this->role_id  == 4) {
            }
            $this->load->view('comman/unauthorize_view', $data);
        } else {
            $this->load->view('comman/unauthorize_view', $data);
        }
    }

    public function productEdit($product_id = "")
    {
        extract($this->input->get(null, true));

        if ($product_id) {
            $where_in  = "( " . $product_id . " )";
        } else {
            $where_in = false;
        }

        $data['project_details_by_Product_all_Details'] = $this->obj_home->project_details_by_Product_all_Details($where_in);

        $theme_setting['theme_setting'] = $this->obj_setting->getThemeData();
        if ($data['project_details_by_Product_all_Details']) {



            if ($this->role_id == 1) {
                $this->load->view('layout/superadmin/header', $data);
                $this->load->view('themeSetting/themeconfig', $theme_setting);
                $this->load->view('admin/productEdit', $data);
                $this->load->view('layout/superadmin/footer', $data);
            } else if ($this->role_id == 2) {
                $this->load->view('layout/admin/header', $data);
                $this->load->view('themeSetting/themeconfig', $theme_setting);
                $this->load->view('admin/productEdit', $data);
                $this->load->view('layout/admin/footer', $data);
                return;
            } else if ($this->role_id  == 4) {
            }
            $this->load->view('comman/unauthorize_view', $data);
        } else {
            $this->load->view('comman/unauthorize_view', $data);
        }
    }

    public function test($id = "")
    {
        extract($this->input->get(null, true));
        $data['project_details'] = $this->obj_home->project_details();
        $data['project_details_by_Satge'] = $this->obj_home->project_details_by_Satge();
        $data['project_details_by_Item'] = $this->obj_home->project_details_by_Item();
        $data['project_details_by_Product'] = $this->obj_home->project_details_by_Product();

        $this->load->view('admin/test', $data);
    }
}
