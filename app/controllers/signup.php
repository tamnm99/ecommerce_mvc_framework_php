<?php
// this is the file controller of webpage signup 


class Signup extends Controller{

    //index show file html 
    public function index(){
        $data['page_title'] = "Đăng Ký";

                //When click form
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            //show($_POST);
            // Load class name 'user' exists in folder models
            $user = $this ->load_model("User");

             //call method loggin with variable super global $_POST(from form user post information)
            $user -> signup($_POST);
        }

        $this->view("signup", $data);
    }

}