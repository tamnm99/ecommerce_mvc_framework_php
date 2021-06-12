<!-- This file show view of page Setting in admin sidebar -->

<?php $this->view("admin/header", $data) ?>

<?php $this->view("admin/sidebar", $data) ?>

<style>
    .details {
        background-color: #eee;
        box-shadow: 0px 0px 10px #aaa;
        width: 90%;
        position: absolute;
        min-height: 100px;
        left: 2%;
        right: 5%;
        padding: 10px;
        z-index: 2;
    }

    .hide {
        display: none;
    }
</style>

<!--Information of customer or admin in tbl_user-->
<form method="POST" enctype="multipart/form-data">
    <table class="table table-striped table-advance table-hover">

        <?php if ($type == "socials"): ?>
            <thead>
            <tr>
                <th>Cài Đặt</th>
                <th>Giá Trị</th>
            </tr>
            </thead>

            <tbody>
            <?php if (isset($settings) && is_array($settings)): ?>
                <?php foreach ($settings as $row): ?>
                    <tr>
                        <td><?= $row->setting ?></td>
                        <td><input name="<?= $row->setting_slug ?>" class="form-control" type="text"
                                   value="<?= $row->value ?>"</td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>

            <input type="submit" value="Lưu Cài Đặt" class="btn btn-success pull-right">

        <?php elseif ($type == "slider_image"): ?>
            <?php if ($action == "show"): ?>
                <thead>
                <tr>
                    <th>Header 1 Text:</th>
                    <th>Header 2 Text:</th>
                    <th>Mô Tả:</th>
                    <th>Link Sản Phẩm:</th>
                    <th>Ảnh Sản Phẩm:</th>
                    <th>Vô Hiệu Hóa:</th>
                    <th>Sửa / Xóa</th>
                </tr>
                </thead>

                <tbody>

                <?php if (isset($rows) && is_array($rows)): ?>
                    <?php foreach ($rows as $row): ?>
                        <tr>
                            <td><?= $row->header1_text ?></td>
                            <td><?= $row->header2_text ?></td>
                            <td><?= $row->description ?></td>
                            <td><?= $row->link ?></td>
                            <td><img src="<?= ROOT. $row->image?>" style="width: 100px"></td>
                            <td><?= ($row->disabled) ? "Có" : "Không" ?></td>
                            <td></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
                <a href="<?= ROOT ?>admin/settings/slider_image?action=add">
                    <button type="button" class="btn btn-success pull-left"><i class="fa fa-plus"></i> Thêm Mới</button>
                </a>

            <!--Page has form of add new slider-->
            <?php elseif ($action == "add"): ?>

                <h4>Thêm Slider Ảnh Mới</h4>
                <div class="form-group">
                    <label for="header1_text">Header 1 Text: </label>
                    <input type="text" id="header1_text" name="header1_text" class="form-control" placeholder=""
                           value="<?= (isset($POST['header1_text'])) ? $POST['header1_text'] : ''; ?>" required>

                </div>

                <div class="form-group">
                    <label for="header2_text">Header 2 Text: </label>
                    <input type="text" id="header2_text" name="header2_text" class="form-control" placeholder=""
                           value="<?= (isset($POST['header2_text'])) ? $POST['header2_text'] : ''; ?>" required>
                </div>

                <div class="form-group">
                    <label for="description">Mô Tả: </label>
                    <textarea name="description" id="description" class="form-control"
                              required><?= (isset($POST['description'])) ? trim($POST['description']) : ''; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="link">Đường Dẫn: </label>
                    <input type="text" id="link" name="link" class="form-control" placeholder="" required
                           value="<?= (isset($POST['link'])) ? $POST['link'] : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="image"> Slider Ảnh 1: </label>
                    <input type="file" id="image" class="form-control" name="image"
                    >
                </div>

                <input type="submit" value="THÊM" class="btn btn-success">
            <?php endif; ?>
        <?php endif; ?>
    </table>


</form>
<?php $this->view("admin/footer", $data) ?>
