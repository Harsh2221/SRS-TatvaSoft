<?php
session_start();
$email = $_SESSION['username'];
$base = "https://localhost/tatvasoft/Helperland_MVC/";
if(!isset($_SESSION['username'])){
  header('Location:' . $base);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin|User management</title>
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./assets/css/admin_user.css" />
  <link href="./assets/css/jquery.dataTables.min.css" rel="stylesheet" />
</head>

<body>
<?php
  include('adminNavbar.php');  
  ?>

  <section class="main-content">
    <div class="wrapper">

      <nav id="sidebar">


        <ul class="list-unstyled components">


          <li>
            <a href="adminServiceRequest.php">Service Requests</a>
          </li>

          <li>
            <a class="link-active" href="adminUser.php">User Management</a>
          </li>




        </ul>
      </nav>


      <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid upper-btn">
            <a id="sidebarCollapse" class="btn">

              <span> <img src="./assets/assets/vector-smart-object-copy.png" alt=""></span>

            </a>
            <h6>User Management</h6>
          </div>
          <div class="add-user">
            <button id="adduser-btn"><img src="./assets/assets/add.png" alt="#"> Add New User</button>

          </div>
        </nav>

        <div class="user-form">
          <div class="row gx-3 gy-2 align-items-center">
            <div class="col-sm-2">
              <select class="form-select" id="selUser">
                <option selected disabled="disabled">Username</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="userRole">
                <option selected disabled="disabled">User role</option>
                <option value="0">Customer</option>
                <option value="1">Service provider</option>
                <option value="2">Admin</option>
              </select>
            </div> 
 
            <div class="col-sm-3">
              <label class="visually-hidden">Phone number</label>
              <div class="input-group">
                <div class="input-group-text">+49</div>
                <input type="number" class="form-control" id="phonenum" placeholder="Phone Number">
              </div>
            </div>
            <div class="col-sm-2">
              <input type="number" class="form-control" id="postal" placeholder="Zipcode">
            </div>
            
            <div class="col-sm-2 s-btn">
              <button type="submit" class="btn" id="searchbtn">Search</button>
            </div>

            <div class="col-sm-1 c-btn">
              <button type="reset" class="btn" id="resetbtn">Clear</button>
            </div>




          </div>

        </div>
        <div class="export">
            <button id="export-btn" class="expBtn">Export</button>

          </div>

        <div class="user-table">
          <table class="table" id="myTable">
            <thead>
              <tr>
                <th scope="col">
                  User Name
                  <span><img src="./assets/assets/sort.png" alt="#" /></span>
                </th>
                
                <th scope="col">
                  Role
                </th>
                <th scope="col">
                  Registration Date
                </th>
                <th scope="col">
                  User Type
                </th>
                <th scope="col">
                  Phone
                  </th>
                 
                <th scope="col">
                  Postal Code
                </th>
                <th scope="col">Status</th>
                
                <th scope="col">
                  Action
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td scope="row">
                  Lyum Watson
                </td>
                <td>
                  Call Center
                </td>
                <td>1/2/2022</td>
                <td>Inquiry Manager</td>
                
                <td>1234567890</td>
                <td>123456</td>
                <td><span id="active-status">Active</span></td>
                <td>
                  <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <span><img src="./assets/assets/group-38.png" alt="" /></span>

                  </a>

                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Edit</a></li>
                    <li><a class="dropdown-item" href="#">Deactivate</a></li>

                  </ul>
                </td>
              </tr>



              <tr>
              <td scope="row">
                  Lyum Watson
                </td>
                <td>
                  Call Center
                </td>
                <td>1/2/2022</td>
                <td>Inquiry Manager</td>
                
                <td>1234567890</td>
                <td>123456</td>
                <td><span id="inactive-status">Inactive</span></td>
                <td>
                  <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <span><img src="./assets/assets/group-38.png" alt="" /></span>

                  </a>

                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Edit</a></li>
                    <li><a class="dropdown-item" href="#">Deactivate</a></li>
                    <li><a class="dropdown-item" href="#">Service History</a></li>
                  </ul>
                </td>
              </tr>





            </tbody>
          </table>

        </div>

      </div>

  </section>



  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
    

  <script src="./assets/js/admin.js"></script>

  <script src="./assets/js/jquery.js"></script>
  <script src="./assets/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/table2csv@1.1.6/src/table2csv.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <?php
  include('adminUserAJAX.php');
  ?>


</body>

</html>