<?php $this->view("admin/header", $data) ?>

<?php $this->view("admin/sidebar", $data) ?>

    <style type="text/css">

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
                    <!--  show table of tbl_products-->
                    <?= $data['tbl_rows']; ?>
                    </tbody>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div><!-- /row -->

    <!-- Add new product/ BootStrap 3 Modal-->
    <div id="add_product_modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <form id="product_form" method="POST">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-center">THÊM SẢN PHẨM</h4>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="description">Tên Sản Phẩm:</label>
                            <input type="text" class="form-control" id="description" name="description" required>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Số Lượng:</label>
                            <input type="number" class="form-control" id="quantity"
                                   name="quantity"/>
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
                            <input type="number" class="form-control" id="price"
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
                                <img src="" alt="Ảnh chính">
                                <img src="" alt="Ảnh 2">
                                <img src="" alt="Ảnh  3">
                                <img src="" alt="Ảnh  4">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="collect_data()">
                            Thêm
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Add new product end-->

    <!-- Edit product /BootStrap 3 Modal-->
    <div id="edit_product_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form id="edit_product_form" method="POST">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Sửa Sản Phẩm</h4>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_description">Tên Sản Phẩm:</label>
                            <input type="text" class="form-control" id="edit_description" name="edit_description"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="edit_quantity">Số Lượng:</label>
                            <input type="number" value="1" class="form-control" id="edit_quantity"
                                   name="edit_quantity" required
                            />
                        </div>

                        <div class="form-group">
                            <label for="edit_category">Danh Mục:</label>

                            <select id="edit_category" name="edit_category" class="form-control" required>
                                <option></option>
                                <?php if (is_array($categories)): ?>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category->id ?>"> <?= $category->category_name ?> </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="edit_price">Giá (VND):</label>
                            <input type="number" placeholder="1000" step="500" class="form-control" id="edit_price"
                                   name="edit_price" required>
                        </div>

                        <div class="form-group">
                            <label for="image">Ảnh Chính (Bắt buộc):</label>
                            <input id="edit_image" name="image" type="file" class="form-control"
                                   onchange="display_image(this.files[0], this.name, 'js-product-images-edit')">
                        </div>

                        <div class="form-group">
                            <label for="image2">Ảnh 2 (Tùy chọn):</label>
                            <input id="edit_image2" name="image2" type="file" class="form-control"
                                   onchange="display_image(this.files[0], this.name, 'js-product-images-edit')">
                        </div>

                        <div class="form-group">
                            <label for="image3">Ảnh 3 (Tùy chọn):</label>
                            <input id="edit_image3" name="image3" type="file" class="form-control"
                                   onchange="display_image(this.files[0], this.name, 'js-product-images-edit')">
                        </div>

                        <div class="form-group">
                            <label for="image4">Ảnh 4 (Tùy chọn):</label>
                            <input id="edit_image4" name="image4" type="file" class="form-control"
                                   onchange="display_image(this.files[0], this.name,  'js-product-images-edit')">
                        </div>

                        <div class="form-group">
                            <div class="js-product-images-edit edit_product_images">

                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="collect_edit_data()">
                            Sửa
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Edit product end-->

    <!-- Delete product /BootStrap 3 Modal-->
    <div id="delete_product_modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form id="delete_product_form" method="POST">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Xóa Sản Phẩm</h4>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            Bạn có chắc muốn xóa Sản Phẩm này ?
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="id_delete" id="id_delete" value="">
                        <button type="button" class="btn btn-success" onclick="delete_product()">
                            Có
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Không</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Delete product end-->

    <script type="text/javascript">

        // When select picture file, can see picture in the bottom of modal
        function display_image(file, name, element) {
            var index = 0;
            if (name === "image2") {
                index = 1;
            } else if (name === "image3") {
                index = 2;
            } else if (name === "image4") {
                index = 3;
            }

            //image_holder = .js-product-images-add
            var image_holder = document.querySelector("." + element);

            //Get all element img
            var images = image_holder.querySelectorAll("IMG");

            /*
             creates a DOMString containing a URL representing the object given in the parameter.
             The URL lifetime is tied to the document in the window on which it was created.
             The new object URL represents the specified File object or Blob object.
             */
            images[index].src = URL.createObjectURL(file);
        }

        //get data from input field of modal add new product and send data for ajax handle
        function collect_data() {
            var description_input = document.querySelector("#description");
            if (description_input.value.trim() === "" || !isNaN(description_input.value.trim())) {
                alert("Tên Sản Phẩm không được để trống và không được là số");
                return;
            }

            var quantity_input = document.querySelector("#quantity");
            if (quantity_input.value.trim() === "") {
                alert("Số lượng không được để trống");
                return;
            }

            var category_input = document.querySelector("#category");
            if (category_input.value.trim() === "") {
                alert("Tên Danh Mục không được để trống");
                return;
            }

            var price_input = document.querySelector("#price");
            if (price_input.value.trim() === "") {
                alert("Giá không được để trống");
                return;
            }

            var image_input = document.querySelector("#image");
            if (image_input.files.length === 0) {
                alert("Ảnh không được để trống");
                return;
            }

            //creat data form
            var data = new FormData();

            data.append('description', description_input.value.trim());
            data.append('quantity', quantity_input.value.trim());
            data.append('category', category_input.value.trim());
            data.append('price', price_input.value.trim());
            data.append('image', image_input.files[0]);

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

            data.append('data_type', 'add_product');
            send_data_files(data);
        }

        // show modal edit or hide modal edit
        var EDIT_ID = 0;
        function show_edit_product(id, product, e) {
            $("#edit_product_modal").modal('show');
            EDIT_ID = id;

            if (e) {
                var a = (e.currentTarget.getAttribute("info"));

                //replace single quote in json to convert a to object
                var info = JSON.parse(a.replaceAll("'", '"'));

                EDIT_ID = info.id;

                var edit_description_input = document.querySelector("#edit_description");
                edit_description_input.value = info.description;

                var edit_quantity_input = document.querySelector("#edit_quantity");
                edit_quantity_input.value = info.quantity;

                var edit_category_input = document.querySelector("#edit_category");
                edit_category_input.value = info.category;

                var edit_price_input = document.querySelector("#edit_price");
                edit_price_input.value = info.price;

                var product_images_input = document.querySelector(".js-product-images-edit");

                // use backtick in javascript ` ... `
                // ${..} is a variable when use backtick
                product_images_input.innerHTML = `<img src="<?=ROOT?>${info.image}"/>`;
                product_images_input.innerHTML += `<img src="<?=ROOT?>${info.image2}"/>`;
                product_images_input.innerHTML += `<img src="<?=ROOT?>${info.image3}"/>`;
                product_images_input.innerHTML += `<img src="<?=ROOT?>${info.image4}"/>`;
            }
        }

        //get data from input field of edit category and send data for ajax handle
        function collect_edit_data() {
            var edit_description_input = document.querySelector("#edit_description");
            if (edit_description_input.value.trim() === "" || !isNaN(edit_description_input.value.trim())) {
                alert("Tên Sản Phẩm không được để trống và không được là số");
                return;
            }

            var edit_quantity_input = document.querySelector("#edit_quantity");
            if (edit_quantity_input.value.trim() === "") {
                alert("Số lượng không được để trống");
                return;
            }

            var edit_category_input = document.querySelector("#edit_category");
            if (edit_category_input.value.trim() === "") {
                alert("Tên Danh Mục của Sản Phẩm không được để trống");
                return;
            }

            var edit_price_input = document.querySelector("#edit_price");
            if (edit_price_input.value.trim() === "") {
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

        //send data with data of file image to ajax_product
        function send_data_files(formData) {

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

            ajax.open("POST", "<?=ROOT?>ajax_product", true);//Specifies the type of request
            ajax.send(formData);
        }


        // reset field modal form
        function clear_field() {
            $('#product_form')[0].reset();
            $('#product_name').text('');
        }

        //receive data from ajax, handle data and show in webpage
        function handle_result(result) {
            console.log(result);
            var table_body = document.querySelector("#table_body");
            if (result !== "") {
                var obj = JSON.parse(result);// convert string json to object
                if (typeof obj.data_type != 'undefined') {

                    if (obj.data_type === "add_product") {
                        if (obj.message_type === "info") {
                            alert(obj.message);
                            $('#add_product_modal').modal('hide');
                            clear_field();
                            table_body.innerHTML = obj.data;
                        } else {
                            alert(obj.message);
                        }
                    } else if (obj.data_type === "delete_row") {
                        table_body.innerHTML = obj.data;
                        alert(obj.message);
                    } else if (obj.data_type === "edit_product") {
                        if (obj.message_type === "info") {
                            alert(obj.message);
                            $('#edit_product_modal').modal('hide');
                            clear_field();

                            table_body.innerHTML = obj.data;
                        } else {
                            alert(obj.message);
                        }
                    }
                }

            }
        }

        //Send data for ajax handle
        function send_data(data = {}, files = {}) {

            // var form = new FormData();
            // form.append('data', data);
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

            ajax.open("POST", "<?=ROOT?>ajax_product", true);//Specifies the type of request
            ajax.send(JSON.stringify(data)); // convert data to JSON
        }

        //open delete modal to delete product
        function show_delete_modal(id) {
            $("#id_delete").val(id);
            $("#delete_product_modal").modal('show');
        }

        //Delete product
        function delete_product() {
            var id = $("#id_delete").val();

            send_data({
                data_type: "delete_row",
                id: id
            });

            $("#delete_product_modal").modal('hide');
        }

    </script>


<?php $this->view("admin/footer") ?>

