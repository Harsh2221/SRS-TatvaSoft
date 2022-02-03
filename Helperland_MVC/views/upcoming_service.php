<?php
$base_url="https://localhost/tatvasoft/Helperland_MVC";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Upcoming services</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/css/upcoming_service.css" />
  </head>
  <body>
    <section class="navbar-area">
      <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"
            ><img src="./assets/assets/logo-small.png" alt=""
          /></a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span
              class="navbar-toggler-icon"
              
            ></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link border-btn" href="#">Prices& services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Warranty</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Blog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link border-btn" href="#" id="notify"
                  ><span><img src="./assets/assets/icon-notification.png" alt="" /></span
                ></a>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown"
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <span><img src="./assets/assets/user.png" alt="" /></span>
                  <span><img src="./assets/assets/sp-arrow-down.png" alt="" /></span>
                </a>

                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Settings</a></li>
                  <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </section>

    <section class="welcom-section">
      <div class="container-welcom">
        <h3>Welcome,HARSH!</h3>
      </div>
      <hr />
    </section>

    <section class="dashboard-content">
      
      <div class="container-main">
        <div class="row sidebar">
          <div class="col-lg-6 col-md-3 col-sm-6 left-sidebar">
          <div class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action p-2" href="#!"
              >Dashboard</a
            >
            <a class="list-group-item list-group-item-action p-2" href="#!"
              >New Service Requests</a
            >
            <a class="list-group-item list-group-item-action p-2 active" href="#upcoming-services"
              >Upcoming Services</a
            >
            <a class="list-group-item list-group-item-action p-2" href="#!">
              Service Schedule
            </a> 
            <a class="list-group-item list-group-item-action p-2" href="#!"
              >Service History
            </a>
            <a class="list-group-item list-group-item-action p-2" href="#!"
              >My Ratings</a
            >
            <a class="list-group-item list-group-item-action p-2" href="#!"
              >Block Customer</a
            >
          </div>
       
        </div>

       

        <div class="col-lg-6 col-md-3 col-sm-6">
            <div class="upcoming-ser" id="upcoming-services">
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Service ID <span><img src="./assets/assets/sort.png" alt="#"></span></th>
                    <th scope="col">Service Date <span><img src="./assets/assets/sort.png" alt="#"></span></th>
                    <th scope="col">Customer Details <span><img src="./assets/assets/sort.png" alt="#"></span></th> 
                    <th scope="col">Distance <span><img src="./assets/assets/sort.png" alt="#"></span></th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td scope="row">323436</td>
                    <td><span><img src="./assets/assets/calendar2.png" alt=""></span> 09/04/2018 <br> <span><img src="./assets/assets/layer-14.png" alt=""></span> 12:00 - 18:00 </td>
                    <td>David Bough <br> <span><img src="./assets/assets/layer-15.png" alt=""></span> Musterstrabe 5,12345 Bonn</td>
                    <td>15km</td>
                    <td><button class="cancle-btn">Cancle</button></td>
                  </tr>
                  <tr>
                    <td scope="row">323437</td>
                    <td><span><img src="assets/calendar2.png" alt=""></span> 09/04/2018 <br> <span><img src="assets/layer-14.png" alt=""></span> 12:00 - 18:00 </td>
                    <td>David Bough <br> <span><img src="assets/layer-15.png" alt=""></span> Musterstrabe 5,12345 Bonn</td>
                    <td>10km</td>
                    <td><button class="cancle-btn">Cancle</button></td>
                  </tr>
                  <tr>
                    <td scope="row">323438</td>
                    <td><span><img src="assets/calendar2.png" alt=""></span> 09/04/2018 <br> <span><img src="assets/layer-14.png" alt=""></span> 12:00 - 18:00 </td>
                    <td>David Bough <br> <span><img src="assets/layer-15.png" alt=""></span> Musterstrabe 5,12345 Bonn</td>
                    <td>10km</td>
                    <td><button class="cancle-btn">Cancle</button></td>
                  </tr>
                  <tr>
                    <td scope="row">323439</td>
                    <td><span><img src="assets/calendar2.png" alt=""></span> 09/04/2018 <br> <span><img src="assets/layer-14.png" alt=""></span> 12:00 - 18:00 </td>
                    <td>David Bough <br> <span><img src="assets/layer-15.png" alt=""></span> Musterstrabe 5,12345 Bonn</td>
                    <td>10km</td>
                    <td><button class="cancle-btn">Cancle</button></td>
                  </tr>
                  <tr>
                    <td scope="row">323440</td>
                    <td><span><img src="assets/calendar2.png" alt=""></span> 09/04/2018 <br> <span><img src="assets/layer-14.png" alt=""></span> 12:00 - 18:00 </td>
                    <td>David Bough <br> <span><img src="assets/layer-15.png" alt=""></span> Musterstrabe 5,12345 Bonn</td>
                    <td>10km</td>
                    <td><button class="cancle-btn">Cancle</button></td>
                  </tr>

                  <tr>
                    <td scope="row">323441</td>
                    <td><span><img src="assets/calendar2.png" alt=""></span> 09/04/2018 <br> <span><img src="assets/layer-14.png" alt=""></span> 12:00 - 18:00 </td>
                    <td>David Bough <br> <span><img src="assets/layer-15.png" alt=""></span> Musterstrabe 5,12345 Bonn</td>
                    <td>10km</td>
                    <td><button class="cancle-btn">Cancle</button></td>
                  </tr>
                  <tr>
                    <td scope="row">323442</td>
                    <td><span><img src="assets/calendar2.png" alt=""></span> 09/04/2018 <br> <span><img src="assets/layer-14.png" alt=""></span> 12:00 - 18:00 </td>
                    <td>David Bough <br> <span><img src="assets/layer-15.png" alt=""></span> Musterstrabe 5,12345 Bonn</td>
                    <td>10km</td>
                    <td><button class="cancle-btn">Cancle</button></td>
                  </tr>
                 
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
                <img src="assets/logo-small.png" alt="Helper Hand" />
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
                    <img src="assets/ic-facebook.png" alt="Facebook" />
                  </a>
                </li>
                <li>
                  <a href="#" target="_blank" title="Instagram">
                    <img src="assets/ic-instagram.png" alt="Instagram" />
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <script src="js/upcoming_service.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
  </body>
</html> 

