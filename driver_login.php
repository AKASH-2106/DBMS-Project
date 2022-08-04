<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Driver Log In · CAB</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form method="post">
    <img class="mb-4" src="assets/brand/White Logo.png" alt="A customer log in icon" width="144" height="114">
    <h1 class="h3 mb-3 fw-normal">Driver Log In</h1>

    <div class="form-floating">
    <input type="text" class="form-control" name="username" id='floatingInput' placeholder="User">
      <label for="floatingInput">Driver ID</label>
    </div>
    <div class="form-floating">
    <input type="password" class="form-control" name="password" id='floatingPassword' placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <!-- <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div> -->
    <input type = "submit"  class="w-100 btn btn-lg btn-primary" value='Login'>&nbsp;
      <button type = "button" class="w-100 btn btn-lg btn-outline-primary" onclick="document.location='index.html'">Main Page</button>
      <p class="mt-5 mb-3 text-muted">&copy; Database Management Systems Lab Mini-Project, Even Semester 2022</p>    
   
    
  </form>
</main>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
  </body>
</html>
<?php
  session_start();
  if ($_SERVER['REQUEST_METHOD']=='POST'){
    $conn = mysqli_connect('localhost', 'root', 'prasad', 'b\'proj\'');

    if(!$conn)
    {
      echo 'Connection Error : ' . mysqli_connect_error();
    }
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM drivers where Driver_id = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

  $pass = $row['password'];
      if (password_verify($password, $pass))
    {
    $_SESSION["name"] = $username;
    header("Location: driver_home.php");
    }
    else
    {
      echo "<script>alert('Incorrect Password')</script>";
    }
  } else {
  echo "<script>alert('Username not found!!!')</script>";
}
  }
?>