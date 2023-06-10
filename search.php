<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header("location: page-login.php");
}

include('handle/connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manager--Data</title>
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
    <link href="css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
    <link href="css/lib/chartist/chartist.min.css" rel="stylesheet">
    <link href="css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="css/lib/themify-icons.css" rel="stylesheet">
    <link href="css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="css/lib/weather-icons.css" rel="stylesheet" />
    <link href="css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="css/lib/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
          .tbl {
  width: 100%;
  border-collapse: collapse;
}

.tbl th, .tbl td {
  padding: 10px;
  border: 1px solid #ff0000;
}

.tbl tr:hover {
  background-color: #fbd4d4;
}
#myBtn {
  display: none; /* Ẩn nút ban đầu */
  position: fixed; /* Nút di chuyển cố định */
  bottom: 20px; /* Khoảng cách từ nút đến bottom của trình duyệt */
right: 30px; /* Khoảng cách từ nút đến right của trình duyệt */
z-index: 99; /* Hiển thị trên các phần tử khác */
border: none; /* Không có đường viền */
outline: none; /* Không có đường viền nổi */
background-color: #555; /* Màu nền của nút */
color: white; /* Màu chữ của nút */
cursor: pointer; /* Thay đổi con trỏ chuột khi di chuột qua nút */
padding: 15px; /* Kích thước nút */
border-radius: 10px; /* Bo tròn góc của nút */
font-size: 18px; /* Cỡ chữ của nút */
}

#myBtn:hover {
background-color: black; /* Màu nền của nút khi di chuột qua */
}
    </style>
</head>

<body>
<button onclick="topFunction()" id="myBtn" title="Go to top">Back to Top</button>
<script>
  // Khi người dùng cuộn xuống 20px từ đầu trang, hiển thị nút
  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
      document.getElementById("myBtn").style.display = "block";
    } else {
      document.getElementById("myBtn").style.display = "none";
    }
  }

  // Khi người dùng nhấp vào nút, cuộn lên đầu trang
  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
