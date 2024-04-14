<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>No Products Available</title>
  <!-- CSS link for page styling -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 mt-5">
        <div class="alert alert-danger" role="alert">
          <h4 class="alert-heading">No Products Available!</h4>
          <p>Sorry, there are currently no products available.</p>
          <hr>
          <p class="mb-0">Please try again later.</p>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

<?php
// Redirect to another page after 5 seconds
header("refresh:5; url=./../index.php");
exit; // Make sure to exit after setting the header to prevent further execution
?>