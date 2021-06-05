<!-- file login html of website -->

<!-- include file header of website -->
<?php $this->view("header", $data); ?>

<section id="form" style="margin-top: 5px">
	<!--form-->
	<div class="container">
		<div class="row">

			<!-- Shơ Validation and check information login -->
			<span style="color:red;text-align: center"> <h3><?php check_error()?></h3></span>

			<div class="login-form col-sm-4 col-sm-offset-4" >
				<!--login form-->
				<h2 style="text-align: center;">Đăng nhập vào tài khoản của bạn</h2>
				<form method="POST">

					<!-- if user login failed, retain information from the last type -->
					<input name="user_email" type="email" value="<?= isset($_POST['user_email']) ? $_POST['user_email'] : '' ?>" 
						placeholder="Email" />
					<input name="user_password" type="password" value="<?= isset($_POST['user_password']) ? $_POST['user_password'] : '' ?>" 
						placeholder="Password" />
					<span>
						<input type="checkbox" class="checkbox">
						Lưu mật khẩu
					</span>
					<button type="submit" class="btn btn-default">Đăn nhập</button>
					<br>
					<a href="<?= ROOT ?>signup">Chưa có tài khoản ? Click để đăng ký</a>
				</form>
			</div>
			<!--/login form-->


		</div>
</section>
<!--/form-->

<!-- include file header of website -->
<?php $this->view("footer"); ?>