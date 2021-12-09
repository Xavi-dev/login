<?php 

$title = "Password recovery";
require_once("includes-login/header.php"); 
require_once("connection_mysqli.php");

   if(isset($_POST['recoverypass'])) {
      $email = mysqli_real_escape_string($conn,$_POST['email']);
      $queryEmailExists = "SELECT * FROM session_login WHERE email = '$email'";
      $stmtEmailExists = $conn->query($queryEmailExists);
      $result = $stmtEmailExists->num_rows;

      if($result < 1) {
         $error = "This email does not exist in the database!";
      }else{
         $user = $stmtEmailExists->fetch_assoc();
         $email = $user['email'];
         $token = $user['token'];
         $name = $user['name'];

         $messageSendEmail = "An email has been sent to your account to update your password.";

         $toUser = $email;
         $subject = "Password recovery";
         $message = "Hi " . $name . ". Click on the following link to update your password: http://your-domain-name/login/new_pass.php?email=" . $email . '&token=' . $token;
         mail($toUser,$subject,$message);
      }
   }

?>

<body class="class-body">

<?php 
   require_once("nav_login.php");
   require_once("includes-login/alert_error.php");
   require_once("includes-login/message.php");
?>

   <div class="d-flex justify-content-center container-vh">

      <div class="flex-sm-row align-self-center p-3">

      <div class="d-flex justify-content-center mb-3">
         <p class="color-grey pt-5">Enter your email to recover your password.</p>
      </div>

      <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="form">

         <div class="input-group">
            <input type="email" class="form-control mb-3" name="email" placeholder="Email" required>
         </div>

         <div>
            <button type="submit" name="recoverypass" class="btn bg-green-color d-block w-100"><span>Recovery password</span></button>
         </div>
                
      </form>

      </div>
   </div>

<?php require_once("includes-login/footer.php"); ?>

</body>
