<!-- This file show view of page "Đơn Hàng" in admin sidebar -->

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

<table class="table table-striped table-advance table-hover">

    <thead>
    <tr>
        <th>ID Đơn Hàng</th>
        <th>Khách Hàng</th>
        <th>Ngày Đặt</th>
        <th>Địa Chỉ</th>
        <th>Số Điện Thoại</th>
        <th>Thành Phố/Tỉnh</th>
        <th>Quận/Huyện</th>
        <th>Tổng Tiền (VNĐ)</th>
        <th style="color:green;">Xem Chi Tiết</th>
    </tr>
    </thead>

    <tbody onclick="show_detail(event)">
    <?php foreach ($orders as $row): ?>
        <tr style="position: relative; cursor: pointer;">
            <td> <?= $row->id ?></td>
            <td><a href="<? ROOT ?>profile/<?= $row->user->user_url_address ?>"> <?= $row->user->user_full_name ?> </a>
            </td>
            <td> <?= date("d/m/Y", strtotime($row->date)) ?></td>
            <td> <?= $row->delivery_address ?></td>
            <td> <?= $row->phone_number ?></td>
            <td> <?= $row->city ?></td>
            <td> <?= $row->district ?></td>
            <td> <?= number_format($row->total, 0, ',') ?></td>
            <td>
                <i class="fa fa-arrow-down" style="color:green; cursor: pointer;"></i>
                <div class="js-order-details details hide">

                    <a style="float: right; cursor: pointer; margin-bottom: 5px">Đóng</a>
                    <h3> ID Đơn Hàng #<?= $row->id ?>  </h3>
                    <h4> Khách Hàng: <?= $row->user->user_full_name ?>  </h4>

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
                                <td><?= $row->delivery_address ?></td>
                            </tr>
                        </table>
                        <table class="table" style="flex: 1; margin: 4px">
                            <tr>
                                <th>Số Điện Thoại:</th>
                                <td><?= $row->phone_number ?></td>
                            </tr>

                            <tr>
                                <th>Ngày:</th>
                                <td><?= date("d/m/Y", strtotime($row->date)) ?></td>
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

                        <?php if ((isset($row->details) && is_array($row->details))): ?>
                            <?php foreach ($row->details as $detail): ?>
                                <tbody>
                                <tr>
                                    <td><?= $detail->description ?></td>
                                    <td><?= number_format($detail->amount, 0, ',') ?></td>
                                    <td><?= $detail->quantity ?></td>
                                    <td><?= number_format($detail->total, 0, ',') ?></td>
                                </tr>
                                </tbody>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div>
                                Không có dữ liệu chi tiết trong Đơn Hàng này
                            </div>
                        <?php endif; ?>
                    </table>
                    <h3 class="pull-right">Tổng Tiền: <?= number_format($row->grand_total,
                            0, ',') ?></h3>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>

</table>

<script type="text/javascript">

    function show_detail(event) {
        var row = event.target.parentNode;
        if (row.tagName !== "TR") {
            row = row.parentNode;
        }
        var details = row.querySelector(".js-order-details");

        //get all rows
        var all = event.currentTarget.querySelectorAll(".js-order-details");
        for (var i = 0; i < all.length; i++) {
            if (all[i] !== details) {
                all[i].classList.add('hide');
            }

        }

        if (details.classList.contains('hide')) {
            details.classList.remove('hide');
        } else {
            details.classList.add('hide');
        }

    }

</script>

<?php $this->view("admin/footer", $data) ?>
