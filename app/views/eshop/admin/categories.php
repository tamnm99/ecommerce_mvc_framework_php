<?php $this->view("admin/header", $data) ?>

<?php $this->view("admin/sidebar", $data) ?>

<div class="row mt">
    <div class="col-md-12">
        <div class="content-panel">
            <table class="table table-striped table-advance table-hover">
                <h4><i class="fa fa-angle-right"></i> Danh sách Danh Mục
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_category_modal"
                            style="margin-left: 15px">
                        Thêm Mới
                    </button>
                </h4>

                <hr>
                <thead>
                <tr>
                    <th><i class="fa fa-bullhorn"></i> Tên Danh Mục</th>
                    <th><i class="fa fa-list-alt"></i> Danh Mục Cha</th>
                    <th><i class=" fa fa-bell"></i> Trạng Thái</th>
                    <th><i class="fa fa-pencil"></i> Chức Năng</th>
                </tr>
                </thead>

                <!-- Table of content-->
                <tbody id="table_body">

                <!--show all categories-->
                <?= $data['tbl_rows']; ?>
                </tbody>
            </table>
        </div><!-- /content-panel -->
    </div><!-- /col-md-12 -->
</div><!-- /row -->


<!-- Add new category-->
<!-- BootStrap 3 Modal -->
<div id="add_category_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form id="add_category_form" method="POST">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center">THÊM DANH MỤC MỚI</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="category_name">Tên Danh Mục:</label>
                        <input type="text" class="form-control" id="category_name" name="category_name">
                    </div>

                    <div class="form-group">
                        <label for="parent">Danh Mục Cha (Tùy chọn):</label>
                        <select id="parent" name="parent" class="form-control" required>

                            <!-- show parent of categories which is enabled and not disabled-->
                            <option></option>
                            <?php if (is_array($categories)): ?>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category->id ?>"> <?= $category->category_name ?> </option>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </select>
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
<!-- Add new category end-->

<!-- Edit category-->
<!-- BootStrap 3 Modal -->
<div id="edit_category_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form id="edit_category_form" method="POST">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center">SỬA DANH MỤC</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="category_name_edit">Tên Danh Mục:</label>
                        <input type="text" class="form-control" id="category_name_edit" name="category_name_edit">
                    </div>

                    <div class="form-group">
                        <label for="parent_edit">Danh Mục Cha (Tùy chọn):</label>
                        <select id="parent_edit" name="parent" class="form-control" required>
                            <option></option>
                            <?php if (is_array($categories)): ?>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category->id ?>"> <?= $category->category_name ?> </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
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
<!-- Edit category end-->


<!-- Delete category-->
<!-- BootStrap 3 Modal -->
<div id="delete_category_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form id="delete_category_form" method="POST">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center">XÓA DANH MỤC</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        Bạn có chắc muốn xóa danh mục sản phẩm này ?
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="id_delete" id="id_delete" value="">
                    <button type="button" class="btn btn-success" onclick="delete_category()">
                        Có
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Không</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Delete category end-->

<script type="text/javascript">

    var EDIT_ID = 0;

    // show modal  edit or hide modal edit
    function show_edit_category(id, category, parent) {
        $("#edit_category_modal").modal('show');
        EDIT_ID = id;
        var category_name_edit_input = document.querySelector("#category_name_edit");
        category_name_edit_input.value = category;
        var parent_edit_input = document.querySelector("#parent_edit");
        parent_edit_input.value = parent;

    }


    //get data from input field of modal add new category and send data for ajax handle
    function collect_data() {
        var category_name_input = document.querySelector("#category_name");
        if (category_name_input.value.trim() === "" || !isNaN(category_name_input.value.trim())) {
            alert("Tên Danh Mục không được để trống và không được là số");
            return;
        }

        var parent_input = document.querySelector("#parent");
       /* if (parent_input.value.trim() === "") {
            alert("Danh mục Cha không được để trống");
            return;
        }*/

        var category_name = category_name_input.value.trim();
        var parent = parent_input.value.trim();

        send_data({
            category_name: category_name,
            parent: parent,
            data_type: "add_category"
        });

    }

    //get data from input field of edit category and send data for ajax handle
    function collect_edit_data() {
        var category_name_edit_input = document.querySelector("#category_name_edit");
        if (category_name_edit_input.value.trim() === "") {
            alert("Tên Danh Mục không được để trống và không được là số");
            return;
        }

        var parent_edit_input = document.querySelector("#parent_edit");
        if (isNaN(parent_edit_input.value.trim())) {
            alert("Danh mục Cha không được là số");
            return;
        }

        var category_name_edit = category_name_edit_input.value.trim();
        var parent_edit = parent_edit_input.value.trim();

        send_data({
            id: EDIT_ID,
            category: category_name_edit,
            parent: parent_edit,
            data_type: "edit_category"
        });

    }

    //Send data for ajax handle
    function send_data(data = {}) {

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

        ajax.open("POST", "<?=ROOT?>ajax_category", true);//Specifies the type of request
        ajax.send(JSON.stringify(data)); // convert data to JSON
    }

    // reset field modal form
    function clear_field() {
        $('#add_category_form')[0].reset();
        $('#category_name').text('');
    }

    //receive data from ajax, handle data and show in webpage
    function handle_result(result) {
        console.log(result);
        table_body = document.querySelector("#table_body");
        if (result !== "") {
            var obj = JSON.parse(result);// convert string json to object
            if (typeof obj.data_type != 'undefined') {

                if (obj.data_type === "add_category") {
                    if (obj.message_type === "info") {
                        alert(obj.message);
                        $('#add_category_modal').modal('hide');
                        clear_field();
                        table_body.innerHTML = obj.data;
                    } else {
                        alert(obj.message);
                    }
                } else if (obj.data_type === "delete_row") {
                    table_body.innerHTML = obj.data;
                    alert(obj.message);
                }

                else if (obj.data_type === "disable_row") {
                    table_body.innerHTML = obj.data;
                }

                else if (obj.data_type === "edit_category") {
                    if (obj.message_type === "info") {
                        alert(obj.message);
                        $("#edit_category_modal").modal('hide');
                        table_body.innerHTML = obj.data;
                    } else {
                        alert(obj.message);
                    }
                }
            }

        }
    }

    // open delete modal
    function show_delete_modal(id) {

        $("#id_delete").val(id);
        $("#delete_category_modal").modal('show');
    }

    // Click OK to delete a row category
    function delete_category() {
        var id = $("#id_delete").val();

        send_data({
            data_type: "delete_row",
            id: id
        });

        $("#delete_category_modal").modal('hide');

    }

    // Click to disabled row or enabled row
    function disable_row(id, state) {

        send_data({
            data_type: "disable_row",
            id: id,
            current_state: state
        });
    }

</script>


<?php $this->view("admin/footer", $data) ?>
