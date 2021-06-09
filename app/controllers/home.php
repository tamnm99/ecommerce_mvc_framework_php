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

        $DB = Database::newInstance();

        //Check if user type in search bar
        $search = false;
        if(isset($_GET['find'])){
            $find = addslashes($_GET['find']);
            $search = true;
        }

        //$ROWS: all products exists in DB
        if($search){
            $arr['description'] =  "%" . $find . "%";
            $ROWS = $DB->read_db("SELECT * FROM tbl_products WHERE description LIKE :description ", $arr);

        }else{
            $ROWS = $DB->read_db("SELECT * FROM tbl_products");
        }

        //Variable show_search will show search bar in webpage
        $data['show_search'] = true;

        $data['page_title'] = "Trang Chủ";

        if($ROWS){
            foreach ($ROWS as $key => $row){
                // generate thumbnail product
                $ROWS[$key]->image = $image_class->get_thumb_post($ROWS[$key]->image);
            }
        }
        $data['ROWS'] = $ROWS;

        //Get all categories
        $category= $this->load_model('Category');
        $data['categories'] = $category->get_all();

        //show index.php with data
        $this->view("index", $data);
    }


}
