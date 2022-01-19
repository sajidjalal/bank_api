<?php
require APPPATH . '/vendor/autoload.php';

use Firebase\JWT\JWT;

function setToken($token)
{
    $date = new DateTime();
    $cookie_name = "token";
    $cookie_value = $token;
    // setcookie($cookie_name, $cookie_value, time() + ($date->getTimestamp() + 60 * 60 * 5), "/", '', false, true); // 86400 = 1 
    setcookie($cookie_name, $cookie_value, 0, "/", "", false, true); // 86400 = 1 day
}

if (!function_exists('print_pre')) {
    function print_pre($arr)
    {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
}

if (!function_exists('validateToken')) {
    function validateToken($token = "")
    {
        $key = ("example_key_construct"); //secret key for encode and decode
        $token = getToken();

        try {
            $decoded = JWT::decode($token, $key, array('HS256'));

            $result["status_code"] = 200;
            $result["user_data"] = $decoded;
            $result["message"] = "success";
            return $result;
        } catch (Exception $e) {

            $result["status_code"] = 401;
            $result["user_data"] = "";
            $result["message"] = $e->getMessage();

            return $result;
        }
    }
}

function getToken()
{
    $CI = &get_instance();
    $token = "";
    $token = @$CI->input->get_request_header('authorizationToken');
    if (!empty($token)) {
        return $token;
    }
    $headers = @$CI->input->get_request_header('authorizationToken');
    if (!empty($headers)) {
        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            $token = $matches[1];
        }
    } else if (@$CI->input->post('token')) {
        $token = $CI->input->post('token');
    } else if (@$CI->input->get('token')) {
        $token = $CI->input->get('token');
    } else if (@$_COOKIE['token']) {
        $token = $_COOKIE['token'];
    }

    return $token;
}

if (!function_exists('saveLogin')) {
    function saveLogin($user_id, $token, $is_disconnected, $type = "Login")
    {
        $CI = &get_instance();

        if ($CI->agent->is_browser()) {
            $agent = $CI->agent->browser() . ' ' . $CI->agent->version();
        } elseif ($CI->agent->is_robot()) {
            $agent = $CI->agent->robot();
        } elseif ($CI->agent->is_mobile()) {
            $agent = $CI->agent->mobile();
        } else {
            $agent = 'Unidentified User Agent';
        }

        $CI->db->insert("user_sessions", [
            "user_id" => $user_id,
            "token" => $token,
            "device_browser" => $agent,
            "type" => $type,
            "is_disconnected" => $is_disconnected,
            "ip" => $CI->input->ip_address(),
        ]);
    }
}
