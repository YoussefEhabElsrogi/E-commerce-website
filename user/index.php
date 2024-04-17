<?php

require_once './../connection/config.php';
require_once './../core/sessions.php';
require_once './../core/funtions.php';

session_start();

$messages = [];

if (issetSession('user_id')) {
  $user_id = $_SESSION['user_id'];
}

if (!issetValue($user_id)) {

  redirectPage('./login.php');

}

if (isset($_GET['logout'])) {
  unset($user_id);
  session_destroy();
  redirectPage('./login.php');
}

if (issetPostInput('add_to_cart')) {

  foreach ($_POST as $key => $value) {
    $$key = $value;
  }

  $select_cart = "SELECT * FROM `carts` WHERE `name`= '$product_name' AND `user_id` = '$user_id' ";

  $result = mysqli_query($conn, $select_cart);

  if (mysqli_num_rows($result) > 0) {

    $messages[] = 'المنتج أضيف بالفعل إلى عربة التسوق!';

  } else {

    $insert = "INSERT INTO `carts`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity') ";

    $result = mysqli_query($conn, $insert);

    $messages[] = 'المنتج يضاف الى عربة التسوق!';

  }

}

if (issetPostInput('update_cart')) {

  $update_quantity = $_POST['cart_quantity'];

  $update_id = $_POST['cart_id'];

  $update = "UPDATE `carts` SET `quantity` = '$update_quantity' WHERE `id` = '$update_id'  ";

  $result = mysqli_query($conn, $update);

  $message[] = 'تم تحديث كمية سلة التسوق بنجاح!';

}

if (isset($_GET['remove'])) {

  $remove_id = $_GET['remove'];

  $delete = "DELETE FROM `carts` WHERE id = '$remove_id'";

  $result = mysqli_query($conn, $delete);

  redirectPage('./index.php');

}

if (isset($_GET['delete_all'])) {

  $delete = "DELETE FROM `carts` WHERE `user_id` = '$user_id'";

  $result = mysqli_query($conn,$delete);

  redirectPage('./index.php');

}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>عربة التسوق</title>

  <!-- custom css file link  -->
  <link rel="stylesheet" href="css/style.css">

</head>

<body>

  <?php if (issetValue($messages)): ?>
    <?php foreach ($messages as $message): ?>
      <?php echo '<div class="message" onclick="this.remove();">' . $message . '</div>'; ?>
    <?php endforeach; ?>
  <?php endif; ?>

  <div class="container">

    <div class="user-profile">

      <?php

      $select = "SELECT * FROM `users` WHERE id = '$user_id'";

      $result = mysqli_query($conn, $select);

      if (mysqli_num_rows($result) > 0) {
        $fetch_user = mysqli_fetch_assoc($result);
      }

      ?>

      <p>المستخدم الحالي : <span><?php echo $fetch_user['name'] ?></span> </p>
      <div class="flex">
        <a href="index.php?logout=<?php echo $fetch_user['id']; ?>"
          onclick="return confirm('هل أنت متأكد أنك تريد تسجيل الخروج؟');" class="delete-btn">تسجيل الخروج</a>
      </div>

    </div>

    <div class="products">

      <h1 class="heading">أحدث المنتجات</h1>

      <div class="box-container">

        <?php

        $select = "SELECT * FROM `products`";

        $result = mysqli_query($conn, $select);

        if (mysqli_num_rows($result) > 0):

          while ($row = mysqli_fetch_array($result)):

            ?>

            <form method="POST" class="box" action="">
              <img src="./../upload/<?php echo isset($row['image']) ? $row['image'] : '' ?>" width="200">
              <div class="name"><?php echo isset($row['name']) ? $row['name'] : '' ?></div>
              <div class="price"><?php echo isset($row['price']) ? $row['price'] : '' ?></div>
              <input type="number" min="1" name="product_quantity" value="1">
              <input type="hidden" name="product_image"
                value="<?php echo './../upload/' . isset($row['image']) ? $row['image'] : '' ?>">
              <input type="hidden" name="product_name" value="<?php echo isset($row['name']) ? $row['name'] : '' ?>">
              <input type="hidden" name="product_price" value="<?php echo isset($row['price']) ? $row['price'] : '' ?>">
              <input type="submit" value="add to cart" name="add_to_cart" class="btn">
            </form>

          <?php endwhile; ?>

        <?php else: ?>

          <?php redirectPage('./messagePages/productMessage.php') ?>

        <?php endif; ?>

      </div>

    </div>

    <div class="shopping-cart">

      <h1 class="heading"> عربة التسوق</h1>

      <table>
        <thead>
          <th>الصورة</th>
          <th>الاسم</th>
          <th>السعر</th>
          <th>العدد</th>
          <th>السعر الكلي</th>
          <th>العمل</th>
        </thead>
        <tbody>

          <?php

          $cart_query = "SELECT  * FROM `carts` WHERE `user_id` = '$user_id'";

          $result = mysqli_query($conn, $cart_query);

          $grandTotal = 0;

          if (mysqli_num_rows($result) > 0):

            while ($fetch_cart = mysqli_fetch_assoc($result)):


              ?>

              <tr>
                <td><img src="./../upload/<?php echo isset($fetch_cart['image']) ? $fetch_cart['image'] : '' ?>" height="75"
                    alt="logo"></td>
                <td><?php echo isset($fetch_cart['name']) ? $fetch_cart['name'] : ''; ?></td>
                <td><?php echo isset($fetch_cart['price']) ? $fetch_cart['price'] : ''; ?></td>
                <td>
                  <form action="" method="POST">
                    <input type="hidden" name="cart_id"
                      value="<?php echo isset($fetch_cart['id']) ? $fetch_cart['id'] : '' ?>">
                    <input type="number" min="1" name="cart_quantity"
                      value="<?php echo isset($fetch_cart['quantity']) ? $fetch_cart['quantity'] : ''; ?>">
                    <input type="submit" name="update_cart" value="تعديل" class="option-btn">
                  </form>
                </td>
                <td><?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>$</td>
                <td><a href="index.php?remove=<?php echo isset($fetch_cart['id']) ? $fetch_cart['id'] : ''; ?>"
                    class="delete-btn" onclick="return confirm('إزالة العنصر من سلة التسوق؟');">حذف</a></td>
              </tr>

              <?php $grandTotal += $sub_total; ?>

            <?php endwhile; ?>

          <?php else: ?>
            <?php echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">العربة فارغة</td></tr>'; ?>
          <?php endif; ?>

          <tr class="table-bottom">
            <td colspan="4">المبلغ الإجمالي :</td>
            <td><?php echo $grandTotal; ?></td>
            <td><a href="index.php?delete_all" onclick="return confirm('حذف كل المنتجات من العربة?');" class="delete-btn<?php echo ($grandTotal > 1) ? '' : 'disabled' ?>">حذف الكل</a></td>
          </tr>
        </tbody>
      </table>



    </div>

  </div>

</body>

</html>