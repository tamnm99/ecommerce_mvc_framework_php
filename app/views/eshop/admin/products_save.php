<?php $this->view("admin/header", $data) ?>

<?php $this->view("admin/sidebar", $data) ?>

    <style type="text/css">

        .edit_product {
            width: 800px;
            height: 650px;
            background-color: #cecccc;
            position: absolute;
            padding: 6px;

        }

        .show {
            display: block;
        }

        .hide {
            display: none;
        }

        .edit_product_images {
            display: flex;
            width: 100%;
        }

        .edit_product_images img {
            flex: 1;
            width: 100px;
            margin: 2px;
            height: 100px;
        }

    </style>


    <div class="row mt">
        <div class="col-md-12">
            <div class="content-panel">
                <table class="table table-striped table-advance table-hover">
                    <h4><i class="fa fa-angle-right"></i> Danh Sách Sản Phẩm
                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_product_modal"
                                style="margin-left: 15px">
                            Thêm Mới
                        </button>
                    </h4>

                    <!--modal to edit a row-->
                    <div class="edit_product hide" style="left: 0px">
                        <h4 class="mb"><i class="fa fa-angle-right"></i>Sửa Sản Phẩm: </h4>
                        <form class="form-horizontal style-form" method="POST">
                            <div class="form-group">
                                <label for="edit_description" class="col-sm-2 control-label"> Tên Sản Phẩm:</label>
                                <div class="col-sm-10">
                                    <input id="edit_description" name="edit_description" type="text"
                                           class="form-control">

                                </div>
                            </div>
                            <br><br style="clear: both;">

                            <div class="form-group">
                                <label for="edit_quantity" class="col-sm-2 control-label"> Số Lượng:</label>
                                <div class="col-sm-10">
                                    <input id="edit_quantity" type="number" value="1" name="edit_quantity"
                                           class="form-control">

                                </div>
                            </div>
                            <br><br style="clear: both;">

                            <div class="form-group">
                                <label for="edit_category" class="col-sm-2 control-label"> Danh Mục:</label>
                                <div class="col-sm-10">
                                    <select id="edit_category" name="edit_category" class="form-control">
                                        <option></option>
                                        <?php if (is_array($categories)): ?>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?= $category->id ?>"> <?= $category->category_name ?> </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <br><br style="clear: both;">

                            <div class="form-group">
                                <label for="edit_price" class="col-sm-2 control-label"> Giá (VNĐ):</label>
                                <div class="col-sm-10">
                                    <input id="edit_price" type="number" placeholder="1000" step="500" name="edit_price"
                                           class="form-control">

                                </div>
                            </div>
                            <br><br style="clear: both;">

                            <div class="form-group">
                                <label for="edit_image" class="col-sm-2 control-label"> Ảnh chính (Bắt buộc):</label>
                                <div class="col-sm-10">
                                    <input id="edit_image" name="image" type="file" class="form-control"
                                           onchange="display_image(this.files[0], this.name, 'js-product-images-edit')">
                                </div>
                            </div>
                            <br><br style="clear: both;">

                            <div class="form-group">
                                <label for="edit_image2" class="col-sm-2 control-label"> Ảnh 2 (Tùy chọn):</label>
                                <div class="col-sm-10">
                                    <input id="edit_image2" name="image2" type="file" class="form-control"
                                           onchange="display_image(this.files[0], this.name, 'js-product-images-edit')">
                                </div>
                            </div>
                            <br><br style="clear: both;">

                            <div class="form-group">
                                <label for="edit_image3" class="col-sm-2 control-label"> Ảnh 3 (Tùy chọn):</label>
                                <div class="col-sm-10">
                                    <input id="edit_image3" name="image3" type="file" class="form-control"
                                           onchange="display_image(this.files[0], this.name, 'js-product-images-edit')">
                                </div>
                            </div>
                            <br><br style="clear: both;">

                            <div class="form-group">
                                <label for="edit_image4" class="col-sm-2 control-label"> Ảnh 4 (Tùy chọn):</label>
                                <div class="col-sm-10">
                                    <input id="edit_image4" name="image4" type="file" class="form-control"
                                           onchange="display_image(this.files[0], this.name,  'js-product-images-edit')">
                                </div>
                            </div>
                            <br><br style="clear: both;">

                            <div class="js-product-images-edit edit_product_images">

                            </div>
                            <br><br style="clear: both;">

                            <button type="button" class="btn btn-warning" onclick="show_edit_product(0, '', false)"
                                    style="position:absolute; bottom: 10px; left: 10px">Hủy
                            </button>
                            <button type="button" class="btn btn-primary" onclick="collect_edit_data()"
                                    style="position:absolute; bottom: 10px; right:10px">Sửa
                            </button>

                        </form>
                    </div>
                    <!--End modal to edit a row-->

                    <hr>
                    <thead>
                    <tr>
                        <th><i class="fa fa-qrcode"></i> ID Sản Phẩm</th>
                        <th><i class="fa fa-tag"></i> Tên Sản Phẩm</th>
                        <th><i class="fas fa-"></i> Số Lượng</th>
                        <th><i class="fa fa-list-alt"></i> Danh Mục</th>
                        <th><i class="fa fa-money"></i> Giá</th>
                        <th><i class="fa fa-calendar-o"></i> Ngày Nhập</th>
                        <th><i class="fa fa-pencil"></i> Chức Năng</th>
                    </tr>
                    </thead>

                    <!-- Table of content-->
                    <tbody id="table_body">
                    <?= $data['tbl_rows']; ?>
                    </tbody>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div><!-- /row -->


    <!-- Add new product-->
    <!-- BootStrap 3 Modal -->
    <div id="add_product_modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <form id="product_form" method="POST">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Thêm Sản Phẩm mới</h4>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="description">Tên Sản Phẩm:</label>
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Số Lượng:</label>
                            <input type="number"  class="form-control" id="quantity"
                                   name="product_quantity" required
                            />
                        </div>

                        <div class="form-group">
                            <label for="category">Danh Mục:</label>

                            <select id="category" name="category" class="form-control" required>
                                <option></option>
                                <?php if (is_array($categories)): ?>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category->id ?>"> <?= $category->category_name ?> </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="price">Giá (VND):</label>
                            <input type="number"  class="form-control" id="price"
                                   name="price" required>
                        </div>

                        <div class="form-group">
                            <label for="image">Ảnh Chính (Bắt buộc):</label>
                            <input type="file" class="form-control" id="image" name="image"
                                   onchange="display_image(this.files[0], this.name,  'js-product-images-add')">
                        </div>

                        <div class="form-group">
                            <label for="image2">Ảnh 2 (Tùy chọn):</label>
                            <input type="file" class="form-control" id="image2" name="image2"
                                   onchange="display_image(this.files[0], this.name,  'js-product-images-add')">
                        </div>

                        <div class="form-group">
                            <label for="image3">Ảnh 3 (Tùy chọn):</label>
                            <input type="file" class="form-control" id="image3" name="image3"
                                   onchange="display_image(this.files[0], this.name,  'js-product-images-add')">
                        </div>

                        <div class="form-group">
                            <label for="image4">Ảnh 4 (Tùy chọn):</label>
                            <input type="file" class="form-control" id="image4" name="image4"
                                   onchange="display_image(this.files[0], this.name,  'js-product-images-add')">
                        </div>

                        <div class="form-group">
                            <div class="js-product-images-add edit_product_images">
                                <img src="">
                                <img src="">
                                <img src="">
                                <img src="">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="collect_data()">
                            Thêm
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Add new product end-->


    <script type="text/javascript">

        var EDIT_ID = 0;

        // show modal edit or hide modal edit
        function show_edit_product(id, product, e) {

            var show_edit_box = document.querySelector(".edit_product");
            if (e) {

                var a = (e.currentTarget.getAttribute("info"));
                //replace single quote in json to convert a to object
                var info = JSON.parse(a.replaceAll("'", '"'));

                EDIT_ID = info.id;

                // show_edit_box.style.left = (e.clientX - 700) + "px";
                // show_edit_box.style.top = (e.clientY - 100) + "px";

                var edit_description_input = document.querySelector("#edit_description");
                edit_description_input.value = info.description;

                var edit_quantity_input = document.querySelector("#edit_quantity");
                edit_quantity_input.value = info.quantity;

                var edit_category_input = document.querySelector("#edit_category");
                edit_category_input.value = info.category;

                var edit_price_input = document.querySelector("#edit_price");
                edit_price_input.value = info.price;

                var product_images_input = document.querySelector(".js-product-images-edit");
                product_images_input.innerHTML = `<img src="<?=ROOT?>${info.image}"/>`;
                product_images_input.innerHTML += `<img src="<?=ROOT?>${info.image2}"/>`;
                product_images_input.innerHTML += `<img src="<?=ROOT?>${info.image3}"/>`;
                product_images_input.innerHTML += `<img src="<?=ROOT?>${info.image4}"/>`;
            }

            if (show_edit_box.classList.contains("hide")) {
                show_edit_box.classList.remove("hide");

            } else {
                show_edit_box.classList.add("hide");

            }
        }


        //get data from input field of modal add new product and send data for ajax handle
        function collect_data() {
            var description_input = document.querySelector("#description");
            if (description_input.value.trim() == "" || !isNaN(description_input.value.trim())) {
                alert("Tên Sản Phẩm không được để trống và không được là số");
                return;
            }

            var quantity_input = document.querySelector("#quantity");
            if (quantity_input.value.trim() == "") {
                alert("Số lượng không được để trống");
                return;
            }

            var category_input = document.querySelector("#category");
            if (category_input.value.trim() == "") {
                alert("Tên Danh Mục của Sản Phẩm không được để trống");
                return;
            }

            var price_input = document.querySelector("#price");
            if (price_input.value.trim() == "") {
                alert("Giá không được để trống");
                return;
            }

            var image_input = document.querySelector("#image");
            if (image_input.files.length == 0) {
                alert("Ảnh không được để trống");
                return;
            }

            //creat data form
            var data = new FormData();

            var image2_input = document.querySelector("#image2");
            if (image2_input.files.length > 0) {
                data.append('image2', image2_input.files[0]);
            }

            var image3_input = document.querySelector("#image3");
            if (image3_input.files.length > 0) {
                data.append('image3', image3_input.files[0]);
            }

            var image4_input = document.querySelector("#image4");
            if (image4_input.files.length > 0) {
                data.append('image4', image4_input.files[0]);
            }


            data.append('description', description_input.value.trim());
            data.append('quantity', quantity_input.value.trim());
            data.append('category', category_input.value.trim());
            data.append('price', price_input.value.trim());
            data.append('image', image_input.files[0]);

            data.append('data_type', 'add_product');
            send_data_files(data);

        }

        //get data from input field of edit category and send data for ajax handle
        function collect_edit_data() {
            var edit_description_input = document.querySelector("#edit_description");
            if (edit_description_input.value.trim() == "" || !isNaN(edit_description_input.value.trim())) {
                alert("Tên Sản Phẩm không được để trống và không được là số");
                return;
            }


            var edit_quantity_input = document.querySelector("#edit_quantity");
            if (edit_quantity_input.value.trim() == "") {
                alert("Số lượng không được để trống");
                return;
            }

            var edit_category_input = document.querySelector("#edit_category");
            if (edit_category_input.value.trim() == "") {
                alert("Tên Danh Mục của Sản Phẩm không được để trống");
                return;
            }

            var edit_price_input = document.querySelector("#edit_price");
            if (edit_price_input.value.trim() == "") {
                alert("Giá không được để trống");
                return;
            }

            //creat data form
            var data = new FormData();

            var edit_image_input = document.querySelector("#edit_image");
            if (edit_image_input.files.length > 0) {
                data.append('image', edit_image_input.files[0]);
            }

            var edit_image2_input = document.querySelector("#edit_image2");
            if (edit_image2_input.files.length > 0) {
                data.append('image2', edit_image2_input.files[0]);
            }

            var edit_image3_input = document.querySelector("#edit_image3");
            if (edit_image3_input.files.length > 0) {
                data.append('image3', edit_image3_input.files[0]);
            }

            var edit_image4_input = document.querySelector("#edit_image4");
            if (edit_image4_input.files.length > 0) {
                data.append('image4', edit_image4_input.files[0]);
            }


            data.append('description', edit_description_input.value.trim());
            data.append('quantity', edit_quantity_input.value.trim());
            data.append('category', edit_category_input.value.trim());
            data.append('price', edit_price_input.value.trim());
            data.append('id', EDIT_ID);


            data.append('data_type', 'edit_product');
            send_data_files(data);

        }

        //Send data for ajax handle
        function send_data(data = {}) {

            // var form = new FormData();
            // form.append('data', data);
            var ajax = new XMLHttpRequest();

            //attaches an event handler readystatechange: Returns the (loading) status of the current document
            ajax.addEventListener('readystatechange', function () {

                // status_code 200: request is ok
                // state 4: AJAX call has completed ( the request had been sent,
                // the server had finished returning the response and the browser had finished
                // downloading the response content
                if (ajax.readyState == 4 && ajax.status == 200) {

                    //handle data which received from ajax
                    handle_result(ajax.responseText);
                }
            });

            ajax.open("POST", "<?=ROOT?>ajax_product", true);//Specifies the type of request
            ajax.send(JSON.stringify(data)); // convert data to JSON

        }

        function send_data_files(formData) {

            // var form = new FormData();
            // form.append('data', data);
            var ajax = new XMLHttpRequest();

            //attaches an event handler readystatechange: Returns the (loading) status of the current document
            ajax.addEventListener('readystatechange', function () {

                // status_code 200: request is ok
                // state 4: AJAX call has completed ( the request had been sent,
                // the server had finished returning the response and the browser had finished
                // downloading the response content
                if (ajax.readyState == 4 && ajax.status == 200) {

                    //handle data which received from ajax
                    handle_result(ajax.responseText);
                }
            });

            ajax.open("POST", "<?=ROOT?>ajax_product", true);//Specifies the type of request
            ajax.send(formData); // convert data to JSON
        }

        // reset field modal form
        function clear_field() {
            $('#product_form')[0].reset();
            $('#product_name').text('');
        }

        //receive data from ajax, handle data and show in webpage
        function handle_result(result) {
            console.log(result);
            if (result != "") {
                var obj = JSON.parse(result);// convert string json to object
                if (typeof obj.data_type != 'undefined') {

                    if (obj.data_type == "add_product") {
                        if (obj.message_type == "info") {
                            alert(obj.message);
                            $('#add_product_modal').modal('hide');
                            clear_field();

                            var table_body = document.querySelector("#table_body");
                            table_body.innerHTML = obj.data;
                        } else {
                            alert(obj.message);
                        }
                    } else if (obj.data_type == "delete_row") {
                        var table_body = document.querySelector("#table_body");
                        table_body.innerHTML = obj.data;
                        alert(obj.message);
                    } else if (obj.data_type == "edit_product") {
                        if (obj.message_type == "info") {
                            alert(obj.message);
                            show_edit_product(0, '', false);

                            var table_body = document.querySelector("#table_body");
                            table_body.innerHTML = obj.data;
                        } else {
                            alert(obj.message);
                        }
                    }
                }

            }
        }

        function display_image(file, name, element) {
            var index = 0;
            if (name == "image2") {
                index = 1;
            } else if (name == "image3") {
                index = 2;
            } else if (name == "image4") {
                index = 3;
            }

            var image_holder = document.querySelector("." +element);
            var images = image_holder.querySelectorAll("IMG");

            images[index].src = URL.createObjectURL(file);
        }

        //delete a row
        function delete_row(id) {
            //modal dialog to show confirm
            var answer = confirm("Bạn có chắc muốn xóa Sản Phẩm này ?");
            if (answer){
                send_data({
                    data_type: "delete_row",
                    id: id
                });
            } else {
                return;
            }

        }


    </script>


<?php $this->view("admin/footer", $data) ?>
<?php
