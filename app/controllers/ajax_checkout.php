<?php

// this is the file controller about ajax webpage Checkout

class Ajax_checkout extends Controller
{

    //index of Ajax
    public function index($data_type = '', $id = '')
    {

        $info = file_get_contents("php://input");
        $info = json_decode($info); //json string decode to object


        $id = $info->data->id;

        $cities = $this->load_model("City");
        $data = $cities->get_districts($id);

        //[] is array, (object)[]: convert array to object
        //$info is object with array inside
        $info = (object)[];
        $info->data = $data;
        $info->data_type = "get_districts";

        echo json_encode($info);


    }


}
