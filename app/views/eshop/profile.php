<?php $this->view("header", $data); ?>

<section id="main-content">
    <div class="wrapper">
        <div style="min-height: 300px; max-width:1000px; margin:auto;">
            <style type="text/css">
                .col-md-6 {
                    color: #293444;
                }

                #user_text {
                    color: #6e93ce;
                }

                p {
                    color: #6e93ce;
                }

                .details {
                    background-color: #eee;
                    box-shadow: 0px 0px 10px #aaa;
                    width: 80%;
                    position: absolute;
                    min-height: 100px;
                    left: 10%;
                    right: 10%;
                    padding: 10px;
                    z-index: 2;
                }

                .hide {
                    display: none;
                }
            </style>

            <!-- WHITE PANEL - MY ACCOUNT PROFILE DATA -->
            <div class="col-md-4 mb"
                 style=" background-color: #eee; text-align: center; box-shadow: 0px 0px 20px #aaa;">

                <div class="white-panel pn">
                    <div class="white-header" style="color:grey">
                        <h5>HỒ SƠ TÀI KHOẢN</h5>
                    </div>
                    <p><img src="<?= ASSETS . THEME ?>/admin/img/ui-zac.jpg" class="img-circle" width="80"></p>
                    <p><b><?= $data['user_data']->user_full_name ?></b></p>
                    <div class="row">
                        <div class="col-md-6">
                            <p id="user_text" class="small mt">THÀNH VIÊN KỂ TỪ</p>
                            <p><?= date("m/Y", strtotime($data['user_data']->user_date_join)) ?></p>
                        </div>
                        <div class="col-md-6">
                            <p id="user_text" class="small mt">TỔNG CHI TIÊU</p>
                            <p>$ 47,60</p>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <p id="user_text" class="small mt" style="cursor: pointer; color:green;">
                                <i class="fa fa-edit"> SỬA </i>
                            </p>

                        </div>
                        <div class="col-md-6">
                            <p id="user_text" class="small mt" style="cursor: pointer; color:red">
                                <i class="fa fa-trash-o"> XÓA </i>
                            </p>
                        </div>
                    </div>
                </div>
            </div><!-- /col-md-4 -->
            <!-- END MY ACCOUNT PROFILE DATA -->

            <br>
            <br style="clear:both">

            <!--If this user have order online-->
            <?php if (is_array($orders)): ?>
                <table class="table" style="margin-top: 20px; margin-bottom: 20px;">
                    <thead>
                        <tr>
                            <th>ID Đơn Hàng</th>
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
                                <td> <?= date("d/m/Y", strtotime($row->date)) ?></td>
                                <td> <?= $row->delivery_address ?></td>
                                <td> <?= $row->phone_number ?></td>
                                <td> <?= $row->city ?></td>
                                <td> <?= $row->district ?></td>
                                <td> <?= number_format($row->total, 0, ',') ?></td>
                                <td>
                                    <i class="fa fa-arrow-down" style="color:green; cursor: pointer;"></i>
                                    <div class="js-order-details details hide"">
                                        <a style="float: right; cursor: pointer; margin-bottom: 5px">Đóng</a>
                                        <h3> ID Đơn Hàng #<?=$row->id?>  </h3>
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
                                                        <td><?=$detail->description?></td>
                                                        <td><?=number_format($detail->amount,0, ',')?></td>
                                                        <td><?=$detail->quantity?></td>
                                                        <td><?=number_format($detail->total,0, ',')?></td>
                                                    </tr>
                                                    </tbody>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <div>
                                                    Không có dữ liệu chi tiết trong Đơn Hàng này
                                                </div>
                                            <?php endif; ?>
                                        </table>
                                    <h3 class="pull-right">Tổng Tiền: <?=number_format($row->grand_total,0, ',')?></h3>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                     </tbody>
                </table>
            <?php else: ?>
                <div> Tài Khoản chưa đặt Đơn Hàng nào  </div>
            <?php endif; ?>
        </div>
    </section>
</section>

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

<?php $this->view("footer", $data); ?>
