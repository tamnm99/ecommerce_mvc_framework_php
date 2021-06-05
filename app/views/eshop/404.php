<?php $this->view("header", $data); ?>
<body>
<div class="container text-center">
    <div class="logo-404">
        <a href="<?= ROOT ?>index.html"><img src="<?= ASSETS . THEME ?>images/home/logo.png" alt="" /></a>
    </div>
    <div class="content-404">
        <img src="<?= ASSETS . THEME ?>images/404/404.png" class="img-responsive" alt="" style="max-width: 200px"/>
        <h1><b>OPPS!</b> Không thể tìm thấy trang này !!!</h1>
        <p>Uhm... Có vẻ như trang của bạn không tồn tại.</p>
        <h2><a href="<?= ROOT ?>">Quay lại Trang Chủ</a></h2>
        <br>
        <br>
    </div>
</div>

</body>
<?php $this->view("footer", $data); ?>
