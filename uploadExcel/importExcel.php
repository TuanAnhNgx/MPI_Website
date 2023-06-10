<?php

// Load the PHPExcel library
require_once '../PHPExcel/Classes/PHPExcel.php';

// Connect to the MySQL database
include ('../handle/connect.php');

// Check if a file was uploaded
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Check for errors
    if ($file['error'] > 0) {
        echo 'Error: ' . $file['error'] . '<br>';
    }
    else {
        $a = 0;
        // Move the uploaded file to the desired folder
        $target_file = '../uploads/' . $file['name'];
        move_uploaded_file($file['tmp_name'], $target_file);

        // Load the uploaded Excel file
        $objPHPExcel = PHPExcel_IOFactory::load($target_file);

        // Get the first worksheet
        $sheet = $objPHPExcel->getSheet(0);

        // Loop through the rows of the worksheet
        for ($row = 2; $row <= $sheet->getHighestRow(); $row++) {
            // Get the values from the current row
            $SOTBMT = $sheet->getCellByColumnAndRow(0, $row)->getValue();
            $THOIDIEMDANGTAI = $sheet->getCellByColumnAndRow(1, $row)->getValue();
            $SOHIEUKHLCNT = $sheet->getCellByColumnAndRow(2, $row)->getValue();
            $TENKHLCNT = $sheet->getCellByColumnAndRow(3, $row)->getValue();
            $LINHVUC = $sheet->getCellByColumnAndRow(4, $row)->getValue();
            $BENMOITHAU = $sheet->getCellByColumnAndRow(5, $row)->getValue();
            $TENGOITHAU = $sheet->getCellByColumnAndRow(6, $row)->getValue();
            $PHANLOAI = $sheet->getCellByColumnAndRow(7, $row)->getValue();
            $TENDUTOANMUASAM = $sheet->getCellByColumnAndRow(8, $row)->getValue();
            $CHITIETNGUONVON = $sheet->getCellByColumnAndRow(9, $row)->getValue();
            $LOAIHOPDONG = $sheet->getCellByColumnAndRow(10, $row)->getValue();
            $HINHTHUCLCNT = $sheet->getCellByColumnAndRow(11, $row)->getValue();
            $PHUONGTHUCLCNT = $sheet->getCellByColumnAndRow(12, $row)->getValue();
            $THOIGIANTHUCHIENHOPDONG = $sheet->getCellByColumnAndRow(13, $row)->getValue();
            $THOIGIANDONGTHAU = $sheet->getCellByColumnAndRow(14, $row)->getValue();
            $DIADIEMTHUCHIENGOITHAU = $sheet->getCellByColumnAndRow(15, $row)->getValue();
            $DIADIEMMOTHAU = $sheet->getCellByColumnAndRow(16, $row)->getValue();
            $SOTIENBAODAMDUTHAU = $sheet->getCellByColumnAndRow(17, $row)->getValue();
            $HINHTHUCBAODAM = $sheet->getCellByColumnAndRow(18, $row)->getValue();
            
                // Insert the values into the database
                $sql = "INSERT INTO TBMT VALUES("."N"."'".$SOTBMT."', N'".$THOIDIEMDANGTAI."', N'".$SOHIEUKHLCNT."', N'".$TENKHLCNT."', N'".$LINHVUC."', N'".$BENMOITHAU."', N'".$TENGOITHAU."', N'".$PHANLOAI."', N'".$TENDUTOANMUASAM."', N'".$CHITIETNGUONVON."', N'".$LOAIHOPDONG."', N'".$HINHTHUCLCNT."', N'".$PHUONGTHUCLCNT."', N'".$THOIGIANTHUCHIENHOPDONG."', N'".$THOIGIANDONGTHAU."', N'".$DIADIEMTHUCHIENGOITHAU."', N'".$DIADIEMMOTHAU."', N'".$SOTIENBAODAMDUTHAU."', N'".$HINHTHUCBAODAM."')";

                $stmt = sqlsrv_query($conn, $sql);
                if (sqlsrv_has_rows($stmt) == true) {
                    echo "$MST done.\n";
                }
               
                $a++;
        }

        echo "Đã cập nhật $a vào database";
    }
}

?>
