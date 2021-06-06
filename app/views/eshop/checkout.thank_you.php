<!--This file is page of Thank you-->

<?php $this->view("header", $data); ?>
<div class="text-center">
    <h1>Cảm ơn Quý Khách đã tin tưởng và lựa chọn chúng tôi !</h1>
    <h2>Đơn Hàng của Quý Khách đang được xử lý</h2>

    <br><br>

    <h3> Quý Khách muốn làm gì tiếp theo ?</h3><br>

    <a href="<?=ROOT?>shop">
        <input type="button" class="btn btn-success" value="Tiếp tục shopping">
    </a>

    <a href="<?=ROOT?>profile">
        <input type="button" class="btn btn-info" value="Xem Đơn Hàng">
    </a>
    <br><br>

</div>
<?php $this->view("footer", $data); ?>
