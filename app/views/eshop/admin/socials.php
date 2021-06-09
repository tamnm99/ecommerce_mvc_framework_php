<!-- This file show view of page Users in admin sidebar -->

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
<form method="POST">
    <table class="table table-striped table-advance table-hover">

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
                    <td><input name="<?= $row->setting_slug ?>" class="form-control" type="text" value="<?= $row->value ?>"</td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>

    </table>

    <input type="submit" value="Lưu Cài Đặt" class="btn btn-success pull-right">

</form>
<?php $this->view("admin/footer", $data) ?>
