<?php


class Category
{

    // Add a new category
    public function add($DATA)
    {
        $DB = Database::newInstance();
        $arr['category_name'] = ucwords($DATA->category_name);
        $arr['parent'] = $DATA->parent;

//        if (!preg_match("/^[a-zA-Z]+$/", trim($arr['category_name']))) {
//            $_SESSION['error'] = "Tên danh mục chỉ được chứa chữ cái";
//        }

        if (!isset($_SESSION['error']) || $_SESSION['error'] == "") {
            $query = "INSERT INTO tbl_categories (category_name, parent) VALUES (:category_name, :parent)";
            $check = $DB->write_db($query, $arr);

            if ($check) {
                return true;
            }
        }

        return false;

    }

    //edit a row
    public function edit($data)
    {
        $DB = Database::newInstance();
        $arr['id'] = $data->id;
        $arr['category_name'] = $data->category;
        $arr['parent'] = $data->parent;
        $query = "UPDATE tbl_categories SET category_name = :category_name, parent = :parent WHERE id = :id LIMIT 1";
        $DB->write_db($query, $arr);
    }

    //delete a row
    public function delete($id)
    {
        $DB = Database::newInstance();
        $id = (int)$id;
        $query = "DELETE FROM tbl_categories WHERE id = '$id' LIMIT 1";
        $DB->write_db($query);
    }

    // get all record in tbl_categories
    public function get_all()
    {
        $DB = Database::newInstance();
        return $DB->read_db("SELECT * FROM tbl_categories ORDER BY ID DESC");
    }

    // get one record in tbl_categories
    public function get_one($id)
    {
        $id = (int)$id;
        $DB = Database::newInstance();
        $data = $DB->read_db("SELECT * FROM tbl_categories WHERE id = '$id' LIMIT 1");
        return $data[0];
    }

    // make table of all record in tbl_categories and show to webpage
    public function make_table($categories)
    {
        $result = "";
        if (is_array($categories)) {
            foreach ($categories as $categories_row) {
                // set color to field Enable/Disabled
                $color = $categories_row->disabled ? "#825c11" : "#5bc0de";

                //Change column disabled in DB(0, 1) to Disabled/Enabled
                $categories_row->disabled = $categories_row->disabled ? "Disabled" : "Enabled";

                $args = $categories_row->id . ",'" . $categories_row->disabled . "'";
                $edit_args = $categories_row->id . ",'" . $categories_row->category_name . "'," . $categories_row->parent;

                //Select parent of categories
                $parent = "";
                foreach ($categories as $category_row2) {
                    if ($categories_row->parent == $category_row2->id) {
                        $parent = $category_row2->category_name;
                    }
                }

                $result .= "<tr>";
                $result .= '
                    <td><a href="basic_table.html#">' . $categories_row->category_name . '</a></td>
                     <td><a href="basic_table.html#">' . $parent . '</a></td>
                    <td><span  onclick="disable_row(' . $args . ')" class="label label-info label-mini" 
                        style="cursor:pointer; background-color:' . $color . ';">' . $categories_row->disabled . '</span></td>
                    <td>
                        <button onclick="show_edit_category(' . $edit_args . ')"        
                                class="btn btn-primary btn-xs "><i class="fa fa-pencil"></i></button>
                        <button onclick="show_delete_modal(' . $categories_row->id . ')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                    </td>
                    ';

                $result .= "</tr>";
            }
        }
        return $result;
    }

}

