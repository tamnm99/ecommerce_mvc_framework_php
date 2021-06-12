<?php


class Message
{
    protected $error = array();

    // Add a new Message
    public function add($DATA)
    {
        $this->error = array();
        $DB = Database::newInstance();
        $arr['client_name'] = ucwords($DATA['client_name']);
        $arr['email'] = $DATA['email'];
        $arr['subject'] = $DATA['subject'];
        $arr['message'] = $DATA['message'];
        $arr['date'] = date("Y-m-d H:i:s");

       /* if (!preg_match("/^[a-zA-Z]+$/", $arr['client_name'])) {
            $this->error[] = "Họ và Tên chỉ được chứa chữ cái";
        }*/

        if (count($this->error) == 0) {
            $query = "INSERT INTO tbl_message (client_name, email, subject, message, date) 
                VALUES (:client_name, :email, :subject, :message, :date)";
            $check = $DB->write_db($query, $arr);

            if ($check) {
                return true;
            }
        }

        return $this->error;

    }

    //Get all message from database
    public function get_all(){
        $DB = Database::newInstance();
        return $DB->read_db("SELECT * FROM tbl_message ORDER BY id DESC");
    }

    //Delete one message
    public function delete($id){
        $DB = Database::newInstance();
        $id = (int)$id;
        $query = "DELETE FROM tbl_message WHERE id = '$id' LIMIT 1";
        $DB->write_db($query);
    }

    // get one record in tbl_message
    public function get_one($id)
    {
        $id = (int)$id;
        $DB = Database::newInstance();
        $data = $DB->read_db("SELECT * FROM tbl_message WHERE id = '$id' LIMIT 1");
        return $data[0];
    }

}

