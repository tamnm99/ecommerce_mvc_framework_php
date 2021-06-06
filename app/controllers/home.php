<?php

// this is the file controller of webpage Home

Class Home extends Controller{

    //index show file html
    public function index(){

        // Load class name 'user' and 'image' exists in folder models
        $User = $this->load_model('User');
        $image_class = $this->load_model('Image');

        //check login success or not, user has rank admin or not
        $user_data = $User->check_login();

        //if success get information login
        if(is_object($user_data)){
			$data['user_data'] = $user_data;
		}

        //get product in DB to show Webpage
        $DB = Database::newInstance();

        //$ROWS: all products exists in DB
        $ROWS = $DB->read_db("SELECT * FROM tbl_products");
        $data['page_title'] = "Trang Chủ";

        if($ROWS){
            foreach ($ROWS as $key => $row){
                // generate thumbnail product
                $ROWS[$key]->image = $image_class->get_thumb_post($ROWS[$key]->image);
            }
        }
        $data['ROWS'] = $ROWS;

        //show index.php with data
        $this->view("index", $data);
    }


}
