<!-- Webpage Cart -->

<!-- include file header of website -->
<?php $this->view("header", $data); ?>

<section id="cart_items">
    <div class="container">

        <!--breadcrums-->
        <ol class="breadcrumb">
            <li><a href="#">Trang Chủ</a></li>
            <li class="active">Giỏ Hàng</li>
        </ol>
        <!--/breadcrums-->

        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                <tr class="cart_menu">
                    <td class="image">Sản Phẩm</td>
                    <td class="description"></td>
                    <td class="price">Giá</td>
                    <td class="quantity">Số Lượng</td>
                    <td class="total">Thành Tiền</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>



                <?php if ($ROWS): ?>  <!--if has item in cart-->
                    <?php foreach ($ROWS as $row): ?>
                        <tr>
                            <td class="cart_product">
                                <a href="<?= ROOT ?>product_details/<?= $row->slug ?>"><img src="<?= ROOT ?><?= $row->image ?>" style="width: 100px; "
                                                alt="Ảnh Sản Phẩm"></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href=""><?= $row->description ?></a></h4>
                                <p>ID Sản Phẩm: <?= $row->id ?> </p>
                            </td>
                            <td class="cart_price">
                                <p><?= number_format($row->price, 0, ',') ?> ₫</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up"
                                       href="<?= ROOT ?>add_to_cart/add_quantity/<?= $row->id ?>"> + </a>

                                    <input onchange="edit_quantity(this.value, '<?= $row->id ?>'); "
                                           class="cart_quantity_input" type="text"
                                           name="quantity"
                                           value="<?= $row->cart_quantity ?>" autocomplete="off" size="2">
                                    <a class="cart_quantity_down"
                                       href="<?= ROOT ?>add_to_cart/subtract_quantity/<?= $row->id ?>"> - </a>
                                </div>
                            </td>

                            <!--Calculate total price of one Product-->
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    <?= number_format($row->price * $row->cart_quantity, 0, ',') ?> ₫
                                </p>
                            </td>

                           <!-- 2 way to delete item. 1: using delete_item in ajax, 2: using remove method in
                            controller add_to_cart.php-->
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" delete_id="<?= $row->id ?>"
                                   onclick="delete_item(this.getAttribute('delete_id'))"
                                   href="<?= ROOT ?>add_to_cart/remove/<?= $row->id ?>">
                                    <i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <!--No item in cart-->
                <?php else: ?>
                    <div style="text-align: center; padding: 10px">
                        <h4>Không có sản phẩm nào trong Giỏ Hàng !!</h4>
                    </div>
                <?php endif; ?>

                </tbody>
            </table>

        </div>

        <!-- Total Price of all item-->
        <div class="text-center" style="font-size: 25px">
            Tổng Cộng: <?= number_format($sub_total, 0, ',') ?> ₫
        </div>

        <a href="<?= ROOT ?>checkout">
            <input type="button" class="btn btn-success pull-right" value="Thanh Toán >>>" name="">
        </a>
        <a href="<?= ROOT ?>shop">
            <input type="button" class="btn btn-info pull-left" value=" <<< Tiếp Tục Mua Sắm" name="">
        </a>

    </div>
</section> <!--/#cart_items-->

<br>
<br>

<script>

    //Edit quantity of Product in Quantity input field
    function edit_quantity(quantity, id) {

        //check number
        if (isNaN(quantity)) {
            return
        }

        send_data({
            quantity: quantity.trim(),
            id: id.trim()
        }, "edit_quantity");
    }

    //Click button to remove Product in cart
    function delete_item(id) {

        send_data({
            id: id.trim()
        }, "delete_item");
    }

    //Send data for ajax handle
    function send_data(data = {}, data_type) {

        var ajax = new XMLHttpRequest();

        //attaches an event handler readystatechange: Returns the (loading) status of the current document
        ajax.addEventListener('readystatechange', function () {

            // status_code 200: request is ok
            // state 4: AJAX call has completed ( the request had been sent,
            // the server had finished returning the response and the browser had finished
            // downloading the response content
            if (ajax.readyState === 4 && ajax.status === 200) {

                //handle data which received from ajax
                handle_result(ajax.responseText);
            }
        });

        ajax.open("POST", "<?= ROOT ?>ajax_cart/" + data_type + "/" + JSON.stringify(data), true);//Specifies the type of request
        ajax.send();
    }

    //receive data from ajax, handle data and show in webpage
    function handle_result(result) {
        console.log(result);

        if (result !== "") {
            var obj = JSON.parse(result);// convert string json to object
            if (typeof obj.data_type != 'undefined') {
                if (obj.data_type === "edit_quantity" || obj.data_type === "delete_item") {

                    //refresh webpage
                    window.location.href = window.location.href;
                }

            }

        }
    }

</script>

<!-- include file footer of website -->
<?php $this->view("footer", $data); ?>