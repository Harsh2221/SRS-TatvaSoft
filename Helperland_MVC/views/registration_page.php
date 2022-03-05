<?php 
$base_url="https://localhost/tatvasoft/Helperland_MVC";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/css/registration_page.css" />
    <title>Create Account | Helperland</title>
</head>

<body>
    <!-- Navbar -->
    <?php 
   include('navbar.php');
?>
    <!-- End of Navbar -->
    <section class="content">
        <h2 class="text-center">Create Account</h2>
        <div class="separator-section">
            <img src="./assets/assets/separator.png" class="separator" alt="" />
            <hr class="w-25 m-auto" />
        </div>
        </section>

        <section class="registration">
            <div class="Regi_section">
                <form method="POST" class="form" action=<?= $base_url."./?controller=main_&function=register_user"?> name="regi_form" onsubmit="return validate()">
                    <div class="row register">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <input type="text" class="form-control" placeholder="First name" aria-label="First name" name="firstName" id="firstName">
                           <span id="msg1" style="color: red;"></span>
                            
                            
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <input type="text" class="form-control" placeholder="Last name" aria-label="Last name" name="lastName" id="lastName">
                            <span id="msg2" style="color: red;"></span>
                           
                        </div>
                    </div>

                    <div class="row register">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <input type="email" class="form-control" placeholder="E-mail" aria-label="email" name="email" id="email">
                            <span id="msg3" style="color: red;"></span>
                           
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <input type="text" class="form-control" placeholder="Mobile number" aria-label="mobile number" name="number" pattern="[0-9]{10}" title="Phone number must contains 10 digits" id="number">
                            <span id="msg4" style="color: red;"></span>
                            
                        </div>
                    </div>

                    <div class="row register">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <input type="password" class="form-control" placeholder="Password " aria-label="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,14}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 to 14 characters" id="password">
                            <span id="msg5" style="color: red;"></span>
                           
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <input type="password" class="form-control" placeholder="Confirm Password" aria-label="confirm password" name="confirmPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,14}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 to 14 characters" id="c_password">
                            <span id="msg6" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck" name="check1">
                        <label class="form-check-label" for="gridCheck">
                            Yes, I would like to subscribe to the Helperland GmbH newsletter with vouchers, trends, promotions and individualized offers. I can unsubscribe from the newsletter at any time in the newsletter and in my customer account.
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="agreecheck" name="check2">
                        <label class="form-check-label" for="gridCheck" >
                            I agree to the terms and conditions of Helperland GmbH.
                        </label>
                        <br>
                        <span id="msg7" style="color: red;"></span>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck" name="check3">
                        <label class="form-check-label" for="gridCheck">
                            I have read the privacy policy .
                        </label>
                      </div>

                      <div class="r-btn">
                        <button class="register-btn" type="submit">
                            Register
                        </button>
                      </div>

                      <div class="log-in">
                          <p>Already Registered ? <span><a href="homepage.php">Login Now</a></span></p>
                          

                      </div>
                      

                </form>
            </div>

        </section>

        <?php 
   include('footer.php');
?>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
            <script src="./assets/js/register.js"></script>
            <script src="./assets/js/jquery.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <?php
    if(isset($_SESSION['msg'])){

    ?>
    <script>
    swal({
      title: "<?php echo $_SESSION['msg'] ?>",
      icon: "<?php echo $_SESSION['icon'] ?>",
      button: "OK",
    });

    </script>
    <?php
    unset($_SESSION['msg']);
    }
    ?>
    
</body>

</html>