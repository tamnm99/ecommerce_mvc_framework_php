<?php

// this is the file controller of webpage Add to Cart

class Add_to_cart extends Controller
{

    private $redirect_to = "";

    //index show file html
    public function index($id = '')
    {
        //Get product information in DB
        $id = escape($id);
        $DB = Database::newInstance();
        $ROWS = $DB->read_db("SELECT * FROM tbl_products WHERE id= :id LIMIT 1", ["id" => $id]);

        //Save product in $_SESSION['cart']
        if ($ROWS) {
            $ROW = $ROWS[0];

            //if item in cart > 0
            if (isset($_SESSION['CART'])) {
                $id_product = array_column($_SESSION['CART'], "id");

                //if cart had this product, quantity of this product ++
                if (in_array($ROW->id, $id_product)) {
                    $key = array_search($ROW->id, $id_product);
                    $_SESSION['CART'][$key]['quantity']++;
                } else { // else add this product into cart
                    $arr['id'] = $ROW->id;
                    $arr['quantity'] = 1;

                    $_SESSION['CART'][] = $arr;
                }
            } else { // this product is the first product in cart
                $arr['id'] = $ROW->id;
                $arr['quantity'] = 1;

                $_SESSION['CART'][] = $arr;
            }

        }

        //show($_SESSION);
        //header("Location: " . ROOT . "shop");
        //die;

        //direct to page cart

        header("Location: " . ROOT . "cart");

    }

    //add quantity of item in cart
    public function add_quantity($id = '')
    {
        $this->set_redirect();

        $id = escape($id);
        if (isset($_SESSION['CART'])) {
            foreach ($_SESSION['CART'] as $key => $item) {
                if ($item['id'] == $id) {
                    $_SESSION['CART'][$key]['quantity'] += 1;
                    break;
                }
            }
        }

        //echo("add to quantity");

        $this->redirect();
    }

    //subtract quantity of item in cart
    public function subtract_quantity($id = '')
    {
        $this->set_redirect();

        $id = escape($id);
        if (isset($_SESSION['CART'])) {
            foreach ($_SESSION['CART'] as $key => $item) {
                if ($item['id'] == $id) {
                    $_SESSION['CART'][$key]['quantity'] -= 1;
                    break;
                }
            }
        }
        //echo("subtract to quantity");

        $this->redirect();
    }

    //remove an item in cart
    public function remove($id = '')
    {
        $this->set_redirect();

        $id = escape($id);
        if (isset($_SESSION['CART'])) {
            foreach ($_SESSION['CART'] as $key => $item) {
                if ($item['id'] == $id) {
                    unset($_SESSION['CART'][$key]);

                    //reorder index of $_SESSION['CART'] when remove product from cart
                    $_SESSION['CART'] = array_values($_SESSION['CART']);
                    show($_SESSION['CART']);
                    break;
                }
            }
        }
        //echo("remove product");

        $this->redirect();
    }


    //redirect page
    private function redirect()
    {
        header("Location: " . $this->redirect_to);
    }

    //set url to direct page cart
    private function set_redirect()
    {

        //$_SERVER['HTTP_REFERER']: Returns the complete URL of the current page
        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != "") {
            $this->redirect_to = $_SERVER['HTTP_REFERER'];
        } else {
            $this->redirect_to = ROOT . "shop";
        }
        //show($_SERVER);
    }

}
