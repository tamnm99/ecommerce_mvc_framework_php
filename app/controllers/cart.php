<?php

// this is the file controller of webpage Cart

class Cart extends Controller
{

    //index show file html
    public function index()
    {

        // Load class name 'user' and Image exists in folder models
        //$User = $this->load_model('User');
        $image_class = $this->load_model('Image');

        //check login success or not, user has rank admin or not
        //$user_data = $User->check_login();

        //if success get information login
        //if (is_object($user_data)) {
           // $data['user_data'] = $user_data;
       // }

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
                    if ($row->id == $cart['id']){
                        $ROWS[$key]->cart_quantity = $cart['quantity'];
                        break;
                    }
                }
            }
        }


        $data['page_title'] = "Giỏ Hàng";

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

        //show index.php with data
        $this->view("cart", $data);
    }


}
