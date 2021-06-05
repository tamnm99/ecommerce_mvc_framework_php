<?php

//this is Controller of all webpage, show view webpage, load model in models folder

class Controller
{

    //Link path with file extension .php to show view
    public function view($path, $data = [])
    {
        // Extract This function uses array keys as variable names and values as variable values.
        // For each element it will create a variable in the current symbol table.

        if(is_array($data)){
            extract($data);
        }

        if (file_exists("../app/views/" . THEME . $path . ".php")) {
            include("../app/views/" . THEME . $path . ".php");
        } else {
            include("../app/views/" . THEME . "404.php");
        }
    }

    //Link path with file extension .class.php to connect with MOdel
    public function load_model($model)
    {
        if (file_exists("../app/models/" . strtolower($model) . ".class.php")) {
            include_once("../app/models/" . strtolower($model) . ".class.php");
            return $a = new $model();
        }
        return false;
    }
}

?>