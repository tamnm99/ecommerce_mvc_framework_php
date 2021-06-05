<!-- file signup html of website -->

<!-- include file header of website -->

<?php $this->view("header", $data); ?>

<section id="form" style="margin-top: 5px">
    <!--form-->
    <div class="container">
        <div class="row" style="text-align: center;">

            <!--show validation-->
            <span style="color:red">
                <h3><?php check_error() ?></h3>
            </span>

            <div class="col-sm-4 col-sm-offset-4">
                <div class="signup-form">
                    <!--sign up form-->
                    <h2>Đăng ký tài khoản User!</h2>
                    <form method="POST">

                        <!-- if user signup failed, retain information from the last type -->
                        <input name="user_full_name" type="text"
                               value="<?= isset($_POST['user_full_name']) ? $_POST['user_full_name'] : '' ?>"
                               placeholder="Họ và tên"/>
                        <input name="user_email" type="email"
                               value="<?= isset($_POST['user_email']) ? $_POST['user_email'] : '' ?>"
                               placeholder="Địa chỉ Email"/>
                        <input name="user_password" type="password" placeholder=" Password"/>
                        <input name="retype_password" type="password" placeholder=" Nhập lại Password"/>
                        <button type="submit" class="btn btn-default">Đăng Ký</button>

                    </form>
                </div>
                <!--/sign up form-->
            </div>
        </div>
    </div>
</section>
<!--/form-->

<!-- include file header of website -->
<?php $this->view("footer"); ?>