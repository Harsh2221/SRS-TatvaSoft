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
    <title>services provider | screen</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/css/serviceProviderScreens.css" />
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

    <section class="dashboard-content">
      
      <div class="container-main">
        <div class="row sidebar">
          <div class="col-lg-6 col-md-3 col-sm-6 left-sidebar">
          <div class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action p-2"
              >Dashboard</a
            >
            <a data-bs-toggle="tab" data-bs-target="#newServiceReq" class="list-group-item p-2 active" 
            >New Service Requests</a
            >
            <a data-bs-toggle="tab" data-bs-target="#upcoming-services" class="list-group-item list-group-item-action p-2"
              >Upcoming Services</a
            >
            <a data-bs-toggle="tab" data-bs-target="#serviceSchedule" class="list-group-item p-2" >
              Service Schedule
            </a> 
            <a data-bs-toggle="tab" data-bs-target="#serviceHistory" class="list-group-item p-2"
              >Service History
            </a>
            <a data-bs-toggle="tab" data-bs-target="#myRatinng" class="list-group-item p-2"
              >My Ratings</a
            >
            <a data-bs-toggle="tab" data-bs-target="#blockCust" class="list-group-item p-2"
              >Block Customer</a
            >
          </div>
       
        </div>

       

        <div class="col-lg-9 col-md-3 col-sm-6 tab-content">

          <div class="tab-pane fade show active newServiceReq" id="newServiceReq">
            <div class="d-flex">
              <h6>Service area: </h6>
              <select name="area" id="" style="margin-right: 20px">
                <option value="25">25</option>
                <option value="50">50</option>
              </select>
              <input class="form-check-input " type="checkbox" value="" id="pet" >
                 <h6>  <label class="form-check-label" for="pet">
                    Include Pet at Home
                    </label> </h6>
              
            </div>
            <table class="table" id="newServiceTable">
              <thead>
                <tr>
                  <th scope="col">Service ID <span><img src="./assets/assets/sort.png" alt="#"></span></th>

                  <th scope="col">Service Date</th>

                  <th scope="col">Customer Details</th> 

                  <th scope="col">Payment</th>

                  <th scope="col">Time conflict</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>

              <tbody>
                
                  <tr>
                    
                    <td>
                      <div data-bs-toggle="modal" data-bs-target="#serviceDetail">
                       323436
                      </div>
                      
                    </td>
                    <td>
                      <div data-bs-toggle="modal" data-bs-target="#serviceDetail">
                      <span><img src="./assets/assets/calendar2.png" alt=""></span> 09/04/2018 <br> <span><img src="./assets/assets/layer-14.png" alt=""></span> 12:00 - 18:00</div> </td>

                    <td>
                      <div data-bs-toggle="modal" data-bs-target="#serviceDetail">
                      David Bough <br> <span><img src="./assets/assets/layer-15.png" alt=""></span> Musterstrabe 5 <br> 12345 Bonn </div></td>
                    <td>$45</td>
                    <td>T C</td>
                    <td><button class="acceptBtn">Accept</button></td>
                 
                  </tr>
                
                

                                                
              </tbody>
          </table>
          
<!-- Modal -->
<div class="modal fade" id="serviceDetail" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Service Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body serviceData">
        <div class="row">
          <div class="col">
          <h5><span class="bookDate">07/03/22022</span>
        
        <span class="sTime">08</span>:00-<span class="eTime">11</span>:00</span></h5>

       <p><b>Duration:</b> <span class="duration">3</span> Hrs</p>
       <hr>

       <p><b>Service Id:</b><span class="serviceId"> 1212 </span><br>
       <b>Extras:</b><span class="extraS"> </span><br>
       <b>Total Payment:</b> <span style="color: #1D7A8C; font-size: 20px;"><b>$ <span class="paymentTotal">56,300</span></b></span> 
       <hr>
       <p><b>Customer Name:</b> <span class="custName">Harsh Prajapati </span><br>
       <b>Service Address:</b><span class="addressData"> XYZ 1212, 12345 ahmedabad </span><br>
       <b>Phone no:</b> <span class="phoneNo"></span> <br>
       <hr>
       <b>Comments:</b> <br><span class="commentPet">❌ I don't have pets at home </span>


       <hr>
       <div class="acceptmodalBtn"><button type="submit" class="acceptBtnModal" data-bs-dismiss="modal">✔ Accept</button>
       
        </div>
       
     </div>
      <div class="col">
      <div class="float-right mapModal">
     
      </div>
      </div>

      </div>

     </div>
             
    </div>
    
  </div>
