<?php

// this is the file controller of product detail webpage

Class Product_Details extends Controller{

    //method index to show file html
    public function index($slug){

        $slug = escape($slug);

        // Load class name 'user' exists in folder models
        $User = $this->load_model('User');

        //check login success or not, user has rank admin or not
        $user_data = $User->check_login();

        //if success get information login
        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        $DB = Database::newInstance();
        $ROW  = $DB->read_db("SELECT * FROM tbl_products WHERE slug = :slug", ['slug'=>$slug]);

        $data['page_title'] = "Trang Chủ";
        $data['ROW'] = is_array($ROW) ? $ROW[0] : false;

        //show index.php with data
        $this->view("product_details", $data);
    }




}
