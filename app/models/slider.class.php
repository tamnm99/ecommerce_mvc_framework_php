<?php

class Slider
{

    private $error = "";

    // Add new slider into tbl_slider
    public function add($DATA, $FILES, $image_class = null)
    {
        $this->error = "";
        $DB = Database::newInstance();
        $arr['header1_text'] = ucwords($DATA['header1_text']);
        $arr['header2_text'] = ucwords($DATA['header2_text']);
        $arr['description'] = $DATA['description'];
        $arr['link'] = $DATA['link'];

        /*if (!preg_match("/^[a-zA-Z 0-9._\-,]+$/", trim($arr['header1_text']))) {
            $_SESSION['error'] .= "Tên sản phẩm phải là chữ số <br>";
        }
        if (empty($arr['header2_text'])) {
            $_SESSION['error'] .= "Số Lượng phải là số";
        }
        if (!preg_match("/^[a-zA-Z]+$/", trim($arr['category']))) {
            $_SESSION['error'] .= "Danh mục sản phẩm phải là chữ số <br>";
        }
        if (!is_numeric($arr['price'])) {
            $_SESSION['error'] .= "Giá phải là số <br>";
        }*/

       /* Handle file image which is POST to server*/
        if ($this->error == "") {
            $arr['image'] = "";
            $arr['image2'] = "";

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
                    $this->error .= "File ảnh nhập sai định dạng";
                }
                if ($img_row['error'] == 0 && in_array($img_row['type'], $allowed)) {
                    if ($img_row['size'] < $size) {
                        $destination = $folder . $image_class->generate_filename(60) . ".jpg";
                        move_uploaded_file($img_row['tmp_name'], $destination);
                        $arr[$key] = $destination;
                        $image_class->resize_image($destination, $destination, 1500, 1500);
                    } else {
                        $this->error .= $key . "có dung dượng quá lớn <br>";
                    }
                }
            }

            $query = "INSERT INTO tbl_slider (header1_text, header2_text, description, link, image, image2, disabled) 
                    VALUES (:header1_text, :header2_text, :description, :link, :image, :image2, 0)";

            $check = $DB->write_db($query, $arr);

            if ($check) {
                return true;
            }
        }
        return $this->error;
    }

    //get all slider from tbl_slider
    public function get_all(){
        $DB = Database::newInstance();
        $query = "SELECT * FROM tbl_slider WHERE disabled = 0";
        $result = $DB->read_db($query);
        return $result;
    }
}
