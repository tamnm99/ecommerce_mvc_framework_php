<?php

// this is the file controller about ajax action of Cart

class Ajax_cart extends Controller
{

    //index of Ajax
    public function index()
    {

    }

    //Edit input quantity of an item in Cart
    public function edit_quantity($data = "")
    {
        $obj = json_decode($data);

        $quantity =  escape($obj->quantity);
        $id = escape($obj->id);

        //Edit and Store in $_SESSION
        if(isset($_SESSION['CART'])){
            foreach ($_SESSION['CART'] as $key => $item){
                if($item['id'] == $id){
                    $_SESSION['CART'][$key]['quantity'] = (int) $quantity;
                    break;
                }
            }
        }

        $obj->data_type = "edit_quantity";
        echo json_encode($obj);
    }

    //Delete a Product in cart
    public function delete_item($data =""){
        $obj = json_decode($data);
        $id = escape($obj->id);


        if(isset($_SESSION['CART'])){
            foreach ($_SESSION['CART'] as $key => $item){
                if($item['id'] == $id){
                    unset($_SESSION['CART'][$key]);

                    //reorder index of $_SESSion['CART'] when remove product from cart
                    $_SESSION['CART'] = array_values($_SESSION['CART']);
                    show($_SESSION['CART']);
                    break;
                }
            }
        }

        $obj->data_type = "delete_item";
        echo json_encode($obj);
    }



}
