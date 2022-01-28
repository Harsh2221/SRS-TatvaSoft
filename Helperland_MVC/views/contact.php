<?php 
$base_url="https://localhost/php-mvc/Helperland_MVC/";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <title>Contact page</title>
    <link rel="stylesheet" href="./assets/css/contact.css" />
  </head>
  <body>
    <!-- Navbar -->
    <?php 
   include('navbar.php');
?>
    <!-- End of Navbar -->

    <section class="hero"><img src="./assets/assets/group-16_2.png" alt=#" /></section>

    <section class="contact">
      <h1 class="text-center" style="color: #4f4f4f">Contact us</h1>
      <div class="separator-section">
        <img src="./assets/assets/separator.png" class="separator" alt="" />
        <hr class="w-25 m-auto" />
      </div>

      <div class="contact-icon">
        <div class="row">
          <div class="col-lg-4 col-md-3 col-sm-6 contact-item">
            <div class="contact-img">
              <img src="./assets/assets/forma-1_2.png" alt="#" />
            </div>
            <p>
              1111 Lorem ipsum text 100, <br />
              Lorem ipsum AB
            </p>
          </div>

          <div class="col-lg-4 col-md-3 col-sm-6 contact-item">
            <div class="contact-img">
              <img src="./assets/assets/phone-call.png" alt="#" />
            </div>
            <p>
              +49 (40) 123 56 7890 <br />
              Lorem +49 (40) 987 56 0000
            </p>
          </div>

          <div class="col-lg-4 col-md-3 col-sm-6 contact-item">
            <div class="contact-img">
              <img src="./assets/assets/vector-smart-object.png" alt="#" />
            </div>
            <p>info@helperland.com</p>
          </div>
        </div>
        <hr class="m-auto line" />
      </div>
    </section>

    <section class="getintouch">
      <h2 class="text-center" style="color: #4f4f4f">Get in touch with us</h2>

      <div class="form-div">
        <form method="POST" class="form" action=<?= $base_url."./?controller=main_&function=contactus"?>>
          <input type="text" name="f_name" id="f_name" placeholder="First name" />
          <input type="text" name="l_name" id="l_name" placeholder="Last name" />
          <br />
          <input type="tel" name="number" id="number" placeholder="Mobile number" />
          <input type="email" name="email" id="email" placeholder="Email address" />
          <br />
          <select name="subject" id="sub">
            <option value="subject">Subject</option>
            <option value="general">General</option>
            <option value="subscription">subscription</option>
            
          </select>
          <br />
          <textarea
            name="message"
            id="msg"
            cols="45"
            rows="5"
            placeholder="Message"
          ></textarea>
          <br />
          <button class="submit-btn">Submit</button>
        </form>
      </div>
    </section>
    <section class="hero" style="margin-bottom: 60px">
      <img src="./assets/assets/group-16.png" alt=#" />
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
  </body>
</html> 
