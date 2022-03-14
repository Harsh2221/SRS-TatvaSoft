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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Customer | Service history</title>
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./assets/css/service_history.css" />
 
  <link href="./assets/css/jquery.dataTables.min.css" rel="stylesheet" />
  
  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  
</head>

<body>
  <?php
  include('navbar_BS.php');
  ?>

  <section class="welcom-section">
    <div class="container-welcom">
      <h3>Welcome, <?php echo $_SESSION['firstname']; ?></h3>
    </div>
    <hr />
  </section>

  <section class="history-section">
    <div class="container-main">
      <div class="row sidebar">

        <div class="col-lg-6 col-md-3 col-sm-6 left-sidebar">
          <div class="list-group list-group-flush">

            <a data-bs-toggle="tab" data-bs-target="#dashboard" class="list-group-item p-2 active" id="dash_link">Dashboard</a>
            <a data-bs-toggle="tab" data-bs-target="#history" class="list-group-item p-2" id="history_link">Service History</a>
            <a class="list-group-item p-2 " href="#!">Service Schedule</a>
            <a data-bs-toggle="tab" data-bs-target="#favorite" class="list-group-item p-2" id="fav_link">
              Favourite Pros
            </a>
            <a class="list-group-item p-2" href="#!">
              Invoices
            </a>
            <a class="list-group-item p-2" data-bs-toggle="tab" data-bs-target="#settings">Settings</a>
            <a class="list-group-item p-2" href="#!">Notifications</a>
            
          </div>
        </div>

        <div class="col-lg-8 col-md-3 col-sm-6 tab-content">
          <div id="dashboard" class="tab-pane fade show active dashbord_tab">

            <div class="d-flex">
              <h6>Current Service Requests</h6>
              <a id="export-btn" href="book_services.php" style="text-decoration: none;">Add New Service Request</a>
            </div>
            <table class="table dashboardTable" id="myTable1">
              <thead>
                <tr>
                  <th scope="col"> 
                    Service ID

                  </th>
                  <th scope="col">
                    Service Date

                  </th>
                  <th scope="col">
                    Service Provider
                  </th>
                  <th scope="col">
                    Payment
                  </th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>

                <tr>
                  <td class="serviceid">
                    1234
                  </td>
                  <td>
                    <span><img src="./assets/assets/calendar2.png" alt="#" /> 31/03/2018</span>
                    <br />
                    <span><img src="./assets/assets/layer-14.png" alt="#" /> 12:00 - 18:00 </span>
                  </td>
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
                  <td class="payment">
                    <h5><span>€</span>63</h5>
                  </td>

                  <td>
                  <span><button id="reschedule-btn">Reschedule</button></span>  
                  <span><button id="cancel-btn">Cancel</button></span>  
                  </td>
                </tr>

                <tr>
                  <td>
                    1234
                  </td>
                  <td>
                    <span><img src="./assets/assets/calendar2.png" alt="#" /> 31/03/2018</span>
                    <br />
                    <span><img src="./assets/assets/layer-14.png" alt="#" /> 12:00 - 18:00 </span>
                  </td>
                  <td>

                  </td>
                  <td>
                    <h5>€63</h5>
                  </td>

                  <td>
                    <button type="button" class="reschedule-btn" data-bs-toggle="modal"
                      data-bs-target="#reschedule_modal">Reschedule</button>
                    <button class="cancel-btn" type="button" data-bs-toggle="modal"
                      data-bs-target="#cancel_modal">Cancel</button>
                  </td>
                </tr>

              </tbody>

            </table>

            <div class="modal fade" id="reschedule_modal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="header_modal">Reschedule Service Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                  <span class="newDateTime">
                  <h6>Select New Date & Time</h6>
                  </span>
                    
                    <div class="row">
                      <div class="re_date d-picker">
                        <img src="./assets/assets/calendar-book-service.png" alt=""> <input type="text" id="datepicker"
                          placeholder="Date" name="select_date" data-date-format='yyyy-mm-dd'>
                      </div>
                      <div class="re_time">
                        <select id="select_time" class="form-select select_time">
                          <option value='8'>8:00 </option>
                          <option value='8.5'>8:30 </option>
                          <option value='9'>9:00 </option>
                          <option value='9.5'>9:30 </option>
                          <option value='10'>10:00</option>
                          <option value='10.5'>10:30</option>
                          <option value='11'>11:00</option>
                          <option value='11.5'>11:30</option>
                          <option value='12'>12:00</option>
                          <option value='12.5'>12:30</option>
                          <option value='13'>13:00</option>
                          <option value='13.5'>13:30</option>
                          <option value='14'>14:00</option>
                          <option value='14.5'>14:30</option>
                          <option value='15'>15:00</option>
                          <option value='15.5'>15:30</option>
                          <option value='16'>16:00</option>
                          <option value='16.5'>16:30</option>
                          <option value='17'>17:00</option>
                          <option value='17.5'>17:30</option>
                          <option value='18'>18:00</option>
                        </select>
                      </div>
                      
                    </div>
                    <span class="timeError" style="font-size: 12px"></span>

                  </div>
                  <div class="footer-modal">
                    <div class="updateButton">
                    <button type="button" class="update" >Update</button>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="cancel_modal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="header_modal">Cancel Service Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <h6>Why you want to cancel service request?</h6>
                    <div class="row">
                      <div class="cancel_reason">
                        <textarea name="cancel_reason" id="" cols="37" rows="3"></textarea>
                      </div>

                    </div>

                  </div>
                  <div class="footer-modal">
                    <div class="cancelButton"><button type="button" class="cancel">Cancel Now</button></div>
                    
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="ServiceData_modal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="header_modal">Cancel Service Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <h6>Why you want to cancel service request?</h6>
                    <div class="row">
                      <div class="cancel_reason">
                        <textarea name="cancel_reason" id="" cols="37" rows="3"></textarea>
                      </div>

                    </div>

                  </div>
                  <div class="footer-modal">
                    <div class="cancelButton"><button type="button" class="cancel">Cancel Now</button></div>
                    
                  </div>
                </div>
              </div>
            </div>

          </div>

          

          
          <div id="history" class="tab-pane fade history_tab">
            <div class="d-flex">
              <h6>Service history</h6>
              <button id="export-btn">Export</button>
            </div>

            <table class="table historyTable" id="myTable2">
              <thead>
                <tr>
                  <th scope="col">
                    Service Id
                   
                  </th>
                  <th scope="col">
                    Service Date
                    
                  </th>
                  <th scope="col">
                    Service Provider 
                  </th>
                  <th scope="col">
                    Payment 
                  </th>
                  <th scope="col">
                    Status 
                  </th>
                  <th scope="col">Rate SP</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                
                  <td class="serviceid">
                    1234
                  </td>
                  <td>
                    <span><img src="./assets/assets/calendar2.png" alt="#" /> 31/03/2018</span>
                    <br />
                    <span><img src="./assets/assets/layer-14.png" alt="#" /> 12:00 - 18:00 </span>
                  </td>
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
                  <td class="payment">
                    <h5><span>€</span>63</h5>
                  </td>
                  <td><span id="pay-status">Completed</span></td>
                  <td><button class="rate-btn" id="rate-btn" type="button" data-bs-toggle="modal"
                      data-bs-target="#rate_sp">Rate SP</button></td>
                </tr>

                
                <tr>
                  <td class="serviceid">
                    1234
                  </td>
                  <td>
                    <span><img src="./assets/assets/calendar2.png" alt="#" /> 31/03/2018</span>
                    <br />
                    <span><img src="./assets/assets/layer-14.png" alt="#" /> 12:00 - 18:00 </span>
                  </td>
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
                  <td class="payment">
                    <h5><span>€</span>63</h5>
                  </td>
                  <td><span id="cancle-status">Cancelled</span></td>
                  <td><button class="rate-btn">Rate SP</button></td>
                </tr>
                
              </tbody>
            </table>
            <div class="modal fade" id="rate_sp" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered rating_modal">
                <div class="modal-content p-3">
                  <div class="modal-header">
                    <div class="serviceProviderData">
                    <h6 class="modal-title" id="header_modal"><img src="./assets/assets/cap.png" alt="" id="cap" />
                    <div class="spData">harsh</div>
                    
                      
                      <span id="star" style="margin-bottom: 20px;">
                        <img src="./assets/assets/star1.png" alt="" />
                        <img src="./assets/assets/star1.png" alt="" />
                        <img src="./assets/assets/star1.png" alt="" />
                        <img src="./assets/assets/star1.png" alt="" />
                        <img src="./assets/assets/star2.png" alt="" />
                        <span> 4 </span>
                      </span>

                    </h6>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <h5 class="rateSPy" style="margin-bottom: 30px;">Rate your service provider</h5>

                    <div class="row on_time">
                      <div class="col-sm-6">
                        <h6 style="font-size: 14px;">On time arrival</h6>
                      </div>
                      <div class="col-sm-6">
                        <span class="timeRate">
                        <i class = "fa fa-star" aria-hidden = "true" id = "tst1"></i> 
                        <i class = "fa fa-star" aria-hidden = "true" id = "tst2"></i> 
                        <i class = "fa fa-star" aria-hidden = "true" id = "tst3"></i> 
                        <i class = "fa fa-star" aria-hidden = "true" id = "tst4"></i> 
                        <i class = "fa fa-star" aria-hidden = "true" id = "tst5"></i> 
                        <span class="rateTime"></span>
                        </span>
                        
                       
                      </div>
                    </div>

                    <div class="row friendly">
                      <div class="col-sm-6">
                        <h6 style="font-size: 14px;">Friendly</h6>
                      </div>
                      <div class="col-sm-6">
                      <span class="FriendlyRate">
                        <i class = "fa fa-star" aria-hidden = "true" id = "fst1"></i> 
                        <i class = "fa fa-star" aria-hidden = "true" id = "fst2"></i> 
                        <i class = "fa fa-star" aria-hidden = "true" id = "fst3"></i> 
                        <i class = "fa fa-star" aria-hidden = "true" id = "fst4"></i> 
                        <i class = "fa fa-star" aria-hidden = "true" id = "fst5"></i> 
                        <span class="rateFrnd"></span>
                        </span>
                        
                      </div>
                    </div>

                    <div class="row qualityofservice">
                      
                      <div class="col-sm-6 ">
                        <h6 style="font-size: 14px;">Quality of service</h6>
                      </div>
                      <div class="col-sm-6">
                      <span class="qualityRate">
                        <i class = "fa fa-star" aria-hidden = "true" id = "qst1"></i> 
                        <i class = "fa fa-star" aria-hidden = "true" id = "qst2"></i> 
                        <i class = "fa fa-star" aria-hidden = "true" id = "qst3"></i> 
                        <i class = "fa fa-star" aria-hidden = "true" id = "qst4"></i> 
                        <i class = "fa fa-star" aria-hidden = "true" id = "qst5"></i> 
                        <span class="rateqlt"></span>
                        </span>
                      
                      </div>
                    </div>
                    <div class="row feedback">
                     
                      
                        <h6 style="font-size: 14px; margin-top: 5px;">Feedback on service provider</h6>
                        
                          <textarea name="feedback_sp" id="feedback_sp" cols="8" rows="2"></textarea>
                        
                      
                      
                    </div>
                  </div>

                  <div class="footer-modal" style="text-align: left;">

                    <button type="submit" class="rate_submit">Submit</button>
                  </div>


                </div>

              </div>
            </div>
          </div>

          <div id="favorite" class="tab-pane fade favorite_pros">
          favorite
          </div>
          <div id="settings" class="tab-pane fade my_settings">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="home" aria-selected="true">My Details</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#address" type="button" role="tab" aria-controls="profile" aria-selected="false">My Addresses</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#change_pass" type="button" role="tab" aria-controls="contact" aria-selected="false">Change Password</button>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">

              <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="home-tab">
              <div class="my_details">
                <div class="row">
                  <div class="col-4">
                    <label for="first_name">First name</label>
                    <input type="text" id="first_name" class="form-control" placeholder="First name" >
                  </div>
                  <div class="col-4">
                    <label for="last_name">Last name</label>
                    <input type="text" id="last_name" class="form-control" placeholder="Last name" >
                  </div>
                  <div class="col-4">
                    <label for="email_detail">Email address</label>
                    <input type="email" id="email_detail" class="form-control" placeholder="Email Address">
                  </div>
                  <div class="col-4">
                    <label for="phone_detail">Email address</label>
                    <input type="tel" id="phone_detail" class="form-control" placeholder="Phone number">
                  </div>
                  <div class="col-4">
                    <label for="dob_detail">Date of Birth</label>
                    <input type="number" id="dob_detail" class="form-control" placeholder="DOB">
                  </div>
                  <hr style="margin-top: 20px;">
                  <div class="col-3">
                    <label for="lang_detail">My Preferred Language</label>
                    <select id="lang_detail" class="form-select">
                      <option selected>English</option>
                      <option>Hindi</option>
                      <option>Gujarati</option>
                    </select>
                  </div> 
                  <div><button class="save-btn" id="save">Save</button></div>
                  
                </div>

              </div>
              </div>

              <div class="tab-pane fade" id="address" role="address" aria-labelledby="profile-tab">
                <div class="address_table">
                  <table class="table">
                    <thead>
                      <tr>
                        
                        <th scope="col">Addresses</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        
                        <td>demo address</td>
                        <td>
                          <button style="margin-right: 10px; border: none" data-bs-toggle="modal" data-bs-target="#edit_address"><img src="./assets/assets/edit.png" alt="" style="height: 20px; width: 20px;"></button>
                          <button style="border: none"><img src="./assets/assets/delete.png" alt="" style="height: 22px; width: 25px;"></button>
                        </td>
                      </tr>
                     
                    </tbody>
                  </table>
                  <div><button class="add_address-btn" id="add_address">Add New Address</button></div>

                  <div class="modal fade" id="edit_address" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="edit_title" style="color: #646464;">Edit Address</h4>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="card card-body" id="address_form">

                            <div class="row">
                              <div class="col-md-6">
                                <label for="inputstreet" class="form-label">Street name</label>
                                <input type="text" class="form-control" id="inputstreet">
                              </div>
                              <div class="col-md-6">
                                <label for="inputhouse" class="form-label">House number</label>
                                <input type="text" class="form-control" id="inputhouse">
                              </div>
                              <div class="col-md-6">
                                <label for="inputpostal" class="form-label">Postal code</label>
                                <input type="text" class="form-control" id="inputpostal">
                              </div>
                              <div class="col-md-6">
                                <label for="inputcity" class="form-label">City</label>
                                <input type="text" class="form-control" id="inputcity">
                              </div>
                              <div class="col-md-6">
                                <label for="inputphone" class="form-label">Phone number</label>
                                <input type="text" class="form-control" id="inputphone">
                              </div>
                              
                            </div>
              
                          </div>
                        </div>
                        <div class="edit-btn">
                          <button class="btn_edit">Edit</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                 </div>

              </div>

              <div class="tab-pane fade" id="change_pass" role="change_pass" aria-labelledby="contact-tab">
                <div class="change_password">
                  <label for="old_pass">Old Password</label>
                  <input type="text" id="old_pass" class="form-control w-25" placeholder="Current Password" >
                  <label for="new_pass">New Password</label>
                  <input type="text" id="new_pass" class="form-control w-25" placeholder="Password" >
                  <label for="confirm_pass">Confirm Password</label>
                  <input type="text" id="confirm_pass" class="form-control w-25" placeholder="Confirm Password" >
                </div>

              </div>
            </div>

          </div>
         
          

        </div>
        
      </div>

    </div>
    </div>
  </section>

  <footer class="site-footer">
    <div class="footer-top">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-2 footer-widget">
            <a href="#" title="Helper Hand">
              <img src="./assets/assets/logo-small.png" alt="Helper Hand" />
            </a>
          </div>
          <div class="col-lg-8 footer-widget">
            <ul class="footer-navigation d-flex justify-content-center">
              <li>
                <a href="homepage.php" title="Home">Home</a>
              </li>
              <li>
                <a href="about.php" title="About">About</a>
              </li>
              <li>
                <a href="#" title="Testimonials">Testimonials</a>
              </li>
              <li>
                <a href="faqs.php" title="FAQs">FAQs</a>
              </li>
              <li>
                <a href="#" title="Insurance Policy">Insurance Policy</a>
              </li>
              <li>
                <a href="#" title="Impressum">Impressum</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-2 footer-widget">
            <ul class="social-media-list d-flex justify-content-end">
              <li>
                <a href="#" target="_blank" title="Facebook">
                  <img src="./assets/assets/ic-facebook.png" alt="Facebook" />
                </a>
              </li>
              <li>
                <a href="#" target="_blank" title="Instagram">
                  <img src="./assets/assets/ic-instagram.png" alt="Instagram" />
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script src="./assets/js/jquery.js"></script>
  <script src="./assets/js/jquery.dataTables.min.js"></script>
  <script src="./assets/js/service_history.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script> -->
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js">
  </script>
  <?php include('customer_ajax.php'); ?>


</body>

</html>