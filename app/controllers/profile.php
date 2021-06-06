<?php

// this is the file controller of webpage admin profile page

Class Profile extends Controller{

    //index show file html
    public function index($user_url_address = null){

        // Load class name 'User' & 'Order' exists in folder models
        $User = $this->load_model('User');
        $Order = $this->load_model('Order');

        //check login success or not, if not login can not type profile in url to show profile of user
        $user_data = $User->check_login(true);
        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }

        //if success get information login
        if(is_object($user_data)){
            $data['user_data'] = $user_data;
        }


        if($user_url_address){
            //Get information about user in database
            $profile_data = $User->get_user($user_url_address);
        } else{
            $profile_data = $user_data;
        }

        if(is_object($profile_data)){
            // get all order of user via user_url_address
            $orders = $Order->get_orders_by_user($profile_data->user_url_address);
        }else{
            $orders = false;
        }

        //if user have order, get all information
        if(is_array($orders)){
            foreach ($orders as $key => $row){
                $details = $Order->get_orders_details($row->id);
                $totals = array_column($details, 'total' );
                $grand_total = array_sum($totals);
                $orders[$key]->grand_total = $grand_total;
                $orders[$key]->details = $details;

            }
        }

        $data['profile_data'] = $profile_data;
        $data['page_title'] = "Hồ sơ Tài khoản";
        $data['orders'] =   $orders ;

        //show index.php with data
        $this->view("profile", $data);
    }




}
