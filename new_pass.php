<?php 

$title = "New password";
require_once("includes-login/header.php"); 
require_once("connection_mysqli.php");

session_start();

   if(isset($_GET['email']) AND isset($_GET['token'])) {
      $email = mysqli_real_escape_string($conn,$_GET['email']);
      $token = mysqli_real_escape_string($conn,$_GET['token']);

      $query = "SELECT * FROM session_login WHERE email = '$email' AND token = '$token'";
      $stmt = $conn->query($query);
      $result = $stmt->num_rows;

      if($result < 1) {
         header("Location: index_login.php");
         exit();
      }
   }

?>

<body class="class-body">
   

<?php require_once("nav_login.php");?>

   <?php if(isset($_GET['pw_error'])) : ?>
      <div class="alert alert-dismissible fade show message bg-red-color" role="alert">
         <?php echo $_GET['pw_error'];?>
            <button type="button" class="btn-close" id="x-alert" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
   <?php endif; ?>

   <?php if(isset($_GET['pw_update'])) : ?>
      <div class="alert alert-dismissible fade show message bg-green-color" role="alert">
         <?php echo $_GET['pw_update']; ?>
         <button type="button" class="btn-close" id="x-alert" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
   <?php endif; ?>


   <div class="d-flex justify-content-center container-vh">

      <div class="flex-sm-row align-self-center container-form p-3">

         <form action="check_recovery_pass.php" method="POST" id="userform" class="form">

            <div class="input-group mb-3">
               <input type="password" class="form-control" name="newPw" placeholder="New password" required>
            </div>

            <div class="input-group mb-3">
               <input type="password" class="form-control" name="repeatPw" placeholder="Confirm password" required>
            </div>

            <div class="row">
               <div class="col-sm-12 mb-1">
                  <input type="hidden" name="email" value="<?= $email ?>">
                  <input type="hidden" name="token" value="<?= $token ?>">
                     <button type="submit" name="enter" class="btn bg-green-color d-block w-100"><span>Update</span></button>
                     <p class="mb-0 mt-1"><a href="index-login.php">Log in.</a></p>
                </div>
            </div>

         </form>
      </div>
   </div>

<?php require_once("includes-login/footer.php"); ?>

</body>
</html>

