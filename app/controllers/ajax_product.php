<?php

// this is the file controller about ajax action of admin

class Ajax_product extends Controller
{

    //index of Ajax
    public function index()
    {
        /**Actually php://input allows you to read raw POST data and convert to string JSON
         * IT is a less memory intensive alternative to $HTTP_RAW_POST_DATA and does not need any
         * special php.ini directives. php://input is not available with enctype="multipart/form-data".
         * Reference: http://php.net/manual/en/wrappers.php.php
         */

        if(count($_POST) > 0){

            //data: Add or edit product
            $data = (object)$_POST;
        }else{

            //data: Delete product
            $data = file_get_contents("php://input");
            $data = json_decode($data);
        }

        $_SESSION['error'] = "";

        if (is_object($data) && isset($data->data_type)) {
            $DB = Database::getInstance();
            $product = $this->load_model('Product');
            $category = $this->load_model('Category');
            $image_class= $this->load_model('Image');

            //add new  product
            if ($data->data_type == "add_product") {

                $check = $product->add($data, $_FILES, $image_class);

                if ($_SESSION['error'] != "") {
                    $arr['message'] = $_SESSION['error'];
                    $_SESSION['error'] = "";
                    $arr['message_type'] = "error";
                    $arr['data'] = "";
                    $arr['data_type'] = "add_product";

                    echo json_encode($arr);
                }
                 else {
                    $arr['message'] = "Thêm Sản Phẩm mới thành công";
                    $arr['message_type'] = "info";

                    //refresh data in table
                    $products = $product->get_all();
                    $arr['data'] = $product->make_table($products, $category);

                    $arr['data_type'] = "add_product";
                    echo json_encode($arr);
                }
            }// Edit category name
            else if ($data->data_type == "edit_product") {

                $check = $product->edit($data, $_FILES, $image_class);
                if($_SESSION['error'] != ""){
                    $arr['message'] = $_SESSION['error'];
                    $_SESSION['error'] = "";
                    $arr['message_type'] = "error";
                    $arr['data'] = "";
                    $arr['data_type'] = "edit_product";

                    echo json_encode($arr);
                }else{
                    $arr['message'] = "Cập nhật Sản Phẩm thành công";
                    $_SESSION['error'] = "";
                    $arr['message_type'] = "info";

                    //refresh data in table
                    $products = $product->get_all();
                    $arr['data'] = $product->make_table($products, $category);

                    $arr['data_type'] = "edit_product";
                    echo json_encode($arr);
                }

            }

            // delete category
            else if ($data->data_type == "delete_row") {
                $product->delete($data->id);
                $arr['message'] = "Xóa Sản Phẩm thành công";
                $_SESSION['error'] = "";
                $arr['message_type'] = "info";

                //refresh data in table
                $products = $product->get_all();
                $arr['data'] = $product->make_table($products, $category);

                $arr['data_type'] = "delete_row";
                echo json_encode($arr);
            }

        }
    }


}
