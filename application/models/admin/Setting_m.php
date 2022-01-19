<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setting_m extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getThemeData($condition = '')
    {
        $query = $this->db
            ->select("*");
        $this->db->where("theme_setting.isactive = ", 1);
        if ($condition)
            $this->db->where($condition);
        $result = $query->get("theme_setting")->row();

        return $result;
    }
}
