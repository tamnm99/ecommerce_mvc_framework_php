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
<table class="table table-striped table-advance table-hover">

    <thead>
    <tr>
        <th>ID</th>
        <th>Họ & Tên</th>
        <th>Email</th>
        <th>Ngày Tạo</th>
        <th>Tổng Đơn</th>

    </tr>
    </thead>

    <tbody>
    <?php if (isset($users) && is_array($users)): ?>
        <?php foreach ($users as $row): ?>
            <tr style="position: relative; cursor: pointer;">
                <td> <?= $row->user_id ?></td>
                <td>
                    <a href="<?= ROOT ?>profile/<?= $row->user_url_address ?>">
                        <?= $row->user_full_name ?>
                    </a>
                </td>
                <td><?= $row->user_email ?></td>
                <td> <?= date("d/m/Y", strtotime($row->user_date_join)) ?></td>
                <td><?= $row->order_count ?></td>

            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>

</table>

<?php $this->view("admin/footer", $data) ?>
