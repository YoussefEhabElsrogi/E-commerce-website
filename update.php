<?php require_once './connection/config.php'; ?>
<?php require_once './inc/funtions.php'; ?>
<?php require_once './inc/sessions.php'; ?>

<?php session_start(); ?>

<?php

  $id = $_GET['id'];

  $select = "SELECT * FROM `products` WHERE `id` = $id";

  $result = mysqli_query($conn, $select);

  $row = mysqli_fetch_array($result);

?>  

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
      <form action="./handelers/handelUpdate.php" method="POST" enctype="multipart/form-data">
        <h2>تعديل المنتجات</h2>
        <?php if (issetSession('errors')): ?>
          <div class="style">
            <?php foreach ($_SESSION['errors'] as $error): ?>
              <div class="error" role="alert">
                <?php echo $error; ?>
              </div>
            <?php endforeach; ?>
          </div>
          <?php removeSession('errors'); endif; ?>

        <?php if (issetSession('success')): ?>
          <div class="style">
            <div class="success" role="alert">
              <?php echo $_SESSION['success']; ?>
            </div>
          </div>
          <?php removeSession('success'); endif; ?>
        <input type="text" name="id" value="<?php echo isset($row['id']) ? $row['id'] : '' ?>" disabled><br>
        <input type="text" name='name' value="<?php echo isset($row['name']) ? $row['name'] : '' ?>"><br>
        <input type="text" name='price' value="<?php echo isset($row['price']) ? $row['price'] : '' ?>"><br>
        <input type="file" id="file" name='image' style='display:none;'>
        <label for="file">تحديث صورة للمنتج</label>
        <button name='update'>تعديل المنتج</button><br><br>
        <a href="products.php">عرض كل المنتجات</a>
      </form>
    </div>
  </center>

</body>

</html>