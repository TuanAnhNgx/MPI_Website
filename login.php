<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Đăng Nhập</title>

    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">

    <!-- Styles -->
    <link href="css/register.css" rel="stylesheet">
</head>

<body class="bg-primary">

    <div class="unix-login">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="login-content">
                        <div class="login-logo">
                            
                        </div>
                        <div class="login-form">
                            <h1>Đăng Nhập Hệ Thống</h1>
                            <form action="handle/checkLogin.php" method="post">
                                <div class="form-group">
                                    <label style="color: red;"><?php session_start();
                                            if (isset($_SESSION['tb'])) {
                                                echo $_SESSION['tb'];
                                            }  ?></label>
                                </div>
                                <div class="form-group">
                                <label for="username">Tên đăng nhập:</label>
		                        <input type="text" id="user_name" name="user_name"><br>

                                </div>
                                <div class="form-group">
                                <label for="password">Mật khẩu:</label>
		                        <input type="password" id="password" name="password"><br>
                                </div>
                                <input type="submit" value="Đăng Nhập">
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>