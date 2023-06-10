<?php

// Check if a file was uploaded
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Check for errors
    if ($file['error'] > 0) {
        echo 'Error: ' . $file['error'] . '<br>';
    }
    else {
        // Move the uploaded file to the desired folder
        move_uploaded_file($file['tmp_name'], '../uploads/' . $file['name']);
        require_once 'importExcel.php';
        echo 'File uploaded successfully<br>';
    }
}

?>