</div>

          </div>

          <div class="tab-pane fade upcoming-ser" id="upcoming-services">

            <table class="table" id="upcomingServiceTable">
                <thead>
                  <tr>
                    <th scope="col">Service ID <span><img src="./assets/assets/sort.png" alt="#"></span></th>

                    <th scope="col">Service Date</th>

                    <th scope="col">Customer Details</th> 

                    
                    <th scope="col">Distance</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td><div class="detailModal" data-bs-toggle="modal" data-bs-target="#upcomingModal">323436</div></td>

                    <td><div class="detailModal" data-bs-toggle="modal" data-bs-target="#upcomingModal">
                      <span><img src="./assets/assets/calendar2.png" alt=""></span> 09/04/2018 <br> <span><img src="./assets/assets/layer-14.png" alt=""></span> 12:00 - 18:00 <div>
                    </td>
                    <td><div class="detailModal" data-bs-toggle="modal" data-bs-target="#upcomingModal">David Bough <br> <span><img src="./assets/assets/layer-15.png" alt=""></span> Musterstrabe 5,12345 Bonn<div></td>

                    <td> <div class="detailModal" data-bs-toggle="modal" data-bs-target="#upcomingModal">45 km</div> </td>
                    
                    <td> <div class="detailModal" data-bs-toggle="modal" data-bs-target="#cancel_modal"> <button class="cancle-btn">Cancle</button></div></td>
                  </tr>

                 
                                   
                </tbody>
            </table>
