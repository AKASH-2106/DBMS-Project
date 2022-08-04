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

      <title>Rent a Car · CAB</title>
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
                <li><a href="customer_cab1.php" class="nav-link px-2 link-dark">Hire a cab</a></li>
                <li><a href="customer_rent_car.php" class="nav-link px-2 link-secondary">Rent a car</a></li>
              </ul>
        
              <div class="col-md-3 text-end">
                <button type="button"  onclick="document.location='cust_profile.php'" class="btn btn-primary">Profile</button>
                <button type="button" onclick="document.location='customer_login.php'" class="btn btn-outline-primary me-2">Log out</button>
              </div>
            </header>
        </div>
        <div class="container">
            <h1 class="display-6">Fancy some DIY commuting?</h1>
           <p style = "font-size: large;">With CAB, you can rent out a car from among our wide vareity of choices- just choose a vehicle ID from the table below and enter the duration of the rental.</p>

              <h6>Available vehicles:</h6>
                <?php
                $conn = mysqli_connect('localhost', 'root', 'prasad', 'b\'proj\'');
                if(!$conn)
                {
                  echo 'Connection Error : ' . mysqli_connect_error();
                }
                $sql = "SELECT * FROM vehicles where Booked='N'";
                $result = mysqli_query($conn, $sql);
            
                if (mysqli_num_rows($result) > 0)  {

                print "
        <table border=\"5\" cellpadding=\"5\" cellspacing=\"0\" style=\"border-  collapse: collapse\" width=\"100&#37;\"    id=\"AutoNumber2\" bgcolor=\"#FFFFFF\">
         <tr>
         <td width=100>Vehicle ID</td> 
        <td width=100>Company</td> 
        <td width=100>Model</td> 
        <td width=100>Year</td> 
        <td width=100>Colour</td>
        <td width=100>Rate per Day</td>  
        </tr>";       
        while($row = $result->fetch_assoc())
        {
            print "<tr>"; 
            print "<td>" . $row['vehicle_id'] . "</td>"; 
            print "<td>" . $row['company'] . "</td>"; 
            print "<td>" . $row['Model'] . "</td>"; 
            print "<td>" . $row['year'] . "</td>";
            print "<td>" . $row['colour'] . "</td>";
            print "<td>" . $row['Base_fare'] . "</td>";
            print "</tr>"; 
        }
        print "</table>";
    }
               else {
              echo "No vehicles available";
            }
              ?>
              </tbody>
          </table>
        </div>
          <div class="container mt-4 p-4 border">
              <h4>Enter the details to book a car:</h4>
              <form method="post">
                <div class="row mb-3 mt-3">
                  <div class="col">
                    <label for="vehicleid">Vehicle ID:</label>
                    <input type="text" class="form-control" id="vid" name="v_id" placeholder="Enter the ID of your preferred vehicle from the above list">
                  </div>
                  <div class="col">
                    <label for="no_of_days">Booking duration:</label>
                    <input type="text" class="form-control" id="n_o_days" name="nod" placeholder="Enter duration in days. Prices will be calculated accordingly">
                  </div>
                </div>
                <div class="d-grid col-xl-4 mx-auto">
                  <button type="submit" class="btn btn-primary btn-lg" id="booking">Book</button>
                </div>

              </form>
          </div>
  
    </main>
        <!-- <script>
          document.getElementById("booking").onclick = function() {success()};
          function success() 
          {
            getElementById("success_alert").class.toggle("show");
          }
        </script> -->
        <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
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

    $vehicle_id = $_POST['v_id'];
    $sql = "SELECT Base_fare from vehicles where vehicle_id='$vehicle_id' AND Booked='N'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0)
        echo "<script>alert('Vehicle ID not found')</script>";
    else
    {
    $row = $result->fetch_assoc();
    $nod = $_POST['nod'];
    $price=$row['Base_fare']*$nod;

    $sql = "SELECT max(book_id) from rent_history";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    $book_id=$row['max(book_id)']+1;

    $username = $_SESSION['username'];

    $sql = "UPDATE vehicles set Booked='Y' WHERE vehicle_id=$vehicle_id";
    $result = mysqli_query($conn, $sql);

    $sql = "SELECT CURDATE()";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    $tdate=$row['CURDATE()'];

    $sql = "SELECT DATE_ADD(CURDATE(), INTERVAL $nod DAY) AS fdate";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    $fdate=$row['fdate'];

    $sql = "INSERT into rent_history values($book_id, '$username', $vehicle_id, '$tdate', '$fdate', $price)";
    $result = mysqli_query($conn, $sql);
    echo "<script>alert('Success, your vehicle has been booked, collect your vehicle at our address by paying Rupees $price!!!')</script>";
    }
}
?>