<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>File Upload</title>
    	<link rel="stylesheet" href="css/mainData.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
  </head>
  <body>
    <form action="../uploadExcel/upload.php" method="post" enctype="multipart/form-data">
      <input type="file" name="file">
      <input type="submit" value="Upload">
    </form>
  </body>
</html>


