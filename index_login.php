<?php

$title = "User login";
require_once("includes-login/header.php"); 
require_once("connection_mysqli.php");

session_start(); 

   if(isset($_POST['enter'])) {
      $user = mysqli_real_escape_string($conn, $_POST['user']);
      $PW = mysqli_real_escape_string($conn, $_POST['pw']); 
      $pwEncrypt = sha1($PW);

      $query = "SELECT id FROM session_login WHERE user ='$user' AND pw ='$pwEncrypt'";
      $queryResult = $conn->query($query);
      $rows = $queryResult->num_rows;
   
      if($rows > 0) {
         $row = $queryResult->fetch_assoc();
         $_SESSION['id'] = $row['id'];
         header("Location: login_session_accepted.php?");
      }else{
         $error = "User or password is incorrect.";
      }
   }

?>

<body class="class-body">

<?php require_once("nav_login.php");?>


    <?php if(isset($error)) : ?>
    <div class="alert alert-dismissible fade show message bg-red-color" role="alert">
        <?php echo $error;?>
        <button type="button" class="btn-close" id="x-alert" data-bs-dismiss="alert"
            aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <?php if(isset($_GET['accountActive'])) : ?>
    <div class="alert alert-dismissible fade show message bg-green-color" role="alert">
        <?php echo $_GET['accountActive'];?>
        <button type="button" class="btn-close" id="x-alert" data-bs-dismiss="alert"
            aria-label="Close"></button>
    </div>
    <?php endif; ?>


   <div class="d-flex justify-content-center container-vh">

      <div class="flex-sm-row align-self-center container-form p-3">

         <div class="d-flex justify-content-center mb-3">
             <img src="img/user_session_2.svg" alt="">
         </div>

         <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" id="userform" class="form">

            <div class="input-group mb-3">
               <input type="text" class="form-control" name="user" placeholder="User" required>
            </div>

            <div class="input-group mb-3">
               <input type="password" class="form-control" name="pw" placeholder="Password" required>
            </div>

            <div class="row">
               <div class="col-sm-12 mb-1">
                  <button type="submit" name="enter" class="btn bg-green-color d-block w-100"><span>Log in</span></button>
               </div>
            </div>
                <p class="mb-0"><a href="registre.php">Register.</a></p>
                <a href="recovery_pass.php">Forgot your password?</a>

         </form>

      </div>
   </div>

<?php require_once("includes-login/footer.php"); ?>

</body>
</html>
