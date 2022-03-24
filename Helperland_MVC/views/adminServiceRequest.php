<?php
session_start();
$email = $_SESSION['username'];
$base = "https://localhost/tatvasoft/Helperland_MVC/";
if(!isset($_SESSION['username'])){
  header('Location:' . $base);
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin|Service Requests</title>
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./assets/css/admin_service_request.css" />
  <link href="./assets/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

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
            <a class="link-active" href="adminServiceRequest.php">Service Requests</a>
          </li>

          <li>
            <a href="adminUser.php">User Management</a>
          </li>

        </ul>
      </nav>


      <div id="content">
 
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid upper-btn">
            <a id="sidebarCollapse" class="btn">

              <span> <img src="./assets/assets/vector-smart-object-copy.png" alt=""></span>

            </a>
            <h6>Service Requests</h6>
          </div>
          <div class="add-user">
            <button id="adduser-btn"><img src="./assets/assets/add.png" alt="#"> Add New User</button>

          </div>
        </nav>

        <div class="user-form">
          <div class="row gx-3 gy-2 align-items-center">
            <div class="col-sm-2">
              <input type="text" class="form-control" id="serviceId" placeholder="Service ID">
            </div>
            <!-- <div class="col-sm-2">
              <input type="text" class="form-control" placeholder="Postal code">
            </div>
            <div class="col-sm-2">
              <input type="email" class="form-control" placeholder="Email">
            </div> -->
            <div class="col-sm-2">
              <select class="form-select" id="selectCust">
                <option selected="true" disabled="disabled">Customer</option>
                
              </select>
            </div>
            <div class="col-sm-2">
              <select class="form-select" id="selectSp">

                <option selected="true" disabled="disabled">Serviceprovider</option>
                <!-- <option value="2">Call center</option> -->
              </select>
            </div> 

            <div class="col-sm-2">
              <select class="form-select" id="selectStatus">
                <option value='0' selected="true" disabled="disabled">Status</option>
                <option >Approoved</option>
                <option >Panding</option>
                <option >Completed</option>
                <option >Cancelled</option>
              </select>
            </div>
            <div class="col-sm-2 d-picker">
              <img src="./assets/assets/admin-calendar-blue.png" alt=""> <input type="text" id="datepicker"
                placeholder="From date">

            </div>
            <div class="col-sm-2 d-picker">

              <img src="./assets/assets/admin-calendar-blue.png" alt=""> <input type="text" id="datepicker2"
                placeholder="To date">
            </div>

            <div class="col-sm-1 s-btn">
              <button type="submit" class="btn" id="searchRec">Search</button>
            </div>

            <div class="col-sm-1 c-btn">
              <button type="reset" class="btn" id="clearBtn">Clear</button>
            </div>




          </div>

        </div>

        <div class="user-table">
          <table class="table" id="serviceReqTable">
            <thead>
              <tr>
                <th scope="col">
                  Service ID
                  <span><img src="./assets/assets/sort.png" alt="#" /></span>
                </th>
                <th scope="col">
                  Service date

                </th>
                <th scope="col">
                  Customer details
                </th>
                <th scope="col">
                  Service provider <span><img src="./assets/assets/sort.png" alt="#" /></span>
                </th>
                <th scope="col">Status </th>

                <th scope="col">
                  Action
                </th>
              </tr>
            </thead>
            <tbody>
              <tr> 
                <td scope="row">323436</td>
                <td>
                  <div data-bs-toggle="modal" data-bs-target="#serviceData">
                    <span><img src="./assets/assets/calendar2.png" alt=""></span> 09/04/2018 <br> <span><img
                        src="./assets/assets/layer-14.png" alt=""></span> 12:00 - 18:00
                </td>
                <td>David Bough <br> <span><img src="./assets/assets/layer-15.png" alt=""></span> Musterstrabe 5,12345 Bonn
        </div>
        </td>
        <td></td>
        <td> <span id="new-status">New</span> </td>

        <td>
          <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <span><img src="./assets/assets/group-38.png" alt="" /></span>

          </a>

          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Edit</a></li>


          </ul>
        </td>
        </tr>

        <tr>
          <td scope="row">323436</td>
          <td><span><img src="./assets/assets/calendar2.png" alt=""></span> 09/04/2018 <br> <span><img src="assets/layer-14.png"
                alt=""></span> 12:00 - 18:00 </td>
          <td>David Bough <br> <span><img src="./assets/assets/layer-15.png" alt=""></span> Musterstrabe 5,12345 Bonn</td>
          <td>

          </td>
          <td> <span id="panding-status">Panding</span> </td>

          <td>
            <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <span><img src="./assets/assets/group-38.png" alt="" /></span>

            </a>

            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editmodal"
                  style="cursor: pointer;">Edit & Reschedule</a></li>
              <li><a class="dropdown-item" href="#">Refund</a></li>
              <li><a class="dropdown-item" href="#">Cancle</a></li>
              <li><a class="dropdown-item" href="#">Change SP</a></li>
              <li><a class="dropdown-item" href="#">Escalate</a></li>
              <li><a class="dropdown-item" href="#">History Log</a></li>
              <li><a class="dropdown-item" href="#">Download Invoice</a></li>

            </ul>
          </td>
        </tr>

        <tr>
          <td scope="row">323436</td>
          <td><span><img src="./assets/assets/calendar2.png" alt=""></span> 09/04/2018 <br> <span><img src="./assets/assets/layer-14.png"
                alt=""></span> 12:00 - 18:00 </td>
          <td>David Bough <br> <span><img src="./assets/assets/layer-15.png" alt=""></span> Musterstrabe 5,12345 Bonn</td>
          <td>
            <img src="./assets/assets/cap.png" alt="" id="cap" />

            Lyum Watson <br />
            <span id="star">
              <img src="./assets/assets/star1.png" alt="" />
              <img src="./assets/assets/star1.png" alt="" />
              <img src="./assets/assets/star1.png" alt="" />
              <img src="./assets/assets/star1.png" alt="" />
              <img src="./assets/assets/star2.png" alt="" />
              <span>4</span>
            </span>
          </td>
          <td> <span id="complete-status">Completed</span> </td>

          <td>
            <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <span><img src="./assets/assets/group-38.png" alt="" /></span>

            </a>

            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Edit</a></li>


            </ul>
          </td>
        </tr>

        <tr>
          <td scope="row">323436</td>
          <td><span><img src="./assets/assets/calendar2.png" alt=""></span> 09/04/2018 <br> <span><img src="./assets/assets/layer-14.png"
                alt=""></span> 12:00 - 18:00 </td>
          <td>David Bough <br> <span><img src="./assets/assets/layer-15.png" alt=""></span> Musterstrabe 5,12345 Bonn</td>
          <td>
            <img src="./assets/assets/cap.png" alt="" id="cap" />

            Lyum Watson <br />
            <span id="star">
              <img src="./assets/assets/star1.png" alt="" />
              <img src="./assets/assets/star1.png" alt="" />
              <img src="./assets/assets/star1.png" alt="" />
              <img src="./assets/assets/star1.png" alt="" />
              <img src="./assets/assets/star2.png" alt="" />
              <span>4</span>
            </span>
          </td>
          <td> <span id="cancle-status">Cancle</span> </td>

          <td>
            <a class="nav-link dropdown" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <span><img src="./assets/assets/group-38.png" alt="" /></span>

            </a>

            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Edit</a></li>


            </ul>
          </td>
        </tr>




        </tbody>
        </table>

        <div class="modal fade" id="serviceData" tabindex="-1" role="dialog" aria-labelledby="serviceData">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Service Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body serviceData">
                <div class="row">
                  <div class="col-6">
                    <h5><span class="bookDate">07/03/2022</span>

                      <span class="sTime">08</span>-<span class="eTime">11</span></span></h5>

                    <p><b>Duration:</b> <span class="duration">3</span> Hrs</p>
                    <hr>

                    <p><b>Service Id:</b><span class="serviceId"> 1212 </span><br>
                      <b>Extras:</b><span class="extraS"> </span><br>
                      <b>Total Payment:</b> <span style="color: #1D7A8C; font-size: 20px;"><b>$ <span
                            class="paymentTotal">56,300</span></b></span>
                      <hr>
                    <p><b>Address:</b> <span class="addressData">address here</span><br>
                      <b>Billing address:</b> <span class="addressData">Same as address</span><br>
                      <b>Phone no:</b> <span class="phoneNo"></span> <br>
                      <hr>
                      <b>Comments:</b> <br><span class="commentPet">❌ I don't have pets at home </span>

                  </div>
                  <div class="col-6">
                    <div class="float-right mapModal">

                    </div>
                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

        <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodal"
          aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Service Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body editservice">

                <div class="row">
                  <div class="col-md-6">
                    <label for="reDate"><b>Date</b></label>
                    <div class="row">
                      <div class="col-2">
                        <img src="./assets/assets/admin-calendar-blue.png">
                      </div>
                      <div class="col-10">
                        <input type="text" id="reDate" class="form-control " placeholder="Enter Date" />
                      </div>
                    </div>

                  </div>

                  <div class="form-group col-md-6">
                    <label for="time"><b>Time</b></label>
                    <select id="time" class="form-control">
                      <option>3</option>
                    </select>
                  </div>
                </div>
                <label><b>Address</b></label>
                <!-- <h5 class="">Address</h5> -->
                <div class="serviceaddress">
                  <div class="row">
                    <div class="col-md-6">
                      <label for="street">Street name</label>
                      <input type="text" class="form-control mb-2" id="street" placeholder="Street">
                    </div>
                    <div class="col-md-6">
                      <label for="houseno">House number</label>
                      <input type="number" class="form-control mb-2" id="houseno" placeholder="House number">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <label for="postal">Postal Code</label>
                      <input type="text" class="form-control mb-2" id="postal" placeholder="Street">
                    </div>
                    <div class="form-group col-md-6">
                      <label class="location">Location</label>
                      <select id="location" class="located form-control">
                      </select>
                    </div>
                  </div>
                </div>

                <label><b>Invoicing Address</b></label>
                <div class="invoicing">
                  <div class="row">
                    <div class="col-md-6">
                      <label for="streets">Street name</label>
                      <input type="text" class="form-control mb-2" id="streets" placeholder="Street">
                    </div>
                    <div class="col-md-6">
                      <label for="housenos">House number</label>
                      <input type="number" class="form-control mb-2" id="housenos" placeholder="House number">
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <label for="postals">Postal Code</label>
                      <input type="text" class="form-control mb-2" id="postals" placeholder="Street">
                    </div>
                    <div class="form-group col-md-6">
                      <label class="location">Location</label>
                      <select id="location" class="located form-control">
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="whyreschedule"><b>Why do you want to reschedule service request?</b></label>
                  <textarea class="form-control" id="whyreschedule"
                    placeholder="Why do you want to reschedule service request?" rows="3"
                    style="height: auto;"></textarea>
                </div>
                <div class="form-group ">
                  <label for="callcenteremp"><b>Call Center EMP Notes</b></label>
                  <textarea class="form-control" id="callcenteremp" placeholder="Enter Notes" rows="3"
                    style="height: auto;"></textarea>
                </div>
                <div class="row">

                  <button type="submit" class="btnReschedule" data-bs-dismiss="modal">Update</button>
                </div>


              <!-- end of body div -->
              </div>

            </div>
          </div>
        </div>

      </div>

    </div>

  </section>





  <!-- scripts -->
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


  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
  <?php
  include('adminServiceAJAX.php');
  ?>
  <script>
    
  </script>



  </script>
</body>

</html>