<!-- Modal -->
<div class="modal fade" id="upcomingModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Service Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

    

  <div class="modal-body serviceData">
      <!-- <div class="container-fluid"> -->
    <div class="row">
      <div class="col"> <h5><span class="upcomeDate">07/03/22022</span>
        <span class="UsTime">08</span>:00-<span class="UeTime">11</span>:00
        </h5>
        <p><b>Duration:</b><span class="upcomeDuration"> 3 </span>Hrs</p>
        <hr>
        <p><b>Service Id:</b> <span class="upcomeSId">1212</span> <br>
        <b>Extras:</b><span class="upcomeExtraS"></span> <br>
        <b>Total Payment:</b> <span style="color: #1D7A8C; font-size: 20px;"><b>$ <span class="upcomePayment">56,300</span></b></span> 
        <hr>
        <p><b>Customer Name:</b> <span class="upcomeCustName">Harsh Prajapati</span> <br>
        <b>Service Address:</b><span class="upcomeAddr"> XYZ 1212, 12345 ahmedabad<span> <br>
        <b>Phone No:</b> <span class="upcomephone">Harsh Prajapati</span> <br>

        <b>Distance:</b> 25,00 km <br>
        <hr>
        <b>Comments:</b> <br><span class="upcomepets">❌ I don't have pets at home </span>


        <hr>
        <div class="upcomeactionbtn">
        <button type="submit" class="acceptBtnModal" data-bs-dismiss="modal">✔ Accept</button>
        </div></div>
      <div class="col">
     <div class="float-right mapModal">
      <!-- <iframe width="100%" height="400" src="https://maps.google.com/maps?q=53844&output=embed"></iframe> -->
      </div>
      </div>
    <!-- </div> -->
    </div>
       
        <!-- <button type="submit" data-bs-toggle="modal" data-bs-target="#cancel_modal" class="cancelBtnModal">❌ Cancel</button>
        <button type="submit" class="completeBtnModal" data-bs-dismiss="modal">✔ Complete</button> -->
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
                        <textarea name="cancel_reason" id="" cols="42" rows="3"></textarea>
                      </div>

                    </div>

                  </div>
                  <div class="footer-modal">
                    <div class="cancelButton"><button type="button" class="cancel" data-bs-dismiss="modal">Cancel Now</button></div>
                    
                  </div>
                </div>
              </div>
            </div>
      </div>

          <div class="tab-pane fade serviceSchedule" id="serviceSchedule">
            service schedule

          </div>

  <div class="tab-pane fade serviceHistory" id="serviceHistory">
        <div class="table-caption">
            Payment Status
         <select id="Sstatus"><option value="1">All</option>
            <option value="2">Completed</option>
            <option value="3">Cancelled</option>
         </select>
        </div>
    <table class="table" id="serviceHistoryTableSP">
           
              <thead>
                <tr>
                  <th scope="col">Service ID</th>

                  <th scope="col">Service Date</th>

                  <th scope="col">Customer Details</th> 

                  <th scope="col">Status</th>  

                </tr>
              </thead>

              <tbody>
                <tr>
                  <td><div data-bs-toggle="modal" data-bs-target="#historyModal">323436</div></td>
                  
                  <td><div data-bs-toggle="modal" data-bs-target="#historyModal">
                    <span><img src="./assets/assets/calendar2.png" alt=""></span> 09/04/2018 <br> <span><img src="./assets/assets/layer-14.png" alt=""></span> 12:00 - 18:00 <div>
                  </td>
                  <td><div data-bs-toggle="modal" data-bs-target="#historyModal">David Bough <br> <span><img src="./assets/vassets/layer-15.png" alt=""></span> Musterstrabe 5,12345 Bonn<div></td>
                  <td><div data-bs-toggle="modal" data-bs-target="#historyModal">cancel</div></td>
                </tr>
                
       
              </tbody>
    </table>

            <div class="modal fade" id="historyModal" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Service Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> 
                  <div class="modal-body serviceData">
      <!-- <div class="container-fluid"> -->
    <div class="row">
      <div class="col"> <h5><span class="upcomeDate">07/03/22022</span>
        <span class="UsTime">08</span>:00-<span class="UeTime">11</span>:00
        </h5>
        <p><b>Duration:</b><span class="upcomeDuration"> 3 </span>Hrs</p>
        <hr>
        <p><b>Service Id:</b> <span class="upcomeSId">1212</span> <br>
        <b>Extras:</b><span class="upcomeExtraS"></span> <br>
        <b>Total Payment:</b> <span style="color: #1D7A8C; font-size: 20px;"><b>$ <span class="upcomePayment">56,300</span></b></span> 
        <hr>
        <p><b>Customer Name:</b> <span class="upcomeCustName">Harsh Prajapati</span> <br>
        <b>Service Address:</b><span class="upcomeAddr"> XYZ 1212, 12345 ahmedabad<span> <br>
        <b>Phone No:</b> <span class="upcomephone">Harsh Prajapati</span> <br>

        <b>Distance:</b> 25,00 km <br>
        <hr>
        <b>Comments:</b> <br><span class="upcomepets">❌ I don't have pets at home </span>


        <hr>
      </div>
      <div class="col">
     <div class="float-right mapModal">
      <iframe width="100%" height="400" src="https://maps.google.com/maps?q=53844&output=embed"></iframe>
      </div>
      </div>
    <!-- </div> -->
    </div>
       
        <!-- <button type="submit" data-bs-toggle="modal" data-bs-target="#cancel_modal" class="cancelBtnModal">❌ Cancel</button>
        <button type="submit" class="completeBtnModal" data-bs-dismiss="modal">✔ Complete</button> -->
  </div>
                  
                </div>
              </div>
            </div>
  </div>



    <div class="tab-pane fade myRatinng" id="myRatinng">
          <div class="headpart">
          <div class="float-left">Rating <select id="selectbtn">
                <option value="1" selected>All</option>
                <option value="2">Very Good</option>
                <option value="3">Good</option>
                <option value="4">Poor</option>
                <option value="5">Very Poor</option>

            </select>
          </div>
          </div>

          <table class="table" id="spRatings">
           
           <thead>
             <tr>
               <th scope="col">Ratings</th>

               <th scope="col"> </th>

               <th scope="col"> </th> 

               <!-- <th scope="col"></th>   -->

             </tr>
           </thead>

           <tbody>
             <tr>
               <td><div data-bs-toggle="modal" data-bs-target="#historyModal">323436<br><b>Harsh Prajapati</b></div>
               <hr>
               <b>Comments:</b>
               </td>
               
               <td><div data-bs-toggle="modal" data-bs-target="#historyModal">
                 <span><img src="./assets/assets/calendar2.png" alt=""></span> 09/04/2018 <br> <span><img src="./assets/assets/layer-14.png" alt=""></span> 12:00 - 18:00 <div>
               </td>
               <td> 
                      <b>Ratings</b> <br />
                      <span id="star">
                          <i class="fa fa-star s1"></i>
                          <i class="fa fa-star s2"></i>
                          <i class="fa fa-star s3"></i>
                          <i class="fa fa-star s4"></i>
                          <i class="fa fa-star s5"></i>
                        <span>4</span>
                      </span></td>
              
             </tr>

             <tr>
               <td><div data-bs-toggle="modal" data-bs-target="#historyModal">323436<br><b>Harsh Prajapati</b></div>
               <hr>
               <b>Comments:</b>
               </td>
               
               <td><div data-bs-toggle="modal" data-bs-target="#historyModal">
                 <span><img src="./assets/assets/calendar2.png" alt=""></span> 09/04/2018 <br> <span><img src="./assets/assets/layer-14.png" alt=""></span> 12:00 - 18:00 <div>
               </td>
               <td> <img src="./assets/assets/cap.png" alt="" id="cap" />

                      Lyum Watson <br />
                      <span id="star">
                        <img src="./assets/assets/star1.png" alt="" />
                        <img src="./assets/assets/star1.png" alt="" />
                        <img src="./assets/assets/star1.png" alt="" />
                        <img src="./assets/assets/star1.png" alt="" />
                        <img src="./assets/assets/star2.png" alt="" />
                        <span>4</span>
                      </span></td>
              
             </tr>
             
             
    
           </tbody>
          </table>

    </div>



          <div class="tab-pane fade blockCust" id="blockCust">
          <table class="table" id="blockTable">
            
            <thead id="headings">
                <tr>
                    <th scope="row"></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

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
                  <a href="#" title="Home">Home</a>
                </li>
                <li>
                  <a href="#" title="About">About</a>
                </li>
                <li>
                  <a href="#" title="Testimonials">Testimonials</a>
                </li>
                <li>
                  <a href="#" title="FAQs">FAQs</a>
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
    <script src="./assets/js/serviceProviderScreens.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <?php 
    include('SpScreensAJAX.php');
    ?>

  </body>
</html> 

