<?php

// class user has method of user: login, signup, check login, check signup, logup, ...

class User
{

    private $error = "";

    //method to signup account with website, add user to database, validation form
    public function signup($POST)
    {
        $db = Database::getInstance();
        $data = array();
        $data['user_full_name'] = trim($POST['user_full_name']);
        $data['user_email'] = trim($POST['user_email']);
        $data['user_password'] = trim($POST['user_password']);
        $retype_password = trim($POST['retype_password']);

        //validation name of user
        if (empty($data['user_full_name'])) {
            $this->error .= "Họ và tên không được để trống <br>";
        }

        //validation email
        if (empty($data['user_email'])) {
            $this->error .= "Địa chỉ email không được để trống <br>";
        } elseif (!preg_match("/^[0-9a-zA-Z_-]+@[a-zA-Z]+.[a-zA-Z]+$/", $data['user_email'])) {
            $this->error .= "Sai định dạng email <br>";
        } else {
            //check if email already exists
            $sql = "SELECT * FROM tbl_user WHERE user_email = :user_email limit 1";
            $arr['user_email'] = $data['user_email'];
            $check = $db->read_db($sql, $arr);
            if (is_array($check)) {
                $this->error .= "Email đăng nhập đã được sử dụng  <br>";
            }
        }

        if (empty($data['user_password'])) {
            $this->error .= "Password không được để trống <br>";
        } elseif (strlen($data['user_password']) < 4) {
            $this->error .= "Chiều dài mật khẩu phải từ 4 ký tự trở nên <br>";
        } elseif ($data['user_password'] !== $retype_password) {
            $this->error .= "Mật khẩu và Nhập lại mật khẩu không khớp <br>";
        }

        if (empty($retype_password)) {
            $this->error .= "Nhập lại Password không được để trống <br>";
        }

        //check for user_url_address
        $data['user_url_address'] = $this->get_random_string_max(60);
        $sql = "SELECT * FROM tbl_user WHERE user_url_address = :user_url_address limit 1";
        $arr = false;
        $arr['user_url_address'] = $data['user_url_address'];
        $check = $db->read_db($sql, $arr);
        if (is_array($check)) {
            $data['user_url_address'] = $this->get_random_string_max(60);
        }

        // Save to database
        if ($this->error == "") {

            $data['user_password'] = hash('sha1', $data['user_password']);
            $data['user_rank'] = "Khách Hàng";
            $data['user_date_join'] = date("Y-m-d H:i:s");
            $query = "INSERT INTO tbl_user(user_url_address, user_full_name, user_email, user_password, user_rank,
                user_date_join) VALUES (:user_url_address, :user_full_name, :user_email, :user_password, :user_rank,
                :user_date_join)";

            //Signup succes and direct to webpage Login Page
            $result = $db->write_db($query, $data);
            if ($result) {
                header("Location: " . ROOT . "login");
                die;
            }
        }

        $_SESSION['error'] = $this->error;
    }

    //method to login
    public function login($POST)
    {

        $db = Database::getInstance();
        $data = array();
        $data['user_email'] = trim($POST['user_email']);
        $data['user_password'] = trim($POST['user_password']);

        //validate email
        if (empty($data['user_email'])) {
            $this->error .= "Địa chỉ email không được để trống <br>";
        } elseif (!preg_match("/^[0-9a-zA-Z_-]+@[a-zA-Z]+.[a-zA-Z]+$/", $data['user_email'])) {
            $this->error .= "Sai định dạng email <br>";
        }

        //validate password
        if (empty($data['user_password'])) {
            $this->error .= "Password không được để trống <br>";
        }

        //Confirm user login
        if ($this->error == "") {
            $data['user_password'] = hash('sha1', $data['user_password']);

            //check if email already exists
            $sql = "SELECT * FROM tbl_user WHERE user_email = :user_email and user_password = :user_password limit 1";
            $result = $db->read_db($sql, $data);

            //Login success and direct to webpage Home Page
            if (is_array($result)) {
                $_SESSION['user_url_address'] = $result[0]->user_url_address;
                header("Location: " . ROOT . "home");
                die;
            }
            $this->error .= "Sai Username hoặc Password <br>";
        }

        $_SESSION['error'] = $this->error;
    }

    // init user url address with random string with random length 
    private function get_random_string_max($length)
    {

        $array = array(
            0,
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8,
            9,
            'a',
            'b',
            'c',
            'd',
            'e',
            'f',
            'g',
            'h',
            'i',
            'j',
            'k',
            'l',
            'm',
            'n',
            'o',
            'p',
            'q',
            'r',
            's',
            't',
            'u',
            'v',
            'w',
            'x',
            'y',
            'z',
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'G',
            'H',
            'I',
            'J',
            'K',
            'L',
            'M',
            'N',
            'O',
            'P',
            'Q',
            'R',
            'S',
            'T',
            'U',
            'V',
            'W',
            'X',
            'Y',
            'Z'
        );
        $text = "";

        $length = rand(4, $length);

        for ($i = 0; $i < $length; $i++) {

            $random = rand(0, 61);

            $text .= $array[$random];
        }

        return $text;
    }

    //check login to convert user_url_address in db to user_full_name in db 
    public function check_login ($redirect = false, $allowed = array() )
    {
        //connect DB
        $db = Database::getInstance();

        //check user has rank 'Admin' or not
        if (count($allowed) > 0) {
            $arr['user_url_address'] = $_SESSION['user_url_address'];
            $query = "SELECT * FROM tbl_user WHERE user_url_address = :user_url_address limit 1";
            $result = $db->read_db($query, $arr);

            if (is_array($result)) {
                $result = $result[0];
                if (in_array($result->user_rank, $allowed)) {
                    return $result;
                }
            }

            //user hasn't rank 'Admin' can not access webpage admin and redirect to webpage login
            header("Location: " . ROOT . "login");
            die();

        }

        //check user has account in database or not
        else {
            if (isset($_SESSION['user_url_address'])) {

                //reset array
                $arr = false;

                $arr['user_url_address'] = $_SESSION['user_url_address'];
                $query = "SELECT * FROM tbl_user WHERE user_url_address = :user_url_address limit 1";

                $result = $db->read_db($query, $arr);
                if(is_array($result)) {
                    return $result[0];
                }
            }

            //user hasn't account in database can not access webpage ecommerce and redirect to webpage login
            if ($redirect) {
                header("Location: " . ROOT . "login");
                die();
            }
        }
        return false;

    }

    //logout and return to index page
    public function logout()
    {
        if (isset($_SESSION['user_url_address'])) {
            unset($_SESSION['user_url_address']);
        }
        header("Location: " . ROOT . "home");
        die;

    }

    //return one user via user_url_address
    public function get_user($user_url_address){
        $db = Database::newInstance();

        $arr = false;


        $arr['user_url_address'] = addslashes($user_url_address);
        $query = "SELECT * FROM tbl_user WHERE user_url_address = :user_url_address limit 1";

        $result = $db->read_db($query, $arr);
        if(is_array($result)) {
            return $result[0];
        }

        return false;
    }
}
