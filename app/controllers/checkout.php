<?php

// this is the file controller of webpage CheckOut

class Checkout extends Controller
{

    //index show file html
    public function index()
    {

        // Load class name 'user' and Image exists in folder models
        $User = $this->load_model('User');
        $image_class = $this->load_model('Image');

        //check login success or not, user has rank admin or not
        $user_data = $User->check_login();

        //if success get information login
        if (is_object($user_data)) {
            $data['user_data'] = $user_data;
        }


        $DB = Database::newInstance();
        $ROWS = false;
        $product_id = array();
        if (isset($_SESSION['CART'])) {

            //get all value in column $_SESSION['CART'] and store in array $product_id
            $product_id = array_column($_SESSION['CART'], 'id');

            //String contain all values in array $product_id
            $id_str = "'" . implode("','", $product_id) . "'";

            //Get all product in DB via value of $id_string
            $ROWS = $DB->read_db("SELECT * FROM tbl_products WHERE id IN ($id_str)");

        }

        //Add new column 'cart_quantity' into $ROWS[$key]
        if (is_array($ROWS)) {
            foreach ($ROWS as $key => $row) {
                foreach ($_SESSION['CART'] as $cart) {
                    if ($row->id == $cart['id']) {
                        $ROWS[$key]->cart_quantity = $cart['quantity'];
                        break;
                    }
                }
            }
        }

        $data['page_title'] = "Thanh Toán";

        //Calculate total price of all item in ROWS
        $data['sub_total'] = 0;
        if ($ROWS) {
            foreach ($ROWS as $key => $row) {

                // generate thumbnail product
                $ROWS[$key]->image = $image_class->get_thumb_post($ROWS[$key]->image);
                $myTotal = $row->price * $row->cart_quantity;
                $data['sub_total'] += $myTotal;
            }
        }

        $data['ROWS'] = $ROWS;

        //get list of city
        $cities = $this->load_model('City');
        $data['cities'] = $cities->get_cities();

        //check if old POST data exists
        if(isset($_SESSION['POST_DATA'])){
            $data['POST_DATA'] =  $_SESSION['POST_DATA'] ;
        }

        if (count($_POST) > 0) {

            //Validate information of form checkout
            $order = $this->load_model("Order");
            $order->validate($_POST);
            $data['errors'] = $order->errors;


            //after validate, form had no error, link to page checkout/summary
            $_SESSION['POST_DATA'] = $_POST;
            $data['POST_DATA'] =  $_SESSION['POST_DATA'];
            if(count($order->errors) == 0){
                header("Location:" . ROOT . "checkout/summary");
                die;
            }

        }
        //show index.php with data
        $this->view("checkout", $data);
    }

    //page checkout/summary
    public function summary()
    {

        // Load class name 'user' and Image exists in folder models
        $User = $this->load_model('User');
        $image_class = $this->load_model('Image');

        //check login success or not, user has rank admin or not
        $user_data = $User->check_login();

        //if success get information login
        if (is_object($user_data)) {
            $data['user_data'] = $user_data;
        }

        $data['page_title'] = "Tóm Tắt Thanh Toán";

        //When click Thanh Toán, form will be POST and save information form to database
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset( $_SESSION['POST_DATA'])) {

            /* show($_POST);
            show($ROWS);
            show($_SESSION);*/

            $session_id = session_id();
            $user_url_address = 0;

            if (isset($_SESSION['user_url_address'])) {
                $user_url_address = $_SESSION['user_url_address'];
            }

            //Save checkout information of client to DB
            //$_POST: information in form checkout, $ROWS: all product in cart
            //$user_url_address: user url address when user logged in
            //$session_id

            $order = $this->load_model("Order");
            $order->save_checkout($_SESSION['POST_DATA'], $ROWS, $user_url_address, $session_id);

            $data['errors'] = $order->errors;


        }

        //show index.php with data
        $this->view("checkout.summary", $data);

    }


}
