<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Đăng ký tài khoản</title>
	<link href="css/register.css" rel="stylesheet">
</head>
<body>
	<h1>Thay đổi mật khẩu</h1>
	<form action="changepass_process.php" method="post">
	<div class="form-group">
                                    <label style="color: red;"><?php 
                                            if (isset($_SESSION['tbs'])) {
                                                echo $_SESSION['tbs'];
                                            }  ?></label>
                                </div>
    <label for="password">Mật khẩu cũ:</label>
		<input type="password" id="password" name="password" required><br>

		<label for="newpassword">Mật khẩu mới:</label>
		<input type="password" id="newpassword" name="newpassword" required><br>

		<input type="submit" value="Lưu">
	</form>
</body>
</html>
