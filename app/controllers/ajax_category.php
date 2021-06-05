<?php

// this is the file controller about ajax action of admin

class Ajax_category extends Controller
{

    //index of Ajax
    public function index()
    {

        /**Actually php://input allows you to read raw POST data and convert to string JSON
         * IT is a less memory intensive alternative to $HTTP_RAW_POST_DATA and does not need any
         * special php.ini directives. php://input is not available with enctype="multipart/form-data".
         * Reference: http://php.net/manual/en/wrappers.php.php
         */
        $data = file_get_contents("php://input");
        $data = json_decode($data);// decode json and convert to object
        $_SESSION['error'] = "";

        if (is_object($data) && isset($data->data_type)) {
            $DB = Database::getInstance();
            $category = $this->load_model('Category');

            //add new category
            if ($data->data_type == "add_category") {

                $check = $category->add($data);

                if ($_SESSION['error'] != "") {
                    $arr['message'] = $_SESSION['error'];
                    $_SESSION['error'] = "";
                    $arr['message_type'] = "error";
                    $arr['data'] = "";
                    $arr['data_type'] = "add_category";

                    echo json_encode($arr);
                } else {
                    $arr['message'] = "Thêm tên Danh Mục mới thành công";
                    $arr['message_type'] = "info";

                    //refresh data in table
                    $cats = $category->get_all();
                    $arr['data'] = $category->make_table($cats);

                    $arr['data_type'] = "add_category";
                    echo json_encode($arr);
                }
            } // delete category
            elseif ($data->data_type == "delete_row") {
                $category->delete($data->id);
                $arr['message'] = "Xóa tên Danh Mục thành công";
                $_SESSION['error'] = "";
                $arr['message_type'] = "info";

                //refresh data in table
                $cats = $category->get_all();
                $arr['data'] = $category->make_table($cats);

                $arr['data_type'] = "delete_row";
                echo json_encode($arr);
            } // change disabled/enabled to enabled/disabled
            elseif ($data->data_type == "disable_row") {
                $disabled = ($data->current_state == "Enabled") ? 1 : 0;
                $id = $data->id;

                $query = "UPDATE tbl_categories SET disabled = '$disabled' WHERE id = '$id' LIMIT 1 ";
                $DB->write_db($query);

                $arr['message'] = "";
                $_SESSION['error'] = "";
                $arr['message_type'] = "info";

                //refresh data in table
                $cats = $category->get_all();
                $arr['data'] = $category->make_table($cats);

                $arr['data_type'] = "disable_row";
                echo json_encode($arr);
            } // Edit category name
            elseif ($data->data_type == "edit_category") {
                $category->edit($data);
                $arr['message'] = "Cập nhật tên Danh Mục thành công";
                $_SESSION['error'] = "";
                $arr['message_type'] = "info";

                //refresh data in table
                $cats = $category->get_all();
                $arr['data'] = $category->make_table($cats);

                $arr['data_type'] = "edit_category";
                echo json_encode($arr);
            }
        }
    }


}
