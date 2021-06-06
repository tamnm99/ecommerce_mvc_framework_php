<?php

class Order extends Controller
{
    public $errors = array();

    //validate information of form checkout
    public function validate($POST){

        $this->errors = array();

        //loop through all value in checkout form to validation
        foreach ($POST as $key => $value){
            if($key == "city"){
                if($value == "" || $value == "-- Thành Phố/ Tỉnh --"){
                    $this->errors[] = "Vui lòng chọn Thành Phố hoặc Tỉnh mà bạn muốn giao hàng !";
                }
            }

            if($key == "district"){
                if($value == "" || $value == "-- Quận/Huyện --"){
                    $this->errors[] = "Vui lòng chọn Quận hoặc Huyện mà bạn muốn giao hàng !";
                }
            }

            if($key == "address"){
                if(empty($value)){
                    $this->errors[] = "Vui lòng điền địa chỉ mong muốn hàng được giao đến !";
                }
            }

            if($key == "phone_number"){
                if(empty($value)){
                    $this->errors[] = "Vui lòng điền số điện thoại của người nhận hàng !";
                }
            }

        }
    }

    //Save checkout information of client to DB
    public function save_checkout($POST, $ROWS, $user_url_address, $session_id)
    {
        //Total price of an Order (all price of product in Order)
        $total = 0;
        foreach ($ROWS as $key => $row) {
            $total += $row->cart_quantity * $row->price;
        }

        $DB = Database::newInstance();

        //If cart has Item
        if (is_array($ROWS) && count($this->errors) == 0) {

            $data = array();
            $data['user_url_address'] = $user_url_address;
            $data['session_id'] = $session_id;
            $data['delivery_address'] = $POST['address'];
            $data['total'] = $total;
            $data['note'] = $POST['note'];

            /*$POST['city'] and $POST['district'] is int*/
            //Convert int to text
            $cities = $this->load_model('City');
           /* $city_obj =  $cities->get_city($POST['city']);*/
           /* $data['city'] =    $city_obj->city;*/
            $data['city'] = $POST['city'];
            /*$district_obj = $cities->get_district($POST['district']);*/
           /* $data['district'] =  $district_obj->district;*/
            $data['district'] = $POST['district'];
            $data['zip'] = $POST['postal_code'];
            $data['tax'] = 0;
            $data['date'] = date("Y:m:d H:i:s");
            $data['phone_number'] = $POST['phone_number'];
            $data['shipping'] = 0;



            $query = "INSERT INTO tbl_orders(user_url_address, delivery_address, total, city, 
                    district, zip, tax, shipping, date, session_id, phone_number, note) 
                    VALUES (:user_url_address, :delivery_address, :total, :city, 
                    :district, :zip, :tax, :shipping, :date, :session_id, :phone_number, :note)";
            $result = $DB->write_db($query, $data);

            //Save order checkout detail
            $order_id = 0;
            $query = "SELECT id FROM tbl_orders ORDER BY id DESC LIMIT 1";
            $result = $DB->read_db($query);

            if(is_array($result)){
                $order_id = $result[0]->id;
            }

            foreach($ROWS as $row){
                $data = array();
                $data['order_id'] = $order_id;
                $data['quantity'] = $row->cart_quantity;
                $data['description'] =  $row->description;
                $data['amount'] = $row->price;
                $data['total'] =  $row->cart_quantity * $row->price;
                $data['product_id'] =  $row->id;
                $query = "INSERT INTO tbl_order_details (order_id, quantity, description, amount, total, product_id) 
                            VALUES (:order_id, :quantity, :description, :amount, :total, :product_id)";
                $result = $DB->write_db($query, $data);
            }
        }
    }

    //get orders and show in profile.php
    public function get_orders_by_user($user_url_address){

        $orders = false;
        $DB = Database::newInstance();
        $data['user_url_address'] = $user_url_address;
        $query = "SELECT * FROM tbl_orders WHERE user_url_address = :user_url_address ORDER BY id DESC 
                LIMIT 100";
        $orders = $DB->read_db($query, $data);

        return $orders;

    }

    //Count all orders of 1 user
    public function get_order_count_one_user($user_url_address){

        $DB = Database::newInstance();
        $data['user_url_address'] = $user_url_address;

        $query = "SELECT id FROM tbl_orders WHERE user_url_address = :user_url_address  ";
        $result = $DB->read_db($query, $data);

        //Store in variable $orders
        $orders = is_array($result) ? count($result) : 0;

        return $orders;

    }

    public function get_all_orders(){

        $orders = false;

        $DB = Database::newInstance();

        $query = "SELECT * FROM tbl_orders ORDER BY id DESC LIMIT 100";

        $orders = $DB->read_db($query);

        return $orders;

    }

    public function get_orders_details($order_id){

        $details = false;
        $data = array();
        $data['order_id'] = addslashes($order_id);
        $DB = Database::newInstance();
        $query = "SELECT * FROM tbl_order_details WHERE order_id = :order_id ORDER BY id DESC ";

        $details  = $DB->read_db($query, $data);

        return   $details ;

    }
}

?>