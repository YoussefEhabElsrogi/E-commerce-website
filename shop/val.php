<?php

require_once './../connection/config.php';
require_once './../core/funtions.php';

$id = $_GET['id'];

$select = "SELECT * FROM `products` WHERE `id` = $id";

$result = mysqli_query($conn, $select);

$data = mysqli_fetch_array($result);

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
  <title>تاكيد شراء المنتج</title>
  <!-- CSS File -->
  <link rel="stylesheet" href="./../css/style.css">
  <!-- Bootstrap File -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    input {
      display: none;
    }

    .main {
      width: 30%;
      padding: 20px;
      box-shadow: 2px 2px 10px silver;
      margin-top: 50px;
    }

    button {
      margin-top: 20px;
      font-weight: bold;
      font-family: 'Cairo', sans-serif;
    }

    .button {
      margin-top: 20px;
    }

    .button a {
      text-decoration: none;
      font-size: 20px;
      font-weight: bold;
      font-family: 'Cairo', sans-serif;
    }
  </style>
</head>

<body>
  <center>
    <div class="main">
      <form action="insert_card.php" method="POST">
        <h2>هل تريد شراء المنتج</h2>
        <input type="text" name="id" value="<?php echo isset($data['id']) ? $data['id'] : '' ?>">
        <input class="card-title" name="name" value="<?php echo isset($data['name']) ? $data['name'] : '' ?>"></input>
        <input class="card-text" name="price" value="<?php echo isset($data['price']) ? $data['price'] : '' ?>"></input>
        <button name="add" type="submit" class="btn btn-warning">تاكيد اضافة المنتج للعربة</button>
        <br>
        <div class="button">
          <a href="shop.php">الرجوع لصفحة المنتجات</a>
        </div>
      </form>
    </div>
  </center>
</body>

</html>