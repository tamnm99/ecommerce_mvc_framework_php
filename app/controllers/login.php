<?php
// this is the file controller of webpage login 

class Login extends Controller{

    //index show file html 
    public function index(){
        $data['page_title'] = "Đăng Nhập";

        //When click form
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            //show($_POST);

            // Load class name 'user' exists in folder models
            $user = $this ->load_model("User");

            //call method login with variable super global $_POST(from form user post information)
            $user ->login($_POST);
        }

        $this->view("login", $data);
    }

}
