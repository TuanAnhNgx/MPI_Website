<?php
require_once("../handle/connect.php");
include '../PHPExcel/Classes/PHPExcel/IOFactory.php';
if (isset($_FILES['file'])) {
    if ($_FILES['file']['error'] > 0) {
        echo 'file upload bị lỗi';
    } else {
        move_uploaded_file($_FILES['file']['tmp_name'], '../updata/' . $_FILES['file']['name']);
        $tenfile = $_FILES['file']['name'];

        $inputFileName = '../updata/' . $_FILES['file']['name'];
        //  Tiến hành đọc file excel
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Lỗi không thể đọc file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        //  Lấy thông tin cơ bản của file excel

        // Lấy sheet hiện tại
        $sheet = $objPHPExcel->getSheet(0);

        // Lấy tổng số dòng của file, trong trường hợp này là 6 dòng
        $highestRow = $sheet->getHighestRow();

        // Lấy tổng số cột của file, trong trường hợp này là 4 dòng
        $highestColumn = $sheet->getHighestColumn();

        // Khai báo mảng $rowData chứa dữ liệu

        //  Thực hiện việc lặp qua từng dòng của file, để lấy thông tin
        for ($row = 1; $row <= $highestRow; $row++) {
            // Lấy dữ liệu từng dòng và đưa vào mảng $rowData
            $rowData[] = $sheet->rangeToArray('B' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
        }
        date_default_timezone_set('Asia/Saigon');
        $thoigian = date("Y-m-d H:i:s");

        $stt = 0;
        $cum_row = floor($highestRow / 11);
        for ($i = 0; $i < $highestRow + $cum_row; $i += $cum_row) {
            $stt++;
            $cum = $stt;
            if ($i > $highestRow) {
                break;
            } else {
                if ($i == 0) {
                    $i = 1;
                }
            }

            for ($s = $i; $s <= $stt * $cum_row; $s++) {

                foreach ($rowData[$s] as $data) {
                    $sql = "INSERT INTO dataDN
             (mst
             ,ten_dn
             ,sdt
             ,dia_chi
             ,email
             ,ng_daidien
             ,chuc_vu
             ,cccd
             ,von_dl
             ,ngay_tl) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    // if($stt>11){
                    //     $cum = 11;
                    // }

                    $params = array("$data[0]", "$data[1]", "$data[2]", "$data[3]", "$data[4]", "$data[5]", "$cum", "$data[7]", "$data[8]", "$data[9]");
                    $stmt = sqlsrv_query($conn, $sql, $params);
                    if ($stmt == false) {
                        die(print_r(sqlsrv_errors(), true));
                    }
                    
                }
            }

            
        }
    }
}
