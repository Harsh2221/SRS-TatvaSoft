<?php 
$base_url="https://localhost/tatvasoft/Helperland_MVC";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/css/become_pro.css" />
    <title>Become a Helper</title>
  </head>
  <body>
    <!-- Navbar -->
    <section id="banner-section">
      <div class="hero-banner-section">
        <!-- Navbar -->
    <?php 
   include('navbar.php');
?>
    <!-- End of Navbar -->

        <div class="sign-in_card">
          <div class="card">
            <div class="card-body">

                
              <h5 class="card-title" style="text-align: center;">Register Now!</h5>
            
              <form method="POST" class="form" action=<?= $base_url."./?controller=main_&function=register_SP"?> name="regi_form" onsubmit="return validate()">
                <input
                  type="text"
                  placeholder="First name"
                  
                  id="f_name"
                  style="width: 90%"
                  name="firstName"
                />
                <span id="msg1" style="visibility: hidden; color: red;">please enter first name !</span>
                <br />
                <input
                  type="text"
                  
                  id="l_name"
                  style="width: 90%"
                  placeholder="Last name"
                  name="lastName"
                />
                <span id="msg2" style="visibility: hidden; color: red;">please enter last name !</span>
                <br />
                
                <input
                  type="email"
                  
                  id="email"
                  style="width: 90%"
                  placeholder="Email address"
                  name="email"
                />
                <span id="msg3" style="visibility: hidden; color: red;">please enter Email !</span>
                <br />
                <input
                  type="tel"
                  
                  id="number"
                  style="width: 90%"
                  placeholder="Mobile number"
                  name="number"
                  pattern="[0-9]{10}" title="Phone number must contains 10 digits"
                />
                <span id="msg4" style="visibility: hidden; color: red;">please enter number !</span>
                <br />
                <input
                  type="password"
                  style="width: 90%"
                  placeholder="Password"
                  name="password"
                  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,14}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 to 14 characters"
                />
                <span id="msg5" style="visibility: hidden; color: red;">please enter password !</span>
                <br />
                <input
                  type="password"
                  style="width: 90%"
                  placeholder="Confirm Password"
                  name="confirmPassword"
                  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,14}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 to 14 characters"
                />
                <span id="msg6" style="visibility: hidden; color: red;">please conform password !</span>
                <br />
                <input type="checkbox" id="check1" name="check1" />
                <label for="check1">Send me newsletters from Helperland</label
                ><br />
                <input type="checkbox" id="check2" name="check2" />
                <label for="check2"
                  >I accept
                  <span style="color: #1fb6ff"> terms and conditions</span> &
                  <span style="color: #1fb6ff">privacy policy</span> </label
                ><br />

                <div class="btn-con" style="text-align: center;">
                <button type="submit" class="s-btn">
                  Get Started
                  <span><img src="./assets/assets/arrow-white.png" alt="" /></span>
                </button>
            </div>
              </form>
            </div>
          </div>
        </div>

        <div class="scroll-down">
          <a href="#howitworks"> <img src="./assets/assets/group-18_5.png" alt="#" /></a>
        </div>
      </div>
    </section> 

    <section class="howitworks" id="howitworks">
      <div class="header">
        <h2>How it works</h2>
      </div>

      <div class="container-main">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Register yourself</h4>
                <p class="card-text">
                  Provide your basic information to register yourself as a
                  service provider.
                </p>
                <a href="#" class="btn"
                  >Read more
                  <span><img src="./assets/assets/shape-2.png" alt="" /></span>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 side-img">
            <img src="./assets/assets/img-1.jpeg"  alt="#" />
          </div>

        </div>

        <div class="row">

            <div class="col-lg-6 col-md-6 col-sm-12 side-img-c">
                <img src="./assets/assets/img-2.jpeg"  alt="#" />
              </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Get service requests</h4>
                  <p class="card-text">
                   you will get service request from customs depends on service area and profile.
                  </p>
                  <a href="#" class="btn"
                    >Read more
                    <span><img src="./assets/assets/shape-2.png" alt="" /></span>
                  </a>
                </div>
              </div>
            </div>
  
            
  
          </div>

          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Complete service</h4>
                  <p class="card-text">
                    Accept service request from your customers and complete your work.
                  </p>
                  <a href="#" class="btn"
                    >Read more
                    <span><img src="./assets/assets/shape-2.png" alt="" /></span>
                  </a>
                </div>
              </div>
            </div>
  
            <div class="col-lg-6 col-md-6 col-sm-12 side-img">
              <img src="./assets/assets/img-3.jpeg" class="rounded-circle"alt="#" />
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

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <script src="./assets/js/register.js"></script>
  </body>
</html>
