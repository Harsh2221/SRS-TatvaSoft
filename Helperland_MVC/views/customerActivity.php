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
        <!-- <span style="visibility: hidden;" id="loader"><img src="./assets/assets/load.gif" /></span> -->
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
                    <button type="button" class="update" data-bs-dismiss="modal">Update</button>
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
                    <div class="cancelButton" data-bs-dismiss="modal"><button type="button" class="cancel">Cancel Now</button></div>
                    
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="ServiceData_modal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Service Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body serviceData">
        <div class="row">
          <div class="col">
          <h4><span class="bookDate">07/03/22022</span>
        
        <span class="sTime">08</span>-<span class="eTime">11</span></span></h4>

       <p><b>Duration:</b> <span class="duration">3</span> Hrs</p>
       <hr>

       <p><b>Service Id:</b><span class="serviceId"> 1212 </span><br>
       <b>Extras:</b><span class="extraS"> </span><br>
       <b>Total Payment:</b> <span style="color: #1D7A8C; font-size: 20px;"><b>$ <span class="paymentTotal">56,300</span></b></span> 
       <hr>
       
       <b>Service Address:</b><span class="addressData"> XYZ 1212, 12345 ahmedabad </span><br>
       <b>Billing Address:</b><span class="addressDatab"> Same as Service Address </span><br>
       <b>Phone no:</b> <span class="phoneNo"></span> <br>
      
       <hr>
       <b>Comments:</b> <br><span class="commentPet">❌ I don't have pets at home </span>


       <hr>
       
       
        </div>
       
     </div>
      
      </div>

     </div>
             
  </div>
    
  <!-- </div> -->

            </div>

          </div>

          

          
          <div id="history" class="tab-pane fade history_tab">
            <div class="d-flex">
              <h6>Service history</h6>
              <button id="export-btn" class="exprtBtn">Export</button>
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

                    <button type="submit" class="rate_submit" data-bs-dismiss="modal">Submit</button>
                  </div>


                </div>

              </div>
            </div>
            <div class="modal fade" id="ServiceHistory_modal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
             
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Service Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body serviceData">
        <div class="row">
          <div class="col">
          <h4><span class="bookDate">07/03/22022</span>
        
        <span class="sTime">08</span>-<span class="eTime">11</span></span></h4>

       <p><b>Duration:</b> <span class="duration">3</span> Hrs</p>
       <hr>

       <p><b>Service Id:</b><span class="serviceId"> 1212 </span><br>
       <b>Extras:</b><span class="extraS"> </span><br>
       <b>Total Payment:</b> <span style="color: #1D7A8C; font-size: 20px;"><b>$ <span class="paymentTotal">56,300</span></b></span> 
       <hr>
       
       <b>Service Address:</b><span class="addressData"> XYZ 1212, 12345 ahmedabad </span><br>
       <b>Billing Address:</b><span class="addressDatab"> Same as Service Address </span><br>
       <b>Phone no:</b> <span class="phoneNo"></span> <br>
      
       <hr>
       <b>Comments:</b> <br><span class="commentPet">❌ I don't have pets at home </span>


       <hr>
       
       
        </div>
       
     </div>
      
      </div>

     </div>
             
  </div>
    
  <!-- </div> -->

            </div>
          </div>

          <div id="favorite" class="tab-pane fade favorite_pros">
          favorite
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
  <script src="https://cdn.jsdelivr.net/npm/table2csv@1.1.6/src/table2csv.min.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script> -->
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js">
  </script>
  <?php include('customer_ajax.php'); ?>


</body>

</html>