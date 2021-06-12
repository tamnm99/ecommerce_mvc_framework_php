<?php

// this is the file controller of webpage admin page

class Admin extends Controller
{

    //index method show file html
    public function index()
    {

        // Load class name 'user' exists in folder models
        $User = $this->load_model('User');

        //check login success or not, user has rank 'Admin' or not
        $user_data = $User->check_login(true, ["Admin"]);

        //if success get information login
        if (is_object($user_data)) {
            $data['user_data'] = $user_data;
        }

        $data['page_title'] = "Admin";
        $data['current_page'] = "dashboard";

        //show index.php with data
        $this->view("admin/index", $data);
    }

    //method for show categories
    public function categories()
    {

        // Load class name 'user' exists in folder models
        $User = $this->load_model('User');

        //check login success or not, user has rank 'Admin' or not
        $user_data = $User->check_login(true, ["Admin"]);

        //if success get information login
        if (is_object($user_data)) {
            $data['user_data'] = $user_data;
        }


        $DB = Database::newInstance();

        //select all categories (include disabled == true)
        $categories_all = $DB->read_db("SELECT * FROM tbl_categories ORDER BY id DESC");

        //select all categories (not include disabled == true)
        $categories = $DB->read_db("SELECT * FROM tbl_categories WHERE disabled = 0 ORDER BY id DESC");
        $category = $this->load_model("category");

        // store table of categories in $tbl_rows
        $tbl_rows = $category->make_table($categories_all);
        $data['tbl_rows'] = $tbl_rows;
        $data['categories'] = $categories;
        $data['page_title'] = "Admin - Danh Mục Sản Phẩm";
        $data['current_page'] = "categories";

        //show categories.php with data
        $this->view("admin/categories", $data);
    }

    //method for show products
    public function products()
    {

        // Load class name 'user' exists in folder models
        $User = $this->load_model('User');

        //check login success or not, user has rank 'Admin' or not
        $user_data = $User->check_login(true, ["Admin"]);

        //if success get information login
        if (is_object($user_data)) {
            $data['user_data'] = $user_data;
        }

        //get all record in tbl_products
        $DB = Database::newInstance();
        $products = $DB->read_db("SELECT * FROM tbl_products ORDER BY id DESC");
        $product = $this->load_model("Product");

        //get all record in tbl_categories not include categories disabled = true
        $categories = $DB->read_db("SELECT * FROM tbl_categories WHERE disabled = 0 ORDER BY id DESC");
        $category = $this->load_model("Category");

        // store all record in tbl_rows and show view
        $tbl_rows = $product->make_table($products, $category);
        $data['tbl_rows'] = $tbl_rows;
        $data['categories'] = $categories;
        $data['page_title'] = "Admin - Danh Sách Sản Phẩm";
        $data['current_page'] = "products";

        //show categories.php with data
        $this->view("admin/products", $data);
    }

    //method for show orders
    public function orders()
    {

        // Load class name 'user' & 'order' exists in folder models
        $User = $this->load_model('User');
        $Order = $this->load_model('Order');
        //check login success or not, user has rank 'Admin' or not
        $user_data = $User->check_login(true, ["Admin"]);

        //if success get information login
        if (is_object($user_data)) {
            $data['user_data'] = $user_data;
        }

        // get all order in database
        $orders = $Order->get_all_orders();

        //if user have order, get all information
        if (is_array($orders)) {
            foreach ($orders as $key => $row) {
                $details = $Order->get_orders_details($row->id);
                $orders[$key]->grand_total = 0;

                if (is_array($details)) {
                    $totals = array_column($details, 'total');
                    $grand_total = array_sum($totals);
                    $orders[$key]->grand_total = $grand_total;
                }


                $orders[$key]->details = $details;

                $user = $User->get_user($row->user_url_address);
                $orders[$key]->user = $user;
            }
        }
        $data['orders'] = $orders;
        $data['current_page'] = "orders";
        $data['page_title'] = "Admin - Danh Sách Đơn Hàng";
        $this->view("admin/orders", $data);
    }

