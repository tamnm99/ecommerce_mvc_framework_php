<!--This file is page of Checkout-->

<?php $this->view("header", $data); ?>

<!--Validation in checkout page-->
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
        <?php if (is_array($ROWS)): ?>
            <div class="register-req">
                <p>
                    Vui lòng Đăng Nhập hoặc Đăng Ký thành viên để có thể dễ dàng trong việc Đặt Hàng và Thanh Toán
                </p>
            </div><!--/register-req-->

           <!--If form checkout have error of validation. Retaining information of form checkout-->
            <?php
                $address = "";
                $postal_code = "";
                $city = "";
                $district = "";
                $note = "";
                $phone_number = "";

                if (isset($POST_DATA)) {
                    extract($POST_DATA);
                }
            ?>
            <form method="POST">
                <div class="shopper-informations">

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="bill-to">
                                <p>Đơn Hàng Tới </p>
                                <div class="form-one">

                                    <input name="address"  value="<?= $address?>" class="form-control" type="text" placeholder="Địa chỉ *"
                                           required><br>

                                    <input name="postal_code" class="form-control" value="<?= $postal_code?>" type="text"
                                           placeholder="Zip/Mã Bưu Điện *" required><br>

                                </div>
                                <div class="form-two">

                                    <select name="city" value="<?= $city?>" class="js-city form-control" oninput="get_districts(this.value)"
                                            required>
                                        <?php
                                            if($city == ""){
                                                 echo "<option>-- Thành Phố/ Tỉnh --</option>";
                                            }else{
                                                echo "<option>$city</option>";
                                            }
                                        ?>

                                        <?php if (isset($cities) && $cities) : ?>
                                            <?php foreach ($cities as $row) : ?>
                                                <option value="<?= $row->city ?>"> <?= $row->city ?></option>

                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select><br>

                                    <select name="district" value="<?= $district?>" class="js-district form-control" required>

                                        <?php
                                            if($district == ""){
                                                echo "<option>-- Quận/Huyện --</option>";
                                            }else{
                                                echo "<option> $district </option>";
                                            }
                                        ?>

                                    </select><br>

                                    <input name="phone_number" value="<?= $phone_number?>" type="text" class="form-control"
                                           placeholder="Số Điện Thoại *" required><br>

                                </div>
                            </div>

                        </div>

                        <div class="col-sm-4">
                            <div class="order-message">
                                <p>Ghi Chú</p>
                                <textarea name="note"
                                          placeholder="Bạn muốn lưu ý gì cho Đơn Hàng này ?"
                                          rows="6 "><?= $note ?> </textarea>

                            </div>
                        </div>
                        <a href="<?= ROOT ?>cart" class="pull-left">
                            <input type="button" class="btn btn-success pull-right" value="<--  Giỏ Hàng " name="">
                        </a>

                        <input type="submit" class="btn btn-info pull-right" value=" Tiếp Tục -->" name="">

                    </div>
            </form>

            <!--Else client will see notification-->
        <?php else: ?>
            <div style="margin-top: 50px; margin-bottom: 50px">
                <h3 class="text-center">
                    Vui lòng thêm Mặt Hàng vào trong Giỏ Hàng rồi mới Thanh Toán
                </h3>
                <br>
                <a href="<?= ROOT ?>cart" class="pull-left">
                    <input type="button" class="btn btn-success pull-right" value="<--  Giỏ Hàng " name="">
                </a>
            </div>
        <?php endif; ?>

    </div> <!--/#container-->


</section> <!--/#cart_items-->


<script>

    //When choose city, get all districts of that city
    //Get id of parent to show child districts
    function get_districts(city) {
        send_data({
            id: city.trim()
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
                            "<option value='" + obj.data[i].district + "'>" + obj.data[i].district + "</option>";
                    }
                }

            }

        }
    }


</script>

<?php $this->view("footer", $data); ?>