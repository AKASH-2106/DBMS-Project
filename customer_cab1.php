<?php
session_start();
if ($_SERVER['REQUEST_METHOD']=='POST')
{
  $_SESSION["start1"] = $_POST["ploc"];
  $_SESSION["start"] = $_POST['Source'];
  $_SESSION["stop1"] = $_POST['dloc'];
  $_SESSION["stop"] = $_POST['dest'];
  header("Location: customer_cab2.php");
 }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
            
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

      <title>Hire a Cab · CAB</title>
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
           <p style = "font-size: large;">CAB comprises of a network of drivers operating in nine districts (and more soon) available 24x7. Pick your current district and enter your location to find available drivers.</p>

          <!-- <table class="table">
              <h6>Available vehicles:</h6>
              <thead class="table-primary">
                  <tr>
                   <th>Vehicle Details</th>
                   <th>Type</th>
                   <th>Hwatever</th>
                 </tr>
              </thead>
              <tbody>
                 <tr>
                   <td>Car1</td>
                   <td>SUV</td>
                   <td>PLace1</td>
                 </tr>
                 <tr>
                  <td>Car2</td>
                  <td>Boat</td>
                  <td></td>
                </tr>
                <tr>
                  <td>Car3</td>
                  <td>Plane</td>
                  <td>PLace3</td>
                </tr>
              </tbody>
          </table> -->
        </div>
          <div class="container mt-4 p-4 border">
              <h4>Enter your pick up and drop off locations:</h4>
              <form method="post">
                <div class="row mb-3 mt-3">
                    <div class="col-lg-5">
                        <label for="pick_up">Pick up location:</label>
                        <input type="text" class="form-control" id="plocation" name="ploc" placeholder="Enter the pick up address (20 characters limit)">
                    </div>
                    <div class="col-lg-1">
                        <label for="from_district">District:</label>
                        <select name='Source'>
                        <option class="dropdown-item" value=1>Kodagu</option>
                            <option class="dropdown-item" value=2>Hassan</option>
                            <option class="dropdown-item" value=3>Dakshina Kannada</option>
                            <option class="dropdown-item" value=4>Chikkamangaluru</option>
                            <option class="dropdown-item" value=5>Udupi</option>
                            <option class="dropdown-item" value=6>Shivamogga</option>
                            <option class="dropdown-item" value=7>Davanagere</option>
                            <option class="dropdown-item" value=8>Uttara Kannada</option>
                            <option class="dropdown-item" value=9>Haveri</option>
                        </select>
                  </div>
                                    
                  
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col-lg-5">
                        <label for="drop_off">Drop off location:</label>
                        <input type="text" class="form-control" id="dlocation" name="dloc" placeholder="Enter the drop off address (20 characters limit)">
                    </div>
                    <div class="col-lg-1">
                        <label for="to_district">District:</label>
                        <!-- <div class="dropdown d-grid">
                            <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" id="togglebutton" value="Choose a district">
                            Choose a district
                            </button>
                            <ul class="dropdown-menu ">
                                <li><a class="dropdown-item" href="#" id="toogle1" value="Kodagu" onclick="distr_replace(1)">Kodagu</a></li>
                                <li><a class="dropdown-item" href="#" id="toogle2" onclick="distr_replace(2)">Hassan</a></li>
                                <li><a class="dropdown-item" href="#" id="toogle3" onclick="distr_replace(3)">Dakshina Kannada</a></li>
                                <li><a class="dropdown-item" href="#" id="toogle4" onclick="distr_replace(4)">Chikkamangaluru</a></li>
                                <li><a class="dropdown-item" href="#" id="toogle5" onclick="distr_replace(5)">Udupi</a></li>
                                <li><a class="dropdown-item" href="#" id="toogle6" onclick="distr_replace(6)">Shivamogga</a></li>
                                <li><a class="dropdown-item" href="#" id="toogle7" onclick="distr_replace(7)">Davanagere</a></li>
                                <li><a class="dropdown-item" href="#" id="toogle8" onclick="distr_replace(8)">Uttara Kannada</a></li>
                                <li><a class="dropdown-item" href="#" id="toogle9" onclick="distr_replace(9)">Haveri</a></li>
                            </ul>
                        </div> -->
                        <select name='dest'>
                            <option class="dropdown-item" value=1>Kodagu</option>
                            <option class="dropdown-item" value=2>Hassan</option>
                            <option class="dropdown-item" value=3>Dakshina Kannada</option>
                            <option class="dropdown-item" value=4>Chikkamangaluru</option>
                            <option class="dropdown-item" value=5>Udupi</option>
                            <option class="dropdown-item" value=6>Shivamogga</option>
                            <option class="dropdown-item" value=7>Davanagere</option>
                            <option class="dropdown-item" value=8>Uttara Kannada</option>
                            <option class="dropdown-item" value=9>Haveri</option>
                        </select>
                  </div>
                </div>     
                <div class="row mb-3 mt-3">
                    <div class="col-lg-large-8 ">
                        <button type="submit" class="btn btn-primary" id="view_cabs">Confirm</button>
                      </div>
                </div> 

              </form>
              

          </div>
  
    </main>
        <!-- <script src="assets/dist/js/bootstrap.bundle.min.js"></script> -->
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>