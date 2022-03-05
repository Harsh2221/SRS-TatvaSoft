<?php
$base_url = "http://localhost/tatvasoft/Helperland_MVC";
?>
<?php 
if (!isset($_SESSION['username'])) { ?>

<section id="nav">
      <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="homepage.php"
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
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a
                  class="nav-link border-btn-1"
                  aria-current="page"
                  href="book_services.php"
                  >Book Now</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link border-btn-1" href="price.php">Prices & Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Warranty</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Blog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link border-btn-1" href="#" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#login_modal">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link border-btn-1" href="service_provider_become_pro.php">Become a Helper</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </section>

<?php } ?>

<?php if (isset($_SESSION['username'])) { ?>
  <?php if(isset($_SESSION['usertypeCustomer'])){ ?>
    <section class="navbar-area">
      <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="homepage.php"
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
                <a
                  class="nav-link active border-btn"
                  aria-current="page"
                  href="book_services.php"
                  id="book-btn"
                  >Book Now</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link border-btn" href="price.php">Prices& services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Warranty</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Blog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link border-btn" href="#" id="notify"
                  ><span><img src="./assets/assets/icon-notification.png" alt="" /></span
                ></a>
              </li>
              <li class="nav-item dropdown dropstart">
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
                  <li><a class="dropdown-item disabled" >Welcome, 
                 
                  <?php echo $_SESSION["firstname"]; ?>
                  
                  </a></li>
                  <li><a class="dropdown-item" href="customerActivity.php">Dashboard</a></li>
                  <li><a class="dropdown-item" href="customerSetting.php">Settings</a></li>
                  
                  <li>
                  <form method="POST" action=<?= $base_url . "./?controller=main_&function=Logout" ?>>
                  <button  type="submit" class="dropdown-item" name="logout">Logout</a>
                  </form>
                  </li>
                  
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </section>
  <?php } ?>
<?php } ?>
