<?php

require_once './../connection/config.php';
require_once './../core/funtions.php';

$select = "SELECT * FROM `carts`";

$result = mysqli_query($conn, $select);

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
  <title>عربتي | منتجاتي</title>
  <!-- CSS File -->
  <link rel="stylesheet" href="./../css/style.css">
  <!-- Bootstrap File -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    h3 {
      font-family: 'Cairo', sans-serif;
      font-weight: bold;
      margin-top: 20px;
    }

    main {
      width: 40%;
      margin-top: 20px;

    }

    table {
      box-shadow: 2px 2px 10px silver;
    }

    thead {
      background-color: #3498DB;
      color: white;
      text-align: center
    }

    tbody {
      text-align: center;
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

  <?php if (mysqli_num_rows($result) === 0): ?>

    <?php redirectPage('./messagePages/cardMessage.php'); ?>

  <?php else: ?>

    <center>
      <h3>منتجاتك المحجوزة</h3>
    </center>

    <?php while ($row = mysqli_fetch_array($result)): ?>
      <center>
        <main>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Product name</th>
                <th scope="col">Product price</th>
                <th scope="col">Delete Product</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo isset($row['name']) ? $row['name'] : '' ?></td>
                <td><?php echo isset($row['price']) ? $row['price'] : '' ?></td>
                <td><a href="del_card.php?id=<?php echo isset($row['id']) ? $row['id'] : '' ?>"
                    class="btn btn-danger">ازالة</a></td>
              </tr>
            </tbody>
          </table>
        </main>
      </center>
    <?php endwhile; ?>

    <center class="button">
      <a href="shop.php">الرجوع لصفحة المنتجات</a>
    </center>

  <?php endif; ?>
</body>

</html>