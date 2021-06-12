<?php

// this is the file controller of webpage Contact US

Class Contact_us extends Controller{

    //index show file html
    public function index(){

        // Load class name 'user' & 'message' exists in folder models
        $User = $this->load_model('User');
        $Message = $this->load_model('Message');

        //check login success or not, user has rank admin or not
        $user_data = $User->check_login();

        //if success get information login
        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $DB = Database::newInstance();
        $data['error'] = array();
        $data['success'] = false;
        if(count($_POST) > 0){
            $data['$POST'] = $_POST;
            $data['error'] = $Message->add($_POST);
            if(!is_array($data['error']) && $data['error']){
                $data['success'] = true;
            }
        }

        //show index.php with data
        $data['page_title'] = "Liên Hệ với Chúng Tôi";
        $this->view("contact-us", $data);
    }


}
