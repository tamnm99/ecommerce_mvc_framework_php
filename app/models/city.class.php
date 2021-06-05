<?php

Class City{


    //Get list cities in tbl_cites
    public function  get_cities(){
        $DB = Database::newInstance();
        $query = "SELECT * FROM tbl_cities ORDER BY id DESC";
        $data = $DB->read_db($query);

        return $data;
    }

    //Get list districts in tbl_districts via parent (cities)
    public function get_districts($city){
        $arr['city'] = addslashes($city);

        $DB = Database::newInstance();
        $query = "SELECT * FROM tbl_cities WHERE city = :city LIMIT 1";



        $check = $DB->read_db($query, $arr);
        $data = false;

        if(is_array($check)){
            $arr = false;
            $arr['id'] = $check[0]->id;
            $query = "SELECT * FROM tbl_districts WHERE parent = :id ORDER BY id DESC";
            $data = $DB->read_db($query, $arr);
        }

        return $data;

    }

    //Get one city
    public function get_city($id){

        $id = (int) $id;
        $DB = Database::newInstance();
        $query = "SELECT * FROM tbl_cities WHERE id = '$id' ";
        $data = $DB->read_db($query);

        return is_array($data) ? $data[0] : false;
    }

    //Get one district
    public function get_district($id){
        $arr['id'] = (int) $id;

        $DB = Database::newInstance();
        $query = "SELECT * FROM tbl_districts WHERE id = :id ";
        $data = $DB->read_db($query, $arr);

        return is_array($data) ? $data[0] : false;

    }
}

?>