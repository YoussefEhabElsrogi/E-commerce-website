<?php session_start(); ?>
<?php require_once './../core/sessions.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login</title>

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
    <form action="./handelers/handelLogin.php" method="post">
      <h3>تسجيل الدخول</h3>

      <?php if (issetSession('errors')): ?>
        <div class="style">
          <?php foreach ($_SESSION['errors'] as $error): ?>
            <div class="error" role="alert">
              <?php echo $error; ?>
            </div>
          <?php endforeach; ?>
        </div>
        <?php removeSession('errors'); endif; ?>
      <input type="email" name="email" placeholder="البريد الالكتروني" class="box">
      <input type="password" name="password" placeholder="كلمة المرور" class="box">
      <input type="submit" name="submit" class="btn" value="تسجيل الدخول">
      <p>هل تريد انشاء حساب جديد؟ <a href="register.php"> حساب جديد</a></p>
    </form>

  </div>

</body>

</html>