<?php 
$base_url="https://localhost/tatvasoft/Helperland_MVC/";
session_start();
?>
<!DOCTYPE html>
<html lang="en"> 

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="./assets/css/book_services.css" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <title>Book a Services</title>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
</head>

<body>
  <!-- Navbar -->
  <?php
  include('navbar_BS.php');
  ?>
  <!-- End of Navbar -->

  <section class="hero">
    <img src="./assets/assets/book-service-banner.jpg" alt="" />
  </section>

  <section class="content" id="allcontent">
    <h2 class="text-center">Set up your cleaning service</h2>
    <div class="separator-section">
      <img src="./assets/assets/separator.png" class="separator" alt="" />
      <hr class="w-25 m-auto" />
    </div>

    <div class="tabs row">


      <div class="sub-tab row col-lg-7">

        <ul class="tabs-steps">
          <li data-tab-target="#step-1" class="tab t-1 active"> <img src="./assets/assets/setup-service-white.png" alt="" />
            Setup Service</li>
          <li data-tab-target="#step-2" class="tab t-2" id="tab-2" onclick='changeImage1();'><img src="./assets/assets/schedule.png" alt=""
              id="img1" /> Schedule & Plan</li>
          <li data-tab-target="#step-3" class="tab t-3" id="tab-3" onclick='changeImage2();'><img src="./assets/assets/details.png" alt=""
              id="img2" /> Your Details</li>
          <li data-tab-target="#step-4" class="tab t-4" id="tab-4" onclick='changeImage3();'><img src="./assets/assets/payment.png" alt=""
              id="img3" /> Make Payment</li>
        </ul>

        <div id="step-1" data-tab-content class="tab-content f_tab active">
          <div class="step-1-content">
            <h6>Enter your Postal Code</h6>
            <!-- <form id="check_form" name="checkform" method="POST" action=<?= $base_url."./?controller=main_&function=postalCheck"?>> -->
            
              <input type="text" placeholder="Postal code" id="postalcode" name="postalcode">
              <button type="submit" id="check-btn" class="check-btn" onclick="check()">Check Availability</button>
              
            <!-- </form> -->
            <hr>
            <div id="msg-box"></div>
           <?php if (isset($_SESSION['msg'])){ ?>
           <?php echo $_SESSION['msg'];
           ?>
           <?php  unset($_SESSION['msg']); } ?>

            <div class="continue-btn">
              <button id="continu" data-tab-target="#step-2" onclick='changeImage1();'>Continue</button>
            </div>
          </div>

        </div>

        <div id="step-2" data-tab-content class="tab-content s_tab">
                                  
            <div class="sub-form row">
              <div class="1 row col-lg-6">
                <p>When do you need the cleaner?</p>
                <div class="row">
                  <div class="col-sm-7 d-picker">
                    <img src="./assets/assets/calendar-book-service.png" alt=""> <input type="text" id="datepicker" placeholder="Date" name="select_date" data-date-format='yyyy-mm-dd'>
                  </div>
                  <div class="col-sm-5 time">
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
                  <span class="time_error" style="color: red"></span>
                </div>
              </div>
              <div class="col-lg-5 sub_2">
                <p>How long do you need your cleaner to stay?</p>
                <div class="col-sm-5">
                  <select id="select_hours" class="form-select select_hours" name="select_hours">
                  <option value='3'>3.0 Hrs</option>
                  <option value='3.5'>3.5 Hrs</option>
                  <option value='4'>4.0 Hrs</option>
                  <option value='4.5'>4.5 Hrs</option>
                  <option value='5'>5.0 Hrs</option>
                  <option value='5.5'>5.5 Hrs</option>
                  <option value='6'>6.0 Hrs</option>
                  <option value='6.5'>6.5 Hrs</option>
                  <option value='5'>7.0 Hrs</option>
                  <option value='7.5'>7.5 Hrs</option>
                  <option value='8'>8.0 Hrs</option>
                  <option value='8.5'>8.5 Hrs</option>
                  <option value='9'>9.0 Hrs</option>
                  <option value='9.5'>9.5 Hrs</option>
                  <option value='10'>10.0 Hrs</option>
                  <option value='10.5'>10.5 Hrs</option>
                  <option value='11'>11.0 Hrs</option>
                  </select>
                </div>
              </div>
            </div>
            <hr />
            <div class="extra-service">
              <p id="extra_service">Extra Services</p>
              <div class="row">

                <div class="col-lg-2 col-md-2 col-sm-3 service-items">
                  <input type="checkbox" id="1" style="visibility: hidden">
                 
                  <label for="1">

                    <div id="s-1" class="service-img ser-1" >
                      <img id="img-1" src="./assets/assets/3.png" alt="" />
                    </div>
                    <p>Inside cabinets</p>
                  </label>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 service-items">
                  <input type="checkbox" id="2" style="visibility: hidden">
                  <label for="2">
                  <div id="s-2" class="service-img ser-2" >
                    <img id="img-2" src="./assets/assets/5.png" alt="#" />
                  </div>
                  <p>Inside fridge</p>
                </label>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 service-items">
                  <input type="checkbox" id="3" style="visibility: hidden">
                  <label for="3">
                  <div id="s-3" class="service-img ser-3" >
                    <img id="img-3" src="./assets/assets/4.png" alt="#" />
                  </div>
                  <p>Inside oven</p>
                </label>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 service-items">
                  <input type="checkbox" id="4" style="visibility: hidden">
                  <label for="4">
                  <div id="s-4" class="service-img ser-4" >
                    <img id="img-4" src="./assets/assets/2.png" alt="#" />
                  </div>
                  <p>Laundry wash & dry</p>
                </label>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 service-items">
                  <input type="checkbox" id="5" style="visibility: hidden">
                  <label for="5">
                  <div id="s-5" class="service-img ser-5">
                    <img id="img-5" src="./assets/assets/1.png" alt="#" />
                  </div>
                  <p>Interior windows</p>
                </label>
                </div>
              </div>

            </div>
            <hr />
            <div class="comment-part">
              <p>Comments</p>
              <textarea name="comments_text" cols="110" rows="3" id="comment"></textarea>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="petcheck" />
                <label class="form-check-label" for="flexCheckDefault">
                  I have pets at home
                </label>
              </div>
              <hr />

             
            </div>
          
          <div class="continue-btn">
            <button class="tab" onclick="schedule_plan()">Continue</button>
          </div>
        </div>

        <div class="modal fade" id="login_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="login-modal" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Login to your account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="POST" class="form" action=<?= $base_url."./?controller=main_&function=login"?>>
                  <div class="col">
                    <input type="email" class="form-control" placeholder="Email" aria-label="email"
                    name="user_email" value="<?php if (isset($_COOKIE['email_cookie'])) {  echo $_COOKIE['email_cookie']; } ?>">
                    
                  </div>
                  <div class="col">
                    <input type="password" class="form-control" placeholder="password" aria-label="password"
                    name="pass" value="<?php if (isset($_COOKIE['password_cookie'])) {  echo $_COOKIE['password_cookie']; } ?>">
                  </div>
                  
                  <div class="form-check">
                  <?php if (isset($_COOKIE)) { ?>
                    <input class="form-check-input" type="checkbox" checked id="gridCheck"
                    name="remember">
                  <?php }
                    if (!isset($_COOKIE['emailcookie'])) { ?>
                    <input class="form-check-input" type="checkbox" id="gridCheck"
                    name="remember">
                    <?php } ?>
                    <label class="form-check-label" for="gridCheck">
                      Remember Me
                    </label>
                  </div>
                  <div class="login">
                    <button type="submit" id="login">
                      Login
                    </button>
                  </div>
                  <div class="model-footer">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#forgot">Forgot Password ?</a>
                    <p>Don't have an account? <span><a href="registration_page.php">Create an account</a></span></p>

                  </div>

                </form>
              </div>
              
            </div>
          </div>
        </div>

        <div id="step-3" data-tab-content class="tab-content">
          <div class="step-3-content">
            <h6>Enter your contact details, so we can serve you in better way !</h6>
            <div class="address-tab">

            </div>

            <button class="add-address" type="button" onclick="show_form()">+ Add New Address</button>

            <div class="address-card" id="address_form">

              <div class="row" id="addressform">
                <div class="col-md-6">
                  <label for="inputstreet" class="form-label">Street name</label>
                  <input type="text" class="form-control" id="inputstreet" name="street">
                  <p class="street_error" style="color: red"></p>
                </div>
                <div class="col-md-6">
                  <label for="inputhouse" class="form-label">House number</label>
                  <input type="number" class="form-control" id="inputhouse" name="house">
                  <p class="house_error" style="color: red"></p>
                </div>
                <div class="col-md-6">
                  <label for="inputpostal" class="form-label">Postal code</label>
                  <input type="number" class="form-control" id="inputpostal" name="postal_code">
                </div>
                <div class="col-md-6">
                  <label for="inputcity" class="form-label">City</label>
                  <select class="form-control" id="inputcity"></select>
                </div>
                <div class="col-md-6">
                  <label for="inputphone" class="form-label">Phone number</label>
                  <input type="tel" class="form-control" id="inputphone">
                  <p class="phone_error" style="color: red"></p>
                </div>
                <div class="btn-2">
                  <button type="submit" id="save" class="add_address" onclick="new_address()">
                    Save
                  </button>
                  <button type="reset"" id="cancle" onclick="cancle_form()">
                    Cancle
                  </button>

                </div>
              </div>

            </div>

            <h6 style="margin-top: 15px;">Your favourite service provider</h6>
            <hr>
            <div class="fav-sp">
              <p>You can choose your service provider from the below list</p>
              <div class="SP">

                
                  <div class="img-sp"><img src="./assets/assets/cap.png" alt="#"></div>

                  <p>Sandip Patel</p>
                  <div type="button" id="select">Select</div>
                
               
              </div>

              <hr>
              <div class="continue-btn">
                <button onclick="yourdetails()">Continue</button>
              </div>

            </div>

          </div>

        </div>

        <div id="step-4" data-tab-content class="tab-content">
          <div class="step-4-content">

            <h6>Pay securely with Helperland payment gateway!</h6>
            <p>Promo code (Optional)</p>
            
              <input type="text" placeholder="Promo code" id="promocode">
              <button type="submit" class="check-btn" id="apply">Apply</button>
            
            <hr>
            <div class="row payment-card" id="card">
             <div class="col-md-6">
                <input type="text" name="creditcardnumber" class="form-control payment-cardno" placeholder="Card number" required size="20" id="cr_no" maxlength="19">
                                                                      
              </div>
              <div class="col-md-3 col-sm-6 col-6">
              <input type="text" id="expiry" name="expirydate" class="form-control date" size="6" maxlength="5" placeholder="MM/YY" required />
                                    
              </div>
              <div class="col-md-3 col-sm-6 col-6">
              <input type="password" name="cvv" class="form-control cvv" placeholder="CVV" maxlength="4" required>
            
             </div>
             <div class="accepted_card">
             <span>Accepted cards</span> 
             <img src="./assets/assets/visa.png" alt="">
             <img src="./assets/assets/master.png" alt="">
             <img src="./assets/assets/american.png" alt="">
             </div>
            </div>

            <hr>

            <div class="final_check">
              <span class="checkbox_err text-danger"></span>
              <div class="form-check acceptance">
              <input class="form-check-input checkbox" type="checkbox" value="" id="Terms_condition" id="checkbox">
              <p class="form-check-label " for="Terms_condition">
              I accepted <span class="check_a"><a href="#">term and conditions</a>,</span>the <span class="check_a"><a href="#">cancellation policy</a></span> and the <span class="check_a"><a href="#">privacy policy.</a></span>
              I confirm that Helperland starts to execute the contract before the expiry of the withdrawal period and i lose my right of withdrawal as a consumer with full performance of the contract. 
              
              </p>
              </div>
            </div>

            <div class="booking-btn">
              <button onclick="complete_booking()">Complete Booking</button>
            </div>
          </div>

        </div>
      </div>

      <div class="payment_question col-lg-4">
        <div class="card" style="width: 16rem">
          <div class="card-body">
            <p class="title">Payment Summary</p>

            <div class="pay-details-1">
              <p class="card-text">
                <span class="selected_date">0000/00/00</span>  @
                <span class="selected_time">00:00</span>
              </p>
              <p class="card-text"> <span style="font-weight: bold;">Duration</span>
                <br>
                <span>Basic</span> <span style="margin-left: 130px;" class="basic_time">3 Hrs</span> <br>

                <p class="extra_ser extr_1" style="display: none;">Inside cabinets (extra) <span style="margin-left: 30px;">30 Mins</span>
                </p>
                <p class="extra_ser extr_2" style="display: none;">Inside cabinets (extra) <span style="margin-left: 30px;">30 Mins</span>
                </p>
                <p class="extra_ser extr_3" style="display: none;">Inside cabinets (extra) <span style="margin-left: 30px;">30 Mins</span>
                </p>
                <p class="extra_ser extr_4" style="display: none;">Inside cabinets (extra) <span style="margin-left: 30px;">30 Mins</span>
                </p>
                <p class="extra_ser extr_5" style="display: none;">Inside cabinets (extra) <span style="margin-left: 30px;">30 Mins</span>
                </p>

                <hr>
                <span style="font-weight: bold;">Total Service Time</span> <span
                  style="margin-left: 48px; font-weight: bold;" class="total_time">3 Hrs</span>
              </p>

            </div>
            <hr>
            <div class="pay-details-2">
              <p class="card-text">
                Per cleaning <span style="margin-left: 90px; font-weight: bold;">$18</span> <br>
                Discount <span style="margin-left: 104px; font-weight: bold;">-$00.0</span>
              </p>


            </div>
            <hr>
            <div class="total-payment">
              <p class="card-text">
                <span style="font-size: 15px; color: #1D7A8C; font-weight: 600;">Total Payment</span>
                <span id="payment">$63</span> <br>
                Effective price
                <span style="margin-left: 82px; font-size: 16px; font-weight: 700;" id="effective_price">$00.0</span> <br>
                <span style="color: red;">*</span>
                <span style="font-size: 12px;">You will save 20%</span>

              </p>

            </div>

            <div class="end-part">
              <a href="#" class="card-link"><img src="./assets/assets/smiley.png" alt=""> See what is always included</a>
            </div>
          </div>
        </div>
        <div class="questions col-lg-8 col-md-6 col-sm-6">
          <h6>Questions?</h6>
          <div class="accordion">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordionbutton" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                  aria-expanded="true" aria-controls="collapseOne" style="font-size: 13px;">
                  <span><img src="./assets/assets/keyboard-right-arrow-button.png" alt=""></span>
                  <span id="question"> Which Helperland professional will come to my place?</span>

                </button>
              </h2>

              <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id diam tincidunt, fringilla ante vitae,
                  dapibus velit. .
                </div>
              </div>
            </div>
            <hr>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordionbutton" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                  aria-expanded="true" aria-controls="collapseTwo" style="font-size: 13px;">
                  <span><img src="./assets/assets/keyboard-right-arrow-button.png" alt=""></span>
                  <span id="question"> Which Helperland professional will come to my place?</span>

                </button>
              </h2>

              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id diam tincidunt, fringilla ante vitae,
                  dapibus velit. .
                </div>
              </div>
            </div>
            <hr>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordionbutton" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                  aria-expanded="true" aria-controls="collapseThree" style="font-size: 13px;">
                  <span><img src="./assets/assets/keyboard-right-arrow-button.png" alt=""></span>
                  <span id="question"> Which Helperland professional will come to my place?</span>

                </button>
              </h2>

              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id diam tincidunt, fringilla ante vitae,
                  dapibus velit. .
                </div>
              </div>
            </div>
            <hr>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingFour">
                <button class="accordionbutton" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour"
                  aria-expanded="true" aria-controls="collapseFour" style="font-size: 13px;">
                  <span><img src="./assets/assets/keyboard-right-arrow-button.png" alt=""></span>
                  <span id="question"> Which Helperland professional will come to my place?</span>

                </button>
              </h2>

              <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed id diam tincidunt, fringilla ante vitae,
                  dapibus velit. .
                </div>
              </div>
            </div>
            <hr>
            <h6 id="forhelp"> <a href="">For more help</a> </h6>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="page-footer">
    <div class="row">
      <div class="col-lg-2 footer-img">
        <img src="./assets/assets/footer-logo.png" alt="" />
      </div>
      <div class="col-lg-7 col-md-7 footer-links">
        <a href="" class="f-links"><span>HOME</span></a>
        <a href="" class="f-links"><span>ABOUT</span></a>
        <a href="" class="f-links"><span>TESTIMONIALS</span></a>
        <a href="" class="f-links"><span>FAQS</span></a>
        <a href="" class="f-links"><span>INSURANCE POLICY</span></a>
        <a href="" class="f-links"><span>IMPRESSUM</span></a>
      </div>
      <div class="col-lg-2 col-md-3 footer-social">
        <a href="" class="f-social"><img src="./assets/assets/ic-facebook.png" alt="" /></a>
        <a href="" class="f-social"><img src="./assets/assets/ic-instagram.png" alt="" /></a>
      </div>
    </div>
  </footer>

  <script src="./assets/js/book_service.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="./assets/js/jquery.js"></script>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <?php
include('ajax_BS.php');
  ?>
  <script>
    
  </script>
</body>

</html>