    //method for show user customer or admin in left sidebar Users of admin
    function users($type = "customers")
    {

        // Load class name 'user' & 'order' exists in folder models
        $User = $this->load_model('User');
        $Order = $this->load_model('Order');

        //check login success or not, user has rank 'Admin' or not
        $user_data = $User->check_login(true, ["Admin"]);

        //if success get information login
        if (is_object($user_data)) {
            $data['user_data'] = $user_data;
        }

        if ($type == "customers") {
            $users = $User->get_customers();
            $data['page_title'] = "Admin - Khách Hàng";
        }

        if ($type == "admins") {
            $users = $User->get_admins();
            $data['page_title'] = "Admin - Admin";
        }

        //Count all order of one user
        if (is_array($users)) {
            foreach ($users as $key => $row) {
                $orders_number = $Order->get_order_count_one_user($row->user_url_address);
                $users[$key]->order_count = $orders_number;
            }
        }
        $data['users'] = $users;
        $data['current_page'] = "users";
        $this->view("admin/users", $data);
    }

    //Method of Config setting in admin page
    public function settings($type = '')
    {

        // Load class name 'user' exists in folder models
        $User = $this->load_model('User');

        //check login success or not, user has rank 'Admin' or not
        $user_data = $User->check_login(true, ["Admin"]);

        //if success get information login
        if (is_object($user_data)) {
            $data['user_data'] = $user_data;
        }

        //Select page based on $type
        $Settings = new Setting();
        if ($type == "socials") {

            //If click button "Lưu Cài Đặt", save setting in form into database
            if (count($_POST) > 0) {
                $errors = $Settings->save_settings($_POST);
                header("Location: " . ROOT . "admin/settings/socials");
                die;
            }

            $data['page_title'] = "Admin - Thông Tin Liên Hệ";

            //get all object of tbl_settings from database
            $data['settings'] = $Settings->get_all_settings();
        } else {
            if ($type == "slider_image") {
                $Slider = $this->load_model('Slider');
                $data['action'] = "show";

                //Read all slider images in tbl_slider
                $data['rows'] = $Slider->get_all();

                if (isset($_GET['action']) && $_GET['action'] == "add") {
                    $data['action'] = "add";

                    //If new row was posted
                    if (count($_POST) > 0) {

                        $Image = $this->load_model('Image');
                        $data['errors'] = $Slider->add($_POST, $_FILES, $Image);
                        $data['POST'] = $_POST;
                        header("Location: " . ROOT . "admin/settings/slider_image");
                    }


                } else {
                    if (isset($_GET['action']) && $_GET['action'] == "edit") {
                        $data['action'] = "edit";
                        $data['id'] = null;
                        if (isset($_GET['id'])) {
                            $data['id'] = $_GET['id'];
                        }


                    } else {
                        if (isset($_GET['action']) && $_GET['action'] == "delete") {
                            $data['action'] = "add";
                        } else {
                            if (isset($_GET['action']) && $_GET['action'] == "delete_confirm") {
                                $data['action'] = "add";
                            }
                        }
                    }
                }

                $data['page_title'] = "Admin - Slider Ảnh";
            }
        }

        $data['type'] = $type;

        $data['current_page'] = "settings";
        $this->view("admin/settings", $data);
    }

    //Method for handling Message of Client in admin page
    public function messages(){

        //Load class name 'user' & 'message' exists in folder models
        $User = $this->load_model('User');
        $Message = $this->load_model('Message');

        //check login success or not, user has rank 'Admin' or not
        $user_data = $User->check_login(true, ["Admin"]);

        //if success get information login
        if (is_object($user_data)) {
            $data['user_data'] = $user_data;
        }

        //Read all message in tbl_message.
        $mode = "read";
        $messages = $Message->get_all();

        //Want delete a message
        if(isset($_GET['delete'])){
            $mode = "delete";
            $id = $_GET['delete'];
            $messages = $Message->get_one($id);
        }

        //Confirm delete a message
        else if(isset($_GET['delete_confirmed'])){
            $mode = "delete_confirmed";
            $id = $_GET['delete_confirmed'];
            $messages = $Message->delete($id);
        }

        $data['mode'] = $mode;
        $data['messages'] = $messages;
        $data['current_page'] = "messages";
        $data['page_title'] = "Admin - Thông Điệp từ Khách Hàng";
        $this->view("admin/messages", $data);
    }

}
