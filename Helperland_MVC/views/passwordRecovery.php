<?php 
$base_url="https://localhost/tatvasoft/Helperland_MVC";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./assets/css/passwordRecovery.css" />
    <title>Password | Recovery</title>
</head>
<body>
    <!-- Navbar -->
    <?php 
   include('navbar.php');
    ?>
      <!-- End of Navbar -->

      <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">Reset your Password</h5>
         <form method="POST" class="form" name="form" onsubmit="return validate()" action=<?= $base_url."./?controller=main_&function=resetPassword"?>>

         <input type="text" class="form-control" id="reset" name="reset" placeholder="ResetKey" value="<?php if(isset($_GET['parameter'])){echo $_GET['parameter'];} ?>" hidden>

             <input type="password" placeholder="Enter new password" name="new_password" id="pass1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,14}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 to 14 characters">
             <span id="msg1" style="visibility: hidden; color: red;">please enter password !</span>

             <input type="password" placeholder="confirm password" name="c_password" id="pass2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,14}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 to 14 characters">
             <span id="msg2" style="visibility: hidden; color: red;">please confirm password !</span>

             <div class="btn-div">
                <button type="submit" name="reset-btn" id="reset-btn">Reset</button>

             </div>
             
         </form>
          <div class="login">
            <a href="#" class="card-link">Login</a>
          </div>
                   
        </div>
      </div>





       <!-- Footer -->
       <?php 
   include('footer.php');
        ?>
      <!-- //Footer -->
      <script src="./assets/js/forgotPass.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
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