<!--This file is page of Checkout Summary-->

<?php $this->view("header", $data); ?>

<!--Validation in checkout summary page-->
<?php
if (isset($errors) && count($errors) > 0) {
    echo "<div>";
    foreach ($errors as $error) {
        echo "<div class='alert alert-danger text-center' style='padding: 5px;
            max-width: 500px; margin: auto; margin-bottom: 20px'>$error</div>";
    }
    echo "</div>";
}

?>

<section id="cart_items">
    <div class="container">
        <!--breadcrums-->
        <ul class="breadcrumb">
            <li><a href="<?= ROOT ?>">Trang Chủ</a></li>
            <li class="active">Thanh Toán</li>
        </ul>
        <!--/breadcrums-->

        <!--If cart has item, client will see checkout page-->
        <?php if (is_array($orders)): ?>
            <div class="register-req">
                <p style="text-align: center">
                    Vui lòng kiểm tra lại thông tin thanh toán trước khi hoàn tất đặt hàng.
                </p>
            </div><!--/register-req-->


            <?php foreach ($orders as $row): ?>
                <?php
                $row = (object)$row;
                $row->id = 0;
                ?>

                <div class="js-order-details details">

                    <!--Order Details-->
                    <div style="display: flex;">
                        <table class="table" style=" flex: 1; margin: 4px">
                            <tr>
                                <th>Thành Phố/Tỉnh:</th>
                                <td> <?= $row->city ?></td>
                            <tr>

                            <tr>
                                <th>Quận/Huyện:</th>
                                <td> <?= $row->district ?></td>
                            </tr>

                            <tr>
                                <th>Địa chỉ giao hàng:</th>
                                <td><?= $row->address ?></td>
                            </tr>
                        </table>
                        <table class="table" style="flex: 1; margin: 4px">
                            <tr>
                                <th>Số Điện Thoại:</th>
                                <td><?= $row->phone_number ?></td>
                            </tr>

                            <tr>
                                <th>Ngày:</th>
                                <td><?= date("d/m/Y") ?></td>
                            </tr>

                            <tr>
                                <th>Ghi Chú:</th>
                                <td><?= $row->note ?></td>
                            </tr>
                        </table>
                    </div>
                    <hr>
                    <h3>Tóm Tắt Đơn Hàng</h3>

                    <table class="table">

                        <thead>
                        <tr>
                            <th>Mô Tả</th>
                            <th>Đơn Giá</th>
                            <th>Số Lượng</th>
                            <th>Thành Tiền</th>
                        </tr>
                        </thead>

                        <?php if ((isset($order_details) && is_array($order_details))): ?>
                            <?php foreach ($order_details as $detail): ?>
                                <tbody>
                                <tr>
                                    <td><?= $detail->description ?></td>
                                    <td><?= number_format($detail->price, 0, ',') ?> ₫</td>
                                    <td><?= $detail->cart_quantity ?></td>
                                    <td><?= number_format($detail->cart_quantity * $detail->price,
                                            0, ',') ?> ₫
                                    </td>
                                </tr>
                                </tbody>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center">
                                Không có dữ liệu chi tiết trong Đơn Hàng này
                            </div>
                        <?php endif; ?>
                    </table>
                    <h3 class="pull-right">Tổng Tiền: <?= number_format($sub_total, 0, ',') ?> ₫ </h3>
                </div>
            <?php endforeach; ?>

            <!--Else client will see notification-->
        <?php else: ?>
            <h3 class="text-center">
                Vui lòng thêm Mặt Hàng vào trong Giỏ Hàng rồi mới Thanh Toán
            </h3>

        <?php endif; ?>
        <br style="clear: both">
        <a href="<?= ROOT ?>checkout" class="pull-left" style="margin-bottom: 30px">
            <input type="button" class="btn btn-success pull-left" value="<--  Thanh Toán " name="">
        </a>

        <!--Form with only metho post to link to "thank you" page-->
        <form method="POST">
            <input type="submit" class="btn btn-info pull-right" value=" Tiếp Tục -->" name="">
        </form>

    </div> <!--/#container-->


</section> <!--/#cart_items-->


<script>

    //When choose city, get all districts of that city
    //Get id of parent to show child districts
    function get_districts(id) {
        send_data({
            id: id.trim()
        }, "get_districts");
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

        //info is object
        var info = {};
        info.data_type = data_type;
        info.data = data;

        ajax.open("POST", "<?= ROOT ?>ajax_checkout", true);//Specifies the type of request
        ajax.send(JSON.stringify(info));// object info -> json
    }

    //receive data from ajax, handle data and show in webpage
    function handle_result(result) {
        console.log(result);

        if (result !== "") {
            var obj = JSON.parse(result);// convert string json to object

            if (typeof obj.data_type != 'undefined') {
                if (obj.data_type === "get_districts") {

                    //Show Select box all districts of that city
                    var select_input = document.querySelector(".js-district");
                    select_input.innerHTML = "<option>-- Quận/Huyện --</option>";

                    for (var i = 0; i < obj.data.length; i++) {
                        select_input.innerHTML +=
                            "<option value='" + obj.data[i].id + "'>" + obj.data[i].district + "</option>";
                    }
                }

            }

        }
    }


</script>

<?php $this->view("footer", $data); ?>