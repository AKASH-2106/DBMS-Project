<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
            
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

      <title>Confirm Driver · CAB</title>
      <!-- Bootstrap core CSS -->
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
      <link href="headers.css" rel="stylesheet">            
    </head>
  <body>
     <main>
        <div class="container">
            <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
              <a href="assets/brand/White Logo.png" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
               <img src="assets/brand/White Logo.png" width = "50"> 
              </a>
              <!-- <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg> -->
                
        
              <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0  navbar-light">
                <li><a href="customer_home.php" class="nav-link px-2 link-dark">Home</a></li>
                <li><a href="customer_cab1.php" class="nav-link px-2 link-secondary">Hire a cab</a></li>
                <li><a href="customer_rent_car.php" class="nav-link px-2 link-dark">Rent a car</a></li>
              </ul>
        
              <div class="col-md-3 text-end">
                <button type="button" onclick="document.location='cust_profile.php'" class="btn btn-primary">Profile</button>
                <button type="button" onclick="document.location='customer_login.php'" class="btn btn-outline-primary me-2">Log out</button>
              </div>
            </header>
        </div>
        <div class="container">
            <h1 class="display-6">Get a cab in just a few taps.</h1>
           <p style = "font-size: large;">CAB comprises of a network of drivers operating in eight districts (and more soon) available 24x7. Pick your current district and enter your location to find available drivers.</p>

        </div>
          <div class="container mt-4 p-4 border">
            <table class="table">
                <h6>Available drivers:</h6>
                <?php
  {
    $conn = mysqli_connect('localhost', 'root', 'prasad', 'b\'proj\'');

    if(!$conn)
    {
      echo 'Connection Error : ' . mysqli_connect_error();
    }
    $start=$_SESSION["start"];
    $sql = "SELECT * FROM drivers where Booked = 'N' AND area=$start";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0)  {
            
        print "
        <table border=\"5\" cellpadding=\"5\" cellspacing=\"0\" style=\"border-  collapse: collapse\" width=\"100&#37;\"    id=\"AutoNumber2\" bgcolor=\"#FFFFFF\">
         <tr>
        <td width=100>Driver ID:</td> 
        <td width=100>Name</td> 
        <td width=100>Age</td> 
        <td width=100>Experience</td> 
        <td width=100>Vehicle Model</td> 
        <td width=100>Price per Unit Distance</td> 
        </tr>";       
        while($row = $result->fetch_assoc())
        {
            print "<tr>"; 
            print "<td>" . $row['Driver_id'] . "</td>";
            print "<td>" . $row['Name'] . "</td>"; 
            print "<td>" . $row['Age'] . "</td>"; 
            print "<td>" . $row['Experience'] . "</td>";
            print "<td>" . $row['vehicle_model'] . "</td>"; 
            print "<td>" . $row['Base_charge'] . "</td>";
            print "</tr>"; 
        }
        print "</table>";
    } else {
  echo "No drivers available now";
}
  }
?>
              <h4>Select a cab:</h4>
              <form method='post'>
                <div class="row mb-3 mt-3">
                    <div class="col-lg-6">
                        <label for="no_of_days">Driver ID:</label>
                        <input type="text" class="form-control" id="location" name="loc" placeholder="Enter the preferred driver ID">
                    </div>
                  <div class="col-lg d-grid">
                      <label class="text-white">jhgjhhhjh Ignore this</label>
                        <button type="submit" onclick="document.location='customer_cab3.html'" class="btn btn-primary" id="view_cabs">Confirm</button>
                    </div>
                  
                </div>
                            

              </form>
              

          </div>
  
    </main>
        <!-- <script src="assets/dist/js/bootstrap.bundle.min.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>


<?php
  if ($_SERVER['REQUEST_METHOD']=='POST'){
    $conn = mysqli_connect('localhost', 'root', 'prasad', 'b\'proj\'');

    if(!$conn)
    {
      echo 'Connection Error : ' . mysqli_connect_error();
    }

    $driver_id = $_POST['loc'];
    $sql = "SELECT Base_charge from drivers where Driver_id='$driver_id' AND Booked='N' AND area=$start";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0)
        echo "<script>alert('Driver ID not found')</script>";
    else
    {
    $stop=$_SESSION["stop"];
    $row = $result->fetch_assoc();
    $price=$row['Base_charge']*(abs($stop-$start)+1);

    $sql = "SELECT max(book_id) from history";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    $book_id=$row['max(book_id)']+1;

    $username = $_SESSION['username'];

    $sql = "UPDATE drivers set Booked='Y' WHERE Driver_id=$driver_id";
    $result = mysqli_query($conn, $sql);

    $sql = "UPDATE drivers set area=$stop WHERE Driver_id=$driver_id";
    $result = mysqli_query($conn, $sql);

    $sql = "SELECT SYSDATE()";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    $tdate=$row['SYSDATE()'];

    $start1=$_SESSION["start1"];
    $stop1=$_SESSION["stop1"];

    $sql = "INSERT into history values($book_id, '$username', $driver_id, '$start1', '$stop1', '$tdate', NULL, $price)";
    $result = mysqli_query($conn, $sql);
    echo "<script>alert('Success, you may check the transaction details in your home page. The driver will reach the given location shortly')</script>";
    }
}
?>