</script>
    <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <ul>
                <div class="logo"><a href="User.php">
                            <span>Xin chào <?php if (isset($_SESSION['user_name'])) {
                                                                echo $_SESSION['user_name'];
                                                            } ?></span>
                        </a></div>
                            
                    <li class="label">Main</li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-home"></i> Data <span class="badge badge-primary"></span> <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                        <div class="col-6 mx-auto">
                            <?php
                                   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                    $startDate = $_POST['startDate'];
                                    $endDate = $_POST['endDate'];
                                    $tax_code = $_POST['tax_code'];
                                    $query = http_build_query(array('startDate' => $startDate, 'endDate' => $endDate));
                                    if (!empty($_POST['tax_code'])) {
                                        $tax_code = $_POST['tax_code'];
                                        $query = http_build_query(array('tax_code' => $tax_code));
                                    }
                                    $url = "search.php?" . $query;
                                    header('Location: ' . $url);
                                    exit();
                                }
                                
                                      
                                    ?>

                                    <form method="post" action = "search.php">
                                    <label for="startDate">Từ ngày:</label>
                                    <input type="date" name="startDate" id="startDate">

                                    <label for="endDate">Đến ngày:</label>
                                    <input type="date" name="endDate" id="endDate">
                                    <input type="text" id="tax_code" name="tax_code" placeholder = "Nhập mã số thuế">
                                    <button type="submit" class= "btn btn-success">Tìm kiếm</button>
                                    </form>



                            </div>
                        </ul>

                        <li><a class="sidebar-sub-toggle"><i class="ti-lock"></i> Account <span class="badge badge-primary"></span> <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                              <ul>
                              <div class="dropdown-content-body">
                                        <ul>
                                            <li>
                                                <a href="User.php">
                                                    <i class="ti-user"></i>
                                                    <span>Profile</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a onclick="window.location='handle/checkLogout.php';" href="handle/checkLogout.php">
                                                    <i class="ti-power-off"></i>
                                                    <span>Logout</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                              </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /# sidebar -->

    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-left">
                        <div class="hamburger sidebar-toggle">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                    </div>
                  
                            <div class="col-6 mx-auto">
                            <?php
                                   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                    $startDate = $_POST['startDate'];
                                    $endDate = $_POST['endDate'];
                                    $tax_code = $_POST['tax_code'];
                                    $query = http_build_query(array('startDate' => $startDate, 'endDate' => $endDate));
                                    if (!empty($_POST['tax_code'])) {
                                        $tax_code = $_POST['tax_code'];
                                        $query = http_build_query(array('tax_code' => $tax_code));
                                    }
                                    $url = "search.php?" . $query;
                                    header('Location: ' . $url);
                                    exit();
                                }
                                
                                      
                                    ?>

                                    <form method="post">
                                    <label for="startDate">Từ ngày:</label>
                                    <input type="date" name="startDate" id="startDate">

                                    <label for="endDate">Đến ngày:</label>
                                    <input type="date" name="endDate" id="endDate">
                                    <input type="text" id="tax_code" name="tax_code" placeholder = "Nhập mã số thuế">
                                    <button type="submit" class= "btn btn-success">Tìm kiếm</button>
                                    </form>



                            </div>
                       
                    <div class="float-right">
                        <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                                <span class="user-avatar"><?php if (isset($_SESSION['user_name'])) {
                                                                echo $_SESSION['user_name'];
                                                            } ?>
                                    <i class="ti-angle-down f-s-10"></i>
                                </span>
                                <div class="drop-down dropdown-profile dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-content-body">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <i class="ti-user"></i>
                                                    <span>Profile</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a onclick="window.location='handle/checkLogout.php';" href="handle/checkLogout.php">
                                                    <i class="ti-power-off"></i>
                                                    <span>Logout</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Hello, <span>Welcome Here</span></h1>
                                <!--Thêm tính năng lọc ngày-->
                                
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><button type="submit"><a href="export/export.php">Export</a></button></a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                
<section id="main-content">
                    <div class="row">
                        <table class="table table-bordered table-responsive-sm">
                            <thead>
                                <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Mã số thuế</th>
                                <th scope="col">Tên Doanh nghiệp</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Địa chỉ công ty</th>
                                <th scope="col">Email</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                $cum = $_SESSION['id_user'];
                                if (!empty($_GET['tax_code'])) {
                                    $tax_code = $_GET['tax_code'];
                                    $sql = "SELECT * FROM [DataDN].[dbo].[mainData] WHERE mst = '$tax_code'";
                                }
                                else{
                                    $start_date = $_GET['startDate'];
                                    $end_date = $_GET['endDate'];
                                    $sql = "SELECT * FROM [DataDN].[dbo].[mainData] WHERE ngayThanhLap BETWEEN '$start_date' AND '$end_date'";
                                }
                                // $sql = "SELECT * FROM [sales].[dbo].[data] WHERE cum = '$cum' and YEAR( system_date ) = '2022' and MONTH ( system_date ) = '7' and DAY  ( system_date )  = '5'";
                                $resuld = sqlsrv_query($conn, $sql);
                                while ($row = sqlsrv_fetch_array($resuld, SQLSRV_FETCH_NUMERIC)) {
                                    $i++;
                                ?>
                                    <tr>
                                    <th><?php echo $i; ?></th>
                                    
                                    <td data-toggle="tooltip" title="<?php echo $row[0]; ?>"><?php echo substr($row[0], 0, 14); ?></td>
                                        <td data-toggle="tooltip" title="<?php echo $row[1]; ?>"><?php echo substr($row[1], 0, 40); ?></td>
                                        <td data-toggle="tooltip" title="<?php echo $row[2]; ?>"><?php echo substr($row[2], 0, 40); ?></td>
                                        <td data-toggle="tooltip" title="<?php echo $row[3]; ?>"><?php echo substr($row[3], 0, 40); ?></td>
                                        <td data-toggle="tooltip" title="<?php echo $row[4]; ?>"><?php echo substr($row[4], 0, 40); ?></td>
 

                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- jquery vendor -->
    <script src="js/lib/jquery.min.js"></script>
    <script src="js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="js/lib/menubar/sidebar.js"></script>
    <script src="js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->

    <script src="js/lib/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <!-- bootstrap -->
    <!-- scripit init-->
    <script src="js/dashboard2.js"></script>
    <script>
        function uploadFileData() {
            var form_data = new FormData();
            form_data.append('file', $('#ip_file').prop('files')[0]);
            $.ajax({
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                url: "handle/upData.php",
                data: form_data,
                success: function(response) {
                    alert(response);
                    $("#main-content").html(response);
                }
            });
        }
    </script>
</body>

</html>