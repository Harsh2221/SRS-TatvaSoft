<?php
$base_url = "http://localhost/tatvasoft/Helperland_MVC";
?>
<?php 
if (isset($_SESSION['username'])) { ?>
    <?php if(isset($_SESSION['usertypeAdmin'])){ ?>
        <section class="navbar-area">
        <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <h2>helperland</h2>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

            <li class="nav-item">
              <a class="nav-link" href="#">
                <span><img src="./assets/assets/user.png" alt="" /></span>
                <?php echo $_SESSION["firstname"]; ?>
              </a>

            <li class="nav-item">
            <form method="POST" action=<?= $base_url . "./?controller=main_&function=Logout" ?>>
              <button type="submit" class="nav-link logout-btn"><img src="./assets/assets/logout.png" alt="#"></button>
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
