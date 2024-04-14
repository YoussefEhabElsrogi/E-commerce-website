,<?php require_once './connection/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update | تعديل منتج </title>
  <!-- CSS File -->
  <link rel="stylesheet" href="./css/main.css">
</head>

<body>
  <center>
    <div class="main">
      <form action="./handelers/handelHome.php" method="POST" enctype="multipart/form-data">
        <h2>تعديل المنتجات</h2>
        <input type="text" name="id"><br>
        <input type="text" name='name'><br>
        <input type="text" name='price'><br>
        <input type="file" id="file" name='image' style='display:none;'>
        <label for="file">تحديث صورة للمنتج</label>
        <button name='upload'>تعديل المنتج</button><br><br>
        <a href="products.php">عرض كل المنتجات</a>
      </form>
    </div>
  </center>

</body>

</html>