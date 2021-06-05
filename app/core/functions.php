<?php

// this file has functions to talk with other file in other folder

function show($data){
    echo "<pre>";
        print_r($data);
    echo "</pre>";
}

// check error  in $_SESSION
function check_error(){
    if(isset($_SESSION['error']) && $_SESSION['error'] != ""){
        echo $_SESSION['error'];
        unset($_SESSION['error']);
    }
}

//function escape String
function escape($data){
    return addslashes($data);
}

?>