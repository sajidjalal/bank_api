<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home_m extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getUsers($condition = '')
    {
        $query = $this->db
            ->select("*");
        $this->db->where("users.isactive = ", 1);
        if ($condition)
            $this->db->where($condition);
        $result = $query->get("users")->result();

        return $result;
    }

    public function getToken($token = '')
    {
        $query = $this->db
            ->select("us.session_id")
            ->where("us.isactive = ", 1)
            ->where("us.session_id = ", $token);

        $result = $query->get("users as us")->row();

        return $result;
    }

    public function getUsersInfo($condition = '')
    {
        $query = $this->db
            ->select("*")
            ->join("role_type as rt", "us.role_id = rt.role_id ");

        $this->db->where("us.isactive = ", 1);
        if ($condition)
            $this->db->where($condition);
        $result = $query->get("users as us")->row();

        return $result;
    }

    public function lastDepositDetails($condition = '')
    {
        $query = $this->db
            ->select("ac.*")
            ->join("accounts as ac", "ac.user_id = us.user_id ")
            ->where([
                "us.isactive = " => 1,
                // "ac.transaction_type" => 1
            ]);
        if ($condition)
            $this->db->where($condition);

        $this->db->order_by("ac.id", "desc");
        $result = $query->get("users as us")->row();

        return $result;
    }

    public function lastTranactionDetails($condition = '')
    {
        $query = $this->db
            ->select("ac.*")
            ->join("accounts as ac", "ac.user_id = us.user_id ")
            ->where([
                "us.isactive = " => 1,
            ]);
        if ($condition)
            $this->db->where($condition);

        $this->db->order_by("ac.id", "desc");
        $result = $query->get("users as us")->row();

        return $result;
    }

    public function userTranactionList($condition = '')
    {
        $query = $this->db
            ->select("ac.id,us.role_id,us.user_id,us.mobile_number,us.first_name,us.email,ac.transaction_type,ac.old_balance,ac.balance,ac.deposite,ac.withdraw,ac.created_at")
            ->join("accounts as ac", "ac.user_id = us.user_id ")
            ->where([
                "us.isactive = " => 1,
            ]);
        if ($condition)
            $this->db->where($condition);

        $this->db->order_by("ac.id", "desc");
        $result = $query->get("users as us")->result();

        return $result;
    }

    public function userLast5LoginDetails($condition = '', $perpage = "", $start = 0)
    {
        $this->db
            ->select('us.*,u.created_at as lead_date, u.first_name')
            ->join('users as u', 'u.user_id = us.user_id')
            ->where(
                [
                    'us.type' => "Login",
                    "u.user_id" => $this->user_id
                ]
            );
        if ($condition)
            $this->db->where($condition);

        $this->db->order_by("us.created_at", "desc");
        if ($perpage) {
            $res = $this->db->get('user_sessions as us', $perpage, $start)->result();
            return $res;
        } else {

            return $this->db->get('user_sessions as us')->num_rows();
        }
    }

    public function customerList($condition = "")
    {

        $query = $this->db
            ->select("us.*")
            ->where([
                "us.isactive" => 1,
                "us.role_id" => 4,
            ]);

        if ($condition)
            $this->db->where($condition);
        $result = $query->get("users as us")
            ->result();


        return $result;
    }

    public function customerDetails($custID = "")
    {

        $query = $this->db
            ->select("a.*,us.profile_pic,us.first_name")
            ->join("users as us", "us.user_id = a.user_id")
            ->where([
                // "us.isactive" => 1
            ]);

        if ($custID)
            $this->db->where([
                "us.user_id" => $custID
            ]);
        $result = $query->get("accounts as a")
            ->result();

        return $result;
    }

    public function itemsList($condition = "")
    {

        $query = $this->db
            ->select("i.*,us.profile_pic,us.first_name")
            ->join("users as us", "us.user_id = i.created_by", "left")
            ->where(
                [
                    "i.isactive" => 1
                ]
            );

        if ($condition)
            $this->db->where($condition);
        $result = $query->get("items as i")
            ->result();

        return $result;
    }


    public function productlist($condition = "")
    {

        $query = $this->db
            ->select("pro.*,us.profile_pic,us.first_name")
            ->join("users as us", "us.user_id = pro.created_by", "left")
            ->where(
                [
                    // "pro.isactive" => 1
                ]
            );

        if ($condition)
            $this->db->where($condition);
        $result = $query->get("product as pro")
            ->result();

        return $result;
    }


    public function projectList($condition = "")
    {

        $query = $this->db
            ->select("proj.*,us.profile_pic,us.first_name")
            ->join("users as us", "us.user_id = proj.created_by", "left");

        if ($condition)
            $this->db->where($condition);
        $result = $query->get("project as proj")
            ->result();

        return $result;
    }

    public function projectbyitem($condition = "")
    {

        $query = $this->db
            ->select("ppd.ppdid, proj.project_name,ps.stage_name,p.name as product_name,i.item_name,i.item_description,ppd.quantity,ppd.rate,p.pid AS product_id, ps.psid AS stage_id,us.profile_pic,us.first_name,i.created_at,i.updated_at,i.isactive ")
            ->join("project_stage as ps", "ps.psid = ppd.psid")
            ->join("product as p", "p.pid = ppd.pid")
            ->join("items as i", "i.item_id = ppd.iid")
            ->join("project as proj", "proj.pid = ppd.project_id")
            ->join("users as us", "us.user_id = p.created_by", "left")
            ->group_by("i.item_id")
            ->order_by("ppd.psid", "asc");
        if ($condition)
            $this->db->where($condition);
        $result = $query->get("project_product_details ppd")
            ->result();

        return $result;
    }

    public function project_details_by_Product($condition = "", $groupBy = "")
    {

        $query = $this->db
            ->select("ppd.ppdid, proj.project_name,ps.stage_name,p.name as product_name,i.item_name,ppd.quantity,ppd.rate,p.pid AS product_id, ps.psid AS stage_id ")
            ->join("project_stage as ps", "ps.psid = ppd.psid")
            ->join("product as p", "p.pid = ppd.pid")
            ->join("items as i", "i.item_id = ppd.iid")
            ->join("project as proj", "proj.pid = ppd.project_id")
            ->group_by("p.pid")
            ->order_by("ppd.psid", "asc");
        if ($condition)
            $this->db->where($condition);
        $result = $query->get("project_product_details ppd")
            ->result();

        return $result;
    }

    public function project_details_by_Product_sum($condition = "")
    {
        $query = $this->db
            // ->select("p.pid, p.name,SUM( ROUND( ppd.quantity * ppd.rate , 2) ) AS total, ppd.isactive, ppd.
            ->select("p.pid, p.name, ROUND( ppd.quantity * ppd.rate , 2)  AS total, ppd.isactive, ppd.created_at,us.profile_pic,us.first_name,ppd.created_at as ppd_created_at ")
            ->join("product as p", "p.pid = ppd.pid")
            ->join("users as us", "us.user_id = p.created_by", "left");

        if ($condition) {
            $this->db->where_in(["ppd.pid" => $condition]);
        }
        $this->db->group_by("p.name")
            ->order_by("ppd.psid", "asc");

        $result = $query->get("project_product_details ppd")
            ->result();
        return $result;
    }

    public function productDetails($condition = "", $product_id = "")
    {
        $query = $this->db
            ->select("ppd.ppdid, i.*,p.project_name,prod.name as product_name, ppd.quantity,ppd.rate,  us.profile_pic,us.first_name,ROUND( (ppd.quantity * ppd.rate),2) AS total,ps.stage_name, ppd.pid as product_id ")
            ->join("items as i", "i.item_id = ppd.iid")
            ->join("project as p", "p.pid = ppd.project_id ")
            ->join("product as prod", "prod.pid = ppd.pid ")
            ->join("project_stage as ps", "ps.psid = ppd.psid ")
            ->join("users as us", "us.user_id = p.created_by", "left");

        if ($product_id) {
            $this->db->where(
                [
                    "prod.pid" => $product_id,
                    "ppd.isactive" => 1
                ]
            );
        }
        $this->db
            ->order_by("i.item_id", "asc");

        $result = $query->get("project_product_details ppd")
            ->result();
        return $result;
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


    public function project_stage_details($project_id = "")
    {
        $query = $this->db
            ->select("*")
            // ->join("product as p", "p.id = pd.product_id")
            // ->join("items as i", "i.id = pd.item_id")
            ->order_by("ps.psid", "asc");

        $result = $query->get("project_stage ps")
            ->result();
        return $result;
    }

    public function viewStage($condition = "")
    {

        $query = $this->db
            ->select("*,proj.project_name")
            ->join("project as proj", "proj.pid = ps.project_id")
            ->where(
                ["ps.isactive" => 1]
            );

        if ($condition)
            $this->db->where($condition);
        $result = $query->get("project_stage as ps")
            ->result();

        return $result;
    }

    public function viewProduct($condition = "")
    {

        $query = $this->db
            ->select("*")
            ->where(
                ["pro.isactive" => 1]
            );

        if ($condition)
            $this->db->where($condition);
        $result = $query->get("product as pro")
            ->result();

        return $result;
    }



    public function project_details($condition = "")
    {

        $query = $this->db
            ->select("ppd.ppdid, proj.project_name,ps.stage_name,p.name as product_name,i.item_name,ppd.quantity,ppd.rate,p.pid AS product_id, ps.psid AS stage_id ")
            ->join("project_stage as ps", "ps.psid = ppd.psid")
            ->join("product as p", "p.pid = ppd.pid")
            ->join("items as i", "i.item_id = ppd.iid")
            ->join("project as proj", "proj.pid = ppd.project_id")
            ->order_by("ps.psid", "asc");
        if ($condition)
            $this->db->where($condition);
        $result = $query->get("project_product_details ppd")
            ->result();

        return $result;
    }

    public function project_details_by_Satge($condition = "")
    {

        $query = $this->db
            ->select("ppd.ppdid, proj.project_name,ps.stage_name,p.name as product_name,i.item_name,ppd.quantity,ppd.rate,p.pid AS product_id, ps.psid AS stage_id ")
            ->join("project_stage as ps", "ps.psid = ppd.psid")
            ->join("product as p", "p.pid = ppd.pid")
            ->join("items as i", "i.item_id = ppd.iid")
            ->join("project as proj", "proj.pid = ppd.project_id")
            ->group_by("ps.psid")
            ->order_by("ppd.psid", "asc");
        if ($condition)
            $this->db->where($condition);
        $result = $query->get("project_product_details ppd")
            ->result();

        return $result;
    }


    function mobileno_check_expect_this($mobile)
    {;

        $query = $this->db
            ->where([
                "mobile_number" => $mobile,
            ])
            ->get("users")
            ->num_rows();
        return ($query  > 0) ? true : false;
    }

    function email_check_expect_this($email)
    {
        $query = $this->db->where(["email" => $email])->get("users")->num_rows();
        return ($query > 0) ? true : false;
    }
}
