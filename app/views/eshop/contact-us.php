<!-- include file header of website -->
<?php $this->view("header", $data); ?>

<div id="contact-page" class="container">
    <div class="bg">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="title text-center">Liên Hệ <strong>Với Chúng Tôi</strong></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="contact-form">
                    <h2 class="title text-center">Thông Điệp</h2>

                    <?php if (is_array($error) && (count($error) > 0)): ?>
                        <?php foreach ($error as $notification): ?>
                            <div class="alert alert-danger text-center"><?=$notification?></div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if($success): ?>
                        <div class="alert alert-success text-center">Gửi tin nhắn thành công !!!</div>
                    <?php endif; ?>

                    <form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
                        <div class="form-group col-md-6">
                            <label for="client_name">Họ và Tên</label>
                            <input type="text" id="client_name" name="client_name" class="form-control" required
                                   placeholder="VD: Nguyễn Văn A"
                                   value="<?= isset($POST['client_name']) ? $POST['client_name'] : '' ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Địa chỉ Email</label>
                            <input type="email" id="email" name="email" class="form-control" required
                                   placeholder="VD: abc@gmail.com"
                                   value="<?= isset($POST['email']) ? $POST['email'] : '' ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="subject">Chủ Đề</label>
                            <input type="text" id="subject" name="subject" class="form-control" required
                                   placeholder="VD: Hỏi về ..."
                                   value="<?= isset($POST['subject']) ? $POST['subject'] : '' ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="message">Lời Nhắn</label>
                            <textarea name="message" id="message" required class="form-control" rows="8"
                                      placeholder="VD: Nội dung là..."><?= isset($POST['message']) ? $POST['message'] : '' ?></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="submit" class="btn btn-primary pull-right" value="Gửi">
                        </div>
                    </form>
                </div>
            </div>

            <!--Contact Info-->
            <div class="col-sm-4">
                <div class="contact-info">
                    <h2 class="title text-center">Thông Tin Liên Hệ</h2>
                    <address>
                        <p><i class="fas fa-user-tie"></i> <b>Nguyễn Mạnh Tâm</b></p>
                        <p><i class="fa fa-home"></i> <b><?= Setting::dia_chi() ?></b></p>
                        <p><i class="fa fa-phone"></i> <b><?= Setting::so_dien_thoai() ?></b></p>
                        <p><i class="fa fa-envelope"></i> <b><?= Setting::dia_chi_email() ?></b></p>
                    </address>

                    <div class="social-networks">
                        <br>
                        <h2 class="title text-center">Mạng Xã Hội</h2>
                        <ul>
                            <li><a target="_new" href="<?= Setting::duong_dan_facebook() ?>"><i
                                            class="fa fa-facebook"></i></a></li>
                            <li><a target="_new" href="<?= Setting::duong_dan_instagram() ?>"><i
                                            class="fa fa-instagram"></i></a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/#contact-page-->


<!-- include file footer of website -->
<?php $this->view("footer", $data); ?>