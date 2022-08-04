<?php
  session_start();
  if ($_SERVER['REQUEST_METHOD']=='POST'){
    $conn = mysqli_connect('localhost', 'root', 'prasad', 'b\'proj\'');

    if(!$conn)
    {
      echo 'Connection Error : ' . mysqli_connect_error();
    }
    $name = $_POST['Name'];
    $username = $_POST['Username'];
    $contactno = $_POST['contactno'];
    $area = $_POST['Area'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    if($confirm!=$password)
      echo "<script>alert('Confirm Password does not match with password')</script>";
    else
    {
    $sql = "SELECT * FROM customers where username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0)
    echo "<script>alert('Username already taken')</script>";
    else
    {
    $pass1=password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT into customers values('$name', '$contactno', '$area', '$pass1', '$username')";
    $result = mysqli_query($conn, $sql);
    $_SESSION["username"] = $username;
    header("Location: customer_home.php");
    }
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap core CSS -->
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <title>Register · CAB</title>
    <!-- Custom styles for this template -->
    <link href="headers.css" rel="stylesheet">
  </head>
  <body>
    <main>
      <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
          <a href="assets/brand/ucab-logo.png" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
           <img src="assets/brand/White Logo.png" width = "50"> 
          </a>
              
          <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0  navbar-light">
            <li><a href="#" class="nav-link px-2 link-dark"></a></li>
            <li><a href="#" class="nav-link px-2 link-secondary"></a></li>
            <li><a href="#" class="nav-link px-2 link-dark"></a></li>
          </ul>
    
        </header>
     </div>
     <div class="container">
      <h1 class="display-6">A new experience awaits.</h1>
      </div>
      <div class="container mt-4 p-4 border">
        <h4>Enter your details to create an account</h4>
          <form method='post'>
          <div class="row mb-3 mt-3">
              <div class="col-md-3">
              <label for="validationDefault01" class="form-label">Name</label>
              <input type="text" class="form-control" name="Name" id="validationDefault01" required>
            </div>
            <div class="col-md-3">
              <label for="validationDefaultUsername" class="form-label">Username</label>
              <div class="input-group">
                <input type="text" class="form-control" name="Username" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" required>
              </div>
            </div>
            <div class="col-md-3">
              <label for="validationDefault03" class="form-label">Contact number </label>
              <div class="input-group">
                <div class="input-group-text" id="btnGroupAddon">+91</div>
                <input type="text" class="form-control" name="contactno" id="validationDefault03" required>
              </div>
            </div>
          </div>
          <div class="row mb-3 mt-3">
                <div class="col-md-3">
              <label for="validationDefault03" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" id="validationDefault03" required>
            </div>
            <div class="col-md-3">
              <label for="validationDefault03" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" name="confirm" id="validationDefault03" required>
            </div>
            <div class="col-md-3">
              <label for="validationDefault05" class="form-label">Area</label>
              <input type="text" class="form-control" name="Area" id="validationDefault05" required>
            </div>
          </div>

      <div class="justify-content-center" tyle="padding-left:10%" >
        <button class="btn btn-primary" type="submit">Register</button>
      </div>
    </form>

      </div>
    </main>
    
    <!-- <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1">@</span>
      <input type="text" class="form-control" placeholder="Please enter your full name" aria-label="Customer name" aria-describedby="basic-addon1">
    </div>
    
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Enter a username" aria-label="Customer's username" aria-describedby="basic-addon2">
      <span class="input-group-text" id="basic-addon2">@example.com</span>
    </div>

    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Your username" aria-label="Your email" aria-describedby="basic-addon2">
    </div>
    
    <label for="basic-url" class="form-label">Your vanity URL</label>
    <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon3">https://example.com/users/</span>    if a nisay---/
      <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
    </div>
    
    <div class="input-group mb-3">
      <span class="input-group-text">$</span>
      <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
      <span class="input-group-text">.00</span>
    </div>
    
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Username" aria-label="Username">
      <span class="input-group-text">!</span>
      <input type="text" class="form-control" placeholder="Password" aria-label="Password">
    </div>
    
    <div class="input-group">
      <span class="input-group-text">With textarea</span>
      <textarea class="form-control" aria-label="With textarea"></textarea>
    </div> -->
      

    <!-- Bootstrap Bundle with Popper--> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>