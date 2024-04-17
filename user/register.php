<?php session_start(); ?>
<?php require_once './../core/sessions.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>register</title>

  <!-- custom css file link  -->
  <link rel="stylesheet" href="css/style.css">
  <style>
    input {
      text-align: center;
    }

    .style {
      margin-bottom: 40px;
    }

    form .error {
      background-color: #ffcccc;
      color: #cc0000;
      padding: 10px;
      margin-bottom: 3px;
      border-radius: 5px;
      font-size: 25px;
      font-family: "Cairo", sans-serif;
    }
  </style>
</head>

<body>
  <div class="form-container">
    <form method="POST" action="./handelers/handelRegister.php">
      <h3>انشاء حساب جديد</h3>

      <?php if (issetSession('errors')): ?>
        <div class="style">
          <?php foreach ($_SESSION['errors'] as $error): ?>
            <div class="error" role="alert">
              <?php echo $error; ?>
            </div>
          <?php endforeach; ?>
        </div>
        <?php removeSession('errors'); endif; ?>

      <input type="text" name="name" required placeholder="اسم السمتخدم" class="box">
      <input type="email" name="email" required placeholder="البريد الالكتروني" class="box">
      <input type="password" name="password" required placeholder="كلمة المرور" class="box">
      <input type="submit" name="submit" class="btn" value="تسجيل حساب">
      <p>هل لديك حساب؟ <a href="login.php"> تسجيل دخول</a></p>
    </form>

  </div>

</body>

</html>