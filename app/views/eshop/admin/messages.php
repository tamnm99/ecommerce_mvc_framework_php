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

<!--Information of message in tbl_message-->
<table class="table table-striped table-advance table-hover">

    <?php if ($mode == "read"): ?>
        <thead>
        <tr>
            <th>Họ Tên</th>
            <th>Email</th>
            <th>Chủ Đề</th>
            <th>Nội dung</th>
            <th>Ngày Gửi</th>

        </tr>
        </thead>

        <tbody>
        <?php if (isset($messages) && is_array($messages)): ?>
            <?php foreach ($messages as $row): ?>
                <tr style="position: relative; cursor: pointer;">
                    <td> <?= $row->client_name ?> </td>
                    <td><?= $row->email ?></td>
                    <td><?= $row->subject ?></td>
                    <td><?= $row->message ?></td>
                    <td> <?= date("d/m/Y", strtotime($row->date)) ?></td>


                    <td><a href="<?= ROOT ?>admin/messages?delete=<?= $row->id ?>">
                            <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> XÓA</button>
                        </a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>

    <?php elseif ($mode == "delete_confirmed"): ?>
        <div class="alert alert-success text-center">Đã xóa Thông Điệp từ Khách Hàng thành công !!!</div>
        <a href="<?= ROOT ?>admin/messages">
            <button class="btn btn-success pull-right"><i class="fas fa-trash-alt"></i>Quay Lại</button>
        </a>

    <?php elseif ($mode == "delete" && is_object($messages)): ?>

        <p class="alert alert-danger text-center">
            Bạn có chắc muốn xóa tin nhắn này ?
        </p>

        <a href="<?= ROOT ?>admin/messages?delete_confirmed=<?= $messages->id ?>">
            <button class="btn btn-danger pull-right"><i class="fas fa-trash-alt"></i> OK</button>
        </a>

        <thead>
        <tr>
            <th>Họ Tên</th>
            <th>Email</th>
            <th>Chủ Đề</th>
            <th>Nội dung</th>
            <th>Ngày Gửi</th>

        </tr>
        </thead>

        <tbody>
        <tr style="position: relative; cursor: pointer;">
            <td> <?= $messages->client_name ?> </td>
            <td><?= $messages->email ?></td>
            <td><?= $messages->subject ?></td>
            <td><?= $messages->message ?></td>
            <td> <?= date("d/m/Y", strtotime($messages->date)) ?></td>
        </tr>

        </tbody>
    <?php endif; ?>
    
</table>

<?php $this->view("admin/footer", $data) ?>
<?php
