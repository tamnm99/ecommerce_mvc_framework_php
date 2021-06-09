<?php

//Class Setting information about: email, phone number, facebook

Class Setting{

    protected $error = array();
    protected static $SETTINGS = null;

    //get all object setting in tbl_settings
    public function get_all_settings(){
        $db = Database::newInstance();
        $query = "SELECT * FROM tbl_settings";

        return $db->read_db($query);
    }

    //Magic method of PHP
    public static function __callStatic($name, $arguments)
     {
          // TODO: Implement __callStatic() method.

         if(self::$SETTINGS){
             $settings = self::$SETTINGS;
         }else{
             $settings = self::get_all_settings_as_object();
         }

         if(isset($settings->$name)){
             return $settings->$name;
         }

         return "";
     }

     //Method get all value & setting_slug in tbl_settings
    public static function get_all_settings_as_object(){
        $db = Database::newInstance();
        $query = "SELECT * FROM tbl_settings";
        $data =  $db->read_db($query);

        $settings = (object)[];
        if(is_array($data)){
            foreach ($data as $row){
                $setting_name = $row->setting_slug;
                $settings->$setting_name = $row->value;
            }
        }

        //Store information into static variable $SETTINGS
        self::$SETTINGS = $settings;
        return $settings;

    }

    //Save information into tbl_settings
    public function save_settings($POST){

        $this->error = array();
        $db = Database::newInstance();

        foreach ($POST as $key => $value){
            $arr = array();
            $arr['setting_slug'] = $key;
            $arr['value'] = $value;
            $query = "UPDATE tbl_settings SET value = :value where setting_slug = :setting_slug LIMIT 1";
            $db->write_db($query, $arr);

        }
        return $this->error;
    }

}

