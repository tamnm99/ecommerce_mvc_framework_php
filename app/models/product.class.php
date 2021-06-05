<?php

class Product
{

    // Add new product
    public function add($DATA, $FILES, $image_class = null)
    {
        $DB = Database::newInstance();
        $arr['description'] = ucwords($DATA->description);
        $arr['quantity'] = $DATA->quantity;
        $arr['category'] = ucwords($DATA->category);
        $arr['price'] = $DATA->price;
        $arr['date'] = date("Y-m-d H:i:s");
        $arr['user_url_address'] = $_SESSION['user_url_address'];
        $arr['slug'] = $this->str_to_url($DATA->description);
        $_SESSION['error'] = "";

//
//        if (!preg_match("/^[a-zA-Z 0-9._\-,]+$/", trim($arr['description']))) {
//            $_SESSION['error'] .= "Tên sản phẩm phải là chữ số <br>";
//        }
//        if (!is_numeric($arr['quantity'])) {
//            $_SESSION['error'] .= "Số Lượng phải là số";
//        }
//        if (!preg_match("/^[a-zA-Z]+$/", trim($arr['category']))) {
//            $_SESSION['error'] .= "Danh mục sản phẩm phải là chữ số <br>";
//        }
//        if (!is_numeric($arr['price'])) {
//            $_SESSION['error'] .= "Giá phải là số <br>";
//        }

        //make sure slug is unique
        $slug_arr['slug'] = $arr['slug'];
        $query = "SELECT slug FROM tbl_products WHERE slug = :slug LIMIT 1";
        $check = $DB->read_db($query, $slug_arr);
        if ($check) {
            $arr['slug'] .= "-" . rand(0, 99999);
        }

        $arr['image'] = "";
        $arr['image2'] = "";
        $arr['image3'] = "";
        $arr['image4'] = "";

        $allowed[] = "image/jpeg";
        $allowed[] = "image/png";
        $folder = "uploads/";
        $size = 10;
        $size = ($size * 1024 * 1024);

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        //check for files
        foreach ($FILES as $key => $img_row) {
            if (!in_array($img_row['type'], $allowed)) {
                $_SESSION['error'] .= "File ảnh nhập sai định dạng";
            }
            if ($img_row['error'] == 0 && in_array($img_row['type'], $allowed)) {
                if ($img_row['size'] < $size) {
                    $destination = $folder . $image_class->generate_filename(60) . ".jpg";
                    move_uploaded_file($img_row['tmp_name'], $destination);
                    $arr[$key] = $destination;
                    $image_class->resize_image($destination, $destination, 1500, 1500);
                } else {
                    $_SESSION['error'] .= $key . "có dung dượng quá lớn <br>";
                }
            }
        }


        if (!isset($_SESSION['error']) || $_SESSION['error'] == "") {
            $query = "INSERT INTO tbl_products (description, quantity, category, price, date,
                    user_url_address, image, image2, image3, image4, slug) 
                    VALUES (:description, :quantity, :category, :price, :date, :user_url_address,
                    :image, :image2, :image3, :image4, :slug)";

            $check = $DB->write_db($query, $arr);

            if ($check) {
                return true;
            }
        }
        return false;
    }

//edit a row
    public function edit(
        $data,
        $FILES,
        $image_class = null
    ) {

        $arr['id'] = (int)$data->id;
        $arr['description'] = $data->description;
        $arr['quantity'] = $data->quantity;
        $arr['category'] = $data->category;
        $arr['price'] = $data->price;

        $allowed[] = "image/jpeg";
        $allowed[] = "image/png";
        $folder = "uploads/";
        $size = 10;
        $size = ($size * 1024 * 1024);

        $_SESSION['error'] = "";
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        //This is parameter to prepared statement UPDATE
        $images_string = "";

        //check for files
        foreach ($FILES as $key => $img_row) {
            if (!in_array($img_row['type'], $allowed)) {
                $_SESSION['error'] .= "File ảnh nhập sai định dạng";
            }
            if ($img_row['error'] == 0 && in_array($img_row['type'], $allowed)) {
                if ($img_row['size'] < $size) {
                    $destination = $folder . $image_class->generate_filename(60) . ".jpg";
                    move_uploaded_file($img_row['tmp_name'], $destination);
                    $arr[$key] = $destination;
                    $image_class->resize_image($destination, $destination, 1500, 1500);
                    $images_string .= ", " . $key . " = :" . $key;
                } else {
                    $_SESSION['error'] .= $key . "có dung dượng quá lớn <br>";
                }
            }
        }

        $DB = Database::newInstance();
        if (!isset($_SESSION['error']) || $_SESSION['error'] == "") {
            $query = "UPDATE tbl_products SET description = :description,  quantity = :quantity, category = :category, 
                    price = :price $images_string  WHERE id = :id LIMIT 1";
            $DB->write_db($query, $arr);
        }
    }

//delete a row
    public function delete(
        $id
    ) {
        $DB = Database::newInstance();
        $id = (int)$id;
        $query = "DELETE FROM tbl_products WHERE id = '$id' LIMIT 1";
        $DB->write_db($query);
    }

// get all record in tbl_products
    public  function get_all()
    {
        $DB = Database::newInstance();
        return $DB->read_db("SELECT * FROM tbl_products ORDER BY id DESC");
    }


// make table of all record in tbl_products and show to webpage
    public function make_table(
        $products,
        $model = null
    ) {
        $result = "";
        if (is_array($products)) {

            foreach ($products as $products_row) {
                $edit_args = $products_row->id . ",'" . $products_row->description . "'";

                //information of a row to edit row
                $info = array();
                $info['id'] = $products_row->id;
                $info['description'] = $products_row->description;
                $info['quantity'] = $products_row->quantity;
                $info['price'] = $products_row->price;
                $info['category'] = $products_row->category;
                $info['image'] = $products_row->image;
                $info['image2'] = $products_row->image2;
                $info['image3'] = $products_row->image3;
                $info['image4'] = $products_row->image4;

                //clean string json info
                $info = str_replace('"', "'", json_encode($info));

                //convert category in tbl_products to category_name in tbl_categories
                $one_category = $model->get_one($products_row->category);

                $result .= "<tr>";
                $result .= '
                    <td>' . $products_row->id . '</td>
                    <td>' . $products_row->description . '</td>
                     <td>' . $products_row->quantity . '</td>
                     <td>' . $one_category->category_name . '</td>
                     <td>' . $products_row->price . '</td>
                     <td>' . date("d/m/Y", strtotime($products_row->date)) . '</td>
                      <td><img src="' . ROOT . $products_row->image . '" style="width: 70px; height:70px;" alt="product image"></td>
                    <td>
                        <button info="' . $info . '" onclick="show_edit_product(' . $edit_args . ', event)" 
                                class="btn btn-primary btn-xs "><i class="fa fa-pencil"></i></button>
                        <button onclick="show_delete_modal(' . $products_row->id . ')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                    </td>
                    ';

                $result .= "</tr>";
            }
        }
        return $result;
    }

//Generate url slug of product
    public
    function str_to_url(
        $url
    ) {
        $url = trim(mb_strtolower($url));
        $url = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $url);
        $url = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $url);
        $url = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $url);
        $url = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $url);
        $url = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $url);
        $url = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $url);
        $url = preg_replace('/(đ)/', 'd', $url);
        $url = preg_replace('/[^a-z0-9-\s]/', '', $url);
        $url = preg_replace('/([\s]+)/', '-', $url);
        return $url;
    }
}
