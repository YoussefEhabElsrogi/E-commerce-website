<?php require_once './../connection/config.php'; ?>
<?php require_once './../core/funtions.php'; ?>
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
  <title>Products | المنتجات</title>
  <!-- CSS File -->
  <link rel="stylesheet" href="./../css/style.css">
  <!-- Bootstrap File -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    #aa {
      margin-left: 70px;
      text-decoration: none;
      color: white;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-dark bg-dark">
    <a id="aa" class="navbar-barand" href="card.php">MYCard | عربتي</a>
  </nav>

  <center>
    <h3 class="title_page">المنتجات المتوفرة</h3>
  </center>


  <?php

  $select = "SELECT * FROM `products`";
  $result = mysqli_query($conn, $select);

  if (mysqli_num_rows($result) === 0):

    redirectPage('./messagePages/cardMessage.php');

    ?>

  <?php else:

    //  Start while loop products 
    while ($row = mysqli_fetch_array($result)):

      ?>

      <center>
        <main>
          <div class="card" style="width: 18rem;">
            <img src="<?php echo isset($row['image']) ? './../upload/' . $row['image'] : '' ?>" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title"><?php echo isset($row['name']) ? $row['name'] : '' ?></h5>
              <p class="card-text"><?php echo isset($row['price']) ? $row['price'] : '' ?></p>
              <a href="val.php?id=<?php echo isset($row['id']) ? $row['id'] : '' ?>" class="btn btn-success">اضافة المنتج
                لعربة التسوق</a>
            </div>
          </div>
        </main>
      </center>

      <!-- End while loop products -->
    <?php endwhile; ?>

  <?php endif; ?>

</body>